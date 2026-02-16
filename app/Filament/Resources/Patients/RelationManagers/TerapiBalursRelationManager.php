<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
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
                    ->label('Rokok yang Digunakan')
                    ->toggleable(),

                ImageColumn::make('image_tembaga')
                    ->label('Foto Terapi')
                    ->height(50)
                    ->circular(),

                ImageColumn::make('image_patient')
                    ->label('Foto Kondisi Pasien')
                    ->height(50)
                    ->circular(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->infolist([
                        Section::make('Data Pasien')
                            ->schema([
                                TextEntry::make('patient.full_name')
                                    ->label('Nama Pasien'),

                                TextEntry::make('therapy_datetime')
                                    ->label('Tanggal & Waktu Terapi')
                                    ->dateTime('d M Y H:i'),
                            ])
                            ->columns(2),

                        Section::make('Kondisi Pasien')
                            ->schema([
                                TextEntry::make('pre_complaint')
                                    ->label('Keluhan Sebelum Terapi'),

                                TextEntry::make('post_complaint')
                                    ->label('Keluhan Setelah Terapi'),
                            ]),

                        Section::make('Terapi')
                            ->schema([
                                TextEntry::make('rokok')
                                    ->label('Rokok yang Digunakan'),

                                TextEntry::make('enema')
                                    ->label('Enema')
                                    ,

                                TextEntry::make('minum')
                                    ->label('Minum'),

                                TextEntry::make('therapist_notes')
                                    ->label('Catatan Terapis'),
                            ]),

                        Section::make('Dokumentasi')
                            ->schema([
                                ImageEntry::make('image_tembaga')
                                    ->label('Foto Tembaga'),

                                ImageEntry::make('image_patient')
                                    ->label('Foto Kondisi Pasien'),
                            ])
                            ->columns(2),
                    ]),
            ])

            ->defaultSort('therapy_datetime', 'desc');
    }
}
