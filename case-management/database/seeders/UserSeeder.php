<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Person::all()->each(function ($person) {
            User::factory()->create([
                'person_id' => $person->id,
                'firstName' => $person->first_name,
                'lastName' => $person->last_name,
                'email' => $person->email
            ]);
        });
    }
}
