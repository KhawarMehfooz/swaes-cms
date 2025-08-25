<?php

namespace App\Filament\Resources\ExpensesApplications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExpensesApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Application Details')
                    ->schema([
                        DatePicker::make('application_date')
                            ->label('Application Date')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->default(now())
                            ->prefixIcon('heroicon-o-calendar'),
                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->collapsed()
                    ->collapsible(),
                Section::make('Goods Details')
                    ->schema([
                        TextInput::make('shop_name')
                            ->required()
                            ->label('Shop Name')
                            ->placeholder('Enter shop name')
                            ->prefixIcon('heroicon-o-building-storefront'),
                        TextInput::make('shop_address')
                            ->required()
                            ->label('Address')
                            ->placeholder('Enter address')
                            ->prefixIcon('heroicon-o-map-pin'),

                        RichEditor::make('details')
                            ->required()
                            ->label('Details')
                            ->columnSpanFull()
                            ->placeholder('Enter details')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                                ['h2', 'h3'],
                                ['bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ]),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
