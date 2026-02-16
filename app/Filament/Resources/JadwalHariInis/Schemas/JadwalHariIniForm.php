<?php

namespace App\Filament\Resources\JadwalHariInis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class JadwalHariIniForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Jadwal Hari Ini')
                    ->columns(2)
                    ->schema([

                        Select::make('patient_id')
                            ->relationship('patient', 'full_name')
                            ->label('Pasien')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->default(now('Asia/Jakarta'))
                            ->required(),
                        Select::make('jenis_layanan')
                            ->label('Jenis Layanan')
                            ->options([
                                'Konsultasi' => 'Konsultasi',
                                'Terapi' => 'Terapi',
                                'Konsultasi & Terapi' => 'Konsultasi & Terapi',
                            ])
                            ->reactive() // PENTING
                            ->required(),

                        Select::make('doctor_id')
                            ->label('Dokter')
                            ->relationship(
                                name: 'doctor',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn($query) =>
                                $query->whereHas('roles', fn($q) => $q->where('name', 'dokter'))
                            )
                            ->visible(
                                fn(Get $get) =>
                                in_array($get('jenis_layanan'), ['Konsultasi', 'Konsultasi & Terapi'])
                            )
                            ->searchable()
                            ->preload(),

                        Select::make('therapist_id')
                            ->label('Terapis')
                            ->relationship(
                                name: 'therapist',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn($query) =>
                                $query->whereHas('roles', fn($q) => $q->where('name', 'terapis'))
                            )
                            ->visible(
                                fn(Get $get) =>
                                in_array($get('jenis_layanan'), ['Terapi', 'Konsultasi & Terapi'])
                            )
                            ->searchable()
                            ->preload(),

                    ]),

            ]);
    }
}
