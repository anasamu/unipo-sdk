<?php

declare(strict_types=1);

namespace Unipo\Siakad\Auth;

/**
 * Token disimpan sebagai file (izin 0600) di folder yang bisa ditulis PHP. Bawaan di luar Laravel, supaya aplikasi
 * PHP biasa (satu proses per request) tidak meminta token baru di setiap request.
 */
final class FileTokenStore implements TokenStore
{
    private readonly string $dir;

    public function __construct(?string $dir = null)
    {
        $this->dir = rtrim($dir ?? sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'unipo-siakad-sdk', DIRECTORY_SEPARATOR);
    }

    public function get(string $key): ?TokenSet
    {
        $file = $this->file($key);
        if (!is_file($file)) {
            return null;
        }
        $raw = @file_get_contents($file);
        $data = is_string($raw) ? json_decode($raw, true) : null;
        if (!is_array($data) || (int) ($data['until'] ?? 0) <= time() || !is_array($data['token'] ?? null)) {
            @unlink($file);

            return null;
        }

        return TokenSet::fromArray($data['token']);
    }

    public function set(string $key, TokenSet $token, int $ttl): void
    {
        if (!is_dir($this->dir) && !@mkdir($this->dir, 0700, true) && !is_dir($this->dir)) {
            return; // Tidak bisa menyimpan: token tetap dipakai, hanya tidak di-cache.
        }
        $file = $this->file($key);
        $tmp = $file . '.' . bin2hex(random_bytes(4));
        $json = json_encode(['until' => time() + $ttl, 'token' => $token->toArray()]);
        if ($json !== false && @file_put_contents($tmp, $json, LOCK_EX) !== false) {
            @chmod($tmp, 0600);
            @rename($tmp, $file);
        }
    }

    public function delete(string $key): void
    {
        @unlink($this->file($key));
    }

    private function file(string $key): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . hash('sha256', $key) . '.json';
    }
}
