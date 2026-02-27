<?php

namespace App\Filament\Resources\TerapiBalurs\Pages;

use App\Filament\Resources\TerapiBalurs\TerapiBalurResource;
use Filament\Resources\Pages\ViewRecord;

use Filament\Schemas\Schema;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;

class ViewTerapiBalur extends ViewRecord
{
    protected static string $resource = TerapiBalurResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema->schema([
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
                        ->formatStateUsing(
                            fn($state) =>
                            is_array($state) ? implode(', ', $state) : '-'
                        ),

                    TextEntry::make('minum')
                        ->label('Minum')
                        ->formatStateUsing(
                            fn($state) =>
                            is_array($state) ? implode(', ', $state) : '-'
                        ),

                    TextEntry::make('therapist_notes')
                        ->label('Catatan Terapis'),
                ]),

            Section::make('Dokumentasi')
                ->schema([
                    ImageEntry::make('image_tembaga')
                        ->label('Foto Tembaga'),

                    ImageEntry::make('image_patient')
                        ->label('Foto Pasien'),
                ])
                ->columns(2),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
