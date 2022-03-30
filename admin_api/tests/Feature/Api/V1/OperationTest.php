<?php

namespace Tests\Feature\Api\V1;

use App\Models\Templates\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\V1TestCase as TestCase;

class OperationTest extends TestCase
{
    public function test_user_can_get_all_operations()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates/operations');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                ['id', 'name']
            ]
        ]);
    }

    public function test_user_can_get_template_lists_by_operations()
    {
        $this->seed();
        $operation = Operation::first();
        $response = $this->get($this->uri . '/templates/operations/' . $operation->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                ['id', 'name', 'operation', 'created_at']
            ]
        ]);
    }
}
