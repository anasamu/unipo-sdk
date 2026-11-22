# Panduan agen untuk unipo-sdk

Berkas ini dibaca agen pemrograman (Claude Code, Codex, Cursor, dan sejenisnya) sebelum mengubah repo ini. `AGENTS.md` menunjuk ke sini.

## Skill wajib (keputusan Anas, 22 Nov 2026)

SDK dipakai bersama unipo-ui di peramban, di server Node (Next.js, NestJS, Express), dan lewat SDK PHP. Dua skill berikut wajib dipakai, dan `.claude/settings.json` sudah mendaftarkan keduanya.

1. **modern-web-guidance** (Google Chrome, `googlechrome/modern-web-guidance`)
   - Jalankan sebelum mengubah kode yang berjalan di peramban atau menyentuh platform web: `fetch` dan pembatalan (AbortController), penyimpanan token di klien, unggah/unduh berkas, tanggal dan zona waktu, sanitasi HTML, keamanan (CSP, kredensial), dan kinerja.
     ```sh
     npx -y modern-web-guidance@latest search "abort fetch request"
     npx -y modern-web-guidance@latest retrieve "<id>"
     ```
   - Fitur yang belum Baseline Widely available wajib memakai cadangan sesuai panduan.
   - Deskripsi PR mencantumkan bagian **Modern Web Guidance** berisi id panduan yang dipakai.
2. **unslop** (`heydamir/unslop`)
   - Dipakai untuk contoh antarmuka di dokumentasi, playground, dan templat proyek per framework, supaya contoh yang disalin pengembang tidak terlihat buatan AI.

Pasang di Claude Code lokal bila belum ada:
```sh
claude plugin marketplace add googlechrome/modern-web-guidance
claude plugin install modern-web-guidance@googlechrome
claude plugin marketplace add heydamir/unslop
claude plugin install unslop@heydamir
```

## Aturan kerja yang sudah berlaku

- SDK tidak bergantung pada BFF PHP: penghubung data (`baseUrl`, `fetcher`, `getToken`) bisa diarahkan ke backend apa pun; rahasia klien tidak pernah sampai ke peramban.
- Rilis npm hanya lewat workflow otomatis setelah merge; tidak ada `npm publish` manual.
- Perubahan yang memutus kompatibilitas menaikkan versi mayor dan dicatat di CHANGELOG.
- Contoh di dokumentasi harus benar-benar jalan dan diuji otomatis.
