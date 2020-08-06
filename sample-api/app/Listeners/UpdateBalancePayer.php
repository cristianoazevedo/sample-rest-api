<?php

namespace App\Listeners;

use App\Events\TransactionSaved;

class UpdateBalancePayer
{
    /**
     * @param TransactionSaved $event
     */
    public function handle(TransactionSaved $event)
    {
        $payer = $event->transaction->payer();
        $wallet = $payer->getRelation('wallet')->where('user_id', $payer->value('id'));
        $value = floatval($event->transaction->value);

        $newBalance = floatval($wallet->value('balance')) - $value;

        $wallet->update(['balance' => $newBalance]);
    }
}
