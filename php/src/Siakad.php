<?php

declare(strict_types=1);

namespace Unipo\Siakad;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Unipo\Siakad\Auth\AuthApi;
use Unipo\Siakad\Auth\FileTokenStore;
use Unipo\Siakad\Auth\TokenSet;
use Unipo\Siakad\Auth\TokenStore;
use Unipo\Siakad\Concerns\GeneratedResources;
use Unipo\Siakad\Exceptions\AuthenticationException;
use Unipo\Siakad\Exceptions\ConnectionException;
use Unipo\Siakad\Exceptions\SiakadException;
use Unipo\Siakad\Exceptions\TimeoutException;
use Unipo\Siakad\Http\ApiResponse;
use Unipo\Siakad\Http\DownloadedFile;
use Unipo\Siakad\Http\Upload;
use Unipo\Siakad\Pagination\Paginator;
use Unipo\Siakad\Resources\Resource;

/**
 * Klien API SIAKAD UNIPO.
 *
 *     $siakad = new Siakad(['client_id' => '...', 'client_secret' => '...']);
 *     $mhs = $siakad->mahasiswa()->getByNim('2025001');
 *     echo $mhs['nama'];
 *
 * Token aplikasi diminta dan disimpan otomatis. Untuk token pengguna pakai auth()->password() lalu withToken().
 */
class Siakad
{
    use GeneratedResources;

    public const VERSION = '1.1.0';

    /** Token dianggap habis bila sisa umurnya kurang dari ini (detik). */
    private const EXPIRY_MARGIN = 60;

    public readonly Options $options;
    private readonly string $baseUrl;
    private readonly ClientInterface $http;
    private readonly TokenStore $store;
    private ?TokenSet $userToken = null;
    /** @var array<class-string<Resource>, Resource> */
    private array $resources = [];
    private ?AuthApi $authApi = null;

    /** @param Options|array<string, mixed> $options */
    final public function __construct(Options|array $options = [])
    {
        $this->options = is_array($options) ? Options::fromArray($options) : $options;
        $base = rtrim($this->options->baseUrl, '/');
        $this->baseUrl = str_ends_with($base, '/v1') ? substr($base, 0, -3) : $base;
        $this->http = $this->options->httpClient ?? new GuzzleClient([
            'timeout' => $this->options->timeout,
            'connect_timeout' => min(10.0, $this->options->timeout),
            'http_errors' => false,
            'allow_redirects' => false,
        ]);
        $this->store = $this->options->tokenStore ?? new FileTokenStore();
        if ($this->options->accessToken !== null) {
            $this->userToken = new TokenSet(
                $this->options->accessToken,
                $this->options->accessTokenExpiresAt ?? PHP_INT_MAX,
                $this->options->refreshToken,
            );
        }
    }

    /** Autentikasi: token pengguna, SSO, refresh, revoke, info token, lupa password. */
    public function auth(): AuthApi
    {
        return $this->authApi ??= new AuthApi($this);
    }

    /**
     * Klien baru yang memakai token pengguna (hasil auth()->password(), auth()->exchangeSsoToken(), atau token di sesi).
     * Token diperpanjang otomatis dengan refresh token; simpan token baru lewat $onTokenRefresh.
     *
     * @param (callable(TokenSet): void)|null $onTokenRefresh
     */
    public function withToken(TokenSet|string $token, ?callable $onTokenRefresh = null): static
    {
        $token = is_string($token) ? new TokenSet($token, PHP_INT_MAX) : $token;

        return $this->withOptions([
            'accessToken' => $token->accessToken,
            'refreshToken' => $token->refreshToken,
            'accessTokenExpiresAt' => $token->expiresAt,
            'onTokenRefresh' => $onTokenRefresh ?? $this->options->onTokenRefresh,
        ]);
    }

    /**
     * Klien baru dengan opsi yang diubah, mis. withOptions(['environment' => 'development']).
     *
     * @param array<string, mixed> $options
     */
    public function withOptions(array $options): static
    {
        $changes = $options;
        // Pakai klien HTTP dan penyimpanan token yang sama.
        $changes['httpClient'] ??= $this->http;
        $changes['tokenStore'] ??= $this->store;

        return new static($this->options->with($changes));
    }

