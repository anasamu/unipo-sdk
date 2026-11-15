/*
 * Bantuan infrastruktur layanan (/v1/infra, docs/INFRASTRUKTUR.md di repo SIAKAD):
 *   - verifikasiGerbang(): layanan di belakang gerbang api.unipo.ac.id memeriksa header identitas bertanda tangan;
 *   - konsumsiAntrean():   ambil event dari antrean tarik, jalankan handler, lalu ack/tolak otomatis;
 *   - muatRahasia():       baca rahasia ruang aplikasi dari secret manager ke process.env;
 *   - terbitkanEvent():    layanan menerbitkan event domainnya sendiri ke bus SIAKAD.
 */
import type { SiakadCore } from './core.js';
import type { RequestOptions } from './types.js';

// ------------------------------------------------------------------ gerbang

/** Identitas pemanggil yang diteruskan gerbang (sudah diverifikasi). */
export interface IdentitasGerbang {
  /** client_id klien API pemanggil; kosong untuk rute publik. */
  klien: string;
  /** Username pengguna (token pengguna/SSO); kosong untuk token aplikasi. */
  pengguna: string;
  /** Level pengguna (ADMIN, DOSEN, MAHASISWA, ...). */
  level: string;
  scope: string[];
  requestId: string;
  /** Waktu tanda tangan (detik Unix). */
  waktu: number;
}

type SumberHeader = Headers | Record<string, string | string[] | undefined> | { get(nama: string): string | null | undefined };

export interface PermintaanGerbang {
  /** Metode HTTP, mis. `req.method`. */
  metode: string;
  /** Path + query persis seperti diterima layanan, mis. `req.originalUrl` (Express) atau `url.pathname + url.search`. */
  path: string;
  /** Header permintaan: objek `Headers` (fetch/Next.js) atau `req.headers` (Node/Express). */
  header: SumberHeader;
}

export interface OpsiVerifikasiGerbang {
  /** Selisih waktu maksimum antara tanda tangan dan sekarang (detik), bawaan 300. */
  toleransiDetik?: number;
  /** Waktu sekarang (detik Unix), untuk pengujian. */
  sekarang?: number;
}

function ambilHeader(h: SumberHeader, nama: string): string {
  const fn = (h as { get?: unknown }).get;
  if (typeof fn === 'function') return String((h as { get(n: string): string | null | undefined }).get(nama) ?? '');
  const rec = h as Record<string, string | string[] | undefined>;
  const kunci = Object.keys(rec).find((k) => k.toLowerCase() === nama.toLowerCase());
  const v = kunci === undefined ? undefined : rec[kunci];
  return Array.isArray(v) ? v.join(', ') : (v ?? '');
}

/** Web Crypto: global di browser dan Node.js 19+, dari `node:crypto` di Node.js 18. */
async function subtle(): Promise<SubtleCrypto> {
  if (globalThis.crypto?.subtle) return globalThis.crypto.subtle;
  try {
    const nama = 'node:crypto'; // lewat variabel supaya bundler tidak mencoba menyertakannya
    const m = (await import(/* @vite-ignore */ nama)) as { webcrypto?: { subtle?: SubtleCrypto } };
    if (m.webcrypto?.subtle) return m.webcrypto.subtle;
  } catch {
    /* bukan Node.js */
  }
  throw new Error('Web Crypto (crypto.subtle) tidak tersedia; pakai Node.js 18+ atau browser modern.');
}

const hex = (b: ArrayBuffer) => Array.from(new Uint8Array(b), (x) => x.toString(16).padStart(2, '0')).join('');

/** Teks yang ditandatangani gerbang (harus sama persis dengan server/gerbang-inti.php di api_unipo). */
export function teksTandaGerbang(t: number, metode: string, path: string, klien: string, pengguna: string, requestId: string): string {
  return `${t}\n${metode.toUpperCase()}\n${path}\n${klien}\n${pengguna}\n${requestId}`;
}

/** Hitung nilai header `X-Unipo-Gerbang` (untuk pengujian layanan tanpa gerbang). */
export async function tandaTanganGerbang(kunci: string, t: number, metode: string, path: string, klien: string, pengguna: string, requestId: string): Promise<string> {
  const s = await subtle();
  const k = await s.importKey('raw', new TextEncoder().encode(kunci), { name: 'HMAC', hash: 'SHA-256' }, false, ['sign']);
  const sig = await s.sign('HMAC', k, new TextEncoder().encode(teksTandaGerbang(t, metode, path, klien, pengguna, requestId)));
  return `t=${t},v1=${hex(sig)}`;
}

