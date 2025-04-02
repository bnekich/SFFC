<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Http\Requests\CaseModelFormRequest;

class CaseModelController extends Controller
{
    public function index(CaseModelFormRequest $request)
    {
        $this->logAction("Viewed Cases", "index", "CaseModel");

        $query = CaseModel::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('case_identifier', 'like', "%$search%")
                    ->orWhere('case_description', 'like', "%$search%");
            });
        }

        // Sort functionality
        $sort = $request->get('sort', 'case_identifier'); // default sort by id
        $direction = $request->get('direction', 'asc'); // default ascending

        $query->orderBy($sort, $direction);

        $cases = $query->paginate(10); // Adjust pagination as needed

        return view('case.index', compact('cases'));
    }

    public function create()
    {
        $this->logAction("Create Case", "create", "CaseModel");
        return view('case.create');
    }

    public function store(CaseModelFormRequest $request)
    {
        $request->validate([
            'case_identifier' => 'required|unique:cases|max:255',
            'case_description' => 'nullable',
            // Add other validation rules as needed
        ]);

        CaseModel::create($request->all());
        return redirect()->route('case.index')->with('success', 'Case created successfully.');
    }

    public function show(CaseModel $case)
    {
        return view('case.show', compact('case'));
    }

    public function edit(CaseModel $case)
    {
        return view('case.edit', compact('case'));
    }

    public function update(CaseModelFormRequest $request, CaseModel $case)
    {
        $request->validate([
            'case_identifier' => 'required|max:255|unique:cases,case_identifier,' . $case->id,
            'case_description' => 'nullable',
            // Add other validation rules as needed
        ]);

        $case->update($request->all());
        return redirect()->route('case.index')->with('success', 'Case updated successfully.');
    }

    public function destroy(CaseModel $case)
    {
        $case->delete();
        return redirect()->route('case.index')->with('success', 'Case deleted successfully.');
    }
}
