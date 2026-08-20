<?php

namespace Tests\Feature\Admin;

use App\Models\Client;
use App\Models\MembershipPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ClientListTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_client_index_does_not_n_plus_one(): void
    {
        $admin = User::factory()->create();
        $plans = MembershipPlan::factory()->count(3)->create();
        Client::factory()->count(50)->recycle($plans)->create();

        DB::enableQueryLog();

        $response = $this->actingAs($admin)->get(route('admin.clients.index'));

        $response->assertOk();

        // A handful of fixed queries (auth, pagination count, main select, eager load)
        // regardless of row count. If someone removes with('membershipPlan') later,
        // this jumps toward 1-per-row and fails the assertion.
        $this->assertLessThan(10, count(DB::getQueryLog()));
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get(route('admin.clients.index'))->assertRedirect(route('login'));
    }
}
