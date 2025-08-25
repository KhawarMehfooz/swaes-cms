<?php

namespace App\Filament\Resources\UniformApplications\Pages;

use App\Filament\Resources\UniformApplications\UniformApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUniformApplications extends ListRecords
{
    protected static string $resource = UniformApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
