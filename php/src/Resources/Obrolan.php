<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Obrolan, Obrolan: Perangkat & kunci, Obrolan: Ruang, Obrolan: Pesan, Obrolan: Privasi
 */
final class Obrolan extends Resource
{
    /**
     * Profil obrolan saya
     *
     * Identitas (username atau pmb:<id>), perangkat aktif, setelan privasi, ada/tidaknya cadangan kunci, batas long-poll dan lampiran, hapus_semua_menit (batas "Hapus untuk semua").
     *
     * `GET /v1/obrolan/saya`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Cari pengguna
     *
     * Nama dan peran saja (tanpa email/HP), punya_kunci (sudah mengaktifkan obrolan), dan status daring bila diizinkan pemiliknya. Tanpa `q`: orang yang pernah diajak mengobrol. Pendaftar PMB hanya melihat panitia/admin.
     *
     * `GET /v1/obrolan/pengguna`
     *
     * @param array{q?: string, level?: string, limit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengguna(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/pengguna', [], $query, null, $options, false, false);
    }

    /**
     * Umpan realtime (long-poll)
     *
     * Tanpa `sejak`: mengembalikan kursor terbaru. Dengan `sejak`: menunggu sampai ada peristiwa (pesan, hapus, baca, ketik, ruang, perangkat, kunci) atau `tunggu` detik habis (maksimal OBROLAN_TUNGGU_MAKS). Isi hanya penunjuk, bukan isi pesan. `sembunyi` = pesan dihapus untuk saya; `ruang` dengan aksi `hapus` = obrolan dihapus dari daftar saya.
     *
     * `GET /v1/obrolan/peristiwa`
     *
     * @param array{sejak?: string, tunggu?: string, perangkat?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPeristiwa(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/peristiwa', [], $query, null, $options, false, false);
    }

    /**
     * Perangkat saya
     *
     * `GET /v1/obrolan/perangkat`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPerangkat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/perangkat', [], $query, null, $options, false, false);
    }

    /**
     * Daftarkan perangkat
     *
     * Body {nama, kunci_tukar, kunci_tanda}: kunci publik ECDH P-256 dan ECDSA P-256 bentuk raw (65 byte, base64). Kunci privat tidak pernah dikirim. Kontak diberi tahu (peristiwa perangkat) agar nomor keamanan diperiksa ulang.
     *
     * `POST /v1/obrolan/perangkat`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPerangkat(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/perangkat', [], $query, null, $options, false, false);
    }

    /**
     * Cabut perangkat
     *
     * Perangkat tidak lagi menerima kunci pesan baru, dan kunci pesan lama untuk perangkat itu dihapus.
     *
     * `POST /v1/obrolan/perangkat/{id}/cabut`
     *
     * @param int|string $id UUID perangkat
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPerangkatByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/perangkat/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kunci publik perangkat
     *
     * Perangkat aktif tiap pemilik (untuk mengenkripsi pesan dan memeriksa tanda tangan). Hanya untuk orang yang satu obrolan atau boleh dihubungi.
     *
     * `GET /v1/obrolan/kunci`
     *
     * @param array{pemilik?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKunci(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/kunci', [], $query, null, $options, false, false);
    }

    /**
     * Daftar obrolan
     *
     * Anggota, pesan terakhir (terenkripsi, dengan kunci untuk perangkat ini), jumlah belum dibaca, sematkan/bisu/arsip. Obrolan yang dihapus pemanggil tidak tercantum sampai ada pesan baru.
     *
     * `GET /v1/obrolan/ruang`
     *
     * @param array{perangkat?: string, arsip?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/ruang', [], $query, null, $options, false, false);
    }

    /**
     * Mulai obrolan
     *
     * Body {jenis: "langsung", dengan, perangkat} membuka obrolan berdua (yang sudah ada dipakai lagi), atau {jenis: "grup", judul, anggota: [..], perangkat}.
     *
     * `POST /v1/obrolan/ruang`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuang(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang', [], $query, null, $options, false, false);
    }

    /**
     * Detail obrolan
     *
     * `GET /v1/obrolan/ruang/{id}`
     *
     * @param int|string $id UUID ruang
     * @param array{perangkat?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/ruang/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah obrolan
     *
     * Bersama: judul (admin grup), kedaluwarsa_detik (pesan menghilang, 0 = mati). Pribadi: bisu, arsip, sematkan.
     *
     * `POST /v1/obrolan/ruang/{id}/ubah`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdUbah(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/ubah', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah anggota grup
     *
     * Body {tambah: [..]}. Admin grup. Anggota baru tidak bisa membaca pesan sebelum bergabung.
     *
     * `POST /v1/obrolan/ruang/{id}/anggota`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdAnggota(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/anggota', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keluarkan anggota
     *
     * Body {pemilik}. Admin grup.
     *
     * `POST /v1/obrolan/ruang/{id}/anggota/keluarkan`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdAnggotaKeluarkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/anggota/keluarkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Atur admin grup
     *
     * Body {pemilik, admin: true|false}.
     *
     * `POST /v1/obrolan/ruang/{id}/anggota/admin`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdAnggotaAdmin(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/anggota/admin', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Foto grup
     *
     * Gambar foto grup (dibuka dari simpanan terenkripsi server) untuk anggota. Field `foto` di data ruang berubah setiap foto diganti (pakai sebagai penanda cache).
     *
     * `GET /v1/obrolan/ruang/{id}/foto`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangByIdFoto(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/ruang/{id}/foto', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ganti foto grup
     *
     * Admin grup. multipart field `berkas`: JPEG/PNG/WebP maks. 2 MB dan 2048 px (browser memotong persegi dan memperkecil ke 256 px). Disimpan terenkripsi server; foto lama tidak dihapus. Anggota mendapat peristiwa `ruang` (aksi foto) dan pesan sistem "X mengganti foto grup".
     *
     * `POST /v1/obrolan/ruang/{id}/foto`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdFoto(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/foto', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus foto grup
     *
     * Admin grup. Grup kembali memakai avatar inisial; berkas foto tetap tersimpan (hapus lunak). Pesan sistem "X menghapus foto grup".
     *
     * `POST /v1/obrolan/ruang/{id}/foto/hapus`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdFotoHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/foto/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Keluar dari grup
     *
     * `POST /v1/obrolan/ruang/{id}/keluar`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdKeluar(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/keluar', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ringkasan sebelum membersihkan
     *
     * Jumlah pesan dan lampiran yang masih terlihat, yang sudah disalin ke Berkas saya, dan lampiran lama yang tidak bisa disalin.
     *
     * `GET /v1/obrolan/ruang/{id}/bersihkan`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangByIdBersihkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/ruang/{id}/bersihkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Bersihkan obrolan (untuk saya)
     *
     * Body {simpan: bool}. Riwayat disembunyikan hanya untuk pemanggil; anggota lain tetap melihatnya. simpan=true menyalin lampiran yang belum disalin ke Berkas saya › Obrolan/<nama obrolan>. Tidak ada yang dihapus permanen.
     *
     * `POST /v1/obrolan/ruang/{id}/bersihkan`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdBersihkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/bersihkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus obrolan (untuk saya)
     *
     * Body {simpan: bool}. Seperti bersihkan (simpan=true menyalin lampiran ke Berkas saya dulu), lalu obrolan hilang dari daftar pemanggil sampai ada pesan baru (yang tampil hanya pesan baru). Grup: pemanggil sekaligus keluar dari grup. Anggota lain tidak terpengaruh; tidak ada yang dihapus permanen. Respons {disimpan, dilewati, keluar}.
     *
     * `POST /v1/obrolan/ruang/{id}/hapus`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pesan terenkripsi
     *
     * Terbaru dulu (atau `setelah` untuk yang lebih baru, urut naik). Setiap pesan membawa `kunci` yang dibungkus untuk perangkat ini (null bila perangkat terdaftar setelah pesan dikirim; `menunggu` = true bila kunci akan disusulkan perangkat pengirim).
     *
     * `GET /v1/obrolan/ruang/{id}/pesan`
     *
     * @param int|string $id UUID ruang
     * @param array{perangkat?: string, sebelum?: string, setelah?: string, limit?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRuangByIdPesan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/ruang/{id}/pesan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kirim pesan terenkripsi
     *
     * Body {uuid, perangkat, sandi (AES-256-GCM, base64), iv (12 byte), efemeral (kunci publik ECDH efemeral), tanda (ECDSA perangkat pengirim), kunci: {uuid_perangkat: kunci AES-KW 40 byte}, lampiran?: [uuid]}. Kunci wajib untuk tepat semua perangkat aktif anggota (409 perangkat_berubah bila tidak). Anggota yang belum punya perangkat tidak menghalangi; mereka tercantum di `menunggu_penerima` dan kuncinya disusulkan lewat /v1/obrolan/susulan. Kirim ulang dengan uuid sama aman.
     *
     * `POST /v1/obrolan/ruang/{id}/pesan`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdPesan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/pesan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Kunci pesan yang perlu disusulkan
     *
     * Pesan kiriman saya (OBROLAN_SUSULAN_HARI terakhir) untuk anggota yang belum punya kunci saat pesan dikirim tetapi kini sudah mendaftarkan perangkat. Setiap butir membawa efemeral + kunci untuk perangkat saya dan daftar perangkat tujuan (kunci_tukar). Perangkat saya membungkus ulang kunci pesan lalu mengirimnya ke POST /v1/obrolan/susulan.
     *
     * `GET /v1/obrolan/susulan`
     *
     * @param array{perangkat?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSusulan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/susulan', [], $query, null, $options, false, false);
    }

    /**
     * Kirim kunci susulan
     *
     * Body {perangkat, kunci: [{pesan, perangkat (tujuan), kunci (AES-KW 40 byte, dibungkus dengan ECDH perangkat saya x perangkat tujuan)}]}. Butir yang tidak memenuhi syarat dilewati. Penerima mendapat peristiwa `kunci` lalu memuat ulang pesannya.
     *
     * `POST /v1/obrolan/susulan`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSusulan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/susulan', [], $query, null, $options, false, false);
    }

    /**
     * Hapus untuk semua
     *
     * Pengirim dalam OBROLAN_HAPUS_SEMUA_MENIT (bawaan 60) setelah dikirim, atau admin grup tanpa batas waktu (403 lewat_batas_waktu). Hapus lunak: isi dan lampiran tetap tersimpan di server, tetapi tidak lagi diberikan ke anggota mana pun (pesan tampil "Pesan ini dihapus", lampiran tidak bisa diunduh). Hapus permanen hanya oleh admin/Pustikom.
     *
     * `POST /v1/obrolan/ruang/{id}/pesan/{pesan}/hapus`
     *
     * @param int|string $id UUID ruang
     * @param int|string $pesan UUID pesan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdPesanByPesanHapus(int|string $id, int|string $pesan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/pesan/{pesan}/hapus', ['id' => $id, 'pesan' => $pesan], $query, null, $options, false, false);
    }

    /**
     * Hapus untuk saya
     *
     * Pesan apa pun di ruang ini tidak lagi dikirim ke pemanggil (semua perangkatnya, peristiwa `sembunyi`). Anggota lain tidak terpengaruh. Disimpan di obrolan_pesan_sembunyi.
     *
     * `POST /v1/obrolan/ruang/{id}/pesan/{pesan}/hapus-saya`
     *
     * @param int|string $id UUID ruang
     * @param int|string $pesan UUID pesan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdPesanByPesanHapusSaya(int|string $id, int|string $pesan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/pesan/{pesan}/hapus-saya', ['id' => $id, 'pesan' => $pesan], $query, null, $options, false, false);
    }

    /**
     * Pindahkan pesan lama ke enkripsi server
     *
     * Body {kunci}: kunci pesan end-to-end lama (AES-256, base64) dari perangkat anggota yang masih memegangnya. SIAKAD membuka isi aslinya sendiri lalu menyimpannya terenkripsi server; lampirannya ikut dipindah.
     *
     * `POST /v1/obrolan/ruang/{id}/pesan/{pesan}/pindah-server`
     *
     * @param int|string $id UUID ruang
     * @param int|string $pesan UUID pesan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdPesanByPesanPindahServer(int|string $id, int|string $pesan, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/pesan/{pesan}/pindah-server', ['id' => $id, 'pesan' => $pesan], $query, null, $options, false, false);
    }

    /**
     * Tandai diterima/dibaca
     *
     * Body {diterima?, dibaca?}: ID pesan terakhir. Tanda baca tidak dikirim ke orang lain bila setelan tanda_baca dimatikan.
     *
     * `POST /v1/obrolan/ruang/{id}/tandai`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdTandai(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/tandai', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Sedang mengetik
     *
     * `POST /v1/obrolan/ruang/{id}/ketik`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdKetik(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/ketik', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unggah lampiran terenkripsi
     *
     * multipart field `berkas` berisi file yang SUDAH dienkripsi di perangkat. Lalu sebutkan uuid-nya di `lampiran` saat mengirim pesan. Maks. OBROLAN_LAMPIRAN_MB.
     *
     * `POST /v1/obrolan/ruang/{id}/lampiran`
     *
     * @param int|string $id UUID ruang
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRuangByIdLampiran(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/ruang/{id}/lampiran', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Unduh lampiran terenkripsi
     *
     * Hanya anggota obrolan yang masih melihat pesannya. Lampiran pesan yang dihapus untuk semua atau kedaluwarsa tidak bisa diunduh siapa pun (404).
     *
     * `GET /v1/obrolan/lampiran/{id}`
     *
     * @param int|string $id UUID lampiran
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getLampiranById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/lampiran/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cadangan kunci
     *
     * Kunci perangkat yang dienkripsi sandi cadangan pengguna (PBKDF2-SHA256 + AES-GCM di perangkat). Server tidak bisa membukanya.
     *
     * `GET /v1/obrolan/cadangan`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCadangan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/cadangan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan cadangan kunci
     *
     * Body {data, salt, iterasi (>= 300000)}.
     *
     * `POST /v1/obrolan/cadangan`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCadangan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/cadangan', [], $query, null, $options, false, false);
    }

    /**
     * Hapus cadangan kunci
     *
     * `POST /v1/obrolan/cadangan/hapus`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCadanganHapus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/cadangan/hapus', [], $query, null, $options, false, false);
    }

    /**
     * Setelan privasi
     *
     * `GET /v1/obrolan/setelan`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSetelan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/setelan', [], $query, null, $options, false, false);
    }

    /**
     * Ubah setelan privasi
     *
     * Body {tampil_daring?, tanda_baca?, simpan_kirim?}. simpan_kirim (bawaan true): browser menyalin berkas yang dikirim ke Berkas saya/Obrolan (salinan tidak terenkripsi end-to-end).
     *
     * `POST /v1/obrolan/setelan`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postSetelan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/setelan', [], $query, null, $options, false, false);
    }

    /**
     * Daftar blokir
     *
     * `GET /v1/obrolan/blokir`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getBlokir(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/obrolan/blokir', [], $query, null, $options, false, false);
    }

    /**
     * Blokir atau buka blokir
     *
     * Body {pemilik, blokir: true|false}. Orang yang diblokir tidak bisa mengirim pesan di obrolan langsung dengan Anda.
     *
     * `POST /v1/obrolan/blokir`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postBlokir(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/obrolan/blokir', [], $query, null, $options, false, false);
    }
}
