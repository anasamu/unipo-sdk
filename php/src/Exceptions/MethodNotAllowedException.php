<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/** 405: metode HTTP tidak didukung. Bila hosting menolak PUT/PATCH/DELETE, nyalakan opsi method_override. */
class MethodNotAllowedException extends SiakadException
{
}
