# Catatan rilis SDK

Versi paket PHP (`unipo/siakad-sdk`) dan Node.js (`unipo-siakad-sdk`) selalu sama dan dirilis bersamaan.

## 2.0.0 (2026-11-22)

- Registri SK tunggal (/v1/sk, SIAKAD docs/SK.md): klien bertipe registriSK(siakad) di Node (cari, periksa nomor ganda, detail, catat/ajukan pencatatan, catatAtauPakai, ubah, verifikasi, cabut, gabung, penerbit, penandatangan, urlBerkas sementara, dariSurat) dan siakad.sk.* / $siakad->sk() (13 operasi; tipe SkRegistri, SkDetail, SkCatat, SkPeriksa, SkPenerbit, SkPenandatangan). Modul lain merujuk SK lewat sk_id.
- Penandatangan SK tanpa ketergantungan melingkar: `registriSK().bawaan()` (penerbit/perihal/penandatangan bawaan menurut jenis SK dan jabatan yang diangkat), `jabatanPenandatangan()`; tipe `PenandatanganSK` (`tautan`: pejabat, jabatan, teks), `JabatanPenandatanganSK`, `BawaanSK`; `SkCatat` menerima `penandatangan_jabatan_id`/`penandatangan_unit_id` atau teks jabatan + nama.
- Profil Yayasan dan kewenangan penerbitan SK: `registriSK().yayasan()`, `simpanYayasan()`, `kewenangan()`, `simpanKewenangan()` (tipe `ProfilYayasan`, `PengurusYayasan`, `KewenanganSK`); `aturan.list({ tanpa_sk: 1 })` untuk aturan bawaan aktif tanpa SK.
- Spesifikasi diperbarui dari SIAKAD gabungan dev (branch claude/project-thread-asy9g9-dev + -sk-tunggal): 112 operasi baru, 0 hilang (total 3785). Selain /v1/sk: periode dan tahapan kalender (/v1/kalender/periode*, /v1/kalender/status, /v1/kalender/batas*), organisasi & pejabat Pustikom (/v1/induk/organisasi*), dan tambahan akademik/fakultas dari branch yang belum di-merge; rilis setelah branch-branch itu masuk main.
- Spesifikasi diperbarui dari SIAKAD: 96 operasi baru, 0 operasi hilang (total 3881).
- Spesifikasi diperbarui dari SIAKAD: 214 operasi baru, 0 operasi hilang (total 4095).
- Spesifikasi diperbarui dari SIAKAD: 316 operasi baru, 0 operasi hilang (total 4411).
- Spesifikasi diperbarui dari SIAKAD main 92a7efa5 (+ skema PmbTugasPanitia dari fix/katalog): 206 operasi baru, 1 operasi hilang (DELETE /v1/pimpinan/arahan/{id}, diganti POST /v1/pimpinan/arahan/{id}/batalkan; tidak dipakai aplikasi mana pun). Total 4616. Generator: $ref ke skema yang tidak ada dipetakan ke JsonObject (dengan peringatan) agar typecheck tidak gagal.

## 1.19.0 (belum dirilis)

- Log terpadu semua proses untuk Pustikom: `logSistem(siakad)` bertipe (`daftar` dengan paginasi kursor, `semua`, `detail`, `sumber`, `ringkasan`, `eksporCsv`) dan tipe `BarisLog`, `DetailLog`, `SumberLog`, `RingkasanLog`, `SaringanLog`. Endpoint mentah juga tersedia di `siakad.sistem.*` (GET /v1/sistem/log, /sumber, /ringkasan, /ekspor, /{sumber}/{id}); hak izin `pustikom.log`.
- Tugas terjadwal (penjadwal SIAKAD): `siakad.sistem.*` untuk /v1/sistem/jadwal (status penjadwal, daftar tugas, ubah, jalankan, hentikan, riwayat jalan); 9 operasi baru.
- Spesifikasi diperbarui dari SIAKAD: 14 operasi baru dibanding 1.18.0 (semuanya /v1/sistem/log dan /v1/sistem/jadwal), 0 operasi hilang (total 3673).

