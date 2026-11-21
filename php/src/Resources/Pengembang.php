<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Sistem: Log terpadu
 */
final class Pengembang extends Resource
{
    /**
     * Catat tulis penjelajah data Portal pengembang
     *
     * Dipanggil BFF Pustikom setelah setiap tambah/ubah/hapus/operasi tulis lewat penjelajah data. Hak: izin `pustikom.pengembang` atau `pustikom.pengembang.tulis` (atau administrator sistem). Pelaku = pemilik token. Body: metode, path, query, body (ringkasan, isian rahasia disamarkan ulang di server), status, hasil, request_id, menyamar_oleh, ip. Dibaca lewat /v1/sistem/log sumber `jelajah`.
     *
     * `POST /v1/pengembang/jelajah-log`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJelajahLog(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pengembang/jelajah-log', [], $options['query'] ?? [], $body, $options, false, false);
    }
}
