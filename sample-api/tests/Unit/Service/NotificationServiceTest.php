<?php

use App\Services\NotificationService;
use Illuminate\Support\Facades\Http;

class NotificationServiceTest extends TestCase
{
    public function testNotificationFail()
    {
        Http::fake(function ($request) {
            return Http::response(['message' => 'service is wrong'], 500);
        });

        $notificationService = app(NotificationService::class);
        $notificationService->notify();

        $this->assertTrue($notificationService->isNotNotified());
        $this->assertEquals(500, $notificationService->statusCode());
    }
}
