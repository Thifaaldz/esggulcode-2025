<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Position;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Role dasar dan tambahan
        $roles = [
            'employee', 'manager', 'senior_staff', 'junior_staff',
            'instructor', 'content_team', 'tech_support', 'marketing', 'hr'
        ];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Branch & Position default
        $branch = Branch::firstOrCreate(['id' => 1], [
            'company_id' => 1,
            'nama' => 'Cabang Utama',
            'alamat' => 'Jl. Merdeka No.1',
        ]);

        $position = Position::firstOrCreate(['id' => 1], [
            'division_id' => 1,
            'name' => 'Staff HRD',
            'basic_salary' => 5000000,
        ]);

        // Data Karyawan + role tambahan
        $employees = [
            ['name' => 'Jonathan Rey Irawan', 'role' => ['instructor']],
            ['name' => 'Muhammad Ghozy Akbar', 'role' => ['instructor']],
            ['name' => 'Achmad Fatih Azhar', 'role' => ['hr']],
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

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
            ]);

            // Assign default role
            $user->assignRole('employee');

            // Assign role tambahan jika ada
            foreach ($data['role'] as $r) {
                $user->assignRole($r);
            }

            Employee::create([
                'user_id' => $user->id,
                'branch_id' => $branch->id,
                'position_id' => $position->id,
                'nama' => $name,
                'nik' => 'EMP' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'telepon' => '08' . rand(1111111111, 9999999999),
                'tanggal_lahir' => now()->subYears(rand(22, 35))->subDays(rand(0, 365))->format('Y-m-d'),
            ]);
        }
    }
}
