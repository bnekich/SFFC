<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
  public function run(): void
  {
    $organizationTypes = [
      ['name' => 'Adoption Agency'],
      ['name' => 'Armed Forces'],
      ['name' => 'Business'],
      ['name' => 'Church'],
      ['name' => 'Church as Referral Agency'],
      ['name' => 'Community Services'],
      ['name' => 'Correctional Facility/Court'],
      ['name' => 'Counseling/Mental Health Service'],
      ['name' => 'Crisis Nursery'],
      ['name' => 'Domestic Violence Shelter'],
      ['name' => 'Drug Treatment Program'],
      ['name' => 'Employment Services'],
      ['name' => 'Government'],
      ['name' => 'Help Line'],
      ['name' => 'Homeless Shelter'],
      ['name' => 'Hub'],
      ['name' => 'Human Rights Organization'],
      ['name' => 'Human Trafficking Shelter'],
      ['name' => 'Immigration'],
      ['name' => 'Media/News Service'],
      ['name' => 'Medical/Hospital/Clinic'],
      ['name' => 'Mental Health Services'],
      ['name' => 'Municipal/Fire/Police'],
      ['name' => 'Other'],
      ['name' => 'Parental Self Referral'],
      ['name' => 'Parish'],
      ['name' => 'Pregnancy Counseling'],
      ['name' => 'Private Child Welfare Agency'],
      ['name' => 'Public Child Welfare Agency'],
      ['name' => 'Recreational Center'],
      ['name' => 'School'],
      ['name' => 'Social Service/Ministry'],
      ['name' => 'Teen Parenting Services'],
      ['name' => 'Transitional Living Program'],
      ['name' => 'Transportation Services'],
      ['name' => 'Veteran Services'],

    ];
    foreach ($organizationTypes as $type) {
      \App\Models\OrganizationType::create($type);
    }
  }
}
