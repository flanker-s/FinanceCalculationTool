<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\V1\OperationTypeTestCase as TestCase;

class OperationTypeTest extends TestCase
{
    public function test_user_can_get_all_operation_types()
    {
        $this->seed();
        $response = $this->get($this->uri . '/templates/operation-types');
        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => $this->operationTypes
        ]);
    }

    public function test_user_can_get_template_lists_by_operation_types()
    {
        $this->seed();
        for($i = 0; $i < count($this->operationTypes); $i++){
            $response = $this->get($this->uri . '/templates/operation-types/' . $this->operationTypes[$i]);
            $response->assertStatus(200);
            $response->assertJsonStructure([
               'data' => [
                   ['id', 'name', 'operation_type', 'created_at']
               ]
            ]);
        }
    }
}
