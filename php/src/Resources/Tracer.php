<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Tracer Study: kuesioner, Tracer Study: periode & responden, Tracer Study: pengisian, Tracer Study: dasbor & dosen, Tracer Study: alumni, Tracer Study: referensi & karir, Tracer Study: publikasi, Tracer Study: aturan IKU 1
 */
final class Tracer extends Resource
{
    /**
     * Daftar kuesioner
     *
     * Termasuk kuesioner standar Kemdikbud 2021 (alumni) dan survei pengguna lulusan yang dipasang migration.
     *
     * `GET /v1/tracer/kuesioner`
     *
     * scope: `tracer:read`
     *
     * @param array{jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKuesioner(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/kuesioner', [], $query, null, $options, false, false);
    }

    /**
     * Buat kuesioner kustom
     *
     * Body: kode, versi, nama, jenis, deskripsi, dan opsional `bagian` (struktur lengkap, format sama dengan respons struktur).
     *
     * `POST /v1/tracer/kuesioner`
     *
     * scope: `tracer:manage`
     *
     * @param array{kode: string|null, versi?: string|null, nama: string|null, jenis?: string|null, deskripsi?: string|null, aktif?: bool, bagian?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKuesioner(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/kuesioner', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Struktur kuesioner
     *
     * Bagian, pertanyaan (kode, tipe, wajib, kondisi tampil, validasi), dan opsi jawaban.
     *
     * `GET /v1/tracer/kuesioner/{id}`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID kuesioner
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKuesionerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/kuesioner/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kuesioner
     *
     * Mengirim `bagian` mengganti seluruh struktur, hanya selama kuesioner belum punya jawaban. Setelah dipakai, buat versi baru dengan /salin.
     *
     * `PUT /v1/tracer/kuesioner/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID kuesioner
     * @param array{kode: string|null, versi?: string|null, nama: string|null, jenis?: string|null, deskripsi?: string|null, aktif?: bool, bagian?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKuesionerById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/kuesioner/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kuesioner
     *
     * Hanya bila belum dipakai periode dan belum punya jawaban.
     *
     * `DELETE /v1/tracer/kuesioner/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID kuesioner
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKuesionerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/kuesioner/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Salin ke versi baru
     *
     * Body: {"versi": "2027"}.
     *
     * `POST /v1/tracer/kuesioner/{id}/salin`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID kuesioner
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKuesionerByIdSalin(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/kuesioner/{id}/salin', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar periode survei
     *
     * Beserta jumlah sasaran, jumlah selesai, dan tingkat respons.
     *
     * `GET /v1/tracer/periode`
     *
     * scope: `tracer:read`
     *
     * @param array{status?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/periode', [], $query, null, $options, false, false);
    }

    /**
     * Buat periode survei
     *
     * Contoh tracer study tahunan: lulusan 1 tahun sebelumnya (TS-1).
     * `{"kode": "TS2026", "nama": "Tracer Study 2026 (lulusan 2025)", "kuesioner_id": 1, "tahun_pelaporan": 2026,
     * "lulus_dari": "2025-01-01", "lulus_sampai": "2025-12-31", "mulai": "2026-02-01", "selesai": "2026-08-31", "status": "aktif", "target_persen": 50}`
     *
     * `POST /v1/tracer/periode`
     *
     * scope: `tracer:manage`
     *
     * @param array{kode: string|null, nama: string|null, kuesioner_id: int|null, tahun_pelaporan?: int|null, lulus_dari?: string|null, lulus_sampai?: string|null, prodi?: list<mixed>, sasaran_angkatan?: list<mixed>, sasaran_tahun_lulus?: list<mixed>, mulai?: string|null, selesai?: string|null, status?: string|null, target_persen?: int|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail periode
     *
     * `GET /v1/tracer/periode/{id}`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah periode
     *
     * Kirim field yang diubah saja. Status `aktif` membuka pengisian (dalam rentang mulai-selesai).
     *
     * `PUT /v1/tracer/periode/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID periode
     * @param array{kode: string|null, nama: string|null, kuesioner_id: int|null, tahun_pelaporan?: int|null, lulus_dari?: string|null, lulus_sampai?: string|null, prodi?: list<mixed>, sasaran_angkatan?: list<mixed>, sasaran_tahun_lulus?: list<mixed>, mulai?: string|null, selesai?: string|null, status?: string|null, target_persen?: int|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus periode
     *
     * Hanya bila belum ada responden yang selesai.
     *
     * `DELETE /v1/tracer/periode/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tarik sasaran dari SIAKAD
     *
     * Periode pengguna lulusan: satu penilai per alumni yang sedang bekerja (bukan wirausaha), memakai kontak HRD/atasan instansinya (`kontak_email`, atau email instansi); jawaban juga menghitung `tanpa_kontak` dan `tanpa_instansi`. Periode alumni: menambahkan semua lulusan (t_mahasiswa_status_lulus_do status L) sesuai prodi, `sasaran_angkatan` (tahun masuk), `sasaran_tahun_lulus`, dan rentang `lulus_dari`-`lulus_sampai` periode (yang diisi berlaku bersamaan) sebagai responden. Aman diulang: yang sudah ada dilewati. Alumni yang menolak dihubungi (profil) tidak ditambahkan.
     *
     * `POST /v1/tracer/periode/{id}/sasaran`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdSasaran(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/periode/{id}/sasaran', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar responden
     *
     * Email/HP hanya dengan scope tracer:pii.
     *
     * `GET /v1/tracer/periode/{id}/responden`
     *
     * scope: `tracer:read` · berhalaman
     *
     * @param int|string $id ID periode
     * @param array{status?: string, prodi?: string, tahun_lulus?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdResponden(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/periode/{id}/responden', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah responden
     *
     * Periode alumni: `{"nim": "..."}`.
     * Periode pengguna lulusan: `{"instansi_id": 3, "nim": "<alumni yang dinilai>", "pekerjaan_id": 10, "nama": "Nama atasan", "jabatan": "HRD", "email": "..."}`.
     *
     * `POST /v1/tracer/periode/{id}/responden`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID periode
     * @param array{nim?: string|null, instansi_id?: int|null, pekerjaan_id?: int|null, nama?: string|null, jabatan?: string|null, email?: string|null, hp?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdResponden(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/periode/{id}/responden', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat token undangan massal
     *
     * Membuat token undangan untuk responden yang belum selesai (default: hanya yang belum punya token atau tokennya kedaluwarsa;
     * `"ganti_semua": true` mengganti semua). Respons berisi token asli, email, dan HP untuk dikirim aplikasi tracer
     * (email/WhatsApp) sebagai tautan `https://alumni.unipo.ac.id/isi/<token>`. SIAKAD hanya menyimpan hash token.
     * Body: `{"berlaku_hari": 60, "ganti_semua": false}`. Maksimal 5000 per panggilan.
     *
     * `POST /v1/tracer/periode/{id}/token`
     *
     * scope: `tracer:manage`, `tracer:pii`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdToken(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/periode/{id}/token', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Impor hasil tracerstudy.kemdiktisaintek.go.id
     *
     * Untuk kampus yang mengumpulkan jawaban alumni di situs tracer study nasional. Unduh data dari dasbor PT, simpan sebagai
     * CSV (Excel: Save As > CSV UTF-8), lalu unggah di field `file` (maks. 5 MB, 5000 baris). Kolom dikenali dari judul:
     * `nimhsmsmh` (wajib), `emailmsmh`, `telpomsmh`, dan kode pertanyaan (f8, f502, f505, f1761, ...); pilihan ganda dari kolom
     * 0/1 (f401-f415, f1601-f1613), isian "Lainnya" dari f416/f1102/f1202/f1614. Kolom lain diabaikan.
     *
     * Tiap baris diproses seperti kirim final (validasi dan logika tampil yang sama) lalu memperbarui profil dan karir alumni.
     * Baris yang belum lengkap disimpan sebagai draf (`belum_lengkap`); NIM yang bukan lulusan atau nilai tidak valid
     * dilaporkan di `gagal`. Aman diulang. Untuk jumlah kecil boleh JSON `{"data": [{"nimhsmsmh": "...", "f8": "1"}]}`.
     *
     * `POST /v1/tracer/periode/{id}/impor`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID periode alumni
     * @param array{file: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdImpor(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/periode/{id}/impor', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Rekap dan indikator
     *
     * Tingkat respons per status dan prodi, sebaran setiap pertanyaan pilihan/skala, statistik pertanyaan angka.
     * Untuk kuesioner berkode Kemdikbud ditambah `indikator`: status (F8), waktu tunggu, pendapatan, keselarasan horizontal (F14)
     * dan vertikal (F15), tingkat tempat kerja (F5d, untuk LKPS), kesenjangan kompetensi (F17), dan komponen IKU 1
     * (butuh data UMP: PUT /v1/tracer/ump). Periode pengguna lulusan: sebaran tiap aspek kepuasan dalam persen.
     *
     * `GET /v1/tracer/periode/{id}/rekap`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID periode
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdRekap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/periode/{id}/rekap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Target tingkat respons per prodi
     *
     * `bawaan_persen` = target bawaan universitas periode ini (sama dengan `target_persen` periode). Tiap prodi sasaran (dalam
     * batas prodi token) berisi `target_prodi` (target khusus prodi, null bila tidak diatur), `target_persen` yang berlaku
     * (`target_sumber`: prodi atau bawaan), sasaran, selesai, dan tingkat respons. `boleh_ubah`/`boleh_ubah_bawaan` untuk tampilan.
     *
     * `GET /v1/tracer/periode/{id}/target`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdTarget(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/periode/{id}/target', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Atur target tingkat respons
     *
     * Body `{"bawaan_persen": 50, "prodi": [{"kode_prodi": "86206", "target_persen": 60}, {"kode_prodi": "57201", "target_persen": null}]}`;
     * keduanya opsional. `target_persen` null menghapus target prodi sehingga prodi kembali memakai bawaan. Bawaan universitas hanya
     * untuk pengelola tanpa batas prodi (BAK/admin/tim tracer universitas); tim tracer berlingkup unit hanya prodi dalam lingkupnya
     * (403 di luar itu). Periode ditutup: 409. Perubahan dicatat di jejak audit. Jawaban sama dengan GET.
     *
     * `PUT /v1/tracer/periode/{id}/target`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID periode
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeByIdTarget(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/periode/{id}/target', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ekspor jawaban (format Kemdikbud)
     *
     * Satu baris per responden yang selesai (`semua=1`: semua responden). Kolom identitas dan kode pertanyaan sama dengan template
     * unggah tracerstudy.kemdikbud.go.id; pilihan ganda menjadi kolom 0/1 per opsi (f401-f415, f1601-f1613).
     * `format=csv` mengembalikan file CSV (UTF-8 BOM, siap dibuka Excel); default JSON dengan `meta.kolom`.
     *
     * `GET /v1/tracer/periode/{id}/ekspor`
     *
     * scope: `tracer:read`, `tracer:pii`
     *
     * @param int|string $id ID periode
     * @param array{format?: string, prodi?: string, semua?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdEkspor(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/periode/{id}/ekspor', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail responden dan jawabannya
     *
     * `GET /v1/tracer/responden/{id}`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID responden
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRespondenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/responden/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kontak/status responden
     *
     * Field: email, hp, nama, jabatan (pengguna), status (belum, diundang, menolak).
     *
     * `PUT /v1/tracer/responden/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID responden
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRespondenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/responden/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus responden
     *
     * Tidak bisa untuk responden yang sudah selesai.
     *
     * `DELETE /v1/tracer/responden/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID responden
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRespondenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/responden/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat token undangan satu responden
     *
     * Token lama otomatis tidak berlaku. Body: {"berlaku_hari": 60}. Token asli hanya ditampilkan sekali.
     *
     * `POST /v1/tracer/responden/{id}/token`
     *
     * scope: `tracer:manage`, `tracer:pii`
     *
     * @param int|string $id ID responden
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRespondenByIdToken(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/responden/{id}/token', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat pengiriman undangan/pengingat
     *
     * Aplikasi tracer yang mengirim email/WhatsApp mencatat hasilnya di sini. Body: {"jenis": "undangan|pengingat|terima_kasih", "saluran": "email|whatsapp|sms|lainnya", "status": "terkirim|gagal|antri", "tujuan", "galat"}.
     *
     * `POST /v1/tracer/responden/{id}/kirim`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID responden
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRespondenByIdKirim(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/responden/{id}/kirim', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi/koreksi jawaban oleh petugas
     *
     * Untuk survei lewat telepon atau koreksi. Body sama dengan pengisian; tambah `"kirim": true` untuk menandai selesai. Tidak dibatasi jadwal periode.
     *
     * `PUT /v1/tracer/responden/{id}/jawaban`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID responden
     * @param array{jawaban: array<string, mixed>, teks_lain?: array<string, mixed>, kirim?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRespondenByIdJawaban(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/responden/{id}/jawaban', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buka formulir dari tautan undangan
     *
     * Dipanggil aplikasi tracer (token klien dengan scope tracer:respond) saat alumni atau pengguna lulusan membuka tautan undangan.
     * Mengembalikan responden, periode (`bisa_diisi`), struktur kuesioner, jawaban tersimpan, dan daftar kode yang `terlihat`
     * menurut kondisi. Status responden berubah menjadi `dibuka`.
     *
     * `GET /v1/tracer/isi/{token}`
     *
     * scope: `tracer:respond`
     *
     * @param int|string $token Token undangan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIsiByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/isi/{token}', ['token' => $token], $query, null, $options, false, false);
    }

    /**
     * Simpan draf jawaban
     *
     * Boleh sebagian. Nilai null/"" menghapus jawaban. Format nilai mengikuti tipe pertanyaan (lihat skema TracerJawabanInput).
     *
     * `PUT /v1/tracer/isi/{token}`
     *
     * scope: `tracer:respond`
     *
     * @param int|string $token Token undangan
     * @param array{jawaban: array<string, mixed>, teks_lain?: array<string, mixed>, kirim?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putIsiByToken(int|string $token, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/isi/{token}', ['token' => $token], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim jawaban final
     *
     * Menyimpan jawaban di body (boleh kosong bila sudah disimpan sebagai draf), lalu memeriksa semua pertanyaan wajib yang tampil.
     * Galat 422 berisi daftar kode yang belum diisi. Jawaban pertanyaan yang tidak tampil dibuang. Untuk alumni, profil
     * (email, HP, status), riwayat pekerjaan, dan studi lanjut ikut diperbarui. Boleh dikirim ulang selama periode aktif.
     *
     * `POST /v1/tracer/isi/{token}/kirim`
     *
     * scope: `tracer:respond`
     *
     * @param int|string $token Token undangan
     * @param array{jawaban: array<string, mixed>, teks_lain?: array<string, mixed>, kirim?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIsiByTokenKirim(int|string $token, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/isi/{token}/kirim', ['token' => $token], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Responden menolak mengisi
     *
     * `POST /v1/tracer/isi/{token}/tolak`
     *
     * scope: `tracer:respond`
     *
     * @param int|string $token Token undangan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIsiByTokenTolak(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/isi/{token}/tolak', ['token' => $token], $query, null, $options, false, false);
    }

    /**
     * Survei untuk alumni yang login
     *
     * Token pengguna MAHASISWA (alumni), atau token aplikasi tracer (tracer:alumni) dengan header `X-Tracer-Alumni: <nim>` untuk alumni yang sudah diverifikasinya. Daftar periode alumni aktif yang ditujukan untuknya beserta status pengisiannya.
     *
     * `GET /v1/tracer/saya`
     *
     * scope: `tracer:respond`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/saya', [], $query, null, $options, false, false);
    }

    /**
     * Atasan/HRD yang menilai alumni ini
     *
     * Penilai survei pengguna lulusan untuk alumni yang login (dari pengelola atau usulan alumni sendiri) beserta status pengisiannya. Tanpa token.
     *
     * `GET /v1/tracer/saya/penilai`
     *
     * scope: `tracer:respond`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPenilai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/saya/penilai', [], $query, null, $options, false, false);
    }

    /**
     * Alumni mengusulkan atasan/HRD sebagai penilai
     *
     * Alumni yang login mengusulkan atasannya untuk survei pengguna lulusan yang sedang berjalan (periode `pengguna` aktif yang
     * cocok dengan prodi, angkatan, dan tahun lulusnya). Instansi diambil dari pekerjaan yang dipilih; bila belum terdaftar,
     * dicocokkan dengan nama atau dibuat sebagai instansi belum terverifikasi. Responden dicatat dengan `sumber = mandiri`.
     *
     * Jawaban berisi `token` undangan satu kali: aplikasi tracer langsung mengirimkannya ke email/WhatsApp atasan dan tidak
     * meneruskannya ke browser alumni. Maksimal 5 usulan per alumni per hari.
     *
     * `POST /v1/tracer/saya/penilai`
     *
     * scope: `tracer:respond`
     *
     * @param array{pekerjaan_id: int|null, nama: string|null, jabatan?: string|null, email: string|null, hp?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPenilai(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/saya/penilai', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buka formulir (alumni login)
     *
     * Alumni otomatis didaftarkan sebagai responden bila belum ada.
     *
     * `GET /v1/tracer/saya/{periode_id}`
     *
     * scope: `tracer:respond`
     *
     * @param int|string $periode_id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaByPeriodeId(int|string $periode_id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/saya/{periode_id}', ['periode_id' => $periode_id], $query, null, $options, false, false);
    }

    /**
     * Simpan draf (alumni login)
     *
     * `PUT /v1/tracer/saya/{periode_id}`
     *
     * scope: `tracer:respond`
     *
     * @param int|string $periode_id ID periode
     * @param array{jawaban: array<string, mixed>, teks_lain?: array<string, mixed>, kirim?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSayaByPeriodeId(int|string $periode_id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/saya/{periode_id}', ['periode_id' => $periode_id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim final (alumni login)
     *
     * `POST /v1/tracer/saya/{periode_id}/kirim`
     *
     * scope: `tracer:respond`
     *
     * @param int|string $periode_id ID periode
     * @param array{jawaban: array<string, mixed>, teks_lain?: array<string, mixed>, kirim?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaByPeriodeIdKirim(int|string $periode_id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/saya/{periode_id}/kirim', ['periode_id' => $periode_id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Statistik alumni
     *
     * Jumlah lulusan, status terkini (F8) dari profil alumni, per tahun lulus, per prodi, 10 instansi terbanyak, dan lowongan aktif. Token PROGDI/klien berbatas prodi hanya prodinya. Tanpa data pribadi, aman untuk halaman depan aplikasi tracer.
     *
     * `GET /v1/tracer/statistik`
     *
     * scope: `tracer:read`
     *
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Dasbor dosen
     *
     * Token pengguna dosen (level DOSEN atau PROGDI, username = NIDN). Berisi identitas dosen, statistik alumni prodi homebase
     * (`m_dosen.kode_prodi`), keterisian periode tracer untuk prodi itu, dan ringkasan alumni bimbingan: mahasiswa yang
     * dosen PA-nya dia (`m_mahasiswa.NIDN_pa`) atau dibimbing tugas akhirnya (`t_mahasiswa_ta.pembimbing_1/2`). Tanpa kontak pribadi.
     *
     * `GET /v1/tracer/dosen`
     *
     * scope: `tracer:dosen`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDosen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/dosen', [], $query, null, $options, false, false);
    }

    /**
     * Alumni bimbingan dosen
     *
     * Status karier terkini, instansi dan jabatan saat ini. Tanpa kontak pribadi.
     *
     * `GET /v1/tracer/dosen/alumni`
     *
     * scope: `tracer:dosen` · berhalaman
     *
     * @param array{relasi?: string, tahun_lulus?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDosenAlumni(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/dosen/alumni', [], $query, null, $options, false, false);
    }

    /**
     * Rekap periode untuk prodi dosen
     *
     * Sama dengan /v1/tracer/periode/{id}/rekap, dibatasi prodi homebase dosen. Periode draf tidak tampil.
     *
     * `GET /v1/tracer/dosen/rekap/{periode_id}`
     *
     * scope: `tracer:dosen`
     *
     * @param int|string $periode_id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDosenRekapByPeriodeId(int|string $periode_id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/dosen/rekap/{periode_id}', ['periode_id' => $periode_id], $query, null, $options, false, false);
    }

    /**
     * Direktori alumni
     *
     * Hanya alumni yang memilih tampil di direktori (profil `tampil_direktori`). Nama, prodi, tahun lulus, pekerjaan saat ini, LinkedIn/situs; tanpa NIM dan kontak. Untuk alumni (token MAHASISWA atau X-Tracer-Alumni) dan pemegang tracer:read.
     *
     * `GET /v1/tracer/direktori`
     *
     * berhalaman
     *
     * @param array{prodi?: string, tahun_lulus?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDirektori(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/direktori', [], $query, null, $options, false, false);
    }

    /**
     * Verifikasi alumni tanpa akun SIAKAD
     *
     * Untuk alumni yang akun SIAKAD-nya sudah tidak aktif atau lupa password. Aplikasi tracer mengirim
     * `{"nim": "...", "tanggal_lahir": "YYYY-MM-DD", "nik": "16 digit"}`; bila cocok dengan data lulusan, respons berisi identitas dan kontak
     * tercatat (email/HP dari profil tracer lalu SIAKAD). Dengan `nik` yang cocok (`nik_cocok: true`; NIK dari m_mahasiswa, atau dari
     * profil tracer bila di SIAKAD kosong) aplikasi boleh langsung membuat sesi. `no_ijazah` (`ijazah_cocok`) masih diterima untuk
     * klien lama. Tanpa keduanya aplikasi wajib mengirim kode OTP dulu. NIK/nomor ijazah yang belum tercatat = 409. Setelah itu aplikasi memanggil
     * endpoint alumni (`/v1/tracer/saya/*`, `/v1/tracer/alumni/{nim}/*`, direktori) dengan header `X-Tracer-Alumni: <nim>`;
     * SIAKAD hanya mengizinkan data NIM itu. Batas 5 percobaan per NIM per jam. Tidak cocok = 404.
     *
     * `POST /v1/tracer/alumni-akses/verifikasi`
     *
     * scope: `tracer:alumni`, `tracer:pii`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniAksesVerifikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni-akses/verifikasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar alumni
     *
     * Lulusan SIAKAD (status L) beserta status terkini dari tracer study.
     *
     * `GET /v1/tracer/alumni`
     *
     * scope: `tracer:read` · berhalaman
     *
     * @param array{prodi?: string, tahun_lulus?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlumni(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/alumni', [], $query, null, $options, false, false);
    }

    /**
     * Profil alumni
     *
     * Profil, riwayat pekerjaan, studi lanjut, dan riwayat survei. Token MAHASISWA: hanya dirinya; lainnya butuh tracer:read (kontak: tracer:pii).
     *
     * `GET /v1/tracer/alumni/{nim}`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlumniByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/alumni/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Ubah profil alumni (POST)
     *
     * Sama dengan PUT, untuk hosting yang menolak PUT. Juga menerima nik, npwp, kode_pos, dan koreksi_data (permohonan koreksi data SIAKAD; m_mahasiswa tidak diubah).
     *
     * `POST /v1/tracer/alumni/{nim}/profil`
     *
     * @param int|string $nim NIM
     * @param array{email?: string|null, hp?: string|null, alamat?: string|null, kode_propinsi?: string|null, kode_kabupaten?: string|null, linkedin?: string|null, situs?: string|null, bersedia_dihubungi?: bool, tampil_direktori?: bool, persetujuan?: bool, nik?: string|null, npwp?: string|null, kode_pos?: string|null, koreksi_data?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimProfil(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/profil', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah profil alumni
     *
     * Field: email, hp, alamat, kode_propinsi, kode_kabupaten, linkedin, situs, bersedia_dihubungi, tampil_direktori, persetujuan (alumni sendiri). Data m_mahasiswa tidak diubah. Alumni sendiri atau tracer:manage.
     *
     * `PUT /v1/tracer/alumni/{nim}/profil`
     *
     * @param int|string $nim NIM
     * @param array{email?: string|null, hp?: string|null, alamat?: string|null, kode_propinsi?: string|null, kode_kabupaten?: string|null, linkedin?: string|null, situs?: string|null, bersedia_dihubungi?: bool, tampil_direktori?: bool, persetujuan?: bool, nik?: string|null, npwp?: string|null, kode_pos?: string|null, koreksi_data?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAlumniByNimProfil(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/alumni/{nim}/profil', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah riwayat pekerjaan
     *
     * Alumni sendiri atau tracer:manage.
     *
     * `POST /v1/tracer/alumni/{nim}/pekerjaan`
     *
     * @param int|string $nim NIM
     * @param array{id?: int|null, nim?: string|null, instansi_id?: int|null, nama_instansi?: string|null, jenis_instansi?: string|null, tingkat?: string|null, jabatan?: string|null, posisi_wirausaha?: string|null, status_kerja?: string|null, mulai?: string|null, selesai?: string|null, saat_ini?: bool, pendapatan?: float|int|null, waktu_tunggu?: int|null, sebelum_lulus?: bool, kode_propinsi?: string|null, kode_kabupaten?: string|null, keselarasan_horizontal?: string|null, keselarasan_vertikal?: string|null, responden_id?: int|null, instansi?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimPekerjaan(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/pekerjaan', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah riwayat pekerjaan (POST)
     *
     * Sama dengan PUT, untuk hosting yang menolak PUT.
     *
     * `POST /v1/tracer/alumni/{nim}/pekerjaan/{id}`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID pekerjaan
     * @param array{id?: int|null, nim?: string|null, instansi_id?: int|null, nama_instansi?: string|null, jenis_instansi?: string|null, tingkat?: string|null, jabatan?: string|null, posisi_wirausaha?: string|null, status_kerja?: string|null, mulai?: string|null, selesai?: string|null, saat_ini?: bool, pendapatan?: float|int|null, waktu_tunggu?: int|null, sebelum_lulus?: bool, kode_propinsi?: string|null, kode_kabupaten?: string|null, keselarasan_horizontal?: string|null, keselarasan_vertikal?: string|null, responden_id?: int|null, instansi?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimPekerjaanById(int|string $nim, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/pekerjaan/{id}', ['nim' => $nim, 'id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah riwayat pekerjaan
     *
     * `PUT /v1/tracer/alumni/{nim}/pekerjaan/{id}`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID pekerjaan
     * @param array{id?: int|null, nim?: string|null, instansi_id?: int|null, nama_instansi?: string|null, jenis_instansi?: string|null, tingkat?: string|null, jabatan?: string|null, posisi_wirausaha?: string|null, status_kerja?: string|null, mulai?: string|null, selesai?: string|null, saat_ini?: bool, pendapatan?: float|int|null, waktu_tunggu?: int|null, sebelum_lulus?: bool, kode_propinsi?: string|null, kode_kabupaten?: string|null, keselarasan_horizontal?: string|null, keselarasan_vertikal?: string|null, responden_id?: int|null, instansi?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAlumniByNimPekerjaanById(int|string $nim, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/alumni/{nim}/pekerjaan/{id}', ['nim' => $nim, 'id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus riwayat pekerjaan
     *
     * `DELETE /v1/tracer/alumni/{nim}/pekerjaan/{id}`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID pekerjaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAlumniByNimPekerjaanById(int|string $nim, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/alumni/{nim}/pekerjaan/{id}', ['nim' => $nim, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah riwayat studi lanjut
     *
     * `POST /v1/tracer/alumni/{nim}/studi-lanjut`
     *
     * @param int|string $nim NIM
     * @param array{id?: int|null, nim?: string|null, jenjang?: string|null, perguruan_tinggi?: string|null, program_studi?: string|null, negara?: string|null, sumber_biaya?: string|null, tanggal_masuk?: string|null, tanggal_lulus?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimStudiLanjut(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/studi-lanjut', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah riwayat studi lanjut (POST)
     *
     * Sama dengan PUT.
     *
     * `POST /v1/tracer/alumni/{nim}/studi-lanjut/{id}`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID
     * @param array{id?: int|null, nim?: string|null, jenjang?: string|null, perguruan_tinggi?: string|null, program_studi?: string|null, negara?: string|null, sumber_biaya?: string|null, tanggal_masuk?: string|null, tanggal_lulus?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimStudiLanjutById(int|string $nim, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/studi-lanjut/{id}', ['nim' => $nim, 'id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah riwayat studi lanjut
     *
     * `PUT /v1/tracer/alumni/{nim}/studi-lanjut/{id}`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID
     * @param array{id?: int|null, nim?: string|null, jenjang?: string|null, perguruan_tinggi?: string|null, program_studi?: string|null, negara?: string|null, sumber_biaya?: string|null, tanggal_masuk?: string|null, tanggal_lulus?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAlumniByNimStudiLanjutById(int|string $nim, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/alumni/{nim}/studi-lanjut/{id}', ['nim' => $nim, 'id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus riwayat studi lanjut
     *
     * `DELETE /v1/tracer/alumni/{nim}/studi-lanjut/{id}`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAlumniByNimStudiLanjutById(int|string $nim, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/alumni/{nim}/studi-lanjut/{id}', ['nim' => $nim, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pas foto alumni
     *
     * Respons gambar (bukan JSON). Alumni sendiri atau tracer:read.
     *
     * `GET /v1/tracer/alumni/{nim}/foto`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlumniByNimFoto(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/alumni/{nim}/foto', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Unggah pas foto
     *
     * JPG/PNG/WEBP maksimal 2 MB, disimpan di arsip pribadi (jenis PAS-FOTO) sebagai versi baru. Alumni sendiri atau tracer:manage.
     *
     * `POST /v1/tracer/alumni/{nim}/foto`
     *
     * @param int|string $nim NIM
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, berkas_id?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimFoto(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/foto', ['nim' => $nim], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Berkas alumni
     *
     * Ijazah/transkrip resmi yang diunggah petugas ke arsip, dan berkas unggahan alumni (CV, sertifikat, dll). Alumni sendiri atau tracer:pii.
     *
     * `GET /v1/tracer/alumni/{nim}/berkas`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlumniByNimBerkas(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/alumni/{nim}/berkas', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Unggah berkas alumni
     *
     * Disimpan di arsip pribadi mahasiswa (sumber tracer). Ijazah/transkrip unggahan alumni berstatus diajukan sampai diverifikasi petugas.
     *
     * `POST /v1/tracer/alumni/{nim}/berkas`
     *
     * @param int|string $nim NIM
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis: string|null, judul?: string|null, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimBerkas(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/berkas', ['nim' => $nim], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Hapus berkas alumni
     *
     * Hanya berkas unggahan sendiri yang belum diverifikasi.
     *
     * `POST /v1/tracer/alumni/{nim}/berkas/{uuid}/hapus`
     *
     * @param int|string $nim NIM
     * @param int|string $uuid ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimBerkasByUuidHapus(int|string $nim, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/berkas/{uuid}/hapus', ['nim' => $nim, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Unduh berkas alumni
     *
     * Respons biner. `inline=1` untuk PDF/gambar. Hanya pemilik atau tracer:pii; setiap unduhan dicatat.
     *
     * `GET /v1/tracer/alumni/{nim}/berkas/file/{uuid}/unduh`
     *
     * @param int|string $nim NIM
     * @param int|string $uuid ID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlumniByNimBerkasFileByUuidUnduh(int|string $nim, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/alumni/{nim}/berkas/file/{uuid}/unduh', ['nim' => $nim, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Transkrip nilai alumni
     *
     * Nilai terbaik per mata kuliah dan IPK dari data SIAKAD, untuk salinan cetak (bukan dokumen resmi). Alumni sendiri atau tracer:pii.
     *
     * `GET /v1/tracer/alumni/{nim}/transkrip`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlumniByNimTranskrip(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/alumni/{nim}/transkrip', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Hapus riwayat pekerjaan (POST)
     *
     * Sama dengan DELETE, untuk hosting yang menolak DELETE.
     *
     * `POST /v1/tracer/alumni/{nim}/pekerjaan/{id}/hapus`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID pekerjaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimPekerjaanByIdHapus(int|string $nim, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/pekerjaan/{id}/hapus', ['nim' => $nim, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus riwayat studi lanjut (POST)
     *
     * Sama dengan DELETE.
     *
     * `POST /v1/tracer/alumni/{nim}/studi-lanjut/{id}/hapus`
     *
     * @param int|string $nim NIM
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlumniByNimStudiLanjutByIdHapus(int|string $nim, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/alumni/{nim}/studi-lanjut/{id}/hapus', ['nim' => $nim, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jawaban kuesioner tracer lama
     *
     * Isi t_mahasiswa_ts (menu tracer study SIAKAD lama, format Dikti sebelum 2021) apa adanya. Kodenya tidak sama artinya dengan kuesioner 2021, jadi tidak digabung.
     *
     * `GET /v1/tracer/alumni/{nim}/jawaban-lama`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlumniByNimJawabanLama(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/alumni/{nim}/jawaban-lama', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Daftar instansi/pengguna lulusan
     *
     * Termasuk jumlah alumni yang tercatat bekerja di sana.
     *
     * `GET /v1/tracer/instansi`
     *
     * scope: `tracer:read` · berhalaman
     *
     * @param array{q?: string, jenis?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInstansi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/instansi', [], $query, null, $options, false, false);
    }

    /**
     * Tambah instansi
     *
     * `POST /v1/tracer/instansi`
     *
     * scope: `tracer:manage`
     *
     * @param array{id?: int|null, nama?: string|null, jenis?: string|null, tingkat?: string|null, bidang_usaha?: string|null, alamat?: string|null, kode_propinsi?: string|null, kode_kabupaten?: string|null, telepon?: string|null, email?: string|null, situs?: string|null, kontak_nama?: string|null, kontak_jabatan?: string|null, kontak_email?: string|null, kontak_hp?: string|null, terverifikasi?: bool, jumlah_alumni?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postInstansi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/instansi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail instansi
     *
     * `GET /v1/tracer/instansi/{id}`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID instansi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInstansiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/instansi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah instansi
     *
     * `PUT /v1/tracer/instansi/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID instansi
     * @param array{id?: int|null, nama?: string|null, jenis?: string|null, tingkat?: string|null, bidang_usaha?: string|null, alamat?: string|null, kode_propinsi?: string|null, kode_kabupaten?: string|null, telepon?: string|null, email?: string|null, situs?: string|null, kontak_nama?: string|null, kontak_jabatan?: string|null, kontak_email?: string|null, kontak_hp?: string|null, terverifikasi?: bool, jumlah_alumni?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putInstansiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/instansi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus instansi
     *
     * Ditolak bila sudah dipakai responden pengguna lulusan.
     *
     * `DELETE /v1/tracer/instansi/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID instansi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteInstansiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/instansi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar lowongan kerja
     *
     * Scope tracer:respond/tracer:read hanya melihat yang terbit dan belum lewat batas; tracer:manage melihat semua (filter status).
     *
     * `GET /v1/tracer/lowongan`
     *
     * berhalaman
     *
     * @param array{status?: string, prodi?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLowongan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/lowongan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah lowongan
     *
     * `POST /v1/tracer/lowongan`
     *
     * scope: `tracer:manage`
     *
     * @param array{id?: int|null, instansi_id?: int|null, nama_instansi?: string|null, judul?: string|null, deskripsi?: string|null, kualifikasi?: string|null, tipe?: string|null, lokasi?: string|null, kode_propinsi?: string|null, kode_kabupaten?: string|null, prodi?: list<mixed>, gaji_min?: float|int|null, gaji_maks?: float|int|null, tautan?: string|null, kontak?: string|null, batas_lamar?: string|null, status?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLowongan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/lowongan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail lowongan
     *
     * `GET /v1/tracer/lowongan/{id}`
     *
     * @param int|string $id ID lowongan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLowonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/lowongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah lowongan
     *
     * `PUT /v1/tracer/lowongan/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID lowongan
     * @param array{id?: int|null, instansi_id?: int|null, nama_instansi?: string|null, judul?: string|null, deskripsi?: string|null, kualifikasi?: string|null, tipe?: string|null, lokasi?: string|null, kode_propinsi?: string|null, kode_kabupaten?: string|null, prodi?: list<mixed>, gaji_min?: float|int|null, gaji_maks?: float|int|null, tautan?: string|null, kontak?: string|null, batas_lamar?: string|null, status?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putLowonganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/lowongan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus lowongan
     *
     * `DELETE /v1/tracer/lowongan/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID lowongan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLowonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/lowongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Upah minimum provinsi
     *
     * Dipakai indikator IKU 1 (pendapatan >= 1,2 x UMP).
     *
     * `GET /v1/tracer/ump`
     *
     * scope: `tracer:read`
     *
     * @param array{tahun?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUmp(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/ump', [], $query, null, $options, false, false);
    }

    /**
     * Simpan UMP (massal)
     *
     * Body: {"data": [{"tahun": 2026, "kode_propinsi": "35", "nama_propinsi": "Jawa Timur", "nilai": 2305985}]}. Kode propinsi sama dengan r_propinsi.
     *
     * `PUT /v1/tracer/ump`
     *
     * scope: `tracer:manage`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUmp(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/ump', [], $query, null, $options, false, false);
    }

    /**
     * Saran instansi untuk alumni
     *
     * Untuk isian nama instansi di formulir pekerjaan alumni. Hanya data usaha (nama, jenis, cakupan, bidang usaha, alamat, wilayah, situs), tanpa kontak; yang terverifikasi didahulukan. Riwayat pekerjaan yang disimpan otomatis tertaut ke instansi (dicocokkan dengan nama atau dibuat belum terverifikasi); `instansi` di body pekerjaan hanya mengisi kolom instansi yang masih kosong.
     *
     * `GET /v1/tracer/referensi/instansi`
     *
     * scope: `tracer:respond`
     *
     * @param array{q?: string, limit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensiInstansi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/referensi/instansi', [], $query, null, $options, false, false);
    }

    /**
     * Referensi provinsi/kabupaten
     *
     * Tanpa parameter: daftar provinsi (r_propinsi). Dengan `propinsi`: kabupaten/kota provinsi itu (r_kabupaten). Untuk pertanyaan bertipe propinsi/kabupaten (F5a1/F5a2).
     *
     * `GET /v1/tracer/referensi/wilayah`
     *
     * scope: `tracer:respond`
     *
     * @param array{propinsi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensiWilayah(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/referensi/wilayah', [], $query, null, $options, false, false);
    }

    /**
     * Daftar publikasi hasil
     *
     * Tanpa token: hanya yang terbit. Token dengan tracer:manage melihat draf juga.
     *
     * `GET /v1/tracer/publikasi`
     *
     * publik (tanpa token)
     *
     * @param array{tahun?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/publikasi', [], $query, null, $options, false, true);
    }

    /**
     * Buat publikasi
     *
     * Body {"periode_id", "judul", "ringkasan"?, "tampil_per_prodi"?, "tampil_pertanyaan"?, "min_responden"? (bawaan 5), "terbit"?}. Satu publikasi per periode; periode draf ditolak.
     *
     * `POST /v1/tracer/publikasi`
     *
     * scope: `tracer:manage`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPublikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/tracer/publikasi', [], $query, null, $options, false, false);
    }

    /**
     * Hasil tracer yang dipublikasikan
     *
     * Rekap agregat periode (tingkat respons, indikator lulusan: status, waktu tunggu, pendapatan, keselarasan, kompetensi, IKU 1, dan sebaran jawaban) tanpa data pribadi. Bagian dengan responden selesai < min_responden disembunyikan. prodi=<kode> untuk hasil satu prodi bila tampil_per_prodi.
     *
     * `GET /v1/tracer/publikasi/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID publikasi
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/publikasi/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Ubah / terbitkan publikasi
     *
     * Kirim field yang diubah saja; terbit=true menerbitkan, false menarik kembali.
     *
     * `PUT /v1/tracer/publikasi/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID publikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPublikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/tracer/publikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus publikasi
     *
     * `DELETE /v1/tracer/publikasi/{id}`
     *
     * scope: `tracer:manage`
     *
     * @param int|string $id ID publikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePublikasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/tracer/publikasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Definisi IKU 1 lulusan: ringkasan
     *
     * Kebijakan yang berlaku sekarang (versi terbit berdasar SK, atau nilai bawaan sistem beserta peringatan), nilai bawaan, daftar versi, dan boleh_kelola. Pemilik: LPM (Staf/Kepala LPM).
     *
     * `GET /v1/tracer/aturan-iku1`
     *
     * scope: `tracer:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanIku1(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/aturan-iku1', [], $query, null, $options, false, false);
    }

    /**
     * Definisi IKU 1 lulusan: yang berlaku
     *
     * {sumber: aturan|bawaan, versi, isi, peringatan}. Query tanggal=YYYY-MM-DD (bawaan hari ini).
     *
     * `GET /v1/tracer/aturan-iku1/berlaku`
     *
     * scope: `tracer:read`
     *
     * @param array{tanggal?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanIku1Berlaku(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/aturan-iku1/berlaku', [], $query, null, $options, false, false);
    }

    /**
     * Definisi IKU 1 lulusan: detail versi
     *
     * Isi, SK, riwayat, perubahan dari versi induk.
     *
     * `GET /v1/tracer/aturan-iku1/versi/{id}`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanIku1VersiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/aturan-iku1/versi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Definisi IKU 1 lulusan: banding versi
     *
     * Perubahan dibanding versi `dengan` (bawaan: yang berlaku; tanpa versi terbit: nilai bawaan).
     *
     * `GET /v1/tracer/aturan-iku1/versi/{id}/banding`
     *
     * scope: `tracer:read`
     *
     * @param int|string $id ID versi
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanIku1VersiByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/tracer/aturan-iku1/versi/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }
}