## 1.18.0 (belum dirilis)

- Spesifikasi diperbarui dari SIAKAD: 54 operasi baru, 0 operasi hilang (total 3659). Di antaranya pengumuman lintas aplikasi (/v1/notif/pita: tayang, tutup, kelola, hak, tautan konten portal, perkiraan penerima), pemicu notifikasi per peran/unit (/v1/notif/pemicu), obrolan (foto grup, bersihkan, hapus obrolan, hapus untuk saya, pindah ke enkripsi server), daftar pegawai ringkas untuk gaji/honor (/v1/gaji/pegawai), pengaturan dan statistik honor (/v1/sdm/honor), tunjangan jabatan (/v1/sdm/master/jabatan/{id}/tunjangan); scope honor kini gaji:*.

## 1.17.0 (2026-11-17)

- Spesifikasi diperbarui dari SIAKAD: 57 operasi baru, 0 operasi hilang (total 3605).

## 1.16.0 (2026-11-17)

- Spesifikasi diperbarui dari SIAKAD: 1 operasi baru, 0 operasi hilang (total 3548).

## 1.15.0 (2026-11-17)

- Spesifikasi diperbarui dari SIAKAD: 21 operasi baru, 0 operasi hilang (total 3547).

## 1.14.0 (2026-11-16)

- Presensi kerja berbasis lokasi (/v1/sdm/presensi, 17 operasi baru): layar hari-ini untuk web/mobile, catat dengan bukti lokasi (akurasi, lokasi palsu, perangkat, swafoto, kunci idempoten), percobaan + tinjauan, peta kehadiran, area presensi (radius/poligon/jaringan), jadwal kerja dan shift, penugasan, perangkat, dan koreksi. Pembantu Node: `cocokkanArea`, `jarakMeter`, `catatPresensiKerja`, `KODE_GALAT_PRESENSI`, tipe `PresensiHariIni`.
- Spesifikasi disamakan dengan `main` SIAKAD: modul `panitia` dan tambahan lain dari main ikut masuk.

## 1.13.0 (2026-11-16)

- Modul baru `akun` (/v1/akun, 13 operasi): kelola akun pengguna SIAKAD dari Pustikom, SDM, dan BAAK. Daftar dan ringkasan akun, orang yang belum punya akun (dosen, tendik, mahasiswa, pendaftar), buat akun satu per satu atau massal (password bawaan lama, acak, atau manual), buat akun dari pegawai SDM (`postPegawaiById`), ubah level/email, aktifkan/nonaktifkan, reset password, dan log kelola akun.
- Spesifikasi disamakan dengan `main` SIAKAD: modul `pimpinan` (dasbor pimpinan), tambahan `kurikulumObe`, dan pilihan lingkungan di `rbac` (masuk sebagai pengguna) ikut masuk.

## 1.12.1 (2026-11-16)

