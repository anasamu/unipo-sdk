<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Keuangan
 */
final class Keuangan extends Resource
{
    /**
     * Master biaya per prodi dan periode
     *
     * `GET /v1/keuangan/biaya`
     *
     * scope: `keuangan:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBiaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/biaya', [], $query, null, $options, false, false);
    }

    /**
     * Transaksi pembayaran
     *
     * Untuk aplikasi keuangan/bank. Tidak untuk token mahasiswa/dosen.
     *
     * `GET /v1/keuangan/pembayaran`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{tahun_id?: string, prodi?: string, nim?: string, kode_biaya?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembayaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pembayaran', [], $query, null, $options, false, false);
    }
}
