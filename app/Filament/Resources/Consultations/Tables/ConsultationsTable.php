<?php

namespace App\Filament\Resources\Consultations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;

class ConsultationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('patient.full_name')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('doctor.name')
                    ->label('Dokter')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('consultation_datetime')
                    ->label('Tanggal Konsultasi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('diagnosis')
                    ->label('Diagnosis')
                    ->limit(40)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('therapist_status')
                    ->label('Terapis')
                    ->badge()
                    ->state(function ($record) {
                        return $record->therapist
                            ? $record->therapist->name
                            : 'Belum Ada Terapis';
                    })
                    ->color(function ($record) {
                        return $record->therapist
                            ? 'success'
                            : 'danger';
                    })
                    ->icon(function ($record) {
                        return $record->therapist
                            ? 'heroicon-o-check-circle'
                            : 'heroicon-o-x-circle';
                    }),
            ])
            ->defaultSort('consultation_datetime', 'desc')
            ->filters([
                // bisa ditambahkan filter tanggal / dokter
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
