<?php

namespace App\Filament\Resources\MarriageAssistanceApplications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;


class MarriageAssistanceApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('applicant_name')
                    ->label('Applicant Name')
                    ->searchable(),
                TextColumn::make('applicant_cnic')
                    ->label('Applicant CNIC')
                    ->searchable(),
                TextColumn::make('applicant_mobile_number')
                    ->label('Applicant Mobile No.')
                    ->searchable(),

            ])
            ->filters([
                // TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                ReplicateAction::make()
                    ->modal(false)
                    ->using(function ($record) {
                        $newRecord = $record->replicate();
                        $newRecord->applicant_name = $record->applicant_name . ' (Copy)';
                        $newRecord->save();
                        return $newRecord;
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Marriage Assistance Application Replicated')
                    )
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
