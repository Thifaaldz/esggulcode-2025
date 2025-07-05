<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PayrollCategory;
use App\Models\PayrollDetail;
use App\Models\SalaryPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayrollDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee1 = Employee::find(1);
        $employee2 = Employee::find(2);

        $salaryPeriod = SalaryPeriod::where('month', 6)->where('year', 2025)->first();
        $categories = PayrollCategory::all()->keyBy('name');
        if (!$employee1 || !$employee2 || !$salaryPeriod || $categories->isEmpty()) {
            $this->command->info('Cannot run PayrollDetailSeeder. Missing required data from Employee, SalaryPeriod, or PayrollCategory seeders.');
            return;
        }
        $payrollDataEmp1 = [
            // Pendapatan
            ['category_name' => 'Gaji Pokok', 'amount' => $employee1->position->basic_salary ?? 15000000], // Assumes position has basic_salary
            ['category_name' => 'Tunjangan Jabatan', 'amount' => 2000000],
            ['category_name' => 'Tunjangan Transportasi', 'amount' => 750000],
            // Potongan
            ['category_name' => 'Potongan BPJS Kesehatan', 'amount' => 150000],
            ['category_name' => 'Pajak Penghasilan (PPh 21)', 'amount' => 550000],
        ];
        $payrollDataEmp2 = [
            // Pendapatan
            ['category_name' => 'Gaji Pokok', 'amount' => $employee2->position->basic_salary ?? 8000000],
            ['category_name' => 'Tunjangan Makan', 'amount' => 600000],
            ['category_name' => 'Uang Lembur', 'amount' => 500000],
            // Potongan
            ['category_name' => 'Potongan BPJS Kesehatan', 'amount' => 80000],
            ['category_name' => 'Potongan BPJS Ketenagakerjaan', 'amount' => 160000],
        ];


        $createDetails = function ($employee, $period, $payrollData, $categoryCollection) {
            foreach ($payrollData as $data) {
                if (isset($categoryCollection[$data['category_name']])) {
                    $category = $categoryCollection[$data['category_name']];

                    PayrollDetail::firstOrCreate(
                        [
                            'employee_id' => $employee->id,
                            'salary_period_id' => $period->id,
                            'payroll_category_id' => $category->id,
                        ],
                        [
                            'amount' => $data['amount'] // In your migration, this column is 'Total Gaji'
                        ]
                    );
                }
            }
        };

        $createDetails($employee1, $salaryPeriod, $payrollDataEmp1, $categories);
        $createDetails($employee2, $salaryPeriod, $payrollDataEmp2, $categories);
    }
}
