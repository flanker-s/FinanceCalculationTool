<?php

namespace Tests\Feature\Api\V1\ClientResources;

use App\Models\ClientResources\Category;
use App\Models\ClientResources\Operation;
use Tests\Feature\Api\V1\ClientResourcesTestCase;

class CategoryTest extends ClientResourcesTestCase
{
    public function test_user_can_get_all_categories()
    {
        $this->seed();
        $response = $this->get($this->uri . '/categories');
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
                        'created_at'
                    ]
                ]
            ],
        ]);
    }

    public function test_user_can_get_category()
    {
        $this->seed();
        $response = $this->get($this->uri . '/categories/' . Category::first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'name',
                    'created_at'
                ],
                'links' => [
                    'self'
                ]
            ]
        ]);
    }

    public function test_user_can_create_category()
    {
        $this->seed();
        $data = [
            'name' => 'test',
            'operation_id' => Operation::first()->id
        ];
        $response = $this->post($this->uri . '/categories', $data);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'name',
                    'created_at'
                ],
                'links' => [
                    'self'
                ]
            ]
        ]);
    }

    public function test_user_can_update_category()
    {
        $this->seed();
        $data = [
            'name' => 'test',
            'operation_id' => Operation::first()->id
        ];
        $category = Category::where('is_primary', false)->first();
        $uri = $this->uri . '/categories/' . $category->id;
        $response = $this->put($uri, $data);
        $response->assertStatus(200);
    }

    public function test_user_can_delete_category()
    {
        $this->seed();
        $category = Category::where('is_primary', false)->first();
        $response = $this->delete($this->uri . '/categories/' . $category->id);
        $response->assertStatus(204);
    }

    public function test_user_cant_update_primary_categories()
    {
        $this->seed();
        $data = [
            'name' => 'test',
            'operation_id' => Operation::first()->id
        ];
        $primaryCategory = Category::where('is_primary', true)->first();
        $uri = $this->uri . '/categories/' . $primaryCategory->id;
        $response = $this->put($uri, $data);
        $response->assertStatus(405);
    }

    public function test_user_cant_delete_primary_categories()
    {
        $this->seed();
        $primaryCategory = Category::where('is_primary', true)->first();
        $response = $this->delete($this->uri . '/categories/' . $primaryCategory->id);
        $response->assertStatus(405);
    }
}
