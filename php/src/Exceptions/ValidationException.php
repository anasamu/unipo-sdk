<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/** 422: validasi gagal. */
class ValidationException extends SiakadException
{
    /** @return array<string, mixed> pesan per field, mis. ['nim' => 'NIM wajib diisi.'] */
    public function fields(): array
    {
        return $this->details();
    }
}
