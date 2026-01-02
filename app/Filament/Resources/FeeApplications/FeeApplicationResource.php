<?php

namespace App\Filament\Resources\FeeApplications;

use App\Filament\Resources\FeeApplications\Pages\CreateFeeApplication;
use App\Filament\Resources\FeeApplications\Pages\EditFeeApplication;
use App\Filament\Resources\FeeApplications\Pages\ListFeeApplications;
use App\Filament\Resources\FeeApplications\Pages\ViewFeeApplication;
use App\Filament\Resources\FeeApplications\Schemas\FeeApplicationForm;
use App\Filament\Resources\FeeApplications\Schemas\FeeApplicationInfolist;
use App\Filament\Resources\FeeApplications\Tables\FeeApplicationsTable;
use App\Models\FeeApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class FeeApplicationResource extends Resource
{
    protected static ?string $model = FeeApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingLibrary;

    protected static string|UnitEnum|null $navigationGroup = 'Application Forms';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return FeeApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FeeApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeeApplicationsTable::configure($table);
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
            'index' => ListFeeApplications::route('/'),
            'create' => CreateFeeApplication::route('/create'),
            'view' => ViewFeeApplication::route('/{record}'),
            'edit' => EditFeeApplication::route('/{record}/edit'),
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
