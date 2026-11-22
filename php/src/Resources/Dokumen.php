<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Dokumen: Templat, Dokumen: Templat Word, Dokumen: Terbitkan, Dokumen: Desain KTM, Dokumen: Arsip terbit, Dokumen: Verifikasi publik
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
     * Daftar templat Word
     *
     * Templat .docx semua bagian (atau `bagian` tertentu), jenis yang mendukung placeholder, dan `pdf_tersedia` (LibreOffice di server; tanpa itu dokumen terbit sebagai .docx).
     *
     * `GET /v1/dokumen/templat-docx`
     *
     * scope: `dokumen:read`
     *
     * @param array{jenis?: string, bagian?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatDocx(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/templat-docx', [], $query, null, $options, false, false);
    }

    /**
     * Unggah templat Word
     *
     * Multipart `berkas` (.docx, maks. 10 MB) + `jenis`, `nama?`, `bagian?` (kosong = kampus), `keterangan?`, `aktif?` (bawaan true; mengaktifkan menonaktifkan templat lain bagian + jenis yang sama). Placeholder di berkas dibaca dan dilaporkan (`penanda`, `penanda_tidak_dikenal`). Hak: admin dokumen, pimpinan/admin unit, atau pengelola akademik (BAAK untuk tingkat kampus; prodi untuk unit prodinya).
     *
     * `POST /v1/dokumen/templat-docx`
     *
     * scope: `dokumen:write`
     *
     * @param array<string, mixed> $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatDocx(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat-docx', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Daftar placeholder
     *
     * Placeholder {..} per jenis, dikelompokkan, dengan contoh nilai. Baris tabel berulang memakai {mk.kode}, {mk.nama}, ...; gambar QR {qr} atau {qr:30} (mm).
     *
     * `GET /v1/dokumen/templat-docx/penanda`
     *
     * scope: `dokumen:read`
     *
     * @param array{jenis: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatDocxPenanda(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/templat-docx/penanda', [], $query, null, $options, false, false);
    }

    /**
     * Unduh berkas contoh .docx
     *
     * Berkas Word awal berisi placeholder untuk jenis ini; ubah desainnya di Word lalu unggah.
     *
     * `GET /v1/dokumen/templat-docx/contoh`
     *
     * scope: `dokumen:read`
     *
     * @param array{jenis: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatDocxContoh(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/templat-docx/contoh', [], $query, null, $options, false, false);
    }

    /**
     * Periksa berkas Word
     *
     * Multipart `berkas` (.docx, maks. 10 MB) + `jenis`. Tidak disimpan: mengembalikan placeholder yang ditemukan, yang dikenali untuk jenis ini (dengan label), yang tidak dikenal, serta ada/tidaknya QR dan baris tabel berulang. Untuk wizard unggah.
     *
     * `POST /v1/dokumen/templat-docx/periksa`
     *
     * scope: `dokumen:read`
     *
     * @param array<string, mixed> $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatDocxPeriksa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat-docx/periksa', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Ubah templat Word
     *
     * Body {nama?, keterangan?, aktif?}.
     *
     * `POST /v1/dokumen/templat-docx/{id}`
     *
     * scope: `dokumen:write`
     *
     * @param int|string $id UUID templat Word
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatDocxById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat-docx/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus templat Word
     *
     * `POST /v1/dokumen/templat-docx/{id}/hapus`
     *
     * scope: `dokumen:write`
     *
     * @param int|string $id UUID templat Word
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatDocxByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat-docx/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh berkas templat Word
     *
     * `GET /v1/dokumen/templat-docx/{id}/unduh`
     *
     * scope: `dokumen:read`
     *
     * @param int|string $id UUID templat Word
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplatDocxByIdUnduh(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/templat-docx/{id}/unduh', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau templat Word
     *
     * Body {nim?, tahun_id?}: dengan NIM memakai data mahasiswa itu, tanpa NIM memakai data contoh. Tidak disimpan. PDF bila LibreOffice ada (header X-Format), selain itu .docx.
     *
     * `POST /v1/dokumen/templat-docx/{id}/pratinjau`
     *
     * scope: `dokumen:read`
     *
     * @param int|string $id UUID templat Word
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemplatDocxByIdPratinjau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/templat-docx/{id}/pratinjau', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Terbitkan KRS
     *
     * Body {nim, tahun_id?}. Hak sama dengan GET /v1/mahasiswa/{nim}/krs (mahasiswa hanya miliknya). Tanda tangan dosen PA dan mahasiswa. Aturan dinamis titik `krs.cetak` (/v1/aturan) diperiksa setelah hak akses; pelanggaran 409 aturan_dilanggar.
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
     * Body {nim, tahun_id?}. Hak sama dengan GET /v1/mahasiswa/{nim}/khs. Nilai yang belum boleh tampil ditulis "-". Scope sempit `dokumen:khs-saya`: hanya mahasiswa pemilik token (nim = dirinya, selain itu 403), `bagian` diabaikan. Aturan dinamis titik `khs.lihat` dan `khs.cetak` (/v1/aturan) diperiksa setelah hak akses; pelanggaran 409 aturan_dilanggar.
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
     * Body {nim}. Nilai terbaik tiap mata kuliah, sama dengan GET /v1/mahasiswa/{nim}/transkrip. Aturan dinamis titik `transkrip.cetak` (/v1/aturan) diperiksa setelah hak akses; pelanggaran 409 aturan_dilanggar.
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
     * Terbitkan ijazah
     *
     * Body {nim}. Hanya pengelola kelulusan (BAAK); mahasiswa harus berstatus lulus. Memakai templat Word ijazah aktif bila ada (placeholder {nomor_ijazah}, {nomor_sk}, {gelar}, ...), selain itu desain bawaan.
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/ijazah`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIjazah(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/ijazah', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan kartu ujian
     *
     * Body {nim, tahun_id?, ujian? (UTS/UAS; kosong = ujian yang sedang berlangsung)}. Hanya saat masa ujian berlangsung dan mahasiswa boleh mencetak (syarat pembayaran/presensi SIAKAD + aturan dinamis ujian.uts/ujian.uas); selain itu 409. Oleh mahasiswa sendiri, admin dokumen, atau pengelola akademik prodinya. Templat Word kartu_ujian dipakai bila aktif (baris {uj.*} diulang per mata kuliah).
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/kartu-ujian`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKartuUjian(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/kartu-ujian', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan KTM
     *
     * Body {nim}. Kartu depan + belakang dengan pas foto dan QR verifikasi; KTM lama mahasiswa itu ditandai diganti, kedaluwarsa = masa berlaku (batas studi). Templat Word KTM aktif diutamakan; selain itu desain KTM aktif (prodi → fakultas → kampus) atau desain bawaan. Oleh mahasiswa sendiri, admin dokumen, atau pengelola akademik prodinya.
     * Body umum: `keluaran` `json` (bawaan: data dokumen terbit + `url_verifikasi`; `sertakan_pdf: true` menambah `pdf_base64`)
     * atau `pdf` (application/pdf langsung, header `X-Dokumen-Id` dan `X-Kode-Verifikasi`), `unduh: true` (attachment),
     * `pratinjau: true` (PDF bertanda air PRATINJAU, tidak disimpan, tidak dicatat), `bagian` (kode unit penerbit; bawaan
     * menurut aturan `bagian_penerbit` templat kampus jenis ini, lalu prodi mahasiswa/unit surat).
     *
     * PDF tersimpan di berkas terpusat (kategori `dokumen`) dan tercatat di arsip terbit. Menerbitkan ulang dokumen yang sama
     * (mis. KRS NIM + periode yang sama) menandai versi lama `diganti`.
     *
     * `POST /v1/dokumen/ktm`
     *
     * scope: `dokumen:write`
     *
     * @param array{nim?: string, tahun_id?: string, transaksi_id?: int, surat?: string, bagian?: string, keluaran?: string, unduh?: bool, pratinjau?: bool, sertakan_pdf?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKtm(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/ktm', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat KTM massal
     *
     * Body {prodi?, angkatan?, status? (A = aktif bawaan, `semua`), nim?: list (maks. 300), tata?: `kartu` (halaman seukuran kartu) | `a4` (10 kartu per lembar, belakang dicerminkan untuk cetak bolak-balik), hitung?: true}. `hitung` hanya mengembalikan {jumlah}. Setiap kartu dicatat dengan QR sendiri. Keluaran application/pdf (header X-Jumlah); bila templat Word KTM aktif, application/zip berisi KTM per mahasiswa. Hanya admin dokumen atau pengelola akademik (prodi kelolaan).
     *
     * `POST /v1/dokumen/ktm/massal`
     *
     * scope: `dokumen:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKtmMassal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/ktm/massal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Desain KTM
     *
     * Desain tersimpan (atau `bagian` tertentu), desain bawaan siap pakai, katalog penanda {..} KTM, data contoh, pilihan huruf, ukuran kartu (mm), dan templat Word KTM yang aktif (bila ada, diutamakan saat buat KTM).
     *
     * `GET /v1/dokumen/desain-kartu`
     *
     * scope: `dokumen:read`
     *
     * @param array{bagian?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDesainKartu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/desain-kartu', [], $query, null, $options, false, false);
    }

    /**
     * Simpan desain KTM baru
     *
     * Body {nama, bagian?, keterangan?, desain: {orientasi: lanskap|potret, huruf, depan: {latar: {warna, warna2?, arah: polos|horizontal|vertikal|diagonal, gambar?: uuid}, elemen: [{id, jenis: teks|foto|qr|logo|gambar|kotak, x, y, w, h (mm), teks?, ukuran? (pt), warna?, tebal?, miring?, kapital?, rata?, latar?, garis?, sudut?, opasitas?, gambar?}]}, belakang: {...}}, aktif? (bawaan true; menonaktifkan desain lain bagian yang sama)}. Hak sama dengan templat Word KTM.
     *
     * `POST /v1/dokumen/desain-kartu`
     *
     * scope: `dokumen:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDesainKartu(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/desain-kartu', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pratinjau desain KTM
     *
     * Body {desain?: objek belum disimpan, id?: desain tersimpan, nim?, tata?: kartu|a4}. PDF (application/pdf) dengan data contoh atau data mahasiswa itu; QR menuju kode PRATINJAU. Tidak disimpan.
     *
     * `POST /v1/dokumen/desain-kartu/pratinjau`
     *
     * scope: `dokumen:read`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDesainKartuPratinjau(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/desain-kartu/pratinjau', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail desain KTM
     *
     * `GET /v1/dokumen/desain-kartu/{id}`
     *
     * scope: `dokumen:read`
     *
     * @param int|string $id UUID desain kartu
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDesainKartuById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/dokumen/desain-kartu/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah desain KTM
     *
     * Body sebagian: nama, keterangan, desain (menggantikan seluruh desain), aktif.
     *
     * `POST /v1/dokumen/desain-kartu/{id}`
     *
     * scope: `dokumen:write`
     *
     * @param int|string $id UUID desain kartu
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDesainKartuById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/desain-kartu/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus desain KTM
     *
     * `POST /v1/dokumen/desain-kartu/{id}/hapus`
     *
     * scope: `dokumen:write`
     *
     * @param int|string $id UUID desain kartu
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDesainKartuByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/dokumen/desain-kartu/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
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
     * Admin: semua; petugas unit (dengan `bagian`): dokumen unitnya; lainnya: dokumen miliknya atau yang dibuatnya. Scope sempit `dokumen:khs-saya`: hanya KHS milik pemilik token.
     *
     * `GET /v1/dokumen/terbit`
     *
     * scope: `dokumen:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, status?: string, bagian?: string, pemilik?: string, sumber_modul?: string, sumber_ref?: string, q?: string, lingkup?: string, prodi?: string, dari?: string, sampai?: string, ...} $query
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
     * Scope sempit `dokumen:khs-saya`: hanya KHS milik pemilik token (selain itu 403).
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
     * PDF dari penyimpanan (atau 302 ke URL sementara bucket). `?unduh=1` sebagai attachment. Scope sempit `dokumen:khs-saya`: hanya KHS milik pemilik token.
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
