<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_view_the_dashboard(): void
    {
        $staff = $this->staff();

        $this->actingAs($staff)->get(route('admin.dashboard'))->assertOk();
    }

    public function test_staff_can_view_the_client_list(): void
    {
        $staff = $this->staff();

        $this->actingAs($staff)->get(route('admin.clients.index'))->assertOk();
    }

    public function test_staff_cannot_view_website_cms(): void
    {
        $staff = $this->staff();

        $this->actingAs($staff)->get(route('admin.website.index'))->assertForbidden();
    }

    public function test_staff_cannot_view_membership_plan_editor(): void
    {
        $staff = $this->staff();

        $this->actingAs($staff)->get(route('admin.website.membership-plans'))->assertForbidden();
    }

    public function test_admin_can_view_website_cms(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->get(route('admin.website.index'))->assertOk();
    }

    public function test_user_without_a_role_is_forbidden_from_the_dashboard(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
    }
}
