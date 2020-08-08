<?php

namespace App\Providers;

use App\Events\TransactionSaved;
use App\Listeners\CashInProcess;
use App\Listeners\CashOutProcess;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TransactionSaved::class => [
            CashOutProcess::class,
            CashInProcess::class,
        ]
    ];
}
