<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Person;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'admin-view',
            'auditLogs-view',
            'cases-create',
            'cases-edit',
            'cases-delete',
            'cases-view',
            'intake-create',
            'intake-edit',
            'intake-delete',
            'intake-view',
            'families-view',
            'families-create',
            'families-edit',
            'families-delete',
            'users-create',
            'users-edit',
            'users-delete',
            'users-view',
            'roles-create',
            'roles-edit',
            'roles-delete',
            'roles-view',
            'permissions-create',
            'permissions-edit',
            'permissions-delete',
            'permissions-view',
            'persons-create',
            'persons-edit',
            'persons-delete',
            'persons-view',
            'types-create',
            'types-edit',
            'types-delete',
            'types-view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'Administrator',
            'State Director',
            'State Operations Director',
            'State Teams Director',
            'Lead Family Coach Supervisor',
            'Services Director',
            'Grants Support Specialist',
            'State Volunteer Coordinator',
            'State Business Operations',
            'State Event Manager',
            'Human Resources Manager',
            'Director of Development',
            'Engagement Coordinator',
            'Family Coach Supervisor',
            'Intake Volunteer',
            'Intake Supervisor',
            'Donor Administrator',
            'Volunteer Administrator',
            'Family Support Specialist',
            'Client',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        $address = Address::create([
            'address_line_1' => '123 Main St',
            'address_line_2' => 'Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zip' => '10001',
            'created_by' => 'system',
            'updated_by' => 'system'
        ]);

        $adminPerson = Person::create([
            'first_name' => 'Bruce',
            'middle_name' => 'James',
            'last_name' => 'Nekich',
            'date_of_birth' => '1954-03-11',
            'gender' => 'M',
            'email' => 'bnekich@example.com',
            'phone' => '(414)303-4050',
            'can_text_reminder' => true,
            'can_email_reminder' => true,
            'address_id' => $address->id,
            'created_by' => 'system',
            'updated_by' => 'system'
        ]);



        $adminUser = User::create([
            'person_id' => $adminPerson->id,
            'lastName' => 'Nekich',
            'firstName' => 'Bruce',
            'email' => 'bnekich@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $adminRole = Role::findByName('Administrator');
        $adminRole->givePermissionTo(Permission::all());
        $adminUser->assignRole($adminRole);

        $familyCoachSupervisorPerson = Person::create([
            'first_name' => 'Emily',
            'middle_name' => 'Ann',
            'last_name' => 'Jones',
            'date_of_birth' => '1986-04-11',
            'gender' => 'F',
            'email' => 'ejones@example.com',
            'phone' => '(414)999-9999',
            'can_text_reminder' => true,
            'can_email_reminder' => true,
            'address_id' => $address->id,
            'created_by' => 'system',
            'updated_by' => 'system'
        ]);
        $familyCoachSupervisorUser = User::create([
            'person_id' => $familyCoachSupervisorPerson->id,
            'lastName' => 'Jones',
            'firstName' => 'Emily',
            'email' => 'ejones@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $familyCoachSupervisorRole = Role::findByName('Family Coach Supervisor');
        $familyCoachSupervisorRole->givePermissionTo([
            'cases-view',
            'cases-create',
            'cases-edit',
            'cases-delete',
            'persons-view',
            'persons-create',
            'persons-edit',
            'intake-view',
            'intake-create',
            'intake-edit',
            'intake-delete',
        ]);
        $familyCoachSupervisorUser->assignRole($familyCoachSupervisorRole);

        $intakeVolunteerRole = Role::findByName('Intake Volunteer');
        $intakeVolunteerRole->givePermissionTo([
            'cases-view',
            'cases-create',
            'cases-edit',
            'persons-view',
            'persons-create',
            'persons-edit',
            'intake-view',
            'intake-create',
            'intake-edit',
        ]);

        $volunteerPerson = Person::create([
            'first_name' => 'Kristen',
            'middle_name' => 'Elizabeth',
            'last_name' => 'Smith',
            'date_of_birth' => '1983-06-12',
            'gender' => 'F',
            'email' => 'ksmith@example.com',
            'phone' => '(414)999-9998',
            'can_text_reminder' => true,
            'can_email_reminder' => true,
            'address_id' => $address->id,
            'created_by' => 'system',
            'updated_by' => 'system'
        ]);

        $volunteerUser = User::create([
            'person_id' => $volunteerPerson->id,
            'lastName' => 'Smith',
            'firstName' => 'Kristen',
            'email' => 'ksmith@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $volunteerUser->assignRole($intakeVolunteerRole);
    }
}
