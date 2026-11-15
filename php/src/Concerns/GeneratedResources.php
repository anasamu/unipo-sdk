<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Concerns;

use Unipo\Siakad\Resources;

/**
 * Akses ke semua modul API (2984 endpoint).
 */
trait GeneratedResources
{
    /** Sistem (3 endpoint) */
    public function system(): Resources\System
    {
        return $this->resource(Resources\System::class);
    }

    /** Admisi: Penerimaan, Admisi: Seleksi, Admisi: KIP Kuliah dan UKT, Admisi: Chat dan laporan, Admisi: Pendaftar, Admisi: Program studi (68 endpoint) */
    public function admisi(): Resources\Admisi
    {
        return $this->resource(Resources\Admisi::class);
    }

    /** Akademik: Jadwal dan kelas, Akademik: Persetujuan KRS, Akademik: Nilai, Akademik: Batas waktu input, Akademik: Presensi dan jurnal, Akademik: Dokumen dan laporan, Akademik: Pengajuan status (51 endpoint) */
    public function akademik(): Resources\Akademik
    {
        return $this->resource(Resources\Akademik::class);
    }

    /** Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom (18 endpoint) */
    public function apiPortal(): Resources\ApiPortal
    {
        return $this->resource(Resources\ApiPortal::class);
    }

    /** Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan (123 endpoint) */
    public function arsip(): Resources\Arsip
    {
        return $this->resource(Resources\Arsip::class);
    }

    /** Aturan, Aturan: pengatur dan pemeriksaan, Aturan: SK dan pengecualian (22 endpoint) */
    public function aturan(): Resources\Aturan
    {
        return $this->resource(Resources\Aturan::class);
    }

    /** Berkas, Berkas: Unggah bertahap, Berkas: Folder (24 endpoint) */
    public function berkas(): Resources\Berkas
    {
        return $this->resource(Resources\Berkas::class);
    }

    /** CBT: Nilai ke SIAKAD, CBT: Ujian percobaan, CBT: Koreksi dan hasil, CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Soal, CBT: Peserta, CBT: Ujian (50 endpoint) */
    public function cbt(): Resources\Cbt
    {
        return $this->resource(Resources\Cbt::class);
    }

    /** CRM: Prospek, CRM: Skor dan segmen (35 endpoint) */
    public function crm(): Resources\Crm
    {
        return $this->resource(Resources\Crm::class);
    }

    /** Dasbor: Ringkasan, Dasbor: Perkuliahan, Dasbor: Kehadiran, Dasbor: Outcome, Dasbor: Peringatan dini (16 endpoint) */
    public function dasbor(): Resources\Dasbor
    {
        return $this->resource(Resources\Dasbor::class);
    }

    /** Dokumen: Templat, Dokumen: Terbitkan, Dokumen: Arsip terbit, Dokumen: Verifikasi publik (21 endpoint) */
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

    /** Fakultas, Fakultas: kelola akademik (47 endpoint) */
    public function fakultas(): Resources\Fakultas
    {
        return $this->resource(Resources\Fakultas::class);
    }

    /** Helpdesk: Publik, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket (25 endpoint) */
    public function helpdesk(): Resources\Helpdesk
    {
        return $this->resource(Resources\Helpdesk::class);
    }

    /** Humas, Humas: redaksi (53 endpoint) */
    public function humas(): Resources\Humas
    {
        return $this->resource(Resources\Humas::class);
    }

    /** IKU: Dasbor, IKU: Pengaturan, IKU: Bukti (27 endpoint) */
    public function iku(): Resources\Iku
    {
        return $this->resource(Resources\Iku::class);
    }

    /** Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Jabatan, Induk: Peran modul, Induk: Log audit (38 endpoint) */
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

    /** Kalender: Terpadu, Kalender: Hari kerja, Kalender: Kegiatan (14 endpoint) */
    public function kalender(): Resources\Kalender
    {
        return $this->resource(Resources\Kalender::class);
    }

    /** Karier: Profil dan CV, Karier: Laporan, Karier: Rekomendasi, Karier: Mitra, Karier: Lamaran, Karier: Acara, Karier: Tips (89 endpoint) */
    public function karier(): Resources\Karier
    {
        return $this->resource(Resources\Karier::class);
    }

    /** Kelengkapan data (7 endpoint) */
    public function kelengkapan(): Resources\Kelengkapan
    {
        return $this->resource(Resources\Kelengkapan::class);
    }

    /** Kelulusan: Yudisium, Kelulusan: Syarat, Kelulusan: Wisuda, Kelulusan: Ijazah dan sertifikat, Kelulusan: Poin dan SKPI (76 endpoint) */
    public function kelulusan(): Resources\Kelulusan
    {
        return $this->resource(Resources\Kelulusan::class);
    }

    /** Kemahasiswaan: Beasiswa, Kemahasiswaan: Organisasi, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran (92 endpoint) */
    public function kemahasiswaan(): Resources\Kemahasiswaan
    {
        return $this->resource(Resources\Kemahasiswaan::class);
    }

    /** Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi (43 endpoint) */
    public function kerjasama(): Resources\Kerjasama
    {
        return $this->resource(Resources\Kerjasama::class);
    }

    /** Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan (62 endpoint) */
    public function keu(): Resources\Keu
    {
        return $this->resource(Resources\Keu::class);
    }

