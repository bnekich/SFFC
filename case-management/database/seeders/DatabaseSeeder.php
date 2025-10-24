<?php

namespace Database\Seeders;

use App\Models\RelationshipType;
use App\Models\ReminderType;
use App\Models\CaseModel;
use App\Models\Course;
use App\Models\Family;
use App\Models\NoteStatus;
use App\Models\FormModel;
use App\Models\Field;
use App\Models\Intake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CaseNote;
use App\Models\NotePrivacy;
use App\Models\PersonsOrganizations;
use App\Models\Volunteer;
use App\Models\VolunteerStatus;

class DatabaseSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run(): void
    {
        RelationshipType::factory()->create();
        ReminderType::factory()->create();
        $this->call([
            RolePermissionSeeder::class,
            PersonSeeder::class,
            OrganizationTypeSeeder::class,
            OrganizationSeeder::class,
            TagSeeder::class,
            CaseStatusSeeder::class,
            IntakeStatusSeeder::class,
            IntakeOutcomeSeeder::class,
            VolunteerStatusSeeder::class,
            NoteStatusSeeder::class,
            NotePrivacySeeder::class,
        ]);
        Intake::factory()->count(100)->create();
        Family::factory()->count(100)->create();
        CaseModel::factory()->count(100)->create();
        Course::factory()->count(20)->create();
        CaseNote::factory()->count(100)->create();
        Volunteer::factory()->count(25)->create();
        PersonsOrganizations::factory()->count(99)->create();
    }
}
