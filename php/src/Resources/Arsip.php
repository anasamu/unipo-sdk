<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Arsip: Publik, Arsip: Master, Arsip: Surat, Arsip: Disposisi, Arsip: Dokumen, Arsip: File, Arsip: Berkas, Arsip: Berbagi, Arsip: Peminjaman, Arsip: Penyusutan, Arsip: Saya, Arsip: Laporan
 */
final class Arsip extends Resource
{
    /**
     * Cek keaslian surat keluar
     *
     * Tanpa token. Untuk QR code/tautan di surat: menampilkan nomor, tanggal, perihal (disamarkan bila rahasia), unit, penandatangan, dan SHA-256 file utama. `sah=false` bila surat dibatalkan/belum terbit.
     *
     * `GET /v1/arsip/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode kode_verifikasi surat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Pilihan nilai (enum)
     *
     * Sifat, keamanan, status surat/disposisi, instruksi disposisi, akses dokumen, penanda format nomor, jenis file yang diizinkan, dll.
     *
     * `GET /v1/arsip/referensi`
     *
     * scope: `arsip:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Daftar unit pemilik arsip
     *
     * Universitas, fakultas, prodi, unit kerja. `peran_saya` = peran pemilik token di unit itu (admin, pimpinan, sekretaris, arsiparis, staf, pengawas = admin/pimpinan unit induk).
     *
     * `GET /v1/arsip/unit`
     *
     * scope: `arsip:read`
     *
     * @param array{jenis?: string, induk_id?: string, aktif?: string, q?: string, saya?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/unit', [], $query, null, $options, false, false);
    }

    /**
     * Tambah unit
     *
     * `POST /v1/arsip/unit`
     *
     * scope: `arsip:admin`
     *
     * @param array{kode: string, jenis: string, induk_id?: int|null, kode_fakultas?: string|null, kode_prodi?: string|null, nama: string, singkatan?: string, kode_surat?: string, email?: string, telepon?: string, alamat?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnit(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/unit', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat unit dari data SIAKAD
     *
     * Membuat unit universitas, fakultas (m_fakultas), dan prodi (m_program_studi) yang belum ada, unit kerja bagian yang punya aplikasi sendiri (baak, bauk, sdm, lpm, pmb; jenis unit), serta mendaftarkan dekan (m_fakultas.pejabat) dan kaprodi (idd_ketua_prodi) sebagai pimpinan bila akunnya ada. Aman diulang.
     *
     * `POST /v1/arsip/unit/sinkron-siakad`
     *
     * scope: `arsip:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnitSinkronSiakad(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/unit/sinkron-siakad', [], $query, null, $options, false, false);
    }

    /**
     * Detail unit
     *
     * Termasuk unit turunan, dan daftar petugas bila Anda anggota unit.
     *
     * `GET /v1/arsip/unit/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID unit
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah unit
     *
     * `PUT /v1/arsip/unit/{id}`
     *
     * scope: `arsip:admin`
     *
     * @param int|string $id ID unit
     * @param array{kode: string, jenis: string, induk_id?: int|null, kode_fakultas?: string|null, kode_prodi?: string|null, nama: string, singkatan?: string, kode_surat?: string, email?: string, telepon?: string, alamat?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUnitById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/unit/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus unit
     *
     * Ditolak bila unit masih punya arsip atau unit turunan; nonaktifkan saja.
     *
     * `DELETE /v1/arsip/unit/{id}`
     *
     * scope: `arsip:admin`
     *
     * @param int|string $id ID unit
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cari akun untuk disposisi/petugas
     *
     * Akun aktif selain mahasiswa/pendaftar: username, nama, level, jabatan arsip. Hanya untuk admin arsip dan petugas unit.
     *
     * `GET /v1/arsip/pengguna`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{q?: string, username?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengguna(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/pengguna', [], $query, null, $options, false, false);
    }

    /**
     * Petugas unit
     *
     * `GET /v1/arsip/unit/{id}/petugas`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID unit
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitByIdPetugas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/unit/{id}/petugas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah petugas unit
     *
     * Oleh admin unit atau admin arsip. Peran: admin (kelola unit), pimpinan (lihat semua termasuk rahasia, disposisi, tanda tangan, setujui penyusutan), sekretaris (catat surat, nomor, kirim), arsiparis (dokumen, berkas, peminjaman, penyusutan), staf (konsep surat, terima disposisi).
     *
     * `POST /v1/arsip/unit/{id}/petugas`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID unit
     * @param array{unit_id: int|null, username: string, peran: string, jabatan?: string, bisa_tandatangan?: bool, aktif?: bool, mulai?: string|null, selesai?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnitByIdPetugas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/unit/{id}/petugas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah petugas
     *
     * Peran, jabatan, hak tanda tangan, aktif, masa tugas (unit dan username tetap).
     *
     * `PUT /v1/arsip/petugas/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID petugas
     * @param array{unit_id: int|null, username: string, peran: string, jabatan?: string, bisa_tandatangan?: bool, aktif?: bool, mulai?: string|null, selesai?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPetugasById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/petugas/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus petugas
     *
     * `DELETE /v1/arsip/petugas/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID petugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePetugasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/petugas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Klasifikasi arsip dan JRA: daftar
     *
     * Kode klasifikasi bertingkat beserta retensi aktif/inaktif (tahun) dan nasib akhir. Dipakai menghitung jadwal retensi surat/dokumen/berkas.
     *
     * `GET /v1/arsip/klasifikasi`
     *
     * scope: `arsip:read`
     *
     * @param array{q?: string, aktif?: string, induk_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKlasifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/klasifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Klasifikasi arsip dan JRA: tambah
     *
     * `POST /v1/arsip/klasifikasi`
     *
     * scope: `arsip:admin`
     *
     * @param array{induk_id?: int|null, kode: string, nama: string, keterangan?: string, retensi_aktif?: int, retensi_inaktif?: int, nasib_akhir?: string, keterangan_retensi?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKlasifikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/klasifikasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Klasifikasi arsip dan JRA: ubah
     *
     * `PUT /v1/arsip/klasifikasi/{id}`
     *
     * scope: `arsip:admin`
     *
     * @param int|string $id ID
     * @param array{induk_id?: int|null, kode: string, nama: string, keterangan?: string, retensi_aktif?: int, retensi_inaktif?: int, nasib_akhir?: string, keterangan_retensi?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKlasifikasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/klasifikasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Klasifikasi arsip dan JRA: hapus
     *
     * Ditolak bila masih dipakai.
     *
     * `DELETE /v1/arsip/klasifikasi/{id}`
     *
     * scope: `arsip:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKlasifikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/klasifikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis naskah dan dokumen: daftar
     *
     * kelompok=naskah untuk surat (kode dipakai di nomor surat), kelompok=dokumen untuk arsip dokumen (untuk_pemilik, masa berlaku, wajib verifikasi).
     *
     * `GET /v1/arsip/jenis`
     *
     * scope: `arsip:read`
     *
     * @param array{q?: string, aktif?: string, kelompok?: string, pemilik?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Jenis naskah dan dokumen: tambah
     *
     * `POST /v1/arsip/jenis`
     *
     * scope: `arsip:admin`
     *
     * @param array{kelompok: string, kode: string, nama: string, keterangan?: string, untuk_pemilik?: list<mixed>, klasifikasi_id?: int|null, punya_masa_berlaku?: bool, wajib_verifikasi?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenis(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/jenis', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis naskah dan dokumen: ubah
     *
     * `PUT /v1/arsip/jenis/{id}`
     *
     * scope: `arsip:admin`
     *
     * @param int|string $id ID
     * @param array{kelompok: string, kode: string, nama: string, keterangan?: string, untuk_pemilik?: list<mixed>, klasifikasi_id?: int|null, punya_masa_berlaku?: bool, wajib_verifikasi?: bool, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putJenisById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/jenis/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis naskah dan dokumen: hapus
     *
     * Ditolak bila masih dipakai.
     *
     * `DELETE /v1/arsip/jenis/{id}`
     *
     * scope: `arsip:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteJenisById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/jenis/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau nomor berikutnya
     *
     * Tanpa memakai nomor. Format dipilih dari pengaturan paling spesifik (unit+jenis → unit → jenis → umum → bawaan).
     *
     * `GET /v1/arsip/penomoran/pratinjau`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id: int, untuk?: string, jenis_id?: string, klasifikasi_id?: string, tanggal?: string, format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenomoranPratinjau(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/penomoran/pratinjau', [], $query, null, $options, false, false);
    }

    /**
     * Format penomoran: daftar
     *
     * Format nomor surat keluar dan nomor agenda, mis. `{nomor:3}/{kode_unit}/{klasifikasi}/{bulan_romawi}/{tahun}`. Penanda lihat /referensi (token_nomor). unit_id kosong = berlaku untuk semua unit (admin arsip). Hanya milik unit tempat Anda berperan dan yang bersama.
     *
     * `GET /v1/arsip/penomoran`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id?: string, q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenomoran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/penomoran', [], $query, null, $options, false, false);
    }

    /**
     * Format penomoran: tambah
     *
     * Oleh admin/sekretaris/arsiparis unit; tanpa unit_id hanya admin arsip.
     *
     * `POST /v1/arsip/penomoran`
     *
     * scope: `arsip:write`
     *
     * @param array{untuk: string, unit_id?: int|null, jenis_id?: int|null, format: string, reset?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenomoran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/penomoran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Format penomoran: detail
     *
     * `GET /v1/arsip/penomoran/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenomoranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/penomoran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Format penomoran: ubah
     *
     * `PUT /v1/arsip/penomoran/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array{untuk: string, unit_id?: int|null, jenis_id?: int|null, format: string, reset?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPenomoranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/penomoran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Format penomoran: hapus
     *
     * `DELETE /v1/arsip/penomoran/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePenomoranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/penomoran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lokasi simpan fisik: daftar
     *
     * Gedung › ruang › lemari › rak › boks milik unit. Hanya milik unit tempat Anda berperan dan yang bersama.
     *
     * `GET /v1/arsip/lokasi`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id?: string, q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLokasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/lokasi', [], $query, null, $options, false, false);
    }

    /**
     * Lokasi simpan fisik: tambah
     *
     * Oleh admin/sekretaris/arsiparis unit; tanpa unit_id hanya admin arsip.
     *
     * `POST /v1/arsip/lokasi`
     *
     * scope: `arsip:write`
     *
     * @param array{unit_id: int|null, induk_id?: int|null, kode: string, nama: string, jenis?: string, keterangan?: string, kapasitas?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLokasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/lokasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lokasi simpan fisik: detail
     *
     * `GET /v1/arsip/lokasi/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLokasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/lokasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lokasi simpan fisik: ubah
     *
     * `PUT /v1/arsip/lokasi/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array{unit_id: int|null, induk_id?: int|null, kode: string, nama: string, jenis?: string, keterangan?: string, kapasitas?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putLokasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/lokasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lokasi simpan fisik: hapus
     *
     * `DELETE /v1/arsip/lokasi/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLokasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/lokasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Templat surat: daftar
     *
     * HTML dengan penanda {{nama}}; penanda bawaan: unit, unit_singkatan, tanggal, perihal, lampiran. unit_id kosong = templat bersama. Hanya milik unit tempat Anda berperan dan yang bersama.
     *
     * `GET /v1/arsip/template`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id?: string, q?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplate(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/template', [], $query, null, $options, false, false);
    }

    /**
     * Templat surat: tambah
     *
     * Oleh admin/sekretaris/arsiparis unit; tanpa unit_id hanya admin arsip.
     *
     * `POST /v1/arsip/template`
     *
     * scope: `arsip:write`
     *
     * @param array{unit_id?: int|null, jenis_id?: int|null, nama: string, perihal?: string, isi: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplate(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/template', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Templat surat: detail
     *
     * `GET /v1/arsip/template/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplateById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/template/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Templat surat: ubah
     *
     * `PUT /v1/arsip/template/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array{unit_id?: int|null, jenis_id?: int|null, nama: string, perihal?: string, isi: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTemplateById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/template/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Templat surat: hapus
     *
     * `DELETE /v1/arsip/template/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTemplateById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/template/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi templat dengan data
     *
     * Body: `unit_id`, `data` (objek penanda → nilai; nilai di-escape).
     *
     * `POST /v1/arsip/template/{id}/render`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID templat
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplateByIdRender(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/template/{id}/render', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar surat (masuk dan keluar)
     *
     * Hanya surat yang boleh Anda lihat: arsip unit tempat Anda pengelola (rahasia hanya admin/pimpinan), surat yang Anda buat/ajukan/setujui, disposisi untuk Anda/unit Anda, surat yang ditujukan kepada Anda, dan yang dibagikan.
     *
     * `GET /v1/arsip/surat`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{arah?: string, status?: string, unit_id?: string, turunan?: string, sifat?: string, keamanan?: string, jenis_id?: string, klasifikasi_id?: string, berkas_id?: string, dari?: string, sampai?: string, tahun?: string, q?: string, lewat_batas?: string, perlu_tindakan?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/surat', [], $query, null, $options, false, false);
    }

    /**
     * Daftar surat masuk
     *
     * `GET /v1/arsip/surat-masuk`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{status?: string, unit_id?: string, turunan?: string, sifat?: string, keamanan?: string, jenis_id?: string, klasifikasi_id?: string, berkas_id?: string, dari?: string, sampai?: string, tahun?: string, q?: string, lewat_batas?: string, perlu_tindakan?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSuratMasuk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/surat-masuk', [], $query, null, $options, false, false);
    }

    /**
     * Catat surat masuk
     *
     * Oleh admin/pimpinan/sekretaris/arsiparis unit penerima. Nomor agenda dibuat otomatis; retensi dihitung dari klasifikasi (atau klasifikasi bawaan jenis). Unggah hasil pindai lewat POST /surat/{ref}/file.
     *
     * `POST /v1/arsip/surat-masuk`
     *
     * scope: `arsip:write`
     *
     * @param array{jenis_id?: int|null, tanggal_surat?: string|null, perihal: string, ringkasan?: string|null, lampiran?: string|null, sifat?: string, keamanan?: string, media?: string, batas_waktu?: string|null, balasan_untuk_id?: int|null, klasifikasi_id?: int|null, berkas_id?: int|null, lokasi_id?: int|null, unit_id: int, nomor_surat?: string|null, tanggal_diterima?: string|null, pengirim_nama?: string|null, pengirim_instansi?: string|null, pengirim_alamat?: string|null, pengirim_email?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratMasuk(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat-masuk', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar surat keluar
     *
     * `GET /v1/arsip/surat-keluar`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{status?: string, unit_id?: string, turunan?: string, sifat?: string, keamanan?: string, jenis_id?: string, klasifikasi_id?: string, berkas_id?: string, dari?: string, sampai?: string, tahun?: string, q?: string, lewat_batas?: string, perlu_tindakan?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSuratKeluar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/surat-keluar', [], $query, null, $options, false, false);
    }

    /**
     * Buat konsep surat keluar
     *
     * Semua petugas unit (termasuk staf). `template_id` + `data_templat` mengisi `isi` dari templat. `catat_langsung=true` (admin/pimpinan/sekretaris/arsiparis) untuk surat yang sudah ditandatangani di kertas: langsung diberi nomor (atau `nomor_surat` manual) dan dikirim.
     *
     * `POST /v1/arsip/surat-keluar`
     *
     * scope: `arsip:write`
     *
     * @param array{jenis_id?: int|null, tanggal_surat?: string|null, perihal: string, ringkasan?: string|null, lampiran?: string|null, sifat?: string, keamanan?: string, media?: string, batas_waktu?: string|null, balasan_untuk_id?: int|null, klasifikasi_id?: int|null, berkas_id?: int|null, lokasi_id?: int|null, unit_id: int, isi?: string|null, template_id?: int|null, data_templat?: array<string, mixed>, tujuan?: list<mixed>, catat_langsung?: bool, nomor_surat?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratKeluar(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat-keluar', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim surat/permohonan ke unit
     *
     * Dosen, mahasiswa, atau pegawai mengirim surat ke sebuah unit (mis. permohonan ke prodi). Tercatat sebagai surat masuk unit itu dengan pengirim = pengguna token. Lampiran diunggah pengirim lewat POST /surat/{ref}/file selama status masih baru.
     *
     * `POST /v1/arsip/saya/kirim-surat`
     *
     * scope: `arsip:write` · hanya token pengguna
     *
     * @param array{jenis_id?: int|null, tanggal_surat?: string|null, perihal: string, ringkasan?: string|null, lampiran?: string|null, sifat?: string, keamanan?: string, media?: string, batas_waktu?: string|null, balasan_untuk_id?: int|null, klasifikasi_id?: int|null, berkas_id?: int|null, lokasi_id?: int|null, unit_id: int, nomor_surat?: string|null, tanggal_diterima?: string|null, pengirim_nama?: string|null, pengirim_instansi?: string|null, pengirim_alamat?: string|null, pengirim_email?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaKirimSurat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/saya/kirim-surat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail surat
     *
     * Termasuk tujuan, alur persetujuan, pohon disposisi, file (dengan lampiran surat asal untuk surat internal), balasan, riwayat (bagi pengelola), dan `hak` = tindakan yang boleh Anda lakukan. Membuka surat yang ditujukan kepada Anda menandainya dibaca.
     *
     * `GET /v1/arsip/surat/{ref}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSuratByRef(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/surat/{ref}', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Ubah surat
     *
     * Konsep/revisi surat keluar oleh konseptor atau pengelola (termasuk `tujuan`). Surat masuk oleh pengelola. Setelah terkirim/diarsipkan hanya klasifikasi_id, berkas_id, lokasi_id, ringkasan oleh pengelola arsip.
     *
     * `PUT /v1/arsip/surat/{ref}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{jenis_id?: int|null, tanggal_surat?: string|null, perihal: string, ringkasan?: string|null, lampiran?: string|null, sifat?: string, keamanan?: string, media?: string, batas_waktu?: string|null, balasan_untuk_id?: int|null, klasifikasi_id?: int|null, berkas_id?: int|null, lokasi_id?: int|null, unit_id: int, isi?: string|null, template_id?: int|null, data_templat?: array<string, mixed>, tujuan?: list<mixed>, catat_langsung?: bool, nomor_surat?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSuratByRef(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/surat/{ref}', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus surat
     *
     * Hanya konsep/revisi atau surat yang dibatalkan.
     *
     * `DELETE /v1/arsip/surat/{ref}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSuratByRef(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/surat/{ref}', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Ajukan untuk paraf/tanda tangan
     *
     * Body `persetujuan`: [{username, peran: paraf|tandatangan, jabatan?}] berurutan; terakhir harus tandatangan (petugas dengan bisa_tandatangan). Syarat: perihal, isi atau file, dan tujuan terisi.
     *
     * `POST /v1/arsip/surat/{ref}/ajukan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{persetujuan: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefAjukan(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/ajukan', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Paraf/tanda tangani
     *
     * Hanya penyetuju yang sedang mendapat giliran. Tanda tangan mencatat penandatangan dan membuat kode verifikasi. Setelah semua menyetujui status menjadi disetujui.
     *
     * `POST /v1/arsip/surat/{ref}/setujui`
     *
     * scope: `arsip:write` · hanya token pengguna
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefSetujui(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/setujui', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kembalikan untuk revisi
     *
     * Catatan wajib. Status menjadi revisi; konseptor memperbaiki lalu mengajukan ulang.
     *
     * `POST /v1/arsip/surat/{ref}/tolak`
     *
     * scope: `arsip:write` · hanya token pengguna
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefTolak(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/tolak', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Beri nomor surat
     *
     * Otomatis dari format penomoran (atomik, tidak pernah ganda), atau `nomor_surat` manual. Admin/pimpinan/sekretaris unit.
     *
     * `POST /v1/arsip/surat/{ref}/nomor`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefNomor(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/nomor', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim surat keluar
     *
     * Memberi nomor bila belum ada. Tujuan unit menerima salinan surat masuk (dengan nomor agenda) dan notifikasi; tujuan pengguna/dosen/mahasiswa menerima notifikasi dan bisa membuka surat. Tujuan eksternal ditandai terkirim (email/pos oleh frontend). Body opsional: media, tanggal_kirim.
     *
     * `POST /v1/arsip/surat/{ref}/kirim`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefKirim(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/kirim', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tandai surat masuk selesai
     *
     * `POST /v1/arsip/surat/{ref}/selesai`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefSelesai(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/selesai', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arsipkan surat (selesai/terkirim)
     *
     * `POST /v1/arsip/surat/{ref}/arsipkan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefArsipkan(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/arsipkan', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan surat (catatan wajib)
     *
     * `POST /v1/arsip/surat/{ref}/batalkan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefBatalkan(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/batalkan', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pohon disposisi surat
     *
     * `GET /v1/arsip/surat/{ref}/disposisi`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSuratByRefDisposisi(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/surat/{ref}/disposisi', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Disposisikan surat masuk
     *
     * Oleh admin/pimpinan/sekretaris unit penerima, atau penerima disposisi (meneruskan; `induk_id` opsional). Body: tujuan [{username} | {unit_id}], instruksi [teks], catatan, sifat, batas_waktu.
     *
     * `POST /v1/arsip/surat/{ref}/disposisi`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{tujuan: list<mixed>, instruksi?: list<mixed>, catatan?: string|null, sifat?: string, batas_waktu?: string|null, induk_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefDisposisi(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/disposisi', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kotak disposisi saya
     *
     * `kotak=masuk` (untuk saya dan unit saya, bawaan) atau `keluar` (dari saya). Urut: belum selesai dan batas waktu terdekat dulu.
     *
     * `GET /v1/arsip/disposisi`
     *
     * scope: `arsip:read` · hanya token pengguna · berhalaman
     *
     * @param array{kotak?: string, status?: string, aktif?: string, lewat_batas?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDisposisi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/disposisi', [], $query, null, $options, false, false);
    }

    /**
     * Detail disposisi
     *
     * `GET /v1/arsip/disposisi/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID disposisi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDisposisiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/disposisi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tandai dibaca
     *
     * Oleh penerima disposisi (atau petugas unit tujuan). Status surat diperbarui otomatis: diproses, lalu selesai saat semua disposisi selesai.
     *
     * `POST /v1/arsip/disposisi/{id}/baca`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID disposisi
     * @param array{laporan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDisposisiByIdBaca(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/disposisi/{id}/baca', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sedang ditindaklanjuti (laporan opsional)
     *
     * Oleh penerima disposisi (atau petugas unit tujuan). Status surat diperbarui otomatis: diproses, lalu selesai saat semua disposisi selesai.
     *
     * `POST /v1/arsip/disposisi/{id}/proses`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID disposisi
     * @param array{laporan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDisposisiByIdProses(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/disposisi/{id}/proses', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Selesai (laporan tindak lanjut)
     *
     * Oleh penerima disposisi (atau petugas unit tujuan). Status surat diperbarui otomatis: diproses, lalu selesai saat semua disposisi selesai.
     *
     * `POST /v1/arsip/disposisi/{id}/selesai`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID disposisi
     * @param array{laporan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDisposisiByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/disposisi/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kembalikan ke pengirim (alasan wajib di laporan)
     *
     * Oleh penerima disposisi (atau petugas unit tujuan). Status surat diperbarui otomatis: diproses, lalu selesai saat semua disposisi selesai.
     *
     * `POST /v1/arsip/disposisi/{id}/kembalikan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID disposisi
     * @param array{laporan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDisposisiByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/disposisi/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar dokumen
     *
     * Arsip unit dan arsip pribadi dosen/mahasiswa yang boleh Anda lihat. `pemilik=saya` untuk arsip pribadi Anda.
     *
     * `GET /v1/arsip/dokumen`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{pemilik?: string, pemilik_jenis?: string, unit_id?: string, turunan?: string, nidn?: string, nim?: string, kode_prodi?: string, jenis_id?: string, klasifikasi_id?: string, berkas_id?: string, akses?: string, status_verifikasi?: string, status_arsip?: string, tahun?: string, berlaku?: string, hari?: string, sumber?: string, q?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Tambah dokumen
     *
     * Pemilik: tepat satu dari `unit_id`, `nidn`, `nim`, atau `pemilik: "saya"`. Arsip unit oleh pengelola unit; arsip pribadi oleh pemiliknya (status diajukan bila jenis wajib verifikasi) atau petugas yang mencakup prodinya. Integrasi aplikasi (scope arsip:admin): `sumber` + `sumber_ref` membuat kiriman ulang memperbarui dokumen yang sama (200, meta.diperbarui).
     *
     * `POST /v1/arsip/dokumen`
     *
     * scope: `arsip:write`
     *
     * @param array{unit_id?: int|null, nidn?: string|null, nim?: string|null, pemilik?: string, jenis_id?: int|null, nomor?: string|null, judul: string, deskripsi?: string|null, tanggal_dokumen?: string|null, tahun?: int|null, berlaku_mulai?: string|null, berlaku_sampai?: string|null, penerbit?: string|null, kata_kunci?: list<mixed>, akses?: string, media?: string, tingkat?: string, jumlah_lembar?: int|null, klasifikasi_id?: int|null, berkas_id?: int|null, lokasi_id?: int|null, sumber?: string|null, sumber_ref?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arsip pribadi saya
     *
     * Dosen: dokumen dengan NIDN Anda; mahasiswa: dokumen dengan NIM Anda.
     *
     * `GET /v1/arsip/saya/dokumen`
     *
     * scope: `arsip:read` · hanya token pengguna · berhalaman
     *
     * @param array{pemilik_jenis?: string, unit_id?: string, turunan?: string, nidn?: string, nim?: string, kode_prodi?: string, jenis_id?: string, klasifikasi_id?: string, berkas_id?: string, akses?: string, status_verifikasi?: string, status_arsip?: string, tahun?: string, berlaku?: string, hari?: string, sumber?: string, q?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/saya/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Detail dokumen
     *
     * Termasuk data pemilik dari SIAKAD, file, riwayat (bagi pengelola), dan `hak`.
     *
     * `GET /v1/arsip/dokumen/{ref}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByRef(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/dokumen/{ref}', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Ubah dokumen
     *
     * Pemilik tidak bisa mengubah dokumen yang sudah terverifikasi; perubahan oleh pemilik pada dokumen ditolak/diajukan mengajukan ulang verifikasi.
     *
     * `PUT /v1/arsip/dokumen/{ref}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{unit_id?: int|null, nidn?: string|null, nim?: string|null, pemilik?: string, jenis_id?: int|null, nomor?: string|null, judul: string, deskripsi?: string|null, tanggal_dokumen?: string|null, tahun?: int|null, berlaku_mulai?: string|null, berlaku_sampai?: string|null, penerbit?: string|null, kata_kunci?: list<mixed>, akses?: string, media?: string, tingkat?: string, jumlah_lembar?: int|null, klasifikasi_id?: int|null, berkas_id?: int|null, lokasi_id?: int|null, sumber?: string|null, sumber_ref?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDokumenByRef(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/dokumen/{ref}', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus dokumen (soft delete)
     *
     * `DELETE /v1/arsip/dokumen/{ref}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenByRef(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/dokumen/{ref}', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Verifikasi arsip pribadi
     *
     * Body: keputusan terima|tolak, catatan (wajib bila tolak). Oleh petugas (admin/pimpinan/sekretaris/arsiparis) unit universitas, fakultas, atau prodi pemilik. Pemilik mendapat notifikasi.
     *
     * `POST /v1/arsip/dokumen/{ref}/verifikasi`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{keputusan: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByRefVerifikasi(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/dokumen/{ref}/verifikasi', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * File surat
     *
     * `versi=semua` untuk menyertakan versi lama.
     *
     * `GET /v1/arsip/surat/{ref}/file`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{versi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSuratByRefFile(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/surat/{ref}/file', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Unggah file surat
     *
     * multipart/form-data field `berkas`, atau JSON `berkas_base64` + `nama_file`. Opsional: peran (utama|lampiran|bukti), keterangan, menggantikan (id file lama → versi baru). Jenis file dicek dari isinya.
     *
     * `POST /v1/arsip/surat/{ref}/file`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, peran?: string, keterangan?: string, menggantikan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefFile(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/file', ['ref' => $ref], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * File dokumen
     *
     * `versi=semua` untuk menyertakan versi lama.
     *
     * `GET /v1/arsip/dokumen/{ref}/file`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{versi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByRefFile(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/dokumen/{ref}/file', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Unggah file dokumen
     *
     * multipart/form-data field `berkas`, atau JSON `berkas_base64` + `nama_file`. Opsional: peran (utama|lampiran|bukti), keterangan, menggantikan (id file lama → versi baru). Jenis file dicek dari isinya.
     *
     * `POST /v1/arsip/dokumen/{ref}/file`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, peran?: string, keterangan?: string, menggantikan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByRefFile(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/dokumen/{ref}/file', ['ref' => $ref], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * File disposisi (bukti tindak lanjut)
     *
     * `versi=semua` untuk menyertakan versi lama.
     *
     * `GET /v1/arsip/disposisi/{ref}/file`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{versi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDisposisiByRefFile(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/disposisi/{ref}/file', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Unggah file disposisi (bukti tindak lanjut)
     *
     * multipart/form-data field `berkas`, atau JSON `berkas_base64` + `nama_file`. Opsional: peran (utama|lampiran|bukti), keterangan, menggantikan (id file lama → versi baru). Jenis file dicek dari isinya.
     *
     * `POST /v1/arsip/disposisi/{ref}/file`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, peran?: string, keterangan?: string, menggantikan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDisposisiByRefFile(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/disposisi/{ref}/file', ['ref' => $ref], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * File peminjaman
     *
     * `versi=semua` untuk menyertakan versi lama.
     *
     * `GET /v1/arsip/peminjaman/{ref}/file`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{versi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeminjamanByRefFile(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/peminjaman/{ref}/file', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Unggah file peminjaman
     *
     * multipart/form-data field `berkas`, atau JSON `berkas_base64` + `nama_file`. Opsional: peran (utama|lampiran|bukti), keterangan, menggantikan (id file lama → versi baru). Jenis file dicek dari isinya.
     *
     * `POST /v1/arsip/peminjaman/{ref}/file`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, peran?: string, keterangan?: string, menggantikan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByRefFile(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/peminjaman/{ref}/file', ['ref' => $ref], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * File penyusutan (berita acara)
     *
     * `versi=semua` untuk menyertakan versi lama.
     *
     * `GET /v1/arsip/penyusutan/{ref}/file`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{versi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyusutanByRefFile(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/penyusutan/{ref}/file', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Unggah file penyusutan (berita acara)
     *
     * multipart/form-data field `berkas`, atau JSON `berkas_base64` + `nama_file`. Opsional: peran (utama|lampiran|bukti), keterangan, menggantikan (id file lama → versi baru). Jenis file dicek dari isinya.
     *
     * `POST /v1/arsip/penyusutan/{ref}/file`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, peran?: string, keterangan?: string, menggantikan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyusutanByRefFile(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/penyusutan/{ref}/file', ['ref' => $ref], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Metadata file
     *
     * Termasuk versi lain.
     *
     * `GET /v1/arsip/file/{uuid}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $uuid ID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Hapus file
     *
     * Bila yang dihapus versi terbaru, versi sebelumnya menjadi terkini.
     *
     * `DELETE /v1/arsip/file/{uuid}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $uuid ID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Unduh file
     *
     * Respons biner (bukan JSON). `inline=1` untuk menampilkan PDF/gambar di browser. Header X-Checksum-Sha256 berisi sidik file. Setiap unduhan dicatat. Berbagi dengan hak "lihat" tidak bisa mengunduh.
     *
     * `GET /v1/arsip/file/{uuid}/unduh`
     *
     * scope: `arsip:read`
     *
     * @param int|string $uuid ID file
     * @param array{inline?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByUuidUnduh(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/file/{uuid}/unduh', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Daftar berkas (folder arsip)
     *
     * `GET /v1/arsip/berkas`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{unit_id?: string, klasifikasi_id?: string, status?: string, status_arsip?: string, tahun?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerkas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/berkas', [], $query, null, $options, false, false);
    }

    /**
     * Buat berkas
     *
     * Admin/pimpinan/sekretaris/arsiparis unit.
     *
     * `POST /v1/arsip/berkas`
     *
     * scope: `arsip:write`
     *
     * @param array{unit_id: int, nomor_berkas: string, judul: string, uraian?: string|null, tahun_awal?: int|null, tahun_akhir?: int|null, klasifikasi_id?: int|null, lokasi_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkas(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/berkas', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail berkas beserta isinya
     *
     * `GET /v1/arsip/berkas/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerkasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah berkas
     *
     * `PUT /v1/arsip/berkas/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID berkas
     * @param array{unit_id: int, nomor_berkas: string, judul: string, uraian?: string|null, tahun_awal?: int|null, tahun_akhir?: int|null, klasifikasi_id?: int|null, lokasi_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBerkasById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/arsip/berkas/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus berkas kosong
     *
     * `DELETE /v1/arsip/berkas/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBerkasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tutup berkas
     *
     * Menghitung jadwal retensi dari tanggal penutupan (body `tanggal` opsional) dan menerapkannya ke isi berkas.
     *
     * `POST /v1/arsip/berkas/{id}/tutup`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID berkas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkasByIdTutup(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/berkas/{id}/tutup', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buka kembali berkas
     *
     * `POST /v1/arsip/berkas/{id}/buka`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkasByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/berkas/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Masukkan surat/dokumen ke berkas
     *
     * Body: surat_id [..], dokumen_id [..]. Hanya arsip unit yang sama.
     *
     * `POST /v1/arsip/berkas/{id}/masukkan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID berkas
     * @param array{surat_id?: list<mixed>, dokumen_id?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkasByIdMasukkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/berkas/{id}/masukkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keluarkan surat/dokumen dari berkas
     *
     * `POST /v1/arsip/berkas/{id}/keluarkan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID berkas
     * @param array{surat_id?: list<mixed>, dokumen_id?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkasByIdKeluarkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/berkas/{id}/keluarkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar berbagi surat
     *
     * `GET /v1/arsip/surat/{ref}/bagikan`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSuratByRefBagikan(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/surat/{ref}/bagikan', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Bagikan surat
     *
     * Ke pengguna (username) atau unit (unit_id), hak lihat|unduh, berlaku_sampai opsional. Oleh pengelola arsip atau pemilik arsip pribadi.
     *
     * `POST /v1/arsip/surat/{ref}/bagikan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{username?: string|null, unit_id?: int|null, hak?: string, berlaku_sampai?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratByRefBagikan(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/surat/{ref}/bagikan', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar berbagi dokumen
     *
     * `GET /v1/arsip/dokumen/{ref}/bagikan`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByRefBagikan(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/dokumen/{ref}/bagikan', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Bagikan dokumen
     *
     * Ke pengguna (username) atau unit (unit_id), hak lihat|unduh, berlaku_sampai opsional. Oleh pengelola arsip atau pemilik arsip pribadi.
     *
     * `POST /v1/arsip/dokumen/{ref}/bagikan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{username?: string|null, unit_id?: int|null, hak?: string, berlaku_sampai?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByRefBagikan(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/dokumen/{ref}/bagikan', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar berbagi berkas
     *
     * `GET /v1/arsip/berkas/{ref}/bagikan`
     *
     * scope: `arsip:read`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerkasByRefBagikan(int|string $ref, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/berkas/{ref}/bagikan', ['ref' => $ref], $query, null, $options, false, false);
    }

    /**
     * Bagikan berkas
     *
     * Ke pengguna (username) atau unit (unit_id), hak lihat|unduh, berlaku_sampai opsional. Oleh pengelola arsip atau pemilik arsip pribadi.
     *
     * `POST /v1/arsip/berkas/{ref}/bagikan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $ref ID angka atau UUID
     * @param array{username?: string|null, unit_id?: int|null, hak?: string, berlaku_sampai?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkasByRefBagikan(int|string $ref, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/berkas/{ref}/bagikan', ['ref' => $ref], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut berbagi
     *
     * `DELETE /v1/arsip/bagikan/{id}`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID berbagi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBagikanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/arsip/bagikan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar peminjaman
     *
     * Milik Anda sebagai peminjam dan yang perlu Anda proses sebagai pengelola.
     *
     * `GET /v1/arsip/peminjaman`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{status?: string, peran?: string, unit_id?: string, terlambat?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeminjaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/peminjaman', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan peminjaman
     *
     * Body: entitas (surat|dokumen|berkas), entitas_id, jenis (fisik|digital), keperluan, tanggal_pinjam, rencana_kembali. Arsip harus terlihat oleh peminjam. Peminjaman digital yang disetujui langsung memberi akses unduh sampai tanggal kembali.
     *
     * `POST /v1/arsip/peminjaman`
     *
     * scope: `arsip:write` · hanya token pengguna
     *
     * @param array{entitas: string, entitas_id: int, jenis?: string, keperluan: string, tanggal_pinjam?: string|null, rencana_kembali: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjaman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/peminjaman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail peminjaman
     *
     * `GET /v1/arsip/peminjaman/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID peminjaman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeminjamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/peminjaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui
     *
     * Oleh arsiparis/admin/pimpinan unit pengelola; batalkan juga oleh peminjam.
     *
     * `POST /v1/arsip/peminjaman/{id}/setujui`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID peminjaman
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/peminjaman/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tolak (catatan wajib)
     *
     * Oleh arsiparis/admin/pimpinan unit pengelola; batalkan juga oleh peminjam.
     *
     * `POST /v1/arsip/peminjaman/{id}/tolak`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID peminjaman
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/peminjaman/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Serahkan arsip fisik
     *
     * Oleh arsiparis/admin/pimpinan unit pengelola; batalkan juga oleh peminjam.
     *
     * `POST /v1/arsip/peminjaman/{id}/serahkan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID peminjaman
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdSerahkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/peminjaman/{id}/serahkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Catat pengembalian (catatan = kondisi)
     *
     * Oleh arsiparis/admin/pimpinan unit pengelola; batalkan juga oleh peminjam.
     *
     * `POST /v1/arsip/peminjaman/{id}/kembalikan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID peminjaman
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/peminjaman/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan
     *
     * Oleh arsiparis/admin/pimpinan unit pengelola; batalkan juga oleh peminjam.
     *
     * `POST /v1/arsip/peminjaman/{id}/batalkan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID peminjaman
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeminjamanByIdBatalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/peminjaman/{id}/batalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Arsip jatuh tempo penyusutan
     *
     * pemindahan: aktif yang retensi aktifnya lewat; pemusnahan: inaktif lewat dengan nasib musnah; penyerahan: inaktif lewat dengan nasib permanen. Berkas tertutup dihitung sebagai satu kesatuan.
     *
     * `GET /v1/arsip/penyusutan/kandidat`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id: int, jenis: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyusutanKandidat(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/penyusutan/kandidat', [], $query, null, $options, false, false);
    }

    /**
     * Daftar usulan penyusutan
     *
     * `GET /v1/arsip/penyusutan`
     *
     * scope: `arsip:read` · berhalaman
     *
     * @param array{unit_id?: string, jenis?: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyusutan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/penyusutan', [], $query, null, $options, false, false);
    }

    /**
     * Usulkan penyusutan
     *
     * Body: unit_id, jenis, judul, keterangan, item [{entitas, entitas_id, catatan}] dari daftar kandidat. Oleh arsiparis/pimpinan/admin unit.
     *
     * `POST /v1/arsip/penyusutan`
     *
     * scope: `arsip:write`
     *
     * @param array{unit_id: int, jenis: string, judul?: string|null, keterangan?: string|null, item: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyusutan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/penyusutan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail penyusutan
     *
     * `GET /v1/arsip/penyusutan/{id}`
     *
     * scope: `arsip:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyusutanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/penyusutan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui usulan
     *
     * Pimpinan/admin unit, bukan pengusul.
     *
     * `POST /v1/arsip/penyusutan/{id}/setujui`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyusutanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/penyusutan/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tolak usulan
     *
     * Catatan wajib.
     *
     * `POST /v1/arsip/penyusutan/{id}/tolak`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyusutanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/penyusutan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Laksanakan penyusutan
     *
     * nomor_berita_acara wajib untuk pemusnahan/penyerahan; unggah berita acara di POST /penyusutan/{id}/file. Pemindahan → status inaktif; pemusnahan → dimusnahkan dan ISI FILE DIHAPUS PERMANEN (metadata + SHA-256 tetap); penyerahan → diserahkan.
     *
     * `POST /v1/arsip/penyusutan/{id}/laksanakan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyusutanByIdLaksanakan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/penyusutan/{id}/laksanakan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan usulan
     *
     * `POST /v1/arsip/penyusutan/{id}/batalkan`
     *
     * scope: `arsip:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyusutanByIdBatalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/penyusutan/{id}/batalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ringkasan saya
     *
     * Peran di unit, NIDN/NIM, dan jumlah tugas: disposisi aktif/lewat batas, menunggu persetujuan, konsep, notifikasi belum dibaca, dokumen pribadi.
     *
     * `GET /v1/arsip/saya`
     *
     * scope: `arsip:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/saya', [], $query, null, $options, false, false);
    }

    /**
     * Notifikasi
     *
     * `GET /v1/arsip/saya/notifikasi`
     *
     * scope: `arsip:read` · hanya token pengguna · berhalaman
     *
     * @param array{belum_dibaca?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaNotifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/saya/notifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Tandai notifikasi dibaca
     *
     * Body `id`: [..]; kosong = semua.
     *
     * `POST /v1/arsip/saya/notifikasi/baca`
     *
     * scope: `arsip:read` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaNotifikasiBaca(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/arsip/saya/notifikasi/baca', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dasbor arsip
     *
     * Surat masuk/keluar per bulan, per status, per klasifikasi, kinerja disposisi (rata-rata jam selesai), dokumen kedaluwarsa, retensi jatuh tempo, peminjaman aktif. Tanpa unit_id = semua unit yang Anda kelola.
     *
     * `GET /v1/arsip/laporan/ringkasan`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id?: string, tahun?: string, turunan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/laporan/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Buku agenda surat
     *
     * Untuk dicetak. Perihal surat rahasia disamarkan bagi selain admin/pimpinan.
     *
     * `GET /v1/arsip/laporan/agenda`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id: int, arah?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanAgenda(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/laporan/agenda', [], $query, null, $options, false, false);
    }

    /**
     * Daftar arsip aktif/inaktif (DAA/DAI)
     *
     * Berkas dan arsip lepas per klasifikasi dengan kurun waktu, jumlah, lokasi, dan jadwal retensi.
     *
     * `GET /v1/arsip/laporan/daftar-arsip`
     *
     * scope: `arsip:read`
     *
     * @param array{unit_id: int, status_arsip?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanDaftarArsip(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/laporan/daftar-arsip', [], $query, null, $options, false, false);
    }

    /**
     * Pengingat
     *
     * Disposisi lewat batas, surat mendekati batas waktu, dokumen akan kedaluwarsa, peminjaman terlambat, retensi jatuh tempo.
     *
     * `GET /v1/arsip/laporan/pengingat`
     *
     * scope: `arsip:read`
     *
     * @param array{hari?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanPengingat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/laporan/pengingat', [], $query, null, $options, false, false);
    }

    /**
     * Pencarian gabungan
     *
     * Surat, dokumen, dan berkas yang boleh Anda lihat.
     *
     * `GET /v1/arsip/cari`
     *
     * scope: `arsip:read`
     *
     * @param array{q: string, per_jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCari(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/cari', [], $query, null, $options, false, false);
    }

    /**
     * Log audit
     *
     * Semua perubahan dan unduhan. Admin arsip.
     *
     * `GET /v1/arsip/log`
     *
     * scope: `arsip:admin` · berhalaman
     *
     * @param array{entitas?: string, entitas_id?: string, aksi?: string, oleh?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/arsip/log', [], $query, null, $options, false, false);
    }
}
