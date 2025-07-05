<?php

namespace App\Filament\Admin\Resources\PayrollCategoryResource\Pages;

use App\Filament\Admin\Resources\PayrollCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayrollCategories extends ListRecords
{
    protected static string $resource = PayrollCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