    /** Alamat dasar (tanpa /v1). */
    public function baseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Panggil endpoint apa pun secara langsung (mis. endpoint baru yang belum ada di SDK).
     * Placeholder {nama} di path diisi dari $query.
     *
     *     $siakad->request('GET', '/v1/mahasiswa/{nim}/khs', ['nim' => '2025001', 'tahun_id' => '20261']);
     *
     * @param array<string, mixed> $query
     * @param array<string, mixed>|null $body
     * @param array{headers?: array<string, string>, multipart?: bool, public?: bool, max_retries?: int} $options
     */
    public function request(string $method, string $path, array $query = [], ?array $body = null, array $options = []): ApiResponse
    {
        $pathParams = [];
        if (preg_match_all('/\{([A-Za-z0-9_]+)\}/', $path, $m)) {
            foreach ($m[1] as $name) {
                if (array_key_exists($name, $query)) {
                    $pathParams[$name] = $query[$name];
                    unset($query[$name]);
                }
            }
        }

        return $this->send($method, $path, $pathParams, $query, $body, $options, (bool) ($options['multipart'] ?? false), (bool) ($options['public'] ?? false));
    }

    /**
     * Iterasi semua item dari endpoint daftar.
     *
     *     foreach ($siakad->paginate(fn (array $q) => $siakad->mahasiswa()->list($q), ['prodi' => '86206']) as $mhs) { ... }
     *
     * @param callable(array<string, mixed>): ApiResponse $fetchPage
     * @param array<string, mixed> $query
     */
    public function paginate(callable $fetchPage, array $query = []): Paginator
    {
        return new Paginator($fetchPage, $query);
    }

    /**
     * @internal Dipakai kelas modul.
     *
     * @param array<string, int|string> $pathParams
     * @param array<string, mixed> $query
     * @param array<string, mixed>|null $body
     * @param array<string, mixed> $options
     */
    public function send(string $method, string $path, array $pathParams, array $query, ?array $body, array $options, bool $multipart, bool $public): ApiResponse
    {
        $method = strtoupper($method);
        $url = $this->baseUrl . $this->fillPath($path, $pathParams) . $this->buildQuery($query);
        $maxRetries = (int) ($options['max_retries'] ?? $this->options->maxRetries);
        $authRetried = false;

        for ($attempt = 0; ; $attempt++) {
            try {
                $token = $this->tokenFor($public);
            } catch (SiakadException $e) {
                if (!$public) {
                    throw $e;
                }
                $token = null;
            }

            try {
                $response = $this->dispatch($method, $url, $body, $multipart, $token, (array) ($options['headers'] ?? []));
            } catch (ConnectionException $e) {
                if ($method === 'GET' && $attempt < $maxRetries) {
                    $this->sleep($this->backoff($attempt));
                    continue;
                }
                throw $e;
            }

            $status = $response->getStatusCode();
            if ($status >= 200 && $status < 300) {
                return $this->parse($response);
            }

            $error = $this->toException($response);
            if ($status === 401 && $token !== null && !$authRetried && $this->canRenew()) {
                $authRetried = true;
                $this->forgetToken();
                continue;
            }
            if ($attempt < $maxRetries) {
                if ($status === 429) {
                    $wait = $error->headers()['retry-after'] ?? null;
                    $this->sleep(min(is_numeric($wait) ? (float) $wait : $this->backoff($attempt), 60.0));
                    continue;
                }
                if (in_array($status, [502, 503, 504], true) && $error->errorCode() !== 'api_disabled') {
                    $this->sleep($this->backoff($attempt));
                    continue;
                }
            }
            throw $error;
        }
    }

