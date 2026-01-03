<?php

namespace App\Filament\Resources\BalanceSheets;

use App\Filament\Resources\BalanceSheets\Pages\CreateBalanceSheet;
use App\Filament\Resources\BalanceSheets\Pages\EditBalanceSheet;
use App\Filament\Resources\BalanceSheets\Pages\ListBalanceSheets;
use App\Filament\Resources\BalanceSheets\Pages\ViewBalanceSheet;
use App\Filament\Resources\BalanceSheets\Schemas\BalanceSheetForm;
use App\Filament\Resources\BalanceSheets\Schemas\BalanceSheetInfolist;
use App\Filament\Resources\BalanceSheets\Tables\BalanceSheetsTable;
use App\Models\BalanceSheet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class BalanceSheetResource extends Resource
{
    protected static ?string $model = BalanceSheet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static string|UnitEnum|null $navigationGroup = 'Accounting';

    public static function form(Schema $schema): Schema
    {
        return BalanceSheetForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BalanceSheetInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BalanceSheetsTable::configure($table);
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
            'index' => ListBalanceSheets::route('/'),
            'create' => CreateBalanceSheet::route('/create'),
            'view' => ViewBalanceSheet::route('/{record}'),
            'edit' => EditBalanceSheet::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    // disable editing for balance sheets
    public static function canEdit($record): bool
    {
        return false;
    }
}
