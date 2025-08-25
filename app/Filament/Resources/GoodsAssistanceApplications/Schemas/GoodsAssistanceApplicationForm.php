<?php

namespace App\Filament\Resources\GoodsAssistanceApplications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GoodsAssistanceApplicationForm
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

                // Goods Details
                Section::make('Goods Details')
                    ->schema([
                        RichEditor::make('goods_details')
                            ->required()
                            ->label('Detail of Goods')
                            ->columnSpanFull()
                            ->placeholder('Enter details of goods')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                                ['h2', 'h3'],
                                ['bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ]),
                    ])
                    ->columnSpanFull()
                    ->collapsible(),


                // Payment Details
                Section::make('Payment Details')
                    ->schema([
                        RichEditor::make('payment_details')
                            ->required()
                            ->label('Details of Payment')
                            ->columnSpanFull()
                            ->placeholder('Enter details of payment')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                                ['h2', 'h3'],
                                ['bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ]),
                        TextInput::make('cheque_and_bill_number')
                            ->required()
                            ->label('Cheque and Bill Number')
                            ->placeholder('Enter bill number')
                            ->prefixIcon('heroicon-o-document-text')
                    ])
                    ->columnSpanFull()
                    ->collapsible(),

                // Receiver Details
                Section::make('Receiver Details')
                    ->schema([
                        TextInput::make('receiver_name')
                            ->required()
                            ->label('Receiver Name')
                            ->placeholder('Enter name of receiver')
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('receiver_cnic')
                            ->required()
                            ->label('CNIC')
                            ->mask('99999-9999999-9')
                            ->placeholder('12345-6789012-3')
                            ->prefixIcon('heroicon-o-identification'),
                        TextInput::make('receiver_mobile_number')
                            ->required()
                            ->label('Mobile No.')
                            ->mask('9999-9999999')
                            ->placeholder('0300-1234567')
                            ->prefixIcon('heroicon-o-phone'),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
