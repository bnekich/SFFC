<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Family;
use App\Http\Requests\FamilyFormRequest;
use App\Http\Requests\UpdateFamilyRequest;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    //for family search
    public function search(Request $request)
    {
        $query = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 10;

        $families = Family::where('family_name', 'like', "%{$query}%")
            ->paginate($perPage);

        return response()->json([
            'items' => $families->items(),
            'current_page' => $families->currentPage(),
            'last_page' => $families->lastPage()
        ]);
    }

    public function index(Request $request)
    {
        $this->logAction("Viewed Families", "index", "Family");

        $query = Family::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('family_name', 'like', "%$search%");
            });
        }

        $sort = $request->get('sort', 'family_name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $families = $query->paginate(10);

        return view('family.index', compact('families'));
    }

    public function create()
    {
        //
    }

    public function store(FamilyFormRequest $request)
    {
        //
    }

    public function show(Family $family)
    {
        //
    }

    public function edit(Family $family)
    {
        //
    }

    public function update(FamilyFormRequest $request, Family $family)
    {
        //
    }

    public function destroy(Family $family)
    {
        //
    }
}
