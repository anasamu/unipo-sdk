<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Concerns;

use Unipo\Siakad\Resources;

/**
 * Akses ke semua modul API (4088 endpoint).
 */
trait GeneratedResources
{
    /** Sistem (4 endpoint) */
    public function system(): Resources\System
    {
        return $this->resource(Resources\System::class);
    }

    /** Admisi: Penerimaan, Admisi: Seleksi, Admisi: KIP Kuliah dan UKT, Admisi: Chat dan laporan, Admisi: Pendaftar, Admisi: Program studi (86 endpoint) */
    public function admisi(): Resources\Admisi
    {
        return $this->resource(Resources\Admisi::class);
    }

    /** Akademik: Jadwal dan kelas, Akademik: Persetujuan KRS, Akademik: Nilai, Akademik: Batas waktu input, Akademik: Presensi dan jurnal, Akademik: Dokumen dan laporan, Akademik: Ujian, Akademik: Konversi dan riwayat nilai, Akademik: Pengajuan status, Akademik: Perbaikan nilai, Akademik: Periode, Akademik: Her-registrasi (102 endpoint) */
    public function akademik(): Resources\Akademik
    {
        return $this->resource(Resources\Akademik::class);
    }

    /** Akun pengguna (14 endpoint) */
    public function akun(): Resources\Akun
    {
        return $this->resource(Resources\Akun::class);
    }

    /** Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom (18 endpoint) */
    public function apiPortal(): Resources\ApiPortal
    {
        return $this->resource(Resources\ApiPortal::class);
    }

    /** Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan (124 endpoint) */
    public function arsip(): Resources\Arsip
    {
        return $this->resource(Resources\Arsip::class);
    }

    /** Aturan, Aturan: titik penerapan, Aturan: SK dan pengecualian, Aturan: pengatur dan pemeriksaan, Aturan: persetujuan (42 endpoint) */
    public function aturan(): Resources\Aturan
    {
        return $this->resource(Resources\Aturan::class);
    }

    /** Berkas, Berkas: Unggah bertahap, Berkas: Folder, Berkas: Unit dan periode, Berkas: Berbagi, Berkas: Enkripsi (39 endpoint) */
    public function berkas(): Resources\Berkas
    {
        return $this->resource(Resources\Berkas::class);
    }

    /** Biaya: Aturan, Biaya: Pembagian, Biaya: SK dan riwayat (27 endpoint) */
    public function biaya(): Resources\Biaya
    {
        return $this->resource(Resources\Biaya::class);
    }

    /** Aturan: Bukti syarat (6 endpoint) */
    public function buktiSyarat(): Resources\BuktiSyarat
    {
        return $this->resource(Resources\BuktiSyarat::class);
    }

    /** CBT: Nilai ke SIAKAD, CBT: Ujian percobaan, CBT: Koreksi dan hasil, CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Soal, CBT: Peserta, CBT: Ujian (54 endpoint) */
    public function cbt(): Resources\Cbt
    {
        return $this->resource(Resources\Cbt::class);
    }

    /** CRM: Prospek, CRM: Skor dan segmen (40 endpoint) */
    public function crm(): Resources\Crm
    {
        return $this->resource(Resources\Crm::class);
    }

    /** Dasbor: Ringkasan, Dasbor: Perkuliahan, Dasbor: Kehadiran, Dasbor: Outcome, Dasbor: Peringatan dini (18 endpoint) */
    public function dasbor(): Resources\Dasbor
    {
        return $this->resource(Resources\Dasbor::class);
    }

    /** Dokumen: Templat, Dokumen: Templat Word, Dokumen: Terbitkan, Dokumen: Arsip terbit, Dokumen: Verifikasi publik (30 endpoint) */
    public function dokumen(): Resources\Dokumen
    {
        return $this->resource(Resources\Dokumen::class);
    }

    /** Dosen, Jadwal (4 endpoint) */
    public function dosen(): Resources\Dosen
    {
        return $this->resource(Resources\Dosen::class);
    }

    /** EDOM: Soal, EDOM: Pengisian, EDOM: Hasil (14 endpoint) */
    public function edom(): Resources\Edom
    {
        return $this->resource(Resources\Edom::class);
    }

    /** Fakultas, Fakultas: struktur organisasi, Fakultas: kelola akademik (112 endpoint) */
    public function fakultas(): Resources\Fakultas
    {
        return $this->resource(Resources\Fakultas::class);
    }

    /** Gaji: Master, Gaji: Proses payroll, Gaji: Laporan, Gaji: Slip saya (65 endpoint) */
    public function gaji(): Resources\Gaji
    {
        return $this->resource(Resources\Gaji::class);
    }

    /** Helpdesk: Publik, Helpdesk: Laporan bug, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket (30 endpoint) */
    public function helpdesk(): Resources\Helpdesk
    {
        return $this->resource(Resources\Helpdesk::class);
    }

