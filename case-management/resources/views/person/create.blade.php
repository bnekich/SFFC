@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Person</h1>
        <form action="{{ route('person.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Add As System User?</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="isSystemUser" id="isSystemUser" value="1">
                    <label class="form-check-label" for="isSystemUser">Yes</label>
                </div>
            </div>

            <!-- Basic Person Fields -->
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name') }}">
                @error('first_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                    value="{{ old('middle_name') }}">
                @error('middle_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name') }}">
                @error('last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                    value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                    <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                    <option value="O" {{ old('gender') == 'O' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}">
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="can_text_reminder" value="1" class="form-check-input"
                    {{ old('can_text_reminder') ? 'checked' : '' }}>
                <label class="form-check-label">Can Text Reminder</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="can_email_reminder" value="1" class="form-check-input"
                    {{ old('can_email_reminder') ? 'checked' : '' }}>
                <label class="form-check-label">Can Email Reminder</label>
            </div>
            <h3>Address</h3>
            <x-address-form />
            <!-- Process Roles (Always Visible) -->
            <div class="mb-3">
                <label class="form-label">Process Roles</label>
                <select name="process_roles[]" class="form-select" multiple>
                    @foreach (\Spatie\Permission\Models\Role::where('role_type', 'process')->get() as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('process_roles')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Authorization Roles (Conditional) -->
            <div class="mb-3" id="authRolesSection" style="display: none;">
                <label class="form-label">Authorization Roles</label>
                <select name="auth_roles[]" class="form-select" multiple>
                    @foreach (\Spatie\Permission\Models\Role::where('role_type', 'authorization')->where('name', '<>', 'Administrator')->get() as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('auth_roles')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>

    <!-- JavaScript to Toggle Authorization Roles -->
    <script>
        document.getElementById('isSystemUser').addEventListener('change', function() {
            document.getElementById('authRolesSection').style.display = this.checked ? 'block' : 'none';
        });
    </script>
@endsection
{{-- 
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Person</h1>
        <form action="{{ route('person.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Add As System User?</label>
                <input class="form-control form-check-input" type="checkbox" name="isSystemUser">
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name') }}">
                @error('first_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                    value="{{ old('middle_name') }}">
                @error('middle_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name') }}">
                @error('last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                    value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                    <option value="O" {{ old('gender') == 'O' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}">
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check">
                <input type="checkbox" name="can_text_reminder" value="1" class="form-check-input"
                    {{ old('can_text_reminder') ? 'checked' : '' }}>
                <label class="form-check-label">Can Text Reminder</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="can_email_reminder" value="1" class="form-check-input"
                    {{ old('can_email_reminder') ? 'checked' : '' }}>
                <label class="form-check-label">Can Email Reminder</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>
@endsection --}}
