<?php

namespace App\Models\Payer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Payer
 * @package App\Models\Payer
 */
class User extends Model
{
    /**
     * Get the user that owns the wallet.
     *
     * @return HasOne
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
}
