<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a set of default permissions
        $permissions = [
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

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web' // Add this line
            ]);
        }
    }
}
