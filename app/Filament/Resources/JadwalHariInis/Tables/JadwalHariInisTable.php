<?php

namespace App\Filament\Resources\JadwalHariInis\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JadwalHariInisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.full_name')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('jenis_layanan')
                    ->label('Layanan')
                    ->badge()
                    ->colors([
                        'primary' => 'Konsultasi',
                        'success' => 'Terapi',
                    ]),

                TextColumn::make('doctor.name')
                    ->label('Dokter')
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('therapist.name')
                    ->label('Terapis')
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal', 'desc')
            ->recordActions([
                EditAction::make(),
                Action::make('konsultasi')
                    ->label('Tambah Konsultasi')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->color('success')
                    ->url(fn($record) => route('filament.rumah-sehat.resources.consultations.create', [
                        'jadwal_id' => $record->id,
                        'patient_id' => $record->patient_id,
                        'doctor_id' => $record->doctor_id,
                    ])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
