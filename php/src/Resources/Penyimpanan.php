<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Penyimpanan, Penyimpanan: Unit, Penyimpanan: Pustikom
 */
final class Penyimpanan extends Resource
{
    /**
     * Penyimpanan saya
     *
     * Kuota efektif beserta asalnya, terpakai, sisa, per modul dan jenis berkas, kolam unit, berkas terbesar, sampah, tren, riwayat permintaan tambah kuota, dan aturan resolusi. Hanya metadata.
     *
     * `GET /v1/penyimpanan/saya`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Kebijakan efektif untuk unggah
     *
     * Batas ukuran, jenis berkas, kuota dan sisa untuk ruang pribadi pemanggil atau ruang bersama `unit`. Dipakai komponen unggah unipo-ui sebelum mengunggah.
     *
     * `GET /v1/penyimpanan/efektif`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEfektif(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/efektif', [], $query, null, $options, false, false);
    }

    /**
     * Daftar permintaan tambah kuota
     *
     * `arah=saya` (bawaan) atau `arah=periksa` (pengelola unit: unitnya; Pustikom: semua). `status` = menunggu, menunggu_unit, menunggu_pustikom, disetujui, ditolak.
     *
     * `GET /v1/penyimpanan/permintaan`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{arah?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermintaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/permintaan', [], $query, null, $options, false, false);
    }

    /**
     * Minta tambah kuota
     *
     * Body: `lingkup` (pengguna/unit), `unit` (untuk kolam unit; hanya pengelola unit), `tambah_byte`, `alasan`. Permintaan pengguna diperiksa pengelola unit utamanya lalu Pustikom; permintaan unit langsung ke Pustikom.
     *
     * `POST /v1/penyimpanan/permintaan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermintaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/permintaan', [], $query, null, $options, false, false);
    }

    /**
     * Putuskan permintaan tambah kuota
     *
     * Body: `setuju` (bool), `catatan`, opsional `tambah_byte` (Pustikom boleh mengubah besarnya). Tahap unit: pengelola unit; tahap Pustikom: persetujuan memperbarui kebijakan pengguna/kolam unit.
     *
     * `POST /v1/penyimpanan/permintaan/{id}/putuskan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID permintaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermintaanByIdPutuskan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/permintaan/{id}/putuskan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan permintaan
     *
     * Hanya pemohon, selama belum diputuskan.
     *
     * `POST /v1/penyimpanan/permintaan/{id}/batal`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID permintaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermintaanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/permintaan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kartu penyimpanan per unit
     *
     * Setiap unit: kolam (atau mengikuti bawaan), teralokasi, terpakai nyata, sisa, persen, jumlah anggota, kelompok. Pustikom: semua unit; pengelola: unitnya. Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `GET /v1/penyimpanan/unit`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/unit', [], $query, null, $options, false, false);
    }

    /**
     * Rincian unit
     *
     * Pembagian kolam (kelompok, sub-unit, pengecualian pengguna), perkiraan anggota, pemakaian per kelompok dan modul. Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `GET /v1/penyimpanan/unit/{kode}`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode unit berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/unit/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Bagi kuota unit
     *
     * Body: `bersama_byte`, `kelompok` [{kelompok: dosen|tendik|mahasiswa|peran:<kode>, mode: orang|total, kuota_byte}], `subunit` [{kode, kuota_byte}], `pengguna` [{username, kuota_byte}]; Pustikom juga `kolam_byte` dan `boleh_lebih`. Ditolak 422 `alokasi_melebihi_kolam` bila teralokasi > kolam (kecuali boleh_lebih). Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `POST /v1/penyimpanan/unit/{kode}/bagi`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode unit berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnitByKodeBagi(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/unit/{kode}/bagi', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Akumulasi total penyimpanan
     *
     * Terpakai, kapasitas, teralokasi, sisa, jumlah berkas, sampah, per modul, per jenis, pertumbuhan 30 hari, waktu terakhir dihitung. Tanpa `unit`: seluruh sistem (Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.). Dengan `unit`: unit itu (Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.).
     *
     * `GET /v1/penyimpanan/ringkasan`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Statistik penyimpanan
     *
     * Tren harian/bulanan, proyeksi penuh, per unit, pengguna teratas, sebaran ukuran, berkas terbesar, duplikat dan potensi hemat, sampah dan yang akan terhapus, unggahan ditolak, permintaan kuota. Saring `dari`, `sampai` (YYYY-MM-DD), `unit`.
     *
     * `GET /v1/penyimpanan/statistik`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{unit?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Penyimpanan per pengguna
     *
     * Kuota efektif dan asalnya, terpakai, sisa, persen. Saring `q`, `unit`, `peran` (kode peran/kelompok), `status` (hampir, penuh, aman, pengecualian). Tanpa `unit`: Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator. Dengan `unit`: Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `GET /v1/penyimpanan/pengguna`
     *
     * scope: `berkas:read` · hanya token pengguna · berhalaman
     *
     * @param array{q?: string, unit?: string, peran?: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengguna(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/pengguna', [], $query, null, $options, false, false);
    }

    /**
     * Rincian penyimpanan pengguna
     *
     * Metadata saja (nama berkas, ukuran, modul), tercatat di log. Pengguna sendiri, pengelola unit utamanya, atau Pustikom.
     *
     * `GET /v1/penyimpanan/pengguna/{username}`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param int|string $username Username
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenggunaByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/pengguna/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Kosongkan sampah pengguna
     *
     * Hapus permanen isi sampah ruang pribadi pengguna (atas permintaannya); tercatat di log. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/penyimpanan/pengguna/{username}/sampah/kosongkan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $username Username
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenggunaByUsernameSampahKosongkan(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/pengguna/{username}/sampah/kosongkan', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Daftar kebijakan
     *
     * Semua baris kebijakan (bawaan, unit, kelompok, peran, pengguna), nilai konfigurasi server, aturan resolusi, daftar unit. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `GET /v1/penyimpanan/kebijakan`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/kebijakan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan kebijakan
     *
     * Body: `lingkup` (bawaan, unit, kelompok, peran, pengguna, aplikasi), `kunci` (kode unit/peran/username; aplikasi: client_id, hanya `maks_berkas_byte`, `ekstensi_izin`, `ekstensi_larang`, `mime_larang`), untuk kelompok `unit`+`kelompok`+`mode`; nilai: `kuota_byte`, `bersama_byte`, `boleh_lebih`, `kapasitas_byte` (bawaan), `maks_berkas_byte`, `ekstensi_izin`, `ekstensi_larang`, `mime_larang`, `maks_jumlah`, `sampah_hari`, `bagi_publik`, `tautan_maks_hari`, `wajib_enkripsi`, `retensi_versi`, `catatan`. null = ikut tingkat di atasnya. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/penyimpanan/kebijakan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKebijakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/kebijakan', [], $query, null, $options, false, false);
    }

    /**
     * Hapus kebijakan
     *
     * Body: `lingkup`, `kunci`. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/penyimpanan/kebijakan/hapus`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKebijakanHapus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/kebijakan/hapus', [], $query, null, $options, false, false);
    }

    /**
     * Simulasi kebijakan efektif
     *
     * Kebijakan efektif untuk kombinasi `username` × `klien` (aplikasi) × ruang (`unit` = ruang bersama unit; kosong = ruang pribadi) beserta asal setiap nilai, `batas_unggah` (ukuran/jenis dan sumbernya), dan kolam unit yang membatasinya.
     *
     * `GET /v1/penyimpanan/simulasi`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{username?: string, unit?: string, klien?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSimulasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/penyimpanan/simulasi', [], $query, null, $options, false, false);
    }

    /**
     * Hitung ulang pemakaian
     *
     * Rekonsiliasi sekarang dari tabel berkas (tanpa mengosongkan sampah). Cron: `php artisan penyimpanan:rekonsiliasi`. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/penyimpanan/hitung-ulang`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHitungUlang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/penyimpanan/hitung-ulang', [], $query, null, $options, false, false);
    }
}
