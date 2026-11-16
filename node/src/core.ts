import { AuthResource } from './auth.js';
import { AuthenticationError, ConnectionError, SiakadError, TimeoutError, errorFromStatus } from './errors.js';
import { MemoryTokenStore, type TokenStore } from './token-store.js';
import type {
  ApiResult,
  Meta,
  Query,
  RequestOptions,
  RequestSpec,
  SiakadFile,
  SiakadOptions,
  TokenSet,
  Uploadable,
} from './types.js';
import { VERSION } from './version.js';

const DEFAULT_BASE_URL = 'https://api.unipo.ac.id';
/** Token dianggap habis bila sisa umurnya kurang dari ini (detik), supaya tidak habis di tengah jalan. */
const EXPIRY_MARGIN = 60;
const sharedStore = new MemoryTokenStore();

type FetchResponse = Awaited<ReturnType<typeof fetch>>;

/**
 * Inti klien: HTTP, token, percobaan ulang, dan galat. Kelas {@link Siakad} (hasil generator) menambahkan
 * semua modul API di atas kelas ini.
 */
export class SiakadCore {
  /** Autentikasi: token aplikasi/pengguna, SSO, refresh, revoke, info token, lupa password. */
  readonly auth: AuthResource;

  protected readonly options: Readonly<SiakadOptions>;
  private readonly baseUrl: string;
  private readonly fetchFn: typeof fetch;
  private readonly store: TokenStore;
  private userToken: { access: string; refresh?: string; expiresAt?: number } | null;
  private pendingToken: Promise<string> | null = null;

  constructor(options: SiakadOptions = {}) {
    this.options = Object.freeze({ ...options });
    this.baseUrl = (options.baseUrl ?? DEFAULT_BASE_URL).replace(/\/+$/, '').replace(/\/v1$/, '');
    const f = options.fetch ?? globalThis.fetch;
    if (typeof f !== 'function') {
      throw new SiakadError('fetch tidak tersedia. Pakai Node.js 18+ atau isi opsi `fetch`.');
    }
    this.fetchFn = f.bind(globalThis);
    this.store = options.tokenStore ?? sharedStore;
    this.userToken = options.accessToken
      ? { access: options.accessToken, refresh: options.refreshToken, expiresAt: options.accessTokenExpiresAt }
      : null;
    this.auth = new AuthResource(this);
  }

  /**
   * Klien baru yang memakai token pengguna (hasil `auth.password()`, `auth.exchangeSsoToken()`, atau token yang
   * disimpan di sesi). Opsi lain (baseUrl, clientId, clientSecret, ...) ikut disalin, sehingga token pengguna bisa
   * diperpanjang otomatis dengan refresh token.
   */
  withToken(token: TokenSet | string, onTokenRefresh?: SiakadOptions['onTokenRefresh']): this {
    const t: Partial<TokenSet> & { access_token: string } = typeof token === 'string' ? { access_token: token } : token;
    const Ctor = this.constructor as new (o: SiakadOptions) => this;
    return new Ctor({
      ...this.options,
      accessToken: t.access_token,
      refreshToken: typeof t.refresh_token === 'string' ? t.refresh_token : undefined,
      accessTokenExpiresAt:
        typeof t.expires_at === 'number'
          ? t.expires_at
          : typeof t.expires_in === 'number'
            ? Date.now() + t.expires_in * 1000
            : undefined,
      onTokenRefresh: onTokenRefresh ?? this.options.onTokenRefresh,
    });
  }

  /** Klien baru dengan opsi yang diubah, mis. `siakad.withOptions({ environment: 'development' })`. */
  withOptions(options: Partial<SiakadOptions>): this {
    const Ctor = this.constructor as new (o: SiakadOptions) => this;
    return new Ctor({ ...this.options, ...options });
  }

  /** Alamat dasar yang dipakai (tanpa `/v1`). */
  get url(): string {
    return this.baseUrl;
  }

