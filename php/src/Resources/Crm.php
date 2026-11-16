<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * CRM: Prospek, CRM: Skor dan segmen
 */
final class Crm extends Resource
{
    /**
     * Pipeline pendaftaran
     *
     * Jumlah prospek per tahap (baru -> daftar_ulang), per petugas, dan tindak lanjut terlambat/hari ini. Filter petugas, prodi (minat).
     *
     * `GET /v1/crm/pipeline`
     *
     * scope: `crm:read`
     *
     * @param array{petugas?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPipeline(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/pipeline', [], $query, null, $options, false, false);
    }

    /**
     * Analisis konversi
     *
     * Prospek -> mendaftar -> diajukan -> diterima -> daftar ulang beserta persentase, dikelompokkan per sumber, kampanye, minat_prodi, petugas, kota, atau bulan. Jalankan POST /crm/sinkron dulu agar tahap mengikuti data PMB terbaru.
     *
     * `GET /v1/crm/konversi`
     *
     * scope: `crm:read`
     *
     * @param array{per?: string, dari?: string, sampai?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKonversi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/konversi', [], $query, null, $options, false, false);
    }

    /**
     * Sinkron dengan PMB
     *
     * Menautkan prospek ke akun PMB online (email/HP sama), lalu menaikkan tahap dari data pendaftaran: mendaftar, diajukan (no PMB), diterima (lulus seleksi di tabel PMB lama), daftar_ulang (sudah ber-NIM). Tahap tidak pernah diturunkan. Body {"buat_prospek": true} juga membuat prospek untuk akun PMB yang belum tercatat. Skor dihitung ulang. Cocok dijalankan berkala.
     *
     * `POST /v1/crm/sinkron`
     *
     * scope: `crm:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSinkron(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/sinkron', [], $query, null, $options, false, false);
    }

    /**
     * Hitung ulang skor semua prospek
     *
     * Setelah aturan skor diubah.
     *
     * `POST /v1/crm/skor/hitung`
     *
     * scope: `crm:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkorHitung(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/skor/hitung', [], $query, null, $options, false, false);
    }

    /**
     * Anggota segmen
     *
     * Prospek yang cocok dengan kriteria segmen, urut skor.
     *
     * `GET /v1/crm/segmen/{id}/anggota`
     *
     * scope: `crm:read` · berhalaman
     *
     * @param int|string $id ID segmen
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSegmenByIdAnggota(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/segmen/{id}/anggota', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Coba kriteria segmen
     *
     * Body {"kriteria": {"tahap": [...], "sumber": [...], "minat_prodi": [...], "minat_jalur": [...], "kota": [...], "provinsi": [...], "tahun_lulus": [...], "kampanye": [...], "petugas": [...], "label": [...], "skor_min": 0, "skor_maks": 100, "setuju_dihubungi": true}} tanpa menyimpan segmen.
     *
     * `POST /v1/crm/segmen/cari`
     *
     * scope: `crm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSegmenCari(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/segmen/cari', [], $query, null, $options, false, false);
    }

    /**
     * Impor prospek
     *
     * Body {"data": [{"nama", "email", "hp", "asal_sekolah", "npsn", "kota", "provinsi", "tahun_lulus", "minat_prodi", "minat_prodi_2", "minat_jalur", "sumber", "kampanye", "catatan"}], "sumber", "kampanye", "petugas"} (maks. 2000). Untuk data pameran/kunjungan sekolah, formulir minat landing PMB (token aplikasi crm:write), atau kanal promosi seperti Maukuliah (sumber maukuliah). Email/HP yang sudah ada tidak digandakan: data kosong dilengkapi dan dicatat sebagai interaksi masuk.
     *
     * `POST /v1/crm/impor`
     *
     * scope: `crm:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postImpor(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/impor', [], $query, null, $options, false, false);
    }

    /**
     * Bagi prospek ke petugas
     *
     * Body {"petugas": ["user1", "user2"], "prodi"?, "maks"?: 500}: prospek tanpa petugas (skor tertinggi dulu) dibagi rata ke petugas dengan beban paling sedikit.
     *
     * `POST /v1/crm/bagi`
     *
     * scope: `crm:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBagi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/bagi', [], $query, null, $options, false, false);
    }

    /**
     * Prospek calon mahasiswa: daftar
     *
     * Database prospek dan kontak (nama, HP, email, sekolah, minat prodi/jalur, sumber, kampanye). Tahap pipeline: baru -> dihubungi -> tertarik -> mendaftar -> diajukan -> diterima -> daftar_ulang (atau tidak_tertarik); tahap mendaftar ke atas diisi otomatis oleh POST /crm/sinkron dari data PMB. Skor dihitung otomatis dari /crm/skor-aturan setiap prospek/interaksi disimpan. Filter tahap, sumber, minat_prodi, petugas; q cari nama/email/HP/sekolah. Hanya pengelola modul.
     *
     * `GET /v1/crm/prospek`
     *
     * scope: `crm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, minat_prodi?: string, minat_prodi_2?: string, sumber?: string, referal_id?: string, tahap?: string, petugas?: string, setuju_dihubungi?: string, kampanye?: string, kota?: string, minat_jalur?: string, tahun_lulus?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProspek(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/prospek', [], $query, null, $options, false, false);
    }

    /**
     * Prospek calon mahasiswa: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/crm/prospek`
     *
     * scope: `crm:write`
     *
     * @param array{nama: string, email?: string, hp?: string, asal_sekolah?: string, npsn?: string, kota?: string, provinsi?: string, tahun_lulus?: int, minat_prodi?: string, minat_prodi_2?: string, minat_jalur?: string, sumber?: string, kampanye?: string, referal_id?: int, tahap?: string, petugas?: string, label?: mixed, setuju_dihubungi?: bool, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProspek(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/prospek', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prospek calon mahasiswa: detail
     *
     * Database prospek dan kontak (nama, HP, email, sekolah, minat prodi/jalur, sumber, kampanye). Tahap pipeline: baru -> dihubungi -> tertarik -> mendaftar -> diajukan -> diterima -> daftar_ulang (atau tidak_tertarik); tahap mendaftar ke atas diisi otomatis oleh POST /crm/sinkron dari data PMB. Skor dihitung otomatis dari /crm/skor-aturan setiap prospek/interaksi disimpan. Filter tahap, sumber, minat_prodi, petugas; q cari nama/email/HP/sekolah. Hanya pengelola modul.
     *
     * `GET /v1/crm/prospek/{id}`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProspekById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/prospek/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prospek calon mahasiswa: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/crm/prospek/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nama: string, email?: string, hp?: string, asal_sekolah?: string, npsn?: string, kota?: string, provinsi?: string, tahun_lulus?: int, minat_prodi?: string, minat_prodi_2?: string, minat_jalur?: string, sumber?: string, kampanye?: string, referal_id?: int, tahap?: string, petugas?: string, label?: mixed, setuju_dihubungi?: bool, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putProspekById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/crm/prospek/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prospek calon mahasiswa: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/crm/prospek/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProspekById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/crm/prospek/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prospek calon mahasiswa: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Database prospek dan kontak (nama, HP, email, sekolah, minat prodi/jalur, sumber, kampanye). Tahap pipeline: baru -> dihubungi -> tertarik -> mendaftar -> diajukan -> diterima -> daftar_ulang (atau tidak_tertarik); tahap mendaftar ke atas diisi otomatis oleh POST /crm/sinkron dari data PMB. Skor dihitung otomatis dari /crm/skor-aturan setiap prospek/interaksi disimpan. Filter tahap, sumber, minat_prodi, petugas; q cari nama/email/HP/sekolah. Hanya pengelola modul.
     *
     * `GET /v1/crm/prospek/{id}/riwayat`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProspekByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/prospek/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat interaksi prospek: daftar
     *
     * Catatan komunikasi petugas dengan prospek (telepon, WhatsApp, email, tatap muka, pameran, chat). Prospek berpindah otomatis dari tahap baru ke dihubungi; hasil tertarik/akan_daftar menaikkan tahap ke tertarik, tidak_tertarik menandai prospek tidak tertarik. Filter prospek_id, kanal, hasil. Hanya pengelola modul.
     *
     * `GET /v1/crm/interaksi`
     *
     * scope: `crm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, prospek_id?: string, kanal?: string, arah?: string, hasil?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInteraksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/interaksi', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat interaksi prospek: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/crm/interaksi`
     *
     * scope: `crm:write`
     *
     * @param array{prospek_id: int, kanal: string, arah?: string, waktu?: string, ringkasan: string, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postInteraksi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/interaksi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat interaksi prospek: detail
     *
     * Catatan komunikasi petugas dengan prospek (telepon, WhatsApp, email, tatap muka, pameran, chat). Prospek berpindah otomatis dari tahap baru ke dihubungi; hasil tertarik/akan_daftar menaikkan tahap ke tertarik, tidak_tertarik menandai prospek tidak tertarik. Filter prospek_id, kanal, hasil. Hanya pengelola modul.
     *
     * `GET /v1/crm/interaksi/{id}`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInteraksiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/interaksi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat interaksi prospek: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/crm/interaksi/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{prospek_id: int, kanal: string, arah?: string, waktu?: string, ringkasan: string, hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putInteraksiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/crm/interaksi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat interaksi prospek: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/crm/interaksi/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteInteraksiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/crm/interaksi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat interaksi prospek: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Catatan komunikasi petugas dengan prospek (telepon, WhatsApp, email, tatap muka, pameran, chat). Prospek berpindah otomatis dari tahap baru ke dihubungi; hasil tertarik/akan_daftar menaikkan tahap ke tertarik, tidak_tertarik menandai prospek tidak tertarik. Filter prospek_id, kanal, hasil. Hanya pengelola modul.
     *
     * `GET /v1/crm/interaksi/{id}/riwayat`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInteraksiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/interaksi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: daftar
     *
     * Jadwal follow-up per prospek dan petugas. Aksi selesai mencatat hasil (dan otomatis menjadi interaksi). Jadwal terdekat yang masih terjadwal ditampilkan di prospek (tindak_lanjut_berikut). Filter status, petugas, prospek_id; dari/sampai = tanggal jadwal. Hanya pengelola modul.
     *
     * `GET /v1/crm/tindak-lanjut`
     *
     * scope: `crm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, prospek_id?: string, kanal?: string, petugas?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTindakLanjut(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/tindak-lanjut', [], $query, null, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/crm/tindak-lanjut`
     *
     * scope: `crm:write`
     *
     * @param array{prospek_id: int, jadwal: string, kanal?: string, tujuan: string, petugas?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTindakLanjut(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/tindak-lanjut', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: detail
     *
     * Jadwal follow-up per prospek dan petugas. Aksi selesai mencatat hasil (dan otomatis menjadi interaksi). Jadwal terdekat yang masih terjadwal ditampilkan di prospek (tindak_lanjut_berikut). Filter status, petugas, prospek_id; dari/sampai = tanggal jadwal. Hanya pengelola modul.
     *
     * `GET /v1/crm/tindak-lanjut/{id}`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTindakLanjutById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/tindak-lanjut/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/crm/tindak-lanjut/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{prospek_id: int, jadwal: string, kanal?: string, tujuan: string, petugas?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putTindakLanjutById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/crm/tindak-lanjut/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/crm/tindak-lanjut/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteTindakLanjutById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/crm/tindak-lanjut/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Jadwal follow-up per prospek dan petugas. Aksi selesai mencatat hasil (dan otomatis menjadi interaksi). Jadwal terdekat yang masih terjadwal ditampilkan di prospek (tindak_lanjut_berikut). Filter status, petugas, prospek_id; dari/sampai = tanggal jadwal. Hanya pengelola modul.
     *
     * `GET /v1/crm/tindak-lanjut/{id}/riwayat`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTindakLanjutByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/tindak-lanjut/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: Tandai selesai
     *
     * Pengelola modul. Status harus terjadwal, menjadi selesai.
     *
     * `POST /v1/crm/tindak-lanjut/{id}/selesai`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{hasil: string, hasil_interaksi?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTindakLanjutByIdSelesai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/tindak-lanjut/{id}/selesai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tindak lanjut prospek: Batalkan
     *
     * Pengelola modul. Status harus terjadwal, menjadi batal.
     *
     * `POST /v1/crm/tindak-lanjut/{id}/batal`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{hasil?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postTindakLanjutByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/tindak-lanjut/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan lead scoring: daftar
     *
     * Poin ditambahkan ke skor prospek bila kriteria cocok: sumber/tahap/minat_prodi/minat_jalur/kota/tahun_lulus/label = nilai; ada_email, ada_hp, punya_akun_pmb (nilai kosong); jumlah_interaksi >= nilai; hasil_interaksi = hasil interaksi mana pun. Poin boleh negatif; skor akhir 0..65535. Hitung ulang semua: POST /crm/skor/hitung. Hanya pengelola modul.
     *
     * `GET /v1/crm/skor-aturan`
     *
     * scope: `crm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, kriteria?: string, aktif?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkorAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/skor-aturan', [], $query, null, $options, false, false);
    }

    /**
     * Aturan lead scoring: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/crm/skor-aturan`
     *
     * scope: `crm:write`
     *
     * @param array{kriteria: string, nilai?: string, poin: int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSkorAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/skor-aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan lead scoring: detail
     *
     * Poin ditambahkan ke skor prospek bila kriteria cocok: sumber/tahap/minat_prodi/minat_jalur/kota/tahun_lulus/label = nilai; ada_email, ada_hp, punya_akun_pmb (nilai kosong); jumlah_interaksi >= nilai; hasil_interaksi = hasil interaksi mana pun. Poin boleh negatif; skor akhir 0..65535. Hitung ulang semua: POST /crm/skor/hitung. Hanya pengelola modul.
     *
     * `GET /v1/crm/skor-aturan/{id}`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkorAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/skor-aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan lead scoring: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/crm/skor-aturan/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{kriteria: string, nilai?: string, poin: int, keterangan?: string, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSkorAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/crm/skor-aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan lead scoring: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/crm/skor-aturan/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSkorAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/crm/skor-aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan lead scoring: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Poin ditambahkan ke skor prospek bila kriteria cocok: sumber/tahap/minat_prodi/minat_jalur/kota/tahun_lulus/label = nilai; ada_email, ada_hp, punya_akun_pmb (nilai kosong); jumlah_interaksi >= nilai; hasil_interaksi = hasil interaksi mana pun. Poin boleh negatif; skor akhir 0..65535. Hitung ulang semua: POST /crm/skor/hitung. Hanya pengelola modul.
     *
     * `GET /v1/crm/skor-aturan/{id}/riwayat`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSkorAturanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/skor-aturan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Segmen prospek: daftar
     *
     * Kriteria tersimpan untuk mengelompokkan prospek (minat, prodi, sumber, kota, tahun lulus, label, rentang skor, tahap). Anggota: GET /crm/segmen/{id}/anggota. Hanya pengelola modul.
     *
     * `GET /v1/crm/segmen`
     *
     * scope: `crm:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSegmen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/segmen', [], $query, null, $options, false, false);
    }

    /**
     * Segmen prospek: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/crm/segmen`
     *
     * scope: `crm:write`
     *
     * @param array{nama: string, keterangan?: string, kriteria: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSegmen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/crm/segmen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Segmen prospek: detail
     *
     * Kriteria tersimpan untuk mengelompokkan prospek (minat, prodi, sumber, kota, tahun lulus, label, rentang skor, tahap). Anggota: GET /crm/segmen/{id}/anggota. Hanya pengelola modul.
     *
     * `GET /v1/crm/segmen/{id}`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSegmenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/segmen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Segmen prospek: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/crm/segmen/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nama: string, keterangan?: string, kriteria: array<string, mixed>, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSegmenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/crm/segmen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Segmen prospek: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/crm/segmen/{id}`
     *
     * scope: `crm:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSegmenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/crm/segmen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Segmen prospek: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Kriteria tersimpan untuk mengelompokkan prospek (minat, prodi, sumber, kota, tahun lulus, label, rentang skor, tahap). Anggota: GET /crm/segmen/{id}/anggota. Hanya pengelola modul.
     *
     * `GET /v1/crm/segmen/{id}/riwayat`
     *
     * scope: `crm:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSegmenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/crm/segmen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }
}
