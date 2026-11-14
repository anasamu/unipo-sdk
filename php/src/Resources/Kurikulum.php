<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Akademik
 */
final class Kurikulum extends Resource
{
    /**
     * Ringkasan kurikulum per prodi (SKS wajib/pilihan/total)
     *
     * `GET /v1/kurikulum`
     *
     * scope: `akademik:read`
     *
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum', [], $query, null, $options, false, false);
    }
}
