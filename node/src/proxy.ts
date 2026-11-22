import type { SiakadCore } from './core.js';
import { SiakadError } from './errors.js';
import type { Query, RequestSpec, SiakadFile } from './types.js';

type Metode = RequestSpec['method'];

/** Jawaban tiruan untuk satu rute: data saja, `{ data, meta }`, atau fungsi yang menerima query. */
export type JawabanTiruan = unknown | ((query: URLSearchParams, body: unknown) => unknown | Promise<unknown>);

export interface OpsiProxySiakad {
  /**
   * Klien SDK di server yang memanggil API SIAKAD: `new Siakad({ clientId, clientSecret })` (token aplikasi), atau
   * fungsi yang membuat klien per permintaan, mis. `(req) => siakad.withToken(await tokenPenggunaDariSesi(req))`.
   * Boleh kosong bila `tiruan` diisi (mode data tiruan, tanpa API sungguhan).
   */
  siakad?: SiakadCore | ((req: Request) => SiakadCore | null | Promise<SiakadCore | null>);
  /** Awalan jalur di aplikasi Anda yang dibuang sebelum diteruskan, mis. `'/api/siakad'`. Bawaan: tanpa awalan. */
  awalan?: string;
  /**
   * Jalur API yang boleh diteruskan. String = awalan (`'/v1/referensi/'`), RegExp = pola. Bawaan: semua `/v1/...`
   * kecuali `/v1/auth/`. Persempit sesuai kebutuhan aplikasi agar browser tidak bisa memanggil endpoint lain.
   */
  izinkan?: Array<string | RegExp>;
  /** Metode HTTP yang boleh diteruskan. Bawaan hanya `GET` (baca saja). */
  metode?: Metode[];
  /**
   * Data tiruan per rute, kunci `"GET /v1/referensi/prodi"`. Dipakai bila `siakad` kosong (mis. belum punya
   * client_id), atau selalu bila `selaluTiruan` true. Rute yang tidak ada di sini dijawab 404.
   */
  tiruan?: Record<string, JawabanTiruan>;
  /** Pakai `tiruan` walau `siakad` diisi (mis. untuk uji). */
  selaluTiruan?: boolean;
}

/** Penanganan permintaan bergaya Web (Request → Response): Next.js route handler, Hono, Bun, Deno, Cloudflare. */
export type PenanganProxy = (req: Request) => Promise<Response>;

const BAWAAN_IZIN: Array<string | RegExp> = [/^\/v1\/(?!auth\/)/];

/**
 * Proxy server ke API SIAKAD untuk komponen `unipo-ui/siakad` di browser. Browser memanggil jalur aplikasi Anda
 * (`/api/siakad/v1/...`), server meneruskannya dengan token yang disimpan di server, sehingga client_secret tidak
 * pernah sampai ke browser.
 *
 * ```ts
 * // Next.js: app/api/siakad/[...jalur]/route.ts
 * import { Siakad, proxySiakad } from 'unipo-siakad-sdk';
 * const proxy = proxySiakad({ siakad: new Siakad({ clientId: process.env.SIAKAD_CLIENT_ID, clientSecret: process.env.SIAKAD_CLIENT_SECRET }), awalan: '/api/siakad', izinkan: ['/v1/referensi/'] });
 * export { proxy as GET };
 * ```
 * Di sisi browser: `<UnipoProvider baseUrl="/api/siakad">`.
 */
