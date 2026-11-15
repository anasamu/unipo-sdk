<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Presensi QR: Peserta, Presensi QR: Sesi, Presensi QR: Izin, Presensi QR: Titik kerja
 */
final class Presensi extends Resource
{
    /**
     * Pindai QR presensi
     *
     * Dipanggil aplikasi peserta setelah kamera membaca QR. Body: `{"token": "<isi QR>", "lokasi": "-0.54,123.06", "perangkat": "<id perangkat>"}`
     * atau `{"kode": "K7MPQ2"}` (kode cadangan yang dibacakan dosen).
     *
     * - **QR sesi** (layar dosen/penyelenggara): mencatat kehadiran di sesi itu. Mahasiswa harus peserta KRS kelasnya; kegiatan
     *   mengikuti aturan peserta (undangan, terbuka, mahasiswa, pegawai).
     * - **QR titik kerja** (kiosk gerbang/kantor): dosen/tendik tercatat **masuk** (pindaian pertama hari itu) atau **pulang** di
     *   `sdm_presensi` lewat layanan SDM. Kirim `"aksi": "pulang"` untuk memaksa pulang.
     *
     * QR berganti setiap `interval_detik`; QR dari jendela sebelumnya masih diterima (jeda jaringan), lebih lama dari itu 409
     * `qr_kedaluwarsa`. Lokasi diperiksa bila sesi/titik mewajibkannya (`lokasi_wajib`, `di_luar_lokasi`). Satu perangkat untuk
     * dua peserta di sesi yang sama ditandai curiga (atau ditolak 409 `perangkat_ganda` bila sesi menyetel `tolak_perangkat_ganda`).
     * Memindai ulang setelah hadir mengembalikan `"sudah": true`, bukan galat.
     *
     * `POST /v1/presensi/pindai`
     *
     * scope: `presensi:write` · hanya token pengguna
     *
     * @param array{token?: string|null, kode?: string|null, lokasi?: string|null, perangkat?: string|null, aksi?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPindai(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/pindai', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kartu QR pribadi saya
     *
     * Token kartu peserta yang berganti setiap 30 detik, untuk dipindai petugas sesi (mis. seminar, ujian, upacara). `?svg=1` menyertakan gambar SVG dari generator QR (gaya "presensi").
     *
     * `GET /v1/presensi/kartu`
     *
     * scope: `presensi:read` · hanya token pengguna
     *
     * @param array{svg?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKartu(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/kartu', [], $query, null, $options, false, false);
    }

    /**
     * Presensi saya
     *
     * Sesi yang sedang dibuka untuk saya (kuliah dari KRS/ampuan, kegiatan undangan/terbuka) beserta status saya, dan riwayat kehadiran QR. Rekap kuliah per mata kuliah tetap di /v1/mahasiswa/{nim}/presensi; rekap kerja di /v1/sdm/presensi.
     *
     * `GET /v1/presensi/saya`
     *
     * scope: `presensi:read` · hanya token pengguna · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar sesi yang saya kelola
     *
     * Sesi buatan saya, sesi kelas yang saya ampu (dosen), sesi kuliah prodi yang saya kelola (BAK/PROGDI), sesi tempat saya petugas. presensi:admin melihat semua.
     *
     * `GET /v1/presensi/sesi`
     *
     * scope: `presensi:read` · berhalaman
     *
     * @param array{jenis?: string, status?: string, idj?: string, lms_kelas_id?: string, tanggal?: string, dari?: string, sampai?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/sesi', [], $query, null, $options, false, false);
    }

    /**
     * Buat sesi presensi
     *
     * **Kuliah** (dosen pengampu/tim, atau pengelola prodi): `{"jenis": "kuliah", "idj": 1234, "tanggal": "2026-11-16", "jam": 3, "jam_selesai": 4, "bahasan": "Pertemuan 5: ...", "buka": true}`.
     * Dari kelas LMS cukup `{"jenis": "kuliah", "lms_kelas_id": 55, "buka": true}` (idj dibaca dari kelas LMS). Saat disahkan, hasilnya juga disalin ke
     * presensi kelas LMS (lms_presensi_sesi/lms_presensi) supaya tab presensi dan analitik LMS memakai data yang sama.
     * Bawaan: tanggal hari ini, jam = jam jadwal, judul = nama mata kuliah + kelas, peserta = KRS disetujui.
     *
     * **Kegiatan** (semua pegawai dan mahasiswa, mis. rapat, seminar, ormawa): `{"jenis": "kegiatan", "judul": "Rapat senat", "mulai_at": "2026-11-16 09:00",
     * "selesai_at": "2026-11-16 12:00", "peserta": "undangan", "undangan": [{"jenis": "dosen", "subjek": "0912..."}, {"jenis": "tendik", "subjek": "K99..."}], "unit": "fik"}`.
     * `peserta`: undangan, terbuka, mahasiswa, pegawai.
     *
     * Keamanan opsional: `interval_detik` (10-300, bawaan 20), `pakai_kode` (kode cadangan 6 huruf), `izinkan_kartu`, `lokasi` "lat,lng" + `radius_m` + `wajib_lokasi`,
     * `titik` (pakai lokasi titik kerja), `tolak_perangkat_ganda`, `terlambat_menit` (setelah dibuka), `petugas` (username pembantu), `status_kosong` (A/I/S untuk yang tidak hadir).
     * `unit` = bagian penyelenggara (dipakai gaya QR per bagian). `buka: true` langsung membuka sesi.
     *
     * `POST /v1/presensi/sesi`
     *
     * scope: `presensi:write`
     *
     * @param array{jenis?: string|null, idj?: int|null, lms_kelas_id?: int|null, tanggal?: string|null, jam?: int|null, jam_selesai?: int|null, lama?: int|null, nidn?: string|null, bahasan?: string|null, judul?: string|null, keterangan?: string|null, mulai_at?: string|null, selesai_at?: string|null, peserta?: string|null, undangan?: list<mixed>, ganti_undangan?: bool, unit?: string|null, interval_detik?: int|null, pakai_kode?: bool, izinkan_kartu?: bool, lokasi?: string|null, radius_m?: int|null, wajib_lokasi?: bool, titik?: string|null, tolak_perangkat_ganda?: bool, terlambat_menit?: int|null, status_kosong?: string|null, petugas?: list<mixed>, buka?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail sesi
     *
     * Pengelola/petugas juga menerima ringkasan (hadir, izin, sakit, alpa, belum, terlambat, curiga), kode cadangan, dan petugas. Peserta menerima data sesi saja.
     *
     * `GET /v1/presensi/sesi/{id}`
     *
     * scope: `presensi:read`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/sesi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah sesi
     *
     * Isian seperti buat (kecuali jenis, idj, tanggal, jam). `undangan` menambah peserta; `ganti_undangan: true` mengganti seluruh daftar. Sesi disahkan/batal tidak bisa diubah.
     *
     * `POST /v1/presensi/sesi/{id}`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array{jenis?: string|null, idj?: int|null, lms_kelas_id?: int|null, tanggal?: string|null, jam?: int|null, jam_selesai?: int|null, lama?: int|null, nidn?: string|null, bahasan?: string|null, judul?: string|null, keterangan?: string|null, mulai_at?: string|null, selesai_at?: string|null, peserta?: string|null, undangan?: list<mixed>, ganti_undangan?: bool, unit?: string|null, interval_detik?: int|null, pakai_kode?: bool, izinkan_kartu?: bool, lokasi?: string|null, radius_m?: int|null, wajib_lokasi?: bool, titik?: string|null, tolak_perangkat_ganda?: bool, terlambat_menit?: int|null, status_kosong?: string|null, petugas?: list<mixed>, buka?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buka sesi
     *
     * QR mulai berlaku. Dosen pengampu yang membuka sesi kuliah tercatat hadir mengajar (waktu, lokasi `lokasi`, perangkat). Event presensi.sesi_dibuka.
     *
     * `POST /v1/presensi/sesi/{id}/buka`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tutup sesi
     *
     * Pindaian berhenti diterima. Sesi kuliah langsung disahkan ke SIAKAD kecuali `{"sahkan": false}`; kegiatan tidak, kecuali `{"sahkan": true}`.
     *
     * `POST /v1/presensi/sesi/{id}/tutup`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdTutup(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/tutup', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sahkan sesi
     *
     * **Kuliah**: pertemuan + status semua peserta KRS ditulis ke `t_dosen_presensi` / `t_mahasiswa_presensi` lewat service input presensi dosen
     * yang sama dengan halaman web (hadir dari pindaian/isi manual, izin/sakit dari izin yang disetujui, sisanya `status_kosong`). Dosen hanya bisa
     * mengesahkan pada hari pertemuan (aturan SIAKAD); hari lain oleh pengelola prodi. Bila pertemuan itu sudah tercatat, kirim `{"gabung": true}`
     * untuk memperbarui status peserta yang sudah ada. **Kegiatan**: undangan yang tidak hadir dicatat `status_kosong`. Event presensi.sesi_disahkan.
     *
     * `POST /v1/presensi/sesi/{id}/sahkan`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdSahkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/sahkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan sesi
     *
     * Body opsional {"alasan"}. Sesi yang sudah disahkan tidak bisa dibatalkan.
     *
     * `POST /v1/presensi/sesi/{id}/batal`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ganti kode cadangan
     *
     * Kode 6 huruf baru (bila kode lama tersebar).
     *
     * `POST /v1/presensi/sesi/{id}/kode-baru`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdKodeBaru(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/kode-baru', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * QR sesi saat ini
     *
     * Untuk layar dosen/penyelenggara (proyektor). Panggil ulang setiap `sisa_detik`. `isi` = teks yang dijadikan QR; render dengan komponen
     * `KodeQrSiakad` (unipo-ui, gaya `gaya.kode` untuk `gaya.bagian`) atau minta `?svg=1` (SVG dari generator QR terpusat bila terpasang).
     * Juga mengembalikan ringkasan kehadiran dan 8 pemindai terbaru untuk ditampilkan di samping QR.
     *
     * `GET /v1/presensi/sesi/{id}/qr`
     *
     * scope: `presensi:read`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array{svg?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesiByIdQr(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/sesi/{id}/qr', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar peserta dan status
     *
     * Pengelola/petugas. Kuliah: semua peserta KRS; kegiatan undangan: semua undangan; ditambah yang hadir di luar daftar. Per peserta: status, waktu, cara (qr, kode, kartu, manual, izin), terlambat, jarak, tanda curiga, izin yang diajukan. Dosen pengampu yang hadir ada di `pengajar`.
     *
     * `GET /v1/presensi/sesi/{id}/peserta`
     *
     * scope: `presensi:read`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesiByIdPeserta(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/sesi/{id}/peserta', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi/koreksi status peserta
     *
     * `{"peserta": [{"jenis": "mahasiswa", "subjek": "NIM", "status": "I", "catatan": "..."}], "lainnya": "A"}`. `lainnya` mengisi peserta daftar yang belum punya status. Pengelola atau petugas, sebelum disahkan.
     *
     * `POST /v1/presensi/sesi/{id}/peserta`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdPeserta(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/peserta', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pindai kartu QR peserta (petugas)
     *
     * `{"token": "<isi kartu QR>"}`. Untuk peserta tanpa kamera/ponsel atau acara dengan meja registrasi. Lokasi tidak diperiksa (petugas di lokasi).
     *
     * `POST /v1/presensi/sesi/{id}/pindai-kartu`
     *
     * scope: `presensi:write` · hanya token pengguna
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdPindaiKartu(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/pindai-kartu', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus tanda curiga
     *
     * `{"jenis", "subjek", "catatan"}` setelah pengelola memeriksa (mis. dua mahasiswa berbagi ponsel dengan alasan sah).
     *
     * `POST /v1/presensi/sesi/{id}/curiga`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSesiByIdCuriga(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/sesi/{id}/curiga', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jejak pemindaian
     *
     * Pengelola: 500 pindaian terakhir, termasuk yang ditolak (QR kedaluwarsa, bukan peserta, di luar lokasi, perangkat ganda).
     *
     * `GET /v1/presensi/sesi/{id}/log`
     *
     * scope: `presensi:read`
     *
     * @param int|string $id UUID atau ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSesiByIdLog(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/sesi/{id}/log', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar izin
     *
     * Izin saya dan izin yang bisa saya proses (pengelola sesi, dosen pengampu, pengelola prodi). `sebagai=saya|penyetuju` untuk memilih.
     *
     * `GET /v1/presensi/izin`
     *
     * scope: `presensi:read` · berhalaman
     *
     * @param array{status?: string, sebagai?: string, sesi_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIzin(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/izin', [], $query, null, $options, false, false);
    }

    /**
     * Ajukan izin/sakit
     *
     * `{"sesi_id": "<uuid>", "jenis": "sakit", "alasan": "...", "berkas_id": "<uuid surat dari /v1/berkas>"}`, atau untuk pertemuan kuliah tanpa
     * sesi QR (mis. diajukan sebelum kuliah) `{"idj": 1234, "tanggal": "2026-11-20", ...}` (mahasiswa). Izin kerja dosen/tendik lewat /v1/sdm/cuti.
     * Event presensi.izin_diajukan.
     *
     * `POST /v1/presensi/izin`
     *
     * scope: `presensi:write` · hanya token pengguna
     *
     * @param array{sesi_id?: string|null, idj?: int|null, tanggal?: string|null, jenis?: string|null, alasan?: string|null, berkas_id?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIzin(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/izin', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unduh surat izin
     *
     * Pengaju dan penyetuju. ?unduh=1 untuk unduhan.
     *
     * `GET /v1/presensi/izin/{id}/berkas`
     *
     * scope: `presensi:read`
     *
     * @param int|string $id UUID izin
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIzinByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/izin/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui izin
     *
     * Body opsional {"catatan"}. Status peserta di sesi menjadi I/S (tidak menimpa hadir); bila pertemuan kuliah sudah tercatat di SIAKAD, status A diubah ke I/S. Event presensi.izin_diproses.
     *
     * `POST /v1/presensi/izin/{id}/setujui`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID izin
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIzinByIdSetujui(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/izin/{id}/setujui', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tolak izin
     *
     * Body opsional {"catatan"}.
     *
     * `POST /v1/presensi/izin/{id}/tolak`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID izin
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIzinByIdTolak(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/izin/{id}/tolak', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan izin (pengaju)
     *
     * Body opsional {"catatan"}.
     *
     * `POST /v1/presensi/izin/{id}/batal`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID izin
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postIzinByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/izin/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar titik presensi kerja
     *
     * Titik aktif (gerbang, kantor, kiosk). `semua=1` (pengelola) termasuk nonaktif.
     *
     * `GET /v1/presensi/titik`
     *
     * scope: `presensi:read`
     *
     * @param array{semua?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTitik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/titik', [], $query, null, $options, false, false);
    }

    /**
     * Tambah titik
     *
     * `{"kode": "gerbang-utama", "nama": "Gerbang utama", "jenis": "gerbang", "untuk": "pegawai|dosen|tendik", "lokasi": "-0.54,123.06", "radius_m": 150, "wajib_lokasi": true, "interval_detik": 20, "unit": "rektorat"}`. presensi:admin atau admin/operator kepegawaian.
     *
     * `POST /v1/presensi/titik`
     *
     * scope: `presensi:write`
     *
     * @param array{kode?: string|null, nama?: string|null, jenis?: string|null, untuk?: string|null, unit?: string|null, lokasi?: string|null, radius_m?: int|null, wajib_lokasi?: bool, interval_detik?: int|null, aktif?: bool, keterangan?: string|null, ganti_rahasia?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTitik(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/titik', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail titik
     *
     * `GET /v1/presensi/titik/{id}`
     *
     * scope: `presensi:read`
     *
     * @param int|string $id UUID, ID, atau kode titik
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTitikById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/titik/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah titik
     *
     * Isian seperti tambah; `ganti_rahasia: true` membuat QR lama langsung tidak berlaku.
     *
     * `POST /v1/presensi/titik/{id}`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID, ID, atau kode titik
     * @param array{kode?: string|null, nama?: string|null, jenis?: string|null, untuk?: string|null, unit?: string|null, lokasi?: string|null, radius_m?: int|null, wajib_lokasi?: bool, interval_detik?: int|null, aktif?: bool, keterangan?: string|null, ganti_rahasia?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTitikById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/titik/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus titik
     *
     * `POST /v1/presensi/titik/{id}/hapus`
     *
     * scope: `presensi:write`
     *
     * @param int|string $id UUID, ID, atau kode titik
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTitikByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/presensi/titik/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * QR titik saat ini (layar kiosk)
     *
     * Perangkat kiosk memakai token aplikasi dengan scope presensi:kiosk dan memanggil ulang setiap `sisa_detik`. Juga jumlah masuk/pulang lewat titik ini hari ini. `?svg=1` menyertakan SVG.
     *
     * `GET /v1/presensi/titik/{id}/qr`
     *
     * @param int|string $id UUID, ID, atau kode titik
     * @param array{svg?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTitikByIdQr(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/titik/{id}/qr', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jejak pindaian titik
     *
     * Pengelola titik: pindaian satu hari (bawaan hari ini), termasuk yang ditolak.
     *
     * `GET /v1/presensi/titik/{id}/log`
     *
     * scope: `presensi:read`
     *
     * @param int|string $id UUID, ID, atau kode titik
     * @param array{tanggal?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTitikByIdLog(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/presensi/titik/{id}/log', ['id' => $id], $query, null, $options, false, false);
    }
}
