<?php

namespace App\Jobs;

use App\Exceptions\NotificationUserException;
use App\Models\Transaction\PaymentTransaction;
use App\Services\NotificationService;

/**
 * Class NotifyUser
 * @package App\Jobs
 */
class NotifyUser extends Job
{
    /**
     * @var PaymentTransaction
     */
    public PaymentTransaction $paymentTransaction;

    /**
     * NotifyUser constructor.
     * @param PaymentTransaction $paymentTransaction
     */
    public function __construct(PaymentTransaction $paymentTransaction)
    {
        $this->paymentTransaction = $paymentTransaction;
    }

    /**
     * @param NotificationService $notificationService
     * @throws NotificationUserException
     */
    public function handle(NotificationService $notificationService)
    {
        $notificationService->notify();

        if ($notificationService->isNotNotified()) {
            throw new NotificationUserException($notificationService->statusCode());
        }

        $this->paymentTransaction->notified();
        $this->paymentTransaction->update();
    }
}
