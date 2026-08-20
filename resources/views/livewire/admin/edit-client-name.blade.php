<div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 mb-6">
    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Name (saves independently)</h3>

    <div class="flex flex-wrap items-end gap-4">
        <div>
            <label for="ecn-first-name" class="block text-xs font-medium text-gray-500 mb-1">First name</label>
            <input id="ecn-first-name" type="text" wire:model="first_name"
                class="border-gray-300 rounded-lg shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('first_name')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ecn-last-name" class="block text-xs font-medium text-gray-500 mb-1">Last name</label>
            <input id="ecn-last-name" type="text" wire:model="last_name"
                class="border-gray-300 rounded-lg shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('last_name')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 disabled:opacity-50 transition">
            <span wire:loading.remove wire:target="save">Save name</span>
            <span wire:loading wire:target="save">Saving…</span>
        </button>

        @if ($saved)
            <span
                wire:key="saved-{{ $saveVersion }}"
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 2000)"
                class="text-green-600 text-sm font-medium"
            >
                Saved ✓
            </span>
        @endif
    </div>
</div>
