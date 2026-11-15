<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Dokumen: Templat, Dokumen: Terbitkan, Dokumen: Arsip terbit, Dokumen: Verifikasi publik
 */
final class Dokumen extends Resource
{
    /**
     * Pilihan templat
     *
     * Publik. Jenis dokumen, ukuran kertas (mm), huruf, gaya garis kop, letak QR, posisi tanda tangan, penanda {..}, dan aturan bawaan. Untuk editor templat di UI.
     *
     * `GET /v1/dokumen/opsi`
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
        return $this->send('GET', '/v1/dokumen/opsi', [], $query, null, $options, false, true);
    }

    /**
     * Daftar templat tersimpan
     *
     * `GET /v1/dokumen/templat`
     *
     * scope: `dokumen:read`
     *
     * @param array{jenis?: string, bagian?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/templat', [], $query, null, $options, false, false);
    }

    /**
     * Tambah templat
     *
     * Body {nama, bagian?, jenis?, keterangan?, pengaturan, aktif?}. Satu templat per bagian + jenis (jenis kosong = semua jenis). Tingkat kampus hanya dokumen:admin; bagian oleh dokumen:admin atau pimpinan/admin unit itu (atau induknya) di arsip_petugas. Gambar (logo, kop gambar, tanda tangan, stempel) = berkas PNG/JPG milik penyimpan atau publik.
     *
     * `POST /v1/dokumen/templat`
     *
     * scope: `dokumen:write`
     *
     * @param array{nama?: string, keterangan?: string, bagian?: string, jenis?: string, pengaturan?: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Templat yang berlaku
     *
     * Gabungan bawaan → kampus → unit induk → bagian (semua jenis lalu jenis ini), `lapis` = templat yang ikut, `data` = nilai penanda {..}.
     *
     * `GET /v1/dokumen/templat/efektif`
     *
     * scope: `dokumen:read`
     *
     * @param array{jenis: string, bagian?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatEfektif(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/templat/efektif', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau PDF templat
     *
     * Body {jenis, bagian?, pengaturan?}: PDF contoh (application/pdf) dengan aturan berlaku + `pengaturan` yang belum disimpan, untuk editor templat langsung.
     *
     * `POST /v1/dokumen/templat/pratinjau`
     *
     * scope: `dokumen:read`
     *
     * @param array{jenis?: string, bagian?: string, pengaturan?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatPratinjau(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat/pratinjau', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail templat
     *
     * `GET /v1/dokumen/templat/{id}`
     *
     * scope: `dokumen:read`
     *
     * @param int|string $id UUID templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/templat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah templat
     *
     * Body sebagian: nama, keterangan, pengaturan (menggantikan seluruh aturan templat ini), aktif.
     *
     * `POST /v1/dokumen/templat/{id}`
     *
     * scope: `dokumen:write`
     *
     * @param int|string $id UUID templat
     * @param array{nama?: string, keterangan?: string, bagian?: string, jenis?: string, pengaturan?: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus templat
     *
     * `POST /v1/dokumen/templat/{id}/hapus`
     *
     * scope: `dokumen:write`
     *
     * @param int|string $id UUID templat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Terbitkan KRS
     *
     * Body {nim, tahun_id?}. Hak sama dengan GET /v1/mahasiswa/{nim}/krs (mahasiswa hanya miliknya). Tanda tangan dosen PA dan mahasiswa.
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/krs`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKrs(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/krs', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan KHS
     *
     * Body {nim, tahun_id?}. Hak sama dengan GET /v1/mahasiswa/{nim}/khs. Nilai yang belum boleh tampil ditulis "-".
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/khs`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKhs(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/khs', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan transkrip nilai
     *
     * Body {nim}. Nilai terbaik tiap mata kuliah, sama dengan GET /v1/mahasiswa/{nim}/transkrip.
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/transkrip`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTranskrip(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/transkrip', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan kwitansi
     *
     * Body {transaksi_id}. Hak sama dengan GET /v1/keuangan/transaksi/{id}/kwitansi.
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/kwitansi`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKwitansi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/kwitansi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan PDF surat keluar
     *
     * Body {surat: id/uuid}. Surat harus sudah disetujui; kop mengikuti unit surat, penandatangan dari surat, tembusan di bawah tanda tangan.
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/surat-keluar`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSuratKeluar(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/surat-keluar', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan dokumen bebas
     *
     * Untuk surat keterangan, sertifikat, berita acara, laporan, undangan, dll. Body {jenis, judul, isi_html, bagian?, subjudul?, nomor?, tanggal?, penandatangan?: [{jabatan, nama, nip, label_nip}], pemilik?, pemilik_nama?, ringkasan? (objek kunci → teks untuk halaman verifikasi), kedaluwarsa? (YYYY-MM-DD), sumber_modul?, sumber_ref?}. Hanya dokumen:admin atau petugas admin/pimpinan/sekretaris unit penerbit. HTML dibersihkan.
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/buat`
     *
     * scope: `dokumen:write`
     *
     * @param array{jenis?: string, judul?: string, subjudul?: string, nomor?: string, tanggal?: string, isi_html?: string, bagian?: string, penandatangan?: list<mixed>, pemilik?: string, pemilik_nama?: string, ringkasan?: array<string, mixed>, kedaluwarsa?: string, sumber_modul?: string, sumber_ref?: string, keluaran?: string, pratinjau?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBuat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/buat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen terbit
     *
     * Admin: semua; petugas unit (dengan `bagian`): dokumen unitnya; lainnya: dokumen miliknya atau yang dibuatnya.
     *
     * `GET /v1/dokumen/terbit`
     *
     * scope: `dokumen:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, status?: string, bagian?: string, pemilik?: string, sumber_modul?: string, sumber_ref?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerbit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/terbit', [], $query, null, $options, false, false);
    }

    /**
     * Detail dokumen terbit
     *
     * `GET /v1/dokumen/terbit/{id}`
     *
     * scope: `dokumen:read`
     *
     * @param int|string $id UUID dokumen
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerbitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/terbit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh PDF
     *
     * PDF dari penyimpanan (atau 302 ke URL sementara bucket). `?unduh=1` sebagai attachment.
     *
     * `GET /v1/dokumen/terbit/{id}/unduh`
     *
     * scope: `dokumen:read`
     *
     * @param int|string $id UUID dokumen
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerbitByIdUnduh(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/terbit/{id}/unduh', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan dokumen
     *
     * Body {alasan}. Halaman verifikasi akan menyatakan dokumen dibatalkan. Oleh dokumen:admin atau pimpinan/admin unit penerbit.
     *
     * `POST /v1/dokumen/terbit/{id}/batal`
     *
     * scope: `dokumen:write`
     *
     * @param int|string $id UUID dokumen
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTerbitByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/terbit/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Halaman verifikasi (tujuan QR)
     *
     * Tanpa token. Peramban mendapat halaman HTML; `Accept: application/json` atau `?format=json` mendapat data. Nama pemilik dan NIM disamarkan.
     *
     * `GET /v1/dokumen/v/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi 12 karakter (tanda - boleh)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/v/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Verifikasi kode (JSON)
     *
     * Tanpa token. `sah` false bila dibatalkan, diganti versi baru, atau kedaluwarsa; `pesan` menjelaskan.
     *
     * `GET /v1/dokumen/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Cocokkan file PDF
     *
     * Tanpa token. Multipart `berkas` (PDF, maks. 20 MB) atau JSON `berkas_base64`, opsional `kode`. Membandingkan SHA-256 file dengan catatan terbit: mendeteksi PDF yang diubah walau QR-nya asli.
     *
     * `POST /v1/dokumen/verifikasi`
     *
     * publik (tanpa token)
     *
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, berkas_base64?: string, kode?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVerifikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/verifikasi', [], $options['query'] ?? [], $body, $options, true, true);
    }
}
