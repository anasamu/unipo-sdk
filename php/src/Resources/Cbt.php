<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * CBT: Nilai ke SIAKAD, CBT: Ujian percobaan, CBT: Koreksi dan hasil, CBT: Peserta ujian, CBT: Sesi dan pengawasan, CBT: Soal, CBT: Peserta, CBT: Ujian
 */
final class Cbt extends Resource
{
    /**
     * Pratinjau kirim nilai ke SIAKAD
     *
     * Rencana penulisan nilai ujian ke t_mahasiswa_nilai: per peserta aksi tambah/ubah/sama/dilewati/ditolak beserta alasannya
     * (belum selesai, esai belum dikoreksi, tidak ada KRS disetujui, syarat presensi UAS). `jenis_nilai` bawaan dari jenis ujian
     * (uts = UTS, uas = UAS, kuis = Harian); `batas_input_nilai` menunjukkan apakah input nilai sedang dibuka per kelas (ADMIN bebas).
     *
     * `GET /v1/cbt/ujian/{id}/nilai-siakad`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID ujian
     * @param array{jenis_nilai?: string, nilai_ke?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianByIdNilaiSiakad(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian/{id}/nilai-siakad', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim nilai ke SIAKAD
     *
     * Menulis baris tambah/ubah dari pratinjau ke t_mahasiswa_nilai (kolom sama seperti import nilai angka) dan m_log. Nilai akhir KHS dihitung SIAKAD seperti biasa. Body opsional: jenis_nilai, nilai_ke. 409 bila batas input nilai tutup atau tidak ada yang perlu dikirim.
     *
     * `POST /v1/cbt/ujian/{id}/nilai-siakad`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID ujian
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdNilaiSiakad(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/nilai-siakad', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat pengiriman nilai
     *
     * `GET /v1/cbt/ujian/{id}/nilai-siakad/riwayat`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianByIdNilaiSiakadRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian/{id}/nilai-siakad/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan pengiriman nilai
     *
     * Mengembalikan nilai lama (baris yang ditambahkan dihapus). Baris yang sudah diubah lagi di SIAKAD tidak ditimpa kecuali body `paksa: true`.
     *
     * `POST /v1/cbt/ujian/{id}/nilai-siakad/{kirim}/batal`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID ujian
     * @param int|string $kirim ID pengiriman
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdNilaiSiakadByKirimBatal(int|string $id, int|string $kirim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/nilai-siakad/{kirim}/batal', ['id' => $id, 'kirim' => $kirim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar ujian latihan
     *
     * Ujian ber-latihan=1 yang siap dan punya sesi dibuka, beserta status dan nilai terakhir pengguna. Dibatasi prodi pengguna bila ujian berprodi.
     *
     * `GET /v1/cbt/latihan`
     *
     * scope: `cbt:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLatihan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/latihan', [], $query, null, $options, false, false);
    }

    /**
     * Mulai / ulangi ujian latihan
     *
     * Mendaftarkan pengguna ke sesi latihan tanpa token pengawas, atau mengulang bila sudah selesai (jawaban lama dihapus). Hasilnya lembar ujian dan peserta_id untuk endpoint /cbt/kerjakan/{peserta_id}. Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi ujian di perangkat); bersama User-Agent dipakai untuk kunci perangkat.
     *
     * `POST /v1/cbt/latihan/{id}/mulai`
     *
     * scope: `cbt:write` · hanya token pengguna
     *
     * @param int|string $id ID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLatihanByIdMulai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/latihan/{id}/mulai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peringkat peserta
     *
     * Pengelola: peringkat semua peserta selesai (nilai sama = peringkat sama), peringkat dalam prodi, persentil, durasi. Peserta: posisinya sendiri bila ujian menampilkan hasil atau ujian latihan.
     *
     * `GET /v1/cbt/ujian/{id}/peringkat`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianByIdPeringkat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian/{id}/peringkat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian saya
     *
     * Ujian (siap/selesai) tempat pengguna terdaftar sebagai peserta, dengan sesi, status, dan `bisa_mulai`.
     *
     * `GET /v1/cbt/saya`
     *
     * scope: `cbt:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/saya', [], $query, null, $options, false, false);
    }

    /**
     * Mulai ujian
     *
     * Body: token (dari pengawas). Bila sudah mengerjakan, melanjutkan (sambung ulang) dari perangkat yang sama. Soal dan opsi diacak per peserta; batas waktu dihitung server (durasi + tambahan, tidak melewati akhir sesi). Mengembalikan lembar soal tanpa kunci. Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi ujian di perangkat); bersama User-Agent dipakai untuk kunci perangkat.
     *
     * `POST /v1/cbt/kerjakan/{id}/mulai`
     *
     * scope: `cbt:write` · hanya token pengguna
     *
     * @param int|string $id ID peserta (dari /cbt/saya)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerjakanByIdMulai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/kerjakan/{id}/mulai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lembar ujian
     *
     * Soal, jawaban tersimpan, tanda ragu, sisa_detik. Bila waktu habis, ujian otomatis diakhiri dan dinilai; hasil tampil bila ujian `tampil_hasil`. Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi ujian di perangkat); bersama User-Agent dipakai untuk kunci perangkat.
     *
     * `GET /v1/cbt/kerjakan/{id}`
     *
     * scope: `cbt:read` · hanya token pengguna
     *
     * @param int|string $id ID peserta
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKerjakanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/kerjakan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan jawaban
     *
     * Body: soal_id, jawaban (bentuk sesuai jenis soal; null = kosongkan), ragu; atau `jawaban_banyak`: [{soal_id, jawaban, ragu}] untuk sinkron setelah koneksi putus. Ditolak setelah waktu habis (kelonggaran 30 detik). Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi ujian di perangkat); bersama User-Agent dipakai untuk kunci perangkat.
     *
     * `POST /v1/cbt/kerjakan/{id}/jawab`
     *
     * scope: `cbt:write` · hanya token pengguna
     *
     * @param int|string $id ID peserta
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerjakanByIdJawab(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/kerjakan/{id}/jawab', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat kejadian
     *
     * Body: jenis (keluar_layar, pindah_tab, salin_tempel, layar_penuh, koneksi_putus, lainnya), detail. Keluar layar, pindah tab, dan salin-tempel menambah hitungan pelanggaran yang terlihat pengawas.
     *
     * `POST /v1/cbt/kerjakan/{id}/log`
     *
     * scope: `cbt:write` · hanya token pengguna
     *
     * @param int|string $id ID peserta
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerjakanByIdLog(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/kerjakan/{id}/log', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Selesai ujian
     *
     * Mengakhiri dan menilai otomatis (esai menunggu koreksi). Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi ujian di perangkat); bersama User-Agent dipakai untuk kunci perangkat.
     *
     * `POST /v1/cbt/kerjakan/{id}/selesai`
     *
     * scope: `cbt:write` · hanya token pengguna
     *
     * @param int|string $id ID peserta
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerjakanByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/kerjakan/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pantau sesi
     *
     * Untuk pengawas sesi atau pengelola: token, ringkasan status, dan tiap peserta (progres terjawab, sisa waktu, pelanggaran, kejadian terakhir, perangkat terkunci). Tindakan lewat aksi peserta: reset-perangkat, tambah-waktu, diskualifikasi.
     *
     * `GET /v1/cbt/sesi/{id}/pantau`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesiByIdPantau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/sesi/{id}/pantau', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jawaban esai untuk dikoreksi
     *
     * Jawaban esai peserta yang sudah selesai dan belum dikoreksi (`semua=1` termasuk yang sudah). Pengelola.
     *
     * `GET /v1/cbt/ujian/{id}/koreksi`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID ujian
     * @param array{semua?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianByIdKoreksi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian/{id}/koreksi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Beri skor jawaban
     *
     * Body: skor (0 sampai poin soal). Nilai dan kelulusan peserta dihitung ulang; skor koreksi manual tidak ditimpa penilaian otomatis. Pengelola.
     *
     * `POST /v1/cbt/jawaban/{id}/koreksi`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID jawaban
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJawabanByIdKoreksi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/jawaban/{id}/koreksi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hasil dan analisis butir
     *
     * Statistik nilai (rata, median, simpangan baku, distribusi, lulus), daftar peserta, dan analisis butir: indeks kesukaran, daya beda kelompok atas/bawah 27%, sebaran pilihan. Pengelola.
     *
     * `GET /v1/cbt/ujian/{id}/hasil`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianByIdHasil(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian/{id}/hasil', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Impor dari bank soal LMS
     *
     * Body: `ids` [lms_bank_soal.id] atau saringan kode_mk/kode_prodi/jenis/tingkat/tag dengan `jumlah` (acak). Soal disalin (bank soal tidak berubah); yang sudah pernah diimpor dilewati. Pengelola.
     *
     * `POST /v1/cbt/ujian/{id}/impor-bank-soal`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdImporBankSoal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/impor-bank-soal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi peserta
     *
     * Body: sesi_id, sumber `krs` (mahasiswa yang mengambil kode_mk ujian di tahun_id ujian, disaring kelas/prodi ujian bila diisi; t_mahasiswa_krs hanya dibaca) atau `daftar` dengan username [..]. Yang sudah terdaftar dilewati. Pengelola.
     *
     * `POST /v1/cbt/ujian/{id}/isi-peserta`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdIsiPeserta(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/isi-peserta', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian: daftar
     *
     * Ujian berbasis komputer. Soal hanya bisa diubah selama belum ada peserta yang mulai. Aksi `siapkan` memeriksa soal dan sesi sebelum ujian bisa dikerjakan. Pengawas melihat ujian yang sesinya ia awasi. Hanya pengelola modul.
     *
     * `GET /v1/cbt/ujian`
     *
     * scope: `cbt:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, tahun_id?: string, kode_prodi?: string, acak_soal?: string, acak_opsi?: string, tampil_hasil?: string, kunci_perangkat?: string, latihan?: string, status?: string, kode_mk?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian', [], $query, null, $options, false, false);
    }

    /**
     * Ujian: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/cbt/ujian`
     *
     * scope: `cbt:write`
     *
     * @param array{kode: string, nama: string, jenis?: string, tahun_id?: string, kode_prodi?: string, kode_mk?: string, kelas?: string, durasi_menit?: int, jumlah_soal?: int, acak_soal?: bool, acak_opsi?: bool, nilai_lulus?: float|int, tampil_hasil?: bool, kunci_perangkat?: bool, latihan?: bool, petunjuk?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjian(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ujian: detail
     *
     * Ujian berbasis komputer. Soal hanya bisa diubah selama belum ada peserta yang mulai. Aksi `siapkan` memeriksa soal dan sesi sebelum ujian bisa dikerjakan. Pengawas melihat ujian yang sesinya ia awasi. Hanya pengelola modul.
     *
     * `GET /v1/cbt/ujian/{id}`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/cbt/ujian/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, jenis?: string, tahun_id?: string, kode_prodi?: string, kode_mk?: string, kelas?: string, durasi_menit?: int, jumlah_soal?: int, acak_soal?: bool, acak_opsi?: bool, nilai_lulus?: float|int, tampil_hasil?: bool, kunci_perangkat?: bool, latihan?: bool, petunjuk?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUjianById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/cbt/ujian/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ujian: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/cbt/ujian/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUjianById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/cbt/ujian/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Ujian berbasis komputer. Soal hanya bisa diubah selama belum ada peserta yang mulai. Aksi `siapkan` memeriksa soal dan sesi sebelum ujian bisa dikerjakan. Pengawas melihat ujian yang sesinya ia awasi. Hanya pengelola modul.
     *
     * `GET /v1/cbt/ujian/{id}/riwayat`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/ujian/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian: Siapkan ujian
     *
     * Memeriksa ujian punya soal (cukup untuk jumlah_soal) dan minimal satu sesi. Pengelola modul. Status harus draf, menjadi siap.
     *
     * `POST /v1/cbt/ujian/{id}/siapkan`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdSiapkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/siapkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian: Kembalikan ke draf
     *
     * Pengelola modul. Status harus siap, menjadi draf.
     *
     * `POST /v1/cbt/ujian/{id}/kembali-draf`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdKembaliDraf(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/kembali-draf', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian: Selesaikan ujian
     *
     * Mengakhiri semua peserta yang masih mengerjakan (dinilai) dan menandai yang belum mulai sebagai tidak hadir. Pengelola modul. Status harus siap, menjadi selesai.
     *
     * `POST /v1/cbt/ujian/{id}/selesaikan`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdSelesaikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/selesaikan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ujian: Arsipkan
     *
     * Pengelola modul. Status harus draf/selesai, menjadi diarsip.
     *
     * `POST /v1/cbt/ujian/{id}/arsipkan`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/ujian/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Soal: daftar
     *
     * Format sama dengan bank soal LMS: `opsi` [{id, teks}] dan `kunci` "a" / ["a","c"] / true / ["jawaban"] / {"kiri-id": "kanan-id"} (menjodohkan: opsi {kiri: [...], kanan: [...]}). Esai tanpa kunci dan dikoreksi manual. Kunci hanya terlihat oleh pengelola. Soal terkunci setelah ada peserta yang mulai. Hanya pengelola modul.
     *
     * `GET /v1/cbt/soal`
     *
     * scope: `cbt:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ujian_id?: string, jenis?: string, tingkat?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSoal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/soal', [], $query, null, $options, false, false);
    }

    /**
     * Soal: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/cbt/soal`
     *
     * scope: `cbt:write`
     *
     * @param array{ujian_id: int, jenis?: string, pertanyaan: string, opsi?: mixed, kunci?: mixed, poin?: float|int, tingkat?: string, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSoal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/soal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Soal: detail
     *
     * Format sama dengan bank soal LMS: `opsi` [{id, teks}] dan `kunci` "a" / ["a","c"] / true / ["jawaban"] / {"kiri-id": "kanan-id"} (menjodohkan: opsi {kiri: [...], kanan: [...]}). Esai tanpa kunci dan dikoreksi manual. Kunci hanya terlihat oleh pengelola. Soal terkunci setelah ada peserta yang mulai. Hanya pengelola modul.
     *
     * `GET /v1/cbt/soal/{id}`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSoalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/soal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Soal: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/cbt/soal/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{ujian_id: int, jenis?: string, pertanyaan: string, opsi?: mixed, kunci?: mixed, poin?: float|int, tingkat?: string, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSoalById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/cbt/soal/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Soal: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/cbt/soal/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSoalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/cbt/soal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Soal: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Format sama dengan bank soal LMS: `opsi` [{id, teks}] dan `kunci` "a" / ["a","c"] / true / ["jawaban"] / {"kiri-id": "kanan-id"} (menjodohkan: opsi {kiri: [...], kanan: [...]}). Esai tanpa kunci dan dikoreksi manual. Kunci hanya terlihat oleh pengelola. Soal terkunci setelah ada peserta yang mulai. Hanya pengelola modul.
     *
     * `GET /v1/cbt/soal/{id}/riwayat`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSoalByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/soal/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sesi: daftar
     *
     * Sesi per ruang/waktu. Pengawas (username) melihat sesinya, membuka sesi (token dibuat otomatis, dibagikan ke peserta di ruang), mengganti token, menangani peserta, dan menutup sesi dengan berita acara. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengawas).
     *
     * `GET /v1/cbt/sesi`
     *
     * scope: `cbt:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ujian_id?: string, ruang_id?: string, pengawas?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/sesi', [], $query, null, $options, false, false);
    }

    /**
     * Sesi: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/cbt/sesi`
     *
     * scope: `cbt:write`
     *
     * @param array{ujian_id: int, nama: string, ruang_id?: int, mulai: string, selesai: string, pengawas?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/sesi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sesi: detail
     *
     * Sesi per ruang/waktu. Pengawas (username) melihat sesinya, membuka sesi (token dibuat otomatis, dibagikan ke peserta di ruang), mengganti token, menangani peserta, dan menutup sesi dengan berita acara. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengawas).
     *
     * `GET /v1/cbt/sesi/{id}`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/sesi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sesi: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/cbt/sesi/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{ujian_id: int, nama: string, ruang_id?: int, mulai: string, selesai: string, pengawas?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSesiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/cbt/sesi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sesi: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/cbt/sesi/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSesiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/cbt/sesi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sesi: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Sesi per ruang/waktu. Pengawas (username) melihat sesinya, membuka sesi (token dibuat otomatis, dibagikan ke peserta di ruang), mengganti token, menangani peserta, dan menutup sesi dengan berita acara. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengawas).
     *
     * `GET /v1/cbt/sesi/{id}/riwayat`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/sesi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sesi: Buka sesi
     *
     * Membuat token 6 karakter. Peserta bisa mulai 15 menit sebelum jadwal sampai jadwal selesai. Pemilik data atau pengelola. Status harus terjadwal, menjadi dibuka.
     *
     * `POST /v1/cbt/sesi/{id}/buka`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/sesi/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sesi: Ganti token
     *
     * Token lama tidak berlaku lagi; peserta yang sudah mulai tidak terpengaruh. Pemilik data atau pengelola. Status harus dibuka.
     *
     * `POST /v1/cbt/sesi/{id}/ganti-token`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdGantiToken(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/sesi/{id}/ganti-token', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sesi: Tutup sesi
     *
     * Mengakhiri peserta yang masih mengerjakan (jawaban dinilai), menandai yang belum mulai sebagai tidak hadir, dan menyimpan berita acara. Pemilik data atau pengelola. Status harus dibuka, menjadi ditutup.
     *
     * `POST /v1/cbt/sesi/{id}/tutup`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berita_acara?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdTutup(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/sesi/{id}/tutup', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: daftar
     *
     * Peserta per ujian (satu baris per username: NIM, nomor PMB, atau username lain). Isi massal dari KRS lewat /cbt/ujian/{id}/isi-peserta. Peserta melihat barisnya sendiri; nilai hanya terlihat bila ujian `tampil_hasil`. Pengawas sesi melihat dan menangani peserta di sesinya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/cbt/peserta`
     *
     * scope: `cbt:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ujian_id?: string, sesi_id?: string, status?: string, lulus?: string, perlu_koreksi?: string, username?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeserta(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/peserta', [], $query, null, $options, false, false);
    }

    /**
     * Peserta: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/cbt/peserta`
     *
     * scope: `cbt:write`
     *
     * @param array{ujian_id: int, sesi_id: int, username: string, nama?: string, nomor_peserta?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeserta(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/peserta', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: detail
     *
     * Peserta per ujian (satu baris per username: NIM, nomor PMB, atau username lain). Isi massal dari KRS lewat /cbt/ujian/{id}/isi-peserta. Peserta melihat barisnya sendiri; nilai hanya terlihat bila ujian `tampil_hasil`. Pengawas sesi melihat dan menangani peserta di sesinya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/cbt/peserta/{id}`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPesertaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/peserta/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/cbt/peserta/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{ujian_id: int, sesi_id: int, username: string, nama?: string, nomor_peserta?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPesertaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/cbt/peserta/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/cbt/peserta/{id}`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePesertaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/cbt/peserta/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Peserta per ujian (satu baris per username: NIM, nomor PMB, atau username lain). Isi massal dari KRS lewat /cbt/ujian/{id}/isi-peserta. Peserta melihat barisnya sendiri; nilai hanya terlihat bila ujian `tampil_hasil`. Pengawas sesi melihat dan menangani peserta di sesinya. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/cbt/peserta/{id}/riwayat`
     *
     * scope: `cbt:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPesertaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/cbt/peserta/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: Reset perangkat
     *
     * Melepas kunci perangkat agar peserta bisa melanjutkan dari perangkat lain (jawaban tetap tersimpan). Pengelola modul. Status harus terdaftar/mengerjakan.
     *
     * `POST /v1/cbt/peserta/{id}/reset-perangkat`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdResetPerangkat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/peserta/{id}/reset-perangkat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peserta: Tambah waktu
     *
     * Menambah waktu (menit) untuk peserta ini, mis. karena gangguan teknis. Batas waktu tetap tidak melewati akhir sesi kecuali `lewati_sesi` oleh pengelola. Pengelola modul. Status harus terdaftar/mengerjakan.
     *
     * `POST /v1/cbt/peserta/{id}/tambah-waktu`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{menit: int, alasan: string, lewati_sesi?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdTambahWaktu(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/peserta/{id}/tambah-waktu', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: Diskualifikasi
     *
     * Pengelola modul. Status harus terdaftar/mengerjakan, menjadi diskualifikasi.
     *
     * `POST /v1/cbt/peserta/{id}/diskualifikasi`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdDiskualifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/peserta/{id}/diskualifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peserta: Izinkan mengulang
     *
     * Pengelola mengizinkan peserta tidak hadir/diskualifikasi mengerjakan lagi (mis. ujian susulan di sesi lain). Jawaban lama dihapus. Pengelola modul. Status harus tidak_hadir/diskualifikasi, menjadi terdaftar.
     *
     * `POST /v1/cbt/peserta/{id}/buka-kembali`
     *
     * scope: `cbt:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{sesi_id?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdBukaKembali(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/cbt/peserta/{id}/buka-kembali', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
