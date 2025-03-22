<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use App\Models\PersonType;
use App\Models\RelationshipType;
use App\Models\ReminderType;
use App\Models\CaseModel;
use App\Models\Status;
use App\Models\FormModel;
use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run(): void
    {

        $this->call([
            RolePermissionSeeder::class
        ]);

        Status::factory()->create();
        OrganizationType::factory()->create();
        PersonType::factory()->create();
        RelationshipType::factory()->create();
        ReminderType::factory()->create();
        CaseModel::factory()->count(10)->create();
        FormModel::factory()->create();
        Field::factory()->create();
    }
}
