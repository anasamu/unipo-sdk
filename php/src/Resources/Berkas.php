<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Berkas, Berkas: Unggah bertahap, Berkas: Folder
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
     * Token pengguna: berkas milik pengguna itu. Token aplikasi: berkas yang diunggah aplikasi itu. berkas:admin: semua (filter `pemilik`, `klien_id`), dan `?terhapus=1` untuk sampah.
     *
     * `GET /v1/berkas`
     *
     * scope: `berkas:read` · berhalaman
     *
     * @param array{kategori?: string, modul?: string, status?: string, folder?: string, dalam?: string, jenis?: string, ekstensi?: string, urut?: string, q?: string, pemilik?: string, klien_id?: string, terhapus?: string, page?: int, per_page?: int, ...} $query
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
     * Daftar folder saya
     *
     * Semua folder pemanggil (pohon datar: `path`, `induk`, `nama`) dengan jumlah dan ukuran isi langsung maupun total termasuk subfolder, plus ringkasan `akar`. Folder berasal dari kolom `folder` berkas dan folder kosong yang dibuat lewat POST /v1/berkas/folder. Isi folder: GET /v1/berkas?folder=path (atau `folder=/` untuk akar, `dalam=path` termasuk subfolder).
     *
     * `GET /v1/berkas/folder`
     *
     * scope: `berkas:read`
     *
     * @param array{modul?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFolder(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/folder', [], $query, null, $options, false, false);
    }

    /**
     * Buat folder
     *
     * Body: `nama`, opsional `induk` (path folder induk; kosong = akar), `warna`, `modul`. Nama boleh berisi spasi dan huruf apa pun (mis. "Surat Masuk 2026"). 409 folder_sudah_ada.
     *
     * `POST /v1/berkas/folder`
     *
     * scope: `berkas:write`
     *
     * @param array{nama: string|null, induk?: string|null, warna?: string|null, modul?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolder(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ganti nama, pindah, atau ganti warna folder
     *
     * Body: `path` (folder yang diubah), opsional `nama` (nama baru), `induk_baru` (null = akar), `warna`, `modul`. Subfolder dan berkas di dalamnya ikut; isi file di penyimpanan tidak dipindah.
     *
     * `POST /v1/berkas/folder/ubah`
     *
     * scope: `berkas:write`
     *
     * @param array{path: string|null, nama?: string|null, induk_baru?: string|null, warna?: string|null, modul?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolderUbah(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder/ubah', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus folder
     *
     * Body: `path`, opsional `isi` (true = berkas di dalamnya ikut pindah ke sampah), `modul`. Folder berisi tanpa `isi` ditolak 409 folder_berisi; berkas yang masih dipakai data modul membatalkan seluruhnya (409 berkas_dipakai). Hapus permanen tetap hanya admin.
     *
     * `POST /v1/berkas/folder/hapus`
     *
     * scope: `berkas:write`
     *
     * @param array{path: string|null, isi?: bool, modul?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolderHapus(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder/hapus', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pindahkan banyak berkas
     *
     * Body: `id` (1-100 UUID), `folder` (path tujuan; null/"" = akar). Hasil: `dipindah` dan `gagal` per berkas.
     *
     * `POST /v1/berkas/pindah`
     *
     * scope: `berkas:write`
     *
     * @param array{id: list<mixed>, folder: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPindah(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/pindah', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus banyak berkas
     *
     * Body: `id` (1-100 UUID). Soft delete seperti /v1/berkas/{id}/hapus; berkas yang masih dipakai dilaporkan di `gagal`.
     *
     * `POST /v1/berkas/hapus-banyak`
     *
     * scope: `berkas:write`
     *
     * @param array{id: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHapusBanyak(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/hapus-banyak', [], $options['query'] ?? [], $body, $options, false, false);
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
     * Sama dengan POST /v1/berkas/{id}/hapus (soft delete).
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
     * Ubah nama/kategori/keterangan/folder
     *
     * Body: `nama` (ekstensi tetap), `kategori`, `keterangan`, `folder` (pindah; null/"" = akar). Isi file tidak bisa diganti; unggah berkas baru.
     *
     * `POST /v1/berkas/{id}/ubah`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{nama?: string|null, kategori?: string|null, keterangan?: string|null, folder?: string|null, ...} $body
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
     * Soft delete: berkas pindah ke sampah dan tidak tampil lagi, isinya tetap di penyimpanan. Hapus permanen hanya admin lewat /hapus-permanen. Ditolak (409 berkas_dipakai) bila masih dipakai data modul; berkas:admin bisa `?paksa=1`.
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
     * Pulihkan dari sampah (admin)
     *
     * Mengembalikan berkas yang dihapus pengguna atau yang lampirannya dihapus.
     *
     * `POST /v1/berkas/{id}/pulihkan`
     *
     * scope: `berkas:admin`
     *
     * @param int|string $id UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPulihkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/pulihkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus permanen (admin)
     *
     * Isi file ikut dihapus dari penyimpanan (S3/R2/MinIO/Google Drive/disk) dan tidak bisa dipulihkan. Berlaku untuk berkas di sampah maupun yang aktif (`?paksa=1` bila masih dipakai).
     *
     * `POST /v1/berkas/{id}/hapus-permanen`
     *
     * scope: `berkas:admin`
     *
     * @param int|string $id UUID berkas
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapusPermanen(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/hapus-permanen', ['id' => $id], $query, null, $options, false, false);
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
