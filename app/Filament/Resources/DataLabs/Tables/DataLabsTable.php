<?php

namespace App\Filament\Resources\DataLabs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DataLabsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.full_name')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('images') 
		    ->label('Hasil Lab') 
		    ->square(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->recordActions([

                EditAction::make(),

                ViewAction::make(),

                /*
                |--------------------------------------------------------------------------
                | DOWNLOAD BUTTON
                |--------------------------------------------------------------------------
                */

                Action::make('download')
                    ->label('Unduh')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn ($record) => filled($record->images))
                    ->url(function ($record) {

                        // $image = is_array($record->images)
                        //     ? (implode('+', $record->images) ?? null)
                        //     : $record->images;

                        // if (! $image) {
                        //     return null;
                        // }

                        // return route('file.download', [
                        //     'path' => str_replace('/', '|', $image),
                        //     // 'path' => $image."/".$record->patient_id,
                        // ]);
                        
                            return route('data-lab.batch.download', [
                                'id' => $record->id,
                            ]);

                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}