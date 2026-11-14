<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * IKU: Dasbor, IKU: Pengaturan, IKU: Bukti
 */
final class Iku extends Resource
{
    /**
     * Dasbor IKU
     *
     * Tanpa prodi = IKU institusi (pengelola, DIREKTUR, WD1) beserta capaian tiap prodi; prodi=<kode> = IKU prodi. PROGDI otomatis prodinya. Tiap indikator: nilai, pembilang/penyebut, target (target prodi, atau target institusi bila kosong), status tercapai/mendekati (>= 80% target)/belum, tren 5 tahun.
     *
     * `GET /v1/iku/dasbor`
     *
     * scope: `iku:read`
     *
     * @param array{prodi?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDasbor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/dasbor', [], $query, null, $options, false, false);
    }

    /**
     * Dasbor IKU program studi
     *
     * `GET /v1/iku/dasbor/prodi/{kode}`
     *
     * scope: `iku:read`
     *
     * @param int|string $kode Kode prodi
     * @param array{tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDasborProdiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/dasbor/prodi/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Rincian capaian
     *
     * Komponen hitung dan contoh subjek (maks. 100: NIM, NIDN, prodi, mata kuliah, luaran).
     *
     * `GET /v1/iku/capaian/{indikator}`
     *
     * scope: `iku:read`
     *
     * @param int|string $indikator ID indikator
     * @param array{prodi?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCapaianByIndikator(int|string $indikator, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/capaian/{indikator}', ['indikator' => $indikator], $query, null, $options, false, false);
    }

    /**
     * Unduh data IKU
     *
     * Semua capaian tahun itu (institusi dan prodi dalam kewenangan). format=csv untuk berkas (pemisah titik koma, desimal koma).
     *
     * `GET /v1/iku/unduh`
     *
     * scope: `iku:read`
     *
     * @param array{format?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnduh(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/unduh', [], $query, null, $options, false, false);
    }

    /**
     * Metode penghitung
     *
     * Daftar penghitung otomatis dan sumber datanya.
     *
     * `GET /v1/iku/metode`
     *
     * scope: `iku:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMetode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/metode', [], $query, null, $options, false, false);
    }

    /**
     * Hitung ulang capaian
     *
     * Pengelola. Body {"tahun"?, "prodi"?, "indikator_id"?, "timpa_manual"?}. Tanpa prodi: institusi dan semua prodi. Capaian dikunci, indikator manual, dan capaian yang diisi manual dilewati (timpa_manual=true untuk kembali ke hasil otomatis). Juga lewat cron `php artisan iku:hitung`.
     *
     * `POST /v1/iku/hitung`
     *
     * scope: `iku:write`
     *
     * @param array{tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHitung(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/iku/hitung', [], $query, null, $options, false, false);
    }

    /**
     * Isi capaian manual
     *
     * Pengelola. Body {"indikator_id", "tahun", "prodi"? (kosong = institusi), "nilai"? atau "pembilang"+"penyebut", "catatan"?}. Menggantikan hasil otomatis; hitung ulang dan cron melewatinya sampai dihitung dengan timpa_manual=true.
     *
     * `POST /v1/iku/capaian/manual`
     *
     * scope: `iku:write`
     *
     * @param array{tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianManual(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/iku/capaian/manual', [], $query, null, $options, false, false);
    }

    /**
     * Kunci capaian final
     *
     * ADMIN. Body {"tahun", "kunci"?: true|false, "prodi"?}. Capaian terkunci tidak dihitung ulang.
     *
     * `POST /v1/iku/capaian/kunci`
     *
     * scope: `iku:admin`
     *
     * @param array{tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianKunci(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/iku/capaian/kunci', [], $query, null, $options, false, false);
    }

    /**
     * Indikator IKU: daftar
     *
     * IKU 1-8 sudah terisi (Kepmendikbudristek 210/M/2023) beserta penghitungnya. metode: iku1_tracer, iku2_luar_kampus, iku3_dosen_luar, iku4_kualifikasi, iku5_luaran, iku6_kerjasama, iku7_kelas, iku8_internasional, manual. parameter (JSON) mengatur ambang penghitung, mis. IKU2 {"sks_minimal": 20}. Indikator tambahan memakai metode manual. Semua pemilik token ber-scope iku:read.
     *
     * `GET /v1/iku/indikator`
     *
     * scope: `iku:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, satuan?: string, metode?: string, per_prodi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIndikator(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/indikator', [], $query, null, $options, false, false);
    }

    /**
     * Indikator IKU: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/iku/indikator`
     *
     * scope: `iku:write`
     *
     * @param array{kode: string, nama: string, deskripsi?: string, satuan?: string, metode?: string, parameter?: array<string, mixed>, dasar_hukum?: string, per_prodi?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIndikator(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/iku/indikator', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Indikator IKU: detail
     *
     * IKU 1-8 sudah terisi (Kepmendikbudristek 210/M/2023) beserta penghitungnya. metode: iku1_tracer, iku2_luar_kampus, iku3_dosen_luar, iku4_kualifikasi, iku5_luaran, iku6_kerjasama, iku7_kelas, iku8_internasional, manual. parameter (JSON) mengatur ambang penghitung, mis. IKU2 {"sks_minimal": 20}. Indikator tambahan memakai metode manual. Semua pemilik token ber-scope iku:read.
     *
     * `GET /v1/iku/indikator/{id}`
     *
     * scope: `iku:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIndikatorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/indikator/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Indikator IKU: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/iku/indikator/{id}`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, deskripsi?: string, satuan?: string, metode?: string, parameter?: array<string, mixed>, dasar_hukum?: string, per_prodi?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putIndikatorById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/iku/indikator/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Indikator IKU: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/iku/indikator/{id}`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteIndikatorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/iku/indikator/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Target IKU: daftar
     *
     * Target per indikator per tahun. kode_prodi kosong = target institusi; target prodi yang tidak diisi memakai target institusi di dasbor. Semua pemilik token ber-scope iku:read.
     *
     * `GET /v1/iku/target`
     *
     * scope: `iku:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, indikator_id?: string, tahun?: string, kode_prodi?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTarget(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/target', [], $query, null, $options, false, false);
    }

    /**
     * Target IKU: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/iku/target`
     *
     * scope: `iku:write`
     *
     * @param array{indikator_id: int, tahun: int, kode_prodi?: string, target: float|int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTarget(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/iku/target', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Target IKU: detail
     *
     * Target per indikator per tahun. kode_prodi kosong = target institusi; target prodi yang tidak diisi memakai target institusi di dasbor. Semua pemilik token ber-scope iku:read.
     *
     * `GET /v1/iku/target/{id}`
     *
     * scope: `iku:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTargetById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/target/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Target IKU: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/iku/target/{id}`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{indikator_id: int, tahun: int, kode_prodi?: string, target: float|int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTargetById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/iku/target/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Target IKU: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/iku/target/{id}`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTargetById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/iku/target/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bukti capaian IKU: daftar
     *
     * Capaian yang belum tercatat di modul SIAKAD lain, mis. dosen berkegiatan di PT lain/praktisi (IKU3/4, jenis_subjek dosen + NIDN), mahasiswa (IKU2, NIM), luaran (IKU5), prodi (IKU6/8, kode prodi), mata kuliah (IKU7, "<kode_prodi>:<kode_mk>"). Bisa diberi lampiran. Yang berstatus disetujui ikut dihitung saat POST /v1/iku/hitung. Hanya pengelola modul.
     *
     * `GET /v1/iku/bukti`
     *
     * scope: `iku:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, indikator_id?: string, kode_prodi?: string, jenis_subjek?: string, status?: string, tahun?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBukti(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/bukti', [], $query, null, $options, false, false);
    }

    /**
     * Bukti capaian IKU: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/iku/bukti`
     *
     * scope: `iku:write`
     *
     * @param array{indikator_id: int, tahun: int, kode_prodi?: string, jenis_subjek: string, subjek: string, nama?: string, kategori?: string, keterangan?: string, tautan?: string, status?: string, catatan_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBukti(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/iku/bukti', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bukti capaian IKU: detail
     *
     * Capaian yang belum tercatat di modul SIAKAD lain, mis. dosen berkegiatan di PT lain/praktisi (IKU3/4, jenis_subjek dosen + NIDN), mahasiswa (IKU2, NIM), luaran (IKU5), prodi (IKU6/8, kode prodi), mata kuliah (IKU7, "<kode_prodi>:<kode_mk>"). Bisa diberi lampiran. Yang berstatus disetujui ikut dihitung saat POST /v1/iku/hitung. Hanya pengelola modul.
     *
     * `GET /v1/iku/bukti/{id}`
     *
     * scope: `iku:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBuktiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/bukti/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bukti capaian IKU: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/iku/bukti/{id}`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{indikator_id: int, tahun: int, kode_prodi?: string, jenis_subjek: string, subjek: string, nama?: string, kategori?: string, keterangan?: string, tautan?: string, status?: string, catatan_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBuktiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/iku/bukti/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bukti capaian IKU: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/iku/bukti/{id}`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBuktiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/iku/bukti/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bukti capaian IKU: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/iku/bukti/{id}/berkas`
     *
     * scope: `iku:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBuktiByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/bukti/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bukti capaian IKU: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/iku/bukti/{id}/berkas`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBuktiByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/iku/bukti/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Bukti capaian IKU: unduh lampiran
     *
     * `GET /v1/iku/bukti/{id}/berkas/{uuid}`
     *
     * scope: `iku:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBuktiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/iku/bukti/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Bukti capaian IKU: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/iku/bukti/{id}/berkas/{uuid}`
     *
     * scope: `iku:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBuktiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/iku/bukti/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }
}
