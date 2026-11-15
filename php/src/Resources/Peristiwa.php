<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Event domain
 */
final class Peristiwa extends Resource
{
    /**
     * Katalog event dan pendengar
     *
     * Semua event domain yang diterbitkan modul SIAKAD (jenis, isi data, contoh, scope yang wajib dimiliki aplikasi penerima),
     * pendengar di dalam SIAKAD yang bereaksi, dan penerus luar (webhook, message broker) beserta status aktifnya.
     *
     * Aplikasi berlangganan event lewat **POST /v1/integrasi/webhook** (`"event": ["mahasiswa.lulus"]`); pesan yang dikirim
     * berisi amplop yang sama dengan `PeristiwaAmplop` (id event dipakai untuk membuang duplikat).
     *
     * `GET /v1/peristiwa/katalog`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/peristiwa/katalog', [], $query, null, $options, false, true);
    }

    /**
     * Peta alur bisnis lintas modul
     *
     * Langkah, endpoint pemicu, event, dan reaksi modul lain untuk alur utama (PMB ke mahasiswa, bayar ke KRS, kuliah ke nilai, lulus ke alumni), plus diagram Mermaid seluruh event dan pendengar.
     *
     * `GET /v1/peristiwa/alur`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/peristiwa/alur', [], $query, null, $options, false, true);
    }

    /**
     * Statistik outbox dan pengantaran
     *
     * Jumlah event per status, pengantaran per status dan per tujuan (pendengar/penerus), dan waktu event tertua yang belum terkirim. Dipakai dasbor Pustikom.
     *
     * `GET /v1/peristiwa/statistik`
     *
     * scope: `peristiwa:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/peristiwa/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Daftar event (outbox)
     *
     * Terbaru dulu. Filter: jenis, sumber (nama modul atau siakad/<modul>), subjek (mis. NIM), korelasi_id (request_id API), status (baru|disebar), tujuan (kode pendengar/penerus), pengantaran (antre|proses|terkirim|mati|dilewati) untuk melihat dead letter.
     *
     * `GET /v1/peristiwa`
     *
     * scope: `peristiwa:admin` · berhalaman
     *
     * @param array{jenis?: string, sumber?: string, subjek?: string, korelasi_id?: string, status?: string, tujuan?: string, pengantaran?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/peristiwa', [], $query, null, $options, false, false);
    }

    /**
     * Proses antrean sekarang
     *
     * Body opsional {"batas": 50}. Sama dengan `php artisan peristiwa:proses` (cron tiap menit).
     *
     * `POST /v1/peristiwa/proses`
     *
     * scope: `peristiwa:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProses(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/peristiwa/proses', [], $query, null, $options, false, false);
    }

    /**
     * Detail event
     *
     * Amplop, status pengantaran ke setiap pendengar/penerus (percobaan, galat, jadwal ulang), dan event lain dalam rantai yang sama (korelasi_id).
     *
     * `GET /v1/peristiwa/{id}`
     *
     * scope: `peristiwa:admin`
     *
     * @param int|string $id UUID event
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/peristiwa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim ulang event
     *
     * Antre ulang pengantaran yang mati/dilewati lalu langsung diproses. Body opsional {"tujuan": "webhook"} untuk satu pendengar/penerus (juga untuk penerus yang baru diaktifkan sesudah event disebar).
     *
     * `POST /v1/peristiwa/{id}/ulang`
     *
     * scope: `peristiwa:admin`
     *
     * @param int|string $id UUID event
     * @param array{tujuan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUlang(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/peristiwa/{id}/ulang', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
