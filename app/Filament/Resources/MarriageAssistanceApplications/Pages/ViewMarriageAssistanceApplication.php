<?php

namespace App\Filament\Resources\MarriageAssistanceApplications\Pages;

use App\Filament\Resources\MarriageAssistanceApplications\MarriageAssistanceApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMarriageAssistanceApplication extends ViewRecord
{
    protected static string $resource = MarriageAssistanceApplicationResource::class;

    protected string $view = 'filament.resources.marriage-assistance-application.pages.view-marriage-assistance-application';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
