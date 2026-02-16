<?php

namespace App\Filament\Resources\DataLabs\Pages;

use App\Filament\Resources\DataLabs\DataLabResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDataLabs extends ListRecords
{
    protected static string $resource = DataLabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Data Lab')
                ->icon('heroicon-o-plus'),
        ];
    }
}
