<?php

namespace App\Exceptions;

use Throwable;

/**
 * Class TransactionException
 * @package App\Exceptions
 */
class TransactionException extends ApplicationException
{
    /**
     * TransactionException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
