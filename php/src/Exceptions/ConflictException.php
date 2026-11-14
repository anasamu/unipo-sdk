<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/** 409: tidak bisa diproses pada kondisi sekarang (mis. masa KRS tutup). */
class ConflictException extends SiakadException
{
}