    /** Humas, Humas: redaksi (74 endpoint) */
    public function humas(): Resources\Humas
    {
        return $this->resource(Resources\Humas::class);
    }

    /** IKU: Dasbor, IKU: Pengaturan, IKU: Bukti (30 endpoint) */
    public function iku(): Resources\Iku
    {
        return $this->resource(Resources\Iku::class);
    }

    /** Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Organisasi & pejabat (Pustikom), Induk: Jabatan, Induk: Peran modul, Induk: Log audit (80 endpoint) */
    public function induk(): Resources\Induk
    {
        return $this->resource(Resources\Induk::class);
    }

    /** Infra: Layanan, Infra: Gerbang API, Infra: Rahasia, Infra: Antrean (48 endpoint) */
    public function infra(): Resources\Infra
    {
        return $this->resource(Resources\Infra::class);
    }

    /** Integrasi: Status, Integrasi: Pengaturan, Integrasi: Captcha, Integrasi: Pembayaran, Integrasi: Berkas, Integrasi: Cache, Integrasi: Email & WhatsApp, Integrasi: Webhook keluar, Integrasi: Rapat daring, Integrasi: Tanda tangan elektronik, Integrasi: AI (66 endpoint) */
    public function integrasi(): Resources\Integrasi
    {
        return $this->resource(Resources\Integrasi::class);
    }

    /** Jadwal, Presensi (4 endpoint) */
    public function jadwal(): Resources\Jadwal
    {
        return $this->resource(Resources\Jadwal::class);
    }

    /** Jadwal (1 endpoint) */
    public function jadwalUjian(): Resources\JadwalUjian
    {
        return $this->resource(Resources\JadwalUjian::class);
    }

    /** Kalender: Terpadu, Kalender: Hari kerja, Kalender: Periode, Kalender: Batas waktu, Kalender: Kunci periode, Kalender: Kegiatan (43 endpoint) */
    public function kalender(): Resources\Kalender
    {
        return $this->resource(Resources\Kalender::class);
    }

    /** Karier: Profil dan CV, Karier: Laporan, Karier: Rekomendasi, Karier: Mitra, Karier: Lamaran, Karier: Acara, Karier: Tips (98 endpoint) */
    public function karier(): Resources\Karier
    {
        return $this->resource(Resources\Karier::class);
    }

    /** Kasir: Sesi, Kasir: Pengaturan, Kasir: Penerimaan, Kasir: Laporan, Kasir: Migrasi aplikasi lama (27 endpoint) */
    public function kasir(): Resources\Kasir
    {
        return $this->resource(Resources\Kasir::class);
    }

    /** Kelengkapan data (7 endpoint) */
    public function kelengkapan(): Resources\Kelengkapan
    {
        return $this->resource(Resources\Kelengkapan::class);
    }

    /** Kelulusan: Yudisium, Kelulusan: Syarat, Kelulusan: Wisuda, Kelulusan: Ijazah dan sertifikat, Kelulusan: Poin dan SKPI (83 endpoint) */
    public function kelulusan(): Resources\Kelulusan
    {
        return $this->resource(Resources\Kelulusan::class);
    }

    /** Kemahasiswaan: Organisasi, Kemahasiswaan: Beasiswa, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran (111 endpoint) */
    public function kemahasiswaan(): Resources\Kemahasiswaan
    {
        return $this->resource(Resources\Kemahasiswaan::class);
    }

    /** Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi (48 endpoint) */
    public function kerjasama(): Resources\Kerjasama
    {
        return $this->resource(Resources\Kerjasama::class);
    }

    /** Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Buku besar, Keuangan: Kas, Keuangan: Laporan keuangan, Keuangan: Statistik, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan (106 endpoint) */
    public function keu(): Resources\Keu
    {
        return $this->resource(Resources\Keu::class);
    }

    /** Keuangan, Keuangan: Tagihan, Keuangan: Tarif, Keuangan: Denda, Keuangan: Pembayaran dan kwitansi, Keuangan: Kasir, Keuangan: Refund dan deposit, Keuangan: Potongan, Keuangan: Rekonsiliasi dan laporan, Keuangan: Mahasiswa, Keuangan: Pengaturan, Keuangan: UKT, Keuangan: Dispensasi, Keuangan: Cicilan, Keuangan: Keringanan dan beasiswa (166 endpoint) */
    public function keuangan(): Resources\Keuangan
    {
        return $this->resource(Resources\Keuangan::class);
    }

    /** Akademik (1 endpoint) */
    public function kurikulum(): Resources\Kurikulum
    {
        return $this->resource(Resources\Kurikulum::class);
    }

