<?php

namespace Tests\Feature;

use Tests\TestCase;

class MethodNotAllowedTest extends TestCase
{
    public function test_options_method_is_rejected()
    {
        $response = $this->call('OPTIONS', '/api/v1/analytics');
        $response->assertStatus(405);
    }

    public function test_config_disallows_method()
    {
        config(['gateway_routes.analytics.allowed_methods' => ['GET']]);
        $response = $this->post('/api/v1/analytics');
        $response->assertStatus(405);
    }
}
