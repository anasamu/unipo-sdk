/**
 * Galat dari API SIAKAD. Semua galat turunan dari {@link SiakadError}, jadi cukup satu `catch`:
 *
 * ```ts
 * try { ... } catch (e) {
 *   if (e instanceof ValidationError) console.log(e.details);
 *   else if (e instanceof SiakadError) console.log(e.status, e.code, e.requestId);
 * }
 * ```
 */
export class SiakadError extends Error {
  /** Kode HTTP (0 bila tidak sampai ke server). */
  readonly status: number;
  /** Kode galat dari API, mis. `insufficient_scope`, `validation_failed`. */
  readonly code: string;
  /** Rincian galat dari API (mis. field yang tidak valid, scope yang dibutuhkan). */
  readonly details: Record<string, unknown>;
  /** ID permintaan (header `X-Request-Id`); sertakan saat melapor ke Pustikom. */
  readonly requestId: string | null;
  /** Header jawaban, bila ada. */
  readonly headers: Record<string, string>;

  constructor(
    message: string,
    init: {
      status?: number;
      code?: string;
      details?: Record<string, unknown>;
      requestId?: string | null;
      headers?: Record<string, string>;
      cause?: unknown;
    } = {},
  ) {
    super(message, init.cause !== undefined ? { cause: init.cause } : undefined);
    this.name = new.target.name;
    this.status = init.status ?? 0;
    this.code = init.code ?? 'error';
    this.details = init.details ?? {};
    this.requestId = init.requestId ?? null;
    this.headers = init.headers ?? {};
  }
}

/** Tidak bisa menghubungi server (DNS, koneksi putus, batas waktu habis). */
export class ConnectionError extends SiakadError {}

/** Batas waktu permintaan habis. */
export class TimeoutError extends ConnectionError {}

/** 400: permintaan salah (mis. `invalid_grant`, `invalid_scope`, `bad_request`). */
export class BadRequestError extends SiakadError {}

/** 401: kredensial klien salah, atau token kedaluwarsa/dicabut. */
export class AuthenticationError extends SiakadError {}

/** 403: tidak berhak (`insufficient_scope`, `forbidden`, `ip_not_allowed`, `level_not_allowed`, ...). */
export class PermissionError extends SiakadError {
  /** Scope yang dibutuhkan endpoint, bila galatnya `insufficient_scope`. */
  get requiredScopes(): string[] {
    const s = this.details['required_scopes'];
    return Array.isArray(s) ? s.map(String) : [];
  }
}

/** 404: data atau alamat tidak ada. */
export class NotFoundError extends SiakadError {}

/** 405: metode HTTP tidak didukung (coba opsi `methodOverride: true` bila hosting menolak PUT/PATCH/DELETE). */
export class MethodNotAllowedError extends SiakadError {}

/** 409: tidak bisa diproses pada kondisi sekarang (mis. masa KRS tutup). */
export class ConflictError extends SiakadError {}

/** Satu aturan dinamis yang tidak terpenuhi (dari `/v1/aturan`). */
export interface PelanggaranAturan {
  /** UUID aturan. */
  id: string;
  nama: string;
  /** Pesan siap tampil, mis. "SKS lulus minimal 100 (sekarang 92)." */
  pesan: string;
  [k: string]: unknown;
}

/**
 * 409 `aturan_dilanggar`: langkah ditolak aturan dinamis SIAKAD (mis. batas SKS, syarat KKN, batas input nilai,
 * syarat bayar). `message` sudah berisi semua pesan pelanggaran; `pelanggaran` merinci per aturan.
 *
 * ```ts
 * try { await siakad.mahasiswa.postKrs(...) } catch (e) {
 *   if (e instanceof AturanDilanggarError) tampilkan(e.pelanggaran.map((p) => p.pesan));
 * }
 * ```
 */
