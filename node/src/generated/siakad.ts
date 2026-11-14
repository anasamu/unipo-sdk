// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.
import { SiakadCore } from '../core.js';
import * as R from './resources.js';

/**
 * Klien API SIAKAD UNIPO.
 *
 * ```ts
 * const siakad = new Siakad({ clientId: process.env.SIAKAD_CLIENT_ID, clientSecret: process.env.SIAKAD_CLIENT_SECRET });
 * const { data } = await siakad.mahasiswa.getByNim('2025001');
 * ```
 */
export class Siakad extends SiakadCore {
  private readonly resources = new Map<string, unknown>();

  private resource<T>(key: string, make: () => T): T {
    let r = this.resources.get(key) as T | undefined;
    if (!r) {
      r = make();
      this.resources.set(key, r);
    }
    return r;
  }

  /** Sistem (3 endpoint) */
  get system(): R.SystemResource {
    return this.resource('system', () => new R.SystemResource(this));
  }

  /** Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom (18 endpoint) */
  get apiPortal(): R.ApiPortalResource {
    return this.resource('apiPortal', () => new R.ApiPortalResource(this));
  }

  /** Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan (123 endpoint) */
  get arsip(): R.ArsipResource {
    return this.resource('arsip', () => new R.ArsipResource(this));
  }

  /** CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Koreksi dan hasil, CBT: Soal, CBT: Peserta, CBT: Ujian (43 endpoint) */
  get cbt(): R.CbtResource {
    return this.resource('cbt', () => new R.CbtResource(this));
  }

  /** Dasbor: Ringkasan, Dasbor: Peringatan dini (11 endpoint) */
  get dasbor(): R.DasborResource {
    return this.resource('dasbor', () => new R.DasborResource(this));
  }

  /** Dosen, Jadwal (4 endpoint) */
  get dosen(): R.DosenResource {
    return this.resource('dosen', () => new R.DosenResource(this));
  }

  /** Fakultas, Fakultas: kelola akademik (45 endpoint) */
  get fakultas(): R.FakultasResource {
    return this.resource('fakultas', () => new R.FakultasResource(this));
  }

  /** Helpdesk: Publik, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket (25 endpoint) */
  get helpdesk(): R.HelpdeskResource {
    return this.resource('helpdesk', () => new R.HelpdeskResource(this));
  }

  /** Humas, Humas: redaksi (53 endpoint) */
  get humas(): R.HumasResource {
    return this.resource('humas', () => new R.HumasResource(this));
  }

  /** Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Jabatan, Induk: Peran modul, Induk: Log audit (38 endpoint) */
  get induk(): R.IndukResource {
    return this.resource('induk', () => new R.IndukResource(this));
  }

  /** Integrasi: Status, Integrasi: Pengaturan, Integrasi: Captcha, Integrasi: Pembayaran, Integrasi: Berkas, Integrasi: Cache, Integrasi: Email & WhatsApp, Integrasi: Webhook keluar, Integrasi: Rapat daring (58 endpoint) */
  get integrasi(): R.IntegrasiResource {
    return this.resource('integrasi', () => new R.IntegrasiResource(this));
  }

  /** Jadwal, Presensi (4 endpoint) */
  get jadwal(): R.JadwalResource {
    return this.resource('jadwal', () => new R.JadwalResource(this));
  }

  /** Jadwal (1 endpoint) */
  get jadwalUjian(): R.JadwalUjianResource {
    return this.resource('jadwalUjian', () => new R.JadwalUjianResource(this));
  }

  /** Kalender: Terpadu, Kalender: Hari kerja, Kalender: Kegiatan (14 endpoint) */
  get kalender(): R.KalenderResource {
    return this.resource('kalender', () => new R.KalenderResource(this));
  }

  /** Karier: Profil dan CV, Karier: Laporan, Karier: Lamaran, Karier: Acara (51 endpoint) */
  get karier(): R.KarierResource {
    return this.resource('karier', () => new R.KarierResource(this));
  }

  /** Kemahasiswaan: Beasiswa, Kemahasiswaan: Organisasi, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran (92 endpoint) */
  get kemahasiswaan(): R.KemahasiswaanResource {
    return this.resource('kemahasiswaan', () => new R.KemahasiswaanResource(this));
  }

  /** Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi (43 endpoint) */
  get kerjasama(): R.KerjasamaResource {
    return this.resource('kerjasama', () => new R.KerjasamaResource(this));
  }

  /** Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan (61 endpoint) */
  get keu(): R.KeuResource {
    return this.resource('keu', () => new R.KeuResource(this));
  }

