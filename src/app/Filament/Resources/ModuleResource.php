<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Module;
use App\Models\EventCourse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\ModuleResource\Pages;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Kursus';
    protected static ?string $navigationLabel = 'Modul Kursus';

    public static function canAccess(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        $employee = auth()->user()?->employee;

        return $form->schema([
            Select::make('event_course_id')
            ->label('Event Kursus')
            ->options(function () use ($employee) {
                if (!$employee || !$employee->instructor) {
                    // Jika bukan instruktur (admin misalnya), tampilkan semua
                    return EventCourse::pluck('title', 'id');
                }
        
                // Jika instruktur, hanya tampilkan event kursus yang dia ajar
                return EventCourse::where('instructor_id', $employee->id)
                    ->pluck('title', 'id');
            })
            ->required(),
        

            TextInput::make('meeting_number')
                ->label('Pertemuan Ke-')
                ->numeric()
                ->required(),

            TextInput::make('title')
                ->label('Judul Modul')
                ->required(),

            Textarea::make('description')
                ->label('Deskripsi'),

                FileUpload::make('ppt_path')
                ->directory('ppt')
                ->label('Upload PPT')
                ->acceptedFileTypes(['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])
                ->downloadable()
                ->openable(),

            TextInput::make('video_url')
                ->label('Link Video YouTube'),
            

            DateTimePicker::make('meeting_datetime') // ✅ Tambahan baru
                ->label('Waktu Pertemuan')
                ->required()
                ->seconds(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('eventCourse.title')
                ->label('Event Kursus')
                ->searchable(),

            TextColumn::make('meeting_number')
                ->label('Pertemuan'),

            TextColumn::make('title')
                ->label('Judul Modul'),

            TextColumn::make('meeting_datetime') // ✅ Tampilkan waktu
                ->label('Waktu Pertemuan')
                ->dateTime('d M Y H:i'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Hanya tampilkan modul dari kursus yang diajar oleh instruktur yang sedang login
        if ($user->hasRole('instructor')) {
            return parent::getEloquentQuery()
                ->whereHas('eventCourse', function ($query) use ($user) {
                    $query->where('instructor_id', $user->employee->id);
                });
        }

        // Admin bisa lihat semua
        return parent::getEloquentQuery();
    }
}
