<?php

namespace App\Filament\Resources\BalanceSheets\Pages;

use App\Filament\Resources\BalanceSheets\BalanceSheetResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('add_transaction')
                ->label('Add Transaction')
                ->button()
                ->color('primary')
                ->form([
                    Select::make('type')
                        ->options([
                            'income' => 'Income (Donation)',
                            'expense' => 'Expense',
                        ])
                        ->reactive()
                        ->required(),

                    Select::make('donor_id')
                        ->label('Donor')
                        ->options(\App\Models\Donor::pluck('donor_name', 'id')) // Adjust model/field names
                        ->searchable()
                        ->visible(fn(callable $get) => $get('type') === 'income')
                        ->nullable(),

                    TextInput::make('purpose')
                        ->label('Purpose')
                        ->required(),

                    TextInput::make('amount')
                        ->numeric()
                        ->label('Amount')
                        ->required(),
                ])
                ->action(function (array $data, $record) {
                    $record->transactions()->create($data);
                    Notification::make()
                        ->success()
                        ->title('Transaction created!');
                }),
        ];
    }

    
}
