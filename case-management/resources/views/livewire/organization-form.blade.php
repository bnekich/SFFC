<div>
    @if ($isModal)
        <div class="modal-body">
    @endif

    <form wire:submit="save">
        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Organization Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Address Form Component -->
        <x-address-form :address="$address" :states="$states" />

        <!-- Persons Multi-Select -->
        <div class="form-group">
            <label for="person_ids">Associated Persons (hold Ctrl/Cmd to select multiple)</label>
            <select wire:model="person_ids" multiple class="form-control @error('person_ids') is-invalid @enderror"
                id="person_ids">
                @foreach ($persons as $person)
                    <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                @endforeach
            </select>
            @error('person_ids')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Organization</button>
            @if ($isModal)
                <button type="button" class="btn btn-secondary" wire:click="$dispatch('closeModal')">Cancel</button>
            @endif
        </div>
    </form>

    @if ($isModal)
</div>
@endif
</div>
