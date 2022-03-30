<?php

namespace Tests\Feature\Api\V1;

use App\Models\Templates\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Templates\Category;
use Tests\Feature\Api\V1TestCase as TestCase;

class OperationCategoryTest extends TestCase
{
    public function test_user_can_get_all_categories_by_operations()
    {
        $this->seed();
        $operation = Operation::first();
        $uri = $this->uri . '/templates/operations/' . $operation->id . '/categories';
        $response = $this->get($uri);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                ['id', 'name', 'operation', 'created_at']
            ]
        ]);

    }

    public function test_user_can_get_a_category_by_operation()
    {
        $this->seed();
        $operation = Operation::first();
        $category = Category::where('operation_id', $operation->id)->first();
        $uri = $this->uri . '/templates/operations/' . $operation->id . '/categories/' . $category->id;
        $response = $this->get($uri);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'operation', 'created_at', 'templates'
            ]
        ]);

    }

    public function test_user_can_create_a_category_of_a_specific_operation()
    {
        $this->seed();
        $operation = Operation::first();
        $uri = $this->uri . '/templates/operations/' . $operation->id . '/categories';
        $response = $this->post($uri, [
            'name' => 'test-' . $operation->id
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'operation', 'created_at'
            ]
        ]);
    }
}