    /**
     * @internal Dipakai AuthApi: POST /v1/auth/token dengan kredensial klien.
     *
     * @param array<string, string> $params
     */
    public function requestToken(array $params, ?string $userIp = null): TokenSet
    {
        if (($this->options->clientId ?? '') === '' || ($this->options->clientSecret ?? '') === '') {
            throw new AuthenticationException('client_id dan client_secret wajib diisi untuk meminta token.', 0, 'missing_credentials');
        }
        $headers = $this->baseHeaders() + [
            'Authorization' => 'Basic ' . base64_encode($this->options->clientId . ':' . $this->options->clientSecret),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $ip = $userIp ?? $this->options->userIp;
        if ($ip !== null && $ip !== '') {
            $headers['X-Siakad-User-Ip'] = $ip;
        }
        $response = $this->transmit(new Request('POST', $this->baseUrl . '/v1/auth/token', $headers, $this->json($params)));
        if ($response->getStatusCode() !== 200) {
            throw $this->toException($response);
        }
        $data = json_decode((string) $response->getBody(), true);
        if (!is_array($data) || !isset($data['access_token'])) {
            throw new SiakadException('Jawaban token tidak dikenali.', $response->getStatusCode(), 'invalid_response');
        }

        return TokenSet::fromArray($data);
    }

    /** @internal Token pengguna yang sedang dipakai. */
    public function currentToken(): ?TokenSet
    {
        return $this->userToken;
    }

    /**
     * @internal Dipanggil trait GeneratedResources.
     *
     * @template T of Resource
     * @param class-string<T> $class
     * @return T
     */
    protected function resource(string $class): Resource
    {
        if (!isset($this->resources[$class])) {
            $this->resources[$class] = new $class($this);
        }
        /** @var T */
        return $this->resources[$class];
    }

    /** Ditimpa dalam pengujian. */
    protected function sleep(float $seconds): void
    {
        if ($seconds > 0) {
            usleep((int) ($seconds * 1_000_000));
        }
    }

    // ------------------------------------------------------------------ token

    private function cacheKey(): string
    {
        $scope = is_array($this->options->scope) ? implode(' ', $this->options->scope) : (string) $this->options->scope;

        return implode('|', [$this->baseUrl, (string) $this->options->clientId, $scope, (string) $this->options->environment]);
    }

    private function tokenFor(bool $public): ?string
    {
        if ($this->userToken !== null) {
            if (!$public && $this->userToken->isExpired(self::EXPIRY_MARGIN) && $this->canRenew()) {
                return $this->renewUserToken();
            }

            return $this->userToken->accessToken;
        }
        if (($this->options->clientId ?? '') === '' || ($this->options->clientSecret ?? '') === '') {
            if ($public) {
                return null;
            }
            throw new AuthenticationException('Belum ada token. Isi client_id + client_secret, atau access_token, atau pakai withToken().', 0, 'missing_credentials');
        }

        $cached = $this->store->get($this->cacheKey());
        if ($cached !== null && !$cached->isExpired(self::EXPIRY_MARGIN)) {
            return $cached->accessToken;
        }
        if ($public) {
            return null;
        }

        $params = ['grant_type' => 'client_credentials'];
        $scope = is_array($this->options->scope) ? implode(' ', $this->options->scope) : (string) $this->options->scope;
        if ($scope !== '') {
            $params['scope'] = $scope;
        }
        $token = $this->requestToken($params);
        $this->store->set($this->cacheKey(), $token, max(1, $token->expiresIn() - self::EXPIRY_MARGIN));

        return $token->accessToken;
    }

    private function canRenew(): bool
    {
        if (($this->options->clientId ?? '') === '' || ($this->options->clientSecret ?? '') === '') {
            return false;
        }

        return $this->userToken === null || $this->userToken->refreshToken !== null;
    }

    private function renewUserToken(): string
    {
        $token = $this->requestToken(['grant_type' => 'refresh_token', 'refresh_token' => (string) $this->userToken?->refreshToken]);
        $this->userToken = $token;
        if ($this->options->onTokenRefresh !== null) {
            ($this->options->onTokenRefresh)($token);
        }

        return $token->accessToken;
    }

    private function forgetToken(): void
    {
        if ($this->userToken !== null) {
            if ($this->userToken->refreshToken !== null) {
                $this->userToken = new TokenSet($this->userToken->accessToken, 0, $this->userToken->refreshToken);
            }

            return;
        }
        $this->store->delete($this->cacheKey());
    }

    // ------------------------------------------------------------------ HTTP

    /** @return array<string, string> */
    private function baseHeaders(): array
    {
        $h = $this->options->headers + ['User-Agent' => 'unipo-siakad-sdk-php/' . self::VERSION . ' PHP/' . PHP_VERSION];
        if ($this->options->environment !== null && $this->options->environment !== '') {
            $h['X-Siakad-Lingkungan'] = $this->options->environment;
        }

        return $h;
    }

    /**
     * @param array<string, mixed>|null $body
     * @param array<string, string> $extraHeaders
     */
    private function dispatch(string $method, string $url, ?array $body, bool $multipart, ?string $token, array $extraHeaders): ResponseInterface
    {
        $headers = $extraHeaders + $this->baseHeaders() + ['Accept' => 'application/json'];
        if ($token !== null) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        $httpMethod = $method;
        if ($this->options->methodOverride && in_array($method, ['PUT', 'PATCH', 'DELETE'], true)) {
            $headers['X-HTTP-Method-Override'] = $method;
            $httpMethod = 'POST';
        }

        $payload = null;
        if ($body !== null && $method !== 'GET') {
            if ($multipart) {
                $stream = new MultipartStream($this->multipartParts($body));
                $headers['Content-Type'] = 'multipart/form-data; boundary=' . $stream->getBoundary();
                $payload = $stream;
            } else {
                $headers['Content-Type'] = 'application/json';
                $payload = $this->json($body);
            }
        } elseif ($httpMethod === 'POST' && $method !== 'POST') {
            $headers['Content-Type'] = 'application/json';
            $payload = '{}';
        }

        return $this->transmit(new Request($httpMethod, $url, $headers, $payload));
    }

    private function transmit(Request $request): ResponseInterface
    {
        try {
            return $this->http->sendRequest($request);
        } catch (NetworkExceptionInterface $e) {
            $class = stripos($e->getMessage(), 'timed out') !== false || stripos($e->getMessage(), 'timeout') !== false
                ? TimeoutException::class : ConnectionException::class;
            throw new $class('Tidak bisa menghubungi ' . $this->baseUrl . ': ' . $e->getMessage(), 0, 'connection_failed', [], null, [], $e);
        } catch (ClientExceptionInterface $e) {
            throw new ConnectionException('Permintaan ke ' . $this->baseUrl . ' gagal: ' . $e->getMessage(), 0, 'connection_failed', [], null, [], $e);
        }
    }

    /**
     * @param array<string, mixed> $body
     * @return list<array<string, mixed>>
     */
    private function multipartParts(array $body, string $prefix = ''): array
    {
        $parts = [];
        foreach ($body as $key => $value) {
            $name = $prefix === '' ? (string) $key : $prefix . '[' . $key . ']';
            if ($value === null) {
                continue;
            }
            $upload = Upload::tryFrom($value);
            if ($upload !== null) {
                $part = ['name' => $name, 'contents' => is_string($upload->contents) ? $upload->contents : Utils::streamFor($upload->contents), 'filename' => $upload->filename];
                if ($upload->contentType !== null) {
                    $part['headers'] = ['Content-Type' => $upload->contentType];
                }
                $parts[] = $part;
            } elseif (is_array($value)) {
                if (array_is_list($value)) {
                    foreach ($value as $item) {
                        $parts = array_merge($parts, $this->multipartParts([$name . '[]' => $item]));
                    }
                } else {
                    $parts = array_merge($parts, $this->multipartParts($value, $name));
                }
            } else {
                $parts[] = ['name' => $name, 'contents' => is_bool($value) ? ($value ? '1' : '0') : (string) $value];
            }
        }

        return $parts;
    }

    /** @param array<string, int|string> $params */
    private function fillPath(string $path, array $params): string
    {
        return (string) preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', static function (array $m) use ($params, $path): string {
            $v = $params[$m[1]] ?? null;
            if ($v === null || $v === '') {
                throw new SiakadException('Parameter path "' . $m[1] . '" wajib diisi untuk ' . $path . '.', 0, 'missing_parameter');
            }

            return rawurlencode((string) $v);
        }, $path);
    }

    /** @param array<string, mixed> $query */
    private function buildQuery(array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }
            if (is_array($value)) {
                foreach ($value as $item) {
                    $parts[] = rawurlencode((string) $key) . '[]=' . rawurlencode(is_bool($item) ? ($item ? '1' : '0') : (string) $item);
                }
                continue;
            }
            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode(is_bool($value) ? ($value ? '1' : '0') : (string) $value);
        }

        return $parts === [] ? '' : '?' . implode('&', $parts);
    }

    private function json(mixed $data): string
    {
        return json_encode($data === [] ? new \stdClass() : $data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION);
    }

    /** @return array<string, string> */
    private function headersOf(ResponseInterface $response): array
    {
        $out = [];
        foreach ($response->getHeaders() as $name => $values) {
            $out[strtolower((string) $name)] = implode(', ', $values);
        }

        return $out;
    }

    private function parse(ResponseInterface $response): ApiResponse
    {
        $headers = $this->headersOf($response);
        $status = $response->getStatusCode();
        $raw = (string) $response->getBody();
        if ($status === 204 || $raw === '') {
            return new ApiResponse(null, null, $status, $headers);
        }
        $type = $headers['content-type'] ?? '';
        if (!str_contains($type, 'json')) {
            return new ApiResponse(new DownloadedFile($raw, $type !== '' ? $type : 'application/octet-stream', $this->filename($headers['content-disposition'] ?? '')), null, $status, $headers);
        }
        $json = json_decode($raw, true);
        if (is_array($json) && array_key_exists('data', $json)) {
            return new ApiResponse($json['data'], isset($json['meta']) && is_array($json['meta']) ? $json['meta'] : null, $status, $headers);
        }

        return new ApiResponse($json, null, $status, $headers);
    }

    private function filename(string $disposition): ?string
    {
        if (preg_match("/filename\\*=UTF-8''([^;]+)/i", $disposition, $m)) {
            return rawurldecode($m[1]);
        }
        if (preg_match('/filename="?([^";]+)"?/i', $disposition, $m)) {
            return $m[1];
        }

        return null;
    }

    private function toException(ResponseInterface $response): SiakadException
    {
        $status = $response->getStatusCode();
        $headers = $this->headersOf($response);
        $raw = (string) $response->getBody();
        $json = json_decode($raw, true);
        $code = 'http_' . $status;
        $message = 'HTTP ' . $status;
        $details = [];
        $requestId = $headers['x-request-id'] ?? null;

        if (is_array($json) && isset($json['error'])) {
            if (is_array($json['error'])) {
                $code = (string) ($json['error']['code'] ?? $code);
                $message = (string) ($json['error']['message'] ?? $message);
                $details = is_array($json['error']['details'] ?? null) ? $json['error']['details'] : [];
            } else {
                $code = (string) $json['error'];
                $message = (string) ($json['error_description'] ?? $message);
            }
            $requestId = isset($json['request_id']) ? (string) $json['request_id'] : $requestId;
        } elseif ($raw !== '') {
            // Bukan JSON: biasanya ditolak server web/hosting sebelum sampai ke API.
            $text = trim((string) preg_replace('/\s+/', ' ', strip_tags($raw)));
            $message .= ' (bukan jawaban API: ' . mb_substr($text, 0, 160) . ')';
            if ($status === 403 || $status === 405) {
                $message .= '. Bila hosting menolak PUT/PATCH/DELETE, nyalakan opsi method_override.';
            }
        }

        return SiakadException::fromStatus($status, $message, $code, $details, $requestId, $headers);
    }

    private function backoff(int $attempt): float
    {
        return min(0.5 * (2 ** $attempt), 8.0) + mt_rand(0, 250) / 1000;
    }
}
