<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Profil: Profil saya, Profil: Pemutakhiran saya, Profil: Akun saya, Profil: Pemutakhiran (unit pemilik data), Profil: Saya, Profil: Verifikasi, Profil: Riwayat, Profil: Dokumen, Profil: Permohonan perubahan data
 */
final class Profil extends Resource
{
    /**
     * Riwayat organisasi mahasiswa saya
     *
     * Untuk profile.unipo.ac.id: riwayat kepengurusan ormawa milik pengguna mahasiswa/alumni (ormawa, jabatan, periode, SK kepengurusan). Selain mahasiswa: berlaku false.
     *
     * `GET /v1/profil/saya/organisasi-mahasiswa`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaOrganisasiMahasiswa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/organisasi-mahasiswa', [], $query, null, $options, false, false);
    }

    /**
     * Bagian data saya
     *
     * Bagian data pemilik token per sasaran (pegawai: identitas, kontak, alamat, kepegawaian, keuangan; mahasiswa: identitas,
     * kontak, alamat, akademik, orang tua & wali, keuangan). Tiap isian: nilai, tampilan, `mode` (`langsung` tersimpan
     * seketika, `verifikasi` diperiksa petugas dalam periode pemutakhiran, `ajukan` pengajuan biasa, `baca`), `bukti` wajib,
     * `rahasia` (tersamar; nilai utuh lewat /saya/rahasia/{kode}), `menunggu` (pengajuan belum diputus). Juga kelengkapan per
     * bagian dan total, serta periode pemutakhiran yang sedang aktif.
     *
     * `GET /v1/profil/saya/bagian`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaBagian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/bagian', [], $query, null, $options, false, false);
    }

    /**
     * Simpan satu bagian
     *
     * Satu panel sekaligus. JSON `{isian: {kode: nilai}, alasan?}` atau multipart (`isian` = JSON teks, `alasan`, file
     * `bukti_<kode>` per isian yang wajib bukti). Semua isian divalidasi dulu (422 per isian; tidak ada yang tersimpan bila
     * ada yang salah). Isian `langsung` ditulis ke data induk; isian `verifikasi`/`ajukan` menjadi SATU pengajuan berkelompok.
     * Jawaban: `tersimpan[]`, `pengajuan` (atau null), `pesan`.
     *
     * `POST /v1/profil/saya/bagian/{bagian}`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $bagian identitas, kontak, alamat, kepegawaian, akademik, keluarga, keuangan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaBagianByBagian(int|string $bagian, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya/bagian/{bagian}', ['bagian' => $bagian], $query, null, $options, false, false);
    }

    /**
     * Konfirmasi data sudah benar
     *
     * Mencatat bahwa data bagian ini sudah diperiksa pemiliknya tanpa perubahan (dihitung di progres periode pemutakhiran).
     *
     * `POST /v1/profil/saya/bagian/{bagian}/konfirmasi`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $bagian kode bagian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaBagianByBagianKonfirmasi(int|string $bagian, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya/bagian/{bagian}/konfirmasi', ['bagian' => $bagian], $query, null, $options, false, false);
    }

    /**
     * Nilai utuh isian rahasia
     *
     * Nomor rekening, NPWP, BPJS, NIK milik sendiri (tombol "Tampilkan"). Pembacaan dicatat di jejak audit tanpa nilainya.
     *
     * `GET /v1/profil/saya/rahasia/{kode}`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $kode kode isian rahasia
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaRahasiaByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/rahasia/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Pengajuan saya
     *
     * Pengajuan perubahan data berkelompok milik sendiri, terbaru dulu, beserta status per isian (nilai rahasia tersamar).
     *
     * `GET /v1/profil/saya/pengajuan`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Rincian pengajuan saya
     *
     * `GET /v1/profil/saya/pengajuan/{id}`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPengajuanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/pengajuan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan pengajuan
     *
     * Hanya selama belum ada isian yang diputus.
     *
     * `POST /v1/profil/saya/pengajuan/{id}/batal`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPengajuanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya/pengajuan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh bukti pengajuan saya
     *
     * Respons file.
     *
     * `GET /v1/profil/saya/pengajuan/{id}/bukti/{uuid}`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $id ID atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPengajuanByIdBuktiByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/pengajuan/{id}/bukti/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Riwayat aktivitas saya
     *
     * Linimasa aktivitas akun sendiri dari log yang sudah ada: sesi aplikasi lewat SSO, login SIAKAD lama, ganti password,
     * perubahan akun oleh petugas, "masuk sebagai Anda" oleh administrator, perubahan data Profil/pemutakhiran, pengajuan,
     * dan perubahan kepegawaian dari SDM. Saringan `jenis` (masuk, keamanan, data, pengajuan, kepegawaian), `dari`, `sampai`
     * (bawaan 90 hari terakhir), `q`; paginasi page/per_page. IP disamarkan; token dan isi rahasia tidak pernah dikirim.
     *
     * `GET /v1/profil/saya/aktivitas`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaAktivitas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/aktivitas', [], $query, null, $options, false, false);
    }

    /**
     * Aplikasi dan hak akses saya
     *
     * Aplikasi yang bisa dibuka beserta peran di dalamnya, peran aktif (sumber, unit, masa berlaku, izin per modul dengan label), dan aplikasi yang sedang memegang sesi atas nama akun ini. Hanya baca.
     *
     * `GET /v1/profil/saya/akses`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaAkses(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/akses', [], $query, null, $options, false, false);
    }

    /**
     * Katalog isian dan hak
     *
     * Bagian dan isian yang bisa diatur unit pemilik (sdm, baak, bauk), referensi fakultas/prodi/unit SDM, dan hak petugas (kelola, verifikasi, lingkup).
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/katalog`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikKatalog(int|string $pemilik, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/katalog', ['pemilik' => $pemilik], $query, null, $options, false, false);
    }

    /**
     * Aturan verifikasi bawaan
     *
     * Aturan per isian dan per peran (`peran`: dosen, tendik, mahasiswa; bawaan peran pertama unit) milik unit (SDM:
     * identitas, kontak, alamat, domisili, kepegawaian; BAAK: data mahasiswa; BAUK: data keuangan): `mode` (langsung, verifikasi, ajukan, baca), `bukti`, `wajib` (isian penting), `pemeriksa` (pusat, unit),
     * `diatur` (berbeda dari bawaan), dan `bawaan` dari kode. Berlaku di luar periode pemutakhiran dan menjadi nilai awal
     * periode baru. Izin <pemilik>.pemutakhiran.kelola; `boleh_ubah` hanya untuk petugas tanpa batas lingkup.
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/aturan`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikAturan(int|string $pemilik, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/aturan', ['pemilik' => $pemilik], $query, null, $options, false, false);
    }

    /**
     * Simpan aturan verifikasi
     *
     * Body `aturan` {"peran:kode": {mode, bukti, wajib, pemeriksa}}, opsional `peran` untuk jawaban. Isian yang sama dengan bawaan kode peran itu tidak disimpan. Tercatat di jejak audit.
     *
     * `POST /v1/profil/pemutakhiran/{pemilik}/aturan`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemutakhiranByPemilikAturan(int|string $pemilik, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pemutakhiran/{pemilik}/aturan', ['pemilik' => $pemilik], $query, null, $options, false, false);
    }

    /**
     * Kembalikan aturan ke bawaan
     *
     * Body opsional `peran` (dosen, tendik, mahasiswa); kosong = semua peran unit ini.
     *
     * `POST /v1/profil/pemutakhiran/{pemilik}/aturan/kembalikan`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemutakhiranByPemilikAturanKembalikan(int|string $pemilik, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pemutakhiran/{pemilik}/aturan/kembalikan', ['pemilik' => $pemilik], $query, null, $options, false, false);
    }

    /**
     * Daftar periode pemutakhiran
     *
     * Beserta ringkasan progres (total, sudah, belum, persen, pengajuan menunggu). Izin <pemilik>.pemutakhiran.kelola.
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/pengaturan`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikPengaturan(int|string $pemilik, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/pengaturan', ['pemilik' => $pemilik], $query, null, $options, false, false);
    }

    /**
     * Buat periode pemutakhiran
     *
     * Body: `judul`, `keterangan`, `aktif`, `mulai`, `selesai`, `peran[]`, `cakupan` {fakultas, prodi, unit, angkatan}, `isian` {kode: {mode: langsung|verifikasi, bukti}}.
     *
     * `POST /v1/profil/pemutakhiran/{pemilik}/pengaturan`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemutakhiranByPemilikPengaturan(int|string $pemilik, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pemutakhiran/{pemilik}/pengaturan', ['pemilik' => $pemilik], $query, null, $options, false, false);
    }

    /**
     * Ubah periode pemutakhiran
     *
     * Isian yang tidak dikirim tetap.
     *
     * `POST /v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/ubah`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemutakhiranByPemilikPengaturanByIdUbah(int|string $pemilik, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/ubah', ['pemilik' => $pemilik, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus periode pemutakhiran
     *
     * `POST /v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/hapus`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemutakhiranByPemilikPengaturanByIdHapus(int|string $pemilik, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/hapus', ['pemilik' => $pemilik, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Progres pemutakhiran
     *
     * Daftar sasaran dengan status sudah/belum memperbarui (saringan `status`, `q`), meta.ringkas berisi angka ringkasan.
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/progres`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikPengaturanByIdProgres(int|string $pemilik, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/progres', ['pemilik' => $pemilik, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh progres (CSV)
     *
     * Saringan sama dengan progres. Respons file CSV (pemisah titik koma).
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/progres.csv`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikPengaturanByIdProgresCsv(int|string $pemilik, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/progres.csv', ['pemilik' => $pemilik, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim pengingat
     *
     * Notifikasi ke semua sasaran yang belum memperbarui (maks 5000). Body opsional `pesan`.
     *
     * `POST /v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/pengingat`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemutakhiranByPemilikPengaturanByIdPengingat(int|string $pemilik, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pemutakhiran/{pemilik}/pengaturan/{id}/pengingat', ['pemilik' => $pemilik, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Antrean verifikasi
     *
     * Pengajuan berkelompok di lingkup petugas. Saringan `status` (bawaan diajukan; semua), `q`, `kode_fakultas`, `kode_prodi`, `bagian`, `pengaturan_id`, `dari`, `sampai`. meta.hitung = jumlah per status.
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/pengajuan`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikPengajuan(int|string $pemilik, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/pengajuan', ['pemilik' => $pemilik], $query, null, $options, false, false);
    }

    /**
     * Rincian pengajuan
     *
     * Sebelum → sesudah per isian (nilai utuh), bukti, status per isian.
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/pengajuan/{id}`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikPengajuanById(int|string $pemilik, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/pengajuan/{id}', ['pemilik' => $pemilik, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Putus pengajuan per isian
     *
     * Body `keputusan` {isian_id: {status: diterima|ditolak, alasan}}; "terima semua" = kirim semua isian diterima. Isian diterima langsung ditulis ke data induk dan tercatat di jejak audit; pengaju mendapat notifikasi.
     *
     * `POST /v1/profil/pemutakhiran/{pemilik}/pengajuan/{id}/putus`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPemutakhiranByPemilikPengajuanByIdPutus(int|string $pemilik, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pemutakhiran/{pemilik}/pengajuan/{id}/putus', ['pemilik' => $pemilik, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh bukti
     *
     * Respons file.
     *
     * `GET /v1/profil/pemutakhiran/{pemilik}/pengajuan/{id}/bukti/{uuid}`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param int|string $pemilik sdm, baak, atau bauk
     * @param int|string $id ID atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPemutakhiranByPemilikPengajuanByIdBuktiByUuid(int|string $pemilik, int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pemutakhiran/{pemilik}/pengajuan/{id}/bukti/{uuid}', ['pemilik' => $pemilik, 'id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Profil saya
     *
     * Ringkasan untuk halaman profil: `akun` (username, level, email akun), `identitas` (peran: mahasiswa, alumni, dosen,
     * tendik, pengguna; NIM/NIDN/NIK, prodi), `data_pribadi[]` (setiap isian dengan `bisa_diubah` atau `bisa_diajukan`),
     * `profil` (bio, keahlian, tautan, pas foto), `ringkasan` jumlah riwayat/dokumen/permohonan, `kelengkapan` isian wajib
     * PDDikti (mahasiswa/dosen), dan `hak.verifikasi` bila pengguna petugas verifikasi.
     *
     * `GET /v1/profil/saya`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya', [], $query, null, $options, false, false);
    }

    /**
     * Simpan profil tambahan
     *
     * Body: `nama_panggilan`, `judul`, `bio` (maks 2000), `keahlian` (daftar teks, maks 30), `tautan` {linkedin, orcid, scholar, sinta, scopus, garuda, researchgate, github, situs}, `email_alternatif`. Isian yang tidak dikirim tidak berubah.
     *
     * `POST /v1/profil/saya`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSaya(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah data pribadi
     *
     * Body berisi `kode` isian dengan `bisa_diubah: true` dari GET /saya. Mahasiswa/dosen memakai aturan wizard kelengkapan PDDikti; tendik: HP, telepon, email, alamat, kode pos. Data induk lain ditolak 422 (ajukan lewat /v1/profil/permohonan). Semua isian divalidasi dulu; bila ada yang salah tidak ada yang tersimpan.
     *
     * `POST /v1/profil/saya/data-pribadi`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaDataPribadi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya/data-pribadi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Orang tua dan wali saya
     *
     * Mahasiswa/alumni: `anggota[]` ayah, ibu, wali dari data orang tua SIAKAD (nama, tanggal lahir, agama, pendidikan, pekerjaan, penghasilan, status hidup dengan label, alamat, kontak). Hanya baca; peran lain mendapat `berlaku: false`.
     *
     * `GET /v1/profil/saya/keluarga`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaKeluarga(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/keluarga', [], $query, null, $options, false, false);
    }

    /**
     * Pas foto saya
     *
     * Respons gambar (bukan JSON).
     *
     * `GET /v1/profil/saya/foto`
     *
     * scope: `profil:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaFoto(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/saya/foto', [], $query, null, $options, false, false);
    }

    /**
     * Unggah pas foto
     *
     * multipart/form-data field `berkas`: JPG, PNG, atau WEBP maksimal 2 MB. Menggantikan foto lama.
     *
     * `POST /v1/profil/saya/foto`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaFoto(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya/foto', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Hapus pas foto
     *
     * `POST /v1/profil/saya/foto/hapus`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaFotoHapus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya/foto/hapus', [], $query, null, $options, false, false);
    }

    /**
     * Ganti password
     *
     * Body: `password_lama`, `password` (min. 8 karakter, tidak sama dengan username). Berlaku untuk login SIAKAD dan SSO. Dibatasi 5 percobaan per 15 menit.
     *
     * `POST /v1/profil/saya/password`
     *
     * scope: `profil:write` · hanya token pengguna
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPassword(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/saya/password', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pilihan isian
     *
     * Peran, jenis dokumen (wajib verifikasi, masa berlaku, khusus peran), isian data induk yang bisa diajukan untuk pengguna ini, jenis tinggal, jenis tautan, batas ukuran berkas.
     *
     * `GET /v1/profil/referensi`
     *
     * scope: `profil:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Antrean verifikasi
     *
     * Jumlah dokumen dan permohonan berstatus diajukan. Hanya petugas (pengelola modul profil).
     *
     * `GET /v1/profil/antrean`
     *
     * scope: `profil:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Pas foto pengguna
     *
     * Untuk petugas yang memeriksa dokumen/permohonan. Respons gambar.
     *
     * `GET /v1/profil/pengguna/{username}/foto`
     *
     * scope: `profil:read`
     *
     * @param int|string $username Username SIAKAD (NIM/NIDN/NIK)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenggunaByUsernameFoto(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pengguna/{username}/foto', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: ubah (POST)
     *
     * Sama dengan PUT /v1/profil/pekerjaan/{id}.
     *
     * `POST /v1/profil/pekerjaan/{id}/ubah`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, instansi: string, jabatan: string, unit_kerja?: string, jenis?: string, sektor?: string, lokasi?: string, mulai: string, selesai?: string, masih_bekerja?: bool, deskripsi?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPekerjaanByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pekerjaan/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: hapus (POST)
     *
     * Sama dengan DELETE /v1/profil/pekerjaan/{id}.
     *
     * `POST /v1/profil/pekerjaan/{id}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPekerjaanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pekerjaan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: hapus lampiran (POST)
     *
     * Sama dengan DELETE /v1/profil/pekerjaan/{id}/berkas/{uuid}.
     *
     * `POST /v1/profil/pekerjaan/{id}/berkas/{uuid}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPekerjaanByIdBerkasByUuidHapus(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pekerjaan/{id}/berkas/{uuid}/hapus', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: ubah (POST)
     *
     * Sama dengan PUT /v1/profil/pendidikan/{id}.
     *
     * `POST /v1/profil/pendidikan/{id}/ubah`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, jenjang: string, institusi: string, program_studi?: string, gelar?: string, negara?: string, tahun_masuk?: int, tahun_lulus?: int, masih_studi?: bool, ipk?: float|int, nomor_ijazah?: string, judul_tugas_akhir?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendidikanByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pendidikan/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat pendidikan: hapus (POST)
     *
     * Sama dengan DELETE /v1/profil/pendidikan/{id}.
     *
     * `POST /v1/profil/pendidikan/{id}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendidikanByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pendidikan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: hapus lampiran (POST)
     *
     * Sama dengan DELETE /v1/profil/pendidikan/{id}/berkas/{uuid}.
     *
     * `POST /v1/profil/pendidikan/{id}/berkas/{uuid}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendidikanByIdBerkasByUuidHapus(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pendidikan/{id}/berkas/{uuid}/hapus', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: ubah (POST)
     *
     * Sama dengan PUT /v1/profil/prestasi/{id}.
     *
     * `POST /v1/profil/prestasi/{id}/ubah`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, jenis: string, judul: string, penyelenggara?: string, tingkat?: string, peringkat?: string, tanggal?: string, berlaku_sampai?: string, nomor_sertifikat?: string, tautan?: string, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasiByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/prestasi/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: hapus (POST)
     *
     * Sama dengan DELETE /v1/profil/prestasi/{id}.
     *
     * `POST /v1/profil/prestasi/{id}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasiByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/prestasi/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: hapus lampiran (POST)
     *
     * Sama dengan DELETE /v1/profil/prestasi/{id}/berkas/{uuid}.
     *
     * `POST /v1/profil/prestasi/{id}/berkas/{uuid}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasiByIdBerkasByUuidHapus(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/prestasi/{id}/berkas/{uuid}/hapus', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Organisasi: ubah (POST)
     *
     * Sama dengan PUT /v1/profil/organisasi/{id}.
     *
     * `POST /v1/profil/organisasi/{id}/ubah`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, nama_organisasi: string, jabatan?: string, jenis?: string, mulai?: string, selesai?: string, masih_aktif?: bool, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrganisasiByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/organisasi/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi: hapus (POST)
     *
     * Sama dengan DELETE /v1/profil/organisasi/{id}.
     *
     * `POST /v1/profil/organisasi/{id}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrganisasiByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/organisasi/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi: hapus lampiran (POST)
     *
     * Sama dengan DELETE /v1/profil/organisasi/{id}/berkas/{uuid}.
     *
     * `POST /v1/profil/organisasi/{id}/berkas/{uuid}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrganisasiByIdBerkasByUuidHapus(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/organisasi/{id}/berkas/{uuid}/hapus', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: ubah (POST)
     *
     * Sama dengan PUT /v1/profil/dokumen/{id}.
     *
     * `POST /v1/profil/dokumen/{id}/ubah`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, jenis: string, judul?: string, nomor?: string, penerbit?: string, tanggal_terbit?: string, berlaku_sampai?: string, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen pribadi: hapus (POST)
     *
     * Sama dengan DELETE /v1/profil/dokumen/{id}.
     *
     * `POST /v1/profil/dokumen/{id}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: hapus lampiran (POST)
     *
     * Sama dengan DELETE /v1/profil/dokumen/{id}/berkas/{uuid}.
     *
     * `POST /v1/profil/dokumen/{id}/berkas/{uuid}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdBerkasByUuidHapus(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen/{id}/berkas/{uuid}/hapus', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: ubah (POST)
     *
     * Sama dengan PUT /v1/profil/permohonan/{id}.
     *
     * `POST /v1/profil/permohonan/{id}/ubah`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, kolom: string, nilai_baru: string, alasan: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/permohonan/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: hapus lampiran (POST)
     *
     * Sama dengan DELETE /v1/profil/permohonan/{id}/berkas/{uuid}.
     *
     * `POST /v1/profil/permohonan/{id}/berkas/{uuid}/hapus`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdBerkasByUuidHapus(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/permohonan/{id}/berkas/{uuid}/hapus', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: daftar
     *
     * Riwayat pekerjaan yang diisi pengguna sendiri (username otomatis). Bukti (SK/kontrak) dilampirkan lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/pekerjaan`
     *
     * scope: `profil:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, jenis?: string, sektor?: string, masih_bekerja?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPekerjaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pekerjaan', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/pekerjaan`
     *
     * scope: `profil:write`
     *
     * @param array{username: string, instansi: string, jabatan: string, unit_kerja?: string, jenis?: string, sektor?: string, lokasi?: string, mulai: string, selesai?: string, masih_bekerja?: bool, deskripsi?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPekerjaan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pekerjaan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: detail
     *
     * Riwayat pekerjaan yang diisi pengguna sendiri (username otomatis). Bukti (SK/kontrak) dilampirkan lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/pekerjaan/{id}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPekerjaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pekerjaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/profil/pekerjaan/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, instansi: string, jabatan: string, unit_kerja?: string, jenis?: string, sektor?: string, lokasi?: string, mulai: string, selesai?: string, masih_bekerja?: bool, deskripsi?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPekerjaanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/profil/pekerjaan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/pekerjaan/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePekerjaanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/pekerjaan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Riwayat pekerjaan yang diisi pengguna sendiri (username otomatis). Bukti (SK/kontrak) dilampirkan lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/pekerjaan/{id}/riwayat`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPekerjaanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pekerjaan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/profil/pekerjaan/{id}/berkas`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPekerjaanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pekerjaan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/pekerjaan/{id}/berkas`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPekerjaanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pekerjaan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Riwayat pekerjaan: unduh lampiran
     *
     * `GET /v1/profil/pekerjaan/{id}/berkas/{uuid}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPekerjaanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pekerjaan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Riwayat pekerjaan: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/pekerjaan/{id}/berkas/{uuid}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePekerjaanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/pekerjaan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: daftar
     *
     * Riwayat pendidikan formal dan nonformal yang diisi pengguna sendiri. Ijazah/transkrip dilampirkan lewat /berkas atau sebagai dokumen pribadi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/pendidikan`
     *
     * scope: `profil:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, jenjang?: string, masih_studi?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendidikan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pendidikan', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/pendidikan`
     *
     * scope: `profil:write`
     *
     * @param array{username: string, jenjang: string, institusi: string, program_studi?: string, gelar?: string, negara?: string, tahun_masuk?: int, tahun_lulus?: int, masih_studi?: bool, ipk?: float|int, nomor_ijazah?: string, judul_tugas_akhir?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendidikan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pendidikan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat pendidikan: detail
     *
     * Riwayat pendidikan formal dan nonformal yang diisi pengguna sendiri. Ijazah/transkrip dilampirkan lewat /berkas atau sebagai dokumen pribadi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/pendidikan/{id}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendidikanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pendidikan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/profil/pendidikan/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, jenjang: string, institusi: string, program_studi?: string, gelar?: string, negara?: string, tahun_masuk?: int, tahun_lulus?: int, masih_studi?: bool, ipk?: float|int, nomor_ijazah?: string, judul_tugas_akhir?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPendidikanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/profil/pendidikan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat pendidikan: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/pendidikan/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePendidikanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/pendidikan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Riwayat pendidikan formal dan nonformal yang diisi pengguna sendiri. Ijazah/transkrip dilampirkan lewat /berkas atau sebagai dokumen pribadi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/pendidikan/{id}/riwayat`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendidikanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pendidikan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/profil/pendidikan/{id}/berkas`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendidikanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pendidikan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/pendidikan/{id}/berkas`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPendidikanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/pendidikan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Riwayat pendidikan: unduh lampiran
     *
     * `GET /v1/profil/pendidikan/{id}/berkas/{uuid}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendidikanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/pendidikan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Riwayat pendidikan: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/pendidikan/{id}/berkas/{uuid}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePendidikanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/pendidikan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: daftar
     *
     * Penghargaan, sertifikasi, pelatihan, kompetisi, dan publikasi. Piagam/sertifikat dilampirkan lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/prestasi`
     *
     * scope: `profil:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, jenis?: string, tingkat?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/prestasi', [], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/prestasi`
     *
     * scope: `profil:write`
     *
     * @param array{username: string, jenis: string, judul: string, penyelenggara?: string, tingkat?: string, peringkat?: string, tanggal?: string, berlaku_sampai?: string, nomor_sertifikat?: string, tautan?: string, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/prestasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: detail
     *
     * Penghargaan, sertifikasi, pelatihan, kompetisi, dan publikasi. Piagam/sertifikat dilampirkan lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/prestasi/{id}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/prestasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/profil/prestasi/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, jenis: string, judul: string, penyelenggara?: string, tingkat?: string, peringkat?: string, tanggal?: string, berlaku_sampai?: string, nomor_sertifikat?: string, tautan?: string, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPrestasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/profil/prestasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/prestasi/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePrestasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/prestasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Penghargaan, sertifikasi, pelatihan, kompetisi, dan publikasi. Piagam/sertifikat dilampirkan lewat /berkas. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/prestasi/{id}/riwayat`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/prestasi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/profil/prestasi/{id}/berkas`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasiByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/prestasi/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/prestasi/{id}/berkas`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPrestasiByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/prestasi/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Prestasi dan sertifikasi: unduh lampiran
     *
     * `GET /v1/profil/prestasi/{id}/berkas/{uuid}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPrestasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/prestasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Prestasi dan sertifikasi: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/prestasi/{id}/berkas/{uuid}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePrestasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/prestasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Organisasi: daftar
     *
     * Organisasi kemahasiswaan, profesi, kemasyarakatan, kepanitiaan, dan kegiatan relawan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/organisasi`
     *
     * scope: `profil:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, jenis?: string, masih_aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrganisasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/organisasi', [], $query, null, $options, false, false);
    }

    /**
     * Organisasi: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/organisasi`
     *
     * scope: `profil:write`
     *
     * @param array{username: string, nama_organisasi: string, jabatan?: string, jenis?: string, mulai?: string, selesai?: string, masih_aktif?: bool, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrganisasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/organisasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi: detail
     *
     * Organisasi kemahasiswaan, profesi, kemasyarakatan, kepanitiaan, dan kegiatan relawan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/organisasi/{id}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrganisasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/organisasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/profil/organisasi/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, nama_organisasi: string, jabatan?: string, jenis?: string, mulai?: string, selesai?: string, masih_aktif?: bool, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putOrganisasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/profil/organisasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Organisasi: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/organisasi/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteOrganisasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/organisasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Organisasi kemahasiswaan, profesi, kemasyarakatan, kepanitiaan, dan kegiatan relawan. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/organisasi/{id}/riwayat`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrganisasiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/organisasi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/profil/organisasi/{id}/berkas`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrganisasiByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/organisasi/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Organisasi: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/profil/organisasi/{id}/berkas`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postOrganisasiByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/organisasi/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Organisasi: unduh lampiran
     *
     * `GET /v1/profil/organisasi/{id}/berkas/{uuid}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getOrganisasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/organisasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Organisasi: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/profil/organisasi/{id}/berkas/{uuid}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteOrganisasiByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/organisasi/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: daftar
     *
     * Dokumen pribadi (KTP, KK, NPWP, ijazah, transkrip, piagam, CV, ...). Buat barisnya dulu, lalu unggah file lewat /berkas (PDF/JPG/PNG/WEBP). Jenis yang wajib verifikasi berstatus `diajukan` sampai diperiksa petugas; dokumen terverifikasi terkunci bagi pemilik. Daftar jenis: GET /v1/profil/referensi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/dokumen`
     *
     * scope: `profil:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, peran?: string, kode_prodi?: string, status?: string, jenis?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumen(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/dokumen', [], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status tidak_perlu/diajukan/ditolak.
     *
     * `POST /v1/profil/dokumen`
     *
     * scope: `profil:write`
     *
     * @param array{username: string, jenis: string, judul?: string, nomor?: string, penerbit?: string, tanggal_terbit?: string, berlaku_sampai?: string, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumen(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen pribadi: detail
     *
     * Dokumen pribadi (KTP, KK, NPWP, ijazah, transkrip, piagam, CV, ...). Buat barisnya dulu, lalu unggah file lewat /berkas (PDF/JPG/PNG/WEBP). Jenis yang wajib verifikasi berstatus `diajukan` sampai diperiksa petugas; dokumen terverifikasi terkunci bagi pemilik. Daftar jenis: GET /v1/profil/referensi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/dokumen/{id}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status tidak_perlu/diajukan/ditolak. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/profil/dokumen/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, jenis: string, judul?: string, nomor?: string, penerbit?: string, tanggal_terbit?: string, berlaku_sampai?: string, keterangan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putDokumenById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/profil/dokumen/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen pribadi: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status tidak_perlu/diajukan/ditolak.
     *
     * `DELETE /v1/profil/dokumen/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/dokumen/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Dokumen pribadi (KTP, KK, NPWP, ijazah, transkrip, piagam, CV, ...). Buat barisnya dulu, lalu unggah file lewat /berkas (PDF/JPG/PNG/WEBP). Jenis yang wajib verifikasi berstatus `diajukan` sampai diperiksa petugas; dokumen terverifikasi terkunci bagi pemilik. Daftar jenis: GET /v1/profil/referensi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/dokumen/{id}/riwayat`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/dokumen/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/profil/dokumen/{id}/berkas`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/dokumen/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status tidak_perlu/diajukan/ditolak.
     *
     * `POST /v1/profil/dokumen/{id}/berkas`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Dokumen pribadi: unduh lampiran
     *
     * `GET /v1/profil/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDokumenByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status tidak_perlu/diajukan/ditolak.
     *
     * `DELETE /v1/profil/dokumen/{id}/berkas/{uuid}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteDokumenByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/dokumen/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Dokumen pribadi: Verifikasi dokumen
     *
     * Petugas menyatakan dokumen sesuai aslinya. Pemilik mendapat notifikasi; dokumen terkunci bagi pemilik. Pengelola modul. Status harus diajukan/ditolak, menjadi terverifikasi.
     *
     * `POST /v1/profil/dokumen/{id}/verifikasi`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen pribadi: Tolak dokumen
     *
     * Catatan wajib, mis. "file buram" atau "nomor tidak sesuai". Pemilik bisa memperbaiki lalu mengajukan ulang. Pengelola modul. Status harus diajukan/terverifikasi, menjadi ditolak.
     *
     * `POST /v1/profil/dokumen/{id}/tolak`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dokumen pribadi: Ajukan ulang verifikasi
     *
     * Setelah file atau isian diperbaiki. Pemilik data. Status harus ditolak, menjadi diajukan.
     *
     * `POST /v1/profil/dokumen/{id}/ajukan`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postDokumenByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/dokumen/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: daftar
     *
     * Data induk (nama, tempat/tanggal lahir, jenis kelamin, agama, ...) tidak bisa diubah sendiri. Pengguna mengajukan nilai baru beserta alasan dan bukti (lampiran /berkas, mis. akta lahir atau KK). Petugas BAK/SDM memeriksa dan memperbarui data di SIAKAD; API ini tidak mengubah tabel lama. Isian yang bisa diajukan ada di GET /v1/profil/saya (`bisa_diajukan`). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/permohonan`
     *
     * scope: `profil:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, username?: string, peran?: string, kode_prodi?: string, status?: string, kolom?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/permohonan', [], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/profil/permohonan`
     *
     * scope: `profil:write`
     *
     * @param array{username: string, kolom: string, nilai_baru: string, alasan: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/permohonan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: detail
     *
     * Data induk (nama, tempat/tanggal lahir, jenis kelamin, agama, ...) tidak bisa diubah sendiri. Pengguna mengajukan nilai baru beserta alasan dan bukti (lampiran /berkas, mis. akta lahir atau KK). Petugas BAK/SDM memeriksa dan memperbarui data di SIAKAD; API ini tidak mengubah tabel lama. Isian yang bisa diajukan ada di GET /v1/profil/saya (`bisa_diajukan`). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/permohonan/{id}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/permohonan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/profil/permohonan/{id}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{username: string, kolom: string, nilai_baru: string, alasan: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPermohonanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/profil/permohonan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Data induk (nama, tempat/tanggal lahir, jenis kelamin, agama, ...) tidak bisa diubah sendiri. Pengguna mengajukan nilai baru beserta alasan dan bukti (lampiran /berkas, mis. akta lahir atau KK). Petugas BAK/SDM memeriksa dan memperbarui data di SIAKAD; API ini tidak mengubah tabel lama. Isian yang bisa diajukan ada di GET /v1/profil/saya (`bisa_diajukan`). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/profil/permohonan/{id}/riwayat`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/permohonan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/profil/permohonan/{id}/berkas`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/permohonan/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `POST /v1/profil/permohonan/{id}/berkas`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/permohonan/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Permohonan perubahan data induk: unduh lampiran
     *
     * `GET /v1/profil/permohonan/{id}/berkas/{uuid}`
     *
     * scope: `profil:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPermohonanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/profil/permohonan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status diajukan.
     *
     * `DELETE /v1/profil/permohonan/{id}/berkas/{uuid}`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePermohonanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/profil/permohonan/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: Setujui permohonan
     *
     * Tandai disetujui setelah data di SIAKAD diperbarui petugas. Pengelola modul. Status harus diajukan, menjadi disetujui.
     *
     * `POST /v1/profil/permohonan/{id}/setujui`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/permohonan/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: Tolak permohonan
     *
     * Catatan alasan penolakan wajib. Pengelola modul. Status harus diajukan, menjadi ditolak.
     *
     * `POST /v1/profil/permohonan/{id}/tolak`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/permohonan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Permohonan perubahan data induk: Batalkan permohonan
     *
     * Pemilik data. Status harus diajukan, menjadi dibatalkan.
     *
     * `POST /v1/profil/permohonan/{id}/batal`
     *
     * scope: `profil:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPermohonanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/profil/permohonan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }
}
