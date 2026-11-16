/*
 * Unggah berkas terpusat (/v1/berkas) dengan pemilihan cara otomatis:
 *   - file sampai `batas_sekali_unggah_byte` (php.ini server): satu POST multipart;
 *   - lebih besar: unggah bertahap per potongan (paralel, diulang bila gagal, bisa dilanjutkan).
 * Hasilnya objek Berkas; `id`-nya dipakai sebagai `berkas_id` di endpoint unggah modul mana pun
 * (dokumen profil, lampiran pusat data, arsip, SPMI, LMS, SDM, LPPM, portal, tracer).
 */
import type { SiakadCore } from './core.js';
import type { RequestOptions, Uploadable } from './types.js';
import type { Berkas, BerkasInfo } from './generated/schemas.js';

export interface UnggahBerkasOpsi {
  /** Nama file (wajib bila sumbernya bukan File/Blob bernama). */
  nama?: string;
  kategori?: string;
  modul?: string;
  folder?: string;
  keterangan?: string;
  visibilitas?: 'privat' | 'publik';
  /** Kode penyedia storage; bawaan penyimpanan utama. */
  penyimpanan?: string;
  /** Simpan di ruang berkas bersama unit (mis. `baak`, `bauk`, `fak-ft`); lihat GET /v1/berkas/unit. */
  unit?: string;
  /** Kode periode akademik (mis. `20251`); bawaan periode yang sedang dibuka. */
  periode?: string;
  /** Enkripsi isi di server sebelum masuk storage (bisa diwajibkan kebijakan Pustikom/unit/pengguna). */
  enkripsi?: boolean;
  /** Jumlah potongan yang dikirim bersamaan (bawaan 3). */
  paralel?: number;
  /** Berapa kali satu potongan diulang bila gagal (bawaan 3). */
  ulang?: number;
  /** Lanjutkan sesi unggah bertahap yang terputus (id berkas berstatus `mengunggah`). */
  lanjutkan?: string;
  /** Paksa unggah bertahap walau file kecil. */
  bertahap?: boolean;
  onProgress?: (p: { terkirim: number; total: number; persen: number }) => void;
  signal?: AbortSignal;
}

const infoCache = new WeakMap<SiakadCore, Promise<BerkasInfo>>();

/** Batas dan penyimpanan aktif (GET /v1/berkas/info), di-cache per klien. */
export function infoBerkas(client: SiakadCore, options?: RequestOptions): Promise<BerkasInfo> {
  let p = infoCache.get(client);
  if (!p) {
    p = client.request<BerkasInfo>({ method: 'GET', path: '/v1/berkas/info' }, options).then((r) => r.data);
    p.catch(() => infoCache.delete(client));
    infoCache.set(client, p);
  }
  return p;
}

function keBlob(file: Uploadable, nama?: string): { blob: Blob; nama: string } {
  if (typeof Blob !== 'undefined' && file instanceof Blob) {
    const n = nama ?? (file as Blob & { name?: string }).name;
    if (!n) throw new TypeError('unggahBerkas: opsi `nama` wajib untuk Blob tanpa nama.');
    return { blob: file, nama: n };
  }
  if (file instanceof Uint8Array || file instanceof ArrayBuffer) {
    if (!nama) throw new TypeError('unggahBerkas: opsi `nama` wajib untuk Uint8Array/ArrayBuffer.');
    return { blob: new Blob([file as BlobPart]), nama };
  }
  const f = file as { data: Blob | Uint8Array | ArrayBuffer; filename: string; contentType?: string };
  const blob = f.data instanceof Blob ? f.data : new Blob([f.data as BlobPart], f.contentType ? { type: f.contentType } : undefined);
  return { blob, nama: nama ?? f.filename };
}

const tunggu = (ms: number) => new Promise((r) => setTimeout(r, ms));

/**
 * Unggah satu berkas ke /v1/berkas dan kembalikan datanya (status `tersedia`).
 *
 * ```ts
 * const b = await unggahBerkas(siakad, input.files[0], { kategori: 'dokumen', onProgress: (p) => setPersen(p.persen) });
 * await siakad.profil.postDokumenByIdBerkas(dokumen.id, { berkas_id: b.id });
 * ```
 */
