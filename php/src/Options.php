<?php

declare(strict_types=1);

namespace Unipo\Siakad;

use Psr\Http\Client\ClientInterface;
use Unipo\Siakad\Auth\TokenSet;
use Unipo\Siakad\Auth\TokenStore;

/**
 * Pengaturan klien. Bisa dibuat dengan argumen bernama atau dari array (mis. config Laravel):
 *
 *     new Options(clientId: '...', clientSecret: '...');
 *     Options::fromArray(['client_id' => '...', 'client_secret' => '...']);
 */
final class Options
{
    /**
     * @param string $baseUrl alamat dasar tanpa /v1; alamat lama https://siakad.unipo.ac.id/api juga bisa
     * @param string|list<string>|null $scope scope token aplikasi (bawaan: semua scope klien)
     * @param string|null $accessToken token yang sudah ada (mis. token pengguna); bila diisi tidak meminta client_credentials
     * @param int|null $accessTokenExpiresAt kedaluwarsa accessToken (detik epoch), bila diketahui
     * @param (callable(TokenSet): void)|null $onTokenRefresh dipanggil setelah token pengguna diperpanjang otomatis
     * @param 'live'|'development'|null $environment pakai database development walau klien punya akses live
     * @param string|null $userIp IP pengguna akhir, untuk klien perantara login "percayai IP pengguna" (mis. SSO)
     * @param float $timeout batas waktu tiap permintaan (detik)
     * @param int $maxRetries percobaan ulang untuk 429, 502/503/504, dan galat koneksi (GET)
     * @param bool $methodOverride kirim PUT/PATCH/DELETE sebagai POST + X-HTTP-Method-Override (bila hosting menolak metode itu)
     * @param array<string, string> $headers header tambahan
     * @param ClientInterface|null $httpClient klien PSR-18 lain; bawaan Guzzle
     */
    public function __construct(
        public readonly string $baseUrl = 'https://api.unipo.ac.id',
        public readonly ?string $clientId = null,
        public readonly ?string $clientSecret = null,
        public readonly string|array|null $scope = null,
        public readonly ?string $accessToken = null,
        public readonly ?string $refreshToken = null,
        public readonly ?int $accessTokenExpiresAt = null,
        public readonly mixed $onTokenRefresh = null,
        public readonly ?TokenStore $tokenStore = null,
        public readonly ?string $environment = null,
        public readonly ?string $userIp = null,
        public readonly float $timeout = 30.0,
        public readonly int $maxRetries = 2,
        public readonly bool $methodOverride = false,
        public readonly array $headers = [],
        public readonly ?ClientInterface $httpClient = null,
    ) {
        if ($onTokenRefresh !== null && !is_callable($onTokenRefresh)) { // @phpstan-ignore booleanAnd.alwaysFalse (nilai dari array config bisa apa saja)
            throw new \InvalidArgumentException('onTokenRefresh harus callable.');
        }
    }

    /**
     * Kunci snake_case (base_url, client_id, client_secret, scope, access_token, refresh_token, access_token_expires_at,
     * on_token_refresh, token_store, environment, user_ip, timeout, max_retries, method_override, headers, http_client)
     * atau camelCase.
     *
     * @param array<string, mixed> $config
     */
    public static function fromArray(array $config): self
    {
        $args = [];
        foreach ($config as $key => $value) {
            $name = lcfirst(str_replace('_', '', ucwords((string) $key, '_')));
            if ($value === null || $value === '') {
                continue;
            }
            $args[$name] = match ($name) {
                'timeout' => (float) $value,
                'maxRetries', 'accessTokenExpiresAt' => (int) $value,
                'methodOverride' => filter_var($value, FILTER_VALIDATE_BOOL),
                default => $value,
            };
        }
        $known = array_map(static fn (\ReflectionParameter $p): string => $p->getName(), (new \ReflectionMethod(self::class, '__construct'))->getParameters());
        $unknown = array_diff(array_keys($args), $known);
        if ($unknown !== []) {
            throw new \InvalidArgumentException('Opsi tidak dikenal: ' . implode(', ', $unknown));
        }

        return new self(...$args);
    }

    /**
     * Salinan dengan sebagian nilai diganti.
     *
     * @param array<string, mixed> $changes
     */
    public function with(array $changes): self
    {
        $current = get_object_vars($this);
        foreach ($changes as $key => $value) {
            $current[lcfirst(str_replace('_', '', ucwords((string) $key, '_')))] = $value;
        }

        return new self(...$current);
    }
}
