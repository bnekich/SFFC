<?php

namespace Database\Seeders;

use App\Models\IntakeStatus;
use Illuminate\Database\Seeder;

class IntakeStatusSeeder extends Seeder
{
  public function run(): void
  {
    $intakestatuses = ['First Contact Attempt', 'Second Contact Attempt', 'Third Contact Attempt', 'In Progress', 'Completed', 'Closed', 'Other'];
    foreach ($intakestatuses as $status)
      IntakeStatus::create(['name' => $status]);
  }
}
