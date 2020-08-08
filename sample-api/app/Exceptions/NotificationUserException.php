<?php

namespace App\Exceptions;

use Throwable;

/**
 * Class NotificationUserException
 * @package App\Exceptions
 */
class NotificationUserException extends \Exception
{
    /**
     * NotificationUserException constructor.
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        parent::__construct('unable to notify user', $code, $previous);
    }
}
