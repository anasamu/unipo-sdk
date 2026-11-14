<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Lulusan
 */
final class Lulusan extends Resource
{
    /**
     * Daftar lulusan dan mahasiswa keluar
     *
     * Dari t_mahasiswa_status_lulus_do. Status: L lulus, D drop out, K keluar, dll.
     *
     * `GET /v1/lulusan`
     *
     * scope: `lulusan:read` · berhalaman
     *
     * @param array{prodi?: string, tahun_id?: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lulusan', [], $query, null, $options, false, false);
    }
}
