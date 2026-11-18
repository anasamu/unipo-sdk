<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * SK: Registri
 */
final class Sk extends Resource
{
    /**
     * Cari SK
     *
     * Cari di registri SK tunggal: q (nomor dinormalisasi atau perihal), jenis, status (terbit, draf, dicabut, diubah, ditolak; dipisah koma), penerbit (induk_unit.id), arsip=0 untuk tidak menawarkan surat keluar arsip berjenis SK yang belum tercatat (id "surat:<uuid>"). Draf dan SK terbatas hanya tampil untuk penerbit/pengajunya. meta.unit_catat = unit tempat pengguna boleh mencatat (null = semua).
     *
     * `GET /v1/sk`
     *
     * scope: `berkas:read`
     *
     * @param array{q?: string, jenis?: string, status?: string, penerbit?: string, per_page?: string, arsip?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk', [], $query, null, $options, false, false);
    }

    /**
     * Catat atau ajukan SK
     *
     * Body: {"nomor", "tanggal"?, "perihal"?, "jenis"?, "penerbit_unit_id" | "penerbit_luar", penandatangan opsional: "penandatangan_pejabat_id" | ("penandatangan_jabatan_id" + "penandatangan_unit_id") | ("penandatangan_jabatan" + "penandatangan_nama" teks, belum tertaut), "tempat"?, "berkas_id"?, "ttd_berkas_id"?, "keamanan"?: "biasa"|"terbatas", "catatan"?, "mengubah"?: [uuid], "mencabut"?: [uuid], "abaikan_mirip"?: true}. Pemegang sk.catat di unit penerbit: status terbit; selain itu: draf (ajuan pencatatan) yang diverifikasi penerbit. Nomor sama di penerbit sama: 409 kode sk_sudah_tercatat beserta SK yang ada (pilih SK itu). Nomor sama di penerbit lain: 409 sk_mirip kecuali abaikan_mirip. Berkas dipindah ke ruang Berkas unit penerbit (folder SK).
     *
     * `POST /v1/sk`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array{nomor?: string|null, tanggal?: string|null, perihal?: string|null, jenis?: string|null, penerbit_unit_id?: int|null, penerbit_luar?: string|null, penandatangan_pejabat_id?: int|null, penandatangan_jabatan_id?: int|null, penandatangan_unit_id?: int|null, penandatangan_jabatan?: string|null, penandatangan_nama?: string|null, tempat?: string|null, berkas_id?: string|null, ttd_berkas_id?: string|null, keamanan?: string, catatan?: string|null, mengubah?: list<mixed>, mencabut?: list<mixed>, abaikan_mirip?: bool, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sk', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periksa nomor SK
     *
     * Sebelum mencatat/merujuk: SK dengan nomor yang sama setelah dinormalisasi (spasi, huruf besar, tanda baca, nol depan). sama = SK yang sama (penerbit sama atau belum diketahui), mirip = nomor sama dengan penerbit lain, pesan = saran untuk pengguna.
     *
     * `GET /v1/sk/periksa`
     *
     * scope: `berkas:read`
     *
     * @param array{nomor?: string, penerbit_unit_id?: string, penerbit_luar?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriksa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/periksa', [], $query, null, $options, false, false);
    }

    /**
     * Unit penerbit
     *
     * Unit organisasi (induk_unit) dengan boleh_catat = pengguna memegang sk.catat di unit itu.
     *
     * `GET /v1/sk/penerbit`
     *
     * scope: `berkas:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenerbit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/penerbit', [], $query, null, $options, false, false);
    }

    /**
     * Pejabat penandatangan
     *
     * Pejabat aktif (induk_pejabat) di unit penerbit beserta jabatan lengkapnya, untuk dipilih sebagai penandatangan. Nama dan jabatan tidak diketik.
     *
     * `GET /v1/sk/penandatangan`
     *
     * scope: `berkas:read`
     *
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenandatangan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/penandatangan', [], $query, null, $options, false, false);
    }

    /**
     * Isian bawaan SK
     *
     * Penerbit, perihal, dan penandatangan bawaan menurut jenis SK dan jabatan yang diangkat: pengangkatan Rektor -> Yayasan (penandatangan Ketua Yayasan, teks); pengangkatan pejabat lain dan surat tugas Plt/Plh -> universitas, Rektor; SK fakultas/prodi -> Dekan. Penandatangan = pejabat aktif bila ada, selain itu jabatan saja (tautan "jabatan") atau teks.
     *
     * `GET /v1/sk/bawaan`
     *
     * scope: `berkas:read`
     *
     * @param array{jenis?: string, penerbit_unit_id?: string, untuk_jabatan_id?: string, untuk_unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBawaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/bawaan', [], $query, null, $options, false, false);
    }

    /**
     * Jabatan penandatangan
     *
     * Jabatan yang berlaku di unit (untuk penandatangan berupa jabatan tanpa orang, mis. sebelum pejabatnya tercatat).
     *
     * `GET /v1/sk/jabatan-penandatangan`
     *
     * scope: `berkas:read`
     *
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJabatanPenandatangan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/jabatan-penandatangan', [], $query, null, $options, false, false);
    }

    /**
     * Detail SK
     *
     * SK beserta pemakaian (baris modul yang merujuk), relasi mengubah/mencabut, catatan lain bernomor sama, dan boleh.catat.
     *
     * `GET /v1/sk/{id}`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID SK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah SK
     *
     * Penerbit (sk.catat di unit penerbit), atau pengaju selama draf. Body sama dengan catat (sebagian boleh). Salinan nomor/tanggal di modul pemakai ikut diselaraskan.
     *
     * `POST /v1/sk/{id}`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID SK
     * @param array{nomor?: string|null, tanggal?: string|null, perihal?: string|null, jenis?: string|null, penerbit_unit_id?: int|null, penerbit_luar?: string|null, penandatangan_pejabat_id?: int|null, penandatangan_jabatan_id?: int|null, penandatangan_unit_id?: int|null, penandatangan_jabatan?: string|null, penandatangan_nama?: string|null, tempat?: string|null, berkas_id?: string|null, ttd_berkas_id?: string|null, keamanan?: string, catatan?: string|null, mengubah?: list<mixed>, mencabut?: list<mixed>, abaikan_mirip?: bool, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sk/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Verifikasi ajuan pencatatan
     *
     * Body: {"keputusan": "terima"|"tolak", "catatan"? (wajib saat tolak), "penerbit_unit_id"?}. Penerbit saja.
     *
     * `POST /v1/sk/{id}/verifikasi`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID SK
     * @param array{keputusan: string, catatan?: string|null, penerbit_unit_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sk/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut SK
     *
     * Body: {"oleh_sk_id"?: UUID SK pencabut, "catatan"?}. Penerbit saja.
     *
     * `POST /v1/sk/{id}/cabut`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID SK
     * @param array{oleh_sk_id?: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sk/{id}/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Gabungkan catatan ganda
     *
     * Body: {"ke": UUID SK tujuan}. Nomor kunci harus sama. Rujukan, relasi, dan berkas dipindah ke tujuan; catatan ini dihapus lunak. Penerbit SK tujuan saja.
     *
     * `POST /v1/sk/{id}/gabung`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID SK
     * @param array{ke: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdGabung(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sk/{id}/gabung', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berkas SK
     *
     * Isi berkas SK untuk siapa pun yang boleh melihat SK (hak baca registri, tanpa salinan). ?unduh=1 untuk unduhan.
     *
     * `GET /v1/sk/{id}/berkas`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID SK
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * URL sementara berkas SK
     *
     * Untuk dibuka di peramban/aplikasi lain tanpa token: {url, kedaluwarsa_at}. ttl 60-3600 detik, unduh=1 untuk unduhan.
     *
     * `GET /v1/sk/{id}/berkas-url`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID SK
     * @param array{ttl?: string, unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdBerkasUrl(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/{id}/berkas-url', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Gambar tanda tangan penandatangan
     *
     * Hanya bila penerbit melampirkan gambar tanda tangan resmi di registri.
     *
     * `GET /v1/sk/{id}/ttd`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID SK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdTtd(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/sk/{id}/ttd', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat SK dari surat keluar arsip
     *
     * Surat keluar berjenis SK yang sudah bernomor dicatat ke registri (penerbit = unit arsip pengirim, penandatangan dari surat). Bila sudah tercatat, SK itu yang dikembalikan.
     *
     * `POST /v1/sk/dari-surat/{surat}`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $surat UUID surat keluar arsip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDariSuratBySurat(int|string $surat, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/sk/dari-surat/{surat}', ['surat' => $surat], $query, null, $options, false, false);
    }
}
