<?php

namespace Database\Seeders;

use App\Models\Assignments;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            Assignments::create([
                'module_id'   => $module->id,
                'title'       => "Tugas " . $module->title,
                'description' => "Silakan kerjakan tugas untuk " . strtolower($module->title) . ". Unggah dalam format PDF.",
                'deadline'    => now()->addDays(7), // deadline 7 hari dari sekarang
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
