<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Address;
use App\Enums\USState;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
  //for organization search
  // public function search(Request $request)
  // {
  //   $this->logAction("Searched Organizations", "search", "Organization");
  //   $query = $request->input('q');
  //   $page = $request->input('page', 1);
  //   $perPage = 10;

  //   $organizations = Organization::where('name', 'like', "%{$query}%")
  //     //->join('persons', 'organizations.contact_person_id', '=', 'persons.id')
  //     ->paginate($perPage);

  //   return response()->json([
  //     'items' => $organizations->items(),
  //     'current_page' => $organizations->currentPage(),
  //     'last_page' => $organizations->lastPage()
  //   ]);
  // }

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

    return view('organization.create', compact('states', 'address', 'persons'));
  }

  public function store(OrganizationFormRequest $request)
  {
    $validatedData = $request->validated();
    $createdBy = auth()->user()->firstName . ' ' . auth()->user()->lastName;

    $organization = new Organization();
    $organization->name = $validatedData['name'];
    $organization->address_id = $validatedData['address_id'] ?? null;
    // 
    $organization->created_by = $createdBy;
    $organization->updated_by = $createdBy;
    $organization->save();

    // Attach persons to the organization
    if (array_key_exists('person_ids', $validatedData)) {
      $organization->persons()->attach($validatedData['person_ids']);
    }

    return redirect()->route('organization.index')
      ->with('success', 'Organization created successfully.');
  }

  // Display form to edit an existing organization
  public function edit(Organization $organization)
  {
    $persons = Person::all();
    $selectedPersons = $organization->persons->pluck('id')->toArray();
    return view('organization.edit', compact('organization', 'persons', 'selectedPersons'));
  }

  // Update an existing organization
  public function update(OrganizationFormRequest $request, Organization $organization)
  {
    $createdBy = auth()->user()->firstName . ' ' . auth()->user()->lastName;

    $request->validate([
      'name' => 'required|string|max:255',
      'person_ids' => 'array',
      'person_ids.*' => 'exists:persons,id'
    ]);

    $organization->name = $request->name;
    $organization->updated_by = $createdBy;
    $organization->save();

    // Sync persons (updates the pivot table to match the provided IDs)
    if ($request->has('person_ids')) {
      $organization->persons()->sync($request->person_ids);
    } else {
      $organization->persons()->detach(); // Remove all if no persons selected
    }

    return redirect()->route('organization.index')
      ->with('success', 'Organization updated successfully.');
  }
}
