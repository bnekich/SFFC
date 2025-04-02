<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Http\Requests\FamilyFormRequest;
use App\Http\Requests\UpdateFamilyRequest;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FamilyFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        //
    }
}
