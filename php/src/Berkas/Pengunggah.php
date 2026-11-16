<?php

declare(strict_types=1);

namespace Unipo\Siakad\Berkas;

use Unipo\Siakad\Http\Upload;
use Unipo\Siakad\Siakad;

/**
 * Unggah berkas terpusat (/v1/berkas) dengan pemilihan cara otomatis:
 * file sampai `batas_sekali_unggah_byte` dikirim sekali (multipart), yang lebih besar dikirim bertahap per potongan
 * (diulang bila gagal, bisa dilanjutkan dengan opsi `lanjutkan`). `id` hasilnya dipakai sebagai `berkas_id` di
 * endpoint unggah modul (dokumen profil, lampiran pusat data, arsip, SPMI, LMS, SDM, LPPM, portal, tracer).
 *
 *     $b = $siakad->unggahBerkas('/tmp/ijazah.pdf', ['kategori' => 'dokumen']);
 *     $siakad->profil()->postDokumenByIdBerkas($dokumenId, ['berkas_id' => $b['id']]);
 */
final class Pengunggah
{
    /** @var array<string, mixed>|null */
    private ?array $info = null;

    public function __construct(private readonly Siakad $siakad)
    {
    }

    /** @return array<string, mixed> GET /v1/berkas/info */
    public function info(): array
    {
        return $this->info ??= (array) $this->siakad->request('GET', '/v1/berkas/info')->data();
    }

    /**
     * @param array{nama?: string, kategori?: string, modul?: string, folder?: string, keterangan?: string, visibilitas?: string,
     *              penyimpanan?: string, unit?: string, periode?: string, enkripsi?: bool, ulang?: int, lanjutkan?: string, bertahap?: bool, progres?: callable(int, int): void} $opsi
     * @return array<string, mixed> data berkas (status tersedia)
     */
    public function unggah(string|\SplFileInfo $file, array $opsi = []): array
    {
        $path = $file instanceof \SplFileInfo ? $file->getPathname() : $file;
        if (!is_file($path) || !is_readable($path)) {
            throw new \InvalidArgumentException('File tidak bisa dibaca: ' . $path);
        }
        $nama = $opsi['nama'] ?? ($file instanceof \SplFileInfo && method_exists($file, 'getClientOriginalName') ? (string) $file->getClientOriginalName() : basename($path));
        $atribut = array_filter(array_intersect_key($opsi, array_flip(['kategori', 'modul', 'folder', 'keterangan', 'visibilitas', 'penyimpanan', 'unit', 'periode', 'enkripsi'])), static fn ($v) => $v !== null);
        if (isset($atribut['enkripsi'])) {
            $atribut['enkripsi'] = $atribut['enkripsi'] ? '1' : '0';
        }
        $total = (int) filesize($path);
        $progres = $opsi['progres'] ?? null;
        $lapor = static function (int $n) use ($progres, $total): void {
            if (is_callable($progres)) {
                $progres($n, $total);
            }
        };

        if (empty($opsi['lanjutkan']) && empty($opsi['bertahap']) && $total <= (int) ($this->info()['batas_sekali_unggah_byte'] ?? 0)) {
            $r = $this->siakad->request('POST', '/v1/berkas', [], ['berkas' => Upload::fromPath($path, $nama)] + $atribut, ['multipart' => true]);
            $lapor($total);

            return (array) $r->data();
        }

        $sesi = !empty($opsi['lanjutkan'])
            ? (array) $this->siakad->request('GET', '/v1/berkas/{id}', ['id' => $opsi['lanjutkan']])->data()
            : (array) $this->siakad->request('POST', '/v1/berkas/bertahap', [], ['nama' => $nama, 'ukuran' => $total] + $atribut)->data();
        if (($sesi['status'] ?? '') !== 'mengunggah') {
            return $sesi;
        }
        $ukuran = (int) $sesi['sesi']['ukuran_potongan'];
        $jumlah = (int) $sesi['sesi']['jumlah_potongan'];
        $sudah = array_flip(array_map('intval', (array) ($sesi['sesi']['diterima'] ?? [])));
        $fh = fopen($path, 'rb') ?: throw new \RuntimeException('File tidak bisa dibuka: ' . $path);
        try {
            $terkirim = 0;
            for ($ke = 0; $ke < $jumlah; $ke++) {
                $panjang = min($ukuran, $total - $ke * $ukuran);
                if (isset($sudah[$ke])) {
                    $terkirim += $panjang;
                    continue;
                }
                fseek($fh, $ke * $ukuran);
                $isi = (string) fread($fh, $panjang);
                for ($coba = 0; ; $coba++) {
                    try {
                        $this->siakad->request('POST', '/v1/berkas/{id}/potongan/{ke}', ['id' => $sesi['id'], 'ke' => $ke], ['potongan' => Upload::fromString($isi, $ke . '.part')], ['multipart' => true]);
                        break;
                    } catch (\Throwable $e) {
                        if ($coba >= (int) ($opsi['ulang'] ?? 3)) {
                            throw $e;
                        }
                        usleep(500000 * (2 ** $coba));
                    }
                }
                $terkirim += $panjang;
                $lapor($terkirim);
            }
        } finally {
            fclose($fh);
        }

        return (array) $this->siakad->request('POST', '/v1/berkas/{id}/selesai', ['id' => $sesi['id']])->data();
    }
}
