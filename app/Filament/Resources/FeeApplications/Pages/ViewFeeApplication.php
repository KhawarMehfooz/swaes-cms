<?php

namespace App\Filament\Resources\FeeApplications\Pages;

use App\Filament\Resources\FeeApplications\FeeApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFeeApplication extends ViewRecord
{
    protected static string $resource = FeeApplicationResource::class;

    protected string $view = 'filament.resources.fee-application.pages.view-fee-application';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
