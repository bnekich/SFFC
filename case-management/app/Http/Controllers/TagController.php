<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TagFormRequest;

class TagController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('q');
        $page = (int) $request->input('page', 1);
        $perPage = (int) $request->input('per_page', 10);
        $tags = Tag::query()->where('name', 'like', '%' . $query . '%')->paginate($perPage, ['id', 'name'], 'page', $page);
        return response()->json([
            'items' => $tags->items(),
            'current_page' => $tags->currentPage(),
            'last_page' => $tags->lastPage()
        ]);
    }
    public function index(TagFormRequest $request)
    {
        $this->logAction("Viewed Tags", "index", "Tag");
        $query = Tag::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        $sort = [
            'field' => $request->get('sort', 'name'),
            'direction' => $request->get('direction', 'asc')
        ];

        $tags = $query->orderBy($sort['field'], $sort['direction'])->paginate(10);

        return view('tag.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        try {
            Tag::create($validated);
            return redirect()->route('tag.index')->with('success', 'Tag created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create tag: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create tag. Please try again.']);
        }
    }

    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        try {
            $tag->update($validated);
            return redirect()->route('tag.index')->with('success', 'Tag updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update tag: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to update tag. Please try again.']);
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect()->route('tag.index')->with('success', 'Tag deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete tag: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete tag. Please try again.']);
        }
    }
}
