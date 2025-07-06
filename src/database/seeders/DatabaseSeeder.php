<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Leave;
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
            RoleSeeder::class,
            PositionSeeder::class,
            BranchSeeder::class,
            EmployeeSeeder::class,
            RoleSeeder::class,
            AttendanceSeeder::class,
            LeaveSeeder::class,
            SalaryPeriodSeeder::class,
            PayrollCategorySeeder::class,
            PayrollDetailSeeder::class,
            EventCourseSeeder::class,
            ModuleSeeder::class,
            AssignmentsSeeder::class,
        ]);
    }
}
