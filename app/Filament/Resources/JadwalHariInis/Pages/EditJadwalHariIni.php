<?php

namespace App\Filament\Resources\JadwalHariInis\Pages;

use App\Filament\Resources\JadwalHariInis\JadwalHariIniResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJadwalHariIni extends EditRecord
{
    protected static string $resource = JadwalHariIniResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
