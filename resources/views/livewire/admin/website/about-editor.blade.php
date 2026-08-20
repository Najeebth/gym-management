<div>
    <form wire:submit="save" class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 space-y-4">
        <div>
            <x-input-label for="heading" value="Heading" />
            <x-text-input id="heading" wire:model="heading" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('heading')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="description" value="Description" />
            <textarea id="description" wire:model="description" rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="mission" value="Mission" />
                <textarea id="mission" wire:model="mission" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('mission')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="vision" value="Vision" />
                <textarea id="vision" wire:model="vision" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('vision')" class="mt-2" />
            </div>
        </div>
        <div>
            <x-input-label value="Main image" />
            @if ($existingMainImagePath)
                <div class="mt-2 flex items-center gap-4">
                    <img src="{{ Storage::disk('public')->url($existingMainImagePath) }}" class="h-20 rounded-md object-cover">
                    <button type="button" wire:click="removeMainImage" wire:confirm="Remove this image?"
                        class="text-red-600 text-sm hover:text-red-800">Remove image</button>
                </div>
            @endif
            <input type="file" wire:model="mainImage" class="mt-2 block w-full text-sm" />
            <div wire:loading wire:target="mainImage" class="text-xs text-gray-400 mt-1">Uploading…</div>
            <x-input-error :messages="$errors->get('mainImage')" class="mt-2" />
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center gap-4">
            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 disabled:opacity-50 transition">
                <span wire:loading.remove wire:target="save">Save changes</span>
                <span wire:loading wire:target="save">Saving…</span>
            </button>

            @if ($saved)
                <span wire:key="saved-{{ $saveVersion }}" x-data="{ show: true }" x-show="show"
                    x-init="setTimeout(() => show = false, 2000)" class="text-green-600 text-sm font-medium">
                    Saved ✓
                </span>
            @endif
        </div>
    </form>
</div>
