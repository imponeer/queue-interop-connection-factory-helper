<?php

declare(strict_types=1);

namespace Imponeer\QueueInteropConnectionFactoryHelper\Exceptions;

use RuntimeException;
use Throwable;

class ComposerPackageMissingException extends RuntimeException
{
    public function __construct(
        public readonly array $composerPackages,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        $message = 'At least one of the following Composer packages is required: ' . implode(', ', $composerPackages);

        parent::__construct($message, $code, $previous);
    }
}
