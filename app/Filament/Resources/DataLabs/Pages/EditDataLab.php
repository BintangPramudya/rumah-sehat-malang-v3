<?php

namespace App\Filament\Resources\DataLabs\Pages;

use App\Filament\Resources\DataLabs\DataLabResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDataLab extends EditRecord
{
    protected static string $resource = DataLabResource::class;

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
