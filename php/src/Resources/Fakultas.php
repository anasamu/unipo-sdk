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
     * Direktori dosen (publik)
     *
     * Dosen aktif di prodi fakultas ini: NIDN, nama + gelar, prodi, jabatan akademik (tanpa data pribadi). Dipakai portal fakultas bila situs portal belum didaftarkan.
     *
     * `GET /v1/fakultas/{kode}/dosen-publik`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param int|string $kode
     * @param array{prodi?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeDosenPublik(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/dosen-publik', ['kode' => $kode], $query, null, $options, false, true);
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
     * Struktur organisasi fakultas
     *
     * Unit fakultas (atau `prodi`) beserta sub-unitnya yang aktif, pejabat aktif (termasuk Plt/Plh), dan jabatan lazim yang belum diisi (pejabat = null), serta tendik/staf per unit (`tendik`), dari Organisasi & pejabat Pustikom. Izin fakultas.akses.
     *
     * `GET /v1/fakultas/{kode}/struktur`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeStruktur(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/struktur', ['kode' => $kode], $query, null, $options, false, false);
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
     * Daftar kurikulum SIAKAD (m_kurikulum per tahun), mata kuliah kurikulum terpilih per semester (m_mata_kuliah, bawaan kurikulum terbaru; detail SKS, jenis, kelompok, pengampu, kelengkapan silabus/SAP/bahan ajar), dan kurikulum OBE (kurikulum_prodi).
     *
     * `GET /v1/fakultas/{kode}/kurikulum`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_kurikulum?: string, prodi?: string, ...} $query
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
     * Unit keuangan saya
     *
     * Unit induk (fakultas dan prodi) yang boleh dilihat untuk keuangan fakultas (izin fakultas.keuangan), dengan tanda kelola (fakultas.keuangan.kelola). Dekan/operator: fakultas + semua prodi; kaprodi: prodinya. Data keuangan sendiri lewat /v1/keu.
     *
     * `GET /v1/fakultas/{kode}/keuangan/unit`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeKeuanganUnit(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/keuangan/unit', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Unit sarpras saya
     *
     * Unit induk (fakultas dan prodi) untuk sarana prasarana fakultas (izin fakultas.sarpras), dengan tanda kelola (fakultas.sarpras.kelola: catat aset, gedung, ruang unit dan putuskan peminjamannya). Unit fakultas hanya untuk yang berwenang di semua prodi. Data sarpras sendiri lewat /v1/sarpras.
     *
     * `GET /v1/fakultas/{kode}/sarpras/unit`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeSarprasUnit(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/sarpras/unit', ['kode' => $kode], $query, null, $options, false, false);
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
     * Cek jadwal bentrok
     *
     * Bentrok jadwal prodi terhadap semua prodi (ruang, dosen, rombongan kelas, mahasiswa KRS) + peringatan pindah kampus/ruang kampus lain. Sama dengan /v1/akademik/jadwal/bentrok. Izin fakultas.jadwal.kelola.
     *
     * `GET /v1/fakultas/{kode}/jadwal/bentrok`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{jeda_kampus?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeJadwalBentrok(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/jadwal/bentrok', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Cek satu jadwal sebelum disimpan
     *
     * Body sama dengan tambah/ubah jadwal (+ "id" saat ubah). Tidak menyimpan.
     *
     * `POST /v1/fakultas/{kode}/jadwal/cek`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $body
     * @param array{query?: array{prodi?: string, tahun_id?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwalCek(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal/cek', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pratinjau jadwal otomatis
     *
     * Tidak menyimpan. Body sama dengan /v1/akademik/jadwal/otomatis.
     *
     * `POST /v1/fakultas/{kode}/jadwal/otomatis`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{sumber?: string, dari_tahun_id?: string, hari?: list<mixed>, kelas?: list<mixed>, jeda_kampus?: int, menit_per_sks?: int, batas_sore?: string, ...} $body
     * @param array{query?: array{prodi?: string, tahun_id?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwalOtomatis(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal/otomatis', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Simpan usulan jadwal otomatis
     *
     * Body: {"usulan": [...]} dari pratinjau. Diperiksa ulang lalu disimpan lewat JadwalKuliahService.
     *
     * `POST /v1/fakultas/{kode}/jadwal/otomatis/simpan`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{usulan: list<mixed>, ...} $body
     * @param array{query?: array{prodi?: string, tahun_id?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeJadwalOtomatisSimpan(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/jadwal/otomatis/simpan', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
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
     * Referensi form mata kuliah
     *
     * Kelompok, kurikulum, status, jenis, jenis substansi (r_kode), dosen aktif, konsentrasi prodi, semester (batas sesi prodi), periode beserta jumlah MK.
     *
     * `GET /v1/fakultas/{kode}/matakuliah/referensi`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeMatakuliahReferensi(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/matakuliah/referensi', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Mata kuliah prodi per periode
     *
     * m_mata_kuliah satu prodi dan periode (?tahun_id=, bawaan tahun aktif) lengkap dengan prasyarat, pemakaian (jadwal, KRS, bernilai), terkunci (periode|bernilai|obe), bisa_dihapus, padanan kurikulum OBE, kode yang juga dipakai prodi lain. Izin fakultas.kurikulum (lihat) atau fakultas.matakuliah.kelola.
     *
     * `GET /v1/fakultas/{kode}/matakuliah`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeMatakuliah(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/matakuliah', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah mata kuliah
     *
     * Body: {"kode_mk", "nama_mk", "nama_en", "semester", "sks_teori", "sks_praktek", "sks_lapangan", "sks_simulasi", "jenis", "kelompok", "kurikulum", "status", "jenis_substansi", "substansi", "metode", "nidn", "pertemuan", "silabus", "sap", "bahan_ajar", "diktat", "acara_praktik" (Y/N), "konsentrasi", "no_urut"}. Lewat KurikulumService (halaman Master Mata Kuliah).
     *
     * `POST /v1/fakultas/{kode}/matakuliah`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeMatakuliah(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/matakuliah', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus mata kuliah
     *
     * Body: {"id": [1, 2]}. Hanya MK yang belum dipakai jadwal/KRS/nilai/presensi, bukan prasyarat MK lain, dan bukan hasil terbit kurikulum OBE; sisanya dikembalikan di "ditolak". Periode lalu ditolak.
     *
     * `POST /v1/fakultas/{kode}/matakuliah/hapus`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeMatakuliahHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/matakuliah/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Salin mata kuliah dari periode lain
     *
     * Body: {"sumber": "20241", "kode_mk": ["MK01"] (opsional)}. Hanya menambah MK yang belum ada beserta prasyaratnya; MK yang sudah ada tidak diubah.
     *
     * `POST /v1/fakultas/{kode}/matakuliah/salin`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeMatakuliahSalin(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/matakuliah/salin', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah mata kuliah
     *
     * Body sama dengan tambah; kolom yang tidak dikirim tetap. Kode/SKS/semester terkunci bila sudah bernilai atau berasal dari terbit kurikulum OBE; bila sudah dipakai jadwal/KRS, perubahan ikut diterapkan ke jadwal dan KRS periode itu.
     *
     * `POST /v1/fakultas/{kode}/matakuliah/{id}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID mata kuliah
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeMatakuliahById(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/matakuliah/{id}', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Atur prasyarat mata kuliah
     *
     * Body: {"syarat": [id, ...]} (kosong = tanpa prasyarat). Hanya MK prodi dan periode yang sama, tidak melingkar; max_sks dihitung ulang.
     *
     * `POST /v1/fakultas/{kode}/matakuliah/{id}/prasyarat`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID mata kuliah
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeMatakuliahByIdPrasyarat(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/matakuliah/{id}/prasyarat', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Referensi dosen PA
     *
     * Dosen aktif (prodi ini dulu) beserta beban bimbingan PA (mahasiswa aktif/cuti/non-aktif semua prodi), angkatan, status.
     *
     * `GET /v1/fakultas/{kode}/pa/referensi`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodePaReferensi(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/pa/referensi', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa dan dosen PA
     *
     * Mahasiswa prodi dengan PA-nya + ringkasan (tanpa PA, PA tidak aktif, beban per dosen). Izin fakultas.mahasiswa atau fakultas.pa.kelola.
     *
     * `GET /v1/fakultas/{kode}/pa`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{angkatan?: string, status?: string, pa?: string, q?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodePa(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/pa', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tetapkan dosen PA
     *
     * Body: {"nim": ["..."], "nidn": "..."} (maks. 500). Hanya dosen aktif; mahasiswa lulus/DO/keluar atau prodi lain ditolak. Lewat PenasehatRepository (halaman Penasehat Akademik).
     *
     * `POST /v1/fakultas/{kode}/pa`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodePa(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/pa', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Bagi PA merata
     *
     * Body: {"nim": [...], "dosen": ["NIDN", ...], "simpan": false}. Tiap mahasiswa diberikan ke dosen terpilih yang bebannya paling sedikit. simpan=false hanya pratinjau.
     *
     * `POST /v1/fakultas/{kode}/pa/bagi-rata`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodePaBagiRata(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/pa/bagi-rata', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Referensi jadwal ujian
     *
     * Kelas kuliah periode (MK, kelas, pengampu, ruang, peserta), jam, ruang, dosen aktif, rentang UTS/UAS periode, syarat kartu.
     *
     * `GET /v1/fakultas/{kode}/ujian/referensi`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeUjianReferensi(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ujian/referensi', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Kartu ujian
     *
     * Mahasiswa ber-KRS disetujui + jadwal ujian MK-nya + kelayakan (status semester, lulus/DO, batas studi, pembayaran, presensi UAS) dengan alasannya.
     *
     * `GET /v1/fakultas/{kode}/ujian/kartu`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{ujian?: string, kelas?: string, angkatan?: string, q?: string, nim?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeUjianKartu(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ujian/kartu', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Jadwal ujian prodi
     *
     * Jadwal UTS/UAS satu periode: MK, kelas, tanggal, jam, ruang, pengawas, kapasitas, peserta + ringkasan kelas belum terjadwal.
     *
     * `GET /v1/fakultas/{kode}/ujian`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{ujian?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeUjian(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ujian', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah jadwal ujian
     *
     * Body: {"ujian": "uts|uas", "kode_mk", "kelas", "tanggal", "jamke", "ruang", "kapasitas", "nidn1", "nidn2"}. Bentrok pengawas/ruang/kelas/mahasiswa = 409; tanggal wajib di masa UTS/UAS periode bila diatur; kapasitas >= peserta.
     *
     * `POST /v1/fakultas/{kode}/ujian`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeUjian(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/ujian', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus jadwal ujian
     *
     * Body: {"id": [1, 2]}. Periode lalu ditolak.
     *
     * `POST /v1/fakultas/{kode}/ujian/hapus`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeUjianHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/ujian/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah jadwal ujian
     *
     * Body sama dengan tambah; kelas tidak bisa diubah. Bentrok diperiksa ulang (kecuali dirinya).
     *
     * `POST /v1/fakultas/{kode}/ujian/{id}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID jadwal ujian
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeUjianById(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/ujian/{id}', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar hadir ujian
     *
     * Peserta (KRS disetujui) satu jadwal ujian + ruang/meja + kelayakan + kop dokumen.
     *
     * `GET /v1/fakultas/{kode}/ujian/{id}/peserta`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID jadwal ujian
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeUjianByIdPeserta(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ujian/{id}/peserta', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Atur nomor meja
     *
     * Nomor meja 1..n urut NIM untuk peserta jadwal ini (t_mahasiswa_krs uts_/uas_ruang + meja, lewat KartuUjianRepository).
     *
     * `POST /v1/fakultas/{kode}/ujian/{id}/meja`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID jadwal ujian
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeUjianByIdMeja(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/ujian/{id}/meja', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rekap presensi prodi
     *
     * Kehadiran per kelas kuliah dan per mahasiswa (jam hadir / jam mengajar dosen pengampu), MK di bawah batas, SP terakhir dan SP berikutnya. Batas dari m_tahun.min_presensi (0 = acuan 75%).
     *
     * `GET /v1/fakultas/{kode}/presensi/rekap`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{kode_mk?: string, kelas?: string, q?: string, bawah?: string, batas?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodePresensiRekap(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/presensi/rekap', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Riwayat SP kehadiran
     *
     * SP prodi satu periode (atau satu mahasiswa lewat ?nim=) + kop surat.
     *
     * `GET /v1/fakultas/{kode}/presensi/sp`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{nim?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodePresensiSp(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/presensi/sp', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Terbitkan SP kehadiran
     *
     * Body: {"nim": [...], "batas": 75 (opsional), "catatan", "tanggal"}. Tingkat naik otomatis (SP1–SP3) per periode; hanya mahasiswa dengan MK di bawah batas.
     *
     * `POST /v1/fakultas/{kode}/presensi/sp`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodePresensiSp(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/presensi/sp', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Batalkan SP
     *
     * Body: {"alasan": "..."}. Hanya SP tingkat tertinggi yang berlaku.
     *
     * `POST /v1/fakultas/{kode}/presensi/sp/{id}/batal`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID SP
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodePresensiSpByIdBatal(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/presensi/sp/{id}/batal', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat perbaikan nilai
     *
     * Perbaikan nilai prodi (nilai lama → baru, alasan, pelaku). Filter ?nim= dan ?tahun_id=.
     *
     * `GET /v1/fakultas/{kode}/nilai/perbaikan`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{nim?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiPerbaikan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/perbaikan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Perbaiki nilai
     *
     * Body: {"nim", "idkrs", "nilai": "A", "alasan"}. Hanya KRS periode aktif (periode lalu lewat BAAK), mahasiswa belum lulus/keluar, nilai dari skala m_nilai; lewat KhsEditService level PROGDI dan tercatat di riwayat.
     *
     * `POST /v1/fakultas/{kode}/nilai/perbaikan`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeNilaiPerbaikan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/nilai/perbaikan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Koreksi nilai dekan: masa input per prodi
     *
     * Status masa input nilai dosen dan prodi per prodi fakultas untuk ?tahun_id= (bawaan periode aktif): tahap belum_dibuka/dibuka/berakhir, mulai, selesai, sumber tabel_lama/aturan, berakhir (keduanya berakhir), pesan alasan bila dekan belum boleh, plus pilihan periode. Dekan boleh mengajukan koreksi hanya bila berakhir = true.
     *
     * `GET /v1/fakultas/{kode}/nilai/koreksi/masa`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiKoreksiMasa(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/koreksi/masa', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Koreksi nilai dekan: kelas
     *
     * Kelas (t_jadwal) satu prodi pada ?tahun_id=: mata kuliah, dosen, peserta, bernilai, masa_input_ditutup dan masa_input_berakhir per kelas (kampus kelas).
     *
     * `GET /v1/fakultas/{kode}/nilai/koreksi/kelas`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{tahun_id?: string, q?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiKoreksiKelas(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/koreksi/kelas', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Koreksi nilai dekan: peserta kelas
     *
     * Peserta KRS disetujui dengan nilai sekarang, pengajuan yang masih menunggu, boleh_ajukan + alasan_tidak_boleh, skala m_nilai, dan masa input kelas.
     *
     * `GET /v1/fakultas/{kode}/nilai/koreksi/kelas/{idj}`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $idj ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiKoreksiKelasByIdj(int|string $kode, int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/koreksi/kelas/{idj}', ['kode' => $kode, 'idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Koreksi nilai dekan: pengajuan saya
     *
     * Pengajuan koreksi milik akun ini (peran_pengaju dekan) beserta status, catatan BAAK, dan hasil. meta.ringkasan = jumlah per status.
     *
     * `GET /v1/fakultas/{kode}/nilai/koreksi/pengajuan`
     *
     * scope: `fakultas:read` · hanya token pengguna · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiKoreksiPengajuan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/koreksi/pengajuan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Koreksi nilai dekan: ajukan
     *
     * Body: {"idkrs": 123, "nilai_baru": "B" | "nilai_angka_baru": 78, "alasan": "...", "lampiran": ["<uuid /v1/berkas>"]}. Prasyarat sama dengan /v1/akademik/nilai/perbaikan; 409 masa_input_dibuka bila masa input nilai dosen/prodi masih dibuka, 409 masa_input_belum_berakhir bila belum pernah dibuka/belum berakhir; 409 aturan_dilanggar dari titik nilai.perbaikan.ajukan (peran_pengaju dekan).
     *
     * `POST /v1/fakultas/{kode}/nilai/koreksi/pengajuan`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeNilaiKoreksiPengajuan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/nilai/koreksi/pengajuan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Koreksi nilai dekan: rinci
     *
     * Pengajuan + nilai sekarang + linimasa (riwayat) + lampiran. Hanya milik sendiri.
     *
     * `GET /v1/fakultas/{kode}/nilai/koreksi/pengajuan/{id}`
     *
     * scope: `fakultas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiKoreksiPengajuanById(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/koreksi/pengajuan/{id}', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Koreksi nilai dekan: batalkan
     *
     * Hanya selama status diajukan.
     *
     * `POST /v1/fakultas/{kode}/nilai/koreksi/pengajuan/{id}/batalkan`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID pengajuan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeNilaiKoreksiPengajuanByIdBatalkan(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/nilai/koreksi/pengajuan/{id}/batalkan', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mahasiswa pindahan
     *
     * Mahasiswa status masuk pindahan (P) dengan SKS diakui vs SKS konversi terisi. ?status=belum|kurang.
     *
     * `GET /v1/fakultas/{kode}/nilai/pindahan`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{q?: string, status?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiPindahan(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/pindahan', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Nilai satu mahasiswa
     *
     * KHS per periode + IPS, skala nilai, mana yang boleh diperbaiki, riwayat perbaikan.
     *
     * `GET /v1/fakultas/{kode}/nilai/mahasiswa/{nim}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeNilaiMahasiswaByNim(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/nilai/mahasiswa/{nim}', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Beban SKS menurut IPS
     *
     * Baris m_sks prodi + periode, celah rentang IPS yang belum tertutup, batas SKS periode, periode lain yang punya data.
     *
     * `GET /v1/fakultas/{kode}/sks-ips`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeSksIps(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/sks-ips', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah beban SKS
     *
     * Body: {"ips_min": 3.00, "ips_max": 4.00, "sks": 24}. IPS 0–4, SKS 1–30, rentang tidak boleh bertumpuk (409); periode lalu ditolak.
     *
     * `POST /v1/fakultas/{kode}/sks-ips`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeSksIps(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/sks-ips', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Hapus beban SKS
     *
     * Body: {"id": [1, 2]}.
     *
     * `POST /v1/fakultas/{kode}/sks-ips/hapus`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeSksIpsHapus(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/sks-ips/hapus', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Salin beban SKS
     *
     * Body: {"dari": "20251"} ke periode tahun_id (harus masih kosong).
     *
     * `POST /v1/fakultas/{kode}/sks-ips/salin`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeSksIpsSalin(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/sks-ips/salin', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Ubah beban SKS
     *
     * Body sama dengan tambah.
     *
     * `POST /v1/fakultas/{kode}/sks-ips/{id}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $id ID m_sks
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeSksIpsById(int|string $kode, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/sks-ips/{id}', ['kode' => $kode, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Logbook bimbingan tugas akhir
     *
     * Mahasiswa TA + pembimbing, jumlah bimbingan, bimbingan terakhir, tahap. Dosen (pribadi) = bimbingannya sendiri.
     *
     * `GET /v1/fakultas/{kode}/ta/logbook`
     *
     * scope: `fakultas:read` · berhalaman
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{q?: string, tahap?: string, pembimbing?: string, page?: int, per_page?: int, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeTaLogbook(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ta/logbook', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Logbook satu mahasiswa
     *
     * Data TA + catatan bimbingan + boleh_tulis.
     *
     * `GET /v1/fakultas/{kode}/ta/logbook/{nim}`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeTaLogbookByNim(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/ta/logbook/{nim}', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Tambah catatan bimbingan
     *
     * Body: {"tanggal_mulai", "tanggal_selesai", "masalah", "bimbingan"}. Oleh pembimbing atau pemegang fakultas.ta.kelola; judul harus sudah diterima.
     *
     * `POST /v1/fakultas/{kode}/ta/logbook/{nim}`
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
    public function postByKodeTaLogbookByNim(int|string $kode, int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/ta/logbook/{nim}', ['kode' => $kode, 'nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Ubah catatan bimbingan
     *
     * Body sama dengan tambah.
     *
     * `POST /v1/fakultas/{kode}/ta/logbook/{nim}/{id}`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param int|string $nim NIM
     * @param int|string $id ID catatan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeTaLogbookByNimById(int|string $kode, int|string $nim, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/ta/logbook/{nim}/{id}', ['kode' => $kode, 'nim' => $nim, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Templat SKPI prodi
     *
     * Isi bab 0 (kop), 3 (capaian pembelajaran), 4–6 (sistem pendidikan, KKNI, informasi tambahan).
     *
     * `GET /v1/fakultas/{kode}/skpi/templat`
     *
     * scope: `fakultas:read`
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByKodeSkpiTemplat(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/fakultas/{kode}/skpi/templat', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Simpan templat SKPI
     *
     * Body: {"ke": "3", "isi": "<p>...</p>"}. Isi kosong menghapus bab itu.
     *
     * `POST /v1/fakultas/{kode}/skpi/templat`
     *
     * scope: `fakultas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode fakultas (m_fakultas), kode unit induk (FAK-05), singkatan, atau kode/domain situs portal
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByKodeSkpiTemplat(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/fakultas/{kode}/skpi/templat', ['kode' => $kode], $query, null, $options, false, false);
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
