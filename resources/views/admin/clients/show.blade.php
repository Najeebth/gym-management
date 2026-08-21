<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                @if ($client->photo_path)
                    <img src="{{ $client->photo_url }}" class="h-12 w-12 rounded-full object-cover">
                @endif
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $client->full_name }}
                </h2>
            </div>
            <a href="{{ route('admin.clients.edit', $client) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Edit
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm rounded-lg p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Email:</span> {{ $client->email }}</div>
                <div><span class="text-gray-500">Phone:</span> {{ $client->phone }}</div>
                <div><span class="text-gray-500">Plan:</span> {{ $client->membershipPlan->name }}</div>
                <div><span class="text-gray-500">Status:</span> <x-status-badge :status="$client->status" /></div>
                <div><span class="text-gray-500">Joined:</span> {{ $client->join_date->format('Y-m-d') }}</div>
                <div><span class="text-gray-500">Date of birth:</span> {{ $client->date_of_birth?->format('Y-m-d') ?? '—' }}</div>
                <div><span class="text-gray-500">Gender:</span> {{ $client->gender ? ucfirst($client->gender) : '—' }}</div>
                <div><span class="text-gray-500">Address:</span> {{ $client->address ?? '—' }}, {{ $client->city ?? '' }} {{ $client->postal_code ?? '' }} {{ $client->country ?? '' }}</div>
                <div><span class="text-gray-500">Emergency contact:</span> {{ $client->emergency_contact_name ?? '—' }} {{ $client->emergency_contact_phone ?? '' }}</div>
                <div><span class="text-gray-500">Created by:</span> {{ $client->createdBy?->name ?? '—' }}</div>
                @if ($client->notes)
                    <div class="sm:col-span-2"><span class="text-gray-500">Notes:</span> {{ $client->notes }}</div>
                @endif
            </div>

            <a href="{{ route('admin.clients.index') }}" class="text-indigo-600 hover:underline text-sm">&larr; Back to clients</a>
        </div>
    </div>
</x-app-layout>