export function proxySiakad(opsi: OpsiProxySiakad): PenanganProxy {
  const awalan = (opsi.awalan ?? '').replace(/\/+$/, '');
  const izin = opsi.izinkan ?? BAWAAN_IZIN;
  const metode = new Set<string>((opsi.metode ?? ['GET']).map((m) => m.toUpperCase()));

  return async (req) => {
    const url = new URL(req.url);
    let path = url.pathname;
    if (awalan) {
      if (path !== awalan && !path.startsWith(awalan + '/')) return galat(404, 'not_found', 'Jalur tidak dikenal.');
      path = path.slice(awalan.length) || '/';
    }
    path = '/' + path.replace(/^\/+/, '');
    // Tolak jalur yang mencoba keluar dari /v1 (../, %2e%2e, //).
    if (!path.startsWith('/v1/') || /(^|\/)\.\.?(\/|$)/.test(path) || /%2e|%2f|%5c/i.test(url.pathname)) {
      return galat(404, 'not_found', 'Jalur API tidak dikenal.');
    }
    const m = req.method.toUpperCase() as Metode;
    if (!metode.has(m)) return galat(405, 'method_not_allowed', `Metode ${m} tidak diizinkan lewat proxy ini.`);
    if (!izin.some((p) => (typeof p === 'string' ? path.startsWith(p) : p.test(path)))) {
      return galat(403, 'forbidden', 'Endpoint ini tidak dibuka untuk browser. Tambahkan ke opsi `izinkan` di proxy server.');
    }

    const body = m === 'GET' || m === 'DELETE' ? undefined : await bacaBody(req);
    const pakaiTiruan = opsi.selaluTiruan === true || opsi.siakad === undefined || opsi.siakad === null;
    if (pakaiTiruan) return jawabTiruan(opsi.tiruan, m, path, url.searchParams, body);

    const siakad = typeof opsi.siakad === 'function' ? await opsi.siakad(req) : opsi.siakad;
    if (!siakad) return galat(401, 'unauthenticated', 'Silakan masuk dulu.');

    try {
      const multipart = typeof FormData !== 'undefined' && body instanceof FormData;
      const hasil = await siakad.request({ method: m, path, query: keQuery(url.searchParams), body, multipart }, { signal: req.signal });
      const data = hasil.data as unknown;
      if (isBerkas(data)) {
        const h = new Headers({ 'content-type': data.contentType, 'cache-control': 'no-store' });
        if (data.filename) h.set('content-disposition', `attachment; filename*=UTF-8''${encodeURIComponent(data.filename)}`);
        return new Response(data.bytes as BodyInit, { status: hasil.status, headers: h });
      }
      if (hasil.status === 204) return new Response(null, { status: 204 });
      return json(hasil.status, { data, ...(hasil.meta !== undefined ? { meta: hasil.meta } : {}) }, hasil.requestId);
    } catch (e) {
      if (e instanceof SiakadError) {
        const status = e.status && e.status >= 400 ? e.status : 502;
        return json(status, { error: { code: e.code, message: e.message, details: e.details }, request_id: e.requestId }, e.requestId);
      }
      return galat(502, 'bad_gateway', 'API SIAKAD tidak bisa dihubungi dari server.');
    }
  };
}

/** Bentuk minimal `req`/`res` Node (http, Express, NestJS/Express, Fastify `raw`). */
interface ReqNode {
  method?: string;
  url?: string;
  originalUrl?: string;
  headers: Record<string, string | string[] | undefined>;
  body?: unknown;
  on?(ev: string, fn: (...a: unknown[]) => void): unknown;
  [Symbol.asyncIterator]?(): AsyncIterator<unknown>;
}
interface ResNode {
  statusCode: number;
  setHeader(nama: string, nilai: string): unknown;
  end(isi?: unknown): unknown;
}

/**
 * {@link proxySiakad} untuk server Node bergaya `(req, res)`: Express, NestJS (`@All('api/siakad/*')` + `@Req()`/`@Res()`),
 * atau `http.createServer`. Body yang sudah dibaca `express.json()` dipakai apa adanya.
 *
 * ```ts
 * app.use('/api/siakad', proxySiakadNode({ siakad, awalan: '/api/siakad', izinkan: ['/v1/referensi/'] }));
 * ```
 */
