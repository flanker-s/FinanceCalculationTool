<?php

namespace Tests\Feature\Api\V1\Defaults;

use App\Models\Defaults\Template;
use App\Models\Defaults\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\V1\DefaultsTestCase as TestCase;

class OperationTemplateTest extends TestCase
{
    public function test_user_can_get_all_templates_by_operations()
    {
        $this->seed();
        $operation = Operation::first();
        $uri = $this->uri . '/operations/' . $operation->id . '/templates';
        $response = $this->get($uri);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                ['id', 'name']
            ]
        ]);
    }

    public function test_user_can_get_a_template_by_operation()
    {
        $this->seed();
        $operation = Operation::first();
        $template = Template::whereHas('category', function ($query) use ($operation) {
            $query->where('operation_id', $operation->id);
        })->first();
        $uri = $this->uri . '/operations/' . $operation->id . '/templates/' . $template->id;
        $response = $this->get($uri);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name'
            ]
        ]);

    }

    public function test_user_can_create_a_template_of_a_specific_operation()
    {
        $this->seed();
        $operation = Operation::first();
        $uri = $this->uri . '/operations/' . $operation->id . '/templates';
        $response = $this->post($uri, [
            'name' => 'test'
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name'
            ]
        ]);
    }
}
