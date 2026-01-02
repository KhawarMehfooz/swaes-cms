<?php

namespace App\Filament\Resources\AccountOfExpenses\Pages;

use App\Filament\Resources\AccountOfExpenses\AccountOfExpenseResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAccountOfExpense extends EditRecord
{
    protected static string $resource = AccountOfExpenseResource::class;

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
