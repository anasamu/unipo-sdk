# Catatan rilis SDK

Versi paket PHP (`unipo/siakad-sdk`) dan Node.js (`unipo-siakad-sdk`) selalu sama dan dirilis bersamaan.

## 1.11.0 (belum dirilis)

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
