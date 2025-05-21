<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_crud_v1(): void
    {
        // Create
        $response = $this->postJson('/api/v1/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);
        $response->assertStatus(200);
        $userId = $response->json('id');

        // Index
        $this->getJson('/api/v1/users')->assertStatus(200);

        // Show
        $this->getJson("/api/v1/users/{$userId}")->assertStatus(200);

        // Update
        $this->putJson("/api/v1/users/{$userId}", [
            'name' => 'Updated',
            'email' => 'updated@example.com',
            'password' => 'newsecret',
        ])->assertStatus(200)->assertJson(['name' => 'Updated']);

        // Delete
        $this->deleteJson("/api/v1/users/{$userId}")->assertStatus(204);
    }
}
