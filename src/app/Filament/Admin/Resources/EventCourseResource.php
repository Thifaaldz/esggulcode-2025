<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EventCourseResource\Pages;
use App\Models\Assignments;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\EventCourse;
use App\Models\Module;
use Carbon\Carbon;
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
    protected static ?string $navigationLabel = 'Event Kursus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->maxLength(1000)
                    ->nullable(),

                Forms\Components\FileUpload::make('file_path')
                    ->label('Dokumen Panduan')
                    ->disk('public')
                    ->directory('event-course/files')
                    ->preserveFilenames()
                    ->nullable(),

                Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->directory('event-course/images')
                    ->image()
                    ->imagePreviewHeight('200')
                    ->nullable(),

                Forms\Components\Select::make('branch_id')
                    ->label('Cabang')
                    ->relationship('branch', 'nama')
                    ->required(),

                Forms\Components\Select::make('instructor_id')
                    ->label('Instruktur')
                    ->searchable()
                    ->options(
                        Employee::whereHas('user.roles', function ($query) {
                            $query->where('name', 'instructor');
                        })->pluck('nama', 'id')
                    )
                    ->required(),

                    Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $endDate = \Carbon\Carbon::parse($state)->addWeeks(8)->subDay(); // 8 minggu = 8x pertemuan
                            $set('end_date', $endDate->format('Y-m-d'));
                        }
                    }),
                
                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->disabled()
                    ->required()
                    ->dehydrated(true)// tetap simpan ke DB
                    ->format('Y-m-d'),
                

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->required(),

                Forms\Components\TextInput::make('category')
                    ->label('Kategori')
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Judul'),

                Tables\Columns\TextColumn::make('category')
                    ->sortable()
                    ->badge()
                    ->label('Kategori'),

                Tables\Columns\TextColumn::make('branch.nama')
                    ->label('Cabang')
                    ->sortable(),

                Tables\Columns\TextColumn::make('instructor.nama')
                    ->label('Instruktur')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->label('Mulai'),

                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->label('Selesai'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable()
                    ->label('Harga'),

                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Dibuat'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
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
