<?php

namespace App\Filament\Resources\BalanceSheets\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BalanceSheetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('month'),
                TextColumn::make('opening_balance')
                    ->label('Opening Balance'),
                TextColumn::make('closing_balance')
                    ->label('Closing Balance'),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'finalized',
                        'danger' => 'locked',
                    ])
                    ->icons([
                        'heroicon-o-pencil-square' => 'draft',
                        'heroicon-o-check-circle' => 'finalized',
                        'heroicon-o-lock-closed' => 'locked',
                    ])
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
            ])
            ->filters([
                // TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('finalize')
                    ->label('Finalize')
                    ->icon('heroicon-o-lock-closed')
                    ->color('info')
                    ->visible(function ($record) {
                        return $record->status !== 'finalized';
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Finalize Balance Sheet')
                    ->modalDescription('Finalizing will lock this balance sheet.')
                    ->action(function ($data, $record) {
                        // Fetch related transactions
                        $incomes = $record->transactions()
                            ->where('type', 'income')
                            ->sum('amount');

                        $expenses = $record->transactions()
                            ->where('type', 'expense')
                            ->sum('amount');

                        // Calculate closing balance
                        $closingBalance = $record->opening_balance + $incomes - $expenses;

                        // Update the record
                        $record->update([
                            'closing_balance' => $closingBalance,
                            'status' => 'finalized',
                        ]);

                        Notification::make()
                            ->title('Balance sheet finalized successfully.')
                            ->success()
                            ->send();
                    })

                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                    // ForceDeleteBulkAction::make(),
                    // RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
