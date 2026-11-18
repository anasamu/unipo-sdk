<?php

// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.

declare(strict_types=1);

namespace Unipo\Siakad\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade Laravel untuk \Unipo\Siakad\Siakad.
 *
 * @method static \Unipo\Siakad\Auth\AuthApi auth()
 * @method static \Unipo\Siakad\Siakad withToken(\Unipo\Siakad\Auth\TokenSet|string $token)
 * @method static \Unipo\Siakad\Siakad withOptions(array $options)
 * @method static \Unipo\Siakad\Http\ApiResponse request(string $method, string $path, array $query = [], mixed $body = null, array $options = [])
 * @method static \Unipo\Siakad\Pagination\Paginator paginate(callable $fetchPage, array $query = [])
 * @method static \Unipo\Siakad\Resources\System system()
 * @method static \Unipo\Siakad\Resources\Admisi admisi()
 * @method static \Unipo\Siakad\Resources\Akademik akademik()
 * @method static \Unipo\Siakad\Resources\Akun akun()
 * @method static \Unipo\Siakad\Resources\ApiPortal apiPortal()
 * @method static \Unipo\Siakad\Resources\Arsip arsip()
 * @method static \Unipo\Siakad\Resources\Aturan aturan()
 * @method static \Unipo\Siakad\Resources\Berkas berkas()
 * @method static \Unipo\Siakad\Resources\Biaya biaya()
 * @method static \Unipo\Siakad\Resources\BuktiSyarat buktiSyarat()
 * @method static \Unipo\Siakad\Resources\Cbt cbt()
 * @method static \Unipo\Siakad\Resources\Crm crm()
 * @method static \Unipo\Siakad\Resources\Dasbor dasbor()
 * @method static \Unipo\Siakad\Resources\Dokumen dokumen()
 * @method static \Unipo\Siakad\Resources\Dosen dosen()
 * @method static \Unipo\Siakad\Resources\Edom edom()
 * @method static \Unipo\Siakad\Resources\Fakultas fakultas()
 * @method static \Unipo\Siakad\Resources\Gaji gaji()
 * @method static \Unipo\Siakad\Resources\Helpdesk helpdesk()
 * @method static \Unipo\Siakad\Resources\Humas humas()
 * @method static \Unipo\Siakad\Resources\Iku iku()
 * @method static \Unipo\Siakad\Resources\Induk induk()
 * @method static \Unipo\Siakad\Resources\Infra infra()
 * @method static \Unipo\Siakad\Resources\Integrasi integrasi()
 * @method static \Unipo\Siakad\Resources\Jadwal jadwal()
 * @method static \Unipo\Siakad\Resources\JadwalUjian jadwalUjian()
 * @method static \Unipo\Siakad\Resources\Kalender kalender()
 * @method static \Unipo\Siakad\Resources\Karier karier()
 * @method static \Unipo\Siakad\Resources\Kasir kasir()
 * @method static \Unipo\Siakad\Resources\Kelengkapan kelengkapan()
 * @method static \Unipo\Siakad\Resources\Kelulusan kelulusan()
 * @method static \Unipo\Siakad\Resources\Kemahasiswaan kemahasiswaan()
 * @method static \Unipo\Siakad\Resources\Kerjasama kerjasama()
 * @method static \Unipo\Siakad\Resources\Keu keu()
 * @method static \Unipo\Siakad\Resources\Keuangan keuangan()
 * @method static \Unipo\Siakad\Resources\Kurikulum kurikulum()
 * @method static \Unipo\Siakad\Resources\KurikulumObe kurikulumObe()
 * @method static \Unipo\Siakad\Resources\Layanan layanan()
 * @method static \Unipo\Siakad\Resources\Lingkungan lingkungan()
 * @method static \Unipo\Siakad\Resources\Lms lms()
 * @method static \Unipo\Siakad\Resources\Lppm lppm()
 * @method static \Unipo\Siakad\Resources\Lulusan lulusan()
 * @method static \Unipo\Siakad\Resources\Mahasiswa mahasiswa()
 * @method static \Unipo\Siakad\Resources\Master master()
 * @method static \Unipo\Siakad\Resources\MataKuliah mataKuliah()
 * @method static \Unipo\Siakad\Resources\Mbkm mbkm()
 * @method static \Unipo\Siakad\Resources\Notif notif()
 * @method static \Unipo\Siakad\Resources\Obrolan obrolan()
 * @method static \Unipo\Siakad\Resources\Panitia panitia()
 * @method static \Unipo\Siakad\Resources\Pddikti pddikti()
 * @method static \Unipo\Siakad\Resources\Peristiwa peristiwa()
 * @method static \Unipo\Siakad\Resources\Perpustakaan perpustakaan()
 * @method static \Unipo\Siakad\Resources\Pimpinan pimpinan()
 * @method static \Unipo\Siakad\Resources\Plagiasi plagiasi()
 * @method static \Unipo\Siakad\Resources\Pmb pmb()
 * @method static \Unipo\Siakad\Resources\Portal portal()
 * @method static \Unipo\Siakad\Resources\Presensi presensi()
 * @method static \Unipo\Siakad\Resources\Profil profil()
 * @method static \Unipo\Siakad\Resources\Qr qr()
 * @method static \Unipo\Siakad\Resources\Rbac rbac()
 * @method static \Unipo\Siakad\Resources\Referensi referensi()
 * @method static \Unipo\Siakad\Resources\Repositori repositori()
 * @method static \Unipo\Siakad\Resources\Rpl rpl()
 * @method static \Unipo\Siakad\Resources\Sarpras sarpras()
 * @method static \Unipo\Siakad\Resources\Sdm sdm()
 * @method static \Unipo\Siakad\Resources\Sistem sistem()
 * @method static \Unipo\Siakad\Resources\Sk sk()
 * @method static \Unipo\Siakad\Resources\Spmi spmi()
 * @method static \Unipo\Siakad\Resources\Ta ta()
 * @method static \Unipo\Siakad\Resources\Tema tema()
 * @method static \Unipo\Siakad\Resources\Tracer tracer()
 * @method static \Unipo\Siakad\Resources\Wisuda wisuda()
 *
 * @see \Unipo\Siakad\Siakad
 */
final class Siakad extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Unipo\Siakad\Siakad::class;
    }
}
