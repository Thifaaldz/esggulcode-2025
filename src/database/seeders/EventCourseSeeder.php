<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\EventCourse;
use Illuminate\Database\Seeder;

class EventCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = Branch::inRandomOrder()->first();

        if (!$branch) {
            $this->command->warn('No branches found. Please seed branches first.');
            return;
        }

        EventCourse::create([
            'title' => 'Dasar-Dasar Pemrograman',
            'description' => 'Pelatihan intensif mengenai logika dasar pemrograman untuk pemula.',
            'file_path' => null,
            'branch_id' => $branch->id,
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(5),
            'price' => 300000,
            'category' => 'Coding',
            'image' => null,
        ]);

        EventCourse::create([
            'title' => 'Web Development dengan Laravel',
            'description' => 'Belajar membangun aplikasi web modern menggunakan framework Laravel.',
            'file_path' => null,
            'branch_id' => $branch->id,
            'start_date' => now()->addDays(2),
            'end_date' => now()->addDays(6),
            'price' => 400000,
            'category' => 'Coding',
            'image' => null,
        ]);

        EventCourse::create([
            'title' => 'JavaScript Lanjutan',
            'description' => 'Mendalami konsep lanjutan JavaScript seperti asynchronous, closure, dan module.',
            'file_path' => null,
            'branch_id' => $branch->id,
            'start_date' => now()->addDays(3),
            'end_date' => now()->addDays(7),
            'price' => 350000,
            'category' => 'Coding',
            'image' => null,
        ]);

        EventCourse::create([
            'title' => 'Frontend ReactJS',
            'description' => 'Pelatihan membangun antarmuka web interaktif menggunakan ReactJS.',
            'file_path' => null,
            'branch_id' => $branch->id,
            'start_date' => now()->addDays(4),
            'end_date' => now()->addDays(8),
            'price' => 450000,
            'category' => 'Coding',
            'image' => null,
        ]);

        EventCourse::create([
            'title' => 'Backend NodeJS & Express',
            'description' => 'Pelatihan membuat REST API menggunakan Node.js dan Express.js.',
            'file_path' => null,
            'branch_id' => $branch->id,
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(9),
            'price' => 400000,
            'category' => 'Coding',
            'image' => null,
        ]);

        EventCourse::create([
            'title' => 'Mobile App dengan Flutter',
            'description' => 'Belajar membangun aplikasi mobile multiplatform menggunakan Flutter.',
            'file_path' => null,
            'branch_id' => $branch->id,
            'start_date' => now()->addDays(6),
            'end_date' => now()->addDays(10),
            'price' => 500000,
            'category' => 'Coding',
            'image' => null,
        ]);
    }
}
