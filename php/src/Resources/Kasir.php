<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kasir: Sesi, Kasir: Pengaturan, Kasir: Penerimaan, Kasir: Laporan, Kasir: Pengaturan unit, Kasir: Migrasi aplikasi lama
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
     * Daftar perangkat kasir (lama)
     *
     * Sama dengan GET /kelola/perangkat.
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
     * NIM atau nama (min. 3 karakter), maks. 30 baris. status_label, bisa_diproses, alasan, tunggakan per baris.
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
     * Mahasiswa, tagihan, tunggakan, dan riwayat bayar
     *
     * Hanya jenis biaya terbitan unit petugas. tagihan[].boleh/alasan dan jenis[].proses = hasil aturan penerimaan & jadwal; tunggakan = per periode akademik (tertua dulu).
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
     * Body: {"uuid", "nim", "kode_biaya", "jumlah", "potongan", "ket_potongan", "tahun_id" (bawaan: periode tagihan), "metode": "tunai|transfer|va|lainnya", "referensi", "keterangan"}. Idempoten per uuid (status "sudah" bila pernah tercatat, mis. dikirim ulang saat koneksi putus). Ditulis ke t_mahasiswa_bayar lewat langkah popup input pembayaran. Tagihan otomatis hanya bila jenis biaya mengizinkan. Jenis biaya di luar unit penerbit -> 403 di_luar_lingkup_unit; melanggar aturan penerimaan/jadwal -> 422 aturan_penerimaan (details.alasan: status_ditolak, hanya_tunggakan, belum_dibuka, sudah_ditutup, di_luar_jam_layanan).
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
     * Terima pembayaran di muka
     *
     * Body: {"uuid", "nim", "kode_biaya", "tahun_id" (periode sasaran yang tagihannya belum terbit), "jumlah", "metode", "referensi", "keterangan"}. Hanya jenis biaya ber-saklar bayar_dimuka (paling cepat dimuka_hari sebelum jendela dibuka). Dicatat sebagai dana deposit menunggu periode (Deposit::catatDana sumber bayar_dimuka), dialokasikan otomatis saat tagihan terbit. Idempoten per uuid. Ditolak -> 422 aturan_penerimaan (dimuka_tidak_diizinkan, tagihan_sudah_terbit, dimuka_belum_dibuka, sudah_ditutup, status_ditolak, hanya_tunggakan).
     *
     * `POST /v1/kasir/bayar-dimuka`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBayarDimuka(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/bayar-dimuka', [], $query, null, $options, false, false);
    }

    /**
     * Kwitansi pembayaran di muka
     *
     * Bukti kas masuk "Pembayaran di muka – semester <periode>" dari dana deposit: kwitansi resmi terpotret (sumber kasir_dimuka), kode verifikasi + QR, dicetak.
     *
     * `GET /v1/kasir/dimuka/{id}/kwitansi`
     *
     * scope: `kasir:read`
     *
     * @param int|string $id keu_mhs_deposit_dana.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDimukaByIdKwitansi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/dimuka/{id}/kwitansi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat cetak kwitansi di muka
     *
     * Cetak pertama = asli; berikutnya bertanda SALINAN. {dicetak, salinan}.
     *
     * `POST /v1/kasir/dimuka/{id}/cetak`
     *
     * scope: `kasir:write`
     *
     * @param int|string $id keu_mhs_deposit_dana.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDimukaByIdCetak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/dimuka/{id}/cetak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat transaksi
     *
     * Petugas tanpa kasir.laporan hanya melihat transaksinya sendiri. meta.ringkasan = total sah/batal sesuai saringan.
     *
     * `GET /v1/kasir/transaksi`
     *
     * scope: `kasir:read` · berhalaman
     *
     * @param array{nim?: string, kode_biaya?: string, status?: string, sumber?: string, petugas?: string, prodi?: string, perangkat?: string, metode?: string, q?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
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
     * Rekap per periode akademik
     *
     * Tagihan, terbayar, sisa, jumlah mahasiswa per periode x prodi x jenis biaya.
     *
     * `GET /v1/kasir/laporan/periode`
     *
     * scope: `kasir:read`
     *
     * @param array{tahun_id?: string, tahun_dari?: string, tahun_sampai?: string, kode_biaya?: string, prodi?: string, angkatan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/laporan/periode', [], $query, null, $options, false, false);
    }

    /**
     * Setoran per petugas
     *
     * Per petugas x metode, transaksi sah lewat API/aplikasi kasir.
     *
     * `GET /v1/kasir/laporan/setoran`
     *
     * scope: `kasir:read`
     *
     * @param array{dari?: string, sampai?: string, kode_biaya?: string, petugas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanSetoran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/laporan/setoran', [], $query, null, $options, false, false);
    }

    /**
     * Jadwal aktif jenis biaya
     *
     * Jendela penerimaan (buka/belum/tutup/di_luar_jam) jenis biaya petugas untuk periode aktif.
     *
     * `GET /v1/kasir/jadwal`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Templat laporan yang berlaku
     *
     * Per jenis laporan: templat unit petugas, universitas, atau bawaan.
     *
     * `GET /v1/kasir/templat`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemplat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/templat', [], $query, null, $options, false, false);
    }

    /**
     * Lingkup pengaturan saya
     *
     * Unit yang boleh diatur, status akademik dari data, kategori, keputusan, sumber jadwal, tahapan kalender, katalog templat.
     *
     * `GET /v1/kasir/kelola/saya`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/saya', [], $query, null, $options, false, false);
    }

    /**
     * Jenis biaya unit
     *
     * Termasuk nonaktif; hanya terbitan unit dalam lingkup.
     *
     * `GET /v1/kasir/kelola/jenis`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Simpan jenis biaya unit
     *
     * Body: {"kode_biaya", "nama" (wajib bila baru), "unit_id" (unit penerbit dalam lingkup; kosong = universitas/BAUK), "kategori", "perlakuan", "nominal_bawaan", "tagih_otomatis", "batasi_prodi", "potongan_kasir", "bayar_dimuka", "dimuka_hari", "urutan", "aktif", "keterangan"}.
     *
     * `POST /v1/kasir/kelola/jenis`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Loket kasir unit
     *
     * `GET /v1/kasir/kelola/perangkat`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaPerangkat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/perangkat', [], $query, null, $options, false, false);
    }

    /**
     * Ubah loket
     *
     * Body: {"nama", "unit_id", "aktif"}.
     *
     * `POST /v1/kasir/kelola/perangkat/{id}`
     *
     * scope: `kasir:write`
     *
     * @param int|string $id keu_kasir_perangkat.id
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaPerangkatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/perangkat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan penerimaan
     *
     * Versi terkini; aturan universitas tampil sebagai acuan (boleh_ubah=false bagi unit).
     *
     * `GET /v1/kasir/kelola/aturan`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan aturan penerimaan (versi baru)
     *
     * Body: {"kunci" (ubah), "unit_id", "kode_biaya", "kategori", "status": ["L"], "keputusan": "izinkan|tunggakan_saja|tolak", "alasan", "berlaku_mulai", "berlaku_selesai", "aktif", "catatan"}.
     *
     * `POST /v1/kasir/kelola/aturan`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Hapus aturan penerimaan
     *
     * Semua versi.
     *
     * `POST /v1/kasir/kelola/aturan/{kunci}/hapus`
     *
     * scope: `kasir:write`
     *
     * @param int|string $kunci UUID kunci (sama untuk semua versi)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaAturanByKunciHapus(int|string $kunci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/aturan/{kunci}/hapus', ['kunci' => $kunci], $query, null, $options, false, false);
    }

    /**
     * Simulasi aturan & jadwal untuk satu mahasiswa
     *
     * Keputusan per jenis biaya untuk pembayaran baru dan pelunasan tunggakan.
     *
     * `GET /v1/kasir/kelola/simulasi`
     *
     * scope: `kasir:read`
     *
     * @param array{nim?: string, tanggal?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaSimulasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/simulasi', [], $query, null, $options, false, false);
    }

    /**
     * Jadwal aktif pembayaran
     *
     * `GET /v1/kasir/kelola/jadwal`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Simpan jadwal aktif (versi baru)
     *
     * Body: {"kunci", "unit_id", "kode_biaya", "kategori", "sumber": "selalu|kalender|manual", "tahapan" (kal_tahapan.jenis), "mulai", "selesai", "jam_mulai", "jam_selesai", "hari": [1..7], "aktif", "catatan"}.
     *
     * `POST /v1/kasir/kelola/jadwal`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Hapus jadwal aktif
     *
     * `POST /v1/kasir/kelola/jadwal/{kunci}/hapus`
     *
     * scope: `kasir:write`
     *
     * @param int|string $kunci UUID kunci (sama untuk semua versi)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaJadwalByKunciHapus(int|string $kunci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/jadwal/{kunci}/hapus', ['kunci' => $kunci], $query, null, $options, false, false);
    }

    /**
     * Pratinjau garis waktu jadwal
     *
     * Keadaan jendela setiap jenis biaya untuk periode (bawaan aktif).
     *
     * `GET /v1/kasir/kelola/jadwal/pratinjau`
     *
     * scope: `kasir:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaJadwalPratinjau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/jadwal/pratinjau', [], $query, null, $options, false, false);
    }

    /**
     * Templat laporan unit
     *
     * `GET /v1/kasir/kelola/templat`
     *
     * scope: `kasir:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaTemplat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/templat', [], $query, null, $options, false, false);
    }

    /**
     * Simpan templat laporan (versi baru)
     *
     * Body: {"kunci", "unit_id", "jenis": "harian|rekap_periode|per_jenis|setoran|periode_akademik|tunggakan", "nama", "isi": {"judul", "subjudul", "kop", "kolom": [...], "kelompok", "subtotal", "total", "ringkas", "catatan_kaki", "penanda_tangan": [{"jabatan","nama","nip"}], "kota", "kertas", "orientasi"}, "aktif"}.
     *
     * `POST /v1/kasir/kelola/templat`
     *
     * scope: `kasir:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaTemplat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/templat', [], $query, null, $options, false, false);
    }

    /**
     * Hapus templat laporan
     *
     * `POST /v1/kasir/kelola/templat/{kunci}/hapus`
     *
     * scope: `kasir:write`
     *
     * @param int|string $kunci UUID kunci (sama untuk semua versi)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelolaTemplatByKunciHapus(int|string $kunci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kasir/kelola/templat/{kunci}/hapus', ['kunci' => $kunci], $query, null, $options, false, false);
    }

    /**
     * Riwayat versi
     *
     * jenis: aturan|jadwal|templat.
     *
     * `GET /v1/kasir/kelola/{jenis}/{kunci}/riwayat`
     *
     * scope: `kasir:read`
     *
     * @param int|string $jenis aturan|jadwal|templat
     * @param int|string $kunci UUID kunci (sama untuk semua versi)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelolaByJenisByKunciRiwayat(int|string $jenis, int|string $kunci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kasir/kelola/{jenis}/{kunci}/riwayat', ['jenis' => $jenis, 'kunci' => $kunci], $query, null, $options, false, false);
    }

    /**
     * Jenis biaya per unit (lama)
     *
     * Sama dengan GET /kelola/jenis.
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
     * Simpan jenis biaya per unit (lama)
     *
     * Sama dengan POST /kelola/jenis.
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
     * Unit dalam lingkup pengaturan (lama).
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
