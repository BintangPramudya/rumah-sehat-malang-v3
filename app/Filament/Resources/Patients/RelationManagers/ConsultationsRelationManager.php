<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConsultationsRelationManager extends RelationManager
{
    protected static string $relationship = 'consultations';

    protected static ?string $title = 'Riwayat Konsultasi';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('patient.image')
                    ->label('Foto Pasien')
                    ->circular()
                    ->size(50),

                TextColumn::make('consultation_datetime')
                    ->toggleable()
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i'),

                TextColumn::make('doctor.name')
                    ->label('Dokter'),

                TextColumn::make('diagnosis')
                    ->searchable()
                    ->label('Diagnosis')
                    ->limit(30),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->defaultSort('consultation_datetime', 'desc')
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detail Konsultasi')
                    ->modalWidth('7xl')
                    ->infolist([

                        Section::make('Informasi Umum')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('patient.full_name')
                                    ->label('Nama Pasien'),

                                TextEntry::make('doctor.name')
                                    ->label('Dokter'),

                                TextEntry::make('therapist.name')
                                    ->label('Terapis'),

                                TextEntry::make('consultation_datetime')
                                    ->label('Tanggal & Waktu Konsultasi')
                                    ->dateTime('d M Y H:i'),
                            ]),

                        Section::make('Anamnesis')
                            ->schema([
                                TextEntry::make('chief_complaint')
                                    ->label('Keluhan Utama'),

                                TextEntry::make('current_illness_history')
                                    ->label('Sakit yang dirasakan Sekarang'),

                                TextEntry::make('past_medical_history')
                                    ->label('Riwayat Penyakit Sebelumnya'),
                            ])
                            ->columns(1),

                        Section::make('Pemeriksaan & Diagnosa')
                            ->schema([
                                TextEntry::make('physical_examination')
                                    ->label('Pemeriksaan Fisik / Pengobatan'),

                                TextEntry::make('merokok')
                                    ->label('Merokok'),

                                TextEntry::make('diagnosis')
                                    ->label('Diagnosa'),

                                TextEntry::make('treatment_plan')
                                    ->label('Rencana Perawatan'),

                                TextEntry::make('doctor_notes')
                                    ->label('Pemeriksaan yang Dibutuhkan'),
                            ])
                            ->columns(1),

                        Section::make('Catatan Terapis')
                            ->schema([
                                TextEntry::make('teraphist_notes')
                                    ->label('Catatan untuk Terapis'),
                            ])
                            ->columns(1),
                    ]),



                Action::make('print')
                    ->label('Cetak')
                    ->icon('heroicon-o-printer')
                    ->color('primary')
                    ->url(fn($record) => route('consultation.print', $record->id))
                    ->openUrlInNewTab(),
            ]);
    }
}
