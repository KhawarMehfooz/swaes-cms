<?php

namespace App\Filament\Resources\MedicalAssistanceApplications;

use App\Filament\Resources\MedicalAssistanceApplications\Pages\CreateMedicalAssistanceApplication;
use App\Filament\Resources\MedicalAssistanceApplications\Pages\EditMedicalAssistanceApplication;
use App\Filament\Resources\MedicalAssistanceApplications\Pages\ListMedicalAssistanceApplications;
use App\Filament\Resources\MedicalAssistanceApplications\Pages\ViewMedicalAssistanceApplication;
use App\Filament\Resources\MedicalAssistanceApplications\Schemas\MedicalAssistanceApplicationForm;
use App\Filament\Resources\MedicalAssistanceApplications\Schemas\MedicalAssistanceApplicationInfolist;
use App\Filament\Resources\MedicalAssistanceApplications\Tables\MedicalAssistanceApplicationsTable;
use App\Models\MedicalAssistanceApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MedicalAssistanceApplicationResource extends Resource
{
    protected static ?string $model = MedicalAssistanceApplication::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $recordTitleAttribute = 'applicant_name';

    protected static string|UnitEnum|null $navigationGroup = 'Application Forms';

    public static function form(Schema $schema): Schema
    {
        return MedicalAssistanceApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MedicalAssistanceApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MedicalAssistanceApplicationsTable::configure($table);
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
            'index' => ListMedicalAssistanceApplications::route('/'),
            'create' => CreateMedicalAssistanceApplication::route('/create'),
            'view' => ViewMedicalAssistanceApplication::route('/{record}'),
            'edit' => EditMedicalAssistanceApplication::route('/{record}/edit'),
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
