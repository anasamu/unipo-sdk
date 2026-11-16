<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kasir: Sesi, Kasir: Pengaturan, Kasir: Penerimaan, Kasir: Laporan, Kasir: Migrasi aplikasi lama
 */
final class Kasir extends Resource
{
    /**
     * Hak akses dan menu kasir saya
     *
     * Izin kasir.* beserta unit, menu yang tampil (kasir, riwayat, laporan, pengaturan, migrasi), jenis biaya yang boleh diterima/dilaporkan, perangkat (header X-Kasir-Perangkat), kop PT + logo, jam server.
     *
     * `GET /v1/kasir/saya`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar perangkat kasir
     *
     * Izin kasir.pengaturan global.
     *
     * `GET /v1/kasir/perangkat`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPerangkat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/perangkat', [], $query, null, $options, false, false);
    }

    /**
     * Daftarkan perangkat
     *
     * Body: {"perangkat_id", "nama", "unit_id", "versi", "os"}. Dipanggil setiap masuk; komputer baru mendapat kode loket K01, K02, ...
     *
     * `POST /v1/kasir/perangkat`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPerangkat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/perangkat', [], $query, null, $options, false, false);
    }

    /**
     * Cari mahasiswa
     *
     * NIM atau nama (min. 3 karakter), maks. 30 baris.
     *
     * `GET /v1/kasir/mahasiswa`
     *
     * scope: `kasir:read`
     *
     * @param array{q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa, tagihan, dan riwayat bayar
     *
     * Hanya jenis biaya yang boleh dilayani petugas.
     *
     * `GET /v1/kasir/mahasiswa/{nim}`
     *
     * scope: `kasir:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Terima pembayaran
     *
     * Body: {"uuid", "nim", "kode_biaya", "jumlah", "potongan", "ket_potongan", "tahun_id" (bawaan: periode tagihan), "metode": "tunai|transfer|lainnya", "referensi", "keterangan"}. Idempoten per uuid (status "sudah" bila pernah tercatat, mis. dikirim ulang saat koneksi putus). Ditulis ke t_mahasiswa_bayar lewat langkah popup input pembayaran. Tagihan otomatis hanya bila jenis biaya mengizinkan.
     *
     * `POST /v1/kasir/bayar`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBayar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/bayar', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat transaksi
     *
     * Petugas tanpa kasir.laporan hanya melihat transaksinya sendiri.
     *
     * `GET /v1/kasir/transaksi`
     *
     * scope: `kasir:read` · berhalaman
     *
     * @param array{nim?: string, kode_biaya?: string, status?: string, sumber?: string, petugas?: string, prodi?: string, perangkat?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTransaksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/transaksi', [], $query, null, $options, false, false);
    }

    /**
     * Data cetak kwitansi
     *
     * Kop + logo, nomor bukti, mahasiswa, prodi, kelas, keterangan, jumlah, potongan, tagihan, sisa, status bayar (LUNAS/BELUM LUNAS/BATAL), terbilang, penerima, kode verifikasi. ?logo=0 tanpa logo.
     *
     * `GET /v1/kasir/transaksi/{id}/kwitansi`
     *
     * scope: `kasir:read`
     *
     * @param int|string $id keu_mhs_transaksi.id
     * @param array{logo?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTransaksiByIdKwitansi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/transaksi/{id}/kwitansi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat cetak kwitansi
     *
     * Menambah hitungan cetak (cetak ulang tercatat).
     *
     * `POST /v1/kasir/transaksi/{id}/cetak`
     *
     * scope: `kasir:write`
     *
     * @param int|string $id keu_mhs_transaksi.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTransaksiByIdCetak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/transaksi/{id}/cetak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan pembayaran
     *
     * Izin kasir.batal untuk jenis biaya itu. Body: {"alasan"}. Langkah hapus pembayaran menu Cek Pembayaran.
     *
     * `POST /v1/kasir/transaksi/{id}/batal`
     *
     * scope: `kasir:write`
     *
     * @param int|string $id keu_mhs_transaksi.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTransaksiByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/transaksi/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ringkasan beranda
     *
     * Penerimaan hari ini, bulan ini, per jenis, dan milik saya.
     *
     * `GET /v1/kasir/ringkasan`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Laporan penerimaan
     *
     * Total, harian, per jenis, per petugas, per prodi, per metode.
     *
     * `GET /v1/kasir/laporan/penerimaan`
     *
     * scope: `kasir:read`
     *
     * @param array{dari?: string, sampai?: string, kode_biaya?: string, prodi?: string, petugas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanPenerimaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/laporan/penerimaan', [], $query, null, $options, false, false);
    }

    /**
     * Rincian penerimaan
     *
     * Baris pembayaran untuk dicetak/diekspor.
     *
     * `GET /v1/kasir/laporan/rincian`
     *
     * scope: `kasir:read` · berhalaman
     *
     * @param array{dari?: string, sampai?: string, kode_biaya?: string, prodi?: string, petugas?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanRincian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/laporan/rincian', [], $query, null, $options, false, false);
    }

    /**
     * Tunggakan per mahasiswa
     *
     * Tagihan belum lunas. meta.jumlah = total tagihan/dibayar/sisa.
     *
     * `GET /v1/kasir/laporan/tunggakan`
     *
     * scope: `kasir:read` · berhalaman
     *
     * @param array{tahun_id?: string, kode_biaya?: string, prodi?: string, angkatan?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanTunggakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/laporan/tunggakan', [], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa belum bayar
     *
     * Mahasiswa berstatus periode (bawaan A) yang belum membayar jenis biaya itu sama sekali.
     *
     * `GET /v1/kasir/laporan/belum-bayar`
     *
     * scope: `kasir:read` · berhalaman
     *
     * @param array{tahun_id?: string, kode_biaya?: string, prodi?: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanBelumBayar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/laporan/belum-bayar', [], $query, null, $options, false, false);
    }

    /**
     * Pembayaran per angkatan
     *
     * Matriks mahasiswa x jenis biaya (tagihan, dibayar, sisa) untuk satu angkatan.
     *
     * `GET /v1/kasir/laporan/angkatan`
     *
     * scope: `kasir:read`
     *
     * @param array{angkatan?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanAngkatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/laporan/angkatan', [], $query, null, $options, false, false);
    }

    /**
     * Jenis biaya per unit
     *
     * Pemegang kasir.pengaturan melihat semua (termasuk nonaktif); petugas melihat miliknya.
     *
     * `GET /v1/kasir/jenis`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Simpan jenis biaya per unit
     *
     * Body: {"kode_biaya", "nama" (wajib bila baru, dibuat di m_item_biaya), "unit_id", "perlakuan": "per_semester|satu_kali|per_sks|per_mk|sewaktu", "nominal_bawaan", "tagih_otomatis", "batasi_prodi", "potongan_kasir", "urutan", "aktif", "keterangan"}. Izin kasir.pengaturan global.
     *
     * `POST /v1/kasir/jenis`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Daftar unit
     *
     * Unit aktif (induk_unit) untuk pemilik jenis biaya dan perangkat. Izin kasir.pengaturan global.
     *
     * `GET /v1/kasir/unit`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/unit', [], $query, null, $options, false, false);
    }

    /**
     * Ubah perangkat
     *
     * Body: {"nama", "unit_id", "aktif"}. Perangkat nonaktif ditolak saat sinkron.
     *
     * `POST /v1/kasir/perangkat/{id}`
     *
     * scope: `kasir:write`
     *
     * @param int|string $id keu_kasir_perangkat.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPerangkatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/perangkat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peta kode lama ke SIAKAD
     *
     * Jenis biaya, periode, prodi, kelas, kampus. Izin kasir.migrasi.
     *
     * `GET /v1/kasir/migrasi/peta`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasiPeta(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/migrasi/peta', [], $query, null, $options, false, false);
    }

    /**
     * Simpan peta kode
     *
     * Body: {"data": [{"jenis", "kode_lama", "kode_baru" (kosong = dilewati), "nama_lama", "perlakuan", "catatan", "buat": {"nama", "unit_id", "perlakuan"} (buat jenis biaya baru)}]}.
     *
     * `POST /v1/kasir/migrasi/peta`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMigrasiPeta(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/migrasi/peta', [], $query, null, $options, false, false);
    }

    /**
     * Saran peta dari referensi lama
     *
     * Body: {"jenis": [...], "periode": [...], "prodi": [...], "kelas": [...], "kampus": [...], "nim": [...]}. Tidak menulis apa pun.
     *
     * `POST /v1/kasir/migrasi/analisis`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMigrasiAnalisis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/migrasi/analisis', [], $query, null, $options, false, false);
    }

    /**
     * Pratinjau / terapkan migrasi
     *
     * Body: {"pratinjau": true (bawaan), "batch", "buat_status", "rinci", "mahasiswa": [{"nim", "kode_prodi", "kode_kelas", "kode_kampus", "tahun_masuk", "biaya": {kode: nominal}, "transaksi": [...]}] (maks. 200)}. Idempoten per no_bukti|nim. Terapkan menulis tarif, tagihan, dan pembayaran ke tabel lama.
     *
     * `POST /v1/kasir/migrasi/proses`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMigrasiProses(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/migrasi/proses', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan migrasi per batch
     *
     * `GET /v1/kasir/migrasi/ringkasan`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasiRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/migrasi/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Jejak migrasi
     *
     * `GET /v1/kasir/migrasi/log`
     *
     * scope: `kasir:read` · berhalaman
     *
     * @param array{batch?: string, nim?: string, jenis?: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasiLog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/migrasi/log', [], $query, null, $options, false, false);
    }

    /**
     * Batalkan satu batch migrasi
     *
     * Body: {"batch", "alasan"}. Pembayaran batch dibatalkan, tagihan buatan batch tanpa pembayaran lain dihapus, tagihan yang dinaikkan dikembalikan.
     *
     * `POST /v1/kasir/migrasi/batalkan`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMigrasiBatalkan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/migrasi/batalkan', [], $query, null, $options, false, false);
    }
}
