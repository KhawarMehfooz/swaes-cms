<?php

namespace App\Livewire;

use App\Models\Donor;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonorStatsWidget extends StatsOverviewWidget
{

    public ?Donor $record = null; 

    protected function getStats(): array
    {
        $total = $this->record?->donations()->sum('amount') ?? 0;
        $count = $this->record?->donations()->count() ?? 0;

        return [
            Stat::make('Total Donations', number_format($total))
                ->description("Across {$count} donations")
                ->color('success')
                ->icon('heroicon-o-gift'),
        ];
    }
}
