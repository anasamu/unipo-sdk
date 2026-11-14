<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Data master: Struktur akademik, Data master: Mahasiswa dan dosen, Data master: Format dokumen akademik
 */
final class Master extends Resource
{
    /**
     * Tambah fakultas
     *
     * Body: kode_fakultas, nama_fakultas, opsional pejabat (NIDN dekan), jabatan, wakil_pejabat. Dekan dan wakil ditandai pejabat struktural seperti di web.
     *
     * `POST /v1/master/fakultas`
     *
     * scope: `master:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFakultas(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/master/fakultas', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah fakultas
     *
     * Kolom: nama_fakultas, pejabat, jabatan, wakil_pejabat, wakil_pejabat_adm. Kode tidak bisa diganti.
     *
     * `PATCH /v1/master/fakultas/{kode}`
     *
     * scope: `master:write`
     *
     * @param int|string $kode Kode fakultas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchFakultasByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/fakultas/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah jurusan
     *
     * Body: kode_fak, kode_jurusan, nama_jurusan.
     *
     * `POST /v1/master/jurusan`
     *
     * scope: `master:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJurusan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/master/jurusan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah jurusan
     *
     * Kolom: nama_jurusan.
     *
     * `PATCH /v1/master/fakultas/{fak}/jurusan/{kode}`
     *
     * scope: `master:write`
     *
     * @param int|string $fak Kode fakultas
     * @param int|string $kode Kode jurusan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchFakultasByFakJurusanByKode(int|string $fak, int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/fakultas/{fak}/jurusan/{kode}', ['fak' => $fak, 'kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah program studi
     *
     * Body: kode_prodi (harus ada di referensi PDDikti r_prodi; nama diambil dari sana), kode_fak, kode_jurusan, kode_jenjang, dan kolom lain seperti ubah prodi.
     *
     * `POST /v1/master/prodi`
     *
     * scope: `master:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProdi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/master/prodi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah program studi
     *
     * Kolom: alamat, kode_kabupaten, kode_propinsi, kode_pos, telepon, fax, email, website, sks_lulus, status_prodi,
     * tgl_awal_berdiri, semester_awal, mulai_semester, no_sk_dikti, tgl_sk_dikti, tgl_akhir_sk_dikti, no_sk_ban, no_sk_ban_lama,
     * tgl_sk_ban, tgl_akhir_sk_ban, kode_akreditasi, frekuensi_kurikulum, pelaksanaan_kurikulum, idd_ketua_prodi, hp_ketua,
     * idd_nama_operator, telepon_operator, nama_sesi, jumlah_sesi, batas_sesi, gelar, gelar_panjang. Kode prodi, fakultas,
     * jurusan, dan jenjang tidak bisa dipindah lewat API (di web ikut menyalin kode ke semua tabel).
     *
     * `PATCH /v1/master/prodi/{kode}`
     *
     * scope: `master:write`
     *
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchProdiByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/prodi/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konsentrasi/peminatan prodi
     *
     * Konsentrasi UMUM (kode 01) dibuat otomatis seperti di web.
     *
     * `GET /v1/master/prodi/{kode}/konsentrasi`
     *
     * scope: `referensi:read`
     *
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProdiByKodeKonsentrasi(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/master/prodi/{kode}/konsentrasi', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah konsentrasi
     *
     * Body: kode (1-2 karakter; idks = kode prodi + kode), konsentrasi (nama). Mata kuliah per konsentrasi diatur lewat kurikulum (kolom idks).
     *
     * `POST /v1/master/prodi/{kode}/konsentrasi`
     *
     * scope: `master:write`
     *
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProdiByKodeKonsentrasi(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/master/prodi/{kode}/konsentrasi', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah nama konsentrasi
     *
     * `PATCH /v1/master/prodi/{kode}/konsentrasi/{idks}`
     *
     * scope: `master:write`
     *
     * @param int|string $kode Kode prodi
     * @param int|string $idks ID konsentrasi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchProdiByKodeKonsentrasiByIdks(int|string $kode, int|string $idks, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/prodi/{kode}/konsentrasi/{idks}', ['kode' => $kode, 'idks' => $idks], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus konsentrasi
     *
     * Ditolak bila masih dipakai mahasiswa atau konsentrasi UMUM.
     *
     * `DELETE /v1/master/prodi/{kode}/konsentrasi/{idks}`
     *
     * scope: `master:write`
     *
     * @param int|string $kode Kode prodi
     * @param int|string $idks ID konsentrasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProdiByKodeKonsentrasiByIdks(int|string $kode, int|string $idks, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/master/prodi/{kode}/konsentrasi/{idks}', ['kode' => $kode, 'idks' => $idks], $query, null, $options, false, false);
    }

    /**
     * Ubah biodata mahasiswa
     *
     * Kolom: nama_mahasiswa, warga_negara, nik, status_sipil, agama, jenis_kelamin (L/P), tempat_lahir, tanggal_lahir, telepon, NIRM, asal_negara, asal_jenjang_emis, nisn, hp, email, shift, keb_khusus (daftar atau teks dipisah koma), toefl, npwp, lb_toefl. Nama dan email akun ikut diperbarui seperti di web. NIM tidak bisa diganti.
     *
     * `PATCH /v1/master/mahasiswa/{nim}/biodata`
     *
     * scope: `mahasiswa:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchMahasiswaByNimBiodata(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/mahasiswa/{nim}/biodata', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah alamat mahasiswa
     *
     * Kolom: alamat, dusun, rt, rw, desa, kecamatan, jenis_tinggal, kode_pos.
     *
     * `PATCH /v1/master/mahasiswa/{nim}/alamat`
     *
     * scope: `mahasiswa:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchMahasiswaByNimAlamat(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/mahasiswa/{nim}/alamat', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah data pribadi dosen
     *
     * Kolom: nama_dosen, gelar_depan, gelar_belakang, agama, jenis_kelamin, tempat_lahir, tanggal_lahir, ktp, nama_ibu, npwp, stat_kawin, nm_suami_istri, nip_suami_istri, id_pekerjaan_suami_istri, telephon, hp, email, nip_lama, akta_dos, kode_prodi (kode PT/fakultas/jurusan/jenjang ikut prodi). NIDN tidak bisa diganti dan password akun tidak direset.
     *
     * `PATCH /v1/master/dosen/{nidn}/pribadi`
     *
     * scope: `dosen:write`
     *
     * @param int|string $nidn NIDN
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchDosenByNidnPribadi(int|string $nidn, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/dosen/{nidn}/pribadi', ['nidn' => $nidn], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah alamat dosen
     *
     * Kolom: alamat, dusun, rt, rw, desa, kecamatan, kode_pos.
     *
     * `PATCH /v1/master/dosen/{nidn}/alamat`
     *
     * scope: `dosen:write`
     *
     * @param int|string $nidn NIDN
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchDosenByNidnAlamat(int|string $nidn, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/dosen/{nidn}/alamat', ['nidn' => $nidn], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah data akademik dosen
     *
     * Kolom: mulai_masuk, mulai_semester, kode_ikatan_kerja, kode_pendidikan, instansi_induk, sk_cpns, tgl_sk_cpns, sk_angkat, status_pegawai, tmt_sk_angkat, id_lemb_angkat, tmt_pns, status_aktif. kode_pendidikan ikut ke m_dosen_gaji tahun aktif seperti di web.
     *
     * `PATCH /v1/master/dosen/{nidn}/akademik`
     *
     * scope: `dosen:write`
     *
     * @param int|string $nidn NIDN
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchDosenByNidnAkademik(int|string $nidn, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/dosen/{nidn}/akademik', ['nidn' => $nidn], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah jabatan dosen
     *
     * Kolom: pangkat_golongan, jabatan_akademik, jabatan_fungsional, id_sumber_gaji, jabatan_struktural (ikut ke m_dosen_gaji tahun aktif).
     *
     * `PATCH /v1/master/dosen/{nidn}/jabatan`
     *
     * scope: `dosen:write`
     *
     * @param int|string $nidn NIDN
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchDosenByNidnJabatan(int|string $nidn, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/dosen/{nidn}/jabatan', ['nidn' => $nidn], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar format dokumen
     *
     * Format universitas (kode_prodi kosong) dan per prodi.
     *
     * `GET /v1/master/format-dokumen`
     *
     * scope: `referensi:read`
     *
     * @param array{jenis?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFormatDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/master/format-dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Tambah format dokumen
     *
     * Body: jenis, kode_prodi (kosong = universitas), judul, kertas (A4/F4/Letter/A5/kartu), orientasi (potret/lanskap), pengaturan (objek JSON bebas: kop, logo, warna, kolom, nomor, tanda_tangan, catatan_kaki), templat (HTML, dibersihkan), aktif. Satu format per jenis per prodi.
     *
     * `POST /v1/master/format-dokumen`
     *
     * scope: `master:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFormatDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/master/format-dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Format yang berlaku
     *
     * Format prodi, atau universitas bila prodi belum punya, atau bawaan; ditambah `desain_ttd` (m_ttd prodi untuk KRS/KHS/transkrip/DHS) dan daftar `variabel` {{...}} untuk templat. Dipakai aplikasi cetak.
     *
     * `GET /v1/master/format-dokumen/efektif/{jenis}`
     *
     * scope: `referensi:read`
     *
     * @param int|string $jenis Jenis dokumen
     * @param array{kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFormatDokumenEfektifByJenis(int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/master/format-dokumen/efektif/{jenis}', ['jenis' => $jenis], $query, null, $options, false, false);
    }

    /**
     * Ubah format dokumen
     *
     * `PATCH /v1/master/format-dokumen/{id}`
     *
     * scope: `master:write`
     *
     * @param int|string $id UUID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchFormatDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/format-dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus format dokumen
     *
     * `DELETE /v1/master/format-dokumen/{id}`
     *
     * scope: `master:write`
     *
     * @param int|string $id UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteFormatDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/master/format-dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Desain tanda tangan prodi
     *
     * Tabel lama m_ttd (menu Desain Tanda Tangan): ttd 1 = KRS, 2 = KHS, 3 = TRANSKRIP, 4 = DHS. Variabel: $tanggal, $ttd_mahasiswa, $foto_mhs, $ttd_dosen_pa, $ttd_pimpinan_kampus, $wakid1.
     *
     * `GET /v1/master/desain-ttd`
     *
     * scope: `referensi:read`
     *
     * @param array{kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDesainTtd(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/master/desain-ttd', [], $query, null, $options, false, false);
    }

    /**
     * Tambah desain tanda tangan
     *
     * Body: ttd (1-4), kode_prodi, desain (HTML, dibersihkan keamanan_tinymce seperti di web).
     *
     * `POST /v1/master/desain-ttd`
     *
     * scope: `master:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDesainTtd(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/master/desain-ttd', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah desain tanda tangan
     *
     * Body: desain.
     *
     * `PATCH /v1/master/desain-ttd/{id}`
     *
     * scope: `master:write`
     *
     * @param int|string $id ID m_ttd
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchDesainTtdById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/master/desain-ttd/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus desain tanda tangan
     *
     * `DELETE /v1/master/desain-ttd/{id}`
     *
     * scope: `master:write`
     *
     * @param int|string $id ID m_ttd
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDesainTtdById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/master/desain-ttd/{id}', ['id' => $id], $query, null, $options, false, false);
    }
}
