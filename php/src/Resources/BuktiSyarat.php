<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Aturan: Bukti syarat
 */
final class BuktiSyarat extends Resource
{
    /**
     * Syarat bukti saya
     *
     * Mahasiswa: aturan bercara unggah/isian/ceklis yang berlaku untuknya di titik itu, dengan cara memenuhi, unit validasi, dan bukti terbaru (status belum/menunggu/diterima/ditolak/kedaluwarsa).
     *
     * `GET /v1/bukti-syarat/saya`
     *
     * scope: `syarat:read` · hanya token pengguna
     *
     * @param array{titik?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/bukti-syarat/saya', [], $query, null, $options, false, false);
    }

    /**
     * Kirim bukti
     *
     * Mahasiswa. Body {aturan_id, berkas_id? (UUID /v1/berkas), isian?: {kode: nilai}, ceklis?: [true,...], catatan?}. Format, ukuran, isian wajib, dan ceklis diperiksa sesuai aturan.
     *
     * `POST /v1/bukti-syarat`
     *
     * scope: `syarat:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/bukti-syarat', [], $query, null, $options, false, false);
    }

    /**
     * Tarik bukti
     *
     * Mahasiswa, selama masih menunggu validasi.
     *
     * `POST /v1/bukti-syarat/{id}/batal`
     *
     * scope: `syarat:write` · hanya token pengguna
     *
     * @param int|string $id UUID bukti
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/bukti-syarat/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean validasi bukti unit
     *
     * Petugas unit (izin syarat.bukti.validasi berlingkup unit; Pustikom juga pustikom.plagiasi). meta.unit = unit yang boleh divalidasi.
     *
     * `GET /v1/bukti-syarat/antrean`
     *
     * scope: `syarat:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, unit?: string, status?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/bukti-syarat/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Validasi bukti
     *
     * Body {keputusan: terima|tolak, alasan (wajib bila tolak), berlaku_sampai? (bawaan dari masa berlaku aturan)}. Mahasiswa diberi notifikasi.
     *
     * `POST /v1/bukti-syarat/{id}/putuskan`
     *
     * scope: `syarat:write`
     *
     * @param int|string $id UUID bukti
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPutuskan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/bukti-syarat/{id}/putuskan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lihat berkas bukti
     *
     * Pemilik dan petugas validasi.
     *
     * `GET /v1/bukti-syarat/{id}/berkas`
     *
     * scope: `syarat:read`
     *
     * @param int|string $id UUID bukti
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/bukti-syarat/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }
}
