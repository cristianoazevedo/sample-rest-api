<?php

namespace App\Providers;

use App\Models\Transaction\CashIn;
use App\Models\Transaction\CashOut;
use App\Models\Transaction\PaymentTransaction;
use Illuminate\Support\ServiceProvider;

/**
 * Class JobServiceProvider
 * @package App\Providers
 */
class JobServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PaymentTransaction::class, CashIn::class);
        $this->app->bind(PaymentTransaction::class, CashOut::class);
    }
}
