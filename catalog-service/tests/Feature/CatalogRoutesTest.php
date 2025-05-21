<?php

namespace Tests\Feature;

use Tests\TestCase;

class CatalogRoutesTest extends TestCase
{
    public function test_can_list_items(): void
    {
        $response = $this->get('/api/v1/items');
        $response->assertStatus(200)->assertJson(['items' => []]);
    }

    public function test_can_create_item(): void
    {
        $response = $this->postJson('/api/v1/items', ['name' => 'Example']);
        $response->assertStatus(201)->assertJson(['created' => true]);
    }

    public function test_can_show_item(): void
    {
        $response = $this->get('/api/v1/items/1');
        $response->assertStatus(200)->assertJson(['id' => 1]);
    }

    public function test_can_update_item(): void
    {
        $response = $this->patchJson('/api/v1/items/1', ['name' => 'Updated']);
        $response->assertStatus(200)->assertJson(['updated' => true, 'id' => 1]);
    }

    public function test_can_delete_item(): void
    {
        $response = $this->delete('/api/v1/items/1');
        $response->assertStatus(204);
    }
}

