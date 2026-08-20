<header class="bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-lg font-bold tracking-wide">{{ config('app.name') }}</a>
        <nav class="flex items-center gap-6">
            @foreach ($navItems as $item)
                <a href="{{ $item->url }}" class="text-sm text-gray-300 hover:text-white">{{ $item->label }}</a>
            @endforeach
            <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white">Staff Login</a>
        </nav>
    </div>
</header>
