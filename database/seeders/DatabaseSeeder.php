<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolesSeeder::class,
            PermissionSeeder::class,
            AssignPermissionsSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            DepartmentSeeder::class,
            DesignationSeeder::class,
            NationalitySeeder::class,
        ]);

        // Create a user and assign the "admin" role
        $adminUser = User::factory()->create([
            'name' => 'Rizwan Sarwar',
            'username' => 'rizwan',
            'email' => 'iamrizwansarwar@gmail.com',
        ]);
        $adminUser->assignRole('Super Admin');

    }
}
