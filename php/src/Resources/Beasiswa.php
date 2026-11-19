<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kemahasiswaan: Beasiswa
 */
final class Beasiswa extends Resource
{
    /**
     * Peran pengguna di beasiswa
     *
     * mode: baak (operator tingkat universitas, izin beasiswa.kelola), unit (operator berlingkup fakultas/prodi: prodi = daftar prodi, hanya pendaftar prodinya, rekomendasi), admin, ambil_alih (Pustikom saat belum ada pemegang aktif beasiswa.kelola), baca (Pustikom saat operator ada, atau petugas lain), tidak. Juga operator yang ada, pesan spanduk, katalog indikator syarat dan kriteria skor.
     *
     * `GET /v1/beasiswa/peran`
     *
     * scope: `kemahasiswaan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/peran', [], $query, null, $options, false, false);
    }

    /**
     * Daftar program beasiswa
     *
     * Program beserta konfigurasi (sumber dana, bentuk, kuota per prodi, syarat dinamis, berkas, isian, bobot, evaluasi) dan rekap pendaftar per status.
     *
     * `GET /v1/beasiswa/program`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param array{status?: string, tahun_id?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgram(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/program', [], $query, null, $options, false, false);
    }

    /**
     * Buat program beasiswa
     *
     * Body {kode, nama, jenis, penyelenggara?, sumber_dana: internal|pemerintah|swasta, bentuk: potongan_ukt|tunai, tahun_id, nominal?, periode_pencairan?, kuota?, kuota_prodi?: [{kode_prodi, kuota}], daftar_mulai?, daftar_selesai?, pengumuman_tanggal?, keterangan?, syarat: [{indikator, op, nilai}], berkas: [{kode?, nama, wajib, keterangan?}], isian: [{kode?, label, tipe: teks|panjang|angka|pilihan, wajib, opsi?}], bobot: {ipk, penghasilan_ortu, poin_kegiatan, wawancara, berkas}, wawancara: bool, tahap_fakultas: bool (rekomendasi operator fakultas/prodi sebelum verifikasi BAAK), buka_at?/tutup_at? (jam buka/tutup; kosong = sepanjang hari daftar_mulai/daftar_selesai), evaluasi: {ipk_minimal?, tindakan: peringatan|cabut, wajib_aktif}}. Status awal draf. Operator BAAK atau Pustikom ambil alih.
     *
     * `POST /v1/beasiswa/program`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgram(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/program', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rincian program
     *
     * Program, prodi sasaran, rekap, draf/terbit pengumuman Humas, dan 30 riwayat aksi terakhir (pelaku, unit, diambil alih).
     *
     * `GET /v1/beasiswa/program/{id}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgramById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/program/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah program
     *
     * Body seperti buat; isian yang tidak dikirim tidak berubah. Setelah seleksi dimulai hanya pengumuman_tanggal dan evaluasi yang bisa diubah.
     *
     * `POST /v1/beasiswa/program/{id}`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/program/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah status program
     *
     * Body {aksi: buka|seleksi|selesai|draf}. buka = draf pengumuman pembukaan untuk Humas; seleksi = tutup pendaftaran, cek syarat dan skor otomatis.
     *
     * `POST /v1/beasiswa/program/{id}/status`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/program/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus program draf
     *
     * Hanya program draf tanpa pendaftar.
     *
     * `POST /v1/beasiswa/program/{id}/hapus`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/program/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar program
     *
     * Dengan nama, prodi, IPK, skor dan rinciannya, peringkat, hasil cek syarat, isian, berkas beserta status verifikasinya, wawancara, nomor penerima, dan alur pemeriksa.
     *
     * `GET /v1/beasiswa/program/{id}/pendaftar`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgramByIdPendaftar(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/program/{id}/pendaftar', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cek syarat otomatis dan hitung skor
     *
     * Body {tolak_tidak_memenuhi?: bool}. Syarat dinamis dievaluasi ulang dari data SIAKAD, skor berbobot dan peringkat dihitung ulang.
     *
     * `POST /v1/beasiswa/program/{id}/seleksi-otomatis`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdSeleksiOtomatis(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/program/{id}/seleksi-otomatis', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tetapkan penerima
     *
     * Body {nomor_sk, tanggal_sk, pendaftar_id: [..], tolak_lainnya?: bool}. Pendaftar terpilih harus diverifikasi; kuota total dan per prodi dicek; nomor penerima dibuat; program berjalan; draf pengumuman penerima untuk Humas; bentuk potongan UKT langsung menjadi potongan tagihan.
     *
     * `POST /v1/beasiswa/program/{id}/tetapkan`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdTetapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/program/{id}/tetapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat evaluasi
     *
     * Evaluasi per periode setiap penerima.
     *
     * `GET /v1/beasiswa/program/{id}/evaluasi`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgramByIdEvaluasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/program/{id}/evaluasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Evaluasi lanjutan penerima
     *
     * Body {tahun_id, pratinjau?: bool (bawaan true)}. IPK di bawah batas atau status tidak aktif = peringatan/cabut (peringatan kedua = cabut). pratinjau false menyimpan (butuh hak kelola dan scope tulis).
     *
     * `POST /v1/beasiswa/program/{id}/evaluasi`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProgramByIdEvaluasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/program/{id}/evaluasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat aksi program
     *
     * Semua aksi dengan pelaku, unit (BAAK, PUSTIKOM, HUMAS, BAUK, MAHASISWA), dan tanda diambil alih Pustikom.
     *
     * `GET /v1/beasiswa/program/{id}/riwayat`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProgramByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/program/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Verifikasi berkas pendaftar
     *
     * Body {berkas: {kode: {status: sah|tidak_sah, catatan?}}, hasil: lengkap|kurang, catatan?}. lengkap = semua berkas wajib sah, status diverifikasi; kurang = mahasiswa diminta melengkapi.
     *
     * `POST /v1/beasiswa/pendaftar/{id}/verifikasi`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID pendaftar
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/pendaftar/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lihat berkas pendaftar
     *
     * Berkas yang diunggah pendaftar (untuk verifikasi).
     *
     * `GET /v1/beasiswa/pendaftar/{id}/berkas/{uuid}`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param int|string $id ID pendaftar
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendaftarByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/pendaftar/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Jadwal/nilai wawancara
     *
     * Body {jadwal?, tempat?, nilai? (0-100), catatan?}. Hanya program berwawancara.
     *
     * `POST /v1/beasiswa/pendaftar/{id}/wawancara`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID pendaftar
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdWawancara(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/pendaftar/{id}/wawancara', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekomendasi fakultas/prodi
     *
     * Tahap alur bila program memakai tahap_fakultas. Body {hasil: direkomendasikan|tidak_direkomendasikan, catatan? (wajib bila tidak), berkas?: {kode: {status, catatan?}}}. Operator beasiswa berlingkup fakultas/prodi untuk prodinya, atau operator universitas.
     *
     * `POST /v1/beasiswa/pendaftar/{id}/rekomendasi`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID pendaftar
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdRekomendasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/pendaftar/{id}/rekomendasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tolak pendaftar
     *
     * Body {alasan}.
     *
     * `POST /v1/beasiswa/pendaftar/{id}/tolak`
     *
     * scope: `kemahasiswaan:write`
     *
     * @param int|string $id ID pendaftar
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendaftarByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/beasiswa/pendaftar/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Laporan beasiswa
     *
     * Per program: rekap pendaftar, penerima, dicabut, total dicairkan; penerima per sumber dana.
     *
     * `GET /v1/beasiswa/laporan`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/laporan', [], $query, null, $options, false, false);
    }

    /**
     * Ekspor CSV beasiswa
     *
     * Pendaftar dan penerima (program, NIM, nama, prodi, IPK, skor, peringkat, status, nomor penerima, nominal, sudah dicairkan).
     *
     * `GET /v1/beasiswa/laporan/ekspor`
     *
     * scope: `kemahasiswaan:read`
     *
     * @param array{tahun_id?: string, program_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanEkspor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/beasiswa/laporan/ekspor', [], $query, null, $options, false, false);
    }
}
