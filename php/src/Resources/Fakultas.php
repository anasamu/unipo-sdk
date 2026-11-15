<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Fakultas, Fakultas: kelola akademik
 */
final class Fakultas extends Resource
{
    /**
     * Daftar fakultas
     *
     * Publik. Fakultas, prodi + akreditasi, singkatan, situs portal, dan domain; dipakai aplikasi fakultas untuk mengenali fakultas dari subdomain.
     *
     * `GET /v1/fakultas`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas', [], $query, null, $options, false, true);
    }

    /**
     * Fakultas dalam angka
     *
     * Publik, hanya jumlah agregat: prodi, mahasiswa aktif, dosen aktif, lulusan (total dan per prodi). Dipakai halaman depan aplikasi fakultas, juga bila situs portal fakultas belum didaftarkan.
     *
     * `GET /v1/fakultas/{kode}/angka`
     *
     * publik (tanpa token)
     *
     * @param int|string $kode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeAngka(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/angka', ['kode' => $kode], $query, null, $options, false, true);
    }

    /**
     * Konteks & hak akses saya
     *
     * Fakultas, prodi, peran yang berlaku di fakultas ini, izin fakultas.* beserta prodi yang boleh dilihat, tahun akademik aktif. 403 bila tidak punya fakultas.akses.
     *
     * `GET /v1/fakultas/{kode}/saya`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeSaya(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/saya', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Beranda dasbor
     *
     * Angka per prodi (mahasiswa aktif, KRS, lulusan, dosen, rasio, EWS), tren 8 semester, ringkasan tugas akhir, agenda, surat; untuk dosen: kelas diampu dan bimbingan.
     *
     * `GET /v1/fakultas/{kode}/ringkasan`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeRingkasan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ringkasan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Statistik
     *
     * jenis: mahasiswa (status, prodi, angkatan, gender, asal sekolah, semester), dosen (jabatan, pendidikan, ikatan kerja), akademik (sebaran IPS & nilai, tren IPS), lulusan (per tahun, IPK, masa studi, cumlaude), krs (tren), pmb. Izin fakultas.statistik.
     *
     * `GET /v1/fakultas/{kode}/statistik/{jenis}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $jenis mahasiswa|dosen|akademik|lulusan|krs|pmb
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeStatistikByJenis(int|string $kode, int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/statistik/{jenis}', ['kode' => $kode, 'jenis' => $jenis], $query, null, $options, false, false);
    }

    /**
     * Daftar mahasiswa
     *
     * Izin fakultas.mahasiswa; dosen tanpa izin itu (fakultas.pribadi) hanya melihat mahasiswa bimbingan PA-nya (meta.mode = pribadi).
     *
     * `GET /v1/fakultas/{kode}/mahasiswa`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{q?: string, status?: string, angkatan?: string, page?: int, per_page?: int, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeMahasiswa(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/mahasiswa', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Profil akademik mahasiswa
     *
     * Biodata ringkas, IPK, KHS per semester, riwayat status, tugas akhir, KRS semester ini; ?tahun_id= menambah KHS rinci semester itu.
     *
     * `GET /v1/fakultas/{kode}/mahasiswa/{nim}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeMahasiswaByNim(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/mahasiswa/{nim}', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Daftar dosen
     *
     * Dengan jabatan akademik, jumlah bimbingan PA, kelas semester ini, bimbingan tugas akhir. Izin fakultas.dosen.
     *
     * `GET /v1/fakultas/{kode}/dosen`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{q?: string, status?: string, page?: int, per_page?: int, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeDosen(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/dosen', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Perkuliahan dan jadwal
     *
     * Kelas per tahun akademik: mata kuliah, dosen, hari/jam, ruang, peserta, pertemuan tercatat, nilai belum masuk. Dosen (pribadi): kelas yang diampu.
     *
     * `GET /v1/fakultas/{kode}/perkuliahan`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, hari?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodePerkuliahan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/perkuliahan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Pantauan LMS
     *
     * Per jadwal kuliah: kelas LMS (bila sudah dibuat), jumlah materi/tugas/kuis/forum/sesi presensi, jawaban belum dinilai, pengguna aktif 7 hari, aktivitas terakhir. Izin fakultas.perkuliahan; dosen (pribadi): kelas yang diampu.
     *
     * `GET /v1/fakultas/{kode}/lms`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeLms(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/lms', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Rekap KRS
     *
     * Per prodi: mahasiswa aktif, mengisi, disetujui, menunggu, belum; daftar belum KRS dan menunggu persetujuan; sebaran SKS.
     *
     * `GET /v1/fakultas/{kode}/krs`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeKrs(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/krs', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * KHS dan nilai
     *
     * Per kelas: peserta, belum dinilai, rata-rata, tidak lulus; sebaran nilai; mahasiswa IPS < 2.
     *
     * `GET /v1/fakultas/{kode}/khs`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeKhs(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/khs', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Kurikulum
     *
     * Mata kuliah per prodi per semester (m_mata_kuliah) dan kurikulum OBE (kurikulum_prodi).
     *
     * `GET /v1/fakultas/{kode}/kurikulum`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeKurikulum(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/kurikulum', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ujian proposal dan skripsi
     *
     * jenis: proposal (ada tanggal seminar), skripsi (ada tanggal ujian), bimbingan (belum ujian), semua. Dosen (pribadi): sebagai pembimbing/penguji.
     *
     * `GET /v1/fakultas/{kode}/tugas-akhir`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{jenis?: string, tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeTugasAkhir(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/tugas-akhir', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Wisuda
     *
     * Periode wisuda dan pendaftar wisuda prodi fakultas.
     *
     * `GET /v1/fakultas/{kode}/wisuda`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeWisuda(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/wisuda', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Alumni
     *
     * Lulusan dengan IPK, tanggal lulus, status terkini tracer (kontak hanya bila alumni bersedia).
     *
     * `GET /v1/fakultas/{kode}/alumni`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{q?: string, tahun?: string, page?: int, per_page?: int, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeAlumni(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/alumni', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Data PMB
     *
     * Pendaftar yang memilih prodi fakultas: per periode (daftar, bayar, lulus, daftar ulang), per prodi, asal sekolah, pendaftar terbaru.
     *
     * `GET /v1/fakultas/{kode}/pmb`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodePmb(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/pmb', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tracer study
     *
     * Periode tracer dan tingkat respons alumni prodi fakultas, status alumni.
     *
     * `GET /v1/fakultas/{kode}/tracer`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeTracer(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/tracer', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Data modul unit fakultas
     *
     * jenis: surat (arsip surat masuk/keluar unit fakultas + disposisi), kepegawaian (sdm_pegawai), spmi (dokumen + temuan), lppm (usulan penelitian/pengabdian), lms (kelas), cbt (ujian), kalender (kegiatan unit). Hanya baca; ubah data lewat API modulnya.
     *
     * `GET /v1/fakultas/{kode}/modul/{jenis}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $jenis surat|kepegawaian|spmi|lppm|lms|cbt|kalender
     * @param array{q?: string, arah?: string, jenis?: string, tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeModulByJenis(int|string $kode, int|string $jenis, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/modul/{jenis}', ['kode' => $kode, 'jenis' => $jenis], $query, null, $options, false, false);
    }

    /**
     * Referensi form jadwal
     *
     * Mata kuliah, kelas, ruang, hari, jam, dosen aktif, kampus, periode. Izin fakultas.jadwal.kelola.
     *
     * `GET /v1/fakultas/{kode}/jadwal/referensi`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeJadwalReferensi(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/jadwal/referensi', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Daftar jadwal kuliah prodi
     *
     * Jadwal per periode dengan jam, dosen + tim, peserta, bisa_dihapus. Izin fakultas.jadwal.kelola.
     *
     * `GET /v1/fakultas/{kode}/jadwal`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeJadwal(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/jadwal', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah jadwal
     *
     * Body: {"kode_mk", "kelas", "ruang", "kapasitas", "hari", "jamke", "nidn"}. Validasi SIAKAD (bentrok ruang/dosen, jadwal ganda) dikembalikan sebagai 409 dengan pesan.
     *
     * `POST /v1/fakultas/{kode}/jadwal`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwal(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus jadwal
     *
     * Body: {"id": [12, 13]}. Jadwal yang sudah dipakai KRS dilewati.
     *
     * `POST /v1/fakultas/{kode}/jadwal/hapus`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwalHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Salin jadwal dari periode lain
     *
     * Body: {"sumber": "20242"}. Lewat JadwalKuliahService::salin.
     *
     * `POST /v1/fakultas/{kode}/jadwal/salin`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwalSalin(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal/salin', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah jadwal
     *
     * Body sama dengan tambah jadwal.
     *
     * `POST /v1/fakultas/{kode}/jadwal/{idj}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $idj ID jadwal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwalByIdj(int|string $kode, int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal/{idj}', ['kode' => $kode, 'idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Atur tim dosen
     *
     * Body: {"nidn": ["0905011", ...]} (kosong = hapus tim).
     *
     * `POST /v1/fakultas/{kode}/jadwal/{idj}/tim`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $idj ID jadwal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwalByIdjTim(int|string $kode, int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal/{idj}/tim', ['kode' => $kode, 'idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Data kelas prodi
     *
     * m_kelas + jumlah jadwal dan mahasiswa. Izin fakultas.jadwal.kelola.
     *
     * `GET /v1/fakultas/{kode}/kelas`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeKelas(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/kelas', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah kelas
     *
     * Body: {"kelas": "A", "kode_kelas": "01", "kampus": "01"}.
     *
     * `POST /v1/fakultas/{kode}/kelas`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeKelas(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/kelas', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah kelas
     *
     * Body sama dengan tambah kelas.
     *
     * `POST /v1/fakultas/{kode}/kelas/{idk}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $idk ID kelas
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeKelasByIdk(int|string $kode, int|string $idk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/kelas/{idk}', ['kode' => $kode, 'idk' => $idk], $query, null, $options, false, false);
    }

    /**
     * Hapus kelas
     *
     * Ditolak bila kelas masih dipakai jadwal/mahasiswa.
     *
     * `POST /v1/fakultas/{kode}/kelas/{idk}/hapus`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $idk ID kelas
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeKelasByIdkHapus(int|string $kode, int|string $idk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/kelas/{idk}/hapus', ['kode' => $kode, 'idk' => $idk], $query, null, $options, false, false);
    }

    /**
     * Antrian persetujuan KRS
     *
     * Mahasiswa aktif dengan status KRS (belum isi, menunggu, disetujui) + ringkasan. Izin fakultas.krs.kelola; dosen (pribadi) = mahasiswa bimbingan PA.
     *
     * `GET /v1/fakultas/{kode}/krs/persetujuan`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, status?: string, q?: string, angkatan?: string, page?: int, per_page?: int, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeKrsPersetujuan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/krs/persetujuan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Setujui KRS banyak mahasiswa
     *
     * Body: {"nim": ["..."], "tahun_id": "20251"} (maks. 200).
     *
     * `POST /v1/fakultas/{kode}/krs/persetujuan`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeKrsPersetujuan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/krs/persetujuan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * KRS satu mahasiswa
     *
     * Mata kuliah diambil + jadwal, batas SKS, riwayat IPS, pesan PA.
     *
     * `GET /v1/fakultas/{kode}/krs/persetujuan/{nim}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeKrsPersetujuanByNim(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/krs/persetujuan/{nim}', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Setujui/batalkan KRS
     *
     * Body: {"setuju": true|false, "tahun_id"}. Lewat view_insert_krs_terima (sama dengan menu Terima KRS).
     *
     * `POST /v1/fakultas/{kode}/krs/persetujuan/{nim}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeKrsPersetujuanByNim(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/krs/persetujuan/{nim}', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Hapus mata kuliah dari KRS
     *
     * Body: {"idkrs": 123}. Ditolak bila sudah bernilai.
     *
     * `POST /v1/fakultas/{kode}/krs/persetujuan/{nim}/hapus-mk`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeKrsPersetujuanByNimHapusMk(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/krs/persetujuan/{nim}/hapus-mk', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kirim pesan KRS
     *
     * Body: {"pesan": "...", "tahun_id"}.
     *
     * `POST /v1/fakultas/{kode}/krs/persetujuan/{nim}/pesan`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeKrsPersetujuanByNimPesan(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/krs/persetujuan/{nim}/pesan', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kelas untuk input nilai
     *
     * Peserta dan jumlah bernilai per kelas. Izin fakultas.nilai.kelola; dosen (pribadi) = kelas yang diampu/tim.
     *
     * `GET /v1/fakultas/{kode}/nilai/kelas`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiKelas(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/kelas', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tabel nilai kelas
     *
     * Persentase komponen, nilai harian/tugas/UTS/UAS per mahasiswa, nilai akhir, distribusi, skala, batas input.
     *
     * `GET /v1/fakultas/{kode}/nilai/kelas/{idj}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $idj ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiKelasByIdj(int|string $kode, int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/kelas/{idj}', ['kode' => $kode, 'idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Simpan nilai kelas
     *
     * Body: {"persen": {"Harian": 10, "Tugas": 20, "UTS": 30, "UAS": 40}, "nilai": [{"idkrs": 1, "jenis": "UTS", "ke": 1, "nilai": 80}]}. Nilai akhir dihitung ulang (HitungNilaiAngka). Hanya dalam batas tanggal input nilai.
     *
     * `POST /v1/fakultas/{kode}/nilai/kelas/{idj}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $idj ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeNilaiKelasByIdj(int|string $kode, int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/nilai/kelas/{idj}', ['kode' => $kode, 'idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Detail mahasiswa per bagian
     *
     * bagian: biodata, tren-ip, khs, periode-khs, transkrip, keuangan, jadwal (+ rekap presensi). Pemegang fakultas.mahasiswa, dosen PA, atau mahasiswa itu sendiri.
     *
     * `GET /v1/fakultas/{kode}/mahasiswa/{nim}/{bagian}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param int|string $bagian biodata|tren-ip|khs|periode-khs|transkrip|keuangan|jadwal
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeMahasiswaByNimByBagian(int|string $kode, int|string $nim, int|string $bagian, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/mahasiswa/{nim}/{bagian}', ['kode' => $kode, 'nim' => $nim, 'bagian' => $bagian], $query, null, $options, false, false);
    }

    /**
     * Detail dosen
     *
     * Profil, mengajar semester ini + riwayat, bimbingan PA, tugas akhir, kepegawaian (sdm_*), penelitian/pengabdian (lppm_*). Izin fakultas.dosen atau dosen itu sendiri.
     *
     * `GET /v1/fakultas/{kode}/dosen/{nidn}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nidn NIDN
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeDosenByNidn(int|string $kode, int|string $nidn, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/dosen/{nidn}', ['kode' => $kode, 'nidn' => $nidn], $query, null, $options, false, false);
    }

    /**
     * Beranda mahasiswa
     *
     * Profil, KRS semester aktif, IPK + tren, jadwal minggu ini. Izin fakultas.mahasiswa.saya (akun mahasiswa). Isi KRS memakai /v1/mahasiswa/{nim}/krs.
     *
     * `GET /v1/fakultas/{kode}/ruang-mahasiswa`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeRuangMahasiswa(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ruang-mahasiswa', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Pengaturan akses fakultas
     *
     * Pejabat dan pemegang peran tendik/operator di fakultas dan prodinya, isi izin peran. Izin fakultas.pengaturan.
     *
     * `GET /v1/fakultas/{kode}/akses`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeAkses(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/akses', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Beri peran tendik/operator
     *
     * Body: {"username": "K0501", "peran": "tendik-fakultas|operator-fakultas", "prodi": "55201" (kosong = seluruh fakultas), "selesai": "2027-12-31", "nomor_sk": "..."}. Izin fakultas.pengaturan.
     *
     * `POST /v1/fakultas/{kode}/akses`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeAkses(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/akses', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Calon penerima peran
     *
     * Akun SIAKAD aktif milik dosen/karyawan fakultas ini, untuk isian pilih pengguna (pemberian peran, pengelola portal). Izin fakultas.pengaturan atau fakultas.portal.
     *
     * `GET /v1/fakultas/{kode}/akses/calon`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{q?: string, username?: string, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeAksesCalon(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/akses/calon', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Cabut peran tendik/operator
     *
     * Izin fakultas.pengaturan.
     *
     * `POST /v1/fakultas/{kode}/akses/{id}/cabut`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID penugasan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeAksesByIdCabut(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/akses/{id}/cabut', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }
}
