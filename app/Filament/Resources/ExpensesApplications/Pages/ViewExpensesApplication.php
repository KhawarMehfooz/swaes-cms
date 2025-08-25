<?php

namespace App\Filament\Resources\ExpensesApplications\Pages;

use App\Filament\Resources\ExpensesApplications\ExpensesApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewExpensesApplication extends ViewRecord
{
    protected static string $resource = ExpensesApplicationResource::class;

    protected string $view = 'filament.resources.expense-application.pages.view-expense-application';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
