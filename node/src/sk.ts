/*
 * Registri SK tunggal (/v1/sk, docs/SK.md di repo SIAKAD) dengan tipe lengkap.
 *
 * Satu SK dicatat sekali oleh unit penerbitnya (mis. Rektorat untuk SK Rektor). Aplikasi lain hanya MERUJUK SK itu:
 * simpan `sk_id` dan kirim `sk_id` ke endpoint modul (kalender, aturan, pejabat, penugasan, panitia, ...), jangan mengetik
 * ulang nomor/penetap atau mengunggah ulang berkasnya. Hak: izin RBAC `sk.lihat` (cari/rujuk) dan `sk.catat` (catat atas
 * nama unit penerbit); scope token berkas:read/berkas:write.
 *
 *   const sk = registriSK(siakad);
 *   const cek = await sk.periksa('Nomor: 91.01 / unipo-sk / VII / 2026');  // cek.sama[0] = SK yang sudah tercatat
 *   const { data } = await sk.cari({ q: 'kalender' });
 *   const baru = await sk.catat({ nomor, tanggal, perihal, penerbit_unit_id: 1, penandatangan_pejabat_id: 52, berkas_id });
 *   const url = await sk.urlBerkas(baru.id);                                // URL sementara, tanpa salinan
 */
import type { SiakadCore } from './core.js';
import { ConflictError } from './errors.js';
import type { RequestOptions } from './types.js';
import type { SkCatat, SkDetail, SkPenandatangan, SkPenerbit, SkPeriksa, SkRegistri } from './generated/schemas.js';

export type { SkCatat, SkDetail, SkPenandatangan, SkPenerbit, SkPeriksa, SkRegistri };

export type StatusSK = 'draf' | 'terbit' | 'ditolak' | 'dicabut' | 'diubah';

export interface SaringanSK {
  /** Nomor (dinormalisasi di server) atau perihal. */
  q?: string;
  jenis?: string | string[];
  status?: StatusSK | StatusSK[];
  /** induk_unit.id penerbit. */
  penerbit?: number;
  per_page?: number;
  /** false = jangan tawarkan surat keluar arsip berjenis SK yang belum tercatat (id "surat:<uuid>"). */
  arsip?: boolean;
}

export interface HasilCariSK {
  data: SkRegistri[];
  /** Unit tempat pengguna boleh mencatat SK (null = semua unit). */
  unitCatat: number[] | null;
  jenis: Record<string, string>;
}

export interface RegistriSK {
  cari(s?: SaringanSK, opsi?: RequestOptions): Promise<HasilCariSK>;
  /** SK yang sama dengan nomor ini (setelah normalisasi spasi, huruf besar, tanda baca, nol depan). */
  periksa(nomor: string, penerbitUnitId?: number | null, opsi?: RequestOptions): Promise<SkPeriksa>;
  detail(id: string, opsi?: RequestOptions): Promise<SkDetail>;
  /**
   * Catat (penerbit: terbit) atau ajukan pencatatan (unit lain: draf). Nomor yang sudah tercatat di penerbit sama
   * melempar ConflictError dengan `details.kode = 'sk_sudah_tercatat'` dan `details.sk`; pakai {@link catatAtauPakai}.
   */
  catat(isi: SkCatat, opsi?: RequestOptions): Promise<SkDetail>;
  /** Seperti catat, tetapi bila SK sudah tercatat mengembalikan SK itu (tanpa mencatat ulang). */
  catatAtauPakai(isi: SkCatat, opsi?: RequestOptions): Promise<{ sk: SkRegistri; baru: boolean }>;
  ubah(id: string, isi: Partial<SkCatat>, opsi?: RequestOptions): Promise<SkDetail>;
  verifikasi(id: string, keputusan: 'terima' | 'tolak', catatan?: string | null, opsi?: RequestOptions): Promise<SkDetail>;
  cabut(id: string, olehSkId?: string | null, catatan?: string | null, opsi?: RequestOptions): Promise<SkDetail>;
  /** Gabungkan catatan ganda `id` ke SK tujuan `ke` (nomor kunci harus sama). */
  gabung(id: string, ke: string, opsi?: RequestOptions): Promise<SkDetail>;
  penerbit(opsi?: RequestOptions): Promise<SkPenerbit[]>;
  penandatangan(unitId?: number | null, opsi?: RequestOptions): Promise<SkPenandatangan[]>;
  /** URL sementara berkas SK (hak baca registri, tanpa salinan). */
  urlBerkas(id: string, o?: { ttl?: number; unduh?: boolean } & RequestOptions): Promise<string>;
  /** Catat SK dari surat keluar arsip ("surat:<uuid>" dari hasil cari). */
  dariSurat(suratId: string, opsi?: RequestOptions): Promise<SkDetail>;
}

