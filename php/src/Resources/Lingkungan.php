<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Lingkungan data
 */
final class Lingkungan extends Resource
{
    /**
     * Database yang dipakai aplikasi ini
     *
     * Aplikasi (klien API) baru memakai **database development** (salinan data live yang disamarkan) sampai akses live disetujui admin
     * di Pustikom. `lingkungan` = database request ini, `lingkungan_klien` = hak aplikasi. Setiap jawaban API juga membawa header
     * `X-Siakad-Lingkungan: live|development`. Aplikasi yang sudah live bisa tetap memakai development dengan mengirim header
     * `X-Siakad-Lingkungan: development` saat meminta token (token itu terikat ke development).
     *
     * `GET /v1/lingkungan`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lingkungan', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan akses database live
     *
     * Body `{"alasan": "Aplikasi sudah selesai diuji ..."}` (min. 10 karakter). Admin menyetujui atau menolak dari Pustikom. Bila sudah ada pengajuan yang menunggu, pengajuan itu yang dikembalikan.
     *
     * `POST /v1/lingkungan/pengajuan-live`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanLive(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lingkungan/pengajuan-live', [], $options['query'] ?? [], $body, $options, false, false);
    }
}
