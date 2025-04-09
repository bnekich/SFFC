<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IntakeFormRequest;
use App\Models\Intake;

class IntakeController extends Controller
{
    public function index(IntakeFormRequest $request)
    {
        $this->logAction("Viewed Intakes", "index", "Intake");

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
        $this->logAction("Create Intake", "create", "Intake");
        return view('intake.create');
    }

    public function store(IntakeFormRequest $request)
    {
        $successMessage = "";
        $validatedData = $request->validated();

        Intake::create($validatedData->all());
        $successMessage = "Intake created successfully.";
        $this->logAction($successMessage, "store", "Intake");
        return redirect()->route('intake.index')->with('success', $successMessage);
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
