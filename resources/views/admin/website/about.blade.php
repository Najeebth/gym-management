<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Website CMS') }} — About Us
            </h2>
            <a href="{{ route('admin.website.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.website.about-editor />
        </div>
    </div>
</x-app-layout>
