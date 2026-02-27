<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class DataLabsRelationManager extends RelationManager
{
    protected static string $relationship = 'dataLabs';
    protected static ?string $title = 'Data Lab';

    public function table(Table $table): Table
    {
        return $table

            ->columns([

                TextColumn::make('patient.full_name')
                    ->label('Pasien'),

                /*
                |--------------------------------------------------------------------------
                | Thumbnail di tabel (ambil gambar pertama kalau array)
                |--------------------------------------------------------------------------
                */
                ImageColumn::make('images')
                    ->label('Hasil Lab'),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])

            ->recordActions([

                /*
                |--------------------------------------------------------------------------
                | DETAIL MODAL
                |--------------------------------------------------------------------------
                */

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

                                /*
                                |--------------------------------------------------------------------------
                                | TAMPIL SEMUA GAMBAR (support array)
                                |--------------------------------------------------------------------------
                                */
                                ImageEntry::make('images')
                                    ->label('Hasil Lab')
                                    ->getStateUsing(
                                        fn($record) =>
                                        is_array($record->images)
                                            ? $record->images
                                            : [$record->images]
                                    )
                                    ->url(function ($state) {
                                        return route('lab.preview', [
                                            'path' => str_replace('/', '|', $state),
                                        ]);
                                    })
                                    ->openUrlInNewTab()
                                    ->columnSpanFull(),

                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y H:i'),
                            ]),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | DOWNLOAD (ambil gambar pertama)
                |--------------------------------------------------------------------------
                */

                Action::make('download_lab')
                    ->label('Unduh')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn($record) => filled($record->images))
                    ->url(function ($record) {

                        $image = is_array($record->images)
                            ? ($record->images[0] ?? null)
                            : $record->images;

                        if (! $image) {
                            return null;
                        }

                        return route('data-lab.batch.download', [
                            'id' => $record->id,
                        ]);
                    }),
            ]);
    }
}
