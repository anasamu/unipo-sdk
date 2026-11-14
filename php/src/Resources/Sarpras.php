<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Sarpras: Peminjaman, Sarpras: Laporan, Sarpras: Gedung dan ruang, Sarpras: Aset, Sarpras: Pemeliharaan
 */
final class Sarpras extends Resource
{
    /**
     * Ruang tersedia
     *
     * Ruang yang bisa dipinjam dan tidak bentrok dengan peminjaman yang disetujui pada rentang waktu.
     *
     * `GET /v1/sarpras/ruang-tersedia`
     *
     * scope: `sarpras:read`
     *
     * @param array{mulai?: string, selesai?: string, kapasitas?: int, jenis?: string, gedung_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangTersedia(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/ruang-tersedia', [], $query, null, $options, false, false);
    }

    /**
     * Jadwal pemakaian ruang
     *
     * Peminjaman yang disetujui dalam rentang (bawaan 30 hari) dan jadwal kuliah mingguan dari t_jadwal (lewat `ruang_lama`, tahun akademik aktif atau `tahun_id`).
     *
     * `GET /v1/sarpras/ruang/{id}/jadwal`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID ruang
     * @param array{dari?: string, sampai?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangByIdJadwal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/ruang/{id}/jadwal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rekap sarpras
     *
     * Jumlah dan nilai aset (perolehan dan buku) per kondisi/status/kategori, ruang per jenis (kapasitas, luas), gedung, pemeliharaan terbuka dan biaya tahun ini, peminjaman 30 hari terakhir. Hanya pengelola.
     *
     * `GET /v1/sarpras/rekap`
     *
     * scope: `sarpras:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Sinkron ruang dari tabel lama
     *
     * Membuat baris ruang dari m_ruang, m_ruang_kuliah, dan kode ruang di t_jadwal yang belum terdaftar. Tabel lama tidak diubah. Hanya admin modul.
     *
     * `POST /v1/sarpras/sinkron-ruang`
     *
     * scope: `sarpras:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSinkronRuang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/sinkron-ruang', [], $query, null, $options, false, false);
    }

    /**
     * Gedung: daftar
     *
     * Semua pemilik token ber-scope sarpras:read.
     *
     * `GET /v1/sarpras/gedung`
     *
     * scope: `sarpras:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, unit_id?: string, status_milik?: string, kondisi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGedung(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/gedung', [], $query, null, $options, false, false);
    }

    /**
     * Gedung: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/sarpras/gedung`
     *
     * scope: `sarpras:write`
     *
     * @param array{kode: string, nama: string, unit_id?: int, idkp?: string, alamat?: string, jumlah_lantai?: int, luas?: float|int, tahun_bangun?: int, status_milik?: string, kondisi?: string, lintang?: float|int, bujur?: float|int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGedung(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/gedung', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Gedung: detail
     *
     * Semua pemilik token ber-scope sarpras:read.
     *
     * `GET /v1/sarpras/gedung/{id}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGedungById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/gedung/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Gedung: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/sarpras/gedung/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, unit_id?: int, idkp?: string, alamat?: string, jumlah_lantai?: int, luas?: float|int, tahun_bangun?: int, status_milik?: string, kondisi?: string, lintang?: float|int, bujur?: float|int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putGedungById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sarpras/gedung/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Gedung: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/sarpras/gedung/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteGedungById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/gedung/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Gedung: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/sarpras/gedung/{id}/berkas`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGedungByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/gedung/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Gedung: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/sarpras/gedung/{id}/berkas`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGedungByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/gedung/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Gedung: unduh lampiran
     *
     * `GET /v1/sarpras/gedung/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGedungByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/gedung/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Gedung: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/sarpras/gedung/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteGedungByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/gedung/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Ruang: daftar
     *
     * Ruang kuliah, laboratorium, kantor, aula, dll. `ruang_lama` = kode ruang yang dipakai jadwal kuliah lama (t_jadwal.ruang); isi lewat POST /sarpras/sinkron-ruang atau manual. Semua pemilik token ber-scope sarpras:read.
     *
     * `GET /v1/sarpras/ruang`
     *
     * scope: `sarpras:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, gedung_id?: string, jenis?: string, unit_id?: string, kode_prodi?: string, bisa_dipinjam?: string, kondisi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/ruang', [], $query, null, $options, false, false);
    }

    /**
     * Ruang: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/sarpras/ruang`
     *
     * scope: `sarpras:write`
     *
     * @param array{gedung_id?: int, kode: string, nama: string, jenis?: string, lantai?: int, kapasitas?: int, luas?: float|int, unit_id?: int, kode_prodi?: string, ruang_lama?: string, m_ruang_id?: int, fasilitas?: string, bisa_dipinjam?: bool, kondisi?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuang(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/ruang', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ruang: detail
     *
     * Ruang kuliah, laboratorium, kantor, aula, dll. `ruang_lama` = kode ruang yang dipakai jadwal kuliah lama (t_jadwal.ruang); isi lewat POST /sarpras/sinkron-ruang atau manual. Semua pemilik token ber-scope sarpras:read.
     *
     * `GET /v1/sarpras/ruang/{id}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/ruang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ruang: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/sarpras/ruang/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{gedung_id?: int, kode: string, nama: string, jenis?: string, lantai?: int, kapasitas?: int, luas?: float|int, unit_id?: int, kode_prodi?: string, ruang_lama?: string, m_ruang_id?: int, fasilitas?: string, bisa_dipinjam?: bool, kondisi?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRuangById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sarpras/ruang/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ruang: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/sarpras/ruang/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRuangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/ruang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ruang: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/sarpras/ruang/{id}/berkas`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/ruang/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ruang: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/sarpras/ruang/{id}/berkas`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/ruang/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Ruang: unduh lampiran
     *
     * `GET /v1/sarpras/ruang/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/ruang/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Ruang: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/sarpras/ruang/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRuangByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/ruang/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Kategori aset: daftar
     *
     * Semua pemilik token ber-scope sarpras:read.
     *
     * `GET /v1/sarpras/kategori`
     *
     * scope: `sarpras:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, induk_id?: string, habis_pakai?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKategori(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/kategori', [], $query, null, $options, false, false);
    }

    /**
     * Kategori aset: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/sarpras/kategori`
     *
     * scope: `sarpras:write`
     *
     * @param array{induk_id?: int, kode: string, nama: string, umur_ekonomis?: int, habis_pakai?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKategori(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/kategori', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kategori aset: detail
     *
     * Semua pemilik token ber-scope sarpras:read.
     *
     * `GET /v1/sarpras/kategori/{id}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKategoriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/kategori/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kategori aset: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/sarpras/kategori/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{induk_id?: int, kode: string, nama: string, umur_ekonomis?: int, habis_pakai?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKategoriById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sarpras/kategori/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kategori aset: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/sarpras/kategori/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKategoriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/kategori/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aset: daftar
     *
     * Inventaris. Penanggung jawab melihat aset yang dipegangnya; aset yang `bisa_dipinjam` dan aktif bisa dilihat semua pengguna (tanpa nilai). `nilai_buku` dihitung garis lurus dari nilai perolehan dan umur ekonomis. Perpindahan ruang, perubahan kondisi, dan penghapusan tercatat di /sarpras/mutasi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (penanggung_jawab).
     *
     * `GET /v1/sarpras/aset`
     *
     * scope: `sarpras:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kategori_id?: string, ruang_id?: string, unit_id?: string, penanggung_jawab?: string, cara_perolehan?: string, kondisi?: string, status?: string, bisa_dipinjam?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAset(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/aset', [], $query, null, $options, false, false);
    }

    /**
     * Aset: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/sarpras/aset`
     *
     * scope: `sarpras:write`
     *
     * @param array{kode: string, nama: string, kategori_id?: int, merk?: string, tipe?: string, nomor_seri?: string, jumlah?: int, satuan?: string, ruang_id?: int, unit_id?: int, penanggung_jawab?: string, tanggal_perolehan?: string, cara_perolehan?: string, sumber_dana?: string, nilai_perolehan?: float|int, umur_ekonomis?: int, kondisi?: string, bisa_dipinjam?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAset(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/aset', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aset: detail
     *
     * Inventaris. Penanggung jawab melihat aset yang dipegangnya; aset yang `bisa_dipinjam` dan aktif bisa dilihat semua pengguna (tanpa nilai). `nilai_buku` dihitung garis lurus dari nilai perolehan dan umur ekonomis. Perpindahan ruang, perubahan kondisi, dan penghapusan tercatat di /sarpras/mutasi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (penanggung_jawab).
     *
     * `GET /v1/sarpras/aset/{id}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsetById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/aset/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aset: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/sarpras/aset/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, kategori_id?: int, merk?: string, tipe?: string, nomor_seri?: string, jumlah?: int, satuan?: string, ruang_id?: int, unit_id?: int, penanggung_jawab?: string, tanggal_perolehan?: string, cara_perolehan?: string, sumber_dana?: string, nilai_perolehan?: float|int, umur_ekonomis?: int, kondisi?: string, bisa_dipinjam?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAsetById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sarpras/aset/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aset: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/sarpras/aset/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAsetById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/aset/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aset: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/sarpras/aset/{id}/berkas`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsetByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/aset/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aset: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/sarpras/aset/{id}/berkas`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAsetByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/aset/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Aset: unduh lampiran
     *
     * `GET /v1/sarpras/aset/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsetByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/aset/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Aset: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/sarpras/aset/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAsetByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/aset/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Aset: Hapuskan dari daftar aset
     *
     * Penghapusan aset (dijual, hibah keluar, rusak berat, hilang) dengan nomor SK. Admin modul. Status harus aktif/perbaikan, menjadi dihapuskan.
     *
     * `POST /v1/sarpras/aset/{id}/hapuskan`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nomor_sk: string, alasan: string, tanggal?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAsetByIdHapuskan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/aset/{id}/hapuskan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: daftar
     *
     * Diajukan pengguna (peminjam = username otomatis) untuk satu ruang atau satu aset. Bentrok dengan peminjaman yang sudah disetujui ditolak (409). Alur: diajukan → setujui → serahkan → kembalikan; atau tolak/batalkan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (peminjam).
     *
     * `GET /v1/sarpras/peminjaman`
     *
     * scope: `sarpras:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, peminjam?: string, ruang_id?: string, aset_id?: string, status?: string, diputus_oleh?: string, kondisi_kembali?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeminjaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/peminjaman', [], $query, null, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (peminjam diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/sarpras/peminjaman`
     *
     * scope: `sarpras:write`
     *
     * @param array{peminjam: string, ruang_id?: int, aset_id?: int, jumlah?: int, kegiatan: string, ormawa_id?: int, mulai: string, selesai: string, jumlah_peserta?: int, kontak?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjaman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/peminjaman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: detail
     *
     * Diajukan pengguna (peminjam = username otomatis) untuk satu ruang atau satu aset. Bentrok dengan peminjaman yang sudah disetujui ditolak (409). Alur: diajukan → setujui → serahkan → kembalikan; atau tolak/batalkan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (peminjam).
     *
     * `GET /v1/sarpras/peminjaman/{id}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeminjamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/peminjaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (peminjam diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/sarpras/peminjaman/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{peminjam: string, ruang_id?: int, aset_id?: int, jumlah?: int, kegiatan: string, ormawa_id?: int, mulai: string, selesai: string, jumlah_peserta?: int, kontak?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeminjamanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sarpras/peminjaman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (peminjam diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/sarpras/peminjaman/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeminjamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/peminjaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/sarpras/peminjaman/{id}/berkas`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeminjamanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/peminjaman/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (peminjam diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/sarpras/peminjaman/{id}/berkas`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/peminjaman/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Peminjaman ruang/aset: unduh lampiran
     *
     * `GET /v1/sarpras/peminjaman/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeminjamanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/peminjaman/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (peminjam diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/sarpras/peminjaman/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeminjamanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/peminjaman/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: Setujui
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/sarpras/peminjaman/{id}/setujui`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/peminjaman/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/sarpras/peminjaman/{id}/tolak`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/peminjaman/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: Serahkan (mulai dipinjam)
     *
     * Pengelola modul. Status harus disetujui, menjadi dipinjam.
     *
     * `POST /v1/sarpras/peminjaman/{id}/serahkan`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdSerahkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/peminjaman/{id}/serahkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: Terima pengembalian
     *
     * Bila kondisi kembali bukan baik, laporan kerusakan dibuat otomatis. Pengelola modul. Status harus dipinjam, menjadi dikembalikan.
     *
     * `POST /v1/sarpras/peminjaman/{id}/kembalikan`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kondisi_kembali: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/peminjaman/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peminjaman ruang/aset: Batalkan
     *
     * Pemilik data atau pengelola. Status harus diajukan/disetujui, menjadi dibatalkan.
     *
     * `POST /v1/sarpras/peminjaman/{id}/batalkan`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/peminjaman/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: daftar
     *
     * Siapa pun boleh melaporkan kerusakan (pelapor = username otomatis). Pengelola menjadwalkan, mengerjakan, dan menyelesaikan; petugas yang ditunjuk ikut melihat. Pemeliharaan rutin/kalibrasi dibuat pengelola. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pelapor).
     *
     * `GET /v1/sarpras/pemeliharaan`
     *
     * scope: `sarpras:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, aset_id?: string, ruang_id?: string, pelapor?: string, prioritas?: string, petugas?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemeliharaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/pemeliharaan', [], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dilaporkan.
     *
     * `POST /v1/sarpras/pemeliharaan`
     *
     * scope: `sarpras:write`
     *
     * @param array{jenis?: string, aset_id?: int, ruang_id?: int, pelapor: string, judul: string, uraian?: string, prioritas?: string, jadwal?: string, petugas?: string, vendor?: string, biaya?: float|int, tindakan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemeliharaan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/pemeliharaan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: detail
     *
     * Siapa pun boleh melaporkan kerusakan (pelapor = username otomatis). Pengelola menjadwalkan, mengerjakan, dan menyelesaikan; petugas yang ditunjuk ikut melihat. Pemeliharaan rutin/kalibrasi dibuat pengelola. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pelapor).
     *
     * `GET /v1/sarpras/pemeliharaan/{id}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemeliharaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/pemeliharaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dilaporkan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/sarpras/pemeliharaan/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{jenis?: string, aset_id?: int, ruang_id?: int, pelapor: string, judul: string, uraian?: string, prioritas?: string, jadwal?: string, petugas?: string, vendor?: string, biaya?: float|int, tindakan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPemeliharaanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sarpras/pemeliharaan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dilaporkan.
     *
     * `DELETE /v1/sarpras/pemeliharaan/{id}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePemeliharaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/pemeliharaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/sarpras/pemeliharaan/{id}/berkas`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemeliharaanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/pemeliharaan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dilaporkan.
     *
     * `POST /v1/sarpras/pemeliharaan/{id}/berkas`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemeliharaanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/pemeliharaan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pemeliharaan dan perbaikan: unduh lampiran
     *
     * `GET /v1/sarpras/pemeliharaan/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemeliharaanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/pemeliharaan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dilaporkan.
     *
     * `DELETE /v1/sarpras/pemeliharaan/{id}/berkas/{uuid}`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePemeliharaanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sarpras/pemeliharaan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: Jadwalkan
     *
     * Pengelola modul. Status harus dilaporkan, menjadi dijadwalkan.
     *
     * `POST /v1/sarpras/pemeliharaan/{id}/jadwalkan`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{jadwal: string, petugas?: string, vendor?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemeliharaanByIdJadwalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/pemeliharaan/{id}/jadwalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: Mulai dikerjakan
     *
     * Pengelola modul. Status harus dilaporkan/dijadwalkan, menjadi dikerjakan.
     *
     * `POST /v1/sarpras/pemeliharaan/{id}/kerjakan`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemeliharaanByIdKerjakan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/pemeliharaan/{id}/kerjakan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: Selesai
     *
     * Pengelola modul. Status harus dijadwalkan/dikerjakan, menjadi selesai.
     *
     * `POST /v1/sarpras/pemeliharaan/{id}/selesai`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tindakan: string, biaya?: float|int, kondisi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemeliharaanByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/pemeliharaan/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: Tidak dapat diperbaiki
     *
     * Pengelola modul. Status harus dilaporkan/dijadwalkan/dikerjakan, menjadi tidak_dapat_diperbaiki.
     *
     * `POST /v1/sarpras/pemeliharaan/{id}/tidak-dapat-diperbaiki`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tindakan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemeliharaanByIdTidakDapatDiperbaiki(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/pemeliharaan/{id}/tidak-dapat-diperbaiki', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemeliharaan dan perbaikan: Batalkan
     *
     * Pemilik data atau pengelola. Status harus dilaporkan/dijadwalkan, menjadi dibatalkan.
     *
     * `POST /v1/sarpras/pemeliharaan/{id}/batalkan`
     *
     * scope: `sarpras:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemeliharaanByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sarpras/pemeliharaan/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mutasi aset: daftar
     *
     * Riwayat otomatis: pindah ruang, perubahan kondisi, ganti penanggung jawab, penghapusan. Hanya pengelola modul.
     *
     * `GET /v1/sarpras/mutasi`
     *
     * scope: `sarpras:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, aset_id?: string, jenis?: string, oleh?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMutasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/mutasi', [], $query, null, $options, false, false);
    }

    /**
     * Mutasi aset: detail
     *
     * Riwayat otomatis: pindah ruang, perubahan kondisi, ganti penanggung jawab, penghapusan. Hanya pengelola modul.
     *
     * `GET /v1/sarpras/mutasi/{id}`
     *
     * scope: `sarpras:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMutasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sarpras/mutasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }
}
