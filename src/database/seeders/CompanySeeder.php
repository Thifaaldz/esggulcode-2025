<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::firstOrCreate([
            'name' => 'ESGGULCODE',
            'logo' => '',
            'email' => 'contact@esggul.com',
            'phone' => '021-123-4567',
            'address' => 'Jl. Arjuna Utara No.9, Kebon Jeruk, Universitas Esa Unggul',
            'city' => 'Jakarta Barat',
            'state' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'postal_code' => '11510',
            'tax_number' => 'NPWP-12.345.678.9-012.000',
            'website' => 'https://esggulcode.test',
        ]);
    }
}
