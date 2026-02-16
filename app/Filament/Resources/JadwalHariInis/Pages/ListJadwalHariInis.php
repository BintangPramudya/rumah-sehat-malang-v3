<?php

namespace App\Filament\Resources\JadwalHariInis\Pages;

use App\Filament\Resources\JadwalHariInis\JadwalHariIniResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJadwalHariInis extends ListRecords
{
    protected static string $resource = JadwalHariIniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Jadwal')
                ->icon('heroicon-o-plus'),
        ];
    }
}
