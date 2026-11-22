<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kalender: Terpadu, Kalender: Hari kerja, Kalender: Periode, Kalender: Batas waktu, Kalender: Kunci periode, Kalender: Kunci fitur per periode, Kalender: Kegiatan
 */
final class Kalender extends Resource
{
    /**
     * Kalender terpadu
     *
     * Gabungan kegiatan kalender yang terbit (sesuai level pengguna), tahapan tahun akademik di `m_tahun`, batas waktu per prodi di `m_bataskrs*`/`m_batas_*`, agenda portal yang terbit, dan jadwal PMB. Tabel lama hanya dibaca. Bawaan rentang: 30 hari lalu s.d. 180 hari ke depan, maksimal 400 hari. `kode_fakultas` (tanpa kode_prodi): tahapan kalender yang khusus fakultas/prodi lain dilewati.
     *
     * `GET /v1/kalender/terpadu`
     *
     * scope: `kalender:read`
     *
     * @param array{dari?: string, sampai?: string, kode_prodi?: string, tahun_id?: string, sumber?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerpadu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/terpadu', [], $query, null, $options, false, false);
    }

    /**
     * Langganan iCalendar (publik)
     *
     * File .ics tanpa token untuk Google Calendar/Outlook/ponsel. Berisi kegiatan terbit yang untuk semua, tahapan tahun akademik, agenda portal, dan PMB (batas per prodi tidak ikut). Bawaan rentang: 60 hari lalu s.d. 1 tahun ke depan.
     *
     * `GET /v1/kalender/ics`
     *
     * publik (tanpa token)
     *
     * @param array{dari?: string, sampai?: string, kode_prodi?: string, tahun_id?: string, sumber?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIcs(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/ics', [], $query, null, $options, false, true);
    }

    /**
     * Tahun akademik
     *
     * Tahun akademik terbaru dari `m_tahun` (hanya baca) beserta tahapannya.
     *
     * `GET /v1/kalender/tahun`
     *
     * scope: `kalender:read`
     *
     * @param array{batas?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTahun(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/tahun', [], $query, null, $options, false, false);
    }

    /**
     * Hitung hari kerja
     *
     * Jumlah hari kerja dalam rentang (Senin-Jumat, atau Senin-Sabtu bila `sabtu=1`), dikurangi kegiatan terbit yang libur. `sasaran=pegawai` hanya libur yang berlaku untuk pegawai (semua + khusus kepegawaian), `sasaran=mahasiswa` libur akademik.
     *
     * `GET /v1/kalender/hari-kerja`
     *
     * scope: `kalender:read`
     *
     * @param array{dari?: string, sampai?: string, kode_prodi?: string, sabtu?: string, sasaran?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getHariKerja(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/hari-kerja', [], $query, null, $options, false, false);
    }

    /**
     * Tanggal setelah N hari kerja
     *
     * Untuk menghitung tenggat (mis. SLA layanan) dengan melompati akhir pekan dan libur.
     *
     * `GET /v1/kalender/tambah-hari-kerja`
     *
     * scope: `kalender:read`
     *
     * @param array{dari?: string, hari?: int, kode_prodi?: string, sabtu?: string, sasaran?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTambahHariKerja(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/tambah-hari-kerja', [], $query, null, $options, false, false);
    }

    /**
     * Jenis tahapan
     *
     * Jenis tahapan beserta titik aturan yang ditegakkan (peta bisa ditimpa), warna bawaan, dan kolom m_tahun yang ditulis-tembus. titik[].ada = titik sudah ada di katalog aturan (belum ada = tahapan disimpan tetapi belum ditegakkan).
     *
     * `GET /v1/kalender/periode-katalog`
     *
     * scope: `akademik:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/periode-katalog', [], $query, null, $options, false, false);
    }

    /**
     * Atur peta jenis tahapan ke titik
     *
     * Body: {"jenis": "cetak_krs", "titik": ["krs.cetak"]}. Sama dengan bawaan = timpaan dihapus. Butuh izin kalender.periode.kelola.
     *
     * `POST /v1/kalender/periode-katalog/peta`
     *
     * scope: `akademik:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeKatalogPeta(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode-katalog/peta', [], $query, null, $options, false, false);
    }

    /**
     * Daftar periode
     *
     * kal_periode (periode lama di m_tahun disalin otomatis) dengan status (draf, diajukan, dijadwalkan, berjalan, selesai), progres tahapan, tahapan berjalan/berikut, dan ringkas aturan turunan. meta.boleh_kelola, meta.boleh_buka.
     *
     * `GET /v1/kalender/periode`
     *
     * scope: `akademik:read`
     *
     * @param array{batas?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/periode', [], $query, null, $options, false, false);
    }

    /**
     * Buat periode
     *
     * Body: {"tahun": "2027", "semester": "1", "nama"?, "jenis"?, "templat_dari"?: "20261", "mulai"?: "2027-08-01"}. m_tahun baru lewat TahunRepository::tambah; dari templat: tahapan disalin dan tanggal digeser (ke tanggal mulai, atau selisih tahun). Butuh izin kalender.periode.kelola.
     *
     * `POST /v1/kalender/periode`
     *
     * scope: `akademik:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode', [], $query, null, $options, false, false);
    }

    /**
     * Detail periode
     *
     * Periode + tahapan (dengan "ditegakkan": titik dan aturan turunannya) + aturan turunan + pengaturan lama m_tahun (max_sks, min_presensi, syarat_krs*) + jumlah status mahasiswa.
     *
     * `GET /v1/kalender/periode/{tahun}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByTahun(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/periode/{tahun}', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Ubah periode dan SK kalender
     *
     * Body: {"nama"?, "jenis"?, "keterangan"?, "sk_id"?: UUID SK registri (docs/SK.md) | null, "sk"?: {"nomor", "tanggal", "perihal", "berkas_id"} (klien lama: dicari/diajukan di registri)}. Penetap (tempat, jabatan, nama, tanda tangan) diambil dari SK registri; sk_tempat/penetap_* tidak diterima lagi.
     *
     * `POST /v1/kalender/periode/{tahun}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahun(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Tambah tahapan
     *
     * Body: {"judul", "jenis", "mulai": "YYYY-MM-DD[ HH:MM]", "selesai"?, "cakupan"?: {"prodi": [], "fakultas": [], "jenjang": [], "angkatan_min", "angkatan_max"}, "warna"?, "tampil"?, "libur"?, "keterangan"?}. Lalu tulis-tembus m_tahun (tahapan untuk semua) dan draf aturan batas_waktu turunan. Jawaban memuat sinkron.
     *
     * `POST /v1/kalender/periode/{tahun}/tahapan`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunTahapan(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/tahapan', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Ubah tahapan
     *
     * Body sama dengan tambah (sebagian boleh).
     *
     * `POST /v1/kalender/periode/{tahun}/tahapan/{tahapan}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param int|string $tahapan UUID tahapan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunTahapanByTahapan(int|string $tahun, int|string $tahapan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/tahapan/{tahapan}', ['tahun' => $tahun, 'tahapan' => $tahapan], $query, null, $options, false, false);
    }

    /**
     * Hapus tahapan
     *
     * Aturan turunan yang tidak dipakai lagi: draf dihapus, aktif dinonaktifkan. Kolom m_tahun tidak dikosongkan.
     *
     * `POST /v1/kalender/periode/{tahun}/tahapan/{tahapan}/hapus`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param int|string $tahapan UUID tahapan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunTahapanByTahapanHapus(int|string $tahun, int|string $tahapan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/tahapan/{tahapan}/hapus', ['tahun' => $tahun, 'tahapan' => $tahapan], $query, null, $options, false, false);
    }

    /**
     * Urutkan tahapan
     *
     * Body: {"urutan": ["uuid", ...]}.
     *
     * `POST /v1/kalender/periode/{tahun}/urutan`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunUrutan(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/urutan', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Bentuk aturan batas waktu
     *
     * Bentuk atau samakan aturan batas waktu turunan dari tahapan yang ada (mis. periode yang disalin dari tahun akademik lama) tanpa mengubah tahapan. Aturan baru berstatus draf sampai kalender diajukan. Atas nama pengelola kalender (izin kalender.periode.kelola), tanpa izin aturan:<kategori> terpisah. Jawaban memuat sinkron.aturan (dibuat, diperbarui, galat per langkah).
     *
     * `POST /v1/kalender/periode/{tahun}/bentuk-aturan`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunBentukAturan(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/bentuk-aturan', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Ajukan kalender
     *
     * SK kalender wajib. Semua aturan turunan diperbarui, diberi SK kalender, dan diajukan sekaligus ke alur persetujuan aturan (telaah SPMI, penyetuju bidang). Body: {"catatan"?}.
     *
     * `POST /v1/kalender/periode/{tahun}/ajukan`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunAjukan(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/ajukan', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Buka periode
     *
     * Jalur lama: buka + tutup periode lain + CekStatusAllMhs (sama dengan POST /v1/akademik/periode/{id}/buka). Butuh izin akademik.periode.buka.
     *
     * `POST /v1/kalender/periode/{tahun}/buka`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunBuka(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/buka', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Aturan yang berlaku di periode
     *
     * Aturan akademik/kelulusan/keuangan/kemahasiswaan dengan tahun_id periode ini atau semua periode (bukan turunan kalender), dikelompokkan per titik. Draf/diajukan hanya untuk pengelola.
     *
     * `GET /v1/kalender/periode/{tahun}/aturan`
     *
     * scope: `akademik:read`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByTahunAturan(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/periode/{tahun}/aturan', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Status buka/tutup langkah
     *
     * Untuk ditampilkan di fitur aplikasi baru. Query: titik (dipisah koma, mis. krs.ambil,ujian.uts), prodi?, nim? (pengelola), tahun_id? (bawaan tahun aktif). Mahasiswa: dirinya sendiri lewat mesin aturan. Jawaban per titik: {titik, label, keadaan: buka|akan|tutup|bebas, mulai, selesai, pesan ("Dibuka s.d. …", "Belum dibuka, mulai …", "Sudah ditutup …"), catatan (perpanjangan/penutupan per prodi, menunggu persetujuan, jadwal SIAKAD lama), jendela (rentang per sasaran, mis. SMT 3, 5, 7 / Maba), sumber: aturan|lama|kosong}.
     *
     * `GET /v1/kalender/status`
     *
     * scope: `kalender:read`
     *
     * @param array{titik?: string, prodi?: string, nim?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/status', [], $query, null, $options, false, false);
    }

    /**
     * Matriks batas waktu
     *
     * Prodi × titik: rentang dari aturan batas_waktu aktif (sumber aturan), aturan yang belum disetujui (menunggu), atau baris tabel batas lama (lama); keadaan buka/akan/tutup; perpanjangan per prodi; baris lama per kampus dan lama_beda.
     *
     * `GET /v1/kalender/batas`
     *
     * scope: `akademik:read`
     *
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBatas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/batas', [], $query, null, $options, false, false);
    }

    /**
     * Perpanjang batas waktu per prodi
     *
     * Body: {"tahun_id", "titik", "prodi": [...], "sampai": "YYYY-MM-DD[ HH:MM]", "alasan", "dasar"?: {"nomor", "tanggal", "berkas_id"}}. Per prodi: pengecualian prodi pada aturan batas_waktu aktif (berlaku sampai tanggal baru) + tanggal selesai tabel batas lama prodi itu. Jawaban {berhasil, gagal}.
     *
     * `POST /v1/kalender/batas/perpanjang`
     *
     * scope: `akademik:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBatasPerpanjang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/batas/perpanjang', [], $query, null, $options, false, false);
    }

    /**
     * Tutup lebih awal per prodi (dihentikan, 410)
     *
     * DIHENTIKAN 2026-11-18 (keputusan pemilik): selalu 410 dihentikan; Pengecualian waktu hanya perpanjang dan buka kembali. Data lama tetap di riwayat dan bisa dicabut. Dulu: Body: {"tahun_id", "titik", "prodi": [...], "sampai"?: "YYYY-MM-DD[ HH:MM]", "segera"?: true (tutup sekarang), "darurat"?: true (izin aturan.darurat: langsung berlaku), "alasan", "dasar": {"nomor", "tanggal", "berkas_id"}}. Per prodi: aturan batas_waktu penyempitan (cakupan prodi, selesai = tanggal baru) dengan SK/memo, diajukan ke alur persetujuan aturan (atau jalur darurat). Tabel lama tidak disentuh. Jawaban {berhasil, gagal}.
     *
     * `POST /v1/kalender/batas/tutup`
     *
     * scope: `akademik:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBatasTutup(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/batas/tutup', [], $query, null, $options, false, false);
    }

    /**
     * Cabut perpanjangan
     *
     * Perpanjangan: pengecualian dihapus (tanggal tabel lama dikembalikan bila tadi ikut diubah). Penutupan: aturan penyempitan dinonaktifkan (berlaku) atau dihapus (belum berlaku).
     *
     * `POST /v1/kalender/batas/perpanjangan/{id}/cabut`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id UUID perpanjangan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBatasPerpanjanganByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/batas/perpanjangan/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat perpanjangan
     *
     * Perpanjangan per prodi (termasuk yang dicabut).
     *
     * `GET /v1/kalender/batas/riwayat`
     *
     * scope: `akademik:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBatasRiwayat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/batas/riwayat', [], $query, null, $options, false, false);
    }

    /**
     * Status buka/tutup periode
     *
     * Untuk pemilih periode semua aplikasi. Per periode: keadaan aktif|dibuka|ditutup|dibuka_kembali, sejak, oleh, alasan, buka_kembali yang berlaku (fitur, prodi, sampai). Aturan: semua periode sebelum periode aktif (m_tahun.buka) ditutup; perubahan data periode ditutup ditolak 423 periode_ditutup untuk semua peran. meta: aktif, modul (fitur yang bisa dibuka kembali), boleh_buka_kembali.
     *
     * `GET /v1/kalender/kunci`
     *
     * scope: `kalender:read`
     *
     * @param array{batas?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunci(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kunci', [], $query, null, $options, false, false);
    }

    /**
     * Pantauan SIAKAD lama
     *
     * Perubahan data periode ditutup yang ditemukan pemantau harian kalender:pantau-siakad-lama (sidik tabel inti per periode × prodi). saat_buka_kembali = ada buka kembali berlaku (mungkin sah). meta.diperiksa_at.
     *
     * `GET /v1/kalender/kunci/siakad-lama`
     *
     * scope: `akademik:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunciSiakadLama(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kunci/siakad-lama', [], $query, null, $options, false, false);
    }

    /**
     * Tandai perubahan ditinjau
     *
     * Izin kalender.periode.kelola.
     *
     * `POST /v1/kalender/kunci/siakad-lama/{id}/tinjau`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID perubahan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKunciSiakadLamaByIdTinjau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kunci/siakad-lama/{id}/tinjau', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail kunci periode
     *
     * Status, riwayat Pengecualian waktu (semua jenis), dan 50 catatan terakhir (ditolak 423, pengecualian resmi, lolos karena buka kembali).
     *
     * `GET /v1/kalender/kunci/{tahun}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunciByTahun(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kunci/{tahun}', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Riwayat Pengecualian waktu
     *
     * Perpanjang dan buka kembali untuk satu periode (data lama "tutup lebih awal" tampil sebagai jenis lama, jenis_lama: true); buka kembali "semua prodi" ikut tampil.
     *
     * `GET /v1/kalender/pengecualian-waktu`
     *
     * scope: `akademik:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengecualianWaktu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/pengecualian-waktu', [], $query, null, $options, false, false);
    }

    /**
     * Tambah Pengecualian waktu
     *
     * Body {jenis: perpanjang|buka_kembali, ...}. perpanjang: sama dengan /batas/perpanjang, hanya untuk periode yang dibuka (periode ditutup: 409 periode_ditutup, saran_jenis buka_kembali). buka_kembali: {tahun_id, modul: ["nilai", …] | ["*"], prodi: ["55201", …] | ["*"], mulai?, sampai (maks. 180 hari), alasan (min. 10), sk_id (registri SK) | dasar: {nomor, tanggal, berkas_id}}; izin akademik.periode.buka_kembali, hanya untuk periode yang ditutup, tercatat, otomatis terkunci lagi lewat tanggal sampai.
     *
     * `POST /v1/kalender/pengecualian-waktu`
     *
     * scope: `akademik:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengecualianWaktu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/pengecualian-waktu', [], $query, null, $options, false, false);
    }

    /**
     * Cabut Pengecualian waktu
     *
     * Perpanjang (dan data lama tutup lebih awal): seperti /batas/perpanjangan/{id}/cabut. Buka kembali: langsung terkunci lagi (izin akademik.periode.buka_kembali).
     *
     * `POST /v1/kalender/pengecualian-waktu/{id}/cabut`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengecualianWaktuByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/pengecualian-waktu/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tutup periode (manual)
     *
     * Body {alasan}. Periode selain periode aktif. Periode sebelum periode aktif sudah ditutup otomatis; ini menambah catatan alasan, atau menutup periode sesudah periode aktif. Izin akademik.periode.buka.
     *
     * `POST /v1/kalender/periode/{tahun}/tutup`
     *
     * scope: `akademik:write`
     *
     * @param int|string $tahun Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByTahunTutup(int|string $tahun, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/periode/{tahun}/tutup', ['tahun' => $tahun], $query, null, $options, false, false);
    }

    /**
     * Katalog fitur berperiode
     *
     * Semua rute tulis yang dijaga kunci periode (peta Data/kunci_periode.php, rute yang dijaga otomatis karena membawa tahun_id, Sumber PusatData bertahun), dikelompokkan per fitur dan modul, dengan keputusan bawaan, aturan aplikasi yang berlaku, dan status di periode `tahun_id` (dibuka, terkunci, dikecualikan, bukan_berperiode, dibuka_kembali[_sebagian]). entri[].belum_diklasifikasi = rute di luar peta yang membawa tahun_id (tetap terkunci). Izin kalender.kunci.lihat atau kalender.kunci.atur.
     *
     * `GET /v1/kalender/kunci-fitur`
     *
     * scope: `akademik:read`
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunciFitur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kunci-fitur', [], $query, null, $options, false, false);
    }

    /**
     * Daftar aturan kunci
     *
     * Aturan kal_kunci_aturan (berlaku, akan, berakhir, dicabut). meta.boleh_atur.
     *
     * `GET /v1/kalender/kunci-fitur/aturan`
     *
     * scope: `akademik:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunciFiturAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kunci-fitur/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Buat aturan kunci
     *
     * Body {sasaran: rute|awalan|fitur|modul|sumber, kunci, keputusan: ikut_kunci|dikecualikan|bukan_berperiode, tahun_id? (kosong = semua periode), prodi?: [..] (kosong = semua prodi), mulai?, sampai?, alasan (min. 10), dasar_nomor?}. Menimpa keputusan bawaan Data/kunci_periode.php; aturan paling khusus menang. Tercatat di riwayat dan induk_log. Izin kalender.kunci.atur. Buka sementara fitur di periode ditutup: POST /v1/kalender/pengecualian-waktu jenis buka_kembali dengan modul ["fitur:<kode>"].
     *
     * `POST /v1/kalender/kunci-fitur/aturan`
     *
     * scope: `akademik:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKunciFiturAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kunci-fitur/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Cabut aturan kunci
     *
     * Body {alasan}. Rute kembali ke keputusan bawaan (atau aturan lain yang berlaku). Izin kalender.kunci.atur.
     *
     * `POST /v1/kalender/kunci-fitur/aturan/{id}/cabut`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKunciFiturAturanByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kunci-fitur/aturan/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat aturan kunci
     *
     * Buat/cabut beserta pelaku, alasan, dan isi aturan.
     *
     * `GET /v1/kalender/kunci-fitur/riwayat`
     *
     * scope: `akademik:read`
     *
     * @param array{aturan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunciFiturRiwayat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kunci-fitur/riwayat', [], $query, null, $options, false, false);
    }

    /**
     * Simulasi penjaga kunci
     *
     * Body {metode, path (pola rute atau path nyata), tahun_id, prodi?: [..]} atau {sumber: tabel PusatData, tahun_id, prodi?}. Menjalankan PenjagaPeriode sungguhan dengan periode & prodi data yang diberikan (tanpa menulis catatan): hasil ditolak (423) atau lolos beserta sebabnya, aturan yang dipakai, dan keputusan bawaan.
     *
     * `POST /v1/kalender/kunci-fitur/simulasi`
     *
     * scope: `akademik:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKunciFiturSimulasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kunci-fitur/simulasi', [], $query, null, $options, false, false);
    }

    /**
     * Kegiatan kalender: daftar
     *
     * Kegiatan kalender akademik, libur, dan cuti bersama. Yang berstatus `terbit` bisa dibaca semua orang (juga tanpa token) sesuai `untuk` (level pengguna, dipisah koma; kosong = semua). `libur = true` membuat tanggalnya tidak dihitung sebagai hari kerja; `sasaran_libur` menentukan siapa yang libur (semua, pegawai, mahasiswa). Libur yang berlaku untuk pegawai dipakai presensi, cuti, dan payroll SDM. Semua pemilik token ber-scope kalender:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/kalender/kegiatan`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, libur?: string, sasaran_libur?: string, jenis_libur?: string, unit_id?: string, kode_prodi?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan', [], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: tambah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kalender/kegiatan`
     *
     * scope: `kalender:write`
     *
     * @param array{judul: string, jenis?: string, keterangan?: string, mulai: string, selesai?: string, jam_mulai?: string, jam_selesai?: string, libur?: bool, sasaran_libur?: string, jenis_libur?: string, unit_id?: int, kode_prodi?: string, untuk?: string, lokasi?: string, tautan?: string, warna?: string, status?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kegiatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan kalender: detail
     *
     * Kegiatan kalender akademik, libur, dan cuti bersama. Yang berstatus `terbit` bisa dibaca semua orang (juga tanpa token) sesuai `untuk` (level pengguna, dipisah koma; kosong = semua). `libur = true` membuat tanggalnya tidak dihitung sebagai hari kerja; `sasaran_libur` menentukan siapa yang libur (semua, pegawai, mahasiswa). Libur yang berlaku untuk pegawai dipakai presensi, cuti, dan payroll SDM. Semua pemilik token ber-scope kalender:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/kalender/kegiatan/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: ubah
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/kalender/kegiatan/{id}`
     *
     * scope: `kalender:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, jenis?: string, keterangan?: string, mulai: string, selesai?: string, jam_mulai?: string, jam_selesai?: string, libur?: bool, sasaran_libur?: string, jenis_libur?: string, unit_id?: int, kode_prodi?: string, untuk?: string, lokasi?: string, tautan?: string, warna?: string, status?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kalender/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan kalender: hapus
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kalender/kegiatan/{id}`
     *
     * scope: `kalender:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kalender/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan kalender: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kegiatan kalender akademik, libur, dan cuti bersama. Yang berstatus `terbit` bisa dibaca semua orang (juga tanpa token) sesuai `untuk` (level pengguna, dipisah koma; kosong = semua). `libur = true` membuat tanggalnya tidak dihitung sebagai hari kerja; `sasaran_libur` menentukan siapa yang libur (semua, pegawai, mahasiswa). Libur yang berlaku untuk pegawai dipakai presensi, cuti, dan payroll SDM. Semua pemilik token ber-scope kalender:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/kalender/kegiatan/{id}/riwayat`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan/{id}/riwayat', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/kalender/kegiatan/{id}/berkas`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan/{id}/berkas', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `POST /v1/kalender/kegiatan/{id}/berkas`
     *
     * scope: `kalender:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kalender/kegiatan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Kegiatan kalender: unduh lampiran
     *
     * `GET /v1/kalender/kegiatan/{id}/berkas/{uuid}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kalender/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, true);
    }

    /**
     * Kegiatan kalender: hapus lampiran
     *
     * Pengelola modul (peran ber-unit hanya untuk unitnya).
     *
     * `DELETE /v1/kalender/kegiatan/{id}/berkas/{uuid}`
     *
     * scope: `kalender:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kalender/kegiatan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }
}
