/*
 * Pembantu presensi kerja berbasis lokasi (/v1/sdm/presensi, panduan docs/PRESENSI_KERJA.md di SIAKAD).
 * Dipakai web (unipo-ui) dan aplikasi mobile presensi:
 *
 *   const layar = (await siakad.sdm.getPresensiHariIni({ perangkat: idPerangkat })).data as PresensiHariIni;
 *   const pratinjau = cocokkanArea(layar.lokasi, { lat, lng });   // tampilkan "di dalam area" sebelum mengirim
 *   const hasil = await catatPresensiKerja(siakad, { lat, lng, akurasi, perangkat: { id: idPerangkat, platform: 'android' } });
 *
 * Keputusan akhir selalu di server (jam server, area, akurasi, perangkat); pratinjau di sini hanya untuk tampilan.
 */
import type { SiakadCore } from './core.js';
import type { RequestOptions } from './types.js';

export type StatusKejadianPresensi = 'diterima' | 'ditinjau' | 'ditolak';

export interface AreaPresensi {
  id: number | null;
  uuid: string | null;
  kode: string;
  nama: string;
  jenis: 'kampus' | 'gedung' | 'kantor' | 'lapangan' | 'lainnya';
  kampus: string | null;
  unit_id: number | null;
  unit_nama?: string | null;
  alamat: string | null;
  lat: number;
  lng: number;
  radius_m: number;
  /** [[lat, lng], ...]; bila ada, area = di dalam poligon. */
  poligon: Array<[number, number]> | null;
  ada_jaringan: boolean;
  /** Hanya untuk petugas SDM. */
  jaringan?: string | null;
  aktif: boolean;
  keterangan: string | null;
}

export interface JadwalPresensiHari {
  kerja: boolean;
  libur: string | null;
  masuk: string | null;
  pulang: string | null;
  masuk_at: string | null;
  pulang_at: string | null;
  buka_at: string | null;
  tutup_at: string | null;
  kode: string;
  nama: string;
  jenis: 'tetap' | 'shift' | 'fleksibel';
  toleransi_terlambat_menit: number;
  min_kerja_menit: number | null;
  lintas_hari: boolean;
  wajib_lokasi: boolean;
  wajib_foto: boolean;
  mode_lokasi: 'area' | 'bebas';
}

export interface PresensiHarian {
  id: number;
  pegawai_id: number;
  tanggal: string;
  jam_masuk: string | null;
  jam_pulang: string | null;
  status: 'hadir' | 'terlambat' | 'izin' | 'sakit' | 'cuti' | 'dinas' | 'alpa' | 'libur';
  terlambat_menit: number;
  pulang_cepat_menit: number;
  sumber: string;
  lokasi_masuk: string | null;
  lokasi_pulang: string | null;
  keterangan: string | null;
}

export interface KejadianPresensi {
  id: string;
  pegawai_id: number;
  pegawai_nama: string | null;
  pegawai_jenis?: string | null;
  tanggal: string;
  aksi: 'masuk' | 'pulang';
  waktu: string;
  waktu_perangkat: string | null;
  lat: number | null;
  lng: number | null;
  akurasi_m: number | null;
  lokasi: { id: number; nama: string | null } | null;
  jarak_m: number | null;
  di_area: boolean;
  sumber: 'web' | 'mobile' | 'qr' | 'kiosk' | 'mesin';
  platform: string | null;
  perangkat_id: number | null;
  lokasi_palsu: boolean;
  foto_berkas_id: string | null;
  status: StatusKejadianPresensi;
  alasan: string | null;
  tanda: string[];
  tanda_label: string[];
  skor_risiko: number;
  catatan: string | null;
  ditinjau_oleh: string | null;
  ditinjau_at: string | null;
  catatan_tinjau: string | null;
}

/** Jawaban GET /v1/sdm/presensi/hari-ini. */
export interface PresensiHariIni {
  server_waktu: string;
  zona: string;
  tanggal: string;
  jadwal: JadwalPresensiHari;
  presensi: PresensiHarian | null;
  cuti: { id: number; nama: string; status_presensi: 'cuti' | 'izin' | 'sakit' | 'dinas'; tanggal_mulai: string; tanggal_selesai: string } | null;
  mode_lokasi: 'area' | 'bebas';
  lokasi: AreaPresensi[];
  aksi_berikut: 'masuk' | 'pulang' | null;
  bisa: boolean;
  alasan: string | null;
  aturan: {
    wajib_lokasi: boolean;
    wajib_foto: boolean;
    akurasi_maks_m: number;
    luar_area: 'tolak' | 'tinjau';
    lokasi_palsu: 'tolak' | 'tinjau';
    hari_libur: 'tolak' | 'tinjau' | 'izinkan';
    batas_perangkat: number;
    perangkat_baru: 'otomatis' | 'persetujuan';
  };
  kejadian: KejadianPresensi[];
  perangkat?: { status: 'aktif' | 'menunggu' | 'diblokir' | 'baru' };
}

export interface CatatPresensiInput {
  aksi?: 'masuk' | 'pulang';
  lat?: number;
  lng?: number;
  akurasi?: number;
  lokasi_palsu?: boolean;
  perangkat?: { id: string; nama?: string; platform?: 'android' | 'ios' | 'web' | 'desktop'; versi_app?: string };
  waktu_perangkat?: string;
  /** Data URI swafoto. */
  foto?: string;
  foto_berkas_id?: string;
  /** Kunci idempoten; dibuat otomatis oleh catatPresensiKerja bila kosong. */
  kunci?: string;
  catatan?: string;
}

