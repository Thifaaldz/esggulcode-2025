<?php

namespace App\Filament\Admin\Resources\AssignmentsSubmissionsResource\Pages;

use App\Filament\Admin\Resources\AssignmentsSubmissionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssignmentsSubmissions extends EditRecord
{
    protected static string $resource = AssignmentsSubmissionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
