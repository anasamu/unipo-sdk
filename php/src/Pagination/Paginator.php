<?php

declare(strict_types=1);

namespace Unipo\Siakad\Pagination;

use Unipo\Siakad\Http\ApiResponse;

/**
 * Iterasi semua item dari endpoint daftar, halaman demi halaman (lazy: halaman diambil saat dibutuhkan).
 *
 *     foreach ($siakad->paginate(fn ($q) => $siakad->mahasiswa()->list($q), ['prodi' => '86206']) as $mhs) { ... }
 *
 * @implements \IteratorAggregate<int, mixed>
 */
final class Paginator implements \IteratorAggregate
{
    /**
     * @param callable(array<string, mixed>): ApiResponse $fetchPage
     * @param array<string, mixed> $query
     */
    public function __construct(private readonly mixed $fetchPage, private readonly array $query = [])
    {
    }

    /** @return \Generator<int, ApiResponse> */
    public function pages(): \Generator
    {
        $perPage = (int) ($this->query['per_page'] ?? 100);
        for ($page = (int) ($this->query['page'] ?? 1); ; $page++) {
            $response = ($this->fetchPage)(['page' => $page, 'per_page' => $perPage] + $this->query);
            yield $response;
            $items = is_array($response->data()) ? $response->data() : [];
            $total = $response->meta()['total_pages'] ?? null;
            if ($items === [] || (is_int($total) ? $page >= $total : count($items) < $perPage)) {
                return;
            }
        }
    }

    public function getIterator(): \Generator
    {
        foreach ($this->pages() as $response) {
            foreach ((is_array($response->data()) ? $response->data() : []) as $item) {
                yield $item;
            }
        }
    }

    /** @return list<mixed> semua item; $limit mencegah memori habis */
    public function all(int $limit = 10000): array
    {
        $out = [];
        foreach ($this as $item) {
            $out[] = $item;
            if (count($out) >= $limit) {
                break;
            }
        }

        return $out;
    }
}
