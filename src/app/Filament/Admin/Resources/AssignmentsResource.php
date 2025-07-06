<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AssignmentsResource\Pages;
use App\Filament\Admin\Resources\AssignmentsResource\RelationManagers;
use App\Models\Assignments;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssignmentsResource extends Resource
{
    protected static ?string $model = Assignments::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('module_id')
                ->label('Modul')
                ->relationship('module', 'title')
                ->searchable()
                ->required(),

            TextInput::make('title')
                ->label('Judul Tugas')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('Deskripsi Tugas')
                ->required()
                ->rows(4),

            DatePicker::make('deadline')
                ->label('Batas Pengumpulan')
                ->required(),
        ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('module.title')->label('Modul')->searchable(),
                TextColumn::make('title')->label('Judul'),
                TextColumn::make('deadline')->label('Deadline')->date(),
                TextColumn::make('created_at')->label('Dibuat')->since(),
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
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignments::route('/create'),
            'edit' => Pages\EditAssignments::route('/{record}/edit'),
        ];
    }
}
