<?php

namespace App\Listeners;

use App\Events\TransactionSaved;
use App\Jobs\NotifyUser;
use App\Models\Payer\User;
use App\Models\Payer\Wallet;
use App\Models\Transaction\CashOut;

/**
 * Class CashOutProcess
 * @package App\Listeners
 */
class CashOutProcess
{
    /**
     * @param TransactionSaved $event
     */
    public function handle(TransactionSaved $event)
    {
        /* @var CashOut $cashOut */
        $cashOut = $event->transaction->cashOut;
        /* @var User $payer */
        $payer = $cashOut->user;
        /* @var Wallet $wallet */
        $wallet = $payer->wallet;

        $wallet->subtract($event->transaction->value);
        $wallet->save();

        $cashOut->finished();
        $cashOut->save();

        dispatch(new NotifyUser($cashOut));
    }
}
