<?php

namespace Tests\Feature\Api\V1\ClientResources;

use App\Models\ClientResources\Operation;
use Tests\Feature\Api\V1\ClientResourcesTestCase;

class OperationTest extends ClientResourcesTestCase
{
    public function test_user_can_get_all_operations()
    {
        $this->seed();
        $response = $this->get($this->uri . '/operations');
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

    public function test_user_can_get_operation()
    {
        $this->seed();
        $operation = Operation::first();
        $response = $this->get($this->uri . '/operations/' . $operation->id);
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
