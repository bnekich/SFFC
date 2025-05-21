<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Statuses\CaseStatus;
use App\Models\CaseModel;
use App\Http\Requests\CaseModelFormRequest;
use App\Services\CaseService;

class CaseModelController extends Controller
{
    protected CaseService $caseService;

    public function __construct(CaseService $caseService)
    {
        $this->caseService = $caseService;
    }

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
        $validatedData = $request->validated();

        try {
            $case = $this->caseService->createCase($validatedData);
            $this->logAction("Created Case", "store", "CaseModel");
            return redirect()->route('case.show', $case)->with('success', 'Case created successfully!');
        } catch (\DomainException $e) {
            return back()->withInput()->with('error', 'Failed to create case: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred while creating the case.');
        }
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
        $validatedData = $request->validated();
        try {
            $case = $this->caseService->updateCase($validatedData);
            $this->logAction("Updated Case", "update", "CaseModel");
            return redirect()->route('case.show', $case)->with('success', 'Case updated successfully!');
        } catch (\DomainException $e) {
            return back()->withInput()->with('error', 'Failed to update case: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred while updating the case.');
        }
    }

    public function destroy(CaseModel $case)
    {
        $case->delete();
        return redirect()->route('case.index')->with('success', 'Case deleted successfully.');
    }
}
