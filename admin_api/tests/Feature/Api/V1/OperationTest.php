<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\V1\OperationTestCase as TestCase;

class OperationTest extends TestCase
{
    public function test_user_can_get_all_operations()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates/operations');
        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => $this->operations
        ]);
    }

    public function test_user_can_get_template_lists_by_operations()
    {
        $this->seed();
        for($i = 0; $i < count($this->operations); $i++){
            $response = $this->get($this->uri . '/templates/operations/' . $this->operations[$i]);
            $response->assertStatus(200);
            $response->assertJsonStructure([
               'data' => [
                   ['id', 'name', 'operation', 'created_at']
               ]
            ]);
        }
    }
}
