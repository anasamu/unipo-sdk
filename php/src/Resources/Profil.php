<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Profil: Profil saya, Profil: Saya, Profil: Verifikasi, Profil: Riwayat, Profil: Dokumen, Profil: Permohonan perubahan data
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
