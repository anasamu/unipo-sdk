<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * LMS: Beranda, LMS: Kelas, LMS: Konten, LMS: Kelas terbuka, LMS: Analitik, LMS: Kelas daring, LMS: File, LMS: Tugas, LMS: Kuis, LMS: Forum, LMS: Presensi, LMS: Nilai, LMS: Impor ke SIAKAD
 */
final class Lms extends Resource
{
    /**
     * Ringkasan pengguna
     *
     * Jumlah kelas, notifikasi belum dibaca, tugas yang tenggatnya 14 hari ke depan (mahasiswa), kuis yang sedang dibuka, dan jumlah jawaban yang perlu dinilai (pengajar).
     *
     * `GET /v1/lms/saya`
     *
     * scope: `lms:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/saya', [], $query, null, $options, false, false);
    }

    /**
     * Kalender
     *
     * Tenggat tugas, kuis, kelas daring (materi konferensi), dan pertemuan presensi di kelas pengguna. Token aplikasi wajib memberi kelas_id.
     *
     * `GET /v1/lms/kalender`
     *
     * scope: `lms:read`
     *
     * @param array{dari?: string, sampai?: string, kelas_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKalender(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kalender', [], $query, null, $options, false, false);
    }

    /**
     * Notifikasi pengguna
     *
     * `GET /v1/lms/notifikasi`
     *
     * scope: `lms:read` · hanya token pengguna · berhalaman
     *
     * @param array{belum_dibaca?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNotifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/notifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Tandai notifikasi dibaca
     *
     * `{"id": [1,2]}` atau `{"semua": true}`.
     *
     * `POST /v1/lms/notifikasi/baca`
     *
     * scope: `lms:read` · hanya token pengguna
     *
     * @param array{id?: list<mixed>, semua?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNotifikasiBaca(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/notifikasi/baca', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar kelas
     *
     * Token mahasiswa: kelas dari KRS-nya dan kelas yang ia ikuti. Token dosen: kelas yang ia ampu (jadwal, tim pengajar) atau ikuti. Token aplikasi dan staf ADMIN/BAK/PROGDI: semua kelas (dibatasi prodi).
     *
     * `GET /v1/lms/kelas`
     *
     * scope: `lms:read` · berhalaman
     *
     * @param array{tahun_id?: string, prodi?: string, kode_mk?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Buat kelas non-jadwal
     *
     * Untuk pelatihan, matrikulasi, atau kelas umum. Peserta bergabung dengan kode (`kode_gabung: true`) atau ditambahkan pengajar. Dosen pembuat otomatis menjadi pengajar.
     *
     * `POST /v1/lms/kelas`
     *
     * scope: `lms:kelola`
     *
     * @param array{judul: string|null, ringkasan?: string|null, kode_prodi?: string|null, kode_mk?: string|null, tahun_id?: string|null, kelas?: string|null, format?: string, status?: string, mulai?: string|null, selesai?: string|null, kode_gabung?: bool, pengaturan?: array<string, mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelas(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jadwal SIAKAD yang belum punya kelas LMS
     *
     * Dosen: jadwal yang diampunya. Pengelola: semua (filter prodi, nidn). Bawaan periode aktif.
     *
     * `GET /v1/lms/kelas/jadwal-tersedia`
     *
     * scope: `lms:read`
     *
     * @param array{tahun_id?: string, prodi?: string, nidn?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasJadwalTersedia(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/jadwal-tersedia', [], $query, null, $options, false, false);
    }

    /**
     * Buat kelas dari jadwal SIAKAD
     *
     * Dosen pengampu atau pengelola. Pengajar diambil dari t_jadwal/t_jadwal_team dan peserta dari KRS secara langsung (tanpa sinkronisasi). Bila kelas untuk jadwal itu sudah ada, kelas itu yang dikembalikan (200).
     *
     * `POST /v1/lms/kelas/dari-jadwal`
     *
     * scope: `lms:kelola`
     *
     * @param array{idj: int|null, judul?: string|null, ringkasan?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasDariJadwal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/dari-jadwal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat kelas untuk semua jadwal satu periode
     *
     * Hanya pengelola (aplikasi atau ADMIN/BAK/PROGDI). Jadwal yang sudah punya kelas dilewati, jadi aman dijalankan berulang (mis. tiap awal semester).
     *
     * `POST /v1/lms/kelas/sinkron-jadwal`
     *
     * scope: `lms:kelola`
     *
     * @param array{tahun_id: string|null, prodi?: string|null, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasSinkronJadwal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/sinkron-jadwal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bergabung dengan kode kelas
     *
     * Mahasiswa bergabung ke kelas non-jadwal dengan kode dari pengajar.
     *
     * `POST /v1/lms/kelas/gabung`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param array{kode: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasGabung(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/gabung', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail kelas
     *
     * Termasuk peran pemilik token (`peran`), data jadwal SIAKAD, dan jumlah konten.
     *
     * `GET /v1/lms/kelas/{id}`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kelas
     *
     * `kode_gabung`: "baru" membuat kode baru, "hapus" menutup pendaftaran dengan kode.
     *
     * `PATCH /v1/lms/kelas/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{judul?: string|null, ringkasan?: string|null, format?: string, status?: string, mulai?: string|null, selesai?: string|null, pengaturan?: array<string, mixed>, sampul_file_id?: int|null, kode_gabung?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelasById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/kelas/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kelas (arsip lunak)
     *
     * Pengajar atau pengelola. Data tetap tersimpan (deleted_at).
     *
     * `DELETE /v1/lms/kelas/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/kelas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Anggota kelas
     *
     * Gabungan pengampu jadwal + tim pengajar, peserta KRS, dan anggota tambahan.
     *
     * `GET /v1/lms/kelas/{id}/peserta`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdPeserta(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/peserta', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah anggota
     *
     * Asisten, pengamat (mis. penjamin mutu), pengajar tambahan, atau mahasiswa (kelas non-jadwal). Username harus akun SIAKAD aktif.
     *
     * `POST /v1/lms/kelas/{id}/anggota`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{username: string|null, peran: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdAnggota(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/anggota', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus anggota tambahan
     *
     * Pengampu jadwal dan peserta KRS tidak bisa dihapus dari LMS; ubah di SIAKAD.
     *
     * `DELETE /v1/lms/kelas/{id}/anggota/{username}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param int|string $username Username
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelasByIdAnggotaByUsername(int|string $id, int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/kelas/{id}/anggota/{username}', ['id' => $id, 'username' => $username], $query, null, $options, false, false);
    }

    /**
     * Kerangka kelas
     *
     * Topik/pertemuan berurutan beserta materi, tugas, kuis, forum, dan sesi presensi di dalamnya, plus progres pengguna. Item tersembunyi tidak dikirim ke mahasiswa.
     *
     * `GET /v1/lms/kelas/{id}/konten`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdKonten(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/konten', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah urutan topik dan materi
     *
     * `{"topik": [id, ...], "materi": [{"id", "topik_id", "urutan"}]}`
     *
     * `PUT /v1/lms/kelas/{id}/urutan`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKelasByIdUrutan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lms/kelas/{id}/urutan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Progres penyelesaian
     *
     * Materi wajib selesai, tugas dikumpulkan, kuis dikerjakan. Pengajar: semua mahasiswa; mahasiswa: dirinya.
     *
     * `GET /v1/lms/kelas/{id}/progres`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdProgres(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/progres', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Log aktivitas kelas
     *
     * Untuk pengajar/pengelola: siapa membuka atau mengerjakan apa, dan ringkasan per pengguna.
     *
     * `GET /v1/lms/kelas/{id}/aktivitas`
     *
     * scope: `lms:kelola` · berhalaman
     *
     * @param int|string $id ID kelas
     * @param array{username?: string, aksi?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdAktivitas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/aktivitas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Katalog kelas terbuka (MOOC)
     *
     * Tanpa token. Kelas non-jadwal aktif dengan pengaturan {"terbuka": true} (atur lewat ubah kelas). Isi kelas hanya untuk anggota.
     *
     * `GET /v1/lms/terbuka`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTerbuka(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/terbuka', [], $query, null, $options, false, true);
    }

    /**
     * Ikuti kelas terbuka
     *
     * Akun mahasiswa bergabung tanpa kode gabung.
     *
     * `POST /v1/lms/terbuka/{id}/gabung`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTerbukaByIdGabung(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/terbuka/{id}/gabung', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pantau aktivitas lintas kelas
     *
     * Pengelola LMS (ADMIN, BAK, PROGDI prodinya): per kelas peserta, isi (materi/tugas/kuis), pengguna aktif 7 dan 30 hari, aktivitas terakhir peserta dan pengajar, kelas tanpa konten.
     *
     * `GET /v1/lms/analitik/kelas`
     *
     * scope: `lms:read` · berhalaman
     *
     * @param array{tahun_id?: string, kode_prodi?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAnalitikKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/analitik/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Aktivitas mahasiswa di semua kelas
     *
     * Mahasiswa itu sendiri atau pengelola LMS: per kelas progres, kehadiran, tugas, forum, nilai sementara, dan skor keterlibatan.
     *
     * `GET /v1/lms/analitik/mahasiswa/{nim}`
     *
     * scope: `lms:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAnalitikMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/analitik/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Skor keterlibatan (engagement)
     *
     * Skor 0-100 per mahasiswa dari keaktifan 30 hari (25), progres (30), ketepatan tugas (20), kehadiran (15), forum (10); komponen tanpa aktivitas di kelas tidak dihitung. Kategori tinggi >= 70, sedang >= 40. Pengajar: semua; mahasiswa: dirinya.
     *
     * `GET /v1/lms/kelas/{id}/keterlibatan`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdKeterlibatan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/keterlibatan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prediksi kelulusan mata kuliah
     *
     * Peluang lulus per mahasiswa dari model logistik transparan (nilai sementara, kehadiran, progres, keterlibatan, IPK SIAKAD), risiko tinggi/sedang/rendah, dan penyebabnya. Pengajar: semua; mahasiswa: dirinya.
     *
     * `GET /v1/lms/kelas/{id}/prediksi`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdPrediksi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/prediksi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Analisis pembelajaran kelas
     *
     * Pengajar/pengelola: tiap materi (dilihat/selesai), tugas (dikumpulkan, terlambat, rata nilai), kuis (peserta, rata/min/maks), sesi presensi, aktivitas per minggu, dan aksi terbanyak.
     *
     * `GET /v1/lms/kelas/{id}/analisis`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdAnalisis(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/analisis', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Duplikasi bahan ajar dari kelas lain
     *
     * Body {"dari_kelas_id", "bagian"?: ["topik","materi","tugas","kuis","forum"]}. Harus pengajar/pengelola di kedua kelas. Lampiran ikut (berkas tidak digandakan di disk), soal kuis memakai bank soal yang sama, item buku nilai dibuat. Salinan disembunyikan dan jadwalnya dikosongkan.
     *
     * `POST /v1/lms/kelas/{id}/salin`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas tujuan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah topik/pertemuan
     *
     * `POST /v1/lms/kelas/{id}/topik`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{id?: int|null, judul: string|null, deskripsi?: string|null, urutan?: int|null, pertemuan_ke?: int|null, tanggal?: string|null, tampil?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdTopik(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/topik', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat topik pertemuan 1..n sekaligus
     *
     * `{"jumlah": 16, "mulai": "2026-09-01", "uts": 8, "uas": 16}`. Pertemuan yang sudah ada dilewati.
     *
     * `POST /v1/lms/kelas/{id}/topik/mingguan`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdTopikMingguan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/topik/mingguan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah topik
     *
     * `PATCH /v1/lms/topik/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID topik
     * @param array{id?: int|null, judul: string|null, deskripsi?: string|null, urutan?: int|null, pertemuan_ke?: int|null, tanggal?: string|null, tampil?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchTopikById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/topik/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus topik
     *
     * Isinya tidak ikut terhapus; dipindah ke bagian Umum.
     *
     * `DELETE /v1/lms/topik/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID topik
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTopikById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/topik/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar materi (tanpa isi)
     *
     * `GET /v1/lms/kelas/{id}/materi`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdMateri(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/materi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah materi
     *
     * Jenis: teks (HTML), file (lampirkan file_ids), tautan, video (URL), konferensi (URL ruang Zoom/Meet/Jitsi + mulai/selesai). HTML disaring di server. `beritahu: true` mengirim notifikasi ke peserta.
     *
     * `POST /v1/lms/kelas/{id}/materi`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{topik_id?: int|null, jenis: string, judul: string|null, konten?: string|null, url?: string|null, mulai?: string|null, selesai?: string|null, wajib_selesai?: bool, urutan?: int|null, tampil?: bool, tersedia_mulai?: string|null, tersedia_sampai?: string|null, file_ids?: list<mixed>, beritahu?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdMateri(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/materi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buka materi
     *
     * Mencatat materi dilihat (dan selesai bila tidak wajib ditandai) untuk mahasiswa.
     *
     * `GET /v1/lms/materi/{id}`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID materi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMateriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/materi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah materi
     *
     * `PATCH /v1/lms/materi/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID materi
     * @param array{topik_id?: int|null, jenis: string, judul: string|null, konten?: string|null, url?: string|null, mulai?: string|null, selesai?: string|null, wajib_selesai?: bool, urutan?: int|null, tampil?: bool, tersedia_mulai?: string|null, tersedia_sampai?: string|null, file_ids?: list<mixed>, beritahu?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchMateriById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/materi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus materi
     *
     * `DELETE /v1/lms/materi/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID materi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMateriById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/materi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tandai materi selesai
     *
     * `{"selesai": false}` membatalkan.
     *
     * `POST /v1/lms/materi/{id}/selesai`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param int|string $id ID materi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMateriByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/materi/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penyedia rapat daring yang aktif
     *
     * Zoom / Google Meet yang diatur admin (Pustikom » Integrasi, kategori rapat). Kosong = kelas daring hanya bisa memakai tautan manual.
     *
     * `GET /v1/lms/rapat/penyedia`
     *
     * scope: `lms:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRapatPenyedia(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/rapat/penyedia', [], $query, null, $options, false, false);
    }

    /**
     * Jadwalkan kelas daring
     *
     * Membuat materi jenis konferensi sekaligus ruang Zoom/Google Meet lewat penyedia utama (atau `penyedia`). Waktu `mulai`/`selesai` dalam zona waktu SIAKAD. Peserta diberi notifikasi (bawaan `beritahu: true`).
     *
     * `POST /v1/lms/kelas/{id}/kelas-daring`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{topik_id?: int|null, judul: string|null, konten?: string|null, mulai: string|null, selesai: string|null, penyedia?: string|null, tampil?: bool, beritahu?: bool, wajib_selesai?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdKelasDaring(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/kelas-daring', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Info bergabung kelas daring
     *
     * Tautan bergabung, kata sandi (Zoom), dan `waktu` (akan_datang, berlangsung mulai 15 menit sebelum, selesai). `url_host` hanya untuk pengajar. Materi konferensi dengan tautan manual dijawab `driver: tautan`.
     *
     * `GET /v1/lms/materi/{id}/rapat`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID materi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMateriByIdRapat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/materi/{id}/rapat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat/selaraskan ruang Zoom/Meet untuk materi
     *
     * Untuk materi konferensi yang sudah ada: membuat ruang rapat (201), atau bila sudah ada, menyamakan judul/waktunya dengan materi (200). Kirim `penyedia` untuk mengganti penyedia (ruang lama dibatalkan). Tautan peserta disalin ke `url` materi.
     *
     * `POST /v1/lms/materi/{id}/rapat`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID materi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMateriByIdRapat(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/materi/{id}/rapat', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan ruang Zoom/Meet
     *
     * Meeting dihapus di penyedia dan tautan di materi dikosongkan. `?paksa=1` tetap membatalkan bila penyedia gagal dihubungi.
     *
     * `DELETE /v1/lms/materi/{id}/rapat`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID materi
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMateriByIdRapat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/materi/{id}/rapat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah file
     *
     * multipart/form-data: `file`, `kelas_id`, `konteks` (materi, tugas, soal, sampul: pengelola; jawaban: mahasiswa; forum: anggota). Hasilnya dipasang lewat `file_ids` di materi/tugas/jawaban/post. Ukuran dan ekstensi diatur di config/lms.php.
     *
     * `POST /v1/lms/file`
     *
     * scope: `lms:read`
     *
     * @param array{berkas_id?: string, file?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, kelas_id: int, konteks: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFile(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/file', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Unduh file
     *
     * File jawaban hanya untuk pemiliknya dan pengelola kelas; file lain untuk anggota kelas yang bisa melihat objek tempat file dilampirkan.
     *
     * `GET /v1/lms/file/{uuid}`
     *
     * scope: `lms:read`
     *
     * @param int|string $uuid UUID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Hapus file
     *
     * Pemilik file atau pengelola kelas.
     *
     * `DELETE /v1/lms/file/{uuid}`
     *
     * scope: `lms:read`
     *
     * @param int|string $uuid UUID file
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteFileByUuid(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/file/{uuid}', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Daftar tugas
     *
     * Mahasiswa: beserta status jawabannya. Pengajar: beserta jumlah dikumpulkan/dinilai.
     *
     * `GET /v1/lms/kelas/{id}/tugas`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdTugas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/tugas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat tugas
     *
     * Otomatis membuat kolom buku nilai (komponen bawaan "Tugas"). `rubrik`: [{kriteria, deskripsi, skor_maks}].
     *
     * `POST /v1/lms/kelas/{id}/tugas`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{topik_id?: int|null, judul: string|null, instruksi?: string|null, jenis_pengumpulan?: string, maks_file?: int|null, ekstensi?: string|null, mulai?: string|null, tenggat?: string|null, batas_akhir?: string|null, terima_terlambat?: bool, nilai_maks?: float|int|null, rubrik?: list<mixed>, tampil?: bool, file_ids?: list<mixed>, komponen?: string|null, bobot?: float|int|null, beritahu?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdTugas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/tugas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail tugas
     *
     * Mahasiswa: termasuk `jawaban_saya`.
     *
     * `GET /v1/lms/tugas/{id}`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTugasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/tugas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah tugas
     *
     * `PATCH /v1/lms/tugas/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID tugas
     * @param array{topik_id?: int|null, judul: string|null, instruksi?: string|null, jenis_pengumpulan?: string, maks_file?: int|null, ekstensi?: string|null, mulai?: string|null, tenggat?: string|null, batas_akhir?: string|null, terima_terlambat?: bool, nilai_maks?: float|int|null, rubrik?: list<mixed>, tampil?: bool, file_ids?: list<mixed>, komponen?: string|null, bobot?: float|int|null, beritahu?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchTugasById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/tugas/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus tugas
     *
     * Kolom buku nilainya ikut dihapus.
     *
     * `DELETE /v1/lms/tugas/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTugasById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/tugas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jawaban tugas
     *
     * Pengajar: semua peserta (termasuk yang belum mengumpulkan). Mahasiswa: jawabannya sendiri.
     *
     * `GET /v1/lms/tugas/{id}/jawaban`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID tugas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTugasByIdJawaban(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/tugas/{id}/jawaban', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan/kumpulkan jawaban (mahasiswa)
     *
     * `{"teks": "...", "file_ids": [..], "kumpulkan": true}`. Tanpa `kumpulkan` = draf (dan menarik pengumpulan yang belum dinilai). Ditolak sebelum mulai, setelah batas_akhir, atau setelah tenggat bila tidak menerima terlambat.
     *
     * `PUT /v1/lms/tugas/{id}/jawaban`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param int|string $id ID tugas
     * @param array{id?: int|null, tugas_id?: int|null, nim?: string|null, teks?: string|null, status?: string, dikumpulkan_at?: string|null, terlambat?: bool, percobaan?: int|null, nilai?: float|int|null, nilai_rubrik?: list<mixed>, umpan_balik?: string|null, dinilai_at?: string|null, lampiran?: list<mixed>, file_ids?: list<mixed>, kumpulkan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTugasByIdJawaban(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lms/tugas/{id}/jawaban', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Nilai jawaban
     *
     * `{"nilai": 85, "umpan_balik": "...", "kembalikan": false}` atau `{"nilai_rubrik": [4, 3, 5]}` (nilai dihitung dari rubrik). `kembalikan: true` membuka pengumpulan ulang. Juga untuk tugas luring tanpa jawaban di LMS.
     *
     * `POST /v1/lms/tugas/{id}/jawaban/{nim}/nilai`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID tugas
     * @param int|string $nim NIM
     * @param array{nilai?: float|int|null, nilai_rubrik?: list<mixed>, umpan_balik?: string|null, kembalikan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTugasByIdJawabanByNimNilai(int|string $id, int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/tugas/{id}/jawaban/{nim}/nilai', ['id' => $id, 'nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bank soal
     *
     * Dosen: soal miliknya dan soal yang dibagikan. Pengelola: semua (dibatasi prodi). Kunci jawaban ikut ditampilkan.
     *
     * `GET /v1/lms/bank-soal`
     *
     * scope: `lms:kelola` · berhalaman
     *
     * @param array{kode_mk?: string, prodi?: string, jenis?: string, tingkat?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBankSoal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/bank-soal', [], $query, null, $options, false, false);
    }

    /**
     * Tambah soal
     *
     * Format `opsi` dan `kunci` per jenis:
     *
     * * `pilihan_ganda`: opsi `[{"id":"a","teks":"..."}, ...]`, kunci `"a"`
     * * `pilihan_ganda_banyak`: opsi sama, kunci `["a","c"]` (nilai parsial: benar - salah)
     * * `benar_salah`: kunci `true`/`false`
     * * `isian_singkat`: kunci `["Jakarta", "DKI Jakarta"]` (tidak peka huruf besar/kecil)
     * * `menjodohkan`: opsi `{"kiri":[{"id":"1","teks":".."}], "kanan":[{"id":"x","teks":".."}]}`, kunci `{"1":"x"}`
     * * `esai`: tanpa kunci, dikoreksi pengajar
     *
     * `POST /v1/lms/bank-soal`
     *
     * scope: `lms:kelola`
     *
     * @param array{id?: int|null, kode_prodi?: string|null, kode_mk?: string|null, jenis: string, pertanyaan: string|null, opsi?: mixed, kunci?: mixed, pembahasan?: string|null, poin?: float|int|null, tingkat?: string, tag?: string|null, dibagikan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBankSoal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/bank-soal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail soal
     *
     * `GET /v1/lms/bank-soal/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID soal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBankSoalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/bank-soal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah soal
     *
     * Hanya pemilik atau pengelola. Perubahan kunci berlaku untuk penilaian berikutnya.
     *
     * `PATCH /v1/lms/bank-soal/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID soal
     * @param array{id?: int|null, kode_prodi?: string|null, kode_mk?: string|null, jenis: string, pertanyaan: string|null, opsi?: mixed, kunci?: mixed, pembahasan?: string|null, poin?: float|int|null, tingkat?: string, tag?: string|null, dibagikan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchBankSoalById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/bank-soal/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus soal
     *
     * `DELETE /v1/lms/bank-soal/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID soal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteBankSoalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/bank-soal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar kuis
     *
     * `GET /v1/lms/kelas/{id}/kuis`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdKuis(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/kuis', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat kuis/ujian daring
     *
     * Otomatis membuat kolom buku nilai (komponen bawaan "Harian", yaitu jenis nilai Harian SIAKAD; isi `komponen: "UTS"` atau `"UAS"` untuk ujian). Soal diatur lewat PUT .../soal.
     *
     * `POST /v1/lms/kelas/{id}/kuis`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{topik_id?: int|null, judul: string|null, deskripsi?: string|null, mulai?: string|null, selesai?: string|null, durasi_menit?: int|null, maks_percobaan?: int|null, metode_nilai?: string, acak_soal?: bool, acak_opsi?: bool, tampil_hasil?: string, tampil_kunci?: bool, nilai_maks?: float|int|null, kata_sandi?: string|null, tampil?: bool, komponen?: string|null, bobot?: float|int|null, beritahu?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdKuis(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/kuis', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail kuis
     *
     * Pengajar: termasuk soal dan kunci. Mahasiswa: termasuk percobaannya.
     *
     * `GET /v1/lms/kuis/{id}`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kuis
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKuisById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kuis/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kuis
     *
     * Mengubah nilai_maks/metode_nilai menghitung ulang semua nilai.
     *
     * `PATCH /v1/lms/kuis/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kuis
     * @param array{topik_id?: int|null, judul: string|null, deskripsi?: string|null, mulai?: string|null, selesai?: string|null, durasi_menit?: int|null, maks_percobaan?: int|null, metode_nilai?: string, acak_soal?: bool, acak_opsi?: bool, tampil_hasil?: string, tampil_kunci?: bool, nilai_maks?: float|int|null, kata_sandi?: string|null, tampil?: bool, komponen?: string|null, bobot?: float|int|null, beritahu?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKuisById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/kuis/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kuis
     *
     * `DELETE /v1/lms/kuis/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kuis
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKuisById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/kuis/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Atur soal kuis
     *
     * `{"soal": [{"soal_id": 1, "poin": 2}, ...]}` mengganti daftar soal. Ditolak bila kuis sudah dikerjakan.
     *
     * `PUT /v1/lms/kuis/{id}/soal`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kuis
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKuisByIdSoal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lms/kuis/{id}/soal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Mulai/lanjutkan kuis (mahasiswa)
     *
     * Mengembalikan soal (tanpa kunci) dan sisa waktu. Percobaan yang sedang berjalan dilanjutkan. `{"kata_sandi": "..."}` bila kuis berkata sandi.
     *
     * `POST /v1/lms/kuis/{id}/mulai`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param int|string $id ID kuis
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKuisByIdMulai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kuis/{id}/mulai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar percobaan
     *
     * Pengajar: semua mahasiswa. Mahasiswa: miliknya (nilai muncul sesuai pengaturan tampil_hasil).
     *
     * `GET /v1/lms/kuis/{id}/percobaan`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kuis
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKuisByIdPercobaan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kuis/{id}/percobaan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail percobaan
     *
     * Berlangsung: soal + jawaban tersimpan. Selesai: hasil per soal (kunci dan pembahasan bila diizinkan).
     *
     * `GET /v1/lms/kuis/percobaan/{id}`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID percobaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKuisPercobaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kuis/percobaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan jawaban
     *
     * `{"jawaban": [{"soal_id": 1, "jawaban": "a"}]}`. Boleh sebagian (simpan otomatis). Lewat batas waktu, percobaan ditutup otomatis.
     *
     * `PUT /v1/lms/kuis/percobaan/{id}/jawaban`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param int|string $id ID percobaan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKuisPercobaanByIdJawaban(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lms/kuis/percobaan/{id}/jawaban', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kumpulkan kuis
     *
     * Menilai otomatis (esai menunggu koreksi) dan memperbarui buku nilai.
     *
     * `POST /v1/lms/kuis/percobaan/{id}/selesai`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param int|string $id ID percobaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKuisPercobaanByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kuis/percobaan/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Koreksi manual satu soal
     *
     * `{"soal_id": 5, "poin": 8, "umpan_balik": "..."}`. Untuk esai, atau mengganti hasil otomatis.
     *
     * `POST /v1/lms/kuis/percobaan/{id}/koreksi`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID percobaan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKuisPercobaanByIdKoreksi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kuis/percobaan/{id}/koreksi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar forum
     *
     * `GET /v1/lms/kelas/{id}/forum`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdForum(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/forum', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat forum
     *
     * Jenis: diskusi, pengumuman (hanya pengajar membuka utas; peserta diberi notifikasi), tanya_jawab (mahasiswa melihat jawaban teman setelah menjawab).
     *
     * `POST /v1/lms/kelas/{id}/forum`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{id?: int|null, kelas_id?: int|null, topik_id?: int|null, jenis?: string, judul: string|null, deskripsi?: string|null, terkunci?: bool, tampil?: bool, jumlah_utas?: int|null, post_terakhir?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdForum(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/forum', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah forum
     *
     * Termasuk mengunci (`terkunci`).
     *
     * `PATCH /v1/lms/forum/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID forum
     * @param array{id?: int|null, kelas_id?: int|null, topik_id?: int|null, jenis?: string, judul: string|null, deskripsi?: string|null, terkunci?: bool, tampil?: bool, jumlah_utas?: int|null, post_terakhir?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchForumById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/forum/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus forum
     *
     * `DELETE /v1/lms/forum/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID forum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteForumById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/forum/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar utas
     *
     * Utas disematkan lebih dulu, lalu yang terakhir aktif.
     *
     * `GET /v1/lms/forum/{id}/post`
     *
     * scope: `lms:read` · berhalaman
     *
     * @param int|string $id ID forum
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getForumByIdPost(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/forum/{id}/post', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buka utas atau balas
     *
     * `{"judul": "...", "isi": "<p>...</p>"}` untuk utas baru; `{"induk_id": 10, "isi": "..."}` untuk membalas. HTML disaring di server.
     *
     * `POST /v1/lms/forum/{id}/post`
     *
     * scope: `lms:write`
     *
     * @param int|string $id ID forum
     * @param array{judul?: string|null, isi: string|null, induk_id?: int|null, file_ids?: list<mixed>, disematkan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postForumByIdPost(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/forum/{id}/post', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Satu utas lengkap
     *
     * Post akar dan semua balasan (susun pohon dengan induk_id).
     *
     * `GET /v1/lms/forum/post/{id}`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID post (akar atau balasan)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getForumPostById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/forum/post/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah post
     *
     * Penulis atau pengajar; menyematkan hanya pengajar.
     *
     * `PATCH /v1/lms/forum/post/{id}`
     *
     * scope: `lms:write`
     *
     * @param int|string $id ID post
     * @param array{judul?: string|null, isi: string|null, induk_id?: int|null, file_ids?: list<mixed>, disematkan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchForumPostById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/forum/post/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus post
     *
     * Penulis atau pengajar.
     *
     * `DELETE /v1/lms/forum/post/{id}`
     *
     * scope: `lms:write`
     *
     * @param int|string $id ID post
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteForumPostById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/forum/post/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sesi presensi dan rekap
     *
     * Pengajar: rekap H/I/S/A semua mahasiswa. Mahasiswa: presensinya sendiri.
     *
     * `GET /v1/lms/kelas/{id}/presensi`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdPresensi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/presensi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat sesi presensi
     *
     * `metode: kode` membuat kode 6 karakter (tampilkan sebagai teks/QR). `buka: true` + `durasi_menit` langsung membuka sesi.
     *
     * `POST /v1/lms/kelas/{id}/presensi`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{pertemuan_ke: int|null, tanggal: string|null, jam_mulai?: string|null, jam_selesai?: string|null, topik_id?: int|null, metode?: string, bahasan?: string|null, buka?: bool, durasi_menit?: int|null, kode_baru?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdPresensi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/presensi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail sesi
     *
     * Pengajar: kode dan status semua peserta.
     *
     * `GET /v1/lms/presensi/{id}`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/presensi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buka/tutup/ubah sesi
     *
     * `{"buka": true, "durasi_menit": 15}`, `{"buka": false}`, `{"kode_baru": true}`.
     *
     * `PATCH /v1/lms/presensi/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID sesi
     * @param array{pertemuan_ke: int|null, tanggal: string|null, jam_mulai?: string|null, jam_selesai?: string|null, topik_id?: int|null, metode?: string, bahasan?: string|null, buka?: bool, durasi_menit?: int|null, kode_baru?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchPresensiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/presensi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus sesi
     *
     * `DELETE /v1/lms/presensi/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePresensiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/presensi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi presensi (mahasiswa)
     *
     * `{"kode": "AB12CD"}` selama sesi dibuka.
     *
     * `POST /v1/lms/presensi/{id}/hadir`
     *
     * scope: `lms:write` · hanya token pengguna
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiByIdHadir(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/presensi/{id}/hadir', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Isi/koreksi presensi (pengajar)
     *
     * `{"peserta": [{"nim": "..", "status": "I", "catatan": ".."}], "lainnya": "A"}`; `lainnya` mengisi peserta yang belum punya status.
     *
     * `PUT /v1/lms/presensi/{id}/peserta`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPresensiByIdPeserta(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lms/presensi/{id}/peserta', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buku nilai
     *
     * Kolom (tugas, kuis, manual), nilai per mahasiswa, rekap per komponen (0-100), dan nilai akhir perkiraan memakai persentase komponen SIAKAD (t_mahasiswa_nilai_persen) bila ada. Mahasiswa: hanya kolom yang ditampilkan dan nilainya sendiri.
     *
     * `GET /v1/lms/kelas/{id}/nilai`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdNilai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/nilai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah kolom nilai manual
     *
     * Mis. keaktifan, praktikum, UTS/UAS luring.
     *
     * `POST /v1/lms/kelas/{id}/nilai/item`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{id?: int|null, sumber?: string, sumber_id?: int|null, nama: string|null, komponen?: string|null, nilai_maks?: float|int|null, bobot?: float|int|null, tampil?: bool, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdNilaiItem(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/nilai/item', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah kolom nilai
     *
     * Komponen, bobot, tampil, urutan (nama/nilai_maks hanya kolom manual).
     *
     * `PATCH /v1/lms/nilai/item/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kolom
     * @param array{id?: int|null, sumber?: string, sumber_id?: int|null, nama: string|null, komponen?: string|null, nilai_maks?: float|int|null, bobot?: float|int|null, tampil?: bool, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchNilaiItemById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/nilai/item/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kolom nilai manual
     *
     * `DELETE /v1/lms/nilai/item/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kolom
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteNilaiItemById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/nilai/item/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi nilai kolom manual
     *
     * `{"nilai": [{"nim": "..", "nilai": 85, "catatan": ".."}]}`
     *
     * `PUT /v1/lms/nilai/item/{id}/nilai`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kolom
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putNilaiItemByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lms/nilai/item/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Capaian pembelajaran (CPMK)
     *
     * CPMK mata kuliah, pemetaannya ke kolom nilai kelas ini, dan capaian tiap mahasiswa (persen, tercapai bila >= batas_lulus) serta rata-rata kelas.
     *
     * `GET /v1/lms/kelas/{id}/cpmk`
     *
     * scope: `lms:read`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdCpmk(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/cpmk', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah CPMK
     *
     * Berlaku untuk semua kelas dengan prodi dan mata kuliah yang sama.
     *
     * `POST /v1/lms/kelas/{id}/cpmk`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdCpmk(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/cpmk', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah CPMK
     *
     * `PATCH /v1/lms/kelas/{id}/cpmk/{cpmk_id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param int|string $cpmk_id ID CPMK
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchKelasByIdCpmkByCpmkId(int|string $id, int|string $cpmk_id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/lms/kelas/{id}/cpmk/{cpmk_id}', ['id' => $id, 'cpmk_id' => $cpmk_id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus CPMK
     *
     * `DELETE /v1/lms/kelas/{id}/cpmk/{cpmk_id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param int|string $cpmk_id ID CPMK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKelasByIdCpmkByCpmkId(int|string $id, int|string $cpmk_id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/lms/kelas/{id}/cpmk/{cpmk_id}', ['id' => $id, 'cpmk_id' => $cpmk_id], $query, null, $options, false, false);
    }

    /**
     * Petakan kolom nilai ke CPMK
     *
     * `{"item": [{"item_id": 3, "bobot": 1}]}` mengganti pemetaan untuk kelas ini.
     *
     * `PUT /v1/lms/kelas/{id}/cpmk/{cpmk_id}/item`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param int|string $cpmk_id ID CPMK
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKelasByIdCpmkByCpmkIdItem(int|string $id, int|string $cpmk_id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/lms/kelas/{id}/cpmk/{cpmk_id}/item', ['id' => $id, 'cpmk_id' => $cpmk_id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pratinjau impor nilai
     *
     * Tidak menulis apa pun. Menampilkan kolom SIAKAD yang akan diisi (dari komponen kolom buku nilai), nilai LMS vs nilai SIAKAD per mahasiswa KRS, aksi tiap sel (tambah/ubah/sama/dilewati/ditolak), dan status batas tanggal input nilai. Hanya dosen pengampu jadwal atau staf ADMIN/BAK/PROGDI.
     *
     * `POST /v1/lms/kelas/{id}/siakad/nilai/pratinjau`
     *
     * scope: `lms:kelola` · hanya token pengguna
     *
     * @param int|string $id ID kelas
     * @param array{mode?: string, item_ids?: list<mixed>, kosong_nol?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdSiakadNilaiPratinjau(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/siakad/nilai/pratinjau', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Impor nilai ke SIAKAD
     *
     * Menulis nilai ke t_mahasiswa_nilai (sama seperti impor Excel di halaman nilai SIAKAD). Nilai akhir/huruf dihitung SIAKAD seperti biasa saat halaman nilai dibuka. Mengikuti batas tanggal input nilai (ADMIN bebas); UAS tidak ditulis bila syarat presensi belum terpenuhi. Nilai lama disimpan agar bisa dibatalkan.
     *
     * `POST /v1/lms/kelas/{id}/siakad/nilai/impor`
     *
     * scope: `lms:kelola` · hanya token pengguna
     *
     * @param int|string $id ID kelas
     * @param array{mode?: string, item_ids?: list<mixed>, kosong_nol?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdSiakadNilaiImpor(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/siakad/nilai/impor', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pratinjau impor presensi
     *
     * Tidak menulis apa pun. Per sesi LMS: jam kuliah SIAKAD (m_jam) hasil pemetaan jam sesi, apakah pertemuan sudah ada di SIAKAD, dan aksi per mahasiswa.
     *
     * `POST /v1/lms/kelas/{id}/siakad/presensi/pratinjau`
     *
     * scope: `lms:kelola` · hanya token pengguna
     *
     * @param int|string $id ID kelas
     * @param array{sesi_ids?: list<mixed>, nidn?: string|null, kosong_alpa?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdSiakadPresensiPratinjau(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/siakad/presensi/pratinjau', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Impor presensi ke SIAKAD
     *
     * Membuat pertemuan di t_dosen_presensi (bila belum ada) dan presensi mahasiswa di t_mahasiswa_presensi dengan status H/I/S/A dari LMS, seperti input presensi dosen di SIAKAD. Bisa dibatalkan.
     *
     * `POST /v1/lms/kelas/{id}/siakad/presensi/impor`
     *
     * scope: `lms:kelola` · hanya token pengguna
     *
     * @param int|string $id ID kelas
     * @param array{sesi_ids?: list<mixed>, nidn?: string|null, kosong_alpa?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdSiakadPresensiImpor(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/kelas/{id}/siakad/presensi/impor', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat impor
     *
     * Terbaru dulu.
     *
     * `GET /v1/lms/kelas/{id}/siakad/impor`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID kelas
     * @param array{jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelasByIdSiakadImpor(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/kelas/{id}/siakad/impor', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Detail impor
     *
     * Setiap baris SIAKAD yang ditulis beserta nilai lama dan barunya.
     *
     * `GET /v1/lms/impor-siakad/{id}`
     *
     * scope: `lms:kelola`
     *
     * @param int|string $id ID impor
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getImporSiakadById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/lms/impor-siakad/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan impor
     *
     * Memulihkan nilai/presensi SIAKAD ke keadaan sebelum impor (baris yang dibuat impor dihapus). Baris yang sudah diubah lagi di SIAKAD setelah impor tidak ditimpa dan dilaporkan sebagai konflik, kecuali `{"paksa": true}`. Pembatalan nilai mengikuti batas tanggal input nilai.
     *
     * `POST /v1/lms/impor-siakad/{id}/batal`
     *
     * scope: `lms:kelola` · hanya token pengguna
     *
     * @param int|string $id ID impor
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postImporSiakadByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/lms/impor-siakad/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
