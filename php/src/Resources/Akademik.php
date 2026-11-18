<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Akademik: Jadwal dan kelas, Akademik: Persetujuan KRS, Akademik: Nilai, Akademik: Batas waktu input, Akademik: Presensi dan jurnal, Akademik: Dokumen dan laporan, Akademik: Pengajuan status, Akademik: Periode, Akademik: Her-registrasi
 */
final class Akademik extends Resource
{
    /**
     * Hak akses akademik saya
     *
     * Apakah pemilik token pengelola akademik (ADMIN, BAK, PROGDI, OPERATOR, peran akademik:kelola), dosen, prodi yang boleh dikelola, dan tahun aktif.
     *
     * `GET /v1/akademik/saya`
     *
     * scope: `akademik:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/saya', [], $query, null, $options, false, false);
    }

    /**
     * Referensi form jadwal
     *
     * Mata kuliah, kelas, ruang, hari, jam, dosen aktif, kampus, periode untuk satu prodi.
     *
     * `GET /v1/akademik/jadwal/referensi`
     *
     * scope: `akademik:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/jadwal/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Daftar jadwal kuliah prodi
     *
     * Jadwal per periode dengan jam, dosen + tim, peserta, bisa_dihapus. Semester pendek = periode berakhiran 3 (mis. 20253).
     *
     * `GET /v1/akademik/jadwal`
     *
     * scope: `akademik:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Tambah jadwal
     *
     * Body: {"kode_mk", "kelas", "ruang", "kapasitas", "hari", "jamke", "nidn"}. Lewat JadwalKuliahService (validasi bentrok ruang/dosen dan jadwal ganda sama dengan web; ditolak 409 dengan pesan).
     *
     * `POST /v1/akademik/jadwal`
     *
     * scope: `akademik:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Cek jadwal bentrok
     *
     * Bentrok jadwal prodi pada periode ini terhadap SEMUA prodi: ruang, dosen (+ tim), rombongan kelas (prodi+semester+kelas), mahasiswa (KRS memuat dua jadwal beririsan); peringatan pindah kampus (jeda < jeda_kampus menit), ruang di kampus lain, jam tidak dikenal. Jam dihitung dari m_jam tiap prodi.
     *
     * `GET /v1/akademik/jadwal/bentrok`
     *
     * scope: `akademik:read`
     *
     * @param array{jeda_kampus?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalBentrok(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/jadwal/bentrok', [], $query, null, $options, false, false);
    }

    /**
     * Cek satu jadwal sebelum disimpan
     *
     * Body sama dengan tambah/ubah jadwal (+ "id" saat ubah, "tim": [nidn]). Hasil: {aman, jadwal, data: [temuan]}. Tidak menyimpan.
     *
     * `POST /v1/akademik/jadwal/cek`
     *
     * scope: `akademik:read`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array{prodi?: string, tahun_id?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalCek(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal/cek', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pratinjau jadwal otomatis
     *
     * TIDAK menyimpan. Body: {"sumber": "periode"|"bentrok", "dari_tahun_id": "20251", "hari": ["1".."6"], "kelas": ["01"], "jeda_kampus": 30, "menit_per_sks": 50, "batas_sore": "15:00"}. periode = jadwal periode lain yang belum ada dicarikan hari/jam/ruang bebas; bentrok = jadwal prodi yang bentrok dipindah. Ruang di kampus kelasnya, tanpa bentrok ruang/dosen/rombongan lintas prodi. Hasil: usulan + tidak_terjadwal (dengan alasan).
     *
     * `POST /v1/akademik/jadwal/otomatis`
     *
     * scope: `akademik:read`
     *
     * @param array{sumber?: string, dari_tahun_id?: string, hari?: list<mixed>, kelas?: list<mixed>, jeda_kampus?: int, menit_per_sks?: int, batas_sore?: string, ...} $body
     * @param array{query?: array{prodi?: string, tahun_id?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalOtomatis(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal/otomatis', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Simpan usulan jadwal otomatis
     *
     * Body: {"usulan": [butir usulan dari pratinjau yang disetujui]} (maks. 300). Tiap butir diperiksa ulang terhadap jadwal terbaru lalu disimpan lewat JadwalKuliahService (validasi lama); hasil {tersimpan, gagal}.
     *
     * `POST /v1/akademik/jadwal/otomatis/simpan`
     *
     * scope: `akademik:write`
     *
     * @param array{usulan: list<mixed>, ...} $body
     * @param array{query?: array{prodi?: string, tahun_id?: string, ...}, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalOtomatisSimpan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal/otomatis/simpan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus jadwal
     *
     * Body: {"id": [12, 13]}. Jadwal yang sudah dipakai KRS dilewati.
     *
     * `POST /v1/akademik/jadwal/hapus`
     *
     * scope: `akademik:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalHapus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal/hapus', [], $query, null, $options, false, false);
    }

    /**
     * Salin jadwal dari periode lain
     *
     * Body: {"sumber": "20242"}. Lewat JadwalKuliahService::salin.
     *
     * `POST /v1/akademik/jadwal/salin`
     *
     * scope: `akademik:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalSalin(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal/salin', [], $query, null, $options, false, false);
    }

    /**
     * Ubah jadwal
     *
     * Body sama dengan tambah jadwal.
     *
     * `POST /v1/akademik/jadwal/{idj}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalByIdj(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal/{idj}', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Atur dosen pengampu (tim dosen)
     *
     * Body: {"nidn": ["0905011", ...]} (kosong = hapus tim).
     *
     * `POST /v1/akademik/jadwal/{idj}/tim`
     *
     * scope: `akademik:write`
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalByIdjTim(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/jadwal/{idj}/tim', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Data kelas prodi
     *
     * m_kelas + jumlah jadwal dan mahasiswa.
     *
     * `GET /v1/akademik/kelas`
     *
     * scope: `akademik:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Tambah kelas
     *
     * Body: {"kelas": "A", "kode_kelas": "01", "kampus": "01"}.
     *
     * `POST /v1/akademik/kelas`
     *
     * scope: `akademik:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Ubah kelas
     *
     * Body sama dengan tambah kelas.
     *
     * `POST /v1/akademik/kelas/{idk}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $idk ID kelas
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdk(int|string $idk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/kelas/{idk}', ['idk' => $idk], $query, null, $options, false, false);
    }

    /**
     * Hapus kelas
     *
     * Ditolak bila kelas masih dipakai jadwal/mahasiswa.
     *
     * `POST /v1/akademik/kelas/{idk}/hapus`
     *
     * scope: `akademik:write`
     *
     * @param int|string $idk ID kelas
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKelasByIdkHapus(int|string $idk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/kelas/{idk}/hapus', ['idk' => $idk], $query, null, $options, false, false);
    }

    /**
     * Antrian persetujuan KRS
     *
     * Mahasiswa aktif dengan status KRS (belum, menunggu, disetujui) + ringkasan. Dosen: mahasiswa bimbingan PA-nya.
     *
     * `GET /v1/akademik/krs/persetujuan`
     *
     * scope: `akademik:read` · berhalaman
     *
     * @param array{prodi?: string, tahun_id?: string, status?: string, q?: string, angkatan?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKrsPersetujuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/krs/persetujuan', [], $query, null, $options, false, false);
    }

    /**
     * Setujui KRS banyak mahasiswa
     *
     * Body: {"nim": ["..."], "tahun_id": "20261"} (maks. 200). Lewat view_insert_krs_terima (sama dengan menu Terima KRS).
     *
     * `POST /v1/akademik/krs/persetujuan`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKrsPersetujuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/krs/persetujuan', [], $query, null, $options, false, false);
    }

    /**
     * KRS satu mahasiswa
     *
     * Mata kuliah diambil + jadwal, batas SKS, riwayat IPS, pesan PA.
     *
     * `GET /v1/akademik/krs/persetujuan/{nim}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKrsPersetujuanByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/krs/persetujuan/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Setujui/batalkan KRS
     *
     * Body: {"setuju": true|false, "tahun_id"}.
     *
     * `POST /v1/akademik/krs/persetujuan/{nim}`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKrsPersetujuanByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/krs/persetujuan/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Hapus mata kuliah dari KRS
     *
     * Body: {"idkrs": 123}. Ditolak bila sudah bernilai.
     *
     * `POST /v1/akademik/krs/persetujuan/{nim}/hapus-mk`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKrsPersetujuanByNimHapusMk(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/krs/persetujuan/{nim}/hapus-mk', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kirim pesan konsultasi KRS
     *
     * Body: {"pesan": "...", "tahun_id"}.
     *
     * `POST /v1/akademik/krs/persetujuan/{nim}/pesan`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKrsPersetujuanByNimPesan(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/krs/persetujuan/{nim}/pesan', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kelas untuk input nilai
     *
     * Peserta dan jumlah bernilai per kelas. Dosen: kelas yang diampu/tim.
     *
     * `GET /v1/akademik/nilai/kelas`
     *
     * scope: `akademik:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNilaiKelas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/nilai/kelas', [], $query, null, $options, false, false);
    }

    /**
     * Tabel nilai kelas
     *
     * Komposisi penilaian (persen Harian/Tugas/UTS/UAS), nilai per komponen, nilai akhir, distribusi, skala, batas input.
     *
     * `GET /v1/akademik/nilai/kelas/{idj}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNilaiKelasByIdj(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/nilai/kelas/{idj}', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Simpan komposisi dan nilai kelas
     *
     * Body: {"persen": {"Harian": 10, "Tugas": 20, "UTS": 30, "UAS": 40}, "nilai": [{"idkrs": 1, "jenis": "UTS", "ke": 1, "nilai": 80}]}. Lewat KrsNilaiService; nilai akhir dihitung ulang (HitungNilaiAngka). Hanya dalam batas tanggal input nilai.
     *
     * `POST /v1/akademik/nilai/kelas/{idj}`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNilaiKelasByIdj(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/nilai/kelas/{idj}', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Umumkan nilai kelas
     *
     * Kirim notifikasi ke kotak masuk peserta yang nilainya sudah masuk. Body opsional: {"pesan": "..."}. Tidak mengubah nilai.
     *
     * `POST /v1/akademik/nilai/kelas/{idj}/umumkan`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postNilaiKelasByIdjUmumkan(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/nilai/kelas/{idj}/umumkan', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Batas waktu input per prodi
     *
     * jenis: krs, krs_dosen, krs_mhs, nilai, nilai_dosen, ta, uji_ta, wd. Baris dari m_bataskrs*\/m_batas_* (dibuat SIAKAD saat popup batas waktu dibuka).
     *
     * `GET /v1/akademik/batas`
     *
     * scope: `akademik:read`
     *
     * @param array{jenis?: string, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBatas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/batas', [], $query, null, $options, false, false);
    }

    /**
     * Ubah batas waktu
     *
     * Body: {"mulai": "2026-12-01", "selesai": "2026-12-20", "terima_krs": "Y|N" (khusus krs_mhs)}. Lewat TahunRepository::ubahBatas, sama dengan menu Tahun Akademik.
     *
     * `POST /v1/akademik/batas/{jenis}/{id}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $jenis krs|krs_dosen|krs_mhs|nilai|nilai_dosen|ta|uji_ta|wd
     * @param int|string $id ID baris batas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBatasByJenisById(int|string $jenis, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/batas/{jenis}/{id}', ['jenis' => $jenis, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kunci input (tutup sekarang)
     *
     * Tanggal selesai diisi kemarin sehingga input (mis. nilai) langsung tertutup. Buka lagi dengan mengubah batas.
     *
     * `POST /v1/akademik/batas/{jenis}/{id}/kunci`
     *
     * scope: `akademik:write`
     *
     * @param int|string $jenis krs|krs_dosen|krs_mhs|nilai|nilai_dosen|ta|uji_ta|wd
     * @param int|string $id ID baris batas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBatasByJenisByIdKunci(int|string $jenis, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/batas/{jenis}/{id}/kunci', ['jenis' => $jenis, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Presensi dan jurnal kelas
     *
     * Pertemuan (tanggal, jam, dosen, bahasan/jurnal) dan rekap hadir/izin/sakit/alpa per mahasiswa.
     *
     * `GET /v1/akademik/presensi/kelas/{idj}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiKelasByIdj(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/presensi/kelas/{idj}', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Catat pertemuan dan presensi
     *
     * Body: {"tanggal": "2026-11-15", "jam": 3, "jam_selesai": 4, "lama": 2, "bahasan": "...", "nidn": "(pengelola, opsional)", "mahasiswa": [{"nim": "...", "status": "H|I|S|A"}]}. Tanpa "mahasiswa": semua peserta dicatat hadir (PresensiDosenService). Dengan "mahasiswa": status per mahasiswa (PresensiInputDosenService). Untuk dosen, tanggal selalu hari ini seperti halaman web.
     *
     * `POST /v1/akademik/presensi/kelas/{idj}`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKelasByIdj(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/presensi/kelas/{idj}', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Detail pertemuan
     *
     * Jurnal pertemuan dan status tiap mahasiswa.
     *
     * `GET /v1/akademik/presensi/kelas/{idj}/pertemuan/{id}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param int|string $id ID pertemuan (iddm)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiKelasByIdjPertemuanById(int|string $idj, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/presensi/kelas/{idj}/pertemuan/{id}', ['idj' => $idj, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah pertemuan / jurnal
     *
     * Body: {"tanggal", "jam", "jam_selesai", "lama", "bahasan", "jenis_presensi"}. Lewat PresensiDosenService::ubahPertemuan.
     *
     * `POST /v1/akademik/presensi/kelas/{idj}/pertemuan/{id}`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param int|string $id ID pertemuan (iddm)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKelasByIdjPertemuanById(int|string $idj, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/presensi/kelas/{idj}/pertemuan/{id}', ['idj' => $idj, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus pertemuan
     *
     * Menghapus presensi dosen dan presensi mahasiswa pertemuan itu (PresensiDosenService::hapusPertemuan).
     *
     * `POST /v1/akademik/presensi/kelas/{idj}/pertemuan/{id}/hapus`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param int|string $id ID pertemuan (iddm)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKelasByIdjPertemuanByIdHapus(int|string $idj, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/presensi/kelas/{idj}/pertemuan/{id}/hapus', ['idj' => $idj, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah status presensi mahasiswa
     *
     * Body: {"status": "H|I|S|A"}. Lewat PresensiInputDosenService::update.
     *
     * `POST /v1/akademik/presensi/kelas/{idj}/mahasiswa/{id}`
     *
     * scope: `akademik:write` · hanya token pengguna
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param int|string $id ID presensi mahasiswa (idpm)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPresensiKelasByIdjMahasiswaById(int|string $idj, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/presensi/kelas/{idj}/mahasiswa/{id}', ['idj' => $idj, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kartu absensi kelas
     *
     * Data untuk mencetak kartu/daftar hadir: peserta, pertemuan, status tiap pertemuan.
     *
     * `GET /v1/akademik/presensi/kelas/{idj}/kartu-absensi`
     *
     * scope: `akademik:read`
     *
     * @param int|string $idj ID jadwal kuliah (t_jadwal.idj)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPresensiKelasByIdjKartuAbsensi(int|string $idj, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/presensi/kelas/{idj}/kartu-absensi', ['idj' => $idj], $query, null, $options, false, false);
    }

    /**
     * Ringkasan akademik mahasiswa
     *
     * Status per periode, SKS/IP per periode, IPK (nilai_ipk), PA, dan data pindahan/transfer (asal PT, SKS diakui, mata kuliah konversi).
     *
     * `GET /v1/akademik/mahasiswa/{nim}/ringkasan`
     *
     * scope: `akademik:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimRingkasan(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/mahasiswa/{nim}/ringkasan', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kartu ujian
     *
     * UTS/UAS yang sedang berlangsung + izin cetak (pembayaran, presensi UAS; KartuUjianMahasiswaService) dan jadwal ujian mata kuliah KRS.
     *
     * `GET /v1/akademik/mahasiswa/{nim}/kartu-ujian`
     *
     * scope: `akademik:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimKartuUjian(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/mahasiswa/{nim}/kartu-ujian', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kartu tanda mahasiswa (KTM)
     *
     * Data KTM: identitas, prodi/fakultas, angkatan, status, masa berlaku (dari batas studi). Foto lewat /foto.
     *
     * `GET /v1/akademik/mahasiswa/{nim}/ktm`
     *
     * scope: `akademik:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimKtm(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/mahasiswa/{nim}/ktm', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Foto mahasiswa
     *
     * File foto (images/avatar) untuk KTM.
     *
     * `GET /v1/akademik/mahasiswa/{nim}/foto`
     *
     * scope: `akademik:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimFoto(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/mahasiswa/{nim}/foto', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Transkrip sementara
     *
     * Transkrip nilai terbaik (sama dengan /v1/mahasiswa/{nim}/transkrip) + kop perguruan tinggi, prodi, predikat sementara (m_predikat).
     *
     * `GET /v1/akademik/mahasiswa/{nim}/transkrip-sementara`
     *
     * scope: `akademik:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNimTranskripSementara(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/mahasiswa/{nim}/transkrip-sementara', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Kartu identitas dosen/pegawai
     *
     * Data kartu identitas dari m_dosen/m_karyawan + sdm_pegawai. Pemilik atau pengelola akademik.
     *
     * `GET /v1/akademik/kartu-identitas/{username}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $username NIDN atau NIK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKartuIdentitasByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/kartu-identitas/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Analisis nilai bermasalah
     *
     * Pengelola akademik. Untuk satu periode dan satu/semua prodi kelolaan: ringkasan kelengkapan nilai, sebaran nilai, per prodi, per kelas (peserta, terisi, belum, D/E, rerata bobot, tanda masalah: belum_dinilai, sebagian, gagal_tinggi (>= 30% D/E), seragam, tanpa_dosen, tanpa_peserta, nilai_tidak_baku), per dosen, per mata kuliah, mahasiswa bermasalah (nilai kosong, D, E, tidak baku, IPS < 2; maks. 2000), dan KRS tanpa jadwal. Hanya baca.
     *
     * `GET /v1/akademik/nilai/analisis`
     *
     * scope: `akademik:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getNilaiAnalisis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/nilai/analisis', [], $query, null, $options, false, false);
    }

    /**
     * Laporan akademik per prodi
     *
     * Status mahasiswa, KRS, nilai terisi + distribusi, kelas dan pertemuan untuk satu periode. Pengelola akademik.
     *
     * `GET /v1/akademik/laporan`
     *
     * scope: `akademik:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLaporan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/laporan', [], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: daftar
     *
     * Mahasiswa mengajukan cuti, aktif kembali, non-aktif, mengundurkan diri, atau pindah kelas/kampus/prodi; pengelola akademik (ADMIN, BAK, PROGDI, OPERATOR) memutuskan. Prasyarat bawaan (docs/PRASYARAT.md): status mahasiswa sesuai jenis, tujuan pindah valid, satu pengajuan perubahan status menunggu dalam satu waktu, dokumen pendukung wajib per jenis (config prasyarat.akademik_lampiran, kirim `lampiran` saat mengajukan), lalu aturan dinamis titik cuti.ajukan / akademik.status.ajukan. Linimasa: GET /pengajuan/{id}/riwayat. Persetujuan cuti, non-aktif, dan mengundurkan diri langsung dicatat ke status SIAKAD lewat service halaman web (sama dengan menu Mahasiswa Cuti, Non Aktif, dan Keluar); jenis lain ditandai disetujui untuk ditindaklanjuti operator. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/akademik/pengajuan`
     *
     * scope: `akademik:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, tahun_id?: string, jenis?: string, status?: string, tercatat_siakad?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/akademik/pengajuan`
     *
     * scope: `akademik:write`
     *
     * @param array{nim: string, tahun_id?: string, jenis: string, tanggal_mulai?: string, tanggal_akhir?: string, tujuan?: string, alasan?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/pengajuan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan status akademik: detail
     *
     * Mahasiswa mengajukan cuti, aktif kembali, non-aktif, mengundurkan diri, atau pindah kelas/kampus/prodi; pengelola akademik (ADMIN, BAK, PROGDI, OPERATOR) memutuskan. Prasyarat bawaan (docs/PRASYARAT.md): status mahasiswa sesuai jenis, tujuan pindah valid, satu pengajuan perubahan status menunggu dalam satu waktu, dokumen pendukung wajib per jenis (config prasyarat.akademik_lampiran, kirim `lampiran` saat mengajukan), lalu aturan dinamis titik cuti.ajukan / akademik.status.ajukan. Linimasa: GET /pengajuan/{id}/riwayat. Persetujuan cuti, non-aktif, dan mengundurkan diri langsung dicatat ke status SIAKAD lewat service halaman web (sama dengan menu Mahasiswa Cuti, Non Aktif, dan Keluar); jenis lain ditandai disetujui untuk ditindaklanjuti operator. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/akademik/pengajuan/{id}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/akademik/pengajuan/{id}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, tahun_id?: string, jenis: string, tanggal_mulai?: string, tanggal_akhir?: string, tujuan?: string, alasan?: string, catatan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengajuanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/akademik/pengajuan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan status akademik: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/akademik/pengajuan/{id}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/akademik/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Mahasiswa mengajukan cuti, aktif kembali, non-aktif, mengundurkan diri, atau pindah kelas/kampus/prodi; pengelola akademik (ADMIN, BAK, PROGDI, OPERATOR) memutuskan. Prasyarat bawaan (docs/PRASYARAT.md): status mahasiswa sesuai jenis, tujuan pindah valid, satu pengajuan perubahan status menunggu dalam satu waktu, dokumen pendukung wajib per jenis (config prasyarat.akademik_lampiran, kirim `lampiran` saat mengajukan), lalu aturan dinamis titik cuti.ajukan / akademik.status.ajukan. Linimasa: GET /pengajuan/{id}/riwayat. Persetujuan cuti, non-aktif, dan mengundurkan diri langsung dicatat ke status SIAKAD lewat service halaman web (sama dengan menu Mahasiswa Cuti, Non Aktif, dan Keluar); jenis lain ditandai disetujui untuk ditindaklanjuti operator. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/akademik/pengajuan/{id}/riwayat`
     *
     * scope: `akademik:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/pengajuan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/akademik/pengajuan/{id}/berkas`
     *
     * scope: `akademik:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/pengajuan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/akademik/pengajuan/{id}/berkas`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/pengajuan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pengajuan status akademik: unduh lampiran
     *
     * `GET /v1/akademik/pengajuan/{id}/berkas/{uuid}`
     *
     * scope: `akademik:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/pengajuan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/akademik/pengajuan/{id}/berkas/{uuid}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengajuanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/akademik/pengajuan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengajuan status akademik: Setujui (cuti, non-aktif, dan mengundurkan diri langsung dicatat ke SIAKAD)
     *
     * Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/akademik/pengajuan/{id}/setujui`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/pengajuan/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan status akademik: Tolak
     *
     * Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/akademik/pengajuan/{id}/tolak`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/pengajuan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengajuan status akademik: Batalkan pengajuan (oleh mahasiswa)
     *
     * Pemilik data atau pengelola. Status harus diajukan, menjadi dibatalkan.
     *
     * `POST /v1/akademik/pengajuan/{id}/batalkan`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanByIdBatalkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/pengajuan/{id}/batalkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar periode
     *
     * m_tahun terbaru beserta tanggal tahapan, aturan KRS, dan jumlah status mahasiswa (A/C/N). meta.boleh_ubah = izin akademik.periode.buka (atau token admin).
     *
     * `GET /v1/akademik/periode`
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
        return $this->send('GET', '/v1/akademik/periode', [], $query, null, $options, false, false);
    }

    /**
     * Tambah periode
     *
     * Body: {"tahun": "2027", "semester": "1", "nama_tahun"?, tanggal YYYY-MM-DD (krs_online_mulai, ..., cuti_selesai), syarat_krs, syarat_krs_ips, paket_krs, max_sks, min_presensi}. Lewat TahunRepository::tambah. Butuh izin RBAC akademik.periode.buka (peran superadmin, bak, staf-baak, kepala-baak) atau token admin.
     *
     * `POST /v1/akademik/periode`
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
        return $this->send('POST', '/v1/akademik/periode', [], $query, null, $options, false, false);
    }

    /**
     * Ubah tanggal dan aturan periode
     *
     * Body: kolom yang diubah saja (tanggal kosong = dikosongkan). Lewat TahunRepository::ubah. Butuh izin RBAC akademik.periode.buka (peran superadmin, bak, staf-baak, kepala-baak) atau token admin.
     *
     * `POST /v1/akademik/periode/{id}`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/periode/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buka periode
     *
     * Sama dengan m=tahun op=buka: periode ini dibuka, periode lain ditutup, status semua mahasiswa disinkronkan (CekStatusAllMhs: A dari KRS diterima, N untuk sisanya, DO melewati batas studi). Butuh izin RBAC akademik.periode.buka (peran superadmin, bak, staf-baak, kepala-baak) atau token admin.
     *
     * `POST /v1/akademik/periode/{id}/buka`
     *
     * scope: `akademik:write`
     *
     * @param int|string $id Periode (tahun_id 5 digit)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriodeByIdBuka(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/periode/{id}/buka', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Status semester mahasiswa
     *
     * Mahasiswa yang semestinya terdaftar di periode (semester masuk s.d. batas studi, belum lulus/keluar) dengan status periode (A/C/N/null = belum tercatat), KRS, dan keuangan (syarat_bayar = cek_spp_persen; tagihan/dibayar/sisa periode). meta.ringkasan menghitung semua status. Hanya membaca.
     *
     * `GET /v1/akademik/registrasi`
     *
     * scope: `akademik:read` · berhalaman
     *
     * @param array{status?: string, q?: string, angkatan?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRegistrasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/registrasi', [], $query, null, $options, false, false);
    }

    /**
     * Her-registrasi (aktifkan)
     *
     * Body: {"nim": [...], "tahun_id"?, "abaikan_keuangan"?: true}. Per NIM lewat HerService::registrasi (m=mahasiswa.her). Mahasiswa yang syarat bayarnya belum terpenuhi dilewati kecuali abaikan_keuangan. Maks. 200 NIM. Jawaban {berhasil, gagal}.
     *
     * `POST /v1/akademik/registrasi/aktifkan`
     *
     * scope: `akademik:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRegistrasiAktifkan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/registrasi/aktifkan', [], $query, null, $options, false, false);
    }

    /**
     * Non-aktifkan
     *
     * Body: {"nim": [...], "tahun_id"?}. Per NIM lewat NonAktifService::validasi + simpan (m=mahasiswa.nonaktif). Maks. 200 NIM.
     *
     * `POST /v1/akademik/registrasi/nonaktifkan`
     *
     * scope: `akademik:write`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRegistrasiNonaktifkan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/registrasi/nonaktifkan', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan registrasi
     *
     * Pengaturan per kampus: {"aktif_kembali_otomatis": false, "aktif_kembali_hari_kerja": 3, "keterangan", "diubah_oleh", "diubah_at"}. meta.boleh_ubah = punya izin akademik.periode.buka (atau token admin).
     *
     * `GET /v1/akademik/registrasi/pengaturan`
     *
     * scope: `akademik:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRegistrasiPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/registrasi/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah pengaturan registrasi
     *
     * Body: {"aktif_kembali_otomatis": true, "aktif_kembali_hari_kerja": 3} (sebagian boleh). Bila aktif, perintah `php artisan registrasi:otomatis` (cron harian) meng-her-registrasi pengajuan aktif kembali yang disetujui tetapi belum her-registrasi dalam N hari kerja, lewat HerService lama, tetap memeriksa syarat bayar dan aturan registrasi.aktifkan; reg_log pelaku sistem. Butuh izin akademik.periode.buka.
     *
     * `POST /v1/akademik/registrasi/pengaturan`
     *
     * scope: `akademik:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRegistrasiPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/akademik/registrasi/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat aksi
     *
     * Log aktifkan/nonaktifkan dan perubahan periode dari API (reg_log).
     *
     * `GET /v1/akademik/registrasi/riwayat`
     *
     * scope: `akademik:read`
     *
     * @param array{batas?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRegistrasiRiwayat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/akademik/registrasi/riwayat', [], $query, null, $options, false, false);
    }
}
