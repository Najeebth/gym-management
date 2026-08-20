<?php

namespace App\Livewire\Admin\Website;

use App\Services\WebsiteService;
use Livewire\Component;

class ContactEditor extends Component
{
    public string $gym_name = '';

    public string $address = '';

    public string $phone = '';

    public string $email = '';

    public string $business_hours = '';

    public string $google_maps_embed_url = '';

    public bool $saved = false;

    public int $saveVersion = 0;

    public function mount(WebsiteService $websiteService): void
    {
        $contact = $websiteService->getContact();

        $this->gym_name = $contact['gym_name'];
        $this->address = $contact['address'];
        $this->phone = $contact['phone'];
        $this->email = $contact['email'];
        $this->business_hours = $contact['business_hours'];
        $this->google_maps_embed_url = $contact['google_maps_embed_url'];
    }

    public function save(WebsiteService $websiteService): void
    {
        $validated = $this->validate([
            'gym_name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'business_hours' => ['nullable', 'string', 'max:1000'],
            'google_maps_embed_url' => ['nullable', 'url', 'max:1000'],
        ]);

        $websiteService->updateContact($validated);

        $this->saved = true;
        $this->saveVersion++;
    }

    public function render()
    {
        return view('livewire.admin.website.contact-editor');
    }
}
