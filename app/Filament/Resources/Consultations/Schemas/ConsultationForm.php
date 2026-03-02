<?php

namespace App\Filament\Resources\Consultations\Schemas;

use Dom\Text;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConsultationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Data Konsultasi')
                    ->columns(2)
                    ->schema([
                        Hidden::make('jadwal_id')
                            ->default(fn() => request()->get('jadwal_id'))
                            ->dehydrated(),
                        Select::make('patient_id')
                            ->relationship('patient', 'full_name')
                            ->default(fn() => request()->get('patient_id'))
                            ->disabled()
                            ->dehydrated(true), // ← PENTING

                        Select::make('doctor_id')
                            ->relationship('doctor', 'name')
                            ->default(fn() => request()->get('doctor_id'))
                            ->disabled()
                            ->dehydrated(true),

                        DateTimePicker::make('consultation_datetime')
                            ->label('Tanggal & Waktu Konsultasi')
                            ->default(now('Asia/Jakarta'))
                            ->displayFormat('d M Y H:i')
                            ->seconds(false)
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('chief_complaint')
                            ->label('Keluhan Utama')
                            ->columnSpanFull(),
                        Textarea::make('current_illness_history')
                            ->label('Sakit yang dirasakan Sekarang')
                            ->columnSpanFull(),
                        Textarea::make('past_medical_history')
                            ->label('Riwayat Penyakit Sebelumnya')
                            ->columnSpanFull(),
                        Textarea::make('physical_examination')
                            ->label('Pemeriksaan Fisik/Pengobatan')
                            ->columnSpanFull(),
                        TextInput::make('merokok')
                            ->label('Merokok (Iya/Tidak)')
                            ->columnSpanFull(),
                        Textarea::make('diagnosis')
                            ->label('Diagnosa')
                            ->columnSpanFull(),
                        Textarea::make('treatment_plan')
                            ->label('Rencana Perawatan')
                            ->columnSpanFull(),
                        Textarea::make('doctor_notes')
                            ->label('Pemeriksaan yang Dibutuhkan')
                            ->columnSpanFull(),
                        Select::make('therapist_id')
                            ->relationship(
                                name: 'therapist',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn($query) =>
                                $query->whereHas('roles', fn($q) => $q->where('name', 'terapis'))
                            )
                            ->label('Terapis')
                            ->preload()
                            ->searchable()
                            ->dehydrated(true)
                            ->columnSpanFull(),
                        Textarea::make('teraphist_notes')
                            ->label('Catatan untuk Terapis')
                            ->columnSpanFull(),
                        Textarea::make('informasi_ruumah_sehat_LPPRB')
                            ->label('Informasi Rumah Sehat LPPRB')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
