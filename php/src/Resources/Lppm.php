<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * LPPM: Umum, LPPM: Master, LPPM: Review, LPPM: Kegiatan, LPPM: Pelaksanaan, LPPM: Luaran, LPPM: Peneliti, LPPM: Rekap, LPPM: Kolaborasi, LPPM: Publikasi, LPPM: KKN, LPPM: File
 */
final class Lppm extends Resource
{
    /**
     * Pilihan nilai (enum)
     *
     * Status usulan, sumber dana, kelompok RAB, tahap review, kategori luaran, peringkat, kategori LKPS, TKT 1-9, bagian substansi proposal, jenis file yang diizinkan, dll.
     *
     * `GET /v1/lppm/referensi`
     *
     * scope: `lppm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Hak dan ringkasan pemilik token
     *
     * NIDN/NIM, peran pengelola, ID reviewer, notifikasi belum dibaca, tugas review aktif, undangan anggota tim, periode usulan yang sedang dibuka.
     *
     * `GET /v1/lppm/saya`
     *
     * scope: `lppm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/saya', [], $query, null, $options, false, false);
    }

    /**
     * Notifikasi saya
     *
     * `GET /v1/lppm/notifikasi`
     *
     * scope: `lppm:read` · hanya token pengguna · berhalaman
     *
     * @param array{belum_dibaca?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNotifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/notifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Tandai notifikasi dibaca
     *
     * Body {"id": [1,2]}; tanpa id = semua.
     *
     * `POST /v1/lppm/notifikasi/baca`
     *
     * scope: `lppm:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNotifikasiBaca(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/notifikasi/baca', [], $query, null, $options, false, false);
    }

    /**
     * Log audit (admin)
     *
     * `GET /v1/lppm/log`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param array{entitas?: string, oleh?: string, aksi?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/log', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat perubahan entitas (pengelola)
     *
     * `GET /v1/lppm/riwayat/{entitas}/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $entitas usulan, luaran, review, laporan, skema, ...
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatByEntitasById(int|string $entitas, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/riwayat/{entitas}/{id}', ['entitas' => $entitas, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Impor penelitian/pengabdian dosen dari tabel lama
     *
     * Admin. Membaca t_dosen_penelitian dan t_dosen_pengabdian (tidak diubah) menjadi kegiatan asal=impor_lama, status selesai. Body: {"jenis": ["penelitian","pengabdian"], "nidn": opsional, "simpan": false} — simpan=false hanya pratinjau. Aman diulang.
     *
     * `POST /v1/lppm/impor-lama`
     *
     * scope: `lppm:write`
     *
     * @param array{jenis?: list<mixed>, nidn?: string|null, simpan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postImporLama(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/impor-lama', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengelola LPPM: daftar
     *
     * Peran: admin, operator, pimpinan (ketua/sekretaris LPPM), keuangan, fakultas (dekan/WD, wajib kode_fakultas). Baca: pengelola; ubah: admin.
     *
     * `GET /v1/lppm/pengelola`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengelola(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/pengelola', [], $query, null, $options, false, false);
    }

    /**
     * Pengelola LPPM: tambah
     *
     * `POST /v1/lppm/pengelola`
     *
     * scope: `lppm:write`
     *
     * @param array{username: string, peran: string, kode_fakultas?: string|null, jabatan?: string, aktif?: bool, mulai?: string|null, selesai?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengelola(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/pengelola', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengelola LPPM: detail
     *
     * `GET /v1/lppm/pengelola/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengelolaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/pengelola/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengelola LPPM: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/pengelola/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{username: string, peran: string, kode_fakultas?: string|null, jabatan?: string, aktif?: bool, mulai?: string|null, selesai?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengelolaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/pengelola/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengelola LPPM: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/pengelola/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengelolaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/pengelola/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Reviewer: daftar
     *
     * Reviewer internal (akun SIAKAD; nama/NIDN/email diisi otomatis dari username) atau eksternal. Non-pengelola hanya melihat nama, instansi, bidang keahlian.
     *
     * `GET /v1/lppm/reviewer`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReviewer(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/reviewer', [], $query, null, $options, false, false);
    }

    /**
     * Reviewer: tambah
     *
     * `POST /v1/lppm/reviewer`
     *
     * scope: `lppm:write`
     *
     * @param array{jenis?: string, username?: string, nidn?: string, nama?: string, instansi?: string, email?: string, hp?: string, bidang_keahlian?: string, nomor_sertifikat?: string, untuk?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postReviewer(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/reviewer', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Reviewer: detail
     *
     * `GET /v1/lppm/reviewer/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReviewerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/reviewer/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Reviewer: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/reviewer/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{jenis?: string, username?: string, nidn?: string, nama?: string, instansi?: string, email?: string, hp?: string, bidang_keahlian?: string, nomor_sertifikat?: string, untuk?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putReviewerById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/reviewer/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Reviewer: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/reviewer/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteReviewerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/reviewer/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bidang fokus, tema, topik, rumpun ilmu: daftar
     *
     * Bertingkat (induk_id). jenis: fokus | tema | topik | rumpun.
     *
     * `GET /v1/lppm/bidang`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBidang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/bidang', [], $query, null, $options, false, false);
    }

    /**
     * Bidang fokus, tema, topik, rumpun ilmu: tambah
     *
     * `POST /v1/lppm/bidang`
     *
     * scope: `lppm:write`
     *
     * @param array{induk_id?: int|null, jenis: string, kode: string, nama: string, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBidang(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/bidang', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bidang fokus, tema, topik, rumpun ilmu: detail
     *
     * `GET /v1/lppm/bidang/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBidangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/bidang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bidang fokus, tema, topik, rumpun ilmu: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/bidang/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{induk_id?: int|null, jenis: string, kode: string, nama: string, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBidangById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/bidang/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bidang fokus, tema, topik, rumpun ilmu: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/bidang/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBidangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/bidang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis luaran: daftar
     *
     * Kategori dan pemetaan ke baris LKPS (kategori_lkps, lihat /referensi).
     *
     * `GET /v1/lppm/jenis-luaran`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenisLuaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/jenis-luaran', [], $query, null, $options, false, false);
    }

    /**
     * Jenis luaran: tambah
     *
     * `POST /v1/lppm/jenis-luaran`
     *
     * scope: `lppm:write`
     *
     * @param array{kode: string, nama: string, kategori: string, kategori_lkps?: string, tingkat?: string, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenisLuaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/jenis-luaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis luaran: detail
     *
     * `GET /v1/lppm/jenis-luaran/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenisLuaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/jenis-luaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis luaran: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/jenis-luaran/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{kode: string, nama: string, kategori: string, kategori_lkps?: string, tingkat?: string, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putJenisLuaranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/jenis-luaran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis luaran: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/jenis-luaran/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteJenisLuaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/jenis-luaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema hibah: daftar
     *
     * Syarat: dana maksimal per tahun, durasi, TKT, jumlah anggota dosen/mahasiswa, jabatan ketua, mitra, persetujuan fakultas, kuota usulan per ketua. Detail memuat luaran wajib dan kriteria penilaian.
     *
     * `GET /v1/lppm/skema`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkema(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/skema', [], $query, null, $options, false, false);
    }

    /**
     * Skema hibah: tambah
     *
     * `POST /v1/lppm/skema`
     *
     * scope: `lppm:write`
     *
     * @param array{kode: string, nama: string, jenis: string, kelompok?: string, sumber_dana?: string, penyelenggara?: string, dana_maks?: float|int|null, durasi_tahun_maks?: int, tkt_min?: int, tkt_maks?: int, anggota_dosen_min?: int, anggota_dosen_maks?: int, mahasiswa_min?: int, mahasiswa_maks?: int, syarat_jabatan_ketua?: string, syarat_lain?: string, wajib_mitra?: bool, wajib_persetujuan_fakultas?: bool, maks_usulan_ketua?: int, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkema(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/skema', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema hibah: detail
     *
     * `GET /v1/lppm/skema/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/skema/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema hibah: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/skema/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{kode: string, nama: string, jenis: string, kelompok?: string, sumber_dana?: string, penyelenggara?: string, dana_maks?: float|int|null, durasi_tahun_maks?: int, tkt_min?: int, tkt_maks?: int, anggota_dosen_min?: int, anggota_dosen_maks?: int, mahasiswa_min?: int, mahasiswa_maks?: int, syarat_jabatan_ketua?: string, syarat_lain?: string, wajib_mitra?: bool, wajib_persetujuan_fakultas?: bool, maks_usulan_ketua?: int, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkemaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/skema/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema hibah: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/skema/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSkemaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/skema/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Luaran wajib/tambahan skema: daftar
     *
     * Disalin ke target luaran saat usulan dibuat.
     *
     * `GET /v1/lppm/skema-luaran`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaLuaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/skema-luaran', [], $query, null, $options, false, false);
    }

    /**
     * Luaran wajib/tambahan skema: tambah
     *
     * `POST /v1/lppm/skema-luaran`
     *
     * scope: `lppm:write`
     *
     * @param array{skema_id: int|null, jenis_luaran_id: int|null, wajib?: bool, target_status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkemaLuaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/skema-luaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Luaran wajib/tambahan skema: detail
     *
     * `GET /v1/lppm/skema-luaran/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaLuaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/skema-luaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Luaran wajib/tambahan skema: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/skema-luaran/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{skema_id: int|null, jenis_luaran_id: int|null, wajib?: bool, target_status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkemaLuaranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/skema-luaran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Luaran wajib/tambahan skema: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/skema-luaran/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSkemaLuaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/skema-luaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode/batch usulan: daftar
     *
     * Jadwal tahapan dan status (draf, dibuka, ditutup, review, diumumkan, berjalan, selesai). Detail memuat skema yang dibuka beserta jumlah usulan, yang didanai, dan dana terpakai.
     *
     * `GET /v1/lppm/periode`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, tahun?: string, status?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/periode', [], $query, null, $options, false, false);
    }

    /**
     * Periode/batch usulan: tambah
     *
     * `POST /v1/lppm/periode`
     *
     * scope: `lppm:write`
     *
     * @param array{kode: string, nama: string, tahun: int, jenis?: string, buka_usulan?: string|null, tutup_usulan?: string|null, batas_persetujuan?: string|null, mulai_review?: string|null, selesai_review?: string|null, pengumuman?: string|null, mulai_pelaksanaan?: string|null, selesai_pelaksanaan?: string|null, batas_laporan_kemajuan?: string|null, batas_laporan_akhir?: string|null, batas_luaran?: string|null, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode/batch usulan: detail
     *
     * `GET /v1/lppm/periode/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode/batch usulan: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/periode/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{kode: string, nama: string, tahun: int, jenis?: string, buka_usulan?: string|null, tutup_usulan?: string|null, batas_persetujuan?: string|null, mulai_review?: string|null, selesai_review?: string|null, pengumuman?: string|null, mulai_pelaksanaan?: string|null, selesai_pelaksanaan?: string|null, batas_laporan_kemajuan?: string|null, batas_laporan_akhir?: string|null, batas_luaran?: string|null, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode/batch usulan: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/periode/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema yang dibuka per periode: daftar
     *
     * Kuota judul dan pagu dana.
     *
     * `GET /v1/lppm/periode-skema`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeSkema(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/periode-skema', [], $query, null, $options, false, false);
    }

    /**
     * Skema yang dibuka per periode: tambah
     *
     * `POST /v1/lppm/periode-skema`
     *
     * scope: `lppm:write`
     *
     * @param array{periode_id: int|null, skema_id: int|null, kuota?: int, pagu?: float|int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeSkema(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/periode-skema', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema yang dibuka per periode: detail
     *
     * `GET /v1/lppm/periode-skema/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeSkemaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/periode-skema/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema yang dibuka per periode: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/periode-skema/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{periode_id: int|null, skema_id: int|null, kuota?: int, pagu?: float|int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeSkemaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/periode-skema/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema yang dibuka per periode: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/periode-skema/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeriodeSkemaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/periode-skema/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kriteria penilaian: daftar
     *
     * Per tahap (usulan, kemajuan, akhir, monev, seminar), bobot %, rentang skor. skema_id kosong = kriteria umum; filter skema_id mengembalikan kriteria efektif skema itu.
     *
     * `GET /v1/lppm/kriteria`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, skema_id?: string, tahap?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKriteria(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kriteria', [], $query, null, $options, false, false);
    }

    /**
     * Kriteria penilaian: tambah
     *
     * `POST /v1/lppm/kriteria`
     *
     * scope: `lppm:write`
     *
     * @param array{skema_id?: int|null, jenis?: string, tahap: string, nama: string, keterangan?: string, bobot: float|int, skor_min?: int, skor_maks?: int, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKriteria(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kriteria', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kriteria penilaian: detail
     *
     * `GET /v1/lppm/kriteria/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKriteriaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kriteria/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kriteria penilaian: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/kriteria/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{skema_id?: int|null, jenis?: string, tahap: string, nama: string, keterangan?: string, bobot: float|int, skor_min?: int, skor_maks?: int, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKriteriaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kriteria/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kriteria penilaian: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/kriteria/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKriteriaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kriteria/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mitra: daftar
     *
     * Industri, UMKM, pemerintah, desa, masyarakat, dll. Dosen boleh menambah; ubah oleh pencatat atau pengelola.
     *
     * `GET /v1/lppm/mitra`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitra(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/mitra', [], $query, null, $options, false, false);
    }

    /**
     * Mitra: tambah
     *
     * `POST /v1/lppm/mitra`
     *
     * scope: `lppm:write`
     *
     * @param array{nama: string, jenis: string, bidang_usaha?: string, alamat?: string, kota?: string, provinsi?: string, negara?: string, kontak_nama?: string, kontak_jabatan?: string, telepon?: string, email?: string, website?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMitra(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/mitra', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mitra: detail
     *
     * `GET /v1/lppm/mitra/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mitra: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/mitra/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{nama: string, jenis: string, bidang_usaha?: string, alamat?: string, kota?: string, provinsi?: string, negara?: string, kontak_nama?: string, kontak_jabatan?: string, telepon?: string, email?: string, website?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMitraById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/mitra/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mitra: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/mitra/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jurnal kampus: daftar
     *
     * Jurnal yang dikelola kampus beserta peringkat SINTA.
     *
     * `GET /v1/lppm/jurnal`
     *
     * scope: `lppm:read`
     *
     * @param array{q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJurnal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/jurnal', [], $query, null, $options, false, false);
    }

    /**
     * Jurnal kampus: tambah
     *
     * `POST /v1/lppm/jurnal`
     *
     * scope: `lppm:write`
     *
     * @param array{nama: string, singkatan?: string, issn?: string, eissn?: string, url?: string, penerbit?: string, kode_fakultas?: string|null, kode_prodi?: string|null, peringkat?: string, sk_akreditasi?: string, akreditasi_sampai?: string|null, frekuensi?: string, bidang?: string, editor_username?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJurnal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/jurnal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jurnal kampus: detail
     *
     * `GET /v1/lppm/jurnal/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJurnalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/jurnal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jurnal kampus: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/jurnal/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{nama: string, singkatan?: string, issn?: string, eissn?: string, url?: string, penerbit?: string, kode_fakultas?: string|null, kode_prodi?: string|null, peringkat?: string, sk_akreditasi?: string, akreditasi_sampai?: string|null, frekuensi?: string, bidang?: string, editor_username?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putJurnalById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/jurnal/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jurnal kampus: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/lppm/jurnal/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteJurnalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/jurnal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tugas review saya
     *
     * Untuk pengguna yang terdaftar di master reviewer.
     *
     * `GET /v1/lppm/review/saya`
     *
     * scope: `lppm:read` · hanya token pengguna
     *
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReviewSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/review/saya', [], $query, null, $options, false, false);
    }

    /**
     * Peringkat usulan per periode/skema
     *
     * Rata-rata, minimum, maksimum skor review tahap usulan, jumlah rekomendasi, dan dana rekomendasi; bahan rapat penetapan. Pengelola.
     *
     * `GET /v1/lppm/review/peringkat`
     *
     * scope: `lppm:read`
     *
     * @param array{periode_id: int, skema_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReviewPeringkat(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/review/peringkat', [], $query, null, $options, false, false);
    }

    /**
     * Detail review
     *
     * Kriteria efektif beserta skor yang sudah diisi. Untuk reviewer yang ditugaskan dan pengelola.
     *
     * `GET /v1/lppm/review/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID review
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReviewById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/review/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi/simpan penilaian
     *
     * nilai = [{kriteria_id, skor, komentar}], rekomendasi, dana_rekomendasi, komentar (terlihat pengusul setelah penetapan, tanpa nama reviewer), komentar_internal. kirim=true mengunci review (semua kriteria wajib terisi). konflik_kepentingan=true membatalkan tugas.
     *
     * `PUT /v1/lppm/review/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID review
     * @param array{nilai?: list<mixed>, rekomendasi?: string, dana_rekomendasi?: float|int|null, komentar?: string|null, komentar_internal?: string|null, konflik_kepentingan?: bool, kirim?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putReviewById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/review/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan penugasan reviewer
     *
     * `DELETE /v1/lppm/review/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID review
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteReviewById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/review/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buka kembali review selesai (admin)
     *
     * `POST /v1/lppm/review/{id}/buka`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID review
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postReviewByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/review/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar usulan/kegiatan
     *
     * Penelitian dan PkM, termasuk hibah eksternal, mandiri, dan impor data lama, sesuai hak akses.
     *
     * `GET /v1/lppm/kegiatan`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param array{q?: string, jenis?: string, status?: string, asal?: string, sumber_dana?: string, persetujuan_fakultas?: string, periode_id?: string, skema_id?: string, bidang_id?: string, tahun?: string, kode_prodi?: string, kode_fakultas?: string, nidn?: string, nim?: string, saya?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan', [], $query, null, $options, false, false);
    }

    /**
     * Buat usulan/kegiatan
     *
     * asal=usulan (bawaan): wajib periode_id + skema_id yang sedang dibuka; status draf. asal=hibah_eksternal/mandiri: dicatat langsung (status berjalan/selesai) untuk rekap & LKPS. Ketua = dosen pemilik token (pengelola boleh mengisi nidn_ketua). Ketua otomatis menjadi anggota; luaran wajib skema disalin ke target.
     *
     * `POST /v1/lppm/kegiatan`
     *
     * scope: `lppm:write`
     *
     * @param array{jenis: string, asal?: string, periode_id?: int|null, skema_id?: int|null, judul: string, ringkasan?: string|null, kata_kunci?: string|null, substansi?: array<string, mixed>, bidang_id?: int|null, tema_id?: int|null, rumpun_id?: int|null, topik?: string|null, tkt_awal?: int, tkt_target?: int, tahun_usulan?: int, tahun_pelaksanaan?: int, lama_tahun?: int, tahun_id?: string|null, lokasi?: string|null, kabupaten?: string|null, provinsi?: string|null, nidn_ketua?: string|null, sumber_dana?: string, nama_pemberi_dana?: string|null, dana_usulan?: float|int|null, dana_disetujui?: float|int|null, nomor_sk?: string|null, nomor_kontrak?: string|null, tanggal_kontrak?: string|null, tanggal_mulai?: string|null, tanggal_selesai?: string|null, id_bima?: string|null, status?: string, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail kegiatan
     *
     * Termasuk skema, periode, ketua, anggota, mitra, RAB + ringkasan, target luaran + realisasi, review (sesuai hak), laporan, pencairan, file, dan `hak` (aksi yang boleh).
     *
     * `GET /v1/lppm/kegiatan/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kegiatan
     *
     * Ketua saat draf/revisi (kegiatan non-hibah kapan saja); pengelola kapan saja. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/lppm/kegiatan/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{jenis: string, asal?: string, periode_id?: int|null, skema_id?: int|null, judul: string, ringkasan?: string|null, kata_kunci?: string|null, substansi?: array<string, mixed>, bidang_id?: int|null, tema_id?: int|null, rumpun_id?: int|null, topik?: string|null, tkt_awal?: int, tkt_target?: int, tahun_usulan?: int, tahun_pelaksanaan?: int, lama_tahun?: int, tahun_id?: string|null, lokasi?: string|null, kabupaten?: string|null, provinsi?: string|null, nidn_ketua?: string|null, sumber_dana?: string, nama_pemberi_dana?: string|null, dana_usulan?: float|int|null, dana_disetujui?: float|int|null, nomor_sk?: string|null, nomor_kontrak?: string|null, tanggal_kontrak?: string|null, tanggal_mulai?: string|null, tanggal_selesai?: string|null, id_bima?: string|null, status?: string, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kegiatan
     *
     * Draf oleh ketua; selebihnya admin.
     *
     * `DELETE /v1/lppm/kegiatan/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat status dan perubahan
     *
     * `GET /v1/lppm/kegiatan/{id}/riwayat`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cek kelengkapan sebelum diajukan
     *
     * Periode dibuka, ringkasan & substansi/file proposal, jabatan ketua, jumlah anggota & mahasiswa, persetujuan anggota, TKT, mitra, RAB ≤ dana maksimal per tahun, luaran wajib, kuota per ketua.
     *
     * `GET /v1/lppm/kegiatan/{id}/cek`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdCek(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}/cek', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan usulan
     *
     * Ketua. Draf/revisi → diajukan; nomor registrasi terbit (P-2026-0001 / PKM-2026-0001). Bila skema mewajibkan, menunggu persetujuan fakultas.
     *
     * `POST /v1/lppm/kegiatan/{id}/ajukan`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Persetujuan fakultas
     *
     * Pengelola peran fakultas (dekan/WD) untuk fakultas pengusul. keputusan: disetujui | ditolak | revisi.
     *
     * `POST /v1/lppm/kegiatan/{id}/persetujuan-fakultas`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{keputusan: string, dana_disetujui?: float|int|null, nomor_sk?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdPersetujuanFakultas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/persetujuan-fakultas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penetapan hasil seleksi
     *
     * Pimpinan/admin LPPM. keputusan: diterima | ditolak | revisi; dana_disetujui (bawaan: rata-rata dana rekomendasi reviewer, atau dana usulan), nomor_sk, catatan.
     *
     * `POST /v1/lppm/kegiatan/{id}/tetapkan`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{keputusan: string, dana_disetujui?: float|int|null, nomor_sk?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kontrak dan mulai pelaksanaan
     *
     * Admin/operator. diterima → berjalan; nomor_kontrak, tanggal_kontrak, tanggal_mulai, tanggal_selesai, pencairan_persen (bawaan [70, 30]) membuat rencana pencairan.
     *
     * `POST /v1/lppm/kegiatan/{id}/kontrak`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{nomor_kontrak: string, tanggal_kontrak?: string|null, tanggal_mulai?: string|null, tanggal_selesai?: string|null, pencairan_persen?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdKontrak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/kontrak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tandai selesai
     *
     * Admin/operator. Butuh laporan akhir diterima (admin bisa paksa=true).
     *
     * `POST /v1/lppm/kegiatan/{id}/selesai`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan
     *
     * Ketua (draf/diajukan) atau pengelola. Body {"alasan": "..."}; tugas review aktif ikut dibatalkan.
     *
     * `POST /v1/lppm/kegiatan/{id}/batal`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konfirmasi keanggotaan
     *
     * Dosen/mahasiswa yang diundang menjadi anggota: {"setuju": true|false}.
     *
     * `POST /v1/lppm/kegiatan/{id}/konfirmasi`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdKonfirmasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/konfirmasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tugaskan reviewer
     *
     * Admin/operator. Body {"tahap": "usulan", "reviewer_id": [1, 2], "batas": "2026-12-01"}. Anggota tim ditolak (konflik kepentingan). Review tahap usulan mengubah status menjadi direview.
     *
     * `POST /v1/lppm/kegiatan/{id}/reviewer`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdReviewer(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/reviewer', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Anggota tim
     *
     * `GET /v1/lppm/kegiatan/{id}/anggota`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdAnggota(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}/anggota', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah anggota
     *
     * jenis dosen (nidn), mahasiswa (nim), tendik (nik): nama & prodi dari SIAKAD; eksternal: nama + instansi. Dosen/mahasiswa yang punya akun perlu konfirmasi (POST .../konfirmasi).
     *
     * `POST /v1/lppm/kegiatan/{id}/anggota`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{jenis: string, nidn?: string|null, nim?: string|null, nik?: string|null, nama?: string|null, instansi?: string|null, peran?: string, tugas?: string|null, jam_per_minggu?: int|null, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdAnggota(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/anggota', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah anggota
     *
     * peran, tugas, jam_per_minggu, urut.
     *
     * `PUT /v1/lppm/kegiatan/{id}/anggota/{anggota}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $anggota ID anggota
     * @param array{jenis: string, nidn?: string|null, nim?: string|null, nik?: string|null, nama?: string|null, instansi?: string|null, peran?: string, tugas?: string|null, jam_per_minggu?: int|null, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdAnggotaByAnggota(int|string $id, int|string $anggota, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/anggota/{anggota}', ['id' => $id, 'anggota' => $anggota], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus anggota
     *
     * `DELETE /v1/lppm/kegiatan/{id}/anggota/{anggota}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $anggota ID anggota
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanByIdAnggotaByAnggota(int|string $id, int|string $anggota, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kegiatan/{id}/anggota/{anggota}', ['id' => $id, 'anggota' => $anggota], $query, null, $options, false, false);
    }

    /**
     * Kaitkan/ubah mitra kegiatan
     *
     * peran, dana_tunai, dana_natura, keterangan. dana_mitra kegiatan dihitung ulang.
     *
     * `PUT /v1/lppm/kegiatan/{id}/mitra/{mitra}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $mitra ID mitra
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdMitraByMitra(int|string $id, int|string $mitra, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/mitra/{mitra}', ['id' => $id, 'mitra' => $mitra], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas mitra kegiatan
     *
     * `DELETE /v1/lppm/kegiatan/{id}/mitra/{mitra}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $mitra ID mitra
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanByIdMitraByMitra(int|string $id, int|string $mitra, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kegiatan/{id}/mitra/{mitra}', ['id' => $id, 'mitra' => $mitra], $query, null, $options, false, false);
    }

    /**
     * RAB
     *
     * Item, ringkasan per tahun/kelompok/sumber, dan realisasi.
     *
     * `GET /v1/lppm/kegiatan/{id}/rab`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdRab(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}/rab', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ganti seluruh RAB
     *
     * Body {"item": [{tahun_ke, kelompok, uraian, satuan, volume, harga_satuan, sumber, keterangan}]}. jumlah = volume × harga; dana_usulan = total sumber hibah.
     *
     * `PUT /v1/lppm/kegiatan/{id}/rab`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{item: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdRab(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/rab', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Isi realisasi RAB
     *
     * Body {"item": [{id, realisasi}]}. Ketua saat berjalan, atau pengelola/keuangan.
     *
     * `PUT /v1/lppm/kegiatan/{id}/rab/realisasi`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdRabRealisasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/rab/realisasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Target luaran dan realisasinya
     *
     * `GET /v1/lppm/kegiatan/{id}/luaran-target`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdLuaranTarget(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}/luaran-target', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ganti daftar target luaran
     *
     * Body {"item": [{jenis_luaran_id, tahun_ke, wajib, target_status, rencana}]}. Luaran wajib skema tidak bisa dihapus ketua.
     *
     * `PUT /v1/lppm/kegiatan/{id}/luaran-target`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdLuaranTarget(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/luaran-target', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kaitkan realisasi luaran ke target
     *
     * Body {"luaran_id": 12} atau null untuk melepas. Luaran dengan usulan_id yang sama juga dikaitkan otomatis saat dicatat.
     *
     * `PUT /v1/lppm/kegiatan/{id}/luaran-target/{target}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $target ID target
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdLuaranTargetByTarget(int|string $id, int|string $target, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/luaran-target/{target}', ['id' => $id, 'target' => $target], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Catatan harian (logbook)
     *
     * `GET /v1/lppm/kegiatan/{id}/logbook`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdLogbook(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}/logbook', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah catatan harian
     *
     * tanggal, kegiatan, capaian_persen, biaya. Bukti: POST /v1/lppm/file/logbook/{id}.
     *
     * `POST /v1/lppm/kegiatan/{id}/logbook`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{tanggal: string|null, kegiatan: string, capaian_persen?: int|null, biaya?: float|int|null, status?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdLogbook(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/logbook', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah catatan harian
     *
     * `PUT /v1/lppm/kegiatan/{id}/logbook/{log}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $log ID catatan
     * @param array{tanggal: string|null, kegiatan: string, capaian_persen?: int|null, biaya?: float|int|null, status?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdLogbookByLog(int|string $id, int|string $log, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/logbook/{log}', ['id' => $id, 'log' => $log], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus catatan harian
     *
     * `DELETE /v1/lppm/kegiatan/{id}/logbook/{log}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $log ID catatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanByIdLogbookByLog(int|string $id, int|string $log, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kegiatan/{id}/logbook/{log}', ['id' => $id, 'log' => $log], $query, null, $options, false, false);
    }

    /**
     * Laporan
     *
     * jenis: kemajuan | akhir | keuangan (dengan realisasi RAB) | monev.
     *
     * `GET /v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $jenis kemajuan | akhir | keuangan | monev
     * @param int|string $tahun_ke 1..lama_tahun
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdLaporanByJenisByTahunKe(int|string $id, int|string $jenis, int|string $tahun_ke, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}', ['id' => $id, 'jenis' => $jenis, 'tahun_ke' => $tahun_ke], $query, null, $options, false, false);
    }

    /**
     * Simpan laporan (draf)
     *
     * ringkasan, isi (objek bebas per bagian), capaian_persen, dana_terpakai. Ketua (monev: pengelola). File laporan: POST /v1/lppm/file/laporan/{id_laporan}.
     *
     * `PUT /v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $jenis Jenis
     * @param int|string $tahun_ke Tahun ke
     * @param array{ringkasan?: string|null, capaian_persen?: int|null, dana_terpakai?: float|int|null, isi?: array<string, mixed>, keputusan?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdLaporanByJenisByTahunKe(int|string $id, int|string $jenis, int|string $tahun_ke, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}', ['id' => $id, 'jenis' => $jenis, 'tahun_ke' => $tahun_ke], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan laporan
     *
     * `POST /v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}/ajukan`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $jenis Jenis
     * @param int|string $tahun_ke Tahun ke
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdLaporanByJenisByTahunKeAjukan(int|string $id, int|string $jenis, int|string $tahun_ke, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}/ajukan', ['id' => $id, 'jenis' => $jenis, 'tahun_ke' => $tahun_ke], $query, null, $options, false, false);
    }

    /**
     * Periksa laporan
     *
     * Pengelola. keputusan: diterima | revisi; catatan.
     *
     * `POST /v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}/periksa`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $jenis Jenis
     * @param int|string $tahun_ke Tahun ke
     * @param array{keputusan: string, dana_disetujui?: float|int|null, nomor_sk?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdLaporanByJenisByTahunKePeriksa(int|string $id, int|string $jenis, int|string $tahun_ke, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/laporan/{jenis}/{tahun_ke}/periksa', ['id' => $id, 'jenis' => $jenis, 'tahun_ke' => $tahun_ke], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar laporan lintas kegiatan
     *
     * Yang diajukan tampil lebih dulu.
     *
     * `GET /v1/lppm/laporan`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param array{jenis?: string, status?: string, periode_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/laporan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah tahap pencairan
     *
     * Admin/operator/keuangan. tahap, uraian, persen, jumlah, status (direncanakan | diajukan | dicairkan | dibatalkan), syarat, tanggal_cair, nomor_bukti.
     *
     * `POST /v1/lppm/kegiatan/{id}/pencairan`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param array{tahap: int, uraian?: string|null, persen?: float|int|null, jumlah?: float|int|null, status?: string, syarat?: string|null, tanggal_cair?: string|null, nomor_bukti?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdPencairan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/pencairan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah/cairkan tahap pencairan
     *
     * `PUT /v1/lppm/kegiatan/{id}/pencairan/{pencairan}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $pencairan ID pencairan
     * @param array{tahap: int, uraian?: string|null, persen?: float|int|null, jumlah?: float|int|null, status?: string, syarat?: string|null, tanggal_cair?: string|null, nomor_bukti?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanByIdPencairanByPencairan(int|string $id, int|string $pencairan, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kegiatan/{id}/pencairan/{pencairan}', ['id' => $id, 'pencairan' => $pencairan], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus tahap pencairan
     *
     * Yang sudah dicairkan tidak bisa dihapus.
     *
     * `DELETE /v1/lppm/kegiatan/{id}/pencairan/{pencairan}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $pencairan ID pencairan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanByIdPencairanByPencairan(int|string $id, int|string $pencairan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kegiatan/{id}/pencairan/{pencairan}', ['id' => $id, 'pencairan' => $pencairan], $query, null, $options, false, false);
    }

    /**
     * Daftar luaran
     *
     * Publikasi, HKI, buku, produk, media, rekognisi, dll. Non-pengelola melihat luaran terverifikasi dan luaran miliknya.
     *
     * `GET /v1/lppm/luaran`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param array{q?: string, jenis_luaran_id?: string, kategori?: string, status?: string, verifikasi?: string, tingkat?: string, peringkat?: string, usulan_id?: string, jurnal_id?: string, tahun?: string, tahun_dari?: string, tahun_sampai?: string, kode_prodi?: string, kode_fakultas?: string, nidn?: string, nim?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLuaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/luaran', [], $query, null, $options, false, false);
    }

    /**
     * Catat luaran
     *
     * Penulis wajib (dosen: nidn, mahasiswa: nim, tendik: nik, eksternal: nama); non-pengelola harus tercantum. Prodi/fakultas diambil dari penulis dosen pertama. usulan_id mengaitkan ke target luaran kegiatan.
     *
     * `POST /v1/lppm/luaran`
     *
     * scope: `lppm:write`
     *
     * @param array{jenis_luaran_id: int, usulan_id?: int|null, judul: string, tahun: int, tanggal?: string|null, nama_wadah?: string|null, jurnal_id?: int|null, penerbit?: string|null, issn?: string|null, isbn?: string|null, volume?: string|null, nomor?: string|null, halaman?: string|null, doi?: string|null, url?: string|null, tingkat?: string, peringkat?: string, terindeks?: string|null, status?: string, nomor_permohonan?: string|null, tanggal_permohonan?: string|null, nomor_sertifikat?: string|null, tanggal_sertifikat?: string|null, pemegang?: string|null, jumlah_sitasi?: int|null, sitasi_diperbarui?: string|null, pengguna?: string|null, abstrak?: string|null, keterangan?: string|null, sumber?: string, id_eksternal?: string|null, penulis?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLuaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/luaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail luaran
     *
     * `GET /v1/lppm/luaran/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLuaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/luaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah luaran
     *
     * Perubahan oleh penulis pada luaran terverifikasi mengembalikan status verifikasi ke belum.
     *
     * `PUT /v1/lppm/luaran/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenis_luaran_id: int, usulan_id?: int|null, judul: string, tahun: int, tanggal?: string|null, nama_wadah?: string|null, jurnal_id?: int|null, penerbit?: string|null, issn?: string|null, isbn?: string|null, volume?: string|null, nomor?: string|null, halaman?: string|null, doi?: string|null, url?: string|null, tingkat?: string, peringkat?: string, terindeks?: string|null, status?: string, nomor_permohonan?: string|null, tanggal_permohonan?: string|null, nomor_sertifikat?: string|null, tanggal_sertifikat?: string|null, pemegang?: string|null, jumlah_sitasi?: int|null, sitasi_diperbarui?: string|null, pengguna?: string|null, abstrak?: string|null, keterangan?: string|null, sumber?: string, id_eksternal?: string|null, penulis?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putLuaranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/luaran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus luaran
     *
     * `DELETE /v1/lppm/luaran/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLuaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/luaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan verifikasi
     *
     * Unggah bukti dulu (POST /v1/lppm/file/luaran/{id}).
     *
     * `POST /v1/lppm/luaran/{id}/ajukan`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLuaranByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/luaran/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Verifikasi luaran
     *
     * Admin/operator LPPM atau pengelola fakultas. keputusan: terverifikasi | ditolak; catatan.
     *
     * `POST /v1/lppm/luaran/{id}/verifikasi`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{keputusan: string, dana_disetujui?: float|int|null, nomor_sk?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLuaranByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/luaran/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar dosen peneliti
     *
     * Dosen SIAKAD beserta ID SINTA/Scopus/Scholar/ORCID, skor, jumlah penelitian, PkM, luaran (sejak tahun_dari, bawaan 3 tahun), sitasi.
     *
     * `GET /v1/lppm/peneliti`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param array{q?: string, kode_prodi?: string, kode_fakultas?: string, aktif?: string, tahun_dari?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeneliti(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/peneliti', [], $query, null, $options, false, false);
    }

    /**
     * Profil peneliti
     *
     * Profil pangkalan data, rekap per tahun, daftar kegiatan dan luaran.
     *
     * `GET /v1/lppm/peneliti/{nidn}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $nidn NIDN
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenelitiByNidn(int|string $nidn, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/peneliti/{nidn}', ['nidn' => $nidn], $query, null, $options, false, false);
    }

    /**
     * Ubah profil peneliti
     *
     * sinta_id, scopus_id, scholar_id, wos_id, garuda_id, orcid, skor/h-index/sitasi, bidang_keahlian, kelompok_riset. Oleh dosen sendiri atau pengelola.
     *
     * `PUT /v1/lppm/peneliti/{nidn}/profil`
     *
     * scope: `lppm:write`
     *
     * @param int|string $nidn NIDN
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPenelitiByNidnProfil(int|string $nidn, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/peneliti/{nidn}/profil', ['nidn' => $nidn], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dasbor
     *
     * Kegiatan per status/sumber dana/skema/prodi, luaran per jenis, jumlah dosen & mahasiswa terlibat, dan antrean tugas pengelola.
     *
     * `GET /v1/lppm/rekap/dasbor`
     *
     * scope: `lppm:read`
     *
     * @param array{tahun?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekapDasbor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/rekap/dasbor', [], $query, null, $options, false, false);
    }

    /**
     * Rekap kinerja per dosen
     *
     * Penelitian/PkM sebagai ketua/anggota, dana, luaran per kategori.
     *
     * `GET /v1/lppm/rekap/dosen`
     *
     * scope: `lppm:read`
     *
     * @param array{tahun_dari?: string, tahun_sampai?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekapDosen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/rekap/dosen', [], $query, null, $options, false, false);
    }

    /**
     * Tabel LKPS akreditasi prodi
     *
     * 3b1 penelitian DTPS per sumber dana; 3b2 PkM; 3b3 rekognisi; 3b4 publikasi; 3b5 karya disitasi; 3b6 produk diadopsi; 3b7 luaran lain (HKI, TTG, buku); 6a penelitian melibatkan mahasiswa; 7a PkM melibatkan mahasiswa. Kolom TS-2, TS-1, TS.
     *
     * `GET /v1/lppm/rekap/lkps/{tabel}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $tabel 3b1 | 3b2 | 3b3 | 3b4 | 3b5 | 3b6 | 3b7 | 6a | 7a
     * @param array{kode_prodi: string, ts?: string, terverifikasi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekapLkpsByTabel(int|string $tabel, array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/rekap/lkps/{tabel}', ['tabel' => $tabel], $query, null, $options, false, false);
    }

    /**
     * Direktori kolaborator
     *
     * Peneliti/mitra luar kampus yang pernah atau akan terlibat (nama, instansi, ORCID/SINTA/Scopus), dengan jumlah kegiatan. Untuk dosen dan pengelola.
     *
     * `GET /v1/lppm/kolaborator`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKolaborator(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kolaborator', [], $query, null, $options, false, false);
    }

    /**
     * Tambah kolaborator
     *
     * `POST /v1/lppm/kolaborator`
     *
     * scope: `lppm:write`
     *
     * @param array{nama: string|null, email?: string|null, hp?: string|null, instansi?: string|null, jabatan?: string|null, negara?: string|null, orcid?: string|null, sinta_id?: string|null, scopus_id?: string|null, scholar_id?: string|null, bidang_keahlian?: string|null, catatan?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKolaborator(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kolaborator', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail kolaborator
     *
     * Termasuk kegiatan yang diikuti lewat undangan.
     *
     * `GET /v1/lppm/kolaborator/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKolaboratorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kolaborator/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kolaborator
     *
     * Pencatat atau pengelola.
     *
     * `PUT /v1/lppm/kolaborator/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array{nama: string|null, email?: string|null, hp?: string|null, instansi?: string|null, jabatan?: string|null, negara?: string|null, orcid?: string|null, sinta_id?: string|null, scopus_id?: string|null, scholar_id?: string|null, bidang_keahlian?: string|null, catatan?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKolaboratorById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kolaborator/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kolaborator
     *
     * Pengelola.
     *
     * `DELETE /v1/lppm/kolaborator/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKolaboratorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kolaborator/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Undang anggota eksternal
     *
     * Ketua/pengelola membuat tautan bertoken (berlaku 30 hari; undangan lama dicabut) untuk anggota eksternal. Kolaborator diambil dari kolaborator_id, dicari/dibuat dari email, atau dibuat dari data anggota. Token hanya tampil sekali; kirim lewat email/WA. Konfirmasi anggota menjadi menunggu.
     *
     * `POST /v1/lppm/kegiatan/{id}/anggota/{anggota}/undang`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID angka atau UUID kegiatan
     * @param int|string $anggota ID anggota
     * @param array{kolaborator_id?: int|null, email?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdAnggotaByAnggotaUndang(int|string $id, int|string $anggota, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kegiatan/{id}/anggota/{anggota}/undang', ['id' => $id, 'anggota' => $anggota], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lihat undangan (tanpa token akses)
     *
     * Untuk kolaborator lewat tautan: ringkasan kegiatan, ketua, tim, peran dan tugasnya, serta profil kolaborator.
     *
     * `GET /v1/lppm/kolaborasi/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token undangan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKolaborasiByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kolaborasi/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Jawab undangan (tanpa token akses)
     *
     * {"setuju": true|false, "profil": {...}}. Menulis konfirmasi anggota, melengkapi profil kolaborator, dan memberi tahu ketua. Bisa diubah selama tautan berlaku.
     *
     * `POST /v1/lppm/kolaborasi/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token undangan
     * @param array{setuju: bool, profil?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKolaborasiByToken(int|string $token, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kolaborasi/{token}', ['token' => $token], $options['query'] ?? [], $body, $options, false, true);
    }

    /**
     * Metadata dari DOI (Crossref)
     *
     * Isian luaran siap pakai (judul, wadah, penerbit, ISSN/ISBN, volume, halaman, tahun, sitasi, saran jenis luaran) dan daftar penulis beserta ORCID. `sudah_tercatat` = ID luaran bila DOI sudah ada.
     *
     * `GET /v1/lppm/publikasi/doi`
     *
     * scope: `lppm:read`
     *
     * @param array{doi: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikasiDoi(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/publikasi/doi', [], $query, null, $options, false, false);
    }

    /**
     * Impor karya dari ORCID
     *
     * Karya di ORCID dosen (profil peneliti) yang belum tercatat dibuat sebagai luaran: status published, sumber impor, verifikasi belum. Jenis luaran ditebak dari tipe karya (jurnal nasional, prosiding nasional, buku, book chapter); pengelola menyesuaikan saat verifikasi. Dosen itu sendiri atau pengelola.
     *
     * `POST /v1/lppm/peneliti/{nidn}/impor-orcid`
     *
     * scope: `lppm:write`
     *
     * @param int|string $nidn NIDN
     * @param array{lengkapi_crossref?: bool, batas?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenelitiByNidnImporOrcid(int|string $nidn, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/peneliti/{nidn}/impor-orcid', ['nidn' => $nidn], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Perbarui jumlah sitasi (OpenAlex)
     *
     * Luaran ber-DOI yang paling lama tidak diperbarui lebih dulu. Pengelola: semua atau luaran_id tertentu; dosen: luarannya sendiri (isi nidn).
     *
     * `POST /v1/lppm/publikasi/sitasi`
     *
     * scope: `lppm:write`
     *
     * @param array{luaran_id?: list<mixed>|null, nidn?: string|null, batas?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPublikasiSitasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/publikasi/sitasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KKN saya (mahasiswa)
     *
     * `GET /v1/lppm/kkn/saya`
     *
     * scope: `lppm:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/saya', [], $query, null, $options, false, false);
    }

    /**
     * Kelompok bimbingan saya (DPL)
     *
     * `GET /v1/lppm/kkn/bimbingan`
     *
     * scope: `lppm:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknBimbingan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/bimbingan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar periode KKN
     *
     * `GET /v1/lppm/kkn/periode`
     *
     * scope: `lppm:read`
     *
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/periode', [], $query, null, $options, false, false);
    }

    /**
     * Tambah periode KKN
     *
     * Admin/operator.
     *
     * `POST /v1/lppm/kkn/periode`
     *
     * scope: `lppm:write`
     *
     * @param array{kode: string, nama: string, jenis?: string, tahun_id?: string|null, daftar_mulai?: string|null, daftar_selesai?: string|null, tanggal_mulai?: string|null, tanggal_selesai?: string|null, sks?: int, syarat_sks_min?: int, syarat_ipk_min?: float|int, kuota?: int, biaya?: float|int|null, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKknPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kkn/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail periode
     *
     * Kelompok, rekap status peserta, pendaftaran_dibuka.
     *
     * `GET /v1/lppm/kkn/periode/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah periode
     *
     * `PUT /v1/lppm/kkn/periode/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID periode
     * @param array{kode: string, nama: string, jenis?: string, tahun_id?: string|null, daftar_mulai?: string|null, daftar_selesai?: string|null, tanggal_mulai?: string|null, tanggal_selesai?: string|null, sks?: int, syarat_sks_min?: int, syarat_ipk_min?: float|int, kuota?: int, biaya?: float|int|null, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKknPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kkn/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus periode
     *
     * Hanya bila belum ada peserta.
     *
     * `DELETE /v1/lppm/kkn/periode/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKknPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kkn/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kelompok/lokasi periode
     *
     * `GET /v1/lppm/kkn/periode/{id}/kelompok`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknPeriodeByIdKelompok(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/periode/{id}/kelompok', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah kelompok
     *
     * Lokasi (desa, kecamatan, kabupaten, koordinat), mitra, DPL (nidn_dpl), kuota, tema, usulan_id program PkM.
     *
     * `POST /v1/lppm/kkn/periode/{id}/kelompok`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID periode
     * @param array{kode: string, nama: string, desa?: string, kecamatan?: string, kabupaten?: string, provinsi?: string, lat?: float|int, lng?: float|int, mitra_id?: int|null, nidn_dpl?: string|null, kuota?: int, tema?: string, usulan_id?: int|null, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKknPeriodeByIdKelompok(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kkn/periode/{id}/kelompok', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta periode
     *
     * Pengelola: semua; DPL: kelompoknya; mahasiswa: dirinya.
     *
     * `GET /v1/lppm/kkn/periode/{id}/peserta`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param int|string $id ID periode
     * @param array{q?: string, status?: string, kelompok_id?: string, kode_prodi?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknPeriodeByIdPeserta(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/periode/{id}/peserta', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar KKN
     *
     * Mahasiswa sendiri saat pendaftaran dibuka; pengelola dengan body nim (langsung diterima). ukuran_baju, kontak_darurat.
     *
     * `POST /v1/lppm/kkn/periode/{id}/daftar`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKknPeriodeByIdDaftar(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kkn/periode/{id}/daftar', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penempatan massal
     *
     * Body {"item": [{nim | peserta_id, kelompok_id, jabatan}]}.
     *
     * `POST /v1/lppm/kkn/periode/{id}/penempatan`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKknPeriodeByIdPenempatan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kkn/periode/{id}/penempatan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail kelompok
     *
     * Termasuk peserta dan file.
     *
     * `GET /v1/lppm/kkn/kelompok/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID kelompok
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknKelompokById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/kelompok/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kelompok
     *
     * `PUT /v1/lppm/kkn/kelompok/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID kelompok
     * @param array{kode: string, nama: string, desa?: string, kecamatan?: string, kabupaten?: string, provinsi?: string, lat?: float|int, lng?: float|int, mitra_id?: int|null, nidn_dpl?: string|null, kuota?: int, tema?: string, usulan_id?: int|null, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKknKelompokById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kkn/kelompok/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kelompok
     *
     * `DELETE /v1/lppm/kkn/kelompok/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID kelompok
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKknKelompokById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/kkn/kelompok/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * DPL memeriksa logbook
     *
     * status: disetujui | ditolak; catatan.
     *
     * `POST /v1/lppm/kkn/logbook/{log}/periksa`
     *
     * scope: `lppm:write`
     *
     * @param int|string $log ID catatan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKknLogbookByLogPeriksa(int|string $log, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kkn/logbook/{log}/periksa', ['log' => $log], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail peserta
     *
     * `GET /v1/lppm/kkn/peserta/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $id ID peserta
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknPesertaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/peserta/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah peserta
     *
     * Pengelola: status, kelompok_id, jabatan, catatan. Peserta: ukuran_baju, kontak_darurat, status=mengundurkan_diri.
     *
     * `PUT /v1/lppm/kkn/peserta/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID peserta
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKknPesertaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kkn/peserta/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Nilai peserta
     *
     * DPL kelompok atau pengelola. nilai_dpl, nilai_mitra, nilai_laporan (0-100), bobot {nilai_dpl: 50, ...}, tetapkan_kelulusan. Huruf dari skala nilai SIAKAD (m_nilai) prodi peserta; tidak ditulis ke KHS.
     *
     * `POST /v1/lppm/kkn/peserta/{id}/nilai`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID peserta
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKknPesertaByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kkn/peserta/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Logbook peserta
     *
     * `GET /v1/lppm/kkn/peserta/{id}/logbook`
     *
     * scope: `lppm:read` · berhalaman
     *
     * @param int|string $id ID peserta
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKknPesertaByIdLogbook(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/kkn/peserta/{id}/logbook', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah logbook (peserta)
     *
     * `POST /v1/lppm/kkn/peserta/{id}/logbook`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID peserta
     * @param array{tanggal: string|null, kegiatan: string, capaian_persen?: int|null, biaya?: float|int|null, status?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKknPesertaByIdLogbook(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/kkn/peserta/{id}/logbook', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah logbook (peserta)
     *
     * `PUT /v1/lppm/kkn/peserta/{id}/logbook/{log}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $id ID peserta
     * @param int|string $log ID catatan
     * @param array{tanggal: string|null, kegiatan: string, capaian_persen?: int|null, biaya?: float|int|null, status?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKknPesertaByIdLogbookByLog(int|string $id, int|string $log, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lppm/kkn/peserta/{id}/logbook/{log}', ['id' => $id, 'log' => $log], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unduh file
     *
     * Hak akses mengikuti entitas pemilik. inline=1 untuk PDF/gambar/video.
     *
     * `GET /v1/lppm/file/{uuid}/unduh`
     *
     * scope: `lppm:read`
     *
     * @param int|string $uuid UUID file
     * @param array{inline?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByUuidUnduh(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/file/{uuid}/unduh', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Hapus file
     *
     * Pengunggah atau pengelola.
     *
     * `DELETE /v1/lppm/file/{uuid}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $uuid UUID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lppm/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Daftar file entitas
     *
     * `GET /v1/lppm/file/{entitas}/{id}`
     *
     * scope: `lppm:read`
     *
     * @param int|string $entitas usulan | laporan | logbook | luaran | mitra | pencairan | kkn_peserta | kkn_kelompok
     * @param int|string $id ID entitas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByEntitasById(int|string $entitas, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lppm/file/{entitas}/{id}', ['entitas' => $entitas, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah file
     *
     * multipart/form-data: berkas, peran (proposal, kontrak, laporan, bukti, sertifikat, surat_mitra, dokumentasi, ...), keterangan. Atau JSON: berkas_base64 + nama_file. Usulan butuh file peran=proposal bila substansi tidak diisi.
     *
     * `POST /v1/lppm/file/{entitas}/{id}`
     *
     * scope: `lppm:write`
     *
     * @param int|string $entitas Entitas
     * @param int|string $id ID entitas
     * @param array{berkas: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, peran?: string|null, keterangan?: string|null, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFileByEntitasById(int|string $entitas, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lppm/file/{entitas}/{id}', ['entitas' => $entitas, 'id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }
}
