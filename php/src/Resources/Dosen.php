<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Dosen, Jadwal
 */
final class Dosen extends Resource
{
    /**
     * Cari dosen
     *
     * Objek `pribadi` hanya dengan scope `dosen:pii` (token dosen: hanya dirinya).
     *
     * `GET /v1/dosen`
     *
     * scope: `dosen:read` · berhalaman
     *
     * @param array{prodi?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dosen', [], $query, null, $options, false, false);
    }

    /**
     * Profil dosen
     *
     * `GET /v1/dosen/{nidn}`
     *
     * scope: `dosen:read`
     *
     * @param int|string $nidn NIDN
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNidn(int|string $nidn, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dosen/{nidn}', ['nidn' => $nidn], $query, null, $options, false, false);
    }

    /**
     * Jadwal mengajar dosen
     *
     * Termasuk kelas di mana dosen menjadi anggota tim pengajar.
     *
     * `GET /v1/dosen/{nidn}/jadwal`
     *
     * scope: `jadwal:read` · berhalaman
     *
     * @param int|string $nidn NIDN
     * @param array{tahun_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNidnJadwal(int|string $nidn, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dosen/{nidn}/jadwal', ['nidn' => $nidn], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa bimbingan akademik (PA)
     *
     * `GET /v1/dosen/{nidn}/mahasiswa-bimbingan`
     *
     * scope: `mahasiswa:read` · berhalaman
     *
     * @param int|string $nidn NIDN
     * @param array{status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNidnMahasiswaBimbingan(int|string $nidn, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dosen/{nidn}/mahasiswa-bimbingan', ['nidn' => $nidn], $query, null, $options, false, false);
    }
}
