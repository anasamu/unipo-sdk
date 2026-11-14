<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Layanan: Verifikasi dokumen, Layanan: Katalog, Layanan: Permohonan
 */
final class Layanan extends Resource
{
    /**
     * Cek keaslian dokumen (publik)
     *
     * Tanpa token, untuk tautan di QR code. Menampilkan status (sah/dicabut/kedaluwarsa), jenis, nomor, judul, nama pemilik yang disamarkan, penerbit, dan SHA-256 file. Kirim ?sha256= untuk mencocokkan file yang dipegang.
     *
     * `GET /v1/layanan/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi
     * @param array{sha256?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Jenis layanan: daftar
     *
     * Katalog layanan. `isian` = JSON daftar isian formulir, mis. [{"nama":"semester","label":"Semester","wajib":true}]. Semua pemilik token ber-scope layanan:read.
     *
     * `GET /v1/layanan/jenis`
     *
     * scope: `layanan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kategori?: string, unit_id?: string, wajib_berkas?: string, terbitkan_dokumen?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Jenis layanan: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/layanan/jenis`
     *
     * scope: `layanan:write`
     *
     * @param array{kode: string, nama: string, kategori?: string, untuk?: string, unit_id?: int, keterangan?: string, syarat?: string, isian?: array<string, mixed>, biaya?: float|int, sla_hari?: int, wajib_berkas?: bool, terbitkan_dokumen?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenis(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/jenis', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis layanan: detail
     *
     * Katalog layanan. `isian` = JSON daftar isian formulir, mis. [{"nama":"semester","label":"Semester","wajib":true}]. Semua pemilik token ber-scope layanan:read.
     *
     * `GET /v1/layanan/jenis/{id}`
     *
     * scope: `layanan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenisById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/jenis/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis layanan: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/layanan/jenis/{id}`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, kategori?: string, untuk?: string, unit_id?: int, keterangan?: string, syarat?: string, isian?: array<string, mixed>, biaya?: float|int, sla_hari?: int, wajib_berkas?: bool, terbitkan_dokumen?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putJenisById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/layanan/jenis/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis layanan: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/layanan/jenis/{id}`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteJenisById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/layanan/jenis/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan layanan: daftar
     *
     * Diajukan pengguna (pemohon = username otomatis, dicek level yang boleh dan isian wajib). Pengelola unit pelaksana memproses. Setiap perubahan status dicatat di riwayat dan dikirim sebagai notifikasi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pemohon).
     *
     * `GET /v1/layanan/permohonan`
     *
     * scope: `layanan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis_id?: string, unit_id?: string, pemohon?: string, kode_prodi?: string, status?: string, petugas?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/permohonan', [], $query, null, $options, false, false);
    }

    /**
     * Permohonan layanan: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pemohon diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/perlu_perbaikan.
     *
     * `POST /v1/layanan/permohonan`
     *
     * scope: `layanan:write`
     *
     * @param array{jenis_id: int, pemohon: string, keperluan?: string, data?: array<string, mixed>, petugas?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan layanan: detail
     *
     * Diajukan pengguna (pemohon = username otomatis, dicek level yang boleh dan isian wajib). Pengelola unit pelaksana memproses. Setiap perubahan status dicatat di riwayat dan dikirim sebagai notifikasi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pemohon).
     *
     * `GET /v1/layanan/permohonan/{id}`
     *
     * scope: `layanan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/permohonan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan layanan: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pemohon diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/perlu_perbaikan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/layanan/permohonan/{id}`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{jenis_id: int, pemohon: string, keperluan?: string, data?: array<string, mixed>, petugas?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPermohonanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/layanan/permohonan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan layanan: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pemohon diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/perlu_perbaikan.
     *
     * `DELETE /v1/layanan/permohonan/{id}`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePermohonanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/layanan/permohonan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan layanan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/layanan/permohonan/{id}/berkas`
     *
     * scope: `layanan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/permohonan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan layanan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (pemohon diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/perlu_perbaikan.
     *
     * `POST /v1/layanan/permohonan/{id}/berkas`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Permohonan layanan: unduh lampiran
     *
     * `GET /v1/layanan/permohonan/{id}/berkas/{uuid}`
     *
     * scope: `layanan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/permohonan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Permohonan layanan: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pemohon diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/perlu_perbaikan.
     *
     * `DELETE /v1/layanan/permohonan/{id}/berkas/{uuid}`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePermohonanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/layanan/permohonan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Permohonan layanan: Proses
     *
     * Pengelola modul. Status harus diajukan, menjadi diproses.
     *
     * `POST /v1/layanan/permohonan/{id}/proses`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdProses(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan/{id}/proses', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan layanan: Minta perbaikan
     *
     * Pengelola modul. Status harus diajukan/diproses, menjadi perlu_perbaikan.
     *
     * `POST /v1/layanan/permohonan/{id}/minta-perbaikan`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdMintaPerbaikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan/{id}/minta-perbaikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan layanan: Kirim ulang setelah perbaikan
     *
     * Pemilik data. Status harus perlu_perbaikan, menjadi diajukan.
     *
     * `POST /v1/layanan/permohonan/{id}/kirim-ulang`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdKirimUlang(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan/{id}/kirim-ulang', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan layanan: Selesaikan
     *
     * Bila jenis layanan menerbitkan dokumen, dokumen didaftarkan untuk verifikasi QR (kode ada di respons). Lampirkan file final ke permohonan lewat /berkas; sidik SHA-256 file terakhir dipakai saat verifikasi. Pengelola modul. Status harus diajukan/diproses, menjadi selesai.
     *
     * `POST /v1/layanan/permohonan/{id}/selesai`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, nomor_dokumen?: string, judul_dokumen?: string, penandatangan?: string, berlaku_sampai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan layanan: Tolak
     *
     * Pengelola modul. Status harus diajukan/diproses/perlu_perbaikan, menjadi ditolak.
     *
     * `POST /v1/layanan/permohonan/{id}/tolak`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan layanan: Batalkan
     *
     * Pemilik data atau pengelola. Status harus diajukan/perlu_perbaikan, menjadi dibatalkan.
     *
     * `POST /v1/layanan/permohonan/{id}/batalkan`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/permohonan/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: daftar
     *
     * Registri dokumen resmi (surat, transkrip, ijazah, SKPI, sertifikat) dengan kode verifikasi untuk QR. Bisa juga didaftarkan aplikasi/modul lain. Pemilik dokumen melihat dokumennya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pemilik_username).
     *
     * `GET /v1/layanan/dokumen`
     *
     * scope: `layanan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, pemilik_username?: string, unit_id?: string, permohonan_id?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/layanan/dokumen`
     *
     * scope: `layanan:write`
     *
     * @param array{jenis: string, nomor?: string, judul: string, pemilik_nama?: string, pemilik_username?: string, tanggal_terbit: string, berlaku_sampai?: string, unit_id?: int, penandatangan?: string, sha256?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: detail
     *
     * Registri dokumen resmi (surat, transkrip, ijazah, SKPI, sertifikat) dengan kode verifikasi untuk QR. Bisa juga didaftarkan aplikasi/modul lain. Pemilik dokumen melihat dokumennya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pemilik_username).
     *
     * `GET /v1/layanan/dokumen/{id}`
     *
     * scope: `layanan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/layanan/dokumen/{id}`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{jenis: string, nomor?: string, judul: string, pemilik_nama?: string, pemilik_username?: string, tanggal_terbit: string, berlaku_sampai?: string, unit_id?: int, penandatangan?: string, sha256?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/layanan/dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/layanan/dokumen/{id}/berkas`
     *
     * scope: `layanan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/dokumen/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/layanan/dokumen/{id}/berkas`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/dokumen/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Dokumen terverifikasi: unduh lampiran
     *
     * `GET /v1/layanan/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `layanan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/layanan/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/layanan/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/layanan/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen terverifikasi: Cabut
     *
     * Admin modul. Status harus sah, menjadi dicabut.
     *
     * `POST /v1/layanan/dokumen/{id}/cabut`
     *
     * scope: `layanan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/layanan/dokumen/{id}/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
