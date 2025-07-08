<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::insert([
            // Human Resources
            ['department_id' => 1, 'nama' => 'Recruitment', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 1, 'nama' => 'Employee Relations', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 1, 'nama' => 'Training & Development', 'created_at' => now(), 'updated_at' => now()],
        
            // Marketing
            ['department_id' => 2, 'nama' => 'Digital Marketing', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 2, 'nama' => 'Content & Copywriting', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 2, 'nama' => 'Branding & Design', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 2, 'nama' => 'SEO & Analytics', 'created_at' => now(), 'updated_at' => now()],
        
            // IT Support
            ['department_id' => 3, 'nama' => 'Hardware Support', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 3, 'nama' => 'Software Support', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 3, 'nama' => 'Network & Security', 'created_at' => now(), 'updated_at' => now()],
        
            // Academic Affairs
            ['department_id' => 4, 'nama' => 'Curriculum Development', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 4, 'nama' => 'Instructor Management', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 4, 'nama' => 'Assessment & Evaluation', 'created_at' => now(), 'updated_at' => now()],
        
            // Student Success
            ['department_id' => 5, 'nama' => 'Mentoring & Coaching', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 5, 'nama' => 'Student Support', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 5, 'nama' => 'Alumni Engagement', 'created_at' => now(), 'updated_at' => now()],
        
            // Product Development
            ['department_id' => 6, 'nama' => 'LMS Development', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 6, 'nama' => 'UX/UI Design', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 6, 'nama' => 'Quality Assurance', 'created_at' => now(), 'updated_at' => now()],
        
            // Admissions
            ['department_id' => 7, 'nama' => 'Lead Generation', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 7, 'nama' => 'Enrollment', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 7, 'nama' => 'Counseling & Consultation', 'created_at' => now(), 'updated_at' => now()],
        
            // Finance
            ['department_id' => 8, 'nama' => 'Accounting', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 8, 'nama' => 'Payroll', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 8, 'nama' => 'Financial Planning', 'created_at' => now(), 'updated_at' => now()],
        
            // Partnerships & Career Services
            ['department_id' => 9, 'nama' => 'Industry Partnership', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 9, 'nama' => 'Career Placement', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 9, 'nama' => 'Internship Coordination', 'created_at' => now(), 'updated_at' => now()],
        
            // Operations
            ['department_id' => 10, 'nama' => 'Facilities', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 10, 'nama' => 'Procurement', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 10, 'nama' => 'Scheduling', 'created_at' => now(), 'updated_at' => now()],
        ]);        
    }
}
