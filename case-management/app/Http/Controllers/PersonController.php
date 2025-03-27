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
use Spatie\Permission\Models\Role;

class PersonController extends Controller
{
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

        $sort = $request->get('sort', 'last_name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $persons = $query->paginate(10);

        return view('person.index', compact('persons'));
    }

    public function create()
    {
        $this->logAction("Create Person", "create", "Person");
        $processRoles = Role::where('role_type', 'process')->get();
        $authRoles = Role::where('role_type', 'authorization')->get();
        return view('person.create', compact('processRoles', 'authRoles'));
    }

    public function store(PersonFormRequest $request)
    {
        $data = $request->validated();
        $createdBy = auth()->user()->firstName . ' ' . auth()->user()->lastName;

        // Create the address if any address fields are provided
        $address = null;
        if (!empty(array_filter([
            $data['address_line_1'] ?? null,
            $data['address_line_2'] ?? null,
            $data['city'] ?? null,
            $data['state'] ?? null,
            $data['zip'] ?? null,
        ]))) {
            $address = Address::create([
                'address_line_1' => $data['address_line_1'] ?? null,
                'address_line_2' => $data['address_line_2'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'zip' => $data['zip'] ?? null,
                'created_by' => $createdBy,
                'updated_by' => $createdBy,
            ]);
        }

        $person = Person::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?? null,
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'gender' => $data['gender'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'can_text_reminder' => $data['can_text_reminder'] ?? false,
            'can_email_reminder' => $data['can_email_reminder'] ?? false,
            'address_id' => $address ? $address->id : null,
            'created_by' => $createdBy,
            'updated_by' => $createdBy,
        ]);

        $successMessage = "Person created successfully.";

        // Attach Process Roles (always applicable)
        if (!empty($request->process_roles)) {
            $person->processRoles()->attach($request->process_roles);
            $this->logAction('Assigned Process Roles', 'store', 'Person', $person->id);
        }

        // Handle System User and Authorization Roles
        if ($request->input('isSystemUser', 0)) {
            $tempPassword = Str::random(12);

            $user = User::create([
                'person_id' => $person->id,
                'firstName' => $data['first_name'],
                'lastName' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($tempPassword),
                'force_password_reset' => true,
            ]);

            // Assign Authorization Roles (if provided)
            if (!empty($request->auth_roles)) {
                $user->assignRole(array_map('intval', $request->auth_roles));
                $this->logAction('Assigned Authorization Roles', 'store', 'Person', $person->id);
            }

            $successMessage .= " Temporary password is " . $tempPassword;
            $this->logAction('Added as System User', 'store', 'Person', $person->id);
        }

        $this->logAction('Added Person', 'store', 'Person', $person->id);
        return redirect()->route('person.index')->with('success', $successMessage);
    }

    public function show(Person $person)
    {
        return view('person.show', compact('person'));
    }

    public function edit(Person $person)
    {
        return view('person.edit', compact('person'));
    }

    public function update(PersonFormRequest $request, Person $person)
    {
        $data = $request->validated();
        $updater = auth()->user()->firstName . ' ' . auth()->user()->lastName;

        $person->update([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?? null,
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'gender' => $data['gender'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'can_text_reminder' => $data['can_text_reminder'] ?? false,
            'can_email_reminder' => $data['can_email_reminder'] ?? false,
            'updated_by' => $updater,
        ]);

        // Update or create address
        if (!empty(array_filter([
            $data['address_line_1'] ?? null,
            $data['address_line_2'] ?? null,
            $data['city'] ?? null,
            $data['state'] ?? null,
            $data['zip'] ?? null,
        ]))) {
            if ($person->address) {
                $person->address->update([
                    'address_line_1' => $data['address_line_1'] ?? null,
                    'address_line_2' => $data['address_line_2'] ?? null,
                    'city' => $data['city'] ?? null,
                    'state' => $data['state'] ?? null,
                    'zip' => $data['zip'] ?? null,
                    'updated_by' => $updater,
                ]);
            } else {
                $address = Address::create([
                    'address_line_1' => $data['address_line_1'] ?? null,
                    'address_line_2' => $data['address_line_2'] ?? null,
                    'city' => $data['city'] ?? null,
                    'state' => $data['state'] ?? null,
                    'zip' => $data['zip'] ?? null,
                    'created_by' => $updater,
                    'updated_by' => $updater,
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
        //$person->update($data);

        return redirect()->route('person.index')->with('success', 'Person updated successfully.');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('person.index')->with('success', 'Person deleted successfully.');
    }
}
