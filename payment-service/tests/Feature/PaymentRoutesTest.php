<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaymentRoutesTest extends TestCase
{
    public function test_index_returns_successful_response(): void
    {
        $this->get('/api/v1/payment')->assertStatus(200);
    }

    public function test_store_returns_created_response(): void
    {
        $payload = ['order_id' => '1', 'amount' => 10.0, 'method' => 'card'];
        $this->postJson('/api/v1/payment', $payload)->assertStatus(201);
    }

    public function test_show_returns_successful_response(): void
    {
        $this->get('/api/v1/payment/1')->assertStatus(200);
    }

    public function test_update_returns_successful_response(): void
    {
        $payload = ['amount' => 20.0, 'method' => 'cash'];
        $this->putJson('/api/v1/payment/1', $payload)->assertStatus(200);
    }

    public function test_delete_returns_successful_response(): void
    {
        $this->delete('/api/v1/payment/1')->assertStatus(200);
    }
}
