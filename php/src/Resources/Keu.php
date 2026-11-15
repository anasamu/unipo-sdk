<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Keuangan: Laporan, Keuangan: Virtual account, Keuangan: Master, Keuangan: Anggaran, Keuangan: Realisasi, Keuangan: Penerimaan
 */
final class Keu extends Resource
{
    /**
     * Serapan anggaran
     *
     * Anggaran RKA yang disetujui dibandingkan realisasi (disetujui, dibayar, selesai/SPJ), per unit dan per akun, plus yang masih diproses dan penerimaan lain. Bawaan periode berjalan. Pengelola, dibatasi unitnya.
     *
     * `GET /v1/keu/serapan`
     *
     * scope: `keu:read`
     *
     * @param array{periode_id?: int, unit_id?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSerapan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/serapan', [], $query, null, $options, false, false);
    }

    /**
     * Rekap pembayaran mahasiswa
     *
     * Tagihan dan pembayaran per prodi dari tabel lama (t_mahasiswa_bayar_tagihan, t_mahasiswa_bayar), hanya dibaca. Pengelola.
     *
     * `GET /v1/keu/pembayaran-mahasiswa`
     *
     * scope: `keu:read`
     *
     * @param array{tahun_id?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembayaranMahasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/pembayaran-mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Notifikasi pembayaran bank
     *
     * Dipanggil aplikasi penghubung bank/payment gateway (token aplikasi dengan keu:write). Body: bank, nomor_va, referensi_bank, jumlah, dibayar_pada (opsional), data (opsional, disimpan apa adanya). Idempoten per bank + referensi_bank. VA aktif ditandai dibayar dan mahasiswa mendapat notifikasi. Tidak menulis ke tabel pembayaran lama.
     *
     * `POST /v1/keu/va/notifikasi`
     *
     * scope: `keu:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVaNotifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/va/notifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Akun: daftar
     *
     * Bagan akun (pendapatan, belanja, aset, kewajiban, ekuitas), bertingkat lewat induk_id. Hanya pengelola modul.
     *
     * `GET /v1/keu/akun`
     *
     * scope: `keu:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, induk_id?: string, jenis?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkun(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/akun', [], $query, null, $options, false, false);
    }

    /**
     * Akun: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/keu/akun`
     *
     * scope: `keu:write`
     *
     * @param array{induk_id?: int, kode: string, nama: string, jenis: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkun(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/akun', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Akun: detail
     *
     * Bagan akun (pendapatan, belanja, aset, kewajiban, ekuitas), bertingkat lewat induk_id. Hanya pengelola modul.
     *
     * `GET /v1/keu/akun/{id}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkunById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/akun/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Akun: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keu/akun/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{induk_id?: int, kode: string, nama: string, jenis: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkunById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keu/akun/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Akun: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/keu/akun/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkunById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/akun/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode anggaran: daftar
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/keu/periode`
     *
     * scope: `keu:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/periode', [], $query, null, $options, false, false);
    }

    /**
     * Periode anggaran: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/keu/periode`
     *
     * scope: `keu:write`
     *
     * @param array{kode: string, nama: string, mulai: string, selesai: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode anggaran: detail
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/keu/periode/{id}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode anggaran: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keu/periode/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, mulai: string, selesai: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keu/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode anggaran: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/keu/periode/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * RKA unit: daftar
     *
     * Rencana kegiatan dan anggaran per unit per periode. Disusun pengelola unit (rincian di /keu/rka-item), diajukan, lalu disetujui/diminta revisi/ditolak admin keuangan. `total` dihitung dari rincian. Hanya pengelola modul.
     *
     * `GET /v1/keu/rka`
     *
     * scope: `keu:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, periode_id?: string, unit_id?: string, kode_prodi?: string, status?: string, disetujui_oleh?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRka(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/rka', [], $query, null, $options, false, false);
    }

    /**
     * RKA unit: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keu/rka`
     *
     * scope: `keu:write`
     *
     * @param array{periode_id: int, unit_id: int, kode_prodi?: string, judul: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRka(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/rka', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * RKA unit: detail
     *
     * Rencana kegiatan dan anggaran per unit per periode. Disusun pengelola unit (rincian di /keu/rka-item), diajukan, lalu disetujui/diminta revisi/ditolak admin keuangan. `total` dihitung dari rincian. Hanya pengelola modul.
     *
     * `GET /v1/keu/rka/{id}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRkaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/rka/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * RKA unit: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keu/rka/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{periode_id: int, unit_id: int, kode_prodi?: string, judul: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRkaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keu/rka/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * RKA unit: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keu/rka/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRkaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/rka/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * RKA unit: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/keu/rka/{id}/berkas`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRkaByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/rka/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * RKA unit: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keu/rka/{id}/berkas`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRkaByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/rka/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * RKA unit: unduh lampiran
     *
     * `GET /v1/keu/rka/{id}/berkas/{uuid}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRkaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/rka/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * RKA unit: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keu/rka/{id}/berkas/{uuid}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRkaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/rka/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * RKA unit: Ajukan
     *
     * Pengelola modul. Status harus draf/revisi, menjadi diajukan.
     *
     * `POST /v1/keu/rka/{id}/ajukan`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRkaByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/rka/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * RKA unit: Setujui
     *
     * Admin modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/keu/rka/{id}/setujui`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRkaByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/rka/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * RKA unit: Minta revisi
     *
     * Bisa juga untuk revisi anggaran yang sudah disetujui; revisi_ke bertambah. Admin modul. Status harus diajukan/disetujui, menjadi revisi.
     *
     * `POST /v1/keu/rka/{id}/minta-revisi`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRkaByIdMintaRevisi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/rka/{id}/minta-revisi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * RKA unit: Tolak
     *
     * Admin modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/keu/rka/{id}/tolak`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRkaByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/rka/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rincian RKA: daftar
     *
     * Rincian anggaran. `jumlah` = volume x harga_satuan. Hanya bisa diubah saat RKA draf/revisi. Hanya pengelola modul.
     *
     * `GET /v1/keu/rka-item`
     *
     * scope: `keu:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, rka_id?: string, unit_id?: string, akun_id?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRkaItem(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/rka-item', [], $query, null, $options, false, false);
    }

    /**
     * Rincian RKA: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keu/rka-item`
     *
     * scope: `keu:write`
     *
     * @param array{rka_id: int, akun_id?: int, kode?: string, kegiatan: string, uraian?: string, volume?: float|int, satuan?: string, harga_satuan: float|int, sumber_dana?: string, bulan?: int, indikator?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRkaItem(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/rka-item', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rincian RKA: detail
     *
     * Rincian anggaran. `jumlah` = volume x harga_satuan. Hanya bisa diubah saat RKA draf/revisi. Hanya pengelola modul.
     *
     * `GET /v1/keu/rka-item/{id}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRkaItemById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/rka-item/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rincian RKA: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keu/rka-item/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{rka_id: int, akun_id?: int, kode?: string, kegiatan: string, uraian?: string, volume?: float|int, satuan?: string, harga_satuan: float|int, sumber_dana?: string, bulan?: int, indikator?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRkaItemById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keu/rka-item/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rincian RKA: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keu/rka-item/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRkaItemById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/rka-item/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: daftar
     *
     * Pengajuan dana atas rincian RKA yang disetujui (dicek sisa anggaran). Alur: diajukan → verifikasi → setujui → bayar → spj (selesai); atau tolak/batalkan. Bukti/SPJ dilampirkan lewat /berkas. Pengaju mendapat notifikasi dan bisa melihat pengajuannya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengaju).
     *
     * `GET /v1/keu/realisasi`
     *
     * scope: `keu:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, rka_item_id?: string, unit_id?: string, pengaju?: string, jenis?: string, status?: string, diverifikasi_oleh?: string, disetujui_oleh?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRealisasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/realisasi', [], $query, null, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keu/realisasi`
     *
     * scope: `keu:write`
     *
     * @param array{rka_item_id: int, pengaju?: string, jenis?: string, tanggal: string, uraian: string, jumlah: float|int, penerima?: string, rekening_penerima?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: detail
     *
     * Pengajuan dana atas rincian RKA yang disetujui (dicek sisa anggaran). Alur: diajukan → verifikasi → setujui → bayar → spj (selesai); atau tolak/batalkan. Bukti/SPJ dilampirkan lewat /berkas. Pengaju mendapat notifikasi dan bisa melihat pengajuannya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengaju).
     *
     * `GET /v1/keu/realisasi/{id}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRealisasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/realisasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keu/realisasi/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{rka_item_id: int, pengaju?: string, jenis?: string, tanggal: string, uraian: string, jumlah: float|int, penerima?: string, rekening_penerima?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRealisasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keu/realisasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keu/realisasi/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRealisasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/realisasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/keu/realisasi/{id}/berkas`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRealisasiByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/realisasi/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keu/realisasi/{id}/berkas`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasiByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pengajuan dana/realisasi: unduh lampiran
     *
     * `GET /v1/keu/realisasi/{id}/berkas/{uuid}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRealisasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/realisasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keu/realisasi/{id}/berkas/{uuid}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRealisasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/realisasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: Verifikasi
     *
     * Admin modul. Status harus diajukan, menjadi diverifikasi.
     *
     * `POST /v1/keu/realisasi/{id}/verifikasi`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasiByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: Setujui
     *
     * Admin modul. Status harus diverifikasi, menjadi disetujui.
     *
     * `POST /v1/keu/realisasi/{id}/setujui`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasiByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: Catat pembayaran
     *
     * Admin modul. Status harus disetujui, menjadi dibayar.
     *
     * `POST /v1/keu/realisasi/{id}/bayar`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tanggal_bayar: string, nomor_bukti?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasiByIdBayar(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi/{id}/bayar', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: Pertanggungjawaban (SPJ)
     *
     * Lampirkan bukti SPJ lewat /berkas sebelum atau sesudahnya. Selisih uang muka (jumlah - jumlah_spj) kembali menjadi sisa anggaran. Pemilik data atau pengelola. Status harus dibayar, menjadi selesai.
     *
     * `POST /v1/keu/realisasi/{id}/spj`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{jumlah_spj: float|int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasiByIdSpj(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi/{id}/spj', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: Tolak
     *
     * Admin modul. Status harus diajukan/diverifikasi, menjadi ditolak.
     *
     * `POST /v1/keu/realisasi/{id}/tolak`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan dana/realisasi: Batalkan
     *
     * Pemilik data atau pengelola. Status harus diajukan, menjadi dibatalkan.
     *
     * `POST /v1/keu/realisasi/{id}/batalkan`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRealisasiByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/realisasi/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penerimaan lain: daftar
     *
     * Penerimaan selain pembayaran mahasiswa (hibah, kerja sama, sewa, donasi, jasa layanan, bunga bank). Bukti lewat /berkas. Hanya pengelola modul.
     *
     * `GET /v1/keu/penerimaan`
     *
     * scope: `keu:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, periode_id?: string, akun_id?: string, unit_id?: string, mitra_id?: string, sumber?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenerimaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/penerimaan', [], $query, null, $options, false, false);
    }

    /**
     * Penerimaan lain: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keu/penerimaan`
     *
     * scope: `keu:write`
     *
     * @param array{periode_id?: int, akun_id?: int, unit_id?: int, mitra_id?: int, tanggal: string, sumber?: string, uraian: string, jumlah: float|int, nomor_bukti?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenerimaan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/penerimaan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penerimaan lain: detail
     *
     * Penerimaan selain pembayaran mahasiswa (hibah, kerja sama, sewa, donasi, jasa layanan, bunga bank). Bukti lewat /berkas. Hanya pengelola modul.
     *
     * `GET /v1/keu/penerimaan/{id}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenerimaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/penerimaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penerimaan lain: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keu/penerimaan/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{periode_id?: int, akun_id?: int, unit_id?: int, mitra_id?: int, tanggal: string, sumber?: string, uraian: string, jumlah: float|int, nomor_bukti?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPenerimaanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keu/penerimaan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penerimaan lain: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keu/penerimaan/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePenerimaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/penerimaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penerimaan lain: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/keu/penerimaan/{id}/berkas`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenerimaanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/penerimaan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penerimaan lain: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keu/penerimaan/{id}/berkas`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenerimaanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/penerimaan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Penerimaan lain: unduh lampiran
     *
     * `GET /v1/keu/penerimaan/{id}/berkas/{uuid}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenerimaanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/penerimaan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Penerimaan lain: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keu/penerimaan/{id}/berkas/{uuid}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePenerimaanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keu/penerimaan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Virtual account: daftar
     *
     * Virtual account tagihan mahasiswa dan status pembayarannya dari bank. Notifikasi bank masuk lewat POST /keu/va/notifikasi. Modul ini tidak menulis ke tabel pembayaran lama; petugas membukukan lewat menu lama lalu menandai `tandai-dibukukan`. Mahasiswa melihat VA miliknya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keu/va`
     *
     * scope: `keu:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, tahun_id?: string, status?: string, sudah_dibukukan?: string, bank?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/va', [], $query, null, $options, false, false);
    }

    /**
     * Virtual account: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keu/va`
     *
     * scope: `keu:write`
     *
     * @param array{bank: string, nomor_va: string, nim: string, tahun_id?: string, kode_biaya?: string, keterangan?: string, jumlah: float|int, berlaku_sampai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/va', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Virtual account: detail
     *
     * Virtual account tagihan mahasiswa dan status pembayarannya dari bank. Notifikasi bank masuk lewat POST /keu/va/notifikasi. Modul ini tidak menulis ke tabel pembayaran lama; petugas membukukan lewat menu lama lalu menandai `tandai-dibukukan`. Mahasiswa melihat VA miliknya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keu/va/{id}`
     *
     * scope: `keu:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keu/va/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Virtual account: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keu/va/{id}`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{bank: string, nomor_va: string, nim: string, tahun_id?: string, kode_biaya?: string, keterangan?: string, jumlah: float|int, berlaku_sampai?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putVaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keu/va/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Virtual account: Batalkan
     *
     * Pengelola modul. Status harus aktif, menjadi batal.
     *
     * `POST /v1/keu/va/{id}/batalkan`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVaByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/va/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Virtual account: Tandai sudah dibukukan
     *
     * Pengelola modul. Status harus dibayar.
     *
     * `POST /v1/keu/va/{id}/tandai-dibukukan`
     *
     * scope: `keu:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVaByIdTandaiDibukukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keu/va/{id}/tandai-dibukukan', ['id' => $id], $query, null, $options, false, false);
    }
}
