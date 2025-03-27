<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
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
  public function store(RoleFormRequest $request)
  {
    $validatedRequest = $request->validated();

    $role = Role::create([
      'name' => $validatedRequest['name'],
      'role_type' => $validatedRequest['role_type']
    ]);

    if (!empty($validatedRequest['permissions'])) {
      $role->syncPermissions($validatedRequest['permissions']);
    }

    $this->logAction($role->role_type . ' Role Added', 'store', 'Role', $role->id);

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
  public function update(RoleFormRequest $request, Role $role)
  {
    $validatedRequest = $request->validated();

    // Role name is not updatable
    $role->update([
      'role_type' => $validatedRequest['role_type']
    ]);

    $role->syncPermissions($validatedRequest['permissions'] ?? []);

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
