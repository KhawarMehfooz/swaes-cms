<?php

namespace App\Filament\Resources\AccountOfExpenses\Pages;

use App\Filament\Resources\AccountOfExpenses\AccountOfExpenseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAccountOfExpense extends CreateRecord
{
    protected static string $resource = AccountOfExpenseResource::class;
}
