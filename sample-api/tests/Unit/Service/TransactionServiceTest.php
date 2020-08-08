<?php

use App\Events\TransactionSaved;
use App\Listeners\CashInProcess;
use App\Listeners\CashOutProcess;
use App\Models\Payer\User;
use App\Models\Payer\Wallet;
use App\Services\TransactionService;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TransactionServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateTransaction()
    {
        $cashInProcessListener = app()->make(CashInProcess::class);
        $cashOutProcessListener = app()->make(CashOutProcess::class);
        $event = \Mockery::mock(TransactionSaved::class);

        $payer = factory(User::class)->create(['document' => '45106691001', 'document_type' => 'CPF']);
        $payer->wallet()->save(factory(Wallet::class)->make(['balance' => 100]));

        $payee = factory(User::class)->create();
        $payee->wallet()->save(factory(Wallet::class)->make(['balance' => 10]));

        $service = app(TransactionService::class);

        $transaction = $service->create($payer->id, $payer->id, 10);

        $event->transaction = $transaction;

        $cashInProcessListener->handle($event);
        $cashOutProcessListener->handle($event);

        $this->assertInstanceOf(App\Models\Transaction\Transactions::class, $transaction);
    }
}
