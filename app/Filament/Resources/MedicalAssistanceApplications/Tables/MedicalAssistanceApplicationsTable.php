<?php

namespace App\Filament\Resources\MedicalAssistanceApplications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MedicalAssistanceApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('applicant_name')
                    ->label('Applicant\'s Name'),
                TextColumn::make('applicant_cnic')
                    ->label('Applicant\'s CNIC')
                    ->searchable(),
                TextColumn::make('applicant_mobile_number')
                    ->label('Applicant\'s Mobile No.')
                    ->searchable(),
                TextColumn::make('patient_name')
                    ->label('Patient\'s Name')
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
                        $newRecord->applicant_name = $record->applicant_name.' (Copy)';
                        $newRecord->save();

                        return $newRecord;
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Fee Application Replicated')
                    ),
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
