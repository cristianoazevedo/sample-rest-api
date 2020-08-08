<?php

use App\Exceptions\NotificationUserException;
use App\Jobs\NotifyUser;
use App\Models\Payer\User;
use App\Models\Payer\Wallet;
use App\Models\Transaction\CashOut;
use App\Services\NotificationService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Http;
use Laravel\Lumen\Testing\DatabaseTransactions;

class NotifyUserTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccessNotification()
    {
        $transactionService = app(TransactionService::class);
        $notificationService = app(NotificationService::class);

        $payer = factory(User::class)->create(['document' => '45106691001', 'document_type' => 'CPF']);
        $payer->wallet()->save(factory(Wallet::class)->make(['balance' => 100]));

        $payee = factory(User::class)->create();
        $payee->wallet()->save(factory(Wallet::class)->make(['balance' => 10]));

        $transaction = $transactionService->create($payer->id, $payer->id, 10);

        $job = app(NotifyUser::class);
        $cashOut = $transaction->cashOut()->get()->first();
        $job->paymentTransaction = $cashOut;
        $job->handle($notificationService);

        $job = app(NotifyUser::class);
        $cashIn = $transaction->cashIn()->get()->first();
        $job->paymentTransaction = $cashIn;
        $job->handle($notificationService);

        $this->assertEquals(CashOut::FINISHED, $cashOut->notified);
        $this->assertEquals(CashOut::FINISHED, $cashIn->notified);
    }

    public function testNotificationFail()
    {
        Http::fake(function ($request) {
            return Http::response(['message' => 'service is wrong'], 500);
        });

        $this->expectException(NotificationUserException::class);

        $cashOut = \Mockery::mock(CashOut::class);
        $notificationService = app(NotificationService::class);

        $job = app(NotifyUser::class);
        $job->paymentTransaction = $cashOut;

        $job->handle($notificationService);
    }
}
