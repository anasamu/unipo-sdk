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

  /** Admisi: Penerimaan, Admisi: Seleksi, Admisi: KIP Kuliah dan UKT, Admisi: Chat dan laporan, Admisi: Pendaftar, Admisi: Program studi (78 endpoint) */
  get admisi(): R.AdmisiResource {
    return this.resource('admisi', () => new R.AdmisiResource(this));
  }

  /** Akademik: Jadwal dan kelas, Akademik: Persetujuan KRS, Akademik: Nilai, Akademik: Batas waktu input, Akademik: Presensi dan jurnal, Akademik: Dokumen dan laporan, Akademik: Pengajuan status (55 endpoint) */
  get akademik(): R.AkademikResource {
    return this.resource('akademik', () => new R.AkademikResource(this));
  }

  /** Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom (18 endpoint) */
  get apiPortal(): R.ApiPortalResource {
    return this.resource('apiPortal', () => new R.ApiPortalResource(this));
  }

  /** Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan (124 endpoint) */
  get arsip(): R.ArsipResource {
    return this.resource('arsip', () => new R.ArsipResource(this));
  }

  /** Aturan, Aturan: pengatur dan pemeriksaan, Aturan: SK dan pengecualian (22 endpoint) */
  get aturan(): R.AturanResource {
    return this.resource('aturan', () => new R.AturanResource(this));
  }

  /** Berkas, Berkas: Unggah bertahap, Berkas: Folder, Berkas: Unit dan periode, Berkas: Berbagi, Berkas: Enkripsi (39 endpoint) */
  get berkas(): R.BerkasResource {
    return this.resource('berkas', () => new R.BerkasResource(this));
  }

  /** Biaya: Aturan, Biaya: Pembagian, Biaya: SK dan riwayat (27 endpoint) */
  get biaya(): R.BiayaResource {
    return this.resource('biaya', () => new R.BiayaResource(this));
  }

  /** CBT: Nilai ke SIAKAD, CBT: Ujian percobaan, CBT: Koreksi dan hasil, CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Soal, CBT: Peserta, CBT: Ujian (50 endpoint) */
  get cbt(): R.CbtResource {
    return this.resource('cbt', () => new R.CbtResource(this));
  }

  /** CRM: Prospek, CRM: Skor dan segmen (35 endpoint) */
  get crm(): R.CrmResource {
    return this.resource('crm', () => new R.CrmResource(this));
  }

  /** Dasbor: Ringkasan, Dasbor: Perkuliahan, Dasbor: Kehadiran, Dasbor: Outcome, Dasbor: Peringatan dini (16 endpoint) */
  get dasbor(): R.DasborResource {
    return this.resource('dasbor', () => new R.DasborResource(this));
  }

  /** Dokumen: Templat, Dokumen: Terbitkan, Dokumen: Arsip terbit, Dokumen: Verifikasi publik (21 endpoint) */
  get dokumen(): R.DokumenResource {
    return this.resource('dokumen', () => new R.DokumenResource(this));
  }

  /** Dosen, Jadwal (4 endpoint) */
  get dosen(): R.DosenResource {
    return this.resource('dosen', () => new R.DosenResource(this));
  }

  /** EDOM: Soal, EDOM: Pengisian, EDOM: Hasil (14 endpoint) */
  get edom(): R.EdomResource {
    return this.resource('edom', () => new R.EdomResource(this));
  }

  /** Fakultas, Fakultas: kelola akademik (53 endpoint) */
  get fakultas(): R.FakultasResource {
    return this.resource('fakultas', () => new R.FakultasResource(this));
  }

  /** Gaji: Master, Gaji: Proses payroll, Gaji: Laporan, Gaji: Slip saya (57 endpoint) */
  get gaji(): R.GajiResource {
    return this.resource('gaji', () => new R.GajiResource(this));
  }

  /** Helpdesk: Publik, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket (25 endpoint) */
  get helpdesk(): R.HelpdeskResource {
    return this.resource('helpdesk', () => new R.HelpdeskResource(this));
  }

  /** Humas, Humas: redaksi (53 endpoint) */
  get humas(): R.HumasResource {
    return this.resource('humas', () => new R.HumasResource(this));
  }

  /** IKU: Dasbor, IKU: Pengaturan, IKU: Bukti (27 endpoint) */
  get iku(): R.IkuResource {
    return this.resource('iku', () => new R.IkuResource(this));
  }

  /** Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Jabatan, Induk: Peran modul, Induk: Log audit (38 endpoint) */
  get induk(): R.IndukResource {
    return this.resource('induk', () => new R.IndukResource(this));
  }

  /** Infra: Layanan, Infra: Gerbang API, Infra: Rahasia, Infra: Antrean (48 endpoint) */
  get infra(): R.InfraResource {
    return this.resource('infra', () => new R.InfraResource(this));
  }

  /** Integrasi: Status, Integrasi: Pengaturan, Integrasi: Captcha, Integrasi: Pembayaran, Integrasi: Berkas, Integrasi: Cache, Integrasi: Email & WhatsApp, Integrasi: Webhook keluar, Integrasi: Rapat daring, Integrasi: Tanda tangan elektronik, Integrasi: AI (66 endpoint) */
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

  /** Karier: Profil dan CV, Karier: Laporan, Karier: Rekomendasi, Karier: Mitra, Karier: Lamaran, Karier: Acara, Karier: Tips (89 endpoint) */
  get karier(): R.KarierResource {
    return this.resource('karier', () => new R.KarierResource(this));
  }

  /** Kasir: Sesi, Kasir: Pengaturan, Kasir: Penerimaan, Kasir: Laporan, Kasir: Migrasi aplikasi lama (27 endpoint) */
  get kasir(): R.KasirResource {
    return this.resource('kasir', () => new R.KasirResource(this));
  }

  /** Kelengkapan data (7 endpoint) */
  get kelengkapan(): R.KelengkapanResource {
    return this.resource('kelengkapan', () => new R.KelengkapanResource(this));
  }

  /** Kelulusan: Yudisium, Kelulusan: Syarat, Kelulusan: Wisuda, Kelulusan: Ijazah dan sertifikat, Kelulusan: Poin dan SKPI (76 endpoint) */
  get kelulusan(): R.KelulusanResource {
    return this.resource('kelulusan', () => new R.KelulusanResource(this));
  }

  /** Kemahasiswaan: Beasiswa, Kemahasiswaan: Organisasi, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran (92 endpoint) */
  get kemahasiswaan(): R.KemahasiswaanResource {
    return this.resource('kemahasiswaan', () => new R.KemahasiswaanResource(this));
  }

  /** Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi (43 endpoint) */
  get kerjasama(): R.KerjasamaResource {
    return this.resource('kerjasama', () => new R.KerjasamaResource(this));
  }

  /** Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Buku besar, Keuangan: Kas, Keuangan: Laporan keuangan, Keuangan: Statistik, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan (96 endpoint) */
  get keu(): R.KeuResource {
    return this.resource('keu', () => new R.KeuResource(this));
  }

  /** Keuangan, Keuangan: Tagihan, Keuangan: Tarif, Keuangan: Denda, Keuangan: Pembayaran dan kwitansi, Keuangan: Kasir, Keuangan: Refund dan deposit, Keuangan: Potongan, Keuangan: Rekonsiliasi dan laporan, Keuangan: Mahasiswa, Keuangan: Pengaturan, Keuangan: UKT, Keuangan: Dispensasi, Keuangan: Cicilan, Keuangan: Keringanan dan beasiswa (151 endpoint) */
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

  /** LMS: Beranda, LMS: Kelas, LMS: Konten, LMS: Kelas terbuka, LMS: Analitik, LMS: Kelas daring, LMS: File, LMS: Tugas, LMS: Kuis, LMS: Forum, LMS: Presensi, LMS: Nilai, LMS: Impor ke SIAKAD (104 endpoint) */
  get lms(): R.LmsResource {
    return this.resource('lms', () => new R.LmsResource(this));
  }

  /** LPPM: Umum, LPPM: Tim LP2M, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: Kolaborasi, LPPM: Publikasi, LPPM: KKN, LPPM: File (163 endpoint) */
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

  /** Data master: Struktur akademik, Data master: Mahasiswa dan dosen, Data master: Format dokumen akademik (25 endpoint) */
  get master(): R.MasterResource {
    return this.resource('master', () => new R.MasterResource(this));
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

  /** Obrolan, Obrolan: Perangkat & kunci, Obrolan: Ruang, Obrolan: Pesan, Obrolan: Privasi (31 endpoint) */
  get obrolan(): R.ObrolanResource {
    return this.resource('obrolan', () => new R.ObrolanResource(this));
  }

  /** PDDikti: Pelaporan, PDDikti: Kirim dan sinkronisasi, PDDikti: Sinkronisasi otomatis, PDDikti: Relay Feeder Desktop, PDDikti: Evaluasi data (29 endpoint) */
  get pddikti(): R.PddiktiResource {
    return this.resource('pddikti', () => new R.PddiktiResource(this));
  }

  /** Event domain (7 endpoint) */
  get peristiwa(): R.PeristiwaResource {
    return this.resource('peristiwa', () => new R.PeristiwaResource(this));
  }

  /** Perpustakaan: Katalog, Perpustakaan: Pengelolaan koleksi, Perpustakaan: Sirkulasi, Perpustakaan: Layanan anggota, Perpustakaan: Laporan dan integrasi, Perpustakaan: Layanan (44 endpoint) */
  get perpustakaan(): R.PerpustakaanResource {
    return this.resource('perpustakaan', () => new R.PerpustakaanResource(this));
  }

  /** PMB, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan (120 endpoint) */
  get pmb(): R.PmbResource {
    return this.resource('pmb', () => new R.PmbResource(this));
  }

  /** Portal, Portal: kelola (138 endpoint) */
  get portal(): R.PortalResource {
    return this.resource('portal', () => new R.PortalResource(this));
  }

  /** Presensi QR: Peserta, Presensi QR: Sesi, Presensi QR: Izin, Presensi QR: Titik kerja (31 endpoint) */
  get presensi(): R.PresensiResource {
    return this.resource('presensi', () => new R.PresensiResource(this));
  }

  /** Profil: Saya, Profil: Verifikasi, Profil: Riwayat, Profil: Dokumen, Profil: Permohonan perubahan data (87 endpoint) */
  get profil(): R.ProfilResource {
    return this.resource('profil', () => new R.ProfilResource(this));
  }

  /** QR: Generator, QR: Gaya (9 endpoint) */
  get qr(): R.QrResource {
    return this.resource('qr', () => new R.QrResource(this));
  }

  /** RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Masuk sebagai pengguna, RBAC: Klien API, RBAC: Log API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan (70 endpoint) */
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

  /** RPL: Pemohon, RPL: Asesmen, RPL: Pengajuan, RPL: Master (75 endpoint) */
  get rpl(): R.RplResource {
    return this.resource('rpl', () => new R.RplResource(this));
  }

  /** Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan (68 endpoint) */
  get sarpras(): R.SarprasResource {
    return this.resource('sarpras', () => new R.SarprasResource(this));
  }

  /** SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Penghasilan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: Usulan, SDM: PAK, SDM: Honor, SDM: SOP dan kebijakan, SDM: SISTER (251 endpoint) */
  get sdm(): R.SdmResource {
    return this.resource('sdm', () => new R.SdmResource(this));
  }

  /** SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Pelaporan, SPMI: File (205 endpoint) */
  get spmi(): R.SpmiResource {
    return this.resource('spmi', () => new R.SpmiResource(this));
  }

  /** Tugas akhir: Pengajuan judul, Tugas akhir: Validasi, Tugas akhir: Progres dan pengaturan (15 endpoint) */
  get ta(): R.TaResource {
    return this.resource('ta', () => new R.TaResource(this));
  }

  /** Tema (6 endpoint) */
  get tema(): R.TemaResource {
    return this.resource('tema', () => new R.TemaResource(this));
  }

  /** Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir, Tracer Study: publikasi (80 endpoint) */
  get tracer(): R.TracerResource {
    return this.resource('tracer', () => new R.TracerResource(this));
  }

  /** Lulusan (1 endpoint) */
  get wisuda(): R.WisudaResource {
    return this.resource('wisuda', () => new R.WisudaResource(this));
  }
}
