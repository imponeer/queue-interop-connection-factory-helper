<?php

declare(strict_types=1);

namespace Imponeer\QueueInteropConnectionFactoryHelper\Exceptions;

use Exception;

/**
 * Exception thrown when DSN was empty
 *
 * @package Imponeer\QueueInteropConnectionFactoryHelper\Exceptions
 */
final class EmptyDsnException extends Exception
{
    /**
     * EmptyDSNException constructor.
     *
     * @param int $code Error code
     * @param Exception|null $previous Previous exception
     */
    public function __construct(
        int $code = 0,
        ?Exception $previous = null
    ) {
        parent::__construct('DSN cannot be empty', $code, $previous);
    }
}