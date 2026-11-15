<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/**
 * 409 aturan_dilanggar: langkah ditolak aturan dinamis SIAKAD (/v1/aturan), mis. batas SKS, syarat KKN, batas input
 * nilai, syarat bayar. getMessage() sudah berisi semua pesan pelanggaran.
 *
 *     try { ... } catch (AturanDilanggarException $e) {
 *         foreach ($e->pelanggaran() as $p) { echo $p['pesan']; }
 *     }
 */
class AturanDilanggarException extends ConflictException
{
    /**
     * Hasil pemeriksaan aturan: titik, boleh, pelanggaran, peringatan, batas.
     *
     * @return array<string, mixed>
     */
    public function aturan(): array
    {
        $a = $this->details()['aturan'] ?? null;

        return is_array($a) ? $a : [];
    }

    /** Titik penerapan, mis. krs.ambil, kkn.daftar. */
    public function titik(): ?string
    {
        $t = $this->aturan()['titik'] ?? null;

        return is_string($t) ? $t : null;
    }

    /** @return list<array<string, mixed>> tiap item: id (UUID aturan), nama, pesan */
    public function pelanggaran(): array
    {
        $p = $this->aturan()['pelanggaran'] ?? null;

        return is_array($p) ? array_values($p) : [];
    }

    /** @return array<string, mixed> mis. ['sks_diambil' => ['op' => '<=', 'nilai' => 21]] */
    public function batas(): array
    {
        $b = $this->aturan()['batas'] ?? null;

        return is_array($b) ? $b : [];
    }
}
