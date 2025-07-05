<?php

namespace Database\Seeders;

use App\Models\PayrollCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayrollCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // --- Pendapatan (Income) ---
            ['name' => 'Gaji Pokok', 'type' => 'pendapatan'],
            ['name' => 'Tunjangan Jabatan', 'type' => 'pendapatan'],
            ['name' => 'Tunjangan Transportasi', 'type' => 'pendapatan'],
            ['name' => 'Tunjangan Makan', 'type' => 'pendapatan'],
            ['name' => 'Uang Lembur', 'type' => 'pendapatan'],
            ['name' => 'Bonus Kinerja', 'type' => 'pendapatan'],
            ['name' => 'Bonus Kehadiran', 'type' => 'pendapatan'], // ⬅️ Tambahan ini
        
            // --- Potongan (Deductions) ---
            ['name' => 'Potongan BPJS Kesehatan', 'type' => 'potongan'],
            ['name' => 'Potongan BPJS Ketenagakerjaan', 'type' => 'potongan'],
            ['name' => 'Pajak Penghasilan (PPh 21)', 'type' => 'potongan'],
            ['name' => 'Potongan Keterlambatan', 'type' => 'potongan'],
            ['name' => 'Potongan Ketidakhadiran', 'type' => 'potongan'],
        ];
        

        // Loop through the categories and use firstOrCreate.
        // This will check for a record with the same 'name' and 'type'.
        // If it doesn't exist, it will be created.
        foreach ($categories as $category) {
            PayrollCategory::firstOrCreate(
                [
                    'name' => $category['name'],
                    'type' => $category['type']
                ]
            );
        }
    }
}
