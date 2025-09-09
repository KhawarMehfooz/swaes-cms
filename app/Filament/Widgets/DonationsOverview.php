<?php

namespace App\Filament\Widgets;

use App\Models\BalanceSheet;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonationsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $currentSheet = BalanceSheet::latest()->first();

        $query = Transaction::query()
            ->where('type', 'income')
            ->where('balance_sheet_id', $currentSheet?->id);

        $total = $query->sum('amount');

        return [
            Stat::make('Donations', number_format($total, 2))
                ->description("Donations for " . now()->format('F Y'))
                ->color('primary')
                ->icon('heroicon-o-gift'),
        ];
    }
}
