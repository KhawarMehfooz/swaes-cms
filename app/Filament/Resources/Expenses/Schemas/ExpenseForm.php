<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Settings\GeneralSettings;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('purpose')
                    ->label('Purpose')
                    ->required()
                    ->prefixIcon('heroicon-o-information-circle'),

                TextInput::make('amount')->numeric()->required()->prefix(app(GeneralSettings::class)->currency_symbol . ' '),
                Hidden::make('type')->default('expense'),
            ]);
    }
}
