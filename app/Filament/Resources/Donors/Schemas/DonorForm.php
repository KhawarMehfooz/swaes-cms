<?php

namespace App\Filament\Resources\Donors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DonorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Donor Details')
                    ->schema([
                        TextInput::make('donor_name')
                            ->label('Full Name')
                            ->required()
                            ->placeholder('Donor\'s Name')
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('donor_cnic')
                            ->unique(table: 'donors', column: 'donor_cnic')
                            ->label('Donor\'s CNIC')
                            ->mask('12345-6789123-4')
                            ->placeholder('12345-6789123-4')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('donor_contact_number')
                            ->label('Donor\'s Contact Number')
                            ->mask('9999-9999999')
                            ->placeholder('0300-1234567')
                            ->prefixIcon('heroicon-o-phone'),

                    ])
                    ->columnSpanFull()
                    ->columns(3)
            ]);
    }
}
