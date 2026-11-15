<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Repositori: OAI-PMH, Repositori: Karya, Repositori: Koleksi
 */
final class Repositori extends Resource
{
    /**
     * OAI-PMH 2.0
     *
     * Titik panen metadata (oai_dc) untuk Garuda, Google Scholar, BASE, OpenAIRE. Verb: Identify, ListMetadataFormats, ListSets (jenis:<jenis>, koleksi:<kode>), ListIdentifiers, ListRecords, GetRecord. 100 rekaman per halaman dengan resumptionToken. Hanya karya yang diterbitkan.
     *
     * `GET /v1/repositori/oai`
     *
     * publik (tanpa token)
     *
     * @param array{verb?: string, metadataPrefix?: string, identifier?: string, from?: string, until?: string, set?: string, resumptionToken?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/oai', [], $query, null, $options, false, true);
    }

    /**
     * Statistik repositori
     *
     * Jumlah karya terbit per jenis, tahun, dan prodi (publik).
     *
     * `GET /v1/repositori/statistik`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/statistik', [], $query, null, $options, false, true);
    }

    /**
     * Impor dari tugas akhir lama
     *
     * Membuat draf karya dari t_mahasiswa_ta yang lulus dan belum ada di repositori (judul, abstraksi, pembimbing, tanggal ujian). Tabel lama hanya dibaca. Body opsional: kode_prodi, tahun_id, batas (bawaan 500). Mahasiswa lalu mengunggah teks lengkap dan mengajukan. Hanya pengelola.
     *
     * `POST /v1/repositori/impor-ta`
     *
     * scope: `repositori:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postImporTa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/impor-ta', [], $query, null, $options, false, false);
    }

    /**
     * Koleksi: daftar
     *
     * Semua pemilik token ber-scope repositori:read.
     *
     * `GET /v1/repositori/koleksi`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, unit_id?: string, kode_prodi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKoleksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/koleksi', [], $query, null, $options, false, true);
    }

    /**
     * Koleksi: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/repositori/koleksi`
     *
     * scope: `repositori:write`
     *
     * @param array{kode: string, nama: string, deskripsi?: string, unit_id?: int, kode_prodi?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKoleksi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/koleksi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Koleksi: detail
     *
     * Semua pemilik token ber-scope repositori:read.
     *
     * `GET /v1/repositori/koleksi/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKoleksiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/koleksi/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Koleksi: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/repositori/koleksi/{id}`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, deskripsi?: string, unit_id?: int, kode_prodi?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKoleksiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/repositori/koleksi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Koleksi: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/repositori/koleksi/{id}`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKoleksiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/repositori/koleksi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Karya ilmiah: daftar
     *
     * Metadata karya yang diterbitkan terbuka untuk umum (juga tanpa token). Teks lengkap dilampirkan lewat /berkas dan bisa diunduh sesuai `akses` (publik, login, tertutup) dan `embargo_sampai`. Mahasiswa/dosen menyetor karyanya sendiri (penulis_username otomatis), lalu `ajukan`; pustakawan memeriksa (cek plagiasi) dan `terbitkan`, `minta-revisi`, atau `tolak`. Semua pemilik token ber-scope repositori:read (selain pengelola hanya melihat status diterbitkan atau miliknya sendiri).
     *
     * `GET /v1/repositori/karya`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, koleksi_id?: string, jenis?: string, penulis_username?: string, kode_prodi?: string, akses?: string, status?: string, diperiksa_oleh?: string, tahun?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKarya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/karya', [], $query, null, $options, false, true);
    }

    /**
     * Karya ilmiah: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (penulis_username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `POST /v1/repositori/karya`
     *
     * scope: `repositori:write`
     *
     * @param array{koleksi_id?: int, jenis: string, judul: string, judul_en?: string, abstrak?: string, abstrak_en?: string, kata_kunci?: string, penulis_username: string, penulis_nama?: string, penulis_lain?: array<string, mixed>, pembimbing?: array<string, mixed>, kode_prodi?: string, tahun: int, tanggal?: string, bahasa?: string, halaman?: int, penerbit?: string, doi?: string, isbn_issn?: string, url?: string, lisensi?: string, akses?: string, embargo_sampai?: string, skor_plagiasi?: float|int, alat_plagiasi?: string, ta_id?: int, lppm_luaran_id?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKarya(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/karya', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Karya ilmiah: detail
     *
     * Metadata karya yang diterbitkan terbuka untuk umum (juga tanpa token). Teks lengkap dilampirkan lewat /berkas dan bisa diunduh sesuai `akses` (publik, login, tertutup) dan `embargo_sampai`. Mahasiswa/dosen menyetor karyanya sendiri (penulis_username otomatis), lalu `ajukan`; pustakawan memeriksa (cek plagiasi) dan `terbitkan`, `minta-revisi`, atau `tolak`. Semua pemilik token ber-scope repositori:read (selain pengelola hanya melihat status diterbitkan atau miliknya sendiri).
     *
     * `GET /v1/repositori/karya/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKaryaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/karya/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Karya ilmiah: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (penulis_username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/repositori/karya/{id}`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{koleksi_id?: int, jenis: string, judul: string, judul_en?: string, abstrak?: string, abstrak_en?: string, kata_kunci?: string, penulis_username: string, penulis_nama?: string, penulis_lain?: array<string, mixed>, pembimbing?: array<string, mixed>, kode_prodi?: string, tahun: int, tanggal?: string, bahasa?: string, halaman?: int, penerbit?: string, doi?: string, isbn_issn?: string, url?: string, lisensi?: string, akses?: string, embargo_sampai?: string, skor_plagiasi?: float|int, alat_plagiasi?: string, ta_id?: int, lppm_luaran_id?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKaryaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/repositori/karya/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Karya ilmiah: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (penulis_username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `DELETE /v1/repositori/karya/{id}`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKaryaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/repositori/karya/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Karya ilmiah: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/repositori/karya/{id}/berkas`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKaryaByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/karya/{id}/berkas', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Karya ilmiah: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (penulis_username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `POST /v1/repositori/karya/{id}/berkas`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKaryaByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/karya/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Karya ilmiah: unduh lampiran
     *
     * `GET /v1/repositori/karya/{id}/berkas/{uuid}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKaryaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/repositori/karya/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, true);
    }

    /**
     * Karya ilmiah: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (penulis_username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `DELETE /v1/repositori/karya/{id}/berkas/{uuid}`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKaryaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/repositori/karya/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Karya ilmiah: Ajukan untuk diperiksa
     *
     * Pemilik data atau pengelola. Status harus draf/revisi, menjadi diajukan.
     *
     * `POST /v1/repositori/karya/{id}/ajukan`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKaryaByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/karya/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Karya ilmiah: Terbitkan
     *
     * Pengelola modul. Status harus diajukan/ditarik, menjadi diterbitkan.
     *
     * `POST /v1/repositori/karya/{id}/terbitkan`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{skor_plagiasi?: float|int, alat_plagiasi?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKaryaByIdTerbitkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/karya/{id}/terbitkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Karya ilmiah: Minta revisi
     *
     * Pengelola modul. Status harus diajukan, menjadi revisi.
     *
     * `POST /v1/repositori/karya/{id}/minta-revisi`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, skor_plagiasi?: float|int, alat_plagiasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKaryaByIdMintaRevisi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/karya/{id}/minta-revisi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Karya ilmiah: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/repositori/karya/{id}/tolak`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKaryaByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/karya/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Karya ilmiah: Tarik dari publikasi
     *
     * Admin modul. Status harus diterbitkan, menjadi ditarik.
     *
     * `POST /v1/repositori/karya/{id}/tarik`
     *
     * scope: `repositori:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKaryaByIdTarik(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/repositori/karya/{id}/tarik', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
