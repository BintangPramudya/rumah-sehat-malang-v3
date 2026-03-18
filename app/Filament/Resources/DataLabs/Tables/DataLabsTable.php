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
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

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
            ->defaultSort('created_at', 'desc')
            ->recordActions([

                EditAction::make(),

                ViewAction::make()
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->modalWidth('7xl')
                    ->modalSubmitAction(false)

                    ->infolist([

                        Section::make('Data Lab')
                            ->columns(1)
                            ->schema([

                                TextEntry::make('patient.full_name')
                                    ->label('Nama Pasien'),

                                ImageEntry::make('images')
                                    ->label('Hasil Lab')
                                    ->getStateUsing(
                                        fn($record) =>
                                        is_array($record->images)
                                            ? $record->images
                                            : [$record->images]
                                    )
                                    ->url(fn($state) => asset('storage/' . $state))
                                    ->openUrlInNewTab()
                                    ->columnSpanFull(),

                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y H:i'),
                            ]),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | DOWNLOAD BUTTON
                |--------------------------------------------------------------------------
                */

                Action::make('download')
                    ->label('Unduh')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn($record) => filled($record->images))
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
