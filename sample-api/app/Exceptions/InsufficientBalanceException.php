<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class InsufficientBalanceException
 * @package App\Exceptions
 */
class InsufficientBalanceException extends TransactionException
{
    /**
     * InsufficientBalanceException constructor.
     */
    public function __construct()
    {
        parent::__construct('INSUFFICIENT_BALANCE', Response::HTTP_NOT_FOUND);
    }
}
