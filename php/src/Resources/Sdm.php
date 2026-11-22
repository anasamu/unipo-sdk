<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * SDM: Master, SDM: Pegawai, SDM: Laporan, SDM: Penghasilan, SDM: Cuti, SDM: Riwayat, SDM: File, SDM: Presensi, SDM: Kinerja, SDM: BKD, SDM: Usulan, SDM: Usulan pejabat, SDM: Aturan karier, SDM: DUPAK, SDM: SKP, SDM: PAK, SDM: Honor, SDM: SOP dan kebijakan, SDM: SISTER, SDM: Pegawai keluar
 */
final class Sdm extends Resource
{
    /**
     * Pilihan nilai (enum) dan data referensi
     *
     * Jenis pegawai, kategori, status, unsur BKD/SKP, predikat, jenis usulan, jenis riwayat beserta kolomnya, serta isi tabel referensi (jabatan akademik, golongan, jabatan, jenis cuti).
     *
     * `GET /v1/sdm/referensi`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Profil kepegawaian saya
     *
     * Data pegawai yang cocok dengan akun login (username, NIDN, atau NIK karyawan), peran petugas, dan hak akses.
     *
     * `GET /v1/sdm/saya`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/saya', [], $query, null, $options, false, false);
    }

    /**
     * Tarik data dari SIAKAD
     *
     * Membuat unit (universitas, fakultas, prodi), pegawai dari m_dosen dan m_karyawan, kepala unit dari dekan/kaprodi, dan riwayat pendidikan dari t_dosen_pendidikan/t_karyawan_pendidikan. Tidak mengubah tabel SIAKAD. Aman diulang.
     *
     * `POST /v1/sdm/sinkron-siakad`
     *
     * scope: `sdm:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSinkronSiakad(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sinkron-siakad', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan
     *
     * BUP, masa KGB/kenaikan pangkat, batas SKS BKD, jam kerja, lokasi presensi, hari pengingat, ukuran file maksimal. Pajak honor ada di /v1/sdm/honor/pengaturan (BAUK).
     *
     * `GET /v1/sdm/pengaturan`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah pengaturan
     *
     * Kirim hanya kunci yang berubah. Kunci honor_pph_* ditolak (dikelola BAUK).
     *
     * `PUT /v1/sdm/pengaturan`
     *
     * scope: `sdm:admin`
     *
     * @param array{bup_dosen?: string, bup_profesor?: string, bup_tendik?: string, kgb_tahun?: string, kenaikan_pangkat_tahun?: string, serdos_min_tahun?: string, bkd_min_sks?: string, bkd_max_sks?: string, jam_masuk?: string, jam_pulang?: string, jam_pulang_jumat?: string, toleransi_terlambat_menit?: string, hari_kerja?: string, presensi_lokasi?: string, presensi_buka_masuk_menit?: string, presensi_batas_pulang_menit?: string, presensi_akurasi_maks_m?: string, presensi_luar_area?: string, presensi_lokasi_palsu?: string, presensi_hari_libur?: string, presensi_wajib_foto?: string, presensi_batas_perangkat?: string, presensi_perangkat_baru?: string, presensi_selisih_waktu_detik?: string, presensi_skor_tinjau?: string, presensi_koreksi_maks_hari?: string, pengingat_hari?: string, file_maks_mb?: string, pak_ak_per_sks_aa?: string, pak_ak_per_sks?: string, pak_ak_pkm?: string, pak_ak_penunjang_per_sks?: string, pak_maks_pengabdian_persen?: string, pak_maks_penunjang_persen?: string, pak_porsi_penulis_utama?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengaturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/pengaturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Log audit
     *
     * Semua perubahan data kepegawaian, persetujuan, dan unggah file.
     *
     * `GET /v1/sdm/log`
     *
     * scope: `sdm:admin` · berhalaman
     *
     * @param array{pegawai_id?: string, entitas?: string, aksi?: string, username?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/log', [], $query, null, $options, false, false);
    }

    /**
     * Struktur organisasi
     *
     * Pohon unit kerja (= unit organisasi SIAKAD, Pustikom » Organisasi) beserta kepala unit dari pejabat Organisasi.
     *
     * `GET /v1/sdm/unit/pohon`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitPohon(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/unit/pohon', [], $query, null, $options, false, false);
    }

    /**
     * Laporan pemetaan unit kerja ke unit SIAKAD
     *
     * Admin SDM. Jumlah unit kerja SDM terpetakan per cara (lama, universitas, kode_fakultas, kode_prodi, kode, katalog, cermin), unit SDM lama yang belum terpetakan beserta jumlah pegawainya (dilaporkan, tidak ditebak), dan pemetaan ganda.
     *
     * `GET /v1/sdm/unit/pemetaan`
     *
     * scope: `sdm:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitPemetaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/unit/pemetaan', [], $query, null, $options, false, false);
    }

    /**
     * Tunjangan jabatan: ubah
     *
     * Tunjangan jabatan struktural/tugas tambahan (rupiah per bulan, sdm_ref_jabatan.tunjangan) yang dibaca payroll. Ditulis BAUK (pengelola gaji); data jabatan lain tetap oleh admin SDM.
     *
     * `PUT /v1/sdm/master/jabatan/{id}/tunjangan`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID jabatan
     * @param array{tunjangan: float|int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterJabatanByIdTunjangan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/jabatan/{id}/tunjangan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit kerja: daftar
     *
     * Unit kerja = unit organisasi SIAKAD (induk_unit, diatur Pustikom » Organisasi): nama, jenis, induk, aktif, dan kepala unit (pejabat Organisasi) dibaca dari SIAKAD; `induk_unit_id` = ID unit SIAKAD, `sumber` = siakad | sdm_lama (baris lama belum terpetakan). Tambah/ubah/hapus ditolak 422.
     *
     * `GET /v1/sdm/master/unit`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/unit', [], $query, null, $options, false, false);
    }

    /**
     * Unit kerja: tambah
     *
     * `POST /v1/sdm/master/unit`
     *
     * scope: `sdm:admin`
     *
     * @param array{induk_id?: int|null, kode: string|null, jenis: string, kode_fakultas?: string|null, kode_prodi?: string|null, nama: string|null, singkatan?: string|null, kepala_pegawai_id?: int|null, induk_unit_id?: int|null, aktif?: bool, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterUnit(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/unit', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit kerja: detail
     *
     * `GET /v1/sdm/master/unit/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unit kerja: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/unit/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{induk_id?: int|null, kode: string|null, jenis: string, kode_fakultas?: string|null, kode_prodi?: string|null, nama: string|null, singkatan?: string|null, kepala_pegawai_id?: int|null, induk_unit_id?: int|null, aktif?: bool, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterUnitById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/unit/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit kerja: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/unit/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenjang jabatan akademik dan syarat promosi: daftar
     *
     * Jenjang jabatan akademik dosen (Permendiktisaintek 52/2025): syarat pendidikan, proporsi penelitian, publikasi khusus, uji kompetensi, angka kredit minimal (isi sesuai juknis).
     *
     * `GET /v1/sdm/master/jabatan-akademik`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterJabatanAkademik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/jabatan-akademik', [], $query, null, $options, false, false);
    }

    /**
     * Jenjang jabatan akademik dan syarat promosi: tambah
     *
     * `POST /v1/sdm/master/jabatan-akademik`
     *
     * scope: `sdm:admin`
     *
     * @param array{kode: string|null, kode_siakad?: string|null, kode_pddikti?: string|null, nama: string|null, urutan: int|null, angka_kredit_minimal?: float|int|null, proporsi_penelitian_min?: int|null, publikasi_khusus_min?: int|null, pendidikan_minimal?: string, masa_dosen_tetap_min?: int|null, wajib_serdos?: bool, wajib_uji_kompetensi?: bool, keterangan?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterJabatanAkademik(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/jabatan-akademik', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenjang jabatan akademik dan syarat promosi: detail
     *
     * `GET /v1/sdm/master/jabatan-akademik/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterJabatanAkademikById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/jabatan-akademik/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenjang jabatan akademik dan syarat promosi: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/jabatan-akademik/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{kode: string|null, kode_siakad?: string|null, kode_pddikti?: string|null, nama: string|null, urutan: int|null, angka_kredit_minimal?: float|int|null, proporsi_penelitian_min?: int|null, publikasi_khusus_min?: int|null, pendidikan_minimal?: string, masa_dosen_tetap_min?: int|null, wajib_serdos?: bool, wajib_uji_kompetensi?: bool, keterangan?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterJabatanAkademikById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/jabatan-akademik/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenjang jabatan akademik dan syarat promosi: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/jabatan-akademik/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterJabatanAkademikById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/jabatan-akademik/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pangkat/golongan: daftar
     *
     * Pangkat dan golongan ruang (I/a sampai IV/e), dengan kode SIAKAD.
     *
     * `GET /v1/sdm/master/golongan`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterGolongan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/golongan', [], $query, null, $options, false, false);
    }

    /**
     * Pangkat/golongan: tambah
     *
     * `POST /v1/sdm/master/golongan`
     *
     * scope: `sdm:admin`
     *
     * @param array{kode: string|null, kode_siakad?: string|null, golongan: string|null, ruang?: string|null, pangkat: string|null, urutan: int|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterGolongan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/golongan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pangkat/golongan: detail
     *
     * `GET /v1/sdm/master/golongan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterGolonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/golongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pangkat/golongan: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/golongan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{kode: string|null, kode_siakad?: string|null, golongan: string|null, ruang?: string|null, pangkat: string|null, urutan: int|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterGolonganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/golongan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pangkat/golongan: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/golongan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterGolonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/golongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural, tugas tambahan, fungsional tendik: daftar
     *
     * Jabatan struktural, tugas tambahan dosen, fungsional tendik, dan pelaksana.
     *
     * `GET /v1/sdm/master/jabatan`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterJabatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/jabatan', [], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural, tugas tambahan, fungsional tendik: tambah
     *
     * `POST /v1/sdm/master/jabatan`
     *
     * scope: `sdm:admin`
     *
     * @param array{kode: string|null, nama: string|null, jenis: string, eselon?: string|null, setara_sks?: float|int|null, aktif?: bool, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterJabatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/jabatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan struktural, tugas tambahan, fungsional tendik: detail
     *
     * `GET /v1/sdm/master/jabatan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural, tugas tambahan, fungsional tendik: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/jabatan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{kode: string|null, nama: string|null, jenis: string, eselon?: string|null, setara_sks?: float|int|null, aktif?: bool, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterJabatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/jabatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan struktural, tugas tambahan, fungsional tendik: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/jabatan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis cuti, izin, dan dinas: daftar
     *
     * Jenis cuti/izin: kuota per tahun, maksimal hari, hitung hari kerja, perlu atasan, wajib lampiran.
     *
     * `GET /v1/sdm/master/jenis-cuti`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterJenisCuti(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/jenis-cuti', [], $query, null, $options, false, false);
    }

    /**
     * Jenis cuti, izin, dan dinas: tambah
     *
     * `POST /v1/sdm/master/jenis-cuti`
     *
     * scope: `sdm:admin`
     *
     * @param array{kode: string|null, nama: string|null, kategori: string, kuota_hari_tahun?: int|null, maks_hari?: int|null, hitung_hari_kerja?: bool, wajib_lampiran?: bool, untuk?: string, butuh_atasan?: bool, status_presensi?: string, aktif?: bool, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterJenisCuti(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/jenis-cuti', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis cuti, izin, dan dinas: detail
     *
     * `GET /v1/sdm/master/jenis-cuti/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterJenisCutiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/jenis-cuti/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis cuti, izin, dan dinas: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/jenis-cuti/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{kode: string|null, nama: string|null, kategori: string, kuota_hari_tahun?: int|null, maks_hari?: int|null, hitung_hari_kerja?: bool, wajib_lampiran?: bool, untuk?: string, butuh_atasan?: bool, status_presensi?: string, aktif?: bool, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterJenisCutiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/jenis-cuti/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jenis cuti, izin, dan dinas: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/jenis-cuti/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterJenisCutiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/jenis-cuti/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skala gaji pokok per golongan dan masa kerja: daftar
     *
     * Skala gaji pokok per golongan dan masa kerja golongan (MKG), berlaku mulai tanggal tertentu. Dipakai mengisi gaji pokok otomatis saat kenaikan pangkat dan KGB ditetapkan. Ditulis BAUK (scope gaji:write, pengelola gaji); SDM membaca.
     *
     * `GET /v1/sdm/master/gaji-pokok`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterGajiPokok(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/gaji-pokok', [], $query, null, $options, false, false);
    }

    /**
     * Skala gaji pokok per golongan dan masa kerja: tambah
     *
     * `POST /v1/sdm/master/gaji-pokok`
     *
     * scope: `gaji:write`
     *
     * @param array{golongan_id: int|null, masa_kerja_tahun: int|null, gaji_pokok: float|int|null, berlaku_mulai: string|null, dasar?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterGajiPokok(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/gaji-pokok', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skala gaji pokok per golongan dan masa kerja: detail
     *
     * `GET /v1/sdm/master/gaji-pokok/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterGajiPokokById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/gaji-pokok/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skala gaji pokok per golongan dan masa kerja: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/gaji-pokok/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID
     * @param array{golongan_id: int|null, masa_kerja_tahun: int|null, gaji_pokok: float|int|null, berlaku_mulai: string|null, dasar?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterGajiPokokById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/gaji-pokok/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skala gaji pokok per golongan dan masa kerja: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/gaji-pokok/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterGajiPokokById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/gaji-pokok/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan tunjangan otomatis (fungsional, profesi, per golongan): daftar
     *
     * Aturan tunjangan otomatis: dasar jabatan_akademik (fungsional per jenjang, dasar_id = jabatan akademik), serdos (profesi), atau golongan; nominal tetap atau persen gaji pokok. Tunjangan dibuat saat riwayat dasarnya disetujui dengan file SK. Ditulis BAUK (scope gaji:write, pengelola gaji); SDM membaca.
     *
     * `GET /v1/sdm/master/tunjangan`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterTunjangan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/tunjangan', [], $query, null, $options, false, false);
    }

    /**
     * Aturan tunjangan otomatis (fungsional, profesi, per golongan): tambah
     *
     * `POST /v1/sdm/master/tunjangan`
     *
     * scope: `gaji:write`
     *
     * @param array{kode: string|null, nama: string|null, jenis: string, dasar: string, dasar_id?: int|null, untuk?: string, nominal?: float|int|null, persen_gaji_pokok?: float|int|null, berlaku_mulai?: string|null, sumber_dana?: string|null, dasar_hukum?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterTunjangan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/tunjangan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan tunjangan otomatis (fungsional, profesi, per golongan): detail
     *
     * `GET /v1/sdm/master/tunjangan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterTunjanganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/tunjangan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan tunjangan otomatis (fungsional, profesi, per golongan): ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/tunjangan/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID
     * @param array{kode: string|null, nama: string|null, jenis: string, dasar: string, dasar_id?: int|null, untuk?: string, nominal?: float|int|null, persen_gaji_pokok?: float|int|null, berlaku_mulai?: string|null, sumber_dana?: string|null, dasar_hukum?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterTunjanganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/tunjangan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan tunjangan otomatis (fungsional, profesi, per golongan): hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/tunjangan/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterTunjanganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/tunjangan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hari libur: daftar
     *
     * Hari libur yang berlaku untuk pegawai dari kalender akademik (libur bersama, hanya-baca di SDM; diubah BAAK di Kalender) dan libur khusus pegawai yang dicatat Biro SDM (sasaran pegawai). Dipakai menghitung hari kerja cuti, presensi, dan payroll. Baris: tanggal, selesai, nama, jenis, sasaran, sumber (kalender | sdm | kal_tahapan), bisa_ubah.
     *
     * `GET /v1/sdm/master/hari-libur`
     *
     * scope: `sdm:read`
     *
     * @param array{q?: string, aktif?: string, jenis?: string, induk_id?: string, tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterHariLibur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/hari-libur', [], $query, null, $options, false, false);
    }

    /**
     * Hari libur: tambah
     *
     * `POST /v1/sdm/master/hari-libur`
     *
     * scope: `sdm:admin`
     *
     * @param array{tanggal: string|null, selesai?: string|null, nama: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMasterHariLibur(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/master/hari-libur', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hari libur: detail
     *
     * `GET /v1/sdm/master/hari-libur/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMasterHariLiburById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/master/hari-libur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hari libur: ubah
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/master/hari-libur/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{tanggal: string|null, selesai?: string|null, nama: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMasterHariLiburById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/master/hari-libur/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hari libur: hapus
     *
     * Ditolak bila masih dipakai; nonaktifkan saja.
     *
     * `DELETE /v1/sdm/master/hari-libur/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMasterHariLiburById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/master/hari-libur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Petugas kepegawaian
     *
     * Peran: admin (kelola semua di unitnya; tanpa unit = admin SDM), operator (input dan verifikasi data), pimpinan (setujui cuti/usulan, lihat laporan), asesor (nilai BKD).
     *
     * `GET /v1/sdm/petugas`
     *
     * scope: `sdm:read`
     *
     * @param array{unit_id?: string, peran?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetugas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/petugas', [], $query, null, $options, false, false);
    }

    /**
     * Tambah petugas
     *
     * `POST /v1/sdm/petugas`
     *
     * scope: `sdm:admin`
     *
     * @param array{username: string|null, peran: string, unit_id?: int|null, aktif?: bool, mulai?: string|null, selesai?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetugas(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/petugas', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah petugas
     *
     * `PUT /v1/sdm/petugas/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID petugas
     * @param array{username: string|null, peran: string, unit_id?: int|null, aktif?: bool, mulai?: string|null, selesai?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPetugasById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/petugas/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus petugas
     *
     * `DELETE /v1/sdm/petugas/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID petugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePetugasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/petugas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar pegawai
     *
     * Dosen dan tendik yang boleh Anda lihat. Bawaan hanya yang masih bekerja (status_aktif=bekerja: aktif, cuti, tugas/izin belajar, diperbantukan); status_aktif=semua untuk semua, tidak_bekerja untuk yang keluar/nonaktif. Data pribadi (NIK, alamat, rekening, dll.) hanya tampil di detail untuk yang berhak.
     *
     * `GET /v1/sdm/pegawai`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{jenis?: string, kategori?: string, status_kepegawaian?: string, status_aktif?: string, urut?: string, unit_id?: string, kode_prodi?: string, kode_fakultas?: string, jabatan_akademik_id?: string, golongan_id?: string, serdos?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai', [], $query, null, $options, false, false);
    }

    /**
     * Tambah pegawai
     *
     * Oleh admin/operator unit. Bila `nidn` atau `nik_karyawan` ada di SIAKAD, data kosong dilengkapi dari m_dosen/m_karyawan.
     *
     * `POST /v1/sdm/pegawai`
     *
     * scope: `sdm:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawai(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ringkasan daftar pegawai
     *
     * Untuk kepala daftar pegawai, dalam cakupan yang boleh Anda lihat: `total`, `bekerja`, `tidak_bekerja`, `dosen`/`tendik` (yang bekerja), `kelengkapan_rata` (persen kolom data terisi, rata-rata yang bekerja), dan `pensiun` (perkiraan pensiun dalam `bulan` ke depan, bawaan 12).
     *
     * `GET /v1/sdm/pegawai-ringkas`
     *
     * scope: `sdm:read`
     *
     * @param array{bulan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiRingkas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai-ringkas', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau data SIAKAD untuk tambah pegawai
     *
     * Tanpa menulis. Baris m_dosen (`nidn`) atau m_karyawan (`nik_karyawan`) yang cocok: `sumber`, `isian` yang akan dilengkapi otomatis saat POST /pegawai (kolom kosong saja), `nama_prodi`, dan `pegawai_ada` bila NIDN/NIK sudah dipakai pegawai SDM. Admin/operator SDM.
     *
     * `GET /v1/sdm/pegawai-siakad`
     *
     * scope: `sdm:write`
     *
     * @param array{nidn?: string, nik_karyawan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiSiakad(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai-siakad', [], $query, null, $options, false, false);
    }

    /**
     * Antrian verifikasi
     *
     * Riwayat yang diajukan pegawai sendiri dan menunggu verifikasi petugas, semua jenis.
     *
     * `GET /v1/sdm/verifikasi`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{jenis?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVerifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/verifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Detail pegawai
     *
     * Termasuk jabatan aktif, jumlah riwayat, yang menunggu verifikasi, data SIAKAD terkait, masa kerja, tanggal pensiun, dan hak Anda.
     *
     * `GET /v1/sdm/pegawai/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah pegawai
     *
     * Pegawai sendiri hanya boleh mengubah data kontak dan pribadi; sisanya oleh petugas. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/pegawai/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPegawaiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/pegawai/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus pegawai
     *
     * Hapus lunak, riwayat tetap tersimpan. Untuk pegawai keluar/pensiun, lebih baik tambah riwayat status.
     *
     * `DELETE /v1/sdm/pegawai/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID pegawai
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePegawaiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/pegawai/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hak penghasilan semua pegawai (untuk payroll)
     *
     * Gaji pokok dan tunjangan yang berlaku pada `tanggal` untuk pegawai yang masih bekerja, beserta tanggungan keluarga (PTKP), NPWP, dan peringatan (gaji pokok belum ada, riwayat tanpa file SK). SDM menetapkan hak; payroll keuangan (/v1/gaji) menghitung potongan, pajak, dan membayar. Admin SDM atau token aplikasi.
     *
     * `GET /v1/sdm/penghasilan`
     *
     * scope: `sdm:admin` · berhalaman
     *
     * @param array{tanggal?: string, unit_id?: string, jenis?: string, pegawai_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenghasilan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/penghasilan', [], $query, null, $options, false, false);
    }

    /**
     * Hak penghasilan pegawai
     *
     * Gaji pokok (riwayat gaji disetujui terakhir), tunjangan aktif, tanggungan keluarga, dan total pada `tanggal`. Hanya pegawai itu sendiri, atasan, dan petugas SDM.
     *
     * `GET /v1/sdm/pegawai/{id}/penghasilan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{tanggal?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPenghasilan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/penghasilan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perkiraan penghasilan setelah kenaikan
     *
     * Gaji pokok dan tunjangan sebelum dan sesudah kenaikan pangkat atau jabatan akademik pada TMT, dihitung dengan aturan yang sama dengan penurunan otomatis (skala gaji, aturan tunjangan). Tidak menulis data; hak baru berlaku setelah riwayat ber-SK disetujui SDM. `mulai_payroll` = bulan gaji pertama yang memuatnya. Hanya pegawai itu sendiri, atasan, dan petugas SDM.
     *
     * `GET /v1/sdm/pegawai/{id}/perkiraan-penghasilan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, ke_id: int, tmt?: string, masa_kerja_tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPerkiraanPenghasilan(int|string $id, array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/perkiraan-penghasilan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peran dan hak akses dari jabatan
     *
     * Penugasan peran (RBAC) yang dibuat otomatis dari riwayat jabatan disetujui pegawai ini, sesuai pemetaan jabatan SDM ke peran di Pustikom: peran, unit, masa berlaku, status (`aktif`, `dilewati` beserta alasannya, `dicabut` di Pustikom, `berakhir`). Sinkron berjalan setiap kali pegawai, riwayat jabatan/status, atau akunnya berubah.
     *
     * `GET /v1/sdm/pegawai/{id}/peran`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPeran(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/peran', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sinkronkan ulang peran dari jabatan
     *
     * Petugas SDM unit itu. Menjalankan ulang sinkron jabatan -> penugasan peran untuk pegawai ini (mis. setelah akun SIAKAD dibuat atau pemetaan unit diperbaiki).
     *
     * `POST /v1/sdm/pegawai/{id}/peran/sinkron`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdPeranSinkron(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/peran/sinkron', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ringkasan karier
     *
     * Jabatan akademik, pangkat, KGB, sertifikasi, dan tanggal penting berikutnya (kenaikan pangkat, KGB, pensiun), jabatan struktural (pejabat ber-SK di data induk dan riwayat jabatan SDM, dengan SK registri), dan usulan kenaikan beserta status tahapnya.
     *
     * `GET /v1/sdm/pegawai/{id}/karier`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdKarier(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/karier', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cek syarat kenaikan
     *
     * Syarat jabatan akademik (Permendiktisaintek 52/2025), pangkat, KGB, atau serdos beserta status terpenuhi tiap butir.
     *
     * `GET /v1/sdm/pegawai/{id}/cek-syarat`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis?: string, ke_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdCekSyarat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/cek-syarat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan kepegawaian yang berlaku
     *
     * Hasil periksa aturan dinamis kategori kepegawaian (/v1/aturan) di titik sdm.cuti.ajukan, sdm.riwayat.ajukan, sdm.presensi.catat, sdm.kinerja.ajukan, dan sdm.usulan.ajukan untuk pegawai ini: boleh, pelanggaran, peringatan, batas, dan indikator. Indikator konteks (mis. lama cuti) tidak terisi, jadi aturan yang bergantung padanya dinilai saat pengajuan.
     *
     * `GET /v1/sdm/pegawai/{id}/aturan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{titik?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdAturan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/aturan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat perubahan data pegawai
     *
     * `GET /v1/sdm/pegawai/{id}/log`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdLog(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/log', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Saldo cuti
     *
     * Kuota, terpakai, dan sisa per jenis cuti pada tahun berjalan.
     *
     * `GET /v1/sdm/pegawai/{id}/saldo-cuti`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdSaldoCuti(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/saldo-cuti', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tulis jabatan/pangkat/pendidikan ke SIAKAD
     *
     * Menulis kode jabatan_akademik, pangkat_golongan, dan pendidikan terakhir ke m_dosen/m_karyawan agar laporan lama ikut benar. Hanya mengisi data, struktur tabel tidak berubah. Admin SDM.
     *
     * `POST /v1/sdm/pegawai/{id}/terapkan-ke-siakad`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID pegawai
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdTerapkanKeSiakad(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/terapkan-ke-siakad', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan akademik (jabatan fungsional dosen): daftar
     *
     * `GET /v1/sdm/pegawai/{id}/jabatan-akademik`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdJabatanAkademik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/jabatan-akademik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan akademik (jabatan fungsional dosen): tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/jabatan-akademik`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jabatan_akademik_id: int|null, angka_kredit?: float|int|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, penetap?: string, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdJabatanAkademik(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/jabatan-akademik', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan akademik (jabatan fungsional dosen): detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/jabatan-akademik/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatJabatanAkademikById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/jabatan-akademik/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan akademik (jabatan fungsional dosen): ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/jabatan-akademik/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jabatan_akademik_id: int|null, angka_kredit?: float|int|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, penetap?: string, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatJabatanAkademikById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/jabatan-akademik/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan akademik (jabatan fungsional dosen): hapus
     *
     * `DELETE /v1/sdm/riwayat/jabatan-akademik/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatJabatanAkademikById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/jabatan-akademik/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan akademik (jabatan fungsional dosen): dampak ke penghasilan
     *
     * Perkiraan gaji pokok dan tunjangan sebelum dan sesudah riwayat ini disetujui (lihat perkiraan-penghasilan), plus `ada_sk`. Untuk pengaju dan verifikator.
     *
     * `GET /v1/sdm/riwayat/jabatan-akademik/{id}/dampak`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatJabatanAkademikByIdDampak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/jabatan-akademik/{id}/dampak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan akademik (jabatan fungsional dosen): verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/jabatan-akademik/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatJabatanAkademikByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/jabatan-akademik/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pangkat/golongan dan inpassing: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/pangkat`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPangkat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/pangkat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pangkat/golongan dan inpassing: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/pangkat`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{golongan_id: int|null, jenis?: string, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, masa_kerja_tahun?: int|null, masa_kerja_bulan?: int|null, angka_kredit?: float|int|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdPangkat(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/pangkat', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pangkat/golongan dan inpassing: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/pangkat/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatPangkatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/pangkat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pangkat/golongan dan inpassing: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/pangkat/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{golongan_id: int|null, jenis?: string, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, masa_kerja_tahun?: int|null, masa_kerja_bulan?: int|null, angka_kredit?: float|int|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatPangkatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/pangkat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pangkat/golongan dan inpassing: hapus
     *
     * `DELETE /v1/sdm/riwayat/pangkat/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatPangkatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/pangkat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pangkat/golongan dan inpassing: dampak ke penghasilan
     *
     * Perkiraan gaji pokok dan tunjangan sebelum dan sesudah riwayat ini disetujui (lihat perkiraan-penghasilan), plus `ada_sk`. Untuk pengaju dan verifikator.
     *
     * `GET /v1/sdm/riwayat/pangkat/{id}/dampak`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatPangkatByIdDampak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/pangkat/{id}/dampak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pangkat/golongan dan inpassing: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/pangkat/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatPangkatByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/pangkat/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan struktural / tugas tambahan / jabatan tendik: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/jabatan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdJabatan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/jabatan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural / tugas tambahan / jabatan tendik: tambah
     *
     * Hanya petugas yang boleh menambah.
     *
     * `POST /v1/sdm/pegawai/{id}/jabatan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jabatan_id: int|null, unit_id?: int|null, nama_jabatan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_mulai: string|null, tmt_selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdJabatan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/jabatan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan struktural / tugas tambahan / jabatan tendik: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/jabatan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural / tugas tambahan / jabatan tendik: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/jabatan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jabatan_id: int|null, unit_id?: int|null, nama_jabatan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_mulai: string|null, tmt_selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatJabatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/jabatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jabatan struktural / tugas tambahan / jabatan tendik: hapus
     *
     * `DELETE /v1/sdm/riwayat/jabatan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatJabatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/jabatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jabatan struktural / tugas tambahan / jabatan tendik: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/jabatan/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatJabatanByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/jabatan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengangkatan, penempatan, mutasi, status, pemberhentian: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/status`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdStatus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/status', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengangkatan, penempatan, mutasi, status, pemberhentian: tambah
     *
     * Hanya petugas yang boleh menambah.
     *
     * `POST /v1/sdm/pegawai/{id}/status`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, kategori?: string, status_kepegawaian?: string, status_aktif?: string, unit_id?: int|null, kode_prodi?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, tmt_selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengangkatan, penempatan, mutasi, status, pemberhentian: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/status/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatStatusById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/status/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengangkatan, penempatan, mutasi, status, pemberhentian: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/status/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenis: string, kategori?: string, status_kepegawaian?: string, status_aktif?: string, unit_id?: int|null, kode_prodi?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, tmt_selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatStatusById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/status/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengangkatan, penempatan, mutasi, status, pemberhentian: hapus
     *
     * `DELETE /v1/sdm/riwayat/status/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatStatusById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/status/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengangkatan, penempatan, mutasi, status, pemberhentian: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/status/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatStatusByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/status/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendidikan formal: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/pendidikan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPendidikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/pendidikan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendidikan formal: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/pendidikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenjang: string, gelar?: string|null, nama_pt: string|null, kode_pt?: string|null, negara?: string|null, program_studi?: string|null, bidang_ilmu?: string|null, tahun_masuk?: int|null, tahun_lulus?: int|null, tanggal_ijazah?: string|null, nomor_ijazah?: string|null, ipk?: float|int|null, judul_tugas_akhir?: string|null, sumber_biaya?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdPendidikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/pendidikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendidikan formal: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/pendidikan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatPendidikanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/pendidikan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendidikan formal: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/pendidikan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenjang: string, gelar?: string|null, nama_pt: string|null, kode_pt?: string|null, negara?: string|null, program_studi?: string|null, bidang_ilmu?: string|null, tahun_masuk?: int|null, tahun_lulus?: int|null, tanggal_ijazah?: string|null, nomor_ijazah?: string|null, ipk?: float|int|null, judul_tugas_akhir?: string|null, sumber_biaya?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatPendidikanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/pendidikan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendidikan formal: hapus
     *
     * `DELETE /v1/sdm/riwayat/pendidikan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatPendidikanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/pendidikan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendidikan formal: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/pendidikan/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatPendidikanByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/pendidikan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Diklat dan pelatihan: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/diklat`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdDiklat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/diklat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Diklat dan pelatihan: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/diklat`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, nama: string|null, penyelenggara?: string|null, tingkat?: string, tanggal_mulai?: string|null, tanggal_selesai?: string|null, jumlah_jam?: int|null, nomor_sertifikat?: string|null, tahun?: int|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdDiklat(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/diklat', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Diklat dan pelatihan: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/diklat/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatDiklatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/diklat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Diklat dan pelatihan: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/diklat/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenis: string, nama: string|null, penyelenggara?: string|null, tingkat?: string, tanggal_mulai?: string|null, tanggal_selesai?: string|null, jumlah_jam?: int|null, nomor_sertifikat?: string|null, tahun?: int|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatDiklatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/diklat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Diklat dan pelatihan: hapus
     *
     * `DELETE /v1/sdm/riwayat/diklat/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatDiklatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/diklat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Diklat dan pelatihan: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/diklat/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatDiklatByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/diklat/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikasi (serdos, profesi, kompetensi): daftar
     *
     * `GET /v1/sdm/pegawai/{id}/sertifikasi`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdSertifikasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/sertifikasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sertifikasi (serdos, profesi, kompetensi): tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/sertifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, nama: string|null, bidang?: string|null, nomor_sertifikat?: string|null, nomor_registrasi?: string|null, penyelenggara?: string|null, tahun?: int|null, tanggal_terbit?: string|null, berlaku_sampai?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdSertifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/sertifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikasi (serdos, profesi, kompetensi): detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/sertifikasi/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatSertifikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/sertifikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sertifikasi (serdos, profesi, kompetensi): ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/sertifikasi/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenis: string, nama: string|null, bidang?: string|null, nomor_sertifikat?: string|null, nomor_registrasi?: string|null, penyelenggara?: string|null, tahun?: int|null, tanggal_terbit?: string|null, berlaku_sampai?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatSertifikasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/sertifikasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikasi (serdos, profesi, kompetensi): hapus
     *
     * `DELETE /v1/sdm/riwayat/sertifikasi/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatSertifikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/sertifikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sertifikasi (serdos, profesi, kompetensi): verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/sertifikasi/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatSertifikasiByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/sertifikasi/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tes bahasa dan potensi akademik: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/tes`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdTes(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/tes', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tes bahasa dan potensi akademik: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/tes`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, nama?: string|null, penyelenggara?: string|null, tanggal?: string|null, skor?: float|int|null, berlaku_sampai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdTes(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/tes', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tes bahasa dan potensi akademik: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/tes/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatTesById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/tes/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tes bahasa dan potensi akademik: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/tes/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenis: string, nama?: string|null, penyelenggara?: string|null, tanggal?: string|null, skor?: float|int|null, berlaku_sampai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatTesById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/tes/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tes bahasa dan potensi akademik: hapus
     *
     * `DELETE /v1/sdm/riwayat/tes/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatTesById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/tes/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tes bahasa dan potensi akademik: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/tes/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatTesByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/tes/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keluarga: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/keluarga`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdKeluarga(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/keluarga', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keluarga: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi). Data pribadi: hanya pegawai, atasan, dan petugas.
     *
     * `POST /v1/sdm/pegawai/{id}/keluarga`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{hubungan: string, nama: string|null, nik?: string|null, jenis_kelamin?: string, tempat_lahir?: string|null, tanggal_lahir?: string|null, pekerjaan?: string|null, nip?: string|null, tanggal_nikah?: string|null, hidup?: bool, tanggungan?: bool, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdKeluarga(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/keluarga', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keluarga: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/keluarga/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatKeluargaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/keluarga/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keluarga: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/keluarga/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{hubungan: string, nama: string|null, nik?: string|null, jenis_kelamin?: string, tempat_lahir?: string|null, tanggal_lahir?: string|null, pekerjaan?: string|null, nip?: string|null, tanggal_nikah?: string|null, hidup?: bool, tanggungan?: bool, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatKeluargaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/keluarga/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keluarga: hapus
     *
     * `DELETE /v1/sdm/riwayat/keluarga/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatKeluargaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/keluarga/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keluarga: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/keluarga/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatKeluargaByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/keluarga/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penghargaan: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/penghargaan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPenghargaan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/penghargaan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penghargaan: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/penghargaan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{nama: string|null, pemberi?: string|null, tingkat?: string, tahun?: int|null, tanggal?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdPenghargaan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/penghargaan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penghargaan: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/penghargaan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatPenghargaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/penghargaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penghargaan: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/penghargaan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{nama: string|null, pemberi?: string|null, tingkat?: string, tahun?: int|null, tanggal?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatPenghargaanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/penghargaan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penghargaan: hapus
     *
     * `DELETE /v1/sdm/riwayat/penghargaan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatPenghargaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/penghargaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penghargaan: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/penghargaan/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatPenghargaanByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/penghargaan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hukuman disiplin: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/disiplin`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdDisiplin(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/disiplin', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hukuman disiplin: tambah
     *
     * Hanya petugas yang boleh menambah. Data pribadi: hanya pegawai, atasan, dan petugas.
     *
     * `POST /v1/sdm/pegawai/{id}/disiplin`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{tingkat: string, jenis_hukuman: string|null, pelanggaran?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_mulai?: string|null, tmt_selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdDisiplin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/disiplin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hukuman disiplin: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/disiplin/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatDisiplinById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/disiplin/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hukuman disiplin: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/disiplin/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{tingkat: string, jenis_hukuman: string|null, pelanggaran?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_mulai?: string|null, tmt_selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatDisiplinById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/disiplin/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hukuman disiplin: hapus
     *
     * `DELETE /v1/sdm/riwayat/disiplin/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatDisiplinById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/disiplin/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hukuman disiplin: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/disiplin/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatDisiplinByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/disiplin/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman kerja: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/pekerjaan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPekerjaan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/pekerjaan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman kerja: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/pekerjaan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{instansi: string|null, jabatan?: string|null, bidang?: string|null, mulai?: string|null, selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdPekerjaan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/pekerjaan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman kerja: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/pekerjaan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatPekerjaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/pekerjaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman kerja: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/pekerjaan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{instansi: string|null, jabatan?: string|null, bidang?: string|null, mulai?: string|null, selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatPekerjaanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/pekerjaan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman kerja: hapus
     *
     * `DELETE /v1/sdm/riwayat/pekerjaan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatPekerjaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/pekerjaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman kerja: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/pekerjaan/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatPekerjaanByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/pekerjaan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi/asosiasi profesi: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/organisasi`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdOrganisasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/organisasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi/asosiasi profesi: tambah
     *
     * Pegawai boleh mengajukan sendiri (status diajukan, menunggu verifikasi).
     *
     * `POST /v1/sdm/pegawai/{id}/organisasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{nama_organisasi: string|null, peran?: string|null, tingkat?: string, nomor_anggota?: string|null, mulai?: string|null, selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdOrganisasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/organisasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi/asosiasi profesi: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/organisasi/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatOrganisasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/organisasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi/asosiasi profesi: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/organisasi/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{nama_organisasi: string|null, peran?: string|null, tingkat?: string, nomor_anggota?: string|null, mulai?: string|null, selesai?: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatOrganisasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/organisasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi/asosiasi profesi: hapus
     *
     * `DELETE /v1/sdm/riwayat/organisasi/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatOrganisasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/organisasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi/asosiasi profesi: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/organisasi/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatOrganisasiByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/organisasi/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Gaji pokok dan kenaikan gaji berkala (KGB): daftar
     *
     * `GET /v1/sdm/pegawai/{id}/gaji`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdGaji(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/gaji', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Gaji pokok dan kenaikan gaji berkala (KGB): tambah
     *
     * Hanya petugas yang boleh menambah. Data pribadi: hanya pegawai, atasan, dan petugas.
     *
     * `POST /v1/sdm/pegawai/{id}/gaji`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, golongan_id?: int|null, gaji_pokok: float|int|null, masa_kerja_tahun?: int|null, masa_kerja_bulan?: int|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdGaji(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/gaji', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Gaji pokok dan kenaikan gaji berkala (KGB): detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/gaji/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatGajiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/gaji/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Gaji pokok dan kenaikan gaji berkala (KGB): ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/gaji/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenis: string, golongan_id?: int|null, gaji_pokok: float|int|null, masa_kerja_tahun?: int|null, masa_kerja_bulan?: int|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt: string|null, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatGajiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/gaji/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Gaji pokok dan kenaikan gaji berkala (KGB): hapus
     *
     * `DELETE /v1/sdm/riwayat/gaji/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatGajiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/gaji/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Gaji pokok dan kenaikan gaji berkala (KGB): verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/gaji/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatGajiByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/gaji/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tunjangan: daftar
     *
     * `GET /v1/sdm/pegawai/{id}/tunjangan`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdTunjangan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/tunjangan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tunjangan: tambah
     *
     * Hanya petugas yang boleh menambah. Data pribadi: hanya pegawai, atasan, dan petugas.
     *
     * `POST /v1/sdm/pegawai/{id}/tunjangan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, nama?: string|null, nominal?: float|int|null, mulai: string|null, selesai?: string|null, sumber_dana?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, dihentikan?: bool, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdTunjangan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/tunjangan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tunjangan: detail
     *
     * Termasuk file pendukung.
     *
     * `GET /v1/sdm/riwayat/tunjangan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRiwayatTunjanganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/riwayat/tunjangan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tunjangan: ubah
     *
     * Pegawai hanya boleh mengubah pengajuannya yang belum disetujui.
     *
     * `PUT /v1/sdm/riwayat/tunjangan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{jenis: string, nama?: string|null, nominal?: float|int|null, mulai: string|null, selesai?: string|null, sumber_dana?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, dihentikan?: bool, keterangan?: string|null, sumber_ref?: string|null, status_verifikasi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRiwayatTunjanganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/riwayat/tunjangan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tunjangan: hapus
     *
     * `DELETE /v1/sdm/riwayat/tunjangan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRiwayatTunjanganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/riwayat/tunjangan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tunjangan: verifikasi
     *
     * Setujui atau tolak pengajuan. Data ringkas pegawai (jabatan, pangkat, pendidikan, serdos) diperbarui otomatis.
     *
     * `POST /v1/sdm/riwayat/tunjangan/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{status: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRiwayatTunjanganByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/riwayat/tunjangan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unggah file pendukung
     *
     * multipart/form-data field `berkas`, atau JSON `berkas_base64` + `nama_file`. `entitas` = pegawai (foto/dokumen), riwayat:<jenis>, cuti, kinerja_item, atau usulan; `entitas_id` = ID datanya. Jenis file dicek dari isinya.
     *
     * `POST /v1/sdm/file`
     *
     * scope: `sdm:write`
     *
     * @param array{entitas: string|null, entitas_id: int|null, berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, keterangan?: string|null, berkas_base64?: string|null, nama_file?: string|null, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFile(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/file', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Unduh file
     *
     * Hanya untuk yang berhak melihat data pemiliknya.
     *
     * `GET /v1/sdm/file/{uuid}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $uuid ID file
     * @param array{inline?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Hapus file
     *
     * `DELETE /v1/sdm/file/{uuid}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $uuid ID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Daftar cuti dan izin
     *
     * `tindakan=1` = yang menunggu persetujuan Anda (sebagai atasan atau pejabat).
     *
     * `GET /v1/sdm/cuti`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{pegawai_id?: string, jenis_id?: string, status?: string, tahun?: string, tanggal?: string, unit_id?: string, tindakan?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCuti(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/cuti', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan cuti
     *
     * Untuk diri sendiri, atau petugas atas nama pegawai. Dicek kuota, maksimal hari, bentrok tanggal, dan jenis pegawai. Alur: atasan → pejabat berwenang. Lampiran (surat dokter, SK, surat tugas) bisa ikut lewat `berkas_id` (UUID dari /v1/berkas, maks. 5).
     *
     * `POST /v1/sdm/cuti`
     *
     * scope: `sdm:write`
     *
     * @param array{pegawai_id?: int|null, jenis_id: int|null, tanggal_mulai: string|null, tanggal_selesai: string|null, alasan?: string|null, alamat_selama_cuti?: string|null, telepon?: string|null, pengganti_id?: int|null, berkas_id?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCuti(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/cuti', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hitung hari kerja
     *
     * Jumlah hari kerja di antara dua tanggal (tanpa akhir pekan dan hari libur).
     *
     * `GET /v1/sdm/cuti/hitung-hari`
     *
     * scope: `sdm:read`
     *
     * @param array{mulai: string, selesai: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCutiHitungHari(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/cuti/hitung-hari', [], $query, null, $options, false, false);
    }

    /**
     * Detail cuti
     *
     * `GET /v1/sdm/cuti/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCutiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/cuti/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cuti: Setujui (atasan, lalu pejabat)
     *
     * `POST /v1/sdm/cuti/{id}/setujui`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_surat?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCutiByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/cuti/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cuti: Tolak
     *
     * `POST /v1/sdm/cuti/{id}/tolak`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_surat?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCutiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/cuti/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cuti: Batalkan (pemohon sebelum disetujui penuh, atau petugas)
     *
     * `POST /v1/sdm/cuti/{id}/batal`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_surat?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCutiByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/cuti/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar presensi
     *
     * `GET /v1/sdm/presensi`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{pegawai_id?: string, unit_id?: string, dari?: string, sampai?: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi', [], $query, null, $options, false, false);
    }

    /**
     * Input presensi manual
     *
     * Oleh petugas (koreksi, dinas luar, izin).
     *
     * `POST /v1/sdm/presensi`
     *
     * scope: `sdm:write`
     *
     * @param array{pegawai_id: int|null, tanggal: string|null, jam_masuk?: string|null, jam_pulang?: string|null, status?: string, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Layar presensi saya (web/mobile)
     *
     * Satu panggilan untuk layar presensi: jam server dan zona, tanggal kerja (shift malam ikut tanggal masuk), jadwal yang berlaku (jam, jendela buka/tutup, toleransi, wajib lokasi/foto), presensi hari ini, cuti/dinas, mode lokasi, area presensi (titik, radius, poligon), aksi berikut + boleh/alasan, aturan (akurasi, luar area, lokasi palsu, perangkat), dan percobaan hari ini. `perangkat` = ID perangkat untuk mengetahui statusnya (aktif, menunggu, diblokir, baru).
     *
     * `GET /v1/sdm/presensi/hari-ini`
     *
     * scope: `sdm:read`
     *
     * @param array{perangkat?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiHariIni(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/hari-ini', [], $query, null, $options, false, false);
    }

    /**
     * Catat masuk/pulang
     *
     * Waktu = jam server. Diperiksa: urutan, cuti/dinas, hari libur, jendela jadwal, perangkat terdaftar, area (radius/poligon/jaringan kampus), akurasi GPS, lokasi palsu, perpindahan tidak wajar, swafoto, dan aturan dinamis sdm.presensi.catat. Hasil: `diterima` (langsung masuk rekap), `ditinjau` (menunggu atasan/SDM), atau galat dengan kode tetap (lokasi_wajib, akurasi_rendah, di_luar_area, alasan_wajib, lokasi_palsu, perangkat_menunggu, perangkat_diblokir, di_luar_jendela, hari_libur, sedang_cuti, foto_wajib, sudah_masuk, belum_masuk). Kirim `kunci` agar kirim ulang aman.
     *
     * `POST /v1/sdm/presensi/catat`
     *
     * scope: `sdm:write`
     *
     * @param array{aksi?: string, lat?: float|int|null, lng?: float|int|null, akurasi?: float|int|null, lokasi?: string|null, lokasi_palsu?: bool, perangkat?: array<string, mixed>, waktu_perangkat?: string|null, foto?: string|null, foto_berkas_id?: string|null, kunci?: string|null, catatan?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiCatat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/catat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Percobaan presensi
     *
     * Setiap percobaan (diterima, ditinjau, ditolak) dengan lokasi, jarak, akurasi, perangkat, foto, dan tanda risiko. `sebagai=saya` milik sendiri; `penyetuju` bawahan/unit yang Anda kelola (tanpa diri sendiri).
     *
     * `GET /v1/sdm/presensi/kejadian`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{sebagai?: string, status?: string, pegawai_id?: string, unit_id?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiKejadian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/kejadian', [], $query, null, $options, false, false);
    }

    /**
     * Tinjau presensi
     *
     * Atasan langsung atau petugas SDM/pimpinan unit. Diterima = ditulis ke presensi harian pada waktu aslinya.
     *
     * `POST /v1/sdm/presensi/kejadian/{id}/tinjau`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID percobaan
     * @param array{keputusan: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKejadianByIdTinjau(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/kejadian/{id}/tinjau', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peta kehadiran
     *
     * Area presensi dan titik presensi pegawai pada satu tanggal (sesuai hak lihat), dengan ringkasan di area/luar area/ditinjau.
     *
     * `GET /v1/sdm/presensi/peta`
     *
     * scope: `sdm:read`
     *
     * @param array{tanggal?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiPeta(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/peta', [], $query, null, $options, false, false);
    }

    /**
     * Area presensi
     *
     * Titik + radius atau poligon per kampus/unit. Jaringan kampus hanya tampil untuk petugas SDM.
     *
     * `GET /v1/sdm/presensi/lokasi`
     *
     * scope: `sdm:read`
     *
     * @param array{semua?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiLokasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/lokasi', [], $query, null, $options, false, false);
    }

    /**
     * Tambah area presensi
     *
     * Area untuk semua unit: admin SDM; area unit: petugas SDM unit itu.
     *
     * `POST /v1/sdm/presensi/lokasi`
     *
     * scope: `sdm:write`
     *
     * @param array{kode: string|null, nama: string|null, jenis?: string, kampus?: string|null, unit_id?: int|null, alamat?: string|null, lat: float|int|null, lng: float|int|null, radius_m?: int|null, poligon?: list<mixed>|null, jaringan?: string|null, aktif?: bool, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiLokasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/lokasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah area presensi
     *
     * `POST /v1/sdm/presensi/lokasi/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID, ID, atau kode
     * @param array{kode: string|null, nama: string|null, jenis?: string, kampus?: string|null, unit_id?: int|null, alamat?: string|null, lat: float|int|null, lng: float|int|null, radius_m?: int|null, poligon?: list<mixed>|null, jaringan?: string|null, aktif?: bool, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiLokasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/lokasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus area presensi
     *
     * `POST /v1/sdm/presensi/lokasi/{id}/hapus`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID, ID, atau kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiLokasiByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/lokasi/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jadwal kerja
     *
     * Termasuk jadwal bawaan dari Pengaturan (dipakai pegawai tanpa penugasan).
     *
     * `GET /v1/sdm/presensi/jadwal`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Tambah jadwal kerja
     *
     * Admin SDM. Tetap, shift (boleh lintas hari), atau fleksibel (lama kerja minimal).
     *
     * `POST /v1/sdm/presensi/jadwal`
     *
     * scope: `sdm:write`
     *
     * @param array{kode: string|null, nama: string|null, jenis?: string, hari: array<string, mixed>, toleransi_terlambat_menit?: int|null, buka_masuk_menit?: int|null, batas_pulang_menit?: int|null, min_kerja_menit?: int|null, lintas_hari?: bool, ikut_libur?: bool, wajib_lokasi?: bool, wajib_foto?: bool, aktif?: bool, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiJadwal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/jadwal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah jadwal kerja
     *
     * `POST /v1/sdm/presensi/jadwal/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID, ID, atau kode
     * @param array{kode: string|null, nama: string|null, jenis?: string, hari: array<string, mixed>, toleransi_terlambat_menit?: int|null, buka_masuk_menit?: int|null, batas_pulang_menit?: int|null, min_kerja_menit?: int|null, lintas_hari?: bool, ikut_libur?: bool, wajib_lokasi?: bool, wajib_foto?: bool, aktif?: bool, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiJadwalById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/jadwal/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus jadwal kerja
     *
     * Ditolak bila masih dipakai penugasan yang berlaku.
     *
     * `POST /v1/sdm/presensi/jadwal/{id}/hapus`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID, ID, atau kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiJadwalByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/jadwal/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan jadwal dan area
     *
     * Prioritas: pegawai > unit terdekat > jenis pegawai > semua; pada sasaran sama, yang mulai paling akhir.
     *
     * `GET /v1/sdm/presensi/penugasan`
     *
     * scope: `sdm:read`
     *
     * @param array{pegawai_id?: string, berlaku?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiPenugasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/penugasan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah penugasan
     *
     * `POST /v1/sdm/presensi/penugasan`
     *
     * scope: `sdm:write`
     *
     * @param array{sasaran: string, jenis_pegawai?: string, unit_id?: int|null, pegawai_id?: int|null, jadwal_id: string|null, mode_lokasi?: string, lokasi_ids?: list<mixed>|null, mulai: string|null, selesai?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiPenugasan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/penugasan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah penugasan
     *
     * `POST /v1/sdm/presensi/penugasan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID penugasan
     * @param array{sasaran: string, jenis_pegawai?: string, unit_id?: int|null, pegawai_id?: int|null, jadwal_id: string|null, mode_lokasi?: string, lokasi_ids?: list<mixed>|null, mulai: string|null, selesai?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiPenugasanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/penugasan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus penugasan
     *
     * `POST /v1/sdm/presensi/penugasan/{id}/hapus`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID penugasan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiPenugasanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/penugasan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perangkat presensi
     *
     * `sebagai=saya` perangkat sendiri; `kelola` perangkat pegawai di unit Anda (petugas).
     *
     * `GET /v1/sdm/presensi/perangkat`
     *
     * scope: `sdm:read`
     *
     * @param array{sebagai?: string, status?: string, pegawai_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiPerangkat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/perangkat', [], $query, null, $options, false, false);
    }

    /**
     * Ubah status perangkat
     *
     * Petugas: aktif/diblokir. Pegawai atau petugas: lepas (hapus).
     *
     * `POST /v1/sdm/presensi/perangkat/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID perangkat
     * @param array{status: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiPerangkatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/perangkat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Koreksi presensi
     *
     * `sebagai=saya` pengajuan sendiri; `penyetuju` yang bisa Anda putuskan (bawahan/unit).
     *
     * `GET /v1/sdm/presensi/koreksi`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{sebagai?: string, status?: string, pegawai_id?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiKoreksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/koreksi', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan koreksi presensi
     *
     * Lupa masuk/pulang, salah jam, gangguan, atau di luar area karena tugas. Batas mundur: pengaturan presensi_koreksi_maks_hari.
     *
     * `POST /v1/sdm/presensi/koreksi`
     *
     * scope: `sdm:write`
     *
     * @param array{tanggal: string|null, jenis: string, jam_masuk?: string|null, jam_pulang?: string|null, alasan: string|null, berkas_id?: string|null, kejadian_id?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKoreksi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/koreksi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Koreksi presensi: Setujui (atasan langsung atau petugas SDM/pimpinan unit)
     *
     * `POST /v1/sdm/presensi/koreksi/{id}/setujui`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID koreksi
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKoreksiByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/koreksi/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Koreksi presensi: Tolak
     *
     * `POST /v1/sdm/presensi/koreksi/{id}/tolak`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID koreksi
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKoreksiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/koreksi/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Koreksi presensi: Batalkan (pemohon)
     *
     * `POST /v1/sdm/presensi/koreksi/{id}/batal`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id UUID koreksi
     * @param array{catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKoreksiByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/koreksi/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Impor log mesin absensi
     *
     * Daftar {pegawai (NIDN/NIK karyawan/username/ID), waktu}. Waktu paling awal = masuk, paling akhir = pulang. Petugas.
     *
     * `POST /v1/sdm/presensi/impor`
     *
     * scope: `sdm:write`
     *
     * @param array{data: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiImpor(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/presensi/impor', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekap presensi bulanan
     *
     * Hadir, terlambat (menit), pulang cepat, cuti, izin, alpa per pegawai.
     *
     * `GET /v1/sdm/presensi/rekap`
     *
     * scope: `sdm:read`
     *
     * @param array{bulan?: string, pegawai_id?: string, unit_id?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/presensi/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Ubah presensi
     *
     * Petugas.
     *
     * `PUT /v1/sdm/presensi/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID presensi
     * @param array{pegawai_id: int|null, tanggal: string|null, jam_masuk?: string|null, jam_pulang?: string|null, status?: string, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPresensiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/presensi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode penilaian
     *
     * `GET /v1/sdm/kinerja/periode`
     *
     * scope: `sdm:read`
     *
     * @param array{jenis?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKinerjaPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/kinerja/periode', [], $query, null, $options, false, false);
    }

    /**
     * Tambah periode
     *
     * BKD per semester (tahun_id SIAKAD), SKP per tahun.
     *
     * `POST /v1/sdm/kinerja/periode`
     *
     * scope: `sdm:admin`
     *
     * @param array{jenis: string, nama: string|null, tahun_id?: string|null, mulai: string|null, selesai: string|null, batas_pengisian?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerjaPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah periode
     *
     * `PUT /v1/sdm/kinerja/periode/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID periode
     * @param array{jenis: string, nama: string|null, tahun_id?: string|null, mulai: string|null, selesai: string|null, batas_pengisian?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKinerjaPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/kinerja/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekap periode
     *
     * Jumlah per status, kesimpulan, dan predikat.
     *
     * `GET /v1/sdm/kinerja/periode/{id}/rekap`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID periode
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKinerjaPeriodeByIdRekap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/kinerja/periode/{id}/rekap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar laporan kinerja
     *
     * `sebagai=penilai` = yang harus Anda nilai.
     *
     * `GET /v1/sdm/kinerja`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{periode_id?: string, pegawai_id?: string, status?: string, jenis?: string, kesimpulan?: string, unit_id?: string, sebagai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKinerja(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/kinerja', [], $query, null, $options, false, false);
    }

    /**
     * Buat laporan kinerja
     *
     * Untuk diri sendiri atau oleh petugas. Penilai SKP diisi dari atasan.
     *
     * `POST /v1/sdm/kinerja`
     *
     * scope: `sdm:write`
     *
     * @param array{periode_id: int|null, pegawai_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerja(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah butir kegiatan
     *
     * Pegawai saat draft/dikembalikan; penilai mengisi kolom penilaian.
     *
     * `PUT /v1/sdm/kinerja/item/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID butir
     * @param array{unsur: string, kegiatan: string|null, uraian?: string|null, indikator?: string|null, target?: float|int|null, satuan?: string|null, realisasi?: float|int|null, sks_rencana?: float|int|null, sks_realisasi?: float|int|null, bukti?: string|null, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKinerjaItemById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/kinerja/item/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus butir kegiatan
     *
     * `DELETE /v1/sdm/kinerja/item/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKinerjaItemById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/kinerja/item/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail laporan kinerja
     *
     * Butir kegiatan, total SKS per unsur, ringkasan syarat BKD, dan hak Anda.
     *
     * `GET /v1/sdm/kinerja/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKinerjaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/kinerja/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah laporan kinerja
     *
     * Catatan, penilai (petugas).
     *
     * `PUT /v1/sdm/kinerja/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan_pegawai?: string|null, penilai1_id?: int|null, penilai2_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKinerjaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/kinerja/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus draf laporan kinerja (BKD/SKP)
     *
     * Pegawai pemilik atau petugas SDM unitnya; hanya status draft yang belum pernah dikirim (SKP: rencana belum diajukan ke atasan). 409 `bukan_draf`, 403 `bukan_pemilik`. Kegiatan, data pelengkap BKD/SKP, penilaian, tautan asesor, dan linimasa ikut terhapus; bukti berkas terpusat pindah ke Sampah.
     *
     * `DELETE /v1/sdm/kinerja/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKinerjaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/kinerja/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah butir kegiatan
     *
     * `POST /v1/sdm/kinerja/{id}/item`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{unsur: string, kegiatan: string|null, uraian?: string|null, indikator?: string|null, target?: float|int|null, satuan?: string|null, realisasi?: float|int|null, sks_rencana?: float|int|null, sks_realisasi?: float|int|null, bukti?: string|null, urut?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerjaByIdItem(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja/{id}/item', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Isi butir dari SIAKAD
     *
     * Mengajar (t_jadwal dan team teaching), bimbingan tugas akhir (t_mahasiswa_ta), dan jabatan/tugas tambahan. Aman diulang (butir yang sama diperbarui).
     *
     * `POST /v1/sdm/kinerja/{id}/tarik-siakad`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerjaByIdTarikSiakad(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja/{id}/tarik-siakad', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kinerja: Ajukan ke penilai
     *
     * `POST /v1/sdm/kinerja/{id}/ajukan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{item?: list<mixed>, catatan_penilai?: string|null, predikat?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerjaByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kinerja: Simpan penilaian (penilai/asesor)
     *
     * `POST /v1/sdm/kinerja/{id}/nilai`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{item?: list<mixed>, catatan_penilai?: string|null, predikat?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerjaByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kinerja: Kembalikan untuk diperbaiki
     *
     * `POST /v1/sdm/kinerja/{id}/kembalikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{item?: list<mixed>, catatan_penilai?: string|null, predikat?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerjaByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kinerja: Sahkan (pimpinan/admin)
     *
     * `POST /v1/sdm/kinerja/{id}/sahkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{item?: list<mixed>, catatan_penilai?: string|null, predikat?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKinerjaByIdSahkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/kinerja/{id}/sahkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dasbor BKD saya
     *
     * Periode BKD yang dibuka (belum dimulai), laporan per semester dengan ringkasan per bidang, tahap, dan pembebasan.
     *
     * `GET /v1/sdm/bkd/saya`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/saya', [], $query, null, $options, false, false);
    }

    /**
     * Antrean BKD saya
     *
     * menilai (asesor), mengetahui (Kaprodi/Dekan), menetapkan (Biro SDM).
     *
     * `GET /v1/sdm/bkd/antrean`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Asesor eksternal: lihat laporan (tanpa login)
     *
     * Lewat tautan bertoken dari Biro SDM: identitas dosen, kegiatan, bukti, hasil hitung, penilaian asesor ini.
     *
     * `GET /v1/sdm/bkd/tamu/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdTamuByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/tamu/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Asesor eksternal: simpan/kirim penilaian (tanpa login)
     *
     * Isi sama dengan /laporan/{id}/nilai (item M/TM, catatan, selesai).
     *
     * `POST /v1/sdm/bkd/tamu/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param array{item: list<mixed>, catatan?: string|null, selesai?: bool, asesor_ke?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdTamuByToken(int|string $token, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/tamu/{token}', ['token' => $token], $options['query'] ?? [], $body, $options, false, true);
    }

    /**
     * Asesor eksternal: unduh bukti (tanpa login)
     *
     * Hanya berkas kegiatan laporan tautan ini.
     *
     * `GET /v1/sdm/bkd/tamu/{token}/berkas/{uuid}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param int|string $uuid UUID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdTamuByTokenBerkasByUuid(int|string $token, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/tamu/{token}/berkas/{uuid}', ['token' => $token, 'uuid' => $uuid], $query, null, $options, false, true);
    }

    /**
     * Status BKD dosen per semester
     *
     * N periode BKD terakhir: hasil per semester (memenuhi, tidak_memenuhi, dibebaskan, belum_ditetapkan, tidak_ada_laporan), jumlah memenuhi, berturut-turut memenuhi dari yang terbaru. Hanya laporan yang ditetapkan SDM dihitung. Dipakai syarat karier (fungsi BkdService::statusBkdDosen).
     *
     * `GET /v1/sdm/bkd/dosen/{id}/status`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{semester?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdDosenByIdStatus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/dosen/{id}/status', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode BKD
     *
     * Dengan versi aturan, jadwal tahap, dan tahap hari ini.
     *
     * `GET /v1/sdm/bkd/periode`
     *
     * scope: `sdm:read`
     *
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/periode', [], $query, null, $options, false, false);
    }

    /**
     * Buka periode BKD
     *
     * `POST /v1/sdm/bkd/periode`
     *
     * scope: `sdm:admin`
     *
     * @param array{nama: string|null, tahun_id?: string|null, mulai: string|null, selesai: string|null, status?: string, aturan_id?: int|null, rencana_selesai?: string|null, kirim_selesai?: string|null, penilaian_selesai?: string|null, penetapan_selesai?: string|null, penugasan_asesor?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail periode BKD
     *
     * `GET /v1/sdm/bkd/periode/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah periode BKD
     *
     * `PUT /v1/sdm/bkd/periode/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID periode
     * @param array{nama: string|null, tahun_id?: string|null, mulai: string|null, selesai: string|null, status?: string, aturan_id?: int|null, rencana_selesai?: string|null, kirim_selesai?: string|null, penilaian_selesai?: string|null, penetapan_selesai?: string|null, penugasan_asesor?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBkdPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/bkd/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekap BKD periode
     *
     * Setiap dosen dalam cakupan (Biro SDM: unitnya; Kaprodi/Dekan: prodi/fakultasnya): tahap, SKS, kesimpulan; jumlah per tahap, kesimpulan, prodi, fakultas.
     *
     * `GET /v1/sdm/bkd/periode/{id}/rekap`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID periode
     * @param array{unit_id?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdPeriodeByIdRekap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/periode/{id}/rekap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tugaskan asesor otomatis
     *
     * Asesor terdaftar dengan beban terkecil yang lolos aturan (bukan diri sendiri, bukan satu prodi bila dilarang, kuota).
     *
     * `POST /v1/sdm/bkd/periode/{id}/tugaskan-asesor`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdPeriodeByIdTugaskanAsesor(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/periode/{id}/tugaskan-asesor', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tetapkan banyak laporan
     *
     * `POST /v1/sdm/bkd/periode/{id}/tetapkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdPeriodeByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/periode/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Asesor BKD terdaftar
     *
     * Dengan beban penilaian pada periode_id.
     *
     * `GET /v1/sdm/bkd/asesor`
     *
     * scope: `sdm:read`
     *
     * @param array{periode_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdAsesor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/asesor', [], $query, null, $options, false, false);
    }

    /**
     * Daftarkan asesor
     *
     * `POST /v1/sdm/bkd/asesor`
     *
     * scope: `sdm:admin`
     *
     * @param array{pegawai_id: int|null, nira?: string|null, asal?: string, pt_asal?: string|null, kode_prodi?: string|null, bidang_ilmu?: string|null, berlaku_sampai?: string|null, kuota?: int|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdAsesor(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/asesor', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah asesor
     *
     * `PUT /v1/sdm/bkd/asesor/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{pegawai_id: int|null, nira?: string|null, asal?: string, pt_asal?: string|null, kode_prodi?: string|null, bidang_ilmu?: string|null, berlaku_sampai?: string|null, kuota?: int|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBkdAsesorById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/bkd/asesor/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus asesor
     *
     * `DELETE /v1/sdm/bkd/asesor/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBkdAsesorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/bkd/asesor/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Versi aturan BKD
     *
     * Paket persyaratan BKD berversi per dasar hukum, dengan SK registri dan jumlah periode pemakai.
     *
     * `GET /v1/sdm/bkd/aturan`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Draf aturan BKD baru
     *
     * `POST /v1/sdm/bkd/aturan`
     *
     * scope: `sdm:admin`
     *
     * @param array{nama?: string|null, dasar_hukum?: string|null, berlaku_mulai?: string|null, catatan_perubahan?: string|null, sk_id?: string|null, isi?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail aturan BKD
     *
     * Isi lengkap, perubahan terhadap versi asal, periode pemakai, riwayat perubahan.
     *
     * `GET /v1/sdm/bkd/aturan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah draf aturan BKD
     *
     * Versi terbit dikunci; salin untuk mengubah.
     *
     * `PUT /v1/sdm/bkd/aturan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{nama?: string|null, dasar_hukum?: string|null, berlaku_mulai?: string|null, catatan_perubahan?: string|null, sk_id?: string|null, isi?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBkdAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/bkd/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin menjadi versi baru
     *
     * `POST /v1/sdm/bkd/aturan/{id}/salin`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdAturanByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/aturan/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banding dua versi aturan
     *
     * `GET /v1/sdm/bkd/aturan/{id}/banding`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdAturanByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/aturan/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau dampak ke periode
     *
     * Kesimpulan setiap laporan periode dengan aturan sekarang vs versi ini, tanpa menyimpan.
     *
     * `GET /v1/sdm/bkd/aturan/{id}/pratinjau`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array{periode_id: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdAturanByIdPratinjau(int|string $id, array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/aturan/{id}/pratinjau', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Terapkan versi ke periode
     *
     * Kunci versi ini untuk periode dan hitung ulang laporan yang belum ditetapkan.
     *
     * `POST /v1/sdm/bkd/aturan/{id}/terapkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdAturanByIdTerapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/aturan/{id}/terapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan BKD: Terbitkan draf
     *
     * `POST /v1/sdm/bkd/aturan/{id}/terbitkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdAturanByIdTerbitkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/aturan/{id}/terbitkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan BKD: Arsipkan versi terbit
     *
     * `POST /v1/sdm/bkd/aturan/{id}/arsipkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdAturanByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/aturan/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan BKD: Hapus draf
     *
     * `POST /v1/sdm/bkd/aturan/{id}/hapus`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdAturanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/aturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mulai laporan BKD
     *
     * Dosen sendiri, atau petugas untuk dosen (pegawai_id). Versi aturan mengikuti periode.
     *
     * `POST /v1/sdm/bkd/laporan`
     *
     * scope: `sdm:write`
     *
     * @param array{periode_id: int|null, pegawai_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah kegiatan BKD
     *
     * `PUT /v1/sdm/bkd/kegiatan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID butir
     * @param array{kategori?: string|null, kegiatan?: string|null, uraian?: string|null, volume?: float|int|null, sks_dasar?: float|int|null, sks_rencana?: float|int|null, sks_realisasi?: float|int|null, bukti?: string|null, sister_url?: string|null, masa?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putBkdKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/bkd/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kegiatan BKD
     *
     * `DELETE /v1/sdm/bkd/kegiatan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBkdKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/bkd/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail laporan BKD
     *
     * Kegiatan + kategori + penilaian asesor, hasil hitung per bidang dan syarat aturan, pemeriksaan sebelum kirim, alur pemeriksa, dan hak.
     *
     * `GET /v1/sdm/bkd/laporan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBkdLaporanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/bkd/laporan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus draf laporan BKD
     *
     * Pegawai pemilik atau petugas SDM unitnya; hanya status draft yang belum pernah dikirim (SKP: rencana belum diajukan ke atasan). 409 `bukan_draf`, 403 `bukan_pemilik`. Kegiatan, data pelengkap BKD/SKP, penilaian, tautan asesor, dan linimasa ikut terhapus; bukti berkas terpusat pindah ke Sampah.
     *
     * `DELETE /v1/sdm/bkd/laporan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBkdLaporanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/bkd/laporan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah kegiatan BKD
     *
     * `POST /v1/sdm/bkd/laporan/{id}/kegiatan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{kategori?: string|null, kegiatan?: string|null, uraian?: string|null, volume?: float|int|null, sks_dasar?: float|int|null, sks_rencana?: float|int|null, sks_realisasi?: float|int|null, bukti?: string|null, sister_url?: string|null, masa?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdKegiatan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/kegiatan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Impor kegiatan dari SIAKAD
     *
     * Kelas diampu, bimbingan dan pengujian TA, penelitian/pengabdian LPPM, tugas tambahan (riwayat jabatan, Organisasi). `sumber` (opsional): mengajar, bimbingan, penguji, penelitian, pengabdian, tugas_tambahan.
     *
     * `POST /v1/sdm/bkd/laporan/{id}/impor`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdImpor(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/impor', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: Kembali ke penyusunan rencana
     *
     * `POST /v1/sdm/bkd/laporan/{id}/fase-rencana`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdFaseRencana(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/fase-rencana', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * BKD: Rencana selesai, isi realisasi dan bukti
     *
     * `POST /v1/sdm/bkd/laporan/{id}/fase-pelaksanaan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdFasePelaksanaan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/fase-pelaksanaan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * BKD: Kirim ke asesor
     *
     * Ditolak bila ada blokir (bukti wajib, SKS kosong, fase). Aturan kepegawaian titik sdm.kinerja.ajukan tetap ditegakkan. Asesor ditugaskan otomatis bila periode otomatis.
     *
     * `POST /v1/sdm/bkd/laporan/{id}/kirim`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdKirim(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/kirim', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: Penilaian asesor (M/TM per kegiatan)
     *
     * Simpan sementara atau kirim (selesai=true). Setelah semua asesor selesai: status dinilai, kesimpulan dihitung dari aturan.
     *
     * `POST /v1/sdm/bkd/laporan/{id}/nilai`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{item: list<mixed>, catatan?: string|null, selesai?: bool, asesor_ke?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: Kembalikan untuk diperbaiki
     *
     * Asesor (saat dinilai asesor), Kaprodi/Dekan atau Biro SDM (sesudah dinilai). Wajib `catatan`.
     *
     * `POST /v1/sdm/bkd/laporan/{id}/kembalikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: Kaprodi/Dekan mengetahui
     *
     * `sebagai` kaprodi | dekan, `catatan` opsional.
     *
     * `POST /v1/sdm/bkd/laporan/{id}/mengetahui`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdMengetahui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/mengetahui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: SDM menetapkan
     *
     * Setelah dinilai dan diketahui Kaprodi/Dekan (bila diwajibkan aturan).
     *
     * `POST /v1/sdm/bkd/laporan/{id}/tetapkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: Tugaskan asesor
     *
     * `penilai1_id`, `penilai2_id` (pegawai). Dicek: bukan diri sendiri, terdaftar, tidak satu prodi bila dilarang.
     *
     * `POST /v1/sdm/bkd/laporan/{id}/asesor`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan_pegawai?: string|null, penilai1_id?: int|null, penilai2_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdAsesor(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/asesor', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: Tindak lanjut tidak memenuhi
     *
     * `tindak_lanjut` (Biro SDM).
     *
     * `POST /v1/sdm/bkd/laporan/{id}/tindak-lanjut`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdTindakLanjut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/tindak-lanjut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * BKD: Tautan penilaian asesor eksternal
     *
     * `asesor_ke` 1|2, `hari` (bawaan 14, maks 30). Token acak, hanya hash disimpan, tautan lama slot itu dicabut; token tampil sekali.
     *
     * `POST /v1/sdm/bkd/laporan/{id}/tautan-asesor`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBkdLaporanByIdTautanAsesor(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/bkd/laporan/{id}/tautan-asesor', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar usulan
     *
     * Kenaikan jabatan akademik, pangkat, KGB, sertifikasi dosen, dll. `antrean=1`: hanya usulan berjenjang yang tahapnya bisa diputus pengguna ini (Kaprodi, Dekan, Tim PAK, Biro SDM). `tahap=siap_sk`: siap ditetapkan dengan SK (antrean Rektorat). Setiap baris memuat `status_label` untuk alur berjenjang.
     *
     * `GET /v1/sdm/usulan`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{jenis?: string, status?: string, pegawai_id?: string, alur?: string, tahap?: string, antrean?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/usulan', [], $query, null, $options, false, false);
    }

    /**
     * Buat usulan
     *
     * Syarat dicek otomatis dan disimpan bersama usulan.
     *
     * `POST /v1/sdm/usulan`
     *
     * scope: `sdm:write`
     *
     * @param array{pegawai_id?: int|null, jenis: string, ke_id?: int|null, loncat_jabatan?: bool, ak_pendidikan?: float|int|null, ak_penelitian?: float|int|null, ak_pengabdian?: float|int|null, ak_penunjang?: float|int|null, publikasi_khusus?: int|null, uji_kompetensi?: string, gaji_pokok_baru?: float|int|null, tmt_usulan?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail usulan
     *
     * Termasuk hasil cek syarat terkini dan file.
     *
     * `GET /v1/sdm/usulan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/usulan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah usulan
     *
     * Saat draft atau dikembalikan.
     *
     * `PUT /v1/sdm/usulan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{pegawai_id?: int|null, jenis: string, ke_id?: int|null, loncat_jabatan?: bool, ak_pendidikan?: float|int|null, ak_penelitian?: float|int|null, ak_pengabdian?: float|int|null, ak_penunjang?: float|int|null, publikasi_khusus?: int|null, uji_kompetensi?: string, gaji_pokok_baru?: float|int|null, tmt_usulan?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUsulanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/usulan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus draf usulan
     *
     * Pegawai pengusul atau petugas SDM unitnya; hanya status draft (yang sudah diajukan: /batal). 409 `bukan_draf`, 403 `bukan_pemilik`. Dihapus lunak, tercatat di linimasa dan log; file pendukung ke Sampah.
     *
     * `DELETE /v1/sdm/usulan/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUsulanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/usulan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Usulan: Ajukan (berjenjang: ke Kaprodi; ajukan ulang setelah dikembalikan)
     *
     * `POST /v1/sdm/usulan/{id}/ajukan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan: Verifikasi (alur lama: petugas; berjenjang: Kaprodi lalu Dekan)
     *
     * `POST /v1/sdm/usulan/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan: Kembalikan ke pengusul dengan catatan (berjenjang: Kaprodi, Dekan, Tim PAK)
     *
     * `POST /v1/sdm/usulan/{id}/kembalikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan: Nilai angka kredit (Tim PAK, izin sdm.pak.nilai): pak_pendidikan, pak_penelitian, pak_pengabdian, pak_penunjang, hasil memenuhi|tidak_memenuhi, catatan
     *
     * `POST /v1/sdm/usulan/{id}/nilai`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan: Tandai dikirim/diajukan ke LLDIKTI/Kementerian (nomor_usulan)
     *
     * `POST /v1/sdm/usulan/{id}/kirim`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdKirim(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/kirim', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan: Tetapkan dengan SK; riwayat baru dibuat otomatis. Berjenjang: sk_id SK terbit di registri (SK Rektor untuk AA/Lektor, SK luar untuk LK/Profesor) atau sk_luar {nomor, tanggal, penerbit_luar, berkas_id}; tmt_sk wajib
     *
     * `POST /v1/sdm/usulan/{id}/tetapkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan: Tolak
     *
     * `POST /v1/sdm/usulan/{id}/tolak`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan: Batalkan
     *
     * `POST /v1/sdm/usulan/{id}/batal`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array{catatan?: string|null, nomor_usulan?: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, tmt_sk?: string|null, sk_id?: string|null, sk_luar?: array<string, mixed>, pak_pendidikan?: float|int|null, pak_penelitian?: float|int|null, pak_pengabdian?: float|int|null, pak_penunjang?: float|int|null, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar usulan pejabat struktural
     *
     * Usulan pengangkatan pejabat oleh pimpinan unit (izin sdm.pejabat.usul berlingkup unit) atau Biro SDM. Pengusul melihat usulan unitnya; Biro SDM, Rektor, dan pencatat SK Rektorat melihat semua. Tiap baris memuat aksi_boleh dan sk (registri).
     *
     * `GET /v1/sdm/usulan-pejabat`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{status?: string, unit_id?: string, pegawai_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulanPejabat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/usulan-pejabat', [], $query, null, $options, false, false);
    }

    /**
     * Buat usulan pejabat
     *
     * Body: unit_id, jabatan_id, pegawai_id (calon; bukan pengusul sendiri), dasar (pemilihan_senat | penunjukan | lainnya), dasar_nomor, dasar_tanggal, dasar_berkas_uuid (berita acara/notulen dari /v1/berkas), mulai, selesai, jenis_penugasan (definitif | plt | plh), alasan. Pemegang jabatan yang sama di unit itu tidak mengusulkan jabatannya sendiri.
     *
     * `POST /v1/sdm/usulan-pejabat`
     *
     * scope: `sdm:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit dan jabatan yang boleh diusulkan
     *
     * Unit dalam lingkup izin sdm.pejabat.usul pengguna (semua untuk Biro SDM); dengan unit_id: jabatan yang tersedia di unit itu (aturan jenis unit dan penyesuaian unit dari Organisasi) beserta pemegang aktifnya.
     *
     * `GET /v1/sdm/usulan-pejabat/pilihan`
     *
     * scope: `sdm:read`
     *
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulanPejabatPilihan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/usulan-pejabat/pilihan', [], $query, null, $options, false, false);
    }

    /**
     * Detail usulan pejabat
     *
     * Termasuk SK pengangkatan (registri), pemegang jabatan saat ini, pejabat yang ditetapkan, linimasa, aksi_boleh, dan isian_pejabat (isian awal form pejabat bersama).
     *
     * `GET /v1/sdm/usulan-pejabat/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulanPejabatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/usulan-pejabat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah usulan pejabat
     *
     * Pengusul, saat draf atau dikembalikan.
     *
     * `PUT /v1/sdm/usulan-pejabat/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUsulanPejabatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/usulan-pejabat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus draf usulan pejabat
     *
     * Pengusul atau yang berhak mengusulkan di unit itu; hanya status draft (yang sudah diajukan: /batal). 409 `bukan_draf`, 403 `bukan_pemilik`. Dihapus lunak, tercatat di linimasa dan log.
     *
     * `DELETE /v1/sdm/usulan-pejabat/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUsulanPejabatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/usulan-pejabat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Usulan pejabat: Ajukan (berkas dasar wajib)
     *
     * `POST /v1/sdm/usulan-pejabat/{id}/ajukan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabatByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pejabat: Setujui dengan SK pengangkatan terbit di registri (sk_id; satu SK boleh untuk banyak usulan). Rektor, pencatat SK Rektorat, atau Biro SDM
     *
     * `POST /v1/sdm/usulan-pejabat/{id}/setujui`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabatByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pejabat: Kembalikan ke pengusul (catatan wajib)
     *
     * `POST /v1/sdm/usulan-pejabat/{id}/kembalikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabatByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pejabat: Tolak (catatan wajib)
     *
     * `POST /v1/sdm/usulan-pejabat/{id}/tolak`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabatByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pejabat: Tetapkan pejabat di data induk dengan SK usulan (mulai, selesai, jenis_penugasan, akhiri_lama opsional); peran jabatan otomatis aktif selama masa SK. Izin sdm.pejabat.kelola atau pustikom.organisasi.kelola
     *
     * `POST /v1/sdm/usulan-pejabat/{id}/tetapkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabatByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pejabat: Tautkan pejabat yang sudah disimpan lewat form pejabat bersama (pejabat_id)
     *
     * `POST /v1/sdm/usulan-pejabat/{id}/tautkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabatByIdTautkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat/{id}/tautkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pejabat: Batalkan
     *
     * `POST /v1/sdm/usulan-pejabat/{id}/batal`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanPejabatByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan-pejabat/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Versi aturan karier
     *
     * Syarat kenaikan jabatan fungsional, pangkat/golongan, dan sertifikasi dosen berversi per dasar hukum (sdm_aturan_versi jenis karier), dengan SK registri, tanggal berlaku, penanda versi yang berlaku sekarang, dan jumlah usulan yang mengunci versi itu.
     *
     * `GET /v1/sdm/karier/aturan`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKarierAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/karier/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Draf aturan karier baru
     *
     * Body: nama, dasar_hukum, berlaku_tanggal, catatan_perubahan, isi (bawaan dari master), sk_id. Admin SDM.
     *
     * `POST /v1/sdm/karier/aturan`
     *
     * scope: `sdm:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKarierAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/karier/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan karier yang berlaku sekarang
     *
     * Isi lengkap versi terbit yang berlaku hari ini (null bila belum ada).
     *
     * `GET /v1/sdm/karier/aturan/berlaku`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKarierAturanBerlaku(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/karier/aturan/berlaku', [], $query, null, $options, false, false);
    }

    /**
     * Detail aturan karier
     *
     * Isi lengkap, perubahan terhadap versi asal, usulan yang mengunci versi ini, riwayat perubahan, referensi (jabatan akademik, golongan, jenis luaran LPPM).
     *
     * `GET /v1/sdm/karier/aturan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKarierAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/karier/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah draf aturan karier
     *
     * Versi terbit dikunci; salin untuk mengubah.
     *
     * `PUT /v1/sdm/karier/aturan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKarierAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/karier/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin menjadi versi baru (draf)
     *
     * `POST /v1/sdm/karier/aturan/{id}/salin`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKarierAturanByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/karier/aturan/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banding dua versi
     *
     * Bawaan dibanding versi yang berlaku sekarang.
     *
     * `GET /v1/sdm/karier/aturan/{id}/banding`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKarierAturanByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/karier/aturan/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau dampak
     *
     * Berapa dosen aktif yang memenuhi syarat kenaikan jabatan fungsional berikutnya dengan aturan sekarang vs versi ini, tanpa menyimpan.
     *
     * `GET /v1/sdm/karier/aturan/{id}/pratinjau`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKarierAturanByIdPratinjau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/karier/aturan/{id}/pratinjau', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan karier: Terbitkan (draf -> terbit; berlaku mulai berlaku_tanggal)
     *
     * `POST /v1/sdm/karier/aturan/{id}/terbitkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKarierAturanByIdTerbitkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/karier/aturan/{id}/terbitkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan karier: Arsipkan versi terbit
     *
     * `POST /v1/sdm/karier/aturan/{id}/arsipkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKarierAturanByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/karier/aturan/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan karier: Hapus draf
     *
     * `POST /v1/sdm/karier/aturan/{id}/hapus`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKarierAturanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/karier/aturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Versi rubrik DUPAK
     *
     * Rubrik DUPAK berversi (sdm_aturan_versi jenis dupak): unsur, sub-unsur, butir kegiatan (kode, uraian, satuan, angka kredit, batas per semester/pengajuan, bukti wajib, jabatan yang boleh, sumber isi otomatis), komposisi unsur per jabatan tujuan. Dengan SK registri, tanggal berlaku, penanda versi berlaku, dan jumlah pengajuan yang mengunci versi itu.
     *
     * `GET /v1/sdm/dupak/aturan`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDupakAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/dupak/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Draf rubrik DUPAK baru
     *
     * Body: nama, dasar_hukum, berlaku_tanggal, catatan_perubahan, isi, sk_id. Admin SDM.
     *
     * `POST /v1/sdm/dupak/aturan`
     *
     * scope: `sdm:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rubrik DUPAK yang berlaku sekarang
     *
     * Null bila belum ada versi terbit.
     *
     * `GET /v1/sdm/dupak/aturan/berlaku`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDupakAturanBerlaku(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/dupak/aturan/berlaku', [], $query, null, $options, false, false);
    }

    /**
     * Detail rubrik DUPAK
     *
     * Isi lengkap, perubahan dari versi asal, pengajuan yang mengunci versi ini, riwayat, referensi (jabatan akademik, sumber isi otomatis, jenis luaran LPPM).
     *
     * `GET /v1/sdm/dupak/aturan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDupakAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/dupak/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah draf rubrik DUPAK
     *
     * Versi terbit dikunci; salin untuk mengubah.
     *
     * `PUT /v1/sdm/dupak/aturan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDupakAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/dupak/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin rubrik menjadi versi baru (draf)
     *
     * `POST /v1/sdm/dupak/aturan/{id}/salin`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakAturanByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/aturan/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banding dua versi rubrik
     *
     * Bawaan dibanding versi yang berlaku sekarang.
     *
     * `GET /v1/sdm/dupak/aturan/{id}/banding`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDupakAturanByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/dupak/aturan/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rubrik DUPAK: Terbitkan (draf -> terbit; berlaku mulai berlaku_tanggal)
     *
     * `POST /v1/sdm/dupak/aturan/{id}/terbitkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakAturanByIdTerbitkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/aturan/{id}/terbitkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rubrik DUPAK: Arsipkan versi terbit
     *
     * `POST /v1/sdm/dupak/aturan/{id}/arsipkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakAturanByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/aturan/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rubrik DUPAK: Hapus draf
     *
     * `POST /v1/sdm/dupak/aturan/{id}/hapus`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakAturanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/aturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Semester dalam periode penilaian
     *
     * `GET /v1/sdm/dupak/semester`
     *
     * scope: `sdm:read`
     *
     * @param array{mulai: string, selesai: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDupakSemester(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/dupak/semester', [], $query, null, $options, false, false);
    }

    /**
     * Daftar DUPAK
     *
     * `sebagai=saya` (bawaan) DUPAK milik pengguna; `antrean` yang tahapnya bisa diputus pengguna (Dekan/Tim PAK fakultas, Tim PAK universitas, Biro SDM); `semua` yang boleh dilihat. Tiap baris memuat status_label, AK usul/diakui per unsur, dan aksi_boleh.
     *
     * `GET /v1/sdm/dupak`
     *
     * scope: `sdm:read`
     *
     * @param array{sebagai?: string, status?: string, pegawai_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDupak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/dupak', [], $query, null, $options, false, false);
    }

    /**
     * Buat draf DUPAK
     *
     * Body: periode_mulai, periode_selesai (tahun_id), jabatan_tujuan_id (bawaan satu jenjang di atas), pegawai_id (petugas), catatan_pengusul, tarik (bawaan true: butir terisi otomatis dari jadwal, BKD, bimbingan, LP2M, luaran). Rubrik = versi yang berlaku.
     *
     * `POST /v1/sdm/dupak`
     *
     * scope: `sdm:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupak(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah butir DUPAK
     *
     * kode_butir, uraian, semester, tanggal, volume, porsi. Saat draf/dikembalikan.
     *
     * `PUT /v1/sdm/dupak/butir/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDupakButirById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/dupak/butir/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus butir DUPAK
     *
     * `DELETE /v1/sdm/dupak/butir/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDupakButirById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/dupak/butir/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail DUPAK
     *
     * Butir + bukti, ringkasan hitung (AK per unsur, peringatan batas/komposisi, blokir), rubrik versi yang dipakai, komposisi jabatan tujuan, linimasa, pemeriksa, aksi_boleh, dan dampak ke syarat AK aturan karier.
     *
     * `GET /v1/sdm/dupak/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDupakById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/dupak/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah draf DUPAK
     *
     * periode_mulai, periode_selesai, jabatan_tujuan_id, catatan_pengusul.
     *
     * `PUT /v1/sdm/dupak/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDupakById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/dupak/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus draf DUPAK
     *
     * Dosen pemilik atau petugas SDM unitnya; hanya status draf (409 `bukan_draf`; yang sudah diajukan dibatalkan lewat /batal). Butir, linimasa, dan bukti ikut terhapus; bukti berkas terpusat pindah ke Sampah. Respons: jumlah butir dan berkas.
     *
     * `DELETE /v1/sdm/dupak/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDupakById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/dupak/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi otomatis butir
     *
     * Tambah butir dari jadwal mengajar, BKD disahkan, bimbingan/pengujian TA, penelitian/PkM LP2M, dan luaran terverifikasi sesuai rubrik; yang sudah ada tidak digandakan.
     *
     * `POST /v1/sdm/dupak/{id}/tarik`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdTarik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/tarik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah butir DUPAK
     *
     * kode_butir (rubrik), uraian, semester, tanggal, volume, porsi. Bukti: POST /v1/sdm/file entitas dupak_butir.
     *
     * `POST /v1/sdm/dupak/{id}/butir`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdButir(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/butir', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * DUPAK: ajukan
     *
     * Ajukan (pengusul). Versi rubrik dikunci saat pertama diajukan; ditolak bila ada blokir (butir kosong, bukti wajib butir manual).
     *
     * `POST /v1/sdm/dupak/{id}/ajukan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * DUPAK: verifikasi
     *
     * Verifikasi fakultas (Dekan/Tim PAK fakultas). Body: butir[{id, ak, catatan}] opsional (AK fakultas), catatan.
     *
     * `POST /v1/sdm/dupak/{id}/verifikasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * DUPAK: nilai
     *
     * Nilai Tim PAK universitas (izin sdm.pak.nilai). Body: butir[{id, ak, catatan}] opsional (AK diakui; bawaan AK fakultas/usul), catatan.
     *
     * `POST /v1/sdm/dupak/{id}/nilai`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * DUPAK: tetapkan
     *
     * Tetapkan PAK (Biro SDM): nomor_pak, tanggal_pak. AK kumulatif = AK dasar + AK diakui, langsung dibaca syarat AK aturan karier.
     *
     * `POST /v1/sdm/dupak/{id}/tetapkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * DUPAK: kembalikan
     *
     * Kembalikan ke pengusul (catatan wajib); penilaian dihapus, versi rubrik tetap.
     *
     * `POST /v1/sdm/dupak/{id}/kembalikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * DUPAK: tolak
     *
     * Tolak (catatan wajib).
     *
     * `POST /v1/sdm/dupak/{id}/tolak`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * DUPAK: batal
     *
     * Batalkan (pengusul).
     *
     * `POST /v1/sdm/dupak/{id}/batal`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDupakByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/dupak/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Versi komponen SKP
     *
     * Komponen SKP berversi (sdm_aturan_versi jenis skp): jenis hasil kerja, aspek indikator, perilaku kerja, rumus nilai (bobot), predikat. SK registri, tanggal berlaku, jumlah laporan yang mengunci versi.
     *
     * `GET /v1/sdm/skp/aturan`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/skp/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Draf komponen SKP baru
     *
     * `POST /v1/sdm/skp/aturan`
     *
     * scope: `sdm:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komponen SKP yang berlaku sekarang
     *
     * `GET /v1/sdm/skp/aturan/berlaku`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpAturanBerlaku(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/skp/aturan/berlaku', [], $query, null, $options, false, false);
    }

    /**
     * Detail komponen SKP
     *
     * `GET /v1/sdm/skp/aturan/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/skp/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah draf komponen SKP
     *
     * `PUT /v1/sdm/skp/aturan/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkpAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/skp/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin komponen SKP menjadi versi baru (draf)
     *
     * `POST /v1/sdm/skp/aturan/{id}/salin`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpAturanByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/aturan/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banding dua versi komponen SKP
     *
     * `GET /v1/sdm/skp/aturan/{id}/banding`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpAturanByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/skp/aturan/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komponen SKP: Terbitkan
     *
     * `POST /v1/sdm/skp/aturan/{id}/terbitkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpAturanByIdTerbitkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/aturan/{id}/terbitkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komponen SKP: Arsipkan versi terbit
     *
     * `POST /v1/sdm/skp/aturan/{id}/arsipkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpAturanByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/aturan/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komponen SKP: Hapus draf
     *
     * `POST /v1/sdm/skp/aturan/{id}/hapus`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpAturanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/aturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar SKP
     *
     * `sebagai=saya` (bawaan), `antrean` (yang menunggu persetujuan rencana/penilaian/pengesahan Anda), `semua` (yang boleh dilihat).
     *
     * `GET /v1/sdm/skp`
     *
     * scope: `sdm:read`
     *
     * @param array{sebagai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkp(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/skp', [], $query, null, $options, false, false);
    }

    /**
     * Mulai SKP periode
     *
     * Body: periode_id (periode SKP dibuka), pegawai_id (petugas). Atasan langsung jadi penilai.
     *
     * `POST /v1/sdm/skp`
     *
     * scope: `sdm:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkp(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail SKP
     *
     * Rencana hasil kerja + indikator + aspek, realisasi, capaian, perilaku, hitung nilai/predikat menurut versi aturan, linimasa, pemeriksa, aksi_boleh.
     *
     * `GET /v1/sdm/skp/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/skp/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus draf SKP
     *
     * Pegawai pemilik atau petugas SDM unitnya; hanya status draft yang belum pernah dikirim (SKP: rencana belum diajukan ke atasan). 409 `bukan_draf`, 403 `bukan_pemilik`. Kegiatan, data pelengkap BKD/SKP, penilaian, tautan asesor, dan linimasa ikut terhapus; bukti berkas terpusat pindah ke Sampah.
     *
     * `DELETE /v1/sdm/skp/{id}`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSkpById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/skp/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan rencana SKP
     *
     * item[{id?, jenis, rencana, indikator, aspek, target, satuan, uraian}]; yang tidak dikirim dihapus. Saat rencana draf/dikembalikan.
     *
     * `PUT /v1/sdm/skp/{id}/rencana`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkpByIdRencana(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/skp/{id}/rencana', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Isi realisasi SKP
     *
     * item[{id, realisasi}]. Bukti: POST /v1/sdm/file entitas kinerja_item.
     *
     * `PUT /v1/sdm/skp/{id}/realisasi`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkpByIdRealisasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/skp/{id}/realisasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKP: ajukan_rencana
     *
     * Ajukan rencana ke atasan
     *
     * `POST /v1/sdm/skp/{id}/ajukan_rencana`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpByIdAjukanRencana(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/{id}/ajukan_rencana', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKP: setujui_rencana
     *
     * Atasan menyetujui rencana
     *
     * `POST /v1/sdm/skp/{id}/setujui_rencana`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpByIdSetujuiRencana(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/{id}/setujui_rencana', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKP: kembalikan_rencana
     *
     * Atasan mengembalikan rencana (catatan wajib)
     *
     * `POST /v1/sdm/skp/{id}/kembalikan_rencana`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpByIdKembalikanRencana(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/{id}/kembalikan_rencana', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKP: kirim
     *
     * Kirim realisasi untuk dinilai
     *
     * `POST /v1/sdm/skp/{id}/kirim`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpByIdKirim(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/{id}/kirim', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKP: nilai
     *
     * Atasan menilai: item[{id, capaian, catatan}] opsional, perilaku {kode: 0-100}; nilai dan predikat dihitung dari rumus versi aturan
     *
     * `POST /v1/sdm/skp/{id}/nilai`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKP: kembalikan
     *
     * Atasan mengembalikan realisasi (catatan wajib)
     *
     * `POST /v1/sdm/skp/{id}/kembalikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKP: sahkan
     *
     * Biro SDM mengesahkan; predikat dibaca syarat kenaikan pangkat
     *
     * `POST /v1/sdm/skp/{id}/sahkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpByIdSahkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/skp/{id}/sahkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hitung angka kredit (simulasi PAK)
     *
     * Angka kredit baru sejak TMT jabatan akademik dari BKD yang disahkan (pendidikan, penunjang), luaran LPPM terverifikasi (penelitian, buku ajar; bagian penulis utama/anggota), dan pengabdian LPPM yang selesai. Dibandingkan dengan angka kredit minimal, proporsi penelitian, dan publikasi khusus jenjang tujuan. Koefisien di pengaturan pak_*.
     *
     * `GET /v1/sdm/pegawai/{id}/pak`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{ke_id?: string, sejak?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/pak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi angka kredit usulan dari hitung PAK
     *
     * Mengisi ak_pendidikan, ak_penelitian, ak_pengabdian, ak_penunjang (yang diakui setelah batas), dan publikasi_khusus usulan jabatan akademik. Hak sama dengan ubah usulan.
     *
     * `POST /v1/sdm/usulan/{id}/hitung-ak`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID atau UUID usulan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulanByIdHitungAk(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/usulan/{id}/hitung-ak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Portofolio dosen
     *
     * Profil, pendidikan, jabatan akademik dan struktural, sertifikasi, penghargaan, pengajaran per semester (t_jadwal), bimbingan dan pengujian TA, penelitian, pengabdian, publikasi terverifikasi (LPPM), dan BKD.
     *
     * `GET /v1/sdm/pegawai/{id}/portofolio`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{semester?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPortofolio(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/portofolio', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pajak honor
     *
     * Persen PPh 21 honor/vakasi/remunerasi untuk pegawai ber-NPWP dan tanpa NPWP (honor_pph_*), dipakai saat hitung dan honor manual.
     *
     * `GET /v1/sdm/honor/pengaturan`
     *
     * scope: `gaji:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHonorPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/honor/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah pajak honor
     *
     * Pengelola gaji BAUK. Kirim hanya kunci yang berubah (0-100).
     *
     * `PUT /v1/sdm/honor/pengaturan`
     *
     * scope: `gaji:write`
     *
     * @param array{honor_pph_persen?: string, honor_pph_tanpa_npwp_persen?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putHonorPengaturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/honor/pengaturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Statistik honor
     *
     * Enam periode terakhir yang punya data: bruto, pajak, netto per periode (dan status bayar), per kelompok, per unit. Pengelola gaji BAUK.
     *
     * `GET /v1/sdm/honor/statistik`
     *
     * scope: `gaji:read`
     *
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHonorStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/honor/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Komponen honor yang dihitung otomatis
     *
     * Kode komponen, kelompok (remunerasi/honor/vakasi), dan satuannya.
     *
     * `GET /v1/sdm/honor/komponen`
     *
     * scope: `gaji:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHonorKomponen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/honor/komponen', [], $query, null, $options, false, false);
    }

    /**
     * Tarif honor
     *
     * Tarif per komponen, bisa dibedakan menurut jabatan akademik dan kategori dosen.
     *
     * `GET /v1/sdm/honor/tarif`
     *
     * scope: `gaji:read`
     *
     * @param array{komponen?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHonorTarif(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/honor/tarif', [], $query, null, $options, false, false);
    }

    /**
     * Tambah tarif
     *
     * `POST /v1/sdm/honor/tarif`
     *
     * scope: `gaji:write`
     *
     * @param array{komponen: string|null, nama: string|null, satuan: string|null, tarif: float|int|null, jabatan_akademik_id?: int|null, kategori?: string, berlaku_mulai?: string|null, berlaku_sampai?: string|null, aktif?: bool, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHonorTarif(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/honor/tarif', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah tarif
     *
     * Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/sdm/honor/tarif/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID tarif
     * @param array{komponen: string|null, nama: string|null, satuan: string|null, tarif: float|int|null, jabatan_akademik_id?: int|null, kategori?: string, berlaku_mulai?: string|null, berlaku_sampai?: string|null, aktif?: bool, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putHonorTarifById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/honor/tarif/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus tarif
     *
     * `DELETE /v1/sdm/honor/tarif/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID tarif
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteHonorTarifById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/honor/tarif/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hitung honor, vakasi, dan remunerasi satu semester
     *
     * Dari t_dosen_presensi (mengajar), t_jadwal_ujian + t_mahasiswa_krs (vakasi soal/koreksi, pengawas), t_mahasiswa_ta (bimbingan, penguji), jabatan akademik (remunerasi P1), dan BKD disahkan (remunerasi P2: kelebihan SKS). Hanya baris draft yang diperbarui; aman diulang. Tabel SIAKAD hanya dibaca.
     *
     * `POST /v1/sdm/honor/hitung`
     *
     * scope: `gaji:write`
     *
     * @param array{periode: string|null, komponen?: list<mixed>|null, pegawai_id?: int|null, unit_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHonorHitung(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/honor/hitung', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekap honor per pegawai
     *
     * Total remunerasi, honor, vakasi, lainnya, bruto, pajak, netto per pegawai (tanpa yang batal). BAUK semua pegawai; pegawai hanya miliknya; petugas/pimpinan SDM sesuai unit.
     *
     * `GET /v1/sdm/honor/rekap`
     *
     * scope: `gaji:read`
     *
     * @param array{periode?: string, kelompok?: string, status?: string, unit_id?: string, pegawai_id?: string, saya?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHonorRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/honor/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Hak saya atas honor
     *
     * Dihitung server dengan aturan yang sama dengan proses: kelola (pengelola gaji BAUK: tambah, hitung, bayar), setujui (Kepala BAUK/admin gaji: setujui, kembalikan, batalkan). Untuk menampilkan tombol di aplikasi.
     *
     * `GET /v1/sdm/honor/hak`
     *
     * scope: `gaji:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHonorHak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/honor/hak', [], $query, null, $options, false, false);
    }

    /**
     * Setujui, bayar, kembalikan, atau batalkan honor
     *
     * Massal sampai 1000 baris; baris yang statusnya tidak cocok dilewati. setujui/kembalikan/batal: Kepala BAUK (admin gaji); bayar: pengelola gaji.
     *
     * `POST /v1/sdm/honor/proses`
     *
     * scope: `gaji:write`
     *
     * @param array{aksi: string, id: list<mixed>, nomor_bukti?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHonorProses(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/honor/proses', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar honor
     *
     * Beserta rincian dasar perhitungan. BAUK semua pegawai; pegawai hanya miliknya (aplikasi Profil); petugas/pimpinan SDM sesuai unit.
     *
     * `GET /v1/sdm/honor`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{periode?: string, komponen?: string, kelompok?: string, status?: string, pegawai_id?: string, unit_id?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHonor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/honor', [], $query, null, $options, false, false);
    }

    /**
     * Tambah honor manual
     *
     * Kegiatan di luar perhitungan otomatis (panitia, narasumber, dll.). periode = bulan YYYY-MM atau semester (tahun_id terdaftar di m_tahun); format lain 422 berbahasa awam. Tarif dari Tarif honor yang berlaku (tarif isian hanya bila komponen belum bertarif); PPh selalu dari Pajak honor.
     *
     * `POST /v1/sdm/honor`
     *
     * scope: `gaji:write`
     *
     * @param array{periode: string|null, pegawai_id: int|null, kelompok: string, komponen: string|null, uraian: string|null, volume: float|int|null, satuan?: string|null, tarif: float|int|null, pajak_persen?: float|int|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHonor(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/honor', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ringkasan
     *
     * Jumlah pegawai per jenis, status, jabatan akademik, golongan, pendidikan, serdos; cuti dan verifikasi yang menunggu.
     *
     * `GET /v1/sdm/laporan/ringkasan`
     *
     * scope: `sdm:read`
     *
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/laporan/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Pengingat
     *
     * Pensiun, KGB, kenaikan pangkat, sertifikat dan kontrak yang akan habis dalam N hari.
     *
     * `GET /v1/sdm/laporan/pengingat`
     *
     * scope: `sdm:read`
     *
     * @param array{hari?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanPengingat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/laporan/pengingat', [], $query, null, $options, false, false);
    }

    /**
     * Daftar urut kepangkatan (DUK)
     *
     * Urut golongan, TMT, jabatan, masa kerja, pendidikan, usia.
     *
     * `GET /v1/sdm/laporan/duk`
     *
     * scope: `sdm:read`
     *
     * @param array{jenis?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanDuk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/laporan/duk', [], $query, null, $options, false, false);
    }

    /**
     * Dosen per prodi
     *
     * Jumlah dosen tetap, jabatan akademik, pendidikan S3, serdos, dan rasio mahasiswa aktif per dosen (untuk akreditasi).
     *
     * `GET /v1/sdm/laporan/dosen-prodi`
     *
     * scope: `sdm:read`
     *
     * @param array{kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanDosenProdi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/laporan/dosen-prodi', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pegawai (unduh)
     *
     * Satu baris per pegawai: identitas kepegawaian, unit, golongan, jabatan akademik, pendidikan, serdos, masa kerja, usia, perkiraan pensiun. Tanpa data pribadi. Bawaan hanya yang masih bekerja; status_aktif memilih satu status.
     *
     * `GET /v1/sdm/laporan/pegawai`
     *
     * scope: `sdm:read`
     *
     * @param array{jenis?: string, status_aktif?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanPegawai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/laporan/pegawai', [], $query, null, $options, false, false);
    }

    /**
     * Rekap cuti tahunan
     *
     * Per pegawai: jumlah pengajuan, hari cuti disetujui per jenis, ditolak, dan sisa cuti tahunan.
     *
     * `GET /v1/sdm/laporan/cuti`
     *
     * scope: `sdm:read`
     *
     * @param array{tahun?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanCuti(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/laporan/cuti', [], $query, null, $options, false, false);
    }

    /**
     * Rekap usulan kenaikan
     *
     * Usulan yang dibuat dalam satu tahun: jenis, status, angka kredit, nomor dan tanggal SK.
     *
     * `GET /v1/sdm/laporan/usulan`
     *
     * scope: `sdm:read`
     *
     * @param array{tahun?: string, jenis?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanUsulan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/laporan/usulan', [], $query, null, $options, false, false);
    }

    /**
     * Statistik kepegawaian
     *
     * Komposisi pegawai (jenis, status, pendidikan, jabatan, golongan, usia, masa kerja, per unit), tren masuk/keluar 10 tahun + proyeksi pensiun 5 tahun, presensi per bulan, cuti per jenis/bulan, BKD/SKP per periode, usulan per jenis/status, dan antrean pekerjaan SDM (statistik honor: GET /v1/sdm/honor/statistik, BAUK). Dibatasi cakupan pemilik token. `bagian` memuat satu kelompok saja.
     *
     * `GET /v1/sdm/statistik`
     *
     * scope: `sdm:read`
     *
     * @param array{tahun?: string, unit_id?: string, bagian?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Daftar SOP dan kebijakan
     *
     * Dokumen mutu SPMI unit SDM (kebijakan, pedoman, SOP, instruksi kerja, formulir, SK) beserta file. Pegawai melihat yang disahkan; admin SDM juga draf. lingkup=semua: kebijakan yang disahkan semua unit (transparansi), bisa disaring unit_id (spmi_unit).
     *
     * `GET /v1/sdm/sop`
     *
     * scope: `sdm:read`
     *
     * @param array{lingkup?: string, jenis?: string, status?: string, unit_id?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSop(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sop', [], $query, null, $options, false, false);
    }

    /**
     * Tambah dokumen SDM
     *
     * Admin SDM. Isian dokumen mutu SPMI: jenis, nomor, judul, versi, ringkasan, tanggal_penetapan, berlaku_mulai, tinjau_berikutnya, ditetapkan_oleh, nomor_penetapan, tautan, publik, menggantikan_id. Dokumen baru berstatus draf; disahkan lewat /sop/{id}/ajukan lalu alur pengesahan (setelah sah hanya bisa ditandai kedaluwarsa/dicabut). Unit selalu SDM; penulis dicatat sebagai pengelola SPMI unit SDM.
     *
     * `POST /v1/sdm/sop`
     *
     * scope: `sdm:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSop(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sop', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah dokumen SDM
     *
     * Kirim hanya kolom yang berubah. Untuk versi baru, buat dokumen baru dengan menggantikan_id.
     *
     * `PUT /v1/sdm/sop/{id}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID dokumen
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSopById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/sdm/sop/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan dokumen SDM untuk disahkan
     *
     * Admin SDM. Draf/dikembalikan masuk alur pengesahan dokumen mutu yang berlaku untuk unit SDM (diatur LPM di /v1/spmi/alur; bawaan: admin SDM -> validasi LPM -> pemegang izin sdm.setujui/Kepala Biro SDM). Body opsional: catatan.
     *
     * `POST /v1/sdm/sop/{id}/ajukan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID dokumen
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSopByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sop/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Setujui/sahkan dokumen SDM
     *
     * Pelaku tahap berjalan alur pengesahan (mis. LPM lalu Kepala Biro SDM). Tahap terakhir = disahkan (berlaku dan terlihat semua pegawai). Pengusul tidak memutus usulannya sendiri. Body opsional: catatan.
     *
     * `POST /v1/sdm/sop/{id}/setujui`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID dokumen
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSopByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sop/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kembalikan dokumen SDM ke pengusul
     *
     * Pelaku tahap berjalan. Body: catatan (wajib, alasan).
     *
     * `POST /v1/sdm/sop/{id}/kembalikan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID dokumen
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSopByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sop/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unggah file dokumen
     *
     * multipart field `berkas` atau JSON berkas_base64 + nama_file (PDF/Office/gambar).
     *
     * `POST /v1/sdm/sop/{id}/file`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID dokumen
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSopByIdFile(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sop/{id}/file', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh file dokumen
     *
     * Dokumen disahkan bisa diunduh semua pegawai. inline=1 untuk ditampilkan.
     *
     * `GET /v1/sdm/sop/file/{uuid}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $uuid ID file
     * @param array{inline?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSopFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sop/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Hapus file dokumen
     *
     * `DELETE /v1/sdm/sop/file/{uuid}`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $uuid ID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSopFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/sdm/sop/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Status integrasi SISTER
     *
     * Pengaturan koneksi (tanpa kata sandi), jumlah pegawai terhubung, proses tarik terakhir, dan daftar jenis data.
     *
     * `GET /v1/sdm/sister/status`
     *
     * scope: `sdm:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterStatus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/status', [], $query, null, $options, false, false);
    }

    /**
     * Jenis data SISTER
     *
     * Jenis data yang ditarik (path endpoint SISTER), kelompoknya, dan jenis riwayat SDM yang diisi darinya.
     *
     * `GET /v1/sdm/sister/jenis`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan koneksi SISTER
     *
     * Mode (sandbox/produksi), alamat, username, id_pengguna, status token, hasil uji terakhir. Kata sandi tidak pernah ditampilkan.
     *
     * `GET /v1/sdm/sister/pengaturan`
     *
     * scope: `sdm:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan pengaturan koneksi SISTER
     *
     * Kredensial dari menu "Kredensial API" di SISTER (peran SISTER WS-Basic). Kirim hanya kunci yang berubah; password disimpan terenkripsi, "" = tidak diubah, null = hapus. Nilai SISTER_* di .env menimpa pengaturan ini.
     *
     * `POST /v1/sdm/sister/pengaturan`
     *
     * scope: `sdm:admin`
     *
     * @param array{mode?: string, username?: string|null, password?: string|null, id_pengguna?: string|null, id_perguruan_tinggi?: string|null, url_sandbox?: string|null, url_produksi?: string|null, aktif?: bool, kirim_mode?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterPengaturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/pengaturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Uji koneksi SISTER
     *
     * Meminta token baru ke /authorize; bila `nidn` dikirim, sekalian mencari di /referensi/sdm. Hasil (berhasil/gagal) selalu 200.
     *
     * `POST /v1/sdm/sister/uji`
     *
     * scope: `sdm:admin`
     *
     * @param array{nidn?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterUji(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/uji', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cari SDM di SISTER
     *
     * Langsung ke GET /referensi/sdm SISTER. Isi salah satu: nidn, nip, nuptk, atau nama (minimal 3 huruf). id_sp hanya ikut bila mencari nama (aturan SISTER). Setiap hasil diberi `terhubung_ke` bila id_sdm sudah dipetakan.
     *
     * `GET /v1/sdm/sister/sdm`
     *
     * scope: `sdm:admin`
     *
     * @param array{nidn?: string, nip?: string, nuptk?: string, nama?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterSdm(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/sdm', [], $query, null, $options, false, false);
    }

    /**
     * Cocokkan pegawai dengan SISTER
     *
     * Pegawai yang belum terhubung dicari di /referensi/sdm lewat NIDN, lalu NIP, lalu NUPTK; dipasangkan hanya bila hasilnya tepat satu. Diproses per batch (`batas`); ulangi sampai `sisa` 0.
     *
     * `POST /v1/sdm/sister/cocokkan`
     *
     * scope: `sdm:admin`
     *
     * @param array{pegawai_id?: list<mixed>|null, batas?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterCocokkan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/cocokkan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pegawai dan status SISTER
     *
     * Daftar pegawai beserta id_sdm, status di SISTER, dan hasil tarik terakhir.
     *
     * `GET /v1/sdm/sister/pegawai`
     *
     * scope: `sdm:admin` · berhalaman
     *
     * @param array{status?: string, jenis?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterPegawai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/pegawai', [], $query, null, $options, false, false);
    }

    /**
     * Tarik data SISTER banyak pegawai
     *
     * Pegawai yang paling lama tidak ditarik diproses lebih dulu, sebanyak `batas` (bawaan 10). Ulangi sampai `sisa` 0, atau biarkan cron `php artisan sdm:sister tarik --cron` yang mengerjakan.
     *
     * `POST /v1/sdm/sister/tarik`
     *
     * scope: `sdm:admin`
     *
     * @param array{pegawai_id?: list<mixed>|null, jenis?: list<mixed>|null, batas?: int|null, umur_jam?: int|null, cocokkan_dulu?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterTarik(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/tarik', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Log tarik data SISTER
     *
     * Setiap proses tarik: pemicu, pelaku, jumlah pegawai, ringkasan per jenis, galat.
     *
     * `GET /v1/sdm/sister/log`
     *
     * scope: `sdm:admin` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/log', [], $query, null, $options, false, false);
    }

    /**
     * Teruskan GET ke SISTER
     *
     * Untuk aplikasi lain yang butuh data SISTER mentah tanpa menyimpan kredensial SISTER sendiri. `path` hanya: referensi/<nama>, data_pribadi/<bagian>/<id_sdm>, atau jenis data (mis. penelitian, penelitian/<id>). Parameter lain diteruskan sebagai query (mis. id_sdm).
     *
     * `GET /v1/sdm/sister/teruskan`
     *
     * scope: `sdm:admin`
     *
     * @param array{path: string, id_sdm?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterTeruskan(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/teruskan', [], $query, null, $options, false, false);
    }

    /**
     * Antrean kirim ke SISTER
     *
     * Perubahan riwayat SDM yang dikirim ke SISTER: aksi (tambah/ubah/hapus), status (menunggu, terkirim, tersinkron, gagal, ditolak, dibatalkan), isian terakhir, jawaban SISTER, galat.
     *
     * `GET /v1/sdm/sister/kirim`
     *
     * scope: `sdm:admin` · berhalaman
     *
     * @param array{status?: string, pegawai_id?: string, riwayat_jenis?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterKirim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/kirim', [], $query, null, $options, false, false);
    }

    /**
     * Kirim antrean ke SISTER sekarang
     *
     * Mengirim antrean yang menunggu (dan yang gagal bila sudah waktunya diulang). Isi `id` untuk mengirim baris tertentu. Butuh kirim_mode manual atau otomatis. Isian yang ditolak SISTER (4xx) berstatus ditolak dan tidak diulang otomatis.
     *
     * `POST /v1/sdm/sister/kirim/proses`
     *
     * scope: `sdm:admin`
     *
     * @param array{batas?: int|null, id?: list<mixed>|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterKirimProses(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/kirim/proses', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Antrekan riwayat lama
     *
     * Masukkan riwayat yang sudah disetujui, bukan berasal dari SISTER, dan belum pernah diantrekan ke antrean kirim. Dipakai sekali saat kirim pertama dinyalakan.
     *
     * `POST /v1/sdm/sister/kirim/antrekan`
     *
     * scope: `sdm:admin`
     *
     * @param array{pegawai_id?: list<mixed>|null, jenis?: list<mixed>|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterKirimAntrekan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/kirim/antrekan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pratinjau kiriman
     *
     * Metode, path, dan isian JSON yang akan dikirim ke SISTER untuk satu riwayat, tanpa mengirim. Pakai untuk memeriksa pemetaan config/sister.php di sandbox.
     *
     * `GET /v1/sdm/sister/kirim/pratinjau`
     *
     * scope: `sdm:admin`
     *
     * @param array{riwayat_jenis: string, riwayat_id: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSisterKirimPratinjau(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/sister/kirim/pratinjau', [], $query, null, $options, false, false);
    }

    /**
     * Ulangi kiriman
     *
     * Kembalikan baris gagal/ditolak/dibatalkan ke status menunggu (setelah data atau pemetaan diperbaiki).
     *
     * `POST /v1/sdm/sister/kirim/{id}/ulang`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID antrean
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterKirimByIdUlang(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/kirim/{id}/ulang', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan kiriman
     *
     * Baris yang belum terkirim tidak akan dikirim.
     *
     * `POST /v1/sdm/sister/kirim/{id}/batal`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID antrean
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSisterKirimByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/sister/kirim/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SISTER: ringkasan pegawai
     *
     * id_sdm, status di SISTER, hasil tarik terakhir, dan jumlah item tersimpan per jenis.
     *
     * `GET /v1/sdm/pegawai/{id}/sister`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdSister(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/sister', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SISTER: tarik data pegawai
     *
     * Petugas SDM unitnya, admin, atau pegawai itu sendiri (dengan jeda minimal, bawaan 10 menit). `jenis` opsional: kunci jenis, nama kelompok (kepegawaian, tridharma, penunjang, dokumen), atau data_pribadi; kosong = semua.
     *
     * `POST /v1/sdm/pegawai/{id}/sister/tarik`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis?: list<mixed>|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdSisterTarik(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/sister/tarik', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SISTER: bandingkan profil
     *
     * Data pribadi SISTER (hasil tarik terakhir) dibanding profil pegawai, dengan daftar kolom yang berbeda.
     *
     * `GET /v1/sdm/pegawai/{id}/sister/profil`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdSisterProfil(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/sister/profil', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SISTER: terapkan profil
     *
     * Salin kolom pilihan dari data pribadi SISTER ke profil pegawai (petugas SDM). Validasi dan log sama dengan ubah pegawai.
     *
     * `POST /v1/sdm/pegawai/{id}/sister/terapkan-profil`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{kolom: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdSisterTerapkanProfil(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/sister/terapkan-profil', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SISTER: hubungkan manual
     *
     * Pasangkan pegawai dengan id_sdm tertentu (mis. NIDN di SIAKAD berbeda dengan SISTER). id_sdm diperiksa ke SISTER.
     *
     * `POST /v1/sdm/pegawai/{id}/sister/hubungkan`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{id_sdm: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdSisterHubungkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/sister/hubungkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SISTER: lepas pemetaan
     *
     * Hapus pemetaan dan salinan data SISTER pegawai ini. Riwayat SDM yang sudah dibuat dari SISTER tetap ada.
     *
     * `POST /v1/sdm/pegawai/{id}/sister/lepas`
     *
     * scope: `sdm:admin`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdSisterLepas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/sister/lepas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SISTER: status kirim pegawai
     *
     * Riwayat pegawai ini yang dikirim ke SISTER beserta statusnya. Pegawai itu sendiri dan petugas SDM.
     *
     * `GET /v1/sdm/pegawai/{id}/sister/kirim`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdSisterKirim(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/sister/kirim', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SISTER: data pribadi pegawai
     *
     * Salinan data pribadi SISTER per bagian (profil, kepegawaian, alamat, kependudukan, keluarga, bidang_ilmu, lain). Hanya pegawai itu dan petugas SDM.
     *
     * `GET /v1/sdm/pegawai/{id}/sister/data_pribadi/{bagian}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param int|string $bagian profil | kepegawaian | alamat | kependudukan | keluarga | bidang_ilmu | lain
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdSisterDataPribadiByBagian(int|string $id, int|string $bagian, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/sister/data_pribadi/{bagian}', ['id' => $id, 'bagian' => $bagian], $query, null, $options, false, false);
    }

    /**
     * SISTER: data pegawai per jenis
     *
     * Item SISTER tersimpan (JSON asli di `data`). Jenis = kunci di GET /v1/sdm/sister/jenis (data pribadi: pakai rute data_pribadi/{bagian}).
     *
     * `GET /v1/sdm/pegawai/{id}/sister/{jenis}`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param int|string $jenis Jenis data, mis. penelitian, publikasi, jabatan_fungsional
     * @param array{tahun?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdSisterByJenis(int|string $id, int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/sister/{jenis}', ['id' => $id, 'jenis' => $jenis], $query, null, $options, false, false);
    }

    /**
     * Daftar pemberhentian
     *
     * Pemberhentian pegawai (terjadwal, diproses, gagal, dibatalkan, dipulihkan). Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `GET /v1/sdm/pemberhentian`
     *
     * scope: `sdm:read` · berhalaman
     *
     * @param array{status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemberhentian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pemberhentian', [], $query, null, $options, false, false);
    }

    /**
     * Alat sapu: kandidat
     *
     * Pegawai yang di data lama sudah keluar/nonaktif (status SDM, status m_dosen/m_karyawan, tanggal pensiun, batas usia pensiun) tetapi masih punya akun aktif, peran, jabatan, atau petugas: alasan deteksi dan pratinjau dampak. Tidak mengubah data. Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `GET /v1/sdm/pemberhentian/kandidat`
     *
     * scope: `sdm:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemberhentianKandidat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pemberhentian/kandidat', [], $query, null, $options, false, false);
    }

    /**
     * Alat sapu: proses massal
     *
     * Memproses kandidat yang dipilih (wajib konfirmasi: true). Setiap pegawai dicatat sebagai pemberhentian sumber sapu dengan jenis dan tanggal usulan, lalu langsung diproses. Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `POST /v1/sdm/pemberhentian/sapu`
     *
     * scope: `sdm:write`
     *
     * @param array{pegawai_id: list<mixed>, konfirmasi: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemberhentianSapu(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pemberhentian/sapu', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail pemberhentian
     *
     * Termasuk keadaan sebelum diproses dan hasil tiap langkah. Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `GET /v1/sdm/pemberhentian/{id}`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID pemberhentian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemberhentianById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pemberhentian/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Proses sekarang
     *
     * Proses pemberhentian yang tanggal efektifnya sudah tiba (terjadwal atau gagal; aman diulang). Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `POST /v1/sdm/pemberhentian/{id}/proses`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID pemberhentian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemberhentianByIdProses(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pemberhentian/{id}/proses', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan pemberhentian terjadwal
     *
     * Body opsional {alasan}. Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `POST /v1/sdm/pemberhentian/{id}/batal`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID pemberhentian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemberhentianByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pemberhentian/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aktifkan kembali
     *
     * Akun dan status pegawai dipulihkan; peran TIDAK otomatis dipulihkan: kirim `penugasan` (ID penugasan sebelumnya) dan `petugas` yang dipilih ulang. Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `POST /v1/sdm/pemberhentian/{id}/pulihkan`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID pemberhentian
     * @param array{alasan: string|null, keliru?: bool, penugasan?: list<mixed>, petugas?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemberhentianByIdPulihkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pemberhentian/{id}/pulihkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keluar/nonaktif: ringkasan pegawai
     *
     * Pemberhentian berjalan dan riwayatnya, pratinjau dampak (akun, sesi API, peran, jabatan, petugas), dan daftar serah terima (PA, TA, penguji, kelas, LMS) dengan tautan ke fitur pengalihan. Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `GET /v1/sdm/pegawai/{id}/pemberhentian`
     *
     * scope: `sdm:read`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawaiByIdPemberhentian(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sdm/pegawai/{id}/pemberhentian', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Proses keluar/nonaktif
     *
     * Catat pemberhentian (jenis, tanggal efektif, SK registri, catatan). Tanggal efektif hari ini/lampau langsung diproses: semua penugasan peran dan jabatan berakhir, petugas dinonaktifkan, akun SIAKAD/SSO nonaktif, token dan sesi dicabut, Pustikom dan pimpinan dinotifikasi. Admin SDM atau izin sdm.pemberhentian.kelola.
     *
     * `POST /v1/sdm/pegawai/{id}/pemberhentian`
     *
     * scope: `sdm:write`
     *
     * @param int|string $id ID angka, UUID, atau `saya`
     * @param array{jenis: string, tanggal_efektif: string|null, tanggal_kembali?: string|null, sk_id?: string|null, bukti?: string|null, catatan?: string|null, pertahankan_akun?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPegawaiByIdPemberhentian(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sdm/pegawai/{id}/pemberhentian', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
