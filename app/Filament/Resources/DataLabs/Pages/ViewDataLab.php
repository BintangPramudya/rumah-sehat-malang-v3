<?php

namespace App\Filament\Resources\DataLabs\Pages;

use App\Filament\Resources\DataLabs\DataLabResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View as ViewComponent;

class ViewDataLab extends ViewRecord
{
    protected static string $resource = DataLabResource::class;

    public function schema(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informasi Pasien')
                ->schema([
                    ViewComponent::make('filament.data-labs.patient-info'),
                ]),

            Section::make('Hasil Pemeriksaan Lab')
                ->description('Dokumentasi hasil lab pasien')
                ->schema([
                    ViewComponent::make('filament.data-labs.images'),
                ]),
        ]);
    }
}
