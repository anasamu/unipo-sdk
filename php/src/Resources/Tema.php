<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Tema, Tema: Halaman landing
 */
final class Tema extends Resource
{
    /**
     * Semua tema (admin)
     *
     * Semua lapis tema yang pernah diatur. Hanya ADMIN atau token ber-scope tema:admin.
     *
     * `GET /v1/tema`
     *
     * scope: `tema:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tema', [], $query, null, $options, false, false);
    }

    /**
     * Tema berlaku
     *
     * Publik. Tema yang berlaku untuk aplikasi (dan lingkupnya): gabungan lapis `kampus` → `<aplikasi>` → `<aplikasi>?lingkup=`.
     *
     * - `tema`: pilihan generator tema unipo-ui (`buatTema` dari `unipo-ui/tema`): primary, secondary, netral, radius, font,
     *   fontJudul, teks, bayangan, gerak, ... Objek kosong = bawaan unipo-ui.
     * - `tata`: tata letak milik aplikasi (mis. aplikasi fakultas: hero, navbar, mode, bagian[]).
     * - `sendiri`: isi lapis ini saja (untuk formulir pengaturan), `warisan`: gabungan lapis di atasnya, `sumber`: lapis yang terisi.
     * - `berkas`: peta `uuid → URL tampil` untuk nilai `tata` berbentuk `berkas:<uuid>` (gambar halaman masuk unggahan).
     *   Hanya berkas publik bergambar; tautan berlaku 1 hari.
     *
     * Aplikasi cukup memasang `<TemaAplikasi aplikasi="..." lingkup="...">` dari unipo-ui/siakad, atau membaca endpoint ini
     * lalu `buatTema(tema)`. Boleh disimpan di cache browser; `versi` naik setiap perubahan.
     *
     * `GET /v1/tema/{aplikasi}`
     *
     * publik (tanpa token)
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param array{lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByAplikasi(int|string $aplikasi, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tema/{aplikasi}', ['aplikasi' => $aplikasi], $query, null, $options, false, true);
    }

    /**
     * Simpan tema
     *
     * Body: `{"tema": {"primary": "#0f766e", "netral": "slate", "radius": 8, "font": "inter"}, "tata": {"mode": "pengguna", "hero": "gambar"}, "catatan": "..."}`.
     * Menggantikan seluruh isi lapis ini; kunci tema yang tidak dikirim mengikuti lapis di atasnya. Nilai tidak dikenal dibuang,
     * teks `tata` dibersihkan dari HTML. Setiap simpan menjadi versi baru di riwayat.
     *
     * Hak: izin RBAC `<aplikasi>.tema` (global, atau berlingkup unit yang sesuai `lingkup`); aplikasi fakultas: izin
     * `fakultas.tema` di tingkat fakultas. Lapis `kampus` hanya ADMIN / scope tema:admin.
     *
     * `POST /v1/tema/{aplikasi}`
     *
     * scope: `tema:write`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param array{tema?: array<string, mixed>, tata?: array<string, mixed>, catatan?: string, ...} $body
     * @param array{query?: array{lingkup?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByAplikasi(int|string $aplikasi, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tema/{aplikasi}', ['aplikasi' => $aplikasi], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bolehkah saya mengubah tema ini
     *
     * `boleh` = punya izin `<aplikasi>.tema` (berlingkup unit lingkup), atau ADMIN. Untuk menampilkan menu Pengaturan tema.
     *
     * `GET /v1/tema/{aplikasi}/akses`
     *
     * scope: `tema:read` · hanya token pengguna
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param array{lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByAplikasiAkses(int|string $aplikasi, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tema/{aplikasi}/akses', ['aplikasi' => $aplikasi], $query, null, $options, false, false);
    }

    /**
     * Riwayat tema
     *
     * Perubahan terakhir lapis ini (bawaan 30, `batas` maks. 100). Hak sama dengan simpan.
     *
     * `GET /v1/tema/{aplikasi}/riwayat`
     *
     * scope: `tema:read`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param array{batas?: string, lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByAplikasiRiwayat(int|string $aplikasi, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tema/{aplikasi}/riwayat', ['aplikasi' => $aplikasi], $query, null, $options, false, false);
    }

    /**
     * Pulihkan versi tema
     *
     * Menyalin versi lama menjadi tema berlaku (dicatat sebagai versi baru). Hak sama dengan simpan.
     *
     * `POST /v1/tema/{aplikasi}/riwayat/{id}/pulihkan`
     *
     * scope: `tema:write`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $id ID riwayat
     * @param array{lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByAplikasiRiwayatByIdPulihkan(int|string $aplikasi, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tema/{aplikasi}/riwayat/{id}/pulihkan', ['aplikasi' => $aplikasi, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Halaman landing terbit
     *
     * Publik. Isi halaman landing yang terbit untuk aplikasi (dan lingkupnya; lingkup tanpa halaman sendiri memakai halaman
     * aplikasinya): `terbit` = `{versi: 1, halaman: {judul, deskripsi}, blok: [{id, tipe, isi, gaya}]}` atau null (belum
     * pernah diterbitkan: aplikasi memakai isi bawaan unipo-ui), `versi`, `terbit_oleh`, `terbit_pada`, `berkas` (peta
     * uuid → URL tampil untuk gambar `berkas:<uuid>`, hanya berkas publik bergambar).
     *
     * `draf=1` (butuh token pengguna yang berhak mengubah tema aplikasi): ikut `draf`, `revisi`, `draf_oleh`, `draf_pada`.
     * Render dengan `<LandingAplikasi aplikasi="...">` atau `<HalamanLanding dokumen={...}>` dari unipo-ui.
     *
     * `GET /v1/tema/{aplikasi}/halaman/{halaman}`
     *
     * publik (tanpa token)
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $halaman Kode halaman, mis. beranda
     * @param array{draf?: string, lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByAplikasiHalamanByHalaman(int|string $aplikasi, int|string $halaman, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tema/{aplikasi}/halaman/{halaman}', ['aplikasi' => $aplikasi, 'halaman' => $halaman], $query, null, $options, false, true);
    }

    /**
     * Simpan draf halaman
     *
     * Body `{"dokumen": {...}, "revisi": 3}`. Menyimpan draf saja; tampilan pengunjung tidak berubah sampai diterbitkan.
     * Isi dibersihkan di server: tipe blok dan kolom yang tidak dikenal dibuang, teks tanpa HTML, URL hanya #jangkar, /alamat,
     * http(s), mailto:, tel:; gambar hanya `berkas:<uuid>`, https, atau /alamat; gaya hanya pilihan token tema. Maks. 40 blok,
     * 200 KB. `revisi` = revisi draf yang dibuka; 409 `draf_berubah` bila penyunting lain sudah menyimpan.
     * Hak: izin RBAC `<aplikasi>.tema` (sama dengan simpan tema).
     *
     * `POST /v1/tema/{aplikasi}/halaman/{halaman}/draf`
     *
     * scope: `tema:write`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $halaman Kode halaman, mis. beranda
     * @param array{dokumen?: array<string, mixed>, revisi?: int, catatan?: string, ...} $body
     * @param array{query?: array{lingkup?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByAplikasiHalamanByHalamanDraf(int|string $aplikasi, int|string $halaman, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tema/{aplikasi}/halaman/{halaman}/draf', ['aplikasi' => $aplikasi, 'halaman' => $halaman], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan halaman
     *
     * Body `{"dokumen"?: {...}, "revisi"?: 3, "catatan"?: "..."}`. Tanpa `dokumen` = terbitkan draf tersimpan. Versi naik, draf dikosongkan, salinan masuk riwayat. Hak sama dengan simpan draf.
     *
     * `POST /v1/tema/{aplikasi}/halaman/{halaman}/terbit`
     *
     * scope: `tema:write`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $halaman Kode halaman, mis. beranda
     * @param array{dokumen?: array<string, mixed>, revisi?: int, catatan?: string, ...} $body
     * @param array{query?: array{lingkup?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByAplikasiHalamanByHalamanTerbit(int|string $aplikasi, int|string $halaman, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tema/{aplikasi}/halaman/{halaman}/terbit', ['aplikasi' => $aplikasi, 'halaman' => $halaman], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buang draf halaman
     *
     * Draf dihapus; halaman terbit tidak berubah.
     *
     * `POST /v1/tema/{aplikasi}/halaman/{halaman}/draf/buang`
     *
     * scope: `tema:write`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $halaman Kode halaman, mis. beranda
     * @param array{lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByAplikasiHalamanByHalamanDrafBuang(int|string $aplikasi, int|string $halaman, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tema/{aplikasi}/halaman/{halaman}/draf/buang', ['aplikasi' => $aplikasi, 'halaman' => $halaman], $query, null, $options, false, false);
    }

    /**
     * Riwayat terbit halaman
     *
     * Terbitan terakhir (bawaan 30, `batas` maks. 100): versi, jumlah blok, catatan, oleh, waktu. Hak sama dengan simpan draf.
     *
     * `GET /v1/tema/{aplikasi}/halaman/{halaman}/riwayat`
     *
     * scope: `tema:read`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $halaman Kode halaman, mis. beranda
     * @param array{batas?: string, lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByAplikasiHalamanByHalamanRiwayat(int|string $aplikasi, int|string $halaman, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tema/{aplikasi}/halaman/{halaman}/riwayat', ['aplikasi' => $aplikasi, 'halaman' => $halaman], $query, null, $options, false, false);
    }

    /**
     * Isi satu versi halaman
     *
     * Untuk pratinjau versi lama sebelum dipulihkan.
     *
     * `GET /v1/tema/{aplikasi}/halaman/{halaman}/riwayat/{id}`
     *
     * scope: `tema:read`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $halaman Kode halaman, mis. beranda
     * @param int|string $id ID riwayat
     * @param array{lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByAplikasiHalamanByHalamanRiwayatById(int|string $aplikasi, int|string $halaman, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tema/{aplikasi}/halaman/{halaman}/riwayat/{id}', ['aplikasi' => $aplikasi, 'halaman' => $halaman, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pulihkan versi ke draf
     *
     * Menyalin versi lama ke draf. Tampilan pengunjung baru berubah setelah draf diterbitkan.
     *
     * `POST /v1/tema/{aplikasi}/halaman/{halaman}/riwayat/{id}/pulihkan`
     *
     * scope: `tema:write`
     *
     * @param int|string $aplikasi Kode aplikasi di katalog RBAC (pmb, lms, tracer, humas, fakultas, ...) atau `kampus` untuk tema bersama
     * @param int|string $halaman Kode halaman, mis. beranda
     * @param int|string $id ID riwayat
     * @param array{lingkup?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByAplikasiHalamanByHalamanRiwayatByIdPulihkan(int|string $aplikasi, int|string $halaman, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tema/{aplikasi}/halaman/{halaman}/riwayat/{id}/pulihkan', ['aplikasi' => $aplikasi, 'halaman' => $halaman, 'id' => $id], $query, null, $options, false, false);
    }
}
