<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class LeadCreationTest extends TestCase
{
    // use RefreshDatabase; 

    /** @test */
    public function admin_can_create_lead()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $agent = User::factory()->create(['role' => 'agent']);

        Sanctum::actingAs($admin, ['*']);

        $leadData = [
            'name' => 'Test Lead',
            'email' => 'test2@gmail.com',
            'phone' => '03176281399',
            'status' => 'new',
            'assigned_to' => $agent->id,
            'notes' => 'Some notes here.',
        ];

        $response = $this->postJson('/api/leads', $leadData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('leads');
    }

    /** @test */
    public function agent_cannot_create_lead()
    {
        $agent = User::factory()->create(['role' => 'agent']);

        Sanctum::actingAs($agent, ['*']);

        $leadData = [
            'name' => 'Unauthorized Lead',
            'email' => 'unauthorized@example.com',
            'phone' => '03171234567',
            'status' => 'new',
            'assigned_to' => $agent->id,
            'notes' => 'This should not be created.',
        ];

        $response = $this->postJson('/api/leads', $leadData);
        $response->assertStatus(403);
        $this->assertDatabaseMissing('leads', ['email' => 'unauthorized@example.com']);
    }
}
