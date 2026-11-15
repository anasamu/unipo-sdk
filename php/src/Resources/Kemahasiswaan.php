<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kemahasiswaan: Beasiswa, Kemahasiswaan: Organisasi, Kemahasiswaan: Prestasi, Kemahasiswaan: Konseling, Kemahasiswaan: Pelanggaran
 */
final class Kemahasiswaan extends Resource
{
    /**
     * Program beasiswa: daftar
     *
     * Semua pemilik token ber-scope kemahasiswaan:read (selain pengelola hanya melihat status buka/seleksi/berjalan/selesai).
     *
     * `GET /v1/kemahasiswaan/beasiswa`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, mitra_id?: string, tahun_id?: string, kode_prodi?: string, periode_pencairan?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/beasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kemahasiswaan/beasiswa`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{kode: string, nama: string, jenis: string, penyelenggara?: string, mitra_id?: int, tahun_id: string, kode_prodi?: string, nominal?: float|int, periode_pencairan?: string, kuota?: int, ipk_minimal?: float|int, semester_minimal?: int, semester_maksimal?: int, syarat?: string, daftar_mulai?: string, daftar_selesai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/beasiswa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Program beasiswa: detail
     *
     * Semua pemilik token ber-scope kemahasiswaan:read (selain pengelola hanya melihat status buka/seleksi/berjalan/selesai).
     *
     * `GET /v1/kemahasiswaan/beasiswa/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/beasiswa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/beasiswa/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, jenis: string, penyelenggara?: string, mitra_id?: int, tahun_id: string, kode_prodi?: string, nominal?: float|int, periode_pencairan?: string, kuota?: int, ipk_minimal?: float|int, semester_minimal?: int, semester_maksimal?: int, syarat?: string, daftar_mulai?: string, daftar_selesai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBeasiswaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/beasiswa/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Program beasiswa: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kemahasiswaan/beasiswa/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBeasiswaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/beasiswa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kemahasiswaan/beasiswa/{id}/berkas`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/beasiswa/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/kemahasiswaan/beasiswa/{id}/berkas`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/beasiswa/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Program beasiswa: unduh lampiran
     *
     * `GET /v1/kemahasiswaan/beasiswa/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/beasiswa/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kemahasiswaan/beasiswa/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBeasiswaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/beasiswa/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: Buka pendaftaran
     *
     * Pengelola modul. Status harus draf, menjadi buka.
     *
     * `POST /v1/kemahasiswaan/beasiswa/{id}/buka`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/beasiswa/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: Tutup pendaftaran dan mulai seleksi
     *
     * Pengelola modul. Status harus buka, menjadi seleksi.
     *
     * `POST /v1/kemahasiswaan/beasiswa/{id}/seleksi`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaByIdSeleksi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/beasiswa/{id}/seleksi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: Tetapkan penerima (mulai berjalan)
     *
     * Pengelola modul. Status harus seleksi, menjadi berjalan.
     *
     * `POST /v1/kemahasiswaan/beasiswa/{id}/tetapkan`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaByIdTetapkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/beasiswa/{id}/tetapkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program beasiswa: Selesaikan
     *
     * Pengelola modul. Status harus berjalan, menjadi selesai.
     *
     * `POST /v1/kemahasiswaan/beasiswa/{id}/selesai`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/beasiswa/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: daftar
     *
     * Mahasiswa mendaftar sendiri saat program berstatus buka; dicek prodi, kuota, semester, dan IPK minimal bila ipk diisi pengelola. Lampirkan berkas syarat lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/pendaftar`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, beasiswa_id?: string, nim?: string, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendaftar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pendaftar', [], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/kemahasiswaan/pendaftar`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{beasiswa_id: int, nim: string, ipk?: float|int, semester?: int, penghasilan_ortu?: float|int, alasan?: string, skor?: float|int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftar(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pendaftar', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: detail
     *
     * Mahasiswa mendaftar sendiri saat program berstatus buka; dicek prodi, kuota, semester, dan IPK minimal bila ipk diisi pengelola. Lampirkan berkas syarat lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/pendaftar/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendaftarById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pendaftar/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/pendaftar/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{beasiswa_id: int, nim: string, ipk?: float|int, semester?: int, penghasilan_ortu?: float|int, alasan?: string, skor?: float|int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPendaftarById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/pendaftar/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/kemahasiswaan/pendaftar/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePendaftarById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/pendaftar/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kemahasiswaan/pendaftar/{id}/berkas`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendaftarByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pendaftar/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/kemahasiswaan/pendaftar/{id}/berkas`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pendaftar/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pendaftar beasiswa: unduh lampiran
     *
     * `GET /v1/kemahasiswaan/pendaftar/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendaftarByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pendaftar/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/kemahasiswaan/pendaftar/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePendaftarByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/pendaftar/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: Berkas lengkap
     *
     * Pengelola modul. Status harus diajukan, menjadi diverifikasi.
     *
     * `POST /v1/kemahasiswaan/pendaftar/{id}/verifikasi`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{skor?: float|int, ipk?: float|int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pendaftar/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: Terima
     *
     * Pengelola modul. Status harus diajukan/diverifikasi, menjadi diterima.
     *
     * `POST /v1/kemahasiswaan/pendaftar/{id}/terima`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdTerima(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pendaftar/{id}/terima', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: Tolak
     *
     * Pengelola modul. Status harus diajukan/diverifikasi, menjadi ditolak.
     *
     * `POST /v1/kemahasiswaan/pendaftar/{id}/tolak`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pendaftar/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendaftar beasiswa: Cabut beasiswa
     *
     * Pengelola modul. Status harus diterima, menjadi dicabut.
     *
     * `POST /v1/kemahasiswaan/pendaftar/{id}/cabut`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pendaftar/{id}/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pencairan beasiswa: daftar
     *
     * Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/pencairan`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pendaftar_id?: string, nim?: string, tahun_id?: string, cara?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPencairan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pencairan', [], $query, null, $options, false, false);
    }

    /**
     * Pencairan beasiswa: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kemahasiswaan/pencairan`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{pendaftar_id: int, tahun_id?: string, tanggal?: string, nominal: float|int, cara?: string, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPencairan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pencairan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pencairan beasiswa: detail
     *
     * Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/pencairan/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPencairanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pencairan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pencairan beasiswa: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/pencairan/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pendaftar_id: int, tahun_id?: string, tanggal?: string, nominal: float|int, cara?: string, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPencairanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/pencairan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pencairan beasiswa: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kemahasiswaan/pencairan/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePencairanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/pencairan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pencairan beasiswa: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kemahasiswaan/pencairan/{id}/berkas`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPencairanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pencairan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pencairan beasiswa: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/kemahasiswaan/pencairan/{id}/berkas`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPencairanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pencairan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pencairan beasiswa: unduh lampiran
     *
     * `GET /v1/kemahasiswaan/pencairan/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPencairanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pencairan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pencairan beasiswa: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kemahasiswaan/pencairan/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePencairanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/pencairan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: daftar
     *
     * Semua pemilik token ber-scope kemahasiswaan:read.
     *
     * `GET /v1/kemahasiswaan/ormawa`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, unit_id?: string, kode_prodi?: string, pembina_nidn?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrmawa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/ormawa', [], $query, null, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kemahasiswaan/ormawa`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{kode: string, nama: string, jenis: string, bidang?: string, unit_id?: int, kode_prodi?: string, pembina_nidn?: string, deskripsi?: string, email?: string, instagram?: string, nomor_sk?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrmawa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/ormawa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: detail
     *
     * Semua pemilik token ber-scope kemahasiswaan:read.
     *
     * `GET /v1/kemahasiswaan/ormawa/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrmawaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/ormawa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/ormawa/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, jenis: string, bidang?: string, unit_id?: int, kode_prodi?: string, pembina_nidn?: string, deskripsi?: string, email?: string, instagram?: string, nomor_sk?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putOrmawaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/ormawa/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kemahasiswaan/ormawa/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteOrmawaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/ormawa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kemahasiswaan/ormawa/{id}/berkas`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrmawaByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/ormawa/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kemahasiswaan/ormawa/{id}/berkas`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrmawaByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/ormawa/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Organisasi mahasiswa: unduh lampiran
     *
     * `GET /v1/kemahasiswaan/ormawa/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrmawaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/ormawa/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Organisasi mahasiswa: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kemahasiswaan/ormawa/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteOrmawaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/ormawa/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengurus organisasi: daftar
     *
     * Semua pemilik token ber-scope kemahasiswaan:read.
     *
     * `GET /v1/kemahasiswaan/pengurus`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ormawa_id?: string, nim?: string, inti?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengurus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pengurus', [], $query, null, $options, false, false);
    }

    /**
     * Pengurus organisasi: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kemahasiswaan/pengurus`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{ormawa_id: int, nim: string, jabatan: string, inti?: bool, mulai: string, selesai?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengurus(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pengurus', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengurus organisasi: detail
     *
     * Semua pemilik token ber-scope kemahasiswaan:read.
     *
     * `GET /v1/kemahasiswaan/pengurus/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengurusById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pengurus/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengurus organisasi: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/pengurus/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{ormawa_id: int, nim: string, jabatan: string, inti?: bool, mulai: string, selesai?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengurusById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/pengurus/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengurus organisasi: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kemahasiswaan/pengurus/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengurusById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/pengurus/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): daftar
     *
     * Diajukan pengurus inti ormawa (pengaju_nim otomatis), disetujui pengelola atau pembina, lalu LPJ diajukan dan diterima. Selain pengelola melihat kegiatan yang sudah disetujui, kegiatan yang diajukannya, atau ormawa yang dibinanya. Semua pemilik token ber-scope kemahasiswaan:read (selain pengelola hanya melihat status disetujui/lpj_diajukan/selesai atau miliknya sendiri).
     *
     * `GET /v1/kemahasiswaan/kegiatan`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ormawa_id?: string, pengaju_nim?: string, tingkat?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/kegiatan', [], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju_nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak/disetujui.
     *
     * `POST /v1/kemahasiswaan/kegiatan`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{ormawa_id: int, pengaju_nim?: string, nama: string, jenis?: string, tingkat?: string, mulai?: string, selesai?: string, lokasi?: string, jumlah_peserta?: int, tujuan?: string, anggaran_diajukan?: float|int, anggaran_disetujui?: float|int, realisasi?: float|int, laporan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): detail
     *
     * Diajukan pengurus inti ormawa (pengaju_nim otomatis), disetujui pengelola atau pembina, lalu LPJ diajukan dan diterima. Selain pengelola melihat kegiatan yang sudah disetujui, kegiatan yang diajukannya, atau ormawa yang dibinanya. Semua pemilik token ber-scope kemahasiswaan:read (selain pengelola hanya melihat status disetujui/lpj_diajukan/selesai atau miliknya sendiri).
     *
     * `GET /v1/kemahasiswaan/kegiatan/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju_nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak/disetujui. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/kegiatan/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{ormawa_id: int, pengaju_nim?: string, nama: string, jenis?: string, tingkat?: string, mulai?: string, selesai?: string, lokasi?: string, jumlah_peserta?: int, tujuan?: string, anggaran_diajukan?: float|int, anggaran_disetujui?: float|int, realisasi?: float|int, laporan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju_nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak/disetujui.
     *
     * `DELETE /v1/kemahasiswaan/kegiatan/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kemahasiswaan/kegiatan/{id}/berkas`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/kegiatan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (pengaju_nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak/disetujui.
     *
     * `POST /v1/kemahasiswaan/kegiatan/{id}/berkas`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): unduh lampiran
     *
     * `GET /v1/kemahasiswaan/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju_nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak/disetujui.
     *
     * `DELETE /v1/kemahasiswaan/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): Ajukan proposal
     *
     * Pemilik data. Status harus draf/ditolak, menjadi diajukan.
     *
     * `POST /v1/kemahasiswaan/kegiatan/{id}/ajukan`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): Setujui proposal
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/kemahasiswaan/kegiatan/{id}/setujui`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{anggaran_disetujui?: float|int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): Tolak proposal
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/kemahasiswaan/kegiatan/{id}/tolak`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): Ajukan LPJ
     *
     * Pemilik data. Status harus disetujui, menjadi lpj_diajukan.
     *
     * `POST /v1/kemahasiswaan/kegiatan/{id}/ajukan-lpj`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdAjukanLpj(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan/{id}/ajukan-lpj', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): Terima LPJ
     *
     * Pengelola modul. Status harus lpj_diajukan, menjadi selesai.
     *
     * `POST /v1/kemahasiswaan/kegiatan/{id}/terima-lpj`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdTerimaLpj(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan/{id}/terima-lpj', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan ormawa (proposal dan LPJ): Kembalikan LPJ
     *
     * Pengelola modul. Status harus lpj_diajukan, menjadi disetujui.
     *
     * `POST /v1/kemahasiswaan/kegiatan/{id}/kembalikan-lpj`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdKembalikanLpj(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/kegiatan/{id}/kembalikan-lpj', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: daftar
     *
     * Dilaporkan mahasiswa (lampirkan sertifikat/bukti), diverifikasi pengelola. Prestasi terverifikasi terlihat semua pengguna. Semua pemilik token ber-scope kemahasiswaan:read (selain pengelola hanya melihat status diverifikasi atau miliknya sendiri).
     *
     * `GET /v1/kemahasiswaan/prestasi`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, tingkat?: string, kategori?: string, jenis?: string, tahun_id?: string, pembimbing_nidn?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/prestasi', [], $query, null, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kemahasiswaan/prestasi`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{nim: string, nama_kegiatan: string, penyelenggara?: string, tingkat: string, kategori?: string, bidang?: string, jenis?: string, peringkat: string, tanggal?: string, tahun_id?: string, url?: string, pembimbing_nidn?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/prestasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: detail
     *
     * Dilaporkan mahasiswa (lampirkan sertifikat/bukti), diverifikasi pengelola. Prestasi terverifikasi terlihat semua pengguna. Semua pemilik token ber-scope kemahasiswaan:read (selain pengelola hanya melihat status diverifikasi atau miliknya sendiri).
     *
     * `GET /v1/kemahasiswaan/prestasi/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/prestasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/prestasi/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, nama_kegiatan: string, penyelenggara?: string, tingkat: string, kategori?: string, bidang?: string, jenis?: string, peringkat: string, tanggal?: string, tahun_id?: string, url?: string, pembimbing_nidn?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPrestasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/prestasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kemahasiswaan/prestasi/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePrestasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/prestasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kemahasiswaan/prestasi/{id}/berkas`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasiByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/prestasi/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kemahasiswaan/prestasi/{id}/berkas`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasiByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/prestasi/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Prestasi mahasiswa: unduh lampiran
     *
     * `GET /v1/kemahasiswaan/prestasi/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/prestasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kemahasiswaan/prestasi/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePrestasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/prestasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: Verifikasi
     *
     * Pengelola modul. Status harus diajukan, menjadi diverifikasi.
     *
     * `POST /v1/kemahasiswaan/prestasi/{id}/verifikasi`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasiByIdVerifikasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/prestasi/{id}/verifikasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi mahasiswa: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/kemahasiswaan/prestasi/{id}/tolak`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/prestasi/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konseling: daftar
     *
     * Mahasiswa mengajukan konseling; pengelola menugaskan konselor (username). catatan_konselor hanya terlihat oleh konselor yang ditugaskan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/konseling`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, konselor?: string, jenis?: string, media?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKonseling(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/konseling', [], $query, null, $options, false, false);
    }

    /**
     * Konseling: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/kemahasiswaan/konseling`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{nim: string, konselor?: string, jenis?: string, topik: string, uraian?: string, jadwal?: string, media?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonseling(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/konseling', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konseling: detail
     *
     * Mahasiswa mengajukan konseling; pengelola menugaskan konselor (username). catatan_konselor hanya terlihat oleh konselor yang ditugaskan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/konseling/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKonselingById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/konseling/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konseling: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/konseling/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, konselor?: string, jenis?: string, topik: string, uraian?: string, jadwal?: string, media?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKonselingById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/konseling/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konseling: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/kemahasiswaan/konseling/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKonselingById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/konseling/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konseling: Jadwalkan
     *
     * Pengelola modul. Status harus diajukan/dijadwalkan, menjadi dijadwalkan.
     *
     * `POST /v1/kemahasiswaan/konseling/{id}/jadwalkan`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{konselor: string, jadwal: string, media?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonselingByIdJadwalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/konseling/{id}/jadwalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konseling: Selesai
     *
     * Pengelola modul. Status harus dijadwalkan, menjadi selesai.
     *
     * `POST /v1/kemahasiswaan/konseling/{id}/selesai`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan_konselor?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonselingByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/konseling/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konseling: Batalkan
     *
     * Pemilik data atau pengelola. Status harus diajukan/dijadwalkan, menjadi dibatalkan.
     *
     * `POST /v1/kemahasiswaan/konseling/{id}/batalkan`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonselingByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/konseling/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: daftar
     *
     * Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/pelanggaran`
     *
     * scope: `kemahasiswaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, tingkat?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPelanggaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pelanggaran', [], $query, null, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kemahasiswaan/pelanggaran`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array{nim: string, tanggal: string, jenis: string, tingkat?: string, uraian?: string, sanksi?: string, sanksi_mulai?: string, sanksi_selesai?: string, nomor_sk?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPelanggaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pelanggaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: detail
     *
     * Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kemahasiswaan/pelanggaran/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPelanggaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pelanggaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kemahasiswaan/pelanggaran/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, tanggal: string, jenis: string, tingkat?: string, uraian?: string, sanksi?: string, sanksi_mulai?: string, sanksi_selesai?: string, nomor_sk?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPelanggaranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kemahasiswaan/pelanggaran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kemahasiswaan/pelanggaran/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePelanggaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/pelanggaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kemahasiswaan/pelanggaran/{id}/berkas`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPelanggaranByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pelanggaran/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/kemahasiswaan/pelanggaran/{id}/berkas`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPelanggaranByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kemahasiswaan/pelanggaran/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pelanggaran dan sanksi: unduh lampiran
     *
     * `GET /v1/kemahasiswaan/pelanggaran/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPelanggaranByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kemahasiswaan/pelanggaran/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pelanggaran dan sanksi: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kemahasiswaan/pelanggaran/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePelanggaranByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kemahasiswaan/pelanggaran/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }
}
