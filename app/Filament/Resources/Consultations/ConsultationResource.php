<?php

namespace App\Filament\Resources\Consultations;

use App\Filament\Resources\Consultations\Pages\CreateConsultation;
use App\Filament\Resources\Consultations\Pages\EditConsultation;
use App\Filament\Resources\Consultations\Pages\ListConsultations;
use App\Filament\Resources\Consultations\Schemas\ConsultationForm;
use App\Filament\Resources\Consultations\Tables\ConsultationsTable;
use App\Models\Consultation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;




class ConsultationResource extends Resource
{

    protected static ?string $model = Consultation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocument;

    protected static ?string $recordTitleAttribute = 'Consultation';

    public static function form(Schema $schema): Schema
    {
        return ConsultationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConsultationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConsultations::route('/'),
            'create' => CreateConsultation::route('/create'),
            'edit' => EditConsultation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Konsultasi';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Medical Records';
    }

    public static function getNavigationSort(): ?int
    {
        return 30;
    }

    public static function getModelLabel(): string
    {
        return 'Konsultasi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Rekam Medis Konsultasi';
    }
}
