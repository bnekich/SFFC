<?php

namespace App\Http\Controllers;

use App\Models\VolunteerStatus;
use App\Http\Requests\VolunteerStatusFormRequest;

class VolunteerStatusController extends Controller
{
    public function index()
    {
        $this->logAction("Viewed Volunteer Statuses", "index", "Volunteer Status");

        $statuses = VolunteerStatus::paginate();
        return view('volunteer-statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('volunteer-statuses.create');
    }

    public function store(VolunteerStatusFormRequest $request)
    {
        VolunteerStatus::create($request->validated());
        return redirect()->route('volunteer-statuses.index')->with('success', 'Volunteer Status created successfully.');
    }

    public function show(VolunteerStatus $status)
    {
        return view('volunteer-statuses.show', compact('status'));
    }

    public function edit(VolunteerStatus $volunteerStatus)
    {
        return view('volunteer-statuses.edit', compact('volunteerStatus'));
    }

    public function update(VolunteerStatusFormRequest $request, VolunteerStatus $volunteerStatus)
    {
        $volunteerStatus->update($request->validated());
        return redirect()->route('volunteer-statuses.index')->with('success', 'Volunteer Status updated successfully.');
    }

    public function destroy(VolunteerStatus $volunteerStatus)
    {
        $volunteerStatus->delete();
        return redirect()->route('volunteer-statuses.index')->with('success', 'Volunteer Status deleted successfully.');
    }
}
