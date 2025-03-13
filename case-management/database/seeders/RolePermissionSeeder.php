<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::create([
            'lastName' => 'Nekich',
            'firstName' => 'Bruce',
            'email' => 'bnekich@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $familyCoachUser = User::create([
            'lastName' => 'Jones',
            'firstName' => 'Sally',
            'email' => 'sjones@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        $volunteerUser = User::create([
            'lastName' => 'Doe',
            'firstName' => 'John',
            'email' => 'jdoe@example.com',
            'password' => bcrypt('password'),
            'force_password_reset' => false,
        ]);

        // Create permissions
        $permissions = [
            'create cases',
            'edit cases',
            'delete cases',
            'view cases',
            'manage users',
            'manage roles',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'Administrator']);
        $adminRole->givePermissionTo(Permission::all());
        $adminUser->assignRole($adminRole);

        $volunteer = Role::create(['name' => 'Volunteer']);
        $volunteer->givePermissionTo([
            'view cases'
        ]);
        $volunteerUser->assignRole($volunteer);

        $familyCoach = Role::create(['name' => 'Family Coach']);
        $familyCoach->givePermissionTo([
            'create cases',
            'edit cases',
            'view cases',
        ]);
        $familyCoachUser->assignRole($familyCoach);
    }
}
