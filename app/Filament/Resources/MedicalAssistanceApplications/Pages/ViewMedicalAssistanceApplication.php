<?php

namespace App\Filament\Resources\MedicalAssistanceApplications\Pages;

use App\Filament\Resources\MedicalAssistanceApplications\MedicalAssistanceApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMedicalAssistanceApplication extends ViewRecord
{
    protected static string $resource = MedicalAssistanceApplicationResource::class;

    protected string $view = 'filament.resources.medical-assistance-application.pages.view-medical-assistance-application';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
