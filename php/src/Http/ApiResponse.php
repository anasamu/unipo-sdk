<?php

declare(strict_types=1);

namespace Unipo\Siakad\Http;

/**
 * Hasil pemanggilan endpoint. Isi `data` bisa diakses langsung seperti array:
 *
 *     $r = $siakad->mahasiswa()->getByNim('2025001');
 *     $r['nama'];            // sama dengan $r->data()['nama']
 *     foreach ($r as $row)   // untuk endpoint daftar
 *     $r->meta()['total'];   // endpoint berhalaman
 *
 * @implements \ArrayAccess<array-key, mixed>
 * @implements \IteratorAggregate<array-key, mixed>
 */
final class ApiResponse implements \ArrayAccess, \IteratorAggregate, \Countable, \JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     * @param array<string, string> $headers nama header huruf kecil
     */
    public function __construct(
        private readonly mixed $data,
        private readonly ?array $meta,
        private readonly int $status,
        private readonly array $headers,
    ) {
    }

    /** Isi `data` dari jawaban API (array, nilai skalar, null, atau DownloadedFile untuk unduhan). */
    public function data(): mixed
    {
        return $this->data;
    }

    /** @return array<string, mixed>|null page, per_page, total, total_pages untuk endpoint daftar */
    public function meta(): ?array
    {
        return $this->meta;
    }

    public function status(): int
    {
        return $this->status;
    }

    /** @return array<string, string> */
    public function headers(): array
    {
        return $this->headers;
    }

    public function header(string $name): ?string
    {
        return $this->headers[strtolower($name)] ?? null;
    }

    /** ID permintaan (X-Request-Id). */
    public function requestId(): ?string
    {
        return $this->header('x-request-id');
    }

    /** Lingkungan database yang melayani: live atau development (X-Siakad-Lingkungan). */
    public function environment(): ?string
    {
        return $this->header('x-siakad-lingkungan');
    }

    /** True bila ada halaman berikutnya (endpoint berhalaman). */
    public function hasMorePages(): bool
    {
        $page = (int) ($this->meta['page'] ?? 0);
        $total = (int) ($this->meta['total_pages'] ?? 0);

        return $page > 0 && $page < $total;
    }

    /** Ubah data jadi Collection Laravel (bila tersedia). */
    public function collect(): mixed
    {
        if (!function_exists('collect')) {
            throw new \LogicException('Fungsi collect() hanya ada di Laravel / illuminate/collections.');
        }

        return collect(is_array($this->data) ? $this->data : [$this->data]);
    }

    /** @return array{data: mixed, meta?: array<string, mixed>} */
    public function toArray(): array
    {
        $out = ['data' => $this->data instanceof DownloadedFile ? $this->data->toArray() : $this->data];
        if ($this->meta !== null) {
            $out['meta'] = $this->meta;
        }

        return $out;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function offsetExists(mixed $offset): bool
    {
        return is_array($this->data) && array_key_exists($offset, $this->data);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return is_array($this->data) ? ($this->data[$offset] ?? null) : null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \LogicException('ApiResponse tidak bisa diubah.');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \LogicException('ApiResponse tidak bisa diubah.');
    }

    /** @return \ArrayIterator<array-key, mixed> */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator(is_array($this->data) ? $this->data : []);
    }

    public function count(): int
    {
        return is_array($this->data) ? count($this->data) : 0;
    }
}
