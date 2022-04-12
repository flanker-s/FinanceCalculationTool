<?php


namespace Tests;


use App\Models\Ability;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AuthorizedTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::create([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => 'password'
        ]), ['*']);
    }
}
