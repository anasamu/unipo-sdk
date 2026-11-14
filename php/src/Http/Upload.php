<?php

declare(strict_types=1);

namespace Unipo\Siakad\Http;

use Psr\Http\Message\StreamInterface;

/**
 * Berkas untuk field unggahan (multipart):
 *
 *     $siakad->arsip()->postSuratByRefFile('S-1', ['berkas' => Upload::fromPath('/tmp/surat.pdf'), 'peran' => 'utama']);
 *
 * Di Laravel, \Illuminate\Http\UploadedFile (turunan SplFileInfo) bisa langsung dipakai.
 */
final class Upload
{
    /** @param resource|string|StreamInterface $contents */
    private function __construct(
        public readonly mixed $contents,
        public readonly string $filename,
        public readonly ?string $contentType = null,
    ) {
    }

    public static function fromPath(string $path, ?string $filename = null, ?string $contentType = null): self
    {
        if (!is_file($path) || !is_readable($path)) {
            throw new \InvalidArgumentException('File tidak bisa dibaca: ' . $path);
        }
        $handle = fopen($path, 'rb');
        if ($handle === false) {
            throw new \InvalidArgumentException('File tidak bisa dibuka: ' . $path);
        }

        return new self($handle, $filename ?? basename($path), $contentType ?? (function_exists('mime_content_type') ? (mime_content_type($path) ?: null) : null));
    }

    public static function fromString(string $contents, string $filename, ?string $contentType = null): self
    {
        return new self($contents, $filename, $contentType);
    }

    /** @param resource|StreamInterface $stream */
    public static function fromStream(mixed $stream, string $filename, ?string $contentType = null): self
    {
        return new self($stream, $filename, $contentType);
    }

    /** Ubah nilai field menjadi Upload bila nilainya berkas (Upload, SplFileInfo, resource). */
    public static function tryFrom(mixed $value): ?self
    {
        if ($value instanceof self) {
            return $value;
        }
        if ($value instanceof \SplFileInfo) {
            $name = method_exists($value, 'getClientOriginalName') ? (string) $value->getClientOriginalName() : $value->getFilename();
            $type = method_exists($value, 'getClientMimeType') ? (string) $value->getClientMimeType() : null;

            return self::fromPath($value->getPathname(), $name, $type);
        }
        if (is_resource($value)) {
            /** @var array<string, mixed> $meta kunci uri tidak selalu ada (bergantung jenis stream dan versi PHP) */
            $meta = stream_get_meta_data($value);

            return new self($value, basename((string) ($meta['uri'] ?? 'berkas')));
        }
        if ($value instanceof StreamInterface) {
            return new self($value, basename((string) ($value->getMetadata('uri') ?? 'berkas')));
        }

        return null;
    }
}
