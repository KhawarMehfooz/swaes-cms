<?php

namespace App\Filament\Resources\MedicalAssistanceApplications\Pages;

use App\Filament\Resources\MedicalAssistanceApplications\MedicalAssistanceApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMedicalAssistanceApplication extends EditRecord
{
    protected static string $resource = MedicalAssistanceApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
