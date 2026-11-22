<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Referensi
 */
final class Referensi extends Resource
{
    /**
     * Profil perguruan tinggi
     *
     * `GET /v1/referensi/perguruan-tinggi`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPerguruanTinggi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/perguruan-tinggi', [], $query, null, $options, false, false);
    }

    /**
     * Daftar fakultas
     *
     * `GET /v1/referensi/fakultas`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFakultas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/fakultas', [], $query, null, $options, false, false);
    }

    /**
     * Daftar program studi
     *
     * `GET /v1/referensi/prodi`
     *
     * scope: `referensi:read`
     *
     * @param array{fakultas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProdi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/prodi', [], $query, null, $options, false, false);
    }

    /**
     * Detail program studi
     *
     * `GET /v1/referensi/prodi/{kode}`
     *
     * scope: `referensi:read`
     *
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProdiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/prodi/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Daftar tahun akademik (periode)
     *
     * Periode berformat TTTTS: tahun + semester (1 ganjil, 2 genap, 3 pendek).
     *
     * `GET /v1/referensi/tahun-akademik`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTahunAkademik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/tahun-akademik', [], $query, null, $options, false, false);
    }

    /**
     * Tahun akademik yang sedang dibuka
     *
     * Periode dengan m_tahun.buka = Y, beserta jadwal KRS, kuliah, UTS, UAS, dan input nilai.
     *
     * `GET /v1/referensi/tahun-akademik/aktif`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTahunAkademikAktif(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/tahun-akademik/aktif', [], $query, null, $options, false, false);
    }

    /**
     * Daftar kampus
     *
     * `GET /v1/referensi/kampus`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKampus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/kampus', [], $query, null, $options, false, false);
    }

    /**
     * Daftar ruang
     *
     * `GET /v1/referensi/ruang`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/ruang', [], $query, null, $options, false, false);
    }

    /**
     * Daftar kelas per prodi
     *
     * `GET /v1/referensi/kelas`
     *
     * scope: `referensi:read`
     *
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Jam kuliah per prodi
     *
     * Jam ke-n beserta jam mulai dan selesai.
     *
     * `GET /v1/referensi/jam`
     *
     * scope: `referensi:read`
     *
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJam(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/jam', [], $query, null, $options, false, false);
    }

    /**
     * Skala nilai (huruf, bobot, rentang)
     *
     * `GET /v1/referensi/skala-nilai`
     *
     * scope: `referensi:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkalaNilai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/skala-nilai', [], $query, null, $options, false, false);
    }

    /**
     * Beban tatap muka per SKS
     *
     * Menit tatap muka satu SKS kuliah per minggu yang berlaku untuk prodi dan periode, dari aturan kurikulum berversi
     * ber-SK (`isi.mata_kuliah.menit_tatap_muka_sks`, katalog pedoman `kurikulum.menit_tatap_muka_sks`). Versi dasar yang
     * cocok lingkup dan periode (angkatan diabaikan). Bawaan 50 menit bila belum diatur (`sumber` = `bawaan`).
     * Token mahasiswa tanpa `prodi` memakai prodinya sendiri. Dipakai unipo-ui untuk tinggi sesi jadwal mingguan.
     *
     * `GET /v1/referensi/beban-sks`
     *
     * scope: `referensi:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBebanSks(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/beban-sks', [], $query, null, $options, false, false);
    }

    /**
     * Daftar grup kode referensi
     *
     * Grup tabel kode (r_kode). Contoh grup 05 = status mahasiswa.
     *
     * `GET /v1/referensi/kode`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/kode', [], $query, null, $options, false, false);
    }

    /**
     * Isi satu grup kode referensi
     *
     * Mis. /v1/referensi/kode/05 untuk arti kode status_aktif mahasiswa.
     *
     * `GET /v1/referensi/kode/{aplikasi}`
     *
     * scope: `referensi:read`
     *
     * @param int|string $aplikasi Kode grup (2 karakter)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKodeByAplikasi(int|string $aplikasi, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/kode/{aplikasi}', ['aplikasi' => $aplikasi], $query, null, $options, false, false);
    }

    /**
     * Jenis item biaya
     *
     * `GET /v1/referensi/item-biaya`
     *
     * scope: `referensi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getItemBiaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/referensi/item-biaya', [], $query, null, $options, false, false);
    }
}
