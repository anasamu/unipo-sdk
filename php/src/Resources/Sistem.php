<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Sistem: Log terpadu
 */
final class Sistem extends Resource
{
    /**
     * Log semua proses
     *
     * Log dari semua sumber (kelola akun, masuk sebagai pengguna, hak akses panitia, login SIAKAD lama, data induk & RBAC,
     * riwayat aturan, tema, pengajuan API, kirim PDDikti, panggilan integrasi/berkas, webhook, AI, tugas terjadwal, kirim
     * notifikasi, antrean event, akses rahasia, event domain, her-registrasi, SDM, SPMI, LPPM, arsip) dengan kolom seragam:
     * `id` (`<sumber>:<kunci>`, null bila sumber tanpa kunci), `waktu`, `sumber`, `sumber_nama`, `kelompok`, `aksi`, `pelaku`,
     * `sasaran`, `ringkasan`, `tingkat` (`info`/`peringatan`/`galat`), `ip` (disamarkan sebagian).
     *
     * Terbaru dulu, paginasi kursor: kirim `meta.berikut` sebagai `kursor` untuk halaman berikutnya (null = habis).
     * `meta.sumber_galat` = sumber yang gagal dibaca (dilewati). Token, password, payload, dan isi pesan tidak pernah dikirim.
     * Hak: izin `pustikom.log` atau administrator sistem (peran superadmin). Token pengguna saja.
     *
     * `GET /v1/sistem/log`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array{sumber?: string, tingkat?: string, pelaku?: string, q?: string, dari?: string, sampai?: string, kursor?: string, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/log', [], $query, null, $options, false, false);
    }

    /**
     * Sumber log
     *
     * Semua sumber log beserta kelompok, keterangan, tabel asal, apakah tersedia di server ini, dan tingkat yang mungkin. Hak: izin `pustikom.log` atau administrator sistem (peran superadmin). Token pengguna saja.
     *
     * `GET /v1/sistem/log/sumber`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogSumber(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/log/sumber', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan log
     *
     * Jumlah baris per tingkat (total dan per sumber) dalam `jam` terakhir (bawaan 24, maks 744) dan 5 galat terbaru. Untuk beranda Pustikom. Hak: izin `pustikom.log` atau administrator sistem (peran superadmin). Token pengguna saja.
     *
     * `GET /v1/sistem/log/ringkasan`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array{jam?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/log/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Ekspor log (CSV)
     *
     * Saringan sama dengan daftar; maks 10.000 baris terbaru, CSV titik koma UTF-8. Hak: izin `pustikom.log` atau administrator sistem (peran superadmin). Token pengguna saja.
     *
     * `GET /v1/sistem/log/ekspor`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param array{sumber?: string, tingkat?: string, pelaku?: string, q?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogEkspor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/log/ekspor', [], $query, null, $options, false, false);
    }

    /**
     * Detail baris log
     *
     * Kolom seragam ditambah `detail` (kolom tambahan sumber itu, JSON sudah dibersihkan dari kunci rahasia, URL tanpa query string). `ip_lengkap` hanya untuk administrator sistem. Hak: izin `pustikom.log` atau administrator sistem (peran superadmin). Token pengguna saja.
     *
     * `GET /v1/sistem/log/{sumber}/{id}`
     *
     * scope: `rbac:read` · hanya token pengguna
     *
     * @param int|string $sumber Kode sumber
     * @param int|string $id Kunci baris
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLogBySumberById(int|string $sumber, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/log/{sumber}/{id}', ['sumber' => $sumber, 'id' => $id], $query, null, $options, false, false);
    }
}
