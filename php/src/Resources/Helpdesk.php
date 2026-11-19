<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Helpdesk: Publik, Helpdesk: Laporan bug, Helpdesk: Tiket saya, Helpdesk: Laporan, Helpdesk: Kategori, Helpdesk: Tiket
 */
final class Helpdesk extends Resource
{
    /**
     * Kirim tiket tanpa login
     *
     * Body: kategori_id (kategori publik), judul, isi, nama (wajib bila tidak anonim), email, hp, anonim. Mengembalikan nomor dan kode lacak (hanya sekali). Bila token pengguna dikirim, tiket juga tercatat atas nama pengguna itu.
     *
     * `POST /v1/helpdesk/publik/tiket`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPublikTiket(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/publik/tiket', [], $query, null, $options, false, true);
    }

    /**
     * Lacak tiket
     *
     * Status dan balasan (tanpa catatan internal dan nama petugas).
     *
     * `GET /v1/helpdesk/publik/lacak/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode lacak 12 karakter
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikLacakByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/publik/lacak/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Balas tiket
     *
     * Body: isi. Membuka kembali tiket yang menunggu pelapor/selesai.
     *
     * `POST /v1/helpdesk/publik/lacak/{kode}/balas`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode lacak
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPublikLacakByKodeBalas(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/publik/lacak/{kode}/balas', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Nilai layanan
     *
     * Body: rating 1-5, ulasan. Untuk tiket selesai; tiket lalu ditutup.
     *
     * `POST /v1/helpdesk/publik/lacak/{kode}/nilai`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode lacak
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPublikLacakByKodeNilai(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/publik/lacak/{kode}/nilai', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Laporan bug saya
     *
     * Tiket laporan bug milik pemanggil (terbaru dulu): nomor, judul, status, request_id, aplikasi. Token pengguna aplikasi mana pun; tanpa scope khusus.
     *
     * `GET /v1/helpdesk/galat`
     *
     * hanya token pengguna · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGalat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/galat', [], $query, null, $options, false, false);
    }

    /**
     * Laporkan kode galat
     *
     * Buat tiket kategori "Laporan bug aplikasi" (Pustikom) yang terhubung ke kode galat. Body: `request_id` (wajib), `judul`
     * (kosong = saran otomatis), `uraian` (apa yang sedang dilakukan), `url` (query rahasia seperti token/code dibuang),
     * `status_http`, `kode_galat`, `pesan`, `perangkat`, `waktu`. Tangkapan layar opsional (maks 5 MB): kirim sebagai
     * multipart/form-data dengan field file `lampiran` (body JSON dibatasi API_MAX_BODY), atau `lampiran_base64` + `nama_file`
     * untuk gambar kecil. Pelapor = pengguna token; token aplikasi tanpa pengguna butuh `helpdesk:write` dan wajib `pelapor` atau
     * `nama_pelapor`. Kode yang sama dari pelapor yang sama tidak membuat tiket baru: `uraian` ditambahkan sebagai komentar
     * (200, `baru: false`). Pengguna lain yang melaporkan kode yang sama mendapat tiket sendiri yang dikaitkan ke tiket pertama.
     * Petugas helpdesk Pustikom mendapat satu notifikasi per kode.
     *
     * `POST /v1/helpdesk/galat`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postGalat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/galat', [], $query, null, $options, false, false);
    }

    /**
     * Periksa kode galat
     *
     * Untuk panel lapor: aplikasi pemanggil (dari client_id token), tiket pemanggil untuk kode ini bila sudah pernah dilaporkan, dan jumlah laporan pengguna lain. Token pengguna aplikasi mana pun.
     *
     * `GET /v1/helpdesk/galat/{request_id}`
     *
     * hanya token pengguna
     *
     * @param int|string $request_id Kode laporan (request_id)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getGalatByRequestId(int|string $request_id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/galat/{request_id}', ['request_id' => $request_id], $query, null, $options, false, false);
    }

    /**
     * Ringkasan tiket saya
     *
     * Jumlah tiket milik pemanggil: total, terbuka, menunggu_anda (petugas meminta info), selesai (selesai + ditutup), ditolak, per_status.
     *
     * `GET /v1/helpdesk/saya/ringkasan`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/saya/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Kategori untuk tiket baru
     *
     * Kategori aktif dan publik (id, kode, nama, jenis, keterangan, sla_jam, unit). Laporan bug aplikasi dikirim lewat kode galat, bukan dari sini.
     *
     * `GET /v1/helpdesk/saya/kategori`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaKategori(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/saya/kategori', [], $query, null, $options, false, false);
    }

    /**
     * Daftar tiket saya
     *
     * Hanya tiket dengan pelapor = pemanggil. Menunggu balasan Anda tampil paling atas, lalu aktivitas terbaru. Petugas tampil sebagai nama.
     *
     * `GET /v1/helpdesk/saya/tiket`
     *
     * hanya token pengguna · berhalaman
     *
     * @param array{status?: string, kategori?: string, dari?: string, sampai?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaTiket(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/saya/tiket', [], $query, null, $options, false, false);
    }

    /**
     * Buat tiket
     *
     * Body: kategori_id (kategori publik), judul (min. 5), isi (min. 10). Lampiran opsional lewat multipart/form-data: lampiran_1..lampiran_3 (maks. 5 MB per berkas; PDF, gambar, dokumen). Prioritas selalu sedang; petugas ditentukan Pustikom/unit. Maks. 10 tiket per jam per pengguna.
     *
     * `POST /v1/helpdesk/saya/tiket`
     *
     * hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaTiket(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/saya/tiket', [], $query, null, $options, false, false);
    }

    /**
     * Rincian tiket saya
     *
     * Percakapan tanpa catatan internal petugas, lampiran (per balasan), konteks kode galat tanpa log server dan tanpa identitas pelapor lain, `aksi` yang tersedia (balas, tutup, buka, nilai, batas_buka). Tiket orang lain: 404.
     *
     * `GET /v1/helpdesk/saya/tiket/{id}`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID tiket
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaTiketById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/saya/tiket/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Balas tiket saya
     *
     * Body: isi; lampiran multipart lampiran_1..3 (maks. 5 MB). Tiket menunggu Anda atau selesai kembali diproses. Petugas mendapat notifikasi (satu per 10 menit untuk balasan beruntun).
     *
     * `POST /v1/helpdesk/saya/tiket/{id}/balas`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID tiket
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaTiketByIdBalas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/saya/tiket/{id}/balas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tutup tiket saya
     *
     * Body: alasan (opsional). Tiket terbuka atau selesai menjadi ditutup.
     *
     * `POST /v1/helpdesk/saya/tiket/{id}/tutup`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID tiket
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaTiketByIdTutup(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/saya/tiket/{id}/tutup', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buka kembali tiket saya
     *
     * Body: isi (alasan, min. 10), lampiran opsional. Hanya tiket selesai/ditutup dalam HELPDESK_BUKA_KEMBALI_HARI (bawaan 14) hari setelah selesai; nilai sebelumnya dihapus.
     *
     * `POST /v1/helpdesk/saya/tiket/{id}/buka`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID tiket
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaTiketByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/saya/tiket/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Nilai layanan
     *
     * Body: rating 1-5, ulasan (opsional, maks. 500). Sekali per tiket selesai/ditutup; tiket selesai lalu ditutup.
     *
     * `POST /v1/helpdesk/saya/tiket/{id}/nilai`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID tiket
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaTiketByIdNilai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/saya/tiket/{id}/nilai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh lampiran tiket saya
     *
     * PDF dan gambar tampil langsung.
     *
     * `GET /v1/helpdesk/saya/tiket/{id}/berkas/{uuid}`
     *
     * hanya token pengguna
     *
     * @param int|string $id ID tiket
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaTiketByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/saya/tiket/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Rekap kinerja layanan
     *
     * Jumlah tiket, terbuka/lewat tenggat, persentase selesai tepat waktu (SLA), rata-rata jam tanggapan pertama dan penyelesaian, kepuasan, per status dan kategori. Pengelola (dibatasi unitnya).
     *
     * `GET /v1/helpdesk/rekap`
     *
     * scope: `helpdesk:read`
     *
     * @param array{hari?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Kategori: daftar
     *
     * Semua pemilik token ber-scope helpdesk:read (selain pengelola hanya melihat aktif 1).
     *
     * `GET /v1/helpdesk/kategori`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, unit_id?: string, publik?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKategori(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/kategori', [], $query, null, $options, false, true);
    }

    /**
     * Kategori: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/helpdesk/kategori`
     *
     * scope: `helpdesk:write`
     *
     * @param array{kode: string, nama: string, jenis?: string, unit_id?: int, sla_jam?: int, publik?: bool, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKategori(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/kategori', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kategori: detail
     *
     * Semua pemilik token ber-scope helpdesk:read (selain pengelola hanya melihat aktif 1).
     *
     * `GET /v1/helpdesk/kategori/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKategoriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/kategori/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Kategori: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/helpdesk/kategori/{id}`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, jenis?: string, unit_id?: int, sla_jam?: int, publik?: bool, keterangan?: string, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKategoriById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/helpdesk/kategori/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kategori: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/helpdesk/kategori/{id}`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKategoriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/helpdesk/kategori/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kategori: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Semua pemilik token ber-scope helpdesk:read (selain pengelola hanya melihat aktif 1).
     *
     * `GET /v1/helpdesk/kategori/{id}/riwayat`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKategoriByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/kategori/{id}/riwayat', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Tiket: daftar
     *
     * Tiket dari pengguna yang login (pelapor = username otomatis) atau dari formulir publik (/helpdesk/publik/tiket, dilacak dengan kode). Unit penanggung jawab mengikuti kategori; petugas yang ditugaskan ikut melihat. Bila `anonim`, identitas pelapor hanya terlihat oleh pelapor dan admin modul. Percakapan lewat aksi `balas`. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pelapor).
     *
     * `GET /v1/helpdesk/tiket`
     *
     * scope: `helpdesk:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kategori_id?: string, unit_id?: string, pelapor?: string, anonim?: string, kanal?: string, prioritas?: string, status?: string, petugas?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTiket(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/tiket', [], $query, null, $options, false, false);
    }

    /**
     * Tiket: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status baru.
     *
     * `POST /v1/helpdesk/tiket`
     *
     * scope: `helpdesk:write`
     *
     * @param array{kategori_id: int, pelapor?: string, nama_pelapor?: string, email_pelapor?: string, hp_pelapor?: string, anonim?: bool, kanal?: string, judul: string, isi: string, prioritas?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiket(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tiket: detail
     *
     * Tiket dari pengguna yang login (pelapor = username otomatis) atau dari formulir publik (/helpdesk/publik/tiket, dilacak dengan kode). Unit penanggung jawab mengikuti kategori; petugas yang ditugaskan ikut melihat. Bila `anonim`, identitas pelapor hanya terlihat oleh pelapor dan admin modul. Percakapan lewat aksi `balas`. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pelapor).
     *
     * `GET /v1/helpdesk/tiket/{id}`
     *
     * scope: `helpdesk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTiketById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/tiket/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tiket: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status baru. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/helpdesk/tiket/{id}`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kategori_id: int, pelapor?: string, nama_pelapor?: string, email_pelapor?: string, hp_pelapor?: string, anonim?: bool, kanal?: string, judul: string, isi: string, prioritas?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTiketById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/helpdesk/tiket/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tiket: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status baru.
     *
     * `DELETE /v1/helpdesk/tiket/{id}`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTiketById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/helpdesk/tiket/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tiket: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Tiket dari pengguna yang login (pelapor = username otomatis) atau dari formulir publik (/helpdesk/publik/tiket, dilacak dengan kode). Unit penanggung jawab mengikuti kategori; petugas yang ditugaskan ikut melihat. Bila `anonim`, identitas pelapor hanya terlihat oleh pelapor dan admin modul. Percakapan lewat aksi `balas`. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pelapor).
     *
     * `GET /v1/helpdesk/tiket/{id}/riwayat`
     *
     * scope: `helpdesk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTiketByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/tiket/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tiket: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/helpdesk/tiket/{id}/berkas`
     *
     * scope: `helpdesk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTiketByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/tiket/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tiket: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status baru.
     *
     * `POST /v1/helpdesk/tiket/{id}/berkas`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiketByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Tiket: unduh lampiran
     *
     * `GET /v1/helpdesk/tiket/{id}/berkas/{uuid}`
     *
     * scope: `helpdesk:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTiketByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/helpdesk/tiket/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Tiket: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pelapor diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status baru.
     *
     * `DELETE /v1/helpdesk/tiket/{id}/berkas/{uuid}`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTiketByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/helpdesk/tiket/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Tiket: Balas
     *
     * Pelapor atau petugas menulis balasan. Petugas bisa menandai `internal` (tidak terlihat pelapor) dan `minta_info` (status jadi menunggu pelapor). Balasan pelapor pada tiket menunggu/selesai membuka kembali tiket. Pemilik data atau pengelola. Status harus baru/diproses/menunggu_pelapor/selesai.
     *
     * `POST /v1/helpdesk/tiket/{id}/balas`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{isi: string, internal?: bool, minta_info?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiketByIdBalas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket/{id}/balas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tiket: Ambil (tugaskan ke saya)
     *
     * Pengelola modul. Status harus baru/diproses/menunggu_pelapor, menjadi diproses.
     *
     * `POST /v1/helpdesk/tiket/{id}/ambil`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiketByIdAmbil(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket/{id}/ambil', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tiket: Tugaskan
     *
     * Pengelola modul. Status harus baru/diproses/menunggu_pelapor, menjadi diproses.
     *
     * `POST /v1/helpdesk/tiket/{id}/tugaskan`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{petugas: string, unit_id?: int, prioritas?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiketByIdTugaskan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket/{id}/tugaskan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tiket: Selesaikan
     *
     * Pengelola modul. Status harus baru/diproses/menunggu_pelapor, menjadi selesai.
     *
     * `POST /v1/helpdesk/tiket/{id}/selesaikan`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{isi: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiketByIdSelesaikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket/{id}/selesaikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tiket: Tolak
     *
     * Pengelola modul. Status harus baru/diproses, menjadi ditolak.
     *
     * `POST /v1/helpdesk/tiket/{id}/tolak`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{alasan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiketByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tiket: Tutup
     *
     * Pelapor menutup tiket yang selesai, opsional memberi nilai 1-5. Pemilik data atau pengelola. Status harus selesai, menjadi ditutup.
     *
     * `POST /v1/helpdesk/tiket/{id}/tutup`
     *
     * scope: `helpdesk:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{rating?: int, ulasan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTiketByIdTutup(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/helpdesk/tiket/{id}/tutup', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
