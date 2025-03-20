<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
  public function index()
  {
    $this->logAction('Viewed Roles.', 'index', 'Role');
    $roles = Role::with('permissions')->get();
    return view('admin.roles.index', compact('roles'));
  }

  public function create()
  {
    $this->logAction("Create Role", "create", "Role");
    $permissions = Permission::all();
    return view('admin.roles.create', compact('permissions'));
  }

  // Roles: Store
  public function store(Request $request)
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

    $this->logAction('Role Added', 'store', 'Role', $role->id);

    return redirect()->route('roles.index')->with('success', 'Role created successfully.');
  }

  // Roles: Edit
  public function edit(Role $role)
  {
    $this->logAction('Role Edited', 'edit', 'Role', $role->id);
    $permissions = Permission::all();
    return view('admin.roles.edit', compact('role', 'permissions'));
  }

  // Roles: Update
  public function update(Request $request, Role $role)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,name',
    ]);

    $role->update(['name' => $validated['name']]);
    $role->syncPermissions($validated['permissions'] ?? []);

    $this->logAction('Role updated', 'update', 'Role', $role->id);

    return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
  }

  // Roles: Destroy
  public function destroy(Role $role)
  {
    $this->logAction('Role deleted', 'destroy', 'Role', $role->id);
    $role->delete();
    return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
  }
}
