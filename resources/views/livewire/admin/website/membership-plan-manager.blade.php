<div class="space-y-6">
    @if ($deleteError)
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
            {{ $deleteError }}
        </div>
    @endif

    <div class="flex justify-end">
        <button wire:click="create"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-indigo-500 transition">
            Add Plan
        </button>
    </div>

    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Order</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Plan</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Price</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Billing</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-500 uppercase text-xs tracking-wider">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($plans as $plan)
                        <tr wire:key="plan-{{ $plan->id }}" class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3">
                                <div class="flex flex-col">
                                    <button wire:click="moveUp({{ $plan->id }})" class="text-gray-400 hover:text-gray-700">&uarr;</button>
                                    <button wire:click="moveDown({{ $plan->id }})" class="text-gray-400 hover:text-gray-700">&darr;</button>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <span class="block font-medium text-gray-900">{{ $plan->name }}</span>
                                @if ($plan->short_description)
                                    <span class="block text-xs text-gray-400">{{ Str::limit($plan->short_description, 60) }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-gray-600">${{ number_format($plan->price, 2) }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ ucfirst(str_replace('_', ' ', $plan->billing_interval)) }}</td>
                            <td class="px-5 py-3">
                                <button wire:click="toggleActive({{ $plan->id }})">
                                    <x-status-badge :status="$plan->is_active ? 'active' : 'inactive'" />
                                </button>
                            </td>
                            <td class="px-5 py-3 text-right whitespace-nowrap">
                                <button wire:click="edit({{ $plan->id }})" class="text-indigo-600 hover:text-indigo-800 font-medium mr-3">Edit</button>
                                <button wire:click="delete({{ $plan->id }})" wire:confirm="Delete this plan?"
                                    class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-gray-400">No membership plans yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal name="membership-plan-modal" :show="$showModal" maxWidth="lg">
        <form wire:submit="save" class="p-6 space-y-4">
            <h2 class="text-lg font-medium text-gray-900">{{ $editingId ? 'Edit Plan' : 'Add Plan' }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="name" value="Plan name" />
                    <x-text-input id="name" wire:model="name" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="price" value="Price" />
                    <x-text-input id="price" wire:model="price" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="billing_interval" value="Billing interval" />
                    <select id="billing_interval" wire:model="billing_interval"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach (['monthly', 'quarterly', 'annual', 'one_time'] as $interval)
                            <option value="{{ $interval }}">{{ ucfirst(str_replace('_', ' ', $interval)) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('billing_interval')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="duration_days" value="Duration (days)" />
                    <x-text-input id="duration_days" wire:model="duration_days" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="short_description" value="Short description" />
                    <textarea id="short_description" wire:model="short_description" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="featuresText" value="Features (one per line)" />
                    <textarea id="featuresText" wire:model="featuresText" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        placeholder="Access to all equipment&#10;Free towel service&#10;1 guest pass per month"></textarea>
                    <x-input-error :messages="$errors->get('featuresText')" class="mt-2" />
                </div>
                <div class="sm:col-span-2 flex items-center gap-2">
                    <input type="checkbox" id="is_active" wire:model="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm" />
                    <x-input-label for="is_active" value="Active" />
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" wire:click="closeModal" class="px-4 py-2 text-gray-500 text-sm">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition">
                    Save
                </button>
            </div>
        </form>
    </x-modal>
</div>