const daftar = (v?: string | string[]) => (Array.isArray(v) ? v.join(',') : v);

/** Klien bertipe registri SK tunggal. */
export function registriSK(siakad: SiakadCore): RegistriSK {
  const P = '/v1/sk';
  const enc = encodeURIComponent;
  const api: RegistriSK = {
    async cari(s = {}, opsi) {
      const r = await siakad.request<SkRegistri[]>(
        { method: 'GET', path: P, query: { q: s.q || undefined, jenis: daftar(s.jenis), status: daftar(s.status), penerbit: s.penerbit, per_page: s.per_page, arsip: s.arsip === false ? '0' : undefined } },
        opsi,
      );
      const meta = (r.meta ?? {}) as { unit_catat?: number[] | null; jenis?: Record<string, string> };
      return { data: r.data, unitCatat: meta.unit_catat ?? [], jenis: meta.jenis ?? {} };
    },
    async periksa(nomor, penerbitUnitId, opsi) {
      return (await siakad.request<SkPeriksa>({ method: 'GET', path: `${P}/periksa`, query: { nomor, penerbit_unit_id: penerbitUnitId ?? undefined } }, opsi)).data;
    },
    async detail(id, opsi) {
      return (await siakad.request<SkDetail>({ method: 'GET', path: `${P}/${enc(id)}` }, opsi)).data;
    },
    async catat(isi, opsi) {
      return (await siakad.request<SkDetail>({ method: 'POST', path: P, body: isi }, opsi)).data;
    },
    async catatAtauPakai(isi, opsi) {
      try {
        return { sk: await api.catat(isi, opsi), baru: true };
      } catch (e) {
        const d = (e as ConflictError)?.details as { kode?: string; sk?: SkRegistri } | undefined;
        if (e instanceof ConflictError && d?.kode === 'sk_sudah_tercatat' && d.sk) return { sk: d.sk, baru: false };
        throw e;
      }
    },
    async ubah(id, isi, opsi) {
      return (await siakad.request<SkDetail>({ method: 'POST', path: `${P}/${enc(id)}`, body: isi }, opsi)).data;
    },
    async verifikasi(id, keputusan, catatan, opsi) {
      return (await siakad.request<SkDetail>({ method: 'POST', path: `${P}/${enc(id)}/verifikasi`, body: { keputusan, catatan: catatan ?? undefined } }, opsi)).data;
    },
    async cabut(id, olehSkId, catatan, opsi) {
      return (await siakad.request<SkDetail>({ method: 'POST', path: `${P}/${enc(id)}/cabut`, body: { oleh_sk_id: olehSkId ?? undefined, catatan: catatan ?? undefined } }, opsi)).data;
    },
    async gabung(id, ke, opsi) {
      return (await siakad.request<SkDetail>({ method: 'POST', path: `${P}/${enc(id)}/gabung`, body: { ke } }, opsi)).data;
    },
    async penerbit(opsi) {
      return (await siakad.request<SkPenerbit[]>({ method: 'GET', path: `${P}/penerbit` }, opsi)).data;
    },
    async penandatangan(unitId, opsi) {
      return (await siakad.request<SkPenandatangan[]>({ method: 'GET', path: `${P}/penandatangan`, query: { unit_id: unitId ?? undefined } }, opsi)).data;
    },
    async urlBerkas(id, o = {}) {
      const { ttl, unduh, ...req } = o;
      return (await siakad.request<{ url: string }>({ method: 'GET', path: `${P}/${enc(id)}/berkas-url`, query: { ttl, unduh: unduh ? '1' : undefined } }, req)).data.url;
    },
    async dariSurat(suratId, opsi) {
      return (await siakad.request<SkDetail>({ method: 'POST', path: `${P}/dari-surat/${enc(suratId.replace(/^surat:/, ''))}` }, opsi)).data;
    },
  };
  return api;
}
