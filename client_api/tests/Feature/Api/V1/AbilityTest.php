<?php

namespace Tests\Feature\Api\V1;

use App\Models\Ability;
use Tests\Feature\Api\V1TestCase;

class AbilityTest extends V1TestCase
{
    public function test_user_can_get_all_abilities()
    {
        $this->seed();
        $response = $this->get($this->uri . '/abilities');
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
