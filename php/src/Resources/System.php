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
