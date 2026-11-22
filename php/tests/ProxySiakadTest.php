<?php

declare(strict_types=1);

namespace Unipo\Siakad\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Unipo\Siakad\Auth\MemoryTokenStore;
use Unipo\Siakad\Options;
use Unipo\Siakad\Proxy\ProxySiakad;
use Unipo\Siakad\Siakad;

final class ProxySiakadTest extends TestCase
{
    /** @var list<array<string, mixed>> */
    private array $history = [];

    private function siakad(array $responses): Siakad
    {
        $this->history = [];
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($this->history));

        return new Siakad(new Options(
            baseUrl: 'https://api.test',
            clientId: 'c',
            clientSecret: 's',
            tokenStore: new MemoryTokenStore(),
            httpClient: new Client(['handler' => $stack, 'http_errors' => false]),
            maxRetries: 0,
        ));
    }

    private static function json(mixed $body, int $status = 200): Response
    {
        return new Response($status, ['Content-Type' => 'application/json', 'X-Request-Id' => 'r-1'], json_encode($body));
    }

    public function testMeneruskanGetDenganTokenServer(): void
    {
        $proxy = new ProxySiakad($this->siakad([
            self::json(['access_token' => 'tok-srv', 'token_type' => 'Bearer', 'expires_in' => 3600]),
            self::json(['data' => [['kode_prodi' => '55201']], 'meta' => ['total' => 1]]),
        ]), izinkan: ['/v1/referensi/']);
        [$status, $h, $isi] = $proxy->teruskan('GET', '/v1/referensi/prodi', ['fakultas' => 'FIK']);
        self::assertSame(200, $status);
        self::assertSame(['data' => [['kode_prodi' => '55201']], 'meta' => ['total' => 1]], json_decode($isi, true));
        self::assertSame('r-1', $h['X-Request-Id']);
        $req = $this->history[1]['request'];
        self::assertSame('Bearer tok-srv', $req->getHeaderLine('Authorization'));
        self::assertSame('fakultas=FIK', $req->getUri()->getQuery());
    }

    public function testMenolakMetodeJalurDanTraversal(): void
    {
        $proxy = new ProxySiakad($this->siakad([]), izinkan: ['/v1/referensi/']);
        self::assertSame(405, $proxy->teruskan('POST', '/v1/referensi/prodi', [], [])[0]);
        self::assertSame(403, $proxy->teruskan('GET', '/v1/mahasiswa')[0]);
        self::assertSame(404, $proxy->teruskan('GET', '/v1/referensi/../auth/token')[0]);
        self::assertSame(404, $proxy->teruskan('GET', '/lain')[0]);
        self::assertSame(403, (new ProxySiakad($this->siakad([]), metode: ['GET', 'POST']))->teruskan('POST', '/v1/auth/token', [], [])[0]);
        self::assertCount(0, $this->history);
    }

    public function testGalatApiDiteruskan(): void
    {
        $proxy = new ProxySiakad($this->siakad([
            self::json(['access_token' => 't', 'token_type' => 'Bearer', 'expires_in' => 3600]),
            self::json(['error' => ['code' => 'insufficient_scope', 'message' => 'Scope kurang']], 403),
        ]));
        [$status, , $isi] = $proxy->teruskan('GET', '/v1/referensi/rahasia');
        self::assertSame(403, $status);
        self::assertSame('insufficient_scope', json_decode($isi, true)['error']['code']);
    }

    public function testModeTiruan(): void
    {
        $proxy = new ProxySiakad(null, tiruan: [
            'GET /v1/referensi/prodi' => [['kode_prodi' => '55201']],
            'GET /v1/referensi/fakultas' => fn (array $q) => ['data' => [], 'meta' => ['cari' => $q['q'] ?? null]],
        ]);
        [$status, $h, $isi] = $proxy->teruskan('GET', '/v1/referensi/prodi');
        self::assertSame(200, $status);
        self::assertSame('tiruan', $h['X-Siakad-Lingkungan']);
        self::assertSame(['data' => [['kode_prodi' => '55201']]], json_decode($isi, true));
        self::assertSame(['data' => [], 'meta' => ['cari' => 'x']], json_decode($proxy->teruskan('GET', '/v1/referensi/fakultas', ['q' => 'x'])[2], true));
        self::assertSame(404, $proxy->teruskan('GET', '/v1/referensi/agama')[0]);
    }
}
