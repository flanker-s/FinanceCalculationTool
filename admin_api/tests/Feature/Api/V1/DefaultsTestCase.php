<?php


namespace Tests\Feature\Api\V1;

use Tests\Feature\Api\V1TestCase as TestCase;

class DefaultsTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->uri .= '/defaults';
    }
}
