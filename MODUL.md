<!-- Dibuat otomatis oleh generator/generate.mjs. Jangan diubah manual. -->
# Daftar modul

4671 endpoint dari SIAKAD UNIPO API 1.0.0, dikelompokkan per modul. Node.js: `siakad.<modul>.<metode>()`, PHP: `$siakad-><modul>()-><metode>()`.

Nama metode = `operationId` di dokumentasi API tanpa nama modul, mis. `GET /v1/lms/kelas/{id}` (operationId `getLmsKelasById`) menjadi `lms.getKelasById(id)`. Endpoint akar modul menjadi `list`/`create`/`update`/`replace`/`delete`.

| Modul | Kelompok di dokumentasi | Endpoint |
|---|---|---|
| `system` | Sistem | 4 |
| `acaraWisuda` | Wisuda: Acara, Wisuda: Hari-H | 21 |
| `admisi` | Admisi: Penerimaan, Admisi: Seleksi, Admisi: KIP Kuliah dan UKT, Admisi: Chat dan laporan, Admisi: Pendaftar, Admisi: Program studi | 87 |
| `akademik` | Akademik: Jadwal dan kelas, Akademik: Persetujuan KRS, Akademik: Nilai, Akademik: Batas waktu input, Akademik: Presensi dan jurnal, Akademik: Dokumen dan laporan, Akademik: Ujian, Akademik: Konversi dan riwayat nilai, Akademik: Pengajuan status, Akademik: Perbaikan nilai, Akademik: Sanggah nilai, Akademik: Periode, Akademik: Her-registrasi | 105 |
| `akun` | Akun pengguna | 23 |
| `apiPortal` | Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom | 22 |
| `arsip` | Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan | 124 |
| `aturan` | Aturan, Aturan: titik penerapan, Aturan: SK dan pengecualian, Aturan: pengatur dan pemeriksaan, Aturan: persetujuan, Aturan: dasar SK dan validator, Aturan: gerbang SK kebijakan unit, Aturan: kebijakan berakibat, Aturan: templat kasus (kanvas admin), Aturan: titik berbasis rute | 91 |
| `beasiswa` | Kemahasiswaan: Beasiswa | 20 |
| `berkas` | Berkas, Berkas: Unggah bertahap, Berkas: Folder, Berkas: Unit dan periode, Berkas: Berbagi, Berkas: Enkripsi, Penyimpanan, Penyimpanan: Unit, Penyimpanan: Pustikom | 63 |
| `biaya` | Biaya: Aturan, Biaya: Pembagian, Biaya: SK dan riwayat | 27 |
| `buktiSyarat` | Aturan: Bukti syarat | 6 |
| `cbt` | CBT: Nilai ke SIAKAD, CBT: Ujian percobaan, CBT: Koreksi dan hasil, CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Soal, CBT: Peserta, CBT: Ujian dari jadwal, CBT: Ujian | 56 |
| `crm` | CRM: Prospek, CRM: Skor dan segmen | 40 |
| `dasbor` | Dasbor: Ringkasan, Dasbor: Perkuliahan, Dasbor: Kehadiran, Dasbor: Outcome, Dasbor: Peringatan dini | 19 |
| `dokumen` | Dokumen: Templat, Dokumen: Templat Word, Dokumen: Terbitkan, Dokumen: Desain KTM, Dokumen: Arsip terbit, Dokumen: Verifikasi publik | 40 |
| `dosen` | Dosen, Jadwal | 4 |
| `edom` | EDOM: Soal, EDOM: Pengisian, EDOM: Hasil | 14 |
| `fakultas` | Fakultas, Fakultas: struktur organisasi, Fakultas: kelola akademik, Fakultas: identitas & usulan prodi | 126 |
| `gaji` | Gaji: Master, Gaji: Proses payroll, Gaji: Laporan, Gaji: Slip saya | 65 |
| `helpdesk` | Helpdesk: Publik, Helpdesk: Laporan bug, Helpdesk: Tiket saya, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket | 40 |
| `humas` | Humas, Humas: redaksi, Humas: Beasiswa | 78 |
| `iku` | IKU: Dasbor, IKU: Pengaturan, IKU: Bukti | 30 |
| `induk` | Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Organisasi & pejabat (Pustikom), Induk: Jabatan, Induk: Peran modul, Induk: Log audit | 80 |
| `infra` | Infra: Layanan, Infra: Gerbang API, Infra: Rahasia, Infra: Antrean | 48 |
| `integrasi` | Integrasi: Status, Integrasi: Pengaturan, Integrasi: Captcha, Integrasi: Pembayaran, Integrasi: Berkas, Integrasi: Cache, Integrasi: Email & WhatsApp, Integrasi: Webhook keluar, Integrasi: Rapat daring, Integrasi: Tanda tangan elektronik, Integrasi: AI | 66 |
| `jadwal` | Jadwal, Presensi | 4 |
| `jadwalUjian` | Jadwal | 1 |
| `kalender` | Kalender: Terpadu, Kalender: Hari kerja, Kalender: Periode, Kalender: Batas waktu, Kalender: Kunci periode, Kalender: Kunci fitur per periode, Kalender: Kegiatan | 49 |
| `karier` | Karier: Profil dan CV, Karier: Laporan, Karier: Rekomendasi, Karier: Mitra, Karier: Lamaran, Karier: Acara, Karier: Tips | 98 |
| `kasir` | Kasir: Sesi, Kasir: Pengaturan, Kasir: Penerimaan, Kasir: Laporan, Kasir: Pengaturan unit, Kasir: Migrasi aplikasi lama | 66 |
| `kelengkapan` | Kelengkapan data | 7 |
| `kelulusan` | Kelulusan: Yudisium, Kelulusan: Syarat, Kelulusan: Wisuda, Kelulusan: Ijazah dan sertifikat, Kelulusan: Poin dan SKPI | 83 |
| `kemahasiswaan` | Kemahasiswaan: Organisasi, Kemahasiswaan: Beasiswa, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran | 111 |
| `kerjasama` | Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi | 48 |
| `keu` | Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Buku besar, Keuangan: Kas, Keuangan: Laporan keuangan, Keuangan: Statistik, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan | 110 |
| `keuangan` | Keuangan, Keuangan: Keringanan dan beasiswa, Keuangan: Beasiswa, Keuangan: Tagihan, Keuangan: Tarif, Keuangan: Denda, Keuangan: Pembayaran dan kwitansi, Keuangan: Kasir, Keuangan: Refund dan deposit, Keuangan: Potongan, Keuangan: Rekonsiliasi dan laporan, Keuangan: Mahasiswa, Keuangan: Pengaturan, Keuangan: UKT, Keuangan: Dispensasi, Keuangan: Cicilan, Keuangan: Keuangan saya (mahasiswa), Keuangan: petunjuk bayar (BAUK) | 222 |
| `kurikulum` | Akademik | 1 |
| `kurikulumAturan` | Kurikulum: Aturan berversi, Kurikulum: Kerangka (data), Kurikulum: Perangkat MK, Kurikulum: Asesmen & RPS, Kurikulum: Pengajuan & validasi BAAK, Kurikulum: Evaluasi & peninjauan | 57 |
| `kurikulumObe` | Kurikulum OBE, Kurikulum OBE: migrasi dari kurikulum lama, Kurikulum OBE: evaluasi & capaian, Kurikulum OBE: profil, CPL, bahan kajian, Kurikulum OBE: mata kuliah & CPMK, Kurikulum OBE: RPS | 73 |
| `kwitansi` | Kwitansi: Pengaturan, Kwitansi: Terbit, Kwitansi: Verifikasi publik | 15 |
| `layanan` | Layanan: Verifikasi dokumen, Layanan: Katalog, Layanan: Permohonan | 33 |
| `lingkungan` | Lingkungan data | 2 |
| `lms` | LMS: Beranda, LMS: Kelas, LMS: Konten, LMS: Kelas terbuka, LMS: Analitik, LMS: Kelas daring, LMS: File, LMS: Tugas, LMS: Kuis, LMS: Forum, LMS: Presensi, LMS: Nilai, LMS: Impor ke SIAKAD | 108 |
| `lppm` | LPPM: Umum, LPPM: Tim LP2M, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: Kolaborasi, LPPM: Publikasi, LPPM: KKN, LPPM: File, LPPM: paket kebijakan hibah | 190 |
| `lulusan` | Lulusan | 1 |
| `mahasiswa` | Mahasiswa, KRS, Nilai, Jadwal, Presensi, Keuangan, Lulusan, Akademik: Sanggah nilai | 19 |
| `master` | Data master: Fakultas & prodi (BAAK), Data master: Struktur akademik, Data master: Mahasiswa dan dosen, Data master: Format dokumen akademik | 35 |
| `mataKuliah` | Akademik | 1 |
| `mbkm` | MBKM: Laporan, MBKM: Peserta, MBKM: Program, MBKM: Logbook, MBKM: Nilai dan konversi | 64 |
| `notif` | Notifikasi: Kotak masuk, Notifikasi: Realtime, Notifikasi: Pengumuman, Notifikasi: Pemicu, Notifikasi: Preferensi, Notifikasi: Antrean | 45 |
| `obrolan` | Obrolan, Obrolan: Perangkat & kunci, Obrolan: Ruang, Obrolan: Pesan, Obrolan: Privasi | 39 |
| `panitia` | Panitia: Kepanitiaan, Panitia: Persetujuan Pustikom, Panitia: Jenis panitia | 28 |
| `pddikti` | PDDikti: Pelaporan, PDDikti: Kirim dan sinkronisasi, PDDikti: Sinkronisasi otomatis, PDDikti: Relay Feeder Desktop, PDDikti: Evaluasi data | 30 |
| `pedoman` | Pedoman & peraturan | 49 |
| `pemeriksa` | Pemeriksa: Alur pemeriksa usulan | 2 |
| `pengembang` | Sistem: Log terpadu | 1 |
| `penyimpanan` | Penyimpanan, Penyimpanan: Unit, Penyimpanan: Pustikom | 19 |
| `peristiwa` | Event domain | 7 |
| `perpustakaan` | Perpustakaan: Katalog, Perpustakaan: Pengelolaan koleksi, Perpustakaan: Sirkulasi, Perpustakaan: Layanan anggota, Perpustakaan: Laporan dan integrasi, Perpustakaan: Layanan | 46 |
| `pimpinan` | Pimpinan: Bidang, Pimpinan: Pengesahan kurikulum, Pimpinan: Arahan | 28 |
| `plagiasi` | Plagiasi: Mahasiswa & pembimbing, Plagiasi: Unit pemeriksa | 11 |
| `pmb` | PMB, PMB: kebijakan kelulusan seleksi, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan | 145 |
| `portal` | Portal, Portal: kelola | 148 |
| `presensi` | Presensi QR: Peserta, Presensi QR: Sesi, Presensi QR: Izin, Presensi QR: Titik kerja | 31 |
| `profil` | Profil: Profil saya, Profil: Pemutakhiran saya, Profil: Akun saya, Profil: Pemutakhiran (unit pemilik data), Profil: Saya, Profil: Verifikasi, Profil: Riwayat, Profil: Dokumen, Profil: Permohonan perubahan data | 124 |
| `qr` | QR: Generator, QR: Gaya | 9 |
| `rbac` | RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Penugasan otomatis SDM, RBAC: Masuk sebagai pengguna, RBAC: Klien API, RBAC: Log API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan | 90 |
| `referensi` | Referensi | 15 |
| `repositori` | Repositori: OAI-PMH, Repositori: Karya, Repositori: Koleksi | 24 |
| `rpl` | RPL: Pemohon, RPL: Asesmen, RPL: Pengajuan, RPL: Master | 85 |
| `sarpras` | Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan | 75 |
| `sdm` | SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Penghasilan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: BKD, SDM: Usulan, SDM: Usulan pejabat, SDM: Aturan karier, SDM: DUPAK, SDM: SKP, SDM: PAK, SDM: Honor, SDM: SOP dan kebijakan, SDM: SISTER, SDM: Pegawai keluar | 421 |
| `sistem` | Sistem: Log terpadu, Sistem: Tugas terjadwal | 22 |
| `sk` | SK: Registri | 29 |
| `spmi` | SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: aturan IKU 1, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Usulan akreditasi prodi, SPMI: Kelengkapan akreditasi, SPMI: Pelaporan, SPMI: File | 278 |
| `surel` | Templat email | 8 |
| `syaratKeuangan` | Keuangan: Validasi syarat | 13 |
| `ta` | Tugas akhir: Pengajuan judul, Tugas akhir: Validasi, Tugas akhir: Progres dan pengaturan, Ujian TA: Kelayakan & pengajuan, Ujian TA: Penjadwalan, Ujian TA: Pelaksanaan & hasil, Ujian TA: Penetapan SK Dekan | 44 |
| `tema` | Tema, Tema: Halaman landing, Tema: Kerangka situs | 20 |
| `tracer` | Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir, Tracer Study: publikasi, Tracer Study: aturan IKU 1 | 87 |
| `wisuda` | Lulusan | 1 |
