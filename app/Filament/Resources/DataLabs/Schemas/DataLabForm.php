<?php

namespace App\Filament\Resources\DataLabs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DataLabForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Upload Data Lab')
                    ->description('Upload satu atau lebih gambar hasil lab')
                    ->schema([
                        Select::make('patient_id')
                            ->relationship('patient', 'full_name')
                            ->label('Pasien'),
                        FileUpload::make('images')
                            ->label('Gambar Hasil Lab')
                            ->image()
                            ->multiple()          // 🔥 bisa banyak
                            ->reorderable()       // drag urutan
                            ->required()
                            ->directory('data-lab')
                            ->imagePreviewHeight('200')
                            ->panelLayout('grid')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
