<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Notifikasi: Kotak masuk, Notifikasi: Pengumuman, Notifikasi: Pemicu, Notifikasi: Preferensi, Notifikasi: Antrean
 */
final class Notif extends Resource
{
    /**
     * Jumlah belum dibaca
     *
     * belum_dibaca (tanpa label yang dibisukan), username pemilik kotak, label: [{modul, total, belum, bisu}], bisu: [modul].
     *
     * `GET /v1/notif/ringkas`
     *
     * scope: `notif:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/ringkas', [], $query, null, $options, false, false);
    }

    /**
     * Tandai semua dibaca
     *
     * Milik pemanggil. Body opsional {modul} (satu label) atau {id: [..]} (beberapa notifikasi).
     *
     * `POST /v1/notif/kotak/baca-semua`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKotakBacaSemua(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kotak/baca-semua', [], $query, null, $options, false, false);
    }

    /**
     * Bersihkan notifikasi
     *
     * Hapus lunak milik pemanggil. Body {cakupan: dibaca|semua|pilih, modul?, id?: [..]}. Jawaban {dibersihkan, id} untuk urungkan.
     *
     * `POST /v1/notif/kotak/bersihkan`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKotakBersihkan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kotak/bersihkan', [], $query, null, $options, false, false);
    }

    /**
     * Urungkan bersihkan
     *
     * Body {id: [..]}: pulihkan milik pemanggil yang dibersihkan dalam 24 jam terakhir.
     *
     * `POST /v1/notif/kotak/pulihkan`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKotakPulihkan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kotak/pulihkan', [], $query, null, $options, false, false);
    }

    /**
     * Bisukan label
     *
     * Body {modul, bisu: bool}. Label yang dibisukan tidak dihitung di lencana dan tidak tampil di tab Semua; notifikasinya tetap ada di tab labelnya.
     *
     * `POST /v1/notif/kotak/bisu`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKotakBisu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kotak/bisu', [], $query, null, $options, false, false);
    }

    /**
     * Kirim notifikasi
     *
     * Untuk aplikasi lain atau pengelola: body {"username": [..], "judul", "isi", "tautan", "modul"}. Masuk kotak masuk penerima dan antrean kanal sesuai preferensi mereka.
     *
     * `POST /v1/notif/kirim`
     *
     * scope: `notif:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKirim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kirim', [], $query, null, $options, false, false);
    }

    /**
     * Pengumuman aktif
     *
     * Pengumuman yang sedang tayang untuk pemanggil di aplikasi ini (sasaran aplikasi, unit, peran termasuk jenis akun `akun:*`, jadwal; yang sudah ditutup atau dihapus tidak ikut). Tautan konten portal di-resolve ke alamat baca terbaru. Tanpa token pengguna = hanya yang ditandai publik.
     *
     * `GET /v1/notif/pita`
     *
     * publik (tanpa token)
     *
     * @param array{aplikasi?: string, situs?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPita(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pita', [], $query, null, $options, false, true);
    }

    /**
     * Tutup pengumuman
     *
     * Tidak tampil lagi untuk akun ini di semua aplikasi.
     *
     * `POST /v1/notif/pita/{id}/tutup`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param int|string $id UUID pengumuman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPitaByIdTutup(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pita/{id}/tutup', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar pengumuman yang dikelola
     *
     * Admin/izin pengumuman:kelola global: semua; izin berlingkup unit: milik unitnya. Berisi status tayang (aktif, terjadwal, berakhir, draf, arsip), `publik`, dan `tautan_ref` (konten portal yang dirujuk). Yang dihapus tidak ikut.
     *
     * `GET /v1/notif/pita/kelola`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPitaKelola(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pita/kelola', [], $query, null, $options, false, false);
    }

    /**
     * Buat pengumuman
     *
     * Body {judul, isi?, tautan?, teks_tautan?, nada, mode: pita|banner|popup|toast|bawah, gambar?, opsi?: {ulang: sekali|sesi, hilang_detik}, mulai?, selesai?, dapat_ditutup?, prioritas?, status: draf|terbit|arsip, aplikasi?: [kode], unit?: [kode], peran?: [kode RBAC atau akun:mahasiswa|akun:dosen|akun:tendik|akun:alumni|akun:pendaftar], publik?: bool (tampil juga tanpa login), tautan_ref?: {jenis: berita|pengumuman|agenda|halaman, id} (konten portal terbit; tautan = URL manual hanya untuk pembuat tingkat universitas)}. Kosong = semua akun yang masuk. `jenis` lama masih diterima: jenis akun dipindah ke peran akun:*.
     *
     * `POST /v1/notif/pita/kelola`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPitaKelola(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pita/kelola', [], $query, null, $options, false, false);
    }

    /**
     * Hak membuat pengumuman
     *
     * semua (boleh semua sasaran), publik (boleh menandai publik), unit (unit yang boleh disasar), tautan_manual (boleh URL bebas), peran_akun (peran khusus jenis akun untuk sasaran peran).
     *
     * `GET /v1/notif/pita/hak`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPitaHak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pita/hak', [], $query, null, $options, false, false);
    }

    /**
     * Ubah pengumuman
     *
     * `POST /v1/notif/pita/kelola/{id}`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param int|string $id UUID pengumuman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPitaKelolaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pita/kelola/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus pengumuman
     *
     * Hapus lunak (deleted_at): hilang dari daftar kelola dan semua aplikasi.
     *
     * `POST /v1/notif/pita/kelola/{id}/hapus`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param int|string $id UUID pengumuman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPitaKelolaByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pita/kelola/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pilihan tautan Selengkapnya
     *
     * Konten portal terbit yang boleh dirujuk pemanggil (pembuat unit: situs unitnya dan situs universitas): jenis, id, judul, situs, tanggal, url (alamat baca). Konten tanpa alamat baca publik tidak ikut.
     *
     * `GET /v1/notif/pita/tautan`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array{q?: string, jenis?: string, per_page?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPitaTautan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pita/tautan', [], $query, null, $options, false, false);
    }

    /**
     * Perkiraan jumlah penerima
     *
     * Body {unit?, peran?, publik?} (jenis lama juga diterima).
     *
     * `POST /v1/notif/pita/perkiraan`
     *
     * scope: `notif:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPitaPerkiraan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pita/perkiraan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pemicu
     *
     * Pemicu notifikasi per aplikasi/unit: penerima bawaan (terkunci), penerima tambahan dari Pustikom, dan status aktif.
     *
     * `GET /v1/notif/pemicu`
     *
     * scope: `notif:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemicu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pemicu', [], $query, null, $options, false, false);
    }

    /**
     * Hidupkan/matikan pemicu
     *
     * Body {pemicu, aktif}.
     *
     * `POST /v1/notif/pemicu/setelan`
     *
     * scope: `notif:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemicuSetelan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pemicu/setelan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah penerima
     *
     * Body {pemicu, jenis: unit|peran|pengguna, nilai: kode unit | id peran RBAC | username, label?}. Penerima bawaan tidak bisa dihapus.
     *
     * `POST /v1/notif/pemicu/tambahan`
     *
     * scope: `notif:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemicuTambahan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pemicu/tambahan', [], $query, null, $options, false, false);
    }

    /**
     * Hapus penerima tambahan
     *
     * Body {pemicu}.
     *
     * `POST /v1/notif/pemicu/tambahan/{id}/hapus`
     *
     * scope: `notif:admin` · hanya token pengguna
     *
     * @param int|string $id ID penerima tambahan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemicuTambahanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pemicu/tambahan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau penerima
     *
     * Body {pemicu, data?}: jumlah dan contoh username penerima untuk data event (bawaan: contoh di katalog event).
     *
     * `POST /v1/notif/pemicu/pratinjau`
     *
     * scope: `notif:admin` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemicuPratinjau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pemicu/pratinjau', [], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: daftar
     *
     * Notifikasi milik pemilik token. Pengelola melihat kotak orang lain hanya dengan `username=<u>` atau `semua=1`. Filter `belum=1` untuk yang belum dibaca, `modul=<label>` untuk satu label, `kecuali=a,b` menyembunyikan label. Dibuat oleh modul lain atau POST /notif/kirim. Hapus = hapus lunak (deleted_at). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/kotak`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, modul?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKotak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/kotak', [], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: detail
     *
     * Notifikasi milik pemilik token. Pengelola melihat kotak orang lain hanya dengan `username=<u>` atau `semua=1`. Filter `belum=1` untuk yang belum dibaca, `modul=<label>` untuk satu label, `kecuali=a,b` menyembunyikan label. Dibuat oleh modul lain atau POST /notif/kirim. Hapus = hapus lunak (deleted_at). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/kotak/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKotakById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/kotak/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/notif/kotak/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKotakById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/notif/kotak/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Notifikasi milik pemilik token. Pengelola melihat kotak orang lain hanya dengan `username=<u>` atau `semua=1`. Filter `belum=1` untuk yang belum dibaca, `modul=<label>` untuk satu label, `kecuali=a,b` menyembunyikan label. Dibuat oleh modul lain atau POST /notif/kirim. Hapus = hapus lunak (deleted_at). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/kotak/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKotakByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/kotak/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kotak masuk: Tandai dibaca
     *
     * Pemilik data.
     *
     * `POST /v1/notif/kotak/{id}/baca`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKotakByIdBaca(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/kotak/{id}/baca', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: daftar
     *
     * Kanal tambahan pengguna (email, WhatsApp, push, Telegram); username diisi otomatis untuk pengguna biasa. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/preferensi`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, kanal?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPreferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/preferensi', [], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/notif/preferensi`
     *
     * scope: `notif:write`
     *
     * @param array{username: string, kanal: string, tujuan: string, modul?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPreferensi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/preferensi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Preferensi kanal: detail
     *
     * Kanal tambahan pengguna (email, WhatsApp, push, Telegram); username diisi otomatis untuk pengguna biasa. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/preferensi/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPreferensiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/preferensi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/notif/preferensi/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, kanal: string, tujuan: string, modul?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPreferensiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/notif/preferensi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Preferensi kanal: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/notif/preferensi/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePreferensiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/notif/preferensi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Preferensi kanal: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kanal tambahan pengguna (email, WhatsApp, push, Telegram); username diisi otomatis untuk pengguna biasa. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/notif/preferensi/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPreferensiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/preferensi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: daftar
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/notif/antrean`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kanal?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: detail
     *
     * Hanya pengelola modul.
     *
     * `GET /v1/notif/antrean/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/antrean/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Hanya pengelola modul.
     *
     * `GET /v1/notif/antrean/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/antrean/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: Kirim ulang
     *
     * Pengelola modul. Status harus gagal/dibatalkan, menjadi antre.
     *
     * `POST /v1/notif/antrean/{id}/ulang`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByIdUlang(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/antrean/{id}/ulang', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean pengiriman: Batalkan
     *
     * Pengelola modul. Status harus antre/gagal, menjadi dibatalkan.
     *
     * `POST /v1/notif/antrean/{id}/batalkan`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/antrean/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: daftar
     *
     * Pengumuman ke semua pengguna aktif, level tertentu, mahasiswa satu prodi/angkatan, atau daftar username. Aksi kirim membuat notifikasi di kotak masuk setiap penerima. Hanya pengelola modul.
     *
     * `GET /v1/notif/pengumuman`
     *
     * scope: `notif:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, sasaran?: string, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumuman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pengumuman', [], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/notif/pengumuman`
     *
     * scope: `notif:write`
     *
     * @param array{judul: string, isi: string, tautan?: string, sasaran?: string, level?: string, kode_prodi?: string, angkatan?: string, daftar_username?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengumuman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pengumuman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman massal: detail
     *
     * Pengumuman ke semua pengguna aktif, level tertentu, mahasiswa satu prodi/angkatan, atau daftar username. Aksi kirim membuat notifikasi di kotak masuk setiap penerima. Hanya pengelola modul.
     *
     * `GET /v1/notif/pengumuman/{id}`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/notif/pengumuman/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, isi: string, tautan?: string, sasaran?: string, level?: string, kode_prodi?: string, angkatan?: string, daftar_username?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengumumanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/notif/pengumuman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengumuman massal: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/notif/pengumuman/{id}`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/notif/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pengumuman ke semua pengguna aktif, level tertentu, mahasiswa satu prodi/angkatan, atau daftar username. Aksi kirim membuat notifikasi di kotak masuk setiap penerima. Hanya pengelola modul.
     *
     * `GET /v1/notif/pengumuman/{id}/riwayat`
     *
     * scope: `notif:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengumumanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/notif/pengumuman/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengumuman massal: Kirim
     *
     * Pengelola modul. Status harus draf, menjadi terkirim.
     *
     * `POST /v1/notif/pengumuman/{id}/kirim`
     *
     * scope: `notif:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengumumanByIdKirim(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/notif/pengumuman/{id}/kirim', ['id' => $id], $query, null, $options, false, false);
    }
}
