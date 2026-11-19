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
     * Status penjadwal (`penjadwal.status`: aktif, tidak_aktif bila tidak berdetak lebih dari 5 menit, belum_pernah; `penjadwal.mode`:
     * antrean, latar, berurutan, dalam_proses beserta `mode_label` dan `mode_alasan`; `pekerja` antrean), ringkasan
     * 24 jam (berhasil, gagal, terlewat, sedang berjalan), dan semua tugas bawaan: jadwal (ekspresi + kalimat awam), pelaksana
     * (`penjadwal`, `crontab` = masih ada baris lama di crontab server sehingga penjadwal tidak menjalankannya,
     * `crontab_server` = sengaja di crontab), jalan terakhir, yang sedang berjalan/antre, jadwal berikutnya. `hak.kelola`
     * menandai apakah pemanggil boleh mengubah.
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
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
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
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
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
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
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
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
     * opsi yang diizinkan katalog, mis. `{"batas": "50"}`; nilai kosong = bawaan), `susul` (bool: susul sekali jadwal
     * harian/mingguan yang terlewat), `crontab_lama` (bool: tandai masih dijalankan crontab lama di server, sehingga penjadwal
     * tidak menjalankannya; dipakai bila `crontab -l` tidak terbaca), atau `kembalikan: true` (semua ke bawaan).
     * Jadwal yang lewat selama nonaktif tidak dihitung terlewat.
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
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
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
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
     * Katalog perintah yang boleh dijadwalkan
     *
     * Perintah artisan yang boleh dipakai tugas kustom: hanya yang menyatakan konstanta `TERJADWALKAN` di kelasnya dan tidak
     * cocok dengan daftar terlarang (migrate, db:*, admin:*, menyamar, kunci, sandi, ...). Tiap perintah: `nama`, `keterangan`,
     * `cara_pakai`, `modul`, `batas_menit` (saran), `parameter` (nama, jenis argumen/opsi, label, tipe angka/teks/pilihan/bendera/tanggal,
     * wajib, bawaan, min, maks, pola, pilihan).
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal/perintah`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalPerintah(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/perintah', [], $query, null, $options, false, false);
    }

    /**
     * Calon penerima notifikasi tugas kustom
     *
     * Admin Pustikom yang berhak melihat tugas terjadwal dan administrator: `username`, `administrator`.
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
     *
     * `GET /v1/sistem/jadwal/penerima`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalPenerima(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/penerima', [], $query, null, $options, false, false);
    }

    /**
     * Buat tugas kustom
     *
     * Body: `judul` (wajib), `keterangan`, `perintah` (wajib, dari katalog perintah), `parameter` (objek nama => nilai, divalidasi
     * menurut definisi perintah), `ekspresi` (wajib, cron 5 kolom, Asia/Makassar), `aktif` (bawaan true), `cegah_tumpang`
     * (bawaan true), `batas_menit` (1-720, bawaan saran perintah), `ulang` (percobaan ulang 0-3), `notif_gagal` (0-10; 0 = tanpa
     * notifikasi), `penerima` (daftar username dari /penerima; kosong = semua Admin Pustikom). Kode dibuat otomatis (`k-...`).
     * Perintah di luar katalog atau terlarang ditolak 422. Tercatat di log (sebelum/sesudah).
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/kustom`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalKustom(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/kustom', [], $query, null, $options, false, false);
    }

    /**
     * Ubah tugas kustom
     *
     * Kirim kolom yang diubah saja (sama dengan buat). Tugas bawaan tidak bisa diubah lewat sini (404).
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/kustom/{kode}`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param int|string $kode Kode tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalKustomByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/kustom/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus tugas kustom
     *
     * Riwayat jalan tetap. Ditolak 409 bila sedang berjalan; yang masih antre dibatalkan. Tugas bawaan tidak bisa dihapus (404).
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/kustom/{kode}/hapus`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param int|string $kode Kode tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalKustomByKodeHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/kustom/{kode}/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Riwayat jalan
     *
     * Terbaru dulu. Saring `tugas`, `status` (antre, berjalan, berhasil, gagal, batas_waktu, terlewat, dibatalkan; boleh beberapa dipisah koma), `pemicu` (jadwal, manual, susulan, ulang), `dari`/`sampai` (YYYY-MM-DD); `page`, `per_page` (maks. 100). Tanpa keluaran lengkap (lihat detail).
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
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
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
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
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
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

    /**
     * Pekerjaan antrean database yang gagal
     *
     * Pekerjaan antrean database (tabel `antrean_gagal`, docs/ANTREAN.md) yang melewati batas percobaan, terbaru dulu: `antrean`, `nama`, `data`, `percobaan`, `galat` (2.000 karakter pertama), `gagal_pada`. `page`, `per_page` (maks. 100).
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal` atau `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja.
     *
     * `GET /v1/sistem/jadwal/antrean/gagal`
     *
     * scope: `penjadwal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalAntreanGagal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sistem/jadwal/antrean/gagal', [], $query, null, $options, false, false);
    }

    /**
     * Coba ulang pekerjaan gagal
     *
     * Body `{"id": [1, 2]}` atau `{"semua": true}`. Pekerjaan dikembalikan ke antreannya dengan percobaan dari nol. Jawaban: `diulang`.
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/antrean/gagal/ulang`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalAntreanGagalUlang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/antrean/gagal/ulang', [], $query, null, $options, false, false);
    }

    /**
     * Hapus pekerjaan gagal
     *
     * Body `{"id": [1, 2]}` atau `{"semua": true}`. Jawaban: `dihapus`.
     *
     * Peran Admin Pustikom (`admin-pustikom`) dengan izin `pustikom.jadwal.kelola`, atau administrator. Token pengguna saja; tercatat di log.
     *
     * `POST /v1/sistem/jadwal/antrean/gagal/hapus`
     *
     * scope: `penjadwal:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalAntreanGagalHapus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sistem/jadwal/antrean/gagal/hapus', [], $query, null, $options, false, false);
    }
}
