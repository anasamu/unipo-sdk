<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Aturan, Aturan: titik penerapan, Aturan: SK dan pengecualian, Aturan: pengatur dan pemeriksaan, Aturan: persetujuan
 */
final class Aturan extends Resource
{
    /**
     * Katalog titik penerapan, indikator, operator
     *
     * Titik penerapan (langkah bisnis yang menegakkan aturan, mis. `krs.ambil`, `nilai.input.dosen`, `wisuda.daftar`, `kkn.daftar`),
     * kategori dan jenis aturan yang boleh di tiap titik, indikator yang bisa dipakai di kondisi (IPK, SKS lulus, nilai D/E,
     * tunggakan, persen bayar, bebas pustaka, ...), dan operator. Dipakai form "tambah aturan" di aplikasi admin.
     *
     * Field untuk UI: titik `kelompok` (Akademik, Kelulusan, Keuangan, Kemahasiswaan, PMB, Akun, Kepegawaian, Mutu, Penelitian)
     * dan `contoh` (templat aturan siap pakai `[{judul, keterangan, kategori, jenis, mode, kondisi?, parameter?}]`);
     * indikator `kelompok`, `satuan` (SKS, %, Rp, tahun, hari), `pesan` bawaan, dan untuk tipe `pilihan` daftar `opsi`
     * `[{nilai, label}]` (dropdown; dinilai seperti teks dengan =, !=, dalam, bukan_dalam). Titik `pmb.daftar_ulang`
     * (subjek pendaftar) dan `akun.buat` (subjek calon akun) lihat docs/ATURAN.md.
     *
     * `GET /v1/aturan/katalog`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Daftar titik penerapan (bawaan dan kustom)
     *
     * Gabungan titik bawaan (kode, tidak bisa dihapus) dan titik kustom (`kustom.*`). Tiap titik: `kode`, `judul`, `keterangan`,
     * `unit`, `kelompok`, `kategori[]`, `subjek`, `jenis[]`, `konteks` = `[{kode, judul, tipe, opsi?}]`, `status_mahasiswa`,
     * `contoh`, `penerapan`, `pengatur` (`[{jenis, kode, sumber}]`), `aktif`, `bawaan`, `kustom`, `ditimpa` (bawaan yang
     * teksnya/aktifnya diubah), `jumlah_aturan_aktif`, `diubah_oleh`, `diubah_at`. Titik nonaktif: aturan di titik itu tidak
     * diperiksa (prasyarat bawaan kode tetap).
     *
     * `GET /v1/aturan/titik`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTitik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/titik', [], $query, null, $options, false, false);
    }

    /**
     * Tambah titik kustom (admin)
     *
     * Body: `{"kode": "kustom.sertifikasi_toefl", "judul": "...", "keterangan": "...", "unit": "baak", "kelompok": "Akademik",
     * "kategori": ["akademik"], "subjek": "mahasiswa" | "pegawai" | "pendaftar" | "umum", "jenis": ["syarat", "batas_waktu"],
     * "konteks": [{"kode": "skor_toefl", "judul": "Skor TOEFL", "tipe": "angka"}, {"kode": "jenis_tes", "judul": "Jenis tes", "tipe": "pilihan", "opsi": [{"nilai": "itp", "label": "TOEFL ITP"}]}],
     * "status_mahasiswa": ["A"], "contoh": [], "pengatur": [{"jenis": "peran", "kode": "bak"}], "aktif": true}`.
     * Kode `^kustom\.[a-z0-9_.]{2,60}$`, unik (dibuat klien dari nama). Aplikasi lain memakai titik ini lewat `POST /v1/aturan/periksa`
     * dengan konteks yang didefinisikan.
     *
     * `POST /v1/aturan/titik`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTitik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/titik', [], $query, null, $options, false, false);
    }

    /**
     * Detail titik
     *
     * Bentuk sama dengan butir daftar.
     *
     * `GET /v1/aturan/titik/{kode}`
     *
     * scope: `aturan:read`
     *
     * @param int|string $kode Kode titik, mis. krs.ambil atau kustom.skor_toefl
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTitikByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/titik/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah titik (admin)
     *
     * Titik bawaan: hanya judul, keterangan, unit, kelompok, contoh, pengatur, aktif (timpaan; kode tetap sumber). Titik kustom: semua isian kecuali kode; subjek tidak bisa diubah bila sudah ada aturan. pengatur = daftar {jenis, kode} untuk semua kategori titik ([] = kembali ke pengatur kategori).
     *
     * `POST /v1/aturan/titik/{kode}`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode titik, mis. krs.ambil atau kustom.skor_toefl
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTitikByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/titik/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus titik kustom (admin)
     *
     * Soft delete. Titik bawaan tidak bisa dihapus (409). Ditolak 409 bila masih ada aturan aktif/diajukan di titik itu; details.aturan = [{id, nama, status}].
     *
     * `POST /v1/aturan/titik/{kode}/hapus`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode titik, mis. krs.ambil atau kustom.skor_toefl
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTitikByKodeHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/titik/{kode}/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Daftar pengajuan pengecualian
     *
     * Pengajuan pengecualian yang bisa saya putus (pemutus: pengecualian_oleh aturan, bawaan pengatur titik) atau yang saya ajukan. Filter status (diajukan|disetujui|ditolak|dibatalkan), aturan (UUID), antrean=saya (hanya yang bisa saya putus), diajukan_saya=1. Tiap butir: {id, subjek_jenis, subjek, tahun_id, berlaku_sampai, alasan, dokumen: {berkas_id, jenis, nomor, tanggal, url_unduh}, status, diajukan_oleh, diajukan_at, diputus_oleh, diputus_at, catatan_putusan, aturan: {id, nama, titik, status}, boleh_putus}.
     *
     * `GET /v1/aturan/pengecualian/ajuan`
     *
     * scope: `aturan:read`
     *
     * @param array{status?: string, aturan?: string, antrean?: string, diajukan_saya?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengecualianAjuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/pengecualian/ajuan', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen pengajuan pengecualian
     *
     * Isi berkas dokumen pengajuan (302 ke URL sementara bila disimpan di bucket), seperti unduh lampiran SK. Hanya pemutus pengecualian aturan itu, admin aturan, atau pengaju. Butir ajuan memuat dokumen.url_unduh (path API ini).
     *
     * `GET /v1/aturan/pengecualian/ajuan/{ajuan}/dokumen`
     *
     * scope: `aturan:read`
     *
     * @param int|string $ajuan UUID pengajuan
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengecualianAjuanByAjuanDokumen(int|string $ajuan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/pengecualian/ajuan/{ajuan}/dokumen', ['ajuan' => $ajuan], $query, null, $options, false, false);
    }

    /**
     * Setujui pengajuan pengecualian
     *
     * Pemutus pengecualian aturan itu. Membuat pengecualian (cakupan subjek, periode, masa berlaku, dokumen) dan mencatat riwayat. Body opsional {"catatan"}.
     *
     * `POST /v1/aturan/pengecualian/ajuan/{ajuan}/setujui`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $ajuan UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengecualianAjuanByAjuanSetujui(int|string $ajuan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/pengecualian/ajuan/{ajuan}/setujui', ['ajuan' => $ajuan], $query, null, $options, false, false);
    }

    /**
     * Tolak pengajuan pengecualian
     *
     * Body {"catatan"} wajib.
     *
     * `POST /v1/aturan/pengecualian/ajuan/{ajuan}/tolak`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $ajuan UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengecualianAjuanByAjuanTolak(int|string $ajuan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/pengecualian/ajuan/{ajuan}/tolak', ['ajuan' => $ajuan], $query, null, $options, false, false);
    }

    /**
     * Hak saya mengatur aturan
     *
     * Per kategori: boleh mengatur atau tidak, prodi yang boleh diatur (null = semua), dan siapa pengaturnya.
     *
     * `GET /v1/aturan/saya`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pengatur per kategori
     *
     * Peran/izin RBAC yang berhak mengatur aturan tiap kategori (dan per titik bila disetel). Tanpa baris = izin bawaan aturan:<kategori> (peran bak untuk akademik/kelulusan/kemahasiswaan, keuangan untuk keuangan).
     *
     * `GET /v1/aturan/pengatur`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengatur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/pengatur', [], $query, null, $options, false, false);
    }

    /**
     * Atur siapa pengatur (admin)
     *
     * Body: `{"kategori": "akademik", "titik": "nilai.input.dosen" (opsional), "pengatur": [{"jenis": "peran", "kode": "bak"}, {"jenis": "peran", "kode": "kaprodi"}, {"jenis": "izin", "kode": "aturan:akademik"}]}`.
     * Mengganti seluruh daftar pengatur kategori itu (atau titik itu saja). `"pengatur": []` = kembali ke izin bawaan.
     * Peran berlingkup unit (mis. kaprodi, dekan) hanya bisa mengatur aturan yang cakupannya di unit itu.
     *
     * `POST /v1/aturan/pengatur`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array{kategori?: string|null, titik?: string|null, pengatur?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengatur(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/pengatur', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penyetuju aturan per kategori
     *
     * Untuk halaman "Pejabat penyetuju aturan". Per kategori: bidang pimpinan, jabatan_daftar (salah satu cukup), penyetuju.orang [{username, nama, sebagai, sumber: penugasan|jabatan}] (yang saat ini bisa menyetujui: pemegang izin aturan.setujui lewat RBAC Pustikom, bukan level SIAKAD lama), penyetuju.peran (peran yang perlu diberikan, mis. pimpinan-akademik/rektor), penyetuju.jabatan_rinci [{kode, nama, pejabat: [{username|null, nama, unit, plt, bisa_menyetujui}]}], penyetuju.bidang_rinci {kode, peran, pemegang}, siap (ada penyetuju), pesan (bila kosong), rektor (jatuh ke Rektor), isi_di (aplikasi, menu, path, api, langkah di Pustikom), telaah_spmi.
     *
     * `GET /v1/aturan/penyetuju`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyetuju(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/penyetuju', [], $query, null, $options, false, false);
    }

    /**
     * Atur penyetuju (admin)
     *
     * Body: {"penyetuju": [{"kategori": "akun", "bidang": "akademik", "jabatan": ["WR1", "REKTOR"], "keterangan": "..."}]}. Hanya kategori yang dikirim yang diubah. bidang = kode bidang pimpinan (/v1/pimpinan/bidang), jabatan = satu atau beberapa kode induk_jabatan (salah satu cukup); tanpa pejabat/pemegang = Rektor.
     *
     * `POST /v1/aturan/penyetuju`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyetuju(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/penyetuju', [], $query, null, $options, false, false);
    }

    /**
     * Periksa aturan di satu titik
     *
     * Body: `{"titik": "krs.ambil", "nim": "...", "tahun_id": "20261", "konteks": {"sks_diambil": 24}}` (titik kelas: `kode_prodi`, `kelas`; `dosen` untuk
     * pengecualian dosen; titik pegawai: `pegawai_id`). Titik pendaftar (`pmb.daftar_ulang`): `{"titik": "pmb.daftar_ulang", "pendaftar": "<id/UUID pmb_pendaftaran atau no_pmb>"}`.
     * Titik akun (`akun.buat`): `{"titik": "akun.buat", "username": "2201010001", "konteks": {"jenis_akun": "mahasiswa"}}`. Subjek pendaftar/akun
     * hanya untuk petugas; angka indikatornya hanya tampil untuk pengatur titik itu. Mahasiswa tanpa `nim` = dirinya sendiri. Hasil: `boleh` (tidak ada aturan blokir yang dilanggar),
     * `pelanggaran` dan `peringatan` beserta pesannya, `batas` (mis. batas SKS dan masa buka yang berlaku), aturan yang
     * diterapkan dan yang dikecualikan, serta nilai indikator yang dipakai. Langkah bisnis SIAKAD memakai pemeriksaan yang sama
     * dan menolak dengan 409 `aturan_dilanggar`; aplikasi lain memakai endpoint ini untuk menampilkan syarat sebelum pengguna mencoba.
     *
     * `POST /v1/aturan/periksa`
     *
     * scope: `aturan:read`
     *
     * @param array{titik?: string|null, nim?: string|null, pegawai_id?: string|null, pendaftar?: string|null, username?: string|null, kode_prodi?: string|null, kelas?: string|null, dosen?: string|null, tahun_id?: string|null, konteks?: array<string, mixed>|null, waktu?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriksa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/periksa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar aturan
     *
     * Semua pengguna melihat aturan aktif; draf dan nonaktif hanya untuk pengatur kategorinya. Filter titik, kategori, jenis, mode, status, prodi (aturan yang berlaku untuk prodi itu), tahun_id, q, terhapus=1 (admin: sampah).
     *
     * `GET /v1/aturan`
     *
     * scope: `aturan:read` · berhalaman
     *
     * @param array{titik?: string, kategori?: string, jenis?: string, mode?: string, status?: string, prodi?: string, tahun_id?: string, q?: string, terhapus?: string, menunggu_sk?: string, antrean?: string, bawaan?: string, unit?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah aturan
     *
     * Aturan baru berstatus **draf**. Lampirkan SK (`POST /v1/aturan/{id}/lampiran`) lalu aktifkan (`POST /v1/aturan/{id}/aktifkan`).
     *
     * Contoh batas input nilai dosen (hanya FKIP, periode 20261):
     * `{"nama": "Batas input nilai dosen 2026 ganjil", "titik": "nilai.input.dosen", "jenis": "batas_waktu", "tahun_id": "20261", "cakupan": {"fakultas": ["06"]}, "parameter": {"mulai": "2026-12-20", "selesai": "2027-01-10"}}`
     *
     * Contoh syarat KKN: `{"nama": "Syarat KKN", "titik": "kkn.daftar", "kategori": "kemahasiswaan", "jenis": "syarat", "kondisi": {"semua": [{"indikator": "sks_lulus", "op": ">=", "nilai": 100}, {"indikator": "ipk", "op": ">=", "nilai": 2}, {"indikator": "tunggakan", "op": "<=", "nilai": 0, "pesan": "Lunasi tunggakan sebelum daftar KKN."}]}}`
     *
     * Contoh batas SKS menurut IPS: `{"nama": "Batas SKS KRS", "titik": "krs.ambil", "jenis": "batas_nilai", "parameter": {"target": "sks_diambil", "op": "<=", "tabel": [{"jika": [{"indikator": "ips_lalu", "op": ">=", "nilai": 3}], "nilai": 24}, {"jika": [{"indikator": "ips_lalu", "op": ">=", "nilai": 2.5}], "nilai": 21}], "nilai": 18}}`
     *
     * Untuk batas waktu dan batas nilai, `kondisi` berarti "berlaku bila" (mis. hanya untuk semester_ke <= 2).
     * `mode`: blokir (ditolak) atau peringatan (diizinkan, pesan ditampilkan). Pengatur hanya bisa mengisi cakupan di unitnya.
     *
     * `POST /v1/aturan`
     *
     * scope: `aturan:write`
     *
     * @param array{kode?: string|null, nama?: string|null, keterangan?: string|null, titik?: string|null, kategori?: string|null, jenis?: string|null, cakupan?: array<string, mixed>, kondisi?: array<string, mixed>|null, parameter?: array<string, mixed>|null, tahun_id?: string|null, berlaku_mulai?: string|null, berlaku_selesai?: string|null, mode?: string|null, pesan?: string|null, prioritas?: int|null, catatan?: string|null, sk?: array<string, mixed>, lampiran_id?: string|null, ajukan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail aturan
     *
     * Isi aturan, lampiran SK, pengecualian (pengatur saja), dan pengatur yang berlaku.
     *
     * `GET /v1/aturan/{id}`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah aturan
     *
     * Body sebagian dari isian tambah (titik tidak bisa diubah), plus `catatan` perubahan dan `ajukan: true` (opsional, langsung ajukan).
     * Aturan draf/nonaktif: versi naik, isi lama tersimpan di riwayat (aturan yang sedang diajukan kembali draf).
     * Aturan **aktif**: disimpan sebagai usulan versi baru (detail `usulan`), versi lama tetap berlaku sampai disetujui.
     * Wajib menyertakan SK: `"sk": {"berkas_id", "nomor", "tanggal", "perihal"}` (SK baru) atau `"lampiran_id"` (UUID SK yang
     * sudah dilampirkan); tanpa itu 422.
     *
     * `POST /v1/aturan/{id}`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{kode?: string|null, nama?: string|null, keterangan?: string|null, titik?: string|null, kategori?: string|null, jenis?: string|null, cakupan?: array<string, mixed>, kondisi?: array<string, mixed>|null, parameter?: array<string, mixed>|null, tahun_id?: string|null, berlaku_mulai?: string|null, berlaku_selesai?: string|null, mode?: string|null, pesan?: string|null, prioritas?: int|null, catatan?: string|null, sk?: array<string, mixed>, lampiran_id?: string|null, ajukan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aktifkan aturan (tidak dipakai lagi)
     *
     * Sejak alur persetujuan dipasang, aturan tidak bisa diaktifkan langsung (juga oleh admin): 409 dengan details.ajukan. Pakai POST /v1/aturan/{id}/ajukan.
     *
     * `POST /v1/aturan/{id}/aktifkan`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAktifkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/aktifkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan aturan untuk disetujui
     *
     * Pengatur mengajukan aturan draf/nonaktif (wajib sudah ada SK) atau usulan versi baru aturan aktif (disimpan lewat
     * `POST /v1/aturan/{id}` dengan SK). Body opsional `{"catatan"}`. Status aturan draf menjadi `diajukan`; aturan aktif tetap
     * berlaku dengan versi lama. Penyetuju (pejabat bidang, lihat `/v1/aturan/penyetuju`) dan penelaah SPMI dikabari.
     * Event `aturan.diajukan`.
     *
     * `POST /v1/aturan/{id}/ajukan`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aktifkan lewat jalur darurat
     *
     * Hanya pemegang izin RBAC `aturan.darurat` (bawaan peran superadmin). Body: `{"alasan": "...", "sk": {"berkas_id", "nomor", "tanggal", "perihal"}}`
     * atau `{"alasan", "lampiran_id"}`; keduanya wajib. Aturan draf/diajukan/nonaktif langsung aktif; aturan aktif dengan usulan
     * versi baru: versi baru langsung berlaku. Aturan ditandai `darurat: true` ("Aktif lewat jalur darurat"), dicatat di riwayat,
     * penyetuju bidang dan SPMI dikabari, dan masuk antrean persetujuan susulan: `/setujui` mengesahkan (tanda darurat hilang),
     * `/kembalikan` mencabut (aturan nonaktif). Event `aturan.darurat`.
     *
     * `POST /v1/aturan/{id}/darurat`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdDarurat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/darurat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui aturan (penyetuju)
     *
     * Hanya penyetuju kategori aturan (GET /v1/aturan/penyetuju): pemegang izin aturan.setujui lewat penugasan peran pimpinan-<bidang>/rektor atau jabatan yang dipetakan ke peran (Pustikom » Peran & hak akses). Level SIAKAD lama tidak dipakai. Aturan langsung berlaku (atau versi baru menggantikan versi lama), SK didaftarkan sebagai dokumen kebijakan unit di SPMI. Body opsional {"catatan"}. Event aturan.disetujui + aturan.diaktifkan/aturan.diubah.
     *
     * `POST /v1/aturan/{id}/setujui`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kembalikan aturan ke pengaju (penyetuju)
     *
     * Body {"catatan"} wajib. Aturan draf kembali draf; aturan aktif tetap pada versi lama. Event aturan.dikembalikan.
     *
     * `POST /v1/aturan/{id}/kembalikan`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdKembalikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/kembalikan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catatan telaah SPMI
     *
     * Pemegang izin aturan.telaah (peran SPMI) memberi catatan atas aturan yang diajukan; tidak memblokir, tampil ke penyetuju dan pengaju. Aturan kategori mutu tidak ditelaah SPMI. Body {"catatan"} wajib. Event aturan.ditelaah.
     *
     * `POST /v1/aturan/{id}/telaah`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdTelaah(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/telaah', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Nonaktifkan aturan
     *
     * Body opsional {"catatan"}. Event aturan.dinonaktifkan.
     *
     * `POST /v1/aturan/{id}/nonaktifkan`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdNonaktifkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/nonaktifkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus aturan (ke sampah)
     *
     * Soft delete: aturan berhenti berlaku, riwayat dan SK tetap tersimpan. Body opsional {"alasan"}.
     *
     * `POST /v1/aturan/{id}/hapus`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pulihkan aturan dari sampah (admin)
     *
     * Kembali sebagai draf, perlu diaktifkan ulang.
     *
     * `POST /v1/aturan/{id}/pulihkan`
     *
     * scope: `aturan:admin`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPulihkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/pulihkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat perubahan
     *
     * Pengatur: setiap versi (isi lengkap), aktif/nonaktif, lampiran, pengecualian, siapa dan kapan.
     *
     * `GET /v1/aturan/{id}/riwayat`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Uji aturan (termasuk draf)
     *
     * Body seperti /periksa tanpa titik (+ "waktu" untuk mencoba tanggal lain). Hanya aturan ini yang dinilai, walau masih draf atau di luar masa berlaku. Subjek sesuai titik aturannya: `nim`, `pegawai_id`, `pendaftar` (id/UUID pmb_pendaftaran atau no_pmb, mis. `{"pendaftar": "123"}`), atau `username` + `konteks.jenis_akun` (mis. `{"username": "2201010001", "konteks": {"jenis_akun": "mahasiswa"}}`).
     *
     * `POST /v1/aturan/{id}/uji`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{titik?: string|null, nim?: string|null, pegawai_id?: string|null, pendaftar?: string|null, username?: string|null, kode_prodi?: string|null, kelas?: string|null, dosen?: string|null, tahun_id?: string|null, konteks?: array<string, mixed>|null, waktu?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUji(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/uji', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lampiran SK
     *
     * SK dan lampiran aturan (pengatur juga melihat yang sudah dilepas).
     *
     * `GET /v1/aturan/{id}/lampiran`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdLampiran(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/lampiran', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lampirkan SK
     *
     * Body: `{"berkas_id": "<uuid dari /v1/berkas>", "jenis": "sk" | "lampiran", "nomor": "123/UN.P/2026", "tanggal": "2026-11-15", "perihal": "..."}`.
     * Unggah file lebih dulu lewat `/v1/berkas` (sekali atau bertahap); berkas tidak disalin, hanya ditautkan dan tercatat dipakai
     * (tidak bisa dihapus dari manajer berkas selama dipakai). Nomor wajib untuk SK.
     *
     * `POST /v1/aturan/{id}/lampiran`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{berkas_id?: string|null, jenis?: string|null, nomor?: string|null, tanggal?: string|null, perihal?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdLampiran(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/lampiran', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas lampiran
     *
     * Soft delete. SK terakhir aturan aktif tidak bisa dilepas.
     *
     * `POST /v1/aturan/{id}/lampiran/{lampiran}/hapus`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param int|string $lampiran UUID lampiran
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdLampiranByLampiranHapus(int|string $id, int|string $lampiran, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/lampiran/{lampiran}/hapus', ['id' => $id, 'lampiran' => $lampiran], $query, null, $options, false, false);
    }

    /**
     * Unduh SK
     *
     * Isi berkas SK (302 ke URL sementara bila disimpan di bucket). ?unduh=1 untuk lampiran unduhan.
     *
     * `GET /v1/aturan/{id}/lampiran/{lampiran}/unduh`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param int|string $lampiran UUID lampiran
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdLampiranByLampiranUnduh(int|string $id, int|string $lampiran, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/lampiran/{lampiran}/unduh', ['id' => $id, 'lampiran' => $lampiran], $query, null, $options, false, false);
    }

    /**
     * Daftar pengecualian
     *
     * Dispensasi aturan ini (pengatur saja).
     *
     * `GET /v1/aturan/{id}/pengecualian`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdPengecualian(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/pengecualian', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Beri pengecualian (dispensasi)
     *
     * Pemutus pengecualian langsung (tanpa pengajuan); hanya aturan boleh_pengecualian (ketat: 409). Body: {"subjek_jenis": "mahasiswa"|"dosen"|"prodi"|"pegawai"|"pendaftar"|"akun", "subjek": "NIM/NIDN/kode prodi/id pegawai/no_pmb/username", "tahun_id"? (periode), "alasan", "berlaku_sampai"?, "berkas_id"? (surat/SK dispensasi)}. Satu-satunya cara melonggarkan aturan untuk subjek tertentu. Event aturan.pengecualian_diberikan.
     *
     * `POST /v1/aturan/{id}/pengecualian`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{subjek_jenis?: string|null, subjek?: string|null, alasan?: string|null, berlaku_sampai?: string|null, berkas_id?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPengecualian(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/pengecualian', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan pengecualian (aturan boleh_pengecualian)
     *
     * Subjek atau operator mengajukan pengecualian berdokumen untuk aturan bersifat `boleh_pengecualian` (aturan `ketat`: 409).
     * Body: `{"subjek_jenis": "mahasiswa"|"pegawai"|"pendaftar"|"akun"|"prodi"|"dosen", "subjek": "...", "tahun_id"?: "20261",
     * "berlaku_sampai"?: "2027-01-31", "alasan": "...", "berkas_id": "<UUID /v1/berkas>", "dok_jenis": "sk"|"dokumen_kebijakan"|"bukti_bayar"|"dokumen",
     * "dok_nomor": "...", "dok_tanggal"?: "2026-11-18"}`. Mahasiswa/MABA hanya untuk dirinya (subjek diisi otomatis). Dokumen wajib;
     * nomor wajib untuk SK/dokumen kebijakan. Diputus di `/v1/aturan/pengecualian/ajuan/{ajuan}/setujui|tolak`.
     *
     * `POST /v1/aturan/{id}/pengecualian/ajukan`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPengecualianAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/pengecualian/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cabut pengecualian
     *
     * Soft delete.
     *
     * `POST /v1/aturan/{id}/pengecualian/{pengecualian}/hapus`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param int|string $pengecualian UUID pengecualian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPengecualianByPengecualianHapus(int|string $id, int|string $pengecualian, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/pengecualian/{pengecualian}/hapus', ['id' => $id, 'pengecualian' => $pengecualian], $query, null, $options, false, false);
    }
}
