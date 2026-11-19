<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Wisuda: Acara, Wisuda: Hari-H
 */
final class AcaraWisuda extends Resource
{
    /**
     * Hak saya
     *
     * kelola (wisuda:kelola), sumber (aplikasi asal permintaan), dan tugas panitia wisuda yang sedang aktif beserta seksinya.
     *
     * `GET /v1/acara-wisuda/saya`
     *
     * scope: `wisuda:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar acara
     *
     * Pengelola: semua acara; panitia: acara yang ditautkan ke panitia aktifnya saja.
     *
     * `GET /v1/acara-wisuda`
     *
     * scope: `wisuda:read` · berhalaman
     *
     * @param array{status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda', [], $query, null, $options, false, false);
    }

    /**
     * Buat acara
     *
     * Izin `wisuda:kelola`. Body: `{"nama", "tahun_id": "20252" (periode pendaftar wisuda), "tanggal", "jam_mulai"?, "jam_selesai"?, "gladi_tanggal"?, "gladi_jam"?, "gladi_tempat"?,
     * "tempat", "alamat"?, "kapasitas"?, "kursi_per_baris"? (20), "pendamping_maks"? (2), "prodi"? [kode], "keterangan"?, "status"? (draf)}`.
     *
     * `POST /v1/acara-wisuda`
     *
     * scope: `wisuda:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail acara
     *
     * Jadwal, panitia, rekap per fakultas, pendamping, status lunas, tugas saya, dan boleh.* (kelola, lihat, ubah, kehadiran, toga, pemanggilan).
     *
     * `GET /v1/acara-wisuda/{id}`
     *
     * scope: `wisuda:read`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah acara
     *
     * Isian sama dengan buat (sebagian). Pengelola atau ketua/sekretaris panitia (wisuda.semua).
     *
     * `POST /v1/acara-wisuda/{id}`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus acara
     *
     * Pengelola. Ditolak bila sudah ada data hari-H.
     *
     * `POST /v1/acara-wisuda/{id}/hapus`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tautkan panitia
     *
     * Pengelola. Body {"panitia_id": uuid panitia berjenis wisuda | null}. Anggota aktif panitia itu mendapat akses acara sesuai tugas seksinya.
     *
     * `POST /v1/acara-wisuda/{id}/panitia`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPanitia(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/panitia', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta
     *
     * Wisudawan acara (kode QR hanya untuk ketua/sekretaris/pengelola).
     *
     * `GET /v1/acara-wisuda/{id}/peserta`
     *
     * scope: `wisuda:read` · berhalaman
     *
     * @param int|string $id UUID acara
     * @param array{q?: string, fakultas?: string, prodi?: string, hadir?: string, toga?: string, kursi?: string, lunas?: string, terbaik?: string, urut?: string, batal?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdPeserta(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda/{id}/peserta', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tarik peserta
     *
     * Dari pendaftar wisuda DITERIMA (t_mahasiswa_wisuda.terima = Y) periode tahun_id acara; IPK/predikat dan status lunas (indikator tunggakan) ikut dibaca. Yang tidak diterima lagi ditandai batal.
     *
     * `POST /v1/acara-wisuda/{id}/peserta/tarik`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPesertaTarik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/peserta/tarik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah peserta
     *
     * Body: {"ukuran_toga"?, "nomor_kursi"?, "terbaik"? (label), "batal"?, "pendamping"? [{urut, nama, hubungan}]}. Ketua/sekretaris/pengelola.
     *
     * `POST /v1/acara-wisuda/{id}/peserta/{peserta}`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param int|string $peserta UUID peserta
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPesertaByPeserta(int|string $id, int|string $peserta, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/peserta/{peserta}', ['id' => $id, 'peserta' => $peserta], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Atur nomor kursi otomatis
     *
     * Urut fakultas, prodi, terbaik, NIM; baris A, B, ... Body {"hanya_kosong"?: true}.
     *
     * `POST /v1/acara-wisuda/{id}/kursi`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdKursi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/kursi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Urutan pemanggilan
     *
     * Seksi acara/ketua/pengelola. Tanpa body = otomatis per blok pemanggilan fakultas di susunan, fakultas, prodi, terbaik, NIM. {"urut": [uuid peserta]} = manual.
     *
     * `POST /v1/acara-wisuda/{id}/urutan`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUrutan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/urutan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Susunan acara
     *
     * Sambutan, acara, dan blok pemanggilan per fakultas.
     *
     * `GET /v1/acara-wisuda/{id}/susunan`
     *
     * scope: `wisuda:read`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdSusunan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda/{id}/susunan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan susunan acara
     *
     * Seksi acara/ketua/pengelola. Body {"item": [{"jenis": "sambutan|acara|pemanggilan", "judul", "pengisi"?, "durasi_menit"?, "kode_fakultas"?}]} menggantikan seluruh susunan.
     *
     * `POST /v1/acara-wisuda/{id}/susunan`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdSusunan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/susunan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan undangan pendamping
     *
     * QR pendamping sebanyak pendamping_maks per wisudawan (QR wisudawan dibuat saat ditarik).
     *
     * `POST /v1/acara-wisuda/{id}/undangan`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUndangan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/undangan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periksa status lunas
     *
     * Membaca ulang tunggakan tiap wisudawan dari keuangan (indikator aturan tunggakan); tidak mengubah data keuangan/kasir.
     *
     * `POST /v1/acara-wisuda/{id}/keuangan`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdKeuangan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/keuangan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Umumkan
     *
     * Body {"kabar": true (notifikasi ke wisudawan), "humas": true (pengumuman portal berstatus review untuk redaksi Humas)}. Status draf menjadi terbit.
     *
     * `POST /v1/acara-wisuda/{id}/umumkan`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUmumkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/umumkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Laporan acara
     *
     * Rekap per fakultas/prodi: peserta, hadir, pendamping hadir, toga, berkursi, lunas, terbaik; daftar wisudawan terbaik.
     *
     * `GET /v1/acara-wisuda/{id}/laporan`
     *
     * scope: `wisuda:read`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdLaporan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda/{id}/laporan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kandidat wisudawan terbaik
     *
     * IPK tertinggi per prodi.
     *
     * `GET /v1/acara-wisuda/{id}/terbaik`
     *
     * scope: `wisuda:read`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdTerbaik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda/{id}/terbaik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat acara
     *
     * Termasuk aplikasi asal aksi (baak, pustikom, fakultas).
     *
     * `GET /v1/acara-wisuda/{id}/riwayat`
     *
     * scope: `wisuda:read`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/acara-wisuda/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pindai QR
     *
     * Body: `{"kode": "UNIPO-WSD:..."}` atau `{"nim": "..."}`, `"jenis": "kehadiran|toga"`, `"batal"?: true` (koreksi).
     * kehadiran: QR wisudawan atau pendamping (tugas wisuda.kehadiran); toga: QR wisudawan (tugas wisuda.toga). QR acara lain ditolak 409.
     * Hasil: status tercatat|sudah|dibatalkan beserta nama, prodi, kursi, urutan panggil, ukuran toga.
     *
     * `POST /v1/acara-wisuda/{id}/pindai`
     *
     * scope: `wisuda:write`
     *
     * @param int|string $id UUID acara
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPindai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/acara-wisuda/{id}/pindai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
