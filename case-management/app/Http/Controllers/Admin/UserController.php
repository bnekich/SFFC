<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    public function index()
    {
        $this->logAction("Viewed Users", "index", "User");
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $this->logAction("Create Users", "create", "User");
        $roles = Role::where('name', '!=', 'Administrator')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function edit(User $user)
    {
        $this->logAction("Edit/Update Users", "edit", "User", $user->id);
        $roles = Role::where('name', '!=', 'Administrator')->get();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function store(UserFormRequest $request)
    {
        $validatedRequest = $request->validated();

        $tempPassword = Str::random(12);
        $user = User::create([
            'firstName' => $validatedRequest['firstName'],
            'lastName' => $validatedRequest['lastName'],
            'email' => $validatedRequest['email'],
            'password' => Hash::make($tempPassword),
            'force_password_reset' => true,
        ]);

        if (!empty($validatedRequest['roles'])) {
            $roles = array_filter($validatedRequest['roles'], fn($role) => $role !== 'Administrator');
            $user->syncRoles($roles);
        }

        $this->logAction("Create Users", "store", "User", $user->id);

        return redirect()->route('admin.users.index')
            ->with('temp_password', $tempPassword)
            ->with('success', 'User created successfully');
    }

    public function update(UserFormRequest $request, User $user)
    {
        $this->logAction("Edit/Update Users", "update", "User", $user->id);

        // TODO Add force password reset button so admin can assign new temp password
        $validatedData = $request->validated();
        $user->update(Arr::except($validatedData, 'roles'));

        if (isset($validatedData["roles"])) {
            $user->syncRoles($validatedData["roles"]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->logAction("Delete User", "destroy", "User", $user->id);

        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
