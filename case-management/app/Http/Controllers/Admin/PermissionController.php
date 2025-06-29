<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionFormRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(PermissionFormRequest $request)
    {
        $this->logAction("Viewed Permissions", "index", "Permission");
        $query = Permission::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        $permissions = $query->paginate(10);
        //$permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $this->logAction("Create Permission", "create", "Permission");
        return view('admin.permissions.create');
    }

    public function store(PermissionFormRequest $request)
    {
        $this->logAction("Store Permission", "store", "Permission");
        $validatedData = $request->validated();

        Permission::create(['name' => $validatedData['name']]);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $this->logAction("Edit Permission", "edit", "Permission");
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(PermissionFormRequest $request, Permission $permission)
    {
        $validatedData = $request->validated();

        $permission->update(['name' => $validatedData['name']]);
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
