<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::insert([
            [
                'division_id' => 1,
                'name' => 'Manager',
                'basic_salary' => 12000000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => 1,
                'name' => 'Senior Staff',
                'basic_salary' => 8000000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => 1,
                'name' => 'Junior Staff',
                'basic_salary' => 5000000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
