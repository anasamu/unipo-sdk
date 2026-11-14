# unipo-sdk

[![Packagist](https://img.shields.io/packagist/v/unipo/siakad-sdk?label=composer)](https://packagist.org/packages/unipo/siakad-sdk)
[![npm](https://img.shields.io/npm/v/unipo-siakad-sdk)](https://www.npmjs.com/package/unipo-siakad-sdk)
[![CI](https://github.com/anasamu/unipo-sdk/actions/workflows/ci.yml/badge.svg)](https://github.com/anasamu/unipo-sdk/actions/workflows/ci.yml)

SDK resmi **API SIAKAD UNIPO** untuk PHP dan Node.js. Kedua paket punya perilaku yang sama.

| Bahasa | Paket | Pasang | Panduan |
|---|---|---|---|
| PHP 8.1–8.5 (Laravel, Symfony, CodeIgniter, PHP biasa) | `unipo/siakad-sdk` | `composer require unipo/siakad-sdk` | [php/README.md](php/README.md) |
| Node.js 18.17+, Bun, Deno (Next.js, NestJS, Express, ...) | `unipo-siakad-sdk` | `npm install unipo-siakad-sdk` | [node/README.md](node/README.md) |

- Token OAuth 2.0 otomatis: token aplikasi diminta, disimpan, dan diperbarui sendiri; login pengguna, tukar token SSO,
  refresh otomatis, revoke, lupa/reset password.
- 40 modul dengan 2.008 endpoint ([MODUL.md](MODUL.md)), bertipe dan berdokumentasi di autocomplete editor.
- Galat bertipe dengan `requestId`, percobaan ulang 429/502/503/504, iterasi halaman, unggah/unduh file.
- `methodOverride` untuk hosting yang menolak PUT/PATCH/DELETE, `environment: development` untuk database development.

```php
$siakad = new \Unipo\Siakad\Siakad(['client_id' => '...', 'client_secret' => '...']);
echo $siakad->mahasiswa()->getByNim('2025001')['nama'];
```

```ts
import { Siakad } from 'unipo-siakad-sdk';
const siakad = new Siakad({ clientId: '...', clientSecret: '...' });
const { data } = await siakad.mahasiswa.getByNim('2025001');
```

Kredensial didapat dari portal pengembang [api.unipo.ac.id](https://api.unipo.ac.id). Panduan singkat juga ada di
[api.unipo.ac.id/docs/panduan/sdk](https://api.unipo.ac.id/docs/panduan/sdk).

## Struktur repo

```
composer.json, phpunit.xml.dist, phpstan.neon.dist   paket PHP (Packagist membaca composer.json di akar)
php/
├── src/Siakad.php, Options.php, Auth/, Http/, Exceptions/, Pagination/, Laravel/   ditulis tangan
├── src/Resources/, src/Concerns/GeneratedResources.php, src/Laravel/Facades/       hasil generator
├── config/siakad.php                                                               config Laravel
└── tests/               PHPUnit (HTTP tiruan) + integrasi.php (API sungguhan)
node/                    paket npm (TypeScript, tsup → ESM + CJS)
├── src/core.ts, auth.ts, errors.ts, types.ts, token-store.ts                        ditulis tangan
├── src/generated/                                                                  hasil generator
└── test/                node:test (fetch tiruan) + integrasi.mjs (API sungguhan)
generator/generate.mjs   menulis kode modul PHP + TypeScript dari openapi.json
generator/spec-dari-siakad.php   membuat openapi.json dari kode SIAKAD
openapi.json             spesifikasi API SIAKAD
```

Arsip Composer hanya berisi paket PHP (`.gitattributes` membuang `node/`, `generator/`, dan berkas uji).

## Pengembangan

```bash
composer install && composer test && composer analyse
(cd node && npm install && npm run typecheck && npm run build && npm test)
```

### Memperbarui setelah endpoint SIAKAD bertambah

```bash
curl -s https://api.unipo.ac.id/v1/openapi.json > openapi.json
# atau dari kode SIAKAD: php generator/spec-dari-siakad.php /path/ke/siakad_unipo > openapi.json
node generator/generate.mjs
```

Workflow **Perbarui spesifikasi API** (`.github/workflows/perbarui-spec.yml`) menjalankan langkah di atas setiap hari dan
membuka PR `otomatis/perbarui-spec` bila ada perubahan (sumber: variabel repo `SIAKAD_OPENAPI_URL`, bawaan
`https://api.unipo.ac.id/v1/openapi.json`). Aktifkan "Allow GitHub Actions to create and approve pull requests" di
Settings > Actions. PR itu sekaligus menaikkan versi (minor, atau mayor bila ada operasi yang hilang) dan menulis
CHANGELOG, jadi setelah di-merge versi barunya langsung dirilis otomatis (lihat Rilis).

CI gagal bila kode hasil generator tidak sesuai `openapi.json`. Nama metode diturunkan dari `operationId`; menghapus
atau mengganti path endpoint berarti menghapus metode, jadi naikkan versi mayor.

### Uji ke API sungguhan

Butuh API SIAKAD lokal/development dan klien dengan scope `referensi:read portal:read portal:write portal:admin`
serta izin login pengguna. Skrip membuat data uji di portal; jangan dijalankan ke database live.

```bash
export SIAKAD_URL=http://127.0.0.1:8090/api SIAKAD_CLIENT_ID=cli_... SIAKAD_CLIENT_SECRET=... SIAKAD_USER=... SIAKAD_PASS=...
php php/tests/integrasi.php
(cd node && npm run build && node test/integrasi.mjs)
```

## Rilis

Rilis berjalan otomatis lewat `.github/workflows/rilis.yml`. Versi PHP dan Node.js selalu sama.

- **Otomatis setiap merge PR ke `main`.** Versi dinaikkan sendiri lalu dirilis: diuji (generator, PHPUnit, paket npm),
  diberi tag, diterbitkan ke npm, dan dibuatkan GitHub Release. Packagist membaca tag itu sendiri. Judul PR menjadi
  catatan di CHANGELOG.
  - Jenis kenaikan: label PR `rilis:major`, `rilis:minor`, atau `rilis:patch`. Tanpa label, ditebak dari
    `openapi.json`: ada operasi hilang = major, ada operasi baru = minor, selain itu patch.
  - Bila PR sudah menaikkan versi sendiri (mis. PR otomatis dari perbarui-spec), versi itu yang dirilis.
  - Tidak dirilis bila PR berlabel `rilis:tidak`, atau isi paket (`php/`, `node/src`, `openapi.json`,
    `composer.json`) tidak berubah sejak rilis terakhir, mis. hanya README atau workflow.
- **Tombol.** Actions > Rilis > Run workflow, pilih `patch`, `minor`, atau `major`. Versi dinaikkan di semua berkas,
  di-commit ke `main`, lalu dirilis.
- **Naikkan versi di PR.** Jalankan skrip ini agar semua berkas versi dan CHANGELOG berubah bersamaan:

```bash
node generator/versi.mjs minor --catatan "Metode baru ..."   # patch | minor | major | X.Y.Z | tetap
node generator/versi.mjs                                       # tampilkan versi sekarang
```

Cara lama tetap bisa: `git tag vX.Y.Z && git push origin vX.Y.Z` (versi berkas harus sama dengan tag).

Bila `main` dilindungi aturan branch, izinkan GitHub Actions mem-push ke `main`: kenaikan versi otomatis di-commit
ke `main` sebelum diberi tag.

### Persiapan sekali

**Packagist** (repo ini harus publik): masuk [packagist.org](https://packagist.org) dengan akun GitHub, **Submit**,
isi `https://github.com/anasamu/unipo-sdk`. Integrasi GitHub Packagist memasang webhook, jadi tag berikutnya terbaca
otomatis.

**npm**:

```bash
npm login
cd node && npm install && npm run build && npm publish --access public   # terbitan pertama
npm token create                                                          # token untuk rilis otomatis
gh secret set NPM_TOKEN -R anasamu/unipo-sdk
```

## Lisensi

MIT. Dikelola Pustikom Universitas Pohuwato.
