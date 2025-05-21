<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrderRoutesTest extends TestCase
{
    public function test_can_get_orders(): void
    {
        $response = $this->get('/api/v1/orders');
        $response->assertStatus(200);
    }

    public function test_can_create_order(): void
    {
        $response = $this->postJson('/api/v1/orders', ['name' => 'Test']);
        $response->assertStatus(201);
    }

    public function test_can_update_order(): void
    {
        $response = $this->putJson('/api/v1/orders/1', ['name' => 'Updated']);
        $response->assertStatus(200);
    }

    public function test_can_delete_order(): void
    {
        $response = $this->delete('/api/v1/orders/1');
        $response->assertStatus(200);
    }
}
