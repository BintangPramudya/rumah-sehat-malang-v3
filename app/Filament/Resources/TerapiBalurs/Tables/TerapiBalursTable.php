<?php

namespace App\Filament\Resources\TerapiBalurs\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class TerapiBalursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('patient.full_name')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),



                Tables\Columns\TextColumn::make('therapy_datetime')
                    ->label('Tanggal Terapi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sesi_ke')
                    ->label('Sesi')
                    ->getStateUsing(function ($record) {
                        return \App\Models\TerapiBalur::where('patient_id', $record->patient_id)
                            ->where('therapy_datetime', '<=', $record->therapy_datetime)
                            ->count();
                    })
                    ->badge()
                    ->color(function ($record) {

                        $latest = \App\Models\TerapiBalur::where('patient_id', $record->patient_id)
                            ->latest('therapy_datetime')
                            ->first();

                        return $latest && $latest->id === $record->id
                            ? 'success'   // sesi terakhir hijau
                            : 'gray';     // sesi lama abu
                    })
                    ->formatStateUsing(fn($state) => 'Ke-' . $state),



                Tables\Columns\TextColumn::make('rokok')
                    ->label('Rokok yang Digunakan')
                    ->toggleable(),

                ImageColumn::make('image_tembaga')
                    ->label('Dokumentasi Terapi')
                    ->height(50)
                    ->circular(),

                ImageColumn::make('image_patient')
                    ->label('Foto Kondisi Pasien')
                    ->height(50)
                    ->circular(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Terapis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('therapy_datetime', 'desc')
            ->recordActions([
                EditAction::make(),

                Action::make('tambah_terapi')
                    ->label(fn($record) => 'Lanjut sesi Terapi berikutnya ')
                    ->icon('heroicon-o-plus')
                    ->color('success')
                    ->visible(function ($record) {

                        $latest = \App\Models\TerapiBalur::where('patient_id', $record->patient_id)
                            ->latest('therapy_datetime')
                            ->first();

                        return $latest && $latest->id === $record->id;
                    })
                    ->url(
                        fn($record) =>
                        \App\Filament\Resources\TerapiBalurs\TerapiBalurResource::getUrl('create', [
                            'patient_id' => $record->patient_id,
                        ])
                    ),

            ])


            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
