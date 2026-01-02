<?php

namespace App\Filament\Resources\AccountOfExpenses\Pages;

use App\Filament\Resources\AccountOfExpenses\AccountOfExpenseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccountOfExpenses extends ListRecords
{
    protected static string $resource = AccountOfExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
