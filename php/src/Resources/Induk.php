<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Induk: Unit organisasi, Induk: Pejabat, Induk: Orang, Induk: Jabatan, Induk: Peran modul, Induk: Log audit
 */
final class Induk extends Resource
{
    /**
     * Pohon unit organisasi
     *
     * Seluruh unit tersusun bertingkat (turunan). ?aktif=1 hanya unit aktif.
     *
     * `GET /v1/induk/unit-pohon`
     *
     * scope: `induk:read`
     *
     * @param array{aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitPohon(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/unit-pohon', [], $query, null, $options, false, false);
    }

    /**
     * Buat unit dari data SIAKAD
     *
     * Membuat unit universitas, fakultas (m_fakultas), dan prodi (m_program_studi) yang belum ada, serta pejabat dekan (m_fakultas.pejabat) dan kaprodi (idd_ketua_prodi). Aman diulang; tabel lama hanya dibaca.
     *
     * `POST /v1/induk/unit/sinkron-siakad`
     *
     * scope: `induk:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnitSinkronSiakad(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/unit/sinkron-siakad', [], $query, null, $options, false, false);
    }

    /**
     * Pejabat aktif suatu unit
     *
     * unit = ID, kode unit, kode_prodi, atau kode_fakultas; jabatan = kode jabatan (opsional), mis. DEKAN, KAPRODI.
     *
     * `GET /v1/induk/pejabat-aktif`
     *
     * scope: `induk:read`
     *
     * @param array{unit: string, jabatan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPejabatAktif(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/pejabat-aktif', [], $query, null, $options, false, false);
    }

    /**
     * Buat identitas dari data SIAKAD
     *
     * Membuat induk_orang + induk_orang_peran dari m_mahasiswa, m_dosen, atau m_karyawan yang belum terdaftar, paling banyak `batas` baris per panggilan (ulangi sampai sisa = 0). Dosen/tendik dengan NIK KTP sama digabung ke satu orang. Mahasiswa berstatus L juga diberi peran alumni.
     *
     * `POST /v1/induk/orang/sinkron-siakad`
     *
     * scope: `induk:admin`
     *
     * @param array{sumber: string, batas?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrangSinkronSiakad(array $query, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/orang/sinkron-siakad', [], $query, null, $options, false, false);
    }

    /**
     * Cari orang dari kunci apa pun
     *
     * kunci = NIM, NIDN, NIK karyawan, username, email, NIK, atau UUID. Hak lihat sama dengan detail orang (pengelola, atau diri sendiri).
     *
     * `GET /v1/induk/cari-orang`
     *
     * scope: `induk:read`
     *
     * @param array{kunci: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCariOrang(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/cari-orang', [], $query, null, $options, false, false);
    }

    /**
     * Identitas saya
     *
     * Identitas, peran, peran pengelola modul, dan jabatan aktif pemilik token.
     *
     * `GET /v1/induk/saya`
     *
     * scope: `induk:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/saya', [], $query, null, $options, false, false);
    }

    /**
     * Unit organisasi: daftar
     *
     * Pohon unit universitas › fakultas › prodi, serta biro, lembaga, UPT, dan bagian. Unit fakultas/prodi terhubung ke tabel lama lewat kode_fakultas/kode_prodi. Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/unit`
     *
     * scope: `induk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, induk_id?: string, jenis?: string, kode_fakultas?: string, kode_prodi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/unit', [], $query, null, $options, false, false);
    }

    /**
     * Unit organisasi: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/induk/unit`
     *
     * scope: `induk:write`
     *
     * @param array{induk_id?: int, kode: string, jenis: string, kode_fakultas?: string, kode_prodi?: string, nama: string, nama_en?: string, singkatan?: string, email?: string, telepon?: string, situs?: string, alamat?: string, tanggal_berdiri?: string, nomor_sk_pendirian?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnit(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/unit', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit organisasi: detail
     *
     * Pohon unit universitas › fakultas › prodi, serta biro, lembaga, UPT, dan bagian. Unit fakultas/prodi terhubung ke tabel lama lewat kode_fakultas/kode_prodi. Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/unit/{id}`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unit organisasi: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/induk/unit/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{induk_id?: int, kode: string, jenis: string, kode_fakultas?: string, kode_prodi?: string, nama: string, nama_en?: string, singkatan?: string, email?: string, telepon?: string, situs?: string, alamat?: string, tanggal_berdiri?: string, nomor_sk_pendirian?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUnitById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/induk/unit/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit organisasi: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/induk/unit/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/induk/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unit organisasi: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pohon unit universitas › fakultas › prodi, serta biro, lembaga, UPT, dan bagian. Unit fakultas/prodi terhubung ke tabel lama lewat kode_fakultas/kode_prodi. Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/unit/{id}/riwayat`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/unit/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural: daftar
     *
     * Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/jabatan`
     *
     * scope: `induk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kelompok?: string, tunggal?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJabatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/jabatan', [], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/induk/jabatan`
     *
     * scope: `induk:write`
     *
     * @param array{kode: string, nama: string, kelompok?: string, untuk_jenis_unit?: string, tunggal?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJabatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/jabatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan struktural: detail
     *
     * Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/jabatan/{id}`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/induk/jabatan/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, kelompok?: string, untuk_jenis_unit?: string, tunggal?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putJabatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/induk/jabatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan struktural: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/induk/jabatan/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/induk/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/jabatan/{id}/riwayat`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJabatanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/jabatan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pejabat struktural: daftar
     *
     * Pejabat aktif dipakai modul lain untuk tanda tangan dan persetujuan. Jabatan bertanda tunggal hanya boleh punya satu pejabat aktif per unit. Riwayat jabatan lengkap pegawai ada di modul kepegawaian. Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/pejabat`
     *
     * scope: `induk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, unit_id?: string, jabatan_id?: string, orang_id?: string, nidn?: string, nik_karyawan?: string, username?: string, plt?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPejabat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/pejabat', [], $query, null, $options, false, false);
    }

    /**
     * Pejabat struktural: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/induk/pejabat`
     *
     * scope: `induk:write`
     *
     * @param array{unit_id: int, jabatan_id: int, orang_id?: int, nidn?: string, nik_karyawan?: string, username?: string, nama?: string, nip?: string, nomor_sk?: string, tanggal_sk?: string, mulai: string, selesai?: string, plt?: bool, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPejabat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/pejabat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pejabat struktural: detail
     *
     * Pejabat aktif dipakai modul lain untuk tanda tangan dan persetujuan. Jabatan bertanda tunggal hanya boleh punya satu pejabat aktif per unit. Riwayat jabatan lengkap pegawai ada di modul kepegawaian. Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/pejabat/{id}`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPejabatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/pejabat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pejabat struktural: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/induk/pejabat/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{unit_id: int, jabatan_id: int, orang_id?: int, nidn?: string, nik_karyawan?: string, username?: string, nama?: string, nip?: string, nomor_sk?: string, tanggal_sk?: string, mulai: string, selesai?: string, plt?: bool, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPejabatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/induk/pejabat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pejabat struktural: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/induk/pejabat/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePejabatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/induk/pejabat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pejabat struktural: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pejabat aktif dipakai modul lain untuk tanda tangan dan persetujuan. Jabatan bertanda tunggal hanya boleh punya satu pejabat aktif per unit. Riwayat jabatan lengkap pegawai ada di modul kepegawaian. Semua pemilik token ber-scope induk:read.
     *
     * `GET /v1/induk/pejabat/{id}/riwayat`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPejabatByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/pejabat/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Orang (identitas tunggal): daftar
     *
     * Satu identitas untuk setiap orang lintas peran. Data pribadi: pengelola melihat semua; pengguna lain hanya dirinya sendiri (username). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/induk/orang`
     *
     * scope: `induk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis_kelamin?: string, username?: string, aktif?: string, email?: string, nik?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/orang', [], $query, null, $options, false, false);
    }

    /**
     * Orang (identitas tunggal): tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/induk/orang`
     *
     * scope: `induk:write`
     *
     * @param array{nama: string, gelar_depan?: string, gelar_belakang?: string, nik?: string, jenis_kelamin?: string, tempat_lahir?: string, tanggal_lahir?: string, email?: string, hp?: string, username?: string, sdm_pegawai_id?: int, catatan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrang(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/orang', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Orang (identitas tunggal): detail
     *
     * Satu identitas untuk setiap orang lintas peran. Data pribadi: pengelola melihat semua; pengguna lain hanya dirinya sendiri (username). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/induk/orang/{id}`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/orang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Orang (identitas tunggal): ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/induk/orang/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nama: string, gelar_depan?: string, gelar_belakang?: string, nik?: string, jenis_kelamin?: string, tempat_lahir?: string, tanggal_lahir?: string, email?: string, hp?: string, username?: string, sdm_pegawai_id?: int, catatan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putOrangById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/induk/orang/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Orang (identitas tunggal): hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/induk/orang/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteOrangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/induk/orang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Orang (identitas tunggal): riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Satu identitas untuk setiap orang lintas peran. Data pribadi: pengelola melihat semua; pengguna lain hanya dirinya sendiri (username). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/induk/orang/{id}/riwayat`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrangByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/orang/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran orang: daftar
     *
     * Peran orang (mahasiswa, dosen, tendik, alumni, mitra) beserta kuncinya di sumber data (NIM, NIDN, NIK karyawan). Pasangan peran+kunci unik. Hanya pengelola modul.
     *
     * `GET /v1/induk/orang-peran`
     *
     * scope: `induk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, orang_id?: string, peran?: string, sumber?: string, unit_id?: string, kode_prodi?: string, aktif?: string, kunci?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrangPeran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/orang-peran', [], $query, null, $options, false, false);
    }

    /**
     * Peran orang: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/induk/orang-peran`
     *
     * scope: `induk:write`
     *
     * @param array{orang_id: int, peran: string, kunci: string, sumber?: string, unit_id?: int, kode_prodi?: string, status?: string, aktif?: bool, mulai?: string, selesai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrangPeran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/orang-peran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran orang: detail
     *
     * Peran orang (mahasiswa, dosen, tendik, alumni, mitra) beserta kuncinya di sumber data (NIM, NIDN, NIK karyawan). Pasangan peran+kunci unik. Hanya pengelola modul.
     *
     * `GET /v1/induk/orang-peran/{id}`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrangPeranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/orang-peran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran orang: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/induk/orang-peran/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{orang_id: int, peran: string, kunci: string, sumber?: string, unit_id?: int, kode_prodi?: string, status?: string, aktif?: bool, mulai?: string, selesai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putOrangPeranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/induk/orang-peran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran orang: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/induk/orang-peran/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteOrangPeranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/induk/orang-peran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran orang: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Peran orang (mahasiswa, dosen, tendik, alumni, mitra) beserta kuncinya di sumber data (NIM, NIDN, NIK karyawan). Pasangan peran+kunci unik. Hanya pengelola modul.
     *
     * `GET /v1/induk/orang-peran/{id}/riwayat`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrangPeranByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/orang-peran/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran pengelola modul: daftar
     *
     * Menunjuk pengguna SIAKAD sebagai admin/pengelola modul pusat data (mbkm, kerjasama, kemahasiswaan, layanan, kalender, sarpras, keuangan, notifikasi, repositori, karier, helpdesk, dasbor, cbt, atau * untuk semua). unit_id membatasi ke unit itu dan turunannya. Hanya pengelola modul dan pemilik baris.
     *
     * `GET /v1/induk/peran`
     *
     * scope: `induk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, peran?: string, unit_id?: string, aktif?: string, modul?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/peran', [], $query, null, $options, false, false);
    }

    /**
     * Peran pengelola modul: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/induk/peran`
     *
     * scope: `induk:write`
     *
     * @param array{username: string, modul: string, peran?: string, unit_id?: int, keterangan?: string, aktif?: bool, mulai?: string, selesai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/induk/peran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran pengelola modul: detail
     *
     * Menunjuk pengguna SIAKAD sebagai admin/pengelola modul pusat data (mbkm, kerjasama, kemahasiswaan, layanan, kalender, sarpras, keuangan, notifikasi, repositori, karier, helpdesk, dasbor, cbt, atau * untuk semua). unit_id membatasi ke unit itu dan turunannya. Hanya pengelola modul dan pemilik baris.
     *
     * `GET /v1/induk/peran/{id}`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/peran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran pengelola modul: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/induk/peran/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, modul: string, peran?: string, unit_id?: int, keterangan?: string, aktif?: bool, mulai?: string, selesai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/induk/peran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peran pengelola modul: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/induk/peran/{id}`
     *
     * scope: `induk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/induk/peran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran pengelola modul: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Menunjuk pengguna SIAKAD sebagai admin/pengelola modul pusat data (mbkm, kerjasama, kemahasiswaan, layanan, kalender, sarpras, keuangan, notifikasi, repositori, karier, helpdesk, dasbor, cbt, atau * untuk semua). unit_id membatasi ke unit itu dan turunannya. Hanya pengelola modul dan pemilik baris.
     *
     * `GET /v1/induk/peran/{id}/riwayat`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeranByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/peran/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Log audit pusat data: daftar
     *
     * Jejak perubahan semua modul pusat data (filter modul, entitas, entitas_id, oleh, dari/sampai). Hanya pengelola modul.
     *
     * `GET /v1/induk/log`
     *
     * scope: `induk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, modul?: string, entitas?: string, entitas_id?: string, oleh?: string, aksi?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/log', [], $query, null, $options, false, false);
    }

    /**
     * Log audit pusat data: detail
     *
     * Jejak perubahan semua modul pusat data (filter modul, entitas, entitas_id, oleh, dari/sampai). Hanya pengelola modul.
     *
     * `GET /v1/induk/log/{id}`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/log/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Log audit pusat data: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Jejak perubahan semua modul pusat data (filter modul, entitas, entitas_id, oleh, dari/sampai). Hanya pengelola modul.
     *
     * `GET /v1/induk/log/{id}/riwayat`
     *
     * scope: `induk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/induk/log/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }
}
