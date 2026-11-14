<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Dasbor: Ringkasan, Dasbor: Perkuliahan, Dasbor: Kehadiran, Dasbor: Outcome, Dasbor: Peringatan dini
 */
final class Dasbor extends Resource
{
    /**
     * Dasbor pimpinan
     *
     * Per prodi: mahasiswa aktif, status semester (aktif/cuti/nonaktif), pengisi KRS dan rata-rata SKS, mahasiswa baru, lulusan dan rata IPK, jumlah dosen dan rasio, EWS tinggi; ditambah ringkasan modul pusat data (kerja sama, prestasi, MBKM, beasiswa, layanan, helpdesk, repositori, aset, LPPM, SDM, serapan anggaran). Untuk ADMIN, BAK, DIREKTUR, WD1, PROGDI (prodinya), KEUANGAN.
     *
     * `GET /v1/dasbor/ringkas`
     *
     * scope: `dasbor:read`
     *
     * @param array{tahun_id?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/ringkas', [], $query, null, $options, false, false);
    }

    /**
     * Tren per semester
     *
     * Pengisi KRS, mahasiswa baru, lulusan, dan rata-rata IPS untuk N semester terakhir.
     *
     * `GET /v1/dasbor/tren`
     *
     * scope: `dasbor:read`
     *
     * @param array{semester?: int, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTren(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/tren', [], $query, null, $options, false, false);
    }

    /**
     * Monitoring perkuliahan
     *
     * Realisasi pertemuan per semester dari jadwal (t_jadwal) dan presensi dosen (t_dosen_presensi): total kelas per status (belum_mulai, tertinggal, sesuai, tuntas), persen realisasi, rata kehadiran mahasiswa, per prodi, dan dosen dengan kelas tertinggal. Rencana pertemuan = m_mata_kuliah.pertemuan, atau parameter rencana (bawaan 16). Pertemuan seharusnya = rencana x progres semester (m_tahun kuliah_mulai..kuliah_selesai).
     *
     * `GET /v1/dasbor/perkuliahan`
     *
     * scope: `dasbor:read`
     *
     * @param array{tahun_id?: string, kode_prodi?: string, rencana?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPerkuliahan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/perkuliahan', [], $query, null, $options, false, false);
    }

    /**
     * Realisasi per kelas
     *
     * Per kelas: dosen, rencana/terlaksana/seharusnya, pertemuan terakhir, peserta KRS, nilai terisi, kehadiran mahasiswa, status.
     *
     * `GET /v1/dasbor/perkuliahan/kelas`
     *
     * scope: `dasbor:read` · berhalaman
     *
     * @param array{tahun_id?: string, kode_prodi?: string, status?: string, nidn?: string, q?: string, rencana?: int, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPerkuliahanKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/perkuliahan/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Analitik kehadiran mahasiswa
     *
     * Dari t_mahasiswa_presensi: jumlah hadir/izin/sakit/alpa dan persen hadir, sebaran mahasiswa per rentang persen hadir, jumlah di bawah ambang, per prodi, per minggu, dan per hari.
     *
     * `GET /v1/dasbor/kehadiran`
     *
     * scope: `dasbor:read`
     *
     * @param array{tahun_id?: string, kode_prodi?: string, ambang?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKehadiran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/kehadiran', [], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa kehadiran rendah
     *
     * Mahasiswa dengan persen hadir di bawah ambang, terendah dahulu, dengan rincian per mata kuliah.
     *
     * `GET /v1/dasbor/kehadiran/mahasiswa`
     *
     * scope: `dasbor:read` · berhalaman
     *
     * @param array{tahun_id?: string, kode_prodi?: string, ambang?: int, kode_mk?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKehadiranMahasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/kehadiran/mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Monitoring outcome lulusan
     *
     * Per tahun lulus: jumlah lulusan, rata IPK, persen IPK >= 3,51, rata masa studi (semester), persen tepat waktu; hasil tracer alumni (responden selesai menurut tahun lulus) (persen bekerja/wiraswasta/studi lanjut/mencari kerja, waktu tunggu, keselarasan bidang); dan capaian IKU 1.
     *
     * `GET /v1/dasbor/outcome`
     *
     * scope: `dasbor:read`
     *
     * @param array{kode_prodi?: string, tahun?: int, jumlah_tahun?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOutcome(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/outcome', [], $query, null, $options, false, false);
    }

    /**
     * Hitung ulang EWS
     *
     * Menghitung indikator mahasiswa aktif (IPS/IPK rendah, kehadiran, tidak KRS setelah masa KRS, nonaktif/cuti semester lalu, tunggakan, masa studi, SKS tertinggal) dan memperbarui daftar mahasiswa berisiko. Dosen PA mendapat notifikasi untuk kasus baru sedang/tinggi. Body opsional: tahun_id, kode_prodi. Pengelola.
     *
     * `POST /v1/dasbor/ews/hitung`
     *
     * scope: `dasbor:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEwsHitung(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dasbor/ews/hitung', [], $query, null, $options, false, false);
    }

    /**
     * Aturan EWS: daftar
     *
     * Indikator mahasiswa berisiko: ambang dan bobot skor. Skor >= 5 = tinggi, >= 3 = sedang. Kode indikator tetap; ubah ambang, bobot, atau nonaktifkan. Hanya pengelola modul.
     *
     * `GET /v1/dasbor/ews-aturan`
     *
     * scope: `dasbor:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEwsAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/ews-aturan', [], $query, null, $options, false, false);
    }

    /**
     * Aturan EWS: detail
     *
     * Indikator mahasiswa berisiko: ambang dan bobot skor. Skor >= 5 = tinggi, >= 3 = sedang. Kode indikator tetap; ubah ambang, bobot, atau nonaktifkan. Hanya pengelola modul.
     *
     * `GET /v1/dasbor/ews-aturan/{id}`
     *
     * scope: `dasbor:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEwsAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/ews-aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan EWS: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/dasbor/ews-aturan/{id}`
     *
     * scope: `dasbor:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nama: string, ambang?: float|int, bobot?: int, aktif?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putEwsAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/dasbor/ews-aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mahasiswa berisiko: daftar
     *
     * Hasil hitung EWS per semester (POST /dasbor/ews/hitung atau perintah `php artisan ews:hitung`). Dosen PA melihat mahasiswa bimbingannya dan mencatat tindak lanjut; pengelola melihat semua (PROGDI terbatas prodinya). Hanya pengelola modul.
     *
     * `GET /v1/dasbor/ews`
     *
     * scope: `dasbor:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, tahun_id?: string, nim?: string, kode_prodi?: string, dosen_pa?: string, tingkat?: string, status?: string, ditangani_oleh?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEws(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/ews', [], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa berisiko: detail
     *
     * Hasil hitung EWS per semester (POST /dasbor/ews/hitung atau perintah `php artisan ews:hitung`). Dosen PA melihat mahasiswa bimbingannya dan mencatat tindak lanjut; pengelola melihat semua (PROGDI terbatas prodinya). Hanya pengelola modul.
     *
     * `GET /v1/dasbor/ews/{id}`
     *
     * scope: `dasbor:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEwsById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dasbor/ews/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa berisiko: Catat tindak lanjut
     *
     * Pengelola modul. Status harus baru/ditindaklanjuti, menjadi ditindaklanjuti.
     *
     * `POST /v1/dasbor/ews/{id}/tindak-lanjut`
     *
     * scope: `dasbor:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tindak_lanjut: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEwsByIdTindakLanjut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dasbor/ews/{id}/tindak-lanjut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mahasiswa berisiko: Tandai selesai
     *
     * Pengelola modul. Status harus baru/ditindaklanjuti, menjadi selesai.
     *
     * `POST /v1/dasbor/ews/{id}/selesai`
     *
     * scope: `dasbor:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEwsByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dasbor/ews/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa berisiko: Abaikan
     *
     * Pengelola modul. Status harus baru/ditindaklanjuti, menjadi diabaikan.
     *
     * `POST /v1/dasbor/ews/{id}/abaikan`
     *
     * scope: `dasbor:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEwsByIdAbaikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dasbor/ews/{id}/abaikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