  /** Keuangan (2 endpoint) */
  get keuangan(): R.KeuanganResource {
    return this.resource('keuangan', () => new R.KeuanganResource(this));
  }

  /** Akademik (1 endpoint) */
  get kurikulum(): R.KurikulumResource {
    return this.resource('kurikulum', () => new R.KurikulumResource(this));
  }

  /** Kurikulum OBE, Kurikulum OBE: migrasi dari kurikulum lama, Kurikulum OBE: evaluasi & capaian, Kurikulum OBE: profil, CPL, bahan kajian, Kurikulum OBE: mata kuliah & CPMK, Kurikulum OBE: RPS (67 endpoint) */
  get kurikulumObe(): R.KurikulumObeResource {
    return this.resource('kurikulumObe', () => new R.KurikulumObeResource(this));
  }

  /** Layanan: Verifikasi dokumen, Layanan: Katalog, Layanan: Permohonan (30 endpoint) */
  get layanan(): R.LayananResource {
    return this.resource('layanan', () => new R.LayananResource(this));
  }

  /** Lingkungan data (2 endpoint) */
  get lingkungan(): R.LingkunganResource {
    return this.resource('lingkungan', () => new R.LingkunganResource(this));
  }

  /** LMS: Beranda, LMS: Kelas, LMS: Konten, LMS: Kelas daring, LMS: File, LMS: Tugas, LMS: Kuis, LMS: Forum, LMS: Presensi, LMS: Nilai, LMS: Impor ke SIAKAD (96 endpoint) */
  get lms(): R.LmsResource {
    return this.resource('lms', () => new R.LmsResource(this));
  }

  /** LPPM: Umum, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: KKN, LPPM: File (146 endpoint) */
  get lppm(): R.LppmResource {
    return this.resource('lppm', () => new R.LppmResource(this));
  }

  /** Lulusan (1 endpoint) */
  get lulusan(): R.LulusanResource {
    return this.resource('lulusan', () => new R.LulusanResource(this));
  }

  /** Mahasiswa, KRS, Nilai, Jadwal, Presensi, Keuangan, Lulusan (15 endpoint) */
  get mahasiswa(): R.MahasiswaResource {
    return this.resource('mahasiswa', () => new R.MahasiswaResource(this));
  }

  /** Akademik (1 endpoint) */
  get mataKuliah(): R.MataKuliahResource {
    return this.resource('mataKuliah', () => new R.MataKuliahResource(this));
  }

  /** MBKM: Laporan, MBKM: Peserta, MBKM: Program, MBKM: Logbook, MBKM: Nilai dan konversi (58 endpoint) */
  get mbkm(): R.MbkmResource {
    return this.resource('mbkm', () => new R.MbkmResource(this));
  }

  /** Notifikasi: Kotak masuk, Notifikasi: Preferensi, Notifikasi: Antrean, Notifikasi: Pengumuman (22 endpoint) */
  get notif(): R.NotifResource {
    return this.resource('notif', () => new R.NotifResource(this));
  }

  /** PMB, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan (119 endpoint) */
  get pmb(): R.PmbResource {
    return this.resource('pmb', () => new R.PmbResource(this));
  }

  /** Portal, Portal: kelola (138 endpoint) */
  get portal(): R.PortalResource {
    return this.resource('portal', () => new R.PortalResource(this));
  }

  /** RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Klien API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan (59 endpoint) */
  get rbac(): R.RbacResource {
    return this.resource('rbac', () => new R.RbacResource(this));
  }

  /** Referensi (14 endpoint) */
  get referensi(): R.ReferensiResource {
    return this.resource('referensi', () => new R.ReferensiResource(this));
  }

  /** Repositori: OAI-PMH, Repositori: Karya, Repositori: Koleksi (22 endpoint) */
  get repositori(): R.RepositoriResource {
    return this.resource('repositori', () => new R.RepositoriResource(this));
  }

  /** Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan (67 endpoint) */
  get sarpras(): R.SarprasResource {
    return this.resource('sarpras', () => new R.SarprasResource(this));
  }

  /** SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: Usulan (189 endpoint) */
  get sdm(): R.SdmResource {
    return this.resource('sdm', () => new R.SdmResource(this));
  }

  /** SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Pelaporan, SPMI: File (196 endpoint) */
  get spmi(): R.SpmiResource {
    return this.resource('spmi', () => new R.SpmiResource(this));
  }

  /** Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir (75 endpoint) */
  get tracer(): R.TracerResource {
    return this.resource('tracer', () => new R.TracerResource(this));
  }

  /** Lulusan (1 endpoint) */
  get wisuda(): R.WisudaResource {
    return this.resource('wisuda', () => new R.WisudaResource(this));
  }
}