/**
 * Verifikasi header identitas dari gerbang api.unipo.ac.id. Mengembalikan identitas bila tanda tangan sah dan belum
 * kedaluwarsa, `null` bila tidak (tolak permintaan dengan 401). Header `X-Unipo-*` hanya boleh dipercaya setelah ini.
 *
 * ```ts
 * app.use(async (req, res, next) => {
 *   const id = await verifikasiGerbang({ metode: req.method, path: req.originalUrl, header: req.headers }, process.env.GERBANG_KUNCI!);
 *   if (!id) return res.status(401).json({ error: { code: 'unauthorized', message: 'Hanya lewat api.unipo.ac.id' } });
 *   req.identitas = id; next();
 * });
 * ```
 */
export async function verifikasiGerbang(req: PermintaanGerbang, kunci: string, opsi: OpsiVerifikasiGerbang = {}): Promise<IdentitasGerbang | null> {
  const m = /^t=(\d{1,12}),v1=([0-9a-f]{64})$/.exec(ambilHeader(req.header, 'x-unipo-gerbang').trim());
  if (!m || !kunci) return null;
  const t = Number(m[1]);
  const sekarang = opsi.sekarang ?? Math.floor(Date.now() / 1000);
  if (Math.abs(sekarang - t) > (opsi.toleransiDetik ?? 300)) return null;
  const klien = ambilHeader(req.header, 'x-unipo-klien');
  const pengguna = ambilHeader(req.header, 'x-unipo-pengguna');
  const requestId = ambilHeader(req.header, 'x-request-id');
  const terima = m[2] as string;
  const harap = (await tandaTanganGerbang(kunci, t, req.metode, req.path, klien, pengguna, requestId)).slice(-64);
  // Perbandingan waktu-konstan.
  let beda = 0;
  for (let i = 0; i < 64; i++) beda |= harap.charCodeAt(i) ^ terima.charCodeAt(i);
  if (beda !== 0) return null;
  const scope = ambilHeader(req.header, 'x-unipo-scope');
  return { klien, pengguna, level: ambilHeader(req.header, 'x-unipo-level'), scope: scope === '' ? [] : scope.split(' '), requestId, waktu: t };
}

// ------------------------------------------------------------------ antrean tarik

/** Amplop event domain (sama untuk webhook, broker, dan antrean). */
export interface AmplopEvent<D = Record<string, unknown>> {
  id: string;
  jenis: string;
  versi: number;
  sumber: string;
  subjek: string | null;
  waktu: string;
  korelasi_id: string | null;
  penyebab_id: string | null;
  aktor: string | null;
  data: D;
}

export interface PesanAntrean<D = Record<string, unknown>> {
  tanda_terima: string;
  percobaan: number;
  diambil_at: string;
  terlihat_lagi_at: string;
  event: AmplopEvent<D>;
}

export interface OpsiKonsumsiAntrean {
  /** Pesan per pengambilan (1-100, bawaan 10). */
  jumlah?: number;
  /** Batas waktu proses per pengambilan (detik, 5-43200); bawaan pengaturan antrean. */
  visibilitasDetik?: number;
  /** Jeda sebelum pesan yang gagal muncul lagi (detik, bawaan 60). */
  tundaDetik?: number;
  /** Berapa kali mengambil sebelum berhenti (bawaan 10). Berhenti lebih awal bila antrean kosong. */
  maksPutaran?: number;
  signal?: AbortSignal;
  request?: RequestOptions;
}

export interface HasilKonsumsiAntrean {
  diproses: number;
  gagal: number;
  putaran: number;
}

/**
 * Ambil event dari antrean tarik dan jalankan `handler` untuk tiap pesan: selesai = ack, melempar galat = tolak
 * (muncul lagi setelah `tundaDetik`; setelah maks. percobaan masuk dead letter). Cocok dijalankan dari cron tiap menit.
 * Pengantaran at-least-once: handler harus idempoten (abaikan `event.id` yang sudah diproses).
 */