  /**
   * Panggil endpoint apa pun secara langsung, mis. endpoint baru yang belum ada di SDK:
   *
   * ```ts
   * const r = await siakad.request({ method: 'GET', path: '/v1/mahasiswa/{nim}', query: { nim: '2025001' } });
   * ```
   * Placeholder `{nama}` di path diisi dari `query` (lalu dihapus dari query).
   */
  async request<T = unknown>(spec: RequestSpec, options: RequestOptions = {}): Promise<ApiResult<T>> {
    const query: Query = { ...(spec.query ?? {}), ...(options.query ?? {}) };
    const path = spec.path.replace(/\{([A-Za-z0-9_]+)\}/g, (_m, name: string) => {
      const v = query[name];
      if (v === undefined || v === null || v === '') {
        throw new SiakadError(`Parameter path "${name}" wajib diisi untuk ${spec.path}.`, { code: 'missing_parameter' });
      }
      delete query[name];
      return encodeURIComponent(String(v));
    });

    const maxRetries = options.maxRetries ?? this.options.maxRetries ?? 2;
    let authRetried = false;

    for (let attempt = 0; ; attempt++) {
      let token: string | null = null;
      try {
        token = await this.tokenFor(spec.public === true);
      } catch (e) {
        if (!spec.public) throw e;
      }

      let res: FetchResponse;
      try {
        res = await this.send(spec.method, path, query, spec.body, spec.multipart === true, token, options);
      } catch (e) {
        const retryable = spec.method === 'GET' && attempt < maxRetries && !(options.signal?.aborted ?? false);
        if (retryable) {
          await sleep(backoff(attempt));
          continue;
        }
        throw e;
      }

      if (res.ok) return this.parse<T>(res);

      const error = await this.toError(res);

      // Token kedaluwarsa/dicabut: buang token lama, minta yang baru sekali.
      if (res.status === 401 && token !== null && !authRetried && (await this.canRenew())) {
        authRetried = true;
        await this.forgetToken();
        continue;
      }
      if (attempt < maxRetries) {
        if (res.status === 429) {
          const wait = error instanceof SiakadError ? Number.parseInt(error.headers['retry-after'] ?? '', 10) : NaN;
          await sleep(Math.min(Number.isFinite(wait) ? wait * 1000 : backoff(attempt), 60_000));
          continue;
        }
        if ([502, 503, 504].includes(res.status) && error.code !== 'api_disabled' && error.code !== 'pemeliharaan') {
          await sleep(backoff(attempt));
          continue;
        }
      }
      throw error;
    }
  }

  /**
   * Iterasi semua item dari endpoint daftar, halaman demi halaman.
   *
   * ```ts
   * for await (const mhs of siakad.paginate((q) => siakad.mahasiswa.list(q), { prodi: '86206' })) { ... }
   * const semua = await siakad.paginate((q) => siakad.lms.getKelas(q)).all();
   * ```
   */
  paginate<T, Q extends Query = Query>(
    fetchPage: (query: Q & { page: number; per_page: number }) => Promise<ApiResult<T[]>>,
    query?: Omit<Q, 'page' | 'per_page'> & { per_page?: number; page?: number },
  ): Paginator<T> {
    return new Paginator<T>(async (page, perPage) =>
      fetchPage({ ...(query ?? {}), page, per_page: perPage } as Q & { page: number; per_page: number }),
      Number(query?.page ?? 1),
      Number(query?.per_page ?? 100),
    );
  }

  // ------------------------------------------------------------------ token

  /** @internal Dipakai AuthResource. */
  async requestToken(params: Record<string, string>, opts: { userIp?: string } = {}): Promise<TokenSet> {
    const { clientId, clientSecret } = this.options;
    if (!clientId || !clientSecret) {
      throw new SiakadError('clientId dan clientSecret wajib diisi untuk meminta token.', { code: 'missing_credentials' });
    }
    const headers: Record<string, string> = {
      Authorization: 'Basic ' + base64(`${clientId}:${clientSecret}`),
      'Content-Type': 'application/json',
      Accept: 'application/json',
      ...this.baseHeaders(),
    };
    const ip = opts.userIp ?? this.options.userIp;
    if (ip) headers['X-Siakad-User-Ip'] = ip;

    const res = await this.fetchWithTimeout(this.baseUrl + '/v1/auth/token', {
      method: 'POST',
      headers,
      body: JSON.stringify(params),
    });
    if (!res.ok) throw await this.toError(res);
    const token = (await res.json()) as TokenSet;
    token.expires_at = Date.now() + Number(token.expires_in ?? 3600) * 1000;
    return token;
  }

  /** @internal Token yang sedang dipakai (tanpa meminta yang baru). */
  currentAccessToken(): string | null {
    return this.userToken?.access ?? null;
  }

