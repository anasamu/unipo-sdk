# unipo-siakad-sdk

SDK resmi **API SIAKAD UNIPO** untuk Node.js dan framework JavaScript modern (Next.js, NestJS, Express, Fastify,
Nuxt, SvelteKit, Remix), juga Bun dan Deno.

- **2.000+ endpoint** dari 40 modul (akademik, LMS, PMB, arsip, SDM, LPPM, SPMI, tracer study, ...), lengkap dengan tipe
  TypeScript dan dokumentasi di autocomplete editor.
- **Token OAuth 2.0 otomatis**: token aplikasi diminta, disimpan, dan diperbarui sendiri; token pengguna diperpanjang
  dengan refresh token.
- **ESM + CommonJS**, tanpa dependensi (memakai `fetch` bawaan Node.js 18+).
- Galat bertipe (`ValidationError`, `PermissionError`, ...), percobaan ulang otomatis untuk 429/503, iterasi halaman,
  unggah dan unduh file.

## Pemasangan

```bash
npm install unipo-siakad-sdk
# atau: pnpm add unipo-siakad-sdk / yarn add unipo-siakad-sdk / bun add unipo-siakad-sdk
```

Butuh Node.js 18.17 atau lebih baru.

## Mulai cepat

Daftarkan aplikasi di [api.unipo.ac.id](https://api.unipo.ac.id) untuk mendapat `client_id` dan `client_secret`.
Simpan keduanya di variabel lingkungan server, **jangan** di kode browser atau aplikasi mobile.

```ts
import { Siakad } from 'unipo-siakad-sdk';

const siakad = new Siakad({
  clientId: process.env.SIAKAD_CLIENT_ID,
  clientSecret: process.env.SIAKAD_CLIENT_SECRET,
});

const { data: prodi } = await siakad.referensi.getProdi();
const { data: mhs } = await siakad.mahasiswa.getByNim('2025001');
const { data: khs } = await siakad.mahasiswa.getByNimKhs('2025001', { tahun_id: '20261' });
```

Setiap metode mengembalikan `ApiResult<T>`:

| Field | Isi |
|---|---|
| `data` | Isi data, bertipe sesuai dokumentasi API |
| `meta` | `page`, `per_page`, `total`, `total_pages` untuk endpoint daftar |
| `status` | Kode HTTP |
| `requestId` | ID permintaan (`X-Request-Id`), sertakan saat melapor masalah |
| `environment` | `live` atau `development` (database yang melayani) |
| `headers` | Semua header jawaban |

## Nama metode

Semua modul ada di `siakad.<modul>`, dan nama metodenya diambil dari `operationId` di
[dokumentasi API](https://api.unipo.ac.id/docs) tanpa nama modul:

| Endpoint | operationId | SDK |
|---|---|---|
| `GET /v1/mahasiswa` | `getMahasiswa` | `siakad.mahasiswa.list(query)` |
| `GET /v1/mahasiswa/{nim}` | `getMahasiswaByNim` | `siakad.mahasiswa.getByNim(nim)` |
| `GET /v1/lms/kelas/{id}` | `getLmsKelasById` | `siakad.lms.getKelasById(id)` |
| `POST /v1/lms/kelas` | `postLmsKelas` | `siakad.lms.postKelas(body)` |
| `PATCH /v1/lms/kelas/{id}` | `patchLmsKelasById` | `siakad.lms.patchKelasById(id, body)` |
| `GET /v1/kurikulum-obe/...` | `getKurikulumObe...` | `siakad.kurikulumObe....` |

Parameter path ditulis berurutan, lalu `query` (GET/DELETE) atau `body` (POST/PUT/PATCH), lalu `options`.
Daftar semua modul ada di [MODUL.md](https://github.com/anasamu/unipo-sdk/blob/main/MODUL.md).

Endpoint yang belum ada di versi SDK Anda tetap bisa dipanggil:

```ts
const r = await siakad.request({ method: 'GET', path: '/v1/mahasiswa/{nim}/transkrip', query: { nim: '2025001' } });
```

## Login pengguna

Untuk aplikasi tempat mahasiswa/dosen login (klien harus diizinkan login pengguna):

```ts
const token = await siakad.auth.password(username, password); // simpan di sesi server
const user = siakad.withToken(token, async (baru) => {
  await simpanKeSesi(baru); // dipanggil saat token diperpanjang otomatis dengan refresh token
});

const info = await user.auth.me(); // username, nama, level, scopes, peran
const { data } = await user.mahasiswa.getByNimKrs(info.username!);

await user.auth.revoke(token.refresh_token); // logout
```

Aplikasi yang login lewat **SSO UNIPO** menukar `id_token` dari sso.unipo.ac.id:

```ts
const token = await siakad.auth.exchangeSsoToken(idToken);
const user = siakad.withToken(token);
```

## Halaman demi halaman

```ts
for await (const mhs of siakad.paginate((q) => siakad.mahasiswa.list(q), { prodi: '86206' })) {
  console.log(mhs.nim);
}

const semua = await siakad.paginate((q) => siakad.lms.getKelas(q), { per_page: 100 }).all();
```

## Unggah dan unduh file

Field berkas menerima `File`, `Blob`, `Uint8Array`/`Buffer`, atau `{ data, filename, contentType }`:

```ts
import { readFile } from 'node:fs/promises';

await siakad.arsip.postSuratByRefFile('S-001', {
  berkas: { data: await readFile('surat.pdf'), filename: 'surat.pdf', contentType: 'application/pdf' },
  peran: 'utama',
});
```

Endpoint yang mengirim file (bukan JSON) mengembalikan `SiakadFile` di `data`:
`filename`, `contentType`, `bytes`, `text()`, `blob()`.

### Berkas terpusat (file besar, progres, `berkas_id`)

`unggahBerkas()` mengunggah ke `/v1/berkas` dan memilih caranya sendiri: file kecil dikirim sekali, file di atas batas
unggah server (`upload_max_filesize`) dikirim bertahap per potongan, paralel, dan diulang bila gagal. `id` hasilnya
dipakai sebagai `berkas_id` di endpoint unggah modul mana pun (dokumen profil, lampiran pusat data, arsip, SPMI, LMS,
SDM, LPPM, portal, tracer). Berkas disimpan di penyimpanan yang aktif di menu Integrasi (S3, R2, MinIO, Google Drive)
atau disk server.

```ts
import { unggahBerkas, urlBerkas } from 'unipo-siakad-sdk';

const berkas = await unggahBerkas(siakad, input.files[0], {
  kategori: 'dokumen',
  modul: 'profil',
  onProgress: ({ persen }) => setPersen(persen),
});
await siakad.profil.postDokumenByIdBerkas(dokumen.id, { berkas_id: berkas.id });

// Tautan sementara untuk <img>, <a>, atau pratinjau PDF (tanpa header Authorization):
img.src = await urlBerkas(siakad, berkas.id!);
```

Unggahan yang terputus bisa dilanjutkan: `unggahBerkas(siakad, file, { lanjutkan: idBerkas })` hanya mengirim potongan
yang belum diterima.

## Microservices: gerbang, antrean, rahasia, event

Pembantu untuk aplikasi dan layanan yang memakai infrastruktur `/v1/infra` (panduan: api.unipo.ac.id/docs/panduan/gerbang).

```ts
import { verifikasiGerbang, konsumsiAntrean, muatRahasia, terbitkanEvent } from 'unipo-siakad-sdk';

// Layanan di belakang gerbang api.unipo.ac.id: percayai header X-Unipo-* hanya bila tanda tangannya sah.
app.use(async (req, res, next) => {
  const id = await verifikasiGerbang({ metode: req.method, path: req.originalUrl, header: req.headers }, process.env.GERBANG_KUNCI!);
  if (!id) return res.status(401).json({ error: { code: 'unauthorized', message: 'Hanya lewat api.unipo.ac.id' } });
  res.locals.identitas = id; // { klien, pengguna, level, scope, requestId }
  next();
});

// Saat boot: rahasia ruang "lms" dari secret manager ke process.env (scope infra:rahasia, token live).
await muatRahasia(siakad, 'lms');

// Cron tiap menit: proses event dari antrean tarik (scope infra:antrean). Galat = tolak, dicoba lagi lalu dead letter.
await konsumsiAntrean(siakad, 'lms.nilai-masuk', async (event) => {
  if (await sudahDiproses(event.id)) return; // at-least-once
  await simpan(event.data);
});

// Terbitkan event domain layanan ini (scope infra:terbitkan; jenis berawalan kode layanan).
await terbitkanEvent(siakad, 'lms.tugas_dinilai', { tugas: 7, nim: '2201010001', nilai: 88 }, { subjek: '2201010001' });
```

## Galat

```ts
import { SiakadError, ValidationError, PermissionError, NotFoundError, RateLimitError } from 'unipo-siakad-sdk';

try {
  await siakad.lms.postKelas({ nama: '' });
} catch (e) {
  if (e instanceof ValidationError) console.log(e.fields);              // { nama: 'Nama wajib diisi.' }
  else if (e instanceof PermissionError) console.log(e.requiredScopes); // ['lms:write']
  else if (e instanceof SiakadError) console.log(e.status, e.code, e.message, e.requestId);
}
```

| Kelas | HTTP |
|---|---|
| `BadRequestError` | 400 |
| `AuthenticationError` | 401 |
| `PermissionError` | 403 |
| `NotFoundError` | 404 |
| `MethodNotAllowedError` | 405 |
| `ConflictError` | 409 |
| `PayloadError` | 413, 415 |
| `ValidationError` | 422 |
| `RateLimitError` | 429 (`retryAfter`) |
| `ServerError` | 5xx |
| `ConnectionError`, `TimeoutError` | tidak sampai ke server |

## Opsi

```ts
new Siakad({
  baseUrl: 'https://api.unipo.ac.id',   // atau alamat lama https://siakad.unipo.ac.id/api
  clientId, clientSecret,
  scope: ['mahasiswa:read', 'nilai:read'], // bawaan: semua scope klien
  environment: 'development',           // paksa database development
  timeout: 30_000,                      // milidetik
  maxRetries: 2,                        // 429, 502/503/504, galat koneksi (GET)
  methodOverride: true,                 // PUT/PATCH/DELETE dikirim sebagai POST + X-HTTP-Method-Override
  tokenStore,                           // simpan token aplikasi di Redis/KV (lihat di bawah)
  headers: { 'X-Aplikasi': 'lms' },
});
```

Nyalakan `methodOverride` bila hosting menolak PUT/PATCH/DELETE (galat 403/405 berisi halaman HTML, bukan JSON).

### Token di Redis (serverless / banyak instance)

Bawaan, token aplikasi disimpan di memori proses. Di lingkungan serverless (Vercel, Lambda) atau banyak instance,
simpan di tempat bersama supaya tidak meminta token baru di setiap permintaan:

```ts
import type { TokenStore } from 'unipo-siakad-sdk';

const tokenStore: TokenStore = {
  get: async (k) => JSON.parse((await redis.get(k)) ?? 'null'),
  set: async (k, t, ttl) => void (await redis.set(k, JSON.stringify(t), 'EX', ttl)),
  delete: async (k) => void (await redis.del(k)),
};
```

## Contoh per framework

### Next.js (App Router)

```ts
// lib/siakad.ts
import 'server-only';
import { Siakad } from 'unipo-siakad-sdk';

export const siakad = new Siakad({
  clientId: process.env.SIAKAD_CLIENT_ID,
  clientSecret: process.env.SIAKAD_CLIENT_SECRET,
});

// app/prodi/page.tsx
import { siakad } from '@/lib/siakad';

export default async function Page() {
  const { data } = await siakad.referensi.getProdi();
  return <ul>{data.map((p) => <li key={String(p.kode)}>{String(p.nama)}</li>)}</ul>;
}
```

### NestJS

```ts
// siakad.module.ts
import { Global, Module } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { Siakad } from 'unipo-siakad-sdk';

@Global()
@Module({
  providers: [{
    provide: Siakad,
    inject: [ConfigService],
    useFactory: (c: ConfigService) => new Siakad({
      clientId: c.getOrThrow('SIAKAD_CLIENT_ID'),
      clientSecret: c.getOrThrow('SIAKAD_CLIENT_SECRET'),
    }),
  }],
  exports: [Siakad],
})
export class SiakadModule {}

// mahasiswa.controller.ts
@Controller('mahasiswa')
export class MahasiswaController {
  constructor(private readonly siakad: Siakad) {}

  @Get(':nim')
  async detail(@Param('nim') nim: string) {
    return (await this.siakad.mahasiswa.getByNim(nim)).data;
  }
}
```

### Express

```js
const express = require('express');
const { Siakad, SiakadError } = require('unipo-siakad-sdk');

const siakad = new Siakad({ clientId: process.env.SIAKAD_CLIENT_ID, clientSecret: process.env.SIAKAD_CLIENT_SECRET });
const app = express();

app.get('/jadwal/:nim', async (req, res, next) => {
  try {
    res.json((await siakad.mahasiswa.getByNimJadwal(req.params.nim)).data);
  } catch (e) {
    if (e instanceof SiakadError) return res.status(e.status || 502).json({ pesan: e.message });
    next(e);
  }
});
```

## Tipe data

Semua skema dari dokumentasi API tersedia sebagai tipe:

```ts
import type { Schemas } from 'unipo-siakad-sdk';

function tampilkan(kelas: Schemas.LmsKelas) { ... }
```

## Lisensi

MIT. Dikelola Pustikom Universitas Pohuwato. Laporkan masalah di
[github.com/anasamu/unipo-sdk/issues](https://github.com/anasamu/unipo-sdk/issues) dengan menyertakan `requestId`.
