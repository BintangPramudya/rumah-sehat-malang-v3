<?php

namespace App\Models;

use App\Models\TerapiBalur;
use App\Models\Consultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    protected $fillable = [

        'medical_record_number',
        'full_name',
        'image',
        'gender',
        'birth_date',
        'phone',
        'address',
        'occupation',
        'national_id_number',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function jadwalHariInis()
    {
        return $this->hasMany(JadwalHariIni::class);
    }
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function terapiBalurs()
    {
        return $this->hasMany(TerapiBalur::class);
    }

    public function dataLabs()
    {
        return $this->hasMany(\App\Models\DataLab::class);
    }


    use SoftDeletes;


    protected static function booted()
    {
        static::creating(function ($patient) {

            $today = now();

            $year  = $today->year;
            $month = self::romanMonth($today->month);
            $day   = $today->format('d');

            // Ambil nomor terbesar dari SEMUA data aktif
            $lastNumber = self::selectRaw("MAX(CAST(RIGHT(medical_record_number,4) AS UNSIGNED)) as max_number")
                ->value('max_number');

            $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

            $urut = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            $patient->medical_record_number = "{$year}/{$month}/{$day}/{$urut}";
        });
    }

    private static function romanMonth(int $month): string
    {
        return [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ][$month];
    }
}
