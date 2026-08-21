<x-site-layout title="About Us">
    <section class="max-w-5xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-3xl font-extrabold">{{ $about['heading'] ?: 'About Us' }}</h1>
                @if ($about['description'])
                    <p class="mt-4 text-gray-600">{{ $about['description'] }}</p>
                @endif
            </div>
            @if ($about['main_image_path'])
                <img src="{{ $about['main_image_url'] }}" class="rounded-xl shadow-xl w-full">
            @endif
        </div>

        @if ($about['mission'] || $about['vision'])
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 gap-8">
                @if ($about['mission'])
                    <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold">Mission</h2>
                        <p class="mt-2 text-gray-600">{{ $about['mission'] }}</p>
                    </div>
                @endif
                @if ($about['vision'])
                    <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold">Vision</h2>
                        <p class="mt-2 text-gray-600">{{ $about['vision'] }}</p>
                    </div>
                @endif
            </div>
        @endif
    </section>
</x-site-layout>
