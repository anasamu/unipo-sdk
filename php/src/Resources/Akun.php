<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Akun pengguna
 */
final class Akun extends Resource
{
    /**
     * Daftar akun
     *
     * Akun di tabel user yang boleh dikelola pemanggil, tanpa password. Saring `q` (username/nama/email), `jenis` (dosen, tendik, mahasiswa, pendaftar, lain = tanpa pemilik), `level`, `aktif` (Y/N), `kode_prodi`.
     *
     * Hak: administrator (peran superadmin) atau izin `pustikom.akun` (semua jenis), `sdm.akun` (dosen, tendik), `baak.akun` atau level BAK (mahasiswa, pendaftar). Token pengguna saja.
     *
     * `GET /v1/akun`
     *
     * scope: `akun:read` · hanya token pengguna · berhalaman
     *
     * @param array{q?: string, jenis?: string, level?: string, aktif?: string, kode_prodi?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akun', [], $query, null, $options, false, false);
    }

    /**
     * Buat akun
     *
     * Membuat akun untuk orang yang sudah terdaftar (NIDN, NIK karyawan, NIM, atau nomor PMB menjadi username), dengan kolom dan
     * hash password sama seperti aplikasi lama. Dosen/tendik yang belum ada di SIAKAD bisa dibuat sekaligus lewat `orang_baru`
     * (kolom sama dengan form tambah dosen/karyawan lama; tendik wajib punya prodi agar bisa login).
     *
     * Level per jenis: dosen DOSEN/PROGDI/DIREKTUR/KEUANGAN, tendik OPERATOR/BAK/PUSTAKA/PANITIA,
     * mahasiswa MAHASISWA, pendaftar MABA. `sandi`: `bawaan` (ID + tanggal lahir 2 digit, rumus lama), `acak` (dikembalikan
     * sekali di `password_sementara`), atau `manual` (`password` min. 8 karakter). Peran RBAC diberikan terpisah lewat
     * POST /v1/rbac/penugasan. Level ADMIN ditolak 409 `level_admin_cli`: hanya lewat CLI
     * `php artisan admin:buat` (akun administrator terpisah).
     *
     * `POST /v1/akun`
     *
     * scope: `akun:write` · hanya token pengguna
     *
     * @param array{jenis: string, id: string, level?: string, email?: string, aktif?: bool, sandi?: string, password?: string, orang_baru?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akun', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ringkasan akun
     *
     * Jumlah akun (dan yang aktif) per jenis, jumlah orang yang belum punya akun, jenis dan level yang boleh dikelola pemanggil.
     *
     * `GET /v1/akun/ringkasan`
     *
     * scope: `akun:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akun/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Orang yang belum punya akun
     *
     * Dosen (m_dosen), tendik (m_karyawan), mahasiswa (m_mahasiswa), atau pendaftar PMB tanpa baris di tabel user. `jenis` wajib; saring `q`, `kode_prodi`, `angkatan` (mahasiswa).
     *
     * `GET /v1/akun/calon`
     *
     * scope: `akun:read` · hanya token pengguna · berhalaman
     *
     * @param array{jenis: string, q?: string, kode_prodi?: string, angkatan?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCalon(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akun/calon', [], $query, null, $options, false, false);
    }

    /**
     * Log kelola akun
     *
     * Siapa membuat, mengubah, menonaktifkan, atau mereset akun apa. Tidak pernah memuat password. Petugas unit melihat aksinya sendiri; saring `username`, `aksi`, `oleh`.
     *
     * `GET /v1/akun/log`
     *
     * scope: `akun:read` · hanya token pengguna · berhalaman
     *
     * @param array{username?: string, aksi?: string, oleh?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akun/log', [], $query, null, $options, false, false);
    }

    /**
     * Buat akun massal
     *
     * Membuat akun berpassword bawaan untuk daftar `id`, atau `"semua": true` untuk semua orang tanpa akun yang cocok saringan `q`/`kode_prodi`/`angkatan`, paling banyak `batas` (maks. 1000) per panggilan. Yang sudah punya akun dilewati. Jawaban: dibuat, dilewati (dengan alasan), sisa.
     *
     * `POST /v1/akun/massal`
     *
     * scope: `akun:write` · hanya token pengguna
     *
     * @param array{jenis: string, id?: list<mixed>, semua?: bool, q?: string, kode_prodi?: string, angkatan?: string, batas?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMassal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akun/massal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Akun pegawai SDM
     *
     * Status akun SIAKAD seorang pegawai (sdm_pegawai.id): ID SIAKAD (NIDN/NIK karyawan), sudah terdaftar di m_dosen/m_karyawan atau belum, dan akunnya. Izin sdm.akun.
     *
     * `GET /v1/akun/pegawai/{id}`
     *
     * scope: `akun:read` · hanya token pengguna
     *
     * @param int|string $id ID pegawai SDM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akun/pegawai/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat akun pegawai SDM
     *
     * Membuat akun dari data pegawai SDM. Bila belum ada di m_dosen/m_karyawan, barisnya dibuat dari data SDM (`kode_prodi` wajib bila SDM belum punya). `id_siakad` diisi bila pegawai belum punya NIDN/NIK karyawan. sdm_pegawai.username ikut diisi. Izin sdm.akun.
     *
     * `POST /v1/akun/pegawai/{id}`
     *
     * scope: `akun:write` · hanya token pengguna
     *
     * @param int|string $id ID pegawai SDM
     * @param array{id_siakad?: string, kode_prodi?: string, level?: string, email?: string, aktif?: bool, sandi?: string, password?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akun/pegawai/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail akun
     *
     * Akun, pegawai SDM yang tertaut, level yang boleh dipilih, dan 20 log terakhir.
     *
     * `GET /v1/akun/{username}`
     *
     * scope: `akun:read` · hanya token pengguna
     *
     * @param int|string $username Username SIAKAD
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akun/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Ubah level/email akun
     *
     * Body `level`, `email`, `nama` (salinan tampilan). Level harus cocok dengan jenis pemilik akun; email ikut disalin ke tabel master pemilik seperti Pengaturan User lama. Lewat POST karena hosting menolak PUT/PATCH.
     *
     * `POST /v1/akun/{username}/ubah`
     *
     * scope: `akun:write` · hanya token pengguna
     *
     * @param int|string $username Username SIAKAD
     * @param array{level?: string, email?: string, nama?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByUsernameUbah(int|string $username, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akun/{username}/ubah', ['username' => $username], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aktifkan/nonaktifkan akun
     *
     * Body `{"aktif": false, "alasan": "..."}`. Akun nonaktif ditolak saat login berikutnya; keluarkan juga sesi SSO-nya dari Pustikom. Akun sendiri tidak bisa dinonaktifkan.
     *
     * `POST /v1/akun/{username}/status`
     *
     * scope: `akun:write` · hanya token pengguna
     *
     * @param int|string $username Username SIAKAD
     * @param array{aktif: bool, alasan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByUsernameStatus(int|string $username, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akun/{username}/status', ['username' => $username], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Reset password akun
     *
     * Body `sandi` (bawaan, acak, manual) dan `password` untuk manual. Password acak dikembalikan sekali di `password_sementara`. Untuk tautan atur password lewat email, pakai SSO (Pustikom: tombol Kirim tautan).
     *
     * `POST /v1/akun/{username}/sandi`
     *
     * scope: `akun:write` · hanya token pengguna
     *
     * @param int|string $username Username SIAKAD
     * @param array{sandi?: string, password?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByUsernameSandi(int|string $username, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akun/{username}/sandi', ['username' => $username], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Catat tautan atur password
     *
     * Dipanggil aplikasi setelah SSO mengirim tautan atur password ke email akun, agar tercatat di log akun. Body `{"terkirim": true}`.
     *
     * `POST /v1/akun/{username}/tautan`
     *
     * scope: `akun:write` · hanya token pengguna
     *
     * @param int|string $username Username SIAKAD
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByUsernameTautan(int|string $username, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akun/{username}/tautan', ['username' => $username], $options['query'] ?? [], $body, $options, false, false);
    }
}
