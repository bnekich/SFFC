<?php

namespace App\Http\Controllers;

use App\Models\OrganizationType;
use Illuminate\Http\Request;

class OrganizationTypeController extends Controller
{
    public function index()
    {
        $types = OrganizationType::all();
        return view('admin.organization-types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.organization-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:organization_types,name',
        ]);

        OrganizationType::create($request->only('name'));
        return redirect()->route('organization-types.index')->with('success', 'Organization type created successfully.');
    }

    public function edit(OrganizationType $organizationType)
    {
        return view('admin.organization-types.edit', compact('organizationType'));
    }

    public function update(Request $request, OrganizationType $organizationType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:organization_types,name,' . $organizationType->id,
        ]);

        $organizationType->update($request->only('name'));
        return redirect()->route('organization-types.index')->with('success', 'Organization type updated successfully.');
    }

    public function destroy(OrganizationType $organizationType)
    {
        $organizationType->delete();
        return redirect()->route('organization-types.index')->with('success', 'Organization type deleted successfully.');
    }
}
