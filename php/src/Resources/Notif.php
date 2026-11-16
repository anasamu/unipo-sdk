<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Notifikasi: Kotak masuk, Notifikasi: Preferensi, Notifikasi: Antrean, Notifikasi: Pengumuman
 */
final class Notif extends Resource
{
    /**
     * Jumlah belum dibaca
     *
     * `GET /v1/notif/ringkas`
     *
     * scope: `notif:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/ringkas', [], $query, null, $options, false, false);
    }

    /**
     * Tandai semua dibaca
     *
     * `POST /v1/notif/kotak/baca-semua`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKotakBacaSemua(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kotak/baca-semua', [], $query, null, $options, false, false);
    }

    /**
     * Kirim notifikasi
     *
     * Untuk aplikasi lain atau pengelola: body {"username": [..], "judul", "isi", "tautan", "modul"}. Masuk kotak masuk penerima dan antrean kanal sesuai preferensi mereka.
     *
     * `POST /v1/notif/kirim`
     *
     * scope: `notif:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKirim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kirim', [], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: daftar
     *
     * Notifikasi milik pemilik token (pengelola melihat semua). Filter `belum=1` untuk yang belum dibaca. Dibuat oleh modul lain atau POST /notif/kirim. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/kotak`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, modul?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKotak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/kotak', [], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: detail
     *
     * Notifikasi milik pemilik token (pengelola melihat semua). Filter `belum=1` untuk yang belum dibaca. Dibuat oleh modul lain atau POST /notif/kirim. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/kotak/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKotakById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/kotak/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/notif/kotak/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKotakById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/notif/kotak/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Notifikasi milik pemilik token (pengelola melihat semua). Filter `belum=1` untuk yang belum dibaca. Dibuat oleh modul lain atau POST /notif/kirim. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/kotak/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKotakByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/kotak/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: Tandai dibaca
     *
     * Pemilik data.
     *
     * `POST /v1/notif/kotak/{id}/baca`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKotakByIdBaca(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kotak/{id}/baca', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: daftar
     *
     * Kanal tambahan pengguna (email, WhatsApp, push, Telegram); username diisi otomatis untuk pengguna biasa. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/preferensi`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, kanal?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPreferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/preferensi', [], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/notif/preferensi`
     *
     * scope: `notif:write`
     *
     * @param array{username: string, kanal: string, tujuan: string, modul?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPreferensi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/preferensi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Preferensi kanal: detail
     *
     * Kanal tambahan pengguna (email, WhatsApp, push, Telegram); username diisi otomatis untuk pengguna biasa. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/preferensi/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPreferensiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/preferensi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/notif/preferensi/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, kanal: string, tujuan: string, modul?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPreferensiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/notif/preferensi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Preferensi kanal: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/notif/preferensi/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePreferensiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/notif/preferensi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kanal tambahan pengguna (email, WhatsApp, push, Telegram); username diisi otomatis untuk pengguna biasa. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/preferensi/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPreferensiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/preferensi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: daftar
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/notif/antrean`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kanal?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: detail
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/notif/antrean/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/antrean/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Hanya pengelola modul.
     *
     * `GET /v1/notif/antrean/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/antrean/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: Kirim ulang
     *
     * Pengelola modul. Status harus gagal/dibatalkan, menjadi antre.
     *
     * `POST /v1/notif/antrean/{id}/ulang`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByIdUlang(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/antrean/{id}/ulang', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: Batalkan
     *
     * Pengelola modul. Status harus antre/gagal, menjadi dibatalkan.
     *
     * `POST /v1/notif/antrean/{id}/batalkan`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/antrean/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: daftar
     *
     * Pengumuman ke semua pengguna aktif, level tertentu, mahasiswa satu prodi/angkatan, atau daftar username. Aksi kirim membuat notifikasi di kotak masuk setiap penerima. Hanya pengelola modul.
     *
     * `GET /v1/notif/pengumuman`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, sasaran?: string, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumuman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pengumuman', [], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/notif/pengumuman`
     *
     * scope: `notif:write`
     *
     * @param array{judul: string, isi: string, tautan?: string, sasaran?: string, level?: string, kode_prodi?: string, angkatan?: string, daftar_username?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengumuman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pengumuman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman massal: detail
     *
     * Pengumuman ke semua pengguna aktif, level tertentu, mahasiswa satu prodi/angkatan, atau daftar username. Aksi kirim membuat notifikasi di kotak masuk setiap penerima. Hanya pengelola modul.
     *
     * `GET /v1/notif/pengumuman/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/notif/pengumuman/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, isi: string, tautan?: string, sasaran?: string, level?: string, kode_prodi?: string, angkatan?: string, daftar_username?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengumumanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/notif/pengumuman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman massal: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/notif/pengumuman/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/notif/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pengumuman ke semua pengguna aktif, level tertentu, mahasiswa satu prodi/angkatan, atau daftar username. Aksi kirim membuat notifikasi di kotak masuk setiap penerima. Hanya pengelola modul.
     *
     * `GET /v1/notif/pengumuman/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumumanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pengumuman/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: Kirim
     *
     * Pengelola modul. Status harus draf, menjadi terkirim.
     *
     * `POST /v1/notif/pengumuman/{id}/kirim`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengumumanByIdKirim(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pengumuman/{id}/kirim', ['id' => $id], $query, null, $options, false, false);
    }
}
