<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::insert([
            [
                'company_id' => 1,
                'nama' => 'Cabang Utama',
                'alamat' => 'Jl. Merdeka No.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'nama' => 'Cabang Jakarta',
                'alamat' => 'Jl. Sudirman No.99',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'nama' => 'Cabang Bandung',
                'alamat' => 'Jl. Asia Afrika No.10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
