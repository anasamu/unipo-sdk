<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Mahasiswa, KRS, Nilai, Jadwal, Presensi, Keuangan, Lulusan
 */
final class Mahasiswa extends Resource
{
    /**
     * Cari mahasiswa
     *
     * Token dosen otomatis dibatasi ke mahasiswa bimbingannya; token mahasiswa tidak boleh memakai endpoint ini.
     *
     * `GET /v1/mahasiswa`
     *
     * scope: `mahasiswa:read` · berhalaman
     *
     * @param array{prodi?: string, angkatan?: string, semester_masuk?: string, status?: string, nidn_pa?: string, kelas?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Profil mahasiswa
     *
     * Objek `pribadi` (NIK, tanggal lahir, alamat, kontak) hanya ada bila token punya scope `mahasiswa:pii`.
     *
     * `GET /v1/mahasiswa/{nim}`
     *
     * scope: `mahasiswa:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Riwayat status per semester dan cuti
     *
     * Status: A aktif, N non-aktif, C cuti (t_mahasiswa_status).
     *
     * `GET /v1/mahasiswa/{nim}/status-semester`
     *
     * scope: `mahasiswa:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimStatusSemester(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/status-semester', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * KRS mahasiswa
     *
     * Default periode aktif. `tahun_id=semua` untuk semua periode. `status_krs` T = disetujui.
     *
     * `GET /v1/mahasiswa/{nim}/krs`
     *
     * scope: `krs:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimKrs(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/krs', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Ambil (simpan) KRS
     *
     * Hanya token pengguna mahasiswa itu sendiri, pada periode aktif. Kirim `id` mata kuliah dan `idj` kelas dari
     * `/krs/penawaran`. Server menghitung ulang batas SKS dan menolak mata kuliah/kelas yang tidak ditawarkan,
     * belum memenuhi prasyarat, atau penuh. Penyimpanan memakai logika yang sama dengan halaman web.
     *
     * `POST /v1/mahasiswa/{nim}/krs`
     *
     * scope: `krs:write` · hanya token pengguna
     *
     * @param int|string $nim NIM
     * @param array{mata_kuliah: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByNimKrs(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mahasiswa/{nim}/krs', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mata kuliah yang bisa diambil (form Ambil KRS)
     *
     * Hanya token pengguna mahasiswa itu sendiri. Menjalankan pemeriksaan yang sama dengan halaman Ambil KRS:
     * status aktif, kelas, persetujuan PA, masa KRS, administrasi/pembayaran, cuti, batas SKS, dan prasyarat.
     * Bila `boleh_ambil` false, `alasan` dan `pesan` menjelaskan sebabnya.
     *
     * `GET /v1/mahasiswa/{nim}/krs/penawaran`
     *
     * scope: `krs:write` · hanya token pengguna
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimKrsPenawaran(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/krs/penawaran', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Pesan konsultasi KRS dengan dosen PA
     *
     * `GET /v1/mahasiswa/{nim}/krs/pesan`
     *
     * scope: `krs:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimKrsPesan(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/krs/pesan', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kirim pesan konsultasi KRS
     *
     * Hanya bila fitur konsultasi PA aktif untuk periode/prodi mahasiswa.
     *
     * `POST /v1/mahasiswa/{nim}/krs/pesan`
     *
     * scope: `krs:write` · hanya token pengguna
     *
     * @param int|string $nim NIM
     * @param array{pesan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByNimKrsPesan(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/mahasiswa/{nim}/krs/pesan', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KHS dan IPS/IPK
     *
     * Dengan `tahun_id`: KHS satu periode. Tanpa `tahun_id`: semua periode. Nilai, IPS, dan IPK dihitung dengan fungsi
     * yang sama dengan halaman KHS (nilai yang belum divalidasi tidak ditampilkan: `nilai_ditampilkan` false).
     *
     * `GET /v1/mahasiswa/{nim}/khs`
     *
     * scope: `nilai:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimKhs(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/khs', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Transkrip (nilai terbaik per mata kuliah) dan IPK
     *
     * Sama dengan halaman transkrip sementara.
     *
     * `GET /v1/mahasiswa/{nim}/transkrip`
     *
     * scope: `nilai:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimTranskrip(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/transkrip', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Jadwal kuliah mahasiswa
     *
     * Dari KRS periode yang diminta (default periode aktif).
     *
     * `GET /v1/mahasiswa/{nim}/jadwal`
     *
     * scope: `jadwal:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimJadwal(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/jadwal', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Presensi mahasiswa
     *
     * Rekap per mata kuliah dan detail pertemuan.
     *
     * `GET /v1/mahasiswa/{nim}/presensi`
     *
     * scope: `presensi:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, kode_mk?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimPresensi(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/presensi', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Tagihan dan pembayaran mahasiswa
     *
     * Sama dengan halaman Riwayat Keuangan: tagihan, dibayar, potongan, dan sisa per jenis biaya per periode.
     *
     * `GET /v1/mahasiswa/{nim}/keuangan`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimKeuangan(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/keuangan', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Tugas akhir/skripsi
     *
     * Judul, jadwal seminar/ujian, pembimbing, penguji, dan nilai.
     *
     * `GET /v1/mahasiswa/{nim}/tugas-akhir`
     *
     * scope: `lulusan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimTugasAkhir(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/tugas-akhir', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Status kelulusan/keluar dan pendaftaran wisuda
     *
     * `GET /v1/mahasiswa/{nim}/kelulusan`
     *
     * scope: `lulusan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByNimKelulusan(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/mahasiswa/{nim}/kelulusan', ['nim' => $nim], $query, null, $options, false, false);
    }
}
