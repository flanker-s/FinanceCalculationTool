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
    public function test_register_status()
    {
        $response = $this->post('api/register', [
            'name' => 'user',
            'email' => 'user@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
    }

    public function test_login_status()
    {
        $password = 'password';
        $factory = User::factory(['password' => bcrypt($password)]);
        $user = $factory->count(1)->create()->first();

        $response = $this->post('api/login', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200);
    }
}
