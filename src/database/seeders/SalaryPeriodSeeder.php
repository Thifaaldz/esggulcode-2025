<?php

namespace Database\Seeders;

use App\Models\SalaryPeriod;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yearToSeed = 2025;
        for ($month = 1; $month <= 12; $month++) {
            SalaryPeriod::firstOrCreate([
                'month' => $month,
                'year' => $yearToSeed,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }
}
}
