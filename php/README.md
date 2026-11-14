# unipo/siakad-sdk

SDK resmi **API SIAKAD UNIPO** untuk PHP 8.1+, dengan integrasi Laravel.

- **2.000+ endpoint** dari 40 modul (akademik, LMS, PMB, arsip, SDM, LPPM, SPMI, tracer study, ...), tiap metode
  berdokumentasi PHPDoc (ringkasan, scope, bentuk body) untuk autocomplete IDE dan PHPStan.
- **Token OAuth 2.0 otomatis**: token aplikasi diminta, disimpan (file, cache Laravel, atau PSR-16), dan diperbarui
  sendiri; token pengguna diperpanjang dengan refresh token.
- Galat bertipe (`ValidationException`, `PermissionException`, ...), percobaan ulang untuk 429/503, iterasi halaman,
  unggah dan unduh file.
- PSR-18 (bawaan Guzzle 7, bisa diganti), PSR-16 untuk cache token. Jalan di PHP 8.1 sampai 8.5.

## Pemasangan

```bash
composer require unipo/siakad-sdk
```

## Mulai cepat

Daftarkan aplikasi di [api.unipo.ac.id](https://api.unipo.ac.id) untuk mendapat `client_id` dan `client_secret`.
Simpan di `.env` server, jangan di kode yang terbuka.

```php
use Unipo\Siakad\Siakad;

$siakad = new Siakad([
    'client_id' => getenv('SIAKAD_CLIENT_ID'),
    'client_secret' => getenv('SIAKAD_CLIENT_SECRET'),
]);

$mhs = $siakad->mahasiswa()->getByNim('2025001');
echo $mhs['nama'];

$khs = $siakad->mahasiswa()->getByNimKhs('2025001', ['tahun_id' => '20261']);
foreach ($siakad->referensi()->getProdi() as $prodi) {
    echo $prodi['kode'], ' ', $prodi['nama'], PHP_EOL;
}
```

Setiap metode mengembalikan `Unipo\Siakad\Http\ApiResponse`:

| Metode | Isi |
|---|---|
| `data()` | Isi data (array). Bisa juga langsung `$r['nama']`, `foreach ($r as ...)`, `count($r)` |
| `meta()` | `page`, `per_page`, `total`, `total_pages` untuk endpoint daftar |
| `status()`, `headers()`, `header($nama)` | Informasi jawaban HTTP |
| `requestId()` | ID permintaan (`X-Request-Id`), sertakan saat melapor masalah |
| `environment()` | `live` atau `development` |
| `toArray()`, `collect()` | Array `['data' => ..., 'meta' => ...]` / Collection Laravel |

## Nama metode

Modul dipanggil sebagai metode `$siakad-><modul>()`, dan nama metodenya diambil dari `operationId` di
[dokumentasi API](https://api.unipo.ac.id/docs) tanpa nama modul:

| Endpoint | SDK |
|---|---|
| `GET /v1/mahasiswa` | `$siakad->mahasiswa()->list($query)` |
| `GET /v1/mahasiswa/{nim}` | `$siakad->mahasiswa()->getByNim($nim)` |
| `GET /v1/lms/kelas/{id}` | `$siakad->lms()->getKelasById($id)` |
| `POST /v1/lms/kelas` | `$siakad->lms()->postKelas($body)` |
| `PATCH /v1/lms/kelas/{id}` | `$siakad->lms()->patchKelasById($id, $body)` |
| `GET /v1/kurikulum-obe/...` | `$siakad->kurikulumObe()->...` |

Parameter path ditulis berurutan, lalu `$query` (GET/DELETE) atau `$body` (POST/PUT/PATCH), lalu `$options`.
Daftar modul ada di [MODUL.md](https://github.com/anasamu/unipo-sdk/blob/main/MODUL.md).

Endpoint yang belum ada di versi SDK Anda tetap bisa dipanggil:

```php
$r = $siakad->request('GET', '/v1/mahasiswa/{nim}/transkrip', ['nim' => '2025001']);
```

## Laravel

Service provider dan facade terdaftar otomatis. Isi `.env`:

```ini
SIAKAD_CLIENT_ID=cli_xxxx
SIAKAD_CLIENT_SECRET=xxxx
# opsional
SIAKAD_BASE_URL=https://api.unipo.ac.id
SIAKAD_SCOPE="mahasiswa:read nilai:read"
SIAKAD_ENVIRONMENT=development
SIAKAD_METHOD_OVERRIDE=false
SIAKAD_CACHE_STORE=redis
```

Token aplikasi disimpan di cache Laravel. Untuk mengubah pengaturan lain:
`php artisan vendor:publish --tag=siakad-config`.

```php
use Unipo\Siakad\Laravel\Facades\Siakad;

$prodi = Siakad::referensi()->getProdi()->collect();

// atau dependency injection
public function show(\Unipo\Siakad\Siakad $siakad, string $nim)
{
    return $siakad->mahasiswa()->getByNim($nim)->data();
}
```

## Login pengguna

Untuk aplikasi tempat mahasiswa/dosen login (klien harus diizinkan login pengguna):

```php
$token = $siakad->auth()->password($username, $password);
session(['siakad_token' => $token->toArray()]);

// di request berikutnya
$user = $siakad->withToken(
    TokenSet::fromArray(session('siakad_token')),
    fn (TokenSet $baru) => session(['siakad_token' => $baru->toArray()]), // dipanggil saat diperpanjang otomatis
);
$info = $user->auth()->me();                          // username, nama, level, scopes, peran
$krs = $user->mahasiswa()->getByNimKrs($info['username']);

$user->auth()->revoke($token->refreshToken);          // logout
```

Aplikasi yang login lewat **SSO UNIPO** menukar `id_token` dari sso.unipo.ac.id:

```php
$user = $siakad->withToken($siakad->auth()->exchangeSsoToken($idToken));
```

## Halaman demi halaman

```php
foreach ($siakad->paginate(fn (array $q) => $siakad->mahasiswa()->list($q), ['prodi' => '86206']) as $mhs) {
    echo $mhs['nim'], PHP_EOL;
}

$semua = $siakad->paginate(fn (array $q) => $siakad->lms()->getKelas($q))->all();
```

## Unggah dan unduh file

Field berkas menerima `Upload::fromPath()`, `Upload::fromString()`, `SplFileInfo` (termasuk `UploadedFile` Laravel),
atau resource:

```php
use Unipo\Siakad\Http\Upload;

$siakad->arsip()->postSuratByRefFile('S-001', [
    'berkas' => Upload::fromPath('/tmp/surat.pdf'),   // atau $request->file('berkas') di Laravel
    'peran' => 'utama',
]);
```

Endpoint yang mengirim file (bukan JSON) mengembalikan `DownloadedFile` di `data()`:

```php
$file = $siakad->request('GET', '/v1/arsip/file/{id}/unduh', ['id' => 7])->data();
$file->saveTo(storage_path('app/arsip'));  // memakai nama file dari server
```

## Galat

```php
use Unipo\Siakad\Exceptions\{SiakadException, ValidationException, PermissionException, NotFoundException};

try {
    $siakad->lms()->postKelas(['nama' => '']);
} catch (ValidationException $e) {
    $e->fields();            // ['nama' => 'Nama wajib diisi.']
} catch (PermissionException $e) {
    $e->requiredScopes();    // ['lms:write']
} catch (SiakadException $e) {
    $e->status(); $e->errorCode(); $e->getMessage(); $e->requestId();
}
```

| Kelas | HTTP |
|---|---|
| `BadRequestException` | 400 |
| `AuthenticationException` | 401 |
| `PermissionException` | 403 |
| `NotFoundException` | 404 |
| `MethodNotAllowedException` | 405 |
| `ConflictException` | 409 |
| `PayloadException` | 413, 415 |
| `ValidationException` | 422 |
| `RateLimitException` | 429 (`retryAfter()`) |
| `ServerException` | 5xx |
| `ConnectionException`, `TimeoutException` | tidak sampai ke server |

## Opsi

```php
use Unipo\Siakad\Options;

$siakad = new Siakad(new Options(
    baseUrl: 'https://api.unipo.ac.id',        // atau alamat lama https://siakad.unipo.ac.id/api
    clientId: '...',
    clientSecret: '...',
    scope: ['mahasiswa:read', 'nilai:read'],   // bawaan: semua scope klien
    environment: 'development',                // paksa database development
    timeout: 30.0,                             // detik
    maxRetries: 2,                             // 429, 502/503/504, galat koneksi (GET)
    methodOverride: true,                      // PUT/PATCH/DELETE dikirim sebagai POST + X-HTTP-Method-Override
    tokenStore: new Psr16TokenStore($cache),   // bawaan di luar Laravel: FileTokenStore di folder temp
    headers: ['X-Aplikasi' => 'lms'],
    httpClient: $klienPsr18,                   // bawaan Guzzle
));
```

Nyalakan `methodOverride` bila hosting menolak PUT/PATCH/DELETE (galat 403/405 berisi halaman HTML, bukan JSON).

## Pengembangan

Dari akar repo [unipo-sdk](https://github.com/anasamu/unipo-sdk):

```bash
composer install
composer test       # PHPUnit
composer analyse    # PHPStan
```

Kelas di `src/Resources/` dibuat otomatis dari spesifikasi OpenAPI; lihat README di akar repo [unipo-sdk](https://github.com/anasamu/unipo-sdk).

## Lisensi

MIT. Dikelola Pustikom Universitas Pohuwato. Laporkan masalah di
[github.com/anasamu/unipo-sdk/issues](https://github.com/anasamu/unipo-sdk/issues) dengan menyertakan `requestId()`.
