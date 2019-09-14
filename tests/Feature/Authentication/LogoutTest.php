<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserIsLoggedOutProperly()
    {
        $user =  $user = User::find(1);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];


        $this->json('post', '/api/v1/auth/logout', [], $headers)->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    public function testUserWithNullToken()
    {
        // Simulating login
        $user = User::find(1);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        // Simulating logout
        $user->api_token = null;
        $user->save();
        $this->assertEquals(null, $user->api_token);

        //$this->json('post', '/api/v1/articles', [], $headers)->assertStatus(401);
    }
}
