<?php

declare(strict_types=1);

namespace Unipo\Siakad\Tests;

use PHPUnit\Framework\TestCase;
use Unipo\Siakad\Infra\Gerbang;

final class GerbangTest extends TestCase
{
    private const KUNCI = 'gwk_abc';

    /** @return array<string, string> */
    private function server(string $tanda): array
    {
        return [
            'REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/app/api/v1/kuliah/kelas?x=1', 'HTTP_X_UNIPO_GERBANG' => $tanda,
            'HTTP_X_UNIPO_KLIEN' => 'cli_1', 'HTTP_X_UNIPO_PENGGUNA' => '', 'HTTP_X_UNIPO_LEVEL' => '', 'HTTP_X_UNIPO_SCOPE' => 'a b',
            'HTTP_X_REQUEST_ID' => 'rid12345',
        ];
    }

    public function testTandaTanganSamaDenganGerbang(): void
    {
        // Nilai dari server/gerbang-inti.php api_unipo dan verifikasiGerbang() Node untuk masukan yang sama.
        self::assertSame(
            't=1794721727,v1=ffd4d976e2a423e5b3b05f55d6a2257a3e77cb4f8dad2788c6e8e17a607dbe86',
            Gerbang::tandaTangan(self::KUNCI, 1794721727, 'POST', '/app/api/v1/kuliah/kelas?x=1', 'cli_1', '', 'rid12345'),
        );
    }

    public function testVerifikasiSah(): void
    {
        $t = 1794721727;
        $id = Gerbang::verifikasi(self::KUNCI, $this->server(Gerbang::tandaTangan(self::KUNCI, $t, 'POST', '/app/api/v1/kuliah/kelas?x=1', 'cli_1', '', 'rid12345')), 300, $t + 10);
        self::assertNotNull($id);
        self::assertSame('cli_1', $id['klien']);
        self::assertSame(['a', 'b'], $id['scope']);
    }

    public function testDitolakBilaDiubahAtauKedaluwarsa(): void
    {
        $t = 1794721727;
        $tanda = Gerbang::tandaTangan(self::KUNCI, $t, 'POST', '/app/api/v1/kuliah/kelas?x=1', 'cli_1', '', 'rid12345');
        $palsu = ['HTTP_X_UNIPO_KLIEN' => 'cli_lain'] + $this->server($tanda);
        self::assertNull(Gerbang::verifikasi(self::KUNCI, $palsu, 300, $t));
        self::assertNull(Gerbang::verifikasi(self::KUNCI, $this->server($tanda), 300, $t + 301));
        self::assertNull(Gerbang::verifikasi('kunci_lain', $this->server($tanda), 300, $t));
        self::assertNull(Gerbang::verifikasi(self::KUNCI, $this->server(''), 300, $t));
    }
}
