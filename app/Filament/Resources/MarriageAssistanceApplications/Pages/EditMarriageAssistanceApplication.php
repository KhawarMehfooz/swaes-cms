<?php

namespace App\Filament\Resources\MarriageAssistanceApplications\Pages;

use App\Filament\Resources\MarriageAssistanceApplications\MarriageAssistanceApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMarriageAssistanceApplication extends EditRecord
{
    protected static string $resource = MarriageAssistanceApplicationResource::class;

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
