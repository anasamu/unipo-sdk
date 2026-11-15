<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Admisi: Penerimaan, Admisi: Seleksi, Admisi: KIP Kuliah dan UKT, Admisi: Chat dan laporan, Admisi: Pendaftar, Admisi: Program studi
 */
final class Admisi extends Resource
{
    /**
     * Feed PMB (publik)
     *
     * JSON untuk kanal promosi/pencarian kampus (mis. Maukuliah) dan portal: gelombang yang terbit dan belum tutup, jalur, prodi + kuota, biaya, jadwal, persyaratan prodi.
     *
     * `GET /v1/admisi/feed`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFeed(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/feed', [], $query, null, $options, false, true);
    }

    /**
     * Verifikasi LoA (publik)
     *
     * Untuk QR di surat penerimaan. Nama disamarkan.
     *
     * `GET /v1/admisi/loa/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLoaVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/loa/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Rekomendasi kelulusan
     *
     * Per gelombang: pendaftar diurutkan menurut nilai USM (lalu rata-rata rapor dan prestasi), lalu ditempatkan ke pilihan pertama yang memenuhi nilai minimal prodi dan kuotanya masih ada. Hasil: lulus (prodi + pilihan ke-), cadangan, tidak_lulus, belum_dinilai, dibanding status lulus saat ini. Hanya rekomendasi; kelulusan tetap lewat nilai di /v1/pmb/admin/pendaftaran/{id}/nilai.
     *
     * `GET /v1/admisi/rekomendasi`
     *
     * scope: `admisi:read`
     *
     * @param array{gelombang_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekomendasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/rekomendasi', [], $query, null, $options, false, false);
    }

    /**
     * Tugas sesi tes saya
     *
     * Sesi tes PMB yang ditugaskan ke pengguna token sebagai pengawas/penguji/pewawancara/operator.
     *
     * `GET /v1/admisi/petugas/saya`
     *
     * scope: `admisi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetugasSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/petugas/saya', [], $query, null, $options, false, false);
    }

    /**
     * Usulan NIM berikutnya
     *
     * NIM berikutnya untuk prodi dan periode masuk (aturan /admisi/aturan-nim, pola /admisi/format-nim, atau ditebak dari NIM angkatan terakhir prodi). Tidak menyimpan apa pun.
     *
     * `GET /v1/admisi/nim/usulan`
     *
     * scope: `admisi:read`
     *
     * @param array{prodi?: string, tahun_id?: string, jalur?: string, jumlah?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNimUsulan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/nim/usulan', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau aturan NIM
     *
     * Pola NIM yang berlaku untuk prodi/jalur/periode (aturan /admisi/aturan-nim, format per prodi, atau tebakan) beserta contoh NIM berikutnya. Isi `pola` untuk mencoba pola baru sebelum disimpan. Tidak menyimpan apa pun.
     *
     * `GET /v1/admisi/nim/pratinjau`
     *
     * scope: `admisi:read`
     *
     * @param array{prodi?: string, tahun_id?: string, jalur?: string, pola?: string, jumlah?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNimPratinjau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/nim/pratinjau', [], $query, null, $options, false, false);
    }

    /**
     * Daftar ulang dengan NIM otomatis
     *
     * Body {"pendaftaran": ["<uuid>", ...], "tahun_id"?, "pratinjau"?: true}. Per pendaftar: pilihan pertama yang lulus, NIM berikutnya, lalu langkah Daftar Ulang PMB (m_mahasiswa, status, ortu, akun MAHASISWA; kuota dicek). Gagal per pendaftar dilaporkan tanpa menghentikan yang lain.
     *
     * `POST /v1/admisi/nim/generate`
     *
     * scope: `admisi:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNimGenerate(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/nim/generate', [], $query, null, $options, false, false);
    }

    /**
     * Terbitkan LoA
     *
     * Body {"pendaftaran": "<uuid>", "nomor"?, "batas_daftar_ulang"?}. Untuk pendaftar yang lulus seleksi: nomor (bawaan LOA/<prodi>/<tahun>/<no PMB>), salinan data surat, kode verifikasi, notifikasi ke pendaftar.
     *
     * `POST /v1/admisi/loa/terbitkan`
     *
     * scope: `admisi:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLoaTerbitkan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/loa/terbitkan', [], $query, null, $options, false, false);
    }

    /**
     * Layanan satu hari: status
     *
     * Daftar periksa pendaftar dari formulir, bayar, verifikasi, nilai, lulus, LoA, sampai daftar ulang, dengan langkah berikutnya, berkas, dan tagihan.
     *
     * `GET /v1/admisi/ods/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOdsById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/ods/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Layanan satu hari: proses
     *
     * Body {"verifikasi": true, "nilai": 80, "loa": true, "daftar_ulang": true, "nim"?, "tahun_id"?}: langkah dijalankan berurutan dengan service PMB online (verifikasi, nilai seleksi -> lulus menurut nilai minimal, LoA, daftar ulang dengan NIM otomatis bila nim tidak diisi). Pembayaran tetap lewat kasir/tagihan PMB.
     *
     * `POST /v1/admisi/ods/{id}/proses`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOdsByIdProses(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/ods/{id}/proses', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Terapkan UKT ke mahasiswa
     *
     * Untuk UKT berstatus ditetapkan dan pendaftar yang sudah ber-NIM: penetapan UKT mahasiswa (/v1/keuangan/ukt/mahasiswa) per jenis biaya kelompok; penetapan aktif lama jenis biaya sama dibatalkan.
     *
     * `POST /v1/admisi/ukt/{id}/terapkan`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID adm_ukt
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUktByIdTerapkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/ukt/{id}/terapkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Laporan PMB
     *
     * Rekap per gelombang (pendaftaran, diajukan, terverifikasi, bayar, dinilai, lulus, daftar ulang), per jalur, per prodi, sumber informasi, asal sekolah, asal wilayah, tagihan per jenis/status, KIP, UKT.
     *
     * `GET /v1/admisi/laporan`
     *
     * scope: `admisi:read`
     *
     * @param array{gelombang_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/laporan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar percakapan
     *
     * Percakapan quick chat per akun pendaftar, pesan terakhir, jumlah belum dibaca. belum_dibalas=1 untuk yang pesan terakhirnya dari pendaftar.
     *
     * `GET /v1/admisi/chat`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{belum_dibalas?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getChat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/chat', [], $query, null, $options, false, false);
    }

    /**
     * Isi percakapan
     *
     * Pesan dengan satu akun pendaftar (pesan pendaftar ditandai dibaca) dan pendaftarannya.
     *
     * `GET /v1/admisi/chat/{akun}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $akun pmb_akun.id
     * @param array{sebelum?: string, limit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getChatByAkun(int|string $akun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/chat/{akun}', ['akun' => $akun], $query, null, $options, false, false);
    }

    /**
     * Balas pendaftar
     *
     * Body {"isi"}. Pendaftar mendapat notifikasi di aplikasi PMB.
     *
     * `POST /v1/admisi/chat/{akun}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $akun pmb_akun.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postChatByAkun(int|string $akun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/chat/{akun}', ['akun' => $akun], $query, null, $options, false, false);
    }

    /**
     * Chat saya
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Riwayat percakapan dengan panitia (balasan panitia ditandai dibaca).
     *
     * `GET /v1/admisi/saya/chat`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array{sebelum?: string, limit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaChat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/saya/chat', [], $query, null, $options, false, false);
    }

    /**
     * Kirim pesan ke panitia
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Body {"isi", "pendaftaran"? (uuid)}. Maks. 10 pesan per menit.
     *
     * `POST /v1/admisi/saya/chat`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaChat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/saya/chat', [], $query, null, $options, false, false);
    }

    /**
     * LoA, KIP, dan UKT saya
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. LoA (data surat + kode verifikasi) bila sudah terbit, pengajuan KIP Kuliah, data UKT.
     *
     * `GET /v1/admisi/saya/pendaftaran/{id}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/saya/pendaftaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan KIP Kuliah
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Body {"nik", "nisn", "no_pendaftaran_kip", "nomor_kip", "punya_kks_pkh", "penghasilan_ortu", "jumlah_tanggungan", "skema"}. Bisa diubah selama status diajukan. Berkas pendukung diunggah sebagai berkas pendaftaran PMB.
     *
     * `POST /v1/admisi/saya/pendaftaran/{id}/kip`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdKip(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/saya/pendaftaran/{id}/kip', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi data ekonomi UKT
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Body {"penghasilan_ayah", "penghasilan_ibu", "penghasilan_wali", "jumlah_tanggungan", "pekerjaan_ayah", "pekerjaan_ibu", "daya_listrik", "kepemilikan_rumah"}. Per kapita dan usulan kelompok dihitung otomatis; bisa diubah selama status diajukan.
     *
     * `POST /v1/admisi/saya/pendaftaran/{id}/ukt`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdUkt(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/saya/pendaftaran/{id}/ukt', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keringanan biaya: skema dan pengajuan saya
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Skema potongan/keringanan/beasiswa yang terbuka untuk calon mahasiswa (sasaran maba/semua, prodi pilihan) beserta syarat berkasnya, dan pengajuan pendaftar ini (status, kelengkapan berkas, nomor SK, potongan).
     *
     * `GET /v1/admisi/saya/pendaftaran/{id}/potongan`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranByIdPotongan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/saya/pendaftaran/{id}/potongan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan keringanan biaya
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Body {"skema_id", "alasan"}. Dibuat sebagai draf; unggah berkas syarat lalu ajukan. Disetujui petugas BAUK (dengan SK bila skema wajib SK); potongan mengurangi tagihan daftar ulang PMB yang belum dibayar dan dipasang ke tagihan semester setelah ber-NIM.
     *
     * `POST /v1/admisi/saya/pendaftaran/{id}/potongan`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdPotongan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/saya/pendaftaran/{id}/potongan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah berkas syarat keringanan
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Multipart "berkas" + "jenis" = kode syarat skema. Selama draf.
     *
     * `POST /v1/admisi/saya/pendaftaran/{id}/potongan/{nomor}/berkas`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param int|string $nomor Nomor pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdPotonganByNomorBerkas(int|string $id, int|string $nomor, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/saya/pendaftaran/{id}/potongan/{nomor}/berkas', ['id' => $id, 'nomor' => $nomor], $query, null, $options, false, false);
    }

    /**
     * Ajukan keringanan (kirim ke petugas)
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token. Syarat berkas wajib harus sudah diunggah.
     *
     * `POST /v1/admisi/saya/pendaftaran/{id}/potongan/{nomor}/ajukan`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id UUID pendaftaran PMB
     * @param int|string $nomor Nomor pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdPotonganByNomorAjukan(int|string $id, int|string $nomor, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/saya/pendaftaran/{id}/potongan/{nomor}/ajukan', ['id' => $id, 'nomor' => $nomor], $query, null, $options, false, false);
    }

    /**
     * Persyaratan penerimaan prodi: daftar
     *
     * Persyaratan per prodi (dan jalur): jurusan SMA/SMK yang diterima, nilai rapor minimal, tes kesehatan/buta warna, uraian lain. Bisa dibaca tanpa token untuk landing PMB. Kuota dan nilai minimal seleksi tetap di /v1/pmb/admin/gelombang/{id}/prodi, profil prodi di /v1/pmb/admin/prodi-info. Semua pemilik token ber-scope admisi:read (selain pengelola hanya melihat aktif 1).
     *
     * `GET /v1/admisi/prodi-syarat`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, tes_kesehatan?: string, tes_buta_warna?: string, aktif?: string, jalur_masuk?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProdiSyarat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/prodi-syarat', [], $query, null, $options, false, true);
    }

    /**
     * Persyaratan penerimaan prodi: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/admisi/prodi-syarat`
     *
     * scope: `admisi:write`
     *
     * @param array{kode_prodi: string, jalur_masuk?: string, judul: string, uraian?: string, jurusan_sma?: mixed, nilai_rapor_min?: float|int, tes_kesehatan?: bool, tes_buta_warna?: bool, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProdiSyarat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/prodi-syarat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Persyaratan penerimaan prodi: detail
     *
     * Persyaratan per prodi (dan jalur): jurusan SMA/SMK yang diterima, nilai rapor minimal, tes kesehatan/buta warna, uraian lain. Bisa dibaca tanpa token untuk landing PMB. Kuota dan nilai minimal seleksi tetap di /v1/pmb/admin/gelombang/{id}/prodi, profil prodi di /v1/pmb/admin/prodi-info. Semua pemilik token ber-scope admisi:read (selain pengelola hanya melihat aktif 1).
     *
     * `GET /v1/admisi/prodi-syarat/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProdiSyaratById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/prodi-syarat/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Persyaratan penerimaan prodi: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/prodi-syarat/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode_prodi: string, jalur_masuk?: string, judul: string, uraian?: string, jurusan_sma?: mixed, nilai_rapor_min?: float|int, tes_kesehatan?: bool, tes_buta_warna?: bool, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putProdiSyaratById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/prodi-syarat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Persyaratan penerimaan prodi: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/prodi-syarat/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProdiSyaratById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/prodi-syarat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Petugas sesi tes: daftar
     *
     * Pengawas, penguji, pewawancara, dan operator per sesi tes PMB (/v1/pmb/admin/sesi-tes). Peserta dan nomor kursi tetap di sesi tes. Petugas melihat jadwal tugasnya di GET /admisi/petugas/saya. Hanya pengelola modul.
     *
     * `GET /v1/admisi/petugas-sesi`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, peran?: string, sesi_id?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetugasSesi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/petugas-sesi', [], $query, null, $options, false, false);
    }

    /**
     * Petugas sesi tes: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/admisi/petugas-sesi`
     *
     * scope: `admisi:write`
     *
     * @param array{sesi_id: int, username: string, nama?: string, peran?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetugasSesi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/petugas-sesi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Petugas sesi tes: detail
     *
     * Pengawas, penguji, pewawancara, dan operator per sesi tes PMB (/v1/pmb/admin/sesi-tes). Peserta dan nomor kursi tetap di sesi tes. Petugas melihat jadwal tugasnya di GET /admisi/petugas/saya. Hanya pengelola modul.
     *
     * `GET /v1/admisi/petugas-sesi/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetugasSesiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/petugas-sesi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Petugas sesi tes: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/petugas-sesi/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{sesi_id: int, username: string, nama?: string, peran?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPetugasSesiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/petugas-sesi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Petugas sesi tes: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/petugas-sesi/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePetugasSesiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/petugas-sesi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Letter of Acceptance: daftar
     *
     * Surat penerimaan untuk pendaftar yang lulus seleksi. Terbitkan dengan POST /admisi/loa/terbitkan (nomor, data surat, kode verifikasi); detail berisi data cetak. Verifikasi publik: GET /admisi/loa/verifikasi/{kode}. Hanya pengelola modul.
     *
     * `GET /v1/admisi/loa`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLoa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/loa', [], $query, null, $options, false, false);
    }

    /**
     * Letter of Acceptance: detail
     *
     * Surat penerimaan untuk pendaftar yang lulus seleksi. Terbitkan dengan POST /admisi/loa/terbitkan (nomor, data surat, kode verifikasi); detail berisi data cetak. Verifikasi publik: GET /admisi/loa/verifikasi/{kode}. Hanya pengelola modul.
     *
     * `GET /v1/admisi/loa/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLoaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/loa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Letter of Acceptance: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/loa/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{batas_daftar_ulang?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putLoaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/loa/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Letter of Acceptance: Batalkan LoA
     *
     * Pengelola modul. Status harus terbit, menjadi batal.
     *
     * `POST /v1/admisi/loa/{id}/batal`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLoaByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/loa/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KIP Kuliah: daftar
     *
     * Pengajuan dan penerima KIP Kuliah (calon mahasiswa dari PMB atau mahasiswa). Alur: diajukan -> diverifikasi -> diusulkan (ke SIM KIP Kuliah) -> ditetapkan (nomor SK) / ditolak; penerima bisa dicabut. Pendaftar mengisi lewat POST /admisi/saya/pendaftaran/{uuid}/kip. Berkas (KIP/KKS/SKTM, foto rumah) lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/admisi/kip`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, punya_kks_pkh?: string, skema?: string, angkatan?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKip(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/kip', [], $query, null, $options, false, false);
    }

    /**
     * KIP Kuliah: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/admisi/kip`
     *
     * scope: `admisi:write`
     *
     * @param array{pmb_pendaftaran_id?: int, nim?: string, kode_prodi?: string, nama: string, nik?: string, nisn?: string, no_pendaftaran_kip?: string, nomor_kip?: string, punya_kks_pkh?: bool, penghasilan_ortu?: float|int, jumlah_tanggungan?: int, skema?: string, angkatan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKip(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/kip', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KIP Kuliah: detail
     *
     * Pengajuan dan penerima KIP Kuliah (calon mahasiswa dari PMB atau mahasiswa). Alur: diajukan -> diverifikasi -> diusulkan (ke SIM KIP Kuliah) -> ditetapkan (nomor SK) / ditolak; penerima bisa dicabut. Pendaftar mengisi lewat POST /admisi/saya/pendaftaran/{uuid}/kip. Berkas (KIP/KKS/SKTM, foto rumah) lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/admisi/kip/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKipById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/kip/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * KIP Kuliah: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/kip/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pmb_pendaftaran_id?: int, nim?: string, kode_prodi?: string, nama: string, nik?: string, nisn?: string, no_pendaftaran_kip?: string, nomor_kip?: string, punya_kks_pkh?: bool, penghasilan_ortu?: float|int, jumlah_tanggungan?: int, skema?: string, angkatan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKipById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/kip/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KIP Kuliah: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/kip/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKipById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/kip/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * KIP Kuliah: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/admisi/kip/{id}/berkas`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKipByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/kip/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * KIP Kuliah: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/admisi/kip/{id}/berkas`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKipByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/kip/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * KIP Kuliah: unduh lampiran
     *
     * `GET /v1/admisi/kip/{id}/berkas/{uuid}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKipByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/kip/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * KIP Kuliah: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/kip/{id}/berkas/{uuid}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKipByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/kip/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * KIP Kuliah: Verifikasi berkas dan data
     *
     * Pengelola modul. Status harus diajukan, menjadi diverifikasi.
     *
     * `POST /v1/admisi/kip/{id}/verifikasi`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKipByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/kip/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KIP Kuliah: Usulkan ke SIM KIP Kuliah
     *
     * Pengelola modul. Status harus diverifikasi, menjadi diusulkan.
     *
     * `POST /v1/admisi/kip/{id}/usulkan`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{no_pendaftaran_kip?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKipByIdUsulkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/kip/{id}/usulkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KIP Kuliah: Tetapkan sebagai penerima
     *
     * Pengelola modul. Status harus diusulkan/diverifikasi, menjadi ditetapkan.
     *
     * `POST /v1/admisi/kip/{id}/tetapkan`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nomor_sk: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKipByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/kip/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KIP Kuliah: Tolak
     *
     * Pengelola modul. Status harus diajukan/diverifikasi/diusulkan, menjadi ditolak.
     *
     * `POST /v1/admisi/kip/{id}/tolak`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKipByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/kip/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * KIP Kuliah: Cabut status penerima
     *
     * Pengelola modul. Status harus ditetapkan, menjadi dicabut.
     *
     * `POST /v1/admisi/kip/{id}/cabut`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKipByIdCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/kip/{id}/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * UKT pendaftar: daftar
     *
     * Data ekonomi pendaftar untuk penetapan kelompok UKT. Penghasilan per kapita dan kelompok usulan dihitung otomatis dari /admisi/ukt-aturan. Aksi tetapkan (kelompok keu_mhs_ukt_kelompok prodi), banding; setelah daftar ulang POST /admisi/ukt/{id}/terapkan menulis penetapan UKT mahasiswa di /v1/keuangan/ukt/mahasiswa (dipakai generate tagihan). Hanya pengelola modul.
     *
     * `GET /v1/admisi/ukt`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, nim?: string, kepemilikan_rumah?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUkt(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/ukt', [], $query, null, $options, false, false);
    }

    /**
     * UKT pendaftar: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/admisi/ukt`
     *
     * scope: `admisi:write`
     *
     * @param array{pmb_pendaftaran_id: int, kode_prodi?: string, penghasilan_ayah?: float|int, penghasilan_ibu?: float|int, penghasilan_wali?: float|int, jumlah_tanggungan?: int, pekerjaan_ayah?: string, pekerjaan_ibu?: string, daya_listrik?: int, kepemilikan_rumah?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUkt(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/ukt', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * UKT pendaftar: detail
     *
     * Data ekonomi pendaftar untuk penetapan kelompok UKT. Penghasilan per kapita dan kelompok usulan dihitung otomatis dari /admisi/ukt-aturan. Aksi tetapkan (kelompok keu_mhs_ukt_kelompok prodi), banding; setelah daftar ulang POST /admisi/ukt/{id}/terapkan menulis penetapan UKT mahasiswa di /v1/keuangan/ukt/mahasiswa (dipakai generate tagihan). Hanya pengelola modul.
     *
     * `GET /v1/admisi/ukt/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/ukt/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * UKT pendaftar: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/ukt/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pmb_pendaftaran_id: int, kode_prodi?: string, penghasilan_ayah?: float|int, penghasilan_ibu?: float|int, penghasilan_wali?: float|int, jumlah_tanggungan?: int, pekerjaan_ayah?: string, pekerjaan_ibu?: string, daya_listrik?: int, kepemilikan_rumah?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUktById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/ukt/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * UKT pendaftar: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/ukt/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUktById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/ukt/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * UKT pendaftar: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/admisi/ukt/{id}/berkas`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/ukt/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * UKT pendaftar: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/admisi/ukt/{id}/berkas`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUktByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/ukt/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * UKT pendaftar: unduh lampiran
     *
     * `GET /v1/admisi/ukt/{id}/berkas/{uuid}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/ukt/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * UKT pendaftar: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/ukt/{id}/berkas/{uuid}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUktByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/ukt/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * UKT pendaftar: Tetapkan kelompok UKT
     *
     * Pengelola modul. Status harus diajukan/banding/ditetapkan, menjadi ditetapkan.
     *
     * `POST /v1/admisi/ukt/{id}/tetapkan`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kelompok?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUktByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/ukt/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * UKT pendaftar: Catat banding
     *
     * Pengelola modul. Status harus ditetapkan, menjadi banding.
     *
     * `POST /v1/admisi/ukt/{id}/banding`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUktByIdBanding(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/ukt/{id}/banding', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan usulan kelompok UKT: daftar
     *
     * Rentang penghasilan per kapita (penghasilan ayah+ibu+wali dibagi jumlah tanggungan) untuk usulan kelompok UKT per prodi (kosong = semua prodi; aturan prodi didahulukan). Hanya pengelola modul.
     *
     * `GET /v1/admisi/ukt-aturan`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/ukt-aturan', [], $query, null, $options, false, false);
    }

    /**
     * Aturan usulan kelompok UKT: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/admisi/ukt-aturan`
     *
     * scope: `admisi:write`
     *
     * @param array{kode_prodi?: string, per_kapita_min?: float|int, per_kapita_maks?: float|int, kelompok: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUktAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/ukt-aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan usulan kelompok UKT: detail
     *
     * Rentang penghasilan per kapita (penghasilan ayah+ibu+wali dibagi jumlah tanggungan) untuk usulan kelompok UKT per prodi (kosong = semua prodi; aturan prodi didahulukan). Hanya pengelola modul.
     *
     * `GET /v1/admisi/ukt-aturan/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/ukt-aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan usulan kelompok UKT: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/ukt-aturan/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode_prodi?: string, per_kapita_min?: float|int, per_kapita_maks?: float|int, kelompok: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUktAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/ukt-aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan usulan kelompok UKT: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/ukt-aturan/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUktAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/ukt-aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Format NIM: daftar
     *
     * Pola NIM otomatis per prodi. Token: {YYYY} tahun masuk, {YY} dua digit tahun, {S} digit semester (1 ganjil, 2 genap), {PRODI} kode prodi, {NNN} nomor urut (panjang = jumlah N). Tanpa pola, NIM ditebak dari NIM angkatan terakhir prodi (bagian dua digit tahun diganti, nomor urut dilanjutkan). Hanya pengelola modul.
     *
     * `GET /v1/admisi/format-nim`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFormatNim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/format-nim', [], $query, null, $options, false, false);
    }

    /**
     * Format NIM: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/admisi/format-nim`
     *
     * scope: `admisi:write`
     *
     * @param array{kode_prodi: string, pola: string, mulai?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFormatNim(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/format-nim', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Format NIM: detail
     *
     * Pola NIM otomatis per prodi. Token: {YYYY} tahun masuk, {YY} dua digit tahun, {S} digit semester (1 ganjil, 2 genap), {PRODI} kode prodi, {NNN} nomor urut (panjang = jumlah N). Tanpa pola, NIM ditebak dari NIM angkatan terakhir prodi (bagian dua digit tahun diganti, nomor urut dilanjutkan). Hanya pengelola modul.
     *
     * `GET /v1/admisi/format-nim/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFormatNimById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/format-nim/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Format NIM: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/format-nim/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode_prodi: string, pola: string, mulai?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putFormatNimById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/format-nim/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Format NIM: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/format-nim/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteFormatNimById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/format-nim/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan NIM otomatis: daftar
     *
     * Aturan NIM dinamis bertingkat. Yang dipakai: aturan aktif yang cocok (prodi, fakultas, jenjang, jalur masuk, rentang periode masuk) dengan prioritas tertinggi, lalu yang paling spesifik (prodi > jalur > jenjang > fakultas). Tanpa aturan yang cocok dipakai format NIM per prodi (/admisi/format-nim), lalu tebakan dari NIM angkatan terakhir. Token pola: {YYYY} tahun masuk, {YY} dua digit tahun, {S} semester masuk (1 ganjil, 2 genap), {PRODI} kode prodi, {PRODI:n} n digit terakhir kode prodi, {FAK} kode fakultas, {JENJANG} kode jenjang, {JALUR} kode jalur masuk, {KODE} kode_khusus aturan, {NNN} nomor urut (panjang = jumlah N). urut_per=prodi_periode: nomor urut dihitung per prodi dan periode masuk. Coba dulu dengan GET /admisi/nim/pratinjau. Hanya pengelola modul.
     *
     * `GET /v1/admisi/aturan-nim`
     *
     * scope: `admisi:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, tahun_mulai?: string, tahun_selesai?: string, urut_per?: string, aktif?: string, kode_fakultas?: string, jalur_masuk?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanNim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/aturan-nim', [], $query, null, $options, false, false);
    }

    /**
     * Aturan NIM otomatis: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/admisi/aturan-nim`
     *
     * scope: `admisi:write`
     *
     * @param array{nama: string, kode_prodi?: string, kode_fakultas?: string, kode_jenjang?: string, jalur_masuk?: string, tahun_mulai?: string, tahun_selesai?: string, pola: string, kode_khusus?: string, mulai?: int, urut_per?: string, prioritas?: int, aktif?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanNim(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/admisi/aturan-nim', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan NIM otomatis: detail
     *
     * Aturan NIM dinamis bertingkat. Yang dipakai: aturan aktif yang cocok (prodi, fakultas, jenjang, jalur masuk, rentang periode masuk) dengan prioritas tertinggi, lalu yang paling spesifik (prodi > jalur > jenjang > fakultas). Tanpa aturan yang cocok dipakai format NIM per prodi (/admisi/format-nim), lalu tebakan dari NIM angkatan terakhir. Token pola: {YYYY} tahun masuk, {YY} dua digit tahun, {S} semester masuk (1 ganjil, 2 genap), {PRODI} kode prodi, {PRODI:n} n digit terakhir kode prodi, {FAK} kode fakultas, {JENJANG} kode jenjang, {JALUR} kode jalur masuk, {KODE} kode_khusus aturan, {NNN} nomor urut (panjang = jumlah N). urut_per=prodi_periode: nomor urut dihitung per prodi dan periode masuk. Coba dulu dengan GET /admisi/nim/pratinjau. Hanya pengelola modul.
     *
     * `GET /v1/admisi/aturan-nim/{id}`
     *
     * scope: `admisi:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanNimById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/admisi/aturan-nim/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan NIM otomatis: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/admisi/aturan-nim/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nama: string, kode_prodi?: string, kode_fakultas?: string, kode_jenjang?: string, jalur_masuk?: string, tahun_mulai?: string, tahun_selesai?: string, pola: string, kode_khusus?: string, mulai?: int, urut_per?: string, prioritas?: int, aktif?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAturanNimById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/admisi/aturan-nim/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan NIM otomatis: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/admisi/aturan-nim/{id}`
     *
     * scope: `admisi:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAturanNimById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/admisi/aturan-nim/{id}', ['id' => $id], $query, null, $options, false, false);
    }
}
