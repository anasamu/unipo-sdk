<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Panitia: Kepanitiaan, Panitia: Persetujuan Pustikom, Panitia: Jenis panitia
 */
final class Panitia extends Resource
{
    /**
     * Hak dan keanggotaan saya
     *
     * Izin panitia.lihat/kelola/setujui/atur beserta unitnya (boleh.*), unit tempat boleh membentuk panitia, dan panitia tempat saya menjadi anggota beserta status hak aksesnya.
     *
     * `GET /v1/panitia/saya`
     *
     * scope: `panitia:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/saya', [], $query, null, $options, false, false);
    }

    /**
     * Pilihan form panitia
     *
     * Jenis panitia aktif (jabatan, peran, dan aplikasi tiap jabatan), unit yang boleh dikelola, dan status.
     *
     * `GET /v1/panitia/referensi`
     *
     * scope: `panitia:read`
     *
     * @param array{jenis_unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Cari akun untuk anggota
     *
     * Akun SIAKAD aktif (dosen, tendik, mahasiswa). q minimal 2 karakter, maks. 20 baris. Izin panitia.kelola.
     *
     * `GET /v1/panitia/pengguna`
     *
     * scope: `panitia:read`
     *
     * @param array{q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengguna(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/pengguna', [], $query, null, $options, false, false);
    }

    /**
     * Antrean hak akses panitia
     *
     * Izin panitia.setujui (Pustikom). Setiap baris = satu peran untuk satu anggota, beserta panitia, SK, masa berlaku, dan aplikasi yang terbuka bila disetujui.
     *
     * `GET /v1/panitia/akses`
     *
     * scope: `panitia:read` · berhalaman
     *
     * @param array{status?: string, panitia_id?: string, unit_id?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAkses(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/akses', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan antrean
     *
     * Jumlah pengajuan menunggu, panitia menunggu, panitia aktif, akses aktif, dan panitia yang berakhir 7 hari lagi. Izin panitia.setujui.
     *
     * `GET /v1/panitia/akses/ringkasan`
     *
     * scope: `panitia:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAksesRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/akses/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Setujui atau tolak
     *
     * Izin `panitia.setujui` (Pustikom). Body: `{"keputusan": "setujui|tolak", "akses_id": ["uuid", ...], "catatan": "..."}` atau `{"keputusan": "setujui", "panitia_id": "uuid"}` untuk semua pengajuan panitia itu.
     * Disetujui = baris `rbac_penugasan` (sumber aplikasi, mulai/selesai = masa SK, nomor SK, unit panitia untuk peran berlingkup unit); anggota diberi notifikasi dan aplikasinya tampil di portal SSO.
     * Tolak wajib `catatan`. Hasil: `{"disetujui": n, "ditolak": n, "dilewati": [{"id", "alasan"}]}`.
     *
     * `POST /v1/panitia/akses/putuskan`
     *
     * scope: `panitia:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAksesPutuskan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/akses/putuskan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut hak akses
     *
     * Pustikom (panitia.setujui) atau pembentuk panitia (panitia.kelola di unitnya). Penugasan RBAC dinonaktifkan hari ini. Body: {"catatan"?}.
     *
     * `POST /v1/panitia/akses/{id}/cabut`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID akses
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAksesByIdCabut(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/akses/{id}/cabut', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar jenis panitia
     *
     * Jenis, jenis unit pembentuk, kewajiban SK, batas masa, jabatan, peran, dan aplikasi tiap jabatan. semua=1 (panitia.atur) menyertakan yang nonaktif.
     *
     * `GET /v1/panitia/jenis`
     *
     * scope: `panitia:read`
     *
     * @param array{semua?: string, jenis_unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/jenis', [], $query, null, $options, false, false);
    }

    /**
     * Tambah jenis panitia
     *
     * Izin `panitia.atur` (Pustikom). Body: `{"kode": "dies-natalis", "nama": "Panitia dies natalis", "keterangan"?, "jenis_unit": ["universitas"] (kosong = semua unit), "wajib_sk": true, "masa_maks_hari"?,
     * "jabatan": [{"kode": "ketua", "nama": "Ketua", "wajib": true, "maks": 1, "peran": ["kode-peran", ...]}, {"kode": "anggota", "nama": "Anggota", "peran": []}]}`.
     *
     * `POST /v1/panitia/jenis`
     *
     * scope: `panitia:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenis(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/jenis', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pilihan peran untuk jabatan
     *
     * Peran RBAC aktif yang boleh diberikan lewat panitia (tanpa peran admin), dengan lingkup dan aplikasi yang dibukanya. Izin panitia.atur.
     *
     * `GET /v1/panitia/jenis/peran`
     *
     * scope: `panitia:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJenisPeran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/jenis/peran', [], $query, null, $options, false, false);
    }

    /**
     * Ubah jenis panitia
     *
     * Body sama dengan tambah (sebagian). jabatan dikirim lengkap; jabatan yang sudah dipakai anggota tidak bisa dihapus. Perubahan peran berlaku untuk pengajuan berikutnya.
     *
     * `POST /v1/panitia/jenis/{id}`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id ID, UUID, atau kode jenis
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenisById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/jenis/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus jenis panitia
     *
     * Jenis yang sudah dipakai panitia hanya dinonaktifkan.
     *
     * `POST /v1/panitia/jenis/{id}/hapus`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id ID, UUID, atau kode jenis
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJenisByIdHapus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/jenis/{id}/hapus', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar panitia
     *
     * Panitia di unit yang boleh dilihat (panitia.lihat, unit dan turunannya; Pustikom semua).
     *
     * `GET /v1/panitia`
     *
     * scope: `panitia:read` · berhalaman
     *
     * @param array{status?: string, jenis?: string, unit_id?: string, unit_saja?: string, tahun_id?: string, menunggu?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia', [], $query, null, $options, false, false);
    }

    /**
     * Bentuk panitia (draf)
     *
     * Izin `panitia.kelola` di unit pembentuk. Body: `{"jenis_id": 2 | "wisuda", "unit_id": 1, "nama": "Panitia Wisuda 2026", "keterangan"?, "tahun_id"?,
     * "nomor_sk"?, "tanggal_sk"?, "penetap_sk"?, "mulai": "2026-11-20", "selesai": "2027-01-31", "anggota"?: [{"username", "jabatan_id", "uraian"?}]}`.
     * Jenis panitia menentukan jenis unit yang boleh membentuk. SK dilampirkan lewat `POST /v1/panitia/{id}/sk`.
     *
     * `POST /v1/panitia`
     *
     * scope: `panitia:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail panitia
     *
     * SK, masa, anggota beserta jabatan dan status tiap hak akses, jabatan jenis ini (peran + aplikasi), hal yang masih menghalangi pengajuan (masalah), dan tombol yang boleh (boleh.*).
     *
     * `GET /v1/panitia/{id}`
     *
     * scope: `panitia:read`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah panitia
     *
     * Draf: semua isian. Aktif: hanya nama dan keterangan (SK dan masa terkunci; gunakan salin untuk SK perubahan/perpanjangan).
     *
     * `POST /v1/panitia/{id}`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lihat/unduh SK
     *
     * ?unduh=1 untuk mengunduh. Pembentuk, pelihat unit, dan Pustikom.
     *
     * `GET /v1/panitia/{id}/sk`
     *
     * scope: `panitia:read`
     *
     * @param int|string $id UUID panitia
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdSk(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/{id}/sk', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lampirkan SK
     *
     * Unggah dulu ke storage (POST /v1/berkas), lalu body: {"berkas_id", "nomor_sk", "tanggal_sk"?, "penetap_sk"?}. Hanya saat draf.
     *
     * `POST /v1/panitia/{id}/sk`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdSk(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/sk', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah anggota
     *
     * Body: {"anggota": [{"username", "jabatan_id", "uraian"?}]} atau satu objek. Pada panitia aktif, hak akses anggota baru langsung diajukan ke Pustikom.
     *
     * `POST /v1/panitia/{id}/anggota`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAnggota(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/anggota', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keluarkan anggota
     *
     * Hak akses anggota itu langsung dicabut (penugasan RBAC dinonaktifkan). Body: {"catatan"?}.
     *
     * `POST /v1/panitia/{id}/anggota/{anggota}/hapus`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param int|string $anggota UUID anggota
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAnggotaByAnggotaHapus(int|string $id, int|string $anggota, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/anggota/{anggota}/hapus', ['id' => $id, 'anggota' => $anggota], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan hak akses ke Pustikom
     *
     * Syarat: SK terlampir (bila jenis mewajibkan), ada anggota, jabatan wajib terisi, batas jabatan dipatuhi, masa belum lewat. Status menjadi aktif; setiap anggota x peran jabatannya diajukan ke Pustikom. Body: {"catatan"?}.
     *
     * `POST /v1/panitia/{id}/ajukan`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan ulang akses ditolak
     *
     * Peran yang ditolak/dicabut untuk anggota yang masih ada diajukan lagi. Body: {"catatan"?}.
     *
     * `POST /v1/panitia/{id}/ajukan-ulang`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAjukanUlang(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/ajukan-ulang', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bubarkan panitia
     *
     * Mengakhiri panitia aktif lebih awal; semua hak akses dicabut hari ini. Body: {"catatan"} (wajib).
     *
     * `POST /v1/panitia/{id}/bubarkan`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdBubarkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/bubarkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus draf
     *
     * Hanya draf.
     *
     * `POST /v1/panitia/{id}/hapus`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/hapus', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin jadi draf baru
     *
     * Untuk SK perpanjangan/perubahan atau periode berikutnya. Body: {"selesai" (wajib), "mulai"?, "nama"?, "tahun_id"?, "tanpa_anggota"?}. Anggota yang akunnya masih aktif ikut disalin.
     *
     * `POST /v1/panitia/{id}/salin`
     *
     * scope: `panitia:write`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/panitia/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat panitia
     *
     * Pembentukan, perubahan, SK, anggota, pengajuan, keputusan Pustikom, pencabutan, dan berakhirnya panitia.
     *
     * `GET /v1/panitia/{id}/riwayat`
     *
     * scope: `panitia:read`
     *
     * @param int|string $id UUID panitia
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/panitia/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }
}
