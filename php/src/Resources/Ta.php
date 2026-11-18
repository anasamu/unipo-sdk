<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Tugas akhir: Pengajuan judul, Tugas akhir: Validasi, Tugas akhir: Progres dan pengaturan, Ujian TA: Kelayakan & pengajuan, Ujian TA: Penjadwalan, Ujian TA: Penetapan SK Dekan, Ujian TA: Pelaksanaan & hasil
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

    /**
     * Jenis ujian dan pengaturan
     *
     * Jenis (proposal, seminar hasil, sidang skripsi) dengan titik aturan, jumlah penguji, durasi, rubrik, keputusan; pengaturan efektif (penjadwal, penetap, alur mahasiswa); label status.
     *
     * `GET /v1/ta/ujian/jenis`
     *
     * scope: `ta:read`
     *
     * @param array{prodi?: string, fakultas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan efektif
     *
     * Kampus <- fakultas <- prodi.
     *
     * `GET /v1/ta/ujian/pengaturan`
     *
     * scope: `ta:read`
     *
     * @param array{prodi?: string, fakultas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan pengaturan
     *
     * Body {lingkup: kampus|fakultas|prodi, kode, penjadwal?: prodi|fakultas|keduanya, penetap?: dekan|wd1, alur_mahasiswa?, jam_mulai?, jam_selesai?, jenis?: {proposal: {aktif, min_penguji, maks_penguji, durasi_menit, sekretaris, pembimbing_menilai, batas_revisi_hari, nilai_lulus, rubrik}}}.
     *
     * `POST /v1/ta/ujian/pengaturan`
     *
     * scope: `ta:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ujian TA saya
     *
     * Mahasiswa: kelayakan per jenis (syarat per unit), ujian aktif, boleh_ajukan. Dosen: ujian yang diuji/dibimbing, jumlah menunggu persetujuan dan perlu nilai. Semua: prodi_jadwal, prodi_lihat, fakultas_tetapkan.
     *
     * `GET /v1/ta/ujian/saya`
     *
     * scope: `ta:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar kelayakan ujian
     *
     * Mahasiswa aktif berjudul diterima di prodi pengguna yang belum lulus jenis ujian ini, dengan hasil aturan titik pendaftaran dikelompokkan per unit (layak, alasan, tindakan).
     *
     * `GET /v1/ta/ujian/kelayakan`
     *
     * scope: `ta:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, prodi?: string, angkatan?: string, pembimbing?: string, status?: string, q?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianKelayakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/kelayakan', [], $query, null, $options, false, false);
    }

    /**
     * Kelayakan satu mahasiswa
     *
     * Mahasiswa itu, pembimbingnya, pengelola prodi.
     *
     * `GET /v1/ta/ujian/kelayakan/{nim}`
     *
     * scope: `ta:read`
     *
     * @param int|string $nim NIM
     * @param array{jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianKelayakanByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/kelayakan/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa mengajukan siap ujian
     *
     * Body {jenis, catatan?}. Syarat aturan harus terpenuhi (422 belum_memenuhi_syarat dengan kelayakan). Pembimbing diberi notifikasi.
     *
     * `POST /v1/ta/ujian/ajukan`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianAjukan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/ajukan', [], $query, null, $options, false, false);
    }

    /**
     * Persetujuan pembimbing (layak uji)
     *
     * Body {keputusan: setuju|kembalikan, catatan (wajib bila kembalikan)}.
     *
     * `POST /v1/ta/ujian/{id}/pembimbing`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdPembimbing(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/pembimbing', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar ujian
     *
     * Pengelola: prodi yang boleh dilihat. Dosen (untuk=saya): ujian yang diuji/dibimbing. Mahasiswa: miliknya.
     *
     * `GET /v1/ta/ujian`
     *
     * scope: `ta:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, untuk?: string, jenis?: string, status?: string, prodi?: string, dari?: string, sampai?: string, ruang?: string, dosen?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian', [], $query, null, $options, false, false);
    }

    /**
     * Operator membuat ujian
     *
     * Body {nim, jenis}. Untuk mahasiswa yang memenuhi syarat (tanpa permohonan mahasiswa). Status layak uji.
     *
     * `POST /v1/ta/ujian`
     *
     * scope: `ta:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian', [], $query, null, $options, false, false);
    }

    /**
     * Agenda ujian
     *
     * Ujian berjadwal dalam rentang tanggal (kalender/agenda/papan per ruang).
     *
     * `GET /v1/ta/ujian/agenda`
     *
     * scope: `ta:read`
     *
     * @param array{dari?: string, sampai?: string, untuk?: string, prodi?: string, ruang?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianAgenda(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/agenda', [], $query, null, $options, false, false);
    }

    /**
     * Ruang ujian
     *
     * Sarpras (bila sudah disinkronkan) atau ruang kuliah lama.
     *
     * `GET /v1/ta/ujian/ruang`
     *
     * scope: `ta:read`
     *
     * @param array{q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianRuang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/ruang', [], $query, null, $options, false, false);
    }

    /**
     * Detail ujian
     *
     * Tim, SK, nilai, keputusan, riwayat, syarat saat diajukan, hak.
     *
     * `GET /v1/ta/ujian/{id}`
     *
     * scope: `ta:read`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Susun jadwal dan tim
     *
     * Body {tanggal, mulai, selesai, ruang? (kode), daring?, tautan?, ketua, sekretaris?, penguji: [nidn], catatan?, abaikan_kuliah?}. Pembimbing ikut otomatis. 422 syarat_dosen (aturan titik penguji), 409 bentrok (ruang/dosen/mahasiswa di ujian lain selalu; kuliah/UTS/peminjaman kecuali abaikan_kuliah). Status draf.
     *
     * `POST /v1/ta/ujian/{id}/jadwal`
     *
     * scope: `ta:write`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdJadwal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/jadwal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periksa jadwal tanpa menyimpan
     *
     * Body sama dengan jadwal. Hasil {bentrok, syarat_dosen, boleh}.
     *
     * `POST /v1/ta/ujian/{id}/periksa-jadwal`
     *
     * scope: `ta:read`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdPeriksaJadwal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/periksa-jadwal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Saran slot
     *
     * Body {dosen?: [nidn tim], dari?, hari? (1-30), durasi? (menit), ruang?}. Slot hari kerja yang kosong untuk dosen, mahasiswa, dan satu ruang.
     *
     * `POST /v1/ta/ujian/{id}/saran`
     *
     * scope: `ta:read`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdSaran(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/saran', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan ke Dekan
     *
     * Body {ids: [UUID draf], catatan?}. Dekan/WD I fakultas diberi notifikasi.
     *
     * `POST /v1/ta/ujian/ajukan-penetapan`
     *
     * scope: `ta:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianAjukanPenetapan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/ajukan-penetapan', [], $query, null, $options, false, false);
    }

    /**
     * Tetapkan dengan SK Dekan
     *
     * Body {ids: [UUID diajukan, satu fakultas], sk_id (UUID registri SK, terbit, penerbit fakultas itu), catatan?}. Hanya Dekan (atau WD I bila didelegasikan). SK dicatat dipakai (sk_pakai) per ujian; mahasiswa dan tim diberi notifikasi; jadwal ditulis ke Daftar TA lama.
     *
     * `POST /v1/ta/ujian/tetapkan`
     *
     * scope: `ta:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianTetapkan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/tetapkan', [], $query, null, $options, false, false);
    }

    /**
     * Kembalikan usulan
     *
     * Dekan. Body {ids, catatan}. Status kembali draf.
     *
     * `POST /v1/ta/ujian/kembalikan`
     *
     * scope: `ta:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianKembalikan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/kembalikan', [], $query, null, $options, false, false);
    }

    /**
     * Catat kehadiran
     *
     * Body {mahasiswa_hadir, hadir: {nidn: bool}}. Status terlaksana.
     *
     * `POST /v1/ta/ujian/{id}/hadir`
     *
     * scope: `ta:write`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdHadir(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/hadir', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi nilai
     *
     * Anggota tim penilai. Body {nilai (0-100)} atau {rubrik: {kode: 0-100}}, catatan?.
     *
     * `POST /v1/ta/ujian/{id}/nilai`
     *
     * scope: `ta:write` · hanya token pengguna
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdNilai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/nilai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keputusan
     *
     * Ketua sidang atau penyusun jadwal. Body {keputusan: lanjut|revisi|ulang, catatan_revisi (wajib bila revisi), batas_revisi?}. Nilai akhir = rata-rata penilai yang hadir.
     *
     * `POST /v1/ta/ujian/{id}/putuskan`
     *
     * scope: `ta:write`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdPutuskan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/putuskan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Revisi selesai
     *
     * Pembimbing, ketua sidang, atau penyusun jadwal.
     *
     * `POST /v1/ta/ujian/{id}/revisi-selesai`
     *
     * scope: `ta:write`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdRevisiSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/revisi-selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tunda
     *
     * Body {alasan}. Bila sudah ditetapkan, tautan SK dilepas (jadwalkan dan tetapkan ulang).
     *
     * `POST /v1/ta/ujian/{id}/tunda`
     *
     * scope: `ta:write`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdTunda(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/tunda', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan
     *
     * Body {alasan}.
     *
     * `POST /v1/ta/ujian/{id}/batal`
     *
     * scope: `ta:write`
     *
     * @param int|string $id UUID ujian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUjianByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/ta/ujian/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * PDF undangan / berita acara
     *
     * Diterbitkan modul Dokumen (kop prodi, kode verifikasi + QR).
     *
     * `GET /v1/ta/ujian/{id}/dokumen/{jenis}`
     *
     * scope: `ta:read`
     *
     * @param int|string $id UUID ujian
     * @param int|string $jenis undangan | berita-acara
     * @param array{pratinjau?: string, unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUjianByIdDokumenByJenis(int|string $id, int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/ta/ujian/{id}/dokumen/{jenis}', ['id' => $id, 'jenis' => $jenis], $query, null, $options, false, false);
    }
}
