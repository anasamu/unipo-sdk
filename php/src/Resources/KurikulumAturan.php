<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kurikulum: Aturan berversi, Kurikulum: Kerangka (data), Kurikulum: Perangkat MK, Kurikulum: Asesmen & RPS, Kurikulum: Pengajuan & validasi BAAK, Kurikulum: Evaluasi & peninjauan
 */
final class KurikulumAturan extends Resource
{
    /**
     * Versi aturan kurikulum
     *
     * Semua versi (universitas, turunan fakultas/prodi, versi prodi hasil impor kurikulum lama) dengan kerangka, lingkup, angkatan/periode berlaku, SK registri, jumlah mahasiswa aktif yang membacanya, dan penanda berlaku sekarang. Filter ?lingkup=, ?prodi= (versi universitas + versi prodi itu), ?fakultas=.
     *
     * `GET /v1/kurikulum-aturan`
     *
     * scope: `kurikulum:read`
     *
     * @param array{lingkup?: string, prodi?: string, fakultas?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function list(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan', [], $query, null, $options, false, false);
    }

    /**
     * Draf aturan kurikulum baru
     *
     * Body: nama, kerangka, lingkup (universitas|fakultas|prodi), kode_fakultas/kode_prodi, induk_universitas_id (turunan), angkatan_mulai, angkatan_selesai, berlaku_mulai, berlaku_selesai (tahun_id), kurikulum_id (kurikulum OBE prodi), dasar_hukum, sk_id (registri SK), catatan_perubahan, isi {struktur, penilaian, mbkm, kelulusan, obe, turunan}. Nilai kosong = ketentuan lama.
     *
     * `POST /v1/kurikulum-aturan`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function create(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Referensi editor aturan kurikulum
     *
     * Kerangka (dinamis), bagian yang boleh diturunkan, komponen nilai SIAKAD, fakultas, prodi, periode, hak pemilik token (universitas, prodi), dan isi bawaan (kosong = ketentuan lama).
     *
     * `GET /v1/kurikulum-aturan/referensi`
     *
     * scope: `kurikulum:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getReferensi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Impor kurikulum lama menjadi versi
     *
     * Body: {kode_prodi, tahun_id: ["20231","20232"], nama, kerangka, angkatan_mulai, angkatan_selesai, dasar_hukum, impor_mk, jalankan}. Membaca m_program_studi, m_kurikulum, m_nilai, m_mata_kuliah (tidak diubah); impor_mk memakai impor Kurikulum OBE (butuh kurikulum:migrasi). Tanpa jalankan = pratinjau.
     *
     * `POST /v1/kurikulum-aturan/impor-lama`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postImporLama(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/impor-lama', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kerangka kurikulum
     *
     * KBK, KKNI, MBKM, OBE, dan kerangka tambahan.
     *
     * `GET /v1/kurikulum-aturan/kerangka`
     *
     * scope: `kurikulum:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKerangka(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/kerangka', [], $query, null, $options, false, false);
    }

    /**
     * Tambah/ubah kerangka kurikulum
     *
     * Body: {kode, nama, keterangan, urutan, aktif}. BAAK.
     *
     * `POST /v1/kurikulum-aturan/kerangka`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerangka(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/kerangka', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ketercapaian CPL
     *
     * Dihitung dari nilai komponen (Harian/Tugas/UTS/UAS) lewat rencana evaluasi RPS -> CPMK -> CPL; MK tanpa pemetaan komponen memakai nilai akhir x 25 dan matriks CPL-MK. Ambang dari CPL atau aturan kurikulum yang berlaku.
     *
     * `GET /v1/kurikulum-aturan/ketercapaian`
     *
     * scope: `kurikulum:read`
     *
     * @param array{kurikulum_id: int, angkatan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKetercapaian(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/ketercapaian', [], $query, null, $options, false, false);
    }

    /**
     * Statistik mata kuliah
     *
     * Per periode (8 terakhir) dan per kelas: peserta, sebaran huruf, rata-rata bobot, persen lulus; kehadiran; capaian CPMK dari komponen nilai (rencana evaluasi RPS); kontribusi MK ke CPL; kelengkapan perangkat.
     *
     * `GET /v1/kurikulum-aturan/statistik/mk`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, kode_mk: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getStatistikMk(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/statistik/mk', [], $query, null, $options, false, false);
    }

    /**
     * Tren ketercapaian CPL
     *
     * Rekap per periode (tugas terjadwal kurikulum:capaian).
     *
     * `GET /v1/kurikulum-aturan/ketercapaian/tren`
     *
     * scope: `kurikulum:read`
     *
     * @param array{kurikulum_id: int, angkatan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKetercapaianTren(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/ketercapaian/tren', [], $query, null, $options, false, false);
    }

    /**
     * Ekspor ketercapaian CPL (LED/borang, SPMI)
     *
     * CSV per CPL x angkatan + rujukan pedoman.
     *
     * `GET /v1/kurikulum-aturan/ketercapaian/ekspor`
     *
     * scope: `kurikulum:read`
     *
     * @param array{kurikulum_id: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKetercapaianEkspor(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/ketercapaian/ekspor', [], $query, null, $options, false, false);
    }

    /**
     * Ketercapaian CPL satu mahasiswa
     *
     * Kurikulum OBE dari aturan kurikulum yang berlaku (atau ?kurikulum_id=).
     *
     * `GET /v1/kurikulum-aturan/ketercapaian/mahasiswa/{nim}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKetercapaianMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/ketercapaian/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Versi definisi kerangka
     *
     * Definisi kerangka (bagian, isian, isian MK, perangkat, taksonomi, templat RPS, aturan bawaan) berversi.
     *
     * `GET /v1/kurikulum-aturan/kerangka-versi`
     *
     * scope: `kurikulum:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKerangkaVersi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/kerangka-versi', [], $query, null, $options, false, false);
    }

    /**
     * Definisi kerangka baru (draf)
     *
     * Body: nama, dasar_hukum, isi {kode, bagian, isian_mk, perangkat, taksonomi, rps, aturan_bawaan}. BAAK.
     *
     * `POST /v1/kurikulum-aturan/kerangka-versi`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerangkaVersi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/kerangka-versi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail definisi kerangka
     *
     * Isi, primitif yang tersedia, jenis isian, fakta validasi RPS, jumlah versi aturan yang mengunci definisi ini.
     *
     * `GET /v1/kurikulum-aturan/kerangka-versi/{id}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKerangkaVersiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/kerangka-versi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah draf definisi kerangka
     *
     * `PUT /v1/kurikulum-aturan/kerangka-versi/{id}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKerangkaVersiById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-aturan/kerangka-versi/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin definisi kerangka
     *
     * Body: nama, kode (isi kode = kerangka baru; kosong = revisi kerangka yang sama).
     *
     * `POST /v1/kurikulum-aturan/kerangka-versi/{id}/salin`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerangkaVersiByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/kerangka-versi/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banding definisi kerangka
     *
     * `GET /v1/kurikulum-aturan/kerangka-versi/{id}/banding`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKerangkaVersiByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/kerangka-versi/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Definisi kerangka: terbitkan
     *
     * `POST /v1/kurikulum-aturan/kerangka-versi/{id}/terbitkan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerangkaVersiByIdTerbitkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/kerangka-versi/{id}/terbitkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Definisi kerangka: arsipkan
     *
     * `POST /v1/kurikulum-aturan/kerangka-versi/{id}/arsipkan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerangkaVersiByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/kerangka-versi/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Definisi kerangka: hapus
     *
     * `POST /v1/kurikulum-aturan/kerangka-versi/{id}/hapus`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKerangkaVersiByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/kerangka-versi/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Perangkat satu MK
     *
     * Perangkat wajib menurut aturan kurikulum versi MK (per jenis MK), bukti, status (belum/dinyatakan/diunggah/diverifikasi/ditolak), lengkap, nilai PDDikti dihitung dari bukti.
     *
     * `GET /v1/kurikulum-aturan/perangkat/mk`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, kode_mk: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPerangkatMk(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/perangkat/mk', [], $query, null, $options, false, false);
    }

    /**
     * Unggah bukti perangkat
     *
     * Body: {kode_prodi, kode_mk, tahun_id, perangkat, berkas_id (unggah dulu ke /v1/berkas), catatan}. Dosen koordinator atau pengelola kurikulum prodi. Versi bukti naik.
     *
     * `POST /v1/kurikulum-aturan/perangkat/unggah`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPerangkatUnggah(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/perangkat/unggah', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Verifikasi bukti perangkat
     *
     * Body: {keputusan: setuju|tolak, catatan}. Oleh peran yang ditentukan aturan (kaprodi, gpm, upm, baak). Setuju mengisi kolom PDDikti lama periode itu.
     *
     * `POST /v1/kurikulum-aturan/perangkat/bukti/{id}/verifikasi`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID bukti
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPerangkatBuktiByIdVerifikasi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/perangkat/bukti/{id}/verifikasi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Rekap kelengkapan perangkat
     *
     * Per MK periode: persen, perangkat kurang, menunggu verifikasi, koordinator.
     *
     * `GET /v1/kurikulum-aturan/perangkat/rekap`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPerangkatRekap(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/perangkat/rekap', [], $query, null, $options, false, false);
    }

    /**
     * Kirim pengingat ke dosen koordinator
     *
     * Body: {kode_prodi, tahun_id}. Notifikasi ke koordinator MK yang belum lengkap.
     *
     * `POST /v1/kurikulum-aturan/perangkat/pengingat`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPerangkatPengingat(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/perangkat/pengingat', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tanda kurikulum beberapa butir
     *
     * Query: entitas, ids=1,2,3.
     *
     * `GET /v1/kurikulum-aturan/asesmen/tanda`
     *
     * scope: `kurikulum:read`
     *
     * @param array{entitas?: string, ids?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsesmenTanda(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/asesmen/tanda', [], $query, null, $options, false, false);
    }

    /**
     * Tandai butir asesmen
     *
     * Body: {entitas: lms_bank_soal|cbt_soal|lms_tugas|lms_kuis|lms_kuis_soal, entitas_id, cpmk_id, sub_cpmk_id, kognitif (taksonomi kerangka), bentuk}.
     *
     * `POST /v1/kurikulum-aturan/asesmen/tanda`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postAsesmenTanda(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/asesmen/tanda', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pilihan penanda MK
     *
     * CPMK, sub-CPMK, taksonomi kognitif (definisi kerangka), dan metode asesmen versi aturan MK.
     *
     * `GET /v1/kurikulum-aturan/asesmen/pilihan`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, kode_mk: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsesmenPilihan(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/asesmen/pilihan', [], $query, null, $options, false, false);
    }

    /**
     * Siapkan kelas LMS dari RPS
     *
     * Topik per pertemuan RPS dan tugas dari rencana evaluasi komponen Tugas (bertanda CPMK). Tanpa "jalankan": true = pratinjau. Kunci periode modul lms.
     *
     * `POST /v1/kurikulum-aturan/lms/kelas/{id}/dari-rps`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kelas LMS
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postLmsKelasByIdDariRps(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/lms/kelas/{id}/dari-rps', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kisi-kisi ujian CBT
     *
     * Proporsi poin soal per CPMK dibanding rencana evaluasi RPS (komponen UTS/UAS/Harian), sebaran tingkat kognitif, peringatan.
     *
     * `GET /v1/kurikulum-aturan/asesmen/cbt/{id}/kisi`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID ujian CBT
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getAsesmenCbtByIdKisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/asesmen/cbt/{id}/kisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Periksa RPS dengan templat kerangka
     *
     * Validasi berparameter (total bobot, jumlah pertemuan, CPMK teruji, ...) dari definisi kerangka versi MK.
     *
     * `GET /v1/kurikulum-aturan/rps/{id}/periksa`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID RPS
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRpsByIdPeriksa(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/rps/{id}/periksa', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isian dinamis kerangka
     *
     * Skema + nilai: entitas=kurikulum&kunci=<id kurikulum OBE> (bagian non-primitif) atau entitas=mk&kunci=<prodi>:<kode_mk> (isian MK tambahan).
     *
     * `GET /v1/kurikulum-aturan/isian`
     *
     * scope: `kurikulum:read`
     *
     * @param array{entitas: string, kunci: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getIsian(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/isian', [], $query, null, $options, false, false);
    }

    /**
     * Simpan isian dinamis
     *
     * Body: {entitas, kunci, bagian, nilai: {isian: nilai}}; diperiksa menurut skema kerangka.
     *
     * `PUT /v1/kurikulum-aturan/isian`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putIsian(array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-aturan/isian', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Pilihan wizard kurikulum baru
     *
     * Versi aturan universitas terbit, kerangka (bagian CPL/bahan kajian, alur pengesahan), kurikulum OBE prodi (sumber salinan), semester MK lama, kurikulum aktif, pengajuan berjalan, hak.
     *
     * `GET /v1/kurikulum-aturan/pengajuan/acuan`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanAcuan(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/pengajuan/acuan', [], $query, null, $options, false, false);
    }

    /**
     * Antrean pengajuan kurikulum
     *
     * Alur pengesahan kurikulum lintas prodi (BAAK: semua fakultas; penyusun: prodinya) beserta alur pemeriksa, tahap sekarang, boleh (giliran pemilik token), dan ringkasan kurikulum. Filter ?giliran=saya, ?status=, ?fakultas=, ?prodi=.
     *
     * `GET /v1/kurikulum-aturan/pengajuan`
     *
     * scope: `kurikulum:read`
     *
     * @param array{giliran?: string, status?: string, fakultas?: string, prodi?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuan(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/pengajuan', [], $query, null, $options, false, false);
    }

    /**
     * Buat kurikulum baru (dan ajukan)
     *
     * Body: {kode_prodi, kerangka, acuan_versi_id, identitas {kode, nama, tahun_berlaku, angkatan_mulai, sks_lulus, sks_wajib, sks_pilihan, masa_tempuh, ipk_min_lulus, ...}, sumber {jenis: kosong|kurikulum|lama, kurikulum_id, tahun_id[]}, cpl [{kode, deskripsi, ranah}], bahan_kajian [{kode, nama}], ajukan, isian {ringkasan, dasar}}. Penyusun kurikulum prodi (kaprodi/sekprodi/tim kurikulum). ajukan=true memulai alur pengesahan berjenjang dan menjalankan tahap penyusunan.
     *
     * `POST /v1/kurikulum-aturan/pengajuan`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuan(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/pengajuan', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ajukan kurikulum draf
     *
     * Memulai (atau melanjutkan setelah dikembalikan) alur pengesahan berjenjang kurikulum ini. Body: {isian: {ringkasan, dasar}}.
     *
     * `POST /v1/kurikulum-aturan/pengajuan/kurikulum/{id}/ajukan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum OBE
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postPengajuanKurikulumByIdAjukan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/pengajuan/kurikulum/{id}/ajukan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Cek administrasi otomatis
     *
     * Struktur SKS terhadap aturan versi acuan dan ketentuan jenjang, batas SKS per semester, kode MK unik/format/bentrok prodi lain, kesiapan PDDikti (SKS komponen, jenis MK, isian Feeder). Tingkat: lolos, peringatan, galat. Ringkasan validasi isi (SN Dikti/OBE) sebagai konteks.
     *
     * `GET /v1/kurikulum-aturan/pengajuan/kurikulum/{id}/periksa`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum OBE
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanKurikulumByIdPeriksa(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/pengajuan/kurikulum/{id}/periksa', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Banding dengan kurikulum aktif
     *
     * Kurikulum OBE berlaku/disahkan terbaru prodi (atau MK SIAKAD lama semester terakhir): MK ditambah, dihapus, berubah (nama/SKS/semester/jenis), perubahan SKS lulus/masa tempuh/IPK.
     *
     * `GET /v1/kurikulum-aturan/pengajuan/kurikulum/{id}/banding`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum OBE
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getPengajuanKurikulumByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/pengajuan/kurikulum/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Jenis evaluasi prodi
     *
     * Dari definisi kerangka versi aturan yang berlaku: portofolio MK, evaluasi CPL, peninjauan (siklus, instrumen, masukan otomatis, tahap & peran, PPEPP).
     *
     * `GET /v1/kurikulum-aturan/evaluasi/definisi`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEvaluasiDefinisi(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/evaluasi/definisi', [], $query, null, $options, false, false);
    }

    /**
     * Daftar evaluasi prodi
     *
     * `GET /v1/kurikulum-aturan/evaluasi`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, jenis?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEvaluasi(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/evaluasi', [], $query, null, $options, false, false);
    }

    /**
     * Mulai evaluasi
     *
     * Body: {jenis, kode_prodi, kode_mk (tingkat MK), periode (tahun_id/tahun), tim: [username]}. Masukan otomatis ditarik.
     *
     * `POST /v1/kurikulum-aturan/evaluasi`
     *
     * scope: `kurikulum:write`
     *
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEvaluasi(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/evaluasi', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail evaluasi
     *
     * Definisi, instrumen terisi, masukan otomatis, alur tahap (bentuk AlurPemeriksa), hak tahap sekarang.
     *
     * `GET /v1/kurikulum-aturan/evaluasi/{id}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getEvaluasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/evaluasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Isi instrumen evaluasi
     *
     * `PUT /v1/kurikulum-aturan/evaluasi/{id}/isian`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putEvaluasiByIdIsian(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-aturan/evaluasi/{id}/isian', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Jalankan tahap evaluasi
     *
     * Body: {keputusan: lanjut|kembalikan, catatan, nilai}. Tahap terakhir = disahkan; peninjauan yang disahkan membuat draf versi aturan baru dari rekomendasi.
     *
     * `POST /v1/kurikulum-aturan/evaluasi/{id}/proses`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postEvaluasiByIdProses(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/evaluasi/{id}/proses', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Aturan kurikulum yang berlaku untuk mahasiswa
     *
     * Versi dasar + turunan yang dibaca otomatis menurut angkatan/periode/prodi (atau timpaan), isi efektif, skala nilai, batas SKS semester ini, syarat lulus (sumber kurikulum/lama) dan pemenuhannya.
     *
     * `GET /v1/kurikulum-aturan/mahasiswa/{nim}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $nim NIM
     * @param array{tahun_id?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Pindahkan mahasiswa ke versi lain
     *
     * Body: {versi_id, alasan}. Untuk mahasiswa pindah kurikulum (pakai ekuivalensi MK di kurikulum OBE).
     *
     * `PUT /v1/kurikulum-aturan/mahasiswa/{nim}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMahasiswaByNim(int|string $nim, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-aturan/mahasiswa/{nim}', ['nim' => $nim], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Kembalikan mahasiswa ke versi otomatis
     *
     * `DELETE /v1/kurikulum-aturan/mahasiswa/{nim}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $nim NIM
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-aturan/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }

    /**
     * Detail aturan kurikulum
     *
     * Isi lengkap, pelengkap (kerangka, lingkup, angkatan), turunan, induk universitas, kurikulum OBE, mahasiswa aktif per prodi, perubahan dari versi asal, riwayat, hak.
     *
     * `GET /v1/kurikulum-aturan/{id}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah draf aturan kurikulum
     *
     * Versi terbit dikunci; salin untuk mengubah. Turunan hanya mengubah bagian yang diizinkan universitas.
     *
     * `PUT /v1/kurikulum-aturan/{id}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-aturan/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Salin menjadi versi baru (draf)
     *
     * `POST /v1/kurikulum-aturan/{id}/salin`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdSalin(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/{id}/salin', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat turunan fakultas/prodi
     *
     * Body: {lingkup: fakultas|prodi, kode_fakultas|kode_prodi, nama, kurikulum_id}. Dari versi universitas yang mengizinkan bagian turunan.
     *
     * `POST /v1/kurikulum-aturan/{id}/turunkan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdTurunkan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/{id}/turunkan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Banding dua versi
     *
     * Bawaan dibanding versi asal salinan.
     *
     * `GET /v1/kurikulum-aturan/{id}/banding`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID
     * @param array{dengan?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdBanding(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/{id}/banding', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Pratinjau dampak
     *
     * Mahasiswa aktif yang aturan kurikulumnya berubah bila versi ini terbit: per prodi, SKS lulus dan skala nilai yang berubah, status lulus akademik sebelum/sesudah. Tidak menyimpan.
     *
     * `GET /v1/kurikulum-aturan/{id}/pratinjau`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getByIdPratinjau(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-aturan/{id}/pratinjau', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan kurikulum: Terbitkan (draf -> terbit; periode yang ditutup butuh buka kembali)
     *
     * `POST /v1/kurikulum-aturan/{id}/terbitkan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdTerbitkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/{id}/terbitkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan kurikulum: Arsipkan versi terbit
     *
     * `POST /v1/kurikulum-aturan/{id}/arsipkan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdArsipkan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/{id}/arsipkan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Aturan kurikulum: Hapus draf
     *
     * `POST /v1/kurikulum-aturan/{id}/hapus`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postByIdHapus(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-aturan/{id}/hapus', ['id' => $id], $query, null, $options, false, false);
    }
}
