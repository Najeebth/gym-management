@php
    $c = $client ?? null;
    $hideNameFields = $hideNameFields ?? false;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @unless ($hideNameFields)
        <div>
            <x-input-label for="first_name" value="First name" />
            <x-text-input id="first_name" name="first_name" class="mt-1 block w-full" :value="old('first_name', $c?->first_name)" required />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="last_name" value="Last name" />
            <x-text-input id="last_name" name="last_name" class="mt-1 block w-full" :value="old('last_name', $c?->last_name)" required />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
    @endunless
    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" type="email" name="email" class="mt-1 block w-full" :value="old('email', $c?->email)" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="phone" value="Phone" />
        <x-text-input id="phone" name="phone" class="mt-1 block w-full" :value="old('phone', $c?->phone)" required />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="membership_plan_id" value="Membership plan" />
        <select id="membership_plan_id" name="membership_plan_id" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="">Select a plan</option>
            @foreach ($plans as $plan)
                <option value="{{ $plan->id }}" @selected(old('membership_plan_id', $c?->membership_plan_id) == $plan->id)>
                    {{ $plan->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('membership_plan_id')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="status" value="Status" />
        <select id="status" name="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @foreach (['active', 'inactive', 'frozen', 'cancelled'] as $status)
                <option value="{{ $status }}" @selected(old('status', $c?->status ?? 'active') === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="join_date" value="Join date" />
        <x-text-input id="join_date" type="date" name="join_date" class="mt-1 block w-full"
            :value="old('join_date', $c?->join_date?->format('Y-m-d') ?? now()->format('Y-m-d'))" required />
        <x-input-error :messages="$errors->get('join_date')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="date_of_birth" value="Date of birth" />
        <x-text-input id="date_of_birth" type="date" name="date_of_birth" class="mt-1 block w-full"
            :value="old('date_of_birth', $c?->date_of_birth?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="gender" value="Gender" />
        <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="">-</option>
            @foreach (['male', 'female', 'other'] as $gender)
                <option value="{{ $gender }}" @selected(old('gender', $c?->gender) === $gender)>
                    {{ ucfirst($gender) }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="address" value="Address" />
        <x-text-input id="address" name="address" class="mt-1 block w-full" :value="old('address', $c?->address)" />
        <x-input-error :messages="$errors->get('address')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="city" value="City" />
        <x-text-input id="city" name="city" class="mt-1 block w-full" :value="old('city', $c?->city)" />
        <x-input-error :messages="$errors->get('city')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="postal_code" value="Postal code" />
        <x-text-input id="postal_code" name="postal_code" class="mt-1 block w-full" :value="old('postal_code', $c?->postal_code)" />
        <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="country" value="Country" />
        <x-text-input id="country" name="country" class="mt-1 block w-full" :value="old('country', $c?->country)" />
        <x-input-error :messages="$errors->get('country')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="emergency_contact_name" value="Emergency contact name" />
        <x-text-input id="emergency_contact_name" name="emergency_contact_name" class="mt-1 block w-full" :value="old('emergency_contact_name', $c?->emergency_contact_name)" />
        <x-input-error :messages="$errors->get('emergency_contact_name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="emergency_contact_phone" value="Emergency contact phone" />
        <x-text-input id="emergency_contact_phone" name="emergency_contact_phone" class="mt-1 block w-full" :value="old('emergency_contact_phone', $c?->emergency_contact_phone)" />
        <x-input-error :messages="$errors->get('emergency_contact_phone')" class="mt-2" />
    </div>
    <div class="sm:col-span-2">
        <x-input-label for="notes" value="Notes" />
        <textarea id="notes" name="notes" rows="3"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('notes', $c?->notes) }}</textarea>
        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
    </div>
</div>
