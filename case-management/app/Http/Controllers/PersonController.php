<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonFormRequest;
use App\Models\Person;
use App\Models\Address;
use App\Enums\Gender;
use App\Enums\USState;
use App\Models\Organization;
use Spatie\Permission\Models\Role;
use App\Enums\Ethnicity;
use App\Services\PersonService;

class PersonController extends Controller
{
    protected PersonService $personService;
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }


    public function search(Request $request)
    {
        $this->logAction("Searched Persons", "search", "Person");
        $query = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 10;

        $persons = Person::where('last_name', 'like', "%{$query}%")
            ->paginate($perPage);

        return response()->json([
            'items' => $persons->items(),
            'current_page' => $persons->currentPage(),
            'last_page' => $persons->lastPage()
        ]);
    }

    public function index(Request $request)
    {
        $this->logAction("Viewed Persons", "index", "Person");

        $query = Person::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('last_name', 'like', "%$search%")
                    ->orWhere('first_name', 'like', "%$search%");
            });
        }

        // Apply organization filter
        if ($request->filled('organization')) {
            $query->whereHas('organizations', function ($q) use ($request) {
                $q->where('organizations.id', $request->organization);
            });
        }

        $sort = $request->get('sort', 'last_name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $persons = $query->paginate(10);
        $organizations = Organization::all()->sortBy('name');
        return view('person.index', compact('persons', 'organizations'));
    }

    public function create()
    {
        $this->logAction("Create Person", "create", "Person");
        $allRoles = Role::all();
        $genders = Gender::cases();
        $states = USState::cases();
        $address = new Address();
        $ethnicities = Ethnicity::cases();

        return view('person.create', compact('allRoles', 'genders', 'states', 'address', 'ethnicities'));
    }

    public function store(PersonFormRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $response = $this->personService->createPerson($validatedData, $request);
            $this->logAction("Created Person", "store", "Person", $response->person->id);
            $successMessage = " Person created successfully. Temporary Password is " . $response->tempPassword;
            $person = $response->person;
            return redirect()->route('person.show', $person)->with('success', $successMessage);
        } catch (\DomainException $e) {
            return back()->withInput()->with('error', 'Failed to create person: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred while creating the person.');
        }
    }

    public function show(Person $person)
    {
        $this->logAction("Viewed Person", "show", "Person", $person->id);
        return view('person.show', compact('person'));
    }

    public function edit(Person $person)
    {
        $this->logAction("Edit Person", "edit", "Person", $person->id);
        $states = USState::cases();
        $allRoles = Role::all();
        $genders = Gender::cases();

        return view('person.edit', compact('person', 'states', 'allRoles', 'genders'));
    }

    public function update(PersonFormRequest $request, Person $person)
    {
        $validatedData = $request->validated();

        try {
            $response = $this->personService->updatePerson($validatedData, $request);
            $this->logAction("Created Person", "store", "Person", $response->person->id);
            $successMessage = "Person updated successfully.";
            $person = $response->person;
            return redirect()->route('person.show', $person)->with('success', $successMessage);
        } catch (\DomainException $e) {
            return back()->withInput()->with('error', 'Failed to create person: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred while creating the person.');
        }
    }

    public function destroy(Person $person)
    {
        $person->delete();
        $this->logAction('Deleted Person', 'destroy', 'Person', $person->id);
        return redirect()->route('person.index')->with('success', 'Person deleted successfully.');
    }
}
