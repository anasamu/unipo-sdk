<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Jadwal, Presensi
 */
final class Jadwal extends Resource
{
    /**
     * Jadwal kuliah
     *
     * Default periode aktif.
     *
     * `GET /v1/jadwal`
     *
     * scope: `jadwal:read` · berhalaman
     *
     * @param array{tahun_id?: string, prodi?: string, nidn?: string, kode_mk?: string, kelas?: string, hari?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Detail jadwal kuliah
     *
     * `GET /v1/jadwal/{idj}`
     *
     * scope: `jadwal:read`
     *
     * @param int|string $idj ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdj(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/jadwal/{idj}', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Peserta kelas
     *
     * Mahasiswa yang KRS-nya memakai jadwal ini. Token dosen: hanya kelas yang diajarnya.
     *
     * `GET /v1/jadwal/{idj}/peserta`
     *
     * scope: `krs:read`
     *
     * @param int|string $idj ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdjPeserta(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/jadwal/{idj}/peserta', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Presensi dosen (berita acara) satu kelas
     *
     * `GET /v1/jadwal/{idj}/presensi`
     *
     * scope: `presensi:read`
     *
     * @param int|string $idj ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdjPresensi(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/jadwal/{idj}/presensi', ['idj' => $idj], $query, null, $options, false, false);
    }
}
