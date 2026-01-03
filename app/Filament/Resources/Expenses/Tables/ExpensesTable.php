<?php

namespace App\Filament\Resources\Expenses\Tables;

use App\Models\AccountOfExpense;
use App\Models\BalanceSheet;
use App\Models\Transaction;
use App\Settings\GeneralSettings;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('accountOfExpense.name')
                    ->label('Account of Expense')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->formatStateUsing(
                        fn($state) => app(GeneralSettings::class)->currency_symbol . ' ' . number_format($state, 2)
                    )
                    ->sortable(),
                TextColumn::make('dated')->date(),

            ])->defaultSort('dated', 'desc')
            ->headerActions([
                CreateAction::make()
                    ->label('Create Expense')
                    ->modalWidth('lg')
                    ->modalHeading('New Expense')
                    ->visible(fn(): bool => ($bs = BalanceSheet::latest()->first()) && $bs->status !== 'finalized')
                    ->using(function (array $data): Transaction {
                        $currentBalanceSheet = BalanceSheet::latest()->first();

                        // Auto-populate purpose from account of expense name for backward compatibility
                        if (isset($data['account_of_expense_id'])) {
                            $accountOfExpense = AccountOfExpense::find($data['account_of_expense_id']);
                            if ($accountOfExpense) {
                                $data['purpose'] = $accountOfExpense->name;
                            }
                        }

                        $transaction = Transaction::create([
                            ...$data,
                            'balance_sheet_id' => $currentBalanceSheet->id,
                            'type' => 'expense',
                        ]);

                        Notification::make()
                            ->title('Expense recorded successfully')
                            ->body('Added under balance sheet ' . $currentBalanceSheet->month)
                            ->success()
                            ->send();

                        return $transaction;
                    })
                    ->successNotification(null),

                // Fallback action when blocked
                \Filament\Actions\Action::make('blockedCreateExpense')
                    ->label('Create Expense')
                    ->color('gray')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->visible(fn(): bool => !(($bs = BalanceSheet::latest()->first()) && $bs->status !== 'finalized'))
                    ->action(function () {
                        Notification::make()
                            ->title('No active balance sheet')
                            ->body('Please create a new balance sheet to record expense.')
                            ->danger()
                            ->send();
                    }),
            ])

            ->filters([
                Filter::make('dated_range')
                    ->label('Date range')
                    ->form([
                        DatePicker::make('from')
                            ->label('From date')
                            ->maxDate(now()),

                        DatePicker::make('to')
                            ->label('To date')
                            ->maxDate(now()),
                    ])
                    ->query(
                        fn(Builder $query, array $data) =>
                        $query
                            ->when($data['from'], fn($q, $d) => $q->whereDate('dated', '>=', $d))
                            ->when($data['to'], fn($q, $d) => $q->whereDate('dated', '<=', $d))
                    ),

                SelectFilter::make('account_of_expense_id')
                    ->label('Account of Expense')
                    ->relationship(
                        'accountOfExpense',
                        'name',
                        fn($query) => $query->whereHas(
                            'transactions',
                            fn($q) =>
                            $q->where('type', 'expense')
                        )
                    )
                    ->searchable()
                    ->preload()

            ])

            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                //     ForceDeleteBulkAction::make(),
                //     RestoreBulkAction::make(),
                // ]),
            ]);
    }
}
