<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/** 401: kredensial klien salah, atau token kedaluwarsa/dicabut. */
class AuthenticationException extends SiakadException
{
}
