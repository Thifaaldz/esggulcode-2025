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
        for ($i = 4; $i <= 30; $i++) {
            Position::insert([
                ['division_id' => $i, 'name' => 'Manager', 'basic_salary' => 12000000.00, 'created_at' => now(), 'updated_at' => now()],
                ['division_id' => $i, 'name' => 'Senior Staff', 'basic_salary' => 8000000.00, 'created_at' => now(), 'updated_at' => now()],
                ['division_id' => $i, 'name' => 'Junior Staff', 'basic_salary' => 5000000.00, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
        
    
    }
}
