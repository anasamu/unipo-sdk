# Catatan rilis SDK

Versi paket PHP (`unipo/siakad-sdk`) dan Node.js (`unipo-siakad-sdk`) selalu sama dan dirilis bersamaan.

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
