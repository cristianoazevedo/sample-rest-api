<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class PaymentRejectedException
 * @package App\Exceptions
 */
class PaymentRejectedException extends TransactionException
{
    /**
     * PaymentRejectedException constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
