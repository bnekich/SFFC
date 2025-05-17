<?php

namespace App\Http\Controllers;

use App\Models\CaseNote;
use App\Http\Requests\CaseNoteFormRequest;
use App\Models\CaseModel;
use App\Models\Tag;

class CaseNoteController extends Controller
{
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

    public function create(CaseNoteFormRequest $request)
    {
        $this->logAction("Create Case Note", "create", "CaseNote");
        $tags = Tag::all();
        $case_id = $request->case_id;
        return view('casenote.create', compact('case_id', 'tags'));
    }

    public function store(CaseNoteFormRequest $request)
    {
        $this->logAction("Created Case Note", "store", "CaseNote");

        $validatedData = $request->validated();
        $caseNote = CaseNote::create([
            'case_id' => $validatedData['case_id'],
            'subject' => $validatedData['subject'],
            'note' => $validatedData['note'],
            'privacy_level' => $validatedData['privacy_level'],
            'status' => $validatedData['status'],
            'is_approved' => $validatedData['is_approved'],
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        // Attach tags
        if (!empty($validatedData['tags'])) {
            foreach ($validatedData['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => strtolower(trim($tagName))]);
                $caseNote->tags()->attach($tag->id);
            }
        }

        return redirect()->route('casenote.show', $caseNote->id)
            ->with('success', 'Case note created successfully.');
        //
    }

    public function show(CaseNote $casenote)
    {
        $this->logAction("Viewed Case Note", "show", "Casenote");
        //$caseNote = CaseNote::with('tags')->find($casenote->id);
        //if (!$caseNote) {
        //    return redirect()->route('casenote.index')->with('error', 'Case note not found.');
        //}
        //$case = CaseModel::find($caseNote->case_id);
        //if (!$case) {
        //    return redirect()->route('casenote.index')->with('error', 'Case not found.');
        //}
        return view('casenote.show', compact('casenote'));
    }

    public function edit(CaseNote $casenote)
    {
        $this->logAction("Edit Case Note", "edit", "CaseNote");
        $tags = Tag::all();
        return view('casenote.edit', compact('casenote', 'tags'));
    }

    public function update(CaseNoteFormRequest $request, CaseNote $casenote)
    {
        $this->logAction("Updated Case Note", "update", "CaseNote");
        $validatedData = $request->validated();

        $casenote->update([
            'case_id' => $validatedData['case_id'],
            'subject' => $validatedData['subject'],
            'note' => $validatedData['note'],
            'privacy_level' => $validatedData['privacy_level'],
            'status' => $validatedData['status'],
            'updated_by' => auth()->id(),
            'is_approved' => $validatedData['is_approved'],
        ]);

        return redirect()->route('casenote.show', $casenote)
            ->with('success', 'Case note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseNote $note)
    {
        //
    }
}
