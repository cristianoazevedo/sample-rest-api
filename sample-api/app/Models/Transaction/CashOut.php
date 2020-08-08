<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CashOut
 * @package App\Models\Transaction
 */
class CashOut extends Model implements PaymentTransaction
{
    use PaymentTransactionCapabilities;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cash_out';
    /**
     * @var string[]
     */
    protected $fillable = ['user_id'];

    /**
     * @va string
     */
    const PENDING = 'pending';
    /**
     * @var string
     */
    const FINISHED = 'finished';
}
