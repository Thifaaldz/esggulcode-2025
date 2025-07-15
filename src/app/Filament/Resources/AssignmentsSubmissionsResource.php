<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentsSubmissionsResource\Pages;
use App\Filament\Resources\AssignmentsSubmissionsResource\RelationManagers;
use App\Models\AssignmentsSubmissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;


class AssignmentsSubmissionsResource extends Resource
{
    protected static ?string $model = AssignmentsSubmissions::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Kursus';
    
    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['instructor', 'super_admin']);
    }
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                    Forms\Components\Select::make('assignment_id')
                        ->relationship('assignment', 'title')
                        ->disabled(),
            
                    Forms\Components\Select::make('student_id')
                        ->relationship('student.user', 'name')
                        ->label('Student')
                        ->disabled(),
            
                    Forms\Components\TextInput::make('file_path')
                        ->label('File')
                        ->disabled()
                        ->suffixAction(
                            Forms\Components\Actions\Action::make('download')
                                ->label('Download')
                                ->icon('heroicon-o-arrow-down-tray')
                                ->url(fn ($record) => $record ? Storage::disk('public')->url($record->file_path) : '#')
                                ->openUrlInNewTab()
                        ),
            
                    Forms\Components\TextInput::make('grade')
                        ->label('Nilai')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->required()
                        ->visible(fn ($record) => $record !== null), // hanya muncul saat edit
            
                    Forms\Components\Textarea::make('comment')
                        ->label('Komentar')
                        ->rows(3)
                        ->nullable()
                        ->visible(fn ($record) => $record !== null),
            
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('assignment.title')->label('Tugas'),
                Tables\Columns\TextColumn::make('student.user.name')->label('Siswa'),
                Tables\Columns\TextColumn::make('grade')->label('Nilai'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i'),
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
            'index' => Pages\ListAssignmentsSubmissions::route('/'),
            'create' => Pages\CreateAssignmentsSubmissions::route('/create'),
            'edit' => Pages\EditAssignmentsSubmissions::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
{
    $user = auth()->user();

    if ($user->hasRole('instructor')) {
        return parent::getEloquentQuery()
            ->whereHas('assignment.module.eventCourse', function ($query) use ($user) {
                $query->where('instructor_id', $user->employee->id);
            });
    }

    return parent::getEloquentQuery();
}
}
