<?php

namespace Database\Seeders;

use App\Models\EventCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventCourse::insert([
            [
                'title' => 'Bootcamp Web Developer',
                'description' => 'Pelatihan intensif dari dasar hingga mahir menggunakan HTML, CSS, JavaScript, dan Laravel. Disertai proyek akhir dan sertifikat digital.',
                'start_date' => now(),
                'end_date' => now()->addWeeks(6),
                'price' => 1499000,
                'category' => 'Fullstack Web Development',
                'image' => 'front/assets/img/course-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'HR Digital & Payroll System',
                'description' => 'Belajar mengelola data karyawan, absensi, dan gaji menggunakan sistem HRM modern. Termasuk praktik sistem cuti dan slip gaji otomatis.',
                'start_date' => now(),
                'end_date' => now()->addWeeks(4),
                'price' => 1299000,
                'category' => 'Human Resource',
                'image' => 'front/assets/img/course-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sertifikasi Pengajar Digital',
                'description' => 'Dapatkan sertifikat mengajar resmi melalui pelatihan LMS, penyusunan RPS, dan metode ajar berbasis teknologi. Cocok untuk guru dan tutor online.',
                'start_date' => now(),
                'end_date' => now()->addWeeks(5),
                'price' => 999000,
                'category' => 'Digital Teaching',
                'image' => 'front/assets/img/course-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