  private cacheKey(): string {
    const scope = Array.isArray(this.options.scope) ? this.options.scope.join(' ') : (this.options.scope ?? '');
    return `unipo-siakad:${this.baseUrl}:${this.options.clientId ?? ''}:${scope}:${this.options.environment ?? ''}`;
  }

  private async tokenFor(isPublic: boolean): Promise<string | null> {
    if (this.userToken) {
      const exp = this.userToken.expiresAt;
      if (exp !== undefined && exp - EXPIRY_MARGIN * 1000 <= Date.now() && !isPublic && (await this.canRenew())) {
        return this.renewUserToken();
      }
      return this.userToken.access;
    }
    if (!this.options.clientId || !this.options.clientSecret) {
      if (isPublic) return null;
      throw new AuthenticationError(
        'Belum ada token. Isi clientId + clientSecret, atau accessToken, atau pakai withToken().',
        { code: 'missing_credentials' },
      );
    }
    const cached = await this.store.get(this.cacheKey());
    if (cached && (cached.expires_at ?? 0) - EXPIRY_MARGIN * 1000 > Date.now()) return cached.access_token;
    if (isPublic) return null;

    // Satu permintaan token untuk banyak pemanggilan serentak.
    this.pendingToken ??= (async () => {
      try {
        const scope = this.options.scope;
        const params: Record<string, string> = { grant_type: 'client_credentials' };
        if (scope && scope.length > 0) params.scope = Array.isArray(scope) ? scope.join(' ') : scope;
        const token = await this.requestToken(params);
        await this.store.set(this.cacheKey(), token, Math.max(1, Number(token.expires_in) - EXPIRY_MARGIN));
        return token.access_token;
      } finally {
        this.pendingToken = null;
      }
    })();
    return this.pendingToken;
  }

  private async canRenew(): Promise<boolean> {
    if (!this.options.clientId || !this.options.clientSecret) return false;
    return this.userToken === null || Boolean(this.userToken.refresh);
  }

  private async renewUserToken(): Promise<string> {
    this.pendingToken ??= (async () => {
      try {
        const token = await this.requestToken({ grant_type: 'refresh_token', refresh_token: this.userToken!.refresh! });
        this.userToken = { access: token.access_token, refresh: token.refresh_token ?? undefined, expiresAt: token.expires_at };
        await this.options.onTokenRefresh?.(token);
        return token.access_token;
      } finally {
        this.pendingToken = null;
      }
    })();
    return this.pendingToken;
  }

  private async forgetToken(): Promise<void> {
    if (this.userToken) {
      if (this.userToken.refresh) this.userToken.expiresAt = 0;
      return;
    }
    await this.store.delete(this.cacheKey());
  }

  // ------------------------------------------------------------------ HTTP

  private baseHeaders(): Record<string, string> {
    const h: Record<string, string> = { ...(this.options.headers ?? {}) };
    if (this.options.environment) h['X-Siakad-Lingkungan'] = this.options.environment;
    if (typeof (globalThis as { window?: unknown }).window === 'undefined') {
      h['User-Agent'] ??= `unipo-siakad-sdk-node/${VERSION}`;
    }
    return h;
  }

  private async send(
    method: RequestSpec['method'],
    path: string,
    query: Query,
    body: unknown,
    multipart: boolean,
    token: string | null,
    options: RequestOptions,
  ): Promise<FetchResponse> {
    const headers: Record<string, string> = { Accept: 'application/json', ...this.baseHeaders(), ...(options.headers ?? {}) };
    if (token) headers.Authorization = `Bearer ${token}`;

    let httpMethod: string = method;
    if (this.options.methodOverride && (method === 'PUT' || method === 'PATCH' || method === 'DELETE')) {
      headers['X-HTTP-Method-Override'] = method;
      httpMethod = 'POST';
    }

    let payload: BodyInit | undefined;
    if (body !== undefined && body !== null && method !== 'GET') {
      if (multipart) {
        payload = toFormData(body as Record<string, unknown>);
      } else {
        headers['Content-Type'] = 'application/json';
        payload = JSON.stringify(body);
      }
    } else if (httpMethod === 'POST' && method !== 'POST') {
      headers['Content-Type'] = 'application/json';
      payload = '{}';
    }

    return this.fetchWithTimeout(this.baseUrl + path + buildQuery(query), { method: httpMethod, headers, body: payload }, options);
  }

