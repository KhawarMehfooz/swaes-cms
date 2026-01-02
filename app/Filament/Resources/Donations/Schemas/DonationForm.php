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
                    ->preload()
                    ->prefixIcon('heroicon-o-user-group')
                    ->createOptionForm([
                        TextInput::make('donor_name')
                            ->label('Full Name')
                            ->placeholder('Full Name')
                            ->required()
                            ->autocomplete(false)
                            ->maxLength(30)
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('donor_cnic')
                            ->label('CNIC')
                            ->autocomplete(false)
                            ->mask('99999-9999999-9')
                            ->placeholder('12345-6789123-4')
                            ->unique(ignoreRecord: true, table: 'donors', column: 'donor_cnic')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('donor_contact_number')
                            ->label('Donor\'s Contact Number')
                            ->mask('9999-9999999')
                            ->autocomplete(false)
                            ->placeholder('0300-1234567')
                            ->prefixIcon('heroicon-o-phone')
                            ->unique(ignoreRecord: true, table: 'donors', column: 'donor_contact_number'),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return Donor::create([
                            'donor_name' => $data['donor_name'],
                            'donor_cnic' => $data['donor_cnic'],
                            'donor_contact_number' => $data['donor_contact_number'],
                        ])->id;
                    }),


                TextInput::make('purpose')
                    ->required()
                    ->placeholder("Donation's Purpose")
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
