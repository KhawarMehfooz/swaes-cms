<?php

namespace App\Filament\Resources\BalanceSheets\Pages;

use App\Filament\Resources\BalanceSheets\BalanceSheetResource;
use App\Models\BalanceSheet;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListBalanceSheets extends ListRecords
{
    protected static string $resource = BalanceSheetResource::class;

    protected function getHeaderActions(): array
    {
        $lastBalanceSheet = BalanceSheet::latest()->first();

        if ($lastBalanceSheet && $lastBalanceSheet->status !== 'finalized') {
            return [
                Action::make('createBlocked')
                    ->label('New balance sheet')
                    ->color('gray')
                    ->action(function () {
                        Notification::make()
                            ->warning()
                            ->title('Finalize the previous balance sheet before creating a new one.')
                            ->send();
                    }),
            ];
        }

        return [
            CreateAction::make(),
        ];
    }


}
