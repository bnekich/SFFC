<?php

namespace Database\Seeders;

use App\Models\IntakeOutcome;
use Illuminate\Database\Seeder;

class IntakeOutcomeSeeder extends Seeder
{
  public function run(): void
  {
    $intakeOutcomes = ['Open', 'Pending', 'Not Open'];
    foreach ($intakeOutcomes as $status)
      IntakeOutcome::create(['name' => $status]);
  }
}
