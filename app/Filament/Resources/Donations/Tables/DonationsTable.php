<?php

namespace App\Filament\Resources\Donations\Tables;

use App\Models\BalanceSheet;
use App\Models\Transaction;
use Filament\Actions\Action;
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
use App\Settings\GeneralSettings;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donor.donor_name')->searchable(),
                TextColumn::make('purpose')->searchable(),
                TextColumn::make('amount')->prefix(app(GeneralSettings::class)->currency_symbol . ' '),
                TextColumn::make('created_at')->dateTime(),
            ])->defaultSort('created_at', 'desc')
            ->headerActions([
                CreateAction::make()
                    ->label('New Donation')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('New Donation')
                    ->modalWidth('xl')
                    ->visible(fn(): bool => ($bs = BalanceSheet::latest()->first()) && $bs->status !== 'finalized')
                    ->using(function (array $data): Transaction {
                        $currentBalanceSheet = BalanceSheet::latest()->first();

                        $transaction = Transaction::create([
                            ...$data,
                            'balance_sheet_id' => $currentBalanceSheet->id,
                            'type' => 'income',
                        ]);

                        return $transaction;
                    }),

                Action::make('blockedCreateDonation')
                    ->label('New Donation')
                    ->color('gray')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->visible(fn(): bool => !(($bs = BalanceSheet::latest()->first()) && $bs->status !== 'finalized'))
                    ->action(function () {
                        Notification::make()
                            ->title('No active balance sheet')
                            ->body('Please create a new balance sheet to record donations.')
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
