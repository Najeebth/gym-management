@php
    $activeFilters = array_filter([
        'search' => request('search'),
        'status' => request('status'),
        'plan' => request('plan') ? optional($plans->firstWhere('id', (int) request('plan')))->name : null,
    ]);

 
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('admin.clients.create') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-indigo-500 transition">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Filter bar --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-100">
                <form method="GET" class="p-4 sm:p-5 flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[220px]">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.2-5.2m0 0a7.5 7.5 0 1 0-10.6-10.6 7.5 7.5 0 0 0 10.6 10.6Z" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search name, email, or phone…"
                                class="w-full pl-9 border-gray-300 rounded-lg shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                    </div>

                    <div class="w-40">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                        <select name="status" onchange="this.form.submit()"
                            class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All statuses</option>
                            @foreach (['active', 'inactive', 'frozen', 'cancelled'] as $status)
                                <option value="{{ $status }}" @selected(request('status') === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-48">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Membership plan</label>
                        <select name="plan" onchange="this.form.submit()"
                            class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All plans</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" @selected((string) request('plan') === (string) $plan->id)>
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition">
                            Search
                        </button>
                        @if (request()->anyFilled(['search', 'status', 'plan']))
                            <a href="{{ route('admin.clients.index') }}"
                                class="px-4 py-2 text-gray-500 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                @if (count($activeFilters))
                    <div class="px-4 sm:px-5 pb-4 flex flex-wrap gap-2 items-center border-t border-gray-100 pt-3">
                        <span class="text-xs text-gray-400">Filtering by:</span>
                        @foreach ($activeFilters as $key => $value)
                            <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium px-2.5 py-1">
                                {{ ucfirst($key) }}: {{ $value }}
                                <a href="{{ route('admin.clients.index', request()->except([$key, 'page'])) }}"
                                    class="hover:text-indigo-900" aria-label="Remove filter">&times;</a>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Results --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 text-sm text-gray-500">
                    @if ($clients->total() > 0)
                        Showing <span class="font-medium text-gray-700">{{ $clients->firstItem() }}–{{ $clients->lastItem() }}</span>
                        of <span class="font-medium text-gray-700">{{ number_format($clients->total()) }}</span> clients
                    @else
                        No clients match these filters
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Client</th>
                                <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Plan</th>
                                <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Status</th>
                                <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Joined</th>
                                <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Phone</th>
                                <th class="px-5 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($clients as $client)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-3">
                                        <a href="{{ route('admin.clients.show', $client) }}" class="flex items-center gap-3 group">
                                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 font-semibold text-xs">
                                                {{ strtoupper(substr($client->first_name, 0, 1) . substr($client->last_name, 0, 1)) }}
                                            </span>
                                            <span>
                                                <span class="block font-medium text-gray-900 group-hover:text-indigo-600">{{ $client->full_name }}</span>
                                                <span class="block text-xs text-gray-400">{{ $client->email }}</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td class="px-5 py-3 text-gray-600">{{ $client->membershipPlan->name }}</td>
                                    <td class="px-5 py-3"><x-status-badge :status="$client->status" /></td>
                                    <td class="px-5 py-3 text-gray-600">{{ $client->join_date->format('M j, Y') }}</td>
                                    <td class="px-5 py-3 text-gray-600">{{ $client->phone }}</td>
                                    <td class="px-5 py-3 text-right">
                                        <a href="{{ route('admin.clients.edit', $client) }}" class="text-gray-400 hover:text-indigo-600">
                                            <svg class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-16 text-center text-gray-400">
                                        <svg class="mx-auto h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                        <p class="mt-3 font-medium">No clients found</p>
                                        <p class="text-sm text-gray-400">Try adjusting your search or filters.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($clients->hasPages())
                    <div class="px-5 py-3 border-t border-gray-100">
                        {{ $clients->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
