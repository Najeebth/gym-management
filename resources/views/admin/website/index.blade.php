@php
    $sections = [
        ['route' => 'admin.website.home', 'title' => 'Home Page', 'description' => 'Hero banner, short introduction, and call to action.'],
        ['route' => 'admin.website.about', 'title' => 'About Us', 'description' => 'Heading, description, mission, vision, and main image.'],
        ['route' => 'admin.website.membership-plans', 'title' => 'Membership Plans', 'description' => 'Plans shown on the public website.'],
        ['route' => 'admin.website.contact', 'title' => 'Contact', 'description' => 'Gym name, address, phone, email, hours, and map.'],
        ['route' => 'admin.website.navigation', 'title' => 'Navigation Menu', 'description' => 'Links shown in the public site header.'],
        ['route' => 'admin.website.footer', 'title' => 'Footer', 'description' => 'Copyright, description, and social links.'],
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Website CMS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($sections as $section)
                    <a href="{{ route($section['route']) }}"
                        class="block bg-white overflow-hidden shadow-sm rounded-lg p-6 hover:shadow-md transition">
                        <div class="font-semibold text-gray-900">{{ $section['title'] }}</div>
                        <p class="mt-2 text-sm text-gray-500">{{ $section['description'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
