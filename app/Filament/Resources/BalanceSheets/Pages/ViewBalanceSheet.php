<?php

namespace App\Filament\Resources\BalanceSheets\Pages;

use App\Filament\Resources\BalanceSheets\BalanceSheetResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewBalanceSheet extends ViewRecord
{
    protected static string $resource = BalanceSheetResource::class;

    protected string $view = 'filament.resources.balance-sheet.pages.view-balance-sheet';

    public function getTitle(): string|Htmlable
    {
        return "Balance Sheet: {$this->record->month}";
    }
}
