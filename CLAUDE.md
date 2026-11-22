# unipo-sdk: cara kerja agen

SDK resmi API SIAKAD UNIPO: Node/TypeScript (`unipo-siakad-sdk`, folder `node/`) dan PHP (`unipo/siakad-sdk`), dibangkitkan dari `openapi.json` SIAKAD.

## Skill wajib (keputusan Anas 2026-11-22)
- **modern-web-guidance** (terpasang di `.claude/skills/modern-web-guidance`): wajib untuk kode yang berjalan di peramban atau dipakai komponen
  UI — klien fetch/streaming, penanganan tanggal & zona waktu (`Intl`/Temporal), unggah berkas, keamanan (sanitasi, token di peramban),
  contoh & dokumentasi integrasi frontend. Jalankan `npx -y modern-web-guidance@latest search "<2–5 kata>"` lalu `retrieve "<id>"`
  sebelum menulis kode itu. Tidak perlu untuk generator, PHP, atau skrip build.
- **Skill desain** (ui-ux-pro-max, design-system, ui-styling, design, frontend-design) bila menyentuh dokumentasi/contoh tampilan.

## Aturan
- Kode tipe & metode dibangkitkan dari OpenAPI (`generator/`); jangan sunting hasil bangkitan secara manual.
- Perubahan yang memecah kompatibilitas = versi mayor + catatan **Migrasi** di `CHANGELOG.md`.
- Rahasia klien tidak pernah dikirim ke peramban; contoh integrasi frontend memakai proxy server (Next.js, NestJS, Express, Laravel) atau BFF.
- Uji: typecheck, build, tes node, phpunit, `php -l`.
- Commit atas nama Anas Amu tanpa atribusi; PR draf; merge hanya oleh Anas; rilis npm otomatis lewat workflow Rilis setelah merge.
