<?php

namespace App\Filament\Resources\BooksApplications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BooksApplicationForm
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
                        Select::make('scheme_year')
                            ->label('Scheme')
                            ->options(
                                collect(range(2020, now()->year + 2))
                                    ->reverse()
                                    ->mapWithKeys(fn($year) => [$year => $year])
                            )
                            ->searchable()
                            ->required()
                            ->default(now()->year),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),

                // Student Details
                Section::make('Student Details')
                    ->schema([
                        TextInput::make('student_name')
                            ->required()
                            ->label('Name')
                            ->placeholder('Student Name')
                            ->prefixIcon('heroicon-o-user'),

                        TextInput::make('guardian_name')
                            ->required()
                            ->label('Father/Guardian Name')
                            ->placeholder('Father/Guardian Name')
                            ->prefixIcon('heroicon-o-user-group'),
                        TextInput::make('guardian_cnic')
                            ->required()
                            ->label('Father/Guardian CNIC')
                            ->mask('12345-6789123-4')
                            ->placeholder('12345-6789123-4')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('student_address')
                            ->required()
                            ->label('Student Address')
                            ->placeholder('Complete Address')
                            ->prefixIcon('heroicon-o-home')
                            ->columnSpan(2),

                        TextInput::make('guardian_contact_number')
                            ->required()
                            ->label('Father/Guardian Mobile No.')
                            ->mask('9999-9999999')
                            ->placeholder('0300-1234567')
                            ->prefixIcon('heroicon-o-phone'),

                        TextInput::make('guardian_source_of_income')
                            ->required()
                            ->label('Father/Guardian Source of Income')
                            ->placeholder('Father/Guardian Source of Income')
                            ->prefixIcon('heroicon-o-briefcase'),

                        TextInput::make('institution_name')
                            ->required()
                            ->label('Institution Name')
                            ->placeholder('School / College')
                            ->prefixIcon('heroicon-o-building-library'),

                        TextInput::make('class')
                            ->required()
                            ->label('Class')
                            ->placeholder('e.g., Class 6')
                            ->prefixIcon('heroicon-o-academic-cap'),
                        Textarea::make('stationary_details')
                            ->required()
                            ->label('Books/Stationary/School Bags')
                            ->placeholder('Enter the details of items')
                            ->columnSpanFull()



                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
