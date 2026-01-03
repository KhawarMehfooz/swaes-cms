<?php

namespace App\Filament\Resources\MedicalAssistanceApplications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MedicalAssistanceApplicationForm
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

                        Select::make('applicant_marital_status')
                            ->required()
                            ->label('Marital Status')
                            ->options([
                                'single' => 'Single',
                                'married' => 'Married',
                                'widowed' => 'Widowed',
                                'divorced' => 'Divorced',
                            ])
                            ->placeholder('Select marital status')
                            ->prefixIcon('heroicon-o-heart'),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsible(),

                // Patient Details
                Section::make('Patient Details')
                    ->schema([
                        TextInput::make('patient_cnic')
                            ->required()
                            ->label('CNIC')
                            ->mask('99999-9999999-9')
                            ->placeholder('12345-6789012-3')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('patient_name')
                            ->required()
                            ->label('Patient Name')
                            ->placeholder('Enter patient’s full name')
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('patient_disease')
                            ->required()
                            ->label('Disease')
                            ->placeholder('Enter disease name')
                            ->prefixIcon('heroicon-o-heart'),

                        TextInput::make('hospital_name')
                            ->required()
                            ->label('Hospital Name')
                            ->placeholder('Enter hospital name')
                            ->prefixIcon('heroicon-o-building-office'),

                        DatePicker::make('date_of_admission')
                            ->label('Date of Admission')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->default(now())
                            ->prefixIcon('heroicon-o-calendar'),

                        TextInput::make('doctor_name')
                            ->required()
                            ->label('Doctor’s Name')
                            ->placeholder('Enter doctor’s name')
                            ->prefixIcon('heroicon-o-user-circle'),

                        Textarea::make('patient_needs')
                            ->label('Patient’s Needs')
                            ->placeholder('Describe the assistance required')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
