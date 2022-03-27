<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\V1TestCase as TestCase;

class TypeTest extends TestCase
{
    private $types = [
        0 => 'expense',
        1 => 'income'
    ];

    public function test_user_can_get_all_types()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates/types');
        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => $this->types
        ]);
    }

    public function test_user_can_get_template_lists_by_types()
    {
        $this->seed();
        for($i = 0; $i < count($this->types); $i++){
            $response = $this->get($this->uri . '/templates/types/' . $this->types[$i]);
            $response->assertStatus(200);
            $response->assertJsonStructure([
               'data' => [
                   ['id', 'name', 'type', 'created_at']
               ]
            ]);
        }
    }
}
