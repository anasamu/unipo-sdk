<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Pemeriksa: Alur pemeriksa usulan
 */
final class Pemeriksa extends Resource
{
    /**
     * Katalog alur pemeriksa
     *
     * Setiap jenis usulan/pengajuan beserta tahapan pemeriksanya (urut, judul, unit, peran, izin, opsional, otomatis, keterangan). Token pengguna aplikasi mana pun; tanpa scope khusus. ?kelompok= menyaring (mis. Mahasiswa, Kepegawaian, Struktur organisasi).
     *
     * `GET /v1/pemeriksa/alur`
     *
     * hanya token pengguna
     *
     * @param array{kelompok?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pemeriksa/alur', [], $query, null, $options, false, false);
    }

    /**
     * Alur pemeriksa satu jenis
     *
     * Untuk pratinjau di formulir sebelum dikirim, mis. organisasi.pejabat: 1. Biro SDM (verifikasi dan penetapan) 2. Pustikom (hak akses, otomatis bila jabatan sudah dipetakan ke peran).
     *
     * `GET /v1/pemeriksa/alur/{jenis}`
     *
     * hanya token pengguna
     *
     * @param int|string $jenis Kunci jenis, mis. organisasi.pejabat, akademik.pengajuan
     * @param array{alur?: string, penetapan?: string, persetujuan_fakultas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlurByJenis(int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pemeriksa/alur/{jenis}', ['jenis' => $jenis], $query, null, $options, false, false);
    }
}
