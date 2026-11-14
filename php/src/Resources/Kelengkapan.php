<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kelengkapan data
 */
final class Kelengkapan extends Resource
{
    /**
     * Kelengkapan data saya
     *
     * Untuk token pengguna MAHASISWA dan DOSEN. Aplikasi memanggil ini setelah login:
     *
     * * `perlu_wizard: true` berarti ada isian wajib PDDikti yang kosong/tidak sah dan bisa diisi sendiri; tampilkan wizard.
     * * `kurang[]`: `kolom`, `label`, `wajib`, `alasan` (`kosong`, `tidak_sah`, `ganda`), `bisa_diisi_sendiri`.
     *   Isian yang tidak bisa diisi sendiri (mis. nama, tanggal lahir, jabatan akademik) diarahkan ke BAK/SDM.
     * * `persen_wajib`: persentase isian wajib yang sudah benar.
     *
     * `GET /v1/kelengkapan/saya`
     *
     * scope: `kelengkapan:saya` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelengkapan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Simpan isian wizard
     *
     * Body JSON berisi isian yang diisi pengguna, nama isian sama dengan `kolom` di `kurang[]`. Mahasiswa: `nik`, `nisn`,
     * `nama_ibu_kandung`, `nama_ayah`, `alamat`, `dusun`, `rt`, `rw`, `desa`, `kecamatan` (kode wilayah dari
     * `/v1/kelengkapan/referensi/wilayah`), `kode_pos`, `jenis_tinggal`, `hp`, `email`. Dosen: `nik_dosen`, `nama_ibu`,
     * `alamat`, `dusun`, `rt`, `rw`, `desa`, `kecamatan`, `kode_pos`, `hp`, `email`, `npwp`.
     *
     * Semua isian divalidasi dulu; bila ada yang salah, tidak ada yang disimpan dan galat 422 menyebut isiannya.
     * Jawaban berhasil = kelengkapan terbaru (bentuk sama dengan GET).
     *
     * `POST /v1/kelengkapan/saya`
     *
     * scope: `kelengkapan:saya` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSaya(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelengkapan/saya', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pilihan isian wizard
     *
     * Kode jenis tinggal dan daftar isian yang bisa diisi sendiri per entitas.
     *
     * `GET /v1/kelengkapan/referensi`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelengkapan/referensi', [], $query, null, $options, false, true);
    }

    /**
     * Cari kecamatan
     *
     * Kode wilayah kecamatan PDDikti untuk isian `kecamatan`. Cari dengan nama kecamatan, kabupaten, atau kode.
     *
     * `GET /v1/kelengkapan/referensi/wilayah`
     *
     * publik (tanpa token)
     *
     * @param array{q: string, limit?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensiWilayah(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelengkapan/referensi/wilayah', [], $query, null, $options, false, true);
    }

    /**
     * Ringkasan kelengkapan
     *
     * Per entitas: jumlah rekaman, yang lengkap isian wajib, dan per isian berapa yang sah/kosong/tidak sah/ganda. PROGDI dibatasi prodinya.
     *
     * `GET /v1/kelengkapan/ringkasan`
     *
     * scope: `kelengkapan:read`
     *
     * @param array{entitas?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelengkapan/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar rekaman belum lengkap
     *
     * Rekaman yang isian wajibnya kurang (status=semua untuk semua rekaman), untuk operator prodi.
     *
     * `GET /v1/kelengkapan/{entitas}`
     *
     * scope: `kelengkapan:read` · berhalaman
     *
     * @param int|string $entitas mahasiswa, dosen, prodi, perguruan_tinggi
     * @param array{page?: int, per_page?: int, kode_prodi?: string, status?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByEntitas(int|string $entitas, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelengkapan/{entitas}', ['entitas' => $entitas], $query, null, $options, false, false);
    }

    /**
     * Kelengkapan satu orang
     *
     * Bentuk sama dengan /saya. Untuk aplikasi dengan token klien yang memeriksa pengguna tertentu.
     *
     * `GET /v1/kelengkapan/{entitas}/{kunci}`
     *
     * scope: `kelengkapan:read`
     *
     * @param int|string $entitas mahasiswa, dosen, prodi, perguruan_tinggi
     * @param int|string $kunci NIM atau NIDN
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByEntitasByKunci(int|string $entitas, int|string $kunci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelengkapan/{entitas}/{kunci}', ['entitas' => $entitas, 'kunci' => $kunci], $query, null, $options, false, false);
    }
}
