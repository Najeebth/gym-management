<?php

namespace Database\Seeders;

use App\Models\NavigationItem;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class WebsiteCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::updateOrCreate(['key' => 'home'], ['value' => [
            'hero_heading' => 'Train Hard. Get Results.',
            'hero_subheading' => 'A fully equipped gym with flexible membership plans, expert trainers, and a community that keeps you accountable.',
            'hero_button_label' => 'View Plans',
            'hero_button_url' => '/membership-plans',
            'hero_image_path' => null,
            'intro_heading' => 'Everything you need under one roof',
            'intro_text' => 'Free weights, machines, group classes, and personal training — all in a space built to keep you motivated.',
            'cta_heading' => 'Ready to join?',
            'cta_text' => 'Visit the front desk or sign up for a membership plan today.',
            'cta_button_label' => 'Contact Us',
            'cta_button_url' => '/contact',
        ]]);

        SiteSetting::updateOrCreate(['key' => 'about'], ['value' => [
            'heading' => 'About Our Gym',
            'description' => 'We are a community-driven gym dedicated to helping members of all levels reach their fitness goals.',
            'mission' => 'To provide an accessible, welcoming space where anyone can build strength and confidence.',
            'vision' => 'To be the go-to fitness community in the area, known for results and support.',
            'main_image_path' => null,
        ]]);

        SiteSetting::updateOrCreate(['key' => 'contact'], ['value' => [
            'gym_name' => config('app.name'),
            'address' => '123 Fitness Ave, Your City',
            'phone' => '(555) 123-4567',
            'email' => 'info@example.com',
            'business_hours' => "Mon-Fri: 6am - 10pm\nSat-Sun: 8am - 6pm",
            'google_maps_embed_url' => '',
        ]]);

        SiteSetting::updateOrCreate(['key' => 'footer'], ['value' => [
            'copyright_text' => '© '.now()->year.' '.config('app.name').'. All rights reserved.',
            'short_description' => 'Train hard, stay accountable, get results.',
            'contact_email' => 'info@example.com',
            'contact_phone' => '(555) 123-4567',
            'social_links' => [
                ['platform' => 'Instagram', 'url' => ''],
                ['platform' => 'Facebook', 'url' => ''],
            ],
        ]]);

        $items = [
            ['label' => 'Home', 'url' => '/', 'display_order' => 1],
            ['label' => 'About', 'url' => '/about', 'display_order' => 2],
            ['label' => 'Plans', 'url' => '/membership-plans', 'display_order' => 3],
            ['label' => 'Contact', 'url' => '/contact', 'display_order' => 4],
        ];

        foreach ($items as $item) {
            NavigationItem::updateOrCreate(['label' => $item['label']], $item);
        }
    }
}
