<?php

declare(strict_types=1);

namespace Unipo\Siakad\Tests;

use PHPUnit\Framework\TestCase;
use Unipo\Siakad\Webhook\Webhook;
use Unipo\Siakad\Webhook\WebhookSignatureException;

final class WebhookTest extends TestCase
{
    private const BODY = '{"id":"e1","event":"keuangan.tagihan_lunas","dibuat_at":"2026-11-16T09:00:00+08:00","data":{"nim":"2401010001"}}';

    public function testWebhookSahDiterima(): void
    {
        $t = 1794700000;
        $sig = 't=' . $t . ',v1=' . hash_hmac('sha256', $t . '.' . self::BODY, 'whsec_uji');
        $p = Webhook::verifikasi(self::BODY, $sig, 'whsec_uji', 300, $t + 5);
        self::assertSame('keuangan.tagihan_lunas', $p['event']);
        self::assertSame('2401010001', $p['data']['nim']);
    }

    public function testTandaTanganSalahDitolak(): void
    {
        $t = 1794700000;
        $sig = 't=' . $t . ',v1=' . hash_hmac('sha256', $t . '.' . self::BODY, 'whsec_lain');
        $this->expectException(WebhookSignatureException::class);
        Webhook::verifikasi(self::BODY, $sig, 'whsec_uji', 300, $t);
    }

    public function testKedaluwarsaDitolak(): void
    {
        $t = 1794700000;
        $sig = 't=' . $t . ',v1=' . Webhook::tandaTangan(self::BODY, 'whsec_uji', $t);
        $this->expectException(WebhookSignatureException::class);
        Webhook::verifikasi(self::BODY, $sig, 'whsec_uji', 300, $t + 600);
    }
}
