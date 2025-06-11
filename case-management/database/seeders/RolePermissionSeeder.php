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
            'cases-delete',
            'cases-edit',
            'cases-view',
            'casenotes-create',
            'casenotes-delete',
            'casenotes-edit',
            'casenotes-view',
            'courses-create',
            'courses-delete',
            'courses-edit',
            'courses-view',
            'documents-viewAny',
            'documents-viewMine',
            'documents-upload',
            'documents-downloadAny',
            'documents-downloadMine',
            'families-create',
            'families-delete',
            'families-edit',
            'families-view',
            'intake-create',
            'intake-delete',
            'intake-edit',
            'intake-view',
            'organizations-create',
            'organizations-delete',
            'organizations-edit',
            'organizations-view',
            'permissions-create',
            'permissions-delete',
            'permissions-edit',
            'permissions-view',
            'persons-create',
            'persons-delete',
            'persons-edit',
            'persons-view',
            'roles-create',
            'roles-delete',
            'roles-edit',
            'roles-view',
            'tags-create',
            'tags-delete',
            'tags-edit',
            'tags-view',
            'types-create',
            'types-delete',
            'types-edit',
            'types-view',
            'users-create',
            'users-delete',
            'users-edit',
            'users-view',
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

        $adminUser = User::create([
            'lastName' => 'Nekich',
            'firstName' => 'Bruce',
            'email' => 'bnekich@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $adminRole = Role::findByName('Administrator');
        $adminRole->givePermissionTo(Permission::all());
        $adminUser->assignRole($adminRole);

        $address = Address::create([
            'address_line_1' => '123 Main St',
            'address_line_2' => 'Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zip' => '10001',
            'created_by' => null,
            'updated_by' => null
        ]);

        Person::create([
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
            'created_by' => null,
            'updated_by' => null
        ]);

        $familyCoachSupervisorUser = User::create([
            'lastName' => 'Jones',
            'firstName' => 'Emily',
            'email' => 'ejones@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $familyCoachSupervisorRole = Role::findByName('Family Coach Supervisor');
        $familyCoachSupervisorRole->givePermissionTo([
            'admin-view',
            'auditLogs-view',
            'cases-create',
            'cases-delete',
            'cases-edit',
            'cases-view',
            'casenotes-create',
            'casenotes-delete',
            'casenotes-edit',
            'casenotes-view',
            'courses-create',
            'courses-delete',
            'courses-edit',
            'courses-view',
            'documents-viewAny',
            'documents-viewMine',
            'documents-upload',
            'documents-downloadAny',
            'documents-downloadMine',
            'families-create',
            'families-delete',
            'families-edit',
            'families-view',
            'intake-create',
            'intake-delete',
            'intake-edit',
            'intake-view',
            'organizations-create',
            'organizations-delete',
            'organizations-edit',
            'organizations-view',
            'permissions-view',
            'persons-create',
            'persons-delete',
            'persons-edit',
            'persons-view',
            'roles-view',
            'tags-create',
            'tags-delete',
            'tags-edit',
            'tags-view',
            'types-view',
            'users-create',
            'users-view',
        ]);
        $familyCoachSupervisorUser->assignRole($familyCoachSupervisorRole);

        Person::create([
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
            'created_by' => 1,
            'updated_by' => 1
        ]);


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

        // $volunteerPerson = Person::create([
        //     'first_name' => 'Kristen',
        //     'middle_name' => 'Elizabeth',
        //     'last_name' => 'Smith',
        //     'date_of_birth' => '1983-06-12',
        //     'gender' => 'F',
        //     'email' => 'ksmith@example.com',
        //     'phone' => '(414)999-9998',
        //     'can_text_reminder' => true,
        //     'can_email_reminder' => true,
        //     'address_id' => $address->id,
        //     'created_by' => 1,
        //     'updated_by' => 1
        // ]);

        // $volunteerUser = User::create([
        //     'person_id' => $volunteerPerson->id,
        //     'lastName' => 'Smith',
        //     'firstName' => 'Kristen',
        //     'email' => 'ksmith@example.com',
        //     'password' => bcrypt('password'),
        //     'force_password_reset' => false,
        // ]);

        // $volunteerUser->assignRole($intakeVolunteerRole);
    }
}
