<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Plagiasi: Mahasiswa & pembimbing, Plagiasi: Unit pemeriksa
 */
final class Plagiasi extends Resource
{
    /**
     * Cek plagiasi saya
     *
     * Mahasiswa: kebijakan efektif per jenis naskah (batas, kuota, SLA, format, unit pemeriksa, hasil yang berlaku) dan semua pengajuan.
     *
     * `GET /v1/plagiasi/saya`
     *
     * scope: `plagiasi:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/plagiasi/saya', [], $query, null, $options, false, false);
    }

    /**
     * Kebijakan cek plagiasi
     *
     * Dihitung dari aturan aktif bercara plagiasi (yang paling ketat bila ada aturan kampus dan fakultas).
     *
     * `GET /v1/plagiasi/kebijakan`
     *
     * scope: `plagiasi:read`
     *
     * @param array{jenis?: string, nim?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/plagiasi/kebijakan', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan cek plagiasi
     *
     * Mahasiswa. Body {jenis_naskah, judul? (bawaan judul TA), berkas_id (UUID /v1/berkas)}. Kuota, format, ukuran dari aturan.
     *
     * `POST /v1/plagiasi`
     *
     * scope: `plagiasi:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/plagiasi', [], $query, null, $options, false, false);
    }

    /**
     * Batalkan pengajuan
     *
     * Sebelum diproses.
     *
     * `POST /v1/plagiasi/{id}/batal`
     *
     * scope: `plagiasi:write` · hanya token pengguna
     *
     * @param int|string $id UUID pengajuan cek
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/plagiasi/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Persetujuan pembimbing
     *
     * Bila aturan mewajibkan. Body {keputusan: setuju|kembalikan, catatan?}.
     *
     * `POST /v1/plagiasi/{id}/pembimbing`
     *
     * scope: `plagiasi:write` · hanya token pengguna
     *
     * @param int|string $id UUID pengajuan cek
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPembimbing(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/plagiasi/{id}/pembimbing', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cek plagiasi mahasiswa bimbingan
     *
     * Dosen pembimbing.
     *
     * `GET /v1/plagiasi/bimbingan`
     *
     * scope: `plagiasi:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBimbingan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/plagiasi/bimbingan', [], $query, null, $options, false, false);
    }

    /**
     * Antrean cek plagiasi
     *
     * Petugas unit pemeriksa (izin pustikom.plagiasi atau syarat.bukti.validasi di unit itu). meta.ringkasan: jumlah per status, lewat SLA, rata-rata hari, rata-rata skor.
     *
     * `GET /v1/plagiasi/antrean`
     *
     * scope: `plagiasi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, status?: string, jenis?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/plagiasi/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Mulai proses
     *
     * Tandai sedang dicek.
     *
     * `POST /v1/plagiasi/{id}/proses`
     *
     * scope: `plagiasi:write`
     *
     * @param int|string $id UUID pengajuan cek
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdProses(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/plagiasi/{id}/proses', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah hasil
     *
     * Body {skor (0-100), alat, catatan?, laporan_berkas_id} atau {perlu_revisi: true, catatan}. Mahasiswa diberi notifikasi.
     *
     * `POST /v1/plagiasi/{id}/hasil`
     *
     * scope: `plagiasi:write`
     *
     * @param int|string $id UUID pengajuan cek
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHasil(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/plagiasi/{id}/hasil', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh naskah
     *
     * `GET /v1/plagiasi/{id}/naskah`
     *
     * scope: `plagiasi:read`
     *
     * @param int|string $id UUID pengajuan cek
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdNaskah(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/plagiasi/{id}/naskah', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh laporan hasil
     *
     * `GET /v1/plagiasi/{id}/laporan`
     *
     * scope: `plagiasi:read`
     *
     * @param int|string $id UUID pengajuan cek
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdLaporan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/plagiasi/{id}/laporan', ['id' => $id], $query, null, $options, false, false);
    }
}
