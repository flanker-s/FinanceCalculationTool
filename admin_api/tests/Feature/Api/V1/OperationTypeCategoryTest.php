<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Templates\Category;
use Tests\Feature\Api\V1\OperationTypeTestCase as TestCase;

class OperationTypeCategoryTest extends TestCase
{
    public function test_user_can_get_all_categories_by_operation_types()
    {
        $this->seed();
        foreach ($this->operationTypes as $operation_type){
            $uri = $this->uri . '/templates/operation-types/' . $operation_type . '/categories';
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertJsonStructure([
               'data' => [
                   ['id', 'name', 'operation_type', 'created_at']
               ]
            ]);
        }
    }

    public function test_user_can_get_a_category_by_operation_types()
    {
        $this->seed();
        foreach ($this->operationTypes as $operationType){
            $category = Category::where('operation_type', $operationType)->first();
            $uri = $this->uri . '/templates/operation-types/' . $operationType . '/categories/' . $category->id;
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertJsonStructure([
                'data' => [
                    'id', 'name', 'operation_type', 'created_at', 'templates'
                ]
            ]);
        }
    }

    public function test_user_can_create_a_category_of_a_specific_operation_type()
    {
        $this->seed();
        foreach ($this->operationTypes as $operationType) {
            $uri = $this->uri . '/templates/operation-types/' . $operationType . '/categories';
            $response = $this->post($uri, [
                'name' => 'test-' . $operationType
            ]);
            $response->assertStatus(201);
            $response->assertJsonStructure([
                'data' => [
                    'id', 'name', 'operation_type', 'created_at'
                ]
            ]);
        }
    }
}
