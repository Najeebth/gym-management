<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\EditClientName;
use App\Models\Client;
use App\Models\MembershipPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditClientNameTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_a_clients_name_independently(): void
    {
        $admin = $this->admin();
        $plan = MembershipPlan::factory()->create();
        $client = Client::factory()->recycle($plan)->create([
            'first_name' => 'Old',
            'last_name' => 'Name',
        ]);

        Livewire::actingAs($admin)
            ->test(EditClientName::class, ['client' => $client])
            ->set('first_name', 'Jane')
            ->set('last_name', 'Smith')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true);

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
        ]);
    }

    public function test_name_is_required(): void
    {
        $admin = $this->admin();
        $plan = MembershipPlan::factory()->create();
        $client = Client::factory()->recycle($plan)->create();

        Livewire::actingAs($admin)
            ->test(EditClientName::class, ['client' => $client])
            ->set('first_name', '')
            ->call('save')
            ->assertHasErrors(['first_name' => 'required']);
    }
}
