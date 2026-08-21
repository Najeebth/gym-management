<?php

namespace App\Livewire\Admin\Website;

use App\Services\ImageUploadService;
use App\Services\WebsiteService;
use Livewire\Component;
use Livewire\WithFileUploads;

class AboutEditor extends Component
{
    use WithFileUploads;

    public string $heading = '';

    public string $description = '';

    public string $mission = '';

    public string $vision = '';

    public $mainImage = null;

    public ?string $existingMainImagePath = null;

    public bool $saved = false;

    public int $saveVersion = 0;

    public function mount(WebsiteService $websiteService): void
    {
        $about = $websiteService->getAbout();

        $this->heading = $about['heading'];
        $this->description = $about['description'];
        $this->mission = $about['mission'];
        $this->vision = $about['vision'];
        $this->existingMainImagePath = $about['main_image_path'];
    }

    public function save(WebsiteService $websiteService): void
    {
        $this->validate([
            'heading' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'mission' => ['nullable', 'string', 'max:1000'],
            'vision' => ['nullable', 'string', 'max:1000'],
            'mainImage' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($this->mainImage) {
            $this->existingMainImagePath = $websiteService->storeImage(
                $this->mainImage,
                'uploads/website/about',
                $this->existingMainImagePath,
            );
            $this->mainImage = null;
        }

        $websiteService->updateAbout([
            'heading' => $this->heading,
            'description' => $this->description,
            'mission' => $this->mission,
            'vision' => $this->vision,
            'main_image_path' => $this->existingMainImagePath,
        ]);

        $this->saved = true;
        $this->saveVersion++;
    }

    public function removeMainImage(WebsiteService $websiteService): void
    {
        $websiteService->deleteImage($this->existingMainImagePath);
        $this->existingMainImagePath = null;

        $about = $websiteService->getAbout();
        $websiteService->updateAbout([...$about, 'main_image_path' => null]);
    }

    public function mainImageUrl(): ?string
    {
        return app(ImageUploadService::class)->url($this->existingMainImagePath);
    }

    public function render()
    {
        return view('livewire.admin.website.about-editor');
    }
}
