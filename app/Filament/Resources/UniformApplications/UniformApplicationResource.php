<?php

namespace App\Filament\Resources\UniformApplications;

use App\Filament\Resources\UniformApplications\Pages\CreateUniformApplication;
use App\Filament\Resources\UniformApplications\Pages\EditUniformApplication;
use App\Filament\Resources\UniformApplications\Pages\ListUniformApplications;
use App\Filament\Resources\UniformApplications\Pages\ViewUniformApplication;
use App\Filament\Resources\UniformApplications\Schemas\UniformApplicationForm;
use App\Filament\Resources\UniformApplications\Schemas\UniformApplicationInfolist;
use App\Filament\Resources\UniformApplications\Tables\UniformApplicationsTable;
use App\Models\UniformApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class UniformApplicationResource extends Resource
{
    protected static ?string $model = UniformApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'Application Forms';

    protected static ?string $recordTitleAttribute = 'student_name';

    public static function form(Schema $schema): Schema
    {
        return UniformApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UniformApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UniformApplicationsTable::configure($table);
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
            'index' => ListUniformApplications::route('/'),
            'create' => CreateUniformApplication::route('/create'),
            'view' => ViewUniformApplication::route('/{record}'),
            'edit' => EditUniformApplication::route('/{record}/edit'),
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
