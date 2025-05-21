<?php

namespace Tests\Feature;

use Tests\TestCase;

class NotificationRoutesTest extends TestCase
{
    public function test_index_route_responds(): void
    {
        $response = $this->get('/api/v1/notification');

        $response->assertStatus(200)
                 ->assertJson([
                     'version' => 'v1',
                     'method' => 'index',
                 ]);
    }

    public function test_store_route_responds(): void
    {
        $response = $this->post('/api/v1/notification', ['foo' => 'bar']);

        $response->assertStatus(200)
                 ->assertJson([
                     'version' => 'v1',
                     'method' => 'store',
                     'data' => ['foo' => 'bar'],
                 ]);
    }

    public function test_show_route_responds(): void
    {
        $response = $this->get('/api/v1/notification/1');

        $response->assertStatus(200)
                 ->assertJson([
                     'version' => 'v1',
                     'method' => 'show',
                     'id' => '1',
                 ]);
    }

    public function test_update_route_responds(): void
    {
        $response = $this->put('/api/v1/notification/1', ['foo' => 'bar']);

        $response->assertStatus(200)
                 ->assertJson([
                     'version' => 'v1',
                     'method' => 'update',
                     'id' => '1',
                 ]);
    }

    public function test_delete_route_responds(): void
    {
        $response = $this->delete('/api/v1/notification/1');

        $response->assertStatus(200)
                 ->assertJson([
                     'version' => 'v1',
                     'method' => 'destroy',
                     'id' => '1',
                 ]);
    }
}
