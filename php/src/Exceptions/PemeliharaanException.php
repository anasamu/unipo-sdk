<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/**
 * 503 pemeliharaan: aplikasi sedang dalam mode pemeliharaan yang dinyalakan admin di Pustikom (dijawab BFF aplikasi
 * dari status SSO). Tidak dicoba ulang otomatis.
 */
class PemeliharaanException extends ServerException
{
    /** Perkiraan selesai (ISO 8601) atau null. */
    public function sampai(): ?string
    {
        $p = $this->details()['pemeliharaan'] ?? null;

        return is_array($p) && is_string($p['sampai'] ?? null) ? $p['sampai'] : null;
    }

    /** Mulai pemeliharaan (ISO 8601) atau null. */
    public function sejak(): ?string
    {
        $p = $this->details()['pemeliharaan'] ?? null;

        return is_array($p) && is_string($p['sejak'] ?? null) ? $p['sejak'] : null;
    }
}
