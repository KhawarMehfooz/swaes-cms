<?php

namespace App\Filament\Resources\FeeApplications\Pages;

use App\Filament\Resources\FeeApplications\FeeApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeeApplications extends ListRecords
{
    protected static string $resource = FeeApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
