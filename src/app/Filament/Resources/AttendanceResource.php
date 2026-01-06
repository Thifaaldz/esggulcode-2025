<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Manajemen Karyawan';

    public static function canAccess(): bool
    {
        return true;
    }

       public static function canCreate(): bool
    {
    return Filament::getCurrentPanel()?->getId() === 'employee' ||
           auth()->user()?->hasRole('employee');
    }
        
    public static function form(Form $form): Form
    {
        $components = [];

        // Deteksi panel yang sedang aktif
        if (Filament::getCurrentPanel()?->getId() === 'admin') {
            $components[] = Select::make('employee_id')
                ->relationship('employee', 'nama')
                ->searchable()
                ->required();
        } else {
            $employeeId = auth()->user()?->employee?->id;
            $components[] = Hidden::make('employee_id')->default($employeeId);
        }

        $components[] = DatePicker::make('tanggal')->required();

        $components[] = Select::make('status')
            ->options([
                'hadir' => 'Hadir',
                'tidak_hadir' => 'Tidak Hadir',
                'cuti' => 'Cuti',
            ])
            ->required();

        return $form->schema($components);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                TextColumn::make('employee.nama')->label('Nama Karyawan')->searchable(),
                TextColumn::make('tanggal')->date(),
                TextColumn::make('status')->badge(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Action::make('sinkronisasiCuti')
                    ->label('Sinkronisasi Cuti')
                    ->icon('heroicon-o-arrow-path')
                    ->color('primary')
                    ->visible(fn () => auth()->user()?->hasRole('super_admin'))
                    ->action(function () {
                        Artisan::call('attendance:from-leave');
                        Notification::make()
                            ->title('Sinkronisasi berhasil!')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Yakin ingin sinkronisasi data cuti?'),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Filament::getCurrentPanel()?->getId() === 'employee') {
            $employeeId = auth()->user()?->employee?->id;
            $query->where('employee_id', $employeeId);
        }

        return $query;
    }

  public static function getPages(): array
{
    $pages = [];

    if (auth()->user()?->hasRole('employee')) {
        $pages['create'] = Pages\CreateAttendance::route('/create');
    } else {
        $pages = [
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }

    return $pages;
}

    }
