<?php

namespace App\Http\Controllers;

use App\Models\PersonType;
use Illuminate\Http\Request;

class PersonTypeController extends Controller
{
    public function index()
    {
        $types = PersonType::all();
        return view('admin.person-types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.person-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:person_types,name',
        ]);

        PersonType::create($request->only('name'));
        return redirect()->route('person-types.index')->with('success', 'Person type created successfully.');
    }

    public function edit(PersonType $personType)
    {
        return view('admin.person-types.edit', compact('personType'));
    }

    public function update(Request $request, PersonType $personType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:person_types,name,' . $personType->id,
        ]);

        $personType->update($request->only('name'));
        return redirect()->route('person-types.index')->with('success', 'Person type updated successfully.');
    }

    public function destroy(PersonType $personType)
    {
        $personType->delete();
        return redirect()->route('person-types.index')->with('success', 'Person type deleted successfully.');
    }
}
