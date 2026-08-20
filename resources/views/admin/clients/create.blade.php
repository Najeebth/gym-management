<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('admin.clients.store') }}">
                    @csrf
                    @include('admin.clients._form', ['client' => null])

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.clients.index') }}" class="px-4 py-2 text-gray-500 text-sm">Cancel</a>
                        <x-primary-button>Create Client</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
