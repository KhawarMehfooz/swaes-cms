<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
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
                    ->prefixIcon('heroicon-o-information-circle')
                    ->maxLength(64)
                    ->columnSpanFull(),

                TextInput::make('amount')->numeric()->required()->prefix(app(GeneralSettings::class)->currency_symbol . ' '),
                DatePicker::make('dated')
                    ->label('Date')
                    ->prefixIcon('heroicon-o-calendar')
                    ->default(Carbon::now('Asia/Karachi'))
                    ->maxDate(Carbon::now('Asia/Karachi')),
                Hidden::make('type')->default('expense'),
            ]);
    }
}
