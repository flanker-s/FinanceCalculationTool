<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $response = $this->post('api/register', [
            'name' => 'user',
            'email' => 'user@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_get_an_access_token(){
        $password = 'password';
        $factory = User::factory(['password' => bcrypt($password)]);
        $user = $factory->count(1)->create()->first();

        $response = $this->post('api/login', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token'
        ]);
    }
}
