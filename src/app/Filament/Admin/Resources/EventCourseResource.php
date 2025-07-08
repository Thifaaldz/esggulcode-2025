<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EventCourseResource\Pages;
use App\Models\Branch;
use App\Models\EventCourse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventCourseResource extends Resource
{
    protected static ?string $model = EventCourse::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Manajemen Kursus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->rows(4)
                    ->maxLength(1000)
                    ->nullable(),

                Forms\Components\TextInput::make('file_path')
                    ->label('Dokumen Panduan')
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\Select::make('branch_id')
                    ->label('Lokasi Cabang')
                    ->relationship('branch', 'nama')
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->required(),

                Forms\Components\TextInput::make('category')
                    ->maxLength(255)
                    ->required(),

                Forms\Components\TextInput::make('image')
                    ->label('Path Gambar')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Cabang')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->label('Mulai'),

                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->label('Selesai'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->since()
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventCourses::route('/'),
            'create' => Pages\CreateEventCourse::route('/create'),
            'edit' => Pages\EditEventCourse::route('/{record}/edit'),
        ];
    }
}
