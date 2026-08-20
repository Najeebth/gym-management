<?php

namespace App\Livewire\Admin\Website;

use App\Services\WebsiteService;
use Livewire\Component;

class FooterEditor extends Component
{
    public string $copyright_text = '';

    public string $short_description = '';

    public string $contact_email = '';

    public string $contact_phone = '';

    public array $social_links = [];

    public bool $saved = false;

    public int $saveVersion = 0;

    public function mount(WebsiteService $websiteService): void
    {
        $footer = $websiteService->getFooter();

        $this->copyright_text = $footer['copyright_text'];
        $this->short_description = $footer['short_description'];
        $this->contact_email = $footer['contact_email'];
        $this->contact_phone = $footer['contact_phone'];
        $this->social_links = $footer['social_links'];
    }

    public function addSocialLink(): void
    {
        $this->social_links[] = ['platform' => '', 'url' => ''];
    }

    public function removeSocialLink(int $index): void
    {
        unset($this->social_links[$index]);
        $this->social_links = array_values($this->social_links);
    }

    public function save(WebsiteService $websiteService): void
    {
        $validated = $this->validate([
            'copyright_text' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'social_links' => ['array'],
            'social_links.*.platform' => ['nullable', 'string', 'max:100'],
            'social_links.*.url' => ['nullable', 'url', 'max:1000'],
        ]);

        $websiteService->updateFooter($validated);

        $this->saved = true;
        $this->saveVersion++;
    }

    public function render()
    {
        return view('livewire.admin.website.footer-editor');
    }
}
