<?php

namespace Database\Seeders;

use App\Models\EventCourse;
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
                'file_path' => 'docs/web-dev-outline.pdf',
                'start_date' => now(),
                'end_date' => now()->addWeeks(6),
                'price' => 1499000,
                'category' => 'Fullstack Web Development',
                'image' => 'front/assets/img/course-1.jpg',
                'branch_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'HR Digital & Payroll System',
                'description' => 'Belajar mengelola data karyawan, absensi, dan gaji menggunakan sistem HRM modern. Termasuk praktik sistem cuti dan slip gaji otomatis.',
                'file_path' => 'docs/hr-payroll-outline.pdf',
                'start_date' => now(),
                'end_date' => now()->addWeeks(4),
                'price' => 1299000,
                'category' => 'Human Resource',
                'image' => 'front/assets/img/course-2.jpg',
                'branch_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sertifikasi Pengajar Digital',
                'description' => 'Dapatkan sertifikat mengajar resmi melalui pelatihan LMS, penyusunan RPS, dan metode ajar berbasis teknologi. Cocok untuk guru dan tutor online.',
                'file_path' => 'docs/digital-teaching-outline.pdf',
                'start_date' => now(),
                'end_date' => now()->addWeeks(5),
                'price' => 999000,
                'category' => 'Digital Teaching',
                'image' => 'front/assets/img/course-3.jpg',
                'branch_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
