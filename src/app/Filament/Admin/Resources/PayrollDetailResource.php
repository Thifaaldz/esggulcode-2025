<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PayrollDetailResource\Pages;
use App\Filament\Admin\Resources\PayrollDetailResource\RelationManagers;
use App\Models\PayrollDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PayrollDetailResource extends Resource
{
    protected static ?string $model = PayrollDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                ->relationship('employee', 'id')
                ->required(),
            Forms\Components\Select::make('salary_period_id')
                ->relationship('salaryPeriod', 'id')
                ->required(),
            Forms\Components\Select::make('payroll_category_id')
                ->relationship('payrollCategory', 'name')
                ->required(),
            Forms\Components\TextInput::make('amount')
                ->required()
                ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('salaryPeriod.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payrollCategory.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayrollDetails::route('/'),
            'create' => Pages\CreatePayrollDetail::route('/create'),
            'edit' => Pages\EditPayrollDetail::route('/{record}/edit'),
        ];
    }
}
