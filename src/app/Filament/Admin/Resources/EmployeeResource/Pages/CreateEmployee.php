<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Pages;

use App\Filament\Admin\Resources\EmployeeResource;
use App\Models\Position;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $formState = $this->form->getState();
    
        $email = $formState['email'] ?? null;
        $password = $formState['password'] ?? null;
    
        if (empty($email) || empty($password)) {
            throw new \Exception('Email dan Password wajib diisi untuk membuat akun user.');
        }
    
        // Buat user
        $user = User::create([
            'name' => $data['nama'],
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    
        // Assign role default "employee"
        $user->assignRole('employee');
    
        // Assign role berdasarkan nama posisi (jika ada)
        if (!empty($data['position_id'])) {
            $position = Position::find($data['position_id']);
    
            if ($position) {
                $positionRoleName = strtolower(str_replace(' ', '_', $position->name));
                $role = Role::firstOrCreate(['name' => $positionRoleName]);
                $user->assignRole($role);
            }
        }
    
        // Inject user_id ke data employee
        $data['user_id'] = $user->id;
    
        // HAPUS email dan password dari data employee
        unset($data['email'], $data['password']);
    
        return $data;
    }
    
}
