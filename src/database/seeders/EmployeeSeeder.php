<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Position;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar role yang digunakan
        $roles = [
            'employee', 'manager', 'senior_staff', 'junior_staff',
            'instructor', 'content_team', 'tech_support', 'marketing', 'hr'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Buat branch default
        $branch = Branch::firstOrCreate(['id' => 1], [
            'company_id' => 1,
            'nama' => 'Cabang Utama',
            'alamat' => 'Jl. Merdeka No.1',
        ]);

        // Mapping role ke nama divisi
        $roleToDivision = [
            'hr' => 'Recruitment',
            'content_team' => 'Content & Copywriting',
            'tech_support' => 'Software Support',
            'marketing' => 'Digital Marketing',
            'instructor' => 'Instructor Management',
            'senior_staff' => 'Curriculum Development',
            'junior_staff' => 'Training & Development',
            'manager' => 'LMS Development',
        ];

        // Data karyawan
        $employees = [
            ['name' => 'Jonathan Rey Irawan', 'role' => ['instructor']],
            ['name' => 'Muhammad Ghozy Akbar', 'role' => ['hr']],
            ['name' => 'Achmad Fatih Azhar', 'role' => ['instructor']],
            ['name' => 'Farid Muhammad Zakky', 'role' => ['content_team']],
            ['name' => 'Satria Dwi Saputra', 'role' => ['instructor']],
            ['name' => 'Kelvin Falentino', 'role' => ['tech_support']],
            ['name' => 'Canavaro Daud', 'role' => ['marketing']],
            ['name' => 'Bilal', 'role' => ['junior_staff']],
            ['name' => 'Rachel Nadira', 'role' => ['content_team']],
            ['name' => 'Annisa putri', 'role' => ['senior_staff']],
            ['name' => 'Reza Aditya Putra', 'role' => ['tech_support']],
            ['name' => 'Ghefira Ahmad', 'role' => ['content_team']],
            ['name' => 'Amelia Putri', 'role' => ['hr']],
            ['name' => 'Menhiara Arifa', 'role' => ['senior_staff']],
            ['name' => 'Dava Flandyansyah', 'role' => ['junior_staff']],
            ['name' => 'Muhammad Farel Suherman', 'role' => ['manager']],
            ['name' => 'Giras Maulana', 'role' => ['marketing']],
            ['name' => 'Candy Yapviero', 'role' => ['content_team']],
            ['name' => 'Ghani Efrizal Ravindani', 'role' => ['manager']],
        ];

        foreach ($employees as $index => $data) {
            $name = $data['name'];
            $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
            $roles = $data['role'];

            // Buat user
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
            ]);

            // Assign semua role
            $user->assignRole('employee');
            foreach ($roles as $r) {
                $user->assignRole($r);
            }

            // Tentukan divisi berdasarkan role utama
            $firstRole = $roles[0];
            $divisionName = $roleToDivision[$firstRole] ?? 'Divisi Umum';

            $division = Division::where('nama', $divisionName)->first();

            // Jika tidak ditemukan, fallback ke divisi pertama
            if (!$division) {
                $division = Division::first();
            }

            // Cari atau buat posisi di divisi tersebut
            $position = Position::where('division_id', $division->id)->first();
            if (!$position) {
                $position = Position::create([
                    'division_id' => $division->id,
                    'name' => 'Default Position',
                    'basic_salary' => 5000000,
                ]);
            }

            // Buat employee
            Employee::create([
                'user_id' => $user->id,
                'branch_id' => $branch->id,
                'division_id' => $division->id,
                'position_id' => $position->id,
                'nama' => $name,
                'nik' => 'EMP' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'telepon' => '08' . rand(1111111111, 9999999999),
                'tanggal_lahir' => now()->subYears(rand(22, 35))->subDays(rand(0, 365))->format('Y-m-d'),
            ]);
        }
    }
}