    /** Kurikulum: Aturan berversi, Kurikulum: Kerangka (data), Kurikulum: Perangkat MK, Kurikulum: Asesmen & RPS, Kurikulum: Evaluasi & peninjauan (51 endpoint) */
    public function kurikulumAturan(): Resources\KurikulumAturan
    {
        return $this->resource(Resources\KurikulumAturan::class);
    }

    /** Kurikulum OBE, Kurikulum OBE: migrasi dari kurikulum lama, Kurikulum OBE: evaluasi & capaian, Kurikulum OBE: profil, CPL, bahan kajian, Kurikulum OBE: mata kuliah & CPMK, Kurikulum OBE: RPS (73 endpoint) */
    public function kurikulumObe(): Resources\KurikulumObe
    {
        return $this->resource(Resources\KurikulumObe::class);
    }

    /** Layanan: Verifikasi dokumen, Layanan: Katalog, Layanan: Permohonan (33 endpoint) */
    public function layanan(): Resources\Layanan
    {
        return $this->resource(Resources\Layanan::class);
    }

    /** Lingkungan data (2 endpoint) */
    public function lingkungan(): Resources\Lingkungan
    {
        return $this->resource(Resources\Lingkungan::class);
    }

    /** LMS: Beranda, LMS: Kelas, LMS: Konten, LMS: Kelas terbuka, LMS: Analitik, LMS: Kelas daring, LMS: File, LMS: Tugas, LMS: Kuis, LMS: Forum, LMS: Presensi, LMS: Nilai, LMS: Impor ke SIAKAD (104 endpoint) */
    public function lms(): Resources\Lms
    {
        return $this->resource(Resources\Lms::class);
    }

    /** LPPM: Umum, LPPM: Tim LP2M, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: Kolaborasi, LPPM: Publikasi, LPPM: KKN, LPPM: File (172 endpoint) */
    public function lppm(): Resources\Lppm
    {
        return $this->resource(Resources\Lppm::class);
    }

    /** Lulusan (1 endpoint) */
    public function lulusan(): Resources\Lulusan
    {
        return $this->resource(Resources\Lulusan::class);
    }

    /** Mahasiswa, KRS, Nilai, Jadwal, Presensi, Keuangan, Lulusan (15 endpoint) */
    public function mahasiswa(): Resources\Mahasiswa
    {
        return $this->resource(Resources\Mahasiswa::class);
    }

    /** Data master: Struktur akademik, Data master: Mahasiswa dan dosen, Data master: Format dokumen akademik (25 endpoint) */
    public function master(): Resources\Master
    {
        return $this->resource(Resources\Master::class);
    }

    /** Akademik (1 endpoint) */
    public function mataKuliah(): Resources\MataKuliah
    {
        return $this->resource(Resources\MataKuliah::class);
    }

    /** MBKM: Laporan, MBKM: Peserta, MBKM: Program, MBKM: Logbook, MBKM: Nilai dan konversi (64 endpoint) */
    public function mbkm(): Resources\Mbkm
    {
        return $this->resource(Resources\Mbkm::class);
    }

    /** Notifikasi: Kotak masuk, Notifikasi: Pengumuman, Notifikasi: Pemicu, Notifikasi: Preferensi, Notifikasi: Antrean (43 endpoint) */
    public function notif(): Resources\Notif
    {
        return $this->resource(Resources\Notif::class);
    }

    /** Obrolan, Obrolan: Perangkat & kunci, Obrolan: Ruang, Obrolan: Pesan, Obrolan: Privasi (39 endpoint) */
    public function obrolan(): Resources\Obrolan
    {
        return $this->resource(Resources\Obrolan::class);
    }

    /** Panitia: Kepanitiaan, Panitia: Persetujuan Pustikom, Panitia: Jenis panitia (26 endpoint) */
    public function panitia(): Resources\Panitia
    {
        return $this->resource(Resources\Panitia::class);
    }

    /** PDDikti: Pelaporan, PDDikti: Kirim dan sinkronisasi, PDDikti: Sinkronisasi otomatis, PDDikti: Relay Feeder Desktop, PDDikti: Evaluasi data (30 endpoint) */
    public function pddikti(): Resources\Pddikti
    {
        return $this->resource(Resources\Pddikti::class);
    }

    /** Pedoman & peraturan (49 endpoint) */
    public function pedoman(): Resources\Pedoman
    {
        return $this->resource(Resources\Pedoman::class);
    }

    /** Pemeriksa: Alur pemeriksa usulan (2 endpoint) */
    public function pemeriksa(): Resources\Pemeriksa
    {
        return $this->resource(Resources\Pemeriksa::class);
    }

    /** Event domain (7 endpoint) */
    public function peristiwa(): Resources\Peristiwa
    {
        return $this->resource(Resources\Peristiwa::class);
    }

