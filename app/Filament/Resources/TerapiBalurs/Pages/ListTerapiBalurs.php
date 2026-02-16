<?php

namespace App\Filament\Resources\TerapiBalurs\Pages;

use App\Filament\Resources\TerapiBalurs\TerapiBalurResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTerapiBalurs extends ListRecords
{
    protected static string $resource = TerapiBalurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Terapi Balur')
                ->icon('heroicon-o-plus'),
        ];
    }
}
