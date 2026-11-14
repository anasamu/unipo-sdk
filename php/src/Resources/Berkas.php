<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Berkas, Berkas: Unggah bertahap
 */
final class Berkas extends Resource
{
    /**
     * Batas dan penyimpanan aktif
     *
     * Ukuran maksimal, batas sekali unggah dari php.ini server, ukuran potongan unggah bertahap, ekstensi yang diizinkan, dan penyimpanan tujuan (lokal/S3/R2/MinIO/Google Drive). Dipakai aplikasi untuk memilih cara unggah.
     *
     * `GET /v1/berkas/info`
     *
     * scope: `berkas:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfo(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/info', [], $query, null, $options, false, false);
    }

    /**
     * Daftar berkas saya
     *
     * Token pengguna: berkas milik pengguna itu. Token aplikasi: berkas yang diunggah aplikasi itu. berkas:admin: semua (filter `pemilik`, `klien_id`).
     *
     * `GET /v1/berkas`
     *
     * scope: `berkas:read` · berhalaman
     *
     * @param array{kategori?: string, modul?: string, status?: string, folder?: string, q?: string, pemilik?: string, klien_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas', [], $query, null, $options, false, false);
    }

    /**
     * Unggah berkas
     *
     * multipart/form-data field `berkas` (atau JSON `berkas_base64` + `nama_file` untuk file kecil). Atribut opsional: `kategori` (dokumen, foto, lampiran, tugas, …), `modul` (aplikasi/modul pemakai), `folder`, `keterangan`, `visibilitas` (privat/publik), `penyimpanan` (kode penyedia; bawaan penyimpanan utama). Jenis file diperiksa dari isinya. File di atas `batas_sekali_unggah_byte` (lihat /info) pakai unggah bertahap.
     *
     * `POST /v1/berkas`
     *
     * scope: `berkas:write`
     *
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, berkas_base64?: string|null, nama_file?: string|null, kategori?: string|null, modul?: string|null, folder?: string|null, keterangan?: string|null, visibilitas?: string|null, penyimpanan?: string|null, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Mulai unggah bertahap
     *
     * Untuk file besar atau hosting dengan upload_max_filesize kecil. Body JSON: `nama`, `ukuran` (byte), opsional `ukuran_potongan` (bawaan dari /info). Atribut opsional: `kategori` (dokumen, foto, lampiran, tugas, …), `modul` (aplikasi/modul pemakai), `folder`, `keterangan`, `visibilitas` (privat/publik), `penyimpanan` (kode penyedia; bawaan penyimpanan utama). Lalu kirim setiap potongan ke POST /v1/berkas/{id}/potongan/{ke} (boleh paralel, boleh diulang), dan akhiri dengan POST /v1/berkas/{id}/selesai. Sesi yang tidak selesai dihapus setelah BERKAS_SESI_JAM.
     *
     * `POST /v1/berkas/bertahap`
     *
     * scope: `berkas:write`
     *
     * @param array{nama: string|null, ukuran: int|null, ukuran_potongan?: int|null, kategori?: string|null, modul?: string|null, folder?: string|null, keterangan?: string|null, visibilitas?: string|null, penyimpanan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBertahap(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/bertahap', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Minta URL unggah langsung ke bucket
     *
     * Khusus penyimpanan S3/R2/MinIO: body `nama`, `ukuran` (byte), `mime`. Kirim isi file dengan PUT ke `unggah.url` beserta `unggah.header` langsung dari browser/aplikasi (tidak lewat server SIAKAD), lalu POST /v1/berkas/{id}/selesai; SIAKAD memeriksa isinya sebelum berkas tersedia.
     *
     * `POST /v1/berkas/unggah-langsung`
     *
     * scope: `berkas:write`
     *
     * @param array{nama: string|null, ukuran: int|null, mime: string|null, kategori?: string|null, modul?: string|null, folder?: string|null, keterangan?: string|null, visibilitas?: string|null, penyimpanan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnggahLangsung(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/unggah-langsung', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unduh dengan tautan sementara
     *
     * Tautan dari /v1/berkas/{id}/url (tanpa token akses; berlaku sampai waktu di dalamnya). PDF/gambar tampil di browser; `?unduh=1` memaksa unduh.
     *
     * `GET /v1/berkas/unduh/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnduhByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/unduh/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Detail berkas
     *
     * Termasuk `url` sementara, status sesi unggah bertahap (`sesi.diterima` untuk melanjutkan unggahan yang terputus), dan `dipakai` (data modul yang memakai berkas ini).
     *
     * `GET /v1/berkas/{id}`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus berkas
     *
     * Sama dengan POST /v1/berkas/{id}/hapus.
     *
     * `DELETE /v1/berkas/{id}`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh isi berkas
     *
     * Respons file (bukan JSON). Disk lokal/Google Drive: dialirkan dari server. S3/R2/MinIO: 302 ke URL sementara bucket, kecuali `?lewat_server=1`. PDF/gambar/video tampil inline; `?unduh=1` memaksa unduh.
     *
     * `GET /v1/berkas/{id}/unduh`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID berkas
     * @param array{unduh?: string, lewat_server?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdUnduh(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/{id}/unduh', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tautan unduh sementara
     *
     * Untuk <img>, <a>, atau pratinjau PDF tanpa header Authorization. Presigned URL (S3/R2/MinIO) atau tautan bertanda tangan SIAKAD.
     *
     * `GET /v1/berkas/{id}/url`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID berkas
     * @param array{ttl?: string, unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdUrl(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/{id}/url', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah nama/kategori/keterangan
     *
     * Body: `nama` (ekstensi tetap), `kategori`, `keterangan`. Isi file tidak bisa diganti; unggah berkas baru.
     *
     * `POST /v1/berkas/{id}/ubah`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{nama?: string|null, kategori?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus berkas (POST)
     *
     * Ditolak (409 berkas_dipakai) bila masih dipakai data modul; berkas:admin bisa `?paksa=1`.
     *
     * `POST /v1/berkas/{id}/hapus`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim satu potongan
     *
     * multipart/form-data field `potongan` berisi bagian file dari byte ke×ukuran_potongan. Semua potongan berukuran `ukuran_potongan` kecuali yang terakhir. Mengirim ulang nomor yang sama menimpa potongan itu.
     *
     * `POST /v1/berkas/{id}/potongan/{ke}`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param int|string $ke Nomor potongan, mulai 0
     * @param array{potongan: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPotonganByKe(int|string $id, int|string $ke, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/potongan/{ke}', ['id' => $id, 'ke' => $ke], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Selesaikan unggahan
     *
     * Unggah bertahap: gabungkan potongan, periksa isi, simpan ke penyimpanan (409 potongan_kurang memuat nomor yang belum ada). Unggah langsung: periksa berkas di bucket.
     *
     * `POST /v1/berkas/{id}/selesai`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat pemakaian berkas
     *
     * Untuk aplikasi yang menyimpan UUID berkas di datanya sendiri: body `modul`, `tabel`, `baris` (ID/UUID), opsional `peran`. Berkas yang dipakai tidak bisa dihapus sampai dilepas.
     *
     * `POST /v1/berkas/{id}/pakai`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{modul?: string|null, tabel: string|null, baris: string|null, peran?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPakai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/pakai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas pemakaian berkas
     *
     * Body `tabel`, `baris`.
     *
     * `POST /v1/berkas/{id}/lepas`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{modul?: string|null, tabel: string|null, baris: string|null, peran?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdLepas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/lepas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
