<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Infra: Layanan, Infra: Gerbang API, Infra: Rahasia, Infra: Antrean
 */
final class Infra extends Resource
{
    /**
     * Status semua layanan (publik)
     *
     * Untuk halaman status dan widget aplikasi. `status` umum: normal, sebagian_terganggu, gangguan, tidak_diketahui. Tanpa alamat internal. Simpan sekitar 1 menit.
     *
     * `GET /v1/infra/status`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/status', [], $query, null, $options, false, true);
    }

    /**
     * Ringkasan infrastruktur
     *
     * Jumlah layanan per status, rute gerbang, metrik 24 jam, antrean, rahasia yang perlu dirotasi, dan penyedia broker.
     *
     * `GET /v1/infra/ringkasan`
     *
     * scope: `infra:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar layanan
     *
     * Semua aplikasi kampus dan microservices di registri, dengan status health check dan uptime 24 jam.
     *
     * `GET /v1/infra/layanan`
     *
     * scope: `infra:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLayanan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/layanan', [], $query, null, $options, false, false);
    }

    /**
     * Daftarkan layanan
     *
     * `kode` dipakai sebagai awalan jenis event yang boleh diterbitkan layanan (`lms.*`) dan biasanya sebagai ruang rahasia. `url_kesehatan` diperiksa cron `infra:jalan` tiap `interval_cek` menit: 2xx = sehat; 2xx lambat atau JSON `{"status": "degraded"}` = terganggu; gagal dua kali berturut-turut = mati.
     *
     * `POST /v1/infra/layanan`
     *
     * scope: `infra:admin`
     *
     * @param array{kode?: string|null, nama?: string|null, jenis?: string|null, url_dasar?: string|null, url_kesehatan?: string|null, interval_cek?: int|null, batas_lambat_ms?: int|null, klien_id?: string|null, pemilik?: string|null, repositori?: string|null, keterangan?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLayanan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/layanan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail layanan
     *
     * `GET /v1/infra/layanan/{kode}`
     *
     * scope: `infra:admin`
     *
     * @param int|string $kode Kode layanan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLayananByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/layanan/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah layanan
     *
     * Kirim hanya field yang diubah. `kode` tidak bisa diubah.
     *
     * `POST /v1/infra/layanan/{kode}`
     *
     * scope: `infra:admin`
     *
     * @param int|string $kode Kode layanan
     * @param array{kode?: string|null, nama?: string|null, jenis?: string|null, url_dasar?: string|null, url_kesehatan?: string|null, interval_cek?: int|null, batas_lambat_ms?: int|null, klien_id?: string|null, pemilik?: string|null, repositori?: string|null, keterangan?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLayananByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/layanan/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus layanan
     *
     * Ditolak (409) bila masih menjadi tujuan rute gerbang.
     *
     * `POST /v1/infra/layanan/{kode}/hapus`
     *
     * scope: `infra:admin`
     *
     * @param int|string $kode Kode layanan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLayananByKodeHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/layanan/{kode}/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Health check sekarang
     *
     * `POST /v1/infra/layanan/{kode}/cek`
     *
     * scope: `infra:admin`
     *
     * @param int|string $kode Kode layanan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLayananByKodeCek(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/layanan/{kode}/cek', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Riwayat health check dan uptime
     *
     * `GET /v1/infra/layanan/{kode}/riwayat`
     *
     * scope: `infra:admin`
     *
     * @param int|string $kode Kode layanan
     * @param array{jam?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLayananByKodeRiwayat(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/layanan/{kode}/riwayat', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Buat kunci gerbang baru
     *
     * Kunci HMAC untuk header identitas yang ditambahkan gerbang saat meneruskan permintaan ke layanan ini
     * (`X-Unipo-Gerbang: t=<unix>,v1=<hex>`). Hanya ditampilkan sekali; simpan di layanan (mis. lewat secret manager).
     * Verifikasi dengan SDK: `verifikasiGerbang()` (Node) / `Gerbang::verifikasi()` (PHP).
     *
     * `POST /v1/infra/layanan/{kode}/kunci-gerbang`
     *
     * scope: `infra:admin`
     *
     * @param int|string $kode Kode layanan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLayananByKodeKunciGerbang(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/layanan/{kode}/kunci-gerbang', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Daftar rute gerbang
     *
     * Urut awalan terpanjang dulu (yang dipakai gerbang bila beberapa cocok). Path tanpa rute tetap ke monolith SIAKAD.
     *
     * `GET /v1/infra/rute`
     *
     * scope: `infra:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRute(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rute', [], $query, null, $options, false, false);
    }

    /**
     * Tambah rute
     *
     * - `tujuan: "monolith"`: tetap dilayani SIAKAD, tetapi dengan kebijakan rute (batas permintaan, pemeliharaan, metode).
     * - `tujuan: "layanan"` + `layanan` (kode registri): gerbang meneruskan ke `url_dasar` layanan, mengganti awalan dengan
     *   `jalur_tujuan` bila diisi. Dengan `autentikasi: "token"`, gerbang memeriksa token (dan `scope` bila diisi) lebih dulu,
     *   lalu menambah header identitas bertanda tangan (`X-Unipo-Klien`, `X-Unipo-Pengguna`, `X-Unipo-Level`, `X-Unipo-Scope`,
     *   `X-Unipo-Gerbang`). Header `Authorization` tetap diteruskan.
     * - `batas_per_menit`: per klien (token) atau per IP (tanpa token). `pemeliharaan: true` menjawab 503 dengan `pesan_pemeliharaan`.
     * Perubahan berlaku di gerbang paling lambat 1 menit.
     *
     * `POST /v1/infra/rute`
     *
     * scope: `infra:admin`
     *
     * @param array{nama?: string|null, awalan?: string|null, metode?: list<mixed>, tujuan?: string|null, layanan?: string|null, jalur_tujuan?: string|null, autentikasi?: string|null, scope?: list<mixed>, batas_per_menit?: int|null, timeout_detik?: int|null, pemeliharaan?: bool, pesan_pemeliharaan?: string|null, aktif?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRute(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rute', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail rute
     *
     * `GET /v1/infra/rute/{id}`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rute (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuteById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rute/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah rute
     *
     * Kirim hanya field yang diubah, mis. `{"pemeliharaan": true}`.
     *
     * `POST /v1/infra/rute/{id}`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rute (UUID)
     * @param array{nama?: string|null, awalan?: string|null, metode?: list<mixed>, tujuan?: string|null, layanan?: string|null, jalur_tujuan?: string|null, autentikasi?: string|null, scope?: list<mixed>, batas_per_menit?: int|null, timeout_detik?: int|null, pemeliharaan?: bool, pesan_pemeliharaan?: string|null, aktif?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuteById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rute/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus rute
     *
     * Path kembali dilayani monolith.
     *
     * `POST /v1/infra/rute/{id}/hapus`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rute (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuteByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rute/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Metrik gerbang
     *
     * Per rute: jumlah permintaan, galat 4xx/5xx, ditolak (batas/pemeliharaan/pemutus sirkuit), latensi rata-rata dan maksimum; plus deret per jam.
     *
     * `GET /v1/infra/metrik`
     *
     * scope: `infra:admin`
     *
     * @param array{jam?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMetrik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/metrik', [], $query, null, $options, false, false);
    }

    /**
     * Konfigurasi untuk gerbang
     *
     * Dipakai gerbang api.unipo.ac.id mode proxy (di server lain). Memuat kunci HMAC layanan, jadi hanya untuk klien gerbang. Gerbang di server yang sama membaca storage/infra/gerbang.json.
     *
     * `GET /v1/infra/gerbang/konfigurasi`
     *
     * scope: `infra:gerbang`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGerbangKonfigurasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/gerbang/konfigurasi', [], $query, null, $options, false, false);
    }

    /**
     * Periksa token (introspeksi)
     *
     * Body `{"token": "...", "ip": "<IP pengguna>"}`. Jawaban `aktif: false` bila token tidak sah, kedaluwarsa, dicabut, atau klien/pengguna nonaktif; selain itu identitas, scope efektif, dan `lewati_pemeliharaan` (true bila pengguna token, atau admin pelaku saat masuk sebagai pengguna, administrator atau memegang izin `pustikom.pemeliharaan.lewati`: rute yang sedang dipelihara tetap diteruskan).
     *
     * `POST /v1/infra/gerbang/introspeksi`
     *
     * scope: `infra:gerbang`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGerbangIntrospeksi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/gerbang/introspeksi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim metrik gerbang
     *
     * Body `{"metrik": [{"rute_id": 3, "menit": "2026-11-15 10:01", "jumlah": 120, "galat_4xx": 2, "galat_5xx": 0, "dibatasi": 1, "latensi_total_ms": 9000, "latensi_maks_ms": 450}]}`.
     *
     * `POST /v1/infra/gerbang/metrik`
     *
     * scope: `infra:gerbang`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGerbangMetrik(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/gerbang/metrik', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar rahasia
     *
     * Metadata saja; isi tidak pernah ikut.
     *
     * `GET /v1/infra/rahasia`
     *
     * scope: `infra:admin` · berhalaman
     *
     * @param array{ruang?: string, lingkungan?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasia(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia', [], $query, null, $options, false, false);
    }

    /**
     * Simpan rahasia baru
     *
     * - Teks: `{"ruang": "pmb", "lingkungan": "produksi", "nama": "XENDIT_SECRET_KEY", "nilai": "..."}` (nama gaya variabel lingkungan).
     * - Berkas: `{"ruang": "lms", "jenis": "berkas", "nama": "service-account.json", "mime": "application/json", "berkas_base64": "..."}` (maks. 1 MB).
     * - Opsional `keterangan`, `rotasi_hari` (pengingat rotasi), `kedaluwarsa_at` (YYYY-MM-DD, mis. masa berlaku sertifikat).
     * Isi dienkripsi AES-256-GCM; jawaban hanya metadata dan sidik jari versi.
     *
     * `POST /v1/infra/rahasia`
     *
     * scope: `infra:admin`
     *
     * @param array{ruang?: string|null, lingkungan?: string|null, nama?: string|null, jenis?: string|null, nilai?: string|null, berkas_base64?: string|null, mime?: string|null, keterangan?: string|null, rotasi_hari?: int|null, kedaluwarsa_at?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasia(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar ruang rahasia
     *
     * Ruang beserta jumlah rahasia per lingkungan.
     *
     * `GET /v1/infra/rahasia-ruang`
     *
     * scope: `infra:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasiaRuang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia-ruang', [], $query, null, $options, false, false);
    }

    /**
     * Detail rahasia + riwayat versi
     *
     * `GET /v1/infra/rahasia/{id}`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rahasia (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasiaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah keterangan rahasia
     *
     * Hanya `keterangan`, `mime`, `rotasi_hari`, `kedaluwarsa_at`. Isi diganti lewat rotasi.
     *
     * `POST /v1/infra/rahasia/{id}`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rahasia (UUID)
     * @param array{ruang?: string|null, lingkungan?: string|null, nama?: string|null, jenis?: string|null, nilai?: string|null, berkas_base64?: string|null, mime?: string|null, keterangan?: string|null, rotasi_hari?: int|null, kedaluwarsa_at?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasiaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rotasi (isi baru)
     *
     * Body `{"nilai": "..."}` atau `{"berkas_base64": "..."}`. Isi baru menjadi versi aktif; 10 versi terakhir disimpan. Event `infra.rahasia.dirotasi` diterbitkan (tanpa isi).
     *
     * `POST /v1/infra/rahasia/{id}/rotasi`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rahasia (UUID)
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasiaByIdRotasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia/{id}/rotasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kembali ke versi lama
     *
     * `POST /v1/infra/rahasia/{id}/versi/{versi}/aktifkan`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rahasia (UUID)
     * @param int|string $versi Nomor versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasiaByIdVersiByVersiAktifkan(int|string $id, int|string $versi, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia/{id}/versi/{versi}/aktifkan', ['id' => $id, 'versi' => $versi], $query, null, $options, false, false);
    }

    /**
     * Tampilkan isi (admin)
     *
     * Body `{"alasan": "..."}` (wajib, 5-255 karakter). Tercatat di log audit beserta alasan, pengguna, dan IP.
     *
     * `POST /v1/infra/rahasia/{id}/tampilkan`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rahasia (UUID)
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasiaByIdTampilkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia/{id}/tampilkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus rahasia
     *
     * Semua versi isi dibuang permanen; jejak audit tetap.
     *
     * `POST /v1/infra/rahasia/{id}/hapus`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID rahasia (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasiaByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar akses aplikasi ke ruang rahasia
     *
     * `GET /v1/infra/rahasia-akses`
     *
     * scope: `infra:admin`
     *
     * @param array{ruang?: string, klien_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasiaAkses(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia-akses', [], $query, null, $options, false, false);
    }

    /**
     * Beri akses ruang ke aplikasi
     *
     * Body `{"ruang": "pmb", "lingkungan": "produksi", "klien_id": "pmb-bff", "catatan": "..."}`. Klien juga butuh scope `infra:rahasia` dan akses live.
     *
     * `POST /v1/infra/rahasia-akses`
     *
     * scope: `infra:admin`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasiaAkses(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia-akses', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut akses
     *
     * `POST /v1/infra/rahasia-akses/{id}/hapus`
     *
     * scope: `infra:admin`
     *
     * @param int|string $id ID akses
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRahasiaAksesByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/rahasia-akses/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Log audit rahasia
     *
     * Aksi: buat, ubah, rotasi, aktifkan_versi, hapus, tampil, baca, ekspor, ditolak, beri_akses, cabut_akses.
     *
     * `GET /v1/infra/rahasia-log`
     *
     * scope: `infra:admin` · berhalaman
     *
     * @param array{ruang?: string, aksi?: string, klien_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasiaLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia-log', [], $query, null, $options, false, false);
    }

    /**
     * Ruang rahasia aplikasi ini
     *
     * Butuh token live (akses live disetujui di Pustikom).
     *
     * `GET /v1/infra/rahasia-saya`
     *
     * scope: `infra:rahasia`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasiaSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia-saya', [], $query, null, $options, false, false);
    }

    /**
     * Semua rahasia satu ruang
     *
     * `?format=env` mengembalikan teks dotenv (`NAMA="nilai"`, hanya rahasia teks) untuk ditulis ke `.env` saat deploy:
     *
     * ```bash
     * curl -fsS -H "Authorization: Bearer $TOKEN" "https://api.unipo.ac.id/v1/infra/rahasia-saya/pmb?format=env" > .env && chmod 600 .env
     * ```
     *
     * `?lingkungan=development` untuk rahasia development (bawaan produksi). Setiap pembacaan tercatat.
     *
     * `GET /v1/infra/rahasia-saya/{ruang}`
     *
     * scope: `infra:rahasia`
     *
     * @param int|string $ruang Ruang
     * @param array{lingkungan?: string, format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasiaSayaByRuang(int|string $ruang, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia-saya/{ruang}', ['ruang' => $ruang], $query, null, $options, false, false);
    }

    /**
     * Satu rahasia
     *
     * Berkas: `berkas_base64`, atau isi mentah dengan `?unduh=1`.
     *
     * `GET /v1/infra/rahasia-saya/{ruang}/{nama}`
     *
     * scope: `infra:rahasia`
     *
     * @param int|string $ruang Ruang
     * @param int|string $nama Nama rahasia
     * @param array{lingkungan?: string, unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRahasiaSayaByRuangByNama(int|string $ruang, int|string $nama, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/rahasia-saya/{ruang}/{nama}', ['ruang' => $ruang, 'nama' => $nama], $query, null, $options, false, false);
    }

    /**
     * Daftar antrean
     *
     * Antrean milik aplikasi ini (admin: semua, saring `klien_id`) beserta jumlah pesan per status.
     *
     * `GET /v1/infra/antrean`
     *
     * scope: `infra:antrean`
     *
     * @param array{klien_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Buat antrean
     *
     * Body `{"kode": "lms.nilai-masuk", "jenis_event": ["akademik.*", "admisi.nim_diterbitkan"]}`. Pola: jenis persis, `modul.*`, atau `*`. Setiap event yang cocok masuk sekali ke antrean ini.
     *
     * `POST /v1/infra/antrean`
     *
     * scope: `infra:antrean`
     *
     * @param array{kode?: string|null, nama?: string|null, jenis_event?: list<mixed>, visibilitas_detik?: int|null, maks_percobaan?: int|null, retensi_hari?: int|null, aktif?: bool, keterangan?: string|null, klien_id?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntrean(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail antrean
     *
     * `GET /v1/infra/antrean/{kode}`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/antrean/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah antrean
     *
     * `POST /v1/infra/antrean/{kode}`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array{kode?: string|null, nama?: string|null, jenis_event?: list<mixed>, visibilitas_detik?: int|null, maks_percobaan?: int|null, retensi_hari?: int|null, aktif?: bool, keterangan?: string|null, klien_id?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus antrean beserta pesannya
     *
     * `POST /v1/infra/antrean/{kode}/hapus`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKodeHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ambil pesan
     *
     * Body `{"jumlah": 10, "visibilitas_detik": 60}`. Setiap pesan berisi `tanda_terima` dan `event` (amplop). Pesan tersembunyi
     * selama visibilitas; bila tidak di-ack sebelum waktunya, pesan bisa diambil lagi. Setelah `maks_percobaan` kali, pesan masuk
     * dead letter (`status: mati`). Pengiriman at-least-once: proses secara idempoten berdasarkan `event.id`.
     *
     * `POST /v1/infra/antrean/{kode}/ambil`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKodeAmbil(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}/ambil', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Akui pesan selesai
     *
     * Body `{"tanda_terima": ["...", "..."]}` (maks. 100). Tanda terima lama (setelah pesan diambil ulang) tidak berlaku.
     *
     * `POST /v1/infra/antrean/{kode}/ack`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKodeAck(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}/ack', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kembalikan pesan (gagal diproses)
     *
     * Body `{"tanda_terima": [...], "tunda_detik": 30, "galat": "..."}`.
     *
     * `POST /v1/infra/antrean/{kode}/tolak`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKodeTolak(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}/tolak', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Perpanjang waktu proses
     *
     * Body `{"tanda_terima": [...], "detik": 120}` untuk pekerjaan yang lebih lama dari visibilitas.
     *
     * `POST /v1/infra/antrean/{kode}/perpanjang`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKodePerpanjang(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}/perpanjang', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Telusuri pesan
     *
     * Termasuk dead letter (`status=mati`).
     *
     * `GET /v1/infra/antrean/{kode}/pesan`
     *
     * scope: `infra:antrean` · berhalaman
     *
     * @param int|string $kode Kode antrean
     * @param array{status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanByKodePesan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/infra/antrean/{kode}/pesan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Kirim ulang dead letter
     *
     * Body opsional `{"id": [12, 13]}`; kosong = semua pesan mati.
     *
     * `POST /v1/infra/antrean/{kode}/ulang`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKodeUlang(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}/ulang', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kosongkan antrean
     *
     * Body opsional `{"status": "selesai"}`; kosong = semua pesan.
     *
     * `POST /v1/infra/antrean/{kode}/kosongkan`
     *
     * scope: `infra:antrean`
     *
     * @param int|string $kode Kode antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByKodeKosongkan(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/antrean/{kode}/kosongkan', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan event layanan
     *
     * Layanan menerbitkan event domainnya sendiri ke bus SIAKAD; event diteruskan ke webhook keluar, antrean tarik, dan broker
     * seperti event SIAKAD. Body `{"jenis": "lms.tugas_dinilai", "subjek": "<id entitas>", "data": {...}, "versi": 1}`.
     * `jenis` wajib berawalan kode layanan milik klien ini di registri (`lms.`); admin bebas.
     *
     * `POST /v1/infra/terbitkan`
     *
     * scope: `infra:terbitkan`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTerbitkan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/infra/terbitkan', [], $options['query'] ?? [], $body, $options, false, false);
    }
}
