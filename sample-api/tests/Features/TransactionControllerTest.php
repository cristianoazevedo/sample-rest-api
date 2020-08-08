<?php

use App\Events\TransactionSaved;
use App\Models\Payer\User;
use App\Models\Payer\Wallet;
use Illuminate\Support\Facades\Http;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * Class TransactionControllerTest
 */
class TransactionControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateTransactionWithTheSameUser()
    {
        $body = [
            'value' => 10.00,
            'payer' => 1,
            'payee' => 1
        ];

        $response = $this->json('post', '/api/v1/transaction', $body);

        $response->seeJsonEquals(['payee' => ['The payee and payer must be different.']])->assertResponseStatus(422);
    }

    public function testCreateTransactionWithPayerWithoutBalance()
    {
        $payer = factory(User::class)->create(['document' => '45106691001', 'document_type' => 'CPF']);
        $payer->wallet()->save(factory(Wallet::class)->make(['balance' => 0]));

        $payee = factory(User::class)->create();
        $payee->wallet()->save(factory(Wallet::class)->make(['balance' => 10]));

        $body = [
            'value' => 10.00,
            'payer' => $payer->id,
            'payee' => $payee->id
        ];

        $response = $this->json('post', '/api/v1/transaction', $body);

        $response->seeJsonEquals(['message' => 'INSUFFICIENT_BALANCE'])->assertResponseStatus(404);
    }

    public function testCreateTransactionWithValueLessThanAllowed()
    {
        $payer = factory(User::class)->create(['document' => '45106691001', 'document_type' => 'CPF']);
        $payer->wallet()->save(factory(Wallet::class)->make(['balance' => 100]));

        $payee = factory(User::class)->create();
        $payee->wallet()->save(factory(Wallet::class)->make(['balance' => 10]));

        $body = [
            'value' => 0.90,
            'payer' => $payer->id,
            'payee' => $payee->id
        ];

        $response = $this->json('post', '/api/v1/transaction', $body);

        $response->seeJsonEquals(['value' => ['The value must be at least 1.']])->assertResponseStatus(422);
    }

    public function testCreateTransactionWithPayerNotAllowed()
    {
        $payer = factory(User::class)->create(['document' => '57664919000105', 'document_type' => 'CNPJ']);
        $payer->wallet()->save(factory(Wallet::class)->make(['balance' => 0]));

        $payee = factory(User::class)->create();
        $payee->wallet()->save(factory(Wallet::class)->make(['balance' => 10]));

        $body = [
            'value' => 10.00,
            'payer' => $payer->id,
            'payee' => $payee->id
        ];

        $response = $this->json('post', '/api/v1/transaction', $body);

        $response->seeJsonEquals(['message' => 'NOT_ABLE_TO_SEND_VALUE'])->assertResponseStatus(404);
    }

    public function testTransactionPaymentProcessFail()
    {
        Http::fake(function ($request) {
            return Http::response(['message' => 'ERR'], 500);
        });

        $this->withoutEvents();

        $payer = factory(User::class)->create(['document' => '45106691001', 'document_type' => 'CPF']);
        $payer->wallet()->save(factory(Wallet::class)->make(['balance' => 100]));

        $payee = factory(User::class)->create();
        $payee->wallet()->save(factory(Wallet::class)->make(['balance' => 10]));

        $body = [
            'value' => 10.00,
            'payer' => $payer->id,
            'payee' => $payee->id
        ];

        $response = $this->json('post', '/api/v1/transaction', $body);

        $response->seeJsonEquals(['message' => 'ERR'])->assertResponseStatus(404);
    }

    public function testTransactionFully()
    {
        $this->expectsEvents(TransactionSaved::class);

        $payer = factory(User::class)->create(['document' => '45106691001', 'document_type' => 'CPF']);
        $payer->wallet()->save(factory(Wallet::class)->make(['balance' => 100]));

        $payee = factory(User::class)->create();
        $payee->wallet()->save(factory(Wallet::class)->make(['balance' => 10]));

        $body = [
            'value' => 10.00,
            'payer' => $payer->id,
            'payee' => $payee->id
        ];

        $response = $this->json('post', '/api/v1/transaction', $body);

        $response->assertResponseStatus(201);
    }
}
