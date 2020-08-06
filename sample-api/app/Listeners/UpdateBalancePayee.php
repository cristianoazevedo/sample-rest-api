<?php

namespace App\Listeners;

use App\Events\TransactionSaved;

class UpdateBalancePayee
{
    /**
     * @param TransactionSaved $event
     */
    public function handle(TransactionSaved $event)
    {
        $payee = $event->transaction->payee();
        $wallet = $payee->getRelation('wallet')->where('user_id', $payee->value('id'));
        $value = $event->transaction->value;

        $newBalance = floatval($wallet->value('balance')) + $value;

        $wallet->update(['balance' => $newBalance]);

    }
}
