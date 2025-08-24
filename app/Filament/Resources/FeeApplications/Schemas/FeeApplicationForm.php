<?php

namespace App\Filament\Resources\FeeApplications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use App\Settings\GeneralSettings;

class FeeApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Application Details')
                    ->schema([
                        DatePicker::make('dated')
                            ->label('Application Date')
                            ->required()
                            ->displayFormat('d/m/Y') 
                            ->format('Y-m-d')
                            ->default(now())
                            ->prefixIcon('heroicon-o-calendar'),
                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->collapsible(),

                // Applicant Details
                Section::make('Applicant Details')
                    ->schema([
                        TextInput::make('cnic')
                            ->required()
                            ->label('CNIC')
                            ->mask('99999-9999999-9')
                            ->placeholder('12345-6789012-3')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('name')
                            ->required()
                            ->label('Name')
                            ->placeholder('Applicant Name')
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('father_name')
                            ->required()
                            ->label('Father\'s Name')
                            ->placeholder('Father Name')
                            ->prefixIcon('heroicon-o-user-group'),

                        TextInput::make('address')
                            ->required()
                            ->label('Address')
                            ->placeholder('Complete Address')
                            ->columnSpan(2)
                            ->prefixIcon('heroicon-o-home'),

                        TextInput::make('mobile_number')
                            ->required()
                            ->label('Mobile No.')
                            ->mask('9999-9999999')
                            ->placeholder('0300-1234567')
                            ->prefixIcon('heroicon-o-phone'),

                        TextInput::make('institution_name')
                            ->required()
                            ->label('Institution Name')
                            ->placeholder('School / College / University')
                            ->prefixIcon('heroicon-o-building-library'),

                        TextInput::make('session')
                            ->required()
                            ->label('Session')
                            ->placeholder('e.g., 2024-2025')
                            ->prefixIcon('heroicon-o-calendar'),

                        Select::make('fee_type')
                            ->required()
                            ->label('Fee Type')
                            ->options([
                                'admission_fee' => 'Admission Fee',
                                'annual' => 'Annual Fee',
                                'exam_fee' => 'Exam Fee',
                                'monthly' => 'Monthly Fee',
                                'semester' => 'Semester Fee',
                            ])
                            ->placeholder('Select Fee Type')
                            ->prefixIcon('heroicon-o-currency-dollar'),

                        TextInput::make('total_fee')
                            ->required()
                            ->label('Total Fee')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->placeholder('Enter total amount')
                            ->prefix(app(GeneralSettings::class)->currency_symbol),

                        TextInput::make('chalan_number')
                            ->required()
                            ->label('Chalan Number')
                            ->placeholder('Enter Chalan No.')
                            ->prefixIcon('heroicon-o-receipt-percent'),

                        TextInput::make('bank')
                            ->required()
                            ->label('Bank')
                            ->placeholder('Bank Name')
                            ->prefixIcon('heroicon-o-building-office'),

                        Textarea::make('additional_details')
                            ->label('Additional Details')
                            ->placeholder('Enter any extra details...')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsible(),


                // Guardian Details
                Section::make('Guardian Details')
                    ->schema([
                        TextInput::make('guardian_cnic')
                            ->required()
                            ->label('CNIC')
                            ->mask('99999-9999999-9')
                            ->placeholder('12345-6789012-3')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('guardian_name')
                            ->required()
                            ->label('Name')
                            ->placeholder('Guardian Name')
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('guardian_address')
                            ->required()
                            ->label('Address')
                            ->placeholder('Complete Address')
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-o-home'),

                        TextInput::make('guardian_mobile_number')
                            ->required()
                            ->label('Mobile No.')
                            ->mask('9999-9999999')
                            ->placeholder('0300-1234567')
                            ->prefixIcon('heroicon-o-phone'),

                        TextInput::make('guardian_amount')
                            ->required()
                            ->label('Amount')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->placeholder('Enter amount')
                            ->prefix(app(GeneralSettings::class)->currency_symbol),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
