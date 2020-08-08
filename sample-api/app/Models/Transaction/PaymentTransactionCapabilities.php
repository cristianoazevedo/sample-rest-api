<?php

namespace App\Models\Transaction;

use App\Models\Payer\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait PaymentTransactionCapabilities
{
    /**
     * @return void
     */
    public function make(): void
    {
        $this->status = self::PENDING;
        $this->notified = self::PENDING;
    }

    /**
     * @return void
     */
    public function finished(): void
    {
        $this->status = self::FINISHED;
    }

    /**
     * @return void
     */
    public function notified(): void
    {
        $this->notified = self::FINISHED;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