    /** Perpustakaan: Katalog, Perpustakaan: Pengelolaan koleksi, Perpustakaan: Sirkulasi, Perpustakaan: Layanan anggota, Perpustakaan: Laporan dan integrasi, Perpustakaan: Layanan (46 endpoint) */
    public function perpustakaan(): Resources\Perpustakaan
    {
        return $this->resource(Resources\Perpustakaan::class);
    }

    /** Pimpinan: Bidang, Pimpinan: Arahan (25 endpoint) */
    public function pimpinan(): Resources\Pimpinan
    {
        return $this->resource(Resources\Pimpinan::class);
    }

    /** Plagiasi: Mahasiswa & pembimbing, Plagiasi: Unit pemeriksa (11 endpoint) */
    public function plagiasi(): Resources\Plagiasi
    {
        return $this->resource(Resources\Plagiasi::class);
    }

    /** PMB, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan (120 endpoint) */
    public function pmb(): Resources\Pmb
    {
        return $this->resource(Resources\Pmb::class);
    }

    /** Portal, Portal: kelola (148 endpoint) */
    public function portal(): Resources\Portal
    {
        return $this->resource(Resources\Portal::class);
    }

    /** Presensi QR: Peserta, Presensi QR: Sesi, Presensi QR: Izin, Presensi QR: Titik kerja (31 endpoint) */
    public function presensi(): Resources\Presensi
    {
        return $this->resource(Resources\Presensi::class);
    }

    /** Profil: Profil saya, Profil: Pemutakhiran saya, Profil: Akun saya, Profil: Pemutakhiran (unit pemilik data), Profil: Saya, Profil: Verifikasi, Profil: Riwayat, Profil: Dokumen, Profil: Permohonan perubahan data (119 endpoint) */
    public function profil(): Resources\Profil
    {
        return $this->resource(Resources\Profil::class);
    }

    /** QR: Generator, QR: Gaya (9 endpoint) */
    public function qr(): Resources\Qr
    {
        return $this->resource(Resources\Qr::class);
    }

    /** RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Penugasan otomatis SDM, RBAC: Masuk sebagai pengguna, RBAC: Klien API, RBAC: Log API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan (82 endpoint) */
    public function rbac(): Resources\Rbac
    {
        return $this->resource(Resources\Rbac::class);
    }

    /** Referensi (14 endpoint) */
    public function referensi(): Resources\Referensi
    {
        return $this->resource(Resources\Referensi::class);
    }

    /** Repositori: OAI-PMH, Repositori: Karya, Repositori: Koleksi (24 endpoint) */
    public function repositori(): Resources\Repositori
    {
        return $this->resource(Resources\Repositori::class);
    }

    /** RPL: Pemohon, RPL: Asesmen, RPL: Pengajuan, RPL: Master (84 endpoint) */
    public function rpl(): Resources\Rpl
    {
        return $this->resource(Resources\Rpl::class);
    }

    /** Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan (75 endpoint) */
    public function sarpras(): Resources\Sarpras
    {
        return $this->resource(Resources\Sarpras::class);
    }

    /** SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Penghasilan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: BKD, SDM: Usulan, SDM: Usulan pejabat, SDM: Aturan karier, SDM: PAK, SDM: Honor, SDM: SOP dan kebijakan, SDM: SISTER, SDM: Pegawai keluar (362 endpoint) */
    public function sdm(): Resources\Sdm
    {
        return $this->resource(Resources\Sdm::class);
    }

    /** Sistem: Log terpadu, Sistem: Tugas terjadwal (17 endpoint) */
    public function sistem(): Resources\Sistem
    {
        return $this->resource(Resources\Sistem::class);
    }

    /** SK: Registri (28 endpoint) */
    public function sk(): Resources\Sk
    {
        return $this->resource(Resources\Sk::class);
    }

    /** SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Pelaporan, SPMI: File (205 endpoint) */
    public function spmi(): Resources\Spmi
    {
        return $this->resource(Resources\Spmi::class);
    }

    /** Tugas akhir: Pengajuan judul, Tugas akhir: Validasi, Tugas akhir: Progres dan pengaturan, Ujian TA: Kelayakan & pengajuan, Ujian TA: Penjadwalan, Ujian TA: Penetapan SK Dekan, Ujian TA: Pelaksanaan & hasil (41 endpoint) */
    public function ta(): Resources\Ta
    {
        return $this->resource(Resources\Ta::class);
    }

    /** Tema (6 endpoint) */
    public function tema(): Resources\Tema
    {
        return $this->resource(Resources\Tema::class);
    }

    /** Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir, Tracer Study: publikasi (81 endpoint) */
    public function tracer(): Resources\Tracer
    {
        return $this->resource(Resources\Tracer::class);
    }

    /** Lulusan (1 endpoint) */
    public function wisuda(): Resources\Wisuda
    {
        return $this->resource(Resources\Wisuda::class);
    }
}
