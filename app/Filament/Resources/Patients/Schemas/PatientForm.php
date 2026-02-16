<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Data Pasien')
                    ->columns(2)
                    ->schema([

                        // TextInput::make('medical_record_number')
                        //     ->label('No. Rekam Medis')
                        //     ->disabled()              // user tidak bisa edit
                        //     ->dehydrated(false)       // jangan ikut dikirim ke request
                        //     ->placeholder('Otomatis dibuat sistem'),

                        TextInput::make('national_id_number')
                            ->label('NIK')
                            ->numeric()
                            ->maxLength(16),

                        TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required(),

                        Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),

                        DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->required(),

                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel(),

                        TextInput::make('occupation')
                            ->label('Pekerjaan'),

                        FileUpload::make('image')
                            ->label('Foto Pasien')
                            ->image()
                            ->directory('patients')
                            ->imagePreviewHeight('150')
                            ->columnSpanFull(),

                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
