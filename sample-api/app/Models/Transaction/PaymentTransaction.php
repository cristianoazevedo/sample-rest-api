<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Interface PaymentTransaction
 * @package App\Models\Transaction
 */
interface PaymentTransaction
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo;

    /**
     * @return void
     */
    public function finished(): void;

    /**
     * @return void
     */
    public function notified(): void;
}
