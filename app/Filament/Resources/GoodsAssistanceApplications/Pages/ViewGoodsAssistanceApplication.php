<?php

namespace App\Filament\Resources\GoodsAssistanceApplications\Pages;

use App\Filament\Resources\GoodsAssistanceApplications\GoodsAssistanceApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGoodsAssistanceApplication extends ViewRecord
{
    protected static string $resource = GoodsAssistanceApplicationResource::class;

    protected string $view = 'filament.resources.goods-assistance-application.pages.view-goods-assistance-application';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
