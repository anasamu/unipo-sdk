<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Keuangan: Validasi syarat
 */
final class SyaratKeuangan extends Resource
{
    /**
     * Katalog syarat, fitur, hak, dan pengaturan unit
     *
     * Syarat keuangan yang bisa divalidasi, fitur (titik aturan aktif yang memakai indikatornya), tahun aktif, izin pengguna (keuangan.syarat.*) beserta unit, dan pengaturan alur unit.
     *
     * `GET /v1/syarat-keuangan/katalog`
     *
     * scope: `syarat:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKatalog(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan/katalog', [], $query, null, $options, false, false);
    }

    /**
     * Antrean syarat keuangan
     *
     * Mahasiswa/pendaftar yang syarat keuangannya belum terpenuhi beserta butir biaya milik unit pengguna (unit lain disembunyikan), dan status validasinya. meta: tahun_id, syarat, total_sisa.
     *
     * `GET /v1/syarat-keuangan/antrean`
     *
     * scope: `syarat:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, syarat?: string, fitur?: string, tahun_id?: string, prodi?: string, angkatan?: string, status?: string, q?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAntrean(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan/antrean', [], $query, null, $options, false, false);
    }

    /**
     * Rincian syarat satu mahasiswa
     *
     * Status tiap syarat (sistem dan setelah validasi), butir biaya, tagihan per periode, riwayat validasi dengan alur pemeriksa.
     *
     * `GET /v1/syarat-keuangan/subjek/{jenis}/{subjek}`
     *
     * scope: `syarat:read`
     *
     * @param int|string $jenis mahasiswa | pendaftar
     * @param int|string $subjek NIM atau no_pmb
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSubjekByJenisBySubjek(int|string $jenis, int|string $subjek, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan/subjek/{jenis}/{subjek}', ['jenis' => $jenis, 'subjek' => $subjek], $query, null, $options, false, false);
    }

    /**
     * Riwayat dan usulan validasi
     *
     * Rekaman validasi/dispensasi unit pengguna; status=diusulkan untuk antrean persetujuan.
     *
     * `GET /v1/syarat-keuangan`
     *
     * scope: `syarat:read` · berhalaman
     *
     * @param array{page?: int, per_page?: int, status?: string, syarat?: string, tahun_id?: string, jenis?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan', [], $query, null, $options, false, false);
    }

    /**
     * Validasi / dispensasi syarat
     *
     * Body {subjek_jenis?: mahasiswa|pendaftar, subjek, tahun_id?, syarat, jenis: validasi|dispensasi, alasan, kode_biaya?, bukti_berkas? (UUID /v1/berkas), bukti_keterangan?, jumlah?, berlaku_sampai? (dispensasi, wajib), janji_bayar? [{tanggal, jumlah}]}. Tanpa kode_biaya: seluruh syarat bila pemegang global, selain itu semua butir kurang milik unit pengguna. Unit yang mewajibkan persetujuan: status diusulkan.
     *
     * `POST /v1/syarat-keuangan`
     *
     * scope: `syarat:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/syarat-keuangan', [], $query, null, $options, false, false);
    }

    /**
     * Validasi / dispensasi massal
     *
     * Body seperti POST dengan subjek berisi daftar (maks. 200). Hasil {berhasil, gagal: [{subjek, pesan}], data}.
     *
     * `POST /v1/syarat-keuangan/massal`
     *
     * scope: `syarat:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMassal(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/syarat-keuangan/massal', [], $query, null, $options, false, false);
    }

    /**
     * Pengaturan alur unit
     *
     * wajib_persetujuan, wajib_bukti, maks_hari_dispensasi.
     *
     * `GET /v1/syarat-keuangan/pengaturan`
     *
     * scope: `syarat:read`
     *
     * @param array{unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Simpan pengaturan alur unit
     *
     * Body {unit_id?, wajib_persetujuan, wajib_bukti, maks_hari_dispensasi?}. Izin keuangan.syarat.setujui di unit itu.
     *
     * `PUT /v1/syarat-keuangan/pengaturan`
     *
     * scope: `syarat:write`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putPengaturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/syarat-keuangan/pengaturan', [], $query, null, $options, false, false);
    }

    /**
     * Syarat keuangan saya
     *
     * Mahasiswa: status tiap syarat keuangan, butir biaya yang belum memenuhi dan unit pemeriksanya, fitur yang memakainya, validasi/dispensasi yang berlaku.
     *
     * `GET /v1/syarat-keuangan/saya`
     *
     * scope: `syarat:read` · hanya token pengguna
     *
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan/saya', [], $query, null, $options, false, false);
    }

    /**
     * Rincian validasi
     *
     * Dengan log dan alur pemeriksa.
     *
     * `GET /v1/syarat-keuangan/{id}`
     *
     * scope: `syarat:read`
     *
     * @param int|string $id UUID validasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Setujui / tolak usulan
     *
     * Body {keputusan: setujui|tolak, catatan (wajib bila tolak)}.
     *
     * `POST /v1/syarat-keuangan/{id}/putuskan`
     *
     * scope: `syarat:write`
     *
     * @param int|string $id UUID validasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdPutuskan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/syarat-keuangan/{id}/putuskan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Cabut validasi / batalkan usulan
     *
     * Body {alasan}. Aktif -> dicabut (syarat kembali dinilai dari pembayaran); diusulkan -> dibatalkan.
     *
     * `POST /v1/syarat-keuangan/{id}/cabut`
     *
     * scope: `syarat:write`
     *
     * @param int|string $id UUID validasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdCabut(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/syarat-keuangan/{id}/cabut', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Berkas bukti
     *
     * Petugas unit pemilik.
     *
     * `GET /v1/syarat-keuangan/{id}/bukti`
     *
     * scope: `syarat:read`
     *
     * @param int|string $id UUID validasi
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdBukti(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/syarat-keuangan/{id}/bukti', ['id' => $id], $query, null, $options, false, false);
    }
}
