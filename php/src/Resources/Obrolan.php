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
     * Identitas (username atau pmb:<id>), perangkat aktif, setelan privasi, ada/tidaknya cadangan kunci, batas long-poll dan lampiran.
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
     * Tanpa `sejak`: mengembalikan kursor terbaru. Dengan `sejak`: menunggu sampai ada peristiwa (pesan, hapus, baca, ketik, ruang, perangkat) atau `tunggu` detik habis (maksimal OBROLAN_TUNGGU_MAKS). Isi hanya penunjuk, bukan isi pesan.
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
     * Anggota, pesan terakhir (terenkripsi, dengan kunci untuk perangkat ini), jumlah belum dibaca, sematkan/bisu/arsip.
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
     * Pesan terenkripsi
     *
     * Terbaru dulu (atau `setelah` untuk yang lebih baru, urut naik). Setiap pesan membawa `kunci` yang dibungkus untuk perangkat ini (null bila perangkat terdaftar setelah pesan dikirim).
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
     * Body {uuid, perangkat, sandi (AES-256-GCM, base64), iv (12 byte), efemeral (kunci publik ECDH efemeral), tanda (ECDSA perangkat pengirim), kunci: {uuid_perangkat: kunci AES-KW 40 byte}, lampiran?: [uuid]}. Kunci wajib untuk tepat semua perangkat aktif anggota (409 perangkat_berubah bila tidak). Kirim ulang dengan uuid sama aman.
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
     * Hapus untuk semua
     *
     * Pengirim atau admin grup. Ciphertext, kunci, dan lampiran dihapus permanen dari server.
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
     * Hanya anggota obrolan. Isi tetap terenkripsi; dibuka di perangkat dengan kunci dari pesan.
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
     * Body {tampil_daring?, tanda_baca?}.
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
