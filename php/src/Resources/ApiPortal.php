<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Portal API: Pengajuan, Portal API: Aplikasi saya, Portal API: Tinjauan Pustikom
 */
final class ApiPortal extends Resource
{
    /**
     * Informasi portal
     *
     * Jenis pengajuan, platform, dan katalog scope (dikelompokkan per modul) untuk formulir pengajuan. Tanpa token.
     *
     * `GET /v1/api-portal/info`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfo(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/info', [], $query, null, $options, false, true);
    }

    /**
     * Ringkasan saya
     *
     * Profil singkat, apakah peninjau, jumlah pengajuan per status, jumlah aplikasi, dan (untuk peninjau) pengajuan yang menunggu.
     *
     * `GET /v1/api-portal/saya`
     *
     * scope: `apiportal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/saya', [], $query, null, $options, false, false);
    }

    /**
     * Pengajuan saya
     *
     * Pengajuan milik pemilik token, yang masih terbuka lebih dulu.
     *
     * `GET /v1/api-portal/pengajuan`
     *
     * scope: `apiportal:read` · hanya token pengguna · berhalaman
     *
     * @param array{page?: int, per_page?: int, status?: string, jenis?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan
     *
     * Membuat pengajuan baru (maksimal 5 yang belum selesai per orang).
     *
     * * `aplikasi_baru`: aplikasi untuk civitas. `butuh_sso: true` + `redirect_uris` bila pengguna login lewat SSO UNIPO; `scopes` bila memakai data SIAKAD.
     * * `akses_api`: integrasi server/skrip/penelitian tanpa login pengguna; `scopes` wajib.
     * * `tambah_scope`: `aplikasi_id` milik Anda + `scopes` tambahan.
     *
     * Scope `*:admin` tidak bisa diajukan. Aplikasi yang disetujui memakai database development; akses live diajukan dari halaman aplikasi.
     *
     * `POST /v1/api-portal/pengajuan`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param array{jenis: string, aplikasi_id?: int, nama_aplikasi: string, keterangan?: string, tujuan: string, platform?: string, url?: string, repositori?: string, butuh_sso?: bool, redirect_uris?: list<mixed>, scopes?: list<mixed>, perkiraan_pengguna?: string, pembimbing?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/pengajuan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail pengajuan
     *
     * Dengan riwayat (percakapan pemohon-peninjau) dan aplikasi hasil persetujuan. Pemohon atau peninjau.
     *
     * `GET /v1/api-portal/pengajuan/{id}`
     *
     * scope: `apiportal:read` · hanya token pengguna
     *
     * @param int|string $id ID angka, UUID, atau nomor pengajuan (API-2026-00001)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah pengajuan
     *
     * Hanya pemohon, selama status diajukan atau perlu_revisi. Pengajuan perlu_revisi kembali menjadi diajukan. `catatan` opsional untuk peninjau.
     *
     * `PUT /v1/api-portal/pengajuan/{id}`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka, UUID, atau nomor pengajuan (API-2026-00001)
     * @param array{jenis: string, aplikasi_id?: int, nama_aplikasi: string, keterangan?: string, tujuan: string, platform?: string, url?: string, repositori?: string, butuh_sso?: bool, redirect_uris?: list<mixed>, scopes?: list<mixed>, perkiraan_pengguna?: string, pembimbing?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengajuanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/api-portal/pengajuan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan pengajuan
     *
     * Hanya pemohon, selama belum diputuskan. Body opsional `{"catatan": "..."}`.
     *
     * `POST /v1/api-portal/pengajuan/{id}/batal`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka, UUID, atau nomor pengajuan (API-2026-00001)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/pengajuan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim komentar
     *
     * Percakapan pemohon dan peninjau: `{"catatan": "..."}`.
     *
     * `POST /v1/api-portal/pengajuan/{id}/komentar`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka, UUID, atau nomor pengajuan (API-2026-00001)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdKomentar(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/pengajuan/{id}/komentar', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aplikasi saya
     *
     * Aplikasi hasil pengajuan yang disetujui: client id, scope, lingkungan (development/live), status akses live, dan apakah secret belum diambil.
     *
     * `GET /v1/api-portal/aplikasi`
     *
     * scope: `apiportal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAplikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/aplikasi', [], $query, null, $options, false, false);
    }

    /**
     * Detail aplikasi
     *
     * Dengan riwayat pengajuan dan akses live.
     *
     * `GET /v1/api-portal/aplikasi/{id}`
     *
     * scope: `apiportal:read` · hanya token pengguna
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAplikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/aplikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ambil secret (sekali)
     *
     * Secret klien API dan SSO dari persetujuan, hanya untuk pemilik dan hanya sekali; setelah itu dihapus dari server. Jawaban: `{"api": {"client_id", "client_secret"}, "sso": {...}}`.
     *
     * `POST /v1/api-portal/aplikasi/{id}/kredensial`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAplikasiByIdKredensial(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/aplikasi/{id}/kredensial', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat secret API baru
     *
     * Secret lama langsung tidak berlaku; secret baru hanya muncul sekali. Secret SSO hanya bisa diganti Pustikom.
     *
     * `POST /v1/api-portal/aplikasi/{id}/secret-api`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAplikasiByIdSecretApi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/aplikasi/{id}/secret-api', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan akses database live
     *
     * Body `{"alasan": "..."}` (min. 10 karakter). Ditinjau di Pustikom (Database development » Akses live).
     *
     * `POST /v1/api-portal/aplikasi/{id}/akses-live`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAplikasiByIdAksesLive(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/aplikasi/{id}/akses-live', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Semua pengajuan
     *
     * Untuk peninjau (level ADMIN, izin api-portal.tinjau, atau admin modul apiportal). `meta.rekap` berisi jumlah per status.
     *
     * `GET /v1/api-portal/tinjau`
     *
     * scope: `apiportal:read` · hanya token pengguna · berhalaman
     *
     * @param array{page?: int, per_page?: int, status?: string, jenis?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTinjau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/tinjau', [], $query, null, $options, false, false);
    }

    /**
     * Minta revisi
     *
     * `{"catatan": "apa yang perlu diperbaiki"}` (wajib).
     *
     * `POST /v1/api-portal/tinjau/{id}/revisi`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka, UUID, atau nomor pengajuan (API-2026-00001)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTinjauByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/tinjau/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tolak
     *
     * `{"catatan": "alasan"}` (wajib).
     *
     * `POST /v1/api-portal/tinjau/{id}/tolak`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka, UUID, atau nomor pengajuan (API-2026-00001)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTinjauByIdTolak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/tinjau/{id}/tolak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui
     *
     * Body (semua opsional):
     *
     * * `scopes`: scope yang diberikan (bawaan = yang diminta; boleh dikurangi atau ditambah).
     * * `catatan`: pesan untuk pemohon.
     * * Aplikasi baru/akses API: bila klien sudah dibuat dari wizard **Aplikasi baru** Pustikom, kirim `client_id_api`,
     *   `client_secret_api`, `client_id_sso`, `client_secret_sso`, `rbac_aplikasi_id`. Bila `client_id_api` tidak dikirim dan
     *   ada scope, klien API dibuat otomatis (database development, origin dari alamat aplikasi web, tukar token SSO bila
     *   `client_id_sso` dikirim). Secret disimpan terenkripsi sampai pemohon mengambilnya sekali.
     * * Tambah scope: scope ditambahkan ke klien API aplikasi pemohon.
     *
     * `POST /v1/api-portal/tinjau/{id}/setujui`
     *
     * scope: `apiportal:write` · hanya token pengguna
     *
     * @param int|string $id ID angka, UUID, atau nomor pengajuan (API-2026-00001)
     * @param array{scopes?: list<mixed>, catatan?: string, client_id_api?: string, client_secret_api?: string, client_id_sso?: string, client_secret_sso?: string, rbac_aplikasi_id?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTinjauByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/api-portal/tinjau/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Semua aplikasi portal
     *
     * Aplikasi yang terdaftar lewat portal beserta pemiliknya (500 terbaru).
     *
     * `GET /v1/api-portal/tinjau-aplikasi`
     *
     * scope: `apiportal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTinjauAplikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/api-portal/tinjau-aplikasi', [], $query, null, $options, false, false);
    }
}
