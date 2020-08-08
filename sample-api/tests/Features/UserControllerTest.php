<?php

use App\Models\Payer\User;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * Class UserControllerTest
 */
class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetAllUsers()
    {
        $response = $this->json('get', '/api/v1/users');

        $response->assertResponseOk();
    }

    public function testNotFoundUser()
    {
        $response = $this->json('get', '/api/v1/user/123');

        $response->seeJsonEquals(['message' => 'payer not found'])->assertResponseStatus(404);
    }

    public function testFindUser()
    {
        $user = factory(User::class)->create([
            'name' => 'Abigail',
        ]);

        $response = $this->json('get', '/api/v1/user/' . $user->id);

        $response->seeJsonEquals(['id' => $user->id, 'name' => $user->name])->assertResponseOk();
    }

    public function testCreateUser()
    {
        $response = $this->json('post', '/api/v1/user/');

        $response->seeJsonEquals(['message' => 'work in progress'])->assertResponseOk();
    }

    public function testUpdateUser()
    {
        $response = $this->json('put', '/api/v1/user/1');

        $response->seeJsonEquals(['message' => 'work in progress'])->assertResponseOk();
    }
}
