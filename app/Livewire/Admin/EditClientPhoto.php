<?php

namespace App\Livewire\Admin;

use App\Models\Client;
use App\Services\ImageUploadService;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditClientPhoto extends Component
{
    use WithFileUploads;

    public Client $client;

    public $photo = null;

    public bool $saved = false;

    public int $saveVersion = 0;

    public function mount(Client $client): void
    {
        $this->client = $client;
    }

    public function save(ImageUploadService $images): void
    {
        $this->validate([
            'photo' => ['required', 'image', 'max:4096'],
        ]);

        $this->client->update([
            'photo_path' => $images->store($this->photo, 'uploads/clients', $this->client->photo_path),
        ]);
        $this->photo = null;

        $this->saved = true;
        $this->saveVersion++;
    }

    public function removePhoto(ImageUploadService $images): void
    {
        $images->delete($this->client->photo_path);
        $this->client->update(['photo_path' => null]);
    }

    public function photoUrl(): ?string
    {
        return app(ImageUploadService::class)->url($this->client->photo_path);
    }

    public function render()
    {
        return view('livewire.admin.edit-client-photo');
    }
}
