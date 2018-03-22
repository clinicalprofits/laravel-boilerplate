<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     */
    public function test_basic_feature_test()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
