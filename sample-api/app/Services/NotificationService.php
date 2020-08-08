<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Class NotificationService
 * @package App\Services
 */
class NotificationService
{
    /**
     * @var string
     */
    private const URL = 'https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04';

    /**
     * @var Response
     */
    private Response $response;

    /**
     * NotificationService constructor.
     */
    public function __construct()
    {
        Http::fake(function ($request) {
            return Http::response(['message' => 'Enviado'], 200);
        });
    }

    /**
     * @return void
     */
    public function notify(): void
    {
        $this->response = Http::get(self::URL);
    }

    /**
     * @return bool
     */
    public function isNotNotified(): bool
    {
        return !$this->response->successful();
    }

    /**
     * @return int
     */
    public function statusCode(): int
    {
        return $this->response->status();
    }
}
