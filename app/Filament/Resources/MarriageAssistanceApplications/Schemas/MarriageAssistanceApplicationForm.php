<?php

namespace App\Filament\Resources\MarriageAssistanceApplications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MarriageAssistanceApplicationForm
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
                    ->collapsible(),

                // Guardian/Applicant Details
                Section::make('Guardian / Applicant Details')
                    ->schema([
                        TextInput::make('applicant_cnic')
                            ->required()
                            ->label('CNIC')
                            ->mask('99999-9999999-9')
                            ->placeholder('12345-6789012-3')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('applicant_name')
                            ->required()
                            ->label('Applicant Name')
                            ->placeholder('Enter full name')
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('applicant_father_or_husband_name')
                            ->required()
                            ->label('Father’s or Husband’s Name')
                            ->placeholder('Enter Father’s or Husband’s Name')
                            ->prefixIcon('heroicon-o-user-group'),

                        TextInput::make('applicant_address')
                            ->required()
                            ->label('Address')
                            ->placeholder('Enter complete address')
                            ->columnSpan(2)
                            ->prefixIcon('heroicon-o-home'),

                        TextInput::make('applicant_mobile_number')
                            ->required()
                            ->label('Mobile Number')
                            ->mask('9999-9999999')
                            ->placeholder('0300-1234567')
                            ->prefixIcon('heroicon-o-phone'),

                        TextInput::make('applicant_occupation')
                            ->label('Occupation')
                            ->placeholder('Enter occupation')
                            ->prefixIcon('heroicon-o-briefcase'),

                        TextInput::make('applicant_family_members')
                            ->numeric()
                            ->label('Family Members')
                            ->placeholder('Enter family members')
                            ->prefixIcon('heroicon-o-briefcase'),

                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsible(),

                // Bride Details
                Section::make('Bride Details')
                    ->schema([
                        TextInput::make('bride_cnic')
                            ->required()
                            ->label('CNIC')
                            ->mask('99999-9999999-9')
                            ->placeholder('12345-6789012-3')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('bride_name')
                            ->required()
                            ->label('Bride Name')
                            ->placeholder('Enter bride\'s full name')
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('bride_education')
                            ->required()
                            ->label('Education')
                            ->placeholder('Enter bride\'s education')
                            ->prefixIcon('heroicon-o-academic-cap'),

                        TextInput::make('bride_occupation')
                            ->required()
                            ->label('Bride Occupation')
                            ->placeholder('Enter Bride occupation')
                            ->prefixIcon('heroicon-o-briefcase'),

                        DatePicker::make('bride_dob')
                            ->label('Date of birth')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->default(now())
                            ->prefixIcon('heroicon-o-calendar'),

                        TextInput::make('bride_marriage_status')
                            ->required()
                            ->label('Marriage Status')
                            ->placeholder('Enter bride\'s marriage status')
                            ->prefixIcon('heroicon-o-heart'),

                        Textarea::make('bride_needs')
                            ->label('Bride\'s Needs')
                            ->required()
                            ->placeholder('Describe the assistance required')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
