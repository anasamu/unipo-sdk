<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Templat email
 */
final class Surel extends Resource
{
    /**
     * Daftar templat email
     *
     * Semua templat bawaan dengan kelompok, aplikasi pengirim, kejadian yang memicunya, dan sumber (`bawaan`/`ubahan`). `penyedia_email_aktif` = penyedia email di Integrasi sudah aktif.
     *
     * `GET /v1/surel/templat`
     *
     * scope: `integrasi:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/surel/templat', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau email
     *
     * Body {kode, subjek?, blok?, tampilan?, data?}: {subjek, html, teks} dengan data contoh templat itu (`data` menimpa). `subjek`/`blok`/`tampilan` = isian editor yang belum disimpan.
     *
     * `POST /v1/surel/pratinjau`
     *
     * scope: `integrasi:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPratinjau(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/surel/pratinjau', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim email uji
     *
     * Body {ke, kode, subjek?, blok?, tampilan?}: kirim satu email berdata contoh lewat penyedia email aktif (subjek diawali [Uji]).
     *
     * `POST /v1/surel/uji`
     *
     * scope: `integrasi:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUji(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/surel/uji', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tampilan umum email
     *
     * Warna utama, warna kepala, latar, logo, kepala, kaki, sudut, huruf.
     *
     * `GET /v1/surel/tampilan`
     *
     * scope: `integrasi:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTampilan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/surel/tampilan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan tampilan umum
     *
     * Body sebagian {warna_utama, warna_kepala, warna_latar, tampil_logo, logo_url (https), kepala, subkepala, kaki, tautan_kaki, sudut, huruf}. Berlaku untuk semua email.
     *
     * `POST /v1/surel/tampilan`
     *
     * scope: `integrasi:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTampilan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/surel/tampilan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail templat
     *
     * Templat berlaku, templat bawaan, penanda yang bisa dipakai, data contoh, dan info pemakai.
     *
     * `GET /v1/surel/templat/{kode}`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $kode Kode templat, mis. notif.keuangan, sso.reset_password
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/surel/templat/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Simpan ubahan templat
     *
     * Body {subjek, blok: [{jenis: label|judul|paragraf|tombol|kotak|kode|rincian|pemisah|gambar, teks?, gaya?, nada?, tautan?, baris?, url?, alt?}], aktif?}. Maks. 30 blok.
     *
     * `POST /v1/surel/templat/{kode}`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $kode Kode templat, mis. notif.keuangan, sso.reset_password
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/surel/templat/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pulihkan templat bawaan
     *
     * Ubahan dihapus; templat kembali ke bawaan.
     *
     * `POST /v1/surel/templat/{kode}/pulihkan`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $kode Kode templat, mis. notif.keuangan, sso.reset_password
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatByKodePulihkan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/surel/templat/{kode}/pulihkan', ['kode' => $kode], $query, null, $options, false, false);
    }
}
