<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\OrganizationType;
use App\Models\PersonType;
use App\Models\RelationshipType;
use App\Models\ReminderType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        OrganizationType::factory()->create();
        PersonType::factory()->create();
        RelationshipType::factory()->create();
        ReminderType::factory()->create();
    }
}
