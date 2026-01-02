<?php

namespace App\Filament\Resources\AccountOfExpenses\Pages;

use App\Filament\Resources\AccountOfExpenses\AccountOfExpenseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAccountOfExpense extends ViewRecord
{
    protected static string $resource = AccountOfExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
