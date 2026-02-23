<?php

namespace App\Filament\Resources\DataLabs\Pages;

use App\Filament\Resources\DataLabs\DataLabResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDataLab extends CreateRecord
{
    protected static string $resource = DataLabResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
