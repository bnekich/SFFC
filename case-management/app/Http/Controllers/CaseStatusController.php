<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaseStatusFormRequest;
use App\Models\CaseStatus;

class CaseStatusController extends Controller
{
  public function index()
  {
    $this->logAction("Viewed Case Statuses", "index", "Case Status");

    $caseStatuses = CaseStatus::paginate();
    return view('case-statuses.index', compact('caseStatuses'));
  }

  public function create()
  {
    return view('case-statuses.create');
  }

  public function store(CaseStatusFormRequest $request)
  {
    CaseStatus::create($request->validated());
    return redirect()->route('case-statuses.index')->with('success', 'Case Status created successfully.');
  }

  public function show(CaseStatus $caseStatus)
  {
    return view('case-statuses.show', compact('caseStatus'));
  }

  public function edit(CaseStatus $caseStatus)
  {
    return view('case-statuses.edit', compact('caseStatus'));
  }

  public function update(CaseStatusFormRequest $request, CaseStatus $caseStatus)
  {
    $caseStatus->update($request->validated());
    return redirect()->route('case-statuses.index')->with('success', 'Case Status updated successfully.');
  }

  public function destroy(CaseStatus $caseStatus)
  {
    $caseStatus->delete();
    return redirect()->route('case-statuses.index')->with('success', 'Case Status deleted successfully.');
  }
}
