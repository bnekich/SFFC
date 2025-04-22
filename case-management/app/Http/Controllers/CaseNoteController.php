<?php

namespace App\Http\Controllers;

use App\Models\CaseNote;
use App\Http\Requests\CaseNoteFormRequest;
use App\Models\CaseModel;
use App\Models\Tag;
use Illuminate\Http\Request;

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
        $case = CaseModel::find($request->case_id);
        if (!$case) {
            return redirect()->route('casenote.index')->with('error', 'Case not found.');
        }
        $tags = Tag::all();
        return view('casenote.create', compact('case', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CaseNoteFormRequest $request)
    {
        $this->logAction("Created Case Note", "store", "CaseNote");
        $createdBy = auth()->user()->firstName . ' ' . auth()->user()->lastName;

        $validatedData = $request->validated();
        $caseNote = CaseNote::create([
            'case_id' => $validatedData['case_id'],
            'subject' => $validatedData['subject'],
            'note' => $validatedData['note'],
            'privacy_level' => $validatedData['privacy_level'],
            'status' => $validatedData['status'],
            'is_approved' => $validatedData['is_approved'],
            'created_by' => $createdBy,
            'updated_by' => $createdBy,
        ]);

        // Attach tags
        if (!empty($validatedData['tags'])) {
            foreach ($validatedData['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => strtolower(trim($tagName))]);
                $caseNote->tags()->attach($tag->id);
            }
        }

        return redirect()->route('case_notes.show', $caseNote->id)
            ->with('success', 'Case note created successfully.');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CaseNote $note)
    {
        $this->logAction("Viewed Case Note", "show", "CaseNote");
        $caseNote = CaseNote::with('tags')->find($note->id);
        if (!$caseNote) {
            return redirect()->route('casenote.index')->with('error', 'Case note not found.');
        }
        $case = CaseModel::find($caseNote->case_id);
        if (!$case) {
            return redirect()->route('casenote.index')->with('error', 'Case not found.');
        }
        return view('casenote.show', compact('caseNote', 'case'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseNote $casenote)
    {
        $this->logAction("Edit Case Note", "edit", "CaseNote");
        // $caseNote = CaseNote::with('tags')->find($note->id);
        // if (!$caseNote) {
        //     return redirect()->route('casenote.index')->with('error', 'Case note not found.');
        // }
        // $case = CaseModel::find($caseNote->case_id);
        // if (!$case) {
        //     return redirect()->route('casenote.index')->with('error', 'Case not found.');
        // }
        $tags = Tag::all();
        return view('casenote.edit', compact('casenote', 'tags'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CaseNoteFormRequest $request)
    {
        $this->logAction("Updated Case Note", "update", "CaseNote");


        $updatedBy = auth()->user()->firstName . ' ' . auth()->user()->lastName;


        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'note' => 'required|string',
            'privacy_level' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
        ]);

        $validated->update([
            'subject' => $validated['subject'],
            'note' => $validated['note'],
            'privacy_level' => $validated['privacy_level'],
            'status' => $validated['status'],
            'updated_by' => $updatedBy,
        ]);

        // Sync tags
        $tagIds = [];
        if (!empty($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => strtolower(trim($tagName))]);
                $tagIds[] = $tag->id;
            }
        }

        $request->tags()->sync($tagIds);

        return redirect()->route('case_notes.show', $request->id)
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