  private async fetchWithTimeout(url: string, init: RequestInit, options: RequestOptions = {}): Promise<FetchResponse> {
    const timeout = options.timeout ?? this.options.timeout ?? 30_000;
    const controller = new AbortController();
    const timer = setTimeout(() => controller.abort(new TimeoutError(`Batas waktu ${timeout} ms habis.`, { code: 'timeout' })), timeout);
    const onAbort = () => controller.abort(options.signal?.reason);
    options.signal?.addEventListener('abort', onAbort, { once: true });
    try {
      return await this.fetchFn(url, { ...init, signal: controller.signal });
    } catch (e) {
      if (controller.signal.reason instanceof TimeoutError) throw controller.signal.reason;
      if (options.signal?.aborted) throw e;
      throw new ConnectionError(`Tidak bisa menghubungi ${this.baseUrl}: ${(e as Error)?.message ?? e}`, { code: 'connection_failed', cause: e });
    } finally {
      clearTimeout(timer);
      options.signal?.removeEventListener('abort', onAbort);
    }
  }

  private async parse<T>(res: FetchResponse): Promise<ApiResult<T>> {
    const headers = headersToObject(res.headers);
    const base = {
      status: res.status,
      requestId: headers['x-request-id'] ?? null,
      environment: headers['x-siakad-lingkungan'] ?? null,
      headers,
    };
    if (res.status === 204) return { ...base, data: null as T };

    const type = headers['content-type'] ?? '';
    if (!type.includes('json')) {
      const bytes = new Uint8Array(await res.arrayBuffer());
      return { ...base, data: makeFile(bytes, type || 'application/octet-stream', headers['content-disposition']) as T };
    }
    const text = await res.text();
    if (text === '') return { ...base, data: null as T };
    const json = JSON.parse(text) as unknown;
    if (json !== null && typeof json === 'object' && !Array.isArray(json) && 'data' in json) {
      const env = json as { data: T; meta?: Meta };
      return { ...base, data: env.data, ...(env.meta !== undefined ? { meta: env.meta } : {}) };
    }
    return { ...base, data: json as T };
  }

  private async toError(res: FetchResponse): Promise<SiakadError> {
    const headers = headersToObject(res.headers);
    let code = 'http_' + res.status;
    let message = `HTTP ${res.status}`;
    let details: Record<string, unknown> = {};
    let requestId = headers['x-request-id'] ?? null;
    const text = await res.text().catch(() => '');
    try {
      const json = JSON.parse(text) as {
        error?: { code?: string; message?: string; details?: Record<string, unknown> } | string;
        error_description?: string;
        request_id?: string;
      };
      if (json.error && typeof json.error === 'object') {
        code = json.error.code ?? code;
        message = json.error.message ?? message;
        details = json.error.details ?? {};
      } else if (typeof json.error === 'string') {
        code = json.error;
        message = json.error_description ?? message;
      }
      requestId = json.request_id ?? requestId;
    } catch {
      // Bukan JSON: biasanya ditolak server web/hosting sebelum sampai ke API.
      if (text) message += ` (bukan jawaban API: ${text.replace(/<[^>]+>/g, ' ').replace(/\s+/g, ' ').trim().slice(0, 160)})`;
      if (res.status === 403 || res.status === 405) {
        message += '. Bila hosting menolak PUT/PATCH/DELETE, coba opsi methodOverride: true.';
      }
    }
    return errorFromStatus(res.status, message, { code, details, requestId, headers });
  }
}

/** Iterator halaman untuk {@link SiakadCore.paginate}. */
export class Paginator<T> implements AsyncIterable<T> {
  constructor(
    private readonly fetchPage: (page: number, perPage: number) => Promise<ApiResult<T[]>>,
    private readonly startPage = 1,
    private readonly perPage = 100,
  ) {}

  /** Iterasi per halaman (hasil lengkap dengan `meta`). */
  async *pages(): AsyncGenerator<ApiResult<T[]>> {
    for (let page = this.startPage; ; page++) {
      const result = await this.fetchPage(page, this.perPage);
      yield result;
      const items = Array.isArray(result.data) ? result.data : [];
      const total = result.meta?.total_pages;
      if (items.length === 0) return;
      if (typeof total === 'number' ? page >= total : items.length < this.perPage) return;
    }
  }

