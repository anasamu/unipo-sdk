<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/** 403: tidak berhak (insufficient_scope, forbidden, ip_not_allowed, level_not_allowed, ...). */
class PermissionException extends SiakadException
{
    /** @return list<string> scope yang dibutuhkan endpoint (galat insufficient_scope) */
    public function requiredScopes(): array
    {
        $s = $this->details()['required_scopes'] ?? [];

        return is_array($s) ? array_values(array_map('strval', $s)) : [];
    }
}
