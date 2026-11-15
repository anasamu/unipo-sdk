<?php

declare(strict_types=1);

namespace Unipo\Siakad\Infra;

/**
 * Verifikasi header identitas dari gerbang api.unipo.ac.id untuk layanan (microservice) di belakangnya.
 *
 * Gerbang menambahkan `X-Unipo-Klien`, `X-Unipo-Pengguna`, `X-Unipo-Level`, `X-Unipo-Scope`, `X-Request-Id`, dan
 * `X-Unipo-Gerbang: t=<unix>,v1=<hex HMAC-SHA256>`. Header itu hanya boleh dipercaya setelah tanda tangannya sah.
 * Kunci didapat dari Pustikom » Infrastruktur » Layanan » Buat kunci gerbang (simpan di secret manager / .env).
 *
 *     $id = \Unipo\Siakad\Infra\Gerbang::verifikasi(getenv('GERBANG_KUNCI'));
 *     if ($id === null) { http_response_code(401); exit; }
 *     echo $id['pengguna'];
 */
final class Gerbang
{
    /** Teks yang ditandatangani (sama persis dengan server/gerbang-inti.php di api_unipo). */
    public static function teks(int $t, string $metode, string $path, string $klien, string $pengguna, string $requestId): string
    {
        return $t . "\n" . strtoupper($metode) . "\n" . $path . "\n" . $klien . "\n" . $pengguna . "\n" . $requestId;
    }

    /** Nilai header X-Unipo-Gerbang (untuk menguji layanan tanpa gerbang). */
    public static function tandaTangan(string $kunci, int $t, string $metode, string $path, string $klien, string $pengguna, string $requestId): string
    {
        return 't=' . $t . ',v1=' . hash_hmac('sha256', self::teks($t, $metode, $path, $klien, $pengguna, $requestId), $kunci);
    }

    /**
     * Verifikasi permintaan yang sedang berjalan (bawaan $_SERVER) atau array bergaya $_SERVER.
     *
     * @param array<string, mixed>|null $server
     * @return array{klien: string, pengguna: string, level: string, scope: list<string>, request_id: string, waktu: int}|null
     */
    public static function verifikasi(string $kunci, ?array $server = null, int $toleransiDetik = 300, ?int $sekarang = null): ?array
    {
        $s = $server ?? $_SERVER;
        $h = static fn (string $k): string => is_string($s[$k] ?? null) ? $s[$k] : '';
        $header = trim($h('HTTP_X_UNIPO_GERBANG'));
        if ($kunci === '' || preg_match('/^t=(\d{1,12}),v1=([0-9a-f]{64})$/', $header, $m) !== 1) {
            return null;
        }
        $t = (int) $m[1];
        if (abs(($sekarang ?? time()) - $t) > $toleransiDetik) {
            return null;
        }
        $klien = $h('HTTP_X_UNIPO_KLIEN');
        $pengguna = $h('HTTP_X_UNIPO_PENGGUNA');
        $requestId = $h('HTTP_X_REQUEST_ID');
        $harap = hash_hmac('sha256', self::teks($t, $h('REQUEST_METHOD') ?: 'GET', $h('REQUEST_URI') ?: '/', $klien, $pengguna, $requestId), $kunci);
        if (!hash_equals($harap, $m[2])) {
            return null;
        }
        $scope = $h('HTTP_X_UNIPO_SCOPE');

        return [
            'klien' => $klien, 'pengguna' => $pengguna, 'level' => $h('HTTP_X_UNIPO_LEVEL'),
            'scope' => $scope === '' ? [] : explode(' ', $scope), 'request_id' => $requestId, 'waktu' => $t,
        ];
    }
}
