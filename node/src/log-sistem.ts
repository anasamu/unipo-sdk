/*
 * Log terpadu semua proses SIAKAD (/v1/sistem/log, docs/LOG-SISTEM.md di repo SIAKAD) dengan tipe lengkap.
 * Hak: izin RBAC `pustikom.log` atau administrator sistem; token pengguna (scope rbac:read).
 *
 *   const log = logSistem(siakad);
 *   const { data, berikut } = await log.daftar({ tingkat: ['galat'], per_page: 50 });
 *   for await (const baris of log.semua({ sumber: ['pddikti'] })) { ... }
 */
import type { SiakadCore } from './core.js';
import type { RequestOptions, SiakadFile } from './types.js';

export type TingkatLog = 'info' | 'peringatan' | 'galat';

/** Satu baris log dengan kolom seragam dari sumber mana pun. */
export interface BarisLog {
  /** `<sumber>:<kunci>`; null untuk sumber tanpa kunci (login SIAKAD lama), yang tidak punya detail tambahan. */
  id: string | null;
  /** Waktu kejadian `Y-m-d H:i:s` (zona waktu server). */
  waktu: string;
  sumber: string;
  sumber_nama: string;
  kelompok: string;
  aksi: string;
  pelaku: string | null;
  sasaran: string | null;
  ringkasan: string | null;
  tingkat: TingkatLog;
  /** IP disamarkan sebagian (mis. 10.20.x.x). */
  ip: string | null;
}

/** Baris log dengan kolom tambahan sumbernya (sudah dibersihkan dari nilai rahasia). */
export interface DetailLog extends BarisLog {
  detail: Record<string, unknown>;
  /** Hanya untuk administrator sistem. */
  ip_lengkap?: string;
}

export interface SumberLog {
  kode: string;
  nama: string;
  kelompok: string;
  keterangan: string;
  tabel: string;
  /** Tabel ada di server ini. */
  tersedia: boolean;
  tingkat: TingkatLog[];
}

export interface RingkasanLog {
  sejak: string;
  jam: number;
  total: Record<TingkatLog, number>;
  per_sumber: Array<{ sumber: string; nama: string; kelompok: string } & Record<TingkatLog, number>>;
  galat_terbaru: BarisLog[];
}

export interface SaringanLog {
  sumber?: string[];
  tingkat?: TingkatLog[];
  /** Username/klien pelaku (persis). */
  pelaku?: string;
  /** Cari teks (maks 100 karakter). */
  q?: string;
  /** `Y-m-d` atau `Y-m-d H:i[:s]`. */
  dari?: string;
  /** `Y-m-d` (sampai akhir hari) atau `Y-m-d H:i[:s]`. */
  sampai?: string;
}

export interface HalamanLog {
  data: BarisLog[];
  /** Kursor halaman berikutnya; null bila habis. */
  berikut: string | null;
  /** Sumber yang gagal dibaca (dilewati) pada halaman ini. */
  sumberGalat: string[];
}

function query(s: SaringanLog & { kursor?: string | null; per_page?: number }): Record<string, string | number> {
  const q: Record<string, string | number> = {};
  if (s.sumber?.length) q.sumber = s.sumber.join(',');
  if (s.tingkat?.length) q.tingkat = s.tingkat.join(',');
  for (const k of ['pelaku', 'q', 'dari', 'sampai', 'kursor'] as const) {
    const v = s[k];
    if (typeof v === 'string' && v !== '') q[k] = v;
  }
  if (s.per_page) q.per_page = s.per_page;
  return q;
}

export interface LogSistem {
  daftar(s?: SaringanLog & { kursor?: string | null; per_page?: number }, opsi?: RequestOptions): Promise<HalamanLog>;
  /** Semua baris yang cocok, halaman demi halaman (berhenti setelah `maks`, bawaan 5.000). */
  semua(s?: SaringanLog, maks?: number, opsi?: RequestOptions): AsyncGenerator<BarisLog>;
  detail(id: string, opsi?: RequestOptions): Promise<DetailLog>;
  sumber(opsi?: RequestOptions): Promise<SumberLog[]>;
  ringkasan(jam?: number, opsi?: RequestOptions): Promise<RingkasanLog>;
  /** CSV (titik koma, UTF-8 BOM), maks 10.000 baris; `filename` dari server (log-sistem-YYYYMMDD-HHMMSS.csv). */
  eksporCsv(s?: SaringanLog, opsi?: RequestOptions): Promise<SiakadFile>;
}

export function logSistem(siakad: SiakadCore): LogSistem {
  const P = '/v1/sistem/log';
  const api: LogSistem = {
    async daftar(s = {}, opsi) {
      const r = await siakad.request<BarisLog[]>({ method: 'GET', path: P, query: query(s) }, opsi);
      const meta = (r.meta ?? {}) as { berikut?: string | null; sumber_galat?: string[] };
      return { data: r.data, berikut: meta.berikut ?? null, sumberGalat: meta.sumber_galat ?? [] };
    },
    async *semua(s = {}, maks = 5000, opsi) {
      let kursor: string | null = null;
      let n = 0;
      do {
        const h: HalamanLog = await api.daftar({ ...s, kursor, per_page: 200 }, opsi);
        for (const b of h.data) {
          yield b;
          if (++n >= maks) return;
        }
        kursor = h.berikut;
      } while (kursor);
    },
    async detail(id, opsi) {
      const [sumber, kunci] = id.split(':');
      return (await siakad.request<DetailLog>({ method: 'GET', path: `${P}/${encodeURIComponent(sumber ?? '')}/${encodeURIComponent(kunci ?? '')}` }, opsi)).data;
    },
    async sumber(opsi) {
      return (await siakad.request<SumberLog[]>({ method: 'GET', path: `${P}/sumber` }, opsi)).data;
    },
    async ringkasan(jam = 24, opsi) {
      return (await siakad.request<RingkasanLog>({ method: 'GET', path: `${P}/ringkasan`, query: { jam } }, opsi)).data;
    },
    async eksporCsv(s = {}, opsi) {
      return (await siakad.request<SiakadFile>({ method: 'GET', path: `${P}/ekspor`, query: query(s) }, opsi)).data;
    },
  };
  return api;
}
