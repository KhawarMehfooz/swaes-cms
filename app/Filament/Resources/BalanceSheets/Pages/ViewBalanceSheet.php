<?php

namespace App\Filament\Resources\BalanceSheets\Pages;

use App\Filament\Resources\BalanceSheets\BalanceSheetResource;
use App\Models\Donor;
use App\Settings\GeneralSettings;
use Carbon\Carbon;
use DateTime;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
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
                ->modalWidth('lg')
                ->color('primary')
                ->form([
                    Select::make('type')
                        ->options([
                            'income' => 'Income (Donation)',
                            'expense' => 'Expense',
                        ])
                        ->reactive()
                        ->prefixIcon('heroicon-o-arrows-right-left')
                        ->required(),

                    Select::make('donor_id')
                        ->label('Donor')
                        ->options(fn() => Donor::pluck('donor_name', 'id'))
                        ->searchable()
                        ->prefixIcon('heroicon-o-user-group')
                        ->visible(fn(callable $get) => $get('type') === 'income')
                        ->suffixAction(
                            Action::make('create_donor')
                                ->icon('heroicon-o-plus')
                                ->tooltip('Add New Donor')
                                ->modalHeading('Create New Donor')
                                ->modalWidth('lg')
                                ->form([
                                    TextInput::make('donor_name')
                                        ->label('Full Name')
                                        ->required()
                                        ->maxLength(30)
                                        ->prefixIcon('heroicon-o-user'),

                                    TextInput::make('donor_cnic')
                                        ->label('CNIC')
                                        ->required()
                                        ->mask('99999-9999999-9')
                                        ->prefixIcon('heroicon-o-identification'),

                                    TextInput::make('donor_contact_number')
                                        ->label('Contact Number')
                                        ->mask('9999-9999999')
                                        ->prefixIcon('heroicon-o-phone'),

                                ])
                                ->action(function ($data, $livewire, $component) {
                                    $donor = Donor::create($data);

                                    $component->state($donor->id);

                                    $component->callAfterStateUpdated();

                                    Notification::make()
                                        ->success()
                                        ->title('Donor created successfully')
                                        ->send();
                                })
                        ),

                    TextInput::make('purpose')
                        ->label('Purpose')
                        ->prefixIcon('heroicon-o-information-circle')
                        ->required()
                        ->maxLength(64),

                    TextInput::make('amount')
                        ->numeric()
                        ->label('Amount')
                        ->prefix(app(GeneralSettings::class)->currency_symbol)
                        ->required(),
                    DatePicker::make('dated')
                        ->label('Date')
                        ->prefixIcon('heroicon-o-calendar')
                        ->default(Carbon::now('Asia/Karachi'))
                        ->maxDate(Carbon::now('Asia/Karachi')),

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
