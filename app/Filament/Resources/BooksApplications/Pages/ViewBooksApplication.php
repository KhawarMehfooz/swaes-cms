<?php

namespace App\Filament\Resources\BooksApplications\Pages;

use App\Filament\Resources\BooksApplications\BooksApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBooksApplication extends ViewRecord
{
    protected static string $resource = BooksApplicationResource::class;

    protected string $view = 'filament.resources.books-application.pages.view-books-application';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
