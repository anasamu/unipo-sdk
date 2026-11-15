<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Tugas akhir: Pengajuan judul, Tugas akhir: Validasi, Tugas akhir: Progres dan pengaturan
 */
final class Ta extends Resource
{
    /**
     * Ringkasan tugas akhir saya
     *
     * Mahasiswa: pengaturan prodi, pengajuan aktif (lengkap dengan berkas, validasi, riwayat, hak), riwayat pengajuan, `boleh_buat`, dan progres sampai wisuda. Dosen/pengelola: `menunggu_saya` dan `prodi_kelola`.
     *
     * `GET /v1/ta/saya`
     *
     * scope: `ta:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pengajuan judul
     *
     * Mahasiswa: miliknya. Dosen/pengelola: `untuk=saya` (menunggu keputusan saya, bawaan), `pa` (mahasiswa PA saya), `kelola` (prodi yang saya kelola).
     *
     * `GET /v1/ta/pengajuan`
     *
     * scope: `ta:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, untuk?: string, status?: string, tahap?: string, prodi?: string, tahun_id?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Buat konsep pengajuan judul
     *
     * Mahasiswa. Body {judul, judul_inggris?, bidang?, jenis_penelitian?, latar_belakang?, rumusan?, metode?, usulan_pembimbing_1?, usulan_pembimbing_2? (NIDN)}. Satu pengajuan aktif per mahasiswa.
     *
     * `POST /v1/ta/pengajuan`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Detail pengajuan
     *
     * Untuk pemilik, dosen PA, calon/pembimbing, pengelola prodi. Termasuk berkas, langkah validasi, riwayat, pengaturan, dan `hak`.
     *
     * `GET /v1/ta/pengajuan/{id}`
     *
     * scope: `ta:read`
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah pengajuan
     *
     * Mahasiswa, saat status draf atau revisi. Body sama dengan buat.
     *
     * `POST /v1/ta/pengajuan/{id}`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lampirkan berkas
     *
     * Body {berkas_id (UUID dari /v1/berkas milik Anda), jenis (kode berkas di pengaturan, mis. surat_pengajuan, proposal, transkrip; selain itu lainnya)}.
     *
     * `POST /v1/ta/pengajuan/{id}/berkas`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengajuan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus lampiran
     *
     * `POST /v1/ta/pengajuan/{id}/berkas/{bid}/hapus`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param int|string $bid ID lampiran
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdBerkasByBidHapus(int|string $id, int|string $bid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengajuan/{id}/berkas/{bid}/hapus', ['id' => $id, 'bid' => $bid], $query, null, $options, false, false);
    }

    /**
     * Lihat/unduh lampiran
     *
     * Untuk yang boleh melihat pengajuan.
     *
     * `GET /v1/ta/pengajuan/{id}/berkas/{bid}`
     *
     * scope: `ta:read`
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param int|string $bid ID lampiran
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanByIdBerkasByBid(int|string $id, int|string $bid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/pengajuan/{id}/berkas/{bid}', ['id' => $id, 'bid' => $bid], $query, null, $options, false, false);
    }

    /**
     * Ajukan untuk divalidasi
     *
     * Memeriksa judul, berkas wajib, dan aturan dinamis titik `ta.ajukan`. Langkah validasi dibuat sesuai alur prodi (PA dilewati bila mahasiswa belum punya dosen PA).
     *
     * `POST /v1/ta/pengajuan/{id}/ajukan`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengajuan/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan pengajuan
     *
     * Mahasiswa. Body {alasan?}.
     *
     * `POST /v1/ta/pengajuan/{id}/batal`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengajuan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Putuskan langkah validasi
     *
     * Langkah `pa`: dosen PA mahasiswa (atau pengelola prodi). Langkah `prodi`: kaprodi/sekprodi/operator/BAK. Body {keputusan: setuju|revisi|tolak, catatan (wajib bila revisi/tolak), pembimbing_1, pembimbing_2?, judul? (judul final)}. Persetujuan terakhir menetapkan pembimbing (bawaan: usulan mahasiswa) dan menulis judul ke t_mahasiswa_ta (terima = Y).
     *
     * `POST /v1/ta/pengajuan/{id}/putuskan`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdPutuskan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengajuan/{id}/putuskan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cari dosen untuk pembimbing
     *
     * NIDN, nama bergelar, prodi, jabatan akademik dosen aktif. Untuk pilihan usulan/penetapan pembimbing (mahasiswa tidak punya scope dosen:read).
     *
     * `GET /v1/ta/dosen`
     *
     * scope: `ta:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, q?: string, nidn?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDosen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/dosen', [], $query, null, $options, false, false);
    }

    /**
     * Progres tugas akhir mahasiswa
     *
     * Judul, pembimbing, bimbingan, seminar proposal, ujian, yudisium, wisuda. Untuk mahasiswa itu, dosen PA-nya, dan pengelola prodi.
     *
     * `GET /v1/ta/mahasiswa/{nim}/progres`
     *
     * scope: `ta:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimProgres(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/mahasiswa/{nim}/progres', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Pengaturan pengajuan judul
     *
     * Alur validasi, berkas wajib, usulan pembimbing, buka/tutup, petunjuk.
     *
     * `GET /v1/ta/pengaturan`
     *
     * scope: `ta:read`
     *
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan pengaturan
     *
     * Body {prodi (kosong = kampus, hanya admin), alur: ["pa","prodi"] | ["prodi"], berkas: [{kode, nama, wajib, keterangan?}], usulan_pembimbing, aktif, petunjuk?}. Pengelola tugas akhir prodi.
     *
     * `POST /v1/ta/pengaturan`
     *
     * scope: `ta:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/pengaturan', [], $query, null, $options, false, false);
    }
}
