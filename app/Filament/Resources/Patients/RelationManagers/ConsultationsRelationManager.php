<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Image;
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

            ->actions([
            Action::make('print')
                ->label('Cetak')
                ->icon('heroicon-o-printer')
                ->color('primary')
                ->url(fn ($record) => route('consultation.print', $record->id))
                ->openUrlInNewTab(),
        ]);
    }
}
