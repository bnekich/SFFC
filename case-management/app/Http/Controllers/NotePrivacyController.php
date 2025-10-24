<?php

namespace App\Http\Controllers;

use App\Models\NotePrivacy;
use App\Http\Requests\StoreNotePrivacyRequest;
use App\Http\Requests\UpdateNotePrivacyRequest;
use App\Http\Requests\NotePrivacyFormRequest;


class NotePrivacyController extends Controller
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
    public function store(NotePrivacyFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NotePrivacy $notePrivacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotePrivacy $notePrivacy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotePrivacyFormRequest $request, NotePrivacy $notePrivacy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotePrivacy $notePrivacy)
    {
        //
    }
}
