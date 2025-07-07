<?php

declare(strict_types=1);

namespace Imponeer\QueueInteropConnectionFactoryHelper\Exceptions;

use Exception;

/**
 * Exception raised when helper can't find possible connection factory from DSN
 *
 * @package Imponeer\QueueInteropConnectionFactoryHelper\Exceptions
 */
final class DSNNotSupportedException extends Exception
{
    /**
     * DSNNotSupportedException constructor.
     *
     * @param string $driver Driver that is not supported
     * @param int $code Error code
     * @param Exception|null $previous Previous exception
     */
    public function __construct(
        public readonly string $driver,
        int $code = 0,
        ?Exception $previous = null
    ) {
        parent::__construct("Driver '{$this->driver}' is not supported", $code, $previous);
    }
}
