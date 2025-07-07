<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveResource\Pages;
use App\Models\Leave;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class LeaveResource extends Resource
{
    protected static ?string $model = Leave::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Manajemen Karyawan';
    protected static ?string $label = 'Cuti';

    public static function canAccess(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('employee_id')
                ->relationship('employee', 'nama')
                ->required()
                ->searchable(),

            DatePicker::make('tanggal_mulai')->required(),
            DatePicker::make('tanggal_selesai')->required(),

            Textarea::make('alasan')->rows(3),


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('employee.nama')->label('Karyawan')->searchable(),
                    TextColumn::make('tanggal_mulai')->date(),
                    TextColumn::make('tanggal_selesai')->date(),
                    BadgeColumn::make('status')
                        ->colors([
                            'primary' => 'menunggu',
                            'success' => 'disetujui',
                            'danger' => 'ditolak',
                        ])
                        ->label('Status'),
                ])
                ->actions([
                    Action::make('setujui')
                        ->label('Setujui')
                        ->color('success')
                        ->visible(fn ($record) =>
                            $record->status === 'menunggu' && auth()->user()?->hasRole('super_admin')
                        )
                        ->action(fn ($record) => $record->update(['status' => 'disetujui']))
                        ->requiresConfirmation(),
        
                    Action::make('tolak')
                        ->label('Tolak')
                        ->color('danger')
                        ->visible(fn ($record) =>
                            $record->status === 'menunggu' && auth()->user()?->hasRole('super_admin')
                        )
                        ->action(fn ($record) => $record->update(['status' => 'ditolak']))
                        ->requiresConfirmation(),
        
                    Tables\Actions\EditAction::make(),
                ])
                ->bulkActions([
                    Tables\Actions\DeleteBulkAction::make(),
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
        if (auth()->user()?->hasRole('employee')) {
            return [
                'create' => Pages\CreateLeave::route('/create'),
            ];
        }
    
        return [
            'index' => Pages\ListLeaves::route('/'),
            'create' => Pages\CreateLeave::route('/create'),
            'edit' => Pages\EditLeave::route('/{record}/edit'),
        ];
    }

    
}