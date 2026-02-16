<?php

namespace App\Filament\Resources\JadwalHariInis;

use App\Filament\Resources\JadwalHariInis\Pages\CreateJadwalHariIni;
use App\Filament\Resources\JadwalHariInis\Pages\EditJadwalHariIni;
use App\Filament\Resources\JadwalHariInis\Pages\ListJadwalHariInis;
use App\Filament\Resources\JadwalHariInis\Schemas\JadwalHariIniForm;
use App\Filament\Resources\JadwalHariInis\Tables\JadwalHariInisTable;
use App\Models\JadwalHariIni;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JadwalHariIniResource extends Resource
{
    protected static ?string $model = JadwalHariIni::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static ?string $recordTitleAttribute = 'JadwalHariIni';

    public static function form(Schema $schema): Schema
    {
        return JadwalHariIniForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalHariInisTable::configure($table);
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
            'index' => ListJadwalHariInis::route('/'),
            'create' => CreateJadwalHariIni::route('/create'),
            'edit' => EditJadwalHariIni::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Jadwal Hari Ini';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Front Office';
    }

    public static function getNavigationSort(): ?int
    {
        return 20;
    }

    public static function getModelLabel(): string
    {
        return 'Jadwal Hari Ini';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Jadwal Hari Ini';
    }
}
