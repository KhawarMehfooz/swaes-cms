<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class AppSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string $settings = GeneralSettings::class;

    protected static ?string $title = 'Settings';
    public function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Organization Information')
                ->description('Manage your organization\'s core details.')
                ->schema([
                    TextInput::make('organization_name')
                        ->label('Organization Name')
                        ->placeholder('Enter organization name')
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-building-office'),

                    TextInput::make('address')
                        ->label('Address')
                        ->placeholder('Enter full address')
                        ->required()
                        ->maxLength(500)
                        ->prefixIcon('heroicon-o-map-pin'),

                    TextInput::make('president')
                        ->label('President Name')
                        ->placeholder('Enter president\'s name')
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-user'),
                    FileUpload::make('logo')
                        ->label('Logo')
                        ->image() 
                        ->directory('logos') 
                        ->disk('public')
                        ->maxSize(4096) 
                        ->imagePreviewHeight('200') 
                        ->hint('Upload your organization\'s logo (PNG or JPG)')
                        ->imageEditor()
                        ->columnSpanFull(),
                ])
                ->columns(1),
        ]);

    }
    
}
