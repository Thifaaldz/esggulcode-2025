<?php

namespace App\Filament\Admin\Resources\AssignmentsSubmissionsResource\Pages;

use App\Filament\Admin\Resources\AssignmentsSubmissionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssignmentsSubmissions extends ListRecords
{
    protected static string $resource = AssignmentsSubmissionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
