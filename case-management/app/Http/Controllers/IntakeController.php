<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntakeFormRequest;
use App\Models\Intake;

class IntakeController extends Controller
{
    public function index(IntakeFormRequest $request)
    {
        $query = Intake::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('parent_name', 'like', "%$search%")
                    ->orWhere('case_summary', 'like', "%$search%");
            });
        }

        // Sort functionality
        $sort = $request->get('sort', 'id'); // default sort by id
        $direction = $request->get('direction', 'asc'); // default ascending

        $query->orderBy($sort, $direction);

        $intakes = $query->paginate(10); // Adjust pagination as needed

        return view('intake.index', compact('intakes'));
    }

    public function create()
    {
        //return view('cases.create');
    }

    public function store(IntakeFormRequest $request)
    {
        $request->validate([
            'parent_name' => 'required|unique:cases|max:50',
            'case_summary' => 'required',
            // Add other validation rules as needed
        ]);

        Intake::create($request->all());
        return redirect()->route('intake.index')->with('success', 'Intake created successfully.');
    }

    public function show(Intake $intake)
    {
        return view('intake.show', compact('intake'));
    }

    public function edit(Intake $intake)
    {
        return view('intake.edit', compact('intake'));
    }

    public function update(IntakeFormRequest $request, Intake $intake)
    {
        $request->validate([
            'parent_name' => 'required|max:50',
            'case_summary' => 'required',
            // Add other validation rules as needed
        ]);

        $intake->update($request->all());
        return redirect()->route('intake.index')->with('success', 'Intake updated successfully.');
    }

    public function destroy(Intake $intake)
    {
        $intake->delete();
        return redirect()->route('intake.index')->with('success', 'Intake deleted successfully.');
    }
}
