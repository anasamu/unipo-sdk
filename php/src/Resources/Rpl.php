<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * RPL: Pemohon, RPL: Asesmen, RPL: Pengajuan, RPL: Master
 */
final class Rpl extends Resource
{
    /**
     * RPL saya
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Pendaftaran PMB pemohon, skema RPL yang tersedia untuk prodi pilihannya, dan pengajuan RPL beserta pengalaman, klaim, dan dokumen.
     *
     * `GET /v1/rpl/saya`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/saya', [], $query, null, $options, false, false);
    }

    /**
     * Buat/ubah pengajuan RPL
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Body {"pendaftaran": "<uuid pendaftaran PMB>", "skema_id", "asal_pt", "asal_prodi", "ringkasan", "hp"}. Satu pengajuan aktif per pendaftaran dan prodi; selama draf boleh diubah.
     *
     * `POST /v1/rpl/saya/pengajuan`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/saya/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Mata kuliah yang bisa diklaim
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Mata kuliah kurikulum aktif terbaru prodi skema.
     *
     * `GET /v1/rpl/saya/pengajuan/{id}/mata-kuliah`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPengajuanByIdMataKuliah(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/saya/pengajuan/{id}/mata-kuliah', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah pengalaman
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Body {"id"? (ubah), "jenis", "judul", "instansi", "mulai", "selesai", "durasi_jam", "uraian"}.
     *
     * `POST /v1/rpl/saya/pengajuan/{id}/pengalaman`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPengajuanByIdPengalaman(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/saya/pengajuan/{id}/pengalaman', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah klaim mata kuliah
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Body {"id"? (ubah), "id_mk", "kode_mk_asal", "nama_mk_asal", "sks_asal", "nilai_asal", "asesmen_mandiri", "bukti"}.
     *
     * `POST /v1/rpl/saya/pengajuan/{id}/klaim`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPengajuanByIdKlaim(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/saya/pengajuan/{id}/klaim', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah dokumen bukti
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Multipart: berkas (file), jenis (cv, ijazah, transkrip, sertifikat, surat_keterangan_kerja, portofolio, silabus, lainnya), judul, pengalaman_id?. Atau JSON berkas_base64 + nama_file.
     *
     * `POST /v1/rpl/saya/pengajuan/{id}/dokumen`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPengajuanByIdDokumen(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/saya/pengajuan/{id}/dokumen', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus pengalaman/klaim/dokumen
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). jenis = pengalaman, klaim, atau dokumen. Hanya selama draf.
     *
     * `POST /v1/rpl/saya/pengajuan/{id}/{jenis}/{anak}/hapus`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pengajuan
     * @param int|string $jenis pengalaman | klaim | dokumen
     * @param int|string $anak ID baris
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPengajuanByIdByJenisByAnakHapus(int|string $id, int|string $jenis, int|string $anak, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/saya/pengajuan/{id}/{jenis}/{anak}/hapus', ['id' => $id, 'jenis' => $jenis, 'anak' => $anak], $query, null, $options, false, false);
    }

    /**
     * Hapus draf pengajuan RPL
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Hanya pemilik (akun pendaftar) dan hanya selama berstatus draf; pengalaman, klaim, dan dokumennya ikut dihapus (hapus lunak, tercatat di jejak). Pengajuan yang sudah diajukan tidak bisa dihapus (409).
     *
     * `DELETE /v1/rpl/saya/pengajuan/{id}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSayaPengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/saya/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan RPL
     *
     * Token klien ber-scope pmb:pendaftar + header X-Pmb-Akun-Token (pemohon yang masuk di aplikasi PMB). Perlu minimal satu klaim, satu pengalaman, dan satu dokumen. Setelah diajukan pemohon tidak bisa mengubah kecuali dikembalikan panitia.
     *
     * `POST /v1/rpl/saya/pengajuan/{id}/ajukan`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPengajuanByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/saya/pengajuan/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tugas asesor saya
     *
     * Pengajuan yang ditugaskan ke pengguna token sebagai asesor.
     *
     * `GET /v1/rpl/asesor/saya`
     *
     * scope: `rpl:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsesorSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/asesor/saya', [], $query, null, $options, false, false);
    }

    /**
     * Rekap nilai
     *
     * Nilai per klaim: per asesor (rata-rata berbobot komponen) dan rata-rata antarasesor, serta pratinjau hasil (huruf dari m_nilai prodi, diakui bila >= nilai_lulus skema, dibatasi sks_maks).
     *
     * `GET /v1/rpl/pengajuan/{id}/rekap`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID pengajuan (angka atau UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanByIdRekap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengajuan/{id}/rekap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi nilai massal
     *
     * Body {"asesor_id"? (pengelola), "nilai": [{"klaim_id", "komponen_id", "nilai", "catatan"?}]}. Asesor mengisi nilainya sendiri; nilai yang sudah ada ditimpa. Hanya saat status asesmen.
     *
     * `POST /v1/rpl/pengajuan/{id}/nilai`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID pengajuan (angka atau UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdNilai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/nilai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tetapkan hasil RPL
     *
     * Body {"nomor_sk", "tanggal_sk", "klaim": [{"id", "nilai_akhir"?, "status"? diakui|tidak_diakui, "catatan"?}], "pratinjau"?: true}. Nilai akhir = rata-rata asesor kecuali diisi; huruf dari m_nilai; SKS diakui dibatasi sks_maks skema. Status pengajuan jadi ditetapkan.
     *
     * `POST /v1/rpl/pengajuan/{id}/tetapkan`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID pengajuan (angka atau UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdTetapkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/tetapkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Masukkan hasil ke KRS SIAKAD
     *
     * Body {"kelas" (m_kelas.kode_kelas prodi), "nim"?}. Untuk pemohon yang sudah daftar ulang (NIM dari PMB bila tidak diisi). Mata kuliah diakui ditulis sebagai nilai konversi dengan langkah menu KRS Input Pindahan (t_mahasiswa_krs tahun 00000 pindahan Y, m_log); SKS diakui mahasiswa dinaikkan bila kurang. Mahasiswa harus berstatus masuk P.
     *
     * `POST /v1/rpl/pengajuan/{id}/integrasi`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID pengajuan (angka atau UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdIntegrasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/integrasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Nilai konversi mahasiswa
     *
     * Nilai konversi pindahan/RPL di KRS (pindahan Y), SKS diakui, dan SKS terisi.
     *
     * `GET /v1/rpl/konversi/{nim}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKonversiByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/konversi/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Simpan nilai konversi (pindahan)
     *
     * Body {"kelas", "data": [{"kode_mk", "nilai" (huruf), "kode_mk_asal", "nama_mk_asal", "sks_asal"}], "naikkan_sks_diakui"?: false}. Langkah menu KRS Input Pindahan untuk mahasiswa pindahan (status masuk P): mata kuliah kurikulum semester masuk (atau sebelumnya), bobot dari m_nilai, total SKS <= SKS diakui, m_log. Yang sudah ada diperbarui nilainya.
     *
     * `POST /v1/rpl/konversi/{nim}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKonversiByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/konversi/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Skema RPL: daftar
     *
     * Skema RPL per prodi: transfer_kredit (A1, dari pendidikan formal/perguruan tinggi lain) atau perolehan_kredit (A2, dari pengalaman kerja/pelatihan/nonformal). sks_maks = batas SKS yang diakui, nilai_lulus = nilai akhir minimal (0-100) agar mata kuliah diakui. Semua pemilik token ber-scope rpl:read.
     *
     * `GET /v1/rpl/skema`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, tipe?: string, tahun_id?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkema(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/skema', [], $query, null, $options, false, false);
    }

    /**
     * Skema RPL: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/skema`
     *
     * scope: `rpl:write`
     *
     * @param array{kode_prodi: string, tipe?: string, nama: string, keterangan?: string, sks_maks?: int, nilai_lulus?: float|int, tahun_id?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkema(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/skema', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema RPL: detail
     *
     * Skema RPL per prodi: transfer_kredit (A1, dari pendidikan formal/perguruan tinggi lain) atau perolehan_kredit (A2, dari pengalaman kerja/pelatihan/nonformal). sks_maks = batas SKS yang diakui, nilai_lulus = nilai akhir minimal (0-100) agar mata kuliah diakui. Semua pemilik token ber-scope rpl:read.
     *
     * `GET /v1/rpl/skema/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/skema/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema RPL: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/skema/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode_prodi: string, tipe?: string, nama: string, keterangan?: string, sks_maks?: int, nilai_lulus?: float|int, tahun_id?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkemaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/skema/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema RPL: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/skema/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSkemaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/skema/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema RPL: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Skema RPL per prodi: transfer_kredit (A1, dari pendidikan formal/perguruan tinggi lain) atau perolehan_kredit (A2, dari pengalaman kerja/pelatihan/nonformal). sks_maks = batas SKS yang diakui, nilai_lulus = nilai akhir minimal (0-100) agar mata kuliah diakui. Semua pemilik token ber-scope rpl:read.
     *
     * `GET /v1/rpl/skema/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/skema/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komposisi penilaian RPL: daftar
     *
     * Komponen penilaian per skema (portofolio, wawancara, uji praktik, ujian tulis, ...) dengan bobot persen. Bila jumlah bobot bukan 100, nilai akhir tetap dihitung proporsional terhadap total bobot komponen yang dinilai. Semua pemilik token ber-scope rpl:read.
     *
     * `GET /v1/rpl/komponen`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, skema_id?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomponen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/komponen', [], $query, null, $options, false, false);
    }

    /**
     * Komposisi penilaian RPL: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/komponen`
     *
     * scope: `rpl:write`
     *
     * @param array{skema_id: int, nama: string, bobot: float|int, urutan?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKomponen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/komponen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komposisi penilaian RPL: detail
     *
     * Komponen penilaian per skema (portofolio, wawancara, uji praktik, ujian tulis, ...) dengan bobot persen. Bila jumlah bobot bukan 100, nilai akhir tetap dihitung proporsional terhadap total bobot komponen yang dinilai. Semua pemilik token ber-scope rpl:read.
     *
     * `GET /v1/rpl/komponen/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomponenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/komponen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komposisi penilaian RPL: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/komponen/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{skema_id: int, nama: string, bobot: float|int, urutan?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKomponenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/komponen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komposisi penilaian RPL: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/komponen/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKomponenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/komponen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komposisi penilaian RPL: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Komponen penilaian per skema (portofolio, wawancara, uji praktik, ujian tulis, ...) dengan bobot persen. Bila jumlah bobot bukan 100, nilai akhir tetap dihitung proporsional terhadap total bobot komponen yang dinilai. Semua pemilik token ber-scope rpl:read.
     *
     * `GET /v1/rpl/komponen/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomponenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/komponen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Asesor RPL: daftar
     *
     * Dosen (NIDN; akun SIAKAD-nya otomatis dipakai) atau asesor luar (isi username akun SIAKAD bila asesor perlu masuk untuk menilai). Prodi kosong = lintas prodi. Hanya pengelola modul.
     *
     * `GET /v1/rpl/asesor`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nidn?: string, username?: string, kode_prodi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsesor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/asesor', [], $query, null, $options, false, false);
    }

    /**
     * Asesor RPL: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/asesor`
     *
     * scope: `rpl:write`
     *
     * @param array{nidn?: string, username?: string, nama?: string, kode_prodi?: string, bidang?: string, nomor_sertifikat?: string, instansi?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAsesor(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/asesor', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Asesor RPL: detail
     *
     * Dosen (NIDN; akun SIAKAD-nya otomatis dipakai) atau asesor luar (isi username akun SIAKAD bila asesor perlu masuk untuk menilai). Prodi kosong = lintas prodi. Hanya pengelola modul.
     *
     * `GET /v1/rpl/asesor/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsesorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/asesor/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Asesor RPL: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/asesor/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nidn?: string, username?: string, nama?: string, kode_prodi?: string, bidang?: string, nomor_sertifikat?: string, instansi?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAsesorById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/asesor/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Asesor RPL: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/asesor/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAsesorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/asesor/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Asesor RPL: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Dosen (NIDN; akun SIAKAD-nya otomatis dipakai) atau asesor luar (isi username akun SIAKAD bila asesor perlu masuk untuk menilai). Prodi kosong = lintas prodi. Hanya pengelola modul.
     *
     * `GET /v1/rpl/asesor/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsesorByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/asesor/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan RPL: daftar
     *
     * Pengajuan RPL calon mahasiswa (dibuat pemohon lewat /v1/rpl/saya atau oleh panitia). Alur: draf -> diajukan -> asesmen (asesor ditugaskan) -> ditetapkan (POST /rpl/pengajuan/{id}/tetapkan) atau ditolak. Setelah daftar ulang, nilai mata kuliah yang diakui ditulis ke KRS SIAKAD dengan POST /rpl/pengajuan/{id}/integrasi. Detail memuat pengalaman, dokumen, klaim, asesor, dan rekap nilai. Hanya pengelola modul.
     *
     * `GET /v1/rpl/pengajuan`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, skema_id?: string, kode_prodi?: string, nim?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Pengajuan RPL: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/pengajuan`
     *
     * scope: `rpl:write`
     *
     * @param array{skema_id: int, pmb_pendaftaran_id?: int, nama: string, email?: string, hp?: string, asal_pt?: string, asal_prodi?: string, ringkasan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan RPL: detail
     *
     * Pengajuan RPL calon mahasiswa (dibuat pemohon lewat /v1/rpl/saya atau oleh panitia). Alur: draf -> diajukan -> asesmen (asesor ditugaskan) -> ditetapkan (POST /rpl/pengajuan/{id}/tetapkan) atau ditolak. Setelah daftar ulang, nilai mata kuliah yang diakui ditulis ke KRS SIAKAD dengan POST /rpl/pengajuan/{id}/integrasi. Detail memuat pengalaman, dokumen, klaim, asesor, dan rekap nilai. Hanya pengelola modul.
     *
     * `GET /v1/rpl/pengajuan/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan RPL: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/pengajuan/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{skema_id: int, pmb_pendaftaran_id?: int, nama: string, email?: string, hp?: string, asal_pt?: string, asal_prodi?: string, ringkasan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengajuanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/pengajuan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan RPL: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/pengajuan/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan RPL: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pengajuan RPL calon mahasiswa (dibuat pemohon lewat /v1/rpl/saya atau oleh panitia). Alur: draf -> diajukan -> asesmen (asesor ditugaskan) -> ditetapkan (POST /rpl/pengajuan/{id}/tetapkan) atau ditolak. Setelah daftar ulang, nilai mata kuliah yang diakui ditulis ke KRS SIAKAD dengan POST /rpl/pengajuan/{id}/integrasi. Detail memuat pengalaman, dokumen, klaim, asesor, dan rekap nilai. Hanya pengelola modul.
     *
     * `GET /v1/rpl/pengajuan/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengajuan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan RPL: Ajukan untuk asesmen (atas nama pemohon)
     *
     * Pengelola modul. Status harus draf, menjadi diajukan.
     *
     * `POST /v1/rpl/pengajuan/{id}/ajukan`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan RPL: Mulai asesmen
     *
     * Perlu minimal satu asesor ditugaskan (/rpl/penugasan) dan satu mata kuliah diklaim. Pengelola modul. Status harus diajukan, menjadi asesmen.
     *
     * `POST /v1/rpl/pengajuan/{id}/mulai-asesmen`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdMulaiAsesmen(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/mulai-asesmen', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan RPL: Kembalikan ke pemohon
     *
     * Pengelola modul. Status harus diajukan/asesmen, menjadi draf.
     *
     * `POST /v1/rpl/pengajuan/{id}/kembalikan`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan RPL: Tolak pengajuan
     *
     * Pengelola modul. Status harus diajukan/asesmen, menjadi ditolak.
     *
     * `POST /v1/rpl/pengajuan/{id}/tolak`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan RPL: Batalkan
     *
     * Pengelola modul. Status harus draf/diajukan/asesmen, menjadi batal.
     *
     * `POST /v1/rpl/pengajuan/{id}/batal`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengajuan/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: daftar
     *
     * Riwayat kerja, pelatihan, sertifikasi, pendidikan formal/nonformal, organisasi, dan karya pemohon. Lampiran bukti lewat /berkas atau /rpl/dokumen. Hanya pengelola modul.
     *
     * `GET /v1/rpl/pengalaman`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pengajuan_id?: string, jenis?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengalaman', [], $query, null, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/pengalaman`
     *
     * scope: `rpl:write`
     *
     * @param array{pengajuan_id: int, jenis: string, judul: string, instansi?: string, mulai?: string, selesai?: string, durasi_jam?: int, uraian?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengalaman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengalaman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: detail
     *
     * Riwayat kerja, pelatihan, sertifikasi, pendidikan formal/nonformal, organisasi, dan karya pemohon. Lampiran bukti lewat /berkas atau /rpl/dokumen. Hanya pengelola modul.
     *
     * `GET /v1/rpl/pengalaman/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengalaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/pengalaman/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pengajuan_id: int, jenis: string, judul: string, instansi?: string, mulai?: string, selesai?: string, durasi_jam?: int, uraian?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengalamanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/pengalaman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/pengalaman/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/pengalaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Riwayat kerja, pelatihan, sertifikasi, pendidikan formal/nonformal, organisasi, dan karya pemohon. Lampiran bukti lewat /berkas atau /rpl/dokumen. Hanya pengelola modul.
     *
     * `GET /v1/rpl/pengalaman/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengalaman/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/rpl/pengalaman/{id}/berkas`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengalaman/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/rpl/pengalaman/{id}/berkas`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengalamanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/pengalaman/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pengalaman pemohon RPL: unduh lampiran
     *
     * `GET /v1/rpl/pengalaman/{id}/berkas/{uuid}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/pengalaman/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengalaman pemohon RPL: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/pengalaman/{id}/berkas/{uuid}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengalamanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/pengalaman/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: daftar
     *
     * Dokumen bukti (CV, ijazah, transkrip, sertifikat, surat keterangan kerja, portofolio, silabus). File diunggah ke /rpl/dokumen/{id}/berkas. Pengelola memvalidasi (aksi valid/tidak-valid). Hanya pengelola modul.
     *
     * `GET /v1/rpl/dokumen`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pengajuan_id?: string, pengalaman_id?: string, jenis?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/dokumen`
     *
     * scope: `rpl:write`
     *
     * @param array{pengajuan_id: int, pengalaman_id?: int, jenis: string, judul: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: detail
     *
     * Dokumen bukti (CV, ijazah, transkrip, sertifikat, surat keterangan kerja, portofolio, silabus). File diunggah ke /rpl/dokumen/{id}/berkas. Pengelola memvalidasi (aksi valid/tidak-valid). Hanya pengelola modul.
     *
     * `GET /v1/rpl/dokumen/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/dokumen/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pengajuan_id: int, pengalaman_id?: int, jenis: string, judul: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/dokumen/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Dokumen bukti (CV, ijazah, transkrip, sertifikat, surat keterangan kerja, portofolio, silabus). File diunggah ke /rpl/dokumen/{id}/berkas. Pengelola memvalidasi (aksi valid/tidak-valid). Hanya pengelola modul.
     *
     * `GET /v1/rpl/dokumen/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/dokumen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/rpl/dokumen/{id}/berkas`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/dokumen/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/rpl/dokumen/{id}/berkas`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/dokumen/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Dokumen bukti RPL: unduh lampiran
     *
     * `GET /v1/rpl/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: Nyatakan valid
     *
     * Pengelola modul. Status harus diajukan/tidak_valid, menjadi valid.
     *
     * `POST /v1/rpl/dokumen/{id}/valid`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdValid(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/dokumen/{id}/valid', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen bukti RPL: Nyatakan tidak valid
     *
     * Pengelola modul. Status harus diajukan/valid, menjadi tidak_valid.
     *
     * `POST /v1/rpl/dokumen/{id}/tidak-valid`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdTidakValid(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/dokumen/{id}/tidak-valid', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mata kuliah yang diklaim: daftar
     *
     * Mata kuliah prodi tujuan (m_mata_kuliah.id) yang diklaim pemohon, dengan padanan mata kuliah asal (transfer kredit) atau asesmen mandiri dan uraian bukti (perolehan kredit). nilai_akhir, nilai_huruf, dan status diisi oleh POST /rpl/pengajuan/{id}/hitung dan /tetapkan. Hanya pengelola modul.
     *
     * `GET /v1/rpl/klaim`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pengajuan_id?: string, asesmen_mandiri?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKlaim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/klaim', [], $query, null, $options, false, false);
    }

    /**
     * Mata kuliah yang diklaim: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/klaim`
     *
     * scope: `rpl:write`
     *
     * @param array{pengajuan_id: int, id_mk: int, kode_mk_asal?: string, nama_mk_asal?: string, sks_asal?: int, nilai_asal?: string, asesmen_mandiri?: string, bukti?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKlaim(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/klaim', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mata kuliah yang diklaim: detail
     *
     * Mata kuliah prodi tujuan (m_mata_kuliah.id) yang diklaim pemohon, dengan padanan mata kuliah asal (transfer kredit) atau asesmen mandiri dan uraian bukti (perolehan kredit). nilai_akhir, nilai_huruf, dan status diisi oleh POST /rpl/pengajuan/{id}/hitung dan /tetapkan. Hanya pengelola modul.
     *
     * `GET /v1/rpl/klaim/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKlaimById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/klaim/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mata kuliah yang diklaim: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/klaim/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pengajuan_id: int, id_mk: int, kode_mk_asal?: string, nama_mk_asal?: string, sks_asal?: int, nilai_asal?: string, asesmen_mandiri?: string, bukti?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKlaimById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/klaim/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mata kuliah yang diklaim: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/klaim/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKlaimById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/klaim/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mata kuliah yang diklaim: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Mata kuliah prodi tujuan (m_mata_kuliah.id) yang diklaim pemohon, dengan padanan mata kuliah asal (transfer kredit) atau asesmen mandiri dan uraian bukti (perolehan kredit). nilai_akhir, nilai_huruf, dan status diisi oleh POST /rpl/pengajuan/{id}/hitung dan /tetapkan. Hanya pengelola modul.
     *
     * `GET /v1/rpl/klaim/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKlaimByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/klaim/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan asesor: daftar
     *
     * Asesor yang menilai satu pengajuan (ketua/anggota). Asesor diberi kabar di SIAKAD. Hanya pengelola modul.
     *
     * `GET /v1/rpl/penugasan`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pengajuan_id?: string, asesor_id?: string, peran?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenugasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/penugasan', [], $query, null, $options, false, false);
    }

    /**
     * Penugasan asesor: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/penugasan`
     *
     * scope: `rpl:write`
     *
     * @param array{pengajuan_id: int, asesor_id: int, peran?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenugasan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/penugasan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penugasan asesor: detail
     *
     * Asesor yang menilai satu pengajuan (ketua/anggota). Asesor diberi kabar di SIAKAD. Hanya pengelola modul.
     *
     * `GET /v1/rpl/penugasan/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenugasanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/penugasan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan asesor: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/penugasan/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pengajuan_id: int, asesor_id: int, peran?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPenugasanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/penugasan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penugasan asesor: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/penugasan/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePenugasanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/penugasan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan asesor: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Asesor yang menilai satu pengajuan (ketua/anggota). Asesor diberi kabar di SIAKAD. Hanya pengelola modul.
     *
     * `GET /v1/rpl/penugasan/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenugasanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/penugasan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Nilai asesor: daftar
     *
     * Nilai 0-100 per mata kuliah klaim, asesor, dan komponen penilaian. Asesor hanya mengisi nilainya sendiri (asesor_id otomatis) selama pengajuan berstatus asesmen. Isi banyak sekaligus: POST /rpl/pengajuan/{id}/nilai. Hanya pengelola modul.
     *
     * `GET /v1/rpl/nilai`
     *
     * scope: `rpl:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, klaim_id?: string, asesor_id?: string, komponen_id?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNilai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/nilai', [], $query, null, $options, false, false);
    }

    /**
     * Nilai asesor: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/rpl/nilai`
     *
     * scope: `rpl:write`
     *
     * @param array{klaim_id: int, asesor_id?: int, komponen_id: int, nilai: float|int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNilai(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/rpl/nilai', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Nilai asesor: detail
     *
     * Nilai 0-100 per mata kuliah klaim, asesor, dan komponen penilaian. Asesor hanya mengisi nilainya sendiri (asesor_id otomatis) selama pengajuan berstatus asesmen. Isi banyak sekaligus: POST /rpl/pengajuan/{id}/nilai. Hanya pengelola modul.
     *
     * `GET /v1/rpl/nilai/{id}`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNilaiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/nilai/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Nilai asesor: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/rpl/nilai/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{klaim_id: int, asesor_id?: int, komponen_id: int, nilai: float|int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putNilaiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/rpl/nilai/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Nilai asesor: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/rpl/nilai/{id}`
     *
     * scope: `rpl:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteNilaiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/rpl/nilai/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Nilai asesor: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Nilai 0-100 per mata kuliah klaim, asesor, dan komponen penilaian. Asesor hanya mengisi nilainya sendiri (asesor_id otomatis) selama pengajuan berstatus asesmen. Isi banyak sekaligus: POST /rpl/pengajuan/{id}/nilai. Hanya pengelola modul.
     *
     * `GET /v1/rpl/nilai/{id}/riwayat`
     *
     * scope: `rpl:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNilaiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/rpl/nilai/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }
}
