<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
  public function run(): void
  {
    $organizationTypes = [
      [
        'name' => 'Church Partner',
        'description' => 'Church Partner Organization'
      ],
      [
        'name' => 'Non-Profit',
        'description' => 'Non-Profit Organization'
      ],
      [
        'name' => 'For-Profit',
        'description' => 'For-Profit Organization'
      ],
      [
        'name' => 'Government',
        'description' => 'Government Organization'
      ],
      [
        'name' => 'Educational',
        'description' => 'Educational Institution'
      ],
      [
        'name' => 'Healthcare',
        'description' => 'Healthcare Organization'
      ],
    ];
    foreach ($organizationTypes as $type) {
      \App\Models\OrganizationType::create($type);
    }
  }
}
