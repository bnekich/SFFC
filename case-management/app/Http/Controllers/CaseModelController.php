<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Statuses\CaseStatus;
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
        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort functionality
        $sort = $request->get('sort', 'case_identifier'); // default sort by id
        $direction = $request->get('direction', 'asc'); // default ascending

        $query->orderBy($sort, $direction);

        $cases = $query->paginate(10); // Adjust pagination as needed
        $statuses = CaseStatus::cases();

        return view('case.index', compact('cases', 'statuses'));
    }

    public function create()
    {
        $this->logAction("Create Case", "create", "CaseModel");
        $statuses = CaseStatus::cases();

        return view('case.create', compact('statuses'));
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
        $this->logAction("Edit Case", "edit", "CaseModel");
        $statuses = CaseStatus::cases();
        return view('case.edit', compact('case', 'statuses'));
    }

    public function update(CaseModelFormRequest $request, CaseModel $case)
    {
        $this->logAction("Update Case", "update", "CaseModel");
        $updatedBy = auth()->user()->lastName;
        $validatedData = $request->validated();

        $case->update([
            'status' => $validatedData['status'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'case_description' => $validatedData['case_description'],
            'client_family_id' => $validatedData['client_family_id'],
            'host_family_id' => $validatedData['host_family_id'],
            'assigned_staff_id' => $validatedData['assigned_staff_id'],
            'updated_by' => $updatedBy,
        ]);

        return redirect()->route('case.index')->with('success', 'Case updated successfully.');
    }

    public function destroy(CaseModel $case)
    {
        $case->delete();
        return redirect()->route('case.index')->with('success', 'Case deleted successfully.');
    }
}
