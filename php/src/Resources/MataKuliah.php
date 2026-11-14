<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Akademik
 */
final class MataKuliah extends Resource
{
    /**
     * Mata kuliah (kurikulum per periode)
     *
     * `GET /v1/mata-kuliah`
     *
     * scope: `akademik:read` · berhalaman
     *
     * @param array{prodi?: string, tahun_id?: string, semester?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mata-kuliah', [], $query, null, $options, false, false);
    }
}
