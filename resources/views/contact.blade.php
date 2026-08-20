<x-site-layout title="Contact">
    <section class="max-w-5xl mx-auto px-6 py-16">
        <h1 class="text-3xl font-extrabold text-center">{{ $contact['gym_name'] ?: 'Contact Us' }}</h1>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="space-y-4 text-gray-600">
                @if ($contact['address'])
                    <div>
                        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider">Address</div>
                        <div>{{ $contact['address'] }}</div>
                    </div>
                @endif
                @if ($contact['phone'])
                    <div>
                        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider">Phone</div>
                        <div>{{ $contact['phone'] }}</div>
                    </div>
                @endif
                @if ($contact['email'])
                    <div>
                        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider">Email</div>
                        <div>{{ $contact['email'] }}</div>
                    </div>
                @endif
                @if ($contact['business_hours'])
                    <div>
                        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider">Business Hours</div>
                        <div class="whitespace-pre-line">{{ $contact['business_hours'] }}</div>
                    </div>
                @endif
            </div>

            @if (!empty($contact['google_maps_embed_url']))
                <div class="rounded-xl overflow-hidden shadow-sm border border-gray-100">
                    <iframe src="{{ $contact['google_maps_embed_url'] }}" class="w-full h-80" style="border:0;"
                        allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            @endif
        </div>
    </section>
</x-site-layout>
