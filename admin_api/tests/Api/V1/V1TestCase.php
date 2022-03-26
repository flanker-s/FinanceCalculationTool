<?php


namespace Tests\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AuthorizedTestCase;

class V1TestCase extends AuthorizedTestCase
{
    use RefreshDatabase;
    protected $uri = '/api/v1';
}
