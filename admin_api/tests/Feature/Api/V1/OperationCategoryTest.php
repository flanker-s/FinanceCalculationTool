<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Templates\Category;
use Tests\Feature\Api\V1\OperationTestCase as TestCase;

class OperationCategoryTest extends TestCase
{
    public function test_user_can_get_all_categories_by_operations()
    {
        $this->seed();
        foreach ($this->operations as $operations){
            $uri = $this->uri . '/templates/operations/' . $operations . '/categories';
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertJsonStructure([
               'data' => [
                   ['id', 'name', 'operation', 'created_at']
               ]
            ]);
        }
    }

    public function test_user_can_get_a_category_by_operations()
    {
        $this->seed();
        foreach ($this->operations as $operation){
            $category = Category::where('operation', $operation)->first();
            $uri = $this->uri . '/templates/operations/' . $operation . '/categories/' . $category->id;
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertJsonStructure([
                'data' => [
                    'id', 'name', 'operation', 'created_at', 'templates'
                ]
            ]);
        }
    }

    public function test_user_can_create_a_category_of_a_specific_operations()
    {
        $this->seed();
        foreach ($this->operations as $operation) {
            $uri = $this->uri . '/templates/operations/' . $operation . '/categories';
            $response = $this->post($uri, [
                'name' => 'test-' . $operation
            ]);
            $response->assertStatus(201);
            $response->assertJsonStructure([
                'data' => [
                    'id', 'name', 'operation', 'created_at'
                ]
            ]);
        }
    }
}
