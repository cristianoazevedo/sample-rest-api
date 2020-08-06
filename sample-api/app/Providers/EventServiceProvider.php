<?php

namespace App\Providers;

use App\Events\TransactionSaved;
use App\Listeners\UpdateBalancePayee;
use App\Listeners\UpdateBalancePayer;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TransactionSaved::class => [
            UpdateBalancePayer::class,
            UpdateBalancePayee::class,
        ],
    ];
}
