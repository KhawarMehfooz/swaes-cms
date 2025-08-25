<?php

namespace App\Filament\Resources\UniformApplications\Pages;

use App\Filament\Resources\UniformApplications\UniformApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUniformApplication extends ViewRecord
{
    protected static string $resource = UniformApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
