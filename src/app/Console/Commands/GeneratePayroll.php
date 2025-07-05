<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\PayrollCategory;
use App\Models\PayrollDetail;
use App\Models\SalaryPeriod;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GeneratePayroll extends Command
{
    protected $signature = 'payroll:generate {employeeId?}';
    protected $description = 'Generate or regenerate payroll for a specific employee or all employees';

    public function handle()
    {
        $employeeId = $this->argument('employeeId');
        $employees = $employeeId ? Employee::where('id', $employeeId)->get() : Employee::all();

        $period = SalaryPeriod::where('month', now()->month)->where('year', now()->year)->first();

        if (!$period) {
            $this->error('Salary period for this month does not exist.');
            return;
        }

        foreach ($employees as $employee) {
            try {
                DB::transaction(function () use ($employee, $period) {
                    // Hapus semua detail payroll lama untuk karyawan dan periode ini
                    $employee->payrollDetails()
                        ->where('salary_period_id', $period->id)
                        ->delete();

                    // Gaji Pokok
                    $gajiPokok = PayrollCategory::where('name', 'Gaji Pokok')->first();
                    if ($gajiPokok && $employee->position) {
                        $employee->payrollDetails()->create([
                            'salary_period_id' => $period->id,
                            'payroll_category_id' => $gajiPokok->id,
                            'amount' => $employee->position->basic_salary,
                        ]);
                    }

                    // Tunjangan Makan
                    $tunjMakan = PayrollCategory::where('name', 'Tunjangan Makan')->first();
                    if ($tunjMakan) {
                        $employee->payrollDetails()->create([
                            'salary_period_id' => $period->id,
                            'payroll_category_id' => $tunjMakan->id,
                            'amount' => 500000,
                        ]);
                    }

                    // Potongan BPJS
                    $bpjs = PayrollCategory::where('name', 'Potongan BPJS Kesehatan')->first();
                    if ($bpjs) {
                        $employee->payrollDetails()->create([
                            'salary_period_id' => $period->id,
                            'payroll_category_id' => $bpjs->id,
                            'amount' => 150000,
                        ]);
                    }

                    // Bonus Kehadiran (Rp20.000 per kehadiran)
                    $bonusKehadiranCategory = PayrollCategory::where('name', 'Bonus Kehadiran')->first();
                    if ($bonusKehadiranCategory) {
                        $startDate = Carbon::createFromDate($period->year, $period->month, 1)->startOfMonth();
                        $endDate = $startDate->copy()->endOfMonth();

                        $jumlahHadir = Attendance::where('employee_id', $employee->id)
                            ->whereBetween('tanggal', [$startDate, $endDate])
                            ->where('status', 'hadir')
                            ->count();

                        $bonusKehadiran = $jumlahHadir * 20000;

                        $employee->payrollDetails()->create([
                            'salary_period_id' => $period->id,
                            'payroll_category_id' => $bonusKehadiranCategory->id,
                            'amount' => $bonusKehadiran,
                        ]);
                    }
                });

                $this->info("Payroll successfully (re)generated for {$employee->nama}");
            } catch (\Exception $e) {
                $this->error("Failed to generate payroll for {$employee->nama}: " . $e->getMessage());
            }
        }
    }
}
