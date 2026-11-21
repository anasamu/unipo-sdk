<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Biaya: Aturan, Biaya: Pembagian, Biaya: SK dan riwayat
 */
final class Biaya extends Resource
{
    /**
     * Hak saya
     *
     * Izin biaya.lihat/susun/setujui/cairkan beserta unitnya, dan menu yang boleh tampil (boleh.susun, boleh.setujui, boleh.cairkan).
     *
     * `GET /v1/biaya/saya`
     *
     * scope: `biaya:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSaya(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/saya', [], $query, null, $options, false, false);
    }

    /**
     * Pilihan form aturan
     *
     * Jenis biaya (m_item_biaya + tagihan PMB), unit organisasi, jabatan, akun pendapatan/beban/kewajiban, jenis penerima, dan cara hitung.
     *
     * `GET /v1/biaya/referensi`
     *
     * scope: `biaya:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Cari pegawai
     *
     * Untuk komponen honor pegawai tertentu. q minimal 2 karakter, maks. 20 baris.
     *
     * `GET /v1/biaya/pegawai`
     *
     * scope: `biaya:read`
     *
     * @param array{q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPegawai(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/pegawai', [], $query, null, $options, false, false);
    }

    /**
     * Periksa komponen (klop)
     *
     * Body: {"tarif"?, "jumlah"?, "komponen": [{"nama", "penerima", "cara", "nilai"}]}. Hasil: klop, pesan, total persen/nominal, contoh pembagian pada tarif, dan simulasi bila jumlah diisi. Tidak menyimpan.
     *
     * `POST /v1/biaya/periksa`
     *
     * scope: `biaya:read`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPeriksa(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/periksa', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Simulasi pembagian
     *
     * Aturan yang berlaku untuk jenis biaya, prodi, angkatan, tahun, dan tanggal itu (atau aturan_id tertentu), lalu pembagian jumlah (bawaan tarif) ke komponen dengan nama penerima nyatanya (unit prodi/fakultas, pejabat).
     *
     * `GET /v1/biaya/simulasi`
     *
     * scope: `biaya:read`
     *
     * @param array{sumber?: string, kode_biaya?: string, kode_prodi?: string, angkatan?: string, tahun_id?: string, tanggal?: string, jumlah?: string, tagihan?: string, aturan_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getSimulasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/simulasi', [], $query, null, $options, false, false);
    }

    /**
     * Daftar aturan biaya
     *
     * Draf/diajukan/ditolak hanya untuk penyusun (biaya.susun di unit cakupannya) dan penetap (biaya.setujui); aturan berlaku dan riwayatnya untuk pemegang biaya.lihat yang terkait (cakupan unitnya/induknya, atau unitnya menerima bagian).
     *
     * `GET /v1/biaya/aturan`
     *
     * scope: `biaya:read` · berhalaman
     *
     * @param array{status?: string, sumber?: string, kode_biaya?: string, unit_id?: string, berlaku_pada?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/aturan', [], $query, null, $options, false, false);
    }

    /**
     * Susun aturan biaya (draf)
     *
     * Izin `biaya.susun` (berlingkup unit: hanya cakupan unitnya). Body:
     * `{"nama": "Biaya ujian akhir FIK 2026", "sumber": "mahasiswa", "kode_biaya": "007", "cakupan_unit_id": 2, "penyelenggara_unit_id": 2, "tarif": 300000,
     * "berlaku_mulai": "2026-08-01", "berlaku_selesai": null, "angkatan": null, "tahun_id": null, "keterangan": "...",
     * "komponen": [{"nama": "Yayasan", "penerima": "yayasan", "cara": "persen", "nilai": 20}, {"nama": "Rektorat", "penerima": "unit", "unit_id": 1, "cara": "persen", "nilai": 10},
     * {"nama": "Honor dekan", "penerima": "jabatan", "jabatan_id": 6, "cara": "nominal", "nilai": 10000}, {"nama": "Fakultas", "penerima": "fakultas_mahasiswa", "cara": "sisa"}]}`
     *
     * Penerima: `unit` (unit_id), `prodi_mahasiswa`, `fakultas_mahasiswa`, `yayasan`, `jabatan` (jabatan_id; unit_id kosong = unit pembayar menurut kelompok jabatan), `pegawai` (pegawai_id).
     * Cara: `persen` dari pembayaran, `nominal` per tarif penuh (sebanding bila dicicil), `sisa` (paling banyak satu). Tanpa sisa, total harus tepat 100% tarif.
     *
     * `POST /v1/biaya/aturan`
     *
     * scope: `biaya:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail aturan
     *
     * Beserta komponen, pemeriksaan klop, lampiran SK, jumlah pembayaran yang sudah dibagi, dan tombol yang boleh (boleh.*).
     *
     * `GET /v1/biaya/aturan/{id}`
     *
     * scope: `biaya:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah aturan draf/ditolak
     *
     * Body sama dengan susun (sebagian). Versi naik dan riwayat tercatat; aturan ditolak kembali menjadi draf.
     *
     * `POST /v1/biaya/aturan/{id}`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Revisi aturan berlaku
     *
     * Body: {"berlaku_mulai"?, "catatan"?}. Membuat draf salinan; saat disetujui, aturan lama berstatus diganti dan berakhir sehari sebelum revisi berlaku.
     *
     * `POST /v1/biaya/aturan/{id}/revisi`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdRevisi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/revisi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan ke pimpinan
     *
     * Wajib klop dan sudah ada lampiran SK. Body: {"catatan"?}. Terbit event biaya.aturan_diajukan.
     *
     * `POST /v1/biaya/aturan/{id}/ajukan`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Setujui dan tetapkan
     *
     * Bila rantai validator gerbang berjalan (docs/ATURAN-SK.md), ini keputusan validator tahap berjalan; penetapan WR II = tahap terakhir. Tanpa rantai: izin biaya.setujui (WR bidang keuangan). Wajib klop, ada SK, tidak bertumpang dengan aturan berlaku lain. Pembayaran sejak tanggal mulai berlaku langsung dibagi (hasil di `pembagian`). Body: {"catatan"?}.
     *
     * `POST /v1/biaya/aturan/{id}/setujui`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdSetujui(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/setujui', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tolak
     *
     * Izin biaya.setujui. Body: {"catatan"} (wajib).
     *
     * `POST /v1/biaya/aturan/{id}/tolak`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdTolak(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/tolak', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kembalikan untuk diperbaiki
     *
     * Izin biaya.setujui. Status kembali draf. Body: {"catatan"} (wajib).
     *
     * `POST /v1/biaya/aturan/{id}/kembalikan`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdKembalikan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/kembalikan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Nonaktifkan
     *
     * Izin biaya.setujui. Body: {"catatan", "berlaku_selesai"?} (bawaan hari ini). Pembayaran sesudah tanggal itu tidak dibagi lagi.
     *
     * `POST /v1/biaya/aturan/{id}/nonaktifkan`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdNonaktifkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/nonaktifkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus draf
     *
     * Hanya draf/ditolak.
     *
     * `POST /v1/biaya/aturan/{id}/hapus`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdHapus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/hapus', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Riwayat aturan
     *
     * Semua perubahan, pengajuan, keputusan, lampiran, termasuk aturan yang direvisinya, dengan potret data tiap versi.
     *
     * `GET /v1/biaya/aturan/{id}/riwayat`
     *
     * scope: `biaya:read`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanByIdRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/aturan/{id}/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Lampirkan SK/dokumen
     *
     * Unggah dulu ke storage (POST /v1/berkas), lalu body: {"berkas_id", "jenis": "sk|lampiran", "nomor" (wajib untuk SK), "tanggal"?, "perihal"?}.
     *
     * `POST /v1/biaya/aturan/{id}/lampiran`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdLampiran(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/lampiran', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lepas lampiran
     *
     * SK terakhir aturan diajukan/berlaku tidak bisa dilepas.
     *
     * `POST /v1/biaya/aturan/{id}/lampiran/{lampiran}/hapus`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID aturan
     * @param int|string $lampiran UUID lampiran
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAturanByIdLampiranByLampiranHapus(int|string $id, int|string $lampiran, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/aturan/{id}/lampiran/{lampiran}/hapus', ['id' => $id, 'lampiran' => $lampiran], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Lihat/unduh lampiran
     *
     * ?unduh=1 untuk mengunduh.
     *
     * `GET /v1/biaya/aturan/{id}/lampiran/{lampiran}`
     *
     * scope: `biaya:read`
     *
     * @param int|string $id UUID aturan
     * @param int|string $lampiran UUID lampiran
     * @param array{unduh?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAturanByIdLampiranByLampiran(int|string $id, int|string $lampiran, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/aturan/{id}/lampiran/{lampiran}', ['id' => $id, 'lampiran' => $lampiran], $query, null, $options, false, false);
    }

    /**
     * Rekap pembagian
     *
     * Hak tiap penerima (unit, yayasan, pegawai) dengan yang sudah dicairkan dan sisanya, per jenis penerima, per jenis biaya, per komponen, per bulan, per prodi. Pemegang biaya.lihat berlingkup unit hanya melihat bagian yang diterima unitnya atau berasal dari pembayar unitnya (arah=terima|asal).
     *
     * `GET /v1/biaya/pembagian`
     *
     * scope: `biaya:read`
     *
     * @param array{dari?: string, sampai?: string, unit_id?: string, arah?: string, kode_biaya?: string, sumber?: string, penerima?: string, aturan_id?: string, tahun_id?: string, kode_prodi?: string, pegawai_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembagian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/pembagian', [], $query, null, $options, false, false);
    }

    /**
     * Rincian pembagian per pembayaran
     *
     * Filter sama dengan rekap.
     *
     * `GET /v1/biaya/pembagian/rincian`
     *
     * scope: `biaya:read` · berhalaman
     *
     * @param array{dari?: string, sampai?: string, unit_id?: string, arah?: string, kode_biaya?: string, penerima?: string, aturan_id?: string, pegawai_id?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPembagianRincian(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/pembagian/rincian', [], $query, null, $options, false, false);
    }

    /**
     * Ringkasan untuk dasbor
     *
     * Jumlah aturan berlaku/menunggu persetujuan/draf, total dibagi tahun dan bulan ini, belum dicairkan, per jenis penerima, penerima teratas, per bulan, dan jenis biaya yang belum punya aturan.
     *
     * `GET /v1/biaya/ringkasan`
     *
     * scope: `biaya:read`
     *
     * @param array{tahun?: string, unit_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRingkasan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/ringkasan', [], $query, null, $options, false, false);
    }

    /**
     * Sinkron pembagian
     *
     * Izin biaya.cairkan. Body: {"dari"?, "sampai"?}. Membagi pembayaran yang belum dibagi, membagi ulang yang berubah, membatalkan yang dihapus, memperbarui honor SDM dan jurnal. Cron: php artisan biaya:bagi (juga ikut keu:jurnal).
     *
     * `POST /v1/biaya/pembagian/sinkron`
     *
     * scope: `biaya:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPembagianSinkron(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/pembagian/sinkron', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar pencairan
     *
     * Pencairan bagian ke unit dan yayasan.
     *
     * `GET /v1/biaya/pencairan`
     *
     * scope: `biaya:read` · berhalaman
     *
     * @param array{unit_id?: string, penerima?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPencairan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/biaya/pencairan', [], $query, null, $options, false, false);
    }

    /**
     * Catat pencairan
     *
     * Izin biaya.cairkan. Body: {"penerima": "unit|yayasan", "unit_id", "jumlah", "tanggal"?, "rekening_asal_id"? (bawaan rekening utama universitas), "rekening_tujuan_id"? (bawaan rekening utama unit), "dari"?, "sampai"?, "uraian"?, "berkas_id"? (bukti transfer)}. Unit: transfer kas; yayasan: D utang kepada yayasan / K kas. Tidak boleh melebihi sisa bagian.
     *
     * `POST /v1/biaya/pencairan`
     *
     * scope: `biaya:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPencairan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/pencairan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Batalkan pencairan
     *
     * Izin biaya.cairkan. Body: {"alasan"}. Jurnalnya dibalik.
     *
     * `POST /v1/biaya/pencairan/{id}/batal`
     *
     * scope: `biaya:write`
     *
     * @param int|string $id UUID pencairan
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPencairanByIdBatal(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/biaya/pencairan/{id}/batal', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }
}
