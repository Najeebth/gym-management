<div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 mb-6">
    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Photo (saves independently)</h3>

    <div class="flex flex-wrap items-end gap-4">
        @if ($client->photo_path)
            <div class="flex items-center gap-3">
                <img src="{{ $this->photoUrl() }}" class="h-16 w-16 rounded-full object-cover">
                <button type="button" wire:click="removePhoto" wire:confirm="Remove this photo?"
                    class="text-red-600 text-sm hover:text-red-800">Remove photo</button>
            </div>
        @endif

        <div>
            <input type="file" wire:model="photo" class="block text-sm" />
            <div wire:loading wire:target="photo" class="text-xs text-gray-400 mt-1">Uploading…</div>
            @error('photo')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 disabled:opacity-50 transition">
            <span wire:loading.remove wire:target="save">Save photo</span>
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
