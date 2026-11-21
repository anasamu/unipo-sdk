<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * SPMI: Publik, SPMI: Umum, SPMI: Organisasi, SPMI: Penetapan, SPMI: Pelaksanaan, SPMI: AMI, SPMI: Pengendalian, SPMI: Peningkatan, SPMI: Survei, SPMI: Akreditasi, SPMI: Usulan akreditasi prodi, SPMI: Kelengkapan akreditasi, SPMI: Pelaporan, SPMI: File
 */
final class Spmi extends Resource
{
    /**
     * Dokumen mutu publik
     *
     * Tanpa token. Kebijakan, manual, standar, dan dokumen mutu lain yang disahkan dan ditandai publik (untuk situs kampus dan tautan pelaporan SPMI).
     *
     * `GET /v1/spmi/publik/dokumen`
     *
     * publik (tanpa token)
     *
     * @param array{jenis?: string, unit?: string, fakultas?: string, prodi?: string, turunan?: int, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/publik/dokumen', [], $query, null, $options, false, true);
    }

    /**
     * Status akreditasi terkini
     *
     * Tanpa token. Status akreditasi institusi dan prodi yang sedang berlaku.
     *
     * `GET /v1/spmi/publik/akreditasi`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikAkreditasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/publik/akreditasi', [], $query, null, $options, false, true);
    }

    /**
     * Formulir survei responden luar
     *
     * Tanpa token. Untuk survei bersasaran mitra, orang tua, atau umum; token ada di survei (token_publik) setelah terbit.
     *
     * `GET /v1/spmi/publik/survei/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token token_publik survei
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPublikSurveiByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/publik/survei/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Kirim jawaban survei responden luar
     *
     * Tanpa token. Body: jawaban (daftar {pertanyaan_id, nilai | teks | pilihan}), nama dan instansi opsional (tidak disimpan bila survei anonim).
     *
     * `POST /v1/spmi/publik/survei/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token token_publik survei
     * @param array{jawaban: list<mixed>, nama?: string|null, instansi?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPublikSurveiByToken(int|string $token, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/publik/survei/{token}', ['token' => $token], $options['query'] ?? [], $body, $options, false, true);
    }

    /**
     * Pilihan nilai dan dasar regulasi
     *
     * Tahap PPEPP, peran, jenis dokumen, bidang/kelompok standar, kategori temuan, status akreditasi Pasal 73, lembaga akreditasi, katalog metrik otomatis dari SIAKAD, dll.
     *
     * `GET /v1/spmi/referensi`
     *
     * scope: `spmi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Peran SPMI saya
     *
     * Peran per unit, status admin SPMI, ID auditor, dan unit yang datanya bisa dilihat.
     *
     * `GET /v1/spmi/saya`
     *
     * scope: `spmi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/saya', [], $query, null, $options, false, false);
    }

    /**
     * Dasbor siklus PPEPP
     *
     * Ringkasan periode: status tiap tahap PPEPP, capaian standar, AMI, temuan (terlambat), RTM, survei, risiko tinggi, peringatan akreditasi, kelengkapan pelaporan. Tanpa periode_id = periode berjalan/terbaru.
     *
     * `GET /v1/spmi/dasbor`
     *
     * scope: `spmi:read`
     *
     * @param array{periode_id?: int, unit_id?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDasbor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/dasbor', [], $query, null, $options, false, false);
    }

    /**
     * Tugas SPMI saya
     *
     * Capaian belum diajukan, temuan yang perlu ditindaklanjuti, penugasan audit, tindak lanjut yang perlu diverifikasi, survei yang belum diisi, butir akreditasi dan keputusan RTM yang menjadi PIC saya.
     *
     * `GET /v1/spmi/tugas-saya`
     *
     * scope: `spmi:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTugasSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/tugas-saya', [], $query, null, $options, false, false);
    }

    /**
     * Notifikasi saya
     *
     * `GET /v1/spmi/notifikasi`
     *
     * scope: `spmi:read` · hanya token pengguna · berhalaman
     *
     * @param array{belum_dibaca?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNotifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/notifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Tandai semua notifikasi dibaca
     *
     * `POST /v1/spmi/notifikasi/baca`
     *
     * scope: `spmi:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNotifikasiBaca(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/notifikasi/baca', [], $query, null, $options, false, false);
    }

    /**
     * Tandai satu notifikasi dibaca
     *
     * `POST /v1/spmi/notifikasi/{id}/baca`
     *
     * scope: `spmi:read` · hanya token pengguna
     *
     * @param int|string $id ID notifikasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNotifikasiByIdBaca(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/notifikasi/{id}/baca', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Statistik SPMI
     *
     * Untuk grafik dan laporan: tren 6 periode (persen capaian tercapai/terisi, temuan, KTS, respons survei), sebaran temuan per kategori/status/sumber/unit/standar, rata-rata hari penutupan, tindak lanjut, pemenuhan capaian, matriks risiko 5x5, akreditasi (status, peringkat, lembaga, berakhir 12 bulan), dokumen mutu, AMI (status auditee, hasil tilik, skor), survei. Lingkup unit mengikuti hak lihat.
     *
     * `GET /v1/spmi/statistik`
     *
     * scope: `spmi:read`
     *
     * @param array{periode_id?: int, unit_id?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Aturan mutu yang berlaku untuk saya
     *
     * Hasil periksa aturan dinamis kategori mutu (/v1/aturan) di titik spmi.* untuk pemilik token tanpa menolak: pelanggaran, peringatan, batas waktu/nilai, dan aturan yang baru dinilai saat aksi (saat_aksi). Cakupan prodi/fakultas mengikuti unit_id.
     *
     * `GET /v1/spmi/aturan`
     *
     * scope: `spmi:read`
     *
     * @param array{titik?: string, unit_id?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Tim pengelola aplikasi SPMI
     *
     * Admin SPMI. Peran Staf LPM, Operator SPMI, dan Kepala LPM beserta izinnya, pemegang aktif (penugasan RBAC), dan personel peran admin. boleh_kelola = boleh memberi/mencabut (Kepala LPM atau ADMIN).
     *
     * `GET /v1/spmi/tim`
     *
     * scope: `spmi:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/tim', [], $query, null, $options, false, false);
    }

    /**
     * Tambah anggota tim pengelola
     *
     * Kepala LPM (izin spmi.pengelola) atau ADMIN. Body: username (akun SIAKAD aktif, dosen atau tendik), peran (staf-lpm | operator-spmi | kepala-lpm; kepala-lpm hanya oleh ADMIN), selesai, nomor_sk, alasan. Dicatat sebagai penugasan RBAC global sumber aplikasi.
     *
     * `POST /v1/spmi/tim`
     *
     * scope: `spmi:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTim(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/tim', [], $query, null, $options, false, false);
    }

    /**
     * Cabut anggota tim pengelola
     *
     * Kepala LPM atau ADMIN. Penugasan dinonaktifkan dengan tanggal selesai hari ini.
     *
     * `POST /v1/spmi/tim/{id}/cabut`
     *
     * scope: `spmi:write` · hanya token pengguna
     *
     * @param int|string $id ID penugasan RBAC
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTimByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/tim/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat unit dari data SIAKAD
     *
     * Admin SPMI. Membuat unit universitas, LPM, fakultas (m_fakultas), dan prodi (m_program_studi) yang belum ada; dekan dan kaprodi yang punya akun menjadi personel peran pimpinan. Aman diulang.
     *
     * `POST /v1/spmi/unit/sinkron-siakad`
     *
     * scope: `spmi:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnitSinkronSiakad(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/unit/sinkron-siakad', [], $query, null, $options, false, false);
    }

    /**
     * Uji metrik otomatis
     *
     * Hitung metrik dari data SIAKAD untuk unit dan periode tanpa menyimpan (lihat katalog di /referensi metrik).
     *
     * `GET /v1/spmi/metrik/{kode}/uji`
     *
     * scope: `spmi:read`
     *
     * @param int|string $kode Kode metrik
     * @param array{periode_id: int, unit_id: int, indikator_id?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMetrikByKodeUji(int|string $kode, array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/metrik/{kode}/uji', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Berlakukan standar
     *
     * Admin SPMI. Draf → berlaku (wajib punya indikator aktif). Versi yang digantikan (menggantikan_id) otomatis dicabut. Body opsional: berlaku_mulai.
     *
     * `POST /v1/spmi/standar/{id}/berlakukan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID standar
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postStandarByIdBerlakukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/standar/{id}/berlakukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar capaian indikator
     *
     * Capaian indikator per unit per periode beserta target, nilai, nilai otomatis dari SIAKAD, pemenuhan, dan status verifikasi. Hanya unit yang terlihat oleh Anda.
     *
     * `GET /v1/spmi/capaian`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{periode_id?: int, unit_id?: int, standar_id?: int, indikator_id?: int, bidang?: string, status?: string, pemenuhan?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCapaian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/capaian', [], $query, null, $options, false, false);
    }

    /**
     * Rekap pemenuhan standar
     *
     * Persentase indikator terpenuhi dan terisi: total, per bidang, per standar, per unit.
     *
     * `GET /v1/spmi/capaian/rekap`
     *
     * scope: `spmi:read`
     *
     * @param array{periode_id: int, unit_id?: int, bidang?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCapaianRekap(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/capaian/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Siapkan baris capaian
     *
     * Buat baris capaian untuk indikator aktif dari standar berlaku yang lingkupnya cocok dengan unit. Body: periode_id, unit_id (kosong = semua unit, admin SPMI). Target diambil dari /target.
     *
     * `POST /v1/spmi/capaian/siapkan`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int, unit_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianSiapkan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/capaian/siapkan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hitung capaian otomatis dari SIAKAD
     *
     * Isi nilai_otomatis untuk indikator bermetrik. Nilai dan pemenuhan ikut terisi bila capaian belum diisi manual. Body: periode_id, unit_id (kosong = semua, admin SPMI).
     *
     * `POST /v1/spmi/capaian/hitung`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int, unit_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianHitung(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/capaian/hitung', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan semua capaian unit
     *
     * Semua capaian unit pada periode yang sudah berisi nilai diajukan untuk verifikasi.
     *
     * `POST /v1/spmi/capaian/ajukan`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int, unit_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianAjukan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/capaian/ajukan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail capaian
     *
     * Termasuk rincian hitungan metrik dan riwayat.
     *
     * `GET /v1/spmi/capaian/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID capaian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCapaianById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/capaian/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi capaian
     *
     * Oleh pengelola/pimpinan/pic unit selama draf/dikembalikan. Pemenuhan dihitung dari nilai dan target (melampaui = lebih baik >= 10%); untuk indikator teks/ya_tidak boleh diisi.
     *
     * `PUT /v1/spmi/capaian/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID capaian
     * @param array{nilai?: float|int|null, nilai_teks?: string|null, pemenuhan?: string, analisis?: string|null, kendala?: string|null, rencana_perbaikan?: string|null, tautan_bukti?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putCapaianById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/capaian/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hitung ulang satu capaian otomatis
     *
     * `POST /v1/spmi/capaian/{id}/hitung`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID capaian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianByIdHitung(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/capaian/{id}/hitung', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ajukan capaian
     *
     * `POST /v1/spmi/capaian/{id}/ajukan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID capaian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/capaian/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Verifikasi capaian
     *
     * Oleh LPM, pimpinan unit, atau pengelola/pimpinan unit induk. Body: setuju (bool), catatan (wajib bila dikembalikan).
     *
     * `POST /v1/spmi/capaian/{id}/verifikasi`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID capaian
     * @param array{setuju: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCapaianByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/capaian/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail audit lengkap
     *
     * Audit beserta standar yang diaudit, auditee, tim auditor, dan progres.
     *
     * `GET /v1/spmi/audit/{id}/lengkap`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID audit
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditByIdLengkap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/audit/{id}/lengkap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penugasan audit saya
     *
     * Auditee tempat saya menjadi ketua/anggota tim auditor.
     *
     * `GET /v1/spmi/audit/tugas-saya`
     *
     * scope: `spmi:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditTugasSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/audit/tugas-saya', [], $query, null, $options, false, false);
    }

    /**
     * Atur lingkup standar audit
     *
     * Admin SPMI. Body: standar_id (daftar ID). Menggantikan lingkup sebelumnya.
     *
     * `PUT /v1/spmi/audit/{id}/standar`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID audit
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAuditByIdStandar(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/audit/{id}/standar', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah auditee
     *
     * Admin SPMI. Body: unit_id, jadwal_desk, jadwal_visitasi, tempat. Pengelola dan pimpinan unit diberi notifikasi.
     *
     * `POST /v1/spmi/audit/{id}/auditee`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID audit
     * @param array{unit_id: int, jadwal_desk?: string|null, jadwal_visitasi?: string|null, tempat?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditByIdAuditee(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/audit/{id}/auditee', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah jadwal auditee
     *
     * `PUT /v1/spmi/audit/{id}/auditee/{auditee}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID audit
     * @param int|string $auditee ID auditee
     * @param array{unit_id: int, jadwal_desk?: string|null, jadwal_visitasi?: string|null, tempat?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAuditByIdAuditeeByAuditee(int|string $id, int|string $auditee, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/audit/{id}/auditee/{auditee}', ['id' => $id, 'auditee' => $auditee], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus auditee
     *
     * Ditolak bila sudah dinilai/punya temuan.
     *
     * `DELETE /v1/spmi/audit/{id}/auditee/{auditee}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID audit
     * @param int|string $auditee ID auditee
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAuditByIdAuditeeByAuditee(int|string $id, int|string $auditee, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/audit/{id}/auditee/{auditee}', ['id' => $id, 'auditee' => $auditee], $query, null, $options, false, false);
    }

    /**
     * Detail auditee
     *
     * Termasuk tim auditor, peran saya, dan progres daftar tilik.
     *
     * `GET /v1/spmi/auditee/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditeeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/auditee/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah tahap audit auditee
     *
     * Admin atau ketua tim: dijadwalkan → evaluasi_diri → desk → visitasi → pelaporan. Body: status.
     *
     * `POST /v1/spmi/auditee/{id}/status`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditeeByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditee/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tugaskan auditor
     *
     * Admin SPMI. Body: auditor_id, peran (ketua|anggota). Ditolak bila auditor berasal dari unit yang diaudit/induk/turunannya atau menjadi personel mutunya (independensi).
     *
     * `POST /v1/spmi/auditee/{id}/tim`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditeeByIdTim(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditee/{id}/tim', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas auditor
     *
     * `DELETE /v1/spmi/auditee/{id}/tim/{auditor}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param int|string $auditor ID auditor
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAuditeeByIdTimByAuditor(int|string $id, int|string $auditor, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/auditee/{id}/tim/{auditor}', ['id' => $id, 'auditor' => $auditor], $query, null, $options, false, false);
    }

    /**
     * Daftar tilik auditee
     *
     * `GET /v1/spmi/auditee/{id}/tilik`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditeeByIdTilik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/auditee/{id}/tilik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah butir tilik
     *
     * Auditor tim. Body: pertanyaan, standar_id, indikator_id, urut.
     *
     * `POST /v1/spmi/auditee/{id}/tilik`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditeeByIdTilik(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditee/{id}/tilik', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat daftar tilik dari standar
     *
     * Admin/ketua tim. Satu butir per indikator aktif standar lingkup audit yang cocok dengan jenis unit, beserta capaian unit pada periode audit.
     *
     * `POST /v1/spmi/auditee/{id}/tilik/siapkan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditeeByIdTilikSiapkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditee/{id}/tilik/siapkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat temuan dari daftar tilik
     *
     * Auditor tim. Butir ber-hasil kts_mayor/kts_minor/observasi menjadi temuan (batas waktu 30/60 hari). praktik_baik=true juga membuat temuan praktik baik dari butir "melampaui".
     *
     * `POST /v1/spmi/auditee/{id}/temuan-dari-tilik`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array{praktik_baik?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditeeByIdTemuanDariTilik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditee/{id}/temuan-dari-tilik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Laporan AMI auditee
     *
     * Auditee, audit, rekap hasil tilik, daftar tilik, temuan.
     *
     * `GET /v1/spmi/auditee/{id}/laporan`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditeeByIdLaporan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/auditee/{id}/laporan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi ringkasan laporan
     *
     * Ketua tim. Body: kekuatan, peluang_peningkatan, kesimpulan.
     *
     * `PUT /v1/spmi/auditee/{id}/laporan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAuditeeByIdLaporan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/auditee/{id}/laporan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Auditee menyetujui laporan
     *
     * Pimpinan/pengelola unit. Body: tanggapan.
     *
     * `POST /v1/spmi/auditee/{id}/setujui`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditeeByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditee/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * LPM mengesahkan laporan
     *
     * Status selesai; audit selesai bila semua auditee selesai.
     *
     * `POST /v1/spmi/auditee/{id}/sahkan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID auditee
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditeeByIdSahkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditee/{id}/sahkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi butir tilik
     *
     * Unit yang diaudit: jawaban_auditee, tautan_bukti, capaian. Auditor tim: skor (0-4), hasil, catatan_auditor, pertanyaan. Terkunci setelah laporan disetujui.
     *
     * `PUT /v1/spmi/tilik/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID butir tilik
     * @param array{jawaban_auditee?: string|null, tautan_bukti?: string|null, capaian?: float|int|null, skor?: int, hasil?: string, catatan_auditor?: string|null, pertanyaan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTilikById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/tilik/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus butir tilik
     *
     * `DELETE /v1/spmi/tilik/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID butir tilik
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTilikById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/tilik/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar temuan
     *
     * Temuan unit yang terlihat, temuan auditee yang saya audit, dan temuan dengan PIC saya.
     *
     * `GET /v1/spmi/temuan`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{periode_id?: int, unit_id?: int, kategori?: string, status?: string, sumber?: string, audit_id?: int, auditee_id?: int, standar_id?: int, terlambat?: string, saya?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/temuan', [], $query, null, $options, false, false);
    }

    /**
     * Catat temuan
     *
     * AMI: auditor tim (auditee_id). Sumber lain: LPM atau pengelola mutu unit. Kode otomatis TM-<tahun>-<urut>. PIC dan pengelola unit diberi notifikasi.
     *
     * `POST /v1/spmi/temuan`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int, unit_id: int, sumber?: string, auditee_id?: int|null, daftar_tilik_id?: int|null, standar_id?: int|null, indikator_id?: int|null, kategori: string, uraian: string, kriteria?: string|null, akar_masalah?: string|null, akibat?: string|null, rekomendasi?: string|null, pic_username?: string|null, batas_waktu?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemuan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/temuan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail temuan
     *
     * Termasuk tindak lanjut dan riwayat.
     *
     * `GET /v1/spmi/temuan/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID temuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTemuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/temuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah temuan
     *
     * `PUT /v1/spmi/temuan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID temuan
     * @param array{periode_id: int, unit_id: int, sumber?: string, auditee_id?: int|null, daftar_tilik_id?: int|null, standar_id?: int|null, indikator_id?: int|null, kategori: string, uraian: string, kriteria?: string|null, akar_masalah?: string|null, akibat?: string|null, rekomendasi?: string|null, pic_username?: string|null, batas_waktu?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTemuanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/temuan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan temuan
     *
     * Admin SPMI. Body: alasan.
     *
     * `POST /v1/spmi/temuan/{id}/batal`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID temuan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemuanByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/temuan/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tutup temuan
     *
     * Auditor auditee atau LPM. KTS hanya bisa ditutup setelah semua tindak lanjut diterima (otomatis tertutup saat TL terakhir diterima). Body: catatan.
     *
     * `POST /v1/spmi/temuan/{id}/tutup`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID temuan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemuanByIdTutup(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/temuan/{id}/tutup', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah tindak lanjut (PTK)
     *
     * Pengelola/pic unit atau PIC temuan. Body: jenis (koreksi|korektif|pencegahan|peningkatan), rencana, penanggung_jawab, target_tanggal.
     *
     * `POST /v1/spmi/temuan/{id}/tindak-lanjut`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID temuan
     * @param array{jenis?: string, rencana: string, penanggung_jawab?: string|null, target_tanggal?: string|null, realisasi?: string|null, tanggal_realisasi?: string|null, tautan_bukti?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemuanByIdTindakLanjut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/temuan/{id}/tindak-lanjut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Perbarui tindak lanjut
     *
     * Isi realisasi, tanggal_realisasi, tautan_bukti, status (rencana|proses|selesai). Status selesai mengirim notifikasi ke auditor untuk verifikasi.
     *
     * `PUT /v1/spmi/temuan/{id}/tindak-lanjut/{tl}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID temuan
     * @param int|string $tl ID tindak lanjut
     * @param array{jenis?: string, rencana: string, penanggung_jawab?: string|null, target_tanggal?: string|null, realisasi?: string|null, tanggal_realisasi?: string|null, tautan_bukti?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTemuanByIdTindakLanjutByTl(int|string $id, int|string $tl, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/temuan/{id}/tindak-lanjut/{tl}', ['id' => $id, 'tl' => $tl], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus tindak lanjut
     *
     * `DELETE /v1/spmi/temuan/{id}/tindak-lanjut/{tl}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID temuan
     * @param int|string $tl ID tindak lanjut
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTemuanByIdTindakLanjutByTl(int|string $id, int|string $tl, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/temuan/{id}/tindak-lanjut/{tl}', ['id' => $id, 'tl' => $tl], $query, null, $options, false, false);
    }

    /**
     * Verifikasi tindak lanjut
     *
     * Auditor auditee atau LPM. Body: terima (bool), catatan (wajib bila ditolak).
     *
     * `POST /v1/spmi/temuan/{id}/tindak-lanjut/{tl}/verifikasi`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID temuan
     * @param int|string $tl ID tindak lanjut
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTemuanByIdTindakLanjutByTlVerifikasi(int|string $id, int|string $tl, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/temuan/{id}/tindak-lanjut/{tl}/verifikasi', ['id' => $id, 'tl' => $tl], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Siapkan bahan RTM
     *
     * Rangkum capaian standar, hasil AMI, temuan, tindak lanjut, survei kepuasan, risiko utama, dan keputusan RTM lalu yang belum selesai ke kolom masukan.
     *
     * `POST /v1/spmi/rtm/{id}/siapkan-masukan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID RTM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRtmByIdSiapkanMasukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/rtm/{id}/siapkan-masukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sahkan RTM
     *
     * Pimpinan unit atau LPM; status harus terlaksana. PIC keputusan diberi notifikasi.
     *
     * `POST /v1/spmi/rtm/{id}/sahkan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID RTM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRtmByIdSahkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/rtm/{id}/sahkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * RTM beserta keputusan
     *
     * `GET /v1/spmi/rtm/{id}/lengkap`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID RTM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRtmByIdLengkap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/rtm/{id}/lengkap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat standar versi baru dari keputusan RTM
     *
     * Admin SPMI. Menyalin standar (dan indikatornya) pada keputusan menjadi versi baru berstatus draf. Body: versi (wajib) dan kolom standar yang diubah. Berlakukan lewat POST /standar/{id}/berlakukan.
     *
     * `POST /v1/spmi/rtm-keputusan/{id}/tingkatkan-standar`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID keputusan RTM
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRtmKeputusanByIdTingkatkanStandar(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/rtm-keputusan/{id}/tingkatkan-standar', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Survei untuk saya
     *
     * Survei terbit yang sedang dibuka sesuai jenis saya (mahasiswa, dosen, tendik) dan prodi, dengan tanda sudah_mengisi.
     *
     * `GET /v1/spmi/survei/saya`
     *
     * scope: `spmi:respond` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei/saya', [], $query, null, $options, false, false);
    }

    /**
     * Rekap kuisioner layanan dosen lama
     *
     * Hanya baca m_kuisioner + m_jawab_kuisioner per semester (A=5 ... E=1).
     *
     * `GET /v1/spmi/survei/edom`
     *
     * scope: `spmi:read`
     *
     * @param array{tahun_id: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiEdom(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei/edom', [], $query, null, $options, false, false);
    }

    /**
     * Formulir survei
     *
     * Butir survei dan jawaban saya sebelumnya.
     *
     * `GET /v1/spmi/survei/{id}/formulir`
     *
     * scope: `spmi:respond` · hanya token pengguna
     *
     * @param int|string $id ID survei
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiByIdFormulir(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei/{id}/formulir', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim jawaban survei
     *
     * Satu respons per pengguna; mengirim ulang selama survei dibuka mengganti jawaban. Survei anonim tidak menyimpan username.
     *
     * `POST /v1/spmi/survei/{id}/isi`
     *
     * scope: `spmi:respond` · hanya token pengguna
     *
     * @param int|string $id ID survei
     * @param array{jawaban: list<mixed>, nama?: string|null, instansi?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSurveiByIdIsi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/survei/{id}/isi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Terbitkan survei
     *
     * Pengelola unit survei / LPM. Sasaran luar mendapat token_publik.
     *
     * `POST /v1/spmi/survei/{id}/terbit`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID survei
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSurveiByIdTerbit(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/survei/{id}/terbit', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tutup survei
     *
     * `POST /v1/spmi/survei/{id}/tutup`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID survei
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSurveiByIdTutup(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/survei/{id}/tutup', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rekap survei
     *
     * Responden, indeks kepuasan, persen puas, per dimensi (SERVQUAL), per prodi, per butir, jawaban teks.
     *
     * `GET /v1/spmi/survei/{id}/rekap`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID survei
     * @param array{kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiByIdRekap(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei/{id}/rekap', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pantau masa berlaku akreditasi
     *
     * Status terkini institusi dan setiap prodi: kedaluwarsa, segera_ajukan (<= hari), belum_ada_data, aman; serta persiapan yang sedang berjalan.
     *
     * `GET /v1/spmi/akreditasi/pantau`
     *
     * scope: `spmi:read`
     *
     * @param array{hari?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPantau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi/pantau', [], $query, null, $options, false, false);
    }

    /**
     * Impor status akreditasi dari SIAKAD
     *
     * Admin SPMI. Membaca kode_akreditasi/no_sk_ban/tgl_sk_ban di m_program_studi dan m_perguruan_tinggi (tidak diubah) sebagai riwayat sumber=siakad.
     *
     * `POST /v1/spmi/akreditasi/sinkron-siakad`
     *
     * scope: `spmi:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiSinkronSiakad(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi/sinkron-siakad', [], $query, null, $options, false, false);
    }

    /**
     * Acuan pengelolaan akreditasi
     *
     * Lembaga dan peringkat (data, dengan kode_siakad pemetaan ke kode lama), status Pasal 73, masa berlaku bawaan, ambang pengingat, unit universitas/prodi, dan boleh_kelola.
     *
     * `GET /v1/spmi/akreditasi/acuan`
     *
     * scope: `spmi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiAcuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi/acuan', [], $query, null, $options, false, false);
    }

    /**
     * Akreditasi per unit
     *
     * Institusi dan setiap prodi aktif: akreditasi terkini (lembaga, peringkat, SK, berlaku sampai, keadaan berlaku|segera_habis (<= 12 bulan)|habis|proses|tidak_terakreditasi), jumlah riwayat dan sertifikat, serta ringkasan per keadaan (belum_diisi = belum ada data).
     *
     * `GET /v1/spmi/akreditasi/kelola`
     *
     * scope: `spmi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKelola(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi/kelola', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat akreditasi unit
     *
     * Semua akreditasi unit (terkini dulu) dengan SK registri, sertifikat (file SPMI entitas akreditasi, beserta tempatnya di Arsip universitas), anomali data (nomor SK kosong, masa berlaku janggal, peringkat tanpa kode lama, pemetaan status lama), integrasi (kelengkapan persiapan aktif, usulan prodi yang menunggu, tautan lampiran data otomatis), waktu tulis ke SIAKAD lama, dan persiapan/rencana reakreditasi yang berjalan.
     *
     * `GET /v1/spmi/akreditasi/unit/{unit}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $unit ID unit SPMI
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiUnitByUnit(int|string $unit, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi/unit/{unit}', ['unit' => $unit], $query, null, $options, false, false);
    }

    /**
     * Jalankan pengingat masa berlaku
     *
     * Admin SPMI. Sama dengan tugas terjadwal spmi-akreditasi-pengingat: notifikasi 12/6/3 bulan sebelum berakhir ke Kaprodi, Dekan, dan petugas SPMI (tidak berulang untuk ambang yang sama).
     *
     * `POST /v1/spmi/akreditasi/pengingat`
     *
     * scope: `spmi:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiPengingat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi/pengingat', [], $query, null, $options, false, false);
    }

    /**
     * Status akreditasi: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: unit_id, lingkup, lembaga, status, terkini, sumber, q (cari).
     *
     * `GET /v1/spmi/akreditasi`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, unit_id?: string, lingkup?: string, lembaga?: string, status?: string, terkini?: string, sumber?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi', [], $query, null, $options, false, false);
    }

    /**
     * Tambah akreditasi
     *
     * Izin spmi.akreditasi.kelola atau admin SPMI. Body: unit_id (prodi/universitas), lembaga (kode), peringkat (kode/nama; status ikut peringkat), sk_id (PilihSK) atau nomor_sk + tanggal_sk, berlaku_mulai, berlaku_sampai (kosong = 5 tahun prodi/8 tahun institusi), instrumen, nilai, catatan, tautan_sk, terkini (bawaan: ya bila tidak lebih lama dari yang terkini), target_reakreditasi (rencana pengajuan). Akreditasi terkini ditulis ke m_program_studi/m_perguruan_tinggi (kode lama dari peringkat); hasilnya di tulis_siakad.
     *
     * `POST /v1/spmi/akreditasi`
     *
     * scope: `spmi:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Status akreditasi: detail
     *
     * `GET /v1/spmi/akreditasi/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah akreditasi
     *
     * Seperti tambah; kirim hanya isian yang berubah.
     *
     * `PUT /v1/spmi/akreditasi/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID akreditasi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus akreditasi
     *
     * Hanya untuk entri salah input: body {alasan} (atau ?alasan=) wajib, min. 5 karakter, tercatat di log. Riwayat sebelumnya kembali menjadi terkini dan ditulis ulang ke SIAKAD lama (tanpa riwayat = tabel lama tidak diubah).
     *
     * `DELETE /v1/spmi/akreditasi/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID akreditasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar usulan akreditasi
     *
     * SPMI (spmi.akreditasi.kelola/admin): semua; Fakultas: prodi dengan izin fakultas.akreditasi(.kelola). Dengan alur pemeriksa (prodi -> SPMI -> data resmi).
     *
     * `GET /v1/spmi/akreditasi-usulan`
     *
     * scope: `spmi:read`
     *
     * @param array{prodi?: string, fakultas?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiUsulan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-usulan', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan usulan akreditasi
     *
     * Izin dasbor fakultas.akreditasi.kelola untuk prodi itu. Body: kode_prodi, lembaga, peringkat, sk_id (PilihSK) atau nomor_sk + tanggal_sk, berlaku_mulai, berlaku_sampai, berkas_id (sertifikat/SK; wajib kecuali tidak terakreditasi), catatan. Satu usulan menunggu per prodi; SPMI diberi notifikasi.
     *
     * `POST /v1/spmi/akreditasi-usulan`
     *
     * scope: `spmi:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiUsulan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-usulan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Acuan usulan akreditasi prodi
     *
     * Lembaga & peringkat aktif (data SPMI), akreditasi terkini, usulan yang menunggu, hak (lihat, ajukan, validasi).
     *
     * `GET /v1/spmi/akreditasi-usulan/acuan/{kode}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiUsulanAcuanByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-usulan/acuan/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Detail usulan akreditasi
     *
     * Isian usulan, akreditasi terkini prodi untuk banding, alur pemeriksa, hak.
     *
     * `GET /v1/spmi/akreditasi-usulan/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID usulan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiUsulanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-usulan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan usulan akreditasi
     *
     * Pengusul/Kaprodi; hanya yang masih diajukan.
     *
     * `POST /v1/spmi/akreditasi-usulan/{id}/batal`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID usulan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiUsulanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-usulan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Validasi usulan akreditasi
     *
     * Izin spmi.akreditasi.kelola atau admin SPMI. Body: {keputusan: setujui|tolak, catatan (wajib bila tolak), koreksi: {lembaga, peringkat, nomor_sk, tanggal_sk, berlaku_mulai, berlaku_sampai}}. Setujui = akreditasi resmi baru lewat POST /v1/spmi/akreditasi (riwayat, SK registri, tulis-tembus m_program_studi) + sertifikat ditautkan; pengusul diberi notifikasi.
     *
     * `POST /v1/spmi/akreditasi-usulan/{id}/putuskan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID usulan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiUsulanByIdPutuskan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-usulan/{id}/putuskan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sertifikat/SK usulan
     *
     * Inline; ?unduh=1 untuk unduhan.
     *
     * `GET /v1/spmi/akreditasi-usulan/{id}/berkas`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID usulan
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiUsulanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-usulan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ringkasan kelengkapan per prodi
     *
     * Prodi yang terlihat (SPMI: semua; Fakultas: prodi berizin fakultas.akreditasi): akreditasi terkini (SPMI), persiapan aktif, jumlah dokumen, lengkap, menunggu periksa, perbaikan, terlambat, persen, hak. ?fakultas=.
     *
     * `GET /v1/spmi/akreditasi-kelengkapan`
     *
     * scope: `spmi:read`
     *
     * @param array{fakultas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKelengkapan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kelengkapan', [], $query, null, $options, false, false);
    }

    /**
     * Ruang kerja kelengkapan satu prodi
     *
     * Akreditasi terkini (hanya baca), persiapan aktif, dokumen per kriteria (status, penanggung jawab, tenggat, bukti, komentar, alur pemeriksa), persen per kriteria, instrumen untuk memulai, hak.
     *
     * `GET /v1/spmi/akreditasi-kelengkapan/prodi/{kode}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKelengkapanProdiByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kelengkapan/prodi/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Mulai/segarkan ruang kerja
     *
     * Membuat persiapan akreditasi aktif (bila belum ada) dan satu butir per dokumen instrumen. Body: {instrumen_id, target_pengajuan, jenis}. Aman diulang.
     *
     * `POST /v1/spmi/akreditasi-kelengkapan/prodi/{kode}/mulai`
     *
     * scope: `spmi:write`
     *
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiKelengkapanProdiByKodeMulai(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-kelengkapan/prodi/{kode}/mulai', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lampiran data otomatis
     *
     * Dosen tetap & JAD, mahasiswa, lulusan, IPK, tepat waktu, penelitian/PkM LP2M, kerja sama, ketercapaian CPL, tracer, EDOM; dihitung dari SIAKAD (hanya baca). Tabel LKPS lengkap: /v1/spmi/lkps/{kode}.
     *
     * `GET /v1/spmi/akreditasi-kelengkapan/prodi/{kode}/lampiran`
     *
     * scope: `spmi:read`
     *
     * @param int|string $kode Kode prodi
     * @param array{ts?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKelengkapanProdiByKodeLampiran(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kelengkapan/prodi/{kode}/lampiran', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Detail butir kelengkapan
     *
     * Dokumen, status, bukti, alur pemeriksa, komentar, hak (unggah, periksa).
     *
     * `GET /v1/spmi/akreditasi-kelengkapan/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKelengkapanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kelengkapan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Penanggung jawab & tenggat
     *
     * Body: {pic_username, tenggat}.
     *
     * `PUT /v1/spmi/akreditasi-kelengkapan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiKelengkapanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-kelengkapan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unggah bukti
     *
     * Body: {berkas_id} (unggah dulu ke /v1/berkas). Status menjadi diunggah.
     *
     * `POST /v1/spmi/akreditasi-kelengkapan/{id}/unggah`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiKelengkapanByIdUnggah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-kelengkapan/{id}/unggah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periksa bukti
     *
     * Body: {keputusan: lanjut|kembalikan, catatan}. UPM fakultas: diunggah -> diperiksa; SPMI: -> lengkap; kembalikan -> perbaikan (wajib catatan).
     *
     * `POST /v1/spmi/akreditasi-kelengkapan/{id}/periksa`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiKelengkapanByIdPeriksa(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-kelengkapan/{id}/periksa', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah komentar
     *
     * Body: {isi}. Semua yang boleh melihat prodi.
     *
     * `POST /v1/spmi/akreditasi-kelengkapan/{id}/komentar`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID butir
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiKelengkapanByIdKomentar(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-kelengkapan/{id}/komentar', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Isi bukti
     *
     * Tampil inline; ?unduh=1 untuk unduhan.
     *
     * `GET /v1/spmi/akreditasi-kelengkapan/{id}/berkas`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID butir
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKelengkapanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kelengkapan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi butir persiapan dari instrumen
     *
     * Menyalin kriteria instrumen menjadi butir persiapan (narasi, skor simulasi, PIC, bukti).
     *
     * `POST /v1/spmi/akreditasi-persiapan/{id}/buat-butir`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID persiapan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiPersiapanByIdBuatButir(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-persiapan/{id}/buat-butir', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Progres persiapan akreditasi
     *
     * Persen butir selesai dan skor simulasi tertimbang.
     *
     * `GET /v1/spmi/akreditasi-persiapan/{id}/progres`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID persiapan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPersiapanByIdProgres(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-persiapan/{id}/progres', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar tabel LKPS
     *
     * Tabel LKPS (IAPS 4.0) yang disusun otomatis dari data SIAKAD.
     *
     * `GET /v1/spmi/lkps`
     *
     * scope: `spmi:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLkps(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/lkps', [], $query, null, $options, false, false);
    }

    /**
     * LKPS program studi
     *
     * Disusun otomatis dari data SIAKAD (hanya dibaca): kerja sama, seleksi mahasiswa baru, dosen tetap, penelitian/PkM, kurikulum, IPK, prestasi, masa studi, waktu tunggu, kesesuaian bidang; ditambah indikator kuantitatif dan perkiraan skor rumus IAPS. format=csv&tabel=<kode> untuk satu tabel. Pengguna yang boleh melihat unit SPMI prodi itu.
     *
     * `GET /v1/spmi/lkps/{kode_prodi}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $kode_prodi Kode prodi
     * @param array{ts?: int, tabel?: string, format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLkpsByKodeProdi(int|string $kode_prodi, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/lkps/{kode_prodi}', ['kode_prodi' => $kode_prodi], $query, null, $options, false, false);
    }

    /**
     * Laporan Evaluasi Diri (LED)
     *
     * Narasi butir persiapan disusun per kriteria instrumen, dengan kelengkapan (narasi kosong). format=html untuk berkas siap cetak/simpan PDF.
     *
     * `GET /v1/spmi/akreditasi-persiapan/{id}/led`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID persiapan
     * @param array{format?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPersiapanByIdLed(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-persiapan/{id}/led', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simulasi akreditasi
     *
     * Skor butir per kriteria (tertimbang bobot), indikator kuantitatif LKPS bila unit prodi (dosen, rasio, S3, jabatan, serdos, kerja sama, IPK, tepat waktu, waktu tunggu, kesesuaian), perkiraan nilai 0-400 dan peringkat (Unggul/Baik Sekali/Baik), serta butir terlemah. Perkiraan internal, bukan penilaian resmi.
     *
     * `GET /v1/spmi/akreditasi-persiapan/{id}/simulasi`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID persiapan
     * @param array{ts?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPersiapanByIdSimulasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-persiapan/{id}/simulasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isian pelaporan SPMI periode
     *
     * Admin SPMI. Butir pelaporan untuk spmi.kemdiktisaintek.go.id dengan cek kelengkapan (tautan kosong, dokumen tidak publik, tanggal penetapan). Periode tidak ada = 404.
     *
     * `GET /v1/spmi/pelaporan/{periode}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $periode ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPelaporanByPeriode(int|string $periode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/pelaporan/{periode}', ['periode' => $periode], $query, null, $options, false, false);
    }

    /**
     * Siapkan isian pelaporan
     *
     * Admin SPMI. Membuat butir dan mengisi otomatis dari dokumen mutu disahkan (tingkat universitas) dan bukti kegiatan PPEPP selesai. pakai_ulang (bawaan true): butir periode lalu yang sudah valid dipakai ulang. timpa=true mengisi ulang butir yang sudah terisi (kecuali yang dilaporkan).
     *
     * `POST /v1/spmi/pelaporan/{periode}/siapkan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $periode ID periode
     * @param array{pakai_ulang?: string, timpa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPelaporanByPeriodeSiapkan(int|string $periode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/pelaporan/{periode}/siapkan', ['periode' => $periode], $query, null, $options, false, false);
    }

    /**
     * Isi butir pelaporan
     *
     * Admin SPMI. ada, dokumen_id, tautan, tanggal_penetapan, catatan, status (draf|siap|dilaporkan), dan hasil verifikasi LLDikti: status_verifikasi, status_valid, catatan_verifikator.
     *
     * `PUT /v1/spmi/pelaporan-butir/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID butir pelaporan
     * @param array{ada?: bool, dokumen_id?: int|null, tautan?: string|null, tanggal_penetapan?: string|null, catatan?: string|null, status?: string, status_verifikasi?: string, status_valid?: string, catatan_verifikator?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPelaporanButirById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/pelaporan-butir/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unduh file bukti
     *
     * inline=1 untuk ditampilkan di peramban.
     *
     * `GET /v1/spmi/file/{uuid}/unduh`
     *
     * scope: `spmi:read`
     *
     * @param int|string $uuid ID file
     * @param array{inline?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByUuidUnduh(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/file/{uuid}/unduh', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Hapus file bukti
     *
     * `DELETE /v1/spmi/file/{uuid}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $uuid ID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Daftar file data SPMI
     *
     * `GET /v1/spmi/file/{entitas}/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $entitas dokumen | capaian | kegiatan | tilik | auditee | temuan | tindak_lanjut | rtm | akreditasi | butir | pelaporan | risiko
     * @param int|string $id ID data
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByEntitasById(int|string $entitas, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/file/{entitas}/{id}', ['entitas' => $entitas, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah file bukti
     *
     * multipart/form-data field `berkas`, atau JSON `berkas_base64` + `nama_file`. Opsional: keterangan. Jenis file dicek dari isinya. Untuk pelaporan SPMI tetap isi tautan publik.
     *
     * `POST /v1/spmi/file/{entitas}/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $entitas dokumen | capaian | kegiatan | tilik | auditee | temuan | tindak_lanjut | rtm | akreditasi | butir | pelaporan | risiko
     * @param int|string $id ID data
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, berkas_base64?: string, nama_file?: string, keterangan?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFileByEntitasById(int|string $entitas, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/file/{entitas}/{id}', ['entitas' => $entitas, 'id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Menunggu keputusan saya
     *
     * Target dan dokumen mutu unit yang sedang diproses dan tahap berjalannya diputus pemilik token menurut alur pengesahan yang berlaku (/v1/spmi/alur), termasuk pelaku izin:<kode> tanpa peran SPMI. Buka detail lewat /target/{id} atau /dokumen/{id}; putus lewat /setujui atau /kembalikan.
     *
     * `GET /v1/spmi/menunggu-saya`
     *
     * scope: `spmi:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMenungguSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/menunggu-saya', [], $query, null, $options, false, false);
    }

    /**
     * Target: ajukan
     *
     * Pengusul (tahap pertama alur target yang berlaku; bawaan pengelola/pimpinan unit/PIC) mengajukan draf atau data yang dikembalikan ke tahap berikutnya. Body opsional: catatan.
     *
     * `POST /v1/spmi/target/{id}/ajukan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTargetByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/target/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Target: setujui
     *
     * Pelaku tahap berjalan (bawaan: validasi SPMI lalu pengesahan pimpinan unit). Tahap terakhir = disahkan; hanya data disahkan yang berlaku. Pengusul tidak memutus usulannya sendiri. Body opsional: catatan.
     *
     * `POST /v1/spmi/target/{id}/setujui`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTargetByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/target/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Target: kembalikan
     *
     * Pelaku tahap berjalan mengembalikan usulan ke pengusul. Body: catatan (wajib, alasan).
     *
     * `POST /v1/spmi/target/{id}/kembalikan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTargetByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/target/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen mutu: ajukan
     *
     * Pengusul (tahap pertama alur dokumen yang berlaku; bawaan pengelola/pimpinan unit) mengajukan draf atau data yang dikembalikan ke tahap berikutnya. Body opsional: catatan.
     *
     * `POST /v1/spmi/dokumen/{id}/ajukan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/dokumen/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen mutu: setujui
     *
     * Pelaku tahap berjalan (bawaan: validasi SPMI lalu pengesahan pimpinan unit). Tahap terakhir = disahkan; hanya data disahkan yang berlaku. Pengusul tidak memutus usulannya sendiri. Body opsional: catatan.
     *
     * `POST /v1/spmi/dokumen/{id}/setujui`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/dokumen/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen mutu: kembalikan
     *
     * Pelaku tahap berjalan mengembalikan usulan ke pengusul. Body: catatan (wajib, alasan).
     *
     * `POST /v1/spmi/dokumen/{id}/kembalikan`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/dokumen/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: jenis, induk_id, aktif, kode_fakultas, kode_prodi, q (cari).
     *
     * `GET /v1/spmi/unit`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, jenis?: string, induk_id?: string, aktif?: string, kode_fakultas?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/unit', [], $query, null, $options, false, false);
    }

    /**
     * Unit: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/unit`
     *
     * scope: `spmi:write`
     *
     * @param array{kode: string, jenis: string, induk_id?: int|null, kode_fakultas?: string|null, kode_prodi?: string|null, nama: string|null, singkatan?: string|null, email?: string|null, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnit(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/unit', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit: riwayat perubahan
     *
     * `GET /v1/spmi/unit/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/unit/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unit: detail
     *
     * `GET /v1/spmi/unit/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unit: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/unit/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{kode: string, jenis: string, induk_id?: int|null, kode_fakultas?: string|null, kode_prodi?: string|null, nama: string|null, singkatan?: string|null, email?: string|null, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putUnitById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/unit/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/unit/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteUnitById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/unit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Personel mutu: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: unit_id, username, peran, aktif, q (cari).
     *
     * `GET /v1/spmi/personel`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, unit_id?: string, username?: string, peran?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPersonel(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/personel', [], $query, null, $options, false, false);
    }

    /**
     * Personel mutu: tambah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM.
     *
     * `POST /v1/spmi/personel`
     *
     * scope: `spmi:write`
     *
     * @param array{unit_id: int|null, username: string|null, peran: string, jabatan?: string|null, nomor_sk?: string|null, mulai?: string|null, selesai?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPersonel(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/personel', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Personel mutu: riwayat perubahan
     *
     * `GET /v1/spmi/personel/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPersonelByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/personel/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Personel mutu: detail
     *
     * `GET /v1/spmi/personel/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPersonelById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/personel/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Personel mutu: ubah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/personel/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{unit_id: int|null, username: string|null, peran: string, jabatan?: string|null, nomor_sk?: string|null, mulai?: string|null, selesai?: string|null, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPersonelById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/personel/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Personel mutu: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/personel/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePersonelById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/personel/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Auditor: daftar
     *
     * Terlihat oleh admin SPMI, personel mutu, dan auditor; kolom nidn, nomor_sertifikat, penyelenggara_pelatihan, tanggal_sertifikat, berlaku_sampai, tautan_sertifikat, catatan hanya untuk admin SPMI. Filter: aktif, unit_asal_id, q (cari).
     *
     * `GET /v1/spmi/auditor`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, aktif?: string, unit_asal_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/auditor', [], $query, null, $options, false, false);
    }

    /**
     * Auditor: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/auditor`
     *
     * scope: `spmi:write`
     *
     * @param array{username: string|null, nidn?: string|null, nama: string|null, unit_asal_id?: int|null, bidang_keahlian?: string|null, nomor_sertifikat?: string|null, penyelenggara_pelatihan?: string|null, tanggal_sertifikat?: string|null, berlaku_sampai?: string|null, tautan_sertifikat?: string|null, aktif?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAuditor(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/auditor', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Auditor: riwayat perubahan
     *
     * `GET /v1/spmi/auditor/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditorByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/auditor/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Auditor: detail
     *
     * `GET /v1/spmi/auditor/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/auditor/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Auditor: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/auditor/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{username: string|null, nidn?: string|null, nama: string|null, unit_asal_id?: int|null, bidang_keahlian?: string|null, nomor_sertifikat?: string|null, penyelenggara_pelatihan?: string|null, tanggal_sertifikat?: string|null, berlaku_sampai?: string|null, tautan_sertifikat?: string|null, aktif?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAuditorById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/auditor/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Auditor: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/auditor/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAuditorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/auditor/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: status, q (cari).
     *
     * `GET /v1/spmi/periode`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/periode', [], $query, null, $options, false, false);
    }

    /**
     * Periode: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/periode`
     *
     * scope: `spmi:write`
     *
     * @param array{tahun: int, nama: string|null, tahun_id_mulai?: string|null, tahun_id_selesai?: string|null, mulai?: string|null, selesai?: string|null, status?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriode(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/periode', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode: riwayat perubahan
     *
     * `GET /v1/spmi/periode/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/periode/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode: detail
     *
     * `GET /v1/spmi/periode/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periode: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/periode/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{tahun: int, nama: string|null, tahun_id_mulai?: string|null, tahun_id_selesai?: string|null, mulai?: string|null, selesai?: string|null, status?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPeriodeById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/periode/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periode: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/periode/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen mutu: daftar
     *
     * Yang berstatus disahkan terlihat oleh semua; lainnya oleh personel unit terkait. Filter: unit_id, jenis, tahap, status, publik, q (cari).
     *
     * `GET /v1/spmi/dokumen`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, unit_id?: string, jenis?: string, tahap?: string, status?: string, publik?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen mutu: tambah
     *
     * Dokumen unit: draf disusun pengusul menurut alur yang berlaku (/v1/spmi/alur objek dokumen), lalu diajukan, divalidasi, dan disahkan lewat /dokumen/{id}/ajukan|setujui|kembalikan; status tidak diisi langsung (kecuali kedaluwarsa/dicabut setelah sah). Dokumen tanpa unit (universitas) oleh LPM.
     *
     * `POST /v1/spmi/dokumen`
     *
     * scope: `spmi:write`
     *
     * @param array{unit_id?: int|null, jenis: string, tahap?: string, nomor?: string|null, judul: string|null, versi?: string|null, ringkasan?: string|null, status?: string, tanggal_penetapan?: string|null, berlaku_mulai?: string|null, tinjau_berikutnya?: string|null, ditetapkan_oleh?: string|null, nomor_penetapan?: string|null, tautan?: string|null, publik?: bool, menggantikan_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen mutu: riwayat perubahan
     *
     * `GET /v1/spmi/dokumen/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/dokumen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen mutu: detail
     *
     * `GET /v1/spmi/dokumen/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen mutu: ubah
     *
     * Dokumen unit: draf disusun pengusul menurut alur yang berlaku (/v1/spmi/alur objek dokumen), lalu diajukan, divalidasi, dan disahkan lewat /dokumen/{id}/ajukan|setujui|kembalikan; status tidak diisi langsung (kecuali kedaluwarsa/dicabut setelah sah). Dokumen tanpa unit (universitas) oleh LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/dokumen/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{unit_id?: int|null, jenis: string, tahap?: string, nomor?: string|null, judul: string|null, versi?: string|null, ringkasan?: string|null, status?: string, tanggal_penetapan?: string|null, berlaku_mulai?: string|null, tinjau_berikutnya?: string|null, ditetapkan_oleh?: string|null, nomor_penetapan?: string|null, tautan?: string|null, publik?: bool, menggantikan_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen mutu: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/dokumen/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Standar: daftar
     *
     * Yang berstatus berlaku,dicabut terlihat oleh semua; lainnya oleh admin SPMI saja. Filter: bidang, kelompok, sumber, status, induk_id, dokumen_id, q (cari).
     *
     * `GET /v1/spmi/standar`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, bidang?: string, kelompok?: string, sumber?: string, status?: string, induk_id?: string, dokumen_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStandar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/standar', [], $query, null, $options, false, false);
    }

    /**
     * Standar: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/standar`
     *
     * scope: `spmi:write`
     *
     * @param array{induk_id?: int|null, kode: string, nama: string|null, bidang: string, kelompok?: string, sumber?: string, rasional?: string|null, pernyataan?: string|null, strategi?: string|null, pihak_terkait?: string|null, definisi_istilah?: string|null, referensi?: string|null, dokumen_id?: int|null, versi?: string|null, status?: string, berlaku_mulai?: string|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postStandar(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/standar', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Standar: riwayat perubahan
     *
     * `GET /v1/spmi/standar/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStandarByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/standar/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Standar: detail
     *
     * `GET /v1/spmi/standar/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStandarById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/standar/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Standar: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/standar/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{induk_id?: int|null, kode: string, nama: string|null, bidang: string, kelompok?: string, sumber?: string, rasional?: string|null, pernyataan?: string|null, strategi?: string|null, pihak_terkait?: string|null, definisi_istilah?: string|null, referensi?: string|null, dokumen_id?: int|null, versi?: string|null, status?: string, berlaku_mulai?: string|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putStandarById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/standar/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Standar: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/standar/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteStandarById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/standar/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Indikator: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: standar_id, tipe, lingkup, metrik, aktif, q (cari).
     *
     * `GET /v1/spmi/indikator`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, standar_id?: string, tipe?: string, lingkup?: string, metrik?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIndikator(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/indikator', [], $query, null, $options, false, false);
    }

    /**
     * Indikator: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/indikator`
     *
     * scope: `spmi:write`
     *
     * @param array{standar_id: int|null, kode: string, pernyataan: string|null, tipe?: string, satuan?: string|null, arah?: string, baseline?: float|int|null, minimum_sn_dikti?: float|int|null, metrik?: string, lingkup?: string, frekuensi?: string, cara_ukur?: string|null, sumber_data?: string|null, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIndikator(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/indikator', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Indikator: riwayat perubahan
     *
     * `GET /v1/spmi/indikator/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIndikatorByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/indikator/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Indikator: detail
     *
     * `GET /v1/spmi/indikator/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIndikatorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/indikator/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Indikator: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/indikator/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{standar_id: int|null, kode: string, pernyataan: string|null, tipe?: string, satuan?: string|null, arah?: string, baseline?: float|int|null, minimum_sn_dikti?: float|int|null, metrik?: string, lingkup?: string, frekuensi?: string, cara_ukur?: string|null, sumber_data?: string|null, aktif?: bool, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putIndikatorById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/indikator/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Indikator: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/indikator/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteIndikatorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/indikator/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Target: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: indikator_id, periode_id, unit_id, status, q (cari).
     *
     * `GET /v1/spmi/target`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, indikator_id?: string, periode_id?: string, unit_id?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTarget(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/target', [], $query, null, $options, false, false);
    }

    /**
     * Target: tambah
     *
     * Target unit: draf disusun pengusul menurut alur yang berlaku (/v1/spmi/alur objek target), lalu diajukan, divalidasi, dan disahkan lewat /target/{id}/ajukan|setujui|kembalikan. Target tanpa unit (universitas) oleh LPM.
     *
     * `POST /v1/spmi/target`
     *
     * scope: `spmi:write`
     *
     * @param array{indikator_id: int|null, periode_id: int|null, unit_id?: int|null, target?: float|int|null, target_teks?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTarget(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/target', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Target: riwayat perubahan
     *
     * `GET /v1/spmi/target/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTargetByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/target/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Target: detail
     *
     * `GET /v1/spmi/target/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTargetById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/target/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Target: ubah
     *
     * Target unit: draf disusun pengusul menurut alur yang berlaku (/v1/spmi/alur objek target), lalu diajukan, divalidasi, dan disahkan lewat /target/{id}/ajukan|setujui|kembalikan. Target tanpa unit (universitas) oleh LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/target/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{indikator_id: int|null, periode_id: int|null, unit_id?: int|null, target?: float|int|null, target_teks?: string|null, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTargetById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/target/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Target: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/target/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTargetById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/target/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Alur pengesahan: daftar
     *
     * Terlihat oleh admin SPMI, personel mutu, dan auditor. Filter: objek, status, unit_id, q (cari).
     *
     * `GET /v1/spmi/alur`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, objek?: string, status?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/alur', [], $query, null, $options, false, false);
    }

    /**
     * Alur pengesahan: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/alur`
     *
     * scope: `spmi:write`
     *
     * @param array{objek: string, unit_id?: int|null, nama: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, berlaku_mulai?: string|null, status?: string, tahap: list<mixed>, pengusul_bukan_pemutus?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAlur(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/alur', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Alur pengesahan: riwayat perubahan
     *
     * `GET /v1/spmi/alur/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlurByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/alur/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Alur pengesahan: detail
     *
     * `GET /v1/spmi/alur/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAlurById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/alur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Alur pengesahan: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/alur/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{objek: string, unit_id?: int|null, nama: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, berlaku_mulai?: string|null, status?: string, tahap: list<mixed>, pengusul_bukan_pemutus?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAlurById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/alur/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Alur pengesahan: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/alur/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAlurById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/alur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan PPEPP: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: periode_id, unit_id, tahap, jenis, status, q (cari).
     *
     * `GET /v1/spmi/kegiatan`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, periode_id?: string, unit_id?: string, tahap?: string, jenis?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/kegiatan', [], $query, null, $options, false, false);
    }

    /**
     * Kegiatan PPEPP: tambah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM.
     *
     * `POST /v1/spmi/kegiatan`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int|null, unit_id?: int|null, tahap: string, jenis: string, nama: string|null, mulai?: string|null, selesai?: string|null, tempat?: string|null, pelaksana?: string|null, metode?: string|null, hasil?: string|null, tautan_bukti?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKegiatan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/kegiatan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan PPEPP: riwayat perubahan
     *
     * `GET /v1/spmi/kegiatan/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/kegiatan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan PPEPP: detail
     *
     * `GET /v1/spmi/kegiatan/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kegiatan PPEPP: ubah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/kegiatan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{periode_id: int|null, unit_id?: int|null, tahap: string, jenis: string, nama: string|null, mulai?: string|null, selesai?: string|null, tempat?: string|null, pelaksana?: string|null, metode?: string|null, hasil?: string|null, tautan_bukti?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKegiatanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/kegiatan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kegiatan PPEPP: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/kegiatan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKegiatanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/kegiatan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Audit mutu internal: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: periode_id, jenis, status, q (cari).
     *
     * `GET /v1/spmi/audit`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, periode_id?: string, jenis?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAudit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/audit', [], $query, null, $options, false, false);
    }

    /**
     * Audit mutu internal: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/audit`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int|null, kode: string, nama: string|null, jenis?: string, tujuan?: string|null, lingkup?: string|null, acuan?: string|null, mulai?: string|null, selesai?: string|null, status?: string, ringkasan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAudit(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/audit', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Audit mutu internal: riwayat perubahan
     *
     * `GET /v1/spmi/audit/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/audit/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Audit mutu internal: detail
     *
     * `GET /v1/spmi/audit/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAuditById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/audit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Audit mutu internal: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/audit/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{periode_id: int|null, kode: string, nama: string|null, jenis?: string, tujuan?: string|null, lingkup?: string|null, acuan?: string|null, mulai?: string|null, selesai?: string|null, status?: string, ringkasan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAuditById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/audit/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Audit mutu internal: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/audit/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAuditById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/audit/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kebijakan akses auditor: daftar
     *
     * Hanya admin SPMI (LPM/ADMIN). Filter: status, q (cari).
     *
     * `GET /v1/spmi/kebijakan-auditor`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanAuditor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/kebijakan-auditor', [], $query, null, $options, false, false);
    }

    /**
     * Kebijakan akses auditor: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/kebijakan-auditor`
     *
     * scope: `spmi:write`
     *
     * @param array{nama: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, berlaku_mulai?: string|null, status?: string, status_auditee_aktif: string|null, masa_tenggang_hari?: int, batasi_periode?: bool, batasi_standar?: bool, buka_dokumen_unit?: bool, catat_akses?: bool, larang_unit_sendiri?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKebijakanAuditor(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/kebijakan-auditor', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kebijakan akses auditor: riwayat perubahan
     *
     * `GET /v1/spmi/kebijakan-auditor/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanAuditorByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/kebijakan-auditor/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kebijakan akses auditor: detail
     *
     * `GET /v1/spmi/kebijakan-auditor/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakanAuditorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/kebijakan-auditor/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kebijakan akses auditor: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/kebijakan-auditor/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{nama: string|null, nomor_sk?: string|null, tanggal_sk?: string|null, berlaku_mulai?: string|null, status?: string, status_auditee_aktif: string|null, masa_tenggang_hari?: int, batasi_periode?: bool, batasi_standar?: bool, buka_dokumen_unit?: bool, catat_akses?: bool, larang_unit_sendiri?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKebijakanAuditorById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/kebijakan-auditor/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kebijakan akses auditor: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/kebijakan-auditor/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKebijakanAuditorById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/kebijakan-auditor/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rapat tinjauan manajemen: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: periode_id, unit_id, status, q (cari).
     *
     * `GET /v1/spmi/rtm`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, periode_id?: string, unit_id?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRtm(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/rtm', [], $query, null, $options, false, false);
    }

    /**
     * Rapat tinjauan manajemen: tambah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM.
     *
     * `POST /v1/spmi/rtm`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int|null, unit_id: int|null, judul: string|null, tanggal?: string|null, tempat?: string|null, pimpinan_rapat?: string|null, notulis?: string|null, peserta?: string|null, agenda?: string|null, masukan?: mixed, notulen?: string|null, kesimpulan?: string|null, tautan_bukti?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRtm(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/rtm', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rapat tinjauan manajemen: riwayat perubahan
     *
     * `GET /v1/spmi/rtm/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRtmByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/rtm/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rapat tinjauan manajemen: detail
     *
     * `GET /v1/spmi/rtm/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRtmById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/rtm/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rapat tinjauan manajemen: ubah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/rtm/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{periode_id: int|null, unit_id: int|null, judul: string|null, tanggal?: string|null, tempat?: string|null, pimpinan_rapat?: string|null, notulis?: string|null, peserta?: string|null, agenda?: string|null, masukan?: mixed, notulen?: string|null, kesimpulan?: string|null, tautan_bukti?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRtmById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/rtm/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rapat tinjauan manajemen: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/rtm/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRtmById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/rtm/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keputusan RTM: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: rtm_id, jenis, status, temuan_id, standar_id, pic_username, q (cari).
     *
     * `GET /v1/spmi/rtm-keputusan`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, rtm_id?: string, jenis?: string, status?: string, temuan_id?: string, standar_id?: string, pic_username?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRtmKeputusan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/rtm-keputusan', [], $query, null, $options, false, false);
    }

    /**
     * Keputusan RTM: tambah
     *
     * Mengikuti hak data induk (rtm).
     *
     * `POST /v1/spmi/rtm-keputusan`
     *
     * scope: `spmi:write`
     *
     * @param array{rtm_id: int|null, uraian: string|null, jenis?: string, temuan_id?: int|null, standar_id?: int|null, pic_username?: string|null, penanggung_jawab?: string|null, batas_waktu?: string|null, status?: string, hasil?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRtmKeputusan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/rtm-keputusan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keputusan RTM: riwayat perubahan
     *
     * `GET /v1/spmi/rtm-keputusan/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRtmKeputusanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/rtm-keputusan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keputusan RTM: detail
     *
     * `GET /v1/spmi/rtm-keputusan/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRtmKeputusanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/rtm-keputusan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keputusan RTM: ubah
     *
     * Mengikuti hak data induk (rtm). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/rtm-keputusan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{rtm_id: int|null, uraian: string|null, jenis?: string, temuan_id?: int|null, standar_id?: int|null, pic_username?: string|null, penanggung_jawab?: string|null, batas_waktu?: string|null, status?: string, hasil?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRtmKeputusanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/rtm-keputusan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keputusan RTM: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/rtm-keputusan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRtmKeputusanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/rtm-keputusan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Risiko: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: periode_id, unit_id, standar_id, status, q (cari).
     *
     * `GET /v1/spmi/risiko`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, periode_id?: string, unit_id?: string, standar_id?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRisiko(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/risiko', [], $query, null, $options, false, false);
    }

    /**
     * Risiko: tambah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM.
     *
     * `POST /v1/spmi/risiko`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int|null, unit_id: int|null, standar_id?: int|null, kode?: string|null, uraian: string|null, penyebab?: string|null, dampak_uraian?: string|null, kemungkinan: int, dampak: int, pengendalian_ada?: string|null, mitigasi?: string|null, pic_username?: string|null, batas_waktu?: string|null, kemungkinan_sisa?: int, dampak_sisa?: int, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRisiko(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/risiko', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Risiko: riwayat perubahan
     *
     * `GET /v1/spmi/risiko/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRisikoByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/risiko/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Risiko: detail
     *
     * `GET /v1/spmi/risiko/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRisikoById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/risiko/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Risiko: ubah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/risiko/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{periode_id: int|null, unit_id: int|null, standar_id?: int|null, kode?: string|null, uraian: string|null, penyebab?: string|null, dampak_uraian?: string|null, kemungkinan: int, dampak: int, pengendalian_ada?: string|null, mitigasi?: string|null, pic_username?: string|null, batas_waktu?: string|null, kemungkinan_sisa?: int, dampak_sisa?: int, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRisikoById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/risiko/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Risiko: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/risiko/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRisikoById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/risiko/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Survei kepuasan: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: periode_id, unit_id, sasaran, status, indikator_id, q (cari).
     *
     * `GET /v1/spmi/survei`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, periode_id?: string, unit_id?: string, sasaran?: string, status?: string, indikator_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurvei(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei', [], $query, null, $options, false, false);
    }

    /**
     * Survei kepuasan: tambah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM.
     *
     * `POST /v1/spmi/survei`
     *
     * scope: `spmi:write`
     *
     * @param array{periode_id: int|null, unit_id?: int|null, kode: string, judul: string|null, pengantar?: string|null, sasaran: string, kode_prodi?: string|null, tahun_id?: string|null, skala?: int, anonim?: bool, mulai?: string|null, selesai?: string|null, indikator_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSurvei(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/survei', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Survei kepuasan: riwayat perubahan
     *
     * `GET /v1/spmi/survei/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Survei kepuasan: detail
     *
     * `GET /v1/spmi/survei/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Survei kepuasan: ubah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/survei/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{periode_id: int|null, unit_id?: int|null, kode: string, judul: string|null, pengantar?: string|null, sasaran: string, kode_prodi?: string|null, tahun_id?: string|null, skala?: int, anonim?: bool, mulai?: string|null, selesai?: string|null, indikator_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSurveiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/survei/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Survei kepuasan: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/survei/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSurveiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/survei/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Butir survei: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: survei_id, dimensi, tipe, q (cari).
     *
     * `GET /v1/spmi/survei-pertanyaan`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, survei_id?: string, dimensi?: string, tipe?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiPertanyaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei-pertanyaan', [], $query, null, $options, false, false);
    }

    /**
     * Butir survei: tambah
     *
     * Mengikuti hak data induk (survei).
     *
     * `POST /v1/spmi/survei-pertanyaan`
     *
     * scope: `spmi:write`
     *
     * @param array{survei_id: int|null, urut?: int, bagian?: string|null, dimensi?: string, tipe?: string, teks: string|null, pilihan?: mixed, wajib?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSurveiPertanyaan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/survei-pertanyaan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Butir survei: riwayat perubahan
     *
     * `GET /v1/spmi/survei-pertanyaan/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiPertanyaanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei-pertanyaan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Butir survei: detail
     *
     * `GET /v1/spmi/survei-pertanyaan/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSurveiPertanyaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/survei-pertanyaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Butir survei: ubah
     *
     * Mengikuti hak data induk (survei). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/survei-pertanyaan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{survei_id: int|null, urut?: int, bagian?: string|null, dimensi?: string, tipe?: string, teks: string|null, pilihan?: mixed, wajib?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSurveiPertanyaanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/survei-pertanyaan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Butir survei: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/survei-pertanyaan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSurveiPertanyaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/survei-pertanyaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Status akreditasi: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Instrumen akreditasi: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: lembaga, lingkup, aktif, q (cari).
     *
     * `GET /v1/spmi/akreditasi-instrumen`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, lembaga?: string, lingkup?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiInstrumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-instrumen', [], $query, null, $options, false, false);
    }

    /**
     * Instrumen akreditasi: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/akreditasi-instrumen`
     *
     * scope: `spmi:write`
     *
     * @param array{kode: string, nama: string|null, lembaga: string, lingkup: string, dasar?: string|null, aktif?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiInstrumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-instrumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Instrumen akreditasi: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi-instrumen/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiInstrumenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-instrumen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Instrumen akreditasi: detail
     *
     * `GET /v1/spmi/akreditasi-instrumen/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiInstrumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-instrumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Instrumen akreditasi: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/akreditasi-instrumen/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{kode: string, nama: string|null, lembaga: string, lingkup: string, dasar?: string|null, aktif?: bool, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiInstrumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-instrumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Instrumen akreditasi: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/akreditasi-instrumen/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiInstrumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi-instrumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kriteria instrumen: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: instrumen_id, q (cari).
     *
     * `GET /v1/spmi/akreditasi-kriteria`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, instrumen_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKriteria(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kriteria', [], $query, null, $options, false, false);
    }

    /**
     * Kriteria instrumen: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/akreditasi-kriteria`
     *
     * scope: `spmi:write`
     *
     * @param array{instrumen_id: int|null, kode: string, nama: string|null, deskripsi?: string|null, bobot?: float|int|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiKriteria(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-kriteria', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kriteria instrumen: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi-kriteria/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKriteriaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kriteria/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kriteria instrumen: detail
     *
     * `GET /v1/spmi/akreditasi-kriteria/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiKriteriaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-kriteria/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kriteria instrumen: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/akreditasi-kriteria/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{instrumen_id: int|null, kode: string, nama: string|null, deskripsi?: string|null, bobot?: float|int|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiKriteriaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-kriteria/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kriteria instrumen: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/akreditasi-kriteria/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiKriteriaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi-kriteria/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Persiapan akreditasi: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: unit_id, instrumen_id, jenis, status, q (cari).
     *
     * `GET /v1/spmi/akreditasi-persiapan`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, unit_id?: string, instrumen_id?: string, jenis?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPersiapan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-persiapan', [], $query, null, $options, false, false);
    }

    /**
     * Persiapan akreditasi: tambah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM.
     *
     * `POST /v1/spmi/akreditasi-persiapan`
     *
     * scope: `spmi:write`
     *
     * @param array{unit_id: int|null, instrumen_id?: int|null, jenis?: string, target_status?: string, target_pengajuan?: string|null, tanggal_pengajuan?: string|null, ketua_username?: string|null, tim?: string|null, status?: string, akreditasi_id?: int|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiPersiapan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-persiapan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Persiapan akreditasi: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi-persiapan/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPersiapanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-persiapan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Persiapan akreditasi: detail
     *
     * `GET /v1/spmi/akreditasi-persiapan/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPersiapanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-persiapan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Persiapan akreditasi: ubah
     *
     * Dikelola LPM atau pengelola mutu unit (unit_id); unit_id kosong = LPM. Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/akreditasi-persiapan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{unit_id: int|null, instrumen_id?: int|null, jenis?: string, target_status?: string, target_pengajuan?: string|null, tanggal_pengajuan?: string|null, ketua_username?: string|null, tim?: string|null, status?: string, akreditasi_id?: int|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiPersiapanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-persiapan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Persiapan akreditasi: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/akreditasi-persiapan/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiPersiapanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi-persiapan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Butir persiapan akreditasi: daftar
     *
     * Terlihat oleh LPM dan personel unit (serta pengawas unit induk). Filter: persiapan_id, status, pic_username, q (cari).
     *
     * `GET /v1/spmi/akreditasi-butir`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, persiapan_id?: string, status?: string, pic_username?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiButir(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-butir', [], $query, null, $options, false, false);
    }

    /**
     * Butir persiapan akreditasi: tambah
     *
     * Mengikuti hak data induk (persiapan).
     *
     * `POST /v1/spmi/akreditasi-butir`
     *
     * scope: `spmi:write`
     *
     * @param array{persiapan_id: int|null, kriteria_id?: int|null, kode: string, nama: string|null, narasi?: string|null, skor_simulasi?: float|int|null, bobot?: float|int|null, pic_username?: string|null, tautan_bukti?: string|null, status?: string, catatan?: string|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiButir(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-butir', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Butir persiapan akreditasi: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi-butir/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiButirByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-butir/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Butir persiapan akreditasi: detail
     *
     * `GET /v1/spmi/akreditasi-butir/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiButirById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-butir/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Butir persiapan akreditasi: ubah
     *
     * Mengikuti hak data induk (persiapan). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/akreditasi-butir/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{persiapan_id: int|null, kriteria_id?: int|null, kode: string, nama: string|null, narasi?: string|null, skor_simulasi?: float|int|null, bobot?: float|int|null, pic_username?: string|null, tautan_bukti?: string|null, status?: string, catatan?: string|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiButirById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-butir/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Butir persiapan akreditasi: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/akreditasi-butir/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiButirById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi-butir/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lembaga akreditasi: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: lingkup, aktif, q (cari).
     *
     * `GET /v1/spmi/akreditasi-lembaga`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, lingkup?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiLembaga(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-lembaga', [], $query, null, $options, false, false);
    }

    /**
     * Lembaga akreditasi: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/akreditasi-lembaga`
     *
     * scope: `spmi:write`
     *
     * @param array{kode: string, nama: string|null, singkatan?: string|null, lingkup?: string, situs?: string|null, aktif?: bool, urut?: int, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiLembaga(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-lembaga', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lembaga akreditasi: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi-lembaga/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiLembagaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-lembaga/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lembaga akreditasi: detail
     *
     * `GET /v1/spmi/akreditasi-lembaga/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiLembagaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-lembaga/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lembaga akreditasi: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/akreditasi-lembaga/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{kode: string, nama: string|null, singkatan?: string|null, lingkup?: string, situs?: string|null, aktif?: bool, urut?: int, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiLembagaById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-lembaga/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lembaga akreditasi: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/akreditasi-lembaga/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiLembagaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi-lembaga/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peringkat akreditasi: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: status, aktif, q (cari).
     *
     * `GET /v1/spmi/akreditasi-peringkat`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, status?: string, aktif?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPeringkat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-peringkat', [], $query, null, $options, false, false);
    }

    /**
     * Peringkat akreditasi: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/akreditasi-peringkat`
     *
     * scope: `spmi:write`
     *
     * @param array{kode: string, nama: string|null, status: string, kode_siakad?: string, aktif?: bool, urut?: int, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiPeringkat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-peringkat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peringkat akreditasi: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi-peringkat/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPeringkatByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-peringkat/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peringkat akreditasi: detail
     *
     * `GET /v1/spmi/akreditasi-peringkat/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiPeringkatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-peringkat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Peringkat akreditasi: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/akreditasi-peringkat/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{kode: string, nama: string|null, status: string, kode_siakad?: string, aktif?: bool, urut?: int, keterangan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiPeringkatById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-peringkat/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Peringkat akreditasi: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/akreditasi-peringkat/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiPeringkatById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi-peringkat/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kebutuhan akreditasi: daftar
     *
     * Terlihat oleh semua pemilik spmi:read. Filter: instrumen_id, kriteria_id, jenis, q (cari).
     *
     * `GET /v1/spmi/akreditasi-dokumen`
     *
     * scope: `spmi:read` · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, instrumen_id?: string, kriteria_id?: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen kebutuhan akreditasi: tambah
     *
     * Dikelola admin SPMI (LPM/ADMIN).
     *
     * `POST /v1/spmi/akreditasi-dokumen`
     *
     * scope: `spmi:write`
     *
     * @param array{instrumen_id: int|null, kriteria_id?: int|null, kode: string, nama: string|null, jenis: string, keterangan?: string|null, wajib?: bool, sumber_data?: string|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkreditasiDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/spmi/akreditasi-dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen kebutuhan akreditasi: riwayat perubahan
     *
     * `GET /v1/spmi/akreditasi-dokumen/{id}/riwayat`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiDokumenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-dokumen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kebutuhan akreditasi: detail
     *
     * `GET /v1/spmi/akreditasi-dokumen/{id}`
     *
     * scope: `spmi:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkreditasiDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/spmi/akreditasi-dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen kebutuhan akreditasi: ubah
     *
     * Dikelola admin SPMI (LPM/ADMIN). Kirim hanya kolom yang berubah.
     *
     * `PUT /v1/spmi/akreditasi-dokumen/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array{instrumen_id: int|null, kriteria_id?: int|null, kode: string, nama: string|null, jenis: string, keterangan?: string|null, wajib?: bool, sumber_data?: string|null, urut?: int, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAkreditasiDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/spmi/akreditasi-dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen kebutuhan akreditasi: hapus
     *
     * Ditolak bila masih dipakai data lain.
     *
     * `DELETE /v1/spmi/akreditasi-dokumen/{id}`
     *
     * scope: `spmi:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAkreditasiDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/spmi/akreditasi-dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }
}
