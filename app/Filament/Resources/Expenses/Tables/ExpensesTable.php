<?php

namespace App\Filament\Resources\Expenses\Tables;

use App\Models\BalanceSheet;
use App\Models\Transaction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('purpose')->searchable(),
                TextColumn::make('amount'),
                TextColumn::make('created_at')->dateTime(),

            ])->defaultSort('created_at', 'desc')
            ->headerActions([
                // Real create expense, only visible if an active balance sheet exists
                CreateAction::make()
                    ->label('Create Expense')
                    ->modalHeading('New Expense')
                    ->visible(fn(): bool => ($bs = BalanceSheet::latest()->first()) && $bs->status !== 'finalized')
                    ->using(function (array $data): Transaction {
                        $currentBalanceSheet = BalanceSheet::latest()->first();

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
                // TrashedFilter::make(),
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
