<?php

namespace App\Filament\Resources\Donations\Schemas;

use App\Models\Donor;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('donor_id')
                    ->label('Donor')
                    ->required()
                    ->options(Donor::pluck('donor_name', 'id'))
                    ->searchable()
                    ->columnSpanFull(),
                TextInput::make('purpose')->required()->autocomplete(false),
                TextInput::make('amount')->numeric()->required()->autocomplete(false),
                Hidden::make('type')->default('income'),
            ]);
    }
}
