<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage users');
    }

    public function create()
    {
        //$roles = Role::all();
        $roles = Role::where('name', '!=', 'Administrator')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $tempPassword = Str::random(12);
        $user = User::create([
            'firstName' => $validated['firstName'],
            'lastName' => $validated['lastName'],
            'email' => $validated['email'],
            'password' => Hash::make($tempPassword),
            'force_password_reset' => true,
        ]);

        if (!empty($validated['roles'])) {
            $roles = array_filter($validated['roles'], fn($role) => $role !== 'Administrator');
            $user->syncRoles($roles);
            //$user->syncRoles($validated['roles']);
        }

        return redirect()->route('users')
            ->with('temp_password', $tempPassword)
            ->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'Administrator')->get();
        //$roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            //'password' => 'nullable|string|min:8'
        ]);
        $user->update($request->only('firstName', 'lastName', 'email'));

        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
