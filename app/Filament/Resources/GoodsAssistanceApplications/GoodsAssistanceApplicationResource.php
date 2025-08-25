<?php

namespace App\Filament\Resources\GoodsAssistanceApplications;

use App\Filament\Resources\GoodsAssistanceApplications\Pages\CreateGoodsAssistanceApplication;
use App\Filament\Resources\GoodsAssistanceApplications\Pages\EditGoodsAssistanceApplication;
use App\Filament\Resources\GoodsAssistanceApplications\Pages\ListGoodsAssistanceApplications;
use App\Filament\Resources\GoodsAssistanceApplications\Pages\ViewGoodsAssistanceApplication;
use App\Filament\Resources\GoodsAssistanceApplications\Schemas\GoodsAssistanceApplicationForm;
use App\Filament\Resources\GoodsAssistanceApplications\Schemas\GoodsAssistanceApplicationInfolist;
use App\Filament\Resources\GoodsAssistanceApplications\Tables\GoodsAssistanceApplicationsTable;
use App\Models\GoodsAssistanceApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class GoodsAssistanceApplicationResource extends Resource
{
    protected static ?string $model = GoodsAssistanceApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCube;

    protected static string|UnitEnum|null $navigationGroup = 'Application Forms';

    public static function form(Schema $schema): Schema
    {
        return GoodsAssistanceApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GoodsAssistanceApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GoodsAssistanceApplicationsTable::configure($table);
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
            'index' => ListGoodsAssistanceApplications::route('/'),
            'create' => CreateGoodsAssistanceApplication::route('/create'),
            'view' => ViewGoodsAssistanceApplication::route('/{record}'),
            'edit' => EditGoodsAssistanceApplication::route('/{record}/edit'),
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