  async *[Symbol.asyncIterator](): AsyncIterator<T> {
    for await (const result of this.pages()) {
      for (const item of Array.isArray(result.data) ? result.data : []) yield item;
    }
  }

  /** Kumpulkan semua item. `limit` membatasi jumlah item (bawaan 10.000) agar tidak menghabiskan memori. */
  async all(limit = 10_000): Promise<T[]> {
    const out: T[] = [];
    for await (const item of this) {
      out.push(item);
      if (out.length >= limit) break;
    }
    return out;
  }
}

// ------------------------------------------------------------------ util

function sleep(ms: number): Promise<void> {
  return new Promise((r) => setTimeout(r, ms));
}

function backoff(attempt: number): number {
  return Math.min(500 * 2 ** attempt, 8000) + Math.floor(Math.random() * 250);
}

function base64(s: string): string {
  const bytes = new TextEncoder().encode(s);
  let bin = '';
  for (const b of bytes) bin += String.fromCharCode(b);
  return btoa(bin);
}

function headersToObject(h: Headers): Record<string, string> {
  const out: Record<string, string> = {};
  h.forEach((v, k) => {
    out[k.toLowerCase()] = v;
  });
  return out;
}

/** @internal */
export function buildQuery(query: Query): string {
  const parts: string[] = [];
  for (const [k, v] of Object.entries(query)) {
    if (v === undefined || v === null) continue;
    if (Array.isArray(v)) {
      for (const item of v) parts.push(`${encodeURIComponent(k)}[]=${encodeURIComponent(String(item))}`);
    } else {
      parts.push(`${encodeURIComponent(k)}=${encodeURIComponent(typeof v === 'boolean' ? (v ? '1' : '0') : String(v))}`);
    }
  }
  return parts.length ? '?' + parts.join('&') : '';
}

function isUploadable(v: unknown): v is Uploadable {
  return (
    (typeof Blob !== 'undefined' && v instanceof Blob) ||
    v instanceof Uint8Array ||
    v instanceof ArrayBuffer ||
    (typeof v === 'object' && v !== null && 'data' in v && 'filename' in v)
  );
}

function toBlob(v: Uploadable): { blob: Blob; filename?: string } {
  if (typeof Blob !== 'undefined' && v instanceof Blob) {
    return { blob: v, filename: (v as Blob & { name?: string }).name };
  }
  if (v instanceof Uint8Array || v instanceof ArrayBuffer) return { blob: new Blob([v as BlobPart]) };
  const f = v as { data: Blob | Uint8Array | ArrayBuffer; filename: string; contentType?: string };
  const blob =
    f.data instanceof Blob ? f.data : new Blob([f.data as BlobPart], f.contentType ? { type: f.contentType } : undefined);
  return { blob, filename: f.filename };
}

/** @internal */
export function toFormData(body: Record<string, unknown>): FormData {
  if (typeof FormData !== 'undefined' && body instanceof FormData) return body;
  const form = new FormData();
  const add = (key: string, v: unknown): void => {
    if (v === undefined || v === null) return;
    if (isUploadable(v)) {
      const { blob, filename } = toBlob(v);
      form.append(key, blob, filename ?? 'berkas');
    } else if (Array.isArray(v)) {
      for (const item of v) add(`${key}[]`, item);
    } else if (typeof v === 'object') {
      form.append(key, JSON.stringify(v));
    } else {
      form.append(key, typeof v === 'boolean' ? (v ? '1' : '0') : String(v));
    }
  };
  for (const [k, v] of Object.entries(body)) add(k, v);
  return form;
}

function makeFile(bytes: Uint8Array, contentType: string, disposition?: string): SiakadFile {
  let filename: string | null = null;
  if (disposition) {
    const star = /filename\*=UTF-8''([^;]+)/i.exec(disposition);
    const plain = /filename="?([^";]+)"?/i.exec(disposition);
    filename = star ? decodeURIComponent(star[1]!) : plain ? plain[1]! : null;
  }
  return {
    filename,
    contentType,
    size: bytes.byteLength,
    bytes,
    text: () => new TextDecoder().decode(bytes),
    blob: () => new Blob([bytes as BlobPart], { type: contentType }),
  };
}
