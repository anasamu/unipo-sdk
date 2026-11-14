<?php

declare(strict_types=1);

namespace Unipo\Siakad\Resources;

use Unipo\Siakad\Http\ApiResponse;
use Unipo\Siakad\Siakad;

/** Induk kelas modul (hasil generator). */
abstract class Resource
{
    public function __construct(protected readonly Siakad $client)
    {
    }

    /**
     * @param array<string, int|string> $pathParams
     * @param array<string, mixed> $query
     * @param array<string, mixed>|null $body
     * @param array<string, mixed> $options
     */
    protected function send(string $method, string $path, array $pathParams, array $query, ?array $body, array $options, bool $multipart, bool $public): ApiResponse
    {
        return $this->client->send($method, $path, $pathParams, $query, $body, $options, $multipart, $public);
    }
}
