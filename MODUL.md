<!-- Dibuat otomatis oleh generator/generate.mjs. Jangan diubah manual. -->
# Daftar modul

2008 endpoint dari SIAKAD UNIPO API 1.0.0, dikelompokkan per modul. Node.js: `siakad.<modul>.<metode>()`, PHP: `$siakad-><modul>()-><metode>()`.

Nama metode = `operationId` di dokumentasi API tanpa nama modul, mis. `GET /v1/lms/kelas/{id}` (operationId `getLmsKelasById`) menjadi `lms.getKelasById(id)`. Endpoint akar modul menjadi `list`/`create`/`update`/`replace`/`delete`.

| Modul | Kelompok di dokumentasi | Endpoint |
|---|---|---|
| `system` | Sistem | 3 |
| `apiPortal` | Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom | 18 |
| `arsip` | Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan | 123 |
| `cbt` | CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Koreksi dan hasil, CBT: Soal, CBT: Peserta, CBT: Ujian | 43 |
| `dasbor` | Dasbor: Ringkasan, Dasbor: Peringatan dini | 11 |
| `dosen` | Dosen, Jadwal | 4 |
| `fakultas` | Fakultas, Fakultas: kelola akademik | 45 |
| `helpdesk` | Helpdesk: Publik, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket | 25 |
| `humas` | Humas, Humas: redaksi | 53 |
| `induk` | Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Jabatan, Induk: Peran modul, Induk: Log audit | 38 |
| `integrasi` | Integrasi: Status, Integrasi: Pengaturan, Integrasi: Captcha, Integrasi: Pembayaran, Integrasi: Berkas, Integrasi: Cache, Integrasi: Email & WhatsApp, Integrasi: Webhook keluar, Integrasi: Rapat daring | 58 |
| `jadwal` | Jadwal, Presensi | 4 |
| `jadwalUjian` | Jadwal | 1 |
| `kalender` | Kalender: Terpadu, Kalender: Hari kerja, Kalender: Kegiatan | 14 |
| `karier` | Karier: Profil dan CV, Karier: Laporan, Karier: Lamaran, Karier: Acara | 51 |
| `kemahasiswaan` | Kemahasiswaan: Beasiswa, Kemahasiswaan: Organisasi, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran | 92 |
| `kerjasama` | Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi | 43 |
| `keu` | Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan | 61 |
| `keuangan` | Keuangan | 2 |
| `kurikulum` | Akademik | 1 |
| `kurikulumObe` | Kurikulum OBE, Kurikulum OBE: migrasi dari kurikulum lama, Kurikulum OBE: evaluasi & capaian, Kurikulum OBE: profil, CPL, bahan kajian, Kurikulum OBE: mata kuliah & CPMK, Kurikulum OBE: RPS | 67 |
| `layanan` | Layanan: Verifikasi dokumen, Layanan: Katalog, Layanan: Permohonan | 30 |
| `lingkungan` | Lingkungan data | 2 |
| `lms` | LMS: Beranda, LMS: Kelas, LMS: Konten, LMS: Kelas daring, LMS: File, LMS: Tugas, LMS: Kuis, LMS: Forum, LMS: Presensi, LMS: Nilai, LMS: Impor ke SIAKAD | 96 |
| `lppm` | LPPM: Umum, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: KKN, LPPM: File | 146 |
| `lulusan` | Lulusan | 1 |
| `mahasiswa` | Mahasiswa, KRS, Nilai, Jadwal, Presensi, Keuangan, Lulusan | 15 |
| `mataKuliah` | Akademik | 1 |
| `mbkm` | MBKM: Laporan, MBKM: Peserta, MBKM: Program, MBKM: Logbook, MBKM: Nilai dan konversi | 58 |
| `notif` | Notifikasi: Kotak masuk, Notifikasi: Preferensi, Notifikasi: Antrean, Notifikasi: Pengumuman | 22 |
| `pmb` | PMB, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan | 119 |
| `portal` | Portal, Portal: kelola | 138 |
| `rbac` | RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Klien API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan | 59 |
| `referensi` | Referensi | 14 |
| `repositori` | Repositori: OAI-PMH, Repositori: Karya, Repositori: Koleksi | 22 |
| `sarpras` | Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan | 67 |
| `sdm` | SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: Usulan | 189 |
| `spmi` | SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Pelaporan, SPMI: File | 196 |
| `tracer` | Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir | 75 |
| `wisuda` | Lulusan | 1 |
