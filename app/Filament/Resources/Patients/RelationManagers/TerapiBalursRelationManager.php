<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;

class TerapiBalursRelationManager extends RelationManager
{
    protected static string $relationship = 'terapiBalurs';
    protected static ?string $title = 'Riwayat Terapi Balur';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('therapy_datetime')

            ->columns([
                TextColumn::make('patient.full_name')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('therapy_datetime')
                    ->label('Tanggal Terapi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('rokok')
                    ->label('Rokok')
                    ->limit(20)
                    ->toggleable(),

                ImageColumn::make('image_tembaga')
                    ->label('Foto Terapi')
                    ->disk('public')
                    ->height(50)
                    ->circular()
                    ->openUrlInNewTab(),

                ImageColumn::make('image_patient')
                    ->label('Foto Pasien')
                    ->disk('public')
                    ->height(50)
                    ->circular()
                    ->openUrlInNewTab(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->recordActions([

                /*
                |--------------------------------------------------------------------------
                | DETAIL MODAL
                |--------------------------------------------------------------------------
                */

                ViewAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detail Terapi Balur')
                    ->modalWidth('7xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')

                    ->infolist([

                        Section::make('Data Pasien')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('patient.full_name')
                                    ->label('Nama Pasien'),

                                TextEntry::make('therapy_datetime')
                                    ->label('Tanggal & Waktu Terapi')
                                    ->dateTime('d M Y H:i'),
                            ]),

                        Section::make('Kondisi Pasien')
                            ->schema([
                                TextEntry::make('tensi')
                                    ->label('Tensi'),

                                TextEntry::make('pre_complaint')
                                    ->label('Keluhan Sebelum Terapi'),

                                TextEntry::make('post_complaint')
                                    ->label('Keluhan Setelah Terapi'),
                            ]),

                        Section::make('Catatan Dokter')
                            ->schema([
                                TextEntry::make('doctor_treatment_plan_preview')
                                    ->label('Rencana Perawatan Dokter'),

                                TextEntry::make('teraphist_notes_preview')
                                    ->label('Catatan Dokter'),
                            ]),

                        Section::make('Terapi')
                            ->schema([
                                TextEntry::make('rokok')
                                    ->label('Rokok')
                                    ->formatStateUsing(fn ($state) =>
                                        is_array($state) ? implode(', ', $state) : $state
                                    ),

                                TextEntry::make('enema')
                                    ->label('Enema')
                                    ->formatStateUsing(fn ($state) =>
                                        is_array($state) ? implode(', ', $state) : $state
                                    ),

                                TextEntry::make('minum')
                                    ->label('Minum')
                                    ->formatStateUsing(fn ($state) =>
                                        is_array($state) ? implode(', ', $state) : $state
                                    ),

                                TextEntry::make('therapist_notes')
                                    ->label('Catatan Terapis'),

                                TextEntry::make('keterangan_terapi')
                                    ->label('Keterangan Terapi'),
                            ]),

                        Section::make('Dokumentasi')
                            ->columns(2)
                            ->schema([
                                ImageEntry::make('image_tembaga')
                                    ->label('Foto Tembaga')
                                    ->disk('public'),

                                ImageEntry::make('image_patient')
                                    ->label('Foto Pasien')
                                    ->disk('public'),
                            ]),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | DOWNLOAD (FORCE DOWNLOAD)
                |--------------------------------------------------------------------------
                */

                Action::make('download_tembaga')
                    ->label('Unduh Foto Tembaga')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn ($record) => filled($record->image_tembaga))
                    ->url(fn ($record) =>
                        route('file.download', [
                            'path' => str_replace('/', '|', $record->image_tembaga),
                        ])
                    ),

                Action::make('download_patient')
                    ->label('Unduh Foto Kondisi Pasien')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->visible(fn ($record) => filled($record->image_patient))
                    ->url(fn ($record) =>
                        route('file.download', [
                            'path' => str_replace('/', '|', $record->image_patient),
                        ])
                    ),
            ])

            ->defaultSort('therapy_datetime', 'desc');
    }
}