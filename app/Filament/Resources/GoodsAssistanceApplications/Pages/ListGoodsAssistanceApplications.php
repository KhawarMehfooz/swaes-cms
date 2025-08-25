<?php

namespace App\Filament\Resources\GoodsAssistanceApplications\Pages;

use App\Filament\Resources\GoodsAssistanceApplications\GoodsAssistanceApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGoodsAssistanceApplications extends ListRecords
{
    protected static string $resource = GoodsAssistanceApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
