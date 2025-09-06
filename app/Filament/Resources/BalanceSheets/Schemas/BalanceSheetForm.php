<?php

namespace App\Filament\Resources\BalanceSheets\Schemas;

use App\Models\BalanceSheet;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BalanceSheetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Create Balance Sheet')
                    ->description('Select a month to create a new balance sheet. 
                                    If this is your first sheet, you will be asked to enter an opening balance. 
                                    For all future sheets, the opening balance will be automatically carried forward 
                                    from the previous month\'s closing balance.')
                    ->schema([
                        Select::make('month')
                            ->label('Month')
                            ->placeholder('Select a month')
                            ->options(function () {
                                $existingMonths = BalanceSheet::pluck('month')->toArray(); // e.g., ['2025-09', '2025-10']
                    
                                return collect(range(0, 12))
                                    ->mapWithKeys(function ($i) use ($existingMonths) {
                                        $monthKey = now()->startOfMonth()->addMonths($i)->format('Y-m');
                                        $monthLabel = now()->startOfMonth()->addMonths($i)->format('F Y');

                                        // Exclude months that already exist
                                        return in_array($monthKey, $existingMonths)
                                            ? []
                                            : [$monthKey => $monthLabel];
                                    })
                                    ->toArray();
                            })
                            ->required(),


                        TextInput::make('opening_balance')
                            ->numeric()
                            ->default(0)
                            ->visible(fn() => !BalanceSheet::hasAnyBalanceSheet()), // Only visible if no sheets exist
                    ])

            ]);
    }
}
