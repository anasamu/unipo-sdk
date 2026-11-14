<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kerja sama: Laporan, Kerja sama: Mitra, Kerja sama: Dokumen, Kerja sama: Kegiatan, Kerja sama: Evaluasi
 */
final class Kerjasama extends Resource
{
    /**
     * Rekap untuk akreditasi
     *
     * Jumlah dokumen aktif/berakhir per bidang (pendidikan, penelitian, PkM) dan tingkat (internasional, nasional, lokal) yang berlaku dalam rentang tahun, beserta daftar dokumen, jumlah kegiatan, dan manfaat. Bahan tabel kerja sama LKPS.
     *
     * `GET /v1/kerjasama/rekap`
     *
     * scope: `kerjasama:read`
     *
     * @param array{kode_prodi?: string, unit_id?: string, tahun_awal?: int, tahun_akhir?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen yang akan berakhir
     *
     * Dokumen aktif yang berakhir dalam `hari` ke depan (bawaan 90).
     *
     * `GET /v1/kerjasama/akan-berakhir`
     *
     * scope: `kerjasama:read`
     *
     * @param array{hari?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkanBerakhir(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/akan-berakhir', [], $query, null, $options, false, false);
    }

    /**
     * Mitra: daftar
     *
     * Mitra kerja sama, juga dipakai modul MBKM dan karier. Kontak mitra hanya terlihat oleh pengelola. Semua pemilik token ber-scope kerjasama:read.
     *
     * `GET /v1/kerjasama/mitra`
     *
     * scope: `kerjasama:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, lingkup?: string, aktif?: string, negara?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitra(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/mitra', [], $query, null, $options, false, false);
    }

    /**
     * Mitra: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kerjasama/mitra`
     *
     * scope: `kerjasama:write`
     *
     * @param array{nama: string, singkatan?: string, jenis?: string, lingkup?: string, negara?: string, kota?: string, alamat?: string, situs?: string, email?: string, telepon?: string, bidang_usaha?: string, kontak_nama?: string, kontak_jabatan?: string, kontak_email?: string, kontak_hp?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMitra(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/mitra', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mitra: detail
     *
     * Mitra kerja sama, juga dipakai modul MBKM dan karier. Kontak mitra hanya terlihat oleh pengelola. Semua pemilik token ber-scope kerjasama:read.
     *
     * `GET /v1/kerjasama/mitra/{id}`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mitra: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kerjasama/mitra/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nama: string, singkatan?: string, jenis?: string, lingkup?: string, negara?: string, kota?: string, alamat?: string, situs?: string, email?: string, telepon?: string, bidang_usaha?: string, kontak_nama?: string, kontak_jabatan?: string, kontak_email?: string, kontak_hp?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMitraById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kerjasama/mitra/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mitra: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kerjasama/mitra/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kerjasama/mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mitra: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kerjasama/mitra/{id}/berkas`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitraByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/mitra/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mitra: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/kerjasama/mitra/{id}/berkas`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMitraByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/mitra/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Mitra: unduh lampiran
     *
     * `GET /v1/kerjasama/mitra/{id}/berkas/{uuid}`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitraByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/mitra/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Mitra: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kerjasama/mitra/{id}/berkas/{uuid}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMitraByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kerjasama/mitra/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: daftar
     *
     * MoU, MoA/PKS, dan IA. Kolom `berlaku` dan `sisa_hari` dihitung dari tanggal selesai. Status aktif hanya lewat aksi setujui; berakhir otomatis terlihat dari `berlaku=false`. Semua pemilik token ber-scope kerjasama:read (selain pengelola hanya melihat status aktif/berakhir).
     *
     * `GET /v1/kerjasama/dokumen`
     *
     * scope: `kerjasama:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, induk_id?: string, jenis?: string, mitra_id?: string, unit_id?: string, kode_prodi?: string, tingkat?: string, bidang_pendidikan?: string, bidang_penelitian?: string, bidang_pkm?: string, bidang_lain?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kerjasama/dokumen`
     *
     * scope: `kerjasama:write`
     *
     * @param array{induk_id?: int, jenis: string, nomor?: string, nomor_mitra?: string, judul: string, mitra_id: int, unit_id?: int, kode_prodi?: string, tingkat?: string, bidang_pendidikan?: bool, bidang_penelitian?: bool, bidang_pkm?: bool, bidang_lain?: bool, ruang_lingkup?: string, tanggal_ttd?: string, mulai?: string, selesai?: string, nilai?: float|int, sumber_dana?: string, penandatangan?: string, penandatangan_mitra?: string, arsip_dokumen_id?: int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen kerja sama: detail
     *
     * MoU, MoA/PKS, dan IA. Kolom `berlaku` dan `sisa_hari` dihitung dari tanggal selesai. Status aktif hanya lewat aksi setujui; berakhir otomatis terlihat dari `berlaku=false`. Semua pemilik token ber-scope kerjasama:read (selain pengelola hanya melihat status aktif/berakhir).
     *
     * `GET /v1/kerjasama/dokumen/{id}`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kerjasama/dokumen/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{induk_id?: int, jenis: string, nomor?: string, nomor_mitra?: string, judul: string, mitra_id: int, unit_id?: int, kode_prodi?: string, tingkat?: string, bidang_pendidikan?: bool, bidang_penelitian?: bool, bidang_pkm?: bool, bidang_lain?: bool, ruang_lingkup?: string, tanggal_ttd?: string, mulai?: string, selesai?: string, nilai?: float|int, sumber_dana?: string, penandatangan?: string, penandatangan_mitra?: string, arsip_dokumen_id?: int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kerjasama/dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen kerja sama: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kerjasama/dokumen/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kerjasama/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kerjasama/dokumen/{id}/berkas`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/dokumen/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kerjasama/dokumen/{id}/berkas`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/dokumen/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Dokumen kerja sama: unduh lampiran
     *
     * `GET /v1/kerjasama/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `kerjasama:read`
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
        return $this->send('GET', '/v1/kerjasama/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kerjasama/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `kerjasama:write`
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
        return $this->send('DELETE', '/v1/kerjasama/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: Ajukan
     *
     * Pengelola modul. Status harus draf, menjadi diajukan.
     *
     * `POST /v1/kerjasama/dokumen/{id}/ajukan`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/dokumen/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: Setujui/aktifkan
     *
     * Menandai dokumen sudah ditandatangani dan berlaku. Nomor dan tanggal mulai wajib sudah terisi. Admin modul. Status harus draf/diajukan, menjadi aktif.
     *
     * `POST /v1/kerjasama/dokumen/{id}/setujui`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/dokumen/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kerja sama: Akhiri
     *
     * Pengelola modul. Status harus aktif, menjadi berakhir.
     *
     * `POST /v1/kerjasama/dokumen/{id}/akhiri`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tanggal?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdAkhiri(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/dokumen/{id}/akhiri', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen kerja sama: Batalkan
     *
     * Pengelola modul. Status harus draf/diajukan/aktif, menjadi dibatalkan.
     *
     * `POST /v1/kerjasama/dokumen/{id}/batalkan`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdBatalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/dokumen/{id}/batalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pihak tambahan dokumen: daftar
     *
     * Semua pemilik token ber-scope kerjasama:read.
     *
     * `GET /v1/kerjasama/dokumen-mitra`
     *
     * scope: `kerjasama:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, dokumen_id?: string, mitra_id?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenMitra(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/dokumen-mitra', [], $query, null, $options, false, false);
    }

    /**
     * Pihak tambahan dokumen: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kerjasama/dokumen-mitra`
     *
     * scope: `kerjasama:write`
     *
     * @param array{dokumen_id: int, mitra_id: int, peran?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenMitra(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/dokumen-mitra', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pihak tambahan dokumen: detail
     *
     * Semua pemilik token ber-scope kerjasama:read.
     *
     * `GET /v1/kerjasama/dokumen-mitra/{id}`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/dokumen-mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pihak tambahan dokumen: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kerjasama/dokumen-mitra/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{dokumen_id: int, mitra_id: int, peran?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDokumenMitraById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kerjasama/dokumen-mitra/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pihak tambahan dokumen: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kerjasama/dokumen-mitra/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kerjasama/dokumen-mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: daftar
     *
     * Bukti pelaksanaan dan manfaat kerja sama (bahan tabel kerja sama akreditasi). Lampirkan bukti lewat /berkas. Semua pemilik token ber-scope kerjasama:read.
     *
     * `GET /v1/kerjasama/kegiatan`
     *
     * scope: `kerjasama:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, dokumen_id?: string, bidang?: string, unit_id?: string, kode_prodi?: string, tahun_id?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/kegiatan', [], $query, null, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kerjasama/kegiatan`
     *
     * scope: `kerjasama:write`
     *
     * @param array{dokumen_id: int, judul: string, bidang: string, bentuk?: string, unit_id?: int, kode_prodi?: string, tahun_id?: string, mulai?: string, selesai?: string, lokasi?: string, jumlah_mahasiswa?: int, jumlah_dosen?: int, manfaat?: string, luaran?: string, nilai?: float|int, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/kegiatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: detail
     *
     * Bukti pelaksanaan dan manfaat kerja sama (bahan tabel kerja sama akreditasi). Lampirkan bukti lewat /berkas. Semua pemilik token ber-scope kerjasama:read.
     *
     * `GET /v1/kerjasama/kegiatan/{id}`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kerjasama/kegiatan/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{dokumen_id: int, judul: string, bidang: string, bentuk?: string, unit_id?: int, kode_prodi?: string, tahun_id?: string, mulai?: string, selesai?: string, lokasi?: string, jumlah_mahasiswa?: int, jumlah_dosen?: int, manfaat?: string, luaran?: string, nilai?: float|int, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kerjasama/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kerjasama/kegiatan/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kerjasama/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kerjasama/kegiatan/{id}/berkas`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/kegiatan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kerjasama/kegiatan/{id}/berkas`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/kegiatan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Kegiatan pelaksanaan: unduh lampiran
     *
     * `GET /v1/kerjasama/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kerjasama:read`
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
        return $this->send('GET', '/v1/kerjasama/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Kegiatan pelaksanaan: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kerjasama/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kerjasama:write`
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
        return $this->send('DELETE', '/v1/kerjasama/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Evaluasi kerja sama: daftar
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/kerjasama/evaluasi`
     *
     * scope: `kerjasama:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, dokumen_id?: string, rekomendasi?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEvaluasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/evaluasi', [], $query, null, $options, false, false);
    }

    /**
     * Evaluasi kerja sama: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kerjasama/evaluasi`
     *
     * scope: `kerjasama:write`
     *
     * @param array{dokumen_id: int, tanggal: string, skor?: int, rekomendasi?: string, catatan?: string, evaluator?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEvaluasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kerjasama/evaluasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Evaluasi kerja sama: detail
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/kerjasama/evaluasi/{id}`
     *
     * scope: `kerjasama:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEvaluasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kerjasama/evaluasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Evaluasi kerja sama: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kerjasama/evaluasi/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{dokumen_id: int, tanggal: string, skor?: int, rekomendasi?: string, catatan?: string, evaluator?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putEvaluasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kerjasama/evaluasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Evaluasi kerja sama: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kerjasama/evaluasi/{id}`
     *
     * scope: `kerjasama:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteEvaluasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kerjasama/evaluasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }
}
