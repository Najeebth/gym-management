<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Client') }} — {{ $client->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.edit-client-name :client="$client" />
            <livewire:admin.edit-client-photo :client="$client" />

            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('admin.clients.update', $client) }}">
                    @csrf
                    @method('PUT')
                    @include('admin.clients._form', ['hideNameFields' => true])

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.clients.show', $client) }}" class="px-4 py-2 text-gray-500 text-sm">Cancel</a>
                        <x-primary-button>Save Changes</x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('admin.clients.destroy', $client) }}"
                    onsubmit="return confirm('Remove this client?');" class="mt-4 pt-4 border-t border-gray-100">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 text-sm hover:text-red-800">Delete client</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
