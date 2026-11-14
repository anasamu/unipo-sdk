import type { SiakadCore } from './core.js';
import type { ApiResult, RequestOptions, TokenSet } from './types.js';

/** Informasi token dari `/v1/auth/me`. */
export interface TokenInfo {
  client_id?: string;
  client_name?: string;
  /** `client` (token aplikasi) atau `user` (token pengguna). */
  token_type?: string;
  scopes?: string[];
  /** ISO 8601. */
  expires_at?: string;
  username?: string;
  level?: string;
  nama?: string;
  email?: string;
  prodi?: string[];
  /** `live` atau `development`. */
  lingkungan?: string;
  /** Kode peran RBAC pengguna. */
  peran?: string[];
  [key: string]: unknown;
}

/** Autentikasi OAuth 2.0 API SIAKAD (`/v1/auth/*`). */
export class AuthResource {
  constructor(private readonly client: SiakadCore) {}

  /**
   * Token aplikasi (server ke server). Biasanya tidak perlu dipanggil: SDK meminta dan menyimpan token ini otomatis.
   */
  clientCredentials(scope?: string | string[]): Promise<TokenSet> {
    const params: Record<string, string> = { grant_type: 'client_credentials' };
    if (scope && scope.length) params.scope = Array.isArray(scope) ? scope.join(' ') : scope;
    return this.client.requestToken(params);
  }

  /**
   * Login pengguna dengan username (NIM/NIDN/username) dan password SIAKAD. Klien harus diizinkan login pengguna.
   * Pakai hasilnya dengan `siakad.withToken(token)`.
   *
   * @param options.userIp IP pengguna akhir (hanya untuk klien "percayai IP pengguna").
   */
  password(
    username: string,
    password: string,
    options: { scope?: string | string[]; userIp?: string } = {},
  ): Promise<TokenSet> {
    const params: Record<string, string> = { grant_type: 'password', username, password };
    if (options.scope && options.scope.length) {
      params.scope = Array.isArray(options.scope) ? options.scope.join(' ') : options.scope;
    }
    return this.client.requestToken(params, { userIp: options.userIp });
  }

  /** Tukar refresh token (sekali pakai) dengan pasangan token baru. */
  refresh(refreshToken: string): Promise<TokenSet> {
    return this.client.requestToken({ grant_type: 'refresh_token', refresh_token: refreshToken });
  }

  /**
   * Tukar `id_token` dari SSO UNIPO (sso.unipo.ac.id) menjadi token pengguna SIAKAD (RFC 8693).
   * Klien API harus ditandai dengan client ID aplikasi di SSO.
   */
  exchangeSsoToken(idToken: string): Promise<TokenSet> {
    return this.client.requestToken({
      grant_type: 'urn:ietf:params:oauth:grant-type:token-exchange',
      subject_token_type: 'urn:ietf:params:oauth:token-type:id_token',
      subject_token: idToken,
    });
  }

  /** Informasi token yang sedang dipakai: klien, scope, dan pengguna (bila token pengguna). */
  async me(options?: RequestOptions): Promise<TokenInfo> {
    const r = await this.client.request<TokenInfo>({ method: 'GET', path: '/v1/auth/me' }, options);
    return r.data;
  }

  /** Cabut token yang sedang dipakai (logout). Sertakan refresh token agar ikut dicabut. */
  async revoke(refreshToken?: string, options?: RequestOptions): Promise<ApiResult<{ revoked: boolean }>> {
    return this.client.request(
      { method: 'POST', path: '/v1/auth/revoke', body: refreshToken ? { refresh_token: refreshToken } : {} },
      options,
    );
  }

  /**
   * Lupa password: minta token reset (khusus klien perantara login tepercaya, mis. SSO).
   * Jawaban berisi `email` + `token` bila akun punya email, atau `sent=false`.
   */
  async forgotPassword(
    username: string,
    userIp: string,
    options?: RequestOptions,
  ): Promise<{ sent: boolean; email?: string; token?: string; [key: string]: unknown }> {
    const r = await this.client.request<{ sent: boolean; email?: string; token?: string }>(
      { method: 'POST', path: '/v1/auth/password/forgot', body: this.withClient({ username }), public: true },
      { ...options, headers: { 'X-Siakad-User-Ip': userIp, ...(options?.headers ?? {}) } },
    );
    return r.data;
  }

  /** Simpan password baru dengan token reset (minimal 8 karakter, tidak sama dengan username). */
  async resetPassword(
    username: string,
    token: string,
    password: string,
    userIp: string,
    options?: RequestOptions,
  ): Promise<Record<string, unknown>> {
    const r = await this.client.request<Record<string, unknown>>(
      { method: 'POST', path: '/v1/auth/password/reset', body: this.withClient({ username, token, password }), public: true },
      { ...options, headers: { 'X-Siakad-User-Ip': userIp, ...(options?.headers ?? {}) } },
    );
    return r.data;
  }

  private withClient(body: Record<string, string>): Record<string, string> {
    const o = (this.client as unknown as { options: { clientId?: string; clientSecret?: string } }).options;
    return { client_id: o.clientId ?? '', client_secret: o.clientSecret ?? '', ...body };
  }
}
