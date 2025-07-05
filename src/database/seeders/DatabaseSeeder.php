<?php

namespace Database\Seeders;

use App\Models\User;
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
            CompanySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
            DivisionSeeder::class,
            BranchSeeder::class,
            PositionSeeder::class,
            EmployeeSeeder::class,
            PayrollCategorySeeder::class,
            SalaryPeriodSeeder::class,
            PayrollDetailSeeder::class,
        ]);
    }
}
