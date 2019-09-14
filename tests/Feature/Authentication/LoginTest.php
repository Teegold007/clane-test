<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginRequiresEmailAndPassword()
    {
        $this->json('POST', 'api/v1/login')
            ->assertStatus(422)
            ;
    }


    public function testUserLoginsSuccessfully()
    {
        $payload = ['email' => 'clane@test.com', 'password' => '123456'];

        $this->json('POST', 'api/v1/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

    }
}
