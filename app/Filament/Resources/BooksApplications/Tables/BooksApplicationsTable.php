<?php

namespace App\Filament\Resources\BooksApplications\Tables;

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

class BooksApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_name')
                    ->searchable(),
                TextColumn::make('guardian_name')
                    ->searchable(),
                TextColumn::make('guardian_cnic')
                    ->searchable(),
                TextColumn::make('scheme_year')
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
                        $newRecord->student_name = $record->student_name.' (Copy)';
                        $newRecord->save();

                        return $newRecord;
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Books Application Replicated')
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
