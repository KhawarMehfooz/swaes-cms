<?php

namespace App\Filament\Widgets;

use App\Models\BalanceSheet;
use App\Models\Transaction;
use App\Settings\GeneralSettings;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExpenseOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $currentSheet = BalanceSheet::latest()->first();

        $query = Transaction::query()
            ->where('type', 'expense')
            ->where('balance_sheet_id', $currentSheet?->id);

        $total = $query->sum('amount');

        return [
            Stat::make('Expenses', app(GeneralSettings::class)->currency_symbol.' '.number_format($total, 2))
                ->description('Expenses for '.now()->format('F Y'))
                ->color('danger'),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }

    public function getColumnSpan(): int|string|array
    {
        return 1;
    }
}
