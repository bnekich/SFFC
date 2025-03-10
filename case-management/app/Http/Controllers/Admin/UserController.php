<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage users');
    }

    public function create()
    {
        $roles = Role::all();
        //$permissions = Permission::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        if (!empty($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }

        return redirect()->route('users')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8'
        ]);

        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        return redirect()->route('users.index');
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
