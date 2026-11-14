<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/** 429: terlalu banyak permintaan. */
class RateLimitException extends SiakadException
{
    /** Detik yang perlu ditunggu sebelum mencoba lagi. */
    public function retryAfter(): ?int
    {
        $v = $this->headers()['retry-after'] ?? ($this->details()['retry_after'] ?? null);

        return is_numeric($v) ? (int) $v : null;
    }
}
