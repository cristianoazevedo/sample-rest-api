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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    /**
     * @return bool
     */
    public function isNotAbleToSendValue(): bool
    {
        return $this->document_type == 'CNPJ';
    }

    /**
     * @param $value
     * @return mixed
     */
    public function isOutOfBalance($value): bool
    {
        return $this->wallet->balanceLessThan($value);
    }
}
