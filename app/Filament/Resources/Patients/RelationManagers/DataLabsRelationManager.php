<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Dompdf\FrameDecorator\Image;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class DataLabsRelationManager extends RelationManager
{
    protected static string $relationship = 'dataLabs';

    protected static ?string $title = 'Data Lab';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.full_name')
                    ->label('Pasien'),
                ImageColumn::make('images')
                    ->label('Hasil Lab'),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])

            ->recordActions([
                ViewAction::make()
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->infolist([
                        Section::make('Data Lab')
                            ->schema([
                                TextEntry::make('patient.full_name')
                                    ->label('Nama Pasien'),
                                ImageEntry::make('images')
                                    ->label('Hasil Lab'),

                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y H:i'),
                            ]),
                    ]),
            ]);
    }
}
