<?php

declare(strict_types=1);

namespace Unipo\Siakad\Http;

/** File dari endpoint unduhan (jawaban bukan JSON). */
final class DownloadedFile
{
    public function __construct(
        public readonly string $contents,
        public readonly string $contentType,
        public readonly ?string $filename = null,
    ) {
    }

    public function size(): int
    {
        return strlen($this->contents);
    }

    /** Simpan ke disk. Bila $path folder, nama file dari server dipakai. Mengembalikan path file. */
    public function saveTo(string $path): string
    {
        if (is_dir($path)) {
            $name = basename(str_replace('\\', '/', $this->filename ?? 'unduhan'));
            $path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . ($name !== '' ? $name : 'unduhan');
        }
        if (file_put_contents($path, $this->contents) === false) {
            throw new \RuntimeException('Gagal menyimpan file ke ' . $path);
        }

        return $path;
    }

    /** @return array{filename: string|null, content_type: string, size: int} */
    public function toArray(): array
    {
        return ['filename' => $this->filename, 'content_type' => $this->contentType, 'size' => $this->size()];
    }

    public function __toString(): string
    {
        return $this->contents;
    }
}