export function proxySiakadNode(opsi: OpsiProxySiakad): (req: ReqNode, res: ResNode) => Promise<void> {
  const tangani = proxySiakad(opsi);
  return async (req, res) => {
    const host = String(req.headers['host'] ?? 'localhost');
    const url = new URL(req.originalUrl ?? req.url ?? '/', `http://${host}`);
    const method = (req.method ?? 'GET').toUpperCase();
    let body: BodyInit | undefined;
    if (method !== 'GET' && method !== 'HEAD') {
      if (req.body !== undefined && req.body !== null && !(req.body instanceof Uint8Array)) {
        body = typeof req.body === 'string' ? req.body : JSON.stringify(req.body);
      } else if (req.body instanceof Uint8Array) {
        body = req.body as BodyInit;
      } else if (req[Symbol.asyncIterator]) {
        const potongan: Uint8Array[] = [];
        for await (const p of req as AsyncIterable<Uint8Array | string>) potongan.push(typeof p === 'string' ? new TextEncoder().encode(p) : p);
        body = gabung(potongan) as BodyInit;
      }
    }
    const headers = new Headers();
    const ct = req.headers['content-type'];
    if (typeof ct === 'string') headers.set('content-type', typeof req.body === 'object' && req.body !== null && !(req.body instanceof Uint8Array) ? 'application/json' : ct);
    const jawab = await tangani(new Request(url, { method, headers, body }));
    res.statusCode = jawab.status;
    jawab.headers.forEach((v, k) => res.setHeader(k, v));
    res.end(new Uint8Array(await jawab.arrayBuffer()));
  };
}

// ------------------------------------------------------------------ util

async function jawabTiruan(tiruan: OpsiProxySiakad['tiruan'], m: string, path: string, q: URLSearchParams, body: unknown): Promise<Response> {
  const isi = tiruan?.[`${m} ${path}`];
  if (isi === undefined) {
    return galat(404, 'not_found', `Belum ada data tiruan untuk ${m} ${path}. Tambahkan di opsi \`tiruan\` atau isi SIAKAD_CLIENT_ID.`);
  }
  const hasil = typeof isi === 'function' ? await (isi as (q: URLSearchParams, b: unknown) => unknown)(q, body) : isi;
  const amplop = hasil !== null && typeof hasil === 'object' && !Array.isArray(hasil) && 'data' in hasil ? hasil : { data: hasil };
  return json(200, amplop, null, { 'x-siakad-lingkungan': 'tiruan' });
}

async function bacaBody(req: Request): Promise<unknown> {
  const ct = req.headers.get('content-type') ?? '';
  if (ct.includes('multipart/form-data')) return req.formData();
  const teks = await req.text();
  if (teks === '') return undefined;
  try {
    return JSON.parse(teks) as unknown;
  } catch {
    return teks;
  }
}

/** `a=1&b[]=x&b[]=y` → `{ a: '1', b: ['x', 'y'] }`. */
function keQuery(sp: URLSearchParams): Query {
  const q: Query = {};
  for (const [k, v] of sp) {
    if (k.endsWith('[]')) {
      const kunci = k.slice(0, -2);
      const ada = q[kunci];
      q[kunci] = Array.isArray(ada) ? [...ada, v] : [v];
    } else {
      q[k] = v;
    }
  }
  return q;
}

function isBerkas(v: unknown): v is SiakadFile {
  return typeof v === 'object' && v !== null && 'bytes' in v && (v as { bytes: unknown }).bytes instanceof Uint8Array && 'contentType' in v;
}

function json(status: number, isi: unknown, requestId: string | null, ekstra: Record<string, string> = {}): Response {
  const h: Record<string, string> = { 'content-type': 'application/json; charset=utf-8', 'cache-control': 'no-store', ...ekstra };
  if (requestId) h['x-request-id'] = requestId;
  return new Response(JSON.stringify(isi), { status, headers: h });
}

function galat(status: number, code: string, message: string): Response {
  return json(status, { error: { code, message } }, null);
}

function gabung(bagian: Uint8Array[]): Uint8Array {
  const out = new Uint8Array(bagian.reduce((n, b) => n + b.byteLength, 0));
  let i = 0;
  for (const b of bagian) {
    out.set(b, i);
    i += b.byteLength;
  }
  return out;
}
