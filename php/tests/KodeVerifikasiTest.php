<?php

declare(strict_types=1);

namespace Unipo\Siakad\Tests;

use PHPUnit\Framework\TestCase;
use Unipo\Siakad\Dokumen\KodeVerifikasi;

final class KodeVerifikasiTest extends TestCase
{
    public function testMembacaBerbagaiBentukIsiQr(): void
    {
        self::assertSame('K7QM2XPA9RTD', KodeVerifikasi::dariQr('https://siakad.unipo.ac.id/api/v1/dokumen/v/K7QM2XPA9RTD'));
        self::assertSame('K7QM2XPA9RTD', KodeVerifikasi::dariQr('https://contoh.test/cek?kode=k7qm-2xpa-9rtd'));
        self::assertSame('K7QM2XPA9RTD', KodeVerifikasi::dariQr(' K7QM-2XPA-9RTD '));
        self::assertNull(KodeVerifikasi::dariQr('https://contoh.test/v/BUKAN'));
        self::assertNull(KodeVerifikasi::dariQr('K7QM2XPA9RT0'));
        self::assertSame('K7QM-2XPA-9RTD', KodeVerifikasi::format('k7qm2xpa9rtd'));
    }
}
