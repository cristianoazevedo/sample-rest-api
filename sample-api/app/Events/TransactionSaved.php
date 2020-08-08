<?php

namespace App\Events;

use App\Models\Transaction\Transactions;

/**
 * Class TransactionSaved
 * @package App\Events
 */
class TransactionSaved extends Event
{
    /**
     * @var Transactions
     */
    public $transaction;

    /**
     * TransactionSaved constructor.
     * @param Transactions $transaction
     */
    public function __construct(Transactions $transaction)
    {
        $this->transaction = $transaction;
    }
}
