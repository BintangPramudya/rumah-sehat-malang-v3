<?php

namespace App\Filament\Resources\TerapiBalurs\Pages;

use App\Filament\Resources\TerapiBalurs\TerapiBalurResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTerapiBalur extends CreateRecord
{
    protected static string $resource = TerapiBalurResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
