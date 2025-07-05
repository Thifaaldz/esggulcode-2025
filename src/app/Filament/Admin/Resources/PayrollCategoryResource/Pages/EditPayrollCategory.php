<?php

namespace App\Filament\Admin\Resources\PayrollCategoryResource\Pages;

use App\Filament\Admin\Resources\PayrollCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayrollCategory extends EditRecord
{
    protected static string $resource = PayrollCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
