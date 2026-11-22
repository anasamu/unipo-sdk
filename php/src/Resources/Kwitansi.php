<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kwitansi: Pengaturan, Kwitansi: Terbit, Kwitansi: Verifikasi publik
 */
final class Kwitansi extends Resource
{
    /**
     * Hak kwitansi saya
     *
     * atur (hanya pengatur Pustikom: kwitansi.atur global), lihat, global, unit yang boleh diatur/dilihat, pengatur + tautan_pengatur (halaman Kwitansi di Pustikom), daftar varian, variabel catatan, catatan bawaan. Token pengguna aplikasi mana pun; tanpa scope khusus.
     *
     * `GET /v1/kwitansi/saya`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/saya', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan unit penerbit
     *
     * Pengaturan efektif (tersimpan atau bawaan) unit yang boleh diatur/dilihat: jenis, kode awalan nomor, label, varian, warna, judul, kota, jabatan penerima, tanda tangan/stempel (data URI), kaki, tampil logo/QR, boleh_atur.
     *
     * `GET /v1/kwitansi/penerbit`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenerbit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/penerbit', [], $query, null, $options, false, false);
    }

    /**
     * Simpan pengaturan unit penerbit
     *
     * Hanya pengatur Pustikom (kwitansi.atur global); selain itu 403. Body: {"unit_id", "kode_nomor" (2-12 huruf/angka, unik), "label", "varian": "klasik|modern|minimal|a5|arsip|thermal80|thermal58", "warna" (#RRGGBB), "judul", "kota", "jabatan_penerima", "ttd"/"stempel" (data URI PNG/JPG/WebP maks. 400 KB; "" = hapus), "kaki", "tampil_logo", "tampil_qr"}. Tercatat di log.
     *
     * `POST /v1/kwitansi/penerbit`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenerbit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kwitansi/penerbit', [], $query, null, $options, false, false);
    }

    /**
     * Kembalikan pengaturan unit ke bawaan
     *
     * Hanya pengatur Pustikom (kwitansi.atur global).
     *
     * `POST /v1/kwitansi/penerbit/{id}/bawaan`
     *
     * hanya token pengguna
     *
     * @param int|string $id induk_unit.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenerbitByIdBawaan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kwitansi/penerbit/{id}/bawaan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan catatan pembayaran
     *
     * Aturan unit di lingkup + aturan semua unit. ?unit_id= menyaring satu unit (termasuk aturan semua unit). Prioritas: jenis+unit > unit > jenis > bawaan, lalu urutan.
     *
     * `GET /v1/kwitansi/catatan`
     *
     * hanya token pengguna
     *
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCatatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/catatan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah aturan catatan
     *
     * Hanya pengatur Pustikom (kwitansi.atur global). Body: {"id" (ubah), "unit_id" (kosong = semua unit), "jenis_bayar" (idib m_item_biaya, pmb:formulir|pmb:daftar_ulang|pmb:lainnya; kosong = semua jenis), "teks" (maks. 6 baris, variabel {nama} {nomor_induk} {nomor} {tanggal} {jenis_biaya} {periode} {jumlah} {sisa} {batas_tanggal} {unit}), "berlaku_mulai", "berlaku_sampai", "urutan", "aktif"}. Tercatat di log; kwitansi yang sudah terbit tidak berubah.
     *
     * `POST /v1/kwitansi/catatan`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCatatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kwitansi/catatan', [], $query, null, $options, false, false);
    }

    /**
     * Hapus aturan catatan
     *
     * Hanya pengatur Pustikom (kwitansi.atur global).
     *
     * `POST /v1/kwitansi/catatan/{id}/hapus`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCatatanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kwitansi/catatan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau catatan yang berlaku
     *
     * Aturan terpilih untuk unit + jenis + tanggal dan hasil isi variabel dengan data contoh.
     *
     * `GET /v1/kwitansi/catatan/uji`
     *
     * hanya token pengguna
     *
     * @param array{unit_id?: string, jenis_bayar?: string, tanggal?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCatatanUji(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/catatan/uji', [], $query, null, $options, false, false);
    }

    /**
     * Pilihan jenis pembayaran
     *
     * Jenis biaya mahasiswa (m_item_biaya) dan jenis tagihan PMB, untuk aturan catatan.
     *
     * `GET /v1/kwitansi/jenis`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Log perubahan pengaturan kwitansi
     *
     * induk_log modul kwitansi; pengatur Pustikom melihat semua, unit penerbit (kwitansi.lihat) hanya log unitnya.
     *
     * `GET /v1/kwitansi/log`
     *
     * hanya token pengguna · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/log', [], $query, null, $options, false, false);
    }

    /**
     * Kwitansi terbit
     *
     * Kwitansi resmi yang diterbitkan unit di lingkup kwitansi.lihat.
     *
     * `GET /v1/kwitansi/terbit`
     *
     * hanya token pengguna · berhalaman
     *
     * @param array{unit_id?: string, sumber?: string, dari?: string, sampai?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerbit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/terbit', [], $query, null, $options, false, false);
    }

    /**
     * Data cetak kwitansi terbit
     *
     * Bentuk sama dengan /v1/kasir/transaksi/{id}/kwitansi.
     *
     * `GET /v1/kwitansi/terbit/{id}`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerbitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/terbit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat cetak kwitansi
     *
     * Cetak pertama = asli; berikutnya bertanda SALINAN. Mengembalikan {dicetak, salinan}.
     *
     * `POST /v1/kwitansi/terbit/{id}/cetak`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTerbitByIdCetak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kwitansi/terbit/{id}/cetak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Verifikasi kwitansi (JSON)
     *
     * Tanpa token. Hanya nomor bukti, tanggal, jumlah, status (sah/batal), dan penerbit; tanpa data pribadi.
     *
     * `GET /v1/kwitansi/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi 32 karakter
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Halaman verifikasi kwitansi (tujuan QR)
     *
     * Tanpa token. Peramban mendapat halaman HTML; Accept: application/json atau ?format=json mendapat data yang sama dengan /verifikasi/{kode}.
     *
     * `GET /v1/kwitansi/v/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kwitansi/v/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }
}
