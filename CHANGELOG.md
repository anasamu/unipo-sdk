# Catatan rilis SDK

Versi paket PHP (`unipo/siakad-sdk`) dan Node.js (`unipo-siakad-sdk`) selalu sama dan dirilis bersamaan.

## 1.1.0 (belum dirilis)

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
