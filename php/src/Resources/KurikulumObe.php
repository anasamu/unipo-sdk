<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIVERSITAS POHUWATO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Kurikulum OBE, Kurikulum OBE: migrasi dari kurikulum lama, Kurikulum OBE: evaluasi & capaian, Kurikulum OBE: profil, CPL, bahan kajian, Kurikulum OBE: mata kuliah & CPMK, Kurikulum OBE: RPS
 */
final class KurikulumObe extends Resource
{
    /**
     * Ketentuan dan kode referensi
     *
     * Ketentuan Permendiktisaintek 39/2025 (SKS minimal, masa tempuh, batas SKS per semester, IPK lulus per jenjang), ranah/kelompok CPL, bentuk pembelajaran, jenis/kelompok MK, jenis evaluasi Neo Feeder.
     *
     * `GET /v1/kurikulum-obe/referensi`
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
        return $this->send('GET', '/v1/kurikulum-obe/referensi', [], $query, null, $options, false, false);
    }

    /**
     * Tahap migrasi per prodi
     *
     * Tahap: 1_belum, 2_dilengkapi (sudah ada kurikulum draf), 3_disahkan, 4_diterbitkan (MK kurikulum baru sudah dipakai SIAKAD lama). Beserta jumlah semester data lama.
     *
     * `GET /v1/kurikulum-obe/migrasi/status`
     *
     * scope: `kurikulum:read`
     *
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasiStatus(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/migrasi/status', [], $query, null, $options, false, false);
    }

    /**
     * Semester data MK lama satu prodi
     *
     * Jumlah MK, SKS, prasyarat per tahun_id di m_mata_kuliah (sumber impor).
     *
     * `GET /v1/kurikulum-obe/migrasi/semester-lama`
     *
     * scope: `kurikulum:read`
     *
     * @param array{prodi: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasiSemesterLama(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/migrasi/semester-lama', [], $query, null, $options, false, false);
    }

    /**
     * Tahap 1: impor kurikulum lama
     *
     * Membaca MK dari m_mata_kuliah (+ prasyarat m_mata_kuliah_syarat, jumlah SKS m_kurikulum) untuk satu atau beberapa semester
     * dan menyimpannya sebagai kurikulum OBE draf. Tabel lama tidak diubah. MK dengan kode sama di beberapa semester diambil dari
     * semester terakhir. Tanpa `"jalankan": true` hanya pratinjau.
     *
     * Kurikulum baru: `{"kode_prodi": "55201", "tahun_id": ["20251", "20252"], "kurikulum": {"kode": "K2025", "nama": "Kurikulum 2025"}, "jalankan": true}`
     *
     * Sinkron ulang ke kurikulum draf yang sudah ada: `{"kode_prodi": "55201", "tahun_id": "20261", "kurikulum_id": 3, "jalankan": true}`
     * (MK baru ditambah, MK berubah diperbarui, CPL/CPMK/RPS tidak disentuh).
     *
     * `POST /v1/kurikulum-obe/migrasi/impor`
     *
     * scope: `kurikulum:migrasi`
     *
     * @param array{kode_prodi: string|null, tahun_id: string|list<mixed>, kurikulum_id?: int|null, kurikulum?: array<string, mixed>, jalankan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMigrasiImpor(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/migrasi/impor', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Tahap 3: terbitkan MK ke SIAKAD lama
     *
     * Menulis MK kurikulum yang disahkan/berlaku ke m_mata_kuliah untuk satu semester (beserta m_mata_kuliah_syarat dan
     * m_kurikulum bila belum ada), agar KRS, jadwal, nilai, dan Feeder lama tetap berjalan. Baris yang sudah ada di semester
     * itu tidak diubah (kecuali buatan terbit sebelumnya dan `perbarui: true`). Tanpa `"jalankan": true` hanya pratinjau.
     *
     * `{"kurikulum_id": 3, "tahun_id": "20261", "semester": "semua", "jalankan": true}`
     *
     * `POST /v1/kurikulum-obe/migrasi/terbit`
     *
     * scope: `kurikulum:migrasi`
     *
     * @param array{kurikulum_id: int|null, tahun_id: string|null, semester?: mixed, mk_id?: list<mixed>, perbarui?: bool, bulatkan_sks?: bool, abaikan_galat?: bool, jalankan?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMigrasiTerbit(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/migrasi/terbit', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Bandingkan kurikulum baru dengan MK lama satu semester
     *
     * MK hanya di kurikulum baru, hanya di m_mata_kuliah, atau berbeda (nama, semester, SKS, jenis, konsentrasi).
     *
     * `GET /v1/kurikulum-obe/migrasi/selisih`
     *
     * scope: `kurikulum:read`
     *
     * @param array{kurikulum_id: int, tahun_id: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasiSelisih(array $query, array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/migrasi/selisih', [], $query, null, $options, false, false);
    }

    /**
     * Riwayat migrasi
     *
     * `GET /v1/kurikulum-obe/migrasi`
     *
     * scope: `kurikulum:read` · berhalaman
     *
     * @param array{prodi?: string, jenis?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasi(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/migrasi', [], $query, null, $options, false, false);
    }

    /**
     * Detail migrasi
     *
     * Termasuk daftar baris yang ditambah/diubah.
     *
     * `GET /v1/kurikulum-obe/migrasi/{id}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID migrasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMigrasiById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/migrasi/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Batalkan impor/terbit
     *
     * Terbit: ditolak bila MK yang diterbitkan sudah dipakai jadwal/KRS/nilai. Impor: hanya bila kurikulum masih draf; bila sudah ada CPL/CPMK kirim `{"paksa": true}`. Batalkan dari yang terbaru.
     *
     * `POST /v1/kurikulum-obe/migrasi/{id}/batal`
     *
     * scope: `kurikulum:migrasi`
     *
     * @param int|string $id ID migrasi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMigrasiByIdBatal(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/migrasi/{id}/batal', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Daftar kurikulum
     *
     * Token mahasiswa hanya melihat kurikulum disahkan/berlaku/arsip.
     *
     * `GET /v1/kurikulum-obe/kurikulum`
     *
     * scope: `kurikulum:read` · berhalaman
     *
     * @param array{prodi?: string, status?: string, q?: string, page?: int, per_page?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulum(array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum', [], $query, null, $options, false, false);
    }

    /**
     * Buat kurikulum baru (draf)
     *
     * Masa tempuh, SKS lulus, IPK minimal, dan masa studi maksimal diisi otomatis dari ketentuan jenjang bila tidak dikirim.
     *
     * `POST /v1/kurikulum-obe/kurikulum`
     *
     * scope: `kurikulum:write`
     *
     * @param array{kode_prodi: string|null, kode: string|null, nama: string|null, nama_en?: string|null, tahun_berlaku?: int|null, tahun_id_mulai?: string|null, tahun_id_selesai?: string|null, regulasi?: string|null, no_sk?: string|null, tanggal_sk?: string|null, masa_tempuh?: int|null, masa_studi_maks?: int|null, sks_lulus?: int|null, sks_wajib?: int|null, sks_pilihan?: int|null, ipk_min_lulus?: float|int|null, visi_keilmuan?: string|null, kompetensi_utama?: string|null, metode_pembelajaran?: string|null, modalitas_pembelajaran?: string|null, syarat_masuk?: string|null, penilaian?: string|null, tata_cara_penerimaan?: string|null, tugas_akhir?: string|null, keterangan?: string|null, id_kurikulum_feeder?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulum(array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum', [], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail kurikulum
     *
     * Beserta ringkasan isi, angkatan pengguna, dan transisi status yang tersedia.
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah kurikulum
     *
     * Kurikulum disahkan/berlaku: hanya data naratif dan id Feeder yang bisa diubah; beban belajar butuh revisi.
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array{kode_prodi: string|null, kode: string|null, nama: string|null, nama_en?: string|null, tahun_berlaku?: int|null, tahun_id_mulai?: string|null, tahun_id_selesai?: string|null, regulasi?: string|null, no_sk?: string|null, tanggal_sk?: string|null, masa_tempuh?: int|null, masa_studi_maks?: int|null, sks_lulus?: int|null, sks_wajib?: int|null, sks_pilihan?: int|null, ipk_min_lulus?: float|int|null, visi_keilmuan?: string|null, kompetensi_utama?: string|null, metode_pembelajaran?: string|null, modalitas_pembelajaran?: string|null, syarat_masuk?: string|null, penilaian?: string|null, tata_cara_penerimaan?: string|null, tugas_akhir?: string|null, keterangan?: string|null, id_kurikulum_feeder?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumById(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus kurikulum draf
     *
     * Ditolak bila pernah diterbitkan ke tabel lama.
     *
     * `DELETE /v1/kurikulum-obe/kurikulum/{id}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKurikulumById(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/kurikulum/{id}', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah status
     *
     * Alur: draf -> diajukan (kurikulum:write) -> disahkan (kurikulum:sahkan, wajib `no_sk`, ditolak bila validasi masih ada galat
     * kecuali `abaikan_galat: true`) -> berlaku (wajib `tahun_id_mulai`) -> arsip. Disahkan dapat dikembalikan ke draf.
     * `{"status": "disahkan", "no_sk": "123/UNIPO/2026", "tanggal_sk": "2026-07-01"}`
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/status`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array{status: string, no_sk?: string|null, tanggal_sk?: string|null, tahun_id_mulai?: string|null, tahun_id_selesai?: string|null, abaikan_galat?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdStatus(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/status', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat revisi (versi baru)
     *
     * Menyalin seluruh isi (profil, CPL, BK, MK, prasyarat, CPMK, matriks, RPS terakhir) menjadi draf baru. `{"kode": "K2027", "nama": "Kurikulum 2027"}`
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/revisi`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdRevisi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/revisi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tetapkan angkatan pengguna kurikulum
     *
     * `{"angkatan": [2025, 2026]}`. Satu angkatan satu kurikulum per prodi; `pindahkan: true` memindahkan dari kurikulum lain.
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}/angkatan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumByIdAngkatan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}/angkatan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Validasi terhadap SN Dikti dan kelengkapan OBE
     *
     * Isi minimal kurikulum (Pasal 44), SKS minimal, masa tempuh/studi, batas SKS per semester, IPK lulus, tugas akhir, magang, pemetaan CPL-MK-CPMK, RPS, prasyarat. Tingkat: galat, peringatan, info.
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/validasi`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdValidasi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/validasi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Data pelaporan Neo Feeder
     *
     * Payload Kurikulum, Mata Kuliah, Matkul Kurikulum, Rencana Pembelajaran, dan Rencana Evaluasi (dari RPS disahkan). Hanya disusun, tidak dikirim.
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/feeder`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdFeeder(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/feeder', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Semua matriks pemetaan
     *
     * profil-cpl, cpl-bk, cpl-mk (berbobot), bk-mk, dan cpmk-cpl.
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/matriks`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdMatriks(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/matriks', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Simpan matriks
     *
     * nama: profil-cpl, cpl-bk, cpl-mk, bk-mk. Ganti semua: `{"pasangan": [{"cpl_id": 1, "mk_id": 5, "bobot": 2}]}`; sebagian: `{"tambah": [...], "hapus": [...]}`.
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}/matriks/{nama}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $nama Nama matriks
     * @param array{pasangan?: list<mixed>, tambah?: list<mixed>, hapus?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumByIdMatriksByNama(int|string $id, int|string $nama, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}/matriks/{nama}', ['id' => $id, 'nama' => $nama], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Daftar profil lulusan
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/profil-lulusan`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdProfilLulusan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/profil-lulusan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah profil lulusan
     *
     * Hanya saat kurikulum berstatus draf/diajukan.
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/profil-lulusan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array{kode: string|null, nama: string|null, deskripsi?: string|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdProfilLulusan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/profil-lulusan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah profil lulusan
     *
     * Kirim field yang diubah saja.
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}/profil-lulusan/{sid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $sid ID profil lulusan
     * @param array{kode: string|null, nama: string|null, deskripsi?: string|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumByIdProfilLulusanBySid(int|string $id, int|string $sid, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}/profil-lulusan/{sid}', ['id' => $id, 'sid' => $sid], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus profil lulusan
     *
     * Pemetaan terkait ikut terhapus.
     *
     * `DELETE /v1/kurikulum-obe/kurikulum/{id}/profil-lulusan/{sid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $sid ID profil lulusan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKurikulumByIdProfilLulusanBySid(int|string $id, int|string $sid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/kurikulum/{id}/profil-lulusan/{sid}', ['id' => $id, 'sid' => $sid], $query, null, $options, false, false);
    }

    /**
     * Daftar CPL
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/cpl`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdCpl(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/cpl', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah CPL
     *
     * Hanya saat kurikulum berstatus draf/diajukan.
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/cpl`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array{kode: string|null, ranah: string, kelompok_sn?: string, deskripsi: string|null, deskripsi_en?: string|null, sumber?: string, target?: float|int|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdCpl(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/cpl', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah CPL
     *
     * Kirim field yang diubah saja.
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}/cpl/{sid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $sid ID CPL
     * @param array{kode: string|null, ranah: string, kelompok_sn?: string, deskripsi: string|null, deskripsi_en?: string|null, sumber?: string, target?: float|int|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumByIdCplBySid(int|string $id, int|string $sid, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}/cpl/{sid}', ['id' => $id, 'sid' => $sid], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus CPL
     *
     * Pemetaan terkait ikut terhapus.
     *
     * `DELETE /v1/kurikulum-obe/kurikulum/{id}/cpl/{sid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $sid ID CPL
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKurikulumByIdCplBySid(int|string $id, int|string $sid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/kurikulum/{id}/cpl/{sid}', ['id' => $id, 'sid' => $sid], $query, null, $options, false, false);
    }

    /**
     * Daftar bahan kajian
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/bahan-kajian`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdBahanKajian(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/bahan-kajian', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah bahan kajian
     *
     * Hanya saat kurikulum berstatus draf/diajukan.
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/bahan-kajian`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array{kode: string|null, nama: string|null, deskripsi?: string|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdBahanKajian(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/bahan-kajian', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah bahan kajian
     *
     * Kirim field yang diubah saja.
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}/bahan-kajian/{sid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $sid ID bahan kajian
     * @param array{kode: string|null, nama: string|null, deskripsi?: string|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumByIdBahanKajianBySid(int|string $id, int|string $sid, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}/bahan-kajian/{sid}', ['id' => $id, 'sid' => $sid], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus bahan kajian
     *
     * Pemetaan terkait ikut terhapus.
     *
     * `DELETE /v1/kurikulum-obe/kurikulum/{id}/bahan-kajian/{sid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $sid ID bahan kajian
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKurikulumByIdBahanKajianBySid(int|string $id, int|string $sid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/kurikulum/{id}/bahan-kajian/{sid}', ['id' => $id, 'sid' => $sid], $query, null, $options, false, false);
    }

    /**
     * Mata kuliah kurikulum
     *
     * Beserta kode CPL, prasyarat, jumlah CPMK, status RPS terakhir.
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/mk`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array{semester?: string, jenis?: string, q?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdMk(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/mk', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah mata kuliah
     *
     * Kirim `sks` saja (dianggap tatap muka) atau komponen sks_tatap_muka/sks_praktikum/sks_praktik_lapangan/sks_simulasi.
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/mk`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array{kode_mk: string|null, nama: string|null, nama_en?: string|null, semester?: int|null, sks?: float|int|null, sks_tatap_muka?: float|int|null, sks_praktikum?: float|int|null, sks_praktik_lapangan?: float|int|null, sks_simulasi?: float|int|null, jenis: string, kelompok?: string|null, kode_kurikulum?: string|null, idks?: string|null, bentuk_nilai?: string, modalitas?: string, bentuk_pembelajaran?: list<mixed>, luar_prodi?: bool, pertemuan?: int|null, deskripsi?: string|null, nidn_koordinator?: string|null, id_matkul_feeder?: string|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdMk(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/mk', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Detail mata kuliah
     *
     * Prasyarat, CPL, bahan kajian, CPMK + sub-CPMK, daftar versi RPS.
     *
     * `GET /v1/kurikulum-obe/mk/{mk}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $mk ID MK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMkByMk(int|string $mk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/mk/{mk}', ['mk' => $mk], $query, null, $options, false, false);
    }

    /**
     * Ubah mata kuliah
     *
     * `PUT /v1/kurikulum-obe/mk/{mk}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $mk ID MK
     * @param array{kode_mk: string|null, nama: string|null, nama_en?: string|null, semester?: int|null, sks?: float|int|null, sks_tatap_muka?: float|int|null, sks_praktikum?: float|int|null, sks_praktik_lapangan?: float|int|null, sks_simulasi?: float|int|null, jenis: string, kelompok?: string|null, kode_kurikulum?: string|null, idks?: string|null, bentuk_nilai?: string, modalitas?: string, bentuk_pembelajaran?: list<mixed>, luar_prodi?: bool, pertemuan?: int|null, deskripsi?: string|null, nidn_koordinator?: string|null, id_matkul_feeder?: string|null, urutan?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMkByMk(int|string $mk, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/mk/{mk}', ['mk' => $mk], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus mata kuliah
     *
     * `DELETE /v1/kurikulum-obe/mk/{mk}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $mk ID MK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteMkByMk(int|string $mk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/mk/{mk}', ['mk' => $mk], $query, null, $options, false, false);
    }

    /**
     * Ganti prasyarat
     *
     * `{"prasyarat": [{"prasyarat_id": 12, "jenis": "lulus", "nilai_min": "C"}]}`. jenis: lulus, pernah_ambil, bersamaan. Prasyarat melingkar ditolak.
     *
     * `PUT /v1/kurikulum-obe/mk/{mk}/prasyarat`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $mk ID MK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putMkByMkPrasyarat(int|string $mk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/mk/{mk}/prasyarat', ['mk' => $mk], $query, null, $options, false, false);
    }

    /**
     * CPMK mata kuliah
     *
     * Beserta CPL yang didukung dan sub-CPMK.
     *
     * `GET /v1/kurikulum-obe/mk/{mk}/cpmk`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $mk ID MK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMkByMkCpmk(int|string $mk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/mk/{mk}/cpmk', ['mk' => $mk], $query, null, $options, false, false);
    }

    /**
     * Tambah CPMK
     *
     * `{"kode": "CPMK1", "deskripsi": "...", "cpl": [{"cpl_id": 3, "bobot": 1}]}`
     *
     * `POST /v1/kurikulum-obe/mk/{mk}/cpmk`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $mk ID MK
     * @param array{kode: string|null, deskripsi: string|null, target?: float|int|null, urutan?: int|null, cpl?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMkByMkCpmk(int|string $mk, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/mk/{mk}/cpmk', ['mk' => $mk], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah CPMK
     *
     * Mengirim `cpl` mengganti pemetaan CPMK-CPL.
     *
     * `PUT /v1/kurikulum-obe/cpmk/{cpmk}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $cpmk ID CPMK
     * @param array{kode: string|null, deskripsi: string|null, target?: float|int|null, urutan?: int|null, cpl?: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putCpmkByCpmk(int|string $cpmk, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/cpmk/{cpmk}', ['cpmk' => $cpmk], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus CPMK
     *
     * `DELETE /v1/kurikulum-obe/cpmk/{cpmk}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $cpmk ID CPMK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteCpmkByCpmk(int|string $cpmk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/cpmk/{cpmk}', ['cpmk' => $cpmk], $query, null, $options, false, false);
    }

    /**
     * Tambah sub-CPMK
     *
     * `{"kode": "Sub-CPMK1.1", "deskripsi": "...", "indikator": "..."}`
     *
     * `POST /v1/kurikulum-obe/cpmk/{cpmk}/sub`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $cpmk ID CPMK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postCpmkByCpmkSub(int|string $cpmk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/cpmk/{cpmk}/sub', ['cpmk' => $cpmk], $query, null, $options, false, false);
    }

    /**
     * Ubah sub-CPMK
     *
     * `PUT /v1/kurikulum-obe/sub-cpmk/{sub}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $sub ID sub-CPMK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putSubCpmkBySub(int|string $sub, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/sub-cpmk/{sub}', ['sub' => $sub], $query, null, $options, false, false);
    }

    /**
     * Hapus sub-CPMK
     *
     * `DELETE /v1/kurikulum-obe/sub-cpmk/{sub}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $sub ID sub-CPMK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteSubCpmkBySub(int|string $sub, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/sub-cpmk/{sub}', ['sub' => $sub], $query, null, $options, false, false);
    }

    /**
     * Versi RPS mata kuliah
     *
     * Mahasiswa hanya melihat RPS yang disahkan.
     *
     * `GET /v1/kurikulum-obe/mk/{mk}/rps`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $mk ID MK
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getMkByMkRps(int|string $mk, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/mk/{mk}/rps', ['mk' => $mk], $query, null, $options, false, false);
    }

    /**
     * Buat RPS (versi baru)
     *
     * Staf prodi (kurikulum:write) atau dosen (kurikulum:rps) koordinator/pengampu MK. `{"salin_dari": 7}` menyalin versi lain sebagai titik awal.
     *
     * `POST /v1/kurikulum-obe/mk/{mk}/rps`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $mk ID MK
     * @param array{tahun_id?: string|null, deskripsi?: string|null, materi_pokok?: string|null, pustaka_utama?: list<mixed>, pustaka_pendukung?: list<mixed>, media_perangkat_lunak?: string|null, media_perangkat_keras?: string|null, dosen_pengampu?: list<mixed>, nidn_penyusun?: string|null, catatan?: string|null, salin_dari?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postMkByMkRps(int|string $mk, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/mk/{mk}/rps', ['mk' => $mk], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * RPS lengkap
     *
     * Identitas MK, CPL, CPMK, sub-CPMK, rencana pertemuan, rencana evaluasi, total bobot.
     *
     * `GET /v1/kurikulum-obe/rps/{rps}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $rps ID RPS
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getRpsByRps(int|string $rps, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/rps/{rps}', ['rps' => $rps], $query, null, $options, false, false);
    }

    /**
     * Ubah identitas RPS
     *
     * Hanya RPS draf.
     *
     * `PUT /v1/kurikulum-obe/rps/{rps}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $rps ID RPS
     * @param array{tahun_id?: string|null, deskripsi?: string|null, materi_pokok?: string|null, pustaka_utama?: list<mixed>, pustaka_pendukung?: list<mixed>, media_perangkat_lunak?: string|null, media_perangkat_keras?: string|null, dosen_pengampu?: list<mixed>, nidn_penyusun?: string|null, catatan?: string|null, salin_dari?: int|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRpsByRps(int|string $rps, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/rps/{rps}', ['rps' => $rps], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus RPS draf
     *
     * `DELETE /v1/kurikulum-obe/rps/{rps}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $rps ID RPS
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteRpsByRps(int|string $rps, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/rps/{rps}', ['rps' => $rps], $query, null, $options, false, false);
    }

    /**
     * Ganti rencana pertemuan
     *
     * `{"pertemuan": [{"pertemuan_ke": 1, "sub_cpmk_id": 4, "materi": "...", "metode": "Kuliah, diskusi", "modalitas": "luring", "waktu_menit": 150, "bobot": 5}]}`
     *
     * `PUT /v1/kurikulum-obe/rps/{rps}/pertemuan`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $rps ID RPS
     * @param array{pertemuan: list<mixed>, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRpsByRpsPertemuan(int|string $rps, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/rps/{rps}/pertemuan', ['rps' => $rps], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ganti rencana evaluasi
     *
     * Total bobot harus 100. jenis_evaluasi mengikuti Neo Feeder (1 aktivitas partisipatif, 2 hasil proyek, 3 kognitif tugas, 4 kognitif ujian). `{"evaluasi": [{"jenis_evaluasi": 4, "nama": "UTS", "bobot": 30, "komponen_siakad": "UTS", "cpmk": [{"cpmk_id": 1}]}]}`
     *
     * `PUT /v1/kurikulum-obe/rps/{rps}/evaluasi`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $rps ID RPS
     * @param array{evaluasi: list<mixed>, izinkan_total_bukan_100?: bool, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putRpsByRpsEvaluasi(int|string $rps, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/rps/{rps}/evaluasi', ['rps' => $rps], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Sahkan RPS
     *
     * Oleh program studi. Syarat: ada CPMK, rencana pertemuan, evaluasi total 100. Versi sah sebelumnya diarsipkan.
     *
     * `POST /v1/kurikulum-obe/rps/{rps}/sahkan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $rps ID RPS
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postRpsByRpsSahkan(int|string $rps, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/rps/{rps}/sahkan', ['rps' => $rps], $query, null, $options, false, false);
    }

    /**
     * Ekuivalensi MK lama ke baru
     *
     * MK dengan kode sama otomatis setara tanpa baris ekuivalensi.
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/ekuivalensi`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdEkuivalensi(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/ekuivalensi', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah ekuivalensi
     *
     * jenis: setara, gabung (beberapa MK lama ke satu MK baru), pecah, dihapus (mk_id null).
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/ekuivalensi`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array{kode_mk_lama: string|null, nama_mk_lama?: string|null, sks_lama?: float|int|null, mk_id?: int|null, kurikulum_lama_id?: int|null, tahun_id_lama?: string|null, jenis?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdEkuivalensi(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/ekuivalensi', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Buat ekuivalensi otomatis
     *
     * Dari kurikulum lain (`kurikulum_lama_id`) atau MK lama satu semester (`tahun_id_lama`): nama sama dianggap setara. MK lama tanpa pasangan dilaporkan.
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/ekuivalensi/otomatis`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdEkuivalensiOtomatis(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/ekuivalensi/otomatis', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Ubah ekuivalensi
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}/ekuivalensi/{eid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $eid ID ekuivalensi
     * @param array{kode_mk_lama: string|null, nama_mk_lama?: string|null, sks_lama?: float|int|null, mk_id?: int|null, kurikulum_lama_id?: int|null, tahun_id_lama?: string|null, jenis?: string, catatan?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumByIdEkuivalensiByEid(int|string $id, int|string $eid, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}/ekuivalensi/{eid}', ['id' => $id, 'eid' => $eid], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus ekuivalensi
     *
     * `DELETE /v1/kurikulum-obe/kurikulum/{id}/ekuivalensi/{eid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $eid ID ekuivalensi
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKurikulumByIdEkuivalensiByEid(int|string $id, int|string $eid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/kurikulum/{id}/ekuivalensi/{eid}', ['id' => $id, 'eid' => $eid], $query, null, $options, false, false);
    }

    /**
     * Catatan evaluasi/peninjauan kurikulum
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/peninjauan`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdPeninjauan(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/peninjauan', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Tambah catatan peninjauan
     *
     * jenis: evaluasi_tahunan, peninjauan, audit_mutu, masukan_pemangku, lainnya.
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/peninjauan`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array{jenis?: string, judul: string|null, tanggal?: string|null, pelaksana?: string|null, ringkasan?: string|null, temuan?: string|null, tindak_lanjut?: string|null, status?: string, tautan_dokumen?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdPeninjauan(int|string $id, array $body, array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/peninjauan', ['id' => $id], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Ubah catatan peninjauan
     *
     * `PUT /v1/kurikulum-obe/kurikulum/{id}/peninjauan/{pid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $pid ID peninjauan
     * @param array{jenis?: string, judul: string|null, tanggal?: string|null, pelaksana?: string|null, ringkasan?: string|null, temuan?: string|null, tindak_lanjut?: string|null, status?: string, tautan_dokumen?: string|null, ...} $body
     * @param array{query?: array<string, mixed>, headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function putKurikulumByIdPeninjauanByPid(int|string $id, int|string $pid, array $body, array $options = []): ApiResponse
    {
        return $this->send('PUT', '/v1/kurikulum-obe/kurikulum/{id}/peninjauan/{pid}', ['id' => $id, 'pid' => $pid], $options['query'] ?? [], $body, $options, false, false);
    }

    /**
     * Hapus catatan peninjauan
     *
     * `DELETE /v1/kurikulum-obe/kurikulum/{id}/peninjauan/{pid}`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param int|string $pid ID peninjauan
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function deleteKurikulumByIdPeninjauanByPid(int|string $id, int|string $pid, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('DELETE', '/v1/kurikulum-obe/kurikulum/{id}/peninjauan/{pid}', ['id' => $id, 'pid' => $pid], $query, null, $options, false, false);
    }

    /**
     * Capaian CPL (rekap)
     *
     * Dihitung dari nilai akhir MK di SIAKAD (bobot x 25, nilai terbaik), ditimbang matriks CPL-MK; MK lama ikut lewat kode sama/ekuivalensi. Bawaan: angkatan yang ditetapkan memakai kurikulum ini.
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/capaian`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array{angkatan?: int, sampai?: string, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdCapaian(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/capaian', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Rekam capaian CPL
     *
     * Menyimpan rekap untuk evaluasi kurikulum/akreditasi. `{"tahun_id": "20251", "angkatan": 2022}`
     *
     * `POST /v1/kurikulum-obe/kurikulum/{id}/capaian/rekam`
     *
     * scope: `kurikulum:write`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function postKurikulumByIdCapaianRekam(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('POST', '/v1/kurikulum-obe/kurikulum/{id}/capaian/rekam', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Riwayat capaian CPL terekam
     *
     * `GET /v1/kurikulum-obe/kurikulum/{id}/capaian/riwayat`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $id ID kurikulum
     * @param array<string, mixed> $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getKurikulumByIdCapaianRiwayat(int|string $id, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/kurikulum/{id}/capaian/riwayat', ['id' => $id], $query, null, $options, false, false);
    }

    /**
     * Capaian CPL satu mahasiswa
     *
     * Mahasiswa hanya dirinya. Kurikulum diambil dari angkatan mahasiswa, atau kirim kurikulum_id.
     *
     * `GET /v1/kurikulum-obe/capaian/mahasiswa/{nim}`
     *
     * scope: `kurikulum:read`
     *
     * @param int|string $nim NIM
     * @param array{kurikulum_id?: int, ...} $query
     * @param array{headers?: array<string, string>, max_retries?: int} $options
     * @return ApiResponse
     * @throws \Unipo\Siakad\Exceptions\SiakadException
     */
    public function getCapaianMahasiswaByNim(int|string $nim, array $query = [], array $options = []): ApiResponse
    {
        return $this->send('GET', '/v1/kurikulum-obe/capaian/mahasiswa/{nim}', ['nim' => $nim], $query, null, $options, false, false);
    }
}
