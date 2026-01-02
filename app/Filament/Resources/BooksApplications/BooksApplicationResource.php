<?php

namespace App\Filament\Resources\BooksApplications;

use App\Filament\Resources\BooksApplications\Pages\CreateBooksApplication;
use App\Filament\Resources\BooksApplications\Pages\EditBooksApplication;
use App\Filament\Resources\BooksApplications\Pages\ListBooksApplications;
use App\Filament\Resources\BooksApplications\Pages\ViewBooksApplication;
use App\Filament\Resources\BooksApplications\Schemas\BooksApplicationForm;
use App\Filament\Resources\BooksApplications\Schemas\BooksApplicationInfolist;
use App\Filament\Resources\BooksApplications\Tables\BooksApplicationsTable;
use App\Models\BooksApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class BooksApplicationResource extends Resource
{
    protected static ?string $model = BooksApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BookOpen;

    protected static string|UnitEnum|null $navigationGroup = 'Application Forms';

    protected static ?string $recordTitleAttribute = 'student_name';

    public static function form(Schema $schema): Schema
    {
        return BooksApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BooksApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BooksApplicationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBooksApplications::route('/'),
            'create' => CreateBooksApplication::route('/create'),
            'view' => ViewBooksApplication::route('/{record}'),
            'edit' => EditBooksApplication::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
