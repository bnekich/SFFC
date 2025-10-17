<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Person;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'admin-view',
            'auditLogs-view',
            'case-create',
            'case-delete',
            'case-edit',
            'case-view',
            'casenote-create',
            'casenote-delete',
            'casenote-edit',
            'casenote-view',
            'courses-create',
            'courses-delete',
            'courses-edit',
            'courses-view',
            'document-viewAny',
            'document-viewMine',
            'document-upload',
            'document-downloadAny',
            'document-downloadMine',
            'family-create',
            'family-delete',
            'family-edit',
            'family-view',
            'intake-create',
            'intake-delete',
            'intake-edit',
            'intake-view',
            'organization-create',
            'organization-delete',
            'organization-edit',
            'organization-view',
            'permission-create',
            'permission-delete',
            'permission-edit',
            'permission-view',
            'person-create',
            'person-delete',
            'person-edit',
            'person-view',
            'role-create',
            'role-delete',
            'role-edit',
            'role-view',
            'tag-create',
            'tag-delete',
            'tag-edit',
            'tag-view',
            'type-create',
            'type-delete',
            'type-edit',
            'type-view',
            'user-create',
            'user-delete',
            'user-edit',
            'user-view',
            'volunteer-create',
            'volunteer-edit,',
            'volunteer-delete',
            'volunteer-view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'web', 'name' => $permission]);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'Administrator',
            'Director of Development',
            'Donor Administrator',
            'Engagement Coordinator',
            'Family Coach Supervisor',
            'Family Coach',
            'Family Friend',
            'Family Support Specialist',
            'Grants Support Specialist',
            'Host Family Member',
            'Human Resources Manager',
            'Intake Volunteer',
            'Intake Supervisor',
            'Lead Family Coach Supervisor',
            'Ministry Lead',
            'Resource Friend',
            'Served Family Member',
            'Services Director',
            'State Business Operations',
            'State Director',
            'State Event Manager',
            'State Operations Director',
            'State Teams Director',
            'State Volunteer Coordinator',
            'Volunteer',
            'Volunteer Administrator',
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
            'phone' => '(414)303-4050',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        // See AppServiceProvider.php
        $adminRole = Role::findByName('Administrator');
        $adminUser->assignRole($adminRole);

        $qaUser9 = User::create([
            'lastName' => 'Hinze',
            'firstName' => 'Natalie',
            'email' => 'nhinze@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);


        $stateVolunteerCoordinatorRole = Role::findByName('State Volunteer Coordinator');
        $stateVolunteerCoordinatorRole->givePermissionTo([
            'admin-view',
            'auditLogs-view',
            'case-view',
            'casenote-view',
            'courses-create',
            'courses-delete',
            'courses-edit',
            'courses-view',
            'document-viewAny',
            'document-viewMine',
            'document-upload',
            'document-downloadAny',
            'document-downloadMine',
            'family-view',
            'intake-view',
            'organization-create',
            'organization-edit',
            'organization-view',
            'person-create',
            'person-edit',
            'person-view',
            'tag-view',
            'type-create',
            'type-edit',
            'type-view',
            'volunteer-create',
            'volunteer-edit,',
            'volunteer-delete',
            'volunteer-view',
        ]);

        $qaUser9->assignRole($stateVolunteerCoordinatorRole);

        $qaUser1 = User::create([
            'lastName' => 'Thorngate',
            'firstName' => 'Jon',
            'email' => 'jthorngate@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $qaUser1->assignRole($adminRole);

        $qaUser2 = User::create([
            'lastName' => 'Bernhard',
            'firstName' => 'Bethany',
            'email' => 'bbernhard@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $qaUser2->assignRole($adminRole);

        $qaUser3 = User::create([
            'lastName' => 'Petri',
            'firstName' => 'Megan',
            'email' => 'mpetri@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $qaUser3->assignRole($adminRole);

        $qaUser4 = User::create([
            'lastName' => 'Combs',
            'firstName' => 'Amanda',
            'email' => 'acombs@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $qaUser4->assignRole($adminRole);

        $qaUser5 = User::create([
            'lastName' => 'Holm',
            'firstName' => 'Amanda',
            'email' => 'aholm@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $qaUser5->assignRole($adminRole);

        $qaUser6 = User::create([
            'lastName' => 'Johnson-Lyga',
            'firstName' => 'Stacia',
            'email' => 'stacia@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $qaUser6->assignRole($adminRole);

        $qaUser7 = User::create([
            'lastName' => 'Tussoni',
            'firstName' => 'Tracy',
            'email' => 'tracy@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $qaUser7->assignRole($adminRole);

        $qaUser8 = User::create([
            'lastName' => 'Gremminger',
            'firstName' => 'Makayla',
            'email' => 'makayla@example.com',
            'phone' => '(262)111-1111',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);


        $qaUser8->assignRole($adminRole);


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

        // $familyCoachSupervisorUser = User::create([
        //     'lastName' => 'Jones',
        //     'firstName' => 'Emily',
        //     'email' => 'ejones@example.com',
        //     'phone' => '(414)999-9999',
        //     'password' => bcrypt('password'),
        //     'force_password_reset' => false,
        // ]);

        // $familyCoachSupervisorRole = Role::findByName('Family Coach Supervisor');
        // $familyCoachSupervisorRole->givePermissionTo([
        //     'admin-view',
        //     'auditLogs-view',
        //     'case-create',
        //     'case-delete',
        //     'case-edit',
        //     'case-view',
        //     'casenote-create',
        //     'casenote-delete',
        //     'casenote-edit',
        //     'casenote-view',
        //     'courses-create',
        //     'courses-delete',
        //     'courses-edit',
        //     'courses-view',
        //     'document-viewAny',
        //     'document-viewMine',
        //     'document-upload',
        //     'document-downloadAny',
        //     'document-downloadMine',
        //     'family-create',
        //     'family-delete',
        //     'family-edit',
        //     'family-view',
        //     'intake-create',
        //     'intake-delete',
        //     'intake-edit',
        //     'intake-view',
        //     'organization-create',
        //     'organization-delete',
        //     'organization-edit',
        //     'organization-view',
        //     'permission-view',
        //     'person-create',
        //     'person-delete',
        //     'person-edit',
        //     'person-view',
        //     'role-view',
        //     'tag-create',
        //     'tag-delete',
        //     'tag-edit',
        //     'tag-view',
        //     'type-view',
        //     'user-create',
        //     'user-view',
        // ]);
        // $familyCoachSupervisorUser->assignRole($familyCoachSupervisorRole);

        // Person::create([
        //     'first_name' => 'Emily',
        //     'middle_name' => 'Ann',
        //     'last_name' => 'Jones',
        //     'date_of_birth' => '1986-04-11',
        //     'gender' => 'F',
        //     'email' => 'ejones@example.com',
        //     'phone' => '(414)999-9999',
        //     'can_text_reminder' => true,
        //     'can_email_reminder' => true,
        //     'address_id' => $address->id,
        //     'created_by' => 1,
        //     'updated_by' => 1
        // ]);


        // $intakeVolunteerRole = Role::findByName('Intake Volunteer');
        // $intakeVolunteerRole->givePermissionTo([
        //     'case-view',
        //     'case-create',
        //     'case-edit',
        //     'person-view',
        //     'person-create',
        //     'person-edit',
        //     'intake-view',
        //     'intake-create',
        //     'intake-edit',
        // ]);

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
