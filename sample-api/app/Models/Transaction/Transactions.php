<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Transaction
 * @package App\Models
 */
class Transactions extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'float',
    ];

    /**
     * @return HasOne
     */
    public function cashIn(): HasOne
    {
        return $this->hasOne(CashIn::class, 'transaction_id');
    }

    /**
     * @return HasOne
     */
    public function cashOut(): HasOne
    {
        return $this->hasOne(CashOut::class, 'transaction_id');
    }
}
