<?php

namespace App\Filament\Resources\ExpensesApplications;

use App\Filament\Resources\ExpensesApplications\Pages\CreateExpensesApplication;
use App\Filament\Resources\ExpensesApplications\Pages\EditExpensesApplication;
use App\Filament\Resources\ExpensesApplications\Pages\ListExpensesApplications;
use App\Filament\Resources\ExpensesApplications\Pages\ViewExpensesApplication;
use App\Filament\Resources\ExpensesApplications\Schemas\ExpensesApplicationForm;
use App\Filament\Resources\ExpensesApplications\Schemas\ExpensesApplicationInfolist;
use App\Filament\Resources\ExpensesApplications\Tables\ExpensesApplicationsTable;
use App\Models\ExpensesApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class ExpensesApplicationResource extends Resource
{
    protected static ?string $model = ExpensesApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static string|UnitEnum|null $navigationGroup = 'Application Forms';

    public static function form(Schema $schema): Schema
    {
        return ExpensesApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExpensesApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpensesApplicationsTable::configure($table);
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
            'index' => ListExpensesApplications::route('/'),
            'create' => CreateExpensesApplication::route('/create'),
            'view' => ViewExpensesApplication::route('/{record}'),
            'edit' => EditExpensesApplication::route('/{record}/edit'),
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
