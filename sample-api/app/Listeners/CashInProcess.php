<?php

namespace App\Listeners;

use App\Events\TransactionSaved;
use App\Jobs\NotifyUser;
use App\Models\Payer\User;
use App\Models\Payer\Wallet;
use App\Models\Transaction\CashIn;

/**
 * Class CashInProcess
 * @package App\Listeners
 */
class CashInProcess
{
    /**
     * @param TransactionSaved $event
     */
    public function handle(TransactionSaved $event)
    {
        /* @var CashIn $cashIn */
        $cashIn = $event->transaction->cashIn;
        /* @var User $payee */
        $payee = $cashIn->user;
        /* @var Wallet $wallet */
        $wallet = $payee->wallet;

        $wallet->add($event->transaction->value);
        $wallet->save();

        $cashIn->finished();
        $cashIn->save();

        dispatch(new NotifyUser($cashIn));
    }
}
