<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\EditClientPhoto;
use App\Models\Client;
use App\Models\MembershipPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class EditClientPhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_a_client_photo(): void
    {
        Storage::fake(config('filesystems.uploads_disk'));

        $admin = User::factory()->create();
        $plan = MembershipPlan::factory()->create();
        $client = Client::factory()->recycle($plan)->create(['photo_path' => null]);

        Livewire::actingAs($admin)
            ->test(EditClientPhoto::class, ['client' => $client])
            ->set('photo', UploadedFile::fake()->image('photo.jpg'))
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true);

        $client->refresh();
        $this->assertNotNull($client->photo_path);
        Storage::disk(config('filesystems.uploads_disk'))->assertExists($client->photo_path);
    }

    public function test_uploading_a_new_photo_deletes_the_old_one(): void
    {
        Storage::fake(config('filesystems.uploads_disk'));

        $admin = User::factory()->create();
        $plan = MembershipPlan::factory()->create();
        $client = Client::factory()->recycle($plan)->create([
            'photo_path' => 'uploads/clients/old.jpg',
        ]);
        Storage::disk(config('filesystems.uploads_disk'))->put('uploads/clients/old.jpg', 'fake');

        Livewire::actingAs($admin)
            ->test(EditClientPhoto::class, ['client' => $client])
            ->set('photo', UploadedFile::fake()->image('new.jpg'))
            ->call('save');

        Storage::disk(config('filesystems.uploads_disk'))->assertMissing('uploads/clients/old.jpg');
    }

    public function test_admin_can_remove_a_client_photo(): void
    {
        Storage::fake(config('filesystems.uploads_disk'));

        $admin = User::factory()->create();
        $plan = MembershipPlan::factory()->create();
        $client = Client::factory()->recycle($plan)->create([
            'photo_path' => 'uploads/clients/existing.jpg',
        ]);
        Storage::disk(config('filesystems.uploads_disk'))->put('uploads/clients/existing.jpg', 'fake');

        Livewire::actingAs($admin)
            ->test(EditClientPhoto::class, ['client' => $client])
            ->call('removePhoto');

        $client->refresh();
        $this->assertNull($client->photo_path);
        Storage::disk(config('filesystems.uploads_disk'))->assertMissing('uploads/clients/existing.jpg');
    }

    public function test_photo_must_be_an_image(): void
    {
        $admin = User::factory()->create();
        $plan = MembershipPlan::factory()->create();
        $client = Client::factory()->recycle($plan)->create();

        Livewire::actingAs($admin)
            ->test(EditClientPhoto::class, ['client' => $client])
            ->set('photo', UploadedFile::fake()->create('document.pdf', 100))
            ->call('save')
            ->assertHasErrors(['photo' => 'image']);
    }
}
