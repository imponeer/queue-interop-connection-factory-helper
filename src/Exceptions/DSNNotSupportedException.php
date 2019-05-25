<?php

namespace Imponeer\QueueInteropConnectionFactoryHelper\Exceptions;

/**
 * Exception raised when helper can't find possible connection factory from DSN
 *
 * @package Imponeer\QueueInteropConnectionFactoryHelper\Exceptions
 */
class DSNNotSupportedException extends \Exception
{

    /**
     * QueueFactoryDSNNotSupportedException constructor.
     *
     * @param string $driver Driver
     * @param int $code Error code
     * @param Exception|null $previous Previous exception
     */
    public function __construct($driver, $code = 0, Exception $previous = null)
    {
        parent::__construct("$driver is not supported", $code, $previous);
    }

}