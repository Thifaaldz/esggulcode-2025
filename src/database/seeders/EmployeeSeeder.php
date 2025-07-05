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
           // Pastikan role 'employee' ada
           $role = Role::firstOrCreate(['name' => 'employee']);

           // Pastikan branch dan position tersedia
           $branch = Branch::firstOrCreate([
               'id' => 1,
           ], [
               'company_id' => 1,
               'nama' => 'Cabang Utama',
               'alamat' => 'Jl. Merdeka No.1',
               'created_at' => now(),
               'updated_at' => now(),
           ]);
   
           $position = Position::firstOrCreate([
               'id' => 1,
           ], [
               'division_id' => 1,
               'name' => 'Staff HRD',
               'basic_salary' => 5000000,
               'created_at' => now(),
               'updated_at' => now(),
           ]);
   
           // Buat user baru
           $user = User::create([
               'name' => 'Andi Karyawan',
               'email' => 'andi@example.com',
               'password' => Hash::make('password'),
           ]);
   
           // Assign role 'employee'
           $user->assignRole($role);
   
           // Buat data employee
           Employee::create([
               'user_id' => $user->id,
               'branch_id' => $branch->id,
               'position_id' => $position->id,
               'nama' => 'Andi Karyawan',
               'nik' => 'EMP0001',
               'telepon' => '081234567890',
               'tanggal_lahir' => '1990-01-01',
           ]);
    }
}
