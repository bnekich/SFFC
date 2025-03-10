<?php
<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')
    
    <div>
        <label>Roles:</label>
        @foreach($roles as $role)
            <input type="checkbox" 
                   name="roles[]" 
                   value="{{ $role->name }}"
                   {{ $user->hasRole($role->name) ? 'checked' : '' }}>
            {{ $role->name }}
        @endforeach
    </div>

    <div>
        <label>Direct Permissions:</label>
        @foreach($permissions as $permission)
            <input type="checkbox" 
                   name="permissions[]" 
                   value="{{ $permission->name }}"
                   {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }}>
            {{ $permission->name }}
        @endforeach
    </div>

    <button type="submit">Update</button>
</form>
