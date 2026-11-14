<?php

declare(strict_types=1);

namespace Unipo\Siakad\Auth;

/** Token disimpan di memori proses saja (cocok untuk worker/queue yang berjalan lama dan untuk pengujian). */
final class MemoryTokenStore implements TokenStore
{
    /** @var array<string, array{0: TokenSet, 1: int}> */
    private array $items = [];

    public function get(string $key): ?TokenSet
    {
        $item = $this->items[$key] ?? null;
        if ($item === null) {
            return null;
        }
        if ($item[1] <= time()) {
            unset($this->items[$key]);

            return null;
        }

        return $item[0];
    }

    public function set(string $key, TokenSet $token, int $ttl): void
    {
        $this->items[$key] = [$token, time() + $ttl];
    }

    public function delete(string $key): void
    {
        unset($this->items[$key]);
    }
}
