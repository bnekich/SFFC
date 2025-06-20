<?php

namespace App\Http\Controllers;

use App\Models\OrganizationType;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationTypeFormRequest;

class OrganizationTypeController extends Controller
{


    public function index(Request $request)
    {
        $this->logAction("Viewed Organization Types", "index", "Organization Type");

        $query = OrganizationType::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $types = $query->paginate(10);

        return view('admin.organization-types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.organization-types.create');
    }

    public function store(OrganizationTypeFormRequest $request)
    {
        $validatedData = $request->validated();

        OrganizationType::create($validatedData);
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
