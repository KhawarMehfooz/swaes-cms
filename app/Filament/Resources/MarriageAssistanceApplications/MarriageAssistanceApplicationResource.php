<?php

namespace App\Filament\Resources\MarriageAssistanceApplications;

use App\Filament\Resources\MarriageAssistanceApplications\Pages\CreateMarriageAssistanceApplication;
use App\Filament\Resources\MarriageAssistanceApplications\Pages\EditMarriageAssistanceApplication;
use App\Filament\Resources\MarriageAssistanceApplications\Pages\ListMarriageAssistanceApplications;
use App\Filament\Resources\MarriageAssistanceApplications\Pages\ViewMarriageAssistanceApplication;
use App\Filament\Resources\MarriageAssistanceApplications\Schemas\MarriageAssistanceApplicationForm;
use App\Filament\Resources\MarriageAssistanceApplications\Schemas\MarriageAssistanceApplicationInfolist;
use App\Filament\Resources\MarriageAssistanceApplications\Tables\MarriageAssistanceApplicationsTable;
use App\Models\MarriageAssistanceApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class MarriageAssistanceApplicationResource extends Resource
{
    protected static ?string $model = MarriageAssistanceApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGiftTop;

    protected static string|UnitEnum|null $navigationGroup = 'Application Forms';

    protected static ?string $recordTitleAttribute = 'applicant_name';

    public static function form(Schema $schema): Schema
    {
        return MarriageAssistanceApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MarriageAssistanceApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MarriageAssistanceApplicationsTable::configure($table);
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
            'index' => ListMarriageAssistanceApplications::route('/'),
            'create' => CreateMarriageAssistanceApplication::route('/create'),
            'view' => ViewMarriageAssistanceApplication::route('/{record}'),
            'edit' => EditMarriageAssistanceApplication::route('/{record}/edit'),
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
