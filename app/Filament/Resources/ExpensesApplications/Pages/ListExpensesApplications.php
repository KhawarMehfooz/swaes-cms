<?php

namespace App\Filament\Resources\ExpensesApplications\Pages;

use App\Filament\Resources\ExpensesApplications\ExpensesApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExpensesApplications extends ListRecords
{
    protected static string $resource = ExpensesApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
