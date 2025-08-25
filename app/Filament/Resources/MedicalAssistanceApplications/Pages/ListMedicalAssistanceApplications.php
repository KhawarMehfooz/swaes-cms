<?php

namespace App\Filament\Resources\MedicalAssistanceApplications\Pages;

use App\Filament\Resources\MedicalAssistanceApplications\MedicalAssistanceApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMedicalAssistanceApplications extends ListRecords
{
    protected static string $resource = MedicalAssistanceApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
