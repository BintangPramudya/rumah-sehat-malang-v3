<?php

namespace App\Filament\Resources\TerapiBalurs\Schemas;

use App\Models\Consultation;
use App\Models\Patient;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Auth;

class TerapiBalurForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                /* =========================
                 * DATA PASIEN
                 * ========================= */
                Section::make('Data Pasien')
                    ->columns(2)
                    ->schema([
                        Select::make('patient_id')
                            ->label('Pasien')
                            ->options(function ($get) {

                                $query = \App\Models\Patient::whereHas('consultations', function ($q) {
                                    $q->where('therapist_id', Auth::id());
                                });

                                // Kalau belum ada nilai patient_id (create normal)
                                if (! $get('patient_id')) {
                                    $query->whereDoesntHave('terapiBalurs');
                                }

                                return $query->pluck('full_name', 'id');
                            })
                            ->default(fn() => request()->get('patient_id'))
                            ->disabled(fn() => request()->has('patient_id'))
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {

                                $consultation = Consultation::where('patient_id', $state)
                                    ->latest('consultation_datetime')
                                    ->first();

                                $set('consultation_id', $consultation?->id);
                                $set('doctor_treatment_plan_preview', $consultation?->treatment_plan);
                                $set('teraphist_notes_preview', $consultation?->teraphist_notes);
                            }),





                        DateTimePicker::make('therapy_datetime')
                            ->label('Tanggal & Waktu Terapi')
                            ->default(now('Asia/Jakarta'))
                            ->displayFormat('d M Y H:i')
                            ->seconds(false)
                            ->required(),
                    ]),

                /* =========================
                 * KONDISI PASIEN
                 * ========================= */
                Section::make('Kondisi Pasien')
                    ->schema([
                        TextInput::make('tensi')
                            ->label('Tensi')
                            ->placeholder('Contoh: 120/80 mmHg')
                            ->columnSpanFull(),
                        Textarea::make('pre_complaint')
                            ->label('Keluhan Sebelum Terapi')
                            ->columnSpanFull(),

                        Textarea::make('post_complaint')
                            ->label('Keluhan Setelah Terapi')
                            ->columnSpanFull(),


                    ]),
                Hidden::make('doctor_treatment_plan_preview'),
                Hidden::make('teraphist_notes_preview'),
                Section::make('Catatan dari Dokter')
                    ->description('Diisi oleh dokter sebelum terapi dilakukan')
                    ->schema([
                        Textarea::make('doctor_treatment_plan_preview')
                            ->label('Rencana Perawatan Dokter')
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),

                        Textarea::make('teraphist_notes_preview')
                            ->label('Catatan Dokter')
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ])
                    ->visible(fn($get) => filled($get('consultation_id'))),




                /* =========================
                 * TERAPI TAMBAHAN
                 * ========================= */
                Section::make('Terapi')
                    ->description('Pilih terapi yang diberikan')
                    ->columns(2)
                    ->schema([

                        CheckboxList::make('rokok')
                            ->label('Rokok yang Digunakan')
                            ->options(
                                collect(range(1, 45))
                                    ->mapWithKeys(fn($i) => [$i => (string) $i])
                                    ->toArray()
                            )
                            ->columns(5),

                        CheckboxList::make('enema')
                            ->label('Enema')
                            ->options([
                                'AM' => 'AM',
                                'KOPI 1' => 'KOPI 1',
                                'KOPI 2' => 'KOPI 2',
                                'EDTA' => 'EDTA',
                                'PC' => 'PC',
                                'JAMBU' => 'JAMBU',
                                'WORTEL' => 'WORTEL',
                                'TOMAT' => 'TOMAT',
                                'DMSO' => 'DMSO',
                                'CASAVA' => 'CASAVA',
                            ])
                            ->columns(2)
                            ->searchable(),

                        CheckboxList::make('minum')
                            ->label('Minum')
                            ->options([
                                'AM' => 'AM',
                                'AP' => 'AP',
                                'B6' => 'B6',
                                'CCM' => 'CCM',
                                'AY' => 'AY',
                                'AGN' => 'AGN',
                                'HD' => 'HD',
                                'PL' => 'PL',
                                'GLY' => 'GLY',
                                'TAU' => 'TAU',
                                'VCO' => 'VCO',
                                'MUCOSA' => 'MUCOSA',
                                'MN' => 'MN',
                                'KOPI 1' => 'KOPI 1',
                                'KOPI 2' => 'KOPI 2',
                                'KOPI 1 putih' => 'KOPI 1 putih',
                                'KOPI 1 kuning' => 'KOPI 1 kuning',
                                'KOPI 2 putih' => 'KOPI 2 putih',
                                'KOPI 2 kuning' => 'KOPI 2 kuning',
                            ])
                            ->columns(2)
                            ->searchable(),

                        Textarea::make('therapist_notes')
                            ->label('Catatan Terapis')
                            ->columnSpanFull(),

                        Textarea::make('keterangan_terapi')
                            ->label('Keterangan Terapi')
                            ->columnSpanFull(),
                    ]),

                /* =========================
                 * DOKUMENTASI
                 * ========================= */
                Section::make('Dokumentasi Terapi')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image_tembaga')
                            ->label('Foto Tembaga')
                            ->image()
                            ->disk('public')
                            ->directory('terapi/tembaga')
                            ->visibility('public')
                            ->maxSize(10240),

                        FileUpload::make('image_patient')
                            ->label('Foto Kondisi Pasien')
                            ->image()
                            ->disk('public')
                            ->directory('terapi/pasien')
                            ->visibility('public')
                            ->maxSize(10240),

                       FileUpload::make('image_tembaga')
->label('Foto Tembaga')
    ->image()
    ->disk('public')
    ->directory('terapi/tembaga')
    ->visibility('public')
    ,

FileUpload::make('image_patient')
    ->label('Foto Kondisi Pasien')
    ->image()
    ->disk('public')
    ->directory('terapi/pasien')
    ->visibility('public')
    ,

                    ]),
            ]);
    }
}
