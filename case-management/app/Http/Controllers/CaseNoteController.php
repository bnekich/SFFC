<?php

namespace App\Http\Controllers;

use App\Models\CaseNote;
use App\Http\Requests\CaseNoteFormRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\CaseModel;

class CaseNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CaseNoteFormRequest $request)
    {
        $this->logAction("Viewed Case Notes", "index", "CaseNote");

        $query = CaseNote::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                    ->orWhere('note', 'like', "%$search%");
            });
        }

        // Apply case_id filter
        if ($request->filled('case_id')) {
            $query->where('case_id', $request->case_id);
        }

        // Sort functionality
        $sort = $request->get('sort', 'created_at'); // default sort by created_at
        $direction = $request->get('direction', 'desc'); // default descending

        $query->orderBy($sort, $direction);

        $caseNotes = $query->paginate(10); // Adjust pagination as needed
        $case = CaseModel::find($request->case_id);
        return view('casenote.index', compact('caseNotes', 'case'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CaseNoteFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CaseNote $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseNote $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CaseNoteFormRequest $request, CaseNote $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseNote $note)
    {
        //
    }
}
