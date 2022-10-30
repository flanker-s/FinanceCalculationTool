<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * Test if user can login
     *
     * @return void
     */
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
    public function test_user_can_get_current_user(){
        Sanctum::actingAs(User::create([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => 'password'
        ]), ['*']);
        $response = $this->get('api/user');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'name',
                    'email',
                    'created_at'
                ]
            ]
        ]);
    }
}
