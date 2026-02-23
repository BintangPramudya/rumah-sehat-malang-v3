<?php

namespace App\Filament\Resources\Patients\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Image;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([
                ImageColumn::make('image')
                    ->label('Foto Pasien')
                    ->circular()
                    ->size(50),
                TextColumn::make('medical_record_number')
                    ->label('No. Rekam Medis')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->searchable(query: function ($query, string $search) {
                        $query->where('full_name', 'like', "%{$search}%")
                            ->orWhere('medical_record_number', 'like', "%{$search}%")
                            ->orWhereHas('consultations', function ($q) use ($search) {
                                $q->where('diagnosis', 'like', "%{$search}%");
                            });
                    })
                    ->sortable(),

                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->colors([
                        'primary' => 'Laki-laki',
                        'danger' => 'Perempuan',
                    ]),

		TextColumn::make('therapist_name')
    ->label('Terapis')
    ->getStateUsing(function ($record) {
        $consultation = $record->consultations()
            ->latest()
            ->first();

        return $consultation?->therapist?->name ?? 'Belum Ditentukan';
    })
    ->badge()
    ->color(function ($state) {
        if ($state === 'Belum Ditentukan') {
            return 'gray';
        }

        return 'warning'; 
    }),

                TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('national_id_number')
                    ->label('NIK')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                // bisa ditambah filter gender, tanggal, dll
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make()
                    ->label('View')
                    ->icon('heroicon-o-eye'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
