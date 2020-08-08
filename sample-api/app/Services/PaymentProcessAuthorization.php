<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Class PaymentProcessAuthorization
 * @package App\Services
 */
class PaymentProcessAuthorization
{
    private const URL = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';
    /**
     * @var Response
     */
    private Response $response;

    /**
     * PaymentProcessAuthorization constructor.
     */
    public function __construct()
    {
        Http::fake(function ($request) {
            return Http::response(['message' => 'Autorizado'], 200);
        });
    }

    /**
     * @return void
     */
    public function process(): void
    {
        $this->response = Http::get(self::URL);
    }

    /**
     * @return bool
     */
    public function isRejected()
    {
        return !$this->response->successful();
    }

    /**
     * @return string
     */
    public function reason(): string
    {
        return $this->response->json()['message'] ?? 'unknown';
    }
}
