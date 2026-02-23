<?php

namespace App\Filament\Resources\Patients;


use App\Filament\Resources\Patients\Pages\CreatePatient;
use App\Filament\Resources\Patients\Pages\EditPatient;
use App\Filament\Resources\Patients\Pages\ListPatients;
use App\Filament\Resources\Patients\Pages\ViewPatient;
use App\Filament\Resources\Patients\RelationManagers\ConsultationsRelationManager;
use App\Filament\Resources\Patients\RelationManagers\DataLabsRelationManager;
use App\Filament\Resources\Patients\RelationManagers\TerapiBalursRelationManager;
use App\Filament\Resources\Patients\Schemas\PatientForm;
use App\Filament\Resources\Patients\Tables\PatientsTable;
use App\Models\Patient;
use BackedEnum;
use Dflydev\DotAccessData\Data;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserPlus;

    protected static ?string $recordTitleAttribute = 'Patient';

    public static function form(Schema $schema): Schema
    {
        return PatientForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PatientsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ConsultationsRelationManager::class,
            TerapiBalursRelationManager::class,
            DataLabsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPatients::route('/'),
            'create' => CreatePatient::route('/create'),
            'view' => ViewPatient::route('/{record}'),
            'edit' => EditPatient::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Pasien';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function getModelLabel(): string
    {
        return 'Pasien';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Pasien';
    }

    
public static function getEloquentQuery(): Builder
{
    $query = parent::getEloquentQuery();

    if ($search = request()->input('tableSearch')) {
        $query->where(function ($q) use ($search) {
            $q->where('full_name', 'like', "%{$search}%")
              ->orWhere('medical_record_number', 'like', "%{$search}%")
              ->orWhereHas('consultations', function ($sub) use ($search) {
                  $sub->where('diagnosis', 'like', "%{$search}%");
              });
        });
    }

    return $query;
}
}
