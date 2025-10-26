<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Http\Requests\CaseModelFormRequest;
use App\Models\CaseStatus;
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
        // TODO hook up to dashboard instead of all 'open cases' they should be 'open cases' for the logged in user. Also, 
        // make this dynamic to the user's role. Some users can see all cases
        $user_id = $request->user_id ?? auth()->id();

        $filters = [
            'search' => $request->search,
            'status' => $request->status,
            'assigned_staff_id' => $user_id,
        ];
        $sort = [
            // 'field' => $request->get('sort', 'case_identifier'),
            // 'direction' => $request->get('direction', 'asc')
            'field' => $request->input('sort'),
            'direction' => $request->input('direction')
        ];

        $cases = $this->caseService->getCases($filters, $sort);
        $statuses = CaseStatus::all();


        return view('case.index', compact('cases', 'statuses', 'user_id'));
    }

    public function create()
    {
        $this->logAction("Create Case", "create", "CaseModel");
        $statuses = CaseStatus::all();
        return view('case.create', compact('statuses'));
    }

    public function store(CaseModelFormRequest $request)
    {
        $this->logAction("Store Case", "store", "CaseModel");
        $validatedData = $request->validated();

        try {
            $case = $this->caseService->createCase($validatedData);
            return redirect()->route('case.show', $case)->with('success', 'Case created successfully!');
        } catch (\DomainException $e) {
            return back()->withInput()->with('error', 'Failed to create case: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred while creating the case.');
        }
    }

    public function show(CaseModel $case)
    {
        $this->logAction("View Case", "show", "CaseModel", $case->id);
        return view('case.show', compact('case'));
    }

    public function edit(CaseModel $case)
    {
        $this->logAction("Edit Case", "edit", "CaseModel", $case->id);
        $statuses = CaseStatus::all();
        return view('case.edit', compact('case', 'statuses'));
    }

    public function update(CaseModelFormRequest $request, CaseModel $case)
    {
        $this->logAction("Update Case", "update", "CaseModel", $case->id);
        $validatedData = $request->validated();

        try {
            $case = $this->caseService->updateCase($case, $validatedData);
            return redirect()->route('case.show', $case)->with('success', 'Case updated successfully!');
        } catch (\DomainException $e) {
            return back()->withInput()->with('error', 'Failed to update case: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred while updating the case.');
        }
    }

    public function destroy(CaseModel $case)
    {
        $this->logAction("Delete Case", "destroy", "CaseModel", $case->id);
        try {
            $this->caseService->deleteCase($case);
            return redirect()->route('case.index')->with('success', 'Case deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete case: ' . $e->getMessage());
        }
    }
}
