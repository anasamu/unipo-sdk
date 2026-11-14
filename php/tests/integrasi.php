<?php

/*
 * Uji integrasi ke API SIAKAD sungguhan (lokal/development). Tidak ikut PHPUnit.
 *
 *   SIAKAD_URL=http://127.0.0.1:8090/api SIAKAD_CLIENT_ID=... SIAKAD_CLIENT_SECRET=... \
 *   SIAKAD_USER=admin_uji SIAKAD_PASS=... php tests/integrasi.php
 *
 * Klien butuh scope referensi:read, portal:read, portal:write, portal:admin dan izin login pengguna.
 */

declare(strict_types=1);

require $_SERVER['SIAKAD_AUTOLOAD'] ?? __DIR__ . '/../../vendor/autoload.php';

use Unipo\Siakad\Auth\MemoryTokenStore;
use Unipo\Siakad\Auth\TokenSet;
use Unipo\Siakad\Exceptions\NotFoundException;
use Unipo\Siakad\Exceptions\PermissionException;
use Unipo\Siakad\Exceptions\SiakadException;
use Unipo\Siakad\Exceptions\ValidationException;
use Unipo\Siakad\Http\Upload;
use Unipo\Siakad\Siakad;

$env = static fn (string $k): string => (string) getenv($k);
$base = ['base_url' => $env('SIAKAD_URL'), 'client_id' => $env('SIAKAD_CLIENT_ID'), 'client_secret' => $env('SIAKAD_CLIENT_SECRET'), 'token_store' => new MemoryTokenStore()];
$gagal = 0;

function langkah(string $nama, callable $fn): void
{
    global $gagal;
    try {
        $fn();
        echo "ok    $nama\n";
    } catch (\Throwable $e) {
        echo "GAGAL $nama - " . get_class($e) . ': ' . $e->getMessage() . "\n";
        $gagal++;
    }
}

function cek(bool $kondisi, string $pesan = 'asersi gagal'): void
{
    if (!$kondisi) {
        throw new \RuntimeException($pesan);
    }
}

/** @param class-string<\Throwable> $kelas */
function harusGagal(callable $fn, string $kelas): \Throwable
{
    try {
        $fn();
    } catch (\Throwable $e) {
        cek($e instanceof $kelas, 'dapat ' . get_class($e) . ': ' . $e->getMessage());

        return $e;
    }
    throw new \RuntimeException('tidak ada galat');
}

$anon = new Siakad(['base_url' => $env('SIAKAD_URL')]);
$siakad = new Siakad($base);
$ov = $siakad->withOptions(['method_override' => true]);

langkah('health tanpa kredensial', function () use ($anon) {
    $r = $anon->system()->health();
    cek($r['status'] === 'ok');
    cek($r->requestId() !== null);
});

langkah('token aplikasi otomatis + referensi prodi', function () use ($siakad) {
    $r = $siakad->referensi()->getProdi();
    cek(count($r) >= 1);
    cek($r->environment() === 'live');
});

langkah('auth()->me() token aplikasi', function () use ($siakad, $env) {
    $me = $siakad->auth()->me();
    cek($me['client_id'] === $env('SIAKAD_CLIENT_ID'));
});

langkah('404 -> NotFoundException', fn () => harusGagal(fn () => $siakad->referensi()->getProdiByKode('99999'), NotFoundException::class));

langkah('scope kurang -> PermissionException', function () use ($siakad) {
    $e = harusGagal(fn () => $siakad->keuangan()->getBiaya(), PermissionException::class);
    cek($e instanceof SiakadException && $e->errorCode() === 'insufficient_scope');
});

$situs = 'php' . base_convert((string) time(), 10, 36);
langkah('buat situs portal (POST JSON)', function () use ($siakad, $situs) {
    $r = $siakad->portal()->postKelolaSitus(['kode' => $situs, 'nama' => 'Situs uji SDK PHP', 'jenis' => 'universitas']);
    cek($r->status() === 201);
});

langkah('validasi -> ValidationException', function () use ($siakad, $situs) {
    $e = harusGagal(fn () => $siakad->portal()->postKelolaFaq(['situs' => $situs, 'pertanyaan' => '', 'jawaban' => '']), ValidationException::class);
    cek($e instanceof ValidationException && $e->fields() !== []);
});

$ids = [];
langkah('buat 3 FAQ', function () use ($siakad, $situs, &$ids) {
    for ($i = 1; $i <= 3; $i++) {
        $ids[] = $siakad->portal()->postKelolaFaq(['situs' => $situs, 'pertanyaan' => "Pertanyaan $i?", 'jawaban' => "<p>Jawaban $i</p>"])['id'];
    }
    cek(count($ids) === 3);
});

langkah('paginate per_page=1 mengambil 3 item', function () use ($siakad, $situs) {
    $semua = $siakad->paginate(fn (array $q) => $siakad->portal()->getKelolaFaq($q), ['situs' => $situs, 'per_page' => 1])->all();
    cek(count($semua) === 3, 'dapat ' . count($semua));
});

langkah('PATCH lewat method_override', function () use ($ov, &$ids) {
    $r = $ov->portal()->patchKelolaFaqById($ids[0], ['pertanyaan' => 'Diubah lewat override?', 'jawaban' => '<p>ok</p>']);
    cek(($r['judul'] ?? $r['pertanyaan'] ?? null) === 'Diubah lewat override?');
});

langkah('DELETE biasa', function () use ($siakad, &$ids) {
    $siakad->portal()->deleteKelolaFaqById($ids[2]);
    harusGagal(fn () => $siakad->portal()->getKelolaFaqById($ids[2]), NotFoundException::class);
});

langkah('unggah media multipart', function () use ($siakad, $situs) {
    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
    $r = $siakad->portal()->postKelolaMedia(['situs' => $situs, 'berkas' => Upload::fromString($png, 'titik.png', 'image/png'), 'judul' => 'Titik']);
    cek(isset($r['id']));
});

langkah('login pengguna + withToken + refresh + revoke', function () use ($siakad, $env) {
    $t = $siakad->auth()->password($env('SIAKAD_USER'), $env('SIAKAD_PASS'));
    cek($t->refreshToken !== null);
    $disimpan = [];
    $user = $siakad->withToken(new TokenSet($t->accessToken, time(), $t->refreshToken), function (TokenSet $baru) use (&$disimpan) {
        $disimpan[] = $baru;
    });
    cek($user->auth()->me()['username'] === $env('SIAKAD_USER'));
    cek(count($disimpan) === 1);
    $user->auth()->revoke($disimpan[0]->refreshToken);
    harusGagal(fn () => $siakad->auth()->refresh((string) $disimpan[0]->refreshToken), SiakadException::class);
});

exit($gagal > 0 ? 1 : 0);
