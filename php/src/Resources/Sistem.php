<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Sistem: Log terpadu, Sistem: Tugas terjadwal
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

    /**
     * Ikhtisar tugas terjadwal
     *
     * Status penjadwal (`penjadwal.status`: aktif, tidak_aktif bila tidak berdetak lebih dari 5 menit, belum_pernah), ringkasan
     * 24 jam (berhasil, gagal, terlewat, sedang berjalan), dan semua tugas bawaan: jadwal (ekspresi + kalimat awam), pelaksana
     * (`penjadwal`, `crontab` = masih ada baris lama di crontab server sehingga penjadwal tidak menjalankannya,
     * `crontab_server` = sengaja di crontab), jalan terakhir, yang sedang berjalan/antre, jadwal berikutnya. `hak.kelola`
     * menandai apakah pemanggil boleh mengubah.
     *
     * Izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Status penjadwal
     *
     * Detak terakhir per server, baris crontab yang terbaca, dan baris crontab yang perlu dipasang.
     *
     * Izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal/status`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalStatus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/status', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau ekspresi cron
     *
     * `ekspresi` (5 kolom: menit jam tanggal bulan hari, mis. `0 2 * * *`), `jumlah` (1-20, bawaan 5). Jawaban: `valid`, `galat`, `teks` (kalimat awam), `berikut` (waktu jatuh tempo).
     *
     * Izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal/pratinjau`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param array{ekspresi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalPratinjau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/pratinjau', [], $query, null, $options, false, false);
    }

    /**
     * Detail tugas
     *
     * Izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal/tugas/{kode}`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param int|string $kode Kode tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalTugasByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/tugas/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah tugas
     *
     * Body (kirim yang diubah saja): `aktif` (bool), `ekspresi` (cron 5 kolom; kosong = kembali ke bawaan), `opsi` (objek nilai
     * opsi yang diizinkan katalog, mis. `{"batas": "50"}`; nilai kosong = bawaan), atau `kembalikan: true` (semua ke bawaan).
     * Jadwal yang lewat selama nonaktif tidak dihitung terlewat.
     *
     * Izin `pustikom.jadwal.kelola` atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/tugas/{kode}`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param int|string $kode Kode tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalTugasByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/tugas/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Jalankan sekarang
     *
     * Memasukkan tugas ke antrean; detak penjadwal berikutnya (paling lama 1 menit) memulainya sebagai proses latar,
     * bukan di dalam permintaan HTTP ini. Ditolak 409 bila tugas itu masih antre/berjalan. Boleh untuk tugas nonaktif.
     *
     * Izin `pustikom.jadwal.kelola` atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/tugas/{kode}/jalankan`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param int|string $kode Kode tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalTugasByKodeJalankan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/tugas/{kode}/jalankan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Riwayat jalan
     *
     * Terbaru dulu. Saring `tugas`, `status` (antre, berjalan, berhasil, gagal, batas_waktu, terlewat, dibatalkan; boleh beberapa dipisah koma), `pemicu` (jadwal, manual), `dari`/`sampai` (YYYY-MM-DD); `page`, `per_page` (maks. 100). Tanpa keluaran lengkap (lihat detail).
     *
     * Izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal/jalan`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalJalan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/jalan', [], $query, null, $options, false, false);
    }

    /**
     * Detail jalan
     *
     * Termasuk `keluaran` (stdout) dan `galat` (stderr), masing-masing maks. 64 KB (awal dan akhir).
     *
     * Izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal/jalan/{id}`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param int|string $id ID jalan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalJalanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/jalan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hentikan jalan
     *
     * Yang masih antre langsung dibatalkan. Yang sedang berjalan ditandai `minta_berhenti`; proses pelaksana menghentikannya
     * (SIGTERM, lalu SIGKILL setelah 5 detik) dalam beberapa detik dan mencatatnya `dibatalkan`.
     *
     * Izin `pustikom.jadwal.kelola` atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/jalan/{id}/hentikan`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param int|string $id ID jalan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalJalanByIdHentikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/jalan/{id}/hentikan', ['id' => $id], $query, null, $options, false, false);
    }
}
