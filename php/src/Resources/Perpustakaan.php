<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Perpustakaan: Katalog, Perpustakaan: Pengelolaan koleksi, Perpustakaan: Sirkulasi, Perpustakaan: Layanan anggota, Perpustakaan: Laporan dan integrasi, Perpustakaan: Layanan
 */
final class Perpustakaan extends Resource
{
    /**
     * Cari katalog (OPAC)
     *
     * Tanpa token. sumber=siakad (bawaan, t_pustaka) atau slims (database SLiMS bila disambungkan). Filter q (judul, kata kunci, ISBN, ID pustaka, nama penulis/penerbit), katalog, jenis (P/B), rak, format, tahun, penulis, penerbit, tersedia=1. Tiap judul: jumlah eksemplar dan yang tersedia di rak.
     *
     * `GET /v1/perpustakaan/katalog`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{q?: string, sumber?: string, katalog?: string, jenis?: string, tersedia?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/katalog', [], $query, null, $options, false, true);
    }

    /**
     * Rincian koleksi
     *
     * Tanpa token. Data koleksi, daftar eksemplar dengan status (ada, pinjam + jatuh tempo, rusak, hilang), dan antrean reservasi.
     *
     * `GET /v1/perpustakaan/katalog/{idpus}`
     *
     * publik (tanpa token)
     *
     * @param int|string $idpus ID pustaka
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalogByIdpus(int|string $idpus, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/katalog/{idpus}', ['idpus' => $idpus], $query, null, $options, false, true);
    }

    /**
     * Rincian judul SLiMS
     *
     * Tanpa token. Judul, penulis, penerbit, eksemplar dengan status pinjam dan jatuh tempo dari database SLiMS.
     *
     * `GET /v1/perpustakaan/slims/katalog/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id biblio_id SLiMS
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSlimsKatalogById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/slims/katalog/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Referensi katalog
     *
     * Tanpa token. Daftar katalog/rak/format/penulis/penerbit dengan jumlah judul.
     *
     * `GET /v1/perpustakaan/referensi/{jenis}`
     *
     * publik (tanpa token)
     *
     * @param int|string $jenis katalog, rak, format, penulis, penerbit
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensiByJenis(int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/referensi/{jenis}', ['jenis' => $jenis], $query, null, $options, false, true);
    }

    /**
     * Tambah referensi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). rak/format: {nama jenis (mis. "rak"), keterangan}; katalog: {kode, nama, keterangan}; penulis: {kode, nama, kontak, biografi, gelardepan, gelarbelakang}; penerbit: {kode, nama, alamat, telpon, email, fax, website, kontak, keterangan}.
     *
     * `POST /v1/perpustakaan/referensi/{jenis}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $jenis katalog, rak, format, penulis, penerbit
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postReferensiByJenis(int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/referensi/{jenis}', ['jenis' => $jenis], $query, null, $options, false, false);
    }

    /**
     * Tambah koleksi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body: idpus, judul, penulis (kode r_penulis), penerbit (kode r_penerbit), format (id r_format), rak (id r_rak), katalog (kode r_katalog) wajib; abstraksi, keyword, tahun, keteranganfisik, keterangan, harga, stok, hilang, rusak, denda (per hari), jenis (P/B), isbn, alih_bahasa. Query menu Data Koleksi + m_log.
     *
     * `POST /v1/perpustakaan/koleksi`
     *
     * scope: `perpustakaan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKoleksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/koleksi', [], $query, null, $options, false, false);
    }

    /**
     * Ubah koleksi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Kolom yang tidak dikirim tetap. Cover tetap diunggah lewat menu lama.
     *
     * `POST /v1/perpustakaan/koleksi/{idpus}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $idpus ID pustaka
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKoleksiByIdpus(int|string $idpus, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/koleksi/{idpus}', ['idpus' => $idpus], $query, null, $options, false, false);
    }

    /**
     * Hapus koleksi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Koleksi beserta eksemplarnya (langkah hapus menu Data Koleksi). Ditolak bila ada eksemplar yang dipinjam.
     *
     * `POST /v1/perpustakaan/koleksi/{idpus}/hapus`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $idpus ID pustaka
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKoleksiByIdpusHapus(int|string $idpus, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/koleksi/{idpus}/hapus', ['idpus' => $idpus], $query, null, $options, false, false);
    }

    /**
     * Tambah eksemplar
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body {"ideks", "tgl_masuk"?, "penerimaan"?: P|L|S, "status"?: A|R|H}. ID barcode = idpus.ideks seperti menu lama.
     *
     * `POST /v1/perpustakaan/koleksi/{idpus}/eksemplar`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $idpus ID pustaka
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKoleksiByIdpusEksemplar(int|string $idpus, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/koleksi/{idpus}/eksemplar', ['idpus' => $idpus], $query, null, $options, false, false);
    }

    /**
     * Ubah eksemplar
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body {"tgl_masuk"?, "penerimaan"?, "status"?: A|R|H}. Status P hanya lewat sirkulasi.
     *
     * `POST /v1/perpustakaan/eksemplar/{idbarcode}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $idbarcode ID barcode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEksemplarByIdbarcode(int|string $idbarcode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/eksemplar/{idbarcode}', ['idbarcode' => $idbarcode], $query, null, $options, false, false);
    }

    /**
     * Hapus eksemplar
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Ditolak bila sedang dipinjam.
     *
     * `POST /v1/perpustakaan/eksemplar/{idbarcode}/hapus`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $idbarcode ID barcode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEksemplarByIdbarcodeHapus(int|string $idbarcode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/eksemplar/{idbarcode}/hapus', ['idbarcode' => $idbarcode], $query, null, $options, false, false);
    }

    /**
     * Ubah referensi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA).
     *
     * `POST /v1/perpustakaan/referensi/{jenis}/{id}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $jenis katalog, rak, format, penulis, penerbit
     * @param int|string $id ID referensi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postReferensiByJenisById(int|string $jenis, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/referensi/{jenis}/{id}', ['jenis' => $jenis, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus referensi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Ditolak bila masih dipakai koleksi.
     *
     * `POST /v1/perpustakaan/referensi/{jenis}/{id}/hapus`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $jenis katalog, rak, format, penulis, penerbit
     * @param int|string $id ID referensi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postReferensiByJenisByIdHapus(int|string $jenis, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/referensi/{jenis}/{id}/hapus', ['jenis' => $jenis, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Data anggota
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Peminjam (NIDN dosen, NIM mahasiswa, NIK karyawan, urutan pemeriksaan menu lama), status aktif, pinjaman aktif dengan perkiraan denda, reservasi aktif.
     *
     * `GET /v1/perpustakaan/anggota/{username}`
     *
     * scope: `perpustakaan:read`
     *
     * @param int|string $username NIM/NIDN/NIK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAnggotaByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/anggota/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Pinjam
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body {"username", "idbarcode"}. Langkah menu Peminjaman & Pengembalian: eksemplar jenis P berstatus A, anggota aktif; tgl kembali = hari ini + lama pinjam (m_durasi_pinjam); t_eksemplar menjadi P; m_log. Ditambah batas pinjam (pengaturan) dan eksemplar yang disiapkan untuk reservasi anggota lain.
     *
     * `POST /v1/perpustakaan/pinjam`
     *
     * scope: `perpustakaan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPinjam(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/pinjam', [], $query, null, $options, false, false);
    }

    /**
     * Kembalikan
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body {"idbarcode", "username"?}. Denda disimpan seperti daftar pinjaman menu lama (hari terlambat tanpa Minggu × denda per hari koleksi), eksemplar kembali A, peminjaman K, m_log. Reservasi tertua untuk judul itu otomatis siap diambil dan anggotanya mendapat notifikasi.
     *
     * `POST /v1/perpustakaan/kembali`
     *
     * scope: `perpustakaan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKembali(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/kembali', [], $query, null, $options, false, false);
    }

    /**
     * Daftar peminjaman
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Filter status (P/K), terlambat=1, username, tahun_id, dari/sampai (tgl pinjam).
     *
     * `GET /v1/perpustakaan/pinjaman`
     *
     * scope: `perpustakaan:read` · berhalaman
     *
     * @param array{status?: string, terlambat?: string, username?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPinjaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/pinjaman', [], $query, null, $options, false, false);
    }

    /**
     * Perpanjang peminjaman
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Tgl kembali + lama pinjam. Ditolak bila sudah terlambat, batas perpanjangan tercapai, atau ada reservasi anggota lain.
     *
     * `POST /v1/perpustakaan/pinjaman/{id}/perpanjang`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $id idpinjam
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPinjamanByIdPerpanjang(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/pinjaman/{id}/perpanjang', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus peminjaman
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Langkah tombol hapus menu lama: eksemplar kembali A lalu baris peminjaman dihapus (hanya yang masih P).
     *
     * `POST /v1/perpustakaan/pinjaman/{id}/hapus`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $id idpinjam
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPinjamanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/pinjaman/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar reservasi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Filter status (menunggu, siap, diambil, batal, kedaluwarsa), username, idpus. Reservasi siap yang lewat batas ambil otomatis kedaluwarsa dan eksemplarnya diteruskan ke antrean berikutnya.
     *
     * `GET /v1/perpustakaan/reservasi`
     *
     * scope: `perpustakaan:read` · berhalaman
     *
     * @param array{status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReservasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/reservasi', [], $query, null, $options, false, false);
    }

    /**
     * Buat reservasi untuk anggota
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body {"username", "idpus"}. Hanya bila semua eksemplar sedang dipinjam.
     *
     * `POST /v1/perpustakaan/reservasi`
     *
     * scope: `perpustakaan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postReservasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/reservasi', [], $query, null, $options, false, false);
    }

    /**
     * Batalkan reservasi
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body {"catatan"?}.
     *
     * `POST /v1/perpustakaan/reservasi/{id}/batal`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $id ID reservasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postReservasiByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/reservasi/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perpustakaan saya
     *
     * Status keanggotaan, pinjaman aktif (jatuh tempo, perkiraan denda), reservasi, riwayat pinjam, dan aturan layanan untuk pengguna token (NIM/NIDN/NIK).
     *
     * `GET /v1/perpustakaan/saya`
     *
     * scope: `perpustakaan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Perpanjang pinjaman saya
     *
     * Aturan sama dengan perpanjangan oleh petugas.
     *
     * `POST /v1/perpustakaan/saya/pinjaman/{id}/perpanjang`
     *
     * scope: `perpustakaan:write` · hanya token pengguna
     *
     * @param int|string $id idpinjam
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPinjamanByIdPerpanjang(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/saya/pinjaman/{id}/perpanjang', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Reservasi koleksi
     *
     * Body {"idpus"}. Hanya bila semua eksemplar sedang dipinjam; notifikasi dikirim saat eksemplar siap diambil.
     *
     * `POST /v1/perpustakaan/saya/reservasi`
     *
     * scope: `perpustakaan:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaReservasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/saya/reservasi', [], $query, null, $options, false, false);
    }

    /**
     * Batalkan reservasi saya
     *
     * `POST /v1/perpustakaan/saya/reservasi/{id}/batal`
     *
     * scope: `perpustakaan:write` · hanya token pengguna
     *
     * @param int|string $id ID reservasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaReservasiByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/saya/reservasi/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cek bebas pustaka saya
     *
     * Pinjaman aktif dan denda di SIAKAD dan SLiMS.
     *
     * `GET /v1/perpustakaan/saya/bebas-pustaka`
     *
     * scope: `perpustakaan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaBebasPustaka(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/saya/bebas-pustaka', [], $query, null, $options, false, false);
    }

    /**
     * Isi buku tamu
     *
     * Untuk kios/aplikasi dengan login SSO. Body {"keperluan"?}. Dalam 30 menit tidak dicatat dua kali.
     *
     * `POST /v1/perpustakaan/saya/kunjungan`
     *
     * scope: `perpustakaan:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaKunjungan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/saya/kunjungan', [], $query, null, $options, false, false);
    }

    /**
     * Pemeriksaan bebas pustaka
     *
     * Pengelola perpustakaan, BAK, OPERATOR, PROGDI (mahasiswa prodinya), DIREKTUR, atau token aplikasi. bebas = tidak ada pinjaman aktif di SIAKAD dan tidak ada pinjaman/denda di SLiMS (bila tersambung). Juga dipakai syarat kelulusan jenis bebas_pustaka.
     *
     * `GET /v1/perpustakaan/bebas-pustaka/{username}`
     *
     * scope: `perpustakaan:read`
     *
     * @param int|string $username NIM/NIDN/NIK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBebasPustakaByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/bebas-pustaka/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Laporan perpustakaan
     *
     * Pengelola dan DIREKTUR. Koleksi per status/katalog, peminjaman pada periode (per jenis anggota, prodi, bulan, terpopuler, denda), keterlambatan saat ini, kunjungan, reservasi, usulan. Filter dari/sampai (bawaan bulan berjalan), prodi.
     *
     * `GET /v1/perpustakaan/laporan`
     *
     * scope: `perpustakaan:read`
     *
     * @param array{dari?: string, sampai?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/laporan', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan layanan
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Lama pinjam (m_durasi_pinjam), batas pinjam/perpanjang/reservasi, dan status sambungan SLiMS.
     *
     * `GET /v1/perpustakaan/pengaturan`
     *
     * scope: `perpustakaan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah pengaturan layanan
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Body {"lama_pinjam_hari"? (query menu Setting), "maks_pinjam"? (null = tanpa batas), "maks_perpanjang"?, "maks_reservasi"?, "hari_ambil_reservasi"?, "bebas_pustaka_slims"?}.
     *
     * `POST /v1/perpustakaan/pengaturan`
     *
     * scope: `perpustakaan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Anggota di SLiMS
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Data anggota SLiMS (member_id = NIM/NIDN/NIK), pinjaman aktif, saldo denda.
     *
     * `GET /v1/perpustakaan/slims/anggota/{username}`
     *
     * scope: `perpustakaan:read`
     *
     * @param int|string $username member_id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSlimsAnggotaByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/slims/anggota/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Ekspor anggota untuk SLiMS
     *
     * Pengelola perpustakaan (ADMIN, PUSTAKA). Mahasiswa aktif, dosen aktif, dan karyawan dalam kolom impor anggota SLiMS (member_id = NIM/NIDN/NIK, member_type_name Mahasiswa/Dosen/Karyawan). format=csv untuk berkas impor (tanpa baris judul). Filter jenis, prodi, angkatan, berlaku_sampai, instansi.
     *
     * `GET /v1/perpustakaan/anggota-slims`
     *
     * scope: `perpustakaan:read`
     *
     * @param array{format?: string, jenis?: string, prodi?: string, angkatan?: string, berlaku_sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAnggotaSlims(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/anggota-slims', [], $query, null, $options, false, false);
    }

    /**
     * Buku tamu kunjungan: daftar
     *
     * Dicatat petugas (atau lewat POST /v1/perpustakaan/saya/kunjungan oleh anggota). Isi username untuk anggota (NIM/NIDN/NIK): nama, jenis, dan prodi diisi otomatis. Tamu luar: kosongkan username, isi nama dan instansi. Hanya pengelola modul.
     *
     * `GET /v1/perpustakaan/kunjungan`
     *
     * scope: `perpustakaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, keperluan?: string, kode_prodi?: string, username?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunjungan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/kunjungan', [], $query, null, $options, false, false);
    }

    /**
     * Buku tamu kunjungan: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/perpustakaan/kunjungan`
     *
     * scope: `perpustakaan:write`
     *
     * @param array{username?: string, nama?: string, instansi?: string, keperluan?: string, waktu?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKunjungan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/kunjungan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buku tamu kunjungan: detail
     *
     * Dicatat petugas (atau lewat POST /v1/perpustakaan/saya/kunjungan oleh anggota). Isi username untuk anggota (NIM/NIDN/NIK): nama, jenis, dan prodi diisi otomatis. Tamu luar: kosongkan username, isi nama dan instansi. Hanya pengelola modul.
     *
     * `GET /v1/perpustakaan/kunjungan/{id}`
     *
     * scope: `perpustakaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunjunganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/kunjungan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buku tamu kunjungan: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/perpustakaan/kunjungan/{id}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username?: string, nama?: string, instansi?: string, keperluan?: string, waktu?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKunjunganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/perpustakaan/kunjungan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buku tamu kunjungan: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/perpustakaan/kunjungan/{id}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKunjunganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/perpustakaan/kunjungan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buku tamu kunjungan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Dicatat petugas (atau lewat POST /v1/perpustakaan/saya/kunjungan oleh anggota). Isi username untuk anggota (NIM/NIDN/NIK): nama, jenis, dan prodi diisi otomatis. Tamu luar: kosongkan username, isi nama dan instansi. Hanya pengelola modul.
     *
     * `GET /v1/perpustakaan/kunjungan/{id}/riwayat`
     *
     * scope: `perpustakaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunjunganByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/kunjungan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Usulan pengadaan koleksi: daftar
     *
     * Dosen, mahasiswa, dan karyawan mengusulkan judul untuk dibeli; pengusul hanya melihat usulannya sendiri dan bisa mengubah selama status diajukan. Pengelola mengisi status (disetujui, ditolak, dipesan, tersedia), tanggapan, dan idpus koleksi setelah tersedia; pengusul mendapat notifikasi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengusul).
     *
     * `GET /v1/perpustakaan/usulan`
     *
     * scope: `perpustakaan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pengusul?: string, status?: string, kode_prodi?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/usulan', [], $query, null, $options, false, false);
    }

    /**
     * Usulan pengadaan koleksi: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengusul diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/perpustakaan/usulan`
     *
     * scope: `perpustakaan:write`
     *
     * @param array{judul: string, penulis?: string, penerbit?: string, tahun?: int, isbn?: string, jumlah?: int, alasan?: string, pengusul?: string, status?: string, tanggapan?: string, idpus?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUsulan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/perpustakaan/usulan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pengadaan koleksi: detail
     *
     * Dosen, mahasiswa, dan karyawan mengusulkan judul untuk dibeli; pengusul hanya melihat usulannya sendiri dan bisa mengubah selama status diajukan. Pengelola mengisi status (disetujui, ditolak, dipesan, tersedia), tanggapan, dan idpus koleksi setelah tersedia; pengusul mendapat notifikasi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengusul).
     *
     * `GET /v1/perpustakaan/usulan/{id}`
     *
     * scope: `perpustakaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/usulan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Usulan pengadaan koleksi: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengusul diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/perpustakaan/usulan/{id}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, penulis?: string, penerbit?: string, tahun?: int, isbn?: string, jumlah?: int, alasan?: string, pengusul?: string, status?: string, tanggapan?: string, idpus?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUsulanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/perpustakaan/usulan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Usulan pengadaan koleksi: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengusul diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/perpustakaan/usulan/{id}`
     *
     * scope: `perpustakaan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUsulanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/perpustakaan/usulan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Usulan pengadaan koleksi: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Dosen, mahasiswa, dan karyawan mengusulkan judul untuk dibeli; pengusul hanya melihat usulannya sendiri dan bisa mengubah selama status diajukan. Pengelola mengisi status (disetujui, ditolak, dipesan, tersedia), tanggapan, dan idpus koleksi setelah tersedia; pengusul mendapat notifikasi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengusul).
     *
     * `GET /v1/perpustakaan/usulan/{id}/riwayat`
     *
     * scope: `perpustakaan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUsulanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/perpustakaan/usulan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }
}
