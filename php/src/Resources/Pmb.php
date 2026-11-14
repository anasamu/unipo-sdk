<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * PMB, PMB Publik, PMB Akun, PMB Pendaftar, PMB Admin, PMB Keuangan
 */
final class Pmb extends Resource
{
    /**
     * Periode/gelombang PMB
     *
     * `GET /v1/pmb/periode`
     *
     * scope: `pmb:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeriode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/periode', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pendaftar PMB
     *
     * Berisi data kontak pendaftar; berikan scope pmb:read hanya untuk aplikasi PMB.
     *
     * `GET /v1/pmb/pendaftar`
     *
     * scope: `pmb:read` · berhalaman
     *
     * @param array{periode_id?: string, prodi?: string, lulus?: string, terima?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendaftar(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/pendaftar', [], $query, null, $options, false, false);
    }

    /**
     * Detail pendaftar dan pilihan prodi
     *
     * `GET /v1/pmb/pendaftar/{no_pmb}`
     *
     * scope: `pmb:read`
     *
     * @param int|string $no_pmb Nomor pendaftaran
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPendaftarByNoPmb(int|string $no_pmb, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/pendaftar/{no_pmb}', ['no_pmb' => $no_pmb], $query, null, $options, false, false);
    }

    /**
     * Gelombang PMB yang diterbitkan
     *
     * Diurutkan: yang sedang buka lebih dulu. `sedang_buka` dihitung dari status buka dan tanggal di Setup Periode PMB SIAKAD.
     *
     * `GET /v1/pmb/info/gelombang`
     *
     * publik (tanpa token)
     *
     * @param array{jalur?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoGelombang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/gelombang', [], $query, null, $options, false, true);
    }

    /**
     * Detail gelombang
     *
     * Prodi yang dibuka beserta kuota, jadwal, rincian biaya, dan syarat berkas.
     *
     * `GET /v1/pmb/info/gelombang/{id}`
     *
     * publik (tanpa token)
     *
     * @param int|string $id ID atau slug gelombang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoGelombangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/gelombang/{id}', ['id' => $id], $query, null, $options, false, true);
    }

    /**
     * Jalur seleksi
     *
     * `GET /v1/pmb/info/jalur`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoJalur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/jalur', [], $query, null, $options, false, true);
    }

    /**
     * Pengumuman PMB
     *
     * `GET /v1/pmb/info/pengumuman`
     *
     * publik (tanpa token) · berhalaman
     *
     * @param array{gelombang_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoPengumuman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/pengumuman', [], $query, null, $options, false, true);
    }

    /**
     * Isi pengumuman
     *
     * `GET /v1/pmb/info/pengumuman/{slug}`
     *
     * publik (tanpa token)
     *
     * @param int|string $slug Slug pengumuman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoPengumumanBySlug(int|string $slug, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/pengumuman/{slug}', ['slug' => $slug], $query, null, $options, false, true);
    }

    /**
     * Daftar kode isian formulir
     *
     * Jenis kelamin, agama, kewarganegaraan, status sipil, status masuk, jenjang asal, pendidikan/pekerjaan/penghasilan orang tua, dan sumber informasi. Sama dengan pilihan di formulir PMB lama (r_kode).
     *
     * `GET /v1/pmb/info/referensi-formulir`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoReferensiFormulir(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/referensi-formulir', [], $query, null, $options, false, true);
    }

    /**
     * Konten landing page
     *
     * Satu paket: `pengaturan` (hero, statistik, keunggulan, galeri, bantuan/live chat, simulasi biaya), testimoni aktif, tanya jawab aktif, dan keunggulan per prodi. Diatur panitia lewat /v1/pmb/admin/landing.
     *
     * `GET /v1/pmb/info/landing`
     *
     * publik (tanpa token)
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoLanding(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/landing', [], $query, null, $options, false, true);
    }

    /**
     * Cari sekolah asal
     *
     * Dari referensi sekolah SIAKAD (r_asalsekolah), maksimal 20 hasil.
     *
     * `GET /v1/pmb/info/sekolah`
     *
     * publik (tanpa token)
     *
     * @param array{q: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoSekolah(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/sekolah', [], $query, null, $options, false, true);
    }

    /**
     * Cari perguruan tinggi asal
     *
     * Dari referensi perguruan tinggi SIAKAD (r_perguruan_tinggi, menu PMB > Setup > Sekolah & PT), maksimal 20 hasil. Untuk pendaftar pindahan/alih jenjang. Kolom: kode, nama, singkatan, kota, jenis.
     *
     * `GET /v1/pmb/info/perguruan-tinggi`
     *
     * publik (tanpa token)
     *
     * @param array{q: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getInfoPerguruanTinggi(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/info/perguruan-tinggi', [], $query, null, $options, false, true);
    }

    /**
     * Buat akun calon pendaftar
     *
     * Password minimal 8 karakter berisi huruf dan angka. Respons berisi `token_verifikasi` yang dikirim aplikasi PMB ke email pendaftar sebagai tautan; lalu panggil /v1/pmb/akun/verifikasi.
     *
     * `POST /v1/pmb/akun/daftar`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array{nama: string|null, email: string|null, hp?: string|null, password: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkunDaftar(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/akun/daftar', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Verifikasi email
     *
     * Token sekali pakai, berlaku 24 jam (PMB_VERIFIKASI_MENIT).
     *
     * `POST /v1/pmb/akun/verifikasi`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array{token: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkunVerifikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/akun/verifikasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Token verifikasi baru
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Token lama otomatis tidak berlaku.
     *
     * `POST /v1/pmb/akun/verifikasi/kirim-ulang`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkunVerifikasiKirimUlang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/akun/verifikasi/kirim-ulang', [], $query, null, $options, false, false);
    }

    /**
     * Masuk (login pendaftar)
     *
     * Mengembalikan `token` untuk header `X-Pmb-Akun-Token` (berlaku 12 jam). Akun dikunci 15 menit setelah 5 kali salah password. Mengganti password membatalkan semua token lama.
     *
     * `POST /v1/pmb/akun/masuk`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array{email: string|null, password: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkunMasuk(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/akun/masuk', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Minta token reset password
     *
     * Aplikasi PMB mengirim `token_reset` ke email. Tampilkan pesan yang sama ke pengguna walau email tidak terdaftar.
     *
     * `POST /v1/pmb/akun/lupa-password`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array{email: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkunLupaPassword(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/akun/lupa-password', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Reset password dengan token
     *
     * Token sekali pakai, berlaku 60 menit.
     *
     * `POST /v1/pmb/akun/reset-password`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array{token: string|null, password: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAkunResetPassword(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/akun/reset-password', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Profil akun
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `GET /v1/pmb/saya`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya', [], $query, null, $options, false, false);
    }

    /**
     * Ubah nama/HP akun
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `PATCH /v1/pmb/saya`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchSaya(array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/saya', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ganti password
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Body: `password_lama`, `password_baru`.
     *
     * `POST /v1/pmb/saya/ganti-password`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaGantiPassword(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/ganti-password', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Notifikasi pendaftar
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Header respons `X-Belum-Dibaca` berisi jumlah belum dibaca.
     *
     * `GET /v1/pmb/saya/notifikasi`
     *
     * scope: `pmb:pendaftar` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaNotifikasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/notifikasi', [], $query, null, $options, false, false);
    }

    /**
     * Tandai notifikasi dibaca
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Body `{"id": 12}`, atau kosong untuk semua.
     *
     * `POST /v1/pmb/saya/notifikasi/baca`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaNotifikasiBaca(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/notifikasi/baca', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar pendaftaran saya
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `GET /v1/pmb/saya/pendaftaran`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran', [], $query, null, $options, false, false);
    }

    /**
     * Mulai pendaftaran (draf)
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Satu akun satu pendaftaran per gelombang; gelombang harus sedang buka.
     *
     * `POST /v1/pmb/saya/pendaftaran`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array{gelombang_id: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaran(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail pendaftaran
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Berisi isian formulir, `tahap` (langkah berikutnya), `kelengkapan` (yang masih kurang), berkas, tagihan, dan jadwal tes. Hasil seleksi baru tampil mulai tanggal pengumuman.
     *
     * `GET /v1/pmb/saya/pendaftaran/{id}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan isian formulir
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Kirim bagian yang berubah saja (`pribadi`, `alamat`, `asal_sekolah`, `orang_tua`, `pilihan`, `sumber_informasi`, `kode_referal`). Hanya pada status draf/perlu_perbaikan; pilihan prodi terkunci setelah diajukan.
     *
     * `PATCH /v1/pmb/saya/pendaftaran/{id}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array{pribadi?: array<string, mixed>, alamat?: array<string, mixed>, asal_sekolah?: array<string, mixed>, orang_tua?: array<string, mixed>, pilihan?: list<mixed>, sumber_informasi?: string|null, kode_referal?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchSayaPendaftaranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/saya/pendaftaran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah prestasi
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/prestasi`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array{nama: string|null, bidang?: string|null, tingkat: string|null, peringkat?: string|null, tahun?: int|null, penyelenggara?: string|null, berkas_id?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdPrestasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/prestasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus prestasi
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `DELETE /v1/pmb/saya/pendaftaran/{id}/prestasi/{prestasi}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $prestasi ID prestasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSayaPendaftaranByIdPrestasiByPrestasi(int|string $id, int|string $prestasi, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/saya/pendaftaran/{id}/prestasi/{prestasi}', ['id' => $id, 'prestasi' => $prestasi], $query, null, $options, false, false);
    }

    /**
     * Simpan nilai rapor (ganti semua)
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Body `{"nilai": [{"semester": 1, "mapel": "Matematika", "nilai": 85}]}`.
     *
     * `PUT /v1/pmb/saya/pendaftaran/{id}/rapor`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array{nilai: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSayaPendaftaranByIdRapor(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pmb/saya/pendaftaran/{id}/rapor', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unggah berkas
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. multipart/form-data: `jenis` (kode jenis berkas, mis. pas_foto) dan `berkas` (file). Isi file diperiksa (PDF/JPG/PNG asli), ukuran mengikuti jenis berkas. Unggah ulang mengganti file lama.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/berkas`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array{jenis: string|null, berkas: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/berkas', ['id' => $id], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Unduh berkas
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Respons berupa file.
     *
     * `GET /v1/pmb/saya/pendaftaran/{id}/berkas/{berkas}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $berkas ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranByIdBerkasByBerkas(int|string $id, int|string $berkas, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran/{id}/berkas/{berkas}', ['id' => $id, 'berkas' => $berkas], $query, null, $options, false, false);
    }

    /**
     * Hapus berkas
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `DELETE /v1/pmb/saya/pendaftaran/{id}/berkas/{berkas}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $berkas ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSayaPendaftaranByIdBerkasByBerkas(int|string $id, int|string $berkas, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/saya/pendaftaran/{id}/berkas/{berkas}', ['id' => $id, 'berkas' => $berkas], $query, null, $options, false, false);
    }

    /**
     * Ajukan pendaftaran
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Memeriksa kelengkapan (formulir, email terverifikasi, pilihan prodi yang dibuka, berkas wajib, rapor/prestasi sesuai
     * jalur), lalu menulis pendaftar ke tabel PMB SIAKAD dan memberi nomor pendaftaran (`no_pmb`) dengan aturan yang sama
     * dengan formulir PMB lama. Bila ada biaya pendaftaran, tagihan dibuat otomatis. Bila belum lengkap: 422 `incomplete`
     * dengan daftar kekurangan di `details`. Dipakai juga untuk mengajukan ulang setelah perbaikan.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/ajukan`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdAjukan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/ajukan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mengundurkan diri
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/mundur`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdMundur(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/mundur', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tagihan dan riwayat pembayaran
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk.
     *
     * `GET /v1/pmb/saya/pendaftaran/{id}/tagihan`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranByIdTagihan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran/{id}/tagihan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah bukti transfer
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. multipart/form-data: `bukti` (PDF/JPG/PNG), `jumlah`, `tanggal_bayar` (YYYY-MM-DD). Menunggu konfirmasi petugas keuangan.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bukti`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $tagihan ID tagihan
     * @param array{bukti: \Unipo\Siakad\Http\Upload|\SplFileInfo|string, jumlah: float|int|null, tanggal_bayar?: string|null, ...} $body Field berkas: Upload::fromPath(), SplFileInfo, atau resource.
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdTagihanByTagihanBukti(int|string $id, int|string $tagihan, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bukti', ['id' => $id, 'tagihan' => $tagihan], $options['query'] ?? [], $body, $options, true, false);
    }

    /**
     * Data kartu peserta ujian
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Tersedia setelah diajukan dan biaya pendaftaran lunas. Foto: unduh berkas `foto_berkas_id`.
     *
     * `GET /v1/pmb/saya/pendaftaran/{id}/kartu`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranByIdKartu(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran/{id}/kartu', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Metode pembayaran online
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Penyedia (Xendit/Midtrans) dan metode yang aktif: checkout, va (dengan kode bank), qris. Kosong bila belum ada payment gateway; pendaftar memakai transfer + unggah bukti.
     *
     * `GET /v1/pmb/saya/pembayaran/metode`
     *
     * scope: `pmb:pendaftar`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPembayaranMetode(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pembayaran/metode', [], $query, null, $options, false, false);
    }

    /**
     * Transaksi online yang menunggu
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. `segarkan=1` mengambil status terbaru dari penyedia. `data` null bila belum ada.
     *
     * `GET /v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bayar`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $tagihan ID tagihan
     * @param array{segarkan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranByIdTagihanByTagihanBayar(int|string $id, int|string $tagihan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bayar', ['id' => $id, 'tagihan' => $tagihan], $query, null, $options, false, false);
    }

    /**
     * Bayar tagihan secara online
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Body: `metode` (checkout, va, qris), `kanal` (kode bank, wajib untuk va), `url_kembali` (opsional). Jumlah diambil dari tagihan. Transaksi menunggu dengan metode sama dipakai ulang. Saat lunas, tagihan PMB otomatis lunas.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bayar`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $tagihan ID tagihan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdTagihanByTagihanBayar(int|string $id, int|string $tagihan, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bayar', ['id' => $id, 'tagihan' => $tagihan], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan transaksi online
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Untuk mengganti metode atau bank.
     *
     * `DELETE /v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bayar`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $tagihan ID tagihan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSayaPendaftaranByIdTagihanByTagihanBayar(int|string $id, int|string $tagihan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/saya/pendaftaran/{id}/tagihan/{tagihan}/bayar', ['id' => $id, 'tagihan' => $tagihan], $query, null, $options, false, false);
    }

    /**
     * Ujian CBT saya
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Ujian CBT (jenis pmb) tempat nomor PMB pendaftar terdaftar, dengan sesi, status, sisa waktu, dan `bisa_mulai`.
     *
     * `GET /v1/pmb/saya/pendaftaran/{id}/ujian`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranByIdUjian(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran/{id}/ujian', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Mulai ujian CBT
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Body: `token` dari pengawas. Sama dengan POST /v1/cbt/kerjakan/{id}/mulai. Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi di perangkat) dan User-Agent peserta; dipakai untuk kunci perangkat.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/mulai`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $peserta ID peserta CBT
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdUjianByPesertaMulai(int|string $id, int|string $peserta, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/mulai', ['id' => $id, 'peserta' => $peserta], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lembar ujian CBT
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Soal, jawaban tersimpan, sisa_detik. Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi di perangkat) dan User-Agent peserta; dipakai untuk kunci perangkat.
     *
     * `GET /v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $peserta ID peserta CBT
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSayaPendaftaranByIdUjianByPeserta(int|string $id, int|string $peserta, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}', ['id' => $id, 'peserta' => $peserta], $query, null, $options, false, false);
    }

    /**
     * Simpan jawaban CBT
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Body: `soal_id`, `jawaban`, `ragu`, atau `jawaban_banyak`. Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi di perangkat) dan User-Agent peserta; dipakai untuk kunci perangkat.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/jawab`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $peserta ID peserta CBT
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdUjianByPesertaJawab(int|string $id, int|string $peserta, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/jawab', ['id' => $id, 'peserta' => $peserta], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Catat kejadian ujian CBT
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Body: `jenis` (keluar_layar, pindah_tab, salin_tempel, layar_penuh, koneksi_putus, lainnya), `detail`.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/log`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $peserta ID peserta CBT
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdUjianByPesertaLog(int|string $id, int|string $peserta, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/log', ['id' => $id, 'peserta' => $peserta], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Selesai ujian CBT
     *
     * Wajib header `X-Pmb-Akun-Token` dari /v1/pmb/akun/masuk. Kirim header `X-Perangkat` (ID acak yang disimpan aplikasi di perangkat) dan User-Agent peserta; dipakai untuk kunci perangkat.
     *
     * `POST /v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/selesai`
     *
     * scope: `pmb:pendaftar`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $peserta ID peserta CBT
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSayaPendaftaranByIdUjianByPesertaSelesai(int|string $id, int|string $peserta, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/saya/pendaftaran/{id}/ujian/{peserta}/selesai', ['id' => $id, 'peserta' => $peserta], $query, null, $options, false, false);
    }

    /**
     * Jalur seleksi dan syarat berkasnya
     *
     * `GET /v1/pmb/admin/jalur`
     *
     * scope: `pmb:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminJalur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/jalur', [], $query, null, $options, false, false);
    }

    /**
     * Tambah jalur
     *
     * `kode` harus ada di referensi jalur masuk SIAKAD (r_kode grup A2).
     *
     * `POST /v1/pmb/admin/jalur`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminJalur(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/jalur', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah jalur
     *
     * `PATCH /v1/pmb/admin/jalur/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID jalur
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminJalurById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/jalur/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus jalur
     *
     * `DELETE /v1/pmb/admin/jalur/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID jalur
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminJalurById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/jalur/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Atur syarat berkas jalur
     *
     * Body `{"syarat": [{"jenis": "pas_foto", "wajib": true}]}` (mengganti semua).
     *
     * `PUT /v1/pmb/admin/jalur/{id}/syarat-berkas`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID jalur
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAdminJalurByIdSyaratBerkas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pmb/admin/jalur/{id}/syarat-berkas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Semua gelombang
     *
     * Periode baru di Setup Periode PMB SIAKAD otomatis dibuatkan gelombangnya saat daftar ini (atau daftar gelombang publik) dibuka: terbit bila periodenya dibuka dan belum lewat, selain itu draf.
     *
     * `GET /v1/pmb/admin/gelombang`
     *
     * scope: `pmb:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminGelombang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/gelombang', [], $query, null, $options, false, false);
    }

    /**
     * Tambah gelombang
     *
     * Tanpa `periode_id`: periode baru dibuat di Setup Periode PMB SIAKAD (m_pmb_periode) lalu gelombangnya. Wajib: `nama`, `jalur_id`, `tahun_id` (mis. 20261), `tgl_mulai`, `tgl_selesai`, `biaya_formulir`. Opsional: `ujian_mulai`, `pengumuman_mulai`, `bayar_mulai`, `bayar_selesai`, `biaya_formulir_2`, `shift`, `kampus`, `klasifikasi`, `nama_ketua`, `nama_bendahara`, `rekening`, `nama_rekening`, `buka` (butuh minimal satu prodi), `prodi` (`[{"kode_prodi": "55201", "kuota": 40}]`). Dengan `periode_id`: gelombang untuk periode SIAKAD yang sudah ada (biasanya tidak perlu karena periode SIAKAD otomatis menjadi gelombang).
     *
     * `POST /v1/pmb/admin/gelombang`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminGelombang(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/gelombang', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail gelombang
     *
     * Termasuk `periode` (isian Setup Periode PMB).
     *
     * `GET /v1/pmb/admin/gelombang/{id}`
     *
     * scope: `pmb:read`
     *
     * @param int|string $id ID gelombang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminGelombangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/gelombang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah gelombang
     *
     * Kolom gelombang dan kolom periode (tanggal, `biaya_formulir`, `buka`, dll., seperti tambah) yang dikirim saja. Kolom periode ditulis ke m_pmb_periode dengan query Setup Periode PMB. Hosting yang menolak PATCH: kirim POST dengan header `X-HTTP-Method-Override: PATCH`.
     *
     * `PATCH /v1/pmb/admin/gelombang/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID gelombang
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminGelombangById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/gelombang/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus gelombang
     *
     * Menghapus gelombang dan periodenya di Setup Periode PMB SIAKAD. Ditolak (409) bila sudah ada pendaftar, baik dari aplikasi PMB maupun dari SIAKAD.
     *
     * `DELETE /v1/pmb/admin/gelombang/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID gelombang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminGelombangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/gelombang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah prodi gelombang
     *
     * Body `kode_prodi`, `kuota`, `nilai_minimal`. Ditulis ke t_pmb_periode_prodi (prodi periode di Setup Periode PMB).
     *
     * `POST /v1/pmb/admin/gelombang/{gelombang}/prodi`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminGelombangByGelombangProdi(int|string $gelombang, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/gelombang/{gelombang}/prodi', ['gelombang' => $gelombang], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus prodi dari gelombang
     *
     * Ditolak (409) bila prodi sudah dipilih pendaftar.
     *
     * `DELETE /v1/pmb/admin/gelombang/{gelombang}/prodi/{kode}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param int|string $kode Kode prodi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminGelombangByGelombangProdiByKode(int|string $gelombang, int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/gelombang/{gelombang}/prodi/{kode}', ['gelombang' => $gelombang, 'kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Tambah jadwal/timeline
     *
     * `tahap`: pendaftaran, pembayaran, verifikasi_berkas, tes, wawancara, pengumuman, daftar_ulang, pkkmb, lainnya.
     *
     * `POST /v1/pmb/admin/gelombang/{gelombang}/jadwal`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminGelombangByGelombangJadwal(int|string $gelombang, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/gelombang/{gelombang}/jadwal', ['gelombang' => $gelombang], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah jadwal
     *
     * `PATCH /v1/pmb/admin/gelombang/{gelombang}/jadwal/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param int|string $id ID jadwal
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminGelombangByGelombangJadwalById(int|string $gelombang, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/gelombang/{gelombang}/jadwal/{id}', ['gelombang' => $gelombang, 'id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus jadwal
     *
     * `DELETE /v1/pmb/admin/gelombang/{gelombang}/jadwal/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param int|string $id ID jadwal
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminGelombangByGelombangJadwalById(int|string $gelombang, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/gelombang/{gelombang}/jadwal/{id}', ['gelombang' => $gelombang, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah rincian biaya
     *
     * `jenis` formulir (biaya pendaftaran; bila diisi, menggantikan harga di Setup Periode untuk tagihan), daftar_ulang, ukt, spp, pengembangan, almamater, lainnya. `kode_prodi` kosong = semua prodi.
     *
     * `POST /v1/pmb/admin/gelombang/{gelombang}/biaya`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminGelombangByGelombangBiaya(int|string $gelombang, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/gelombang/{gelombang}/biaya', ['gelombang' => $gelombang], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah rincian biaya
     *
     * `PATCH /v1/pmb/admin/gelombang/{gelombang}/biaya/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param int|string $id ID biaya
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminGelombangByGelombangBiayaById(int|string $gelombang, int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/gelombang/{gelombang}/biaya/{id}', ['gelombang' => $gelombang, 'id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus rincian biaya
     *
     * `DELETE /v1/pmb/admin/gelombang/{gelombang}/biaya/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $gelombang ID gelombang
     * @param int|string $id ID biaya
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminGelombangByGelombangBiayaById(int|string $gelombang, int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/gelombang/{gelombang}/biaya/{id}', ['gelombang' => $gelombang, 'id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis berkas
     *
     * `GET /v1/pmb/admin/berkas-jenis`
     *
     * scope: `pmb:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminBerkasJenis(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/berkas-jenis', [], $query, null, $options, false, false);
    }

    /**
     * Tambah jenis berkas
     *
     * `POST /v1/pmb/admin/berkas-jenis`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminBerkasJenis(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/berkas-jenis', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah jenis berkas
     *
     * `PATCH /v1/pmb/admin/berkas-jenis/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID jenis berkas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminBerkasJenisById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/berkas-jenis/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kode referal (sekolah mitra, agen, alumni) dan jumlah pendaftarnya
     *
     * `GET /v1/pmb/admin/referal`
     *
     * scope: `pmb:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminReferal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/referal', [], $query, null, $options, false, false);
    }

    /**
     * Tambah kode referal
     *
     * `POST /v1/pmb/admin/referal`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminReferal(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/referal', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah kode referal
     *
     * `PATCH /v1/pmb/admin/referal/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID referal
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminReferalById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/referal/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Semua pengumuman (termasuk draf)
     *
     * `GET /v1/pmb/admin/pengumuman`
     *
     * scope: `pmb:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminPengumuman(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/pengumuman', [], $query, null, $options, false, false);
    }

    /**
     * Tambah pengumuman
     *
     * `isi` boleh HTML sederhana (skrip dan atribut berbahaya dibuang). `terbit_at` kosong = draf.
     *
     * `POST /v1/pmb/admin/pengumuman`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPengumuman(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pengumuman', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah pengumuman
     *
     * `PATCH /v1/pmb/admin/pengumuman/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pengumuman
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminPengumumanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/pengumuman/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus pengumuman
     *
     * `DELETE /v1/pmb/admin/pengumuman/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pengumuman
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminPengumumanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/pengumuman/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konten landing page
     *
     * Pengaturan, semua testimoni dan tanya jawab (termasuk nonaktif), dan keunggulan prodi.
     *
     * `GET /v1/pmb/admin/landing`
     *
     * scope: `pmb:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminLanding(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/landing', [], $query, null, $options, false, false);
    }

    /**
     * Simpan satu pengaturan landing
     *
     * Body `{nilai}`. Kunci: `hero` {lencana, judul, sorot, sub, cta_utama, cta_kedua, gambar, video, poin[]}; `statistik` [{nilai, label}]; `keunggulan` [{ikon, judul, teks}]; `galeri` [{gambar, judul}]; `bantuan` {whatsapp, email, jam_layanan, sapaan, pesan_wa, sosial[{jenis, url}]}; `simulasi` {catatan, potongan[{nama, persen, keterangan}]}. URL gambar/video wajib https.
     *
     * `PUT /v1/pmb/admin/landing/pengaturan/{kunci}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $kunci hero | statistik | keunggulan | galeri | bantuan | simulasi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAdminLandingPengaturanByKunci(int|string $kunci, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pmb/admin/landing/pengaturan/{kunci}', ['kunci' => $kunci], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tambah testimoni
     *
     * {nama, peran, kode_prodi, foto (https), isi, rating 1-5, video_url, aktif, urut}
     *
     * `POST /v1/pmb/admin/testimoni`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminTestimoni(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/testimoni', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah testimoni
     *
     * `PATCH /v1/pmb/admin/testimoni/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID testimoni
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminTestimoniById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/testimoni/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus testimoni
     *
     * `DELETE /v1/pmb/admin/testimoni/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID testimoni
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminTestimoniById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/testimoni/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah tanya jawab
     *
     * {kategori, pertanyaan, jawaban (HTML sederhana), aktif, urut}
     *
     * `POST /v1/pmb/admin/faq`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminFaq(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/faq', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah tanya jawab
     *
     * `PATCH /v1/pmb/admin/faq/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID tanya jawab
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminFaqById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/faq/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus tanya jawab
     *
     * `DELETE /v1/pmb/admin/faq/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID tanya jawab
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminFaqById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/faq/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan keunggulan program studi
     *
     * {tagline, ringkasan, keunggulan[], prospek_karier[], akreditasi, gelar, gambar, video_url, unggulan}. Mengganti seluruh isi.
     *
     * `PUT /v1/pmb/admin/prodi-info/{kode}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $kode Kode prodi SIAKAD
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putAdminProdiInfoByKode(int|string $kode, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/pmb/admin/prodi-info/{kode}', ['kode' => $kode], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus keunggulan program studi
     *
     * `DELETE /v1/pmb/admin/prodi-info/{kode}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $kode Kode prodi SIAKAD
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminProdiInfoByKode(int|string $kode, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/prodi-info/{kode}', ['kode' => $kode], $query, null, $options, false, false);
    }

    /**
     * Cari pendaftaran
     *
     * Token PROGDI otomatis dibatasi ke pendaftar yang memilih prodinya.
     *
     * `GET /v1/pmb/admin/pendaftaran`
     *
     * scope: `pmb:read` · berhalaman
     *
     * @param array{gelombang_id?: string, status?: string, prodi?: string, bayar?: string, lulus?: string, berkas?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminPendaftaran(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/pendaftaran', [], $query, null, $options, false, false);
    }

    /**
     * Detail pendaftaran
     *
     * Termasuk data di tabel SIAKAD (`siakad`), riwayat status, dan `id_pilihan` untuk daftar ulang.
     *
     * `GET /v1/pmb/admin/pendaftaran/{id}`
     *
     * scope: `pmb:read`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminPendaftaranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/pendaftaran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bantu isi/perbaiki formulir
     *
     * Sama dengan PATCH pendaftar; hanya pada status draf/perlu_perbaikan.
     *
     * `PATCH /v1/pmb/admin/pendaftaran/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array{pribadi?: array<string, mixed>, alamat?: array<string, mixed>, asal_sekolah?: array<string, mixed>, orang_tua?: array<string, mixed>, pilihan?: list<mixed>, sumber_informasi?: string|null, kode_referal?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminPendaftaranById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/pendaftaran/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keputusan verifikasi
     *
     * `keputusan`: terverifikasi (semua berkas harus valid; kolom berkas SIAKAD jadi L), perlu_perbaikan, atau ditolak (`catatan` wajib). Pendaftar mendapat notifikasi.
     *
     * `POST /v1/pmb/admin/pendaftaran/{id}/verifikasi`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array{keputusan: string|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPendaftaranByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pendaftaran/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unduh berkas pendaftar
     *
     * `GET /v1/pmb/admin/pendaftaran/{id}/berkas/{berkas}`
     *
     * scope: `pmb:read`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $berkas ID berkas
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminPendaftaranByIdBerkasByBerkas(int|string $id, int|string $berkas, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/pendaftaran/{id}/berkas/{berkas}', ['id' => $id, 'berkas' => $berkas], $query, null, $options, false, false);
    }

    /**
     * Periksa satu berkas
     *
     * `status`: valid, ditolak (catatan wajib), atau menunggu.
     *
     * `PATCH /v1/pmb/admin/pendaftaran/{id}/berkas/{berkas}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param int|string $berkas ID berkas
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminPendaftaranByIdBerkasByBerkas(int|string $id, int|string $berkas, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/pendaftaran/{id}/berkas/{berkas}', ['id' => $id, 'berkas' => $berkas], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Catat pendaftar mengundurkan diri
     *
     * `alasan` wajib.
     *
     * `POST /v1/pmb/admin/pendaftaran/{id}/batalkan`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPendaftaranByIdBatalkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pendaftaran/{id}/batalkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Simpan nilai USM akhir
     *
     * Ditulis ke t_pmb_periode_mahasiswa.nilai_usm lalu kelulusan tiap pilihan ditentukan aturan SIAKAD (nilai minimal prodi). Tanpa `nilai`: rata-rata nilai sesi tes.
     *
     * `POST /v1/pmb/admin/pendaftaran/{id}/nilai`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPendaftaranByIdNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pendaftaran/{id}/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Info daftar ulang
     *
     * Pilihan yang lulus, kuota, jumlah sudah daftar ulang, dan NIM terakhir prodi (bantuan memberi NIM).
     *
     * `GET /v1/pmb/admin/pendaftaran/{id}/daftar-ulang`
     *
     * scope: `pmb:read`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminPendaftaranByIdDaftarUlang(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/pendaftaran/{id}/daftar-ulang', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Proses daftar ulang (jadi mahasiswa)
     *
     * Memakai logika halaman Daftar Ulang SIAKAD: membuat m_mahasiswa, status semester, data orang tua, dan akun MAHASISWA. Body: `id_pilihan`, `nim`, opsional `tahun_id` (default tahun akademik aktif).
     *
     * `POST /v1/pmb/admin/pendaftaran/{id}/daftar-ulang`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array{id_pilihan: int|null, nim: string|null, tahun_id?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPendaftaranByIdDaftarUlang(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pendaftaran/{id}/daftar-ulang', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat tagihan daftar ulang
     *
     * Total dari rincian biaya wajib (selain formulir) gelombang untuk prodi tempat pendaftar lulus.
     *
     * `POST /v1/pmb/admin/pendaftaran/{id}/tagihan-daftar-ulang`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPendaftaranByIdTagihanDaftarUlang(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pendaftaran/{id}/tagihan-daftar-ulang', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Buat tagihan manual
     *
     * `POST /v1/pmb/admin/pendaftaran/{id}/tagihan`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $id ID pendaftaran (UUID)
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPendaftaranByIdTagihan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pendaftaran/{id}/tagihan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sesi tes
     *
     * `GET /v1/pmb/admin/sesi-tes`
     *
     * scope: `pmb:read`
     *
     * @param array{gelombang_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminSesiTes(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/sesi-tes', [], $query, null, $options, false, false);
    }

    /**
     * Tambah sesi tes
     *
     * `jenis`: tulis, cbt, wawancara, praktik, kesehatan. `ruang_id` dari ruang periode di SIAKAD (opsional).
     *
     * `POST /v1/pmb/admin/sesi-tes`
     *
     * scope: `pmb:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminSesiTes(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/sesi-tes', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail sesi tes dan pesertanya
     *
     * `GET /v1/pmb/admin/sesi-tes/{id}`
     *
     * scope: `pmb:read`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminSesiTesById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/sesi-tes/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah sesi tes
     *
     * `PATCH /v1/pmb/admin/sesi-tes/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminSesiTesById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/sesi-tes/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus sesi tes kosong
     *
     * `DELETE /v1/pmb/admin/sesi-tes/{id}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminSesiTesById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/sesi-tes/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tempatkan peserta
     *
     * Body `{"pendaftaran": ["<uuid>", ...]}` atau `{"otomatis": true}` untuk mengisi sisa kapasitas dengan pendaftar yang sudah bayar (dan terverifikasi bila diwajibkan) dan belum punya sesi tes jenis yang sama. Nomor kursi urut; ruang ikut dicatat di SIAKAD.
     *
     * `POST /v1/pmb/admin/sesi-tes/{id}/peserta`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminSesiTesByIdPeserta(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/sesi-tes/{id}/peserta', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kehadiran dan nilai peserta
     *
     * `PATCH /v1/pmb/admin/sesi-tes/{id}/peserta/{peserta}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID sesi
     * @param int|string $peserta ID peserta
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminSesiTesByIdPesertaByPeserta(int|string $id, int|string $peserta, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/sesi-tes/{id}/peserta/{peserta}', ['id' => $id, 'peserta' => $peserta], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Keluarkan peserta dari sesi
     *
     * `DELETE /v1/pmb/admin/sesi-tes/{id}/peserta/{peserta}`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID sesi
     * @param int|string $peserta ID peserta
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteAdminSesiTesByIdPesertaByPeserta(int|string $id, int|string $peserta, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/pmb/admin/sesi-tes/{id}/peserta/{peserta}', ['id' => $id, 'peserta' => $peserta], $query, null, $options, false, false);
    }

    /**
     * Status CBT peserta sesi
     *
     * Untuk sesi tes jenis cbt: tiap peserta PMB dengan status dan nilainya di ujian CBT berjenis pmb.
     *
     * `GET /v1/pmb/admin/sesi-tes/{id}/cbt`
     *
     * scope: `pmb:read`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminSesiTesByIdCbt(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/sesi-tes/{id}/cbt', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftarkan peserta sesi ke CBT
     *
     * Body `{"cbt_sesi_id": 3}` (sesi dari ujian CBT berjenis pmb). Peserta didaftarkan dengan username = nomor PMB dan nama pendaftar; yang sudah terdaftar dilewati.
     *
     * `POST /v1/pmb/admin/sesi-tes/{id}/cbt`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminSesiTesByIdCbt(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/sesi-tes/{id}/cbt', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tarik nilai CBT ke sesi tes
     *
     * Body `{"cbt_ujian_id": 2}`. Nilai peserta CBT yang selesai (tanpa esai yang menunggu koreksi) disalin ke nilai sesi tes PMB; tidak hadir di CBT ditandai tidak hadir.
     *
     * `POST /v1/pmb/admin/sesi-tes/{id}/cbt/nilai`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID sesi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminSesiTesByIdCbtNilai(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/sesi-tes/{id}/cbt/nilai', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Dashboard PMB
     *
     * Corong pendaftaran (akun, draf, diajukan, bayar, verifikasi, lulus, daftar ulang), per prodi, per sumber informasi, per referal, dan tren 30 hari.
     *
     * `GET /v1/pmb/admin/statistik`
     *
     * scope: `pmb:read`
     *
     * @param array{gelombang_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminStatistik(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/statistik', [], $query, null, $options, false, false);
    }

    /**
     * Antrean email/WhatsApp/SMS
     *
     * Untuk layanan pengirim pesan. Setelah dikirim, tandai lewat POST .../{id}/terkirim.
     *
     * `GET /v1/pmb/admin/notifikasi/antrean`
     *
     * scope: `pmb:write`
     *
     * @param array{kanal?: string, limit?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminNotifikasiAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/notifikasi/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Tandai notifikasi terkirim/gagal
     *
     * Body `{"berhasil": true}`.
     *
     * `POST /v1/pmb/admin/notifikasi/{id}/terkirim`
     *
     * scope: `pmb:write`
     *
     * @param int|string $id ID notifikasi
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminNotifikasiByIdTerkirim(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/notifikasi/{id}/terkirim', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar tagihan PMB
     *
     * `GET /v1/pmb/admin/tagihan`
     *
     * scope: `pmb:keuangan` · berhalaman
     *
     * @param array{status?: string, jenis?: string, gelombang_id?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminTagihan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/tagihan', [], $query, null, $options, false, false);
    }

    /**
     * Detail tagihan dan pembayarannya
     *
     * `GET /v1/pmb/admin/tagihan/{id}`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $id ID tagihan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminTagihanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/tagihan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Atur kanal/nomor VA/batas bayar
     *
     * `PATCH /v1/pmb/admin/tagihan/{id}`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $id ID tagihan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function patchAdminTagihanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PATCH', '/v1/pmb/admin/tagihan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lunasi manual (bayar di loket)
     *
     * Tagihan biaya pendaftaran yang lunas menandai bayar = Y di SIAKAD.
     *
     * `POST /v1/pmb/admin/tagihan/{id}/lunas`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $id ID tagihan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminTagihanByIdLunas(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/tagihan/{id}/lunas', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan tagihan
     *
     * `POST /v1/pmb/admin/tagihan/{id}/batal`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $id ID tagihan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminTagihanByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/tagihan/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Konfirmasi bukti transfer
     *
     * Body `{"diterima": true}` atau `{"diterima": false, "catatan": "..."}`.
     *
     * `POST /v1/pmb/admin/pembayaran/{pembayaran}/konfirmasi`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $pembayaran ID pembayaran
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAdminPembayaranByPembayaranKonfirmasi(int|string $pembayaran, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/admin/pembayaran/{pembayaran}/konfirmasi', ['pembayaran' => $pembayaran], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Unduh bukti transfer
     *
     * `GET /v1/pmb/admin/pembayaran/{pembayaran}/bukti`
     *
     * scope: `pmb:keuangan`
     *
     * @param int|string $pembayaran ID pembayaran
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAdminPembayaranByPembayaranBukti(int|string $pembayaran, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/pmb/admin/pembayaran/{pembayaran}/bukti', ['pembayaran' => $pembayaran], $query, null, $options, false, false);
    }

    /**
     * Notifikasi pembayaran dari bank/payment gateway
     *
     * Server ke server. `nomor` = nomor tagihan atau nomor VA, `jumlah`, `referensi` (ID transaksi bank, unik), opsional
     * `dibayar_at`. Idempoten: referensi yang sama tidak diproses dua kali. Jumlah >= total = lunas; kurang = dicatat
     * untuk dicek petugas. Seluruh body disimpan sebagai payload untuk audit.
     *
     * `POST /v1/pmb/pembayaran/notifikasi`
     *
     * scope: `pmb:keuangan`
     *
     * @param array{nomor: string|null, jumlah: float|int|null, referensi: string|null, dibayar_at?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembayaranNotifikasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/pmb/pembayaran/notifikasi', [], $options['query'] ?? [], $body, $options, false, false);
    }
}
