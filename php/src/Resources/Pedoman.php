<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Pedoman & peraturan
 */
final class Pedoman extends Resource
{
    /**
     * Pedoman publik
     *
     * Pedoman berlaku berakses publik; q = cari isi pasal.
     *
     * `GET /v1/pedoman/publik`
     *
     * publik (tanpa token)
     *
     * @param array{q?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/publik', [], $query, null, $options, false, true);
    }

    /**
     * PDF pedoman publik
     *
     * PDF resmi versi berlaku.
     *
     * `GET /v1/pedoman/publik/{kode}/pdf`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikByKodePdf(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/publik/{kode}/pdf', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Teks pedoman publik
     *
     * Teks lengkap versi berlaku (kode dokumen).
     *
     * `GET /v1/pedoman/publik/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/publik/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Hak pedoman saya
     *
     * Izin pedoman.* pengguna dan unit pembaca.
     *
     * `GET /v1/pedoman/saya`
     *
     * scope: `pedoman:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/saya', [], $query, null, $options, false, false);
    }

    /**
     * Baca pedoman
     *
     * Pedoman berlaku untuk pembaca: universitas + fakultas/prodinya; q = cari isi.
     *
     * `GET /v1/pedoman/baca`
     *
     * scope: `pedoman:read`
     *
     * @param array{q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBaca(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/baca', [], $query, null, $options, false, false);
    }

    /**
     * Teks pedoman
     *
     * Teks lengkap versi berlaku (kode/uuid dokumen) atau versi tertentu (id) bagi penyusun/peninjau.
     *
     * `GET /v1/pedoman/baca/{kode}`
     *
     * scope: `pedoman:read`
     *
     * @param int|string $kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBacaByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/baca/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Jenis dokumen
     *
     * Jenis pedoman/peraturan (data).
     *
     * `GET /v1/pedoman/jenis`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Tambah jenis dokumen
     *
     * Hanya pengelola (LPM).
     *
     * `POST /v1/pedoman/jenis`
     *
     * scope: `pedoman:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Ubah jenis dokumen
     *
     * Unit pemilik, peninjau, alur pengesahan per lingkup, akses baca, ketegasan.
     *
     * `PUT /v1/pedoman/jenis/{id}`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putJenisById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pedoman/jenis/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Katalog parameter
     *
     * Kunci -> unit pemilik aturan -> target aturan.
     *
     * `GET /v1/pedoman/katalog`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Tambah parameter katalog
     *
     * Hanya pengelola (LPM).
     *
     * `POST /v1/pedoman/katalog`
     *
     * scope: `pedoman:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Ubah parameter katalog
     *
     * Hanya pengelola (LPM).
     *
     * `PUT /v1/pedoman/katalog/{id}`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKatalogById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pedoman/katalog/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengaturan pedoman
     *
     * Ketegasan per kategori aturan, batas hari darurat/deviasi.
     *
     * `GET /v1/pedoman/pengaturan`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah pengaturan pedoman
     *
     * Hanya pengelola (LPM).
     *
     * `PUT /v1/pedoman/pengaturan`
     *
     * scope: `pedoman:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pedoman/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pedoman
     *
     * Per jenis/lingkup/fakultas dengan versi berlaku dan versi terakhir.
     *
     * `GET /v1/pedoman/dokumen`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Pedoman baru
     *
     * Dokumen + versi 1 draf (opsional salin dari versi lain).
     *
     * `POST /v1/pedoman/dokumen`
     *
     * scope: `pedoman:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Detail pedoman
     *
     * Dokumen dan daftar versinya.
     *
     * `GET /v1/pedoman/dokumen/{id}`
     *
     * scope: `pedoman:read`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * PDF pedoman
     *
     * PDF resmi (berlaku: kode verifikasi) atau pratinjau draf.
     *
     * `GET /v1/pedoman/versi/{id}/pdf`
     *
     * scope: `pedoman:read`
     *
     * @param int|string $id
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVersiByIdPdf(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/versi/{id}/pdf', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Banding versi
     *
     * Perubahan per pasal dan parameter.
     *
     * `GET /v1/pedoman/versi/{id}/banding`
     *
     * scope: `pedoman:read`
     *
     * @param int|string $id
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVersiByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/versi/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periksa konflik
     *
     * Batas timpa pedoman induk, parameter ganda.
     *
     * `GET /v1/pedoman/versi/{id}/periksa`
     *
     * scope: `pedoman:read`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVersiByIdPeriksa(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/versi/{id}/periksa', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komentar tinjauan
     *
     * Per pasal.
     *
     * `GET /v1/pedoman/versi/{id}/komentar`
     *
     * scope: `pedoman:read`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVersiByIdKomentar(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/versi/{id}/komentar', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah komentar
     *
     * butir_kunci, isi.
     *
     * `POST /v1/pedoman/versi/{id}/komentar`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdKomentar(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/komentar', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah butir
     *
     * tipe bab|bagian|pasal|ayat|lampiran|definisi, induk_id, judul, isi (blok).
     *
     * `POST /v1/pedoman/versi/{id}/butir`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdButir(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/butir', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Urut/pindah butir
     *
     * induk_id, urutan [id].
     *
     * `POST /v1/pedoman/versi/{id}/urut`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdUrut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/urut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan parameter
     *
     * butir_id, kunci (katalog), nilai, catatan.
     *
     * `POST /v1/pedoman/versi/{id}/parameter`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdParameter(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/parameter', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Versi baru
     *
     * Salin versi menjadi draf berikutnya.
     *
     * `POST /v1/pedoman/versi/{id}/salin`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdSalin(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/salin', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: ajukan
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/ajukan`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: tarik
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/tarik`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdTarik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/tarik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: tinjau
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/tinjau`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdTinjau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/tinjau', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: setujui
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/setujui`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: kembalikan
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/kembalikan`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdKembalikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/kembalikan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: sahkan
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/sahkan`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdSahkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/sahkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: berlakukan
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/berlakukan`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdBerlakukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/berlakukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengesahan: cabut
     *
     * Alur pengesahan pedoman (catatan; tinjau: tahap, keputusan setuju|minta_ubah; sahkan: sk_id, berlaku_mulai; cabut: alasan).
     *
     * `POST /v1/pedoman/versi/{id}/cabut`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVersiByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/versi/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Versi pedoman
     *
     * Butir bernomor, parameter, alur pemeriksa, aksi yang boleh.
     *
     * `GET /v1/pedoman/versi/{id}`
     *
     * scope: `pedoman:read`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVersiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/versi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah versi
     *
     * judul, pembukaan, catatan_perubahan (draf).
     *
     * `PUT /v1/pedoman/versi/{id}`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putVersiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pedoman/versi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah butir
     *
     * judul, isi (draf).
     *
     * `PUT /v1/pedoman/butir/{id}`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putButirById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pedoman/butir/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus butir
     *
     * Beserta turunan dan parameternya (draf).
     *
     * `DELETE /v1/pedoman/butir/{id}`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteButirById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pedoman/butir/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus parameter
     *
     * Draf.
     *
     * `DELETE /v1/pedoman/parameter/{id}`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteParameterById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pedoman/parameter/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Selesaikan komentar
     *
     * `POST /v1/pedoman/komentar/{id}/selesai`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKomentarByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/komentar/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Usulan penerapan
     *
     * Per unit pemilik (unit=BAAK,SDM), status, versi.
     *
     * `GET /v1/pedoman/penerapan`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenerapan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/penerapan', [], $query, null, $options, false, false);
    }

    /**
     * Setujui usulan penerapan
     *
     * ids[], catatan: versi aturan baru dibuat lewat mekanisme aturan pemiliknya.
     *
     * `POST /v1/pedoman/penerapan/setujui`
     *
     * scope: `pedoman:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenerapanSetujui(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/penerapan/setujui', [], $query, null, $options, false, false);
    }

    /**
     * Tolak usulan penerapan
     *
     * ids[], catatan (wajib).
     *
     * `POST /v1/pedoman/penerapan/tolak`
     *
     * scope: `pedoman:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenerapanTolak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/penerapan/tolak', [], $query, null, $options, false, false);
    }

    /**
     * Dasar pedoman aturan
     *
     * target_jenis mesin_aturan|aturan_versi, target_ref (uuid/kode aturan, jenis aturan berversi).
     *
     * `GET /v1/pedoman/dasar`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDasar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/dasar', [], $query, null, $options, false, false);
    }

    /**
     * Dasbor kepatuhan
     *
     * Aturan menyimpang, tanpa dasar pedoman, deviasi.
     *
     * `GET /v1/pedoman/kepatuhan`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKepatuhan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/kepatuhan', [], $query, null, $options, false, false);
    }

    /**
     * Deviasi
     *
     * status (koma), target_ref.
     *
     * `GET /v1/pedoman/deviasi`
     *
     * scope: `pedoman:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDeviasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pedoman/deviasi', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan deviasi / darurat
     *
     * kunci, nilai, alasan, fakultas?, darurat?
     *
     * `POST /v1/pedoman/deviasi`
     *
     * scope: `pedoman:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDeviasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/deviasi', [], $query, null, $options, false, false);
    }

    /**
     * Telaah deviasi (SPMI)
     *
     * keputusan lanjut|tolak, catatan.
     *
     * `POST /v1/pedoman/deviasi/{id}/telaah`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDeviasiByIdTelaah(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/deviasi/{id}/telaah', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Putus deviasi
     *
     * keputusan setujui|tolak, tindak sementara|revisi, sampai, catatan.
     *
     * `POST /v1/pedoman/deviasi/{id}/putus`
     *
     * scope: `pedoman:write`
     *
     * @param int|string $id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDeviasiByIdPutus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pedoman/deviasi/{id}/putus', ['id' => $id], $query, null, $options, false, false);
    }
}
