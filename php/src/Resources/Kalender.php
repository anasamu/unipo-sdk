<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kalender: Terpadu, Kalender: Hari kerja, Kalender: Kegiatan
 */
final class Kalender extends Resource
{
    /**
     * Kalender terpadu
     *
     * Gabungan kegiatan kalender yang terbit (sesuai level pengguna), tahapan tahun akademik di `m_tahun`, batas waktu per prodi di `m_bataskrs*`/`m_batas_*`, agenda portal yang terbit, dan jadwal PMB. Tabel lama hanya dibaca. Bawaan rentang: 30 hari lalu s.d. 180 hari ke depan, maksimal 400 hari.
     *
     * `GET /v1/kalender/terpadu`
     *
     * scope: `kalender:read`
     *
     * @param array{dari?: string, sampai?: string, kode_prodi?: string, tahun_id?: string, sumber?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerpadu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/terpadu', [], $query, null, $options, false, false);
    }

    /**
     * Langganan iCalendar (publik)
     *
     * File .ics tanpa token untuk Google Calendar/Outlook/ponsel. Berisi kegiatan terbit yang untuk semua, tahapan tahun akademik, agenda portal, dan PMB (batas per prodi tidak ikut). Bawaan rentang: 60 hari lalu s.d. 1 tahun ke depan.
     *
     * `GET /v1/kalender/ics`
     *
     * publik (tanpa token)
     *
     * @param array{dari?: string, sampai?: string, kode_prodi?: string, tahun_id?: string, sumber?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIcs(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/ics', [], $query, null, $options, false, true);
    }

    /**
     * Tahun akademik
     *
     * Tahun akademik terbaru dari `m_tahun` (hanya baca) beserta tahapannya.
     *
     * `GET /v1/kalender/tahun`
     *
     * scope: `kalender:read`
     *
     * @param array{batas?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTahun(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/tahun', [], $query, null, $options, false, false);
    }

    /**
     * Hitung hari kerja
     *
     * Jumlah hari kerja dalam rentang (Senin-Jumat, atau Senin-Sabtu bila `sabtu=1`), dikurangi kegiatan terbit yang libur.
     *
     * `GET /v1/kalender/hari-kerja`
     *
     * scope: `kalender:read`
     *
     * @param array{dari?: string, sampai?: string, kode_prodi?: string, sabtu?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHariKerja(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/hari-kerja', [], $query, null, $options, false, false);
    }

    /**
     * Tanggal setelah N hari kerja
     *
     * Untuk menghitung tenggat (mis. SLA layanan) dengan melompati akhir pekan dan libur.
     *
     * `GET /v1/kalender/tambah-hari-kerja`
     *
     * scope: `kalender:read`
     *
     * @param array{dari?: string, hari?: int, kode_prodi?: string, sabtu?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTambahHariKerja(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/tambah-hari-kerja', [], $query, null, $options, false, false);
    }

    /**
     * Kegiatan kalender: daftar
     *
     * Kegiatan kalender akademik, libur, dan cuti bersama. Yang berstatus `terbit` bisa dibaca semua orang (juga tanpa token) sesuai `untuk` (level pengguna, dipisah koma; kosong = semua). `libur = true` membuat tanggalnya tidak dihitung sebagai hari kerja. Semua pemilik token ber-scope kalender:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/kalender/kegiatan`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, libur?: string, tahun_id?: string, unit_id?: string, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan', [], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kalender/kegiatan`
     *
     * scope: `kalender:write`
     *
     * @param array{judul: string, jenis?: string, keterangan?: string, mulai: string, selesai?: string, jam_mulai?: string, jam_selesai?: string, libur?: bool, tahun_id?: string, unit_id?: int, kode_prodi?: string, untuk?: string, lokasi?: string, tautan?: string, warna?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kegiatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan kalender: detail
     *
     * Kegiatan kalender akademik, libur, dan cuti bersama. Yang berstatus `terbit` bisa dibaca semua orang (juga tanpa token) sesuai `untuk` (level pengguna, dipisah koma; kosong = semua). `libur = true` membuat tanggalnya tidak dihitung sebagai hari kerja. Semua pemilik token ber-scope kalender:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/kalender/kegiatan/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kalender/kegiatan/{id}`
     *
     * scope: `kalender:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, jenis?: string, keterangan?: string, mulai: string, selesai?: string, jam_mulai?: string, jam_selesai?: string, libur?: bool, tahun_id?: string, unit_id?: int, kode_prodi?: string, untuk?: string, lokasi?: string, tautan?: string, warna?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kalender/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan kalender: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kalender/kegiatan/{id}`
     *
     * scope: `kalender:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kalender/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan kalender: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kalender/kegiatan/{id}/berkas`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan/{id}/berkas', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kalender/kegiatan/{id}/berkas`
     *
     * scope: `kalender:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kegiatan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Kegiatan kalender: unduh lampiran
     *
     * `GET /v1/kalender/kegiatan/{id}/berkas/{uuid}`
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
    public function getKegiatanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kalender/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kalender:write`
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
        return $this->send('DELETE', '/v1/kalender/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }
}
