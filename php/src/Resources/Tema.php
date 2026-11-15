<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Tema
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
}
