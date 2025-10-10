@props(['address', 'states'])

<div class="space-y-6 rounded-lg border border-gray-200 p-4">
    <h4 class="text-lg font-medium leading-6 text-gray-900">Address</h4>

    <div class="grid grid-cols-1 gap-6">
        <div>
            <label for="street" class="block text-sm font-medium text-gray-700">Street Address</label>
            <input type="text" name="street" id="street"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('street') border-red-500 @enderror"
                value="{{ old('street', $address->street ?? '') }}">
            @error('street')
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
</div>

{{-- <div class="row g-3 align-items-center">
    <div class="col-auto">
        <label class="form-label label-required">Address</label>
        <input type="text" name="address_line_1" placeholder="Address Line 1"
            class="form-control-sm @error('address_line_1') is-invalid @enderror"
            value="{{ old('address_line_1', $address->address_line_1 ?? '') }}" required>
        @error('address_line_1')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-auto">
        <input type="text" name="address_line_2" placeholder="Address Line 2"
            class="form-control-sm @error('address_line_2') is-invalid @enderror"
            value="{{ old('address_line_2', $address->address_line_2 ?? '') }}">
        @error('address_line_2')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row g-3 align-items-center">
    <div class="col-auto">
        <label class="form-label label-required">City</label>
        <input type="text" name="city" placeholder="City"
            class="form-control-sm @error('city') is-invalid @enderror" value="{{ old('city', $address->city ?? '') }}">
        @error('city')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-auto">
        <label class="form-label label-required">State</label>
        <select name="state" class="form-select-sm @error('state') is-invalid @enderror" required>
            <option value="">(Select One)</option>
            @foreach ($states as $state)
                <option value="{{ $state->name }}"
                    {{ old('state', $address->state ?? '') == $state->name ? 'selected' : '' }}>
                    {{ $state->value }}
                </option>
            @endforeach
        </select>
        @error('state')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-auto">
        <label class="form-label label-required">Zip Code</label>
        <input type="text" name="zip" maxlength="10" placeholder="Zip Code"
            class="form-control-sm @error('zip') is-invalid @enderror" value="{{ old('zip', $address->zip ?? '') }}"
            required>
        @error('zip')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div> --}}
