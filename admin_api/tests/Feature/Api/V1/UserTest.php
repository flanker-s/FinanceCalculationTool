<?php

namespace Tests\Feature\Api\V1;

use App\Models\Ability;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\Api\V1TestCase as TestCase;

class UserTest extends TestCase
{
    public function test_user_can_get_all_users()
    {
        $this->seed();
        $response = $this->get($this->uri . '/users');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'links' => [
                'self'
            ],
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'name',
                        'email',
                        'created_at'
                    ]
                ]
            ]
        ]);
    }

    public function test_user_can_get_user()
    {
        $this->seed();
        $response = $this->get($this->uri . '/users/' . User::first()->id);
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

    public function test_user_can_create_user()
    {
        $this->seed();
        $user = User::where('is_primary', true)->first();

        Sanctum::actingAs($user, $user->ability_names);
        $data = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'password',
            'abilities' => [Ability::first()->id]
        ];
        $response = $this->post($this->uri . '/users', $data);
        $response->assertStatus(201);
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

    public function test_user_can_update_user()
    {
        $this->seed();
        $user = User::where('is_primary', false)->first();
        $data = [
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => 'password',
            'abilities' => [$user->abilities()->pluck('id')->first()]
        ];
        $uri = $this->uri . '/users/' . $user->id;
        $response = $this->put($uri, $data);
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

    public function test_user_can_delete_user()
    {
        $this->seed();
        $uri = $this->uri . '/users/' . User::where('is_primary', false)->first()->id;
        $response = $this->delete($uri);
        $response->assertStatus(204);
    }

    public function test_user_cant_update_primary_user()
    {
        $this->seed();
        $data = [
            'name' => 'test2',
            'email' => 'test2@gmail.com',
        ];
        $primaryUser = User::where('is_primary', true)->first();
        $uri = $this->uri . '/users/' . $primaryUser->id;
        $response = $this->put($uri, $data);
        $response->assertStatus(405);
    }

    public function test_user_cant_delete_primary_user()
    {
        $this->seed();
        $uri = $this->uri . '/users/' . User::where('is_primary', true)->first()->id;
        $response = $this->delete($uri);
        $response->assertStatus(405);
    }
}
