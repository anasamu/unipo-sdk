<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * QR: Generator, QR: Gaya
 */
final class Qr extends Resource
{
    /**
     * Pilihan gaya QR
     *
     * Publik. Daftar bentuk modul, bentuk mata, jenis gradasi, sumber logo, posisi/bentuk bingkai, tingkat koreksi, batas ukuran, gaya bawaan, dan preset (bawaan, presensi, dokumen, kartu). Untuk pembuat gaya di UI.
     *
     * `GET /v1/qr/opsi`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOpsi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/qr/opsi', [], $query, null, $options, false, true);
    }

    /**
     * Buat kode QR
     *
     * Body:
     *
     * ```json
     * {"isi": "https://siakad.unipo.ac.id/v/AB12CD", "gaya": "presensi", "bagian": "fik", "ukuran": 512, "keluaran": "json"}
     * ```
     *
     * - `isi` (wajib, maks. 2000 byte): teks/URL yang dikodekan.
     * - `gaya`: kode gaya tersimpan (dicari di `bagian` lalu unit induknya sampai kampus, lalu preset), atau objek gaya
     *   lengkap (lihat skema QrGaya dan GET /v1/qr/opsi). Kosong = gaya `bawaan`.
     * - `gaya_tambahan`: objek gaya parsial yang menimpa gaya tersimpan (mis. hanya `bingkai.teks`).
     * - `ukuran`: lebar 64-2048 px (bawaan 512). `koreksi`, `margin`: menimpa gaya.
     * - `keluaran`: `json` (bawaan; `svg` + `data_uri`, dan `data_uri_png` bila `png: true`), `svg` (image/svg+xml
     *   mentah), `png` (image/png mentah).
     * - `simpan: true` (scope qr:write): PNG disimpan ke berkas terpusat (penyimpanan utama menu Integrasi: S3/R2/MinIO/Google
     *   Drive, cadangan disk) dan dicatat; isi + gaya + ukuran yang sama memakai berkas yang sudah ada (200, `baru=false`).
     *   Atribut berkas: `modul`, `referensi`, `visibilitas` (privat|publik), `folder`, `nama_file`.
     *
     * Logo berkas (`gaya.logo.berkas_id`) harus gambar PNG/JPG/WebP yang boleh Anda baca atau berkas publik. Koreksi otomatis
     * naik ke Q/H bila ada logo. `peringatan` berisi saran keterbacaan (kontras, margin, logo).
     *
     * `POST /v1/qr`
     *
     * scope: `qr:read`
     *
     * @param array{isi: string, gaya?: string|array<string, mixed>, gaya_tambahan?: array<string, mixed>, bagian?: string, ukuran?: int, koreksi?: string, margin?: int, keluaran?: string, png?: bool, simpan?: bool, modul?: string, referensi?: string, visibilitas?: string, folder?: string, nama_file?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/qr', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Gaya yang berlaku
     *
     * Publik (untuk layar kiosk/presensi). Gaya `kode` untuk `bagian`: milik bagian itu, unit induknya sampai kampus, lalu preset. Logo dikembalikan sebagai data URI di `gaya.logo.data` supaya komponen KodeQr di browser bisa langsung merender.
     *
     * `GET /v1/qr/gaya/efektif`
     *
     * publik (tanpa token)
     *
     * @param array{kode?: string, bagian?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGayaEfektif(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/qr/gaya/efektif', [], $query, null, $options, false, true);
    }

    /**
     * Daftar gaya tersimpan
     *
     * `GET /v1/qr/gaya`
     *
     * scope: `qr:read`
     *
     * @param array{kode?: string, bagian?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/qr/gaya', [], $query, null, $options, false, false);
    }

    /**
     * Tambah gaya
     *
     * Body {kode, nama, bagian?, keterangan?, gaya, aktif?}. Satu kode per bagian. Tingkat kampus (bagian kosong) hanya qr:admin; gaya bagian oleh qr:admin atau pimpinan/admin unit itu (atau unit induknya) di arsip_petugas.
     *
     * `POST /v1/qr/gaya`
     *
     * scope: `qr:write`
     *
     * @param array{kode?: string, nama?: string, keterangan?: string, bagian?: string, gaya?: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGaya(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/qr/gaya', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail gaya
     *
     * `GET /v1/qr/gaya/{id}`
     *
     * scope: `qr:read`
     *
     * @param int|string $id UUID gaya QR
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGayaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/qr/gaya/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah gaya
     *
     * Body sebagian: nama, keterangan, gaya (menggantikan seluruh gaya), aktif. Kode dan bagian tetap.
     *
     * `POST /v1/qr/gaya/{id}`
     *
     * scope: `qr:write`
     *
     * @param int|string $id UUID gaya QR
     * @param array{kode?: string, nama?: string, keterangan?: string, bagian?: string, gaya?: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGayaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/qr/gaya/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus gaya
     *
     * Hapus lunak; QR berikutnya memakai gaya unit induk atau preset.
     *
     * `POST /v1/qr/gaya/{id}/hapus`
     *
     * scope: `qr:write`
     *
     * @param int|string $id UUID gaya QR
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGayaByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/qr/gaya/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau gaya (SVG)
     *
     * Mengembalikan image/svg+xml.
     *
     * `GET /v1/qr/gaya/{id}/pratinjau`
     *
     * scope: `qr:read`
     *
     * @param int|string $id UUID gaya QR
     * @param array{isi?: string, ukuran?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGayaByIdPratinjau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/qr/gaya/{id}/pratinjau', ['id' => $id], $query, null, $options, false, false);
    }
}
