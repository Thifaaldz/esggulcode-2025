<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::insert([
            [
                'department_id' => 1,
                'nama' => 'Recruitment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama' => 'Employee Relations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama' => 'Training & Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
