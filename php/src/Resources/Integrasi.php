<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Integrasi: Status, Integrasi: Pengaturan, Integrasi: Captcha, Integrasi: Pembayaran, Integrasi: Berkas, Integrasi: Cache, Integrasi: Email & WhatsApp, Integrasi: Webhook keluar, Integrasi: Rapat daring, Integrasi: Tanda tangan elektronik, Integrasi: AI
 */
final class Integrasi extends Resource
{
    /**
     * Integrasi yang aktif (publik)
     *
     * Dibaca aplikasi kampus (SSO, PMB, LMS, portal, dll.) untuk ikut memakai integrasi yang diaktifkan admin, tanpa rahasia.
     * Per kategori `null` bila belum ada penyedia aktif. `captcha` memuat site key, skrip widget, nama field token, dan
     * `halaman` (formulir yang wajib captcha: login, lupa_password, reset_password, daftar, formulir_publik). Token captcha
     * diverifikasi server aplikasi lewat POST /v1/integrasi/captcha/verifikasi (scope `integrasi:captcha`). Boleh disimpan 60 detik.
     *
     * `GET /v1/integrasi/status`
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
        return $this->send('GET', '/v1/integrasi/status', [], $query, null, $options, false, true);
    }

    /**
     * Daftar driver yang didukung
     *
     * Isian `konfigurasi` (tidak rahasia) dan `rahasia` (disimpan terenkripsi) untuk setiap driver: recaptcha_v2, recaptcha_v3, turnstile, hcaptcha, xendit, midtrans, s3, r2, minio, google_drive, lokal, redis, smtp, mailgun, sendgrid, brevo, fonnte, wablas, zoom, google_meet, bsre, anthropic, openai_kompatibel, gemini.
     *
     * `GET /v1/integrasi/katalog`
     *
     * scope: `integrasi:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan integrasi
     *
     * Penyedia utama per kategori, rekap transaksi per status, sumber kunci enkripsi, dan daftar event webhook.
     *
     * `GET /v1/integrasi/ringkasan`
     *
     * scope: `integrasi:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar penyedia
     *
     * Rahasia tidak pernah dikembalikan, hanya status terisi/kosong. `url_webhook` (pembayaran) dipasang di dasbor penyedia.
     *
     * `GET /v1/integrasi/pengaturan`
     *
     * scope: `integrasi:admin`
     *
     * @param array{kategori?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah penyedia
     *
     * Contoh Xendit: `{"driver": "xendit", "kode": "xendit", "mode": "sandbox", "rahasia": {"secret_key": "xnd_development_...", "callback_token": "..."}}`.
     * Contoh Cloudflare R2: `{"driver": "r2", "konfigurasi": {"account_id": "...", "bucket": "siakad"}, "rahasia": {"access_key": "...", "secret_key": "..."}}`.
     * Penyedia pertama di satu kategori otomatis menjadi `utama`. Lihat GET /v1/integrasi/katalog untuk isian tiap driver.
     *
     * `POST /v1/integrasi/pengaturan`
     *
     * scope: `integrasi:admin`
     *
     * @param array{driver?: string|null, kode?: string|null, nama?: string|null, mode?: string|null, aktif?: bool, utama?: bool, catatan?: string|null, konfigurasi?: array<string, mixed>, rahasia?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pengaturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail penyedia
     *
     * `GET /v1/integrasi/pengaturan/{id}`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $id ID atau kode penyedia
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/pengaturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah penyedia (POST)
     *
     * Sama dengan PATCH, untuk server web/hosting yang menolak metode PATCH.
     *
     * `POST /v1/integrasi/pengaturan/{id}`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $id ID atau kode penyedia
     * @param array{driver?: string|null, kode?: string|null, nama?: string|null, mode?: string|null, aktif?: bool, utama?: bool, catatan?: string|null, konfigurasi?: array<string, mixed>, rahasia?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pengaturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah penyedia
     *
     * Kirim bagian yang berubah. `konfigurasi` digabung (nilai null menghapus); `rahasia` yang dikirim menimpa, yang tidak dikirim tetap, "" atau null menghapus. `utama: true` menjadikannya penyedia bawaan kategori itu.
     *
     * `PATCH /v1/integrasi/pengaturan/{id}`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $id ID atau kode penyedia
     * @param array{driver?: string|null, kode?: string|null, nama?: string|null, mode?: string|null, aktif?: bool, utama?: bool, catatan?: string|null, konfigurasi?: array<string, mixed>, rahasia?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchPengaturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/integrasi/pengaturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus penyedia
     *
     * Ditolak bila sudah dipakai transaksi/berkas; nonaktifkan saja.
     *
     * `DELETE /v1/integrasi/pengaturan/{id}`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $id ID atau kode penyedia
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengaturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/integrasi/pengaturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus penyedia (POST)
     *
     * Sama dengan DELETE, untuk hosting yang menolak metode DELETE.
     *
     * `POST /v1/integrasi/pengaturan/{id}/hapus`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $id ID atau kode penyedia
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pengaturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Uji koneksi penyedia
     *
     * Captcha: secret diterima; Xendit: GET /balance; Midtrans: server key diterima; penyimpanan: tulis-baca-hapus berkas uji; Redis: PING + SET/GET; email/WhatsApp: login SMTP/token, atau kirim pesan uji bila body `{"ke": "alamat/nomor"}`; Zoom: token + profil host; Google Meet: token + kalender.
     *
     * `POST /v1/integrasi/pengaturan/{id}/uji`
     *
     * scope: `integrasi:admin`
     *
     * @param int|string $id ID atau kode penyedia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturanByIdUji(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pengaturan/{id}/uji', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Log panggilan ke penyedia
     *
     * Tanpa body dan rahasia. Verifikasi captcha hanya dicatat bila gagal menghubungi penyedia.
     *
     * `GET /v1/integrasi/log`
     *
     * scope: `integrasi:admin` · berhalaman
     *
     * @param array{kategori?: string, driver?: string, penyedia?: string, gagal?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/log', [], $query, null, $options, false, false);
    }

    /**
     * Notifikasi masuk dari payment gateway
     *
     * Untuk menelusuri pembayaran yang belum tercatat.
     *
     * `GET /v1/integrasi/webhook-masuk`
     *
     * scope: `integrasi:admin` · berhalaman
     *
     * @param array{order_id?: string, sah?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getWebhookMasuk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/webhook-masuk', [], $query, null, $options, false, false);
    }

    /**
     * Info widget captcha (publik)
     *
     * Site key, URL skrip, dan nama field token untuk dipasang di formulir aplikasi web/mobile.
     *
     * `GET /v1/integrasi/captcha/konfigurasi`
     *
     * publik (tanpa token)
     *
     * @param array{penyedia?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCaptchaKonfigurasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/captcha/konfigurasi', [], $query, null, $options, false, true);
    }

    /**
     * Verifikasi token captcha
     *
     * Server aplikasi mengirim token dari widget (field g-recaptcha-response / cf-turnstile-response / h-captcha-response) dan IP pengguna. reCAPTCHA v3 lolos bila skor >= skor_minimal. Token hanya bisa diverifikasi sekali.
     *
     * `POST /v1/integrasi/captcha/verifikasi`
     *
     * scope: `integrasi:captcha`
     *
     * @param array{token: string|null, ip?: string|null, aksi?: string|null, penyedia?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCaptchaVerifikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/captcha/verifikasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penyedia dan metode pembayaran yang aktif
     *
     * `GET /v1/integrasi/pembayaran/metode`
     *
     * scope: `integrasi:bayar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembayaranMetode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/pembayaran/metode', [], $query, null, $options, false, false);
    }

    /**
     * Daftar transaksi
     *
     * Klien hanya melihat transaksinya sendiri; admin melihat semua (filter `klien_id`).
     *
     * `GET /v1/integrasi/pembayaran`
     *
     * scope: `integrasi:bayar` · berhalaman
     *
     * @param array{status?: string, sumber_modul?: string, sumber_referensi?: string, metode?: string, penyedia?: string, q?: string, dari?: string, sampai?: string, klien_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembayaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/pembayaran', [], $query, null, $options, false, false);
    }

    /**
     * Buat transaksi pembayaran
     *
     * `metode`: `checkout` (halaman bayar penyedia, `url_bayar`), `va` (`kanal` = kode bank, hasil `nomor_va`), `qris` (`qr_string`).
     * Dengan `sumber: {"modul": "pmb", "referensi": "<nomor tagihan PMB>"}` jumlah diambil dari tagihan PMB dan tagihan otomatis lunas
     * saat dibayar. Transaksi menunggu untuk sumber yang sama dipakai ulang (200, `meta.dipakai_ulang`). Status akhir dikirim lewat
     * webhook keluar (`pembayaran.dibayar`, dst.) dan bisa dicek di GET /v1/integrasi/pembayaran/{id}.
     *
     * `POST /v1/integrasi/pembayaran`
     *
     * scope: `integrasi:bayar`
     *
     * @param array{metode?: string|null, kanal?: string|null, jumlah?: int|null, keterangan?: string|null, pelanggan?: array<string, mixed>, item?: list<mixed>, kedaluwarsa_menit?: int|null, order_id?: string|null, sumber?: array<string, mixed>, url_kembali?: string|null, metadata?: array<string, mixed>, penyedia?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembayaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pembayaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail transaksi
     *
     * `GET /v1/integrasi/pembayaran/{id}`
     *
     * scope: `integrasi:bayar`
     *
     * @param int|string $id ID (UUID) atau order_id
     * @param array{segarkan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembayaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/pembayaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ambil status terbaru dari penyedia
     *
     * `POST /v1/integrasi/pembayaran/{id}/segarkan`
     *
     * scope: `integrasi:bayar`
     *
     * @param int|string $id ID (UUID) atau order_id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembayaranByIdSegarkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pembayaran/{id}/segarkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan transaksi
     *
     * Hanya status menunggu. Invoice Xendit di-expire, VA dinonaktifkan, Midtrans di-expire. Pembayaran yang tetap masuk sesudahnya tetap dicatat dibayar.
     *
     * `POST /v1/integrasi/pembayaran/{id}/batal`
     *
     * scope: `integrasi:bayar`
     *
     * @param int|string $id ID (UUID) atau order_id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembayaranByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pembayaran/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ulangi penerusan ke modul sumber
     *
     * Bila `sumber.status` = gagal (mis. tagihan PMB sempat tidak bisa dilunasi). Cron `integrasi:jalan` juga mengulanginya.
     *
     * `POST /v1/integrasi/pembayaran/{id}/teruskan`
     *
     * scope: `integrasi:bayar`
     *
     * @param int|string $id ID (UUID) atau order_id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembayaranByIdTeruskan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/pembayaran/{id}/teruskan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Notifikasi dari payment gateway
     *
     * Dipanggil server Xendit/Midtrans, bukan aplikasi. Pasang `url_webhook` dari GET /v1/integrasi/pengaturan di dasbor penyedia.
     * Xendit diperiksa dengan header `x-callback-token`; Midtrans dengan `signature_key` lalu status diambil ulang dari Midtrans.
     * Notifikasi ganda diabaikan. Jawaban 401 bila tanda tangan salah.
     *
     * `POST /v1/integrasi/webhook/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode penyedia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWebhookByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/webhook/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, true);
    }

    /**
     * Daftar berkas
     *
     * Klien hanya melihat berkasnya sendiri.
     *
     * `GET /v1/integrasi/berkas`
     *
     * scope: `integrasi:berkas` · berhalaman
     *
     * @param array{folder?: string, modul?: string, referensi?: string, status?: string, visibilitas?: string, q?: string, klien_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerkas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/berkas', [], $query, null, $options, false, false);
    }

    /**
     * Unggah berkas
     *
     * multipart/form-data: `berkas` (file), opsional `folder`, `visibilitas` (privat/publik), `modul`, `referensi`, `penyimpanan` (kode penyedia). Disimpan ke penyimpanan utama (S3/R2/MinIO) atau disk lokal bila belum ada. Batas ukuran INTEGRASI_BERKAS_MAKS_MB (bawaan 20) dan upload_max_filesize PHP.
     *
     * `POST /v1/integrasi/berkas`
     *
     * scope: `integrasi:berkas`
     *
     * @param array{berkas: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, folder?: string|null, visibilitas?: string|null, modul?: string|null, referensi?: string|null, penyimpanan?: string|null, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkas(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/berkas', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Minta URL unggah langsung ke bucket
     *
     * Untuk file besar: kirim `nama`, `ukuran` (byte), `mime`, lalu PUT isi file ke `unggah.url` dengan header `unggah.header`, kemudian POST /berkas/{id}/selesai. Tidak tersedia untuk disk lokal.
     *
     * `POST /v1/integrasi/berkas/unggah-langsung`
     *
     * scope: `integrasi:berkas`
     *
     * @param array{nama: string|null, ukuran: int|null, mime?: string|null, folder?: string|null, visibilitas?: string|null, modul?: string|null, referensi?: string|null, penyimpanan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkasUnggahLangsung(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/berkas/unggah-langsung', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Konfirmasi unggah langsung selesai
     *
     * `POST /v1/integrasi/berkas/{id}/selesai`
     *
     * scope: `integrasi:berkas`
     *
     * @param int|string $id ID berkas (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBerkasByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/berkas/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail berkas + URL unduh sementara
     *
     * `GET /v1/integrasi/berkas/{id}`
     *
     * scope: `integrasi:berkas`
     *
     * @param int|string $id ID berkas (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerkasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus berkas
     *
     * `DELETE /v1/integrasi/berkas/{id}`
     *
     * scope: `integrasi:berkas`
     *
     * @param int|string $id ID berkas (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBerkasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/integrasi/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * URL unduh sementara
     *
     * Presigned URL (S3/R2/MinIO) atau tautan bertanda tangan (lokal). Berkas publik dengan url_publik mendapat URL permanen.
     *
     * `GET /v1/integrasi/berkas/{id}/url`
     *
     * scope: `integrasi:berkas`
     *
     * @param int|string $id ID berkas (UUID)
     * @param array{ttl?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerkasByIdUrl(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/berkas/{id}/url', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh dengan tautan bertanda tangan
     *
     * Tautan dari /berkas/{id}/url; berlaku sampai waktu di dalamnya.
     *
     * `GET /v1/integrasi/berkas/unduh/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBerkasUnduhByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/berkas/unduh/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Ambil nilai cache
     *
     * Ruang nama per aplikasi; aplikasi lain tidak bisa membaca.
     *
     * `GET /v1/integrasi/cache/{kunci}`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $kunci Kunci (huruf/angka . _ -)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCacheByKunci(int|string $kunci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/cache/{kunci}', ['kunci' => $kunci], $query, null, $options, false, false);
    }

    /**
     * Simpan nilai cache
     *
     * Body `{"nilai": ..., "ttl": 3600, "hanya_baru": false}`. ttl detik, 0 = tanpa batas. Nilai maks. 512 KB.
     *
     * `PUT /v1/integrasi/cache/{kunci}`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $kunci Kunci
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putCacheByKunci(int|string $kunci, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/integrasi/cache/{kunci}', ['kunci' => $kunci], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus nilai cache
     *
     * `DELETE /v1/integrasi/cache/{kunci}`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $kunci Kunci
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteCacheByKunci(int|string $kunci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/integrasi/cache/{kunci}', ['kunci' => $kunci], $query, null, $options, false, false);
    }

    /**
     * Penghitung (INCRBY)
     *
     * Body `{"n": 1, "ttl": 60}`; ttl dipasang saat kunci baru dibuat. Cocok untuk rate limit/kuota.
     *
     * `POST /v1/integrasi/cache/{kunci}/tambah`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $kunci Kunci
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCacheByKunciTambah(int|string $kunci, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/cache/{kunci}/tambah', ['kunci' => $kunci], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ambil lock
     *
     * Body `{"ttl": 30}`. Mengembalikan `token` untuk melepas; 409 bila sedang dipegang.
     *
     * `POST /v1/integrasi/cache/{kunci}/kunci`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $kunci Nama lock
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCacheByKunciKunci(int|string $kunci, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/cache/{kunci}/kunci', ['kunci' => $kunci], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas lock
     *
     * Body `{"token": "..."}`.
     *
     * `POST /v1/integrasi/cache/{kunci}/lepas`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $kunci Nama lock
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCacheByKunciLepas(int|string $kunci, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/cache/{kunci}/lepas', ['kunci' => $kunci], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Panjang antrean
     *
     * `GET /v1/integrasi/antrean/{antrean}`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $antrean Nama antrean
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanByAntrean(int|string $antrean, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/antrean/{antrean}', ['antrean' => $antrean], $query, null, $options, false, false);
    }

    /**
     * Masukkan ke antrean
     *
     * Body `{"pesan": {...}}` atau `{"daftar": [...]}` (maks. 100). Antrean FIFO di Redis.
     *
     * `POST /v1/integrasi/antrean/{antrean}`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $antrean Nama antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByAntrean(int|string $antrean, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/antrean/{antrean}', ['antrean' => $antrean], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ambil dari antrean
     *
     * Body `{"jumlah": 10}`. Pesan yang diambil langsung hilang dari antrean.
     *
     * `POST /v1/integrasi/antrean/{antrean}/ambil`
     *
     * scope: `integrasi:cache`
     *
     * @param int|string $antrean Nama antrean
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByAntreanAmbil(int|string $antrean, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/antrean/{antrean}/ambil', ['antrean' => $antrean], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim email
     *
     * Lewat penyedia email utama (SMTP, Mailgun, SendGrid, Brevo) atau `penyedia` tertentu. `ke`: 1-50 alamat; `teks` dan/atau `html`.
     *
     * `POST /v1/integrasi/email/kirim`
     *
     * scope: `integrasi:pesan`
     *
     * @param array{ke: list<mixed>, subjek: string|null, teks?: string|null, html?: string|null, balas_ke?: string|null, penyedia?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEmailKirim(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/email/kirim', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kirim WhatsApp
     *
     * Lewat Fonnte atau Wablas. Nomor 08xx otomatis menjadi 628xx.
     *
     * `POST /v1/integrasi/whatsapp/kirim`
     *
     * scope: `integrasi:pesan`
     *
     * @param array{ke: list<mixed>, teks: string|null, penyedia?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWhatsappKirim(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/whatsapp/kirim', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar langganan webhook
     *
     * `GET /v1/integrasi/webhook-keluar`
     *
     * scope: `integrasi:webhook`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getWebhookKeluar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/webhook-keluar', [], $query, null, $options, false, false);
    }

    /**
     * Daftarkan URL webhook
     *
     * SIAKAD mengirim POST JSON `{"id", "event", "dibuat_at", "data"}` ke `url` untuk event milik aplikasi ini.
     * Verifikasi: `X-Siakad-Signature: t=<unix>,v1=<hex>` dengan v1 = HMAC-SHA256(rahasia, t + "." + body mentah); tolak bila t lebih dari 5 menit.
     * Jawab 2xx dalam 8 detik; selain itu dicoba ulang sampai 6 kali (1 menit sampai 24 jam). `rahasia` hanya ditampilkan sekali.
     *
     * `POST /v1/integrasi/webhook-keluar`
     *
     * scope: `integrasi:webhook`
     *
     * @param array{nama: string|null, url: string|null, event?: list<mixed>, aktif?: bool, semua_klien?: bool, rahasia_baru?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWebhookKeluar(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/webhook-keluar', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail langganan
     *
     * `GET /v1/integrasi/webhook-keluar/{id}`
     *
     * scope: `integrasi:webhook`
     *
     * @param int|string $id ID langganan (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getWebhookKeluarById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/webhook-keluar/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah langganan (POST)
     *
     * Sama dengan PATCH, untuk hosting yang menolak PATCH.
     *
     * `POST /v1/integrasi/webhook-keluar/{id}`
     *
     * scope: `integrasi:webhook`
     *
     * @param int|string $id ID langganan (UUID)
     * @param array{nama: string|null, url: string|null, event?: list<mixed>, aktif?: bool, semua_klien?: bool, rahasia_baru?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWebhookKeluarById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/webhook-keluar/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah langganan
     *
     * `{"rahasia_baru": true}` membuat rahasia baru (ditampilkan sekali).
     *
     * `PATCH /v1/integrasi/webhook-keluar/{id}`
     *
     * scope: `integrasi:webhook`
     *
     * @param int|string $id ID langganan (UUID)
     * @param array{nama: string|null, url: string|null, event?: list<mixed>, aktif?: bool, semua_klien?: bool, rahasia_baru?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchWebhookKeluarById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/integrasi/webhook-keluar/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus langganan
     *
     * `DELETE /v1/integrasi/webhook-keluar/{id}`
     *
     * scope: `integrasi:webhook`
     *
     * @param int|string $id ID langganan (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteWebhookKeluarById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/integrasi/webhook-keluar/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus langganan (POST)
     *
     * Sama dengan DELETE, untuk hosting yang menolak DELETE.
     *
     * `POST /v1/integrasi/webhook-keluar/{id}/hapus`
     *
     * scope: `integrasi:webhook`
     *
     * @param int|string $id ID langganan (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWebhookKeluarByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/webhook-keluar/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim event uji
     *
     * Event `webhook.uji`, langsung dikirim dan hasilnya dikembalikan.
     *
     * `POST /v1/integrasi/webhook-keluar/{id}/uji`
     *
     * scope: `integrasi:webhook`
     *
     * @param int|string $id ID langganan (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWebhookKeluarByIdUji(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/webhook-keluar/{id}/uji', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat kiriman
     *
     * `GET /v1/integrasi/webhook-keluar/{id}/kiriman`
     *
     * scope: `integrasi:webhook` · berhalaman
     *
     * @param int|string $id ID langganan (UUID)
     * @param array{status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getWebhookKeluarByIdKiriman(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/webhook-keluar/{id}/kiriman', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim ulang satu kiriman
     *
     * `POST /v1/integrasi/webhook-keluar/{id}/kiriman/{kiriman}/ulang`
     *
     * scope: `integrasi:webhook`
     *
     * @param int|string $id ID langganan (UUID)
     * @param int|string $kiriman ID kiriman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postWebhookKeluarByIdKirimanByKirimanUlang(int|string $id, int|string $kiriman, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/webhook-keluar/{id}/kiriman/{kiriman}/ulang', ['id' => $id, 'kiriman' => $kiriman], $query, null, $options, false, false);
    }

    /**
     * Penyedia rapat yang aktif
     *
     * Kode dan nama penyedia (Zoom, Google Meet) yang bisa dipilih lewat field `penyedia`.
     *
     * `GET /v1/integrasi/rapat/penyedia`
     *
     * scope: `integrasi:rapat`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRapatPenyedia(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/rapat/penyedia', [], $query, null, $options, false, false);
    }

    /**
     * Daftar rapat
     *
     * Klien hanya melihat rapat buatannya sendiri; admin melihat semua (filter `klien_id`).
     *
     * `GET /v1/integrasi/rapat`
     *
     * scope: `integrasi:rapat` · berhalaman
     *
     * @param array{modul?: string, referensi?: string, status?: string, driver?: string, dari?: string, sampai?: string, klien_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRapat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/rapat', [], $query, null, $options, false, false);
    }

    /**
     * Buat ruang rapat
     *
     * Membuat meeting Zoom terjadwal atau acara Google Calendar dengan tautan Google Meet lewat penyedia utama kategori `rapat`
     * (atau `penyedia` tertentu). `mulai` dalam `zona_waktu` (bawaan zona penyedia, mis. Asia/Makassar); lama rapat lewat
     * `durasi_menit` atau `selesai`. Jawaban memuat `url_gabung` untuk peserta dan `url_host` (Zoom) untuk penyelenggara.
     *
     * `POST /v1/integrasi/rapat`
     *
     * scope: `integrasi:rapat`
     *
     * @param array{judul: string|null, agenda?: string|null, mulai: string|null, durasi_menit?: int|null, selesai?: string|null, zona_waktu?: string|null, penyedia?: string|null, modul?: string|null, referensi?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRapat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/rapat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail rapat
     *
     * `GET /v1/integrasi/rapat/{id}`
     *
     * scope: `integrasi:rapat`
     *
     * @param int|string $id ID rapat (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRapatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/rapat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah judul/waktu rapat
     *
     * Perubahan dikirim juga ke Zoom/Google.
     *
     * `PATCH /v1/integrasi/rapat/{id}`
     *
     * scope: `integrasi:rapat`
     *
     * @param int|string $id ID rapat (UUID)
     * @param array{judul: string|null, agenda?: string|null, mulai: string|null, durasi_menit?: int|null, selesai?: string|null, zona_waktu?: string|null, penyedia?: string|null, modul?: string|null, referensi?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchRapatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/integrasi/rapat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan rapat
     *
     * Meeting Zoom/acara Google dihapus. `?paksa=1` tetap menandai dibatalkan bila penyedia gagal dihubungi.
     *
     * `DELETE /v1/integrasi/rapat/{id}`
     *
     * scope: `integrasi:rapat`
     *
     * @param int|string $id ID rapat (UUID)
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRapatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/integrasi/rapat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tandatangani PDF
     *
     * Menandatangani PDF dengan sertifikat elektronik BSrE milik penanda tangan (`nik` + `passphrase`, dikirim setiap kali
     * dan tidak disimpan). Sumber PDF: `berkas_id` (berkas di /v1/integrasi/berkas milik klien), field `berkas` (multipart),
     * atau `file_base64`. `tampilan.jenis` invisible (bawaan) atau visible dengan `halaman`, `x`, `y`, `lebar`, `tinggi`
     * (point PDF) atau `tag` (teks penanda posisi di dokumen), dan `gambar` (PNG base64). Hasil disimpan sebagai berkas baru
     * di folder `esign` (jawaban `berkas` memuat URL unduh); `kembalikan_pdf: true` juga mengembalikan `pdf_base64`.
     * Riwayat hanya menyimpan 4 digit akhir NIK dan hash SHA-256 dokumen.
     *
     * `POST /v1/integrasi/esign/tanda-tangan`
     *
     * scope: `integrasi:esign`
     *
     * @param array{nik: string|null, passphrase: string|null, berkas_id?: string|null, file_base64?: string|null, judul?: string|null, tampilan?: array<string, mixed>, penyedia?: string|null, penyimpanan?: string|null, simpan?: bool, kembalikan_pdf?: bool, modul?: string|null, referensi?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEsignTandaTangan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/esign/tanda-tangan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Verifikasi PDF bertanda tangan
     *
     * Sumber PDF sama seperti tanda tangan. Jawaban: `valid`, `kesimpulan`, daftar `penanda` (nama, penerbit sertifikat, waktu, keutuhan dokumen), dan `ditandatangani_lewat_siakad` bila hash dokumen cocok dengan hasil tanda tangan lewat SIAKAD.
     *
     * `POST /v1/integrasi/esign/verifikasi`
     *
     * scope: `integrasi:esign`
     *
     * @param array{berkas_id?: string|null, file_base64?: string|null, judul?: string|null, penyedia?: string|null, modul?: string|null, referensi?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEsignVerifikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/esign/verifikasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cek sertifikat penanda tangan
     *
     * Memeriksa apakah NIK sudah punya sertifikat elektronik aktif di BSrE (`aktif`, `status`, mis. ISSUE/EXPIRED/NOT_REGISTERED). NIK tidak disimpan.
     *
     * `POST /v1/integrasi/esign/status-pengguna`
     *
     * scope: `integrasi:esign`
     *
     * @param array{nik: string|null, penyedia?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEsignStatusPengguna(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/esign/status-pengguna', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat tanda tangan dan verifikasi
     *
     * Klien hanya melihat riwayat miliknya; admin melihat semua (filter `klien_id`).
     *
     * `GET /v1/integrasi/esign`
     *
     * scope: `integrasi:esign` · berhalaman
     *
     * @param array{jenis?: string, status?: string, modul?: string, referensi?: string, klien_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEsign(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/esign', [], $query, null, $options, false, false);
    }

    /**
     * Detail riwayat
     *
     * `GET /v1/integrasi/esign/{id}`
     *
     * scope: `integrasi:esign`
     *
     * @param int|string $id ID (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEsignById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/esign/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penyedia AI yang aktif
     *
     * Kode, driver, dan model penyedia AI yang bisa dipilih lewat field `penyedia`.
     *
     * `GET /v1/integrasi/ai/penyedia`
     *
     * scope: `integrasi:ai`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAiPenyedia(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/ai/penyedia', [], $query, null, $options, false, false);
    }

    /**
     * Minta jawaban model bahasa
     *
     * Mengirim `prompt` (teks tunggal) atau `pesan` (percakapan bergantian user/assistant, diakhiri user) ke penyedia
     * utama kategori `ai` atau `penyedia` tertentu. `sistem` ditambahkan setelah instruksi sistem bawaan penyedia. Claude
     * (bawaan claude-opus-5-5) memakai adaptive thinking dan fallback server-side; `effort` (low-max) mengatur kedalaman.
     * `maks_token` dibatasi pengaturan penyedia. Bila pengaman model menolak, jawaban `ditolak: true` dengan `teks` kosong.
     * Isi percakapan tidak disimpan; token dicatat per klien dan dibatasi `kuota_harian_token` (429 bila habis).
     *
     * `POST /v1/integrasi/ai/teks`
     *
     * scope: `integrasi:ai`
     *
     * @param array{prompt?: string|null, pesan?: list<mixed>, sistem?: string|null, maks_token?: int|null, effort?: string|null, json?: bool, penyedia?: string|null, modul?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAiTeks(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/integrasi/ai/teks', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekap pemakaian AI
     *
     * Jumlah permintaan dan token per hari, klien, dan model. Klien melihat miliknya; admin semua (filter `klien_id`).
     *
     * `GET /v1/integrasi/ai/pemakaian`
     *
     * scope: `integrasi:ai`
     *
     * @param array{dari?: string, sampai?: string, klien_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAiPemakaian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/integrasi/ai/pemakaian', [], $query, null, $options, false, false);
    }
}
