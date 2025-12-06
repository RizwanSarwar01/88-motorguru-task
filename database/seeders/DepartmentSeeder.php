<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Human Resources'],
            ['name' => 'Information Technology'],
            ['name' => 'Finance'],
            ['name' => 'Marketing'],
            ['name' => 'Sales'],
            ['name' => 'Operations'],
            ['name' => 'Customer Service'],
            ['name' => 'Research and Development'],
            ['name' => 'Administration'],
            ['name' => 'Legal'],
            ['name' => 'Procurement'],
            ['name' => 'Quality Assurance'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
