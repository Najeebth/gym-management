<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm text-gray-500">Total Clients</div>
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($totalClients) }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm text-gray-500">Active Clients</div>
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($activeClients) }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm text-gray-500">Joined This Month</div>
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($newThisMonth) }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                <a href="{{ route('admin.clients.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                    View all clients &rarr;
                </a>
                <span class="mx-2 text-gray-300">|</span>
                <a href="{{ route('admin.clients.create') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                    Add a new client &rarr;
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
