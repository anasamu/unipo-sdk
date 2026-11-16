<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Karier: Profil dan CV, Karier: Laporan, Karier: Rekomendasi, Karier: Mitra, Karier: Lamaran, Karier: Acara, Karier: Tips
 */
final class Karier extends Resource
{
    /**
     * CV lengkap
     *
     * Profil dan pengalaman digabung data SIAKAD: prodi, tahun masuk, tanggal lulus, IPK, prestasi terverifikasi (kemahasiswaan), kegiatan MBKM selesai, dan jabatan di ormawa. Untuk pemilik, pengelola, atau aplikasi mitra bila profil ditampilkan ke mitra.
     *
     * `GET /v1/karier/cv/{nim}`
     *
     * scope: `karier:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCvByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/cv/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Cari kandidat
     *
     * Untuk pengelola dan aplikasi mitra: profil yang setuju ditampilkan ke mitra, beserta IPK lulusan. Maksimal 200 baris.
     *
     * `GET /v1/karier/kandidat`
     *
     * scope: `karier:read`
     *
     * @param array{keahlian?: string, kode_prodi?: string, status_kerja?: string, lulusan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKandidat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/kandidat', [], $query, null, $options, false, false);
    }

    /**
     * Rekap pusat karier
     *
     * Profil, lamaran per status, lowongan terbit, dan acara 12 bulan terakhir. Pengelola.
     *
     * `GET /v1/karier/rekap`
     *
     * scope: `karier:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekap(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Pemantauan lowongan
     *
     * Ringkasan lowongan tracer (draf, terbit aktif, ditutup, lewat batas tapi masih terbit, akan tutup 14 hari, aktif tanpa pelamar), lamaran per status dan persen diterima, per tipe, per instansi beserta status mitra, tren 12 bulan, dan daftar lowongan aktif dengan jumlah pelamar/belum dilihat/rekomendasi. Pengelola.
     *
     * `GET /v1/karier/lowongan/pantau`
     *
     * scope: `karier:read`
     *
     * @param array{instansi_id?: string, kode_prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLowonganPantau(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/lowongan/pantau', [], $query, null, $options, false, false);
    }

    /**
     * Saran kandidat untuk lowongan
     *
     * Profil yang setuju ditampilkan ke mitra, diurutkan menurut skor kecocokan (prodi, keahlian dan minat terhadap teks lowongan, IPK, lokasi, status mencari kerja) beserta alasannya; yang sudah melamar/direkomendasikan ditandai. Pengelola.
     *
     * `GET /v1/karier/lowongan/{id}/saran-kandidat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID lowongan (tracer_lowongan)
     * @param array{batas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLowonganByIdSaranKandidat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/lowongan/{id}/saran-kandidat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar undangan mitra
     *
     * Pengelola.
     *
     * `GET /v1/karier/undangan-mitra`
     *
     * scope: `karier:read`
     *
     * @param array{status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUndanganMitra(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/undangan-mitra', [], $query, null, $options, false, false);
    }

    /**
     * Undang calon mitra
     *
     * Body {email, nama_instansi?, nama_kontak?, pesan?}. Membuat tautan bertoken (berlaku 30 hari, hanya tampil sekali) untuk dikirim ke perusahaan; undangan aktif lama ke email yang sama dicabut. Pengelola.
     *
     * `POST /v1/karier/undangan-mitra`
     *
     * scope: `karier:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUndanganMitra(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/undangan-mitra', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut undangan mitra
     *
     * `POST /v1/karier/undangan-mitra/{id}/cabut`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID undangan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUndanganMitraByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/undangan-mitra/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lihat undangan (calon mitra, tanpa token akses)
     *
     * Isi undangan dan daftar isian. Membuka tautan menandai undangan dibuka.
     *
     * `GET /v1/karier/undangan-mitra/terima/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token undangan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUndanganMitraTerimaByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/undangan-mitra/terima/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Jawab undangan (calon mitra, tanpa token akses)
     *
     * Body {setuju: true, nama, kontak_nama, bidang_usaha?, alamat?, telepon?, situs?, kontak_jabatan?, kontak_hp?, bidang_rekrutmen?} atau {setuju: false}. Diterima: perusahaan dicatat di tracer_instansi (belum terverifikasi) dan mitra berstatus calon; pengelola mendapat notifikasi lalu mengaktifkan.
     *
     * `POST /v1/karier/undangan-mitra/terima/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token undangan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUndanganMitraTerimaByToken(int|string $token, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/undangan-mitra/terima/{token}', ['token' => $token], $options['query'] ?? [], $body, $options, false, true);
    }

    /**
     * Profil karier: daftar
     *
     * Satu profil per mahasiswa/alumni (nim otomatis untuk pemilik). Aplikasi mitra (token aplikasi ber-scope karier:read) hanya melihat profil yang `tampil_ke_mitra`. CV dilampirkan lewat /berkas; CV lengkap otomatis di /karier/cv/{nim}. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/profil`
     *
     * scope: `karier:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, kode_prodi?: string, status_kerja?: string, tampil_ke_mitra?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfil(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/profil', [], $query, null, $options, false, false);
    }

    /**
     * Profil karier: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `POST /v1/karier/profil`
     *
     * scope: `karier:write`
     *
     * @param array{nim: string, judul_profil?: string, ringkasan?: string, keahlian?: array<string, mixed>, bahasa?: array<string, mixed>, minat_bidang?: string, lokasi_diinginkan?: string, status_kerja?: string, linkedin?: string, portofolio?: string, tampil_ke_mitra?: bool, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProfil(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/profil', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Profil karier: detail
     *
     * Satu profil per mahasiswa/alumni (nim otomatis untuk pemilik). Aplikasi mitra (token aplikasi ber-scope karier:read) hanya melihat profil yang `tampil_ke_mitra`. CV dilampirkan lewat /berkas; CV lengkap otomatis di /karier/cv/{nim}. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/profil/{id}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfilById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/profil/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Profil karier: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/profil/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, judul_profil?: string, ringkasan?: string, keahlian?: array<string, mixed>, bahasa?: array<string, mixed>, minat_bidang?: string, lokasi_diinginkan?: string, status_kerja?: string, linkedin?: string, portofolio?: string, tampil_ke_mitra?: bool, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putProfilById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/profil/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Profil karier: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `DELETE /v1/karier/profil/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProfilById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/profil/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Profil karier: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Satu profil per mahasiswa/alumni (nim otomatis untuk pemilik). Aplikasi mitra (token aplikasi ber-scope karier:read) hanya melihat profil yang `tampil_ke_mitra`. CV dilampirkan lewat /berkas; CV lengkap otomatis di /karier/cv/{nim}. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/profil/{id}/riwayat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfilByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/profil/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Profil karier: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/karier/profil/{id}/berkas`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfilByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/profil/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Profil karier: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `POST /v1/karier/profil/{id}/berkas`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postProfilByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/profil/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Profil karier: unduh lampiran
     *
     * `GET /v1/karier/profil/{id}/berkas/{uuid}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getProfilByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/profil/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Profil karier: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `DELETE /v1/karier/profil/{id}/berkas/{uuid}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteProfilByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/profil/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengalaman: daftar
     *
     * Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/pengalaman`
     *
     * scope: `karier:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, jenis?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalaman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/pengalaman', [], $query, null, $options, false, false);
    }

    /**
     * Pengalaman: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `POST /v1/karier/pengalaman`
     *
     * scope: `karier:write`
     *
     * @param array{nim: string, jenis: string, judul: string, instansi?: string, mulai?: string, selesai?: string, uraian?: string, nomor_kredensial?: string, tautan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengalaman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/pengalaman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman: detail
     *
     * Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/pengalaman/{id}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/pengalaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis). Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/pengalaman/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, jenis: string, judul: string, instansi?: string, mulai?: string, selesai?: string, uraian?: string, nomor_kredensial?: string, tautan?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengalamanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/pengalaman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pengalaman: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `DELETE /v1/karier/pengalaman/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengalamanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/pengalaman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/pengalaman/{id}/riwayat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/pengalaman/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/karier/pengalaman/{id}/berkas`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/pengalaman/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengalaman: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `POST /v1/karier/pengalaman/{id}/berkas`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengalamanByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/pengalaman/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Pengalaman: unduh lampiran
     *
     * `GET /v1/karier/pengalaman/{id}/berkas/{uuid}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengalamanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/pengalaman/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pengalaman: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis).
     *
     * `DELETE /v1/karier/pengalaman/{id}/berkas/{uuid}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePengalamanByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/pengalaman/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: daftar
     *
     * Lamaran ke lowongan tracer (`tracer_lowongan` terbit, belum lewat batas). Pelamar wajib punya profil karier. Pengelola atau aplikasi mitra memperbarui status; pelamar mendapat notifikasi dan bisa menarik lamaran. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/lamaran`
     *
     * scope: `karier:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, lowongan_id?: string, nim?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLamaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/lamaran', [], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dikirim.
     *
     * `POST /v1/karier/lamaran`
     *
     * scope: `karier:write`
     *
     * @param array{lowongan_id: int, nim: string, surat_lamaran?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lamaran kerja: detail
     *
     * Lamaran ke lowongan tracer (`tracer_lowongan` terbit, belum lewat batas). Pelamar wajib punya profil karier. Pengelola atau aplikasi mitra memperbarui status; pelamar mendapat notifikasi dan bisa menarik lamaran. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/lamaran/{id}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLamaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/lamaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: ubah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dikirim. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/lamaran/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{lowongan_id: int, nim: string, surat_lamaran?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putLamaranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/lamaran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lamaran kerja: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dikirim.
     *
     * `DELETE /v1/karier/lamaran/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLamaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/lamaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Lamaran ke lowongan tracer (`tracer_lowongan` terbit, belum lewat batas). Pelamar wajib punya profil karier. Pengelola atau aplikasi mitra memperbarui status; pelamar mendapat notifikasi dan bisa menarik lamaran. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/lamaran/{id}/riwayat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLamaranByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/lamaran/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/karier/lamaran/{id}/berkas`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLamaranByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/lamaran/{id}/berkas', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dikirim.
     *
     * `POST /v1/karier/lamaran/{id}/berkas`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaranByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Lamaran kerja: unduh lampiran
     *
     * `GET /v1/karier/lamaran/{id}/berkas/{uuid}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLamaranByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/lamaran/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: hapus lampiran
     *
     * Pengelola, atau pengguna untuk datanya sendiri (nim diisi otomatis); pemilik hanya bisa mengubah/menghapus bila status dikirim.
     *
     * `DELETE /v1/karier/lamaran/{id}/berkas/{uuid}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteLamaranByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/lamaran/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: Tarik lamaran
     *
     * Pemilik data. Status harus dikirim/dilihat/seleksi/wawancara, menjadi ditarik.
     *
     * `POST /v1/karier/lamaran/{id}/tarik`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaranByIdTarik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran/{id}/tarik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lamaran kerja: Status: dilihat
     *
     * Pengelola modul. Status harus dikirim, menjadi dilihat.
     *
     * `POST /v1/karier/lamaran/{id}/tandai-dilihat`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaranByIdTandaiDilihat(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran/{id}/tandai-dilihat', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lamaran kerja: Status: seleksi
     *
     * Pengelola modul. Status harus dikirim/dilihat, menjadi seleksi.
     *
     * `POST /v1/karier/lamaran/{id}/seleksi`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaranByIdSeleksi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran/{id}/seleksi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lamaran kerja: Status: wawancara
     *
     * Pengelola modul. Status harus dikirim/dilihat/seleksi, menjadi wawancara.
     *
     * `POST /v1/karier/lamaran/{id}/wawancara`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaranByIdWawancara(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran/{id}/wawancara', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lamaran kerja: Status: diterima
     *
     * Pengelola modul. Status harus dilihat/seleksi/wawancara, menjadi diterima.
     *
     * `POST /v1/karier/lamaran/{id}/terima`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaranByIdTerima(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran/{id}/terima', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lamaran kerja: Status: ditolak
     *
     * Pengelola modul. Status harus dikirim/dilihat/seleksi/wawancara, menjadi ditolak.
     *
     * `POST /v1/karier/lamaran/{id}/tolak`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLamaranByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/lamaran/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Acara karier: daftar
     *
     * Semua pemilik token ber-scope karier:read (selain pengelola hanya melihat status terbit/selesai).
     *
     * `GET /v1/karier/acara`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, jenis?: string, mitra_id?: string, instansi_id?: string, mode?: string, sasaran?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAcara(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/acara', [], $query, null, $options, false, true);
    }

    /**
     * Acara karier: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/karier/acara`
     *
     * scope: `karier:write`
     *
     * @param array{judul: string, jenis?: string, mitra_id?: int, instansi_id?: int, deskripsi?: string, mulai: string, selesai?: string, mode?: string, lokasi?: string, tautan?: string, kuota?: int, sasaran?: string, status?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAcara(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/acara', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Acara karier: detail
     *
     * Semua pemilik token ber-scope karier:read (selain pengelola hanya melihat status terbit/selesai).
     *
     * `GET /v1/karier/acara/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAcaraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/acara/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Acara karier: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/acara/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, jenis?: string, mitra_id?: int, instansi_id?: int, deskripsi?: string, mulai: string, selesai?: string, mode?: string, lokasi?: string, tautan?: string, kuota?: int, sasaran?: string, status?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAcaraById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/acara/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Acara karier: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/karier/acara/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAcaraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/acara/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Acara karier: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Semua pemilik token ber-scope karier:read (selain pengelola hanya melihat status terbit/selesai).
     *
     * `GET /v1/karier/acara/{id}/riwayat`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAcaraByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/acara/{id}/riwayat', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Acara karier: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/karier/acara/{id}/berkas`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAcaraByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/acara/{id}/berkas', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Acara karier: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/karier/acara/{id}/berkas`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAcaraByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/acara/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Acara karier: unduh lampiran
     *
     * `GET /v1/karier/acara/{id}/berkas/{uuid}`
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
    public function getAcaraByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/acara/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, true);
    }

    /**
     * Acara karier: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/karier/acara/{id}/berkas/{uuid}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAcaraByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/acara/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Pendaftar acara: daftar
     *
     * Mendaftar acara terbit (username otomatis), dicek kuota. Pengelola menandai `hadir` (opsional nomor sertifikat). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/karier/peserta`
     *
     * scope: `karier:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, acara_id?: string, username?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeserta(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/peserta', [], $query, null, $options, false, false);
    }

    /**
     * Pendaftar acara: tambah
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `POST /v1/karier/peserta`
     *
     * scope: `karier:write`
     *
     * @param array{acara_id: int, username: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeserta(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/peserta', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendaftar acara: detail
     *
     * Mendaftar acara terbit (username otomatis), dicek kuota. Pengelola menandai `hadir` (opsional nomor sertifikat). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/karier/peserta/{id}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPesertaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/peserta/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar acara: hapus
     *
     * Pengelola, atau pengguna untuk datanya sendiri (username diisi otomatis).
     *
     * `DELETE /v1/karier/peserta/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deletePesertaById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/peserta/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar acara: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Mendaftar acara terbit (username otomatis), dicek kuota. Pengelola menandai `hadir` (opsional nomor sertifikat). Pengelola melihat semua; pengguna lain hanya miliknya sendiri (username).
     *
     * `GET /v1/karier/peserta/{id}/riwayat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPesertaByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/peserta/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pendaftar acara: Tandai hadir
     *
     * Pengelola modul. Status harus terdaftar, menjadi hadir.
     *
     * `POST /v1/karier/peserta/{id}/hadir`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{sertifikat_nomor?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdHadir(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/peserta/{id}/hadir', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pendaftar acara: Batalkan pendaftaran
     *
     * Pemilik data atau pengelola. Status harus terdaftar, menjadi batal.
     *
     * `POST /v1/karier/peserta/{id}/batal`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPesertaByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/peserta/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perusahaan mitra: daftar
     *
     * Database perusahaan mitra pusat karier. Data perusahaan (nama, alamat, bidang usaha, kontak umum) tetap di tracer_instansi (/v1/tracer/instansi); di sini status kemitraan, kategori, PIC rekrutmen, bidang dan prodi sasaran, serta tautan ke MoU (kerjasama_mitra). Detail memuat lowongan, lamaran, rekomendasi, dan interaksi terakhir. Hanya pengelola modul.
     *
     * `GET /v1/karier/mitra`
     *
     * scope: `karier:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, instansi_id?: string, kerjasama_mitra_id?: string, status?: string, kategori?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitra(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/mitra', [], $query, null, $options, false, false);
    }

    /**
     * Perusahaan mitra: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/karier/mitra`
     *
     * scope: `karier:write`
     *
     * @param array{instansi_id: int, kerjasama_mitra_id?: int, status?: string, kategori?: string, bidang_rekrutmen?: string, prodi_sasaran?: string, pic_nama?: string, pic_jabatan?: string, pic_email?: string, pic_hp?: string, terakhir_kontak?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMitra(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/mitra', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Perusahaan mitra: detail
     *
     * Database perusahaan mitra pusat karier. Data perusahaan (nama, alamat, bidang usaha, kontak umum) tetap di tracer_instansi (/v1/tracer/instansi); di sini status kemitraan, kategori, PIC rekrutmen, bidang dan prodi sasaran, serta tautan ke MoU (kerjasama_mitra). Detail memuat lowongan, lamaran, rekomendasi, dan interaksi terakhir. Hanya pengelola modul.
     *
     * `GET /v1/karier/mitra/{id}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perusahaan mitra: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/mitra/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{instansi_id: int, kerjasama_mitra_id?: int, status?: string, kategori?: string, bidang_rekrutmen?: string, prodi_sasaran?: string, pic_nama?: string, pic_jabatan?: string, pic_email?: string, pic_hp?: string, terakhir_kontak?: string, catatan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMitraById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/mitra/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Perusahaan mitra: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/karier/mitra/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMitraById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/mitra/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perusahaan mitra: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Database perusahaan mitra pusat karier. Data perusahaan (nama, alamat, bidang usaha, kontak umum) tetap di tracer_instansi (/v1/tracer/instansi); di sini status kemitraan, kategori, PIC rekrutmen, bidang dan prodi sasaran, serta tautan ke MoU (kerjasama_mitra). Detail memuat lowongan, lamaran, rekomendasi, dan interaksi terakhir. Hanya pengelola modul.
     *
     * `GET /v1/karier/mitra/{id}/riwayat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMitraByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/mitra/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perusahaan mitra: Aktifkan kemitraan
     *
     * Pengelola modul. Status harus calon/diundang/nonaktif, menjadi aktif.
     *
     * `POST /v1/karier/mitra/{id}/aktifkan`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMitraByIdAktifkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/mitra/{id}/aktifkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perusahaan mitra: Nonaktifkan kemitraan
     *
     * Pengelola modul. Status harus calon/diundang/aktif, menjadi nonaktif.
     *
     * `POST /v1/karier/mitra/{id}/nonaktifkan`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMitraByIdNonaktifkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/mitra/{id}/nonaktifkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Interaksi dengan mitra: daftar
     *
     * Catatan relasi (kunjungan, rapat, email, telepon, pameran, MoU, rekrutmen, magang) beserta tindak lanjut dan tenggat. `terakhir_kontak` mitra diperbarui otomatis. Hanya pengelola modul.
     *
     * `GET /v1/karier/interaksi`
     *
     * scope: `karier:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, mitra_id?: string, jenis?: string, status?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInteraksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/interaksi', [], $query, null, $options, false, false);
    }

    /**
     * Interaksi dengan mitra: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/karier/interaksi`
     *
     * scope: `karier:write`
     *
     * @param array{mitra_id: int, jenis?: string, tanggal: string, ringkasan: string, tindak_lanjut?: string, tenggat?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postInteraksi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/interaksi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Interaksi dengan mitra: detail
     *
     * Catatan relasi (kunjungan, rapat, email, telepon, pameran, MoU, rekrutmen, magang) beserta tindak lanjut dan tenggat. `terakhir_kontak` mitra diperbarui otomatis. Hanya pengelola modul.
     *
     * `GET /v1/karier/interaksi/{id}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInteraksiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/interaksi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Interaksi dengan mitra: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/interaksi/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{mitra_id: int, jenis?: string, tanggal: string, ringkasan: string, tindak_lanjut?: string, tenggat?: string, status?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putInteraksiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/interaksi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Interaksi dengan mitra: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/karier/interaksi/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteInteraksiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/interaksi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Interaksi dengan mitra: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Catatan relasi (kunjungan, rapat, email, telepon, pameran, MoU, rekrutmen, magang) beserta tindak lanjut dan tenggat. `terakhir_kontak` mitra diperbarui otomatis. Hanya pengelola modul.
     *
     * `GET /v1/karier/interaksi/{id}/riwayat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInteraksiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/interaksi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Interaksi dengan mitra: Tandai tindak lanjut selesai
     *
     * Pengelola modul. Status harus terbuka, menjadi selesai.
     *
     * `POST /v1/karier/interaksi/{id}/selesai`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postInteraksiByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/interaksi/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tips dan artikel karier: daftar
     *
     * Artikel pengembangan karier (CV dan lamaran, wawancara, dunia kerja, wirausaha, studi lanjut). Tanpa token hanya yang terbit. Isi berupa teks/Markdown; sampul lewat /berkas. Slug dibuat dari judul bila kosong; terbit_at diisi saat pertama terbit. Semua pemilik token ber-scope karier:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/karier/artikel`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{page?: int, per_page?: int, kategori?: string, status?: string, slug?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArtikel(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/artikel', [], $query, null, $options, false, true);
    }

    /**
     * Tips dan artikel karier: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/karier/artikel`
     *
     * scope: `karier:write`
     *
     * @param array{judul: string, slug?: string, kategori?: string, ringkasan?: string, isi: string, penulis?: string, tag?: string, status?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArtikel(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/artikel', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tips dan artikel karier: detail
     *
     * Artikel pengembangan karier (CV dan lamaran, wawancara, dunia kerja, wirausaha, studi lanjut). Tanpa token hanya yang terbit. Isi berupa teks/Markdown; sampul lewat /berkas. Slug dibuat dari judul bila kosong; terbit_at diisi saat pertama terbit. Semua pemilik token ber-scope karier:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/karier/artikel/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArtikelById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/artikel/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Tips dan artikel karier: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/artikel/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{judul: string, slug?: string, kategori?: string, ringkasan?: string, isi: string, penulis?: string, tag?: string, status?: string, lampiran?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putArtikelById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/artikel/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tips dan artikel karier: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/karier/artikel/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteArtikelById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/artikel/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tips dan artikel karier: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Artikel pengembangan karier (CV dan lamaran, wawancara, dunia kerja, wirausaha, studi lanjut). Tanpa token hanya yang terbit. Isi berupa teks/Markdown; sampul lewat /berkas. Slug dibuat dari judul bila kosong; terbit_at diisi saat pertama terbit. Semua pemilik token ber-scope karier:read (selain pengelola hanya melihat status terbit).
     *
     * `GET /v1/karier/artikel/{id}/riwayat`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArtikelByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/artikel/{id}/riwayat', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Tips dan artikel karier: daftar lampiran
     *
     * Siapa pun yang boleh melihat barisnya.
     *
     * `GET /v1/karier/artikel/{id}/berkas`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getArtikelByIdBerkas(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/artikel/{id}/berkas', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Tips dan artikel karier: unggah lampiran
     *
     * Multipart field "berkas" (atau JSON berkas_base64 + nama_file), opsional jenis dan keterangan. PDF, gambar, dokumen Office/ODF, CSV, TXT, ZIP; maksimal PUSAT_DATA_MAKS_MB (bawaan 20 MB). Pengelola modul.
     *
     * `POST /v1/karier/artikel/{id}/berkas`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{berkas_id?: string, berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jenis?: string, keterangan?: string, berkas_base64?: string, nama_file?: string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postArtikelByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/artikel/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Tips dan artikel karier: unduh lampiran
     *
     * `GET /v1/karier/artikel/{id}/berkas/{uuid}`
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
    public function getArtikelByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/artikel/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, true);
    }

    /**
     * Tips dan artikel karier: hapus lampiran
     *
     * Pengelola modul.
     *
     * `DELETE /v1/karier/artikel/{id}/berkas/{uuid}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param int|string $uuid UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteArtikelByIdBerkasByUuid(int|string $id, int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/artikel/{id}/berkas/{uuid}', ['id' => $id, 'uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: daftar
     *
     * Pengelola merekomendasikan mahasiswa/alumni ke lowongan atau mitra (saran kandidat: GET /v1/karier/lowongan/{id}/saran-kandidat). Hanya profil yang setuju ditampilkan ke mitra. Mahasiswa melihat rekomendasi dirinya dan mendapat notifikasi saat dikirim dan saat mitra menanggapi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/rekomendasi`
     *
     * scope: `karier:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, nim?: string, lowongan_id?: string, mitra_id?: string, status?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekomendasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/rekomendasi', [], $query, null, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/karier/rekomendasi`
     *
     * scope: `karier:write`
     *
     * @param array{nim: string, lowongan_id?: int, mitra_id?: int, skor?: float|int, alasan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRekomendasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/rekomendasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: detail
     *
     * Pengelola merekomendasikan mahasiswa/alumni ke lowongan atau mitra (saran kandidat: GET /v1/karier/lowongan/{id}/saran-kandidat). Hanya profil yang setuju ditampilkan ke mitra. Mahasiswa melihat rekomendasi dirinya dan mendapat notifikasi saat dikirim dan saat mitra menanggapi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/rekomendasi/{id}`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekomendasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/rekomendasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/karier/rekomendasi/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nim: string, lowongan_id?: int, mitra_id?: int, skor?: float|int, alasan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRekomendasiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/karier/rekomendasi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/karier/rekomendasi/{id}`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRekomendasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/karier/rekomendasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pengelola merekomendasikan mahasiswa/alumni ke lowongan atau mitra (saran kandidat: GET /v1/karier/lowongan/{id}/saran-kandidat). Hanya profil yang setuju ditampilkan ke mitra. Mahasiswa melihat rekomendasi dirinya dan mendapat notifikasi saat dikirim dan saat mitra menanggapi. Pengelola melihat semua; pengguna lain hanya miliknya sendiri (nim).
     *
     * `GET /v1/karier/rekomendasi/{id}/riwayat`
     *
     * scope: `karier:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRekomendasiByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/karier/rekomendasi/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: Status: dikirim
     *
     * Pengelola modul. Status harus diusulkan, menjadi dikirim.
     *
     * `POST /v1/karier/rekomendasi/{id}/kirim`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tanggapan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRekomendasiByIdKirim(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/rekomendasi/{id}/kirim', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: Status: diminati
     *
     * Pengelola modul. Status harus dikirim, menjadi diminati.
     *
     * `POST /v1/karier/rekomendasi/{id}/diminati`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tanggapan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRekomendasiByIdDiminati(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/rekomendasi/{id}/diminati', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: Status: ditolak
     *
     * Pengelola modul. Status harus diusulkan/dikirim/diminati, menjadi ditolak.
     *
     * `POST /v1/karier/rekomendasi/{id}/tolak`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tanggapan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRekomendasiByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/rekomendasi/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekomendasi lulusan: Status: direkrut
     *
     * Pengelola modul. Status harus dikirim/diminati, menjadi direkrut.
     *
     * `POST /v1/karier/rekomendasi/{id}/direkrut`
     *
     * scope: `karier:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{tanggapan?: string, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRekomendasiByIdDirekrut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/karier/rekomendasi/{id}/direkrut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
