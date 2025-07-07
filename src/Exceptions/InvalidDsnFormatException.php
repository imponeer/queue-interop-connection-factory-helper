<?php

declare(strict_types=1);

namespace Imponeer\QueueInteropConnectionFactoryHelper\Exceptions;

use RuntimeException;
use Throwable;

class InvalidDsnFormatException extends RuntimeException
{

	public function __construct(int $code = 0, ?Throwable $previous = null)
	{
		parent::__construct('Invalid DSN exception', $code, $previous);
	}

}