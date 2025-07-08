<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  // Super admin dan user dasar
  Role::firstOrCreate(['name' => 'super_admin']);
  Role::firstOrCreate(['name' => 'user']);

  // Role organisasi berdasarkan posisi jabatan
  Role::firstOrCreate(['name' => 'manager']);         // Untuk semua posisi "Manager", "Lead", "Coordinator"
  Role::firstOrCreate(['name' => 'senior_staff']);    // Untuk posisi seperti "Specialist", "Generalist", "Officer"
  Role::firstOrCreate(['name' => 'junior_staff']);    // Untuk posisi seperti "Assistant", "Junior", "Admin"
  Role::firstOrCreate(['name' => 'instructor']);      // Khusus posisi "Instructor", "Assistant Instructor", "Mentor"
  Role::firstOrCreate(['name' => 'tech_support']);    // Untuk divisi IT Support dan Software Support
  Role::firstOrCreate(['name' => 'content_team']);     // Untuk divisi Content, Copywriter, Design, SEO

  // Tambahan opsional jika diperlukan
  Role::firstOrCreate(['name' => 'hr']);              // Untuk tim HR dan Employee Relations
  Role::firstOrCreate(['name' => 'marketing']);       // Untuk Digital Marketing dan Brand Awareness
}
}
