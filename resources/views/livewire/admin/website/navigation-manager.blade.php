<div class="space-y-6">
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Order</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Label</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">URL</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($items as $item)
                        <tr wire:key="nav-item-{{ $item->id }}" class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3">
                                <div class="flex flex-col">
                                    <button wire:click="moveUp({{ $item->id }})" class="text-gray-400 hover:text-gray-700">&uarr;</button>
                                    <button wire:click="moveDown({{ $item->id }})" class="text-gray-400 hover:text-gray-700">&darr;</button>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <input type="text" wire:model="edits.{{ $item->id }}.label"
                                    class="border-gray-300 rounded-lg shadow-sm text-sm w-full" />
                                <x-input-error :messages="$errors->get("edits.$item->id.label")" class="mt-1" />
                            </td>
                            <td class="px-5 py-3">
                                <input type="text" wire:model="edits.{{ $item->id }}.url"
                                    class="border-gray-300 rounded-lg shadow-sm text-sm w-full" />
                                <x-input-error :messages="$errors->get("edits.$item->id.url")" class="mt-1" />
                            </td>
                            <td class="px-5 py-3">
                                <button wire:click="toggleActive({{ $item->id }})">
                                    <x-status-badge :status="$item->is_active ? 'active' : 'inactive'" />
                                </button>
                            </td>
                            <td class="px-5 py-3 text-right whitespace-nowrap">
                                <button wire:click="saveItem({{ $item->id }})"
                                    class="text-indigo-600 hover:text-indigo-800 font-medium mr-3">Save</button>
                                @if ($savedId === $item->id)
                                    <span wire:key="nav-saved-{{ $item->id }}" x-data="{ show: true }" x-show="show"
                                        x-init="setTimeout(() => show = false, 2000)" class="text-green-600 text-xs font-medium mr-3">
                                        Saved ✓
                                    </span>
                                @endif
                                <button wire:click="deleteItem({{ $item->id }})" wire:confirm="Remove this navigation item?"
                                    class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-gray-400">No navigation items yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
        <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Add navigation item</h3>
        <form wire:submit="addItem" class="flex flex-wrap items-end gap-4">
            <div>
                <x-input-label for="newLabel" value="Label" />
                <x-text-input id="newLabel" wire:model="newLabel" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('newLabel')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="newUrl" value="URL" />
                <x-text-input id="newUrl" wire:model="newUrl" class="mt-1 block w-full" placeholder="/about" />
                <x-input-error :messages="$errors->get('newUrl')" class="mt-2" />
            </div>
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition">
                Add item
            </button>
        </form>
    </div>
</div>