export class AturanDilanggarError extends ConflictError {
  /** Hasil pemeriksaan aturan: `titik`, `boleh`, `pelanggaran`, `peringatan`, `batas`. */
  get aturan(): Record<string, unknown> {
    const a = this.details['aturan'];
    return a && typeof a === 'object' ? (a as Record<string, unknown>) : {};
  }

  /** Titik penerapan, mis. `krs.ambil`, `kkn.daftar`. */
  get titik(): string | null {
    return typeof this.aturan['titik'] === 'string' ? (this.aturan['titik'] as string) : null;
  }

  get pelanggaran(): PelanggaranAturan[] {
    const p = this.aturan['pelanggaran'];
    return Array.isArray(p) ? (p as PelanggaranAturan[]) : [];
  }

  /** Batas yang berlaku, mis. `{ sks_diambil: { op: '<=', nilai: 21 } }`. */
  get batas(): Record<string, unknown> {
    const b = this.aturan['batas'];
    return b && typeof b === 'object' ? (b as Record<string, unknown>) : {};
  }
}

/** 413/415: body terlalu besar atau jenisnya tidak didukung. */
export class PayloadError extends SiakadError {}

/** 422: validasi gagal. `fields` berisi pesan per field, mis. `{ nim: 'NIM wajib diisi.' }`. */
export class ValidationError extends SiakadError {
  get fields(): Record<string, unknown> {
    return this.details;
  }
}

/** 429: terlalu banyak permintaan. */
export class RateLimitError extends SiakadError {
  /** Detik yang perlu ditunggu sebelum mencoba lagi. */
  get retryAfter(): number | null {
    const h = this.headers['retry-after'] ?? String(this.details['retry_after'] ?? '');
    const n = Number.parseInt(h, 10);
    return Number.isFinite(n) ? n : null;
  }
}

/** 5xx: galat di server, termasuk 503 `api_disabled`. */
export class ServerError extends SiakadError {}

/**
 * 503 `pemeliharaan`: aplikasi sedang dalam mode pemeliharaan yang dinyalakan admin di Pustikom (dijawab BFF aplikasi
 * dari status SSO). Tidak dicoba ulang otomatis. Tampilkan halaman pemeliharaan (`GerbangPemeliharaan` unipo-ui).
 */
export class PemeliharaanError extends ServerError {
  private get info(): Record<string, unknown> {
    const p = this.details['pemeliharaan'];
    return p && typeof p === 'object' ? (p as Record<string, unknown>) : {};
  }

  /** Perkiraan selesai (ISO 8601) atau null. */
  get sampai(): string | null {
    return typeof this.info['sampai'] === 'string' ? (this.info['sampai'] as string) : null;
  }

  /** Mulai pemeliharaan (ISO 8601) atau null. */
  get sejak(): string | null {
    return typeof this.info['sejak'] === 'string' ? (this.info['sejak'] as string) : null;
  }
}

/** Membuat kelas galat yang sesuai dari kode HTTP. */
export function errorFromStatus(
  status: number,
  message: string,
  init: ConstructorParameters<typeof SiakadError>[1] = {},
): SiakadError {
  const args = { ...init, status } as const;
  if (status === 400) return new BadRequestError(message, args);
  if (status === 401) return new AuthenticationError(message, args);
  if (status === 403) return new PermissionError(message, args);
  if (status === 404) return new NotFoundError(message, args);
  if (status === 405) return new MethodNotAllowedError(message, args);
  if (status === 409) return args.code === 'aturan_dilanggar' ? new AturanDilanggarError(message, args) : new ConflictError(message, args);
  if (status === 413 || status === 415) return new PayloadError(message, args);
  if (status === 422) return new ValidationError(message, args);
  if (status === 429) return new RateLimitError(message, args);
  if (status === 503 && args.code === 'pemeliharaan') return new PemeliharaanError(message, args);
  if (status >= 500) return new ServerError(message, args);
  return new SiakadError(message, args);
}
