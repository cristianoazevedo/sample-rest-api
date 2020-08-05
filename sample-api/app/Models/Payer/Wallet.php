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
     * Get the user record associated with the user.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wallet';
}
