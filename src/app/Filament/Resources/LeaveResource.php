<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveResource\Pages;
use App\Models\Leave;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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

    public static function canCreate(): bool
    {
    return Filament::getCurrentPanel()?->getId() === 'employee' ||
           auth()->user()?->hasRole('employee');
    }
    
    public static function form(Form $form): Form
    {
        return $form->schema([
            // Admin bisa pilih karyawan
            Hidden::make('employee_id')
    ->default(fn () => auth()->user()?->employee?->id)
    ->dehydrated() // <- tambahkan ini untuk memastikan nilainya disimpan
    ->required()
    ->visible(fn () => auth()->user()?->hasRole('employee')),

            // Employee: hidden input dan nama tampil sebagai informasi
            Hidden::make('employee_id')
                ->default(fn () => auth()->user()?->employee?->id)
                ->dehydrated()
                ->required()
                ->visible(fn () => auth()->user()?->hasRole('employee')),

            Placeholder::make('employee_name')
                ->label('Nama Karyawan')
                ->content(fn () => auth()->user()?->employee?->nama)
                ->visible(fn () => auth()->user()?->hasRole('employee')),

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
        return [
            'index' => Pages\ListLeaves::route('/'),
            'create' => Pages\CreateLeave::route('/create'),
            'edit' => Pages\EditLeave::route('/{record}/edit'),
        ];
    }
}
