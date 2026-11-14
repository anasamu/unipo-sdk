<?php

declare(strict_types=1);

namespace Unipo\Siakad\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Unipo\Siakad\Auth\MemoryTokenStore;
use Unipo\Siakad\Auth\TokenSet;
use Unipo\Siakad\Exceptions\AuthenticationException;
use Unipo\Siakad\Exceptions\NotFoundException;
use Unipo\Siakad\Exceptions\PermissionException;
use Unipo\Siakad\Exceptions\ValidationException;
use Unipo\Siakad\Http\DownloadedFile;
use Unipo\Siakad\Http\Upload;
use Unipo\Siakad\Options;
use Unipo\Siakad\Siakad;

final class SiakadTest extends TestCase
{
    /** @var list<array{request: RequestInterface}> */
    private array $history = [];

    /** @param list<Response|callable> $responses */
    private function client(array $responses, array $options = []): Siakad
    {
        $this->history = [];
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($this->history));

        return new class (new Options(...$options + [
            'baseUrl' => 'https://contoh.test',
            'clientId' => 'cli_x',
            'clientSecret' => 's3cret',
            'tokenStore' => new MemoryTokenStore(),
            'httpClient' => new Client(['handler' => $stack, 'http_errors' => false]),
        ])) extends Siakad {
            protected function sleep(float $seconds): void
            {
            }
        };
    }

    private static function json(mixed $body, int $status = 200, array $headers = []): Response
    {
        return new Response($status, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-1', 'X-Siakad-Lingkungan' => 'development'] + $headers, json_encode($body));
    }

    private static function token(string $n = '1', array $extra = []): Response
    {
        return self::json($extra + ['access_token' => 'tok-' . $n, 'token_type' => 'Bearer', 'expires_in' => 3600, 'scope' => '']);
    }

    public function testTokenDimintaSekaliLaluDipakaiUlang(): void
    {
        $s = $this->client([self::token(), self::json(['data' => ['nim' => '1', 'nama' => 'A']]), self::json(['data' => ['nim' => '2']])]);

        $r = $s->mahasiswa()->getByNim('1');
        $s->mahasiswa()->getByNim('2');

        $this->assertSame('A', $r['nama']);
        $this->assertSame('req-1', $r->requestId());
        $this->assertSame('development', $r->environment());
        $this->assertCount(3, $this->history);
        $tokenReq = $this->history[0]['request'];
        $this->assertSame('/v1/auth/token', $tokenReq->getUri()->getPath());
        $this->assertSame('Basic ' . base64_encode('cli_x:s3cret'), $tokenReq->getHeaderLine('Authorization'));
        $this->assertSame('client_credentials', json_decode((string) $tokenReq->getBody(), true)['grant_type']);
        $this->assertSame('Bearer tok-1', $this->history[2]['request']->getHeaderLine('Authorization'));
    }

    public function testTokenDiperbaruiSaat401(): void
    {
        $s = $this->client([
            self::token('1'),
            self::json(['error' => ['code' => 'invalid_token', 'message' => 'Kedaluwarsa'], 'request_id' => 'x'], 401),
            self::token('2'),
            self::json(['data' => []]),
        ]);
        $s->referensi()->getProdi();
        $this->assertSame('Bearer tok-2', $this->history[3]['request']->getHeaderLine('Authorization'));
    }

    public function testGalatDipetakan(): void
    {
        $s = $this->client([
            self::token(),
            self::json(['error' => ['code' => 'not_found', 'message' => 'Tidak ada.'], 'request_id' => 'x1'], 404),
            self::json(['error' => ['code' => 'insufficient_scope', 'message' => 'Scope.', 'details' => ['required_scopes' => ['nilai:read']]], 'request_id' => 'x2'], 403),
            self::json(['error' => ['code' => 'validation_failed', 'message' => 'Tidak valid.', 'details' => ['nim' => 'Wajib.']], 'request_id' => 'x3'], 422),
        ]);
        try {
            $s->mahasiswa()->getByNim('404');
            $this->fail();
        } catch (NotFoundException $e) {
            $this->assertSame('x1', $e->requestId());
            $this->assertSame(404, $e->status());
        }
        try {
            $s->mahasiswa()->getByNim('403');
            $this->fail();
        } catch (PermissionException $e) {
            $this->assertSame(['nilai:read'], $e->requiredScopes());
        }
        try {
            $s->mahasiswa()->getByNim('422');
            $this->fail();
        } catch (ValidationException $e) {
            $this->assertSame(['nim' => 'Wajib.'], $e->fields());
        }
    }

    public function testRateLimitDiulang(): void
    {
        $s = $this->client([
            self::token(),
            self::json(['error' => ['code' => 'rate_limited', 'message' => 'Tunggu']], 429, ['Retry-After' => '1']),
            self::json(['data' => [['kode' => '86206']]]),
        ]);
        $r = $s->referensi()->getProdi();
        $this->assertSame('86206', $r[0]['kode']);
    }

    public function testPaginateSemuaHalaman(): void
    {
        $s = $this->client([
            self::token(),
            self::json(['data' => [1, 2], 'meta' => ['page' => 1, 'per_page' => 2, 'total' => 5, 'total_pages' => 3]]),
            self::json(['data' => [3, 4], 'meta' => ['page' => 2, 'per_page' => 2, 'total' => 5, 'total_pages' => 3]]),
            self::json(['data' => [5], 'meta' => ['page' => 3, 'per_page' => 2, 'total' => 5, 'total_pages' => 3]]),
        ]);
        $semua = $s->paginate(fn (array $q) => $s->mahasiswa()->list($q), ['prodi' => '86206', 'per_page' => 2])->all();
        $this->assertSame([1, 2, 3, 4, 5], $semua);
        parse_str($this->history[2]['request']->getUri()->getQuery(), $q);
        $this->assertSame(['page' => '2', 'per_page' => '2', 'prodi' => '86206'], $q);
    }

    public function testMethodOverrideDanPathDiEncode(): void
    {
        $s = $this->client([self::token(), self::json(['data' => ['ok' => true]])], ['methodOverride' => true]);
        $s->lms()->patchKelasById('a/b', ['nama' => 'X']);
        $req = $this->history[1]['request'];
        $this->assertSame('POST', $req->getMethod());
        $this->assertSame('PATCH', $req->getHeaderLine('X-HTTP-Method-Override'));
        $this->assertSame('/v1/lms/kelas/a%2Fb', $req->getUri()->getPath());
        $this->assertSame(['nama' => 'X'], json_decode((string) $req->getBody(), true));
    }

    public function testTokenPenggunaDiperpanjangOtomatis(): void
    {
        $disimpan = [];
        $s = $this->client([
            self::token('u1', ['refresh_token' => 'rt-1', 'expires_in' => 1]),
            self::token('u2', ['refresh_token' => 'rt-2']),
            self::json(['data' => ['ok' => true]]),
        ]);
        $t = $s->auth()->password('2025001', 'rahasia');
        $mhs = $s->withToken($t, function (TokenSet $baru) use (&$disimpan): void {
            $disimpan[] = $baru->refreshToken;
        });
        $mhs->mahasiswa()->getByNimKhs('2025001');

        $this->assertSame(['rt-2'], $disimpan);
        $this->assertSame('refresh_token', json_decode((string) $this->history[1]['request']->getBody(), true)['grant_type']);
        $this->assertSame('Bearer tok-u2', $this->history[2]['request']->getHeaderLine('Authorization'));
    }

    public function testTanpaKredensialHanyaEndpointPublik(): void
    {
        $s = $this->client([self::json(['data' => ['status' => 'ok']])], ['clientId' => null, 'clientSecret' => null]);
        $this->assertSame('ok', $s->system()->health()['status']);
        $this->assertSame('', $this->history[0]['request']->getHeaderLine('Authorization'));
        $this->expectException(AuthenticationException::class);
        $s->mahasiswa()->getByNim('1');
    }

    public function testUnggahDanUnduh(): void
    {
        $s = $this->client([
            self::token(),
            self::json(['data' => ['id' => 7]], 201),
            new Response(200, ['Content-Type' => 'application/pdf', 'Content-Disposition' => "attachment; filename=\"a.pdf\"; filename*=UTF-8''surat%20masuk.pdf"], 'isi file'),
        ]);
        $r = $s->arsip()->postSuratByRefFile('S-1', ['berkas' => Upload::fromString('%PDF', 'surat.pdf', 'application/pdf'), 'peran' => 'utama']);
        $this->assertSame(201, $r->status());
        $body = (string) $this->history[1]['request']->getBody();
        $this->assertStringContainsString('filename="surat.pdf"', $body);
        $this->assertStringContainsString('%PDF', $body);
        $this->assertStringStartsWith('multipart/form-data; boundary=', $this->history[1]['request']->getHeaderLine('Content-Type'));

        $file = $s->request('GET', '/v1/arsip/file/{id}/unduh', ['id' => 7])->data();
        $this->assertInstanceOf(DownloadedFile::class, $file);
        $this->assertSame('surat masuk.pdf', $file->filename);
        $this->assertSame('isi file', (string) $file);
    }

    public function testJawabanHtmlHostingMenyarankanMethodOverride(): void
    {
        $s = $this->client([self::token(), new Response(403, ['Content-Type' => 'text/html'], '<html><h1>Forbidden</h1></html>')]);
        $this->expectException(PermissionException::class);
        $this->expectExceptionMessageMatches('/method_override/');
        $s->lms()->deleteKelasById(1);
    }

    public function testOptionsDariArrayLaravel(): void
    {
        $o = Options::fromArray(['base_url' => 'https://siakad.unipo.ac.id/api/v1', 'client_id' => 'a', 'client_secret' => 'b', 'method_override' => '1', 'timeout' => '15', 'scope' => null]);
        $this->assertTrue($o->methodOverride);
        $this->assertSame(15.0, $o->timeout);
        $this->assertSame('https://siakad.unipo.ac.id/api', (new Siakad($o))->baseUrl());
        $this->expectException(\InvalidArgumentException::class);
        Options::fromArray(['clientid_salah' => 'x']);
    }
}
