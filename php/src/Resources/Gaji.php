<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Gaji: Master, Gaji: Proses payroll, Gaji: Laporan, Gaji: Slip saya
 */
final class Gaji extends Resource
{
    /**
     * Pasang komponen gaji standar
     *
     * Admin. Gaji pokok, tunjangan dari SDM, honor, THR, gaji ke-13, BPJS Kesehatan/Ketenagakerjaan (tarif 2025), potongan presensi, koperasi, pinjaman, zakat. Hanya menambah kode yang belum ada.
     *
     * `POST /v1/gaji/komponen/bawaan`
     *
     * scope: `gaji:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKomponenBawaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/komponen/bawaan', [], $query, null, $options, false, false);
    }

    /**
     * Buat profil gaji massal
     *
     * Membuat profil gaji untuk pegawai aktif SDM yang belum punya (pegawai tidak tetap: tanpa BPJS, PPh pegawai tidak tetap). Rekening bank diisi kemudian. Query jenis=dosen|tendik opsional.
     *
     * `POST /v1/gaji/profil/buat-massal`
     *
     * scope: `gaji:write`
     *
     * @param array{jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProfilBuatMassal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/profil/buat-massal', [], $query, null, $options, false, false);
    }

    /**
     * Hitung payroll
     *
     * Menghitung (ulang) slip semua pegawai sasaran: gaji pokok, tunjangan, dan honor dibaca dari SDM; BPJS, potongan presensi, tetapan pegawai, PPh 21 (TER bulanan, Desember disetahunkan, gross-up). Penyesuaian manual dipertahankan. Body {pegawai_id?: [..]} untuk sebagian pegawai. Status draf/dihitung.
     *
     * `POST /v1/gaji/periode/{id}/hitung`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdHitung(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode/{id}/hitung', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan payroll
     *
     * dihitung -> diajukan. Body {catatan?}.
     *
     * `POST /v1/gaji/periode/{id}/ajukan`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kembalikan payroll
     *
     * diajukan -> dihitung untuk diperbaiki. Body {catatan?}.
     *
     * `POST /v1/gaji/periode/{id}/kembalikan`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdKembalikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode/{id}/kembalikan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui payroll
     *
     * Admin gaji (Kepala BAUK), harus orang yang berbeda dari pengaju. Membuat jurnal beban gaji per unit (D beban / K utang gaji, utang PPh 21, utang BPJS, potongan) dan menerbitkan slip ke pegawai (notifikasi).
     *
     * `POST /v1/gaji/periode/{id}/setujui`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat pembayaran payroll
     *
     * disetujui -> dibayar. Body {tanggal?, rekening_id? (bawaan rekening utama universitas), catatan?}. Jurnal D utang gaji / K rekening untuk slip yang tidak ditahan, honor SDM ditandai dibayar (nomor bukti GAJI-<kode>), cicilan tetapan maju satu.
     *
     * `POST /v1/gaji/periode/{id}/bayar`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdBayar(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode/{id}/bayar', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tutup payroll
     *
     * dibayar -> ditutup (terkunci).
     *
     * `POST /v1/gaji/periode/{id}/tutup`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdTutup(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode/{id}/tutup', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan payroll
     *
     * Admin. Sebelum dibayar. Body {alasan}. Jurnal beban dibalik. Koreksi setelah dibayar lewat periode susulan.
     *
     * `POST /v1/gaji/periode/{id}/batal`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * File transfer bank
     *
     * CSV (pemisah ;) untuk transfer massal: rekening, nama, bank, nominal netto, keterangan. Slip ditahan tidak ikut. format=json untuk data mentah. Setelah disetujui.
     *
     * `GET /v1/gaji/periode/{id}/bank`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID atau kode periode (mis. 2026-11)
     * @param array{format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdBank(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/periode/{id}/bank', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Slip lengkap
     *
     * Pengelola gaji. Identitas, kehadiran, rincian pendapatan/potongan/pajak/iuran pemberi kerja dengan dasar hitung, peringatan, kode verifikasi.
     *
     * `GET /v1/gaji/slip/{id}/lengkap`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID slip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSlipByIdLengkap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/slip/{id}/lengkap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hitung ulang satu slip
     *
     * Setelah data SDM pegawai diperbaiki.
     *
     * `POST /v1/gaji/slip/{id}/hitung`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID slip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSlipByIdHitung(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/slip/{id}/hitung', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tahan slip
     *
     * Slip tidak ikut transfer (mis. rekening bermasalah). Body {catatan?}.
     *
     * `POST /v1/gaji/slip/{id}/tahan`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID slip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSlipByIdTahan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/slip/{id}/tahan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lepas tahanan slip
     *
     * Sebelum periode dibayar.
     *
     * `POST /v1/gaji/slip/{id}/lepas`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID slip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSlipByIdLepas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/slip/{id}/lepas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bayar slip tertahan
     *
     * Setelah periode dibayar. Body {tanggal?, rekening_id?}.
     *
     * `POST /v1/gaji/slip/{id}/bayar`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID slip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSlipByIdBayar(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/slip/{id}/bayar', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah penyesuaian slip
     *
     * Body {jenis: pendapatan|potongan, nama, nominal, kena_pajak?, komponen_id?, keterangan?}. Pajak dihitung ulang. Hanya sebelum diajukan.
     *
     * `POST /v1/gaji/slip/{id}/rinci`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID slip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSlipByIdRinci(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/slip/{id}/rinci', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus penyesuaian slip
     *
     * Hanya baris manual.
     *
     * `POST /v1/gaji/slip/{id}/rinci/{rinci}/hapus`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID slip
     * @param int|string $rinci ID baris
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSlipByIdRinciByRinciHapus(int|string $id, int|string $rinci, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/slip/{id}/rinci/{rinci}/hapus', ['id' => $id, 'rinci' => $rinci], $query, null, $options, false, false);
    }

    /**
     * Rekap payroll satu periode
     *
     * Ringkas, per unit, per jenis pegawai, per komponen, dan rincian per pegawai (pendapatan, potongan, PPh 21, BPJS, netto, status bayar). Periode lewat periode_id (ID/kode) atau tahun + bulan (reguler terakhir). Pengelola gaji (pengelola unit hanya unitnya).
     *
     * `GET /v1/gaji/laporan/rekap`
     *
     * scope: `gaji:read`
     *
     * @param array{periode_id?: string, tahun?: int, bulan?: int, unit_id?: int, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/laporan/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Rekap payroll setahun
     *
     * Per bulan dan per pegawai, hanya periode yang sudah disetujui (draf=1 ikut draf, pengelola).
     *
     * `GET /v1/gaji/laporan/tahunan`
     *
     * scope: `gaji:read`
     *
     * @param array{tahun?: int, draf?: int, unit_id?: int, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanTahunan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/laporan/tahunan', [], $query, null, $options, false, false);
    }

    /**
     * Rekap PPh 21 masa
     *
     * Per pegawai: NPWP/NIK, PTKP, kategori TER, kode objek pajak, bruto, tarif, PPh 21. Dasar SPT Masa / e-Bupot 21.
     *
     * `GET /v1/gaji/laporan/pajak`
     *
     * scope: `gaji:read`
     *
     * @param array{periode_id?: string, tahun?: int, bulan?: int, unit_id?: int, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporanPajak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/laporan/pajak', [], $query, null, $options, false, false);
    }

    /**
     * Statistik payroll
     *
     * Beban setahun dibanding tahun lalu, tren bulanan, per unit, per jenis pegawai, komposisi komponen, rata-rata per golongan, daftar periode, kelengkapan data (tanpa profil, tanpa rekening).
     *
     * `GET /v1/gaji/statistik`
     *
     * scope: `gaji:read`
     *
     * @param array{tahun?: int, unit_id?: int, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pegawai ringkas
     *
     * Untuk pemilih pegawai form gaji/honor di BAUK: id, nama, nama_lengkap, nip, nidn, jenis, unit_id, unit_nama, golongan_id, golongan, status_aktif. Tanpa data pribadi (alamat, HP, email, NIK KTP, NPWP, rekening). Hanya pengelola gaji BAUK tingkat universitas (level KEUANGAN/ADMIN, izin gaji:kelola, token aplikasi gaji:write); selain itu 403.
     *
     * `GET /v1/gaji/pegawai`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{q?: string, jenis?: string, unit_id?: int, aktif?: int, id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/pegawai', [], $query, null, $options, false, false);
    }

    /**
     * Slip gaji saya
     *
     * Daftar slip pegawai yang login (periode sudah disetujui) dan profil bayar (rekening disamarkan).
     *
     * `GET /v1/gaji/saya`
     *
     * scope: `gaji:read`
     *
     * @param array{tahun?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/saya', [], $query, null, $options, false, false);
    }

    /**
     * PPh 21 saya setahun
     *
     * Bruto, biaya jabatan, iuran pensiun/JHT, PTKP, PKP, PPh setahun, dan PPh yang sudah dipotong per masa (dasar bukti potong 1721-A1).
     *
     * `GET /v1/gaji/saya/pajak`
     *
     * scope: `gaji:read`
     *
     * @param array{tahun?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPajak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/saya/pajak', [], $query, null, $options, false, false);
    }

    /**
     * Rincian slip saya
     *
     * Slip lengkap milik sendiri.
     *
     * `GET /v1/gaji/saya/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID slip
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/saya/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Verifikasi keaslian slip
     *
     * Publik, untuk kode QR pada slip cetak: nomor, nama, NIP tersamar, periode, status. Tanpa nominal.
     *
     * `GET /v1/gaji/verifikasi/{kode}`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode Kode verifikasi 16 karakter
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVerifikasiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/verifikasi/{kode}', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Komponen gaji: daftar
     *
     * Komponen pendapatan, potongan, dan iuran pemberi kerja. perhitungan: tetap (rupiah), persen (nilai% x dasar gaji_pokok/tetap/bruto, dibatasi batas_bawah/batas_atas), sdm_gaji_pokok, sdm_tunjangan (parameter = jenis tunjangan SDM), sdm_honor (parameter = kelompok honor), per_hadir / per_tidak_hadir / per_menit_terlambat (dari presensi SDM), manual (hanya dari tetapan pegawai). parameter bpjs_kes/bpjs_tk mengikuti kepesertaan di profil gaji. sasaran {jenis:[dosen|tendik], kategori:[tetap|tidak_tetap], status_kepegawaian:[...], golongan_id:[...], jabatan_akademik_id:[...], jabatan_id:[...], unit_id:[...]} membatasi penerima. jenis_periode: ["reguler"], ["thr"], ["gaji13"], ["susulan"]. Komponen bawaan: POST /v1/gaji/komponen/bawaan. Hanya pengelola modul.
     *
     * `GET /v1/gaji/komponen`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, kelompok?: string, perhitungan?: string, dasar?: string, kena_pajak?: string, pengurang_pajak?: string, akun_id?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomponen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/komponen', [], $query, null, $options, false, false);
    }

    /**
     * Komponen gaji: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/gaji/komponen`
     *
     * scope: `gaji:write`
     *
     * @param array{kode: string, nama: string, jenis: string, kelompok?: string, perhitungan: string, parameter?: string, nilai?: float|int, dasar?: string, batas_bawah?: float|int, batas_atas?: float|int, kena_pajak?: bool, pengurang_pajak?: bool, sasaran?: array<string, mixed>, jenis_periode?: array<string, mixed>, akun_id?: int, urutan?: int, aktif?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKomponen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/komponen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komponen gaji: detail
     *
     * Komponen pendapatan, potongan, dan iuran pemberi kerja. perhitungan: tetap (rupiah), persen (nilai% x dasar gaji_pokok/tetap/bruto, dibatasi batas_bawah/batas_atas), sdm_gaji_pokok, sdm_tunjangan (parameter = jenis tunjangan SDM), sdm_honor (parameter = kelompok honor), per_hadir / per_tidak_hadir / per_menit_terlambat (dari presensi SDM), manual (hanya dari tetapan pegawai). parameter bpjs_kes/bpjs_tk mengikuti kepesertaan di profil gaji. sasaran {jenis:[dosen|tendik], kategori:[tetap|tidak_tetap], status_kepegawaian:[...], golongan_id:[...], jabatan_akademik_id:[...], jabatan_id:[...], unit_id:[...]} membatasi penerima. jenis_periode: ["reguler"], ["thr"], ["gaji13"], ["susulan"]. Komponen bawaan: POST /v1/gaji/komponen/bawaan. Hanya pengelola modul.
     *
     * `GET /v1/gaji/komponen/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomponenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/komponen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komponen gaji: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/gaji/komponen/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, jenis: string, kelompok?: string, perhitungan: string, parameter?: string, nilai?: float|int, dasar?: string, batas_bawah?: float|int, batas_atas?: float|int, kena_pajak?: bool, pengurang_pajak?: bool, sasaran?: array<string, mixed>, jenis_periode?: array<string, mixed>, akun_id?: int, urutan?: int, aktif?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKomponenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/gaji/komponen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Komponen gaji: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/gaji/komponen/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKomponenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/gaji/komponen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Komponen gaji: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Komponen pendapatan, potongan, dan iuran pemberi kerja. perhitungan: tetap (rupiah), persen (nilai% x dasar gaji_pokok/tetap/bruto, dibatasi batas_bawah/batas_atas), sdm_gaji_pokok, sdm_tunjangan (parameter = jenis tunjangan SDM), sdm_honor (parameter = kelompok honor), per_hadir / per_tidak_hadir / per_menit_terlambat (dari presensi SDM), manual (hanya dari tetapan pegawai). parameter bpjs_kes/bpjs_tk mengikuti kepesertaan di profil gaji. sasaran {jenis:[dosen|tendik], kategori:[tetap|tidak_tetap], status_kepegawaian:[...], golongan_id:[...], jabatan_akademik_id:[...], jabatan_id:[...], unit_id:[...]} membatasi penerima. jenis_periode: ["reguler"], ["thr"], ["gaji13"], ["susulan"]. Komponen bawaan: POST /v1/gaji/komponen/bawaan. Hanya pengelola modul.
     *
     * `GET /v1/gaji/komponen/{id}/riwayat`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomponenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/komponen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Profil gaji pegawai: daftar
     *
     * Data pembayaran per pegawai: rekening bank, status PTKP (kosong = otomatis dari status nikah dan tanggungan di SDM), jenis/metode pajak, kepesertaan BPJS, unit pembebanan. Pegawai tanpa profil aktif tidak ikut payroll. Buat massal: POST /v1/gaji/profil/buat-massal. Gaji pokok dan tunjangan TIDAK di sini: diatur SDM berdasarkan SK. Hanya pengelola modul.
     *
     * `GET /v1/gaji/profil`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pegawai_id?: string, status_ptkp?: string, jenis_pajak?: string, metode_pajak?: string, ikut_bpjs_kes?: string, ikut_bpjs_tk?: string, unit_id?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfil(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/profil', [], $query, null, $options, false, false);
    }

    /**
     * Profil gaji pegawai: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/gaji/profil`
     *
     * scope: `gaji:write`
     *
     * @param array{pegawai_id: int, status_ptkp?: string, jenis_pajak?: string, metode_pajak?: string, bank?: string, kode_bank?: string, no_rekening?: string, atas_nama?: string, ikut_bpjs_kes?: bool, ikut_bpjs_tk?: bool, unit_id?: int, aktif?: bool, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProfil(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/profil', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Profil gaji pegawai: detail
     *
     * Data pembayaran per pegawai: rekening bank, status PTKP (kosong = otomatis dari status nikah dan tanggungan di SDM), jenis/metode pajak, kepesertaan BPJS, unit pembebanan. Pegawai tanpa profil aktif tidak ikut payroll. Buat massal: POST /v1/gaji/profil/buat-massal. Gaji pokok dan tunjangan TIDAK di sini: diatur SDM berdasarkan SK. Hanya pengelola modul.
     *
     * `GET /v1/gaji/profil/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfilById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/profil/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Profil gaji pegawai: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/gaji/profil/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pegawai_id: int, status_ptkp?: string, jenis_pajak?: string, metode_pajak?: string, bank?: string, kode_bank?: string, no_rekening?: string, atas_nama?: string, ikut_bpjs_kes?: bool, ikut_bpjs_tk?: bool, unit_id?: int, aktif?: bool, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putProfilById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/gaji/profil/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Profil gaji pegawai: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/gaji/profil/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProfilById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/gaji/profil/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Profil gaji pegawai: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Data pembayaran per pegawai: rekening bank, status PTKP (kosong = otomatis dari status nikah dan tanggungan di SDM), jenis/metode pajak, kepesertaan BPJS, unit pembebanan. Pegawai tanpa profil aktif tidak ikut payroll. Buat massal: POST /v1/gaji/profil/buat-massal. Gaji pokok dan tunjangan TIDAK di sini: diatur SDM berdasarkan SK. Hanya pengelola modul.
     *
     * `GET /v1/gaji/profil/{id}/riwayat`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfilByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/profil/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tetapan komponen per pegawai: daftar
     *
     * Nilai komponen khusus untuk satu pegawai, mengalahkan cara hitung komponen: potongan koperasi, cicilan pinjaman pegawai (jumlah_kali = tenor, terpakai maju tiap payroll dibayar), zakat, tunjangan khusus. mulai/selesai format YYYY-MM. Wajib nomor dokumen (surat kuasa potong gaji/perjanjian) untuk potongan. Hanya pengelola modul.
     *
     * `GET /v1/gaji/tetapan`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pegawai_id?: string, komponen_id?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTetapan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/tetapan', [], $query, null, $options, false, false);
    }

    /**
     * Tetapan komponen per pegawai: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/gaji/tetapan`
     *
     * scope: `gaji:write`
     *
     * @param array{pegawai_id: int, komponen_id: int, nilai: float|int, mulai: string, selesai?: string, jumlah_kali?: int, total?: float|int, nomor_dokumen?: string, aktif?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTetapan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/tetapan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tetapan komponen per pegawai: detail
     *
     * Nilai komponen khusus untuk satu pegawai, mengalahkan cara hitung komponen: potongan koperasi, cicilan pinjaman pegawai (jumlah_kali = tenor, terpakai maju tiap payroll dibayar), zakat, tunjangan khusus. mulai/selesai format YYYY-MM. Wajib nomor dokumen (surat kuasa potong gaji/perjanjian) untuk potongan. Hanya pengelola modul.
     *
     * `GET /v1/gaji/tetapan/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTetapanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/tetapan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tetapan komponen per pegawai: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/gaji/tetapan/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{pegawai_id: int, komponen_id: int, nilai: float|int, mulai: string, selesai?: string, jumlah_kali?: int, total?: float|int, nomor_dokumen?: string, aktif?: bool, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTetapanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/gaji/tetapan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tetapan komponen per pegawai: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/gaji/tetapan/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTetapanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/gaji/tetapan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tetapan komponen per pegawai: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Nilai komponen khusus untuk satu pegawai, mengalahkan cara hitung komponen: potongan koperasi, cicilan pinjaman pegawai (jumlah_kali = tenor, terpakai maju tiap payroll dibayar), zakat, tunjangan khusus. mulai/selesai format YYYY-MM. Wajib nomor dokumen (surat kuasa potong gaji/perjanjian) untuk potongan. Hanya pengelola modul.
     *
     * `GET /v1/gaji/tetapan/{id}/riwayat`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTetapanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/tetapan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tarif efektif PPh 21 (TER): daftar
     *
     * TER bulanan PP 58/2023 kategori A (TK/0, TK/1, K/0), B (TK/2, TK/3, K/1, K/2), C (K/3). Sudah terisi oleh migration; ubah hanya bila ada peraturan baru. Hanya pengelola modul.
     *
     * `GET /v1/gaji/ter`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kategori?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTer(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/ter', [], $query, null, $options, false, false);
    }

    /**
     * Tarif efektif PPh 21 (TER): tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/gaji/ter`
     *
     * scope: `gaji:write`
     *
     * @param array{kategori: string, batas_bawah: float|int, batas_atas?: float|int, tarif: float|int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTer(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/ter', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tarif efektif PPh 21 (TER): detail
     *
     * TER bulanan PP 58/2023 kategori A (TK/0, TK/1, K/0), B (TK/2, TK/3, K/1, K/2), C (K/3). Sudah terisi oleh migration; ubah hanya bila ada peraturan baru. Hanya pengelola modul.
     *
     * `GET /v1/gaji/ter/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/ter/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tarif efektif PPh 21 (TER): ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/gaji/ter/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kategori: string, batas_bawah: float|int, batas_atas?: float|int, tarif: float|int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTerById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/gaji/ter/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tarif efektif PPh 21 (TER): hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/gaji/ter/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTerById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/gaji/ter/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tarif efektif PPh 21 (TER): riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. TER bulanan PP 58/2023 kategori A (TK/0, TK/1, K/0), B (TK/2, TK/3, K/1, K/2), C (K/3). Sudah terisi oleh migration; ubah hanya bila ada peraturan baru. Hanya pengelola modul.
     *
     * `GET /v1/gaji/ter/{id}/riwayat`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/ter/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penghasilan dan PPh sebelum payroll: daftar
     *
     * Penghasilan bruto, iuran JHT/JP, dan PPh 21 yang sudah dipotong di luar payroll ini pada tahun berjalan (mis. bulan-bulan dari sistem lama, atau dari pemberi kerja sebelumnya). Dipakai saat PPh masa Desember disetahunkan dan untuk ringkasan bukti potong A1. Hanya pengelola modul.
     *
     * `GET /v1/gaji/pajak-awal`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, pegawai_id?: string, tahun?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPajakAwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/pajak-awal', [], $query, null, $options, false, false);
    }

    /**
     * Penghasilan dan PPh sebelum payroll: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/gaji/pajak-awal`
     *
     * scope: `gaji:write`
     *
     * @param array{tahun: int, pegawai_id: int, jumlah_bulan?: int, bruto?: float|int, iuran?: float|int, pph?: float|int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPajakAwal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/pajak-awal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penghasilan dan PPh sebelum payroll: detail
     *
     * Penghasilan bruto, iuran JHT/JP, dan PPh 21 yang sudah dipotong di luar payroll ini pada tahun berjalan (mis. bulan-bulan dari sistem lama, atau dari pemberi kerja sebelumnya). Dipakai saat PPh masa Desember disetahunkan dan untuk ringkasan bukti potong A1. Hanya pengelola modul.
     *
     * `GET /v1/gaji/pajak-awal/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPajakAwalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/pajak-awal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penghasilan dan PPh sebelum payroll: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/gaji/pajak-awal/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tahun: int, pegawai_id: int, jumlah_bulan?: int, bruto?: float|int, iuran?: float|int, pph?: float|int, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPajakAwalById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/gaji/pajak-awal/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penghasilan dan PPh sebelum payroll: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/gaji/pajak-awal/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePajakAwalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/gaji/pajak-awal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penghasilan dan PPh sebelum payroll: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Penghasilan bruto, iuran JHT/JP, dan PPh 21 yang sudah dipotong di luar payroll ini pada tahun berjalan (mis. bulan-bulan dari sistem lama, atau dari pemberi kerja sebelumnya). Dipakai saat PPh masa Desember disetahunkan dan untuk ringkasan bukti potong A1. Hanya pengelola modul.
     *
     * `GET /v1/gaji/pajak-awal/{id}/riwayat`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPajakAwalByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/pajak-awal/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode payroll: daftar
     *
     * Satu proses payroll: reguler bulanan, THR, gaji ke-13, atau susulan (koreksi). Alur: buat -> POST {id}/hitung -> {id}/ajukan -> {id}/setujui (admin, berbeda dari pengaju; jurnal beban) -> {id}/bayar (jurnal pembayaran, honor SDM dibayar) -> {id}/tutup. {id}/batal sebelum dibayar. sasaran {jenis:[dosen|tendik], unit_id:[...], pegawai_id:[...]} membatasi pegawai (kosong = semua berprofil aktif). Hanya pengelola modul.
     *
     * `GET /v1/gaji/periode`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, status?: string, tahun?: string, bulan?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/periode', [], $query, null, $options, false, false);
    }

    /**
     * Periode payroll: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/gaji/periode`
     *
     * scope: `gaji:write`
     *
     * @param array{tahun: int, bulan: int, jenis?: string, judul?: string, tanggal_bayar?: string, sasaran?: array<string, mixed>, hari_kerja?: int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/gaji/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode payroll: detail
     *
     * Satu proses payroll: reguler bulanan, THR, gaji ke-13, atau susulan (koreksi). Alur: buat -> POST {id}/hitung -> {id}/ajukan -> {id}/setujui (admin, berbeda dari pengaju; jurnal beban) -> {id}/bayar (jurnal pembayaran, honor SDM dibayar) -> {id}/tutup. {id}/batal sebelum dibayar. sasaran {jenis:[dosen|tendik], unit_id:[...], pegawai_id:[...]} membatasi pegawai (kosong = semua berprofil aktif). Hanya pengelola modul.
     *
     * `GET /v1/gaji/periode/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode payroll: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/gaji/periode/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tahun: int, bulan: int, jenis?: string, judul?: string, tanggal_bayar?: string, sasaran?: array<string, mixed>, hari_kerja?: int, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/gaji/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode payroll: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/gaji/periode/{id}`
     *
     * scope: `gaji:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/gaji/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode payroll: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Satu proses payroll: reguler bulanan, THR, gaji ke-13, atau susulan (koreksi). Alur: buat -> POST {id}/hitung -> {id}/ajukan -> {id}/setujui (admin, berbeda dari pengaju; jurnal beban) -> {id}/bayar (jurnal pembayaran, honor SDM dibayar) -> {id}/tutup. {id}/batal sebelum dibayar. sasaran {jenis:[dosen|tendik], unit_id:[...], pegawai_id:[...]} membatasi pegawai (kosong = semua berprofil aktif). Hanya pengelola modul.
     *
     * `GET /v1/gaji/periode/{id}/riwayat`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/periode/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Slip gaji: daftar
     *
     * Slip per pegawai per periode (dibuat oleh hitung). Rincian lengkap: GET /v1/gaji/slip/{id}/lengkap. Penyesuaian manual: POST /v1/gaji/slip/{id}/rinci. Tahan/lepas dari transfer: POST {id}/tahan, {id}/lepas. Pengelola berlingkup unit hanya melihat slip unitnya. Hanya pengelola modul.
     *
     * `GET /v1/gaji/slip`
     *
     * scope: `gaji:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, status?: string, periode_id?: string, pegawai_id?: string, unit_id?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSlip(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/slip', [], $query, null, $options, false, false);
    }

    /**
     * Slip gaji: detail
     *
     * Slip per pegawai per periode (dibuat oleh hitung). Rincian lengkap: GET /v1/gaji/slip/{id}/lengkap. Penyesuaian manual: POST /v1/gaji/slip/{id}/rinci. Tahan/lepas dari transfer: POST {id}/tahan, {id}/lepas. Pengelola berlingkup unit hanya melihat slip unitnya. Hanya pengelola modul.
     *
     * `GET /v1/gaji/slip/{id}`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSlipById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/slip/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Slip gaji: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Slip per pegawai per periode (dibuat oleh hitung). Rincian lengkap: GET /v1/gaji/slip/{id}/lengkap. Penyesuaian manual: POST /v1/gaji/slip/{id}/rinci. Tahan/lepas dari transfer: POST {id}/tahan, {id}/lepas. Pengelola berlingkup unit hanya melihat slip unitnya. Hanya pengelola modul.
     *
     * `GET /v1/gaji/slip/{id}/riwayat`
     *
     * scope: `gaji:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSlipByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/gaji/slip/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }
}
