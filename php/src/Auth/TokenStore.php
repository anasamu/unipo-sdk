<?php

declare(strict_types=1);

namespace Unipo\Siakad\Auth;

/**
 * Tempat menyimpan token aplikasi (client_credentials) agar tidak meminta token baru di setiap request PHP.
 * Bawaan di luar Laravel: FileTokenStore di folder sementara sistem. Di Laravel: cache aplikasi (Psr16TokenStore).
 */
interface TokenStore
{
    public function get(string $key): ?TokenSet;

    public function set(string $key, TokenSet $token, int $ttl): void;

    public function delete(string $key): void;
}
