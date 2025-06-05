<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\PersonFormRequest;
use App\Models\Person;
use App\Models\User;
use App\Models\Address;
use App\Enums\Gender;
use App\Enums\USState;
use App\Models\Organization;
use Spatie\Permission\Models\Role;
use App\Enums\Ethnicity;

class PersonController extends Controller
{
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
        $successMessage = "";
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

        $person = Person::create([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'] ?? null,
            'last_name' => $validatedData['last_name'],
            'date_of_birth' => $validatedData['date_of_birth'] ?? null,
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'can_text_reminder' => $validatedData['can_text_reminder'] ?? false,
            'can_email_reminder' => $validatedData['can_email_reminder'] ?? false,
            'address_id' => $address ? $address->id : null,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        if ($request->has('family_ids')) {
            $person->families()->sync($request->input('family_ids'));
        }

        if ($request->has('org_ids')) {
            $person->organizations()->sync($request->input('org_ids'));
        }

        $tempPassword = Str::random(12);
        $user = User::create([
            'person_id' => $person->id,
            'firstName' => $validatedData['first_name'],
            'lastName' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($tempPassword),
            'force_password_reset' => true,
        ]);

        if ($request->input('isSystemUser', 0)) {
            if (!empty($request->auth_roles)) {
                $user->assignRole(array_map('intval', $request->auth_roles));
                $this->logAction('Assigned Authorization Roles', 'store', 'Person', $person->id);
            }

            $successMessage .= " Temporary password is " . $tempPassword;
            $this->logAction('Added as System User', 'store', 'Person', $person->id);
        } else {
            $user->assignRole('Client');
        }

        $successMessage .= " Person created successfully.";
        $this->logAction('Added Person', 'store', 'Person', $person->id);
        return redirect()->route('person.index')->with('success', $successMessage);
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
        //$updater = auth()->user()->firstName . ' ' . auth()->user()->lastName;

        $person->update([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'] ?? null,
            'last_name' => $validatedData['last_name'],
            'date_of_birth' => $validatedData['date_of_birth'] ?? null,
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'can_text_reminder' => $validatedData['can_text_reminder'] ?? false,
            'can_email_reminder' => $validatedData['can_email_reminder'] ?? false,
            'updated_by' => auth()->id(),
        ]);

        // Update or create address
        if (!empty(array_filter([
            $validatedData['address_line_1'] ?? null,
            $validatedData['address_line_2'] ?? null,
            $validatedData['city'] ?? null,
            $validatedData['state'] ?? null,
            $validatedData['zip'] ?? null,
        ]))) {
            if ($person->address) {
                $person->address->update([
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
                $person->address()->associate($address)->save();
            }
        } elseif ($person->address) {
            // If all address fields are empty and an address exists, you might want to delete it
            // TODO: Confirm with the client if this is the desired behavior    
            //$person->address->delete();
            //$person->address_id = null;
            //$person->save();
        }

        if ($request->has('family_ids')) {
            $person->families()->sync($request->input('family_ids'));
        }

        if ($request->has('org_ids')) {
            $person->organizations()->sync($request->input('org_ids'));
        }

        if (isset($request['auth_roles'])) {
            $person->user->roles()->sync($request['auth_roles']);
            $this->logAction('Updated Authorization Roles', 'update', 'Person', $person->id);
        }

        $this->logAction('Updated Person', 'update', 'Person', $person->id);

        return redirect()->route('person.index')->with('success', 'Person updated successfully.');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        $this->logAction('Deleted Person', 'destroy', 'Person', $person->id);
        return redirect()->route('person.index')->with('success', 'Person deleted successfully.');
    }
}
