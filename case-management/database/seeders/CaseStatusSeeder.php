<?php

namespace Database\Seeders;

use App\Models\CaseStatus;
use Illuminate\Database\Seeder;

class CaseStatusSeeder extends Seeder
{
  public function run()
  {
    $caseStatuses = ['Open', 'On Hold', 'Closed', 'Cancelled'];
    foreach ($caseStatuses as $status)
      CaseStatus::create(['name' => $status]);
  }
}
