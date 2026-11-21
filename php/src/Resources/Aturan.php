<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Aturan, Aturan: titik penerapan, Aturan: SK dan pengecualian, Aturan: pengatur dan pemeriksaan, Aturan: persetujuan, Aturan: dasar SK dan validator, Aturan: gerbang SK kebijakan unit, Aturan: kebijakan berakibat, Aturan: templat kasus (kanvas admin), Aturan: titik berbasis rute
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
     * Per kategori: boleh mengatur atau tidak, prodi yang boleh diatur (null = semua), dan siapa pengaturnya. titik_atur = [{titik, kategori, unit}] titik berpengatur sendiri yang boleh saya atur (mis. pmb.* untuk Ketua/Panitia PMB).
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
     * Calon dosen bersyarat
     *
     * Dosen aktif beserta hasil aturan titik penetapan dosen (akademik.pa.tetapkan, ta.pembimbing.tetapkan, ta.penguji.proposal.tetapkan, ta.penguji.skripsi.tetapkan) untuk satu mahasiswa (nim) atau prodi: memenuhi, alasan singkat ("Belum Lektor", "Sudah membimbing 10 mahasiswa"), peringatan, data_kurang. Urut: prodi mahasiswa, fakultasnya, lalu lainnya. Angka indikator dan sumber datanya hanya untuk pengatur titik (rinci=1). meta.ringkasan, meta.aturan_aktif.
     *
     * `GET /v1/aturan/calon-dosen`
     *
     * scope: `aturan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, titik?: string, nim?: string, prodi?: string, peran?: string, q?: string, nidn?: string, hanya_memenuhi?: string, rinci?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCalonDosen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/calon-dosen', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan aturan fakultas
     *
     * Untuk halaman Aturan fakultas: aturan fakultas (tingkat fakultas/prodi, termasuk aturan bawaan fakultas yang dibuat otomatis bila belum ada), aturan universitas yang berlaku di fakultas itu untuk titik penetapan dosen (lihat saja), penyetuju (Dekan), penelaah GPM, boleh_atur, dampak per titik (dosen memenuhi/tidak/data kurang menurut data sekarang), dan dosen dengan data belum lengkap. ?dampak=0 untuk melewati perhitungan dampak.
     *
     * `GET /v1/aturan/fakultas/{kode}`
     *
     * scope: `aturan:read`
     *
     * @param int|string $kode Kode fakultas (01), kode unit (FAK-01), atau kode prodi
     * @param array{dampak?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFakultasByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/fakultas/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Dasar SK aturan: belum berdasar SK & tinjau ulang
     *
     * Aturan yang boleh saya atur beserta dasar SK-nya. status = belum (aturan aktif belum berdasar SK, untuk dilengkapi) | tinjau (SK dasar dicabut/ditolak/diubah, belum ditinjau) | berlaku. Jawaban {data: [{id, nama, kategori, titik_judul, status, unit, dasar_sk: {status: berlaku|tidak_berlaku|diubah|belum, label, sk, unit_pengaju, ditinjau}}], kelompok: [{nama, jumlah, aturan: [uuid], unit: [..]}], jumlah: {belum, tinjau, berlaku}}. Memanggil pemantau SK dasar lebih dulu.
     *
     * `GET /v1/aturan/dasar-sk`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array{status?: string, kategori?: string, unit?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDasarSk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/dasar-sk', [], $query, null, $options, false, false);
    }

    /**
     * Periksa SK dasar sebelum aturan dibuat
     *
     * Query sk_dasar_id, unit_pengaju (id/kode unit), prodi & fakultas (kode dipisah koma; kosong = semua). Jawaban sama dengan /v1/aturan/{id}/dasar-sk/periksa.
     *
     * `GET /v1/aturan/dasar-sk/periksa`
     *
     * scope: `aturan:read`
     *
     * @param array{sk_dasar_id?: string, unit_pengaju?: string, prodi?: string, fakultas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDasarSkPeriksa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/dasar-sk/periksa', [], $query, null, $options, false, false);
    }

    /**
     * Tetapkan satu SK dasar untuk banyak aturan
     *
     * Body {"aturan": [uuid], "sk_dasar_id": "<uuid SK registri>", "unit_pengaju_id"?, "catatan"?}. Tiap aturan diperiksa kewenangannya sendiri; jawaban {berhasil, gagal, hasil: [{id, nama, ok, pesan}]}.
     *
     * `POST /v1/aturan/dasar-sk/massal`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDasarSkMassal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/dasar-sk/massal', [], $query, null, $options, false, false);
    }

    /**
     * Jenis kebijakan yang lewat gerbang SK
     *
     * Registri Aturan/Data/kebijakan.php: {jenis: [{kode, judul, kategori, unit (kode induk_unit pemilik), menu, aplikasi, path}], tautan: {pejabat, validator, perlu_sk: {menu, url}}} (tautan untuk peringatan data pejabat/validator kosong di layar unit).
     *
     * `GET /v1/aturan/kebijakan/jenis`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/kebijakan/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Daftar kerja "Perlu SK" per unit
     *
     * Aturan aktif modul Aturan tanpa SK dasar (atau SK dasarnya tidak berlaku) dan kebijakan unit yang berlaku tanpa SK
     * (AturanVersi SDM/kurikulum, kunci fitur, penyimpanan, kwitansi, syarat keuangan, biaya PMB, kuesioner tracer, kalender,
     * aturan biaya). Keputusan Anas 2026-11-21: tanpa SK = peringatan, tidak memblokir. Query `unit` (kode induk_unit, mis.
     * BAUK, PMB) untuk layar unit pemilik; kosong = semua unit (Pustikom). Jawaban `{per_unit: [{unit, aturan, kebijakan,
     * jumlah}], aturan: [{id, nama, kategori, titik_judul, status_sk, unit, tautan}], kebijakan: [bentuk gerbang], jumlah: {aturan,
     * kebijakan, total}}`.
     *
     * `GET /v1/aturan/kebijakan/perlu-sk`
     *
     * scope: `aturan:read`
     *
     * @param array{unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanPerluSk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/kebijakan/perlu-sk', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan gerbang per jenis kebijakan
     *
     * Per jenis: {jenis, judul, unit, tunggu_validasi (baru berlaku setelah validasi selesai), bawaan, bisa_diubah, tanpa_validator (berlaku | tahan), tahap_akhir [judul]}. Bawaan tunggu: BKD, DUPAK, SKP (bisa diubah) dan aturan biaya (tetap; penetapan WR II = tahap terakhir rantai).
     *
     * `GET /v1/aturan/kebijakan/pengaturan`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/kebijakan/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah "tunggu validasi sebelum berlaku" satu jenis
     *
     * Body {"jenis": "aturan_versi.karier", "tunggu_validasi": true}. Izin aturan.validator.atur (Pustikom) atau aturan:admin; hanya jenis bisa_diubah. Jawaban = daftar pengaturan.
     *
     * `POST /v1/aturan/kebijakan/pengaturan`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKebijakanPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/kebijakan/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Kebijakan menunggu validasi saya
     *
     * Kebijakan yang tahap validatornya sedang berjalan dan saya termasuk validatornya (rantai Validator aturan unit pemilik, pengaju dikeluarkan).
     *
     * `GET /v1/aturan/kebijakan/antrean`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/kebijakan/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Lampirkan SK dasar ke kebijakan berlaku
     *
     * Body {"jenis": "kwitansi.catatan", "baris": "12", "sk_id": "<UUID SK registri>"}. SK diperiksa DasarSk (status terbit, penerbit berwenang, unit pemilik di bawah penerbit); 422 details.dasar_sk bila tidak sah. Tidak mengubah isi kebijakan sehingga tidak memulai rantai validator. Hak: izin pengelola kebijakan itu (registri) atau aturan:admin.
     *
     * `POST /v1/aturan/kebijakan/sk`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKebijakanSk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/kebijakan/sk', [], $query, null, $options, false, false);
    }

    /**
     * Kebijakan berlaku beserta SK dasar dan status validasi
     *
     * Query jenis, unit (kode), status_sk (belum|berlaku|diubah|tidak_berlaku|perlu), q. Butir: {id (UUID gerbang, null bila belum pernah lewat gerbang), jenis, jenis_judul, baris, nama, kategori, unit, status_sk, label_sk, sk, validasi (berjalan|disetujui|dikembalikan|ditolak|validator_kosong|belum), label_validasi, validasi_rinci, perlu_sk, peringatan[{kode, pesan}], kelola {aplikasi, path, menu, url}}.
     *
     * `GET /v1/aturan/kebijakan`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/kebijakan', [], $query, null, $options, false, false);
    }

    /**
     * Tahap validasi kebijakan
     *
     * Bentuk sama dengan usulan.pemeriksa aturan (AlurPemeriksa).
     *
     * `GET /v1/aturan/kebijakan/{id}/tahap`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $id UUID gerbang kebijakan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanByIdTahap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/kebijakan/{id}/tahap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keputusan validator kebijakan
     *
     * Body {"keputusan": "setujui" | "kembalikan" | "tolak", "catatan"} (catatan wajib untuk kembalikan/tolak). Pengaju tidak bisa memvalidasi kebijakannya sendiri (403 validasi_sendiri); bukan validator tahap berjalan 403. Kebijakan tetap berlaku; pemilik dikabari bila dikembalikan/ditolak.
     *
     * `POST /v1/aturan/kebijakan/{id}/putus`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $id UUID gerbang kebijakan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKebijakanByIdPutus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/kebijakan/{id}/putus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kebijakan berakibat yang berlaku untuk subjek
     *
     * Query titik (keuangan.tarif | keuangan.keringanan | nilai.konversi | nilai.bobot | kelulusan.predikat), nim atau prodi, tahun_id?. Jawaban {bawaan: true} bila tidak ada kebijakan (SIAKAD memakai pengaturan bawaannya), atau {kebijakan: {aturan_id, nama, versi, parameter, kalimat}} versi yang berlaku untuk periode itu.
     *
     * `GET /v1/aturan/akibat/berlaku`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkibatBerlaku(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/akibat/berlaku', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat penyesuaian tagihan saya (mahasiswa)
     *
     * Penyesuaian tagihan oleh kebijakan berdasar SK (pemutihan, tarif periode baru, potongan) beserta nilai sebelum/sesudah dan SK dasarnya.
     *
     * `GET /v1/aturan/akibat/saya`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkibatSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/akibat/saya', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat penyesuaian tagihan mahasiswa
     *
     * Izin aturan.akibat.lihat (BAUK/BAAK) atau mahasiswa sendiri. [{id, aturan, sk, cara, pemicu, tahun_id, status, alasan, total_sebelum, total_sesudah, oleh, waktu, ubah: [{tahun_id, kode_biaya, jenis, sebelum, sesudah, dibayar, keterangan, dibalik_at}]}].
     *
     * `GET /v1/aturan/akibat/mahasiswa/{nim}`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkibatMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/akibat/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Batalkan penerapan kebijakan (rollback)
     *
     * Izin aturan.akibat.terapkan. Body {alasan}. Semua tagihan yang diubah penerapan ini kembali ke nilai sebelum. 409 tagihan_berubah bila tagihan sudah diubah pihak lain sejak diterapkan.
     *
     * `POST /v1/aturan/akibat/penerapan/{penerapan}/batalkan`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $penerapan UUID penerapan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkibatPenerapanByPenerapanBatalkan(int|string $penerapan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/akibat/penerapan/{penerapan}/batalkan', ['penerapan' => $penerapan], $query, null, $options, false, false);
    }

    /**
     * Katalog jenis aturan & templat kasus
     *
     * 15 jenis aturan (urut prioritas) masing-masing dengan templat kasus berisian {kode, judul, kalimat dengan {slot}, slot: [{kode, label, tipe: angka|uang|tanggal|teks|tabel, satuan, bawaan, contoh, kolom}], akibat, siap}, dan registri tipe akibat {kode, label, siap}. Templat siap=false tampil "segera".
     *
     * `GET /v1/aturan/templat`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/templat', [], $query, null, $options, false, false);
    }

    /**
     * Buat draf aturan dari templat berisian
     *
     * Body {"templat": "sks_menurut_ips", "isian": {"tingkat": [{"ips_min": 3, "sks": 24}], "sks_lain": 15}, "cakupan": {"fakultas": ["01"]}, "nama"?, "keterangan"?, "tingkat"?}. Logika dari data templat; hasil = aturan draf (lalu uji, SK dasar, ajukan). Templat yang belum bermesin: 422.
     *
     * `POST /v1/aturan/dari-templat`
     *
     * scope: `aturan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDariTemplat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/dari-templat', [], $query, null, $options, false, false);
    }

    /**
     * Palet kanvas templat (admin)
     *
     * Bahan kanvas seret-lepas: 15 jenis, registri akibat (siap = bermesin, langkah = tolak/peringatan/batasi), titik aktif beserta indikatornya, indikator per kelompok awam (tipe, satuan, opsi), operator per tipe dengan label awam, kategori.
     *
     * `GET /v1/aturan/templat/palet`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatPalet(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/templat/palet', [], $query, null, $options, false, false);
    }

    /**
     * Daftar templat kasus (admin)
     *
     * Semua templat (draf/terbit/arsip) dengan versi terbit, versi terakhir, ada_draf, sumber awal|kanvas.
     *
     * `GET /v1/aturan/templat/kelola`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatKelola(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/templat/kelola', [], $query, null, $options, false, false);
    }

    /**
     * Templat baru dari kanvas (admin)
     *
     * Body {judul, jenis_aturan, kanvas, catatan?, kode?}. Disimpan sebagai draf versi 1; pejabat belum melihatnya sampai diterbitkan. 422 dengan details "kanvas.<id blok>".
     *
     * `POST /v1/aturan/templat/kelola`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatKelola(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/templat/kelola', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau kanvas (admin)
     *
     * Body {kanvas, judul?}. Tanpa menyimpan: {ok, kalimat (celah {slot}), galat: {id blok: pesan}, slot, siap, aturan}. Pohon kanvas dan BUKAN (De Morgan): docs/ATURAN-RUTE.md.
     *
     * `POST /v1/aturan/templat/pratinjau`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatPratinjau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/templat/pratinjau', [], $query, null, $options, false, false);
    }

    /**
     * Detail templat (admin)
     *
     * Isi + kanvas versi terakhir (templat awal diturunkan ke kanvas bila bisa), riwayat versi.
     *
     * `GET /v1/aturan/templat/kelola/{kode}`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatKelolaByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/templat/kelola/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Simpan draf templat (admin)
     *
     * Body sama dengan tambah. Draf terakhir ditimpa; bila versi terakhir sudah terbit, dibuat versi baru. Pejabat tetap memakai versi terbit sampai draf diterbitkan.
     *
     * `POST /v1/aturan/templat/kelola/{kode}`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatKelolaByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/templat/kelola/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Terbitkan templat (admin)
     *
     * Draf terakhir menjadi versi terbit (yang lama ditandai lama) dan muncul di "Mulai dari contoh". Body {catatan?}. Templat arsip tanpa draf diterbitkan ulang.
     *
     * `POST /v1/aturan/templat/kelola/{kode}/terbit`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatKelolaByKodeTerbit(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/templat/kelola/{kode}/terbit', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Arsipkan templat (admin)
     *
     * Tidak tampil lagi untuk pejabat; aturan yang sudah dibuat tidak berubah.
     *
     * `POST /v1/aturan/templat/kelola/{kode}/arsip`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatKelolaByKodeArsip(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/templat/kelola/{kode}/arsip', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Gandakan templat (admin)
     *
     * Versi terakhir menjadi templat draf baru.
     *
     * `POST /v1/aturan/templat/kelola/{kode}/gandakan`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatKelolaByKodeGandakan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/templat/kelola/{kode}/gandakan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus templat draf (admin)
     *
     * Hanya templat yang belum pernah terbit; yang pernah terbit diarsipkan.
     *
     * `POST /v1/aturan/templat/kelola/{kode}/hapus`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatKelolaByKodeHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/templat/kelola/{kode}/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Katalog aksi API untuk titik rute (admin)
     *
     * Semua rute tulis (kecuali /v1/aturan, /v1/auth, /v1/rbac, /v1/sso) per modul: {kunci, metode, path, nama (ringkasan dokumentasi), keterangan, parameter_path, saran: {mahasiswa, pegawai, pendaftar, tahun, prodi: [{sumber, label}]}, titik}. Plus daftar pencarian subjek (cari) dan sumber pengguna.
     *
     * `GET /v1/aturan/rute/katalog`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuteKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/rute/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Daftar titik berbasis rute (admin)
     *
     * Titik rute.* dengan aksi, subjek & sumbernya, periode, prodi, data tambahan, syarat "hanya bila", jumlah aturan aktif.
     *
     * `GET /v1/aturan/rute`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRute(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/rute', [], $query, null, $options, false, false);
    }

    /**
     * Tambah titik dari aksi API (admin)
     *
     * Body `{"judul": "Mahasiswa mendaftar seminar proposal", "rute": "POST /v1/ta/ujian/ajukan", "subjek": "mahasiswa",
     * "subjek_sumber": ["pengguna:nim"], "tahun_sumber"?: ["body:tahun_id"], "prodi_sumber"?: [], "kategori": ["akademik"],
     * "jenis"?: ["syarat"], "konteks"?: [{"kode", "judul", "tipe"}], "konteks_sumber"?: {"kode": "body:x"},
     * "bila"?: [{"sumber": "body:jenis", "nilai": ["proposal"]}], "pengatur"?: [], "aktif"?: true}`. Kode titik `rute.<slug>`
     * dibuat dari judul. Aturan di titik ini ditegakkan otomatis oleh PenjagaRute sebelum handler (422 aturan_dilanggar) dan tetap
     * melalui SK dasar & rantai validator. Sumber tanpa SQL bebas: `pengguna:nim|username|nidn`, `path:x`, `query:x`, `body:a.b`,
     * `cari:<nama>:<sumber>` (Data/rute_cari.php).
     *
     * `POST /v1/aturan/rute`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRute(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/rute', [], $query, null, $options, false, false);
    }

    /**
     * Simulasi: aksi ini akan ditolak?
     *
     * Body {titik, sebagai? (username/NIM pemilik token tiruan), level?, path?: {param: nilai}, query?, isian? (body JSON), aturan? (UUID draf = hanya aturan itu)}. Memakai PenjagaRute sungguhan tanpa menjalankan aksi: {akan_ditolak, status, alasan, diperiksa, alasan_lewat, subjek, hasil}. Admin atau pengatur aturan.
     *
     * `POST /v1/aturan/rute/simulasi`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuteSimulasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/rute/simulasi', [], $query, null, $options, false, false);
    }

    /**
     * Detail titik rute (admin)
     *
     * Bentuk sama dengan butir daftar.
     *
     * `GET /v1/aturan/rute/{kode}`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode titik rute.*
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuteByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/rute/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah titik rute (admin)
     *
     * Isian sama dengan tambah (sebagian boleh). Subjek tidak bisa diubah bila titik sudah punya aturan.
     *
     * `POST /v1/aturan/rute/{kode}`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode titik rute.*
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuteByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/rute/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus titik rute (admin)
     *
     * Soft delete titik + pemetaan; 409 bila masih ada aturan aktif/diajukan.
     *
     * `POST /v1/aturan/rute/{kode}/hapus`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param int|string $kode Kode titik rute.*
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuteByKodeHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/rute/{kode}/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Pengaturan validator aturan per unit pengaju
     *
     * Rantai tahap validasi per unit/jenis unit (opsional per kategori), templat rantai, pewarisan. Izin aturan.validator.lihat. {data: [{id, nama, jenis_baris: aturan|templat, unit, jenis_unit, kategori, warisi, templat, langkah: [{judul, validator: [{jenis, kode?, unit?}], mode: satu|semua, batas_hari, bila_kosong: eskalasi|lewati|tahan}], opsi: {ulang_dari: awal|tahap_pengembali}, prioritas, aktif, bawaan}], boleh_atur}.
     *
     * `GET /v1/aturan/validator`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getValidator(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/validator', [], $query, null, $options, false, false);
    }

    /**
     * Tambah rantai validator / templat
     *
     * Izin aturan.validator.atur. Body {nama, jenis_baris?: aturan|templat, unit_id? | jenis_unit?, kategori?, warisi?, templat_id? | langkah: [...], opsi?: {ulang_dari}, prioritas?, aktif?, keterangan?}.
     *
     * `POST /v1/aturan/validator`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postValidator(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/validator', [], $query, null, $options, false, false);
    }

    /**
     * Pilihan editor rantai validator
     *
     * Jenis validator, unit relatif (pengaju, induk, fakultas, prodi, biro_kategori), jabatan, peran, unit, jenis unit, kategori.
     *
     * `GET /v1/aturan/validator/katalog`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getValidatorKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/validator/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Simulasi: pengajuan dari unit X kategori Y divalidasi siapa
     *
     * Query unit (id/kode induk_unit), kategori, pengaju? (username: dikeluarkan dari validator). Jawaban rantai lengkap: pengaturan yang dipakai & alasannya, tahap [{urut, judul, mode, bila_kosong, validator: [{label, jumlah}], orang: [{username, nama, sebagai}], tindakan: validasi|eskalasi|lewati|tahan}], siap, pesan.
     *
     * `GET /v1/aturan/validator/simulasi`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array{unit?: string, kategori?: string, pengaju?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getValidatorSimulasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/validator/simulasi', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat perubahan pengaturan validator
     *
     * Jejak audit: aksi, oleh, waktu, sebelum, sesudah.
     *
     * `GET /v1/aturan/validator/riwayat`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getValidatorRiwayat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/validator/riwayat', [], $query, null, $options, false, false);
    }

    /**
     * Ubah rantai validator / templat
     *
     * Isian sama dengan tambah. Pengajuan yang sudah berjalan tetap memakai salinan rantai saat diajukan.
     *
     * `POST /v1/aturan/validator/{id}`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $id UUID pengaturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postValidatorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/validator/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus rantai validator / templat
     *
     * Soft delete. Templat yang masih dipakai: 409.
     *
     * `POST /v1/aturan/validator/{id}/hapus`
     *
     * scope: `aturan:read` · hanya token pengguna
     *
     * @param int|string $id UUID pengaturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postValidatorByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/validator/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
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
     * @param array{titik?: string, kategori?: string, jenis?: string, mode?: string, status?: string, prodi?: string, tahun_id?: string, q?: string, terhapus?: string, menunggu_sk?: string, antrean?: string, tanpa_sk?: string, bawaan?: string, unit?: string, page?: int, per_page?: int, ...} $query
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
     * Ajukan aturan untuk divalidasi
     *
     * **Dasar SK wajib** (docs/ATURAN-SK.md): body `sk_dasar_id` (UUID SK induk di Registri SK; kosong = SK dasar yang sudah
     * tercatat, atau SK registri dari lampiran SK aturan), opsional `unit_pengaju_id` (bawaan: unit pemilik aturan). SK harus
     * terbit, penerbitnya berwenang menurut Kewenangan SK, unit pengaju berada di bawah penerbit, dan cakupan aturan tidak
     * melebihi cakupan SK; selain itu 422 `details.dasar_sk.masalah`. Pengajuan lalu berjalan melalui **rantai validator** unit
     * pengaju (Pustikom » Aturan » Validator aturan; tanpa pengaturan = pejabat penyetuju kategori). Tahap tanpa validator dan
     * bila_kosong=tahan: 409 `validator_kosong`.
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
     * Tolak pengajuan (validator)
     *
     * Validator tahap berjalan menolak pengajuan. Body {"catatan"} wajib. Aturan baru tidak berlaku (nonaktif); usulan versi baru aturan aktif ditolak dan versi lama tetap berlaku. Pengaju tidak bisa menolak/menyetujui pengajuannya sendiri (403 validasi_sendiri).
     *
     * `POST /v1/aturan/{id}/tolak`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdTolak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/tolak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periksa SK dasar (tanpa menyimpan)
     *
     * Query sk_dasar_id (UUID SK registri; kosong = SK dasar tercatat / SK lampiran), unit_pengaju_id?. Jawaban {ok, sk, unit_pengaju, penerbit, masalah: [{kode, pesan}], peringatan}. Kode masalah: sk_wajib, sk_tidak_ada, sk_belum_terbit, sk_tidak_berlaku, penerbit_tidak_dikenal, penerbit_tidak_berwenang, unit_di_luar_penerbit, cakupan_melebihi_sk.
     *
     * `GET /v1/aturan/{id}/dasar-sk/periksa`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array{sk_dasar_id?: string, unit_pengaju_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdDasarSkPeriksa(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/dasar-sk/periksa', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tetapkan/ganti SK dasar aturan
     *
     * Untuk melengkapi aturan aktif yang belum berdasar SK, atau mengganti SK dasar yang dicabut. Body {sk_dasar_id, unit_pengaju_id?, catatan?}. Kewenangan SK diperiksa (422 dengan details.dasar_sk). Isi aturan tidak berubah sehingga tidak melewati rantai validasi.
     *
     * `POST /v1/aturan/{id}/dasar-sk`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdDasarSk(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/dasar-sk', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tinjau ulang aturan yang SK dasarnya tidak berlaku
     *
     * Body {keputusan: ganti (sk_dasar_id) | nonaktifkan | tetap, catatan (min. 10 karakter untuk nonaktifkan/tetap)}. Aturan tidak pernah dimatikan otomatis.
     *
     * `POST /v1/aturan/{id}/dasar-sk/tinjau`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdDasarSkTinjau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/dasar-sk/tinjau', ['id' => $id], $query, null, $options, false, false);
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
     * Kembalikan aturan bawaan fakultas ke bawaan
     *
     * Body {"alasan"} wajib (min. 10 karakter). Isi aturan diganti isi bawaan fakultas (Data/bawaan_fakultas.php) dan aktif lagi; usulan perubahan yang berjalan dibatalkan; tercatat di riwayat (dikembalikan_ke_bawaan). Hanya aturan bawaan fakultas.
     *
     * `POST /v1/aturan/{id}/kembalikan-bawaan`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdKembalikanBawaan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/kembalikan-bawaan', ['id' => $id], $query, null, $options, false, false);
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
     * Simulasi dampak kebijakan berakibat
     *
     * Sebelum disahkan dan sebelum penerapan massal. Query: `tahun_id?` (bawaan: mulai berlaku atau periode aktif), `usulan=1`
     * (pakai isi versi yang sedang diajukan), `nim?` (daftar dipisah koma), `semua=1` (sertakan yang tidak memenuhi dengan
     * alasannya), `format=csv` (ekspor). Keringanan: `{jumlah_diperiksa, jumlah_memenuhi, total_sebelum, total_sesudah, selisih,
     * data: [{nim, nama, alasan[], total_sebelum, total_sesudah, ubah: [{tahun_id, kode_biaya, sebelum, sesudah, dibayar, keterangan}]}]}`.
     * Konversi huruf: nilai periode itu yang hurufnya berubah. Bobot: kelas yang terdampak. Predikat: lulusan yang predikatnya
     * berubah. Tarif: tagihan sekarang vs tarif aturan.
     *
     * `GET /v1/aturan/{id}/akibat/simulasi`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdAkibatSimulasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/akibat/simulasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Terapkan kebijakan keringanan/pemutihan (massal)
     *
     * Izin aturan.akibat.terapkan (BAUK). Body {tahun_id?, nim?: [], konfirmasi: jumlah memenuhi pada simulasi yang dilihat}. Hanya aturan aktif. Tiap mahasiswa = satu penerapan berjejak (sebelum/sesudah, SK, pelaku), tidak diterapkan dua kali. 409 konfirmasi_berbeda bila hasil simulasi sudah berubah.
     *
     * `POST /v1/aturan/{id}/akibat/terapkan`
     *
     * scope: `aturan:write` · hanya token pengguna
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAkibatTerapkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/akibat/terapkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar penerapan kebijakan
     *
     * Query status? (diterapkan | dibatalkan). {data: [...penerapan beserta ubah], ringkasan: {jumlah, diterapkan, total_sebelum, total_sesudah}, boleh_terapkan}.
     *
     * `GET /v1/aturan/{id}/akibat/penerapan`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdAkibatPenerapan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/akibat/penerapan', ['id' => $id], $query, null, $options, false, false);
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
