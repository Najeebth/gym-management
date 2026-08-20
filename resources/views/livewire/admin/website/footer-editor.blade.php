<div>
    <form wire:submit="save" class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="copyright_text" value="Copyright text" />
                <x-text-input id="copyright_text" wire:model="copyright_text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('copyright_text')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="short_description" value="Short description" />
                <x-text-input id="short_description" wire:model="short_description" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="contact_email" value="Contact email" />
                <x-text-input id="contact_email" type="email" wire:model="contact_email" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="contact_phone" value="Contact phone" />
                <x-text-input id="contact_phone" wire:model="contact_phone" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('contact_phone')" class="mt-2" />
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Social media links</h3>
            <div class="space-y-3">
                @foreach ($social_links as $index => $link)
                    <div class="flex items-end gap-3" wire:key="social-link-{{ $index }}">
                        <div class="flex-1">
                            <x-input-label value="Platform" />
                            <x-text-input wire:model="social_links.{{ $index }}.platform" class="mt-1 block w-full" placeholder="Instagram" />
                            <x-input-error :messages="$errors->get("social_links.$index.platform")" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label value="URL" />
                            <x-text-input wire:model="social_links.{{ $index }}.url" class="mt-1 block w-full" placeholder="https://instagram.com/yourgym" />
                            <x-input-error :messages="$errors->get("social_links.$index.url")" class="mt-2" />
                        </div>
                        <button type="button" wire:click="removeSocialLink({{ $index }})"
                            class="text-red-600 text-sm hover:text-red-800 pb-2.5">Remove</button>
                    </div>
                @endforeach

                <button type="button" wire:click="addSocialLink"
                    class="text-indigo-600 text-sm font-medium hover:text-indigo-800">
                    + Add social link
                </button>
            </div>
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
