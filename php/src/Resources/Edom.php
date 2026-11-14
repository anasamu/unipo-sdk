<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * EDOM: Soal, EDOM: Pengisian, EDOM: Hasil
 */
final class Edom extends Resource
{
    /**
     * Hak akses EDOM saya
     *
     * Pengelola (ADMIN, BAK, PROGDI, OPERATOR, peran edom:kelola), mahasiswa, atau dosen; tahun aktif; pilihan jawaban (A-E, atau A-D bila kampus memakai 4 pilihan).
     *
     * `GET /v1/edom/saya`
     *
     * scope: `edom:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/saya', [], $query, null, $options, false, false);
    }

    /**
     * Soal EDOM prodi per periode
     *
     * m_kuisioner kuisioner = D. Mahasiswa melihat soal prodinya.
     *
     * `GET /v1/edom/soal`
     *
     * scope: `edom:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSoal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/soal', [], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah soal (form EDOM kustom)
     *
     * Body: {"idk" (untuk ubah), "pertanyaan", "pilihan": {"A","B","C","D","E"}} (atau pil_a..pil_e), "prodi", "tahun_id"}. Langkah simpan menu Kuisioner (m_log).
     *
     * `POST /v1/edom/soal`
     *
     * scope: `edom:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSoal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/edom/soal', [], $query, null, $options, false, false);
    }

    /**
     * Salin soal dari periode lain
     *
     * Body: {"dari": "20251", "tahun_id" (tujuan), "prodi"}. Pertanyaan yang sudah ada di periode tujuan dilewati.
     *
     * `POST /v1/edom/soal/salin`
     *
     * scope: `edom:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSoalSalin(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/edom/soal/salin', [], $query, null, $options, false, false);
    }

    /**
     * Hapus soal
     *
     * Menu lama ikut menghapus jawaban soal itu; ditolak 409 bila sudah ada jawaban kecuali {"paksa": true}.
     *
     * `POST /v1/edom/soal/{idk}/hapus`
     *
     * scope: `edom:write`
     *
     * @param int|string $idk m_kuisioner.idk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSoalByIdkHapus(int|string $idk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/edom/soal/{idk}/hapus', ['idk' => $idk], $query, null, $options, false, false);
    }

    /**
     * Daftar mata kuliah yang dinilai
     *
     * KRS disetujui mahasiswa pada periode: dosen pengampu (jadwal), jumlah soal terjawab, selesai. Pengelola: ?nim=.
     *
     * `GET /v1/edom/isi`
     *
     * scope: `edom:read`
     *
     * @param array{nim?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIsi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/isi', [], $query, null, $options, false, false);
    }

    /**
     * Form EDOM satu mata kuliah
     *
     * Soal + jawaban tersimpan + saran.
     *
     * `GET /v1/edom/isi/{idkrs}`
     *
     * scope: `edom:read`
     *
     * @param int|string $idkrs t_mahasiswa_krs.idkrs
     * @param array{nim?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIsiByIdkrs(int|string $idkrs, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/isi/{idkrs}', ['idkrs' => $idkrs], $query, null, $options, false, false);
    }

    /**
     * Isi EDOM satu mata kuliah
     *
     * Mahasiswa, KRS periode aktif. Body: {"jawaban": {"<idk>": "A"}, "saran"}; semua soal wajib dijawab. Langkah op=Input/Update halaman isi kuisioner: satu baris m_jawab_kuisioner per soal (diubah bila sudah ada), dosen dari jadwal KRS, saran di t_mahasiswa_krs.
     *
     * `POST /v1/edom/isi/{idkrs}`
     *
     * scope: `edom:write`
     *
     * @param int|string $idkrs t_mahasiswa_krs.idkrs
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIsiByIdkrs(int|string $idkrs, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/edom/isi/{idkrs}', ['idkrs' => $idkrs], $query, null, $options, false, false);
    }

    /**
     * Evaluasi per dosen
     *
     * Responden, jumlah jawaban, rata-rata skor (A = 5 ... E = 1), indeks persen, kategori, jumlah MK. Pengelola.
     *
     * `GET /v1/edom/hasil/dosen`
     *
     * scope: `edom:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHasilDosen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/hasil/dosen', [], $query, null, $options, false, false);
    }

    /**
     * Evaluasi satu dosen
     *
     * Ringkasan, per kelas, per soal. Dosen dapat melihat miliknya sendiri (semua prodi); pengelola dibatasi prodinya.
     *
     * `GET /v1/edom/hasil/dosen/{nidn}`
     *
     * scope: `edom:read`
     *
     * @param int|string $nidn NIDN
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHasilDosenByNidn(int|string $nidn, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/hasil/dosen/{nidn}', ['nidn' => $nidn], $query, null, $options, false, false);
    }

    /**
     * Evaluasi per kelas
     *
     * Per mata kuliah + kelas KRS + dosen: peserta, responden, partisipasi, rata-rata, indeks.
     *
     * `GET /v1/edom/hasil/kelas`
     *
     * scope: `edom:read`
     *
     * @param array{nidn?: string, kode_mk?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHasilKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/hasil/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Sebaran jawaban per soal
     *
     * Jumlah dan persen A-E per soal, rata-rata.
     *
     * `GET /v1/edom/hasil/soal`
     *
     * scope: `edom:read`
     *
     * @param array{nidn?: string, kode_mk?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHasilSoal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/hasil/soal', [], $query, null, $options, false, false);
    }

    /**
     * Rekapitulasi EDOM
     *
     * Ringkasan prodi, per soal, dan per dosen.
     *
     * `GET /v1/edom/rekap`
     *
     * scope: `edom:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Monitoring pengisian
     *
     * Per mahasiswa: MK KRS disetujui vs MK yang sudah diisi; meta.ringkasan = jumlah lengkap/sebagian/belum.
     *
     * `GET /v1/edom/monitoring`
     *
     * scope: `edom:read` · berhalaman
     *
     * @param array{status?: string, q?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMonitoring(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/edom/monitoring', [], $query, null, $options, false, false);
    }
}
