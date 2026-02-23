<?php

namespace App\Filament\Resources\JadwalHariInis\Pages;

use App\Filament\Resources\JadwalHariInis\JadwalHariIniResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwalHariIni extends CreateRecord
{
    protected static string $resource = JadwalHariIniResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
