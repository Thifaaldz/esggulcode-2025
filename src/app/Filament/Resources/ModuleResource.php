<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModuleResource\Pages;
use App\Filament\Resources\ModuleResource\RelationManagers;
use App\Models\Module;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
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

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Manajemen Kursus';

    
    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['instructor', 'super_admin']);
    }
    
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Select::make('event_course_id')
                        ->relationship('eventCourse', 'title')
                        ->required(),
                    TextInput::make('meeting_number')->numeric()->required(),
                    TextInput::make('title')->required(),
                    Textarea::make('description'),
                    FileUpload::make('ppt_path')
                        ->disk('public')
                        ->directory('modules/ppt'),
                    TextInput::make('video_url')->url()->label('Video URL'),
                ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('eventCourse.title')->label('Course'),
                TextColumn::make('meeting_number'),
                TextColumn::make('title'),
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
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}