export async function konsumsiAntrean<D = Record<string, unknown>>(
  client: SiakadCore,
  kode: string,
  handler: (event: AmplopEvent<D>, pesan: PesanAntrean<D>) => unknown | Promise<unknown>,
  opsi: OpsiKonsumsiAntrean = {},
): Promise<HasilKonsumsiAntrean> {
  const hasil: HasilKonsumsiAntrean = { diproses: 0, gagal: 0, putaran: 0 };
  const jalur = `/v1/infra/antrean/${encodeURIComponent(kode)}`;
  const maks = opsi.maksPutaran ?? 10;
  while (hasil.putaran < maks && !opsi.signal?.aborted) {
    hasil.putaran++;
    const body: Record<string, unknown> = { jumlah: opsi.jumlah ?? 10 };
    if (opsi.visibilitasDetik !== undefined) body.visibilitas_detik = opsi.visibilitasDetik;
    const { data } = await client.request<{ pesan: PesanAntrean<D>[] }>({ method: 'POST', path: `${jalur}/ambil`, body }, opsi.request);
    if (data.pesan.length === 0) break;
    const ack: string[] = [];
    for (const p of data.pesan) {
      try {
        await handler(p.event, p);
        ack.push(p.tanda_terima);
        hasil.diproses++;
      } catch (e) {
        hasil.gagal++;
        const galat = e instanceof Error ? e.message : String(e);
        await client.request({ method: 'POST', path: `${jalur}/tolak`, body: { tanda_terima: p.tanda_terima, tunda_detik: opsi.tundaDetik ?? 60, galat: galat.slice(0, 1000) } }, opsi.request);
      }
    }
    if (ack.length > 0) await client.request({ method: 'POST', path: `${jalur}/ack`, body: { tanda_terima: ack } }, opsi.request);
  }
  return hasil;
}

// ------------------------------------------------------------------ rahasia

export interface Rahasia {
  nama: string;
  jenis: 'teks' | 'berkas';
  versi: number;
  kedaluwarsa_at: string | null;
  nilai?: string;
  mime?: string | null;
  berkas_base64?: string;
}

export interface OpsiMuatRahasia {
  /** `produksi` (bawaan) atau `development`. */
  lingkungan?: 'produksi' | 'development';
  /** Tujuan variabel (bawaan `process.env`); `null` = hanya kembalikan nilainya. */
  env?: Record<string, string | undefined> | null;
  /** Timpa variabel yang sudah terisi (bawaan false: nilai di env menang, cocok untuk pengembangan lokal). */
  timpa?: boolean;
  request?: RequestOptions;
}

/**
 * Baca semua rahasia satu ruang dari secret manager (`GET /v1/infra/rahasia-saya/{ruang}`, scope `infra:rahasia`,
 * token live) dan isi `process.env` dengan rahasia teks. Rahasia berkas dikembalikan apa adanya (base64).
 */
export async function muatRahasia(client: SiakadCore, ruang: string, opsi: OpsiMuatRahasia = {}): Promise<Rahasia[]> {
  const { data } = await client.request<Rahasia[]>(
    { method: 'GET', path: `/v1/infra/rahasia-saya/${encodeURIComponent(ruang)}`, query: { lingkungan: opsi.lingkungan ?? 'produksi' } },
    opsi.request,
  );
  const env = opsi.env === undefined ? (globalThis as { process?: { env: Record<string, string | undefined> } }).process?.env : opsi.env;
  if (env) {
    for (const r of data) {
      if (r.jenis === 'teks' && r.nilai !== undefined && (opsi.timpa || env[r.nama] === undefined || env[r.nama] === '')) env[r.nama] = r.nilai;
    }
  }
  return data;
}

// ------------------------------------------------------------------ terbitkan

export interface OpsiTerbitkanEvent {
  subjek?: string;
  versi?: number;
  request?: RequestOptions;
}

/**
 * Terbitkan event domain layanan ini ke bus SIAKAD (`POST /v1/infra/terbitkan`, scope `infra:terbitkan`).
 * `jenis` wajib berawalan kode layanan di registri, mis. `lms.tugas_dinilai`.
 */
export async function terbitkanEvent(client: SiakadCore, jenis: string, data: Record<string, unknown>, opsi: OpsiTerbitkanEvent = {}): Promise<{ diterima: boolean; id: string; jenis: string; sumber: string }> {
  const body: Record<string, unknown> = { jenis, data };
  if (opsi.subjek !== undefined) body.subjek = opsi.subjek;
  if (opsi.versi !== undefined) body.versi = opsi.versi;
  const r = await client.request<{ diterima: boolean; id: string; jenis: string; sumber: string }>({ method: 'POST', path: '/v1/infra/terbitkan', body }, opsi.request);
  return r.data;
}
