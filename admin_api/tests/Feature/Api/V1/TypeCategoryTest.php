<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Templates\Category;
use Tests\Feature\Api\V1\TypeTestCase as TestCase;

class TypeCategoryTest extends TestCase
{
    public function test_user_can_get_all_categories_by_types()
    {
        $this->seed();
        foreach ($this->types as $type){
            $uri = $this->uri . '/templates/types/' . $type . '/categories';
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertJsonStructure([
               'data' => [
                   ['id', 'name', 'type', 'created_at']
               ]
            ]);
        }
    }

    public function test_user_can_get_a_category_by_types()
    {
        $this->seed();
        foreach ($this->types as $type){
            $category = Category::where('type', $type)->first();
            $uri = $this->uri . '/templates/types/' . $type . '/categories/' . $category->id;
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertJsonStructure([
                'data' => [
                    'id', 'name', 'type', 'created_at', 'templates'
                ]
            ]);
        }
    }

    public function test_user_can_create_a_category_of_a_specific_type()
    {
        $this->seed();
        foreach ($this->types as $type) {
            $uri = $this->uri . '/templates/types/' . $type . '/categories';
            $response = $this->post($uri, [
                'name' => 'test-' . $type
            ]);
            $response->assertStatus(201);
            $response->assertJsonStructure([
                'data' => [
                    'id', 'name', 'type', 'created_at'
                ]
            ]);
        }
    }
}
