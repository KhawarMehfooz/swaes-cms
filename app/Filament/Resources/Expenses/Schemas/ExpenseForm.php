<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('purpose')->required(),
                TextInput::make('amount')->numeric()->required(),
                Hidden::make('type')->default('expense'), // 👈 always expense
            ]);
    }
}
