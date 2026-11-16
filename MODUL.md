<!-- Dibuat otomatis oleh generator/generate.mjs. Jangan diubah manual. -->
# Daftar modul

3241 endpoint dari SIAKAD UNIPO API 1.0.0, dikelompokkan per modul. Node.js: `siakad.<modul>.<metode>()`, PHP: `$siakad-><modul>()-><metode>()`.

Nama metode = `operationId` di dokumentasi API tanpa nama modul, mis. `GET /v1/lms/kelas/{id}` (operationId `getLmsKelasById`) menjadi `lms.getKelasById(id)`. Endpoint akar modul menjadi `list`/`create`/`update`/`replace`/`delete`.

| Modul | Kelompok di dokumentasi | Endpoint |
|---|---|---|
| `system` | Sistem | 3 |
| `admisi` | Admisi: Penerimaan, Admisi: Seleksi, Admisi: KIP Kuliah dan UKT, Admisi: Chat dan laporan, Admisi: Pendaftar, Admisi: Program studi | 78 |
| `akademik` | Akademik: Jadwal dan kelas, Akademik: Persetujuan KRS, Akademik: Nilai, Akademik: Batas waktu input, Akademik: Presensi dan jurnal, Akademik: Dokumen dan laporan, Akademik: Pengajuan status | 55 |
| `apiPortal` | Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom | 18 |
| `arsip` | Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan | 124 |
| `aturan` | Aturan, Aturan: pengatur dan pemeriksaan, Aturan: SK dan pengecualian | 22 |
| `berkas` | Berkas, Berkas: Unggah bertahap, Berkas: Folder, Berkas: Unit dan periode, Berkas: Berbagi, Berkas: Enkripsi | 39 |
| `cbt` | CBT: Nilai ke SIAKAD, CBT: Ujian percobaan, CBT: Koreksi dan hasil, CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Soal, CBT: Peserta, CBT: Ujian | 50 |
| `crm` | CRM: Prospek, CRM: Skor dan segmen | 35 |
| `dasbor` | Dasbor: Ringkasan, Dasbor: Perkuliahan, Dasbor: Kehadiran, Dasbor: Outcome, Dasbor: Peringatan dini | 16 |
| `dokumen` | Dokumen: Templat, Dokumen: Terbitkan, Dokumen: Arsip terbit, Dokumen: Verifikasi publik | 21 |
| `dosen` | Dosen, Jadwal | 4 |
| `edom` | EDOM: Soal, EDOM: Pengisian, EDOM: Hasil | 14 |
| `fakultas` | Fakultas, Fakultas: kelola akademik | 53 |
| `gaji` | Gaji: Master, Gaji: Proses payroll, Gaji: Laporan, Gaji: Slip saya | 57 |
| `helpdesk` | Helpdesk: Publik, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket | 25 |
| `humas` | Humas, Humas: redaksi | 53 |
| `iku` | IKU: Dasbor, IKU: Pengaturan, IKU: Bukti | 27 |
| `induk` | Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Jabatan, Induk: Peran modul, Induk: Log audit | 38 |
| `infra` | Infra: Layanan, Infra: Gerbang API, Infra: Rahasia, Infra: Antrean | 48 |
| `integrasi` | Integrasi: Status, Integrasi: Pengaturan, Integrasi: Captcha, Integrasi: Pembayaran, Integrasi: Berkas, Integrasi: Cache, Integrasi: Email & WhatsApp, Integrasi: Webhook keluar, Integrasi: Rapat daring, Integrasi: Tanda tangan elektronik, Integrasi: AI | 66 |
| `jadwal` | Jadwal, Presensi | 4 |
| `jadwalUjian` | Jadwal | 1 |
| `kalender` | Kalender: Terpadu, Kalender: Hari kerja, Kalender: Kegiatan | 14 |
| `karier` | Karier: Profil dan CV, Karier: Laporan, Karier: Rekomendasi, Karier: Mitra, Karier: Lamaran, Karier: Acara, Karier: Tips | 89 |
| `kasir` | Kasir: Sesi, Kasir: Pengaturan, Kasir: Penerimaan, Kasir: Laporan, Kasir: Migrasi aplikasi lama | 27 |
| `kelengkapan` | Kelengkapan data | 7 |
| `kelulusan` | Kelulusan: Yudisium, Kelulusan: Syarat, Kelulusan: Wisuda, Kelulusan: Ijazah dan sertifikat, Kelulusan: Poin dan SKPI | 76 |
| `kemahasiswaan` | Kemahasiswaan: Beasiswa, Kemahasiswaan: Organisasi, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran | 92 |
| `kerjasama` | Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi | 43 |
| `keu` | Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Buku besar, Keuangan: Kas, Keuangan: Laporan keuangan, Keuangan: Statistik, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan | 96 |
| `keuangan` | Keuangan, Keuangan: Tagihan, Keuangan: Tarif, Keuangan: Denda, Keuangan: Pembayaran dan kwitansi, Keuangan: Kasir, Keuangan: Refund dan deposit, Keuangan: Potongan, Keuangan: Rekonsiliasi dan laporan, Keuangan: Mahasiswa, Keuangan: Pengaturan, Keuangan: UKT, Keuangan: Dispensasi, Keuangan: Cicilan, Keuangan: Keringanan dan beasiswa | 151 |
| `kurikulum` | Akademik | 1 |
| `kurikulumObe` | Kurikulum OBE, Kurikulum OBE: migrasi dari kurikulum lama, Kurikulum OBE: evaluasi & capaian, Kurikulum OBE: profil, CPL, bahan kajian, Kurikulum OBE: mata kuliah & CPMK, Kurikulum OBE: RPS | 67 |
| `layanan` | Layanan: Verifikasi dokumen, Layanan: Katalog, Layanan: Permohonan | 30 |
| `lingkungan` | Lingkungan data | 2 |
| `lms` | LMS: Beranda, LMS: Kelas, LMS: Konten, LMS: Kelas terbuka, LMS: Analitik, LMS: Kelas daring, LMS: File, LMS: Tugas, LMS: Kuis, LMS: Forum, LMS: Presensi, LMS: Nilai, LMS: Impor ke SIAKAD | 104 |
| `lppm` | LPPM: Umum, LPPM: Tim LP2M, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: Kolaborasi, LPPM: Publikasi, LPPM: KKN, LPPM: File | 163 |
| `lulusan` | Lulusan | 1 |
| `mahasiswa` | Mahasiswa, KRS, Nilai, Jadwal, Presensi, Keuangan, Lulusan | 15 |
| `master` | Data master: Struktur akademik, Data master: Mahasiswa dan dosen, Data master: Format dokumen akademik | 25 |
| `mataKuliah` | Akademik | 1 |
| `mbkm` | MBKM: Laporan, MBKM: Peserta, MBKM: Program, MBKM: Logbook, MBKM: Nilai dan konversi | 58 |
| `notif` | Notifikasi: Kotak masuk, Notifikasi: Preferensi, Notifikasi: Antrean, Notifikasi: Pengumuman | 22 |
| `obrolan` | Obrolan, Obrolan: Perangkat & kunci, Obrolan: Ruang, Obrolan: Pesan, Obrolan: Privasi | 31 |
| `pddikti` | PDDikti: Pelaporan, PDDikti: Kirim dan sinkronisasi, PDDikti: Sinkronisasi otomatis, PDDikti: Relay Feeder Desktop, PDDikti: Evaluasi data | 29 |
| `peristiwa` | Event domain | 7 |
| `perpustakaan` | Perpustakaan: Katalog, Perpustakaan: Pengelolaan koleksi, Perpustakaan: Sirkulasi, Perpustakaan: Layanan anggota, Perpustakaan: Laporan dan integrasi, Perpustakaan: Layanan | 44 |
| `pmb` | PMB, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan | 120 |
| `portal` | Portal, Portal: kelola | 138 |
| `presensi` | Presensi QR: Peserta, Presensi QR: Sesi, Presensi QR: Izin, Presensi QR: Titik kerja | 31 |
| `profil` | Profil: Saya, Profil: Verifikasi, Profil: Riwayat, Profil: Dokumen, Profil: Permohonan perubahan data | 87 |
| `qr` | QR: Generator, QR: Gaya | 9 |
| `rbac` | RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Masuk sebagai pengguna, RBAC: Klien API, RBAC: Log API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan | 70 |
| `referensi` | Referensi | 14 |
| `repositori` | Repositori: OAI-PMH, Repositori: Karya, Repositori: Koleksi | 22 |
| `rpl` | RPL: Pemohon, RPL: Asesmen, RPL: Pengajuan, RPL: Master | 75 |
| `sarpras` | Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan | 68 |
| `sdm` | SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Penghasilan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: Usulan, SDM: PAK, SDM: Honor, SDM: SOP dan kebijakan, SDM: SISTER | 254 |
| `spmi` | SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Pelaporan, SPMI: File | 205 |
| `ta` | Tugas akhir: Pengajuan judul, Tugas akhir: Validasi, Tugas akhir: Progres dan pengaturan | 15 |
| `tema` | Tema | 6 |
| `tracer` | Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir, Tracer Study: publikasi | 80 |
| `wisuda` | Lulusan | 1 |
