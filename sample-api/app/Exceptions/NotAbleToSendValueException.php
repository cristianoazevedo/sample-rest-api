<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class NotAbleToSendValueException
 * @package App\Exceptions
 */
class NotAbleToSendValueException extends TransactionException
{
    /**
     * NotAbleToSendValueException constructor.
     */
    public function __construct()
    {
        parent::__construct('NOT_ABLE_TO_SEND_VALUE', Response::HTTP_NOT_FOUND);
    }
}
