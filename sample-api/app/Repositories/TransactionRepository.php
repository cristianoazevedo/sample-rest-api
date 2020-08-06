<?php

namespace App\Repositories;

use App\Models\Payer\User;
use App\Models\Transactions;

/**
 * Class TransactionRepository
 * @package App\Repositories
 */
class TransactionRepository
{
    /**
     * @va string
     */
    const PENDING = 'pending';

    /**
     * @var Transactions
     */
    private $model;

    public function __construct(Transactions $model)
    {
        $this->model = $model;
    }

    /**
     * @param User $payer
     * @param User $payee
     * @param float $value
     * @return mixed
     */
    public function save(User $payer, User $payee, float $value)
    {
        $transaction = new $this->model();

        $transaction->payer_user = $payer->id;
        $transaction->payee_user = $payee->id;
        $transaction->value = $value;
        $transaction->status = self::PENDING;
        $transaction->notified = self::PENDING;

        $transaction->save();

        return $transaction;
    }
}
