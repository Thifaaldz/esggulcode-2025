<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use App\Models\PayrollDetail;
use App\Models\SalaryPeriod;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\BulkActionGroup;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('id')->required(),
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('nik')->required(),
            Forms\Components\TextInput::make('telepon'),
            Forms\Components\DatePicker::make('tanggal_lahir'),
            Forms\Components\Select::make('branch_id')
                ->relationship('branch', 'nama')
                ->required(),
                Forms\Components\Select::make('position_id')
                ->relationship('position', 'name')
                ->required(),

            // Tambahan form input email & password untuk user
Forms\Components\TextInput::make('email')
    ->label('Email (akun login)')
    ->email()
    ->required()
    ->dehydrated(false), // <- ini penting!

Forms\Components\TextInput::make('password')
    ->label('Password (akun login)')
    ->password()
    ->required()
    ->default(fn () => \Str::random(8))
    ->dehydrated(false), // <- jangan ikut disimpan ke DB

      
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('nik')->label('NIK'),
                Tables\Columns\TextColumn::make('position.name')->label('Position'),
                Tables\Columns\TextColumn::make('branch.nama')->label('Branch'),
                Tables\Columns\TextColumn::make('user.email')->label('Email'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),

                // Generate payroll untuk 1 karyawan
                Action::make('generate_payroll')
                    ->label('Generate Payroll')
                    ->icon('heroicon-o-calculator')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Employee $record) {
                        Artisan::call('payroll:generate', ['employeeId' => $record->id]);

                        Notification::make()
                            ->title('Payroll Diproses')
                            ->body("Payroll untuk {$record->nama} sedang diproses.")
                            ->success()
                            ->send();
                    }),

                // Lihat gaji bersih
                Action::make('view_salary')
                    ->label('Lihat Gaji Bersih')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->modalHeading('Gaji Bersih Bulan Ini')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->requiresConfirmation()
                    ->modalDescription(function (Employee $record) {
                        $now = now();
                        $salaryPeriod = SalaryPeriod::where('month', $now->month)
                            ->where('year', $now->year)
                            ->first();

                        $gajiBersih = 0;

                        if ($salaryPeriod) {
                            $details = PayrollDetail::where('employee_id', $record->id)
                                ->where('salary_period_id', $salaryPeriod->id)
                                ->with('payrollCategory')
                                ->get();

                            $totalPendapatan = $details->where('payrollCategory.type', 'pendapatan')->sum('amount');
                            $totalPotongan = $details->where('payrollCategory.type', 'potongan')->sum('amount');

                            $gajiBersih = $totalPendapatan - $totalPotongan;
                        }

                        $formatted = 'Rp. ' . number_format($gajiBersih, 0, ',', '.');
                        $employeeName = $record->user->name ?? 'NIK ' . $record->nik;
                        $period = $now->translatedFormat('F Y');

                        return new HtmlString(
                            "Gaji bersih untuk <strong>{$employeeName}</strong> pada <strong>{$period}</strong>: <strong>{$formatted}</strong>"
                        );
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    // Generate payroll untuk semua yang dipilih
                    Action::make('generatePayrollAll')
                        ->label('Generate Payroll (Semua)')
                        ->icon('heroicon-o-calculator')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $employee) {
                                Artisan::call('payroll:generate', ['employeeId' => $employee->id]);
                            }

                            Notification::make()
                                ->title('Payroll Sedang Diproses')
                                ->body('Payroll semua karyawan telah dijadwalkan.')
                                ->success()
                                ->send();
                        }),
                    
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
