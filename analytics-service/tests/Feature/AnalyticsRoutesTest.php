<?php

namespace Tests\Feature;

use Tests\TestCase;

class AnalyticsRoutesTest extends TestCase
{
    public function test_get_route_returns_successful_response(): void
    {
        $response = $this->get('/api/v1/analytics');
        $response->assertStatus(200);
    }

    public function test_post_route_returns_successful_response(): void
    {
        $response = $this->post('/api/v1/analytics', ['foo' => 'bar']);
        $response->assertStatus(201);
    }

    public function test_put_route_returns_successful_response(): void
    {
        $response = $this->put('/api/v1/analytics/1', ['foo' => 'bar']);
        $response->assertStatus(200);
    }

    public function test_patch_route_returns_successful_response(): void
    {
        $response = $this->patch('/api/v1/analytics/1', ['foo' => 'bar']);
        $response->assertStatus(200);
    }

    public function test_delete_route_returns_successful_response(): void
    {
        $response = $this->delete('/api/v1/analytics/1');
        $response->assertStatus(200);
    }
}
