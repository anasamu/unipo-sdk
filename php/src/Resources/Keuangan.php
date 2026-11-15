<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Keuangan, Keuangan: Tagihan, Keuangan: Tarif, Keuangan: Denda, Keuangan: Pembayaran dan kwitansi, Keuangan: Kasir, Keuangan: Refund dan deposit, Keuangan: Potongan, Keuangan: Rekonsiliasi dan laporan, Keuangan: Mahasiswa, Keuangan: Pengaturan, Keuangan: UKT, Keuangan: Dispensasi, Keuangan: Cicilan
 */
final class Keuangan extends Resource
{
    /**
     * Master biaya per prodi dan periode
     *
     * `GET /v1/keuangan/biaya`
     *
     * scope: `keuangan:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBiaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/biaya', [], $query, null, $options, false, false);
    }

    /**
     * Transaksi pembayaran
     *
     * Untuk aplikasi keuangan/bank. Tidak untuk token mahasiswa/dosen.
     *
     * `GET /v1/keuangan/pembayaran`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{tahun_id?: string, prodi?: string, nim?: string, kode_biaya?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembayaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pembayaran', [], $query, null, $options, false, false);
    }

    /**
     * Hak akses keuangan saya
     *
     * Pengelola keuangan (ADMIN, BAK, KEUANGAN, peran keuangan:kelola) atau mahasiswa, prodi yang boleh, tahun aktif, mode tagihan SIAKAD, dan sesi kasir terbuka.
     *
     * `GET /v1/keuangan/saya`
     *
     * scope: `keuangan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Tarif biaya prodi per periode
     *
     * Baris m_biaya (Setup Biaya): kode biaya, shift, angkatan (semester_masuk), kampus, nominal, persen syarat KRS/ujian/her. Tarif per prodi dan per angkatan ada di sini.
     *
     * `GET /v1/keuangan/tarif`
     *
     * scope: `keuangan:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTarif(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tarif', [], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah tarif
     *
     * Body: {"kode_biaya", "kode_shift", "kampus", "semester_masuk", "rupiah", "persen_krs", "persen_ujian", "persen_her", "jenis", "idb" (untuk ubah)}. Aturan dan query sama dengan form Setup Biaya (syarat_krs = N bila persen_krs 0).
     *
     * `POST /v1/keuangan/tarif`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTarif(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tarif', [], $query, null, $options, false, false);
    }

    /**
     * Jenis biaya (item biaya)
     *
     * m_item_biaya.
     *
     * `GET /v1/keuangan/tarif/item`
     *
     * scope: `keuangan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTarifItem(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tarif/item', [], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah jenis biaya
     *
     * Body: {"kode_biaya", "item_biaya"}. Query menu Master Jenis Biaya.
     *
     * `POST /v1/keuangan/tarif/item`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTarifItem(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tarif/item', [], $query, null, $options, false, false);
    }

    /**
     * Salin tarif dari periode lain
     *
     * Body: {"sumber": "20242"}. Sama dengan tombol Copy Setup Biaya.
     *
     * `POST /v1/keuangan/tarif/salin`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTarifSalin(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tarif/salin', [], $query, null, $options, false, false);
    }

    /**
     * Hapus tarif
     *
     * Menu lama ikut menghapus tagihan biaya itu. Ditolak 409 bila sudah ada tagihan, kecuali body {"paksa": true}.
     *
     * `POST /v1/keuangan/tarif/{idb}/hapus`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $idb m_biaya.idb
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTarifByIdbHapus(int|string $idb, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tarif/{idb}/hapus', ['idb' => $idb], $query, null, $options, false, false);
    }

    /**
     * Daftar tagihan
     *
     * Tagihan per periode dengan dibayar dan sisa (monitoring tagihan). Mahasiswa melihat miliknya. meta.jumlah = total tagihan/dibayar/sisa.
     *
     * `GET /v1/keuangan/tagihan`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{nim?: string, kode_biaya?: string, status?: string, q?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTagihan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tagihan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah tagihan (satu atau massal)
     *
     * Body: {"nim": "..." atau [...], "kode_biaya", "rupiah", "tahun_id"} atau {"data": [{"nim","kode_biaya","rupiah"}], "tahun_id"} (maks. 2000). Aturan impor tagihan menu Input Tagihan: biaya harus terdaftar di m_biaya untuk prodi/periode/shift/angkatan; mahasiswa tanpa status periode itu diberi status N (perilaku lama). Dipakai juga untuk tagihan wisuda, registrasi, dan tagihan lain per jenis biaya.
     *
     * `POST /v1/keuangan/tagihan`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTagihan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tagihan', [], $query, null, $options, false, false);
    }

    /**
     * Rekap tagihan per prodi
     *
     * Jumlah mahasiswa aktif/tertagih, total tagihan, dibayar, sisa, lunas, dan per jenis biaya.
     *
     * `GET /v1/keuangan/tagihan/rekap`
     *
     * scope: `keuangan:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTagihanRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tagihan/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Generate tagihan otomatis
     *
     * Body: {"kode_biaya": [...], "nim": [...], "timpa": false, "pratinjau": true}. Untuk mahasiswa berstatus A pada periode: setiap tarif m_biaya yang cocok (shift, angkatan, kampus). Nominal dari kelompok UKT mahasiswa bila ditetapkan. Tagihan yang sudah ada dilewati kecuali timpa.
     *
     * `POST /v1/keuangan/tagihan/generate`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTagihanGenerate(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tagihan/generate', [], $query, null, $options, false, false);
    }

    /**
     * Generate tagihan dari KRS (tarif per mata kuliah)
     *
     * Body: {"kode_biaya", "pratinjau"}. Jumlah tarif per SKS/per MK (/keuangan/tarif-mk) atas KRS periode, ditulis sebagai satu tagihan per mahasiswa.
     *
     * `POST /v1/keuangan/tagihan/generate-mk`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTagihanGenerateMk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tagihan/generate-mk', [], $query, null, $options, false, false);
    }

    /**
     * Kirim notifikasi tagihan
     *
     * Body: {"hanya_belum_lunas": true, "nim": [...], "pesan"}. Ringkasan tagihan dikirim ke kotak masuk mahasiswa (/v1/notif/kotak).
     *
     * `POST /v1/keuangan/tagihan/kirim`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTagihanKirim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tagihan/kirim', [], $query, null, $options, false, false);
    }

    /**
     * Detail tagihan
     *
     * Tagihan + baris pembayaran t_mahasiswa_bayar + transaksi API + jatuh tempo.
     *
     * `GET /v1/keuangan/tagihan/{idmb}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $idmb t_mahasiswa_bayar_tagihan.idmb
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTagihanByIdmb(int|string $idmb, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tagihan/{idmb}', ['idmb' => $idmb], $query, null, $options, false, false);
    }

    /**
     * Ubah nominal tagihan
     *
     * Body: {"rupiah", "sebab"}. Query popup ubah tagihan; tidak boleh di bawah yang sudah dibayar.
     *
     * `POST /v1/keuangan/tagihan/{idmb}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $idmb t_mahasiswa_bayar_tagihan.idmb
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTagihanByIdmb(int|string $idmb, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tagihan/{idmb}', ['idmb' => $idmb], $query, null, $options, false, false);
    }

    /**
     * Hapus tagihan
     *
     * Menu lama ikut menghapus pembayarannya. Ditolak 409 bila sudah dibayar, kecuali body {"paksa": true}.
     *
     * `POST /v1/keuangan/tagihan/{idmb}/hapus`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $idmb t_mahasiswa_bayar_tagihan.idmb
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTagihanByIdmbHapus(int|string $idmb, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tagihan/{idmb}/hapus', ['idmb' => $idmb], $query, null, $options, false, false);
    }

    /**
     * Hitung dan tagihkan denda
     *
     * Body: {"pratinjau": true}. Dari periode pembayaran yang lewat jatuh tempo (tetap, per hari, atau persen sisa, dibatasi denda_maks); mahasiswa dengan dispensasi/cicilan disetujui dilewati. Bisa diulang: denda diperbarui, bukan dobel.
     *
     * `POST /v1/keuangan/denda/hitung`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDendaHitung(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/denda/hitung', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pembayaran lewat API
     *
     * Filter prodi, nim, tahun_id, metode, status, kasir_id, dari, sampai. Mahasiswa melihat miliknya.
     *
     * `GET /v1/keuangan/transaksi`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTransaksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/transaksi', [], $query, null, $options, false, false);
    }

    /**
     * Catat pembayaran (kasir/offline)
     *
     * Body: {"nim", "tahun_id", "kode_biaya", "jumlah", "potongan", "tanggal", "metode": "tunai|transfer|va|online|lainnya", "keterangan", "referensi"}. Ditulis ke t_mahasiswa_bayar dengan langkah popup input pembayaran (validasi nominal, cek_her_persen, m_log). Tidak boleh melebihi sisa tagihan. referensi sama = tidak dicatat dua kali. Pembayaran kasir masuk ke sesi kasir yang terbuka. Menghasilkan kwitansi digital.
     *
     * `POST /v1/keuangan/transaksi`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTransaksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/transaksi', [], $query, null, $options, false, false);
    }

    /**
     * Detail pembayaran
     *
     * `GET /v1/keuangan/transaksi/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTransaksiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/transaksi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan pembayaran
     *
     * Body: {"alasan"}. Baris t_mahasiswa_bayar yang dibuat transaksi ini dihapus (langkah hapus pembayaran menu Cek Pembayaran, tercatat di m_log); angsuran dan deposit dikembalikan.
     *
     * `POST /v1/keuangan/transaksi/{id}/batal`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTransaksiByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/transaksi/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kwitansi digital
     *
     * Data cetak kwitansi: kop PT, mahasiswa, jenis biaya, jumlah + terbilang, petugas, kode verifikasi (untuk QR).
     *
     * `GET /v1/keuangan/transaksi/{id}/kwitansi`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTransaksiByIdKwitansi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/transaksi/{id}/kwitansi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Verifikasi kwitansi (publik)
     *
     * Tanpa token, untuk QR di kwitansi. NIM dan nama disamarkan.
     *
     * `GET /v1/keuangan/kwitansi/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKwitansiVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/kwitansi/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Buka sesi kasir
     *
     * Body: {"saldo_awal", "loket"}. Satu sesi terbuka per kasir.
     *
     * `POST /v1/keuangan/kasir/buka`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKasirBuka(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/kasir/buka', [], $query, null, $options, false, false);
    }

    /**
     * Tutup sesi kasir
     *
     * Body: {"setoran", "catatan"}. Selisih = setoran - (saldo awal + total tunai). Rekap per metode.
     *
     * `POST /v1/keuangan/kasir/{id}/tutup`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKasirByIdTutup(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/kasir/{id}/tutup', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Saldo dan mutasi deposit
     *
     * Mahasiswa melihat miliknya.
     *
     * `GET /v1/keuangan/deposit/{nim}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDepositByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/deposit/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Tambah saldo deposit
     *
     * Pengelola. Body: {"nim", "jumlah", "keterangan", "referensi"}.
     *
     * `POST /v1/keuangan/deposit`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDeposit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/deposit', [], $query, null, $options, false, false);
    }

    /**
     * Bayar tagihan dari deposit
     *
     * Body: {"nim" (pengelola), "tahun_id", "kode_biaya", "jumlah" (bawaan sisa, dibatasi saldo)}. Mahasiswa boleh untuk miliknya. Dicatat sebagai pembayaran metode deposit.
     *
     * `POST /v1/keuangan/deposit/pakai`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDepositPakai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/deposit/pakai', [], $query, null, $options, false, false);
    }

    /**
     * Pakai voucher
     *
     * Body: {"kode", "nim" (pengelola), "tahun_id", "kode_biaya"}. Potongan langsung diterapkan ke tagihan (nominal tagihan dikurangi).
     *
     * `POST /v1/keuangan/voucher/pakai`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVoucherPakai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/voucher/pakai', [], $query, null, $options, false, false);
    }

    /**
     * Invoice pembayaran online
     *
     * Mahasiswa melihat miliknya.
     *
     * `GET /v1/keuangan/invoice`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInvoice(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/invoice', [], $query, null, $options, false, false);
    }

    /**
     * Buat invoice pembayaran online
     *
     * Body: {"nim" (pengelola), "tahun_id", "kode_biaya", "jumlah" (bawaan sisa)}. Lalu POST /v1/integrasi/pembayaran {"sumber": {"modul": "keuangan", "referensi": nomor}, "metode": "va|qris|checkout"}; saat lunas pembayaran otomatis tercatat ke SIAKAD + kwitansi.
     *
     * `POST /v1/keuangan/invoice`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postInvoice(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/invoice', [], $query, null, $options, false, false);
    }

    /**
     * Rekonsiliasi pembayaran
     *
     * VA dibayar (keu_va) dan pembayaran online lunas yang belum tercatat di t_mahasiswa_bayar, plus perbandingan harian SIAKAD vs transaksi API.
     *
     * `GET /v1/keuangan/rekonsiliasi`
     *
     * scope: `keuangan:read`
     *
     * @param array{prodi?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekonsiliasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/rekonsiliasi', [], $query, null, $options, false, false);
    }

    /**
     * Catat VA ke SIAKAD
     *
     * VA yang sudah dibayar (keu_va) dicatat sebagai pembayaran. Idempoten.
     *
     * `POST /v1/keuangan/rekonsiliasi/va/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id keu_va.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRekonsiliasiVaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/rekonsiliasi/va/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Teruskan ulang pembayaran online
     *
     * Invoice yang lunas di payment gateway tetapi belum tercatat. Idempoten per order_id.
     *
     * `POST /v1/keuangan/rekonsiliasi/online/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id keu_mhs_invoice.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRekonsiliasiOnlineById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/rekonsiliasi/online/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Laporan keuangan mahasiswa
     *
     * Sama dengan /tagihan/rekap.
     *
     * `GET /v1/keuangan/laporan`
     *
     * scope: `keuangan:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/laporan', [], $query, null, $options, false, false);
    }

    /**
     * Penerimaan harian
     *
     * Total t_mahasiswa_bayar per tanggal + rincian metode dari transaksi API.
     *
     * `GET /v1/keuangan/laporan/harian`
     *
     * scope: `keuangan:read`
     *
     * @param array{prodi?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanHarian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/laporan/harian', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan keuangan mahasiswa
     *
     * Tagihan per periode (sama dengan Riwayat Keuangan), deposit, cicilan, potongan, dispensasi, invoice aktif, denda.
     *
     * `GET /v1/keuangan/mahasiswa/{nim}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Syarat keuangan KRS dan ujian
     *
     * Hasil aturan bayar SIAKAD (cek_spp_persen untuk KRS, cek_spp_persen_ujian untuk ujian) + dispensasi disetujui. Untuk aplikasi KRS/ujian.
     *
     * `GET /v1/keuangan/mahasiswa/{nim}/syarat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimSyarat(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/mahasiswa/{nim}/syarat', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Periode pembayaran: daftar
     *
     * Jatuh tempo pembayaran per periode akademik (opsional per prodi dan jenis biaya) beserta aturan denda keterlambatan. Dipakai /keuangan/denda/hitung dan status jatuh tempo tagihan. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/periode`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, tahun_id?: string, kode_prodi?: string, denda_jenis?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/periode', [], $query, null, $options, false, false);
    }

    /**
     * Periode pembayaran: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keuangan/periode`
     *
     * scope: `keuangan:write`
     *
     * @param array{tahun_id: string, kode_prodi?: string, kode_biaya?: string, nama: string, mulai: string, jatuh_tempo: string, denda_jenis?: string, denda_nilai?: float|int, denda_maks?: float|int, kode_biaya_denda?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode pembayaran: detail
     *
     * Jatuh tempo pembayaran per periode akademik (opsional per prodi dan jenis biaya) beserta aturan denda keterlambatan. Dipakai /keuangan/denda/hitung dan status jatuh tempo tagihan. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/periode/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode pembayaran: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/periode/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tahun_id: string, kode_prodi?: string, kode_biaya?: string, nama: string, mulai: string, jatuh_tempo: string, denda_jenis?: string, denda_nilai?: float|int, denda_maks?: float|int, kode_biaya_denda?: string, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode pembayaran: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/keuangan/periode/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kelompok UKT: daftar
     *
     * Kelompok UKT per prodi (opsional per angkatan) dengan nominal untuk satu jenis biaya (m_item_biaya). Mahasiswa yang ditetapkan ke kelompok ditagih dengan nominal ini saat generate tagihan. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/ukt/kelompok`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktKelompok(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/ukt/kelompok', [], $query, null, $options, false, false);
    }

    /**
     * Kelompok UKT: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keuangan/ukt/kelompok`
     *
     * scope: `keuangan:write`
     *
     * @param array{kode_prodi: string, semester_masuk?: string, kelompok: string, nama?: string, kode_biaya: string, rupiah: float|int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUktKelompok(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/ukt/kelompok', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kelompok UKT: detail
     *
     * Kelompok UKT per prodi (opsional per angkatan) dengan nominal untuk satu jenis biaya (m_item_biaya). Mahasiswa yang ditetapkan ke kelompok ditagih dengan nominal ini saat generate tagihan. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/ukt/kelompok/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktKelompokById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/ukt/kelompok/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kelompok UKT: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/ukt/kelompok/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode_prodi: string, semester_masuk?: string, kelompok: string, nama?: string, kode_biaya: string, rupiah: float|int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUktKelompokById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/ukt/kelompok/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kelompok UKT: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/keuangan/ukt/kelompok/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUktKelompokById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/ukt/kelompok/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penetapan UKT mahasiswa: daftar
     *
     * Kelompok UKT tiap mahasiswa. Satu penetapan aktif (ditetapkan) per mahasiswa per jenis biaya; penetapan baru otomatis membatalkan yang lama. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/ukt/mahasiswa`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, kelompok_id?: string, berlaku_mulai?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktMahasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/ukt/mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Penetapan UKT mahasiswa: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keuangan/ukt/mahasiswa`
     *
     * scope: `keuangan:write`
     *
     * @param array{nim: string, kelompok_id: int, berlaku_mulai?: string, dasar?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUktMahasiswa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/ukt/mahasiswa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penetapan UKT mahasiswa: detail
     *
     * Kelompok UKT tiap mahasiswa. Satu penetapan aktif (ditetapkan) per mahasiswa per jenis biaya; penetapan baru otomatis membatalkan yang lama. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/ukt/mahasiswa/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktMahasiswaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/ukt/mahasiswa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penetapan UKT mahasiswa: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/ukt/mahasiswa/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, kelompok_id: int, berlaku_mulai?: string, dasar?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUktMahasiswaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/ukt/mahasiswa/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penetapan UKT mahasiswa: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/keuangan/ukt/mahasiswa/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUktMahasiswaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/ukt/mahasiswa/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tarif per mata kuliah: daftar
     *
     * Tarif per SKS atau per mata kuliah (kode_mk kosong = berlaku untuk semua mata kuliah yang tidak punya tarif khusus). Dipakai POST /keuangan/tagihan/generate-mk untuk menagih dari KRS. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/tarif-mk`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kode_prodi?: string, tahun_id?: string, dasar?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTarifMk(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tarif-mk', [], $query, null, $options, false, false);
    }

    /**
     * Tarif per mata kuliah: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keuangan/tarif-mk`
     *
     * scope: `keuangan:write`
     *
     * @param array{kode_prodi: string, tahun_id: string, kode_mk?: string, kode_biaya: string, dasar?: string, rupiah: float|int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTarifMk(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/tarif-mk', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tarif per mata kuliah: detail
     *
     * Tarif per SKS atau per mata kuliah (kode_mk kosong = berlaku untuk semua mata kuliah yang tidak punya tarif khusus). Dipakai POST /keuangan/tagihan/generate-mk untuk menagih dari KRS. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/tarif-mk/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTarifMkById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tarif-mk/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tarif per mata kuliah: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/tarif-mk/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode_prodi: string, tahun_id: string, kode_mk?: string, kode_biaya: string, dasar?: string, rupiah: float|int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTarifMkById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/tarif-mk/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tarif per mata kuliah: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/keuangan/tarif-mk/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTarifMkById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/tarif-mk/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Voucher: daftar
     *
     * Kode voucher potongan. Mahasiswa memakainya lewat POST /keuangan/voucher/pakai; potongan langsung mengurangi tagihan. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/voucher`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, kode_prodi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVoucher(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/voucher', [], $query, null, $options, false, false);
    }

    /**
     * Voucher: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keuangan/voucher`
     *
     * scope: `keuangan:write`
     *
     * @param array{kode: string, nama: string, jenis?: string, nilai: float|int, maks_potongan?: float|int, kode_biaya?: string, kode_prodi?: string, kuota?: int, berlaku_mulai?: string, berlaku_sampai?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postVoucher(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/voucher', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Voucher: detail
     *
     * Kode voucher potongan. Mahasiswa memakainya lewat POST /keuangan/voucher/pakai; potongan langsung mengurangi tagihan. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/voucher/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVoucherById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/voucher/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Voucher: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/voucher/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, jenis?: string, nilai: float|int, maks_potongan?: float|int, kode_biaya?: string, kode_prodi?: string, kuota?: int, berlaku_mulai?: string, berlaku_sampai?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putVoucherById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/voucher/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Voucher: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/keuangan/voucher/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteVoucherById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/voucher/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Potongan tagihan: daftar
     *
     * Potongan, beasiswa, atau keringanan atas satu tagihan. Saat diterapkan, nominal tagihan di t_mahasiswa_bayar_tagihan dikurangi (query ubah tagihan menu Keuangan, tercatat di m_log); dibatalkan = dikembalikan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/potongan`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, tahun_id?: string, jenis?: string, voucher_id?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPotongan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/potongan', [], $query, null, $options, false, false);
    }

    /**
     * Potongan tagihan: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keuangan/potongan`
     *
     * scope: `keuangan:write`
     *
     * @param array{nim: string, tahun_id?: string, kode_biaya: string, jenis?: string, nominal?: float|int, persen?: float|int, alasan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPotongan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/potongan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Potongan tagihan: detail
     *
     * Potongan, beasiswa, atau keringanan atas satu tagihan. Saat diterapkan, nominal tagihan di t_mahasiswa_bayar_tagihan dikurangi (query ubah tagihan menu Keuangan, tercatat di m_log); dibatalkan = dikembalikan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/potongan/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPotonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/potongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Potongan tagihan: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/potongan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, tahun_id?: string, kode_biaya: string, jenis?: string, nominal?: float|int, persen?: float|int, alasan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPotonganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/potongan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Potongan tagihan: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/keuangan/potongan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePotonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/potongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Potongan tagihan: Terapkan potongan ke tagihan SIAKAD
     *
     * Pengelola modul. Status harus diajukan, menjadi diterapkan.
     *
     * `POST /v1/keuangan/potongan/{id}/terapkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPotonganByIdTerapkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/potongan/{id}/terapkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Potongan tagihan: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/keuangan/potongan/{id}/tolak`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPotonganByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/potongan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Potongan tagihan: Batalkan (potongan yang sudah diterapkan dikembalikan ke tagihan)
     *
     * Pengelola modul. Status harus diajukan/diterapkan, menjadi dibatalkan.
     *
     * `POST /v1/keuangan/potongan/{id}/batalkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPotonganByIdBatalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/potongan/{id}/batalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: daftar
     *
     * Mahasiswa mengajukan dispensasi (tetap boleh KRS/ujian dengan janji bayar); pengelola keuangan memutuskan. Dispensasi yang disetujui tampil di GET /keuangan/mahasiswa/{nim}/syarat dan otomatis mengecualikan aturan dinamis kategori keuangan (/v1/aturan) di KRS/ujian. Syarat pengajuan diatur aturan titik keuangan.dispensasi.ajukan. Aturan syarat bayar di halaman SIAKAD lama tidak diubah. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/dispensasi`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, tahun_id?: string, untuk?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDispensasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/dispensasi', [], $query, null, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/keuangan/dispensasi`
     *
     * scope: `keuangan:write`
     *
     * @param array{nim: string, tahun_id?: string, untuk?: string, janji_bayar?: string, jumlah_janji?: float|int, alasan: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDispensasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/dispensasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: detail
     *
     * Mahasiswa mengajukan dispensasi (tetap boleh KRS/ujian dengan janji bayar); pengelola keuangan memutuskan. Dispensasi yang disetujui tampil di GET /keuangan/mahasiswa/{nim}/syarat dan otomatis mengecualikan aturan dinamis kategori keuangan (/v1/aturan) di KRS/ujian. Syarat pengajuan diatur aturan titik keuangan.dispensasi.ajukan. Aturan syarat bayar di halaman SIAKAD lama tidak diubah. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/dispensasi/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDispensasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/dispensasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/dispensasi/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, tahun_id?: string, untuk?: string, janji_bayar?: string, jumlah_janji?: float|int, alasan: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDispensasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/dispensasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/keuangan/dispensasi/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDispensasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/dispensasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/keuangan/dispensasi/{id}/berkas`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDispensasiByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/dispensasi/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/keuangan/dispensasi/{id}/berkas`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDispensasiByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/dispensasi/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Dispensasi pembayaran: unduh lampiran
     *
     * `GET /v1/keuangan/dispensasi/{id}/berkas/{uuid}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDispensasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/dispensasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/keuangan/dispensasi/{id}/berkas/{uuid}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDispensasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/dispensasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: Setujui
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/keuangan/dispensasi/{id}/setujui`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDispensasiByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/dispensasi/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/keuangan/dispensasi/{id}/tolak`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDispensasiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/dispensasi/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dispensasi pembayaran: Batalkan
     *
     * Pemilik data atau pengelola. Status harus diajukan/disetujui, menjadi dibatalkan.
     *
     * `POST /v1/keuangan/dispensasi/{id}/batalkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDispensasiByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/dispensasi/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cicilan pembayaran: daftar
     *
     * Mahasiswa mengajukan cicilan untuk satu tagihan; saat disetujui angsuran bulanan dibuat dari sisa tagihan. Pembayaran tagihan yang sama (lewat API) otomatis mengisi angsuran berurutan; semua lunas = status lunas. Syarat pengajuan (mis. jumlah angsuran maksimal) diatur aturan titik keuangan.cicilan.ajukan (/v1/aturan). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/cicilan`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, tahun_id?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCicilan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/cicilan', [], $query, null, $options, false, false);
    }

    /**
     * Cicilan pembayaran: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/keuangan/cicilan`
     *
     * scope: `keuangan:write`
     *
     * @param array{nim: string, tahun_id?: string, kode_biaya: string, jumlah_angsuran: int, mulai?: string, alasan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCicilan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/cicilan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cicilan pembayaran: detail
     *
     * Mahasiswa mengajukan cicilan untuk satu tagihan; saat disetujui angsuran bulanan dibuat dari sisa tagihan. Pembayaran tagihan yang sama (lewat API) otomatis mengisi angsuran berurutan; semua lunas = status lunas. Syarat pengajuan (mis. jumlah angsuran maksimal) diatur aturan titik keuangan.cicilan.ajukan (/v1/aturan). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/cicilan/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCicilanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/cicilan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cicilan pembayaran: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/cicilan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, tahun_id?: string, kode_biaya: string, jumlah_angsuran: int, mulai?: string, alasan?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putCicilanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/cicilan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cicilan pembayaran: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/keuangan/cicilan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteCicilanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/cicilan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cicilan pembayaran: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/keuangan/cicilan/{id}/berkas`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCicilanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/cicilan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cicilan pembayaran: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/keuangan/cicilan/{id}/berkas`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCicilanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/cicilan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Cicilan pembayaran: unduh lampiran
     *
     * `GET /v1/keuangan/cicilan/{id}/berkas/{uuid}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCicilanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/cicilan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Cicilan pembayaran: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/keuangan/cicilan/{id}/berkas/{uuid}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteCicilanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/cicilan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Cicilan pembayaran: Setujui dan buat jadwal angsuran
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/keuangan/cicilan/{id}/setujui`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, mulai?: string, jumlah_angsuran?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCicilanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/cicilan/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cicilan pembayaran: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/keuangan/cicilan/{id}/tolak`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCicilanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/cicilan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cicilan pembayaran: Batalkan
     *
     * Pemilik data atau pengelola. Status harus diajukan/disetujui, menjadi dibatalkan.
     *
     * `POST /v1/keuangan/cicilan/{id}/batalkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCicilanByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/cicilan/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Refund: daftar
     *
     * Pengembalian dana (kelebihan bayar, batal studi). Tujuan deposit: saat disetujui saldo deposit langsung bertambah (status dibayar). Tujuan rekening: disetujui lalu ditandai dibayar setelah transfer. Pembayaran di t_mahasiswa_bayar tidak dihapus; untuk membatalkan pembayaran yang salah pakai POST /keuangan/transaksi/{id}/batal. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/refund`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, transaksi_id?: string, tujuan?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRefund(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/refund', [], $query, null, $options, false, false);
    }

    /**
     * Refund: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/keuangan/refund`
     *
     * scope: `keuangan:write`
     *
     * @param array{nim: string, transaksi_id?: int, jumlah: float|int, alasan: string, tujuan?: string, bank?: string, no_rekening?: string, atas_nama?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRefund(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/refund', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Refund: detail
     *
     * Pengembalian dana (kelebihan bayar, batal studi). Tujuan deposit: saat disetujui saldo deposit langsung bertambah (status dibayar). Tujuan rekening: disetujui lalu ditandai dibayar setelah transfer. Pembayaran di t_mahasiswa_bayar tidak dihapus; untuk membatalkan pembayaran yang salah pakai POST /keuangan/transaksi/{id}/batal. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/refund/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRefundById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/refund/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Refund: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/refund/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, transaksi_id?: int, jumlah: float|int, alasan: string, tujuan?: string, bank?: string, no_rekening?: string, atas_nama?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRefundById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/refund/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Refund: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/keuangan/refund/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRefundById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/refund/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Refund: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/keuangan/refund/{id}/berkas`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRefundByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/refund/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Refund: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/keuangan/refund/{id}/berkas`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRefundByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/refund/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Refund: unduh lampiran
     *
     * `GET /v1/keuangan/refund/{id}/berkas/{uuid}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRefundByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/refund/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Refund: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/keuangan/refund/{id}/berkas/{uuid}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRefundByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/refund/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Refund: Setujui (tujuan deposit langsung masuk saldo)
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/keuangan/refund/{id}/setujui`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRefundByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/refund/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Refund: Tandai sudah ditransfer
     *
     * Pengelola modul. Status harus disetujui, menjadi dibayar.
     *
     * `POST /v1/keuangan/refund/{id}/bayar`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{bukti_bayar?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRefundByIdBayar(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/refund/{id}/bayar', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Refund: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/keuangan/refund/{id}/tolak`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRefundByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/refund/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Refund: Batalkan
     *
     * Pemilik data atau pengelola. Status harus diajukan, menjadi dibatalkan.
     *
     * `POST /v1/keuangan/refund/{id}/batalkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRefundByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/refund/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Denda keterlambatan: daftar
     *
     * Denda yang dihitung POST /keuangan/denda/hitung dari periode pembayaran. Nominal ditagihkan sebagai tagihan kode_biaya_denda di tabel lama. Dihapuskan = tagihan denda dinolkan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/denda`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, tahun_id?: string, periode_id?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDenda(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/denda', [], $query, null, $options, false, false);
    }

    /**
     * Denda keterlambatan: detail
     *
     * Denda yang dihitung POST /keuangan/denda/hitung dari periode pembayaran. Nominal ditagihkan sebagai tagihan kode_biaya_denda di tabel lama. Dihapuskan = tagihan denda dinolkan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/denda/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDendaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/denda/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Denda keterlambatan: Hapuskan denda (tagihan denda dinolkan)
     *
     * Pengelola modul. Status harus aktif, menjadi dihapuskan.
     *
     * `POST /v1/keuangan/denda/{id}/hapuskan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDendaByIdHapuskan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/denda/{id}/hapuskan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sesi kasir: daftar
     *
     * Sesi loket kasir. Buka dengan POST /keuangan/kasir/buka, tutup dengan POST /keuangan/kasir/{id}/tutup. Pembayaran oleh kasir yang sesinya terbuka otomatis masuk ke sesi itu. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/kasir`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKasir(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/kasir', [], $query, null, $options, false, false);
    }

    /**
     * Sesi kasir: detail
     *
     * Sesi loket kasir. Buka dengan POST /keuangan/kasir/buka, tutup dengan POST /keuangan/kasir/{id}/tutup. Pembayaran oleh kasir yang sesinya terbuka otomatis masuk ke sesi itu. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/kasir/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKasirById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/kasir/{id}', ['id' => $id], $query, null, $options, false, false);
    }
}
