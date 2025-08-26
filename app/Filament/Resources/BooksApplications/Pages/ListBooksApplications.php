<?php

namespace App\Filament\Resources\BooksApplications\Pages;

use App\Filament\Resources\BooksApplications\BooksApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBooksApplications extends ListRecords
{
    protected static string $resource = BooksApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
