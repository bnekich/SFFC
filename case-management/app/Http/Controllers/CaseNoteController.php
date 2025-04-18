<?php

namespace App\Http\Controllers;

use App\Models\CaseNote;
use App\Http\Requests\CaseNoteFormRequest;
use App\Http\Requests\UpdateNoteRequest;

class CaseNoteController extends Controller
{
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
    public function update(UpdateNoteRequest $request, CaseNote $note)
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
