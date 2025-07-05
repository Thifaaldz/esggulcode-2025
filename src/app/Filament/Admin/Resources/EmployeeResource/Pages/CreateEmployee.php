<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Pages;

use App\Filament\Admin\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use App\Helpers\WablasHelper;
use Illuminate\Support\Facades\Hash;
class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $password = $data['password'] ?? 'emp' . rand(1000, 9999);
    $email = $data['email'] ?? strtolower(str_replace(' ', '', $data['nama'])) . '@example.com';

    $user = User::create([
        'name' => $data['nama'],
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    $user->assignRole('employee');


    $data['user_id'] = $user->id;

    // Tidak perlu unset, karena `dehydrated(false)` sudah mencegah simpan ke DB
    return $data;
}

}
