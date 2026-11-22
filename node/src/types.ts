import type { TokenStore } from './token-store.js';

/** Metadata halaman pada endpoint daftar. */
export interface Meta {
  page?: number | null;
  per_page?: number | null;
  total?: number | null;
  total_pages?: number | null;
  [key: string]: unknown;
}

/** Hasil setiap pemanggilan endpoint: isi `data`, `meta` (daftar), dan informasi jawaban. */
export interface ApiResult<T> {
  /** Isi `data` dari jawaban API. */
  data: T;
  /** `page`, `per_page`, `total`, `total_pages` untuk endpoint daftar. */
  meta?: Meta;
  /** Kode HTTP. */
  status: number;
  /** ID permintaan (header `X-Request-Id`). */
  requestId: string | null;
  /** Lingkungan database yang melayani: `live` atau `development` (header `X-Siakad-Lingkungan`). */
  environment: string | null;
  /** Semua header jawaban (nama huruf kecil). */
  headers: Record<string, string>;
}

/** Berkas yang diunduh dari endpoint yang mengirim file (bukan JSON). */
export interface SiakadFile {
  /** Nama file dari header `Content-Disposition`, bila ada. */
  filename: string | null;
  contentType: string;
  size: number;
  bytes: Uint8Array;
  /** Isi sebagai teks UTF-8. */
  text(): string;
  /** Isi sebagai Blob (mis. untuk diunduh di browser). */
  blob(): Blob;
}

/** Nilai yang bisa diunggah ke field berkas (multipart). */
export type Uploadable =
  | Blob
  | Uint8Array
  | ArrayBuffer
  | { data: Blob | Uint8Array | ArrayBuffer; filename: string; contentType?: string };

/** Nilai query string. Array dikirim sebagai `nama[]=a&nama[]=b`. */
export type QueryValue = string | number | boolean | null | undefined | Array<string | number | boolean>;
export type Query = Record<string, QueryValue>;

/** Pasangan token dari `/v1/auth/token`. */
export interface TokenSet {
  access_token: string;
  token_type: string;
  expires_in: number;
  scope?: string;
  refresh_token?: string;
  refresh_expires_in?: number;
  /** Waktu kedaluwarsa token akses (milidetik epoch), dihitung SDK saat token diterima. */
  expires_at?: number;
  [key: string]: unknown;
}

export interface SiakadOptions {
  /**
   * Alamat dasar API tanpa `/v1`. Bawaan `https://api.unipo.ac.id`.
   * Alamat lama `https://siakad.unipo.ac.id/api` juga bisa dipakai.
   */
  baseUrl?: string;
  /** `client_id` aplikasi (dari portal api.unipo.ac.id atau admin SIAKAD). */
  clientId?: string;
  /** `client_secret` aplikasi. Simpan di server, jangan di kode browser/mobile. */
  clientSecret?: string;
  /** Scope yang diminta untuk token aplikasi (bawaan: semua scope klien). */
  scope?: string | string[];
  /**
   * Token akses yang sudah ada (mis. token pengguna dari grant password/SSO). Bila diisi, SDK memakai token ini
   * dan tidak meminta token `client_credentials`.
   */
  accessToken?: string;
  /**
   * Ambil token akses untuk setiap permintaan, mis. dari sesi login aplikasi (`() => session.accessToken`).
   * Kembalikan `null` untuk mengirim tanpa header Authorization, mis. bila `baseUrl` adalah proxy server milik
   * aplikasi yang menempelkan token sendiri (`proxySiakad`). Dipakai bila `accessToken` kosong; menggantikan
   * token client_credentials.
   */
  getAccessToken?: () => string | null | undefined | Promise<string | null | undefined>;
  /** Refresh token pasangan `accessToken`; dipakai otomatis saat token akses habis (butuh clientId + clientSecret). */
  refreshToken?: string;
  /** Kedaluwarsa `accessToken` (milidetik epoch), bila diketahui. */
  accessTokenExpiresAt?: number;
  /** Dipanggil setiap kali SDK memperbarui token pengguna lewat refresh token. Simpan token baru di sini. */
  onTokenRefresh?: (token: TokenSet) => void | Promise<void>;
  /**
   * Tempat menyimpan token aplikasi (client_credentials) supaya tidak meminta token baru di setiap proses.
   * Bawaan: memori proses. Contoh Redis ada di README.
   */
  tokenStore?: TokenStore;
  /** Pakai database `development` walau klien punya akses live (header `X-Siakad-Lingkungan`). */
  environment?: 'live' | 'development';
  /** IP pengguna akhir, untuk klien perantara login yang ditandai "percayai IP pengguna" (mis. SSO). */
  userIp?: string;
  /** Batas waktu tiap permintaan dalam milidetik. Bawaan 30000. */
  timeout?: number;
  /** Jumlah percobaan ulang untuk 429, 502/503/504, dan galat koneksi (GET saja untuk yang terakhir). Bawaan 2. */
  maxRetries?: number;
  /**
   * Kirim PUT/PATCH/DELETE sebagai POST + header `X-HTTP-Method-Override`.
   * Nyalakan bila hosting menolak metode selain GET/POST (403/405 dari server web).
   */
  methodOverride?: boolean;
  /** Header tambahan untuk setiap permintaan. */
  headers?: Record<string, string>;
  /** Implementasi fetch lain (mis. undici dengan proxy). Bawaan `globalThis.fetch`. */
  fetch?: typeof fetch;
}

/** Opsi per pemanggilan. */
export interface RequestOptions {
  /** Query string tambahan. */
  query?: Query;
  /** Header tambahan. */
  headers?: Record<string, string>;
  /** Batalkan permintaan. */
  signal?: AbortSignal;
  /** Batas waktu khusus permintaan ini (milidetik). */
  timeout?: number;
  /** Percobaan ulang khusus permintaan ini. */
  maxRetries?: number;
}

/** Definisi satu permintaan untuk {@link SiakadCore.request}. */
export interface RequestSpec {
  method: 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE';
  path: string;
  query?: Query;
  body?: unknown;
  /** Kirim body sebagai multipart/form-data. */
  multipart?: boolean;
  /** Endpoint publik: token dikirim hanya bila sudah ada, tidak diminta. */
  public?: boolean;
}
