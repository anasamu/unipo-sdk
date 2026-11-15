<?php

declare(strict_types=1);

namespace Unipo\Siakad\Exceptions;

/**
 * Induk semua galat SDK. Cukup satu catch:
 *
 *     try { ... } catch (ValidationException $e) { $e->fields(); }
 *     catch (SiakadException $e) { logger()->error($e->getMessage(), ['request_id' => $e->requestId()]); }
 */
class SiakadException extends \RuntimeException
{
    /**
     * @param array<string, mixed> $details
     * @param array<string, string> $headers nama header huruf kecil
     */
    public function __construct(
        string $message,
        private readonly int $status = 0,
        private readonly string $errorCode = 'error',
        private readonly array $details = [],
        private readonly ?string $requestId = null,
        private readonly array $headers = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $status, $previous);
    }

    /** Kode HTTP (0 bila tidak sampai ke server). */
    public function status(): int
    {
        return $this->status;
    }

    /** Kode galat dari API, mis. insufficient_scope, validation_failed. */
    public function errorCode(): string
    {
        return $this->errorCode;
    }

    /** @return array<string, mixed> */
    public function details(): array
    {
        return $this->details;
    }

    /** ID permintaan (header X-Request-Id); sertakan saat melapor ke Pustikom. */
    public function requestId(): ?string
    {
        return $this->requestId;
    }

    /** @return array<string, string> */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Membuat kelas galat yang sesuai dengan kode HTTP.
     *
     * @param array<string, mixed> $details
     * @param array<string, string> $headers
     */
    public static function fromStatus(int $status, string $message, string $code, array $details = [], ?string $requestId = null, array $headers = []): self
    {
        $class = match (true) {
            $status === 400 => BadRequestException::class,
            $status === 401 => AuthenticationException::class,
            $status === 403 => PermissionException::class,
            $status === 404 => NotFoundException::class,
            $status === 405 => MethodNotAllowedException::class,
            $status === 409 && $code === 'aturan_dilanggar' => AturanDilanggarException::class,
            $status === 409 => ConflictException::class,
            $status === 413, $status === 415 => PayloadException::class,
            $status === 422 => ValidationException::class,
            $status === 429 => RateLimitException::class,
            $status >= 500 => ServerException::class,
            default => self::class,
        };

        return new $class($message, $status, $code, $details, $requestId, $headers);
    }
}
