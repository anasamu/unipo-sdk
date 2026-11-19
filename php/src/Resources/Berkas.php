<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Berkas, Berkas: Unggah bertahap, Berkas: Folder, Berkas: Unit dan periode, Berkas: Berbagi, Berkas: Enkripsi, Penyimpanan, Penyimpanan: Unit, Penyimpanan: Pustikom
 */
final class Berkas extends Resource
{
    /**
     * Batas dan penyimpanan aktif
     *
     * Ukuran maksimal, batas sekali unggah dari php.ini server, ukuran potongan unggah bertahap, ekstensi yang diizinkan, dan penyimpanan tujuan (lokal/S3/R2/MinIO/Google Drive). Dipakai aplikasi untuk memilih cara unggah.
     *
     * `GET /v1/berkas/info`
     *
     * scope: `berkas:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfo(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/info', [], $query, null, $options, false, false);
    }

    /**
     * Daftar berkas saya
     *
     * Token pengguna: berkas milik pengguna itu. Token aplikasi: berkas yang diunggah aplikasi itu. berkas:admin: semua (filter `pemilik`, `klien_id`), dan `?terhapus=1` untuk sampah.
     *
     * `GET /v1/berkas`
     *
     * scope: `berkas:read` · berhalaman
     *
     * @param array{kategori?: string, modul?: string, status?: string, folder?: string, dalam?: string, jenis?: string, ekstensi?: string, urut?: string, unit?: string, bagi?: string, periode?: string, terenkripsi?: string, q?: string, pemilik?: string, klien_id?: string, terhapus?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas', [], $query, null, $options, false, false);
    }

    /**
     * Unggah berkas
     *
     * multipart/form-data field `berkas` (atau JSON `berkas_base64` + `nama_file` untuk file kecil). Atribut opsional: `kategori` (dokumen, foto, lampiran, tugas, …), `modul` (aplikasi/modul pemakai), `folder`, `keterangan`, `visibilitas` (privat/publik), `penyimpanan` (kode penyedia; bawaan penyimpanan utama), `unit` (simpan di ruang bersama unit), `periode` (kode periode akademik; bawaan periode aktif), `enkripsi` (true = enkripsi isi di server; bisa diwajibkan kebijakan). Jenis file diperiksa dari isinya. File di atas `batas_sekali_unggah_byte` (lihat /info) pakai unggah bertahap.
     *
     * `POST /v1/berkas`
     *
     * scope: `berkas:write`
     *
     * @param array{berkas?: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, berkas_base64?: string|null, nama_file?: string|null, kategori?: string|null, modul?: string|null, folder?: string|null, keterangan?: string|null, visibilitas?: string|null, penyimpanan?: string|null, unit?: string|null, periode?: string|null, enkripsi?: bool, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas', [], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Mulai unggah bertahap
     *
     * Untuk file besar atau hosting dengan upload_max_filesize kecil. Body JSON: `nama`, `ukuran` (byte), opsional `ukuran_potongan` (bawaan dari /info). Atribut opsional: `kategori` (dokumen, foto, lampiran, tugas, …), `modul` (aplikasi/modul pemakai), `folder`, `keterangan`, `visibilitas` (privat/publik), `penyimpanan` (kode penyedia; bawaan penyimpanan utama), `unit` (simpan di ruang bersama unit), `periode` (kode periode akademik; bawaan periode aktif), `enkripsi` (true = enkripsi isi di server; bisa diwajibkan kebijakan). Lalu kirim setiap potongan ke POST /v1/berkas/{id}/potongan/{ke} (boleh paralel, boleh diulang), dan akhiri dengan POST /v1/berkas/{id}/selesai. Sesi yang tidak selesai dihapus setelah BERKAS_SESI_JAM.
     *
     * `POST /v1/berkas/bertahap`
     *
     * scope: `berkas:write`
     *
     * @param array{nama: string|null, ukuran: int|null, ukuran_potongan?: int|null, kategori?: string|null, modul?: string|null, folder?: string|null, keterangan?: string|null, visibilitas?: string|null, penyimpanan?: string|null, unit?: string|null, periode?: string|null, enkripsi?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBertahap(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/bertahap', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Minta URL unggah langsung ke bucket
     *
     * Khusus penyimpanan S3/R2/MinIO: body `nama`, `ukuran` (byte), `mime`. Kirim isi file dengan PUT ke `unggah.url` beserta `unggah.header` langsung dari browser/aplikasi (tidak lewat server SIAKAD), lalu POST /v1/berkas/{id}/selesai; SIAKAD memeriksa isinya sebelum berkas tersedia.
     *
     * `POST /v1/berkas/unggah-langsung`
     *
     * scope: `berkas:write`
     *
     * @param array{nama: string|null, ukuran: int|null, mime: string|null, kategori?: string|null, modul?: string|null, folder?: string|null, keterangan?: string|null, visibilitas?: string|null, penyimpanan?: string|null, unit?: string|null, periode?: string|null, enkripsi?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postUnggahLangsung(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/unggah-langsung', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unduh dengan tautan sementara
     *
     * Tautan dari /v1/berkas/{id}/url (tanpa token akses; berlaku sampai waktu di dalamnya). PDF/gambar tampil di browser; `?unduh=1` memaksa unduh.
     *
     * `GET /v1/berkas/unduh/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnduhByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/unduh/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Daftar folder saya
     *
     * Semua folder pemanggil (pohon datar: `path`, `induk`, `nama`) dengan jumlah dan ukuran isi langsung maupun total termasuk subfolder, plus ringkasan `akar`. Folder berasal dari kolom `folder` berkas dan folder kosong yang dibuat lewat POST /v1/berkas/folder. Isi folder: GET /v1/berkas?folder=path (atau `folder=/` untuk akar, `dalam=path` termasuk subfolder).
     *
     * `GET /v1/berkas/folder`
     *
     * scope: `berkas:read`
     *
     * @param array{modul?: string, unit?: string, bagi?: string, periode?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFolder(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/folder', [], $query, null, $options, false, false);
    }

    /**
     * Buat folder
     *
     * Body: `nama`, opsional `induk` (path folder induk; kosong = akar), `warna`, `modul`. Nama boleh berisi spasi dan huruf apa pun (mis. "Surat Masuk 2026"). 409 folder_sudah_ada.
     *
     * `POST /v1/berkas/folder`
     *
     * scope: `berkas:write`
     *
     * @param array{nama: string|null, induk?: string|null, warna?: string|null, modul?: string|null, unit?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolder(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ganti nama, pindah, atau ganti warna folder
     *
     * Body: `path` (folder yang diubah), opsional `nama` (nama baru), `induk_baru` (null = akar), `warna`, `modul`. Subfolder dan berkas di dalamnya ikut; isi file di penyimpanan tidak dipindah.
     *
     * `POST /v1/berkas/folder/ubah`
     *
     * scope: `berkas:write`
     *
     * @param array{path: string|null, nama?: string|null, induk_baru?: string|null, warna?: string|null, modul?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolderUbah(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder/ubah', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus folder
     *
     * Body: `path`, opsional `isi` (true = berkas di dalamnya ikut pindah ke sampah), `modul`. Folder berisi tanpa `isi` ditolak 409 folder_berisi; berkas yang masih dipakai data modul membatalkan seluruhnya (409 berkas_dipakai). Hapus permanen tetap hanya admin.
     *
     * `POST /v1/berkas/folder/hapus`
     *
     * scope: `berkas:write`
     *
     * @param array{path: string|null, isi?: bool, modul?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolderHapus(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder/hapus', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pindahkan banyak berkas
     *
     * Body: `id` (1-100 UUID), `folder` (path tujuan; null/"" = akar). Hasil: `dipindah` dan `gagal` per berkas.
     *
     * `POST /v1/berkas/pindah`
     *
     * scope: `berkas:write`
     *
     * @param array{id: list<mixed>, folder: string|null, tujuan_unit?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPindah(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/pindah', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus banyak berkas
     *
     * Body: `id` (1-100 UUID). Soft delete seperti /v1/berkas/{id}/hapus; berkas yang masih dipakai dilaporkan di `gagal`.
     *
     * `POST /v1/berkas/hapus-banyak`
     *
     * scope: `berkas:write`
     *
     * @param array{id: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postHapusBanyak(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/hapus-banyak', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unit yang bisa saya buka
     *
     * Ruang berkas bersama unit (BAAK, BAUK, SDM, LPM, PMB, LPPM, Humas, fakultas, prodi, ...) yang bisa dibuka pemanggil, dengan `akses` (anggota/kelola) dan kebijakan enkripsi efektif. Anggota: izin RBAC <aplikasi>.berkas atau petugas arsip unit; pengelola: <aplikasi>.berkas.kelola atau admin/pimpinan unit. `?semua=1` menambah `semua`: daftar semua unit aktif (kode dan nama saja) untuk tujuan berbagi.
     *
     * `GET /v1/berkas/unit`
     *
     * scope: `berkas:read`
     *
     * @param array{semua?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/unit', [], $query, null, $options, false, false);
    }

    /**
     * Periode akademik berkas
     *
     * Periode akademik (m_tahun) yang dipakai berkas di ruang ini, dengan jumlah dan ukuran berkasnya, ditambah periode aktif. Ruang: `unit` (kode unit, mis. baak, bauk, fak-ft; ruang bersama anggota unit), `bagi` (UUID folder yang dibagikan ke saya), atau ruang pribadi per `modul`. Pakai `periode` di GET /v1/berkas dan /v1/berkas/folder untuk mengelompokkan berkas per periode.
     *
     * `GET /v1/berkas/periode`
     *
     * scope: `berkas:read`
     *
     * @param array{unit?: string, modul?: string, bagi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/periode', [], $query, null, $options, false, false);
    }

    /**
     * Salin banyak berkas
     *
     * Body: `id` (1-100 UUID), `folder` (tujuan; null = akar), opsional `tujuan_unit` (kode unit; null/"" = ruang pribadi). Isi berkas di penyimpanan dipakai bersama sampai salah satunya diubah. Nama yang bentrok diberi akhiran "(salinan)".
     *
     * `POST /v1/berkas/salin`
     *
     * scope: `berkas:write`
     *
     * @param array{id: list<mixed>, folder?: string|null, tujuan_unit?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSalin(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/salin', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin folder
     *
     * Body: `path`, `induk_baru` (null = akar), opsional `tujuan_unit`. Subfolder dan berkas ikut disalin. Ruang: `unit` (kode unit, mis. baak, bauk, fak-ft; ruang bersama anggota unit), `bagi` (UUID folder yang dibagikan ke saya), atau ruang pribadi per `modul`.
     *
     * `POST /v1/berkas/folder/salin`
     *
     * scope: `berkas:write`
     *
     * @param array{path: string|null, induk_baru?: string|null, unit?: string|null, modul?: string|null, tujuan_unit?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolderSalin(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder/salin', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar berbagi folder
     *
     * Query `path` + ruang. Ruang: `unit` (kode unit, mis. baak, bauk, fak-ft; ruang bersama anggota unit), `bagi` (UUID folder yang dibagikan ke saya), atau ruang pribadi per `modul`.
     *
     * `GET /v1/berkas/folder/bagikan`
     *
     * scope: `berkas:read`
     *
     * @param array{path?: string, unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getFolderBagikan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/folder/bagikan', [], $query, null, $options, false, false);
    }

    /**
     * Bagikan folder
     *
     * Body: `path`, `ke_jenis` (pengguna, unit, tautan), `ke` (username/kode unit), `izin` (lihat/ubah), opsional `kedaluwarsa_at`, `sandi` (tautan), `pesan`. Subfolder dan berkas di dalamnya ikut terbagi, termasuk yang ditambahkan kemudian. Ruang: `unit` (kode unit, mis. baak, bauk, fak-ft; ruang bersama anggota unit), `bagi` (UUID folder yang dibagikan ke saya), atau ruang pribadi per `modul`.
     *
     * `POST /v1/berkas/folder/bagikan`
     *
     * scope: `berkas:write`
     *
     * @param array{path?: string|null, unit?: string|null, ke_jenis: string|null, ke?: string|null, izin?: string|null, kedaluwarsa_at?: string|null, sandi?: string|null, pesan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postFolderBagikan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/folder/bagikan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dibagikan ke saya
     *
     * Berkas dan folder yang dibagikan ke pemanggil langsung atau lewat unitnya (`arah=keluar`: yang saya bagikan). Buka isi folder bersama dengan GET /v1/berkas?bagi=<id>.
     *
     * `GET /v1/berkas/dibagikan`
     *
     * scope: `berkas:read`
     *
     * @param array{arah?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getDibagikan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/dibagikan', [], $query, null, $options, false, false);
    }

    /**
     * Cabut berbagi
     *
     * Menghentikan berbagi (termasuk tautan publik). Oleh yang membagikan, pemilik berkas, atau pengelola unit.
     *
     * `POST /v1/berkas/bagikan/{id}/cabut`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID data berbagi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBagikanByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/bagikan/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buka tautan publik
     *
     * Tanpa token akses. Berkas: info dan alamat unduh. Folder: subfolder dan berkas di `folder` (bawaan akar tautan). Tautan bersandi: header `X-Sandi-Tautan` atau `?sandi=`; tanpa sandi 401 sandi_tautan.
     *
     * `GET /v1/berkas/tautan/{token}`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param array{folder?: string, sandi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTautanByToken(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/tautan/{token}', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Unduh dari tautan publik
     *
     * Berkas yang dibagikan, atau `id` berkas di dalam folder yang dibagikan. Berkas terenkripsi didekripsi server.
     *
     * `GET /v1/berkas/tautan/{token}/unduh`
     *
     * publik (tanpa token)
     *
     * @param int|string $token Token tautan
     * @param array{id?: string, unduh?: string, sandi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getTautanByTokenUnduh(int|string $token, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/tautan/{token}/unduh', ['token' => $token], $query, null, $options, false, true);
    }

    /**
     * Kebijakan enkripsi
     *
     * Kebijakan global (Pustikom), unit, dan pengguna yang berlaku untuk ruang ini serta `efektif` (mati, opsional, wajib). Isi berkas terenkripsi disimpan AES-256-GCM; penyedia storage hanya melihat teks sandi. Ruang: `unit` (kode unit, mis. baak, bauk, fak-ft; ruang bersama anggota unit), `bagi` (UUID folder yang dibagikan ke saya), atau ruang pribadi per `modul`.
     *
     * `GET /v1/berkas/kebijakan`
     *
     * scope: `berkas:read`
     *
     * @param array{unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKebijakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/kebijakan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah kebijakan enkripsi
     *
     * Body: `lingkup` global (berkas:admin; mati/opsional/wajib), unit (pengelola unit + `unit`; opsional/wajib), atau pengguna (diri sendiri; opsional/wajib), `enkripsi`, opsional `catatan`. Berlaku untuk berkas baru; berkas lama dienkripsi lewat POST /v1/berkas/{id}/enkripsi.
     *
     * `POST /v1/berkas/kebijakan`
     *
     * scope: `berkas:write`
     *
     * @param array{lingkup: string|null, unit?: string|null, enkripsi: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKebijakan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/kebijakan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail berkas
     *
     * Termasuk `url` sementara, status sesi unggah bertahap (`sesi.diterima` untuk melanjutkan unggahan yang terputus), dan `dipakai` (data modul yang memakai berkas ini).
     *
     * `GET /v1/berkas/{id}`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus berkas
     *
     * Sama dengan POST /v1/berkas/{id}/hapus (soft delete).
     *
     * `DELETE /v1/berkas/{id}`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/berkas/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh isi berkas
     *
     * Respons file (bukan JSON). Disk lokal/Google Drive: dialirkan dari server. S3/R2/MinIO: 302 ke URL sementara bucket, kecuali `?lewat_server=1`. PDF/gambar/video tampil inline; `?unduh=1` memaksa unduh.
     *
     * `GET /v1/berkas/{id}/unduh`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID berkas
     * @param array{unduh?: string, lewat_server?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdUnduh(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/{id}/unduh', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tautan unduh sementara
     *
     * Untuk <img>, <a>, atau pratinjau PDF tanpa header Authorization. Presigned URL (S3/R2/MinIO) atau tautan bertanda tangan SIAKAD.
     *
     * `GET /v1/berkas/{id}/url`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID berkas
     * @param array{ttl?: string, unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdUrl(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/{id}/url', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah nama/kategori/keterangan/folder
     *
     * Body: `nama` (ekstensi tetap), `kategori`, `keterangan`, `folder` (pindah; null/"" = akar). Isi file tidak bisa diganti; unggah berkas baru.
     *
     * `POST /v1/berkas/{id}/ubah`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{nama?: string|null, kategori?: string|null, keterangan?: string|null, folder?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUbah(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/ubah', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus berkas (POST)
     *
     * Soft delete: berkas pindah ke sampah dan tidak tampil lagi, isinya tetap di penyimpanan. Hapus permanen hanya admin lewat /hapus-permanen. Ditolak (409 berkas_dipakai) bila masih dipakai data modul; berkas:admin bisa `?paksa=1`.
     *
     * `POST /v1/berkas/{id}/hapus`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar berbagi berkas
     *
     * Siapa saja yang menerima berkas ini dan tautan publiknya.
     *
     * `GET /v1/berkas/{id}/bagikan`
     *
     * scope: `berkas:read`
     *
     * @param int|string $id UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdBagikan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/{id}/bagikan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bagikan berkas
     *
     * Body: `ke_jenis` (pengguna, unit, tautan), `ke` (username/kode unit), `izin` (lihat/ubah; tautan hanya lihat), opsional `kedaluwarsa_at`, `sandi` (tautan), `pesan`.
     *
     * `POST /v1/berkas/{id}/bagikan`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{path?: string|null, unit?: string|null, ke_jenis: string|null, ke?: string|null, izin?: string|null, kedaluwarsa_at?: string|null, sandi?: string|null, pesan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdBagikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/bagikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Enkripsi atau buka enkripsi berkas
     *
     * Body `aktif` (true/false). Isi ditulis ulang ke objek baru di penyimpanan yang sama. Ditolak bila kebijakan mewajibkan enkripsi (buka) atau mematikannya (aktifkan).
     *
     * `POST /v1/berkas/{id}/enkripsi`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{aktif: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdEnkripsi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/enkripsi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pulihkan dari sampah (admin)
     *
     * Mengembalikan berkas yang dihapus pengguna atau yang lampirannya dihapus.
     *
     * `POST /v1/berkas/{id}/pulihkan`
     *
     * scope: `berkas:admin`
     *
     * @param int|string $id UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPulihkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/pulihkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus permanen (admin)
     *
     * Isi file ikut dihapus dari penyimpanan (S3/R2/MinIO/Google Drive/disk) dan tidak bisa dipulihkan. Berlaku untuk berkas di sampah maupun yang aktif (`?paksa=1` bila masih dipakai).
     *
     * `POST /v1/berkas/{id}/hapus-permanen`
     *
     * scope: `berkas:admin`
     *
     * @param int|string $id UUID berkas
     * @param array{paksa?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapusPermanen(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/hapus-permanen', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim satu potongan
     *
     * multipart/form-data field `potongan` berisi bagian file dari byte ke×ukuran_potongan. Semua potongan berukuran `ukuran_potongan` kecuali yang terakhir. Mengirim ulang nomor yang sama menimpa potongan itu.
     *
     * `POST /v1/berkas/{id}/potongan/{ke}`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param int|string $ke Nomor potongan, mulai 0
     * @param array{potongan: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPotonganByKe(int|string $id, int|string $ke, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/potongan/{ke}', ['id' => $id, 'ke' => $ke], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Selesaikan unggahan
     *
     * Unggah bertahap: gabungkan potongan, periksa isi, simpan ke penyimpanan (409 potongan_kurang memuat nomor yang belum ada). Unggah langsung: periksa berkas di bucket.
     *
     * `POST /v1/berkas/{id}/selesai`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdSelesai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/selesai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Catat pemakaian berkas
     *
     * Untuk aplikasi yang menyimpan UUID berkas di datanya sendiri: body `modul`, `tabel`, `baris` (ID/UUID), opsional `peran`. Berkas yang dipakai tidak bisa dihapus sampai dilepas.
     *
     * `POST /v1/berkas/{id}/pakai`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{modul?: string|null, tabel: string|null, baris: string|null, peran?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPakai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/pakai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas pemakaian berkas
     *
     * Body `tabel`, `baris`.
     *
     * `POST /v1/berkas/{id}/lepas`
     *
     * scope: `berkas:write`
     *
     * @param int|string $id UUID berkas
     * @param array{modul?: string|null, tabel: string|null, baris: string|null, peran?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdLepas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/{id}/lepas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Penyimpanan saya
     *
     * Kuota efektif beserta asalnya, terpakai, sisa, per modul dan jenis berkas, kolam unit, berkas terbesar, sampah, tren, riwayat permintaan tambah kuota, dan aturan resolusi. Hanya metadata.
     *
     * `GET /v1/berkas/penyimpanan/saya`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Kebijakan efektif untuk unggah
     *
     * Batas ukuran, jenis berkas, kuota dan sisa untuk ruang pribadi pemanggil atau ruang bersama `unit`. Dipakai komponen unggah unipo-ui sebelum mengunggah.
     *
     * `GET /v1/berkas/penyimpanan/efektif`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananEfektif(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/efektif', [], $query, null, $options, false, false);
    }

    /**
     * Daftar permintaan tambah kuota
     *
     * `arah=saya` (bawaan) atau `arah=periksa` (pengelola unit: unitnya; Pustikom: semua). `status` = menunggu, menunggu_unit, menunggu_pustikom, disetujui, ditolak.
     *
     * `GET /v1/berkas/penyimpanan/permintaan`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{arah?: string, status?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananPermintaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/permintaan', [], $query, null, $options, false, false);
    }

    /**
     * Minta tambah kuota
     *
     * Body: `lingkup` (pengguna/unit), `unit` (untuk kolam unit; hanya pengelola unit), `tambah_byte`, `alasan`. Permintaan pengguna diperiksa pengelola unit utamanya lalu Pustikom; permintaan unit langsung ke Pustikom.
     *
     * `POST /v1/berkas/penyimpanan/permintaan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananPermintaan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/permintaan', [], $query, null, $options, false, false);
    }

    /**
     * Putuskan permintaan tambah kuota
     *
     * Body: `setuju` (bool), `catatan`, opsional `tambah_byte` (Pustikom boleh mengubah besarnya). Tahap unit: pengelola unit; tahap Pustikom: persetujuan memperbarui kebijakan pengguna/kolam unit.
     *
     * `POST /v1/berkas/penyimpanan/permintaan/{id}/putuskan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID permintaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananPermintaanByIdPutuskan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/permintaan/{id}/putuskan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan permintaan
     *
     * Hanya pemohon, selama belum diputuskan.
     *
     * `POST /v1/berkas/penyimpanan/permintaan/{id}/batal`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $id UUID permintaan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananPermintaanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/permintaan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kartu penyimpanan per unit
     *
     * Setiap unit: kolam (atau mengikuti bawaan), teralokasi, terpakai nyata, sisa, persen, jumlah anggota, kelompok. Pustikom: semua unit; pengelola: unitnya. Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `GET /v1/berkas/penyimpanan/unit`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananUnit(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/unit', [], $query, null, $options, false, false);
    }

    /**
     * Rincian unit
     *
     * Pembagian kolam (kelompok, sub-unit, pengecualian pengguna), perkiraan anggota, pemakaian per kelompok dan modul. Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `GET /v1/berkas/penyimpanan/unit/{kode}`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param int|string $kode Kode unit berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananUnitByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/unit/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Bagi kuota unit
     *
     * Body: `bersama_byte`, `kelompok` [{kelompok: dosen|tendik|mahasiswa|peran:<kode>, mode: orang|total, kuota_byte}], `subunit` [{kode, kuota_byte}], `pengguna` [{username, kuota_byte}]; Pustikom juga `kolam_byte` dan `boleh_lebih`. Ditolak 422 `alokasi_melebihi_kolam` bila teralokasi > kolam (kecuali boleh_lebih). Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `POST /v1/berkas/penyimpanan/unit/{kode}/bagi`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $kode Kode unit berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananUnitByKodeBagi(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/unit/{kode}/bagi', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Akumulasi total penyimpanan
     *
     * Terpakai, kapasitas, teralokasi, sisa, jumlah berkas, sampah, per modul, per jenis, pertumbuhan 30 hari, waktu terakhir dihitung. Tanpa `unit`: seluruh sistem (Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.). Dengan `unit`: unit itu (Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.).
     *
     * `GET /v1/berkas/penyimpanan/ringkasan`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Statistik penyimpanan
     *
     * Tren harian/bulanan, proyeksi penuh, per unit, pengguna teratas, sebaran ukuran, berkas terbesar, duplikat dan potensi hemat, sampah dan yang akan terhapus, unggahan ditolak, permintaan kuota. Saring `dari`, `sampai` (YYYY-MM-DD), `unit`.
     *
     * `GET /v1/berkas/penyimpanan/statistik`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{unit?: string, dari?: string, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Penyimpanan per pengguna
     *
     * Kuota efektif dan asalnya, terpakai, sisa, persen. Saring `q`, `unit`, `peran` (kode peran/kelompok), `status` (hampir, penuh, aman, pengecualian). Tanpa `unit`: Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator. Dengan `unit`: Pengelola unit (izin `penyimpanan.unit.kelola` di unit itu/induknya, atau pengelola berkas unit) atau Pustikom.
     *
     * `GET /v1/berkas/penyimpanan/pengguna`
     *
     * scope: `berkas:read` · hanya token pengguna · berhalaman
     *
     * @param array{q?: string, unit?: string, peran?: string, status?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananPengguna(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/pengguna', [], $query, null, $options, false, false);
    }

    /**
     * Rincian penyimpanan pengguna
     *
     * Metadata saja (nama berkas, ukuran, modul), tercatat di log. Pengguna sendiri, pengelola unit utamanya, atau Pustikom.
     *
     * `GET /v1/berkas/penyimpanan/pengguna/{username}`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param int|string $username Username
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananPenggunaByUsername(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/pengguna/{username}', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Kosongkan sampah pengguna
     *
     * Hapus permanen isi sampah ruang pribadi pengguna (atas permintaannya); tercatat di log. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/berkas/penyimpanan/pengguna/{username}/sampah/kosongkan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param int|string $username Username
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananPenggunaByUsernameSampahKosongkan(int|string $username, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/pengguna/{username}/sampah/kosongkan', ['username' => $username], $query, null, $options, false, false);
    }

    /**
     * Daftar kebijakan
     *
     * Semua baris kebijakan (bawaan, unit, kelompok, peran, pengguna), nilai konfigurasi server, aturan resolusi, daftar unit. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `GET /v1/berkas/penyimpanan/kebijakan`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananKebijakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/kebijakan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan kebijakan
     *
     * Body: `lingkup` (bawaan, unit, kelompok, peran, pengguna), `kunci` (kode unit/peran/username), untuk kelompok `unit`+`kelompok`+`mode`; nilai: `kuota_byte`, `bersama_byte`, `boleh_lebih`, `kapasitas_byte` (bawaan), `maks_berkas_byte`, `ekstensi_izin`, `ekstensi_larang`, `mime_larang`, `maks_jumlah`, `sampah_hari`, `bagi_publik`, `tautan_maks_hari`, `wajib_enkripsi`, `retensi_versi`, `catatan`. null = ikut tingkat di atasnya. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/berkas/penyimpanan/kebijakan`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananKebijakan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/kebijakan', [], $query, null, $options, false, false);
    }

    /**
     * Hapus kebijakan
     *
     * Body: `lingkup`, `kunci`. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/berkas/penyimpanan/kebijakan/hapus`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananKebijakanHapus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/kebijakan/hapus', [], $query, null, $options, false, false);
    }

    /**
     * Simulasi kebijakan efektif
     *
     * Kebijakan efektif untuk `username` (ruang pribadi) atau `unit` (ruang bersama) beserta asal setiap nilai dan kolam unit yang membatasinya.
     *
     * `GET /v1/berkas/penyimpanan/simulasi`
     *
     * scope: `berkas:read` · hanya token pengguna
     *
     * @param array{username?: string, unit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPenyimpananSimulasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/berkas/penyimpanan/simulasi', [], $query, null, $options, false, false);
    }

    /**
     * Hitung ulang pemakaian
     *
     * Rekonsiliasi sekarang dari tabel berkas (tanpa mengosongkan sampah). Cron: `php artisan penyimpanan:rekonsiliasi`. Hanya Pustikom: izin RBAC `pustikom.penyimpanan.kelola` atau administrator.
     *
     * `POST /v1/berkas/penyimpanan/hitung-ulang`
     *
     * scope: `berkas:write` · hanya token pengguna
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPenyimpananHitungUlang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/berkas/penyimpanan/hitung-ulang', [], $query, null, $options, false, false);
    }
}
