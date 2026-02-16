<?php

namespace App\Filament\Resources\TerapiBalurs\Pages;

use App\Filament\Resources\TerapiBalurs\TerapiBalurResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTerapiBalur extends EditRecord
{
    protected static string $resource = TerapiBalurResource::class;

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
