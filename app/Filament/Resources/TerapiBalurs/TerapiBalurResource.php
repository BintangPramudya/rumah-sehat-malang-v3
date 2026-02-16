<?php

namespace App\Filament\Resources\TerapiBalurs;

use App\Filament\Resources\TerapiBalurs\Pages\CreateTerapiBalur;
use App\Filament\Resources\TerapiBalurs\Pages\EditTerapiBalur;
use App\Filament\Resources\TerapiBalurs\Pages\ListTerapiBalurs;
use App\Filament\Resources\TerapiBalurs\Schemas\TerapiBalurForm;
use App\Filament\Resources\TerapiBalurs\Tables\TerapiBalursTable;
use App\Models\TerapiBalur;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TerapiBalurResource extends Resource
{
    protected static ?string $model = TerapiBalur::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Heart;

    protected static ?string $recordTitleAttribute = 'TerapiBalur';

    public static function form(Schema $schema): Schema
    {
        return TerapiBalurForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TerapiBalursTable::configure($table);
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
            'index' => ListTerapiBalurs::route('/'),
            'create' => CreateTerapiBalur::route('/create'),
            'view' => Pages\ViewTerapiBalur::route('/{record}'),
            'edit' => EditTerapiBalur::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return 'Terapi Balur';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Medical Records';
    }

    public static function getNavigationSort(): ?int
    {
        return 40;
    }

    public static function getModelLabel(): string
    {
        return 'Terapi Balur';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sesi Terapi Balur';
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Kalau bukan Admin, filter berdasarkan user_id
        if (! auth()->user()->hasRole('Admin')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }



    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