- Galat pemeliharaan (503 pemeliharaan) tanpa coba ulang (#16)

## 1.12.0 (2026-11-16)

- Modul baru `biaya` (/v1/biaya, 27 operasi): aturan biaya (UKT, gedung, ujian, formulir PMB) dengan komponen pembagian (yayasan, rektor, fakultas, prodi, unit, pegawai; persen/nominal/sisa), alur ajukan/setujui/tolak/kembalikan/nonaktifkan/revisi, lampiran SK dari storage, riwayat versi, periksa klop, simulasi, rekap pembagian per penerima, rincian, ringkasan, dan pencairan.

## 1.11.0 (2026-11-16)

- Spesifikasi diperbarui dari SIAKAD: 5 operasi baru, 0 operasi hilang (total 3248).

## 1.10.0 (2026-11-16)

- Cek jadwal bentrok dan jadwal otomatis: akademik/fakultas getJadwalBentrok, postJadwalCek, postJadwalOtomatis, postJadwalOtomatisSimpan (+ tipe JadwalTemuan, JadwalUsulan, ...); ikut endpoint SIAKAD terbaru (kasir, obrolan, pddikti, rbac).

## 1.9.0 (2026-11-16)

- Berkas: ruang unit, periode, salin, berbagi, enkripsi (#13)

## 1.8.0 (2026-11-16)

- Spesifikasi diperbarui dari SIAKAD: 187 operasi baru, 0 operasi hilang (total 3176).

## 1.6.0 (2026-11-15)

- Modul baru `presensi` (/v1/presensi, 31 operasi): presensi QR kuliah (disahkan ke presensi SIAKAD dan kelas LMS), kegiatan, dan titik kerja dosen/tendik (ke presensi SDM). Sesi (buat, buka, tutup, sahkan, batal, kode cadangan), QR berganti (`getSesiByIdQr`, `getTitikByIdQr`, `getKartu`), pindai (`postPindai`, `postSesiByIdPindaiKartu`), peserta dan koreksi status, tanda curiga, jejak pindaian, izin/sakit dengan surat, titik kerja. Butuh SIAKAD yang sudah memuat modul Presensi.
- Operasi baru `fakultas.getByKodeAksesCalon` (calon penerima peran dasbor fakultas).
- Spesifikasi diperbarui dari SIAKAD terbaru: 61 modul, 2.982 operasi. Tidak ada operasi yang dihapus.

## 1.7.0 (2026-11-16)

- Modul baru `qr` (/v1/qr, 9 operasi): generator kode QR modern (warna, gradasi, bentuk modul dan mata, logo, bingkai teks), gaya tersimpan per bagian, PNG bisa disimpan ke berkas terpusat. Butuh SIAKAD yang sudah memuat modul Qr.
- Modul baru `dokumen` (/v1/dokumen, 21 operasi): templat dokumen per bagian (kertas, kop surat, tanda tangan, QR), penerbitan PDF KRS/KHS/transkrip/kwitansi/surat keluar/dokumen bebas, arsip terbit, dan verifikasi publik (kode dan pencocokan file PDF).
- Pembantu: `qrSvg()`, `qrPng()`, `cocokkanPdf()`, `kodeDariQr()`, `formatKode()` (Node.js); `Unipo\Siakad\Dokumen\KodeVerifikasi::dariQr()` dan `::format()` (PHP).
- Spesifikasi diperbarui dari SIAKAD terbaru: 60 modul, 2.950 operasi (termasuk modul `tema`). Tidak ada operasi yang dihapus.
- Spesifikasi diperbarui dari SIAKAD: 2 operasi baru, 0 operasi hilang (total 2989).

## 1.4.0 (2026-11-15)

- Modul baru `aturan` (/v1/aturan, 22 operasi): aturan akademik/keuangan dinamis (katalog titik dan indikator, CRUD, aktifkan dengan SK, pengecualian, pengatur, periksa/uji). Butuh SIAKAD yang sudah memuat modul Aturan.
- Galat baru `AturanDilanggarError` (Node.js) dan `AturanDilanggarException` (PHP) untuk 409 `aturan_dilanggar`: turunan galat 409 yang sudah ada, dengan `titik`, `pelanggaran` (pesan per aturan), dan `batas`.
- Spesifikasi diperbarui dari SIAKAD terbaru: 57 modul, 2.914 operasi (operasi baru juga di `berkas` folder/pindah/pulihkan, `infra`, dan lainnya). Tidak ada operasi yang dihapus.

## 1.3.1 (2026-11-15)

- Pembantu microservices: verifikasiGerbang, konsumsiAntrean, muatRahasia, terbitkanEvent (#7)

## 1.3.0

- Modul baru `peristiwa` (/v1/peristiwa, 7 operasi): katalog event domain lintas modul, peta alur bisnis, outbox dan kirim ulang (admin). Butuh SIAKAD yang sudah memuat modul Peristiwa.
- Penerima webhook: `verifikasiWebhook({ body, tandaTangan, rahasia })` dan `tandaTanganWebhook()` (Node.js), `Unipo\Siakad\Webhook\Webhook::verifikasi()` (PHP). Memeriksa `X-Siakad-Signature` (HMAC-SHA256, toleransi 5 menit) dan mengembalikan isi pesan; tipe `PesanWebhook`, `AmplopPeristiwa`, `MetaPeristiwa`.
- Spesifikasi diperbarui dari SIAKAD terbaru: 54 modul, 2.805 operasi (termasuk parameter `berkas_id` di endpoint unggah modul).

## 1.2.0 (2026-11-15)

- Modul baru `berkas` (/v1/berkas, 14 operasi): unggah dan unduh berkas terpusat untuk semua aplikasi, disimpan di penyimpanan yang aktif di menu Integrasi (S3, R2, MinIO, Google Drive) atau disk server. Butuh SIAKAD yang sudah memuat modul Berkas.
- Pembantu unggah otomatis: `unggahBerkas(siakad, file, { kategori, onProgress })` (Node.js) dan `$siakad->unggahBerkas($path, [...])` (PHP). File kecil dikirim sekali; file di atas batas unggah server dikirim bertahap per potongan (paralel di Node.js, diulang bila gagal, bisa dilanjutkan dengan `lanjutkan`). Hasilnya `id` yang dipakai sebagai `berkas_id` di endpoint unggah modul. Juga `urlBerkas()` dan `infoBerkas()` (Node.js).

## 1.1.0 (2026-11-15)

- Spesifikasi diperbarui dari SIAKAD terbaru: 52 modul, 2.787 operasi (sebelumnya 40 modul, 2.014). Modul baru antara lain
  `akademik`, `keuangan`, `kelulusan`, `edom`, `admisi`, `crm`, `rpl`, `pddikti`, `perpustakaan`, `iku`, `master`, `kelengkapan`, serta
  metode baru di `integrasi` (e-Sign BSrE, AI), `sdm` (PAK, honor), `lppm` (kolaborasi, publikasi), `karier` (mitra), dan `cbt`
  (kirim nilai ke SIAKAD). Tidak ada metode yang dihapus.
- Workflow `perbarui-spec.yml`: setiap hari mengambil OpenAPI SIAKAD dan membuka PR bila ada endpoint baru, sekaligus
  menaikkan versi dan menulis CHANGELOG.
- Rilis otomatis setiap merge PR ke `main`: versi naik sendiri (label `rilis:*` atau ditebak dari OpenAPI), lalu tag,
  npm, dan GitHub Release; Packagist dari tag.
  Tombol Actions > Rilis untuk menaikkan versi lalu merilis. Skrip `generator/versi.mjs` untuk menaikkan versi.
- `pmb.getInfoPerguruanTinggi({ q })` / `$siakad->pmb()->getInfoPerguruanTinggi(['q' => ...])`: cari perguruan tinggi asal
  dari referensi SIAKAD (`GET /v1/pmb/info/perguruan-tinggi`, publik). Butuh SIAKAD yang sudah memuat endpoint ini.

## 1.0.0 (2026-11-14)

- Rilis pertama: 40 modul, 2.008 endpoint dari spesifikasi OpenAPI SIAKAD.
- Token OAuth 2.0 otomatis (client_credentials), login pengguna (password), tukar token SSO, refresh otomatis,
  revoke, lupa/reset password.
- Galat bertipe, percobaan ulang 429/502/503/504, iterasi halaman, unggah multipart, unduh file.
- Opsi `methodOverride` untuk hosting yang menolak PUT/PATCH/DELETE, `environment` untuk database development.
- PHP: PSR-18 (Guzzle bawaan), cache token file/PSR-16, service provider + facade Laravel.
- Node.js: TypeScript, ESM + CommonJS, tanpa dependensi, TokenStore untuk Redis/KV.
