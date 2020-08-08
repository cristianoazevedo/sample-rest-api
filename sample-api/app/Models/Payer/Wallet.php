<?php

namespace App\Models\Payer;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Wallet
 * @package App\Models\Payer
 */
class Wallet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wallet';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'balance' => 'float',
    ];

    /**
     * @param float $value
     */
    public function add(float $value): void
    {
        $this->balance += $value;
    }

    public function subtract(float $value): void
    {
        $this->balance -= $value;
    }

    /**
     * @param float $value
     * @return bool
     */
    public function balanceLessThan(float $value): bool
    {
        return $this->balance < $value;
    }

}
