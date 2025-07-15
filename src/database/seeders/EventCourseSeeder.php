<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\EventCourse;
use Illuminate\Database\Seeder;

class EventCourseSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $instructorIds = [3, 4, 7]; // Ganti sesuai data real

        if ($branches->isEmpty()) {
            $this->command->warn('Branch tidak ditemukan. Seeder EventCourse dibatalkan.');
            return;
        }

        $topics = [
            [
                'title' => 'Bootcamp Pemrograman Website Dasar',
                'image' => 'https://images.pexels.com/photos/1181671/pexels-photo-1181671.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp Front-End Development',
                'image' => 'https://images.pexels.com/photos/3861954/pexels-photo-3861954.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp Back-End Development',
                'image' => 'https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp Full-Stack Web Development',
                'image' => 'https://images.pexels.com/photos/574071/pexels-photo-574071.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp Laravel dan PHP',
                'image' => 'https://images.pexels.com/photos/1181304/pexels-photo-1181304.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp JavaScript dan React',
                'image' => 'https://images.pexels.com/photos/2102416/pexels-photo-2102416.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp HTML, CSS, dan Bootstrap',
                'image' => 'https://images.pexels.com/photos/160107/pexels-photo-160107.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp REST API dengan Node.js',
                'image' => 'https://images.pexels.com/photos/3861961/pexels-photo-3861961.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp Vue.js untuk Pemula',
                'image' => 'https://images.pexels.com/photos/3861972/pexels-photo-3861972.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
            [
                'title' => 'Bootcamp Next.js dan Deployment',
                'image' => 'https://images.pexels.com/photos/3861964/pexels-photo-3861964.jpeg?auto=compress&cs=tinysrgb&h=400&w=600',
            ],
        ];

        foreach ($topics as $data) {
            $branch = $branches->random();
            $instructorId = $instructorIds[array_rand($instructorIds)];

            EventCourse::create([
                'title' => $data['title'],
                'description' => 'Pelatihan intensif selama beberapa minggu untuk menguasai ' . strtolower($data['title']) . '.',
                'file_path' => null,
                'branch_id' => $branch->id,
                'instructor_id' => $instructorId,
                'start_date' => now()->addDays(rand(1, 10)),
                'end_date' => now()->addDays(rand(15, 30)),
                'price' => rand(250000, 750000),
                'category' => 'Programming',
                'image' => $data['image'],
            ]);
        }
    }
}
