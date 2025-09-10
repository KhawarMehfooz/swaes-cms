<?php

namespace App\Filament\Resources\Donors\Pages;

use App\Filament\Resources\Donors\DonorResource;
use App\Livewire\DonorStatsWidget;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ViewDonor extends ViewRecord
{
    protected static string $resource = DonorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Donor Details')
                    ->schema([
                        Grid::make() 
                            ->columns(2) 
                            ->schema([
                                TextEntry::make('donor_name')
                                    ->label("Donor's Name")->size('md')->weight('bold'),
                                TextEntry::make('donor_cnic')
                                    ->label("Donor's CNIC")->size('md')->weight('bold'),
                            ]),

                        TextEntry::make('donor_contact_number')
                            ->label("Donor's Contact Number")->size('md')->weight('bold'),
                    ])
                    ->columnSpan(1),

                Section::make('Stats')
                    ->schema([
                        ViewEntry::make('stats')
                            ->view('filament.infolists.entries.donor-stats')
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
