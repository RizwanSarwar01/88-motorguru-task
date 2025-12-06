<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Fetch existing roles
        $adminRole = Role::where('name', 'Super Admin')->first();
        $userRole = Role::where('name', 'Admin')->first();

        // Define permissions for each role
        $adminPermissions = [
            'view dashboard',
            'view settings',

            'view permissions',
            'edit permissions',
            'create permissions',
            'delete permissions',

            'view users',
            'create users',
            'edit users',
            'delete users',

            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            'view countries',
            'create countries',
            'edit countries',
            'delete countries',

            'view cities',
            'create cities',
            'edit cities',
            'delete cities',

            'view employees',
            'create employees',
            'edit employees',
            'delete employees',
        ];

        $userPermissions = [
            'view dashboard',
        ];

        // Assign permissions to the admin role
        if ($adminRole) {
            foreach ($adminPermissions as $permission) {
                $perm = Permission::firstWhere('name', $permission);
                if ($perm && !$adminRole->hasPermissionTo($perm)) {
                    $adminRole->givePermissionTo($perm);
                }
            }
        }

        // Assign permissions to the user role
        if ($userRole) {
            foreach ($userPermissions as $permission) {
                $perm = Permission::firstWhere('name', $permission);
                if ($perm && !$userRole->hasPermissionTo($perm)) {
                    $userRole->givePermissionTo($perm);
                }
            }
        }
    }
}
