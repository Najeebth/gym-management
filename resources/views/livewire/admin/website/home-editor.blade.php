<div class="space-y-6">
    <form wire:submit="save" class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 space-y-6">
        <div>
            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Hero Banner</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <x-input-label for="hero_heading" value="Heading" />
                    <x-text-input id="hero_heading" wire:model="hero_heading" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('hero_heading')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="hero_subheading" value="Subheading" />
                    <textarea id="hero_subheading" wire:model="hero_subheading" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    <x-input-error :messages="$errors->get('hero_subheading')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="hero_button_label" value="Button label" />
                    <x-text-input id="hero_button_label" wire:model="hero_button_label" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('hero_button_label')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="hero_button_url" value="Button URL" />
                    <x-text-input id="hero_button_url" wire:model="hero_button_url" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('hero_button_url')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label value="Hero image" />
                    @if ($existingHeroImagePath)
                        <div class="mt-2 flex items-center gap-4">
                            <img src="{{ $this->heroImageUrl() }}" class="h-20 rounded-md object-cover">
                            <button type="button" wire:click="removeHeroImage" wire:confirm="Remove this image?"
                                class="text-red-600 text-sm hover:text-red-800">Remove image</button>
                        </div>
                    @endif
                    <input type="file" wire:model="heroImage" class="mt-2 block w-full text-sm" />
                    <div wire:loading wire:target="heroImage" class="text-xs text-gray-400 mt-1">Uploading…</div>
                    <x-input-error :messages="$errors->get('heroImage')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Short Introduction</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="intro_heading" value="Heading" />
                    <x-text-input id="intro_heading" wire:model="intro_heading" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('intro_heading')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="intro_text" value="Text" />
                    <textarea id="intro_text" wire:model="intro_text" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    <x-input-error :messages="$errors->get('intro_text')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Call to Action</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <x-input-label for="cta_heading" value="Heading" />
                    <x-text-input id="cta_heading" wire:model="cta_heading" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('cta_heading')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="cta_text" value="Text" />
                    <textarea id="cta_text" wire:model="cta_text" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    <x-input-error :messages="$errors->get('cta_text')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="cta_button_label" value="Button label" />
                    <x-text-input id="cta_button_label" wire:model="cta_button_label" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('cta_button_label')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="cta_button_url" value="Button URL" />
                    <x-text-input id="cta_button_url" wire:model="cta_button_url" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('cta_button_url')" class="mt-2" />
                </div>
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
