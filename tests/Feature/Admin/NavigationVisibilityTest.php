<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_website_cms_link(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertSee('Website CMS');
    }

    public function test_staff_does_not_see_website_cms_link(): void
    {
        $staff = $this->staff();

        $this->actingAs($staff)
            ->get(route('admin.dashboard'))
            ->assertDontSee('Website CMS');
    }
}
