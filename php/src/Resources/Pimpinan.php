<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Pimpinan: Bidang, Pimpinan: Pengesahan kurikulum, Pimpinan: Arahan
 */
final class Pimpinan extends Resource
{
    /**
     * Bidang dan fitur saya
     *
     * Bidang pimpinan yang dipegang (lewat jabatan ber-SK atau penugasan ber-SK) beserta fiturnya untuk menu, jabatan aktif saya, apakah boleh mengatur bidang, dan "boleh" (hak menu Administrasi: kepanitiaan, registri_sk, ...). ADMIN melihat semua bidang aktif.
     *
     * `GET /v1/pimpinan/saya`
     *
     * scope: `pimpinan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Katalog fitur
     *
     * Semua fitur aplikasi Dasbor Pimpinan: kode, kelompok, nama, keterangan, apakah memberi kewenangan memutuskan, dan izin RBAC yang ikut diberikan.
     *
     * `GET /v1/pimpinan/fitur`
     *
     * scope: `pimpinan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFitur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/fitur', [], $query, null, $options, false, false);
    }

    /**
     * Daftar bidang
     *
     * Pengatur (dashboard.atur/ADMIN): semua bidang termasuk nonaktif beserta pemegang (jabatan, orang, pejabat aktif, jabatan_kosong = jabatan tanpa pejabat aktif ber-SK, level lama yang tersisa) dan SK versi berlaku. Lainnya: bidang aktif tanpa pemegang.
     *
     * `GET /v1/pimpinan/bidang`
     *
     * scope: `pimpinan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBidang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/bidang', [], $query, null, $options, false, false);
    }

    /**
     * Tambah bidang
     *
     * Body: {"kode" (baru saja; kosong = dibuat dari nama), "nama", "keterangan", "ikon" (nama ikon lucide), "warna", "urutan", "aktif", "fitur": ["akademik.ringkasan", ...], "jabatan": ["WR1", ...] (kode induk_jabatan), "orang": [{"username", "mulai", "selesai", "nomor_sk" atau "sk_id", "alasan"}] (wajib ber-SK), "level": [] (hanya untuk melepas level lama), "sk": UUID registri SK | {"sk_id"} | {"nomor", "tanggal"} (SK Rektor dasar pembagian; wajib bila fitur/pemegang/aktif berubah), "berlaku_mulai": "YYYY-MM-DD" (bawaan hari ini, tidak boleh di masa depan), "catatan"}. Kunci yang tidak dikirim tidak diubah. Perubahan pembagian dicatat sebagai versi baru (riwayat). Izin peran pimpinan-<kode> disamakan dengan izin fitur. Izin dashboard.atur atau ADMIN.
     *
     * `POST /v1/pimpinan/bidang`
     *
     * scope: `pimpinan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBidang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/bidang', [], $query, null, $options, false, false);
    }

    /**
     * Urutkan bidang
     *
     * Body: {"kode": ["akademik", "keuangan", ...]} sesuai urutan menu.
     *
     * `POST /v1/pimpinan/bidang/urutan`
     *
     * scope: `pimpinan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBidangUrutan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/bidang/urutan', [], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural
     *
     * Jabatan data induk beserta pejabat aktifnya, untuk memilih pemegang bidang. Pengatur.
     *
     * `GET /v1/pimpinan/jabatan`
     *
     * scope: `pimpinan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJabatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/jabatan', [], $query, null, $options, false, false);
    }

    /**
     * Detail bidang
     *
     * Bidang beserta fitur dan pemegangnya. Pengatur.
     *
     * `GET /v1/pimpinan/bidang/{kode}`
     *
     * scope: `pimpinan:read`
     *
     * @param int|string $kode pimpinan_bidang.kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBidangByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/bidang/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah bidang (POST)
     *
     * Sama dengan PUT, untuk hosting yang menolak PUT.
     *
     * `POST /v1/pimpinan/bidang/{kode}`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $kode pimpinan_bidang.kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBidangByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/bidang/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah bidang
     *
     * Body: {"kode" (baru saja; kosong = dibuat dari nama), "nama", "keterangan", "ikon" (nama ikon lucide), "warna", "urutan", "aktif", "fitur": ["akademik.ringkasan", ...], "jabatan": ["WR1", ...] (kode induk_jabatan), "orang": [{"username", "mulai", "selesai", "nomor_sk" atau "sk_id", "alasan"}] (wajib ber-SK), "level": [] (hanya untuk melepas level lama), "sk": UUID registri SK | {"sk_id"} | {"nomor", "tanggal"} (SK Rektor dasar pembagian; wajib bila fitur/pemegang/aktif berubah), "berlaku_mulai": "YYYY-MM-DD" (bawaan hari ini, tidak boleh di masa depan), "catatan"}. Kunci yang tidak dikirim tidak diubah. Perubahan pembagian dicatat sebagai versi baru (riwayat). Izin peran pimpinan-<kode> disamakan dengan izin fitur. Izin dashboard.atur atau ADMIN.
     *
     * `PUT /v1/pimpinan/bidang/{kode}`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $kode pimpinan_bidang.kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBidangByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pimpinan/bidang/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Riwayat pembagian bidang
     *
     * Versi pembagian bidang (terbaru dahulu): SK Rektor (registri), tanggal berlaku, fitur dan pemegang tiap versi, pencatat. Pengatur.
     *
     * `GET /v1/pimpinan/bidang/{kode}/riwayat`
     *
     * scope: `pimpinan:read`
     *
     * @param int|string $kode pimpinan_bidang.kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBidangByKodeRiwayat(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/bidang/{kode}/riwayat', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus bidang
     *
     * Bidang diarsipkan, peran pimpinan-<kode> dinonaktifkan, pemetaan jabatan/level dilepas, penugasan orang dicabut. Pengatur.
     *
     * `POST /v1/pimpinan/bidang/{kode}/hapus`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $kode pimpinan_bidang.kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBidangByKodeHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/bidang/{kode}/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Antrean pengesahan kurikulum
     *
     * Pengajuan kurikulum prodi semua fakultas pada alur pengesahan berjenjang (tim kurikulum, GPM, Dekan, verifikasi BAAK, Pengesahan Rektor, SK Rektor) beserta alur tahap, tahap sekarang, dan boleh (giliran Anda). ?giliran=saya (bawaan) | semua, ?status=, ?fakultas=, ?prodi=. Izin kurikulum.sahkan.universitas (Rektor; delegasi WR I).
     *
     * `GET /v1/pimpinan/kurikulum`
     *
     * scope: `pimpinan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulum(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/kurikulum', [], $query, null, $options, false, false);
    }

    /**
     * Detail pengajuan kurikulum
     *
     * Alur tahap dan catatan, isian pengusul, ringkasan kurikulum, cek administrasi otomatis (struktur SKS, kode MK, PDDikti), dan perbandingan dengan kurikulum aktif prodi.
     *
     * `GET /v1/pimpinan/kurikulum/{id}`
     *
     * scope: `pimpinan:read`
     *
     * @param int|string $id ID pengajuan (kur_evaluasi)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/kurikulum/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sahkan atau kembalikan kurikulum
     *
     * Body: {"keputusan": "lanjut" | "kembalikan", "catatan"} (catatan wajib bila dikembalikan). Hanya tahap yang mencantumkan peran Anda (Pengesahan Rektor); setelah disahkan, BAAK mencatat SK Rektor.
     *
     * `POST /v1/pimpinan/kurikulum/{id}/proses`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID pengajuan (kur_evaluasi)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdProses(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/kurikulum/{id}/proses', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Arahan pimpinan: daftar
     *
     * Arahan/instruksi pimpinan ke unit atau penanggung jawab, dengan tenggat dan tindak lanjut. Pimpinan (pemegang bidang di Dasbor Pimpinan) membuat dan menerima laporan; penanggung jawab melihat arahan untuknya, mencatat tindak lanjut, dan melaporkan selesai. Hanya pengelola modul.
     *
     * `GET /v1/pimpinan/arahan`
     *
     * scope: `pimpinan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, prioritas?: string, unit_id?: string, penanggung_jawab?: string, status?: string, pemberi?: string, bidang?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArahan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/arahan', [], $query, null, $options, false, false);
    }

    /**
     * Arahan pimpinan: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/pimpinan/arahan`
     *
     * scope: `pimpinan:write`
     *
     * @param array{judul: string, isi: string, bidang?: string, prioritas?: string, unit_id?: int, penanggung_jawab?: string, tenggat?: string, rujukan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArahan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/arahan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arahan pimpinan: detail
     *
     * Arahan/instruksi pimpinan ke unit atau penanggung jawab, dengan tenggat dan tindak lanjut. Pimpinan (pemegang bidang di Dasbor Pimpinan) membuat dan menerima laporan; penanggung jawab melihat arahan untuknya, mencatat tindak lanjut, dan melaporkan selesai. Hanya pengelola modul.
     *
     * `GET /v1/pimpinan/arahan/{id}`
     *
     * scope: `pimpinan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArahanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/arahan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Arahan pimpinan: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/pimpinan/arahan/{id}`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, isi: string, bidang?: string, prioritas?: string, unit_id?: int, penanggung_jawab?: string, tenggat?: string, rujukan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putArahanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pimpinan/arahan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arahan pimpinan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Arahan/instruksi pimpinan ke unit atau penanggung jawab, dengan tenggat dan tindak lanjut. Pimpinan (pemegang bidang di Dasbor Pimpinan) membuat dan menerima laporan; penanggung jawab melihat arahan untuknya, mencatat tindak lanjut, dan melaporkan selesai. Hanya pengelola modul.
     *
     * `GET /v1/pimpinan/arahan/{id}/riwayat`
     *
     * scope: `pimpinan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArahanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/arahan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Arahan pimpinan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/pimpinan/arahan/{id}/berkas`
     *
     * scope: `pimpinan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArahanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/arahan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Arahan pimpinan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/pimpinan/arahan/{id}/berkas`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArahanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/arahan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Arahan pimpinan: unduh lampiran
     *
     * `GET /v1/pimpinan/arahan/{id}/berkas/{uuid}`
     *
     * scope: `pimpinan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArahanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pimpinan/arahan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Arahan pimpinan: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/pimpinan/arahan/{id}/berkas/{uuid}`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteArahanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pimpinan/arahan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Arahan pimpinan: Catat tindak lanjut
     *
     * Pengelola modul. Status harus dikirim/dikerjakan, menjadi dikerjakan.
     *
     * `POST /v1/pimpinan/arahan/{id}/tindak-lanjut`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, progres?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArahanByIdTindakLanjut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/arahan/{id}/tindak-lanjut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arahan pimpinan: Laporkan selesai
     *
     * Pengelola modul. Status harus dikirim/dikerjakan, menjadi dilaporkan.
     *
     * `POST /v1/pimpinan/arahan/{id}/lapor-selesai`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArahanByIdLaporSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/arahan/{id}/lapor-selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arahan pimpinan: Terima laporan (selesai)
     *
     * Admin modul. Status harus dilaporkan/dikerjakan/dikirim, menjadi selesai.
     *
     * `POST /v1/pimpinan/arahan/{id}/terima`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArahanByIdTerima(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/arahan/{id}/terima', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arahan pimpinan: Kembalikan untuk diperbaiki
     *
     * Admin modul. Status harus dilaporkan, menjadi dikerjakan.
     *
     * `POST /v1/pimpinan/arahan/{id}/kembalikan`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArahanByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/arahan/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arahan pimpinan: Batalkan arahan
     *
     * Admin modul. Status harus dikirim/dikerjakan/dilaporkan, menjadi dibatalkan.
     *
     * `POST /v1/pimpinan/arahan/{id}/batalkan`
     *
     * scope: `pimpinan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArahanByIdBatalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pimpinan/arahan/{id}/batalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
