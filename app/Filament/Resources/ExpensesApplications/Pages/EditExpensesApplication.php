<?php

namespace App\Filament\Resources\ExpensesApplications\Pages;

use App\Filament\Resources\ExpensesApplications\ExpensesApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditExpensesApplication extends EditRecord
{
    protected static string $resource = ExpensesApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
