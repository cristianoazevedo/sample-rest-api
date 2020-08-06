<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InsufficientBalanceException extends TransactionException
{
    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('payer with insufficient balance', Response::HTTP_NOT_FOUND);
    }
}
