<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\VolunteerFormRequest;
use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Person;
use App\Models\Volunteer;
use App\Models\VolunteerStatus;
use App\Services\VolunteerService;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    protected VolunteerService $volunteerService;

    public function __construct(VolunteerService $volunteerService)
    {
        $this->volunteerService = $volunteerService;
    }

    public function search(Request $request)
    {
        $this->logAction("Searched Volunteers", "search", "Volunteer");
        $query = $request->input('q');
        $page = (int) $request->input('page', 1);
        $perPage = (int) $request->input('per_page', 10);

        $volunteers = $this->volunteerService->searchVolunteers($query, $page, $perPage);

        return response()->json([
            'items' => $volunteers->items(),
            'current_page' => $volunteers->currentPage(),
            'last_page' => $volunteers->lastPage()
        ]);
    }

    public function index(Request $request)
    {
        $this->logAction("Viewed Volunteers", "index", "Volunteer");

        $filters = [
            'search' => $request->search,
            'volunteer_status' => $request->volunteer_status_id,
        ];
        $sort = [
            'field' => $request->get('sort', 'created_at'),
            'direction' => $request->get('direction', 'desc')
        ];

        $volunteers = $this->volunteerService->getVolunteers($filters, $sort);
        $volunteerStatuses = VolunteerStatus::all()->sortBy('name');

        return view('volunteer.index', compact('volunteers', 'volunteerStatuses'));
    }

    public function create()
    {
        $orgTypeId = OrganizationType::where('name', '=', 'Church')->pluck('id');
        $this->logAction("Create Volunteer", "create", "Volunteer");
        $persons = Person::all()->sortBy('last_name');
        $churches = Organization::where('organization_type_id', '=', $orgTypeId)->get()->sortBy('name');
        $volunteerStatuses = VolunteerStatus::all()->sortBy('name');
        $sffc_locations = Organization::whereHas('organizationType', function ($query) {
            $query->where('name', 'like', 'Safe Families%');
        })->get();

        return view('volunteer.create', compact('persons', 'churches', 'volunteerStatuses', 'sffc_locations'));
    }

    public function store(VolunteerFormRequest $request)
    {
        $this->logAction("Store Volunteer", "store", "Volunteer");
        $validatedData = $request->validated();

        $volunteer = Volunteer::create([
            'person_id' => $validatedData['person_id'],
            'county' => $validatedData['county'] ?? null,
            'church_id' => $validatedData['church_id'] ?? null,
            'volunteer_status_id' => $validatedData['volunteer_status_id'],
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('volunteer.show', $volunteer)
            ->with('success', 'Volunteer created successfully.');
    }

    public function show(Volunteer $volunteer)
    {
        $this->logAction("Viewed Volunteer", "show", "Volunteer", $volunteer->id);
        return view('volunteer.show', compact('volunteer'));
    }

    public function edit(Volunteer $volunteer)
    {
        $this->logAction("Edit Volunteer", "edit", "Volunteer", $volunteer->id);
        $orgTypeId = OrganizationType::where('name', '=', 'Church Partner')->value('id');
        //$persons = Person::all()->sortBy('last_name');
        $churches = Organization::where('organization_type_id', '=', $orgTypeId)->get()->sortBy('name');
        $volunteerStatuses = VolunteerStatus::all()->sortBy('name');

        return view('volunteer.edit', compact('volunteer', 'churches', 'volunteerStatuses'));
    }

    public function update(VolunteerFormRequest $request, Volunteer $volunteer)
    {
        $this->logAction("Update Volunteer", "update", "Volunteer", $volunteer->id);
        $validatedData = $request->validated();

        $volunteer->update([
            'county' => $validatedData['county'] ?? null,
            'church_id' => $validatedData['church_id'] ?? null,
            'volunteer_status_id' => $validatedData['volunteer_status_id'],
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('volunteer.show', $volunteer)
            ->with('success', 'Volunteer updated successfully.');
    }

    public function destroy(Volunteer $volunteer)
    {
        $this->logAction("Delete Volunteer", "destroy", "Volunteer", $volunteer->id);
        try {
            $this->volunteerService->deleteVolunteer($volunteer);
            return redirect()->route('volunteer.index')
                ->with('success', 'Volunteer deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete volunteer: ' . $e->getMessage());
        }
    }
}
