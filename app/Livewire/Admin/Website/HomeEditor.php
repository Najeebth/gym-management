<?php

namespace App\Livewire\Admin\Website;

use App\Services\ImageUploadService;
use App\Services\WebsiteService;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeEditor extends Component
{
    use WithFileUploads;

    public string $hero_heading = '';

    public string $hero_subheading = '';

    public string $hero_button_label = '';

    public string $hero_button_url = '';

    public string $intro_heading = '';

    public string $intro_text = '';

    public string $cta_heading = '';

    public string $cta_text = '';

    public string $cta_button_label = '';

    public string $cta_button_url = '';

    public $heroImage = null;

    public ?string $existingHeroImagePath = null;

    public bool $saved = false;

    public int $saveVersion = 0;

    public function mount(WebsiteService $websiteService): void
    {
        $home = $websiteService->getHome();

        $this->hero_heading = $home['hero_heading'];
        $this->hero_subheading = $home['hero_subheading'];
        $this->hero_button_label = $home['hero_button_label'];
        $this->hero_button_url = $home['hero_button_url'];
        $this->intro_heading = $home['intro_heading'];
        $this->intro_text = $home['intro_text'];
        $this->cta_heading = $home['cta_heading'];
        $this->cta_text = $home['cta_text'];
        $this->cta_button_label = $home['cta_button_label'];
        $this->cta_button_url = $home['cta_button_url'];
        $this->existingHeroImagePath = $home['hero_image_path'];
    }

    public function save(WebsiteService $websiteService): void
    {
        $this->validate([
            'hero_heading' => ['required', 'string', 'max:255'],
            'hero_subheading' => ['nullable', 'string', 'max:500'],
            'hero_button_label' => ['nullable', 'string', 'max:100'],
            'hero_button_url' => ['nullable', 'string', 'max:255'],
            'intro_heading' => ['nullable', 'string', 'max:255'],
            'intro_text' => ['nullable', 'string', 'max:2000'],
            'cta_heading' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:500'],
            'cta_button_label' => ['nullable', 'string', 'max:100'],
            'cta_button_url' => ['nullable', 'string', 'max:255'],
            'heroImage' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($this->heroImage) {
            $this->existingHeroImagePath = $websiteService->storeImage(
                $this->heroImage,
                'uploads/website/home',
                $this->existingHeroImagePath,
            );
            $this->heroImage = null;
        }

        $websiteService->updateHome([
            'hero_heading' => $this->hero_heading,
            'hero_subheading' => $this->hero_subheading,
            'hero_button_label' => $this->hero_button_label,
            'hero_button_url' => $this->hero_button_url,
            'hero_image_path' => $this->existingHeroImagePath,
            'intro_heading' => $this->intro_heading,
            'intro_text' => $this->intro_text,
            'cta_heading' => $this->cta_heading,
            'cta_text' => $this->cta_text,
            'cta_button_label' => $this->cta_button_label,
            'cta_button_url' => $this->cta_button_url,
        ]);

        $this->saved = true;
        $this->saveVersion++;
    }

    public function removeHeroImage(WebsiteService $websiteService): void
    {
        $websiteService->deleteImage($this->existingHeroImagePath);
        $this->existingHeroImagePath = null;

        $home = $websiteService->getHome();
        $websiteService->updateHome([...$home, 'hero_image_path' => null]);
    }

    public function heroImageUrl(): ?string
    {
        return app(ImageUploadService::class)->url($this->existingHeroImagePath);
    }

    public function render()
    {
        return view('livewire.admin.website.home-editor');
    }
}
