<?php

declare(strict_types=1);

namespace Unipo\Siakad\Auth;

use Psr\SimpleCache\CacheInterface;

/** Token disimpan di cache PSR-16 (Laravel Cache, Symfony Cache, Redis, Memcached, ...). */
final class Psr16TokenStore implements TokenStore
{
    public function __construct(private readonly CacheInterface $cache, private readonly string $prefix = 'unipo_siakad_token_')
    {
    }

    public function get(string $key): ?TokenSet
    {
        $data = $this->cache->get($this->key($key));

        return is_array($data) ? TokenSet::fromArray($data) : null;
    }

    public function set(string $key, TokenSet $token, int $ttl): void
    {
        $this->cache->set($this->key($key), $token->toArray(), $ttl);
    }

    public function delete(string $key): void
    {
        $this->cache->delete($this->key($key));
    }

    private function key(string $key): string
    {
        // Karakter {}()/\@: tidak boleh dipakai sebagai kunci PSR-16.
        return $this->prefix . hash('sha256', $key);
    }
}
