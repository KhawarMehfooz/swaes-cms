<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\Select;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('account_of_expense_id')
                    ->label('Account of Expense')
                    ->relationship('accountOfExpense', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Account Name')
                            ->required()
                            ->maxLength(45)
                    ])
                    ->prefixIcon('heroicon-o-information-circle')
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
