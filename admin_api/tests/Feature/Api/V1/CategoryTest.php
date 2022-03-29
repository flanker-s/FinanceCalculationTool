<?php

namespace Tests\Feature\Api\V1;

use App\Models\Templates\Category;
use App\Models\Templates\Template;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\V1TestCase as TestCase;

class CategoryTest extends TestCase
{
    public function test_user_can_get_all_categories()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates/categories');
        $response->assertStatus(200);
    }

    public function test_user_can_get_category()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates/categories/' . Category::first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'operation', 'created_at', 'templates'
            ]
        ]);
    }

    public function test_user_can_create_category()
    {
        $this->seed();
        $data = [
            'name' => 'test',
            'operation' => collect(['income', 'expense'])->random()
        ];
        $response = $this->post($this->uri . '/templates/categories', $data);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'operation', 'created_at'
            ]
        ]);
    }

    public function test_user_can_update_category()
    {
        $this->seed();
        $data = [
            'name' => 'test2',
            'operation' => collect(['income', 'expense'])->random()
        ];
        $category = Category::factory()->create();
        $uri = $this->uri . '/templates/categories/' . $category->id;
        $response = $this->put($uri, $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'operation', 'created_at'
            ]
        ]);
    }

    public function test_user_can_delete_category()
    {
        $this->seed();
        $category = Category::factory()->create();
        $response = $this->delete($this->uri . '/templates/categories/' . $category->id);
        $response->assertStatus(204);
    }

    public function test_user_cant_delete_primary_categories()
    {
        $this->seed();
        $response = $this->delete($this->uri . '/templates/categories/' . 1);
        $response->assertStatus(405);
        $response = $this->delete($this->uri . '/templates/categories/' . 2);
        $response->assertStatus(405);
    }
}
