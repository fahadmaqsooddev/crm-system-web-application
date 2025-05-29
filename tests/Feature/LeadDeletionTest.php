<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lead;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeadDeletionTest extends TestCase
{
    use RefreshDatabase;

   public function admin_can_delete_a_lead()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $lead = Lead::factory()->create();

        Sanctum::actingAs($admin, ['*']);

        $response = $this->deleteJson('/api/leads/' . $lead->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('leads', ['id' => $lead->id]);
    }

    /** @test */
    public function agent_cannot_delete_a_lead()
    {
        $agent = User::factory()->create(['role' => 'agent']);
        $lead = Lead::factory()->create();

        Sanctum::actingAs($agent, ['*']);

        $response = $this->deleteJson('/api/leads/' . $lead->id);

        $response->assertStatus(403);
        $this->assertDatabaseHas('leads', ['id' => $lead->id]);
    }

    /** @test */
    public function guest_cannot_delete_a_lead()
    {
        $lead = Lead::factory()->create();

        $response = $this->deleteJson('/api/leads/' . $lead->id);

        $response->assertStatus(401);
        $this->assertDatabaseHas('leads', ['id' => $lead->id]);
    }
}