    /** Keuangan, Keuangan: Tagihan, Keuangan: Tarif, Keuangan: Denda, Keuangan: Pembayaran dan kwitansi, Keuangan: Kasir, Keuangan: Refund dan deposit, Keuangan: Potongan, Keuangan: Rekonsiliasi dan laporan, Keuangan: Mahasiswa, Keuangan: Pengaturan, Keuangan: UKT, Keuangan: Dispensasi, Keuangan: Cicilan (115 endpoint) */
    public function keuangan(): Resources\Keuangan
    {
        return $this->resource(Resources\Keuangan::class);
    }

    /** Akademik (1 endpoint) */
    public function kurikulum(): Resources\Kurikulum
    {
        return $this->resource(Resources\Kurikulum::class);
    }

    /** Kurikulum OBE, Kurikulum OBE: migrasi dari kurikulum lama, Kurikulum OBE: evaluasi & capaian, Kurikulum OBE: profil, CPL, bahan kajian, Kurikulum OBE: mata kuliah & CPMK, Kurikulum OBE: RPS (67 endpoint) */
    public function kurikulumObe(): Resources\KurikulumObe
    {
        return $this->resource(Resources\KurikulumObe::class);
    }

    /** Layanan: Verifikasi dokumen, Layanan: Katalog, Layanan: Permohonan (30 endpoint) */
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

    /** LPPM: Umum, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: Kolaborasi, LPPM: Publikasi, LPPM: KKN, LPPM: File (157 endpoint) */
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

    /** MBKM: Laporan, MBKM: Peserta, MBKM: Program, MBKM: Logbook, MBKM: Nilai dan konversi (58 endpoint) */
    public function mbkm(): Resources\Mbkm
    {
        return $this->resource(Resources\Mbkm::class);
    }

    /** Notifikasi: Kotak masuk, Notifikasi: Preferensi, Notifikasi: Antrean, Notifikasi: Pengumuman (22 endpoint) */
    public function notif(): Resources\Notif
    {
        return $this->resource(Resources\Notif::class);
    }

    /** Obrolan, Obrolan: Perangkat & kunci, Obrolan: Ruang, Obrolan: Pesan, Obrolan: Privasi (29 endpoint) */
    public function obrolan(): Resources\Obrolan
    {
        return $this->resource(Resources\Obrolan::class);
    }

    /** PDDikti: Pelaporan, PDDikti: Kirim dan sinkronisasi, PDDikti: Sinkronisasi otomatis, PDDikti: Evaluasi data (25 endpoint) */
    public function pddikti(): Resources\Pddikti
    {
        return $this->resource(Resources\Pddikti::class);
    }

    /** Event domain (7 endpoint) */
    public function peristiwa(): Resources\Peristiwa
    {
        return $this->resource(Resources\Peristiwa::class);
    }

    /** Perpustakaan: Katalog, Perpustakaan: Pengelolaan koleksi, Perpustakaan: Sirkulasi, Perpustakaan: Layanan anggota, Perpustakaan: Laporan dan integrasi, Perpustakaan: Layanan (44 endpoint) */
    public function perpustakaan(): Resources\Perpustakaan
    {
        return $this->resource(Resources\Perpustakaan::class);
    }

    /** PMB, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan (120 endpoint) */
    public function pmb(): Resources\Pmb
    {
        return $this->resource(Resources\Pmb::class);
    }

    /** Portal, Portal: kelola (138 endpoint) */
    public function portal(): Resources\Portal
    {
        return $this->resource(Resources\Portal::class);
    }

    /** Presensi QR: Peserta, Presensi QR: Sesi, Presensi QR: Izin, Presensi QR: Titik kerja (31 endpoint) */
    public function presensi(): Resources\Presensi
    {
        return $this->resource(Resources\Presensi::class);
    }

    /** Profil: Saya, Profil: Verifikasi, Profil: Riwayat, Profil: Dokumen, Profil: Permohonan perubahan data (87 endpoint) */
    public function profil(): Resources\Profil
    {
        return $this->resource(Resources\Profil::class);
    }

    /** QR: Generator, QR: Gaya (9 endpoint) */
    public function qr(): Resources\Qr
    {
        return $this->resource(Resources\Qr::class);
    }

    /** RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Klien API, RBAC: Log API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan (62 endpoint) */
    public function rbac(): Resources\Rbac
    {
        return $this->resource(Resources\Rbac::class);
    }

    /** Referensi (14 endpoint) */
    public function referensi(): Resources\Referensi
    {
        return $this->resource(Resources\Referensi::class);
    }

    /** Repositori: OAI-PMH, Repositori: Karya, Repositori: Koleksi (22 endpoint) */
    public function repositori(): Resources\Repositori
    {
        return $this->resource(Resources\Repositori::class);
    }

    /** RPL: Pemohon, RPL: Asesmen, RPL: Pengajuan, RPL: Master (75 endpoint) */
    public function rpl(): Resources\Rpl
    {
        return $this->resource(Resources\Rpl::class);
    }

    /** Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan (67 endpoint) */
    public function sarpras(): Resources\Sarpras
    {
        return $this->resource(Resources\Sarpras::class);
    }

    /** SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: Usulan, SDM: PAK, SDM: Honor, SDM: SISTER (228 endpoint) */
    public function sdm(): Resources\Sdm
    {
        return $this->resource(Resources\Sdm::class);
    }

    /** SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Pelaporan, SPMI: File (200 endpoint) */
    public function spmi(): Resources\Spmi
    {
        return $this->resource(Resources\Spmi::class);
    }

    /** Tema (6 endpoint) */
    public function tema(): Resources\Tema
    {
        return $this->resource(Resources\Tema::class);
    }

    /** Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir, Tracer Study: publikasi (80 endpoint) */
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
