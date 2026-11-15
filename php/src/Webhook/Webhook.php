<?php

declare(strict_types=1);

namespace Unipo\Siakad\Webhook;

/**
 * Penerima webhook SIAKAD: verifikasi tanda tangan X-Siakad-Signature dan baca isinya.
 *
 *   $pesan = Webhook::verifikasi(file_get_contents('php://input'), $_SERVER['HTTP_X_SIAKAD_SIGNATURE'] ?? null, $rahasia);
 *   if (sudahDiproses($pesan['id'])) { http_response_code(200); return; }   // buang duplikat
 *   if ($pesan['event'] === 'mahasiswa.lulus') { $nim = $pesan['data']['nim']; ... }
 *
 * Katalog event domain dan isi data: GET /v1/peristiwa/katalog ($siakad->peristiwa()->getKatalog()).
 */
final class Webhook
{
    /**
     * @return array{id: string, event: string, dibuat_at: string, data: array<string, mixed>}
     * @throws WebhookSignatureException
     */
    public static function verifikasi(string $body, ?string $tandaTangan, string $rahasia, int $toleransiDetik = 300, ?int $sekarang = null): array
    {
        $bagian = [];
        foreach (explode(',', (string) $tandaTangan) as $x) {
            $kv = explode('=', trim($x), 2);
            if (count($kv) === 2) {
                $bagian[$kv[0]] = $kv[1];
            }
        }
        if (!isset($bagian['t'], $bagian['v1']) || !ctype_digit($bagian['t'])) {
            throw new WebhookSignatureException('Header X-Siakad-Signature tidak ada atau rusak.');
        }
        $t = (int) $bagian['t'];
        if (abs(($sekarang ?? time()) - $t) > $toleransiDetik) {
            throw new WebhookSignatureException('Waktu tanda tangan di luar toleransi.');
        }
        if (!hash_equals(self::tandaTangan($body, $rahasia, $t), $bagian['v1'])) {
            throw new WebhookSignatureException('Tanda tangan webhook tidak cocok.');
        }
        $isi = json_decode($body, true);
        if (!is_array($isi) || !isset($isi['id'], $isi['event'])) {
            throw new WebhookSignatureException('Isi webhook bukan JSON yang dikenal.');
        }

        return $isi;
    }

    /** HMAC-SHA256 hex dari "t.body" (nilai v1). */
    public static function tandaTangan(string $body, string $rahasia, int $t): string
    {
        return hash_hmac('sha256', $t . '.' . $body, $rahasia);
    }
}
