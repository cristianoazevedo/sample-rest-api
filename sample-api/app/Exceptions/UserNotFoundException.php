<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotFoundException
 * @package App\Exceptions
 */
class UserNotFoundException extends ApplicationException
{
    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('payer not found', Response::HTTP_NOT_FOUND);
    }
}
