<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    // Roles: Index
    public function indexRoles()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }

    // Roles: Create
    public function createRole()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    // Roles: Store
    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create(['name' => $validated['name']]);
        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Roles: Edit
    public function editRole(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // Roles: Update
    public function updateRole(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Roles: Destroy
    public function destroyRole(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    // Permissions: Index
    public function indexPermissions()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    // Permissions: Create
    public function createPermission()
    {
        return view('admin.permissions.create');
    }

    // Permissions: Store
    public function storePermission(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create(['name' => $validated['name']]);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    // Permissions: Edit
    public function editPermission(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    // Permissions: Update
    public function updatePermission(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $validated['name']]);
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    // Permissions: Destroy
    public function destroyPermission(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
