<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\PersonFormRequest;
use App\Mail\TemporaryPasswordEmail;
use App\Models\Address;
use App\Models\Person;
use App\Models\User;
use App\Models\Volunteer;
use App\Services\Responses\PersonServiceResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class PersonService
{
    public function searchPersons(string $query, int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return Person::where('last_name', 'like', "%{$query}%")
            ->orWhere('first_name', 'like', "%{$query}%")
            ->paginate($perPage);
    }

    public function getAuthorizedRoles()
    {

        // if (auth()->user()->can('volunteer-create')) {
        //     return Role::where('name', '=', 'Volunteer')->orWhere('name', '=', 'State Volunteer Coordinator')->get();;
        // }

        return  Role::all();
    }

    public function getPersons(array $filters = [], array $sort = []): LengthAwarePaginator
    {
        $query = Person::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('last_name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['organization'])) {
            $query->whereHas('organizations', function ($q) use ($filters) {
                $q->where('organizations.id', $filters['organization']);
            });
        }

        $sort['field'] = $sort['field'] ?? 'last_name';
        $sort['direction'] = $sort['direction'] ?? 'asc';
        $query->orderBy($sort['field'], $sort['direction']);

        return $query->paginate(10);
    }

    public function updatePerson(array $data, PersonFormRequest $request): PersonServiceResponse
    {
        return DB::transaction(function () use ($data, $request) {
            $person = $request->person;
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
                'updated_by' => auth()->id(),
            ]);

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
                        'updated_by' => auth()->id(),
                    ]);
                } else {
                    $address = Address::create([
                        'address_line_1' => $data['address_line_1'] ?? null,
                        'address_line_2' => $data['address_line_2'] ?? null,
                        'city' => $data['city'] ?? null,
                        'state' => $data['state'] ?? null,
                        'zip' => $data['zip'] ?? null,
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);
                    $person->address()->associate($address)->save();
                }
            }

            if ($request->has('family_ids')) {
                $person->families()->sync($request->input('family_ids'));
            }

            if ($request->has('org_ids')) {
                $person->organizations()->sync($request->input('org_ids'));
            }

            // if (isset($request['auth_roles'])) {
            //     $person->user->roles()->sync($request['auth_roles']);
            // }

            return new PersonServiceResponse($person);
        });
    }

    public function createPerson(array $data, PersonFormRequest $request, bool $isVolunteer): PersonServiceResponse
    {
        $tempPassword = "";
        $person = null;
        $user = null;
        $volunteer = null;

        DB::transaction(function () use ($data, $request, &$person, &$user, &$tempPassword, $isVolunteer, &$volunteer) {
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
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
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
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            if ($request->has('family_ids')) {
                $person->families()->sync($request->input('family_ids'));
            }

            if ($request->has('org_ids')) {
                $person->organizations()->sync($request->input('org_ids'));
            }

            if ($request->input('isSystemUser', 0)) {
                // TODO change when deployed to production
                //$tempPassword = Str::random(12);
                $tempPassword = "tmp-password";
                $user = User::create([
                    'firstName' => $data['first_name'],
                    'lastName' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => Hash::make($tempPassword),
                    'force_password_reset' => true,
                ]);
                if (!empty($request->auth_roles)) {
                    $user->assignRole(array_map('intval', $request->auth_roles));
                    if ($isVolunteer) {
                        $volunteer = Volunteer::create([
                            'person_id' => $person->id,
                            'volunteer_status_id' => 1,
                            'created_by' => auth()->id(),
                            'updated_by' => auth()->id(),
                        ]);
                    }
                }
            }
        });

        // TODO uncomment before production deployment
        //if ($request->input('isSystemUser', 0) && $user) {
        //    Mail::to($user->email)->send(new TemporaryPasswordEmail($user, $tempPassword));
        //}

        return new PersonServiceResponse($person, $volunteer, $tempPassword);
    }

    public function deletePerson(Person $person): void
    {
        DB::transaction(function () use ($person) {
            $person->delete();
        });
    }
}
