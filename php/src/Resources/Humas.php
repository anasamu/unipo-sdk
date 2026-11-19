<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Humas, Humas: redaksi, Humas: Beasiswa
 */
final class Humas extends Resource
{
    /**
     * Daftar topik tayang
     *
     * Topik yang dipakai landing page (pmb, karier, alumni, bem, ukm, ...). `semua=1` (butuh portal:write) menyertakan topik nonaktif dan jumlah konten.
     *
     * `GET /v1/humas/topik`
     *
     * scope: `portal:read`
     *
     * @param array{semua?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTopik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/topik', [], $query, null, $options, false, false);
    }

    /**
     * Topik: buat
     *
     * Admin humas. Body: kode, nama, deskripsi, grup, situs (kode situs; umpan topik ikut memuat kontennya), tayang_di, warna, ikon, urutan, aktif.
     *
     * `POST /v1/humas/topik`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTopik(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/topik', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Umpan ringkas untuk landing page
     *
     * Konten terbit untuk satu topik (mis. `pmb`, `karier`) atau kode situs portal (mis. `univ`, kode fakultas): berita, pengumuman, agenda mendatang, dan galeri dalam satu panggilan. Jumlah per jenis lewat query `berita`, `pengumuman`, `agenda`, `galeri` (0-24). Setiap item punya `tautan_baca` ke newsroom humas.
     *
     * `GET /v1/humas/umpan/{kode}`
     *
     * scope: `portal:read`
     *
     * @param int|string $kode Kode topik atau kode situs
     * @param array{turunan?: string, berita?: string, pengumuman?: string, agenda?: string, galeri?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUmpanByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/umpan/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Umpan berita per topik
     *
     * Daftar berita terbit untuk topik atau situs, berhalaman. Detail tetap lewat `/v1/portal/berita/{id}`.
     *
     * `GET /v1/humas/umpan/{kode}/berita`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param int|string $kode Kode topik atau kode situs
     * @param array{q?: string, kategori?: string, turunan?: string, urut?: string, unggulan?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUmpanByKodeBerita(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/umpan/{kode}/berita', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Umpan pengumuman per topik
     *
     * Daftar pengumuman terbit untuk topik atau situs, berhalaman. Detail tetap lewat `/v1/portal/pengumuman/{id}`.
     *
     * `GET /v1/humas/umpan/{kode}/pengumuman`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param int|string $kode Kode topik atau kode situs
     * @param array{q?: string, kategori?: string, turunan?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUmpanByKodePengumuman(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/umpan/{kode}/pengumuman', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Umpan agenda per topik
     *
     * Daftar agenda terbit untuk topik atau situs, berhalaman. Detail tetap lewat `/v1/portal/agenda/{id}`.
     *
     * `GET /v1/humas/umpan/{kode}/agenda`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param int|string $kode Kode topik atau kode situs
     * @param array{q?: string, kategori?: string, turunan?: string, waktu?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUmpanByKodeAgenda(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/umpan/{kode}/agenda', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Umpan galeri per topik
     *
     * Daftar galeri terbit untuk topik atau situs, berhalaman. Detail tetap lewat `/v1/portal/galeri/{id}`.
     *
     * `GET /v1/humas/umpan/{kode}/galeri`
     *
     * scope: `portal:read` · berhalaman
     *
     * @param int|string $kode Kode topik atau kode situs
     * @param array{q?: string, kategori?: string, turunan?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUmpanByKodeGaleri(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/umpan/{kode}/galeri', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Profil redaksi saya
     *
     * Situs yang boleh dikelola beserta peran, dan hak ruang redaksi: `admin` (topik, situs, pengelola), `redaksi` (editor semua situs), `siaran` (kirim notifikasi), `boleh_masuk`.
     *
     * `GET /v1/humas/saya`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/saya', [], $query, null, $options, false, false);
    }

    /**
     * Dasbor redaksi
     *
     * Jumlah konten per status, antrean review, terjadwal, tayangan harian, terpopuler, aktivitas terakhir, agenda mendatang, pesan baru, dan jumlah konten per topik. Dibatasi situs yang dikelola.
     *
     * `GET /v1/humas/ringkasan`
     *
     * scope: `portal:write`
     *
     * @param array{situs?: string, hari?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau HTML dari blok
     *
     * Body `{"blok": [...]}`. Hasil sama dengan yang disimpan ke kolom isi saat konten disimpan.
     *
     * `POST /v1/humas/pratinjau`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPratinjau(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/pratinjau', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berita: daftar
     *
     * Semua status, hanya situs yang dikelola. Setiap baris berisi `topik` dan `jumlah_kata`.
     *
     * `GET /v1/humas/konten/berita`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, kategori?: string, topik?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenBerita(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/berita', [], $query, null, $options, false, false);
    }

    /**
     * Berita: buat
     *
     * Wajib `situs`. Kolom sama dengan /v1/portal/kelola/berita, ditambah `blok` / `blok_en` (daftar blok editor; menggantikan isi/isi_en), `topik` (daftar kode topik tayang), `status`, `terbit_pada`.
     *
     * `POST /v1/humas/konten/berita`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenBerita(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/berita', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berita: detail untuk editor
     *
     * Termasuk `blok`, `blok_en`, `topik`, `peran` Anda di situs itu, dan `tautan_baca`.
     *
     * `GET /v1/humas/konten/berita/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenBeritaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/berita/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Berita: simpan perubahan
     *
     * Kirim hanya yang berubah. `status` berbeda dari status sekarang diproses setelah isi tersimpan (penulis hanya draf/review). Isi lama tersimpan di riwayat revisi portal.
     *
     * `POST /v1/humas/konten/berita/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenBeritaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/berita/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berita: hapus
     *
     * Hapus lunak; isi tersimpan di riwayat revisi.
     *
     * `POST /v1/humas/konten/berita/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenBeritaByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/berita/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: daftar
     *
     * Semua status, hanya situs yang dikelola. Setiap baris berisi `topik` dan `jumlah_kata`.
     *
     * `GET /v1/humas/konten/pengumuman`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, kategori?: string, topik?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenPengumuman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/pengumuman', [], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: buat
     *
     * Wajib `situs`. Kolom sama dengan /v1/portal/kelola/pengumuman, ditambah `blok` / `blok_en` (daftar blok editor; menggantikan isi/isi_en), `topik` (daftar kode topik tayang), `status`, `terbit_pada`.
     *
     * `POST /v1/humas/konten/pengumuman`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenPengumuman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/pengumuman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman: detail untuk editor
     *
     * Termasuk `blok`, `blok_en`, `topik`, `peran` Anda di situs itu, dan `tautan_baca`.
     *
     * `GET /v1/humas/konten/pengumuman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenPengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman: simpan perubahan
     *
     * Kirim hanya yang berubah. `status` berbeda dari status sekarang diproses setelah isi tersimpan (penulis hanya draf/review). Isi lama tersimpan di riwayat revisi portal.
     *
     * `POST /v1/humas/konten/pengumuman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenPengumumanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/pengumuman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman: hapus
     *
     * Hapus lunak; isi tersimpan di riwayat revisi.
     *
     * `POST /v1/humas/konten/pengumuman/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenPengumumanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/pengumuman/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Agenda: daftar
     *
     * Semua status, hanya situs yang dikelola. Setiap baris berisi `topik` dan `jumlah_kata`.
     *
     * `GET /v1/humas/konten/agenda`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, kategori?: string, topik?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenAgenda(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/agenda', [], $query, null, $options, false, false);
    }

    /**
     * Agenda: buat
     *
     * Wajib `situs`. Kolom sama dengan /v1/portal/kelola/agenda, ditambah `blok` / `blok_en` (daftar blok editor; menggantikan isi/isi_en), `topik` (daftar kode topik tayang), `status`, `terbit_pada`.
     *
     * `POST /v1/humas/konten/agenda`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenAgenda(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/agenda', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Agenda: detail untuk editor
     *
     * Termasuk `blok`, `blok_en`, `topik`, `peran` Anda di situs itu, dan `tautan_baca`.
     *
     * `GET /v1/humas/konten/agenda/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenAgendaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/agenda/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Agenda: simpan perubahan
     *
     * Kirim hanya yang berubah. `status` berbeda dari status sekarang diproses setelah isi tersimpan (penulis hanya draf/review). Isi lama tersimpan di riwayat revisi portal.
     *
     * `POST /v1/humas/konten/agenda/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenAgendaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/agenda/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Agenda: hapus
     *
     * Hapus lunak; isi tersimpan di riwayat revisi.
     *
     * `POST /v1/humas/konten/agenda/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenAgendaByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/agenda/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Galeri: daftar
     *
     * Semua status, hanya situs yang dikelola. Setiap baris berisi `topik` dan `jumlah_kata`.
     *
     * `GET /v1/humas/konten/galeri`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, kategori?: string, topik?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenGaleri(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/galeri', [], $query, null, $options, false, false);
    }

    /**
     * Galeri: buat
     *
     * Wajib `situs`. Kolom sama dengan /v1/portal/kelola/galeri, ditambah `blok` / `blok_en` (daftar blok editor; menggantikan isi/isi_en), `topik` (daftar kode topik tayang), `status`, `terbit_pada`.
     *
     * `POST /v1/humas/konten/galeri`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenGaleri(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/galeri', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Galeri: detail untuk editor
     *
     * Termasuk `blok`, `blok_en`, `topik`, `peran` Anda di situs itu, dan `tautan_baca`.
     *
     * `GET /v1/humas/konten/galeri/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenGaleriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/galeri/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Galeri: simpan perubahan
     *
     * Kirim hanya yang berubah. `status` berbeda dari status sekarang diproses setelah isi tersimpan (penulis hanya draf/review). Isi lama tersimpan di riwayat revisi portal.
     *
     * `POST /v1/humas/konten/galeri/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenGaleriById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/galeri/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Galeri: hapus
     *
     * Hapus lunak; isi tersimpan di riwayat revisi.
     *
     * `POST /v1/humas/konten/galeri/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenGaleriByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/galeri/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Halaman: daftar
     *
     * Semua status, hanya situs yang dikelola. Setiap baris berisi `topik` dan `jumlah_kata`.
     *
     * `GET /v1/humas/konten/halaman`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{situs?: string, status?: string, q?: string, kategori?: string, topik?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenHalaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/halaman', [], $query, null, $options, false, false);
    }

    /**
     * Halaman: buat
     *
     * Wajib `situs`. Kolom sama dengan /v1/portal/kelola/halaman, ditambah `blok` / `blok_en` (daftar blok editor; menggantikan isi/isi_en), `status`, `terbit_pada`.
     *
     * `POST /v1/humas/konten/halaman`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenHalaman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/halaman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Halaman: detail untuk editor
     *
     * Termasuk `blok`, `blok_en`, `topik`, `peran` Anda di situs itu, dan `tautan_baca`.
     *
     * `GET /v1/humas/konten/halaman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKontenHalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/konten/halaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Halaman: simpan perubahan
     *
     * Kirim hanya yang berubah. `status` berbeda dari status sekarang diproses setelah isi tersimpan (penulis hanya draf/review). Isi lama tersimpan di riwayat revisi portal.
     *
     * `POST /v1/humas/konten/halaman/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenHalamanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/halaman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Halaman: hapus
     *
     * Hapus lunak; isi tersimpan di riwayat revisi.
     *
     * `POST /v1/humas/konten/halaman/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKontenHalamanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/konten/halaman/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Topik: ubah
     *
     * Admin humas.
     *
     * `POST /v1/humas/topik/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID topik
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTopikById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/topik/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Topik: hapus
     *
     * Admin humas. Penanda topik di konten ikut dihapus; kontennya tetap.
     *
     * `POST /v1/humas/topik/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID topik
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTopikByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/topik/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pola blok
     *
     * Pola bersama dan pola pribadi saya.
     *
     * `GET /v1/humas/pola`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPola(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/pola', [], $query, null, $options, false, false);
    }

    /**
     * Pola blok: simpan baru
     *
     * Body: nama, kategori, deskripsi, blok, bersama (hanya redaksi/admin).
     *
     * `POST /v1/humas/pola`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPola(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/pola', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pola blok: ubah
     *
     * Pembuat atau admin humas.
     *
     * `POST /v1/humas/pola/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID pola
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPolaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/pola/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pola blok: hapus
     *
     * Pembuat atau admin humas.
     *
     * `POST /v1/humas/pola/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID pola
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPolaByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/pola/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat notifikasi siaran
     *
     * Butuh izin humas.siaran, admin humas, atau level ADMIN.
     *
     * `GET /v1/humas/siaran`
     *
     * scope: `portal:write` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSiaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/siaran', [], $query, null, $options, false, false);
    }

    /**
     * Kirim notifikasi siaran
     *
     * Masuk kotak masuk pengguna SIAKAD (modul Notifikasi) dan kanal email/WhatsApp sesuai preferensi mereka. Body: judul, isi (teks), tautan, sasaran (semua | level | prodi | angkatan), level ("MAHASISWA,DOSEN"), kode_prodi, angkatan, jenis + konten_id (konten terbit yang diumumkan; tautan otomatis ke newsroom).
     *
     * `POST /v1/humas/siaran`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSiaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/siaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cari akun SIAKAD
     *
     * Untuk memilih pengelola situs. Admin humas atau admin situs. `q` = nama atau username, `username` = cari tepat satu akun.
     *
     * `GET /v1/humas/pengguna`
     *
     * scope: `portal:write`
     *
     * @param array{q?: string, username?: string, per_page?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengguna(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/pengguna', [], $query, null, $options, false, false);
    }

    /**
     * Daftar peran RBAC
     *
     * Peran aktif beserta jumlah pemegang, untuk memberi hak kelola situs lewat peran. Admin humas atau admin situs.
     *
     * `GET /v1/humas/peran`
     *
     * scope: `portal:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/peran', [], $query, null, $options, false, false);
    }

    /**
     * Peran yang mengelola situs
     *
     * Semua pemegang peran RBAC ini mendapat peran situs (penulis/editor/admin). Admin situs.
     *
     * `GET /v1/humas/situs/{kode}/peran`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSitusByKodePeran(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/situs/{kode}/peran', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Beri hak kelola situs ke peran
     *
     * Body: `peran_rbac` (kode rbac_peran), `peran` (penulis | editor | admin). Mengganti peran bila sudah ada.
     *
     * `POST /v1/humas/situs/{kode}/peran`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSitusByKodePeran(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/situs/{kode}/peran', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut hak kelola situs dari peran
     *
     * Admin situs.
     *
     * `POST /v1/humas/situs/{kode}/peran/{peran}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode Kode atau ID situs
     * @param int|string $peran Kode peran RBAC
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSitusByKodePeranByPeranHapus(int|string $kode, int|string $peran, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/situs/{kode}/peran/{peran}/hapus', ['kode' => $kode, 'peran' => $peran], $query, null, $options, false, false);
    }

    /**
     * Dokumen: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/dokumen/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/dokumen/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/dokumen/{id}.
     *
     * `POST /v1/humas/kelola/dokumen/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaDokumenByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/dokumen/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Banner: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/banner/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/banner/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaBannerById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/banner/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banner: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/banner/{id}.
     *
     * `POST /v1/humas/kelola/banner/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaBannerByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/banner/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tautan: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/tautan/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/tautan/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaTautanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/tautan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tautan: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/tautan/{id}.
     *
     * `POST /v1/humas/kelola/tautan/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaTautanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/tautan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Struktur: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/struktur/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/struktur/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaStrukturById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/struktur/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Struktur: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/struktur/{id}.
     *
     * `POST /v1/humas/kelola/struktur/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaStrukturByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/struktur/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Faq: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/faq/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/faq/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaFaqById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/faq/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Faq: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/faq/{id}.
     *
     * `POST /v1/humas/kelola/faq/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaFaqByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/faq/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Menu: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/menu/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/menu/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaMenuById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/menu/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Menu: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/menu/{id}.
     *
     * `POST /v1/humas/kelola/menu/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaMenuByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/menu/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lowongan: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/lowongan/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/lowongan/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaLowonganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/lowongan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lowongan: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/lowongan/{id}.
     *
     * `POST /v1/humas/kelola/lowongan/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaLowonganByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/lowongan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kategori: simpan perubahan
     *
     * Alias POST dari PATCH /v1/portal/kelola/kategori/{id}; kirim hanya kolom yang berubah.
     *
     * `POST /v1/humas/kelola/kategori/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaKategoriById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/kategori/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kategori: hapus
     *
     * Alias POST dari DELETE /v1/portal/kelola/kategori/{id}.
     *
     * `POST /v1/humas/kelola/kategori/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaKategoriByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/kelola/kategori/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah profil situs (alias POST dari PATCH /v1/portal/kelola/situs/{kode})
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/situs/{kode}`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode kode
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSitusByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/situs/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Simpan pengaturan situs (alias POST dari PUT .../pengaturan)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/situs/{kode}/pengaturan`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode kode
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSitusByKodePengaturan(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/situs/{kode}/pengaturan', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus pengelola situs (alias POST dari DELETE)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/situs/{kode}/pengelola/{username}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $kode kode
     * @param int|string $username username
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSitusByKodePengelolaByUsernameHapus(int|string $kode, int|string $username, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/situs/{kode}/pengelola/{username}/hapus', ['kode' => $kode, 'username' => $username], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah keterangan media (alias POST dari PATCH)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/media/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id id
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMediaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/media/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus media (alias POST dari DELETE)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/media/{id}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id id
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMediaByIdHapus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/media/{id}/hapus', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah item galeri (alias POST dari PATCH)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/galeri/{id}/item/{item}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id id
     * @param int|string $item item
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGaleriByIdItemByItem(int|string $id, int|string $item, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/galeri/{id}/item/{item}', ['id' => $id, 'item' => $item], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus item galeri (alias POST dari DELETE)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/galeri/{id}/item/{item}/hapus`
     *
     * scope: `portal:write`
     *
     * @param int|string $id id
     * @param int|string $item item
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGaleriByIdItemByItemHapus(int|string $id, int|string $item, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/galeri/{id}/item/{item}/hapus', ['id' => $id, 'item' => $item], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tindak lanjut pesan masuk (alias POST dari PATCH)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/pesan/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id id
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/pesan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah status peserta / check-in (alias POST dari PATCH)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/agenda/{id}/peserta/{peserta}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id id
     * @param int|string $peserta peserta
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAgendaByIdPesertaByPeserta(int|string $id, int|string $peserta, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/agenda/{id}/peserta/{peserta}', ['id' => $id, 'peserta' => $peserta], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Setujui/tolak sindikasi (alias POST dari PATCH)
     *
     * Perilaku, hak akses, dan body sama dengan endpoint Portal aslinya (docs/PORTAL.md).
     *
     * `POST /v1/humas/sindikasi/{id}`
     *
     * scope: `portal:write`
     *
     * @param int|string $id id
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSindikasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/sindikasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar beasiswa publik
     *
     * Program yang dibuka/berjalan: syarat, berkas, jadwal, kuota, bentuk, dan pengumuman terbit. Tanpa data pendaftar.
     *
     * `GET /v1/humas/beasiswa`
     *
     * scope: `portal:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/beasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Draf dan terbitan pengumuman beasiswa
     *
     * Dibuat otomatis saat BAAK membuka program dan menetapkan penerima. Izin beasiswa.publikasi atau humas.redaksi.
     *
     * `GET /v1/humas/beasiswa/publikasi`
     *
     * scope: `portal:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaPublikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/humas/beasiswa/publikasi', [], $query, null, $options, false, false);
    }

    /**
     * Sunting draf pengumuman
     *
     * Body {judul, isi (teks; baris "- " jadi daftar)}.
     *
     * `POST /v1/humas/beasiswa/publikasi/{id}`
     *
     * scope: `portal:write` · hanya token pengguna
     *
     * @param int|string $id ID pengumuman
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaPublikasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/beasiswa/publikasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan pengumuman beasiswa
     *
     * Menjadi pengumuman portal universitas bertopik beasiswa (tayang di newsroom, PMB, SIAKAD mahasiswa).
     *
     * `POST /v1/humas/beasiswa/publikasi/{id}/terbit`
     *
     * scope: `portal:write` · hanya token pengguna
     *
     * @param int|string $id ID pengumuman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaPublikasiByIdTerbit(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/humas/beasiswa/publikasi/{id}/terbit', ['id' => $id], $query, null, $options, false, false);
    }
}
