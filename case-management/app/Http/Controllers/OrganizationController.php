<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Address;
use App\Enums\USState;
use Illuminate\Http\Request;
use App\Models\OrganizationType;

class OrganizationController extends Controller
{
    //for organization search
    public function search(Request $request)
    {
        $this->logAction("Searched Organizations", "search", "Organization");
        $query = $request->input('q');
        $page = (int) $request->input('page', 1);
        $perPage = (int) $request->input('per_page', 10);

        $organizations = Organization::where('name', 'like', "%{$query}%")
            ->paginate($perPage);

        return response()->json([
            'items' => $organizations->items(),
            'current_page' => $organizations->currentPage(),
            'last_page' => $organizations->lastPage()
        ]);
    }

    public function index(OrganizationFormRequest $request)
    {
        $this->logAction("Viewed Organizations", "index", "Organization");

        $query = Organization::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('contact_person_name', 'like', "%$search%");
            });
        }

        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $organizations = $query->paginate(10);

        return view('organization.index', compact('organizations'));
    }
    public function create()
    {
        $this->logAction("Create Organization", "create", "Organization");
        $states = USState::cases();
        $address = new Address();
        $persons = [];
        $orgTypes = OrganizationType::all();

        return view('organization.create', compact('states', 'address', 'persons', 'orgTypes'));
    }

    public function store(OrganizationFormRequest $request)
    {
        $validatedData = $request->validated();

        // Create the address if any address fields are provided
        $address = null;
        if (!empty(array_filter([
            $validatedData['address_line_1'] ?? null,
            $validatedData['address_line_2'] ?? null,
            $validatedData['city'] ?? null,
            $validatedData['state'] ?? null,
            $validatedData['zip'] ?? null,
        ]))) {
            $address = Address::create([
                'address_line_1' => $validatedData['address_line_1'] ?? null,
                'address_line_2' => $validatedData['address_line_2'] ?? null,
                'city' => $validatedData['city'] ?? null,
                'state' => $validatedData['state'] ?? null,
                'zip' => $validatedData['zip'] ?? null,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        }

        $organization = Organization::create([
            'name' => $validatedData['name'],
            'organization_type_id' => $validatedData['organization_type_id'],
            'address_id' => $address ? $address->id : null,
            'contact_person_name' => $validatedData['contact_person_name'] ?? null,
            'contact_person_title' => $validatedData['contact_person_title'] ?? null,
            'contact_person_email' => $validatedData['contact_person_email'] ?? null,
            'contact_person_phone' => $validatedData['contact_person_phone'] ?? null,
            'contact_person_mobile' => $validatedData['contact_person_mobile'] ?? null,
            'notes' => $validatedData['notes'] ?? null,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        // Attach persons to the organization
        if (array_key_exists('person_ids', $validatedData)) {
            $organization->persons()->attach($validatedData['person_ids']);
        }

        return redirect()->route('organization.index')
            ->with('success', 'Organization created successfully.');
    }

    public function edit(Organization $organization)
    {
        $orgTypes = OrganizationType::all();
        $states = USState::cases();

        return view('organization.edit', compact('organization', 'orgTypes', 'states'));
    }

    // Update an existing organization
    public function update(OrganizationFormRequest $request, Organization $organization)
    {
        $validatedData = $request->validated();
        $organization->update([
            'name' => $validatedData['name'],
            'organization_type_id' => $validatedData['organization_type_id'],
            'address_id' => $validatedData['address_id'] ?? null,
            'contact_person_name' => $validatedData['contact_person_name'] ?? null,
            'contact_person_title' => $validatedData['contact_person_title'] ?? null,
            'contact_person_email' => $validatedData['contact_person_email'] ?? null,
            'contact_person_phone' => $validatedData['contact_person_phone'] ?? null,
            'contact_person_mobile' => $validatedData['contact_person_mobile'] ?? null,
            'notes' => $validatedData['notes'] ?? null,
            'updated_by' => auth()->id(),
        ]);
        if (!empty(array_filter([
            $validatedData['address_line_1'] ?? null,
            $validatedData['address_line_2'] ?? null,
            $validatedData['city'] ?? null,
            $validatedData['state'] ?? null,
            $validatedData['zip'] ?? null,
        ]))) {
            if ($organization->address) {
                $organization->address->update([
                    'address_line_1' => $validatedData['address_line_1'] ?? null,
                    'address_line_2' => $validatedData['address_line_2'] ?? null,
                    'city' => $validatedData['city'] ?? null,
                    'state' => $validatedData['state'] ?? null,
                    'zip' => $validatedData['zip'] ?? null,
                    'updated_by' => auth()->id(),
                ]);
            } else {
                $address = Address::create([
                    'address_line_1' => $validatedData['address_line_1'] ?? null,
                    'address_line_2' => $validatedData['address_line_2'] ?? null,
                    'city' => $validatedData['city'] ?? null,
                    'state' => $validatedData['state'] ?? null,
                    'zip' => $validatedData['zip'] ?? null,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);

                $organization->address()->associate($address)->save();
            }
        } elseif ($organization->address) {
            // If all address fields are empty and an address exists, you might want to delete it
            // TODO: Confirm with the client if this is the desired behavior
            //$organization->address->delete();
            //$organization->address_id = null;
            //$organization->save();
        }

        // Sync persons (updates the pivot table to match the provided IDs)
        if ($request->has('person_ids')) {
            $organization->persons()->sync($request->person_ids);
        } else {
            $organization->persons()->detach(); // Remove all if no persons selected
        }

        return redirect()->route('organization.index')
            ->with('success', 'Organization updated successfully.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        $this->logAction('Deleted Organization', 'destroy', 'Organization', $organization->id);
        return redirect()->route('organization.index')->with('success', 'Organization deleted successfully.');
    }
    public function show(Organization $organization)
    {
        $this->logAction("Viewed Organization", "show", "Organization", $organization->id);
        return view('organization.show', compact('organization'));
    }
}
