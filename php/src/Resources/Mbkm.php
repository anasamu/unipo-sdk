<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * MBKM: Laporan, MBKM: Peserta, MBKM: Program, MBKM: Logbook, MBKM: Nilai dan konversi
 */
final class Mbkm extends Resource
{
    /**
     * Data aktivitas bentuk Neo Feeder
     *
     * Per program berstatus berjalan/selesai pada semester: aktivitas, anggota, pembimbing, penguji, dan konversi yang disetujui. Hanya pengelola. Belum dikirim otomatis ke Feeder.
     *
     * `GET /v1/mbkm/feeder`
     *
     * scope: `mbkm:read`
     *
     * @param array{tahun_id: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFeeder(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/feeder', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan MBKM saya (mahasiswa)
     *
     * Program yang sedang membuka pendaftaran untuk prodi saya dan keikutsertaan saya beserta SKS yang diakui.
     *
     * `GET /v1/mbkm/saya`
     *
     * scope: `mbkm:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/saya', [], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: daftar
     *
     * Program/aktivitas yang dibuka. Selain pengelola hanya melihat program berstatus buka, berjalan, atau selesai. Semua pemilik token ber-scope mbkm:read (selain pengelola hanya melihat status buka/berjalan/selesai).
     *
     * `GET /v1/mbkm/program`
     *
     * scope: `mbkm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, penyelenggara?: string, mitra_id?: string, kerjasama_dokumen_id?: string, tahun_id?: string, unit_id?: string, kode_prodi?: string, daftar_mandiri?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgram(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/program', [], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/mbkm/program`
     *
     * scope: `mbkm:write`
     *
     * @param array{kode: string, nama: string, jenis: string, id_jenis_aktivitas_feeder?: int, penyelenggara?: string, mitra_id?: int, kerjasama_dokumen_id?: int, tahun_id: string, unit_id?: int, kode_prodi?: string, deskripsi?: string, syarat?: string, lokasi?: string, daftar_mulai?: string, daftar_selesai?: string, mulai?: string, selesai?: string, kuota?: int, sks_maks?: int, daftar_mandiri?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgram(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/program', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Program MBKM: detail
     *
     * Program/aktivitas yang dibuka. Selain pengelola hanya melihat program berstatus buka, berjalan, atau selesai. Semua pemilik token ber-scope mbkm:read (selain pengelola hanya melihat status buka/berjalan/selesai).
     *
     * `GET /v1/mbkm/program/{id}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgramById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/program/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/mbkm/program/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, jenis: string, id_jenis_aktivitas_feeder?: int, penyelenggara?: string, mitra_id?: int, kerjasama_dokumen_id?: int, tahun_id: string, unit_id?: int, kode_prodi?: string, deskripsi?: string, syarat?: string, lokasi?: string, daftar_mulai?: string, daftar_selesai?: string, mulai?: string, selesai?: string, kuota?: int, sks_maks?: int, daftar_mandiri?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putProgramById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/mbkm/program/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Program MBKM: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/mbkm/program/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProgramById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/program/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/mbkm/program/{id}/berkas`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgramByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/program/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/mbkm/program/{id}/berkas`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/program/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Program MBKM: unduh lampiran
     *
     * `GET /v1/mbkm/program/{id}/berkas/{uuid}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgramByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/program/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/mbkm/program/{id}/berkas/{uuid}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProgramByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/program/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: Buka pendaftaran
     *
     * Pengelola modul. Status harus draf, menjadi buka.
     *
     * `POST /v1/mbkm/program/{id}/buka`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/program/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: Mulai pelaksanaan
     *
     * Pengelola modul. Status harus buka, menjadi berjalan.
     *
     * `POST /v1/mbkm/program/{id}/mulai`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdMulai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/program/{id}/mulai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: Selesaikan
     *
     * Pengelola modul. Status harus berjalan, menjadi selesai.
     *
     * `POST /v1/mbkm/program/{id}/selesai`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/program/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Program MBKM: Batalkan
     *
     * Pengelola modul. Status harus draf/buka, menjadi dibatalkan.
     *
     * `POST /v1/mbkm/program/{id}/batalkan`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/program/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: daftar
     *
     * Mahasiswa mendaftar sendiri (program berstatus buka, dalam masa daftar, kuota tersedia); nim, prodi, dan tahun diisi otomatis. Dosen pembimbing melihat peserta bimbingannya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/mbkm/peserta`
     *
     * scope: `mbkm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, program_id?: string, nim?: string, kode_prodi?: string, tahun_id?: string, peran?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeserta(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/peserta', [], $query, null, $options, false, false);
    }

    /**
     * Peserta: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/mbkm/peserta`
     *
     * scope: `mbkm:write`
     *
     * @param array{program_id: int, nim: string, peran?: string, judul?: string, posisi?: string, lokasi?: string, motivasi?: string, mulai?: string, selesai?: string, nomor_sk?: string, nilai_angka?: float|int, nilai_huruf?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeserta(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/peserta', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: detail
     *
     * Mahasiswa mendaftar sendiri (program berstatus buka, dalam masa daftar, kuota tersedia); nim, prodi, dan tahun diisi otomatis. Dosen pembimbing melihat peserta bimbingannya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/mbkm/peserta/{id}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPesertaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/peserta/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/mbkm/peserta/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{program_id: int, nim: string, peran?: string, judul?: string, posisi?: string, lokasi?: string, motivasi?: string, mulai?: string, selesai?: string, nomor_sk?: string, nilai_angka?: float|int, nilai_huruf?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPesertaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/mbkm/peserta/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/mbkm/peserta/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePesertaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/peserta/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/mbkm/peserta/{id}/berkas`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPesertaByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/peserta/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/mbkm/peserta/{id}/berkas`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/peserta/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Peserta: unduh lampiran
     *
     * `GET /v1/mbkm/peserta/{id}/berkas/{uuid}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPesertaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/peserta/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Peserta: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/mbkm/peserta/{id}/berkas/{uuid}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePesertaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/peserta/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Peserta: Setujui
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/mbkm/peserta/{id}/setujui`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nomor_sk?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/peserta/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/mbkm/peserta/{id}/tolak`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/peserta/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: Mulai
     *
     * Pengelola modul. Status harus disetujui, menjadi berjalan.
     *
     * `POST /v1/mbkm/peserta/{id}/mulai`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdMulai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/peserta/{id}/mulai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: Selesaikan dan tetapkan nilai
     *
     * Bila nilai_angka tidak dikirim, dihitung dari komponen penilaian berbobot. Pengelola modul. Status harus berjalan, menjadi selesai.
     *
     * `POST /v1/mbkm/peserta/{id}/selesai`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nilai_angka?: float|int, nilai_huruf?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/peserta/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: Mengundurkan diri
     *
     * Pemilik data atau pengelola. Status harus diajukan/disetujui/berjalan, menjadi mengundurkan_diri.
     *
     * `POST /v1/mbkm/peserta/{id}/mundur`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdMundur(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/peserta/{id}/mundur', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pembimbing dan penguji: daftar
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/mbkm/pembimbing`
     *
     * scope: `mbkm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, peserta_id?: string, peran?: string, nidn?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembimbing(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/pembimbing', [], $query, null, $options, false, false);
    }

    /**
     * Pembimbing dan penguji: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/mbkm/pembimbing`
     *
     * scope: `mbkm:write`
     *
     * @param array{peserta_id: int, peran?: string, urut?: int, nidn?: string, nama?: string, instansi?: string, email?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembimbing(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/pembimbing', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pembimbing dan penguji: detail
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/mbkm/pembimbing/{id}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembimbingById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/pembimbing/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pembimbing dan penguji: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/mbkm/pembimbing/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{peserta_id: int, peran?: string, urut?: int, nidn?: string, nama?: string, instansi?: string, email?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPembimbingById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/mbkm/pembimbing/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pembimbing dan penguji: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/mbkm/pembimbing/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePembimbingById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/pembimbing/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: daftar
     *
     * Diisi mahasiswa peserta (status draf/revisi bisa diubah), diajukan, lalu diperiksa dosen pembimbing atau pengelola. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/mbkm/logbook`
     *
     * scope: `mbkm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, peserta_id?: string, nim?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogbook(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/logbook', [], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `POST /v1/mbkm/logbook`
     *
     * scope: `mbkm:write`
     *
     * @param array{peserta_id: int, tanggal: string, jam?: float|int, kegiatan: string, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLogbook(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/logbook', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Logbook kegiatan: detail
     *
     * Diisi mahasiswa peserta (status draf/revisi bisa diubah), diajukan, lalu diperiksa dosen pembimbing atau pengelola. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/mbkm/logbook/{id}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogbookById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/logbook/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/mbkm/logbook/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{peserta_id: int, tanggal: string, jam?: float|int, kegiatan: string, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putLogbookById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/mbkm/logbook/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Logbook kegiatan: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `DELETE /v1/mbkm/logbook/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLogbookById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/logbook/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/mbkm/logbook/{id}/berkas`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogbookByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/logbook/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `POST /v1/mbkm/logbook/{id}/berkas`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLogbookByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/logbook/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Logbook kegiatan: unduh lampiran
     *
     * `GET /v1/mbkm/logbook/{id}/berkas/{uuid}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogbookByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/logbook/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/revisi.
     *
     * `DELETE /v1/mbkm/logbook/{id}/berkas/{uuid}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLogbookByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/logbook/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: Ajukan
     *
     * Pemilik data. Status harus draf/revisi, menjadi diajukan.
     *
     * `POST /v1/mbkm/logbook/{id}/ajukan`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLogbookByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/logbook/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Logbook kegiatan: Setujui
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/mbkm/logbook/{id}/setujui`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLogbookByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/logbook/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Logbook kegiatan: Minta revisi
     *
     * Pengelola modul. Status harus diajukan, menjadi revisi.
     *
     * `POST /v1/mbkm/logbook/{id}/revisi`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLogbookByIdRevisi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/logbook/{id}/revisi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komponen penilaian: daftar
     *
     * Diisi pengelola atau dosen pembimbing/penguji peserta. Nilai akhir = jumlah nilai×bobot/jumlah bobot. Hanya pengelola modul.
     *
     * `GET /v1/mbkm/penilaian`
     *
     * scope: `mbkm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, peserta_id?: string, penilai?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenilaian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/penilaian', [], $query, null, $options, false, false);
    }

    /**
     * Komponen penilaian: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/mbkm/penilaian`
     *
     * scope: `mbkm:write`
     *
     * @param array{peserta_id: int, komponen: string, bobot?: float|int, nilai: float|int, penilai?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenilaian(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/penilaian', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komponen penilaian: detail
     *
     * Diisi pengelola atau dosen pembimbing/penguji peserta. Nilai akhir = jumlah nilai×bobot/jumlah bobot. Hanya pengelola modul.
     *
     * `GET /v1/mbkm/penilaian/{id}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenilaianById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/penilaian/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komponen penilaian: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/mbkm/penilaian/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{peserta_id: int, komponen: string, bobot?: float|int, nilai: float|int, penilai?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPenilaianById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/mbkm/penilaian/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komponen penilaian: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/mbkm/penilaian/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePenilaianById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/penilaian/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konversi ke mata kuliah: daftar
     *
     * Usulan pengakuan SKS ke mata kuliah (m_mata_kuliah) oleh pengelola atau dosen pembimbing, lalu disetujui pengelola. Total SKS disetujui tidak boleh melebihi sks_maks program. Data ini tidak menulis ke KRS/KHS SIAKAD; dipakai untuk input nilai dan pelaporan Feeder. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/mbkm/konversi`
     *
     * scope: `mbkm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, peserta_id?: string, nim?: string, tahun_id?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKonversi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/konversi', [], $query, null, $options, false, false);
    }

    /**
     * Konversi ke mata kuliah: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/mbkm/konversi`
     *
     * scope: `mbkm:write`
     *
     * @param array{peserta_id: int, mata_kuliah_id?: int, kode_mk?: string, nama_mk?: string, sks?: int, tahun_id?: string, nilai_angka?: float|int, nilai_huruf?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonversi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/konversi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konversi ke mata kuliah: detail
     *
     * Usulan pengakuan SKS ke mata kuliah (m_mata_kuliah) oleh pengelola atau dosen pembimbing, lalu disetujui pengelola. Total SKS disetujui tidak boleh melebihi sks_maks program. Data ini tidak menulis ke KRS/KHS SIAKAD; dipakai untuk input nilai dan pelaporan Feeder. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/mbkm/konversi/{id}`
     *
     * scope: `mbkm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKonversiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mbkm/konversi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konversi ke mata kuliah: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/mbkm/konversi/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{peserta_id: int, mata_kuliah_id?: int, kode_mk?: string, nama_mk?: string, sks?: int, tahun_id?: string, nilai_angka?: float|int, nilai_huruf?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKonversiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/mbkm/konversi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konversi ke mata kuliah: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/mbkm/konversi/{id}`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKonversiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/mbkm/konversi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konversi ke mata kuliah: Setujui
     *
     * Pengelola modul. Status harus usulan, menjadi disetujui.
     *
     * `POST /v1/mbkm/konversi/{id}/setujui`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonversiByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/konversi/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konversi ke mata kuliah: Tolak
     *
     * Pengelola modul. Status harus usulan, menjadi ditolak.
     *
     * `POST /v1/mbkm/konversi/{id}/tolak`
     *
     * scope: `mbkm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonversiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mbkm/konversi/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
