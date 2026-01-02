<?php

namespace App\Filament\Resources\AccountOfExpenses;

use App\Filament\Resources\AccountOfExpenses\Pages\CreateAccountOfExpense;
use App\Filament\Resources\AccountOfExpenses\Pages\EditAccountOfExpense;
use App\Filament\Resources\AccountOfExpenses\Pages\ListAccountOfExpenses;
use App\Filament\Resources\AccountOfExpenses\Pages\ViewAccountOfExpense;
use App\Filament\Resources\AccountOfExpenses\Schemas\AccountOfExpenseForm;
use App\Filament\Resources\AccountOfExpenses\Schemas\AccountOfExpenseInfolist;
use App\Filament\Resources\AccountOfExpenses\Tables\AccountOfExpensesTable;
use App\Models\AccountOfExpense;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class AccountOfExpenseResource extends Resource
{
    protected static ?string $model = AccountOfExpense::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    protected static string|UnitEnum|null $navigationGroup = 'Accounting';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AccountOfExpenseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AccountOfExpenseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountOfExpensesTable::configure($table);
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
            'index' => ListAccountOfExpenses::route('/'),
            'create' => CreateAccountOfExpense::route('/create'),
            'view' => ViewAccountOfExpense::route('/{record}'),
            'edit' => EditAccountOfExpense::route('/{record}/edit'),
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
