<x-site-layout title="Membership Plans">
    <section class="max-w-6xl mx-auto px-6 py-16">
        <h1 class="text-3xl font-extrabold text-center">Membership Plans</h1>

        @if ($plans->isEmpty())
            <p class="mt-10 text-center text-gray-500">Membership plans will be available soon.</p>
        @else
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($plans as $plan)
                    <div class="border border-gray-100 rounded-xl p-6 shadow-sm">
                        <div class="text-lg font-bold">{{ $plan->name }}</div>
                        <div class="mt-2 text-2xl font-extrabold text-indigo-600">
                            ${{ number_format($plan->price, 2) }}
                            <span class="text-sm font-normal text-gray-500">/ {{ str_replace('_', ' ', $plan->billing_interval) }}</span>
                        </div>
                        @if ($plan->short_description)
                            <p class="mt-3 text-sm text-gray-600">{{ $plan->short_description }}</p>
                        @endif
                        @if (!empty($plan->features))
                            <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                @foreach ($plan->features as $feature)
                                    <li class="flex items-start gap-2">
                                        <span class="text-indigo-600">&check;</span>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-site-layout>
