<?php

namespace App\Repositories;

use App\Models\Payer\User;
use App\Models\Transaction\CashOut;
use App\Models\Transaction\CashIn;
use App\Models\Transaction\Transactions;

/**
 * Class TransactionRepository
 * @package App\Repositories
 */
class TransactionRepository
{
    /**
     * @var Transactions
     */
    private Transactions $model;

    /**
     * TransactionRepository constructor.
     * @param Transactions $model
     */
    public function __construct(Transactions $model)
    {
        $this->model = $model;
    }

    /**
     * @param User $payer
     * @param User $payee
     * @param float $value
     * @return Transactions
     */
    public function save(User $payer, User $payee, float $value): Transactions
    {
        $this->model->value = $value;

        $this->model->save();

        $cashOut = $this->makeCashOut();
        $cashOut->user()->associate($payer);

        $cashIn = $this->makeCashIn();
        $cashIn->user()->associate($payee);

        $this->model->cashIn()->save($cashIn);
        $this->model->cashOut()->save($cashOut);

        return $this->model;
    }

    /**
     * @return CashIn
     */
    private function makeCashIn(): CashIn
    {
        $cashIn = new CashIn();
        $cashIn->make();
        return $cashIn;
    }

    /**
     * @return CashOut
     */
    private function makeCashOut(): CashOut
    {
        $cashOut = new CashOut();
        $cashOut->make();
        return $cashOut;
    }
}
