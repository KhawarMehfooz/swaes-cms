<?php

namespace App\Filament\Resources\Donations\Schemas;

use App\Models\Donor;
use Filament\Actions\Action;
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
                    )->columnSpanFull(),

                TextInput::make('purpose')->required()->autocomplete(false)->maxLength(64)->prefixIcon('heroicon-o-information-circle'),
                TextInput::make('amount')->numeric()->required()->autocomplete(false)->prefix(app(GeneralSettings::class)->currency_symbol)
                    ->required(),
                Hidden::make('type')->default('income'),
            ]);
    }
}
