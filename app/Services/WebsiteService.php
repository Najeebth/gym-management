<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WebsiteService
{
    public function getHome(): array
    {
        return array_merge($this->homeDefaults(), SiteSetting::get('home'));
    }

    public function updateHome(array $data): void
    {
        SiteSetting::updateOrCreate(['key' => 'home'], ['value' => $data]);
    }

    public function getAbout(): array
    {
        return array_merge($this->aboutDefaults(), SiteSetting::get('about'));
    }

    public function updateAbout(array $data): void
    {
        SiteSetting::updateOrCreate(['key' => 'about'], ['value' => $data]);
    }

    public function getContact(): array
    {
        return array_merge($this->contactDefaults(), SiteSetting::get('contact'));
    }

    public function updateContact(array $data): void
    {
        SiteSetting::updateOrCreate(['key' => 'contact'], ['value' => $data]);
    }

    public function getFooter(): array
    {
        return array_merge($this->footerDefaults(), SiteSetting::get('footer'));
    }

    public function updateFooter(array $data): void
    {
        SiteSetting::updateOrCreate(['key' => 'footer'], ['value' => $data]);
    }

    public function storeImage(UploadedFile $file, string $directory, ?string $previousPath = null): string
    {
        $path = $file->store($directory, 'public');

        $this->deleteImage($previousPath);

        return $path;
    }

    public function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function homeDefaults(): array
    {
        return [
            'hero_heading' => '',
            'hero_subheading' => '',
            'hero_button_label' => '',
            'hero_button_url' => '',
            'hero_image_path' => null,
            'intro_heading' => '',
            'intro_text' => '',
            'cta_heading' => '',
            'cta_text' => '',
            'cta_button_label' => '',
            'cta_button_url' => '',
        ];
    }

    private function aboutDefaults(): array
    {
        return [
            'heading' => '',
            'description' => '',
            'mission' => '',
            'vision' => '',
            'main_image_path' => null,
        ];
    }

    private function contactDefaults(): array
    {
        return [
            'gym_name' => '',
            'address' => '',
            'phone' => '',
            'email' => '',
            'business_hours' => '',
            'google_maps_embed_url' => '',
        ];
    }

    private function footerDefaults(): array
    {
        return [
            'copyright_text' => '',
            'short_description' => '',
            'contact_email' => '',
            'contact_phone' => '',
            'social_links' => [],
        ];
    }
}
