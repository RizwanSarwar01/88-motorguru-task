<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['name' => 'Chief Executive Officer'],
            ['name' => 'Chief Technology Officer'],
            ['name' => 'Chief Financial Officer'],
            ['name' => 'Director'],
            ['name' => 'Manager'],
            ['name' => 'Senior Manager'],
            ['name' => 'Assistant Manager'],
            ['name' => 'Team Lead'],
            ['name' => 'Senior Developer'],
            ['name' => 'Developer'],
            ['name' => 'Junior Developer'],
            ['name' => 'Senior Analyst'],
            ['name' => 'Business Analyst'],
            ['name' => 'HR Manager'],
            ['name' => 'HR Executive'],
            ['name' => 'Accountant'],
            ['name' => 'Senior Accountant'],
            ['name' => 'Marketing Manager'],
            ['name' => 'Marketing Executive'],
            ['name' => 'Sales Manager'],
            ['name' => 'Sales Executive'],
            ['name' => 'Customer Support Representative'],
            ['name' => 'Administrative Assistant'],
            ['name' => 'Executive Assistant'],
            ['name' => 'Intern'],
        ];

        foreach ($designations as $designation) {
            Designation::create($designation);
        }
    }
}
