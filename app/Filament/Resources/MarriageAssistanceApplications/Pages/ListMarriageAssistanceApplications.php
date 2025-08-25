<?php

namespace App\Filament\Resources\MarriageAssistanceApplications\Pages;

use App\Filament\Resources\MarriageAssistanceApplications\MarriageAssistanceApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMarriageAssistanceApplications extends ListRecords
{
    protected static string $resource = MarriageAssistanceApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
