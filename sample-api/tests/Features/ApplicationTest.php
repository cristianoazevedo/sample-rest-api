<?php

/**
 * Class ApplicationTest
 */
class ApplicationTest extends TestCase
{
    public function testVersion()
    {
        $response = $this->get('/');

        $response->seeJsonEquals(['name' => 'xpto', 'version' => '1.0.0'])->assertResponseOk();
    }

    public function testInvalidResource()
    {
       env('APP_DEBUG', true);

        $response = $this->get('/xpto');

        $response->assertResponseStatus(500);
    }
}
