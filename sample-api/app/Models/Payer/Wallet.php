<?php

namespace App\Models\Payer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Get the user record associated with the wallet.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param float $value
     * @return bool
     */
    public function balanceLessThan(float $value)
    {
        return floatval($this->balance) < $value;
    }

}
