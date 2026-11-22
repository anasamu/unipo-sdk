<?php

declare(strict_types=1);

namespace Unipo\Siakad\Proxy;

use Unipo\Siakad\Exceptions\SiakadException;
use Unipo\Siakad\Http\DownloadedFile;
use Unipo\Siakad\Siakad;

/**
 * Proxy server ke API SIAKAD untuk komponen `unipo-ui/siakad` di browser (Laravel, Symfony, PHP biasa). Browser
 * memanggil jalur aplikasi Anda (`/api/siakad/v1/...`); server meneruskannya dengan token yang disimpan di server,
 * jadi client_secret tidak pernah sampai ke browser. Padanan `proxySiakad` di SDK Node.
 *
 *     // routes/web.php (Laravel)
 *     Route::any('/api/siakad/{jalur}', function (Request $r, string $jalur) {
 *         $proxy = new ProxySiakad(app(Siakad::class), izinkan: ['/v1/referensi/']);
 *         [$status, $headers, $isi] = $proxy->teruskan($r->method(), '/' . $jalur, $r->query(), $r->json()->all() ?: null);
 *         return response($isi, $status, $headers);
 *     })->where('jalur', '.*');
 */
final class ProxySiakad
{
    /** @var list<string> */
    private array $metode;

    /**
     * @param Siakad|null $siakad Klien server; null = mode data tiruan.
     * @param list<string> $izinkan Awalan jalur (`/v1/referensi/`) atau pola regex (diawali `#`). Bawaan: semua /v1 kecuali /v1/auth/.
     * @param list<string> $metode Metode yang diteruskan. Bawaan GET saja.
     * @param array<string, mixed|callable(array<string, mixed>, mixed): mixed> $tiruan Data tiruan, kunci "GET /v1/referensi/prodi".
     */
    public function __construct(
        private readonly ?Siakad $siakad = null,
        private readonly array $izinkan = ['#^/v1/(?!auth/)#'],
        array $metode = ['GET'],
        private readonly array $tiruan = [],
        private readonly bool $selaluTiruan = false,
    ) {
        $this->metode = array_map('strtoupper', $metode);
    }

    /**
     * Teruskan satu permintaan.
     *
     * @param array<string, mixed> $query
     * @param array<string, mixed>|null $body
     * @return array{0: int, 1: array<string, string>, 2: string} status, header, isi
     */
    public function teruskan(string $method, string $path, array $query = [], ?array $body = null): array
    {
        $m = strtoupper($method);
        $path = '/' . ltrim($path, '/');
        if (!str_starts_with($path, '/v1/') || preg_match('#(^|/)\.\.?(/|$)|%2e|%2f|%5c#i', $path)) {
            return $this->galat(404, 'not_found', 'Jalur API tidak dikenal.');
        }
        if (!in_array($m, $this->metode, true)) {
            return $this->galat(405, 'method_not_allowed', "Metode {$m} tidak diizinkan lewat proxy ini.");
        }
        if (!$this->diizinkan($path)) {
            return $this->galat(403, 'forbidden', 'Endpoint ini tidak dibuka untuk browser. Tambahkan ke daftar izinkan di proxy server.');
        }

        if ($this->selaluTiruan || $this->siakad === null) {
            $isi = $this->tiruan["{$m} {$path}"] ?? null;
            if ($isi === null) {
                return $this->galat(404, 'not_found', "Belum ada data tiruan untuk {$m} {$path}.");
            }
            $hasil = is_callable($isi) ? $isi($query, $body) : $isi;
            $amplop = is_array($hasil) && array_key_exists('data', $hasil) ? $hasil : ['data' => $hasil];

            return [200, ['Content-Type' => 'application/json; charset=utf-8', 'Cache-Control' => 'no-store', 'X-Siakad-Lingkungan' => 'tiruan'], $this->json($amplop)];
        }

        try {
            $r = $this->siakad->send($m, $path, [], $query, $m === 'GET' ? null : $body, [], false, false);
            $data = $r->data();
            if ($data instanceof DownloadedFile) {
                $h = ['Content-Type' => $data->contentType, 'Cache-Control' => 'no-store'];
                if ($data->filename !== null) {
                    $h['Content-Disposition'] = "attachment; filename*=UTF-8''" . rawurlencode($data->filename);
                }

                return [$r->status(), $h, $data->contents];
            }
            $amplop = ['data' => $data];
            if ($r->meta() !== null) {
                $amplop['meta'] = $r->meta();
            }
            $h = ['Content-Type' => 'application/json; charset=utf-8', 'Cache-Control' => 'no-store'];
            if ($r->requestId() !== null) {
                $h['X-Request-Id'] = $r->requestId();
            }

            return [$r->status(), $h, $this->json($amplop)];
        } catch (SiakadException $e) {
            $status = $e->status() >= 400 ? $e->status() : 502;

            return [$status, ['Content-Type' => 'application/json; charset=utf-8'], $this->json([
                'error' => ['code' => $e->errorCode(), 'message' => $e->getMessage(), 'details' => $e->details() ?: new \stdClass()],
                'request_id' => $e->requestId(),
            ])];
        }
    }

    private function diizinkan(string $path): bool
    {
        foreach ($this->izinkan as $p) {
            if (str_starts_with($p, '#') ? preg_match($p, $path) === 1 : str_starts_with($path, $p)) {
                return true;
            }
        }

        return false;
    }

    /** @return array{0: int, 1: array<string, string>, 2: string} */
    private function galat(int $status, string $code, string $message): array
    {
        return [$status, ['Content-Type' => 'application/json; charset=utf-8'], $this->json(['error' => ['code' => $code, 'message' => $message]])];
    }

    private function json(mixed $v): string
    {
        return json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    }
}
