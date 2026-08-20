<?php

namespace Tests\Feature\Admin;

use App\Models\Client;
use App\Models\MembershipPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_client(): void
    {
        $admin = User::factory()->create();
        $plan = MembershipPlan::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.clients.store'), [
            'membership_plan_id' => $plan->id,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '5551234567',
            'join_date' => now()->format('Y-m-d'),
            'status' => 'active',
        ]);

        $client = Client::firstWhere('email', 'jane@example.com');

        $response->assertRedirect(route('admin.clients.show', $client));
        $this->assertDatabaseHas('clients', [
            'email' => 'jane@example.com',
            'created_by' => $admin->id,
        ]);
    }

    public function test_client_creation_requires_a_valid_membership_plan(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.clients.store'), [
            'membership_plan_id' => 999,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '5551234567',
            'join_date' => now()->format('Y-m-d'),
            'status' => 'active',
        ]);

        $response->assertSessionHasErrors('membership_plan_id');
    }
}
