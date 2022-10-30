<?php


namespace Tests\Feature\Api\V1;

use Tests\Feature\Api\V1TestCase as TestCase;

class ClientResourcesTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->uri .= '/client_resources';
    }
}

