<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * RBAC: Hak akses efektif, RBAC: Aplikasi, RBAC: Peran, RBAC: Masuk sebagai pengguna, RBAC: Klien API, RBAC: Log API, RBAC: Akses database live, RBAC: Database development, RBAC: Izin, RBAC: Penugasan, RBAC: Pemetaan
 */
final class Rbac extends Resource
{
    /**
     * Hak akses saya
     *
     * Peran yang sedang dipegang pemilik token (dari level lama, penugasan, dan jabatan), izin efektif (pola `*` sudah diuraikan
     * menjadi kode di katalog) beserta lingkup unitnya, aplikasi yang boleh dimasuki (izin `<aplikasi>.akses`), scope API, dan
     * level SIAKAD yang setara. `?aplikasi=lms` membatasi ke satu aplikasi. Dipakai SSO untuk klaim `roles`/`permissions`.
     *
     * `GET /v1/rbac/saya`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array{aplikasi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/saya', [], $query, null, $options, false, false);
    }

    /**
     * Hak akses pengguna
     *
     * Sama dengan /saya untuk pengguna lain. Untuk pengelola hak akses dan token aplikasi (client_credentials) ber-scope rbac:read.
     *
     * `GET /v1/rbac/pengguna/{username}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $username Username SIAKAD
     * @param array{aplikasi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenggunaByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/pengguna/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Cek izin
     *
     * Memeriksa satu atau beberapa izin: `{"izin": "lms.kelas.kelola", "unit": "55201"}` atau `{"izin": ["a", "b"], "username": "..."}`.
     *
     * * Tanpa `unit`, hanya izin global yang dihitung; kirim `"di_mana_saja": true` untuk menerima izin di unit mana pun.
     * * `unit` = ID unit, kode unit, kode prodi, atau kode fakultas; izin unit induk (mis. fakultas) berlaku untuk prodinya.
     * * `username` lain hanya untuk pengelola hak akses dan token aplikasi.
     *
     * `POST /v1/rbac/cek`
     *
     * scope: `rbac:read`
     *
     * @param array{izin: string|list<mixed>, unit?: string, username?: string, di_mana_saja?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCek(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/cek', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Siapa pemegang izin
     *
     * Peran yang memberi izin ini (termasuk warisan), level lama yang dipetakan ke peran itu, pejabat aktif, dan penugasan aktif. `unit` membatasi ke pemegang yang kewenangannya mencakup unit tersebut. Untuk pengelola hak akses dan token aplikasi (mis. menentukan penyetuju).
     *
     * `GET /v1/rbac/pemegang`
     *
     * scope: `rbac:read`
     *
     * @param array{izin: string, unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemegang(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/pemegang', [], $query, null, $options, false, false);
    }

    /**
     * Aplikasi publik
     *
     * Tanpa token. Aplikasi aktif dengan `visibilitas` publik dan jenis web atau mobile, urut seperti di Pustikom. Dipakai dasbor
     * SSO dan daftar aplikasi kampus. `platform` merangkum yang tersedia: `web` (tombol Buka ke `url`), `android` (`url_android`),
     * `ios` (`url_ios`). Logo diambil dari klien SSO `client_id_sso` (`https://sso.unipo.ac.id/logos/<client_id>.png`).
     * `?jenis=web|mobile` menyaring.
     *
     * `GET /v1/rbac/aplikasi-publik`
     *
     * publik (tanpa token)
     *
     * @param array{jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAplikasiPublik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/aplikasi-publik', [], $query, null, $options, false, true);
    }

    /**
     * Katalog izin per aplikasi
     *
     * Aplikasi aktif beserta izinnya, dan daftar peran aktif. `?aplikasi=` membatasi ke satu aplikasi.
     *
     * `GET /v1/rbac/katalog`
     *
     * scope: `rbac:read`
     *
     * @param array{aplikasi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Daftarkan izin aplikasi
     *
     * Aplikasi mendaftarkan seluruh katalog izinnya sendiri (token aplikasi milik klien `client_id_api` aplikasi itu, atau admin).
     * Body: `{"izin": [{"kode": "lms.kelas.kelola", "nama": "Kelola kelas", "jenis": "aksi", "grup": "Kelas", "berlingkup": true}]}`.
     * Kode wajib diawali kode aplikasi. Izin yang sudah ada diperbarui; izin aplikasi itu yang tidak dikirim lagi dinonaktifkan.
     *
     * `POST /v1/rbac/aplikasi/{kode}/izin`
     *
     * scope: `rbac:write`
     *
     * @param int|string $kode Kode aplikasi
     * @param array{izin: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAplikasiByKodeIzin(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/aplikasi/{kode}/izin', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Atur seluruh izin peran
     *
     * Mengganti daftar izin peran sekaligus: `{"izin": ["lms.akses", "lms.kelas.*"]}`. Hanya admin.
     *
     * `PUT /v1/rbac/peran/{id}/izin`
     *
     * scope: `rbac:admin`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{izin: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeranByIdIzin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rbac/peran/{id}/izin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sinkron katalog
     *
     * Menambah aplikasi, izin, dan peran bawaan yang belum ada; izin scope API dari katalog scope terbaru; izin <modul>:kelola untuk modul pusat data. Aman diulang; perubahan admin tidak ditimpa. Sama dengan `php artisan rbac:sinkron`.
     *
     * `POST /v1/rbac/sinkron`
     *
     * scope: `rbac:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSinkron(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/sinkron', [], $query, null, $options, false, false);
    }

    /**
     * Log masuk sebagai pengguna
     *
     * Pemegang izin pustikom.menyamar atau admin RBAC. Saring `admin`, `username`, `status` (menunggu, aktif, selesai, kedaluwarsa, dihentikan, batal), `q`; `page`, `per_page`.
     *
     * `GET /v1/rbac/menyamar`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMenyamar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/menyamar', [], $query, null, $options, false, false);
    }

    /**
     * Minta tiket masuk sebagai pengguna
     *
     * Khusus pemegang izin `pustikom.menyamar` (bawaan: peran superadmin). Body: `{"username": "0912345", "alasan": "Menelusuri tampilan
     * jadwal level PROGDI", "mode": "lihat", "aplikasi": "siakad", "durasi_menit": 30}`.
     *
     * * `mode`: `lihat` (bawaan; simpan/ubah/hapus ditolak) atau `penuh`. `aplikasi`: client_id SSO tujuan pertama, atau `portal`.
     * * Akun admin lain ditolak kecuali `MENYAMAR_BOLEH_ADMIN=true`. Password akun tujuan tidak pernah disentuh.
     * * Jawaban berisi `url` SSO sekali pakai (2 menit) yang harus dibuka di browser yang sedang login SSO sebagai admin peminta.
     * * Semua permintaan tercatat (lihat GET /v1/rbac/menyamar). Batas 20 per admin per jam.
     *
     * `POST /v1/rbac/menyamar`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMenyamar(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/menyamar', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail log masuk sebagai pengguna
     *
     * `GET /v1/rbac/menyamar/{id}`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param int|string $id ID log
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMenyamarById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/menyamar/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hentikan sesi masuk sebagai pengguna
     *
     * Sesi langsung ditolak API SIAKAD dan SIAKAD web pada permintaan berikutnya.
     *
     * `POST /v1/rbac/menyamar/{id}/hentikan`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param int|string $id ID log
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMenyamarByIdHentikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/menyamar/{id}/hentikan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar klien API
     *
     * Semua klien API SIAKAD (aplikasi integrasi) tanpa secret. Hanya admin (level ADMIN atau izin rbac:admin) dengan token pengguna.
     *
     * `GET /v1/rbac/klien-api`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKlienApi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/klien-api', [], $query, null, $options, false, false);
    }

    /**
     * Buat klien API
     *
     * Membuat klien API baru. `client_secret` hanya muncul sekali di jawaban ini, simpan di server aplikasi.
     * Body: `{"name": "LMS", "scopes": ["krs:read"], "allow_user_login": false, "sso_audience": "lms", "allowed_ips": [], "allowed_origins": [], "prodi": [], "rate_limit": null}`.
     * `sso_audience` = client_id aplikasi di SSO yang id_token-nya boleh ditukar menjadi token API (grant token-exchange).
     *
     * `POST /v1/rbac/klien-api`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array{name?: string, scopes?: list<mixed>, allow_user_login?: bool, trust_user_ip?: bool, sso_audience?: string|null, allowed_ips?: list<mixed>, allowed_origins?: list<mixed>, prodi?: list<mixed>, rate_limit?: int|null, active?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKlienApi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/klien-api', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Katalog scope API
     *
     * Semua scope yang bisa diberikan ke klien API: `{"krs:read": "keterangan", ...}`.
     *
     * `GET /v1/rbac/klien-api/scope`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKlienApiScope(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/klien-api/scope', [], $query, null, $options, false, false);
    }

    /**
     * Detail klien API
     *
     * Tanpa secret.
     *
     * `GET /v1/rbac/klien-api/{id}`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id client_id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKlienApiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/klien-api/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah klien API
     *
     * Kolom yang tidak dikirim tetap. `active: false` menonaktifkan klien (token barunya ditolak).
     *
     * `PATCH /v1/rbac/klien-api/{id}`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id client_id
     * @param array{name?: string, scopes?: list<mixed>, allow_user_login?: bool, trust_user_ip?: bool, sso_audience?: string|null, allowed_ips?: list<mixed>, allowed_origins?: list<mixed>, prodi?: list<mixed>, rate_limit?: int|null, active?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKlienApiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/rbac/klien-api/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus klien API
     *
     * Klien dihapus permanen dan tautannya di rbac_aplikasi.client_id_api dikosongkan.
     *
     * `DELETE /v1/rbac/klien-api/{id}`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id client_id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKlienApiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/klien-api/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ganti secret klien API
     *
     * Secret lama langsung tidak berlaku; secret baru hanya muncul sekali.
     *
     * `POST /v1/rbac/klien-api/{id}/secret`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id client_id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKlienApiByIdSecret(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/klien-api/{id}/secret', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Log permintaan API
     *
     * Permintaan API terbaru lebih dulu: waktu, metode, path, query (tanpa nilai rahasia), status, durasi (ms), client_id,
     * username, level, lingkungan database, dan IP. Bawaan hari ini; `dari`/`sampai` (Y-m-d) paling lebar 31 hari.
     * Saring dengan `client_id` (log satu aplikasi), `username`, `status` (`sukses`, `galat`, `4xx`, `5xx`, atau kode),
     * `method`, dan `path` (potongan). Isi body, token, dan secret tidak pernah dicatat.
     *
     * `GET /v1/rbac/log-api`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array{client_id?: string, username?: string, status?: string, method?: string, path?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogApi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/log-api', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan log API
     *
     * Angka untuk grafik: jumlah permintaan, galat 4xx/5xx, tingkat galat, waktu tanggap rata-rata/p50/p95, pengguna unik,
     * deret per jam (satu hari) atau per hari, sebaran status, 10 endpoint dan 10 klien teratas. Saringan sama dengan
     * `/log-api`; bawaan 7 hari terakhir.
     *
     * `GET /v1/rbac/log-api/ringkasan`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array{client_id?: string, username?: string, status?: string, method?: string, path?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogApiRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/log-api/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pengajuan akses live
     *
     * Aplikasi (klien API) baru memakai database **development**. Pengajuan akses database live dari aplikasi
     * (`POST /v1/lingkungan/pengajuan-live`) atau admin, beserta riwayat keputusan. `?status=menunggu` untuk yang perlu diputuskan,
     * `?client_id=` untuk satu aplikasi. Hanya admin dengan token pengguna dari aplikasi yang memakai database live.
     *
     * `GET /v1/rbac/akses-live`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array{status?: string, client_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAksesLive(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/akses-live', [], $query, null, $options, false, false);
    }

    /**
     * Setujui pengajuan
     *
     * Aplikasi langsung memakai database live mulai permintaan berikutnya. Body opsional `{"catatan": "..."}`.
     *
     * `POST /v1/rbac/akses-live/{id}/setujui`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAksesLiveByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/akses-live/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tolak pengajuan
     *
     * Aplikasi tetap memakai database development. Body opsional `{"catatan": "alasan penolakan"}`.
     *
     * `POST /v1/rbac/akses-live/{id}/tolak`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAksesLiveByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/akses-live/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan akses live untuk aplikasi
     *
     * Admin mengajukan atas nama aplikasi. Body `{"alasan": "..."}` (min. 10 karakter).
     *
     * `POST /v1/rbac/klien-api/{id}/akses-live/ajukan`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id client_id
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKlienApiByIdAksesLiveAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/klien-api/{id}/akses-live/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Beri akses live langsung
     *
     * Menyetujui pengajuan yang menunggu, atau memberi akses live tanpa pengajuan (tercatat di riwayat). Body opsional `{"catatan": "..."}`.
     *
     * `POST /v1/rbac/klien-api/{id}/akses-live`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id client_id
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKlienApiByIdAksesLive(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/klien-api/{id}/akses-live', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut akses live
     *
     * Aplikasi kembali memakai database development mulai permintaan berikutnya (token yang sudah terbit ikut pindah). Body opsional `{"catatan": "..."}`.
     *
     * `POST /v1/rbac/klien-api/{id}/akses-live/cabut`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id client_id
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKlienApiByIdAksesLiveCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/klien-api/{id}/akses-live/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Status database development
     *
     * Diatur atau belum (DB_DEV_* di .env), terhubung, jumlah tabel, salinan terakhir dan yang sedang berjalan. `?tabel=1` menambah daftar tabel live (perkiraan baris dan ukuran) untuk pilihan "hanya struktur".
     *
     * `GET /v1/rbac/db-dev`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array{tabel?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDbDev(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/db-dev', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat salinan
     *
     * 50 salinan terakhir, terbaru lebih dulu, dengan kemajuan salinan yang sedang berjalan.
     *
     * `GET /v1/rbac/db-dev/salinan`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDbDevSalinan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/db-dev/salinan', [], $query, null, $options, false, false);
    }

    /**
     * Salin data live ke development
     *
     * Meminta salinan seluruh database live ke database development. Database live hanya dibaca; isi development **diganti seluruhnya**.
     * Body: `{"konfirmasi": "SALIN", "pribadi": true, "password": true, "tanpa_data": ["log_besar"]}`.
     * `pribadi` menyamarkan email, telepon, NIK/KTP/NPWP/rekening, alamat, dan nama orang tua; `password` mengganti semua password akun
     * development dengan DB_DEV_PASSWORD_AKUN (bawaan dev12345). Rahasia layanan pihak ketiga selalu dikosongkan.
     * Salinan dijalankan cron (`php artisan dbdev:jalan`, ikut tools/auto_update.php) dalam beberapa menit; pantau lewat GET salinan/{id}.
     *
     * `POST /v1/rbac/db-dev/salinan`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDbDevSalinan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/db-dev/salinan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kemajuan salinan
     *
     * `GET /v1/rbac/db-dev/salinan/{id}`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id ID salinan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDbDevSalinanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/db-dev/salinan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan salinan
     *
     * Salinan yang menunggu langsung batal; yang sedang berjalan berhenti setelah tabel yang sedang disalin.
     *
     * `POST /v1/rbac/db-dev/salinan/{id}/batal`
     *
     * scope: `rbac:admin` · hanya token pengguna
     *
     * @param int|string $id ID salinan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDbDevSalinanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/db-dev/salinan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aplikasi: daftar
     *
     * Aplikasi yang memakai role dan hak akses terpusat. kode menjadi awalan kode izinnya (mis. lms → lms.akses). client_id_api = klien API milik aplikasi (boleh mendaftarkan izinnya sendiri); client_id_sso = klien SSO (klaim permissions di token SSO). visibilitas publik = tampil di dasbor SSO dan /v1/rbac/aplikasi-publik; privat = hanya di Pustikom. jenis web memakai url (tombol Buka), jenis mobile memakai url_android/url_ios (tautan unduh sesuai platform yang didukung). Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/aplikasi`
     *
     * scope: `rbac:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, visibilitas?: string, sistem?: string, aktif?: string, kode?: string, client_id_api?: string, client_id_sso?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAplikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/aplikasi', [], $query, null, $options, false, false);
    }

    /**
     * Aplikasi: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/rbac/aplikasi`
     *
     * scope: `rbac:write`
     *
     * @param array{kode: string, nama: string, keterangan?: string, jenis?: string, url?: string, visibilitas?: string, url_android?: string, url_ios?: string, client_id_api?: string, client_id_sso?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAplikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/aplikasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aplikasi: detail
     *
     * Aplikasi yang memakai role dan hak akses terpusat. kode menjadi awalan kode izinnya (mis. lms → lms.akses). client_id_api = klien API milik aplikasi (boleh mendaftarkan izinnya sendiri); client_id_sso = klien SSO (klaim permissions di token SSO). visibilitas publik = tampil di dasbor SSO dan /v1/rbac/aplikasi-publik; privat = hanya di Pustikom. jenis web memakai url (tombol Buka), jenis mobile memakai url_android/url_ios (tautan unduh sesuai platform yang didukung). Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/aplikasi/{id}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAplikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/aplikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aplikasi: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rbac/aplikasi/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, keterangan?: string, jenis?: string, url?: string, visibilitas?: string, url_android?: string, url_ios?: string, client_id_api?: string, client_id_sso?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAplikasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rbac/aplikasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aplikasi: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/rbac/aplikasi/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAplikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/aplikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Izin (permission): daftar
     *
     * Katalog izin. Kode diawali kode aplikasinya (lms.kelas.kelola), kecuali izin aplikasi api yang sama dengan nama scope API (krs:read) atau <modul>:kelola. Izin bawaan (sistem) dibuat oleh sinkron katalog; hanya nama, grup, keterangan, dan aktif yang boleh diubah. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/izin`
     *
     * scope: `rbac:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, aplikasi_id?: string, jenis?: string, berlingkup?: string, sistem?: string, aktif?: string, kode?: string, grup?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIzin(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/izin', [], $query, null, $options, false, false);
    }

    /**
     * Izin (permission): tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/rbac/izin`
     *
     * scope: `rbac:write`
     *
     * @param array{aplikasi_id: int, kode: string, jenis?: string, grup?: string, nama: string, keterangan?: string, berlingkup?: bool, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIzin(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/izin', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Izin (permission): detail
     *
     * Katalog izin. Kode diawali kode aplikasinya (lms.kelas.kelola), kecuali izin aplikasi api yang sama dengan nama scope API (krs:read) atau <modul>:kelola. Izin bawaan (sistem) dibuat oleh sinkron katalog; hanya nama, grup, keterangan, dan aktif yang boleh diubah. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/izin/{id}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIzinById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/izin/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Izin (permission): ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rbac/izin/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{aplikasi_id: int, kode: string, jenis?: string, grup?: string, nama: string, keterangan?: string, berlingkup?: bool, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putIzinById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rbac/izin/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Izin (permission): hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/rbac/izin/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteIzinById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/izin/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran (role): daftar
     *
     * Peran mewarisi semua izin peran induknya (induk_id). lingkup unit: penugasan wajib menyebut unit dan izinnya hanya berlaku di unit itu dan turunannya. level_siakad: level lama yang setara. boleh_didelegasikan: boleh diberikan pengelola hak akses unit (rbac:kelola), bukan hanya admin. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/peran`
     *
     * scope: `rbac:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, aplikasi_id?: string, induk_id?: string, lingkup?: string, boleh_didelegasikan?: string, sistem?: string, aktif?: string, kode?: string, level_siakad?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/peran', [], $query, null, $options, false, false);
    }

    /**
     * Peran (role): tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/rbac/peran`
     *
     * scope: `rbac:write`
     *
     * @param array{kode: string, nama: string, keterangan?: string, aplikasi_id?: int, induk_id?: int, lingkup?: string, jenis_unit?: string, level_siakad?: string, boleh_didelegasikan?: bool, maks_pemegang?: int, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/peran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran (role): detail
     *
     * Peran mewarisi semua izin peran induknya (induk_id). lingkup unit: penugasan wajib menyebut unit dan izinnya hanya berlaku di unit itu dan turunannya. level_siakad: level lama yang setara. boleh_didelegasikan: boleh diberikan pengelola hak akses unit (rbac:kelola), bukan hanya admin. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/peran/{id}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/peran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran (role): ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rbac/peran/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, keterangan?: string, aplikasi_id?: int, induk_id?: int, lingkup?: string, jenis_unit?: string, level_siakad?: string, boleh_didelegasikan?: bool, maks_pemegang?: int, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rbac/peran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran (role): hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/rbac/peran/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/peran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Izin peran: daftar
     *
     * Satu izin milik satu peran: kode izin persis, atau pola dengan * (mis. lms.*, *.akses). Untuk mengganti seluruh izin peran sekaligus pakai PUT /v1/rbac/peran/{id}/izin. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/peran-izin`
     *
     * scope: `rbac:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, peran_id?: string, izin?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeranIzin(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/peran-izin', [], $query, null, $options, false, false);
    }

    /**
     * Izin peran: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/rbac/peran-izin`
     *
     * scope: `rbac:write`
     *
     * @param array{peran_id: int, izin: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeranIzin(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/peran-izin', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Izin peran: detail
     *
     * Satu izin milik satu peran: kode izin persis, atau pola dengan * (mis. lms.*, *.akses). Untuk mengganti seluruh izin peran sekaligus pakai PUT /v1/rbac/peran/{id}/izin. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/peran-izin/{id}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeranIzinById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/peran-izin/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Izin peran: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/rbac/peran-izin/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeranIzinById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/peran-izin/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan peran: daftar
     *
     * Peran yang diberikan ke pengguna SIAKAD (username), opsional per unit (induk_unit), dengan masa berlaku mulai/selesai. Admin memberi peran apa pun; pengelola hak akses (rbac:kelola) hanya peran yang boleh didelegasikan, di unit kewenangannya, dan bukan untuk dirinya sendiri. Pengguna bisa melihat penugasannya sendiri. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/rbac/penugasan`
     *
     * scope: `rbac:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, peran_id?: string, unit_id?: string, aktif?: string, sumber?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenugasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/penugasan', [], $query, null, $options, false, false);
    }

    /**
     * Penugasan peran: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/rbac/penugasan`
     *
     * scope: `rbac:write`
     *
     * @param array{username: string, peran_id: int, unit_id?: int, mulai?: string, selesai?: string, aktif?: bool, sumber?: string, nomor_sk?: string, alasan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenugasan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/penugasan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penugasan peran: detail
     *
     * Peran yang diberikan ke pengguna SIAKAD (username), opsional per unit (induk_unit), dengan masa berlaku mulai/selesai. Admin memberi peran apa pun; pengelola hak akses (rbac:kelola) hanya peran yang boleh didelegasikan, di unit kewenangannya, dan bukan untuk dirinya sendiri. Pengguna bisa melihat penugasannya sendiri. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/rbac/penugasan/{id}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenugasanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/penugasan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan peran: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rbac/penugasan/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, peran_id: int, unit_id?: int, mulai?: string, selesai?: string, aktif?: bool, sumber?: string, nomor_sk?: string, alasan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPenugasanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rbac/penugasan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penugasan peran: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/rbac/penugasan/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePenugasanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/penugasan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan peran: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/rbac/penugasan/{id}/berkas`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenugasanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/penugasan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan peran: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/rbac/penugasan/{id}/berkas`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenugasanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/penugasan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Penugasan peran: unduh lampiran
     *
     * `GET /v1/rbac/penugasan/{id}/berkas/{uuid}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenugasanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/penugasan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Penugasan peran: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/rbac/penugasan/{id}/berkas/{uuid}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePenugasanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/penugasan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Penugasan peran: Cabut peran
     *
     * Menonaktifkan penugasan dan mengisi tanggal selesai hari ini (riwayat tetap tersimpan). Pengelola modul.
     *
     * `POST /v1/rbac/penugasan/{id}/cabut`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenugasanByIdCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/penugasan/{id}/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran untuk level lama: daftar
     *
     * Setiap pengguna dengan level lama SIAKAD ini (user.level) otomatis memegang peran tersebut secara global. Level lama tetap menentukan menu SIAKAD web; pemetaan ini menambah peran/izin di atasnya. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/level`
     *
     * scope: `rbac:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, peran_id?: string, level?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLevel(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/level', [], $query, null, $options, false, false);
    }

    /**
     * Peran untuk level lama: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/rbac/level`
     *
     * scope: `rbac:write`
     *
     * @param array{level: string, peran_id: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLevel(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/level', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran untuk level lama: detail
     *
     * Setiap pengguna dengan level lama SIAKAD ini (user.level) otomatis memegang peran tersebut secara global. Level lama tetap menentukan menu SIAKAD web; pemetaan ini menambah peran/izin di atasnya. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/level/{id}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLevelById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/level/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran untuk level lama: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/rbac/level/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLevelById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/level/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran untuk jabatan: daftar
     *
     * Pejabat aktif (induk_pejabat, dicocokkan lewat username/NIDN/NIK karyawan) otomatis memegang peran ini di unit jabatannya selama masa jabatan. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/jabatan`
     *
     * scope: `rbac:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jabatan_id?: string, peran_id?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJabatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/jabatan', [], $query, null, $options, false, false);
    }

    /**
     * Peran untuk jabatan: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/rbac/jabatan`
     *
     * scope: `rbac:write`
     *
     * @param array{jabatan_id: int, peran_id: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJabatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rbac/jabatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran untuk jabatan: detail
     *
     * Pejabat aktif (induk_pejabat, dicocokkan lewat username/NIDN/NIK karyawan) otomatis memegang peran ini di unit jabatannya selama masa jabatan. Semua pemilik token ber-scope rbac:read.
     *
     * `GET /v1/rbac/jabatan/{id}`
     *
     * scope: `rbac:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rbac/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran untuk jabatan: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/rbac/jabatan/{id}`
     *
     * scope: `rbac:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rbac/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }
}
