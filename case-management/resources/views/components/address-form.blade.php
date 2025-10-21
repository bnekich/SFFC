@props(['address', 'states'])

{{-- <div class="space-y-6 rounded-lg border border-gray-200 p-4"> --}}

<div class="grid grid-cols-1 gap-6">
    <div>
        <label for="address_line_1" class="sffc-label">Address Line One</label>
        <input type="text" name="address_line_1" id="address_line_1"
            class="sffc-text-input @error('address_line_1') border-red-500 @enderror"
            value="{{ old('address_line_1', $address->address_line_1 ?? '') }}">
        @error('address_line_1')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="address_line_2" class="sffc-label">Address Line Two</label>
        <input type="text" name="address_line_2" id="address_line_2"
            class="sffc-text-input @error('address_line_2') border-red-500 @enderror"
            value="{{ old('address_line_2', $address->address_line_2 ?? '') }}">
        @error('address_line_2')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
    <div class="sm:col-span-3">
        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
        <input type="text" name="city" id="city"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('city') border-red-500 @enderror"
            value="{{ old('city', $address->city ?? '') }}">
        @error('city')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
        <select id="state" name="state"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('state') border-red-500 @enderror">
            <option value="">(Select)</option>
            @foreach ($states as $state)
                <option value="{{ $state->name }}"
                    {{ old('state', $address->state ?? '') == $state->name ? 'selected' : '' }}>
                    {{ $state->value }}
                </option>
            @endforeach
        </select>
        @error('state')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="sm:col-span-1">
        <label for="zip" class="block text-sm font-medium text-gray-700">ZIP Code</label>
        <input type="text" name="zip" id="zip"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('zip') border-red-500 @enderror"
            value="{{ old('zip', $address->zip ?? '') }}">
        @error('zip')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
{{-- </div> --}}
