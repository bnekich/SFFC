<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrganizationType;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $organizationTypes = OrganizationType::all();
        // if ($organizationTypes->isEmpty()) {
        //     $this->call(OrganizationTypeSeeder::class);
        //     $organizationTypes = OrganizationType::all();
        // }

        $organizations = [
            [
                'name' => 'Safe Families for Children - Madison',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'contact_person_name' => 'Bethany Bernhard',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - Greater Milwaukee',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'contact_person_name' => 'Bethany Bernhard',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - Green Bay / Fox Cities',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - La Crosse',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - Jefferson/Dodge',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'contact_person_name' => 'Amanda Combs',
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - Racine and Kenosha',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - Rock County',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - Southern Lakes',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Safe Families for Children - Dane County',
                'organization_type_id' => $organizationTypes->where('name', 'Safe Families for Children')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'name' => 'River Valley Alliance Church',
                'organization_type_id' => $organizationTypes->where('name', 'Church')->first()->id,
                'contact_person_name' => 'Amee Merton',
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Generac',
                'organization_type_id' => $organizationTypes->where('name', 'Business')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Dodge County Health Department',
                'organization_type_id' => $organizationTypes->where('name', 'Public Child Welfare Agency')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'University of Wisconsin - Madison',
                'organization_type_id' => $organizationTypes->where('name', 'School')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Aurora Health Care',
                'organization_type_id' => $organizationTypes->where('name', 'Medical/Hospital/Clinic')->first()->id,
                'address_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

        ];

        foreach ($organizations as $organization) {
            Organization::create($organization);
        }
    }
}
