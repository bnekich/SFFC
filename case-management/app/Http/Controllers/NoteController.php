<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\NoteFormRequest;
use App\Models\Note;
use App\Models\CaseModel;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $this->logAction("Viewed Notes", "index", "Note");

        $filters = [
            'search' => $request->search,
        ];
        $sort = [
            'field' => $request->get('sort', 'created_at'),
            'direction' => $request->get('direction', 'desc')
        ];

        $query = Note::query()->with(['cases', 'volunteers.person']);
        if ($filters['search']) {
            $query->where('title', 'ilike', '%' . $filters['search'] . '%')
                ->orWhere('note', 'ilike', '%' . $filters['search'] . '%');
        }
        $query->orderBy($sort['field'], $sort['direction']);
        $notes = $query->paginate(20)->withQueryString();

        return view('note.index', compact('notes'));
    }

    public function create(Request $request)
    {
        $this->logAction("Create Note", "create", "Note");
        $preselectedVolunteer = null;

        if ($request->input('person_id')) {
            $volunteer = Volunteer::where('person_id', $request->input('person_id'))->with('person')->first();
            if ($volunteer) {
                $preselectedVolunteer = $volunteer;
            }
        }
        return view('note.create', compact('preselectedVolunteer'));
    }

    public function store(NoteFormRequest $request)
    {
        $this->logAction("Store Note", "store", "Note");
        $validated = $request->validated();

        $note = Note::create([
            'title' => $validated['title'],
            'note' => $validated['note'],
            'comments' => $validated['comments'] ?? null,
            'privacy_id' => $validated['privacy_id'] ?? null,
            'note_status_id' => $validated['note_status_id'] ?? null,
            'approved' => $validated['approved'] ?? false,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        // Attach the note to the selected volunteers
        if (!empty($validated['cases'])) {
            $cases = \App\Models\CaseModel::find($validated['cases']); // Returns a Collection
            foreach ($cases as $case) {
                $case->notes()->attach($note->id);
            }
        }

        // Attach the note to the selected volunteers
        if (!empty($validated['volunteers'])) {
            $volunteers = \App\Models\Volunteer::find($validated['volunteers']); // Returns a Collection
            foreach ($volunteers as $volunteer) {
                $volunteer->notes()->attach($note->id);
            }
        }

        return redirect()->route('note.index')->with('success', 'Note created successfully!');
    }

    public function show(Note $note)
    {
        $this->logAction("View Note", "show", "Note", $note->id);
        return view('note.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->logAction("Edit Note", "edit", "Note", $note->id);
        return view('note.edit', compact('note'));
    }

    public function update(NoteFormRequest $request, Note $note)
    {
        $this->logAction("Update Note", "update", "Note", $note->id);
        $validated = $request->validated();

        try {
            $note->update([
                'title' => $validated['title'],
                'note' => $validated['note'],
                'comments' => $validated['comments'] ?? null,
                'privacy_id' => $validated['privacy_id'] ?? null,
                'note_status_id' => $validated['note_status_id'] ?? null,
                'approved' => $validated['approved'] ?? false,
                'updated_by' => auth()->id(),
            ]);

            $note->cases()->sync($validated['cases'] ?? []);
            $note->volunteers()->sync($validated['volunteers'] ?? []);

            return redirect()->route('note.show', $note)->with('success', 'Note updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update note: ' . $e->getMessage());
        }
    }

    public function destroy(Note $note)
    {
        $this->logAction("Delete Note", "destroy", "Note", $note->id);
        try {
            $note->delete();
            return redirect()->route('note.index')->with('success', 'Note deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete note: ' . $e->getMessage());
        }
    }

    public function apiNoteables(Request $request)
    {
        $this->logAction("Fetch Noteables", "apiNoteables", "Note");

        $type = $request->query('noteType');
        $search = $request->query('q', '');
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 10);

        if ($type === 'cases') {
            $query = CaseModel::query()
                ->when($search, function ($q) use ($search) {
                    $q->where('case_identifier', 'like', '%' . $search . '%');
                    // ->orWhere('case_description', 'like', '%' . $search . '%');
                })
                ->orderBy('case_identifier');
            $cases = $query->paginate($perPage, ['id', 'case_identifier'], 'page', $page);

            return response()->json([
                'items' => $cases->items(),
                'current_page' => $cases->currentPage(),
                'last_page' => $cases->lastPage()
            ]);
        }

        if ($type === 'volunteers') {
            $query = Volunteer::query()
                ->join('persons', 'volunteers.person_id', '=', 'persons.id')
                ->when($search, function ($q) use ($search) {
                    $q->where('persons.first_name', 'like', '%' . $search . '%')
                        ->orWhere('persons.last_name', 'like', '%' . $search . '%');
                })
                ->select('volunteers.id', 'persons.first_name', 'persons.last_name')
                ->orderBy('persons.last_name')
                ->orderBy('persons.first_name');
            $volunteers = $query->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                //'items' => $volunteers->items(),
                'items' => $volunteers->map(function ($volunteer) {
                    return [
                        'id' => $volunteer->id,
                        'name' => $volunteer->first_name . ' ' . $volunteer->last_name
                    ];
                }),

                'current_page' => $volunteers->currentPage(),
                'last_page' => $volunteers->lastPage()
            ]);
        }

        return response()->json(['error' => 'Invalid type'], 400);
    }
}
