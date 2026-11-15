<?php

declare(strict_types=1);

namespace Unipo\Siakad\Webhook;

/** Tanda tangan webhook SIAKAD tidak sah, kedaluwarsa, atau isinya rusak. */
final class WebhookSignatureException extends \RuntimeException
{
}
