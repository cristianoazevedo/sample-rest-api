<?php

namespace App\Models;

use App\Events\TransactionSaved;
use App\Models\Payer\User;
use App\Models\Payer\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Transaction
 * @package App\Models
 */
class Transactions extends Model
{
    /**
     * @return BelongsTo
     */
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_user');
    }

    /**
     * @return BelongsTo
     */
    public function payee()
    {
        return $this->belongsTo(User::class, 'payee_user');
    }

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => TransactionSaved::class,
    ];
}
