<?php

declare(strict_types=1);

namespace Unipo\Siakad\Auth;

/**
 * Pasangan token dari POST /v1/auth/token. Simpan di sesi dengan toArray() dan pulihkan dengan fromArray().
 */
final class TokenSet implements \JsonSerializable
{
    /**
     * @param int $expiresAt kedaluwarsa token akses (detik epoch)
     * @param array<string, mixed> $extra field lain dari jawaban token
     */
    public function __construct(
        public readonly string $accessToken,
        public readonly int $expiresAt,
        public readonly ?string $refreshToken = null,
        public readonly string $scope = '',
        public readonly string $tokenType = 'Bearer',
        public readonly array $extra = [],
    ) {
    }

    /**
     * Dari jawaban API (expires_in) atau hasil toArray() (expires_at).
     *
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data, ?int $now = null): self
    {
        $now ??= time();
        $expiresAt = isset($data['expires_at']) ? (int) $data['expires_at'] : $now + (int) ($data['expires_in'] ?? 3600);
        $extra = array_diff_key($data, array_flip(['access_token', 'expires_in', 'expires_at', 'refresh_token', 'scope', 'token_type']));

        return new self(
            (string) ($data['access_token'] ?? ''),
            $expiresAt,
            isset($data['refresh_token']) && $data['refresh_token'] !== '' ? (string) $data['refresh_token'] : null,
            (string) ($data['scope'] ?? ''),
            (string) ($data['token_type'] ?? 'Bearer'),
            $extra,
        );
    }

    /** Sisa umur token akses dalam detik. */
    public function expiresIn(?int $now = null): int
    {
        return $this->expiresAt - ($now ?? time());
    }

    /** True bila token habis atau akan habis dalam $margin detik. */
    public function isExpired(int $margin = 60, ?int $now = null): bool
    {
        return $this->expiresIn($now) <= $margin;
    }

    /** @return list<string> */
    public function scopes(): array
    {
        return $this->scope === '' ? [] : array_values(array_filter(explode(' ', $this->scope)));
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'access_token' => $this->accessToken,
            'token_type' => $this->tokenType,
            'expires_at' => $this->expiresAt,
            'scope' => $this->scope,
            'refresh_token' => $this->refreshToken,
        ] + $this->extra;
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
