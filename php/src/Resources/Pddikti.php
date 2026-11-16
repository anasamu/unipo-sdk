<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * PDDikti: Pelaporan, PDDikti: Kirim dan sinkronisasi, PDDikti: Sinkronisasi otomatis, PDDikti: Relay Feeder Desktop, PDDikti: Evaluasi data
 */
final class Pddikti extends Resource
{
    /**
     * Jenis data pelaporan
     *
     * Jenis data yang dilaporkan ke Neo Feeder, halaman kirim lama yang dipakai, tabel lama, kunci baris, dan aksi Neo Feeder.
     *
     * `GET /v1/pddikti/entitas`
     *
     * scope: `pddikti:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEntitas(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/entitas', [], $query, null, $options, false, false);
    }

    /**
     * Monitoring pelaporan
     *
     * Per jenis: jumlah baris, yang tercatat gagal di tabel lama (feeder = 1), isi antrean, waktu terakhir berhasil; status koneksi dan kirim_mode.
     *
     * `GET /v1/pddikti/monitoring`
     *
     * scope: `pddikti:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMonitoring(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/monitoring', [], $query, null, $options, false, false);
    }

    /**
     * Data pelaporan per jenis
     *
     * Baris tabel lama yang dikirim menu PDDikti (syarat sama dengan menu kirim) dengan status_kirim: gagal (pesan Neo Feeder dari kolom error), antre, terkirim (lewat antrean API), atau belum_diketahui (menu lama tidak mencatat kirim berhasil).
     *
     * `GET /v1/pddikti/data/{entitas}`
     *
     * scope: `pddikti:read` · berhalaman
     *
     * @param int|string $entitas mahasiswa, akm, krs, nilai, nilai-transfer, kelas, ajar-dosen, lulus-do, mata-kuliah, kurikulum, skala-nilai, periode
     * @param array{status?: string, q?: string, page?: int, per_page?: int, prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDataByEntitas(int|string $entitas, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/data/{entitas}', ['entitas' => $entitas], $query, null, $options, false, false);
    }

    /**
     * Pesan galat terbanyak
     *
     * Pesan galat Neo Feeder yang tercatat di tabel lama, dikelompokkan, dengan contoh kunci baris.
     *
     * `GET /v1/pddikti/data/{entitas}/galat`
     *
     * scope: `pddikti:read`
     *
     * @param int|string $entitas mahasiswa, akm, krs, nilai, nilai-transfer, kelas, ajar-dosen, lulus-do, mata-kuliah, kurikulum, skala-nilai, periode
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDataByEntitasGalat(int|string $entitas, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/data/{entitas}/galat', ['entitas' => $entitas], $query, null, $options, false, false);
    }

    /**
     * Masukkan ke antrean kirim
     *
     * Body {"kode": ["<kunci baris>", ...]} untuk baris tertentu, atau {"prodi", "tahun_id", "cakupan": "semua"|"gagal", "batas"?} untuk semua baris filter (cakupan gagal = kirim ulang yang gagal). Baris yang masih antre tidak digandakan. Pengiriman berjalan sesuai kirim_mode.
     *
     * `POST /v1/pddikti/kirim/{entitas}`
     *
     * scope: `pddikti:write`
     *
     * @param int|string $entitas mahasiswa, akm, krs, nilai, nilai-transfer, kelas, ajar-dosen, lulus-do, mata-kuliah, kurikulum, skala-nilai, periode
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKirimByEntitas(int|string $entitas, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/kirim/{entitas}', ['entitas' => $entitas], $query, null, $options, false, false);
    }

    /**
     * Antrean dan riwayat sinkronisasi
     *
     * Semua baris antrean: menunggu, proses, berhasil (TAMBAH/UPDATE), gagal (pesan Neo Feeder), batal.
     *
     * `GET /v1/pddikti/antrean`
     *
     * scope: `pddikti:read` · berhalaman
     *
     * @param array{entitas?: string, status?: string, kode?: string, prodi?: string, tahun_id?: string, dari?: string, sampai?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Rincian satu kiriman
     *
     * Termasuk keluaran halaman kirim dan baris sync_log.
     *
     * `GET /v1/pddikti/antrean/{id}`
     *
     * scope: `pddikti:read`
     *
     * @param int|string $id ID antrean
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntreanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/antrean/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim antrean sekarang
     *
     * Body {"batas"?: 20, "id"?: [..], "ulang_gagal"?: true}. Mengirim baris menunggu (urut ketergantungan: periode, skala nilai, mata kuliah, kurikulum, mahasiswa, kelas, dosen ajar, KRS, nilai, AKM, lulus/DO), satu per satu dengan halaman kirim PDDikti lama. Butuh kirim_mode manual/otomatis. Maks. PDDIKTI_BATAS_API baris per permintaan; sisanya lewat cron.
     *
     * `POST /v1/pddikti/antrean/proses`
     *
     * scope: `pddikti:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanProses(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/antrean/proses', [], $query, null, $options, false, false);
    }

    /**
     * Batalkan antrean
     *
     * Untuk baris menunggu atau gagal.
     *
     * `POST /v1/pddikti/antrean/{id}/batal`
     *
     * scope: `pddikti:write`
     *
     * @param int|string $id ID antrean
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAntreanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/antrean/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jalankan jadwal sekarang
     *
     * Masukkan baris yang cocok ke antrean tanpa menunggu waktunya.
     *
     * `POST /v1/pddikti/jadwal/{id}/jalankan`
     *
     * scope: `pddikti:write`
     *
     * @param int|string $id ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwalByIdJalankan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/jadwal/{id}/jalankan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pengaturan kirim
     *
     * kirim_mode (mati/manual/otomatis), batas_per_jalan cron, ulang_maks, dan status koneksi (tanpa password).
     *
     * `GET /v1/pddikti/pengaturan`
     *
     * scope: `pddikti:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah pengaturan kirim
     *
     * ADMIN. Body {"kirim_mode"?: "mati"|"manual"|"otomatis", "batas_per_jalan"?, "ulang_maks"?}. Akun Neo Feeder tetap diatur di menu PDDikti > Setting (tabel serverfeeder) atau .env FEEDER_*.
     *
     * `POST /v1/pddikti/pengaturan`
     *
     * scope: `pddikti:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Status koneksi Neo Feeder
     *
     * Endpoint, sumber pengaturan, username, password terisi atau tidak.
     *
     * `GET /v1/pddikti/koneksi`
     *
     * scope: `pddikti:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKoneksi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/koneksi', [], $query, null, $options, false, false);
    }

    /**
     * Uji koneksi Neo Feeder
     *
     * ADMIN. GetToken lalu GetProfilPT.
     *
     * `POST /v1/pddikti/koneksi/uji`
     *
     * scope: `pddikti:admin`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKoneksiUji(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/koneksi/uji', [], $query, null, $options, false, false);
    }

    /**
     * Status relay Feeder Desktop
     *
     * Jalur Neo Feeder (FEEDER_TRANSPORT: langsung, relay, otomatis), apakah relay sedang dipakai, permintaan yang menunggu, dan daftar aplikasi Feeder Desktop beserta detak terakhirnya.
     *
     * `GET /v1/pddikti/relay`
     *
     * scope: `pddikti:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRelay(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/relay', [], $query, null, $options, false, false);
    }

    /**
     * Detak aplikasi Feeder Desktop
     *
     * Body {"agen_id", "nama_komputer"?, "versi"?, "os"?, "neo_url"?, "neo_terhubung"?, "neo_pesan"?, "pt"?}. Hanya pengelola semua prodi. Aplikasi yang berdetak dalam FEEDER_RELAY_AGEN_DETIK membuat mode otomatis memakai relay.
     *
     * `POST /v1/pddikti/relay/detak`
     *
     * scope: `pddikti:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRelayDetak(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/relay/detak', [], $query, null, $options, false, false);
    }

    /**
     * Ambil permintaan Neo Feeder
     *
     * Long-poll. Body {"agen_id", "tunggu"?: detik (maks. 25, bawaan 20), "maks"?: 1-20}. Mengunci permintaan act Neo Feeder yang menunggu untuk aplikasi ini; payload tanpa token/username/password (aplikasi memakai akun Neo Feeder lokal).
     *
     * `POST /v1/pddikti/relay/ambil`
     *
     * scope: `pddikti:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRelayAmbil(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/relay/ambil', [], $query, null, $options, false, false);
    }

    /**
     * Kirim jawaban Neo Feeder
     *
     * Body {"agen_id", "respons": {error_code, error_desc, data, ...}} apa adanya dari Neo Feeder lokal, atau {"agen_id", "galat": "pesan"} bila Neo Feeder lokal tidak bisa dihubungi.
     *
     * `POST /v1/pddikti/relay/{uuid}/jawab`
     *
     * scope: `pddikti:write`
     *
     * @param int|string $uuid UUID permintaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRelayByUuidJawab(int|string $uuid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/relay/{uuid}/jawab', ['uuid' => $uuid], $query, null, $options, false, false);
    }

    /**
     * Riwayat komparasi
     *
     * `GET /v1/pddikti/komparasi`
     *
     * scope: `pddikti:read` · berhalaman
     *
     * @param array{entitas?: string, prodi?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomparasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/komparasi', [], $query, null, $options, false, false);
    }

    /**
     * Komparasi SIAKAD vs Neo Feeder
     *
     * Body {"entitas": "mahasiswa"|"akm"|"kelas"|"nilai"|"lulus-do"|"mata-kuliah", "prodi", "tahun_id"}. Membaca data Neo Feeder (GetList*) dan SIAKAD, lalu mencatat jumlah cocok, hanya_siakad, hanya_feeder, berbeda dengan contoh barisnya.
     *
     * `POST /v1/pddikti/komparasi`
     *
     * scope: `pddikti:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKomparasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/komparasi', [], $query, null, $options, false, false);
    }

    /**
     * Rincian komparasi
     *
     * Contoh baris per kelompok (maks. 500).
     *
     * `GET /v1/pddikti/komparasi/{id}`
     *
     * scope: `pddikti:read`
     *
     * @param int|string $id ID komparasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKomparasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/komparasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Evaluasi data semester
     *
     * Pemeriksaan sebelum lapor: tanggal kuliah semester, AKM aktif tanpa KRS, KRS tanpa status, SKS > 24, nilai kosong/di luar skala, KRS tanpa kelas, kelas tanpa dosen, dosen/mata kuliah tidak dikenal, IPK di luar 0-4, lulusan belum lengkap. Tiap pemeriksaan: jumlah dan contoh (maks. 50).
     *
     * `GET /v1/pddikti/evaluasi`
     *
     * scope: `pddikti:read`
     *
     * @param array{prodi?: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEvaluasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/evaluasi', [], $query, null, $options, false, false);
    }

    /**
     * Pemutakhiran Data Mahasiswa (PDM)
     *
     * Kekurangan biodata wajib PDDikti per mahasiswa: NIK 16 digit, nama ibu, tempat/tanggal lahir, jenis kelamin, agama, kewarganegaraan, kelurahan, wilayah, NISN (mahasiswa baru), HP/email, tanggal masuk. meta.kekurangan = jumlah per jenis.
     *
     * `GET /v1/pddikti/pdm`
     *
     * scope: `pddikti:read` · berhalaman
     *
     * @param array{prodi?: string, angkatan?: string, status?: string, hanya_kurang?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPdm(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/pdm', [], $query, null, $options, false, false);
    }

    /**
     * Simulasi PISN
     *
     * Kesiapan lulusan (status L) untuk penomoran ijazah nasional: NIK, tempat/tanggal lahir, tanggal lulus, SK yudisium, judul TA, IPK, SKS minimal prodi, akreditasi prodi pada tanggal lulus, status kirim lulus ke Neo Feeder, PIN yang sudah ada.
     *
     * `GET /v1/pddikti/pisn`
     *
     * scope: `pddikti:read`
     *
     * @param array{prodi?: string, tahun_id?: string, nim?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPisn(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/pisn', [], $query, null, $options, false, false);
    }

    /**
     * Jadwal sinkronisasi otomatis: daftar
     *
     * Pada waktunya (cron `php artisan pddikti:kirim --cron`), baris yang cocok dimasukkan ke antrean kirim lalu dikirim bila kirim_mode otomatis. cakupan gagal = hanya baris yang tercatat gagal di tabel lama (kirim ulang), semua = semua baris filter. tahun_id kosong/"aktif" = tahun akademik aktif. Hanya pengelola modul.
     *
     * `GET /v1/pddikti/jadwal`
     *
     * scope: `pddikti:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, entitas?: string, kode_prodi?: string, cakupan?: string, frekuensi?: string, aktif?: string, q?: string, dari?: string, sampai?: string, urut?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/jadwal', [], $query, null, $options, false, false);
    }

    /**
     * Jadwal sinkronisasi otomatis: tambah
     *
     * Pengelola modul.
     *
     * `POST /v1/pddikti/jadwal`
     *
     * scope: `pddikti:write`
     *
     * @param array{nama: string, entitas: string, kode_prodi?: string, tahun_id?: string, cakupan?: string, frekuensi?: string, jam?: int, hari?: int, batas?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postJadwal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pddikti/jadwal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jadwal sinkronisasi otomatis: detail
     *
     * Pada waktunya (cron `php artisan pddikti:kirim --cron`), baris yang cocok dimasukkan ke antrean kirim lalu dikirim bila kirim_mode otomatis. cakupan gagal = hanya baris yang tercatat gagal di tabel lama (kirim ulang), semua = semua baris filter. tahun_id kosong/"aktif" = tahun akademik aktif. Hanya pengelola modul.
     *
     * `GET /v1/pddikti/jadwal/{id}`
     *
     * scope: `pddikti:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/jadwal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jadwal sinkronisasi otomatis: ubah
     *
     * Pengelola modul. Kolom yang tidak dikirim tidak berubah.
     *
     * `PUT /v1/pddikti/jadwal/{id}`
     *
     * scope: `pddikti:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array{nama: string, entitas: string, kode_prodi?: string, tahun_id?: string, cakupan?: string, frekuensi?: string, jam?: int, hari?: int, batas?: int, aktif?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putJadwalById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pddikti/jadwal/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jadwal sinkronisasi otomatis: hapus
     *
     * Pengelola modul.
     *
     * `DELETE /v1/pddikti/jadwal/{id}`
     *
     * scope: `pddikti:write`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteJadwalById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pddikti/jadwal/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jadwal sinkronisasi otomatis: riwayat status
     *
     * Linimasa baris dari jejak audit: diajukan, diubah, aksi alur kerja (proses, setujui, tolak, ...) beserta catatan/alasan, lampiran ditambah/dihapus, pelaku, dan waktu. Pada waktunya (cron `php artisan pddikti:kirim --cron`), baris yang cocok dimasukkan ke antrean kirim lalu dikirim bila kirim_mode otomatis. cakupan gagal = hanya baris yang tercatat gagal di tabel lama (kirim ulang), semua = semua baris filter. tahun_id kosong/"aktif" = tahun akademik aktif. Hanya pengelola modul.
     *
     * `GET /v1/pddikti/jadwal/{id}/riwayat`
     *
     * scope: `pddikti:read`
     *
     * @param int|string $id ID angka atau UUID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getJadwalByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pddikti/jadwal/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }
}
