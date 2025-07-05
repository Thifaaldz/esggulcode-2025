<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            [
                'company_id' => 1,
                'nama' => 'Human Resources',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'nama' => 'Marketing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'nama' => 'IT Support',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
