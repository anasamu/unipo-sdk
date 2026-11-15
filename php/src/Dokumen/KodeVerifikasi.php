<?php

declare(strict_types=1);

namespace Unipo\Siakad\Dokumen;

/**
 * Kode verifikasi dokumen terbit (/v1/dokumen): 12 karakter dari QR di PDF.
 *
 *   $kode = KodeVerifikasi::dariQr($hasilPindai);                    // "K7QM2XPA9RTD" atau null
 *   $cek = $siakad->dokumen()->getVerifikasiByKode($kode)->data;     // sah, status, pesan, ...
 *   $cocok = $siakad->dokumen()->postVerifikasi(['berkas' => Upload::fromPath('kiriman.pdf')])->data;
 */
final class KodeVerifikasi
{
    public const HURUF = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    /** Ambil kode dari isi QR: URL `.../dokumen/v/{kode}`, URL dengan `?kode=`, atau kode saja (tanda - dan spasi boleh). */
    public static function dariQr(string $teks): ?string
    {
        $t = trim($teks);
        $calon = $t;
        $u = parse_url($t);
        if (is_array($u) && isset($u['scheme'], $u['host'])) {
            parse_str($u['query'] ?? '', $q);
            $bagian = array_values(array_filter(explode('/', $u['path'] ?? ''), static fn (string $x): bool => $x !== ''));
            $calon = is_string($q['kode'] ?? null) ? $q['kode'] : (string) (end($bagian) ?: '');
        }
        $k = strtoupper((string) preg_replace('/[\s-]/', '', rawurldecode($calon)));
        if (strlen($k) !== 12 || strspn($k, self::HURUF) !== 12) {
            return null;
        }

        return $k;
    }

    /** Bentuk untuk dibaca manusia: K7QM-2XPA-9RTD. */
    public static function format(string $kode): string
    {
        return implode('-', str_split(strtoupper((string) preg_replace('/[\s-]/', '', $kode)), 4));
    }
}
