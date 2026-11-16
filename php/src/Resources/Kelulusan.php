<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kelulusan: Yudisium, Kelulusan: Syarat, Kelulusan: Wisuda, Kelulusan: Ijazah dan sertifikat, Kelulusan: Poin dan SKPI
 */
final class Kelulusan extends Resource
{
    /**
     * Hak akses kelulusan saya
     *
     * Pengelola (ADMIN, BAK, PROGDI, OPERATOR, peran kelulusan:kelola) atau mahasiswa, prodi yang boleh, tahun aktif.
     *
     * `GET /v1/kelulusan/saya`
     *
     * scope: `kelulusan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Periksa syarat kelulusan
     *
     * Syarat yudisium (aturan menu Lulus Akademik: batas SKS prodi, IPK/SKS minimal jenjang, TA lulus + judul, sudah daftar wisuda, KRS terakhir), syarat daftar wisuda (TA lulus, SKS, status A, nilai D/E), syarat tambahan prodi (/kelulusan/syarat), IPK, predikat, status akhir. boleh_yudisium dan boleh_wisuda merangkum semuanya. Query tahun_id = periode lulus (bawaan tahun aktif). Mahasiswa hanya miliknya.
     *
     * `GET /v1/kelulusan/mahasiswa/{nim}/syarat`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimSyarat(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/mahasiswa/{nim}/syarat', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kandidat lulus (yudisium)
     *
     * Daftar menu Lulus Akademik: mahasiswa berstatus A pada periode, belum lulus/DO, dalam batas studi; tiap baris dengan SKS, IPK, boleh, dan alasan bila belum boleh.
     *
     * `GET /v1/kelulusan/kandidat`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{angkatan?: string, nim?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKandidat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/kandidat', [], $query, null, $options, false, false);
    }

    /**
     * Tetapkan lulus (yudisium)
     *
     * Body: {"tanggal_lulus", "mahasiswa": [{"nim", "no_sk_yudisium", "no_ijazah", "pin_ijazah"}]} atau {"nim": [...], "no_sk_yudisium_awalan", "no_ijazah_awalan"} (nomor = awalan + NIM seperti form non-ADMIN). Per mahasiswa dijalankan proses lulus menu Lulus Akademik: m_mahasiswa status L + SK/ijazah/PIN + tanggal wisuda, t_mahasiswa_status_lulus_do (SKS, IPK, data TA), m_log. Mahasiswa yang syaratnya belum terpenuhi dilewati dengan alasan (ADMIN boleh {"paksa": true}). PIN ijazah yang sudah dipakai ditolak.
     *
     * `POST /v1/kelulusan/yudisium`
     *
     * scope: `kelulusan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postYudisium(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/yudisium', [], $query, null, $options, false, false);
    }

    /**
     * Tetapkan status akhir (DO, keluar, wafat, ...)
     *
     * Body: {"status": "D|K|H|M|W|U|P|L", "tahun_id"}. Langkah menu Mahasiswa K.H.M.W.U: validasi (DO harus melampaui batas studi, tidak di luar periode lulus/DO), t_mahasiswa_status_lulus_do + status m_mahasiswa, m_log.
     *
     * `POST /v1/kelulusan/mahasiswa/{nim}/status-akhir`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMahasiswaByNimStatusAkhir(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/mahasiswa/{nim}/status-akhir', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Hapus status akhir (ADMIN)
     *
     * Body: {"alasan"}. Langkah hapus menu K.H.M.W.U: baris lulus/DO dihapus, mahasiswa kembali berstatus N pada periode itu.
     *
     * `POST /v1/kelulusan/mahasiswa/{nim}/status-akhir/hapus`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMahasiswaByNimStatusAkhirHapus(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/mahasiswa/{nim}/status-akhir/hapus', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Predikat kelulusan
     *
     * m_predikat per jenjang (rentang IPK). Predikat tiap lulusan dihitung otomatis di syarat, lulusan, kartu wisuda, dan data ijazah.
     *
     * `GET /v1/kelulusan/predikat`
     *
     * scope: `kelulusan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPredikat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/predikat', [], $query, null, $options, false, false);
    }

    /**
     * Data lulusan
     *
     * Mahasiswa berstatus L: periode/tanggal lulus, SKS, IPK, predikat, SK yudisium, no ijazah, PIN. Filter prodi, tahun_lulus, q, ada_pin.
     *
     * `GET /v1/kelulusan/lulusan`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{prodi?: string, tahun_lulus?: string, q?: string, ada_pin?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLulusan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/lulusan', [], $query, null, $options, false, false);
    }

    /**
     * Periode wisuda/yudisium
     *
     * m_wisuda per prodi: masa pendaftaran, tanggal wisuda, jumlah pendaftar dan diterima. Query buka=1 hanya yang sedang dibuka.
     *
     * `GET /v1/kelulusan/periode`
     *
     * scope: `kelulusan:read`
     *
     * @param array{prodi?: string, tahun_id?: string, buka?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/periode', [], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah periode wisuda
     *
     * Body: {"idw" (untuk ubah), "nama", "tanggal_mulai", "tanggal_selesai", "tanggal_wisuda", "tahun_id", "prodi"}. Langkah Konfigurasi Yudisium (m_wisuda, m_log).
     *
     * `POST /v1/kelulusan/periode`
     *
     * scope: `kelulusan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/periode', [], $query, null, $options, false, false);
    }

    /**
     * Hapus periode wisuda
     *
     * Ditolak 409 bila sudah ada pendaftar, kecuali {"paksa": true} (pendaftaran tidak ikut terhapus).
     *
     * `POST /v1/kelulusan/periode/{idw}/hapus`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $idw m_wisuda.idw
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdwHapus(int|string $idw, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/periode/{idw}/hapus', ['idw' => $idw], $query, null, $options, false, false);
    }

    /**
     * Status pendaftaran wisuda
     *
     * Untuk mahasiswa (pengelola: ?nim=): syarat daftar, pendaftaran periode ini, periode yang dibuka untuk prodinya, dan isian formulir.
     *
     * `GET /v1/kelulusan/wisuda/saya`
     *
     * scope: `kelulusan:read`
     *
     * @param array{nim?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getWisudaSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/wisuda/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar wisuda
     *
     * Body: {"idw", "toga", "ukuran_toga", "topi", "ukuran_topi", "kalung", "undangan", "foto", "ijazah"} (+ "nim", "ket", "terima", "paksa" untuk pengelola). Mahasiswa: periode harus dibuka dan syarat wisuda terpenuhi; langkah Pendaftaran Wisuda (ubah bila sudah mendaftar dan belum diterima). Pengelola: langkah tambah/ubah Daftar Wisudawan.
     *
     * `POST /v1/kelulusan/wisuda/daftar`
     *
     * scope: `kelulusan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWisudaDaftar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/wisuda/daftar', [], $query, null, $options, false, false);
    }

    /**
     * Data wisudawan
     *
     * Pendaftar wisuda per periode akademik: periode, status diterima, perlengkapan, no ijazah/PIN.
     *
     * `GET /v1/kelulusan/wisudawan`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{idw?: string, terima?: string, q?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getWisudawan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/wisudawan', [], $query, null, $options, false, false);
    }

    /**
     * Terima/tolak pendaftar wisuda
     *
     * Body: {"terima": {"<idwm>": "Y"|"N"}}. Langkah simpan status Daftar Wisudawan (m_log).
     *
     * `POST /v1/kelulusan/wisudawan/terima`
     *
     * scope: `kelulusan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWisudawanTerima(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/wisudawan/terima', [], $query, null, $options, false, false);
    }

    /**
     * Hapus pendaftaran wisuda
     *
     * Langkah hapus Daftar Wisudawan (m_log).
     *
     * `POST /v1/kelulusan/wisudawan/{idwm}/hapus`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $idwm t_mahasiswa_wisuda.idwm
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWisudawanByIdwmHapus(int|string $idwm, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/wisudawan/{idwm}/hapus', ['idwm' => $idwm], $query, null, $options, false, false);
    }

    /**
     * Kartu wisuda
     *
     * Data cetak kartu peserta: identitas, prodi/fakultas, periode dan tanggal wisuda, nomor urut (di antara yang diterima), IPK, predikat, perlengkapan, kode verifikasi. Mahasiswa hanya miliknya.
     *
     * `GET /v1/kelulusan/wisudawan/{idwm}/kartu`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $idwm t_mahasiswa_wisuda.idwm
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getWisudawanByIdwmKartu(int|string $idwm, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/wisudawan/{idwm}/kartu', ['idwm' => $idwm], $query, null, $options, false, false);
    }

    /**
     * Data ijazah
     *
     * Data cetak ijazah: identitas (nilai revisi *_rev bila ada), program studi + gelar, data lulus/SK yudisium, no ijazah, PIN, predikat, penanda tangan (t_ttd_ijazah fakultas + periode lulus). Transkrip akhir: GET /v1/mahasiswa/{nim}/transkrip atau /v1/akademik/mahasiswa/{nim}/transkrip-sementara.
     *
     * `GET /v1/kelulusan/mahasiswa/{nim}/ijazah`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimIjazah(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/mahasiswa/{nim}/ijazah', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Ubah identitas ijazah
     *
     * Body: sebagian dari NIM_rev, nama_mahasiswa_rev, tahun_masuk_rev, tgl_sk_yudisium_rev, tempat_lahir_rev, tanggal_lahir_rev, tanggal_beri_ijazah_rev, gelar_panjang_rev, gelar_rev, alamat_rev, no_ijazah_rev, pin_ijazah. Isian lain tetap. Langkah Edit Identitas Daftar Wisudawan (m_mahasiswa + no ijazah/tanggal SK di lulus_do).
     *
     * `POST /v1/kelulusan/mahasiswa/{nim}/ijazah`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMahasiswaByNimIjazah(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/mahasiswa/{nim}/ijazah', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Impor PIN ijazah (PISN)
     *
     * Body: {"data": [{"nim", "pin_ijazah", "no_ijazah"?}]} (maks. 2000), mis. hasil unduhan PISN Kemdiktisaintek. Per baris langkah ubah identitas ijazah; PIN yang dipakai mahasiswa lain ditolak per baris.
     *
     * `POST /v1/kelulusan/ijazah/pin`
     *
     * scope: `kelulusan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIjazahPin(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/ijazah/pin', [], $query, null, $options, false, false);
    }

    /**
     * Penanda tangan ijazah
     *
     * t_ttd_ijazah untuk fakultas prodi dan periode lulus.
     *
     * `GET /v1/kelulusan/ijazah/ttd`
     *
     * scope: `kelulusan:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIjazahTtd(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/ijazah/ttd', [], $query, null, $options, false, false);
    }

    /**
     * Simpan penanda tangan ijazah
     *
     * Body: {"jabatan_kiri", "jabatan_kanan", "NIDN_kiri", "NIDN_kanan", "footer_kiri", "footer_kanan"} (sebagian boleh). Langkah Tanda Tangan menu Ijazah.
     *
     * `POST /v1/kelulusan/ijazah/ttd`
     *
     * scope: `kelulusan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIjazahTtd(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/ijazah/ttd', [], $query, null, $options, false, false);
    }

    /**
     * Poin kemahasiswaan mahasiswa
     *
     * Total dan rincian poin: kegiatan terverifikasi (/kelulusan/poin/kegiatan), prestasi terverifikasi (/kemahasiswaan/prestasi), pengurus ormawa; dinilai dengan /kelulusan/poin/aturan.
     *
     * `GET /v1/kelulusan/mahasiswa/{nim}/poin`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimPoin(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/mahasiswa/{nim}/poin', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Verifikasi SKPI (publik)
     *
     * Tanpa token, untuk QR di SKPI. NIM dan nama disamarkan.
     *
     * `GET /v1/kelulusan/skpi/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpiVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/skpi/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Syarat kelulusan tambahan: daftar
     *
     * Syarat yudisium/wisuda tambahan per prodi (kosong = semua prodi) di luar aturan akademik SIAKAD: diverifikasi pengelola (manual/unggah), poin kemahasiswaan minimal, bebas tunggakan (dihitung dari tagihan SIAKAD), atau bebas pustaka (pinjaman perpustakaan SIAKAD dan SLiMS). Hasilnya ikut di GET /kelulusan/syarat/{nim}. Semua pemilik token ber-scope kelulusan:read.
     *
     * `GET /v1/kelulusan/syarat`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, untuk?: string, jenis?: string, wajib?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyarat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat', [], $query, null, $options, false, false);
    }

    /**
     * Syarat kelulusan tambahan: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kelulusan/syarat`
     *
     * scope: `kelulusan:write`
     *
     * @param array{kode_prodi?: string, untuk?: string, kode: string, nama: string, keterangan?: string, jenis?: string, nilai_minimal?: float|int, wajib?: bool, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSyarat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/syarat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Syarat kelulusan tambahan: detail
     *
     * Syarat yudisium/wisuda tambahan per prodi (kosong = semua prodi) di luar aturan akademik SIAKAD: diverifikasi pengelola (manual/unggah), poin kemahasiswaan minimal, bebas tunggakan (dihitung dari tagihan SIAKAD), atau bebas pustaka (pinjaman perpustakaan SIAKAD dan SLiMS). Hasilnya ikut di GET /kelulusan/syarat/{nim}. Semua pemilik token ber-scope kelulusan:read.
     *
     * `GET /v1/kelulusan/syarat/{id}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyaratById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Syarat kelulusan tambahan: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kelulusan/syarat/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode_prodi?: string, untuk?: string, kode: string, nama: string, keterangan?: string, jenis?: string, nilai_minimal?: float|int, wajib?: bool, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSyaratById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kelulusan/syarat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Syarat kelulusan tambahan: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kelulusan/syarat/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSyaratById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/syarat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Syarat kelulusan tambahan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Syarat yudisium/wisuda tambahan per prodi (kosong = semua prodi) di luar aturan akademik SIAKAD: diverifikasi pengelola (manual/unggah), poin kemahasiswaan minimal, bebas tunggakan (dihitung dari tagihan SIAKAD), atau bebas pustaka (pinjaman perpustakaan SIAKAD dan SLiMS). Hasilnya ikut di GET /kelulusan/syarat/{nim}. Semua pemilik token ber-scope kelulusan:read.
     *
     * `GET /v1/kelulusan/syarat/{id}/riwayat`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyaratByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: daftar
     *
     * Mahasiswa mengajukan bukti pemenuhan syarat manual/unggah (lampiran lewat /berkas); pengelola menyatakan terpenuhi atau menolak. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/syarat-mahasiswa`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, syarat_id?: string, nim?: string, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyaratMahasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat-mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kelulusan/syarat-mahasiswa`
     *
     * scope: `kelulusan:write`
     *
     * @param array{syarat_id: int, nim: string, keterangan?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSyaratMahasiswa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/syarat-mahasiswa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: detail
     *
     * Mahasiswa mengajukan bukti pemenuhan syarat manual/unggah (lampiran lewat /berkas); pengelola menyatakan terpenuhi atau menolak. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/syarat-mahasiswa/{id}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyaratMahasiswaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat-mahasiswa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kelulusan/syarat-mahasiswa/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{syarat_id: int, nim: string, keterangan?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSyaratMahasiswaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kelulusan/syarat-mahasiswa/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kelulusan/syarat-mahasiswa/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSyaratMahasiswaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/syarat-mahasiswa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Mahasiswa mengajukan bukti pemenuhan syarat manual/unggah (lampiran lewat /berkas); pengelola menyatakan terpenuhi atau menolak. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/syarat-mahasiswa/{id}/riwayat`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyaratMahasiswaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat-mahasiswa/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kelulusan/syarat-mahasiswa/{id}/berkas`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyaratMahasiswaByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat-mahasiswa/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kelulusan/syarat-mahasiswa/{id}/berkas`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSyaratMahasiswaByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/syarat-mahasiswa/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: unduh lampiran
     *
     * `GET /v1/kelulusan/syarat-mahasiswa/{id}/berkas/{uuid}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSyaratMahasiswaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/syarat-mahasiswa/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kelulusan/syarat-mahasiswa/{id}/berkas/{uuid}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSyaratMahasiswaByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/syarat-mahasiswa/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: Nyatakan terpenuhi
     *
     * Pengelola modul. Status harus diajukan/ditolak, menjadi terpenuhi.
     *
     * `POST /v1/kelulusan/syarat-mahasiswa/{id}/terpenuhi`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSyaratMahasiswaByIdTerpenuhi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/syarat-mahasiswa/{id}/terpenuhi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemenuhan syarat mahasiswa: Tolak
     *
     * Pengelola modul. Status harus diajukan/terpenuhi, menjadi ditolak.
     *
     * `POST /v1/kelulusan/syarat-mahasiswa/{id}/tolak`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSyaratMahasiswaByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/syarat-mahasiswa/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan poin kemahasiswaan: daftar
     *
     * Poin per kategori kegiatan, tingkat, dan peran (peran kosong = semua peran). Dipakai untuk kegiatan kls_poin yang diverifikasi, prestasi kemahasiswaan (kategori prestasi, peran = peringkat), dan pengurus ormawa (kategori organisasi, tingkat internal, peran = jabatan). Semua pemilik token ber-scope kelulusan:read.
     *
     * `GET /v1/kelulusan/poin/aturan`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kategori?: string, tingkat?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Aturan poin kemahasiswaan: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/kelulusan/poin/aturan`
     *
     * scope: `kelulusan:write`
     *
     * @param array{kategori: string, tingkat?: string, peran?: string, poin: float|int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPoinAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/poin/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan poin kemahasiswaan: detail
     *
     * Poin per kategori kegiatan, tingkat, dan peran (peran kosong = semua peran). Dipakai untuk kegiatan kls_poin yang diverifikasi, prestasi kemahasiswaan (kategori prestasi, peran = peringkat), dan pengurus ormawa (kategori organisasi, tingkat internal, peran = jabatan). Semua pemilik token ber-scope kelulusan:read.
     *
     * `GET /v1/kelulusan/poin/aturan/{id}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan poin kemahasiswaan: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kelulusan/poin/aturan/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kategori: string, tingkat?: string, peran?: string, poin: float|int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPoinAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kelulusan/poin/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan poin kemahasiswaan: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/kelulusan/poin/aturan/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePoinAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/poin/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan poin kemahasiswaan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Poin per kategori kegiatan, tingkat, dan peran (peran kosong = semua peran). Dipakai untuk kegiatan kls_poin yang diverifikasi, prestasi kemahasiswaan (kategori prestasi, peran = peringkat), dan pengurus ormawa (kategori organisasi, tingkat internal, peran = jabatan). Semua pemilik token ber-scope kelulusan:read.
     *
     * `GET /v1/kelulusan/poin/aturan/{id}/riwayat`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinAturanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/aturan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: daftar
     *
     * Kegiatan mahasiswa (organisasi, kepanitiaan, seminar, pengabdian, sertifikasi, dll.) yang diajukan mahasiswa dan diverifikasi pengelola. Saat diverifikasi poin diisi dari aturan (atau isian poin). Kegiatan tampil_skpi masuk ke SKPI. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/poin/kegiatan`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, tahun_id?: string, kategori?: string, tingkat?: string, tampil_skpi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinKegiatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/kegiatan', [], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kelulusan/poin/kegiatan`
     *
     * scope: `kelulusan:write`
     *
     * @param array{nim: string, tahun_id?: string, kategori: string, tingkat?: string, peran?: string, nama_kegiatan: string, nama_kegiatan_en?: string, penyelenggara?: string, tanggal?: string, poin?: float|int, tampil_skpi?: bool, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPoinKegiatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/poin/kegiatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: detail
     *
     * Kegiatan mahasiswa (organisasi, kepanitiaan, seminar, pengabdian, sertifikasi, dll.) yang diajukan mahasiswa dan diverifikasi pengelola. Saat diverifikasi poin diisi dari aturan (atau isian poin). Kegiatan tampil_skpi masuk ke SKPI. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/poin/kegiatan/{id}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kelulusan/poin/kegiatan/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, tahun_id?: string, kategori: string, tingkat?: string, peran?: string, nama_kegiatan: string, nama_kegiatan_en?: string, penyelenggara?: string, tanggal?: string, poin?: float|int, tampil_skpi?: bool, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPoinKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kelulusan/poin/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kelulusan/poin/kegiatan/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePoinKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/poin/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kegiatan mahasiswa (organisasi, kepanitiaan, seminar, pengabdian, sertifikasi, dll.) yang diajukan mahasiswa dan diverifikasi pengelola. Saat diverifikasi poin diisi dari aturan (atau isian poin). Kegiatan tampil_skpi masuk ke SKPI. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/poin/kegiatan/{id}/riwayat`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinKegiatanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/kegiatan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kelulusan/poin/kegiatan/{id}/berkas`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinKegiatanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/kegiatan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kelulusan/poin/kegiatan/{id}/berkas`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPoinKegiatanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/poin/kegiatan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: unduh lampiran
     *
     * `GET /v1/kelulusan/poin/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPoinKegiatanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/poin/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kelulusan/poin/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePoinKegiatanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/poin/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: Verifikasi dan beri poin
     *
     * Pengelola modul. Status harus diajukan/ditolak, menjadi diverifikasi.
     *
     * `POST /v1/kelulusan/poin/kegiatan/{id}/verifikasi`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{poin?: float|int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPoinKegiatanByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/poin/kegiatan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan dan poin mahasiswa: Tolak
     *
     * Pengelola modul. Status harus diajukan/diverifikasi, menjadi ditolak.
     *
     * `POST /v1/kelulusan/poin/kegiatan/{id}/tolak`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPoinKegiatanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/poin/kegiatan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKPI: daftar
     *
     * Surat Keterangan Pendamping Ijazah satu per mahasiswa: draf (mahasiswa/pengelola) -> diajukan -> disetujui -> terbit (nomor + kode verifikasi). Detail berisi isi lengkap SKPI: identitas & ijazah, profil prodi (template SKPI m_template), capaian, kegiatan/prestasi terverifikasi, dan sertifikat. Verifikasi publik: GET /kelulusan/skpi/verifikasi/{kode}. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/skpi`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/skpi', [], $query, null, $options, false, false);
    }

    /**
     * SKPI: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak.
     *
     * `POST /v1/kelulusan/skpi`
     *
     * scope: `kelulusan:write`
     *
     * @param array{nim: string, capaian?: array<string, mixed>, informasi_tambahan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/skpi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKPI: detail
     *
     * Surat Keterangan Pendamping Ijazah satu per mahasiswa: draf (mahasiswa/pengelola) -> diajukan -> disetujui -> terbit (nomor + kode verifikasi). Detail berisi isi lengkap SKPI: identitas & ijazah, profil prodi (template SKPI m_template), capaian, kegiatan/prestasi terverifikasi, dan sertifikat. Verifikasi publik: GET /kelulusan/skpi/verifikasi/{kode}. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/skpi/{id}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/skpi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SKPI: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kelulusan/skpi/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, capaian?: array<string, mixed>, informasi_tambahan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkpiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kelulusan/skpi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKPI: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf/ditolak.
     *
     * `DELETE /v1/kelulusan/skpi/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSkpiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/skpi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SKPI: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Surat Keterangan Pendamping Ijazah satu per mahasiswa: draf (mahasiswa/pengelola) -> diajukan -> disetujui -> terbit (nomor + kode verifikasi). Detail berisi isi lengkap SKPI: identitas & ijazah, profil prodi (template SKPI m_template), capaian, kegiatan/prestasi terverifikasi, dan sertifikat. Verifikasi publik: GET /kelulusan/skpi/verifikasi/{kode}. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/skpi/{id}/riwayat`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkpiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/skpi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SKPI: Ajukan untuk diperiksa
     *
     * Pemilik data atau pengelola. Status harus draf/ditolak, menjadi diajukan.
     *
     * `POST /v1/kelulusan/skpi/{id}/ajukan`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpiByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/skpi/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * SKPI: Setujui isi SKPI
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/kelulusan/skpi/{id}/setujui`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpiByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/skpi/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKPI: Terbitkan (beri nomor)
     *
     * Pengelola modul. Status harus disetujui, menjadi terbit.
     *
     * `POST /v1/kelulusan/skpi/{id}/terbitkan`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nomor?: string, tanggal_terbit?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpiByIdTerbitkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/skpi/{id}/terbitkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * SKPI: Kembalikan untuk diperbaiki
     *
     * Pengelola modul. Status harus diajukan/disetujui, menjadi ditolak.
     *
     * `POST /v1/kelulusan/skpi/{id}/tolak`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkpiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/skpi/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: daftar
     *
     * Sertifikat profesi (dengan nomor PISN bila ada), kompetensi, dan keahlian lulusan. Mahasiswa mengunggah, pengelola memverifikasi; yang terverifikasi dan tampil_skpi masuk ke SKPI. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/sertifikat`
     *
     * scope: `kelulusan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, jenis?: string, tampil_skpi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSertifikat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/sertifikat', [], $query, null, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kelulusan/sertifikat`
     *
     * scope: `kelulusan:write`
     *
     * @param array{nim: string, jenis?: string, nama: string, nomor?: string, nomor_pisn?: string, penerbit?: string, skema?: string, tanggal_terbit?: string, berlaku_sampai?: string, tampil_skpi?: bool, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSertifikat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/sertifikat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: detail
     *
     * Sertifikat profesi (dengan nomor PISN bila ada), kompetensi, dan keahlian lulusan. Mahasiswa mengunggah, pengelola memverifikasi; yang terverifikasi dan tampil_skpi masuk ke SKPI. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/sertifikat/{id}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSertifikatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/sertifikat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kelulusan/sertifikat/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, jenis?: string, nama: string, nomor?: string, nomor_pisn?: string, penerbit?: string, skema?: string, tanggal_terbit?: string, berlaku_sampai?: string, tampil_skpi?: bool, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSertifikatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kelulusan/sertifikat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kelulusan/sertifikat/{id}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSertifikatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/sertifikat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Sertifikat profesi (dengan nomor PISN bila ada), kompetensi, dan keahlian lulusan. Mahasiswa mengunggah, pengelola memverifikasi; yang terverifikasi dan tampil_skpi masuk ke SKPI. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/kelulusan/sertifikat/{id}/riwayat`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSertifikatByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/sertifikat/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kelulusan/sertifikat/{id}/berkas`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSertifikatByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/sertifikat/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `POST /v1/kelulusan/sertifikat/{id}/berkas`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSertifikatByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/sertifikat/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: unduh lampiran
     *
     * `GET /v1/kelulusan/sertifikat/{id}/berkas/{uuid}`
     *
     * scope: `kelulusan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSertifikatByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kelulusan/sertifikat/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan/ditolak.
     *
     * `DELETE /v1/kelulusan/sertifikat/{id}/berkas/{uuid}`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSertifikatByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kelulusan/sertifikat/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: Verifikasi
     *
     * Pengelola modul. Status harus diajukan/ditolak, menjadi diverifikasi.
     *
     * `POST /v1/kelulusan/sertifikat/{id}/verifikasi`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSertifikatByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/sertifikat/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikat profesi dan kompetensi: Tolak
     *
     * Pengelola modul. Status harus diajukan/diverifikasi, menjadi ditolak.
     *
     * `POST /v1/kelulusan/sertifikat/{id}/tolak`
     *
     * scope: `kelulusan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSertifikatByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kelulusan/sertifikat/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
