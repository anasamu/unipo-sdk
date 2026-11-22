<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Keuangan, Keuangan: Keringanan dan beasiswa, Keuangan: Beasiswa, Keuangan: Tagihan, Keuangan: Tarif, Keuangan: Denda, Keuangan: Pembayaran dan kwitansi, Keuangan: Kasir, Keuangan: Refund dan deposit, Keuangan: Potongan, Keuangan: Rekonsiliasi dan laporan, Keuangan: Mahasiswa, Keuangan: Pengaturan, Keuangan: UKT, Keuangan: Dispensasi, Keuangan: Cicilan, Keuangan: Keuangan saya (mahasiswa), Keuangan: petunjuk bayar (BAUK)
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
     * Pencairan beasiswa
     *
     * Penerima program berjalan per periode: potongan UKT (pengajuan dan terapan ke tagihan) atau pencairan tunai (status, bukti).
     *
     * `GET /v1/keuangan/beasiswa/pencairan`
     *
     * scope: `keuangan:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaPencairan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/pencairan', [], $query, null, $options, false, false);
    }

    /**
     * Pasang potongan UKT penerima
     *
     * Skema keringanan bertaut program dibuat bila belum ada; setiap penerima mendapat pengajuan disetujui yang langsung diterapkan ke tagihan (idempoten).
     *
     * `POST /v1/keuangan/beasiswa/program/{id}/potongan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaProgramByIdPotongan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/program/{id}/potongan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat daftar pencairan tunai
     *
     * Body {tahun_id, tanggal?}. Satu baris rencana per penerima yang belum punya pada periode itu.
     *
     * `POST /v1/keuangan/beasiswa/program/{id}/pencairan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaProgramByIdPencairan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/program/{id}/pencairan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan pencairan program
     *
     * Mode (ke_mahasiswa|ke_tagihan|campuran|pembebasan), komponen [{kode, label, nominal, tujuan: tagihan|mahasiswa|catat|bebas, dasar?: nominal|persen, persen?, kode_biaya?: [..]}], prioritas kode_biaya, lintas_periode, aturan_sisa, aturan_lulus, pagu (+ terpakai), persetujuan, boleh_digabung (pembebasan di atas keringanan lain; bawaan tidak). Belum tersimpan = bawaan (KIP Kuliah: biaya pendidikan ke tagihan, sisa deposit). Pembebasan = beasiswa tanpa dana masuk: tagihan dikurangi sebagai keringanan.
     *
     * `GET /v1/keuangan/beasiswa/program/{id}/aturan`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaProgramByIdAturan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/program/{id}/aturan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan aturan pencairan
     *
     * Body seperti GET. Juga bisa dari wizard program BAAK (kunci pencairan).
     *
     * `POST /v1/keuangan/beasiswa/program/{id}/aturan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaProgramByIdAturan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/program/{id}/aturan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Timpa aturan per penerima
     *
     * Body {mode?, nominal?: {kode_komponen: nominal}, alasan (wajib), hapus?: bool}.
     *
     * `POST /v1/keuangan/beasiswa/penerima/{id}/atur`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID pendaftar
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaPenerimaByIdAtur(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/penerima/{id}/atur', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salurkan dana satu periode
     *
     * Body {tahun_id, penerimaan_id?, pendaftar_id?: [..], pratinjau?: bool}. Komponen ke tagihan = dana deposit bertujuan (menunggu bila tagihan periode belum terbit; alokasi berkwitansi berurutan prioritas), ke mahasiswa = rencana transfer, catat = hanya dicatat, bebas (mode pembebasan) = tagihan periode itu dikurangi sebagai keringanan keu_mhs_potongan tanpa dana/deposit/kwitansi (nominal berurutan jenis biaya atau persen per jenis biaya; tidak di atas keringanan lain kecuali boleh_digabung; tidak dobel dengan potongan UKT tahap 1 program yang sama). pratinjau = hitung tanpa menyimpan. Cek pagu. Idempoten.
     *
     * `POST /v1/keuangan/beasiswa/program/{id}/salurkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaProgramByIdSalurkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/program/{id}/salurkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan pembebasan biaya
     *
     * Body {tahun_id, pendaftar_id?: [..] (kosong = semua penerima), alasan}. Potongan pembebasan dikembalikan ke tagihan (tagihan kembali), baris keu_mhs_potongan berstatus dibatalkan, penyaluran batal (bisa diterapkan lagi). Izin beasiswa.cair atau beasiswa.cair.setujui; mahasiswa mendapat Kabar.
     *
     * `POST /v1/keuangan/beasiswa/program/{id}/pembebasan/batal`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaProgramByIdPembebasanBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/program/{id}/pembebasan/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dana masuk dari pemberi
     *
     * Daftar penerimaan kolektif (nomor, periode, nominal, teralokasi, bukti).
     *
     * `GET /v1/keuangan/beasiswa/penerimaan`
     *
     * scope: `keuangan:read`
     *
     * @param array{program_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaPenerimaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/penerimaan', [], $query, null, $options, false, false);
    }

    /**
     * Catat dana masuk kolektif
     *
     * Body {tahun_id, tanggal, pemberi?, nominal, keterangan?, berkas_id? (bukti), salurkan?: bool}. Jurnal kas masuk (draf) bila pemetaan penerimaan "beasiswa" ada.
     *
     * `POST /v1/keuangan/beasiswa/program/{id}/penerimaan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID program
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaProgramByIdPenerimaan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/program/{id}/penerimaan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Proses sisa dana beasiswa
     *
     * Body {nim?}. Alokasikan dulu; sisa tanpa tagihan sasaran ikut aturan_sisa (transfer/kewajiban/hangus); mahasiswa lulus/keluar ikut aturan_lulus (bawaan kelebihan dicatat). Deposit tetap untuk semester berikutnya.
     *
     * `POST /v1/keuangan/beasiswa/proses-sisa`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaProsesSisa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/proses-sisa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Berkas pencairan kolektif
     *
     * Dengan tahap persetujuan (pemeriksa).
     *
     * `GET /v1/keuangan/beasiswa/berkas`
     *
     * scope: `keuangan:read`
     *
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaBerkas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/berkas', [], $query, null, $options, false, false);
    }

    /**
     * Buat berkas pencairan
     *
     * Body {tahun_id, pencairan_id?: [..] (kosong = semua calon), judul?}. Rekening dipotret dari pemutakhiran_rekening; masalah rekening ditandai per baris.
     *
     * `POST /v1/keuangan/beasiswa/berkas`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaBerkas(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/berkas', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Calon baris berkas pencairan
     *
     * Rencana transfer yang belum masuk berkas berjalan, dengan rekening dari data keuangan Profil.
     *
     * `GET /v1/keuangan/beasiswa/berkas-calon`
     *
     * scope: `keuangan:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaBerkasCalon(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/berkas-calon', [], $query, null, $options, false, false);
    }

    /**
     * Rincian berkas pencairan
     *
     * Baris transfer, tahap persetujuan, bukti.
     *
     * `GET /v1/keuangan/beasiswa/berkas/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaBerkasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ekspor daftar transfer bank
     *
     * format=csv|xlsx (format umum: nama pemilik, bank, kode bank, nomor rekening, nominal, berita). Setelah disetujui.
     *
     * `GET /v1/keuangan/beasiswa/berkas/{id}/ekspor`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID berkas
     * @param array{format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaBerkasByIdEkspor(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/berkas/{id}/ekspor', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tandai cair
     *
     * Body {baris_id?: [..] (kosong = semua yang menunggu), tanggal?, berkas_id (bukti transfer)}. Mahasiswa mendapat Kabar; berkas selesai bila semua baris final (jurnal kas keluar draf bila pemetaan belanja "beasiswa" ada).
     *
     * `POST /v1/keuangan/beasiswa/berkas/{id}/cair`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID berkas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaBerkasByIdCair(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/berkas/{id}/cair', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Baris gagal/retur
     *
     * Body {status: gagal|retur, catatan}. Rencana transfer kembali dan bisa diulang di berkas berikutnya.
     *
     * `POST /v1/keuangan/beasiswa/berkas/{id}/baris/{baris}/gagal`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID berkas
     * @param int|string $baris ID baris
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaBerkasByIdBarisByBarisGagal(int|string $id, int|string $baris, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/berkas/{id}/baris/{baris}/gagal', ['id' => $id, 'baris' => $baris], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aksi berkas pencairan
     *
     * ajukan (operator BAUK; ditolak bila ada rekening kosong), setujui/tolak {catatan|alasan} per tahap (Kepala BAUK: beasiswa.cair.setujui; WR II: beasiswa.cair.wr2), batal, keluarkan {baris_id} saat draf.
     *
     * `POST /v1/keuangan/beasiswa/berkas/{id}/{aksi}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID berkas
     * @param int|string $aksi ajukan|setujui|tolak|batal|keluarkan (rute terakhir: cair/baris ditangani rute khusus di atas)
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaBerkasByIdByAksi(int|string $id, int|string $aksi, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/berkas/{id}/{aksi}', ['id' => $id, 'aksi' => $aksi], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pelacakan beasiswa
     *
     * Corong per program (pendaftar, lolos verifikasi, ditetapkan, dicairkan jumlah & nominal), pagu/terpakai/sisa, penerima dengan status pencairan.
     *
     * `GET /v1/keuangan/beasiswa/pelacakan`
     *
     * scope: `keuangan:read`
     *
     * @param array{tahun_id?: string, kode_prodi?: string, kode_fak?: string, sumber_dana?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaPelacakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/pelacakan', [], $query, null, $options, false, false);
    }

    /**
     * Ekspor pelacakan
     *
     * format=csv|xlsx.
     *
     * `GET /v1/keuangan/beasiswa/pelacakan/ekspor`
     *
     * scope: `keuangan:read`
     *
     * @param array{format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaPelacakanEkspor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/pelacakan/ekspor', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat beasiswa mahasiswa
     *
     * Pendaftaran, penyaluran, pencairan, rekening Profil, kartu deposit.
     *
     * `GET /v1/keuangan/beasiswa/mahasiswa/{nim}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Rekonsiliasi per penerima (SPJ)
     *
     * Per penerima per periode: diterima per komponen, dialokasikan ke tagihan (jenis biaya, periode, nomor bukti), ditransfer, sisa deposit, menunggu, ditutup, hanya dicatat; dana masuk.
     *
     * `GET /v1/keuangan/beasiswa/program/{id}/rekonsiliasi`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID program
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaProgramByIdRekonsiliasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/program/{id}/rekonsiliasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ekspor SPJ
     *
     * format=xlsx|csv; PDF dari halaman cetak aplikasi.
     *
     * `GET /v1/keuangan/beasiswa/program/{id}/rekonsiliasi/ekspor`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID program
     * @param array{tahun_id?: string, format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaProgramByIdRekonsiliasiEkspor(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/program/{id}/rekonsiliasi/ekspor', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dasbor deposit menunggu
     *
     * Dana menunggu per periode sasaran (terlambat = periode sasaran sudah lewat) dan daftar dana aktif/menunggu.
     *
     * `GET /v1/keuangan/beasiswa/deposit`
     *
     * scope: `keuangan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBeasiswaDeposit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/beasiswa/deposit', [], $query, null, $options, false, false);
    }

    /**
     * Catat pencairan
     *
     * Body {status: dicairkan|gagal|rencana, tanggal?, cara?, berkas_id? (UUID bukti; wajib untuk dicairkan bila belum ada), keterangan?}. Mahasiswa mendapat Kabar saat dicairkan.
     *
     * `POST /v1/keuangan/beasiswa/pencairan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID pencairan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBeasiswaPencairanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/beasiswa/pencairan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hak akses keuangan saya
     *
     * Pengelola keuangan (administrator, peran keuangan:kelola; level KEUANGAN lewat peran setara levelnya; level BAK hanya melihat ringkasan mahasiswa lewat izin baak.keuangan.lihat) atau mahasiswa, prodi yang boleh, tahun aktif, mode tagihan SIAKAD, dan sesi kasir terbuka.
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
     * Catat pembayaran (loket web / integrasi)
     *
     * TOKEN PETUGAS = loket web BAUK, satu jalur dengan UNIPO Kasir (Kasir\Services\Penerimaan): izin kasir.terima untuk unit penerbit jenis biaya, aturan titik kasir.terima + jadwal aktif (422 aturan_penerimaan), peramban disetujui (query kasir_perangkat, kasir_waktu, kasir_tanda; 403 perangkat_belum_disetujui) dan sesi kasir terbuka di peramban itu (403 sesi_belum_dibuka). Body: {"uuid" (idempoten), "nim", "tahun_id", "kode_biaya", "jumlah", "potongan", "ket_potongan", "metode": "tunai|transfer|va|lainnya", "keterangan", "referensi"}; tanggal = hari ini. Jawaban transaksi + kwitansi + peringatan (aturan tanpa SK). TOKEN APLIKASI (integrasi, keuangan:write): jalur lama, body + "tanggal", metode online, referensi sama = tidak dicatat dua kali.
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
     * Ajukan pembatalan pembayaran
     *
     * Body: {"alasan"} (min. 5 karakter). Pengelola keuangan prodi itu. TIDAK langsung membatalkan: membuat pengajuan pembatalan (status diajukan) yang harus disetujui pemegang izin bauk.pembatalan.setujui (bawaan Kepala BAUK) lewat /keuangan/pembatalan/{id}/setujui. Jawaban = transaksi + pembatalan. 409 bila sudah ada pengajuan yang menunggu.
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
     * Pengajuan pembatalan pembayaran
     *
     * Yang boleh diputus pemilik token (izin bauk.pembatalan.setujui di unit penerbit jenis biaya), yang ia ajukan, dan milik prodi kelolanya. Saring status (diajukan|disetujui|ditolak), transaksi_id. Setiap baris: boleh_putus.
     *
     * `GET /v1/keuangan/pembatalan`
     *
     * scope: `keuangan:read`
     *
     * @param array{status?: string, transaksi_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembatalan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pembatalan', [], $query, null, $options, false, false);
    }

    /**
     * Setujui pembatalan pembayaran (storno)
     *
     * Body: {"catatan"?}. Pemegang izin bauk.pembatalan.setujui untuk unit penerbit jenis biaya, bukan pengaju. Baris pembayaran asli TIDAK dihapus: dibuat baris pembalik negatif (t_mahasiswa_bayar, ket STORNO), transaksi menjadi batal (kwitansi/QR = BATAL), angsuran/deposit/sesi kasir disesuaikan, jurnal pembalik dibuat. Jawaban {pembatalan, transaksi, jurnal}.
     *
     * `POST /v1/keuangan/pembatalan/{id}/setujui`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID/UUID/nomor pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembatalanByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pembatalan/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tolak pembatalan pembayaran
     *
     * Body: {"catatan"} (alasan, min. 5 karakter). Penyetuju yang sama; pembayaran tetap sah.
     *
     * `POST /v1/keuangan/pembatalan/{id}/tolak`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID/UUID/nomor pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembatalanByIdTolak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pembatalan/{id}/tolak', ['id' => $id], $query, null, $options, false, false);
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
     * Loket: cari mahasiswa
     *
     * Token petugas berizin kasir.terima. NIM/nama (min. 3 huruf), maks. 30, hanya prodi yang dilayani jenis biaya terbitan unit petugas; per baris status_label, bisa_diproses, alasan, tunggakan (aturan kasir.terima jalur web).
     *
     * `GET /v1/keuangan/loket/mahasiswa`
     *
     * scope: `keuangan:read`
     *
     * @param array{q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLoketMahasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/loket/mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Loket: tagihan mahasiswa
     *
     * Token petugas berizin kasir.terima (baca saja, lingkup unit penerbit). Tagihan jenis biaya terbitan unit petugas dengan boleh/alasan (aturan kasir.terima + jadwal), tunggakan per periode, riwayat bayar, total.
     *
     * `GET /v1/keuangan/loket/mahasiswa/{nim}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLoketMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/loket/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Daftarkan peramban loket web
     *
     * Token petugas berizin kasir.terima. Body: {"perangkat_id", "kunci_publik" (PEM ECDSA P-256 dari WebCrypto), "nama", "sidik": {"nama_komputer", "os", "versi"}, "unit_id" (diminta), "catatan", "ajukan_ulang"}; ditandatangani kunci itu (query kasir_perangkat, kasir_waktu, kasir_tanda). Peramban berstatus menunggu sampai disetujui pemegang kasir.perangkat.setujui (sama dengan komputer UNIPO Kasir). Jawaban {perangkat, sesi_saya}.
     *
     * `POST /v1/keuangan/kasir/peramban`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKasirPeramban(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/kasir/peramban', [], $query, null, $options, false, false);
    }

    /**
     * Buka sesi kasir
     *
     * Token petugas (loket web): sesi di peramban yang disetujui (bukti peramban di query), body {"saldo_awal", "catatan"}; satu sesi terbuka per peramban dan per petugas. Token aplikasi: body {"saldo_awal", "loket"}.
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
     * Sesi peramban: body {"uang_fisik", "setoran", "catatan"} dengan bukti peramban; selisih = uang fisik - (saldo awal + tunai), rekap per metode & jenis biaya. Sesi lama tanpa perangkat: body {"setoran", "catatan"}, ditutup kasirnya.
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
     * Dana deposit bertujuan
     *
     * Pengelola: ringkasan dana menunggu per periode sasaran (terlambat = periode sasaran sudah lewat) dan daftar dana. Saring status (menunggu|aktif|habis|ditutup) dan sumber.
     *
     * `GET /v1/keuangan/deposit-dana`
     *
     * scope: `keuangan:read`
     *
     * @param array{status?: string, sumber?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDepositDana(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/deposit-dana', [], $query, null, $options, false, false);
    }

    /**
     * Catat dana deposit bertujuan
     *
     * Pengelola. Body {nim, sumber, nominal, label, sumber_ref? (idempoten per sumber+ref+nim), tahun_sasaran? (tagihan belum terbit = menunggu), prioritas?: [kode_biaya urut], lintas_periode?, aturan_sisa?: deposit|transfer|kewajiban|hangus, keterangan?}. Langsung dicoba dialokasikan.
     *
     * `POST /v1/keuangan/deposit-dana`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDepositDana(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/deposit-dana', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Alokasikan dana deposit ke tagihan
     *
     * Pengelola. Body {nim?, tahun_id?}. Sama dengan tugas terjadwal keu:deposit; setiap alokasi berkwitansi (metode deposit). Aman diulang.
     *
     * `POST /v1/keuangan/deposit-dana/alokasikan`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDepositDanaAlokasikan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/deposit-dana/alokasikan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kartu deposit mahasiswa
     *
     * Saldo, dana per sumber (masuk, terpakai, sisa, menunggu periode) dan alokasinya (tagihan + nomor bukti). Mahasiswa melihat miliknya.
     *
     * `GET /v1/keuangan/deposit-dana/kartu/{nim}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDepositDanaKartuByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/deposit-dana/kartu/{nim}', ['nim' => $nim], $query, null, $options, false, false);
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
     * Periode pembayaran: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Jatuh tempo pembayaran per periode akademik (opsional per prodi dan jenis biaya) beserta aturan denda keterlambatan. Dipakai /keuangan/denda/hitung dan status jatuh tempo tagihan. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/periode/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/periode/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * Kelompok UKT: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kelompok UKT per prodi (opsional per angkatan) dengan nominal untuk satu jenis biaya (m_item_biaya). Mahasiswa yang ditetapkan ke kelompok ditagih dengan nominal ini saat generate tagihan. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/ukt/kelompok/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktKelompokByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/ukt/kelompok/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * Penetapan UKT mahasiswa: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kelompok UKT tiap mahasiswa. Satu penetapan aktif (ditetapkan) per mahasiswa per jenis biaya; penetapan baru otomatis membatalkan yang lama. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/ukt/mahasiswa/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUktMahasiswaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/ukt/mahasiswa/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * Tarif per mata kuliah: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Tarif per SKS atau per mata kuliah (kode_mk kosong = berlaku untuk semua mata kuliah yang tidak punya tarif khusus). Dipakai POST /keuangan/tagihan/generate-mk untuk menagih dari KRS. Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/tarif-mk/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTarifMkByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/tarif-mk/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * Voucher: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kode voucher potongan. Mahasiswa memakainya lewat POST /keuangan/voucher/pakai; potongan langsung mengurangi tagihan. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/voucher/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getVoucherByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/voucher/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * Potongan tagihan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Potongan, beasiswa, atau keringanan atas satu tagihan. Saat diterapkan, nominal tagihan di t_mahasiswa_bayar_tagihan dikurangi (query ubah tagihan menu Keuangan, tercatat di m_log); dibatalkan = dikembalikan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/potongan/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPotonganByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/potongan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * @param array{nim: string, tahun_id?: string, untuk?: string, janji_bayar?: string, jumlah_janji?: float|int, alasan: string, catatan?: string, lampiran?: list<mixed>, ...} $body
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
     * @param array{nim: string, tahun_id?: string, untuk?: string, janji_bayar?: string, jumlah_janji?: float|int, alasan: string, catatan?: string, lampiran?: list<mixed>, ...} $body
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
     * Dispensasi pembayaran: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Mahasiswa mengajukan dispensasi (tetap boleh KRS/ujian dengan janji bayar); pengelola keuangan memutuskan. Dispensasi yang disetujui tampil di GET /keuangan/mahasiswa/{nim}/syarat dan otomatis mengecualikan aturan dinamis kategori keuangan (/v1/aturan) di KRS/ujian. Syarat pengajuan diatur aturan titik keuangan.dispensasi.ajukan. Aturan syarat bayar di halaman SIAKAD lama tidak diubah. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/dispensasi/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDispensasiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/dispensasi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * @param array{nim: string, tahun_id?: string, kode_biaya: string, jumlah_angsuran: int, mulai?: string, alasan?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
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
     * @param array{nim: string, tahun_id?: string, kode_biaya: string, jumlah_angsuran: int, mulai?: string, alasan?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
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
     * Cicilan pembayaran: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Mahasiswa mengajukan cicilan untuk satu tagihan; saat disetujui angsuran bulanan dibuat dari sisa tagihan. Pembayaran tagihan yang sama (lewat API) otomatis mengisi angsuran berurutan; semua lunas = status lunas. Syarat pengajuan (mis. jumlah angsuran maksimal) diatur aturan titik keuangan.cicilan.ajukan (/v1/aturan). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/cicilan/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCicilanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/cicilan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * @param array{nim: string, transaksi_id?: int, jumlah: float|int, alasan: string, tujuan?: string, bank?: string, no_rekening?: string, atas_nama?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
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
     * @param array{nim: string, transaksi_id?: int, jumlah: float|int, alasan: string, tujuan?: string, bank?: string, no_rekening?: string, atas_nama?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
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
     * Refund: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pengembalian dana (kelebihan bayar, batal studi). Tujuan deposit: saat disetujui saldo deposit langsung bertambah (status dibayar). Tujuan rekening: disetujui lalu ditandai dibayar setelah transfer. Pembayaran di t_mahasiswa_bayar tidak dihapus; untuk membatalkan pembayaran yang salah pakai POST /keuangan/transaksi/{id}/batal. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/refund/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRefundByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/refund/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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
     * Denda keterlambatan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Denda yang dihitung POST /keuangan/denda/hitung dari periode pembayaran. Nominal ditagihkan sebagai tagihan kode_biaya_denda di tabel lama. Dihapuskan = tagihan denda dinolkan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/keuangan/denda/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDendaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/denda/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
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

    /**
     * Sesi kasir: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Sesi loket kasir. Buka dengan POST /keuangan/kasir/buka, tutup dengan POST /keuangan/kasir/{id}/tutup. Pembayaran oleh kasir yang sesinya terbuka otomatis masuk ke sesi itu. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/kasir/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKasirByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/kasir/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Statistik keringanan dan beasiswa
     *
     * Transparansi: per skema (pengajuan, menunggu, disetujui, ditolak, total potongan, kuota), per kategori, per unit penanggung biaya, per prodi, dan persentase potongan terhadap tagihan periode. Hanya pengelola keuangan (berlingkup unit: prodinya) atau pimpinan bidang keuangan (izin dashboard.bidang.keuangan global); selain itu 403.
     *
     * `GET /v1/keuangan/keringanan/statistik`
     *
     * scope: `keuangan:read`
     *
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKeringananStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/keringanan/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Terapkan keringanan ke tagihan periode
     *
     * Admin keuangan. Body {"tahun_id"?, "pratinjau"?: true}. Semua pengajuan disetujui yang masih berlaku (lama_semester) dipasang ke tagihan periode itu; aman diulang. Jalankan setelah generate tagihan semester (cron keu:keringanan melakukannya otomatis).
     *
     * `POST /v1/keuangan/keringanan/terapkan-massal`
     *
     * scope: `keuangan:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKeringananTerapkanMassal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/keringanan/terapkan-massal', [], $query, null, $options, false, false);
    }

    /**
     * Terapkan satu pengajuan ke tagihan
     *
     * Body {"tahun_id"?}. Untuk pengajuan disetujui; aman diulang.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/terapkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID, UUID, atau nomor pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdTerapkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/terapkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Proses keuangan mahasiswa baru
     *
     * Sama dengan yang dijalankan otomatis setelah daftar ulang (event mahasiswa.terdaftar): tautkan pengajuan keringanan maba ke NIM, buat tagihan semester pertama, pasang potongan, dan akui pembayaran daftar ulang PMB per jenis biaya (/keuangan/pemetaan-pmb; sisa masuk deposit). Aman diulang.
     *
     * `POST /v1/keuangan/mahasiswa-baru/{nim}/proses`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMahasiswaBaruByNimProses(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/mahasiswa-baru/{nim}/proses', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: daftar
     *
     * Program potongan biaya (mis. potongan anak dosen/tendik, saudara kandung, prestasi, keringanan ekonomi, kerja sama instansi, beasiswa yayasan). Besaran persen atau nominal per jenis biaya per periode (kode_biaya kosong = semua tagihan), sasaran maba/mahasiswa, prodi dan angkatan, lama berlaku dalam semester, syarat berkas [{kode, nama, keterangan, wajib}], wajib SK, kuota, masa pengajuan, unit penanggung biaya (unit_id, kosong = universitas/yayasan). Bila beasiswa_id diisi, penerima program beasiswa kemahasiswaan otomatis mendapat potongan ini. Semua orang bertoken boleh membaca (transparansi). Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/skema-potongan`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kategori?: string, dasar?: string, sasaran?: string, angkatan_min?: string, angkatan_maks?: string, wajib_sk?: string, perlu_verifikasi?: string, unit_id?: string, beasiswa_id?: string, gabung?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaPotongan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/skema-potongan', [], $query, null, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/keuangan/skema-potongan`
     *
     * scope: `keuangan:write`
     *
     * @param array{kode: string, nama: string, kategori?: string, dasar?: string, nilai: float|int, maks_nominal?: float|int, kode_biaya?: array<string, mixed>, sasaran?: string, kode_prodi?: array<string, mixed>, angkatan_min?: string, angkatan_maks?: string, lama_semester?: int, syarat?: array<string, mixed>, wajib_sk?: bool, perlu_verifikasi?: bool, kuota?: int, daftar_mulai?: string, daftar_selesai?: string, unit_id?: int, beasiswa_id?: int, gabung?: bool, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkemaPotongan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/skema-potongan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: detail
     *
     * Program potongan biaya (mis. potongan anak dosen/tendik, saudara kandung, prestasi, keringanan ekonomi, kerja sama instansi, beasiswa yayasan). Besaran persen atau nominal per jenis biaya per periode (kode_biaya kosong = semua tagihan), sasaran maba/mahasiswa, prodi dan angkatan, lama berlaku dalam semester, syarat berkas [{kode, nama, keterangan, wajib}], wajib SK, kuota, masa pengajuan, unit penanggung biaya (unit_id, kosong = universitas/yayasan). Bila beasiswa_id diisi, penerima program beasiswa kemahasiswaan otomatis mendapat potongan ini. Semua orang bertoken boleh membaca (transparansi). Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/skema-potongan/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaPotonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/skema-potongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/skema-potongan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kode: string, nama: string, kategori?: string, dasar?: string, nilai: float|int, maks_nominal?: float|int, kode_biaya?: array<string, mixed>, sasaran?: string, kode_prodi?: array<string, mixed>, angkatan_min?: string, angkatan_maks?: string, lama_semester?: int, syarat?: array<string, mixed>, wajib_sk?: bool, perlu_verifikasi?: bool, kuota?: int, daftar_mulai?: string, daftar_selesai?: string, unit_id?: int, beasiswa_id?: int, gabung?: bool, status?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkemaPotonganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/skema-potongan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/keuangan/skema-potongan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSkemaPotonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/skema-potongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Program potongan biaya (mis. potongan anak dosen/tendik, saudara kandung, prestasi, keringanan ekonomi, kerja sama instansi, beasiswa yayasan). Besaran persen atau nominal per jenis biaya per periode (kode_biaya kosong = semua tagihan), sasaran maba/mahasiswa, prodi dan angkatan, lama berlaku dalam semester, syarat berkas [{kode, nama, keterangan, wajib}], wajib SK, kuota, masa pengajuan, unit penanggung biaya (unit_id, kosong = universitas/yayasan). Bila beasiswa_id diisi, penerima program beasiswa kemahasiswaan otomatis mendapat potongan ini. Semua orang bertoken boleh membaca (transparansi). Semua pemilik token ber-scope keuangan:read.
     *
     * `GET /v1/keuangan/skema-potongan/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkemaPotonganByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/skema-potongan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: Buka pengajuan
     *
     * Pengelola modul. Status harus draf/tutup, menjadi buka.
     *
     * `POST /v1/keuangan/skema-potongan/{id}/buka`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkemaPotonganByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/skema-potongan/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Skema potongan, keringanan, dan beasiswa: Tutup pengajuan
     *
     * Pengelola modul. Status harus draf/buka, menjadi tutup.
     *
     * `POST /v1/keuangan/skema-potongan/{id}/tutup`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkemaPotonganByIdTutup(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/skema-potongan/{id}/tutup', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: daftar
     *
     * Alur: draf (mahasiswa mengisi dan mengunggah berkas syarat lewat /berkas dengan jenis = kode syarat) -> ajukan -> verifikasi (unit/fakultas, bila skema perlu_verifikasi) -> setujui (admin keuangan; wajib nomor SK dan lampiran berjenis "sk" bila skema wajib_sk; kuota dicek) -> potongan otomatis dipasang ke tagihan periode berjalan (dan periode berikutnya sampai lama_semester lewat cron keu:keringanan). Bisa juga ditolak, dikembalikan untuk diperbaiki, atau dicabut (opsional mengembalikan potongan pada tagihan yang belum lunas). Petugas boleh membuatkan pengajuan untuk mahasiswa (isi nim). Pengajuan maba dibuat dari aplikasi PMB dan ditautkan ke NIM setelah daftar ulang. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengaju).
     *
     * `GET /v1/keuangan/pengajuan-potongan`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, skema_id?: string, nim?: string, kode_prodi?: string, tahun_id?: string, sumber?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanPotongan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengajuan-potongan', [], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf.
     *
     * `POST /v1/keuangan/pengajuan-potongan`
     *
     * scope: `keuangan:write`
     *
     * @param array{skema_id: int, nim?: string, tahun_id?: string, alasan?: string, nomor_sk?: string, tanggal_sk?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotongan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: detail
     *
     * Alur: draf (mahasiswa mengisi dan mengunggah berkas syarat lewat /berkas dengan jenis = kode syarat) -> ajukan -> verifikasi (unit/fakultas, bila skema perlu_verifikasi) -> setujui (admin keuangan; wajib nomor SK dan lampiran berjenis "sk" bila skema wajib_sk; kuota dicek) -> potongan otomatis dipasang ke tagihan periode berjalan (dan periode berikutnya sampai lama_semester lewat cron keu:keringanan). Bisa juga ditolak, dikembalikan untuk diperbaiki, atau dicabut (opsional mengembalikan potongan pada tagihan yang belum lunas). Petugas boleh membuatkan pengajuan untuk mahasiswa (isi nim). Pengajuan maba dibuat dari aplikasi PMB dan ditautkan ke NIM setelah daftar ulang. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengaju).
     *
     * `GET /v1/keuangan/pengajuan-potongan/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanPotonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengajuan-potongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/pengajuan-potongan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{skema_id: int, nim?: string, tahun_id?: string, alasan?: string, nomor_sk?: string, tanggal_sk?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengajuanPotonganById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/pengajuan-potongan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf.
     *
     * `DELETE /v1/keuangan/pengajuan-potongan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengajuanPotonganById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/pengajuan-potongan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Alur: draf (mahasiswa mengisi dan mengunggah berkas syarat lewat /berkas dengan jenis = kode syarat) -> ajukan -> verifikasi (unit/fakultas, bila skema perlu_verifikasi) -> setujui (admin keuangan; wajib nomor SK dan lampiran berjenis "sk" bila skema wajib_sk; kuota dicek) -> potongan otomatis dipasang ke tagihan periode berjalan (dan periode berikutnya sampai lama_semester lewat cron keu:keringanan). Bisa juga ditolak, dikembalikan untuk diperbaiki, atau dicabut (opsional mengembalikan potongan pada tagihan yang belum lunas). Petugas boleh membuatkan pengajuan untuk mahasiswa (isi nim). Pengajuan maba dibuat dari aplikasi PMB dan ditautkan ke NIM setelah daftar ulang. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (pengaju).
     *
     * `GET /v1/keuangan/pengajuan-potongan/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanPotonganByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengajuan-potongan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/keuangan/pengajuan-potongan/{id}/berkas`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanPotonganByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengajuan-potongan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (pengaju diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/berkas`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pengajuan potongan/keringanan: unduh lampiran
     *
     * `GET /v1/keuangan/pengajuan-potongan/{id}/berkas/{uuid}`
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
    public function getPengajuanPotonganByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengajuan-potongan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (pengaju diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status draf.
     *
     * `DELETE /v1/keuangan/pengajuan-potongan/{id}/berkas/{uuid}`
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
    public function deletePengajuanPotonganByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/pengajuan-potongan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: Ajukan
     *
     * Pemilik data atau pengelola. Status harus draf, menjadi diajukan.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/ajukan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: Kembalikan untuk diperbaiki
     *
     * Pengelola modul. Status harus diajukan/diverifikasi, menjadi draf.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/kembalikan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: Verifikasi berkas dan kelayakan
     *
     * Pengelola modul. Status harus diajukan, menjadi diverifikasi.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/verifikasi`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: Setujui dan terapkan ke tagihan
     *
     * Admin modul. Status harus diajukan/diverifikasi, menjadi disetujui.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/setujui`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nomor_sk?: string, tanggal_sk?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: Tolak
     *
     * Pengelola modul. Status harus diajukan/diverifikasi, menjadi ditolak.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/tolak`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan potongan/keringanan: Cabut keringanan
     *
     * Admin modul. Status harus disetujui/selesai, menjadi dicabut.
     *
     * `POST /v1/keuangan/pengajuan-potongan/{id}/cabut`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, kembalikan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanPotonganByIdCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengajuan-potongan/{id}/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemetaan biaya PMB ke jenis biaya: daftar
     *
     * Jenis rincian biaya PMB (pmb_biaya.jenis: daftar_ulang, ukt, spp, pengembangan, almamater, lainnya) -> kode biaya SIAKAD. Dipakai untuk mengakui pembayaran daftar ulang PMB sebagai pembayaran tagihan semester pertama dan untuk memotong tagihan PMB maba yang keringanannya disetujui. kode_prodi kosong = semua prodi. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/pemetaan-pmb`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, kode_prodi?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemetaanPmb(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pemetaan-pmb', [], $query, null, $options, false, false);
    }

    /**
     * Pemetaan biaya PMB ke jenis biaya: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/keuangan/pemetaan-pmb`
     *
     * scope: `keuangan:write`
     *
     * @param array{jenis: string, kode_prodi?: string, kode_biaya: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemetaanPmb(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pemetaan-pmb', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemetaan biaya PMB ke jenis biaya: detail
     *
     * Jenis rincian biaya PMB (pmb_biaya.jenis: daftar_ulang, ukt, spp, pengembangan, almamater, lainnya) -> kode biaya SIAKAD. Dipakai untuk mengakui pembayaran daftar ulang PMB sebagai pembayaran tagihan semester pertama dan untuk memotong tagihan PMB maba yang keringanannya disetujui. kode_prodi kosong = semua prodi. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/pemetaan-pmb/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemetaanPmbById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pemetaan-pmb/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemetaan biaya PMB ke jenis biaya: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/pemetaan-pmb/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{jenis: string, kode_prodi?: string, kode_biaya: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPemetaanPmbById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/pemetaan-pmb/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pemetaan biaya PMB ke jenis biaya: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/keuangan/pemetaan-pmb/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePemetaanPmbById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/pemetaan-pmb/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pemetaan biaya PMB ke jenis biaya: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Jenis rincian biaya PMB (pmb_biaya.jenis: daftar_ulang, ukt, spp, pengembangan, almamater, lainnya) -> kode biaya SIAKAD. Dipakai untuk mengakui pembayaran daftar ulang PMB sebagai pembayaran tagihan semester pertama dan untuk memotong tagihan PMB maba yang keringanannya disetujui. kode_prodi kosong = semua prodi. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/pemetaan-pmb/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemetaanPmbByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pemetaan-pmb/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengaturan keuangan mahasiswa: daftar
     *
     * Kunci yang dikenal: daftar_ulang_otomatis (bawaan 0): Tagihan daftar ulang PMB lunas = daftar ulang otomatis (NIM dari aturan NIM); kredit_daftar_ulang (bawaan 1): Pembayaran daftar ulang PMB diakui sebagai pembayaran tagihan semester pertama; tagihan_maba_otomatis (bawaan 1): Tagihan semester pertama dibuat otomatis setelah daftar ulang; potong_tagihan_pmb (bawaan 1): Potongan maba yang disetujui mengurangi tagihan daftar ulang PMB yang belum dibayar. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/pengaturan`
     *
     * scope: `keuangan:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan keuangan mahasiswa: tambah
     *
     * Hanya admin modul.
     *
     * `POST /v1/keuangan/pengaturan`
     *
     * scope: `keuangan:write`
     *
     * @param array{kunci: string, nilai?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/pengaturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengaturan keuangan mahasiswa: detail
     *
     * Kunci yang dikenal: daftar_ulang_otomatis (bawaan 0): Tagihan daftar ulang PMB lunas = daftar ulang otomatis (NIM dari aturan NIM); kredit_daftar_ulang (bawaan 1): Pembayaran daftar ulang PMB diakui sebagai pembayaran tagihan semester pertama; tagihan_maba_otomatis (bawaan 1): Tagihan semester pertama dibuat otomatis setelah daftar ulang; potong_tagihan_pmb (bawaan 1): Potongan maba yang disetujui mengurangi tagihan daftar ulang PMB yang belum dibayar. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/pengaturan/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengaturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengaturan keuangan mahasiswa: ubah
     *
     * Hanya admin modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/keuangan/pengaturan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kunci: string, nilai?: string, keterangan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengaturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/pengaturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengaturan keuangan mahasiswa: hapus
     *
     * Hanya admin modul.
     *
     * `DELETE /v1/keuangan/pengaturan/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengaturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/keuangan/pengaturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengaturan keuangan mahasiswa: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kunci yang dikenal: daftar_ulang_otomatis (bawaan 0): Tagihan daftar ulang PMB lunas = daftar ulang otomatis (NIM dari aturan NIM); kredit_daftar_ulang (bawaan 1): Pembayaran daftar ulang PMB diakui sebagai pembayaran tagihan semester pertama; tagihan_maba_otomatis (bawaan 1): Tagihan semester pertama dibuat otomatis setelah daftar ulang; potong_tagihan_pmb (bawaan 1): Potongan maba yang disetujui mengurangi tagihan daftar ulang PMB yang belum dibayar. Hanya pengelola modul.
     *
     * `GET /v1/keuangan/pengaturan/{id}/riwayat`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/pengaturan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cara bayar tagihan
     *
     * online = payment gateway aktif (Pustikom » Integrasi) beserta metode tiap penyedia; tanpa gateway: petunjuk bayar di loket.
     *
     * `GET /v1/keuangan/saya/cara-bayar`
     *
     * scope: `keuangan:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaCaraBayar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/saya/cara-bayar', [], $query, null, $options, false, false);
    }

    /**
     * Bayar online invoice saya
     *
     * Body {metode: checkout|va|qris, kanal? (kode bank untuk va), penyedia?}. Jumlah dari invoice; transaksi menunggu untuk invoice yang sama dipakai ulang. Hasil: url_bayar / nomor_va / qr_string. 409 online_belum_tersedia bila gateway belum aktif.
     *
     * `POST /v1/keuangan/saya/invoice/{nomor}/bayar`
     *
     * scope: `keuangan:write` · hanya token pengguna
     *
     * @param int|string $nomor Nomor invoice (POST /v1/keuangan/invoice)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaInvoiceByNomorBayar(int|string $nomor, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/saya/invoice/{nomor}/bayar', ['nomor' => $nomor], $query, null, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: ringkasan
     *
     * Kebijakan yang berlaku sekarang (versi terbit berdasar SK, atau nilai bawaan sistem beserta peringatan), nilai bawaan, daftar versi, dan boleh_kelola. Pemilik: BAUK.
     *
     * `GET /v1/keuangan/petunjuk-bayar`
     *
     * scope: `keuangan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetunjukBayar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/petunjuk-bayar', [], $query, null, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: yang berlaku
     *
     * {sumber: aturan|bawaan, versi, isi, peringatan}. Query tanggal=YYYY-MM-DD (bawaan hari ini).
     *
     * `GET /v1/keuangan/petunjuk-bayar/berlaku`
     *
     * scope: `keuangan:read`
     *
     * @param array{tanggal?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetunjukBayarBerlaku(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/petunjuk-bayar/berlaku', [], $query, null, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: draf versi baru
     *
     * Body {nama, dasar_hukum?, berlaku_tanggal?, catatan_perubahan?, isi?, sk_id?}. Isi kosong = nilai bawaan.
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi`
     *
     * scope: `keuangan:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: detail versi
     *
     * Isi, SK, riwayat, perubahan dari versi induk.
     *
     * `GET /v1/keuangan/petunjuk-bayar/versi/{id}`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetunjukBayarVersiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/petunjuk-bayar/versi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: ubah draf
     *
     * Versi terbit dikunci; salin menjadi versi baru untuk mengubah.
     *
     * `PUT /v1/keuangan/petunjuk-bayar/versi/{id}`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPetunjukBayarVersiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/keuangan/petunjuk-bayar/versi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: salin jadi versi baru
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi/{id}/salin`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersiByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: banding versi
     *
     * Perubahan dibanding versi `dengan` (bawaan: yang berlaku; tanpa versi terbit: nilai bawaan).
     *
     * `GET /v1/keuangan/petunjuk-bayar/versi/{id}/banding`
     *
     * scope: `keuangan:read`
     *
     * @param int|string $id ID versi
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPetunjukBayarVersiByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/keuangan/petunjuk-bayar/versi/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: Terbitkan (wajib alasan perubahan; SK dianjurkan)
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi/{id}/terbitkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersiByIdTerbitkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi/{id}/terbitkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: Arsipkan versi terbit
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi/{id}/arsipkan`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersiByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Petunjuk dan rekening bayar mahasiswa: Hapus draf
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi/{id}/hapus`
     *
     * scope: `keuangan:write`
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersiByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan persetujuan rekening
     *
     * Body {catatan?}. Draf yang mengubah rekening dibanding yang berlaku tidak bisa diterbitkan langsung (409 perlu_persetujuan); kabar dikirim ke Kepala BAUK.
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi/{id}/ajukan`
     *
     * scope: `keuangan:write` · hanya token pengguna
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersiByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui rekening (Kepala BAUK)
     *
     * Versi langsung terbit. Pengusul tidak boleh menyetujui sendiri (409). Body {catatan?}.
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi/{id}/setujui`
     *
     * scope: `keuangan:write` · hanya token pengguna
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersiByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tolak rekening (Kepala BAUK)
     *
     * Body {catatan} wajib. Pengusul mendapat kabar; draf bisa diperbaiki lalu diajukan ulang.
     *
     * `POST /v1/keuangan/petunjuk-bayar/versi/{id}/tolak`
     *
     * scope: `keuangan:write` · hanya token pengguna
     *
     * @param int|string $id ID versi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPetunjukBayarVersiByIdTolak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/keuangan/petunjuk-bayar/versi/{id}/tolak', ['id' => $id], $query, null, $options, false, false);
    }
}
