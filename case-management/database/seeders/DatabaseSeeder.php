<?php

namespace Database\Seeders;

use App\Models\RelationshipType;
use App\Models\ReminderType;
use App\Models\CaseModel;
use App\Models\Course;
use App\Models\Family;
use App\Models\Status;
use App\Models\FormModel;
use App\Models\Field;
use App\Models\Intake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CaseNote;

class DatabaseSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run(): void
    {
        Status::factory()->create();
        RelationshipType::factory()->create();
        ReminderType::factory()->create();
        $this->call([
            RolePermissionSeeder::class,
            PersonSeeder::class,
            UserSeeder::class,
            OrganizationTypeSeeder::class,
            OrganizationSeeder::class,
            TagSeeder::class,
        ]);
        Intake::factory()->count(100)->create();
        Family::factory()->count(100)->create();
        CaseModel::factory()->count(100)->create();
        // FormModel::factory()->create();
        // Field::factory()->create();
        Course::factory()->count(20)->create();
        CaseNote::factory()->count(100)->create();
    }
}
