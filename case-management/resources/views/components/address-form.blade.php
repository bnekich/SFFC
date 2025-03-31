<div class="row g-3 align-items-center">
    <div class="col-auto">
        <input type="text" name="address_line_1" placeholder="Address 1"
            class="form-control-sm @error('address_line_1') is-invalid @enderror"
            value="{{ old('address_line_1', $address->address_line_1 ?? '') }}">
        @error('address_line_1')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-auto">
        <input type="text" name="address_line_2" placeholder="Address 2"
            class="form-control-sm @error('address_line_2') is-invalid @enderror"
            value="{{ old('address_line_2', $address->address_line_2 ?? '') }}">
        @error('address_line_2')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row g-3 align-items-center">
    <div class="col-auto">
        <input type="text" name="city" placeholder="City"
            class="form-control-sm @error('city') is-invalid @enderror" value="{{ old('city', $address->city ?? '') }}">
        @error('city')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-auto">
        <label class="form-label">State</label>
        <select name="state" class="form-select-sm @error('state') is-invalid @enderror">
            <option value="">(Select One)</option>
            @foreach ($states as $state)
                <option value="{{ $state->name }}" {{ $state->name == $address->state ?? 'WI' ? 'selected' : '' }}>
                    {{ $state->value }}
                </option>
            @endforeach
        </select>
        @error('state')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-auto">
        <input type="text" name="zip" maxlength="10" placeholder="Zip Code"
            class="form-control-sm @error('zip') is-invalid @enderror" value="{{ old('zip', $address->zip ?? '') }}">
        @error('zip')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
