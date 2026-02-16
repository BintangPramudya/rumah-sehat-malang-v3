<?php

namespace App\Filament\Resources\DataLabs;

use App\Filament\Resources\DataLabs\Pages\CreateDataLab;
use App\Filament\Resources\DataLabs\Pages\EditDataLab;
use App\Filament\Resources\DataLabs\Pages\ListDataLabs;
use App\Filament\Resources\DataLabs\Schemas\DataLabForm;
use App\Filament\Resources\DataLabs\Tables\DataLabsTable;
use App\Models\DataLab;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DataLabResource extends Resource
{
    protected static ?string $model = DataLab::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Beaker;

    protected static ?string $recordTitleAttribute = 'DataLab';

    public static function form(Schema $schema): Schema
    {
        return DataLabForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataLabsTable::configure($table);
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
            'index' => ListDataLabs::route('/'),
            'create' => CreateDataLab::route('/create'),
            'edit' => EditDataLab::route('/{record}/edit'),
            'view' => Pages\ViewDataLab::route('/{record}'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Lab';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Medical Records';
    }

    public static function getNavigationSort(): ?int
    {
        return 45;
    }

    public static function getModelLabel(): string
    {
        return 'Data Lab';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Lab';
    }
}
