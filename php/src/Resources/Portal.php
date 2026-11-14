<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Portal, Portal: kelola
 */
final class Portal extends Resource
{
    /**
     * Daftar situs portal
     *
     * Universitas, fakultas, prodi, dan unit yang aktif.
     *
     * `GET /v1/portal/situs`
     *
     * scope: `portal:read`
     *
     * @param array{jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSitus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/situs', [], $query, null, $options, false, false);
    }

    /**
     * Profil situs
     *
     * Profil situs, pengaturan publik (sambutan, visi, misi, ...), situs turunan, dan data resmi dari SIAKAD: perguruan tinggi dan pimpinan (universitas), dekan dan daftar prodi (fakultas), akreditasi prodi (prodi).
     *
     * `GET /v1/portal/situs/{kode}`
     *
     * scope: `portal:read`
     *
     * @param int|string $kode Kode situs
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSitusByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/situs/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Data beranda dalam satu panggilan
     *
     * Profil situs, banner aktif, berita unggulan, berita terbaru, pengumuman aktif, agenda mendatang, dan tautan cepat. `turunan=1` menyertakan konten situs turunan (mis. berita semua fakultas di beranda universitas).
     *
     * `GET /v1/portal/situs/{kode}/beranda`
     *
     * scope: `portal:read`
     *
     * @param int|string $kode Kode situs
     * @param array{turunan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSitusByKodeBeranda(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/situs/{kode}/beranda', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Menu navigasi (pohon)
     *
     * Dikelompokkan per lokasi (utama, atas, footer, sidebar); item bertingkat di `anak`.
     *
     * `GET /v1/portal/situs/{kode}/menu`
     *
     * scope: `portal:read`
     *
     * @param int|string $kode Kode situs
     * @param array{lokasi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSitusByKodeMenu(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/situs/{kode}/menu', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Statistik dari SIAKAD
     *
     * Jumlah prodi, mahasiswa aktif, dosen aktif, dan lulusan untuk cakupan situs (universitas: semua; fakultas: prodi fakultas itu; prodi: prodi itu), dihitung langsung dari SIAKAD.
     *
     * `GET /v1/portal/situs/{kode}/statistik`
     *
     * scope: `portal:read`
     *
     * @param int|string $kode Kode situs
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSitusByKodeStatistik(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/situs/{kode}/statistik', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Direktori dosen publik
     *
     * Dosen aktif di cakupan situs, dari m_dosen: NIDN, nama dan gelar, prodi, jabatan akademik. Tanpa data pribadi.
     *
     * `GET /v1/portal/situs/{kode}/dosen`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param int|string $kode Kode situs
     * @param array{prodi?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSitusByKodeDosen(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/situs/{kode}/dosen', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Kalender akademik dari SIAKAD
     *
     * Jadwal pembayaran, KRS, kuliah, UTS, UAS, input nilai per periode (m_tahun).
     *
     * `GET /v1/portal/kalender-akademik`
     *
     * scope: `portal:read`
     *
     * @param array{tahun_id?: string, jumlah?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKalenderAkademik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kalender-akademik', [], $query, null, $options, false, false);
    }

    /**
     * Pencarian gabungan
     *
     * Berita, pengumuman, agenda, galeri, halaman, dan dokumen yang terbit.
     *
     * `GET /v1/portal/cari`
     *
     * scope: `portal:read`
     *
     * @param array{q: string, situs?: string, per_page?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCari(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/cari', [], $query, null, $options, false, false);
    }

    /**
     * Pengumuman untuk pengguna yang login
     *
     * Pengumuman terbit yang sasarannya cocok dengan pengguna token: kelompok (mahasiswa/dosen/tendik/calon_mahasiswa), prodi, dan angkatan dari SIAKAD. Untuk ditampilkan di SIAKAD, LMS, atau aplikasi mobile.
     *
     * `GET /v1/portal/pengumuman/saya`
     *
     * scope: `portal:read` · hanya token pengguna · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumumanSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/pengumuman/saya', [], $query, null, $options, false, false);
    }

    /**
     * Berita: daftar
     *
     * Berita, artikel, opini, prestasi, liputan, siaran pers. Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/berita`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, kategori?: string, turunan?: string, q?: string, jenis?: string, unggulan?: string, tag?: string, nim?: string, nidn?: string, urut?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerita(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/berita', [], $query, null, $options, false, false);
    }

    /**
     * Berita: detail
     *
     * Pakai ID, atau slug + `situs`. Termasuk tag dan mahasiswa/dosen yang diberitakan (nama dan prodi dari SIAKAD).
     *
     * `GET /v1/portal/berita/{id}`
     *
     * scope: `portal:read`
     *
     * @param int|string $id ID atau slug
     * @param array{situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeritaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/berita/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Berita: catat tayang
     *
     * Menambah hitungan dan statistik harian. Panggil dari frontend sekali per kunjungan.
     *
     * `POST /v1/portal/berita/{id}/dilihat`
     *
     * scope: `portal:interaksi`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeritaByIdDilihat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/berita/{id}/dilihat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: daftar
     *
     * Pengumuman yang masih berlaku (`kedaluwarsa=1` untuk menyertakan yang sudah lewat). Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/pengumuman`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, kategori?: string, turunan?: string, q?: string, prioritas?: string, kedaluwarsa?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumuman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/pengumuman', [], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: detail
     *
     * Pakai ID, atau slug + `situs`.
     *
     * `GET /v1/portal/pengumuman/{id}`
     *
     * scope: `portal:read`
     *
     * @param int|string $id ID atau slug
     * @param array{situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: catat tayang
     *
     * Menambah hitungan dan statistik harian. Panggil dari frontend sekali per kunjungan.
     *
     * `POST /v1/portal/pengumuman/{id}/dilihat`
     *
     * scope: `portal:interaksi`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengumumanByIdDilihat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/pengumuman/{id}/dilihat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Agenda: daftar
     *
     * Agenda/event. `waktu=mendatang` untuk yang belum selesai, `lalu` untuk arsip. Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/agenda`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, kategori?: string, turunan?: string, q?: string, waktu?: string, dari?: string, sampai?: string, mode?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAgenda(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/agenda', [], $query, null, $options, false, false);
    }

    /**
     * Agenda: detail
     *
     * Pakai ID, atau slug + `situs`. Termasuk jumlah peserta, sisa kuota, dan status pendaftaran; tautan daring hanya dikirim ke peserta saat mendaftar.
     *
     * `GET /v1/portal/agenda/{id}`
     *
     * scope: `portal:read`
     *
     * @param int|string $id ID atau slug
     * @param array{situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAgendaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/agenda/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Agenda: catat tayang
     *
     * Menambah hitungan dan statistik harian. Panggil dari frontend sekali per kunjungan.
     *
     * `POST /v1/portal/agenda/{id}/dilihat`
     *
     * scope: `portal:interaksi`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAgendaByIdDilihat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/agenda/{id}/dilihat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Galeri: daftar
     *
     * Album foto/video. Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/galeri`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, kategori?: string, turunan?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGaleri(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/galeri', [], $query, null, $options, false, false);
    }

    /**
     * Galeri: detail
     *
     * Pakai ID, atau slug + `situs`. Termasuk daftar foto/video (`item`).
     *
     * `GET /v1/portal/galeri/{id}`
     *
     * scope: `portal:read`
     *
     * @param int|string $id ID atau slug
     * @param array{situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGaleriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/galeri/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Galeri: catat tayang
     *
     * Menambah hitungan dan statistik harian. Panggil dari frontend sekali per kunjungan.
     *
     * `POST /v1/portal/galeri/{id}/dilihat`
     *
     * scope: `portal:interaksi`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGaleriByIdDilihat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/galeri/{id}/dilihat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Halaman: daftar
     *
     * Halaman statis (profil, sejarah, visi-misi, ...). Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/halaman`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, turunan?: string, q?: string, induk_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHalaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/halaman', [], $query, null, $options, false, false);
    }

    /**
     * Halaman: detail
     *
     * Pakai ID, atau slug + `situs`.
     *
     * `GET /v1/portal/halaman/{id}`
     *
     * scope: `portal:read`
     *
     * @param int|string $id ID atau slug
     * @param array{situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/halaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen: daftar
     *
     * Unduhan dan informasi publik (PPID). Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/dokumen`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, kategori?: string, turunan?: string, q?: string, klasifikasi_ppid?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen: detail
     *
     * Pakai ID, atau slug + `situs`.
     *
     * `GET /v1/portal/dokumen/{id}`
     *
     * scope: `portal:read`
     *
     * @param int|string $id ID atau slug
     * @param array{situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen: catat unduhan
     *
     * Menambah hitungan dan statistik harian. Panggil dari frontend sekali per kunjungan.
     *
     * `POST /v1/portal/dokumen/{id}/unduh`
     *
     * scope: `portal:interaksi`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdUnduh(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/dokumen/{id}/unduh', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Banner: daftar
     *
     * Banner/slider yang sedang tayang. Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/banner`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, turunan?: string, q?: string, posisi?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBanner(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/banner', [], $query, null, $options, false, false);
    }

    /**
     * Tautan: daftar
     *
     * Tautan cepat (SIAKAD, LMS, PMB, e-journal, ...). Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/tautan`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, turunan?: string, q?: string, grup?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTautan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/tautan', [], $query, null, $options, false, false);
    }

    /**
     * Struktur: daftar
     *
     * Pimpinan dan struktur organisasi (nama dosen dari SIAKAD bila NIDN diisi). Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/struktur`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, turunan?: string, q?: string, grup?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStruktur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/struktur', [], $query, null, $options, false, false);
    }

    /**
     * Struktur: detail
     *
     * Pakai ID, atau slug + `situs`.
     *
     * `GET /v1/portal/struktur/{id}`
     *
     * scope: `portal:read`
     *
     * @param int|string $id ID atau slug
     * @param array{situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStrukturById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/struktur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * FAQ: daftar
     *
     * Tanya jawab. Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/faq`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, kategori?: string, turunan?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFaq(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/faq', [], $query, null, $options, false, false);
    }

    /**
     * Kategori: daftar
     *
     * Kategori konten per jenis (termasuk kategori bersama). Tanpa `situs` = semua situs aktif. Dengan `situs`, konten sindikasi yang disetujui ikut tampil.
     *
     * `GET /v1/portal/kategori`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param array{situs?: string, turunan?: string, q?: string, jenis?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKategori(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kategori', [], $query, null, $options, false, false);
    }

    /**
     * Kirim pesan kontak/saran/pengaduan
     *
     * Maksimal 5 pesan per IP per jam per situs. Frontend yang memanggil dari server boleh mengirim `ip_pengunjung`. Pasang captcha di frontend.
     *
     * `POST /v1/portal/pesan`
     *
     * scope: `portal:interaksi`
     *
     * @param array{situs: string, jenis?: string, nama: string, email: string, telepon?: string, subjek: string, pesan: string, ip_pengunjung?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/pesan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar ke agenda
     *
     * Untuk agenda dengan pendaftaran aktif, sebelum tutup dan selama kuota ada. Token pengguna mengisi nama/email dari akun SIAKAD bila tidak dikirim. Jawaban berisi kode tiket (dan tautan daring untuk agenda daring/hibrida).
     *
     * `POST /v1/portal/agenda/{id}/daftar`
     *
     * scope: `portal:interaksi`
     *
     * @param int|string $id ID agenda
     * @param array{nama?: string, email?: string, telepon?: string, instansi?: string, ip_pengunjung?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAgendaByIdDaftar(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/agenda/{id}/daftar', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Situs yang saya kelola
     *
     * Daftar situs dan peran (admin/editor/penulis) untuk token ini.
     *
     * `GET /v1/portal/kelola/saya`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/saya', [], $query, null, $options, false, false);
    }

    /**
     * Buat situs
     *
     * Hanya admin portal. Situs fakultas wajib `kode_fakultas`, situs prodi wajib `kode_prodi` (harus ada di SIAKAD).
     *
     * `POST /v1/portal/kelola/situs`
     *
     * scope: `portal:write`, `portal:admin`
     *
     * @param array{kode?: string, jenis?: string, induk?: int, kode_fakultas?: string, kode_prodi?: string, nama?: string, nama_en?: string, singkatan?: string, tagline?: string, domain?: string, logo_media_id?: int, warna_utama?: string, email?: string, telepon?: string, alamat?: string, media_sosial?: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaSitus(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/situs', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail situs (termasuk pengaturan non-publik)
     *
     * `GET /v1/portal/kelola/situs/{kode}`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaSitusByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/situs/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah profil situs
     *
     * Admin situs: nama, tagline, logo, kontak, media sosial, ... Kolom kode, jenis, induk, kode_fakultas, kode_prodi, domain, aktif hanya admin portal.
     *
     * `PATCH /v1/portal/kelola/situs/{kode}`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param array{kode?: string, jenis?: string, induk?: int, kode_fakultas?: string, kode_prodi?: string, nama?: string, nama_en?: string, singkatan?: string, tagline?: string, domain?: string, logo_media_id?: int, warna_utama?: string, email?: string, telepon?: string, alamat?: string, media_sosial?: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaSitusByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/situs/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Simpan pengaturan situs
     *
     * Objek kunci → nilai, mis. `{"sambutan": "<p>...</p>", "visi": "...", "jam_layanan": {...}, "kode_analitik": {"nilai": "G-XXX", "publik": false}}`. Nilai null menghapus kunci. Teks HTML disaring.
     *
     * `PUT /v1/portal/kelola/situs/{kode}/pengaturan`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKelolaSitusByKodePengaturan(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/portal/kelola/situs/{kode}/pengaturan', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar pengelola situs
     *
     * `GET /v1/portal/kelola/situs/{kode}/pengelola`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaSitusByKodePengelola(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/situs/{kode}/pengelola', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah pengelola
     *
     * Body `{"username": "<user SIAKAD>", "peran": "admin|editor|penulis", "aktif": true}`.
     *
     * `POST /v1/portal/kelola/situs/{kode}/pengelola`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param array{username: string, peran?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaSitusByKodePengelola(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/situs/{kode}/pengelola', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus pengelola
     *
     * `DELETE /v1/portal/kelola/situs/{kode}/pengelola/{username}`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param int|string $username Username SIAKAD
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaSitusByKodePengelolaByUsername(int|string $kode, int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/situs/{kode}/pengelola/{username}', ['kode' => $kode, 'username' => $username], $query, null, $options, false, false);
    }

    /**
     * Pustaka media
     *
     * `GET /v1/portal/kelola/media`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs: string, jenis?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaMedia(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/media', [], $query, null, $options, false, false);
    }

    /**
     * Unggah media
     *
     * multipart/form-data: `situs`, `berkas`, opsional `judul`, `alt`, `alt_en`, `kredit`. Jenis dicek dari isi file. Gambar JPG/PNG/WebP/GIF ≤ 8 MB (EXIF dibuang), dokumen PDF/Office ≤ 25 MB, MP4 ≤ 100 MB, MP3 ≤ 30 MB (juga dibatasi upload_max_filesize server).
     *
     * `POST /v1/portal/kelola/media`
     *
     * scope: `portal:write`
     *
     * @param array{situs: string, berkas: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, judul?: string, alt?: string, alt_en?: string, kredit?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaMedia(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/media', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Tambah video YouTube/Vimeo
     *
     * Body `{"situs": "univ", "url": "https://www.youtube.com/watch?v=...", "judul": "..."}`.
     *
     * `POST /v1/portal/kelola/media/tautan`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaMediaTautan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/media/tautan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah keterangan media
     *
     * judul, alt, alt_en, kredit.
     *
     * `PATCH /v1/portal/kelola/media/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID media
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaMediaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/media/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus media
     *
     * Hapus lunak: hilang dari pustaka; file tetap ada agar tautan lama tidak rusak.
     *
     * `DELETE /v1/portal/kelola/media/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID media
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaMediaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/media/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pesan masuk
     *
     * Editor/admin situs.
     *
     * `GET /v1/portal/kelola/pesan`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs: string, status?: string, jenis?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaPesan(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/pesan', [], $query, null, $options, false, false);
    }

    /**
     * Tindak lanjut pesan
     *
     * Body `{"status": "diproses", "catatan": "..."}`.
     *
     * `PATCH /v1/portal/kelola/pesan/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID pesan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaPesanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/pesan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sindikasi masuk
     *
     * Konten situs lain yang diajukan untuk tampil di situs ini.
     *
     * `GET /v1/portal/kelola/sindikasi`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaSindikasi(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/sindikasi', [], $query, null, $options, false, false);
    }

    /**
     * Setujui/tolak sindikasi
     *
     * Body `{"status": "disetujui"|"ditolak"}`. Editor situs tujuan.
     *
     * `PATCH /v1/portal/kelola/sindikasi/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID sindikasi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaSindikasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/sindikasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah foto/video ke galeri
     *
     * Body `{"media_id": 12}` atau `{"media_id": [12, 13, 14]}`, opsional `keterangan`.
     *
     * `POST /v1/portal/kelola/galeri/{id}/item`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID galeri
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaGaleriByIdItem(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/galeri/{id}/item', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah keterangan/urutan item galeri
     *
     * `PATCH /v1/portal/kelola/galeri/{id}/item/{item}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID galeri
     * @param int|string $item ID item
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaGaleriByIdItemByItem(int|string $id, int|string $item, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/galeri/{id}/item/{item}', ['id' => $id, 'item' => $item], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus item galeri
     *
     * `DELETE /v1/portal/kelola/galeri/{id}/item/{item}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID galeri
     * @param int|string $item ID item
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaGaleriByIdItemByItem(int|string $id, int|string $item, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/galeri/{id}/item/{item}', ['id' => $id, 'item' => $item], $query, null, $options, false, false);
    }

    /**
     * Peserta agenda
     *
     * Editor/admin situs.
     *
     * `GET /v1/portal/kelola/agenda/{id}/peserta`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param int|string $id ID agenda
     * @param array{status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaAgendaByIdPeserta(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/agenda/{id}/peserta', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah status peserta / check-in
     *
     * Pakai ID peserta atau kode tiket. `{"status": "hadir"}` mencatat waktu hadir.
     *
     * `PATCH /v1/portal/kelola/agenda/{id}/peserta/{peserta}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID agenda
     * @param int|string $peserta ID atau kode tiket
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaAgendaByIdPesertaByPeserta(int|string $id, int|string $peserta, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/agenda/{id}/peserta/{peserta}', ['id' => $id, 'peserta' => $peserta], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berita: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/berita`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaBerita(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/berita', [], $query, null, $options, false, false);
    }

    /**
     * Berita: buat
     *
     * Wajib `situs`. Peran: penulis ke atas (penulis hanya miliknya yang masih draf/review). `status` awal draf (bawaan) atau review; editor boleh langsung terbit. Tambahan: `tag` (daftar teks) dan `orang` (daftar {jenis: mahasiswa|dosen, nim|nidn, peran}). HTML disaring di server.
     *
     * `POST /v1/portal/kelola/berita`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, jenis?: string, ringkasan?: string, ringkasan_en?: string, isi?: string, isi_en?: string, gambar_media_id?: int, penulis_tampil?: string, sumber?: string, unggulan?: bool, sematkan?: bool, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, tag?: list<mixed>, orang?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaBerita(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/berita', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berita: detail
     *
     * `GET /v1/portal/kelola/berita/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaBeritaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/berita/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Berita: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/berita/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, jenis?: string, ringkasan?: string, ringkasan_en?: string, isi?: string, isi_en?: string, gambar_media_id?: int, penulis_tampil?: string, sumber?: string, unggulan?: bool, sematkan?: bool, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, tag?: list<mixed>, orang?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaBeritaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/berita/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berita: hapus
     *
     * Hapus lunak (deleted_at); isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/berita/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaBeritaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/berita/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Berita: riwayat perubahan
     *
     * `GET /v1/portal/kelola/berita/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaBeritaByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/berita/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Berita: ubah status
     *
     * Body `{"status": "draf|review|terbit|arsip", "terbit_pada": "2026-12-01 08:00:00"}`. Penulis hanya draf/review; editor menerbitkan. `terbit_pada` di masa depan = terjadwal.
     *
     * `POST /v1/portal/kelola/berita/{id}/status`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{status: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaBeritaByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/berita/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berita: ajukan ke situs lain
     *
     * Body `{"situs": "univ"}`. Editor situs asal. Bila Anda juga editor di situs tujuan, langsung disetujui; selain itu menunggu persetujuan pengelola situs tujuan.
     *
     * `POST /v1/portal/kelola/berita/{id}/sindikasi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaBeritaByIdSindikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/berita/{id}/sindikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/pengumuman`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaPengumuman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/pengumuman', [], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: buat
     *
     * Wajib `situs`. Peran: penulis ke atas (penulis hanya miliknya yang masih draf/review). `status` awal draf (bawaan) atau review; editor boleh langsung terbit. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/pengumuman`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, nomor?: string, kategori_id?: int, isi?: string, isi_en?: string, lampiran_media_id?: int, prioritas?: string, sasaran?: list<mixed>, sasaran_prodi?: string, sasaran_angkatan?: string, berlaku_sampai?: string, sematkan?: bool, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaPengumuman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/pengumuman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman: detail
     *
     * `GET /v1/portal/kelola/pengumuman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaPengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/pengumuman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, nomor?: string, kategori_id?: int, isi?: string, isi_en?: string, lampiran_media_id?: int, prioritas?: string, sasaran?: list<mixed>, sasaran_prodi?: string, sasaran_angkatan?: string, berlaku_sampai?: string, sematkan?: bool, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaPengumumanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/pengumuman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman: hapus
     *
     * Hapus lunak (deleted_at); isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/pengumuman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaPengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: riwayat perubahan
     *
     * `GET /v1/portal/kelola/pengumuman/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaPengumumanByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/pengumuman/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: ubah status
     *
     * Body `{"status": "draf|review|terbit|arsip", "terbit_pada": "2026-12-01 08:00:00"}`. Penulis hanya draf/review; editor menerbitkan. `terbit_pada` di masa depan = terjadwal.
     *
     * `POST /v1/portal/kelola/pengumuman/{id}/status`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{status: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaPengumumanByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/pengumuman/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman: ajukan ke situs lain
     *
     * Body `{"situs": "univ"}`. Editor situs asal. Bila Anda juga editor di situs tujuan, langsung disetujui; selain itu menunggu persetujuan pengelola situs tujuan.
     *
     * `POST /v1/portal/kelola/pengumuman/{id}/sindikasi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaPengumumanByIdSindikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/pengumuman/{id}/sindikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Agenda: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/agenda`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaAgenda(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/agenda', [], $query, null, $options, false, false);
    }

    /**
     * Agenda: buat
     *
     * Wajib `situs`. Peran: penulis ke atas (penulis hanya miliknya yang masih draf/review). `status` awal draf (bawaan) atau review; editor boleh langsung terbit. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/agenda`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, ringkasan?: string, isi?: string, isi_en?: string, gambar_media_id?: int, mulai: string, selesai?: string, sepanjang_hari?: bool, zona_waktu?: string, mode?: string, lokasi?: string, ruang_id?: int, tautan_daring?: string, penyelenggara?: string, narahubung?: string, narahubung_kontak?: string, pendaftaran?: bool, pendaftaran_tutup?: string, kuota?: int, biaya?: float|int, sasaran?: list<mixed>, tahun_id?: string, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaAgenda(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/agenda', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Agenda: detail
     *
     * `GET /v1/portal/kelola/agenda/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaAgendaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/agenda/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Agenda: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/agenda/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, ringkasan?: string, isi?: string, isi_en?: string, gambar_media_id?: int, mulai: string, selesai?: string, sepanjang_hari?: bool, zona_waktu?: string, mode?: string, lokasi?: string, ruang_id?: int, tautan_daring?: string, penyelenggara?: string, narahubung?: string, narahubung_kontak?: string, pendaftaran?: bool, pendaftaran_tutup?: string, kuota?: int, biaya?: float|int, sasaran?: list<mixed>, tahun_id?: string, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaAgendaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/agenda/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Agenda: hapus
     *
     * Hapus lunak (deleted_at); isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/agenda/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaAgendaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/agenda/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Agenda: riwayat perubahan
     *
     * `GET /v1/portal/kelola/agenda/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaAgendaByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/agenda/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Agenda: ubah status
     *
     * Body `{"status": "draf|review|terbit|arsip", "terbit_pada": "2026-12-01 08:00:00"}`. Penulis hanya draf/review; editor menerbitkan. `terbit_pada` di masa depan = terjadwal.
     *
     * `POST /v1/portal/kelola/agenda/{id}/status`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{status: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaAgendaByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/agenda/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Agenda: ajukan ke situs lain
     *
     * Body `{"situs": "univ"}`. Editor situs asal. Bila Anda juga editor di situs tujuan, langsung disetujui; selain itu menunggu persetujuan pengelola situs tujuan.
     *
     * `POST /v1/portal/kelola/agenda/{id}/sindikasi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaAgendaByIdSindikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/agenda/{id}/sindikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Galeri: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/galeri`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaGaleri(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/galeri', [], $query, null, $options, false, false);
    }

    /**
     * Galeri: buat
     *
     * Wajib `situs`. Peran: penulis ke atas (penulis hanya miliknya yang masih draf/review). `status` awal draf (bawaan) atau review; editor boleh langsung terbit. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/galeri`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, agenda_id?: int, deskripsi?: string, deskripsi_en?: string, sampul_media_id?: int, tanggal?: string, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaGaleri(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/galeri', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Galeri: detail
     *
     * `GET /v1/portal/kelola/galeri/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaGaleriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/galeri/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Galeri: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/galeri/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, agenda_id?: int, deskripsi?: string, deskripsi_en?: string, sampul_media_id?: int, tanggal?: string, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaGaleriById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/galeri/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Galeri: hapus
     *
     * Hapus lunak (deleted_at); isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/galeri/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaGaleriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/galeri/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Galeri: riwayat perubahan
     *
     * `GET /v1/portal/kelola/galeri/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaGaleriByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/galeri/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Galeri: ubah status
     *
     * Body `{"status": "draf|review|terbit|arsip", "terbit_pada": "2026-12-01 08:00:00"}`. Penulis hanya draf/review; editor menerbitkan. `terbit_pada` di masa depan = terjadwal.
     *
     * `POST /v1/portal/kelola/galeri/{id}/status`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{status: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaGaleriByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/galeri/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Galeri: ajukan ke situs lain
     *
     * Body `{"situs": "univ"}`. Editor situs asal. Bila Anda juga editor di situs tujuan, langsung disetujui; selain itu menunggu persetujuan pengelola situs tujuan.
     *
     * `POST /v1/portal/kelola/galeri/{id}/sindikasi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaGaleriByIdSindikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/galeri/{id}/sindikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Halaman: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/halaman`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaHalaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/halaman', [], $query, null, $options, false, false);
    }

    /**
     * Halaman: buat
     *
     * Wajib `situs`. Peran: editor ke atas. `status` awal draf (bawaan) atau review; editor boleh langsung terbit. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/halaman`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, induk_id?: int, isi?: string, isi_en?: string, gambar_media_id?: int, templat?: string, urutan?: int, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaHalaman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/halaman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Halaman: detail
     *
     * `GET /v1/portal/kelola/halaman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaHalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/halaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Halaman: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/halaman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, induk_id?: int, isi?: string, isi_en?: string, gambar_media_id?: int, templat?: string, urutan?: int, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaHalamanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/halaman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Halaman: hapus
     *
     * Hapus lunak (deleted_at); isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/halaman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaHalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/halaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Halaman: riwayat perubahan
     *
     * `GET /v1/portal/kelola/halaman/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaHalamanByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/halaman/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Halaman: ubah status
     *
     * Body `{"status": "draf|review|terbit|arsip", "terbit_pada": "2026-12-01 08:00:00"}`. Penulis hanya draf/review; editor menerbitkan. `terbit_pada` di masa depan = terjadwal.
     *
     * `POST /v1/portal/kelola/halaman/{id}/status`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{status: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaHalamanByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/halaman/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/dokumen`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen: buat
     *
     * Wajib `situs`. Peran: penulis ke atas (penulis hanya miliknya yang masih draf/review). `status` awal draf (bawaan) atau review; editor boleh langsung terbit. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/dokumen`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, media_id?: int, tautan?: string, nomor?: string, tanggal?: string, deskripsi?: string, klasifikasi_ppid?: string, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen: detail
     *
     * `GET /v1/portal/kelola/dokumen/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/dokumen/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, judul: string, judul_en?: string, slug?: string, kategori_id?: int, media_id?: int, tautan?: string, nomor?: string, tanggal?: string, deskripsi?: string, klasifikasi_ppid?: string, meta_judul?: string, meta_deskripsi?: string, status?: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen: hapus
     *
     * Hapus lunak (deleted_at); isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/dokumen/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen: riwayat perubahan
     *
     * `GET /v1/portal/kelola/dokumen/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaDokumenByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/dokumen/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen: ubah status
     *
     * Body `{"status": "draf|review|terbit|arsip", "terbit_pada": "2026-12-01 08:00:00"}`. Penulis hanya draf/review; editor menerbitkan. `terbit_pada` di masa depan = terjadwal.
     *
     * `POST /v1/portal/kelola/dokumen/{id}/status`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{status: string, terbit_pada?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaDokumenByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/dokumen/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banner/slider: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/banner`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaBanner(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/banner', [], $query, null, $options, false, false);
    }

    /**
     * Banner/slider: buat
     *
     * Wajib `situs`. Peran: editor ke atas. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/banner`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, posisi?: string, judul?: string, judul_en?: string, keterangan?: string, keterangan_en?: string, media_id?: int, tautan?: string, teks_tombol?: string, mulai?: string, selesai?: string, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaBanner(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/banner', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banner/slider: detail
     *
     * `GET /v1/portal/kelola/banner/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaBannerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/banner/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Banner/slider: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/banner/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, posisi?: string, judul?: string, judul_en?: string, keterangan?: string, keterangan_en?: string, media_id?: int, tautan?: string, teks_tombol?: string, mulai?: string, selesai?: string, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaBannerById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/banner/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banner/slider: hapus
     *
     * Hapus permanen; isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/banner/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaBannerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/banner/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Banner/slider: riwayat perubahan
     *
     * `GET /v1/portal/kelola/banner/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaBannerByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/banner/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tautan cepat: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/tautan`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaTautan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/tautan', [], $query, null, $options, false, false);
    }

    /**
     * Tautan cepat: buat
     *
     * Wajib `situs`. Peran: editor ke atas. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/tautan`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, grup?: string, nama: string, nama_en?: string, url: string, ikon?: string, logo_media_id?: int, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaTautan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/tautan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tautan cepat: detail
     *
     * `GET /v1/portal/kelola/tautan/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaTautanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/tautan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tautan cepat: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/tautan/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, grup?: string, nama: string, nama_en?: string, url: string, ikon?: string, logo_media_id?: int, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaTautanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/tautan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tautan cepat: hapus
     *
     * Hapus permanen; isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/tautan/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaTautanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/tautan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tautan cepat: riwayat perubahan
     *
     * `GET /v1/portal/kelola/tautan/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaTautanByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/tautan/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Struktur/pimpinan: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/struktur`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaStruktur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/struktur', [], $query, null, $options, false, false);
    }

    /**
     * Struktur/pimpinan: buat
     *
     * Wajib `situs`. Peran: editor ke atas. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/struktur`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, jabatan: string, jabatan_en?: string, grup?: string, nidn?: string, nama?: string, foto_media_id?: int, sambutan?: string, periode_mulai?: string, periode_selesai?: string, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaStruktur(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/struktur', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Struktur/pimpinan: detail
     *
     * `GET /v1/portal/kelola/struktur/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaStrukturById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/struktur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Struktur/pimpinan: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/struktur/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, jabatan: string, jabatan_en?: string, grup?: string, nidn?: string, nama?: string, foto_media_id?: int, sambutan?: string, periode_mulai?: string, periode_selesai?: string, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaStrukturById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/struktur/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Struktur/pimpinan: hapus
     *
     * Hapus permanen; isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/struktur/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaStrukturById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/struktur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Struktur/pimpinan: riwayat perubahan
     *
     * `GET /v1/portal/kelola/struktur/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaStrukturByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/struktur/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * FAQ: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/faq`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaFaq(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/faq', [], $query, null, $options, false, false);
    }

    /**
     * FAQ: buat
     *
     * Wajib `situs`. Peran: editor ke atas. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/faq`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, kategori_id?: int, pertanyaan: string, pertanyaan_en?: string, jawaban: string, jawaban_en?: string, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaFaq(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/faq', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * FAQ: detail
     *
     * `GET /v1/portal/kelola/faq/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaFaqById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/faq/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * FAQ: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/faq/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, kategori_id?: int, pertanyaan: string, pertanyaan_en?: string, jawaban: string, jawaban_en?: string, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaFaqById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/faq/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * FAQ: hapus
     *
     * Hapus permanen; isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/faq/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaFaqById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/faq/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * FAQ: riwayat perubahan
     *
     * `GET /v1/portal/kelola/faq/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaFaqByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/faq/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Menu: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/menu`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaMenu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/menu', [], $query, null, $options, false, false);
    }

    /**
     * Menu: buat
     *
     * Wajib `situs`. Peran: editor ke atas. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/menu`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, lokasi?: string, induk_id?: int, label: string, label_en?: string, tipe?: string, ref_id?: int, url?: string, tab_baru?: bool, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaMenu(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/menu', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Menu: detail
     *
     * `GET /v1/portal/kelola/menu/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaMenuById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/menu/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Menu: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/menu/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, lokasi?: string, induk_id?: int, label: string, label_en?: string, tipe?: string, ref_id?: int, url?: string, tab_baru?: bool, urutan?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaMenuById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/menu/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Menu: hapus
     *
     * Hapus permanen; isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/menu/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaMenuById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/menu/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Menu: riwayat perubahan
     *
     * `GET /v1/portal/kelola/menu/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaMenuByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/menu/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kategori: daftar (semua status)
     *
     * Hanya situs yang dikelola token ini.
     *
     * `GET /v1/portal/kelola/kategori`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaKategori(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/kategori', [], $query, null, $options, false, false);
    }

    /**
     * Kategori: buat
     *
     * Wajib `situs`. Peran: editor ke atas. HTML disaring di server.
     *
     * `POST /v1/portal/kelola/kategori`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, jenis: string, induk_id?: int, slug?: string, nama: string, nama_en?: string, deskripsi?: string, warna?: string, urutan?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaKategori(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/portal/kelola/kategori', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kategori: detail
     *
     * `GET /v1/portal/kelola/kategori/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaKategoriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/kategori/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kategori: ubah
     *
     * Kirim hanya kolom yang diubah. Isi lama disimpan di riwayat revisi.
     *
     * `PATCH /v1/portal/kelola/kategori/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array{situs?: string, jenis: string, induk_id?: int, slug?: string, nama: string, nama_en?: string, deskripsi?: string, warna?: string, urutan?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelolaKategoriById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/portal/kelola/kategori/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kategori: hapus
     *
     * Hapus permanen; isi tersimpan di riwayat revisi.
     *
     * `DELETE /v1/portal/kelola/kategori/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelolaKategoriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/portal/kelola/kategori/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kategori: riwayat perubahan
     *
     * `GET /v1/portal/kelola/kategori/{id}/revisi`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaKategoriByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/portal/kelola/kategori/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }
}
