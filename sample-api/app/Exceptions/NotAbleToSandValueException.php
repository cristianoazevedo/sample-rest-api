<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class NotAbleToSandValueException
 * @package App\Exceptions
 */
class NotAbleToSandValueException extends TransactionException
{
    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('payer not able to sand value', Response::HTTP_NOT_FOUND);
    }
}
