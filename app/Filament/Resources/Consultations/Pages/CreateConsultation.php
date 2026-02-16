<?php

namespace App\Filament\Resources\Consultations\Pages;

use App\Filament\Resources\Consultations\ConsultationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConsultation extends CreateRecord
{
    protected static string $resource = ConsultationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $jadwalId = $this->data['jadwal_id'] ?? null;

        if ($jadwalId) {
            \App\Models\JadwalHariIni::where('id', $jadwalId)->delete();
        }
    }
}
