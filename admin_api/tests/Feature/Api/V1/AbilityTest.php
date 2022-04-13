<?php

namespace Tests\Feature\Api\V1;

use App\Models\Ability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\V1TestCase as TestCase;

class AbilityTest extends TestCase
{
    public function test_user_can_get_all_abilities()
    {
        $this->seed();
        $response = $this->get($this->uri . '/abilities');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'name',
                    ],
                    'links' => [
                        'self'
                    ]
                ]
            ]
        ]);
    }

    public function test_user_can_get_ability()
    {
        $this->seed();
        $ability = Ability::first();
        $response = $this->get($this->uri . '/abilities/' . $ability->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'name',
                ],
                'links' => [
                    'self'
                ]
            ]
        ]);
    }
}
