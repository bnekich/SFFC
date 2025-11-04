@props(['address', 'states'])
<div class="grid grid-cols-">
    <div>
        <label for="address_line_1" class="sffc-label">Address</label>
        <input type="text" name="address_line_1" id="address_line_1"
            class="sffc-text-input @error('address_line_1') border-red-500 @enderror"
            value="{{ old('address_line_1', $address->address_line_1 ?? '') }}" placeholder="Address Line 1">
        @error('address_line_1')
            <p class="sffc-text-input-error">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <input type="text" name="address_line_2" id="address_line_2"
            class="sffc-text-input @error('address_line_2') border-red-500 @enderror"
            value="{{ old('address_line_2', $address->address_line_2 ?? '') }}" placeholder="Address Line 2">
        @error('address_line_2')
            <p class="sffc-text-input-error">{{ $message }}</p>
        @enderror
    </div>
    <div class="grid grid-cols-3 gap-6">
        <div>
            <label for="city" class="sffc-label">City</label>
            <input type="text" name="city" id="city"
                class="sffc-text-input @error('city') border-red-500 @enderror"
                value="{{ old('city', $address->city ?? '') }}" placeholder="City">
            @error('city')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="state" class="sffc-label">State</label>
            <select id="state" name="state" class="sffc-text-input @error('state') border-red-500 @enderror">
                <option value="">(Select)</option>
                @foreach ($states as $state)
                    <option value="{{ $state->name }}"
                        {{ old('state', $address->state ?? '') == $state->name ? 'selected' : '' }}>
                        {{ $state->value }}
                    </option>
                @endforeach
            </select>
            @error('state')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="zip" class="sffc-label">ZIP Code</label>
            <input type="text" name="zip" id="zip"
                class="sffc-text-input @error('zip') border-red-500 @enderror"
                value="{{ old('zip', $address->zip ?? '') }}" placeholder="Zip Code">
            @error('zip')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
