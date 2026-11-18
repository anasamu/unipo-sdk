<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Sistem
 */
final class System extends Resource
{
    /**
     * Informasi API v1
     *
     * `GET /v1`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function info(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1', [], $query, null, $options, false, true);
    }

    /**
     * Cek kesehatan
     *
     * Memastikan API dan database berjalan. Tanpa token.
     *
     * `GET /v1/health`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function health(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/health', [], $query, null, $options, false, true);
    }

    /**
     * Status dan lingkungan aplikasi
     *
     * Untuk kaki sidebar aplikasi: status API dan database, jenis server SIAKAD (`server.lingkungan` = produksi, uji, pengembangan,
     * atau lokal; dari `APP_LINGKUNGAN` di .env, atau ditebak dari alamat API), database yang melayani token ini
     * (`database.lingkungan` = live atau development, `label` siap tampil mis. "Live (produksi)", "Development (salinan 12 Nov)",
     * "Lokal"; `data_asli`; `alasan` development: `aplikasi` belum disetujui live, `menyamar`, atau `dipilih`), versi API dan
     * commit pendek, serta waktu server. Token apa pun, tanpa scope. Tidak memuat host, nama database, atau kredensial.
     *
     * `GET /v1/health/lingkungan`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHealthLingkungan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/health/lingkungan', [], $query, null, $options, false, false);
    }

    /**
     * Spesifikasi OpenAPI 3.1
     *
     * Dokumen ini. Bisa diimpor ke Postman, Insomnia, atau generator klien.
     *
     * `GET /v1/openapi.json`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function openapi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/openapi.json', [], $query, null, $options, false, true);
    }
}
