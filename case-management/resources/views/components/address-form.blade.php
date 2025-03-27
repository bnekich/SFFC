<div class="address-form">
    <div class="mb-3">
        <label class="form-label">Address Line 1</label>
        <input type="text" name="address_line_1" class="form-control @error('address_line_1') is-invalid @enderror"
            value="{{ old('address_line_1', $address->address_line_1 ?? '') }}">
        @error('address_line_1')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Address Line 2</label>
        <input type="text" name="address_line_2" class="form-control @error('address_line_2') is-invalid @enderror"
            value="{{ old('address_line_2', $address->address_line_2 ?? '') }}">
        @error('address_line_2')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
            value="{{ old('city', $address->city ?? '') }}">
        @error('city')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">State</label>
        <input type="text" name="state" maxlength="2" class="form-control @error('state') is-invalid @enderror"
            value="{{ old('state', $address->state ?? '') }}">
        @error('state')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Zip</label>
        <input type="text" name="zip" maxlength="10" class="form-control @error('zip') is-invalid @enderror"
            value="{{ old('zip', $address->zip ?? '') }}">
        @error('zip')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
