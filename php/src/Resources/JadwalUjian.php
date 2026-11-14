<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Jadwal
 */
final class JadwalUjian extends Resource
{
    /**
     * Jadwal ujian (UTS/UAS)
     *
     * `GET /v1/jadwal-ujian`
     *
     * scope: `jadwal:read` · berhalaman
     *
     * @param array{tahun_id?: string, prodi?: string, kode_mk?: string, ujian?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/jadwal-ujian', [], $query, null, $options, false, false);
    }
}
