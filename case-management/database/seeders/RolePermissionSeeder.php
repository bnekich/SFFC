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
            'name' => 'Administrator',
            'email' => 'administrator@example.com',
            'password' => bcrypt('password'),
        ]);

        $familyCoachUser = User::create([
            'name' => 'Family Coach',
            'email' => 'familycoach@example.com',
            'password' => bcrypt('password'),
        ]);

        $volunteerUser = User::create([
            'name' => 'Chris Volunteer',
            'email' => 'cvolunteer@example.com',
            'password' => bcrypt('password'),
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
