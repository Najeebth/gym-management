<footer class="bg-gray-900 text-gray-400">
    <div class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <div class="sm:col-span-2 lg:col-span-1">
            <a href="{{ route('home') }}" class="text-lg font-bold text-white tracking-wide">{{ config('app.name') }}</a>

            @if ($footer['short_description'])
                <p class="mt-3 text-sm leading-relaxed">{{ $footer['short_description'] }}</p>
            @endif

            @if (!empty($footer['social_links']))
                <div class="mt-5 flex items-center gap-3">
                    @foreach ($footer['social_links'] as $link)
                        @if (!empty($link['url']))
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                                title="{{ $link['platform'] ?: $link['url'] }}"
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-800 text-xs font-semibold text-gray-300 hover:bg-indigo-600 hover:text-white transition">
                                {{ strtoupper(substr($link['platform'] ?: '#', 0, 1)) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        @if ($navItems->isNotEmpty())
            <div>
                <h3 class="text-xs font-semibold text-gray-200 uppercase tracking-wider">Quick Links</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @foreach ($navItems as $item)
                        <li><a href="{{ $item->url }}" class="hover:text-white transition">{{ $item->label }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($footer['contact_email'] || $footer['contact_phone'])
            <div>
                <h3 class="text-xs font-semibold text-gray-200 uppercase tracking-wider">Contact</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @if ($footer['contact_email'])
                        <li>
                            <a href="mailto:{{ $footer['contact_email'] }}" class="hover:text-white transition">
                                {{ $footer['contact_email'] }}
                            </a>
                        </li>
                    @endif
                    @if ($footer['contact_phone'])
                        <li>
                            <a href="tel:{{ $footer['contact_phone'] }}" class="hover:text-white transition">
                                {{ $footer['contact_phone'] }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <div class="border-t border-gray-800">
        <div class="max-w-6xl mx-auto px-6 py-5 text-xs text-gray-500 text-center space-y-1">
            <div>{{ $footer['copyright_text'] ?: '© '.now()->year.' '.config('app.name').'. All rights reserved.' }}</div>
            <div>Landing page layout inspired by <a href="https://colorlib.com" target="_blank" rel="noopener noreferrer" class="hover:text-gray-300">Colorlib</a> (CC BY 3.0).</div>
        </div>
    </div>
</footer>
