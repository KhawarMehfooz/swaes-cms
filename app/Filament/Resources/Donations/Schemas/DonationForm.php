<?php

namespace App\Filament\Resources\Donations\Schemas;

use App\Models\Donor;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use App\Settings\GeneralSettings;


class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('receipt_number')
                    ->label('Receipt Number')
                    ->prefix('#')
                    ->required()
                    ->autocomplete(false)
                    ->placeholder('Receipt Number')
                    ->unique(
                        ignoreRecord: true, 
                        table: 'transactions', 
                        column: 'receipt_number'
                    )
                    ->rule('max:255'),
                Select::make('donor_id')
                    ->label('Donor')
                    ->required()
                    ->options(fn() => Donor::pluck('donor_name', 'id'))
                    ->searchable()
                    ->prefixIcon('heroicon-o-user-group')
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
                                    ->autocomplete(false)
                                    ->maxLength(30)
                                    ->prefixIcon('heroicon-o-user'),

                                TextInput::make('donor_cnic')
                                    ->label('CNIC')
                                    ->autocomplete(false)
                                    ->mask('99999-9999999-9')
                                    ->prefixIcon('heroicon-o-identification'),

                                TextInput::make('donor_contact_number')
                                    ->label('Contact Number')
                                    ->mask('9999-9999999')
                                    ->autocomplete(false)
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
                    ->required()
                    ->autocomplete(false)
                    ->maxLength(64)
                    ->prefixIcon('heroicon-o-information-circle')
                    ->columnSpanFull(),
                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->autocomplete(false)
                    ->prefix(app(GeneralSettings::class)->currency_symbol),
                DatePicker::make('dated')
                    ->label('Date')
                    ->prefixIcon('heroicon-o-calendar')
                    ->default(Carbon::now('Asia/Karachi'))
                    ->maxDate(Carbon::now('Asia/Karachi')),
                Hidden::make('type')->default('income'),
            ]);
    }
}
