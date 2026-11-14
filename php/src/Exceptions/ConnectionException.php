<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/** Tidak bisa menghubungi server (DNS, koneksi putus, batas waktu habis). */
class ConnectionException extends SiakadException
{
}