/** Jawaban POST /v1/sdm/presensi/catat. */
export interface HasilCatatPresensi {
  status: 'diterima' | 'ditinjau';
  aksi: 'masuk' | 'pulang';
  pesan: string;
  /** true = kunci sama sudah pernah dikirim; ini hasil yang pertama. */
  ulang: boolean;
  kejadian: KejadianPresensi | null;
  presensi: PresensiHarian | null;
}

/** Kode galat tetap dari POST /presensi/catat (error.code). */
export const KODE_GALAT_PRESENSI = {
  lokasi_wajib: 'Aktifkan lokasi (GPS).',
  akurasi_rendah: 'Akurasi lokasi terlalu rendah.',
  di_luar_area: 'Di luar area presensi.',
  alasan_wajib: 'Di luar area: tulis alasan agar ditinjau atasan.',
  lokasi_palsu: 'Lokasi palsu terdeteksi.',
  perangkat_menunggu: 'Perangkat menunggu persetujuan petugas SDM.',
  perangkat_diblokir: 'Perangkat diblokir.',
  di_luar_jendela: 'Di luar jam presensi.',
  hari_libur: 'Bukan hari kerja.',
  sedang_cuti: 'Sedang cuti/izin.',
  foto_wajib: 'Swafoto wajib.',
  sudah_masuk: 'Presensi masuk sudah tercatat.',
  belum_masuk: 'Belum presensi masuk.',
  terlalu_cepat: 'Masuk baru saja tercatat.',
} as const;
export type KodeGalatPresensi = keyof typeof KODE_GALAT_PRESENSI;

const R = 6371000;
const rad = (d: number) => (d * Math.PI) / 180;

/** Jarak dua titik (meter, haversine). */
export function jarakMeter(a: { lat: number; lng: number }, b: { lat: number; lng: number }): number {
  const dlat = rad(b.lat - a.lat);
  const dlng = rad(b.lng - a.lng);
  const h = Math.sin(dlat / 2) ** 2 + Math.cos(rad(a.lat)) * Math.cos(rad(b.lat)) * Math.sin(dlng / 2) ** 2;
  return R * 2 * Math.atan2(Math.sqrt(h), Math.sqrt(1 - h));
}

/** Titik di dalam poligon [[lat, lng], ...]. */
export function dalamPoligon(t: { lat: number; lng: number }, poligon: Array<[number, number]>): boolean {
  let dalam = false;
  for (let i = 0, j = poligon.length - 1; i < poligon.length; j = i++) {
    const [yi, xi] = poligon[i] as [number, number];
    const [yj, xj] = poligon[j] as [number, number];
    if (yi > t.lat !== yj > t.lat && t.lng < ((xj - xi) * (t.lat - yi)) / (yj - yi || 1e-12) + xi) dalam = !dalam;
  }
  return dalam;
}

/** Jarak (meter) dari titik ke tepi poligon; 0 bila di dalam. */
function jarakKePoligon(t: { lat: number; lng: number }, poligon: Array<[number, number]>): number {
  if (dalamPoligon(t, poligon)) return 0;
  const kx = Math.cos(rad(t.lat)) * R * (Math.PI / 180);
  const ky = R * (Math.PI / 180);
  let min = Infinity;
  for (let i = 0; i < poligon.length; i++) {
    const [alat, alng] = poligon[i] as [number, number];
    const [blat, blng] = poligon[(i + 1) % poligon.length] as [number, number];
    const ax = (alng - t.lng) * kx, ay = (alat - t.lat) * ky, bx = (blng - t.lng) * kx, by = (blat - t.lat) * ky;
    const dx = bx - ax, dy = by - ay;
    const len = dx * dx + dy * dy;
    const u = len > 0 ? Math.max(0, Math.min(1, -(ax * dx + ay * dy) / len)) : 0;
    min = Math.min(min, Math.hypot(ax + u * dx, ay + u * dy));
  }
  return min;
}

/**
 * Pratinjau di sisi klien: apakah posisi berada di salah satu area, dan berapa meter dari area terdekat.
 * Sama dengan perhitungan server (radius dari titik pusat, atau poligon). Jaringan kampus hanya diperiksa server.
 */
export function cocokkanArea(area: AreaPresensi[], posisi: { lat: number; lng: number }): { diArea: boolean; area: AreaPresensi | null; jarakM: number | null } {
  let terdekat: AreaPresensi | null = null;
  let min = Infinity;
  for (const a of area) {
    const j = a.poligon && a.poligon.length >= 3 ? jarakKePoligon(posisi, a.poligon) : Math.max(0, jarakMeter(posisi, a) - a.radius_m);
    if (j <= 0) return { diArea: true, area: a, jarakM: 0 };
    if (j < min) {
      min = j;
      terdekat = a;
    }
  }
  return { diArea: false, area: terdekat, jarakM: terdekat ? Math.ceil(min) : null };
}

/** Kunci idempoten acak untuk satu ketukan presensi. */
export function buatKunciPresensi(): string {
  const c = (globalThis as { crypto?: { randomUUID?: () => string } }).crypto;
  if (c?.randomUUID) return c.randomUUID();
  return `p-${Date.now().toString(36)}-${Math.random().toString(36).slice(2, 12)}`;
}

/** POST /v1/sdm/presensi/catat dengan kunci idempoten otomatis dan waktu perangkat. */
export async function catatPresensiKerja(siakad: SiakadCore, input: CatatPresensiInput, options?: RequestOptions): Promise<HasilCatatPresensi> {
  const body = { waktu_perangkat: new Date().toISOString(), ...input, kunci: input.kunci ?? buatKunciPresensi() };
  const r = await siakad.request<HasilCatatPresensi>({ method: 'POST', path: '/v1/sdm/presensi/catat', body }, options);
  return r.data;
}
