<div>
    <form wire:submit="save" class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="gym_name" value="Gym name" />
                <x-text-input id="gym_name" wire:model="gym_name" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('gym_name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="phone" value="Phone" />
                <x-text-input id="phone" wire:model="phone" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" type="email" wire:model="email" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="address" value="Address" />
                <x-text-input id="address" wire:model="address" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>
        <div>
            <x-input-label for="business_hours" value="Business hours" />
            <textarea id="business_hours" wire:model="business_hours" rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                placeholder="Mon-Fri: 6am - 10pm&#10;Sat-Sun: 8am - 6pm"></textarea>
            <x-input-error :messages="$errors->get('business_hours')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="google_maps_embed_url" value="Google Maps embed URL" />
            <x-text-input id="google_maps_embed_url" wire:model="google_maps_embed_url" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('google_maps_embed_url')" class="mt-2" />
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