export async function unggahBerkas(client: SiakadCore, file: Uploadable, opsi: UnggahBerkasOpsi = {}): Promise<Berkas> {
  const { blob, nama } = keBlob(file, opsi.nama);
  const atribut = Object.fromEntries(
    Object.entries({
      kategori: opsi.kategori, modul: opsi.modul, folder: opsi.folder, keterangan: opsi.keterangan, visibilitas: opsi.visibilitas, penyimpanan: opsi.penyimpanan,
      unit: opsi.unit, periode: opsi.periode, enkripsi: opsi.enkripsi === undefined ? undefined : opsi.enkripsi ? '1' : '0',
    }).filter(([, v]) => v !== undefined),
  );
  const req: RequestOptions = { signal: opsi.signal };
  const total = blob.size;
  const lapor = (terkirim: number) => opsi.onProgress?.({ terkirim, total, persen: total > 0 ? Math.min(100, Math.round((terkirim / total) * 100)) : 100 });
  const info = await infoBerkas(client, req);

  if (!opsi.lanjutkan && !opsi.bertahap && total <= info.batas_sekali_unggah_byte!) {
    lapor(0);
    const r = await client.request<Berkas>({ method: 'POST', path: '/v1/berkas', body: { berkas: { data: blob, filename: nama }, ...atribut }, multipart: true }, { ...req, timeout: 300_000 });
    lapor(total);
    return r.data;
  }

  // Unggah bertahap.
  let sesi: Berkas;
  if (opsi.lanjutkan) {
    sesi = (await client.request<Berkas>({ method: 'GET', path: `/v1/berkas/${encodeURIComponent(opsi.lanjutkan)}` }, req)).data;
    if (sesi.status !== 'mengunggah') return sesi;
  } else {
    sesi = (await client.request<Berkas>({ method: 'POST', path: '/v1/berkas/bertahap', body: { nama, ukuran: total, ...atribut } }, req)).data;
  }
  const ukuran = sesi.sesi!.ukuran_potongan!;
  const jumlah = sesi.sesi!.jumlah_potongan!;
  const sudah = new Set<number>(sesi.sesi!.diterima ?? []);
  let terkirim = [...sudah].reduce((n, ke) => n + Math.min(ukuran, total - ke * ukuran), 0);
  lapor(terkirim);

  const antre = Array.from({ length: jumlah }, (_, i) => i).filter((i) => !sudah.has(i));
  const ulang = opsi.ulang ?? 3;
  const kirim = async (ke: number): Promise<void> => {
    const bagian = blob.slice(ke * ukuran, Math.min(total, (ke + 1) * ukuran));
    for (let coba = 0; ; coba++) {
      try {
        await client.request({ method: 'POST', path: `/v1/berkas/${sesi.id}/potongan/${ke}`, body: { potongan: { data: bagian, filename: `${ke}.part` } }, multipart: true }, { ...req, timeout: 300_000 });
        terkirim += bagian.size;
        lapor(terkirim);
        return;
      } catch (e) {
        if (coba >= ulang || opsi.signal?.aborted) throw e;
        await tunggu(500 * 2 ** coba);
      }
    }
  };
  const pekerja = Array.from({ length: Math.max(1, Math.min(opsi.paralel ?? 3, antre.length)) }, async () => {
    for (let ke = antre.shift(); ke !== undefined; ke = antre.shift()) await kirim(ke);
  });
  await Promise.all(pekerja);

  const selesai = await client.request<Berkas>({ method: 'POST', path: `/v1/berkas/${sesi.id}/selesai` }, { ...req, timeout: 300_000 });
  return selesai.data;
}

/** Tautan unduh sementara (untuk <img>, <a>, pratinjau PDF) tanpa header Authorization. */
export async function urlBerkas(client: SiakadCore, id: string, opsi: { ttl?: number; unduh?: boolean } & RequestOptions = {}): Promise<string> {
  const { ttl, unduh, ...req } = opsi;
  const r = await client.request<{ url: string }>({ method: 'GET', path: `/v1/berkas/${encodeURIComponent(id)}/url`, query: { ttl, unduh: unduh ? 1 : undefined } }, req);
  return r.data.url;
}
