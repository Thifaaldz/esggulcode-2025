<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Pages;

use App\Filament\Admin\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\SalaryPeriod;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('generatePayrollAll')
            ->label('Generate Payroll Semua')
            ->icon('heroicon-o-calculator')
            ->color('warning')
            ->requiresConfirmation()
            ->action(function () {
                $currentMonth = now()->month;
                $currentYear = now()->year;

                $salaryPeriod = SalaryPeriod::where('month', $currentMonth)
                    ->where('year', $currentYear)
                    ->first();

                if (!$salaryPeriod) {
                    Notification::make()
                        ->title('Gagal')
                        ->body('Salary period bulan ini belum dibuat.')
                        ->danger()
                        ->send();

                    return;
                }

                $employees = Employee::all();

                foreach ($employees as $employee) {
                    Artisan::call('payroll:generate', ['employeeId' => $employee->id]);
                }

                Notification::make()
                    ->title('Berhasil')
                    ->body('Payroll semua karyawan berhasil dijalankan.')
                    ->success()
                    ->send();
            }),
    ];
    }
}
