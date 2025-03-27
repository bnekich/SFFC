<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\RelationshipType;
use Illuminate\Http\Request;

class RelationshipTypeController extends Controller
{
    public function index()
    {
        $types = RelationshipType::all();
        return view('admin.relationship-types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.relationship-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:relationship_types,name',
        ]);

        RelationshipType::create($request->only('name'));
        return redirect()->route('relationship-types.index')->with('success', 'Relationship type created successfully.');
    }

    public function edit(RelationshipType $relationshipType)
    {
        return view('admin.relationship-types.edit', compact('relationshipType'));
    }

    public function update(Request $request, RelationshipType $relationshipType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:relationship_types,name,' . $relationshipType->id,
        ]);

        $relationshipType->update($request->only('name'));
        return redirect()->route('relationship-types.index')->with('success', 'Relationship type updated successfully.');
    }

    public function destroy(RelationshipType $relationshipType)
    {
        $relationshipType->delete();
        return redirect()->route('relationship-types.index')->with('success', 'Relationship type deleted successfully.');
    }
}
