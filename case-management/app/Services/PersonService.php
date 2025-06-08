<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Person;
use App\Models\Address;
use App\Models\User;
use App\Http\Requests\PersonFormRequest;
use App\Services\Responses\PersonServiceResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonService
{
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
      }


      return new PersonServiceResponse($person);
    });
  }


  public function createPerson(array $data, PersonFormRequest $request): PersonServiceResponse
  {
    return DB::transaction(function () use ($data, $request) {
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

      $tempPassword = Str::random(12);
      $user = User::create([
        'person_id' => $person->id,
        'firstName' => $data['first_name'],
        'lastName' => $data['last_name'],
        'email' => $data['email'],
        'password' => Hash::make($tempPassword),
        'force_password_reset' => true,
      ]);

      if ($request->input('isSystemUser', 0)) {
        if (!empty($request->auth_roles)) {
          $user->assignRole(array_map('intval', $request->auth_roles));
          //$this->logAction('Assigned Authorization Roles', 'store', 'Person', $person->id);
        }

        //$this->logAction('Added as System User', 'store', 'Person', $person->id);
      } else {
        $user->assignRole('Client');
      }

      return new PersonServiceResponse($person, $tempPassword);
    });
  }
}
