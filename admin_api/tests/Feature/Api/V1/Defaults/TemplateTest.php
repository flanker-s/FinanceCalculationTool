<?php

namespace Tests\Feature\Api\V1\Defaults;

use App\Models\Defaults\Template;
use App\Models\Defaults\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\Api\V1\DefaultsTestCase as TestCase;

class TemplateTest extends TestCase
{
    public function test_user_can_get_all_templates()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                [
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
            ]
        ]);
    }

    public function test_user_can_get_template()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates/' . Template::first()->id);
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

    public function test_user_can_create_template()
    {
        $this->seed();
        $data = [
            'name' => 'test',
            'category_id' => Category::first()->id
        ];
        $response = $this->post($this->uri . '/templates', $data);
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

    public function test_user_can_update_template()
    {
        $this->seed();
        $data = [
            'name' => 'test2',
            'category_id' => Category::limit(2)->get()->last()->id
        ];
        $uri = $this->uri . '/templates/' . Template::first()->id;
        $response = $this->put($uri, $data);
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

    public function test_user_can_delete_template()
    {
        $this->seed();
        $response = $this->delete($this->uri . '/templates/' . Template::first()->id);
        $response->assertStatus(204);
    }
}
