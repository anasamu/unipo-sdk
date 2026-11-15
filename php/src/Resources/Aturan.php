<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Aturan, Aturan: pengatur dan pemeriksaan, Aturan: SK dan pengecualian
 */
final class Aturan extends Resource
{
    /**
     * Katalog titik penerapan, indikator, operator
     *
     * Titik penerapan (langkah bisnis yang menegakkan aturan, mis. `krs.ambil`, `nilai.input.dosen`, `wisuda.daftar`, `kkn.daftar`),
     * kategori dan jenis aturan yang boleh di tiap titik, indikator yang bisa dipakai di kondisi (IPK, SKS lulus, nilai D/E,
     * tunggakan, persen bayar, bebas pustaka, ...), dan operator. Dipakai form "tambah aturan" di aplikasi admin.
     *
     * `GET /v1/aturan/katalog`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Hak saya mengatur aturan
     *
     * Per kategori: boleh mengatur atau tidak, prodi yang boleh diatur (null = semua), dan siapa pengaturnya.
     *
     * `GET /v1/aturan/saya`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Daftar pengatur per kategori
     *
     * Peran/izin RBAC yang berhak mengatur aturan tiap kategori (dan per titik bila disetel). Tanpa baris = izin bawaan aturan:<kategori> (peran bak untuk akademik/kelulusan/kemahasiswaan, keuangan untuk keuangan).
     *
     * `GET /v1/aturan/pengatur`
     *
     * scope: `aturan:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengatur(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/pengatur', [], $query, null, $options, false, false);
    }

    /**
     * Atur siapa pengatur (admin)
     *
     * Body: `{"kategori": "akademik", "titik": "nilai.input.dosen" (opsional), "pengatur": [{"jenis": "peran", "kode": "bak"}, {"jenis": "peran", "kode": "kaprodi"}, {"jenis": "izin", "kode": "aturan:akademik"}]}`.
     * Mengganti seluruh daftar pengatur kategori itu (atau titik itu saja). `"pengatur": []` = kembali ke izin bawaan.
     * Peran berlingkup unit (mis. kaprodi, dekan) hanya bisa mengatur aturan yang cakupannya di unit itu.
     *
     * `POST /v1/aturan/pengatur`
     *
     * scope: `aturan:admin` · hanya token pengguna
     *
     * @param array{kategori?: string|null, titik?: string|null, pengatur?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengatur(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/pengatur', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Periksa aturan di satu titik
     *
     * Body: `{"titik": "krs.ambil", "nim": "...", "tahun_id": "20261", "konteks": {"sks_diambil": 24}}` (titik kelas: `kode_prodi`, `kelas`; `dosen` untuk
     * pengecualian dosen). Mahasiswa tanpa `nim` = dirinya sendiri. Hasil: `boleh` (tidak ada aturan blokir yang dilanggar),
     * `pelanggaran` dan `peringatan` beserta pesannya, `batas` (mis. batas SKS dan masa buka yang berlaku), aturan yang
     * diterapkan dan yang dikecualikan, serta nilai indikator yang dipakai. Langkah bisnis SIAKAD memakai pemeriksaan yang sama
     * dan menolak dengan 409 `aturan_dilanggar`; aplikasi lain memakai endpoint ini untuk menampilkan syarat sebelum pengguna mencoba.
     *
     * `POST /v1/aturan/periksa`
     *
     * scope: `aturan:read`
     *
     * @param array{titik?: string|null, nim?: string|null, kode_prodi?: string|null, kelas?: string|null, dosen?: string|null, tahun_id?: string|null, konteks?: array<string, mixed>|null, waktu?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriksa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/periksa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar aturan
     *
     * Semua pengguna melihat aturan aktif; draf dan nonaktif hanya untuk pengatur kategorinya. Filter titik, kategori, jenis, mode, status, prodi (aturan yang berlaku untuk prodi itu), tahun_id, q, terhapus=1 (admin: sampah).
     *
     * `GET /v1/aturan`
     *
     * scope: `aturan:read` · berhalaman
     *
     * @param array{titik?: string, kategori?: string, jenis?: string, mode?: string, status?: string, prodi?: string, tahun_id?: string, q?: string, terhapus?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Tambah aturan
     *
     * Aturan baru berstatus **draf**. Lampirkan SK (`POST /v1/aturan/{id}/lampiran`) lalu aktifkan (`POST /v1/aturan/{id}/aktifkan`).
     *
     * Contoh batas input nilai dosen (hanya FKIP, periode 20261):
     * `{"nama": "Batas input nilai dosen 2026 ganjil", "titik": "nilai.input.dosen", "jenis": "batas_waktu", "tahun_id": "20261", "cakupan": {"fakultas": ["06"]}, "parameter": {"mulai": "2026-12-20", "selesai": "2027-01-10"}}`
     *
     * Contoh syarat KKN: `{"nama": "Syarat KKN", "titik": "kkn.daftar", "kategori": "kemahasiswaan", "jenis": "syarat", "kondisi": {"semua": [{"indikator": "sks_lulus", "op": ">=", "nilai": 100}, {"indikator": "ipk", "op": ">=", "nilai": 2}, {"indikator": "tunggakan", "op": "<=", "nilai": 0, "pesan": "Lunasi tunggakan sebelum daftar KKN."}]}}`
     *
     * Contoh batas SKS menurut IPS: `{"nama": "Batas SKS KRS", "titik": "krs.ambil", "jenis": "batas_nilai", "parameter": {"target": "sks_diambil", "op": "<=", "tabel": [{"jika": [{"indikator": "ips_lalu", "op": ">=", "nilai": 3}], "nilai": 24}, {"jika": [{"indikator": "ips_lalu", "op": ">=", "nilai": 2.5}], "nilai": 21}], "nilai": 18}}`
     *
     * Untuk batas waktu dan batas nilai, `kondisi` berarti "berlaku bila" (mis. hanya untuk semester_ke <= 2).
     * `mode`: blokir (ditolak) atau peringatan (diizinkan, pesan ditampilkan). Pengatur hanya bisa mengisi cakupan di unitnya.
     *
     * `POST /v1/aturan`
     *
     * scope: `aturan:write`
     *
     * @param array{kode?: string|null, nama?: string|null, keterangan?: string|null, titik?: string|null, kategori?: string|null, jenis?: string|null, cakupan?: array<string, mixed>, kondisi?: array<string, mixed>|null, parameter?: array<string, mixed>|null, tahun_id?: string|null, berlaku_mulai?: string|null, berlaku_selesai?: string|null, mode?: string|null, pesan?: string|null, prioritas?: int|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail aturan
     *
     * Isi aturan, lampiran SK, pengecualian (pengatur saja), dan pengatur yang berlaku.
     *
     * `GET /v1/aturan/{id}`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah aturan
     *
     * Body sebagian dari isian tambah (titik tidak bisa diubah), plus "catatan" perubahan. Versi naik dan isi lama tersimpan di riwayat. Aturan aktif langsung berlaku dengan isi baru (event aturan.diubah); batas_waktu aktif ditulis-tembus ke tabel batas lama.
     *
     * `POST /v1/aturan/{id}`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{kode?: string|null, nama?: string|null, keterangan?: string|null, titik?: string|null, kategori?: string|null, jenis?: string|null, cakupan?: array<string, mixed>, kondisi?: array<string, mixed>|null, parameter?: array<string, mixed>|null, tahun_id?: string|null, berlaku_mulai?: string|null, berlaku_selesai?: string|null, mode?: string|null, pesan?: string|null, prioritas?: int|null, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aktifkan aturan
     *
     * Wajib sudah ada lampiran SK. Body opsional {"catatan"}. Event aturan.diaktifkan. Aturan batas_waktu dengan tahun_id ditulis-tembus ke tabel batas lama (tulis_tembus di respons).
     *
     * `POST /v1/aturan/{id}/aktifkan`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdAktifkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/aktifkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Nonaktifkan aturan
     *
     * Body opsional {"catatan"}. Event aturan.dinonaktifkan.
     *
     * `POST /v1/aturan/{id}/nonaktifkan`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdNonaktifkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/nonaktifkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Hapus aturan (ke sampah)
     *
     * Soft delete: aturan berhenti berlaku, riwayat dan SK tetap tersimpan. Body opsional {"alasan"}.
     *
     * `POST /v1/aturan/{id}/hapus`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pulihkan aturan dari sampah (admin)
     *
     * Kembali sebagai draf, perlu diaktifkan ulang.
     *
     * `POST /v1/aturan/{id}/pulihkan`
     *
     * scope: `aturan:admin`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPulihkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/pulihkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat perubahan
     *
     * Pengatur: setiap versi (isi lengkap), aktif/nonaktif, lampiran, pengecualian, siapa dan kapan.
     *
     * `GET /v1/aturan/{id}/riwayat`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Uji aturan (termasuk draf)
     *
     * Body seperti /periksa tanpa titik (+ "waktu" untuk mencoba tanggal lain). Hanya aturan ini yang dinilai, walau masih draf atau di luar masa berlaku.
     *
     * `POST /v1/aturan/{id}/uji`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{titik?: string|null, nim?: string|null, kode_prodi?: string|null, kelas?: string|null, dosen?: string|null, tahun_id?: string|null, konteks?: array<string, mixed>|null, waktu?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdUji(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/uji', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lampiran SK
     *
     * SK dan lampiran aturan (pengatur juga melihat yang sudah dilepas).
     *
     * `GET /v1/aturan/{id}/lampiran`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdLampiran(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/lampiran', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lampirkan SK
     *
     * Body: `{"berkas_id": "<uuid dari /v1/berkas>", "jenis": "sk" | "lampiran", "nomor": "123/UN.P/2026", "tanggal": "2026-11-15", "perihal": "..."}`.
     * Unggah file lebih dulu lewat `/v1/berkas` (sekali atau bertahap); berkas tidak disalin, hanya ditautkan dan tercatat dipakai
     * (tidak bisa dihapus dari manajer berkas selama dipakai). Nomor wajib untuk SK.
     *
     * `POST /v1/aturan/{id}/lampiran`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{berkas_id?: string|null, jenis?: string|null, nomor?: string|null, tanggal?: string|null, perihal?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdLampiran(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/lampiran', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas lampiran
     *
     * Soft delete. SK terakhir aturan aktif tidak bisa dilepas.
     *
     * `POST /v1/aturan/{id}/lampiran/{lampiran}/hapus`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param int|string $lampiran UUID lampiran
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdLampiranByLampiranHapus(int|string $id, int|string $lampiran, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/lampiran/{lampiran}/hapus', ['id' => $id, 'lampiran' => $lampiran], $query, null, $options, false, false);
    }

    /**
     * Unduh SK
     *
     * Isi berkas SK (302 ke URL sementara bila disimpan di bucket). ?unduh=1 untuk lampiran unduhan.
     *
     * `GET /v1/aturan/{id}/lampiran/{lampiran}/unduh`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param int|string $lampiran UUID lampiran
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdLampiranByLampiranUnduh(int|string $id, int|string $lampiran, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/lampiran/{lampiran}/unduh', ['id' => $id, 'lampiran' => $lampiran], $query, null, $options, false, false);
    }

    /**
     * Daftar pengecualian
     *
     * Dispensasi aturan ini (pengatur saja).
     *
     * `GET /v1/aturan/{id}/pengecualian`
     *
     * scope: `aturan:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdPengecualian(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/aturan/{id}/pengecualian', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Beri pengecualian (dispensasi)
     *
     * Body: {"subjek_jenis": "mahasiswa"|"dosen"|"prodi", "subjek": "NIM/NIDN/kode prodi", "alasan", "berlaku_sampai"?, "berkas_id"? (surat/SK dispensasi)}. Satu-satunya cara melonggarkan aturan untuk subjek tertentu. Event aturan.pengecualian_diberikan.
     *
     * `POST /v1/aturan/{id}/pengecualian`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param array{subjek_jenis?: string|null, subjek?: string|null, alasan?: string|null, berlaku_sampai?: string|null, berkas_id?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPengecualian(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/pengecualian', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cabut pengecualian
     *
     * Soft delete.
     *
     * `POST /v1/aturan/{id}/pengecualian/{pengecualian}/hapus`
     *
     * scope: `aturan:write`
     *
     * @param int|string $id UUID aturan
     * @param int|string $pengecualian UUID pengecualian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPengecualianByPengecualianHapus(int|string $id, int|string $pengecualian, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/aturan/{id}/pengecualian/{pengecualian}/hapus', ['id' => $id, 'pengecualian' => $pengecualian], $query, null, $options, false, false);
    }
}
