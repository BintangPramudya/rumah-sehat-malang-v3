<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalHariIni extends Model
{
    protected $fillable = [
        'patient_id',
        'tanggal',
        'jenis_layanan',
        'doctor_id',
        'therapist_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }

    

    
}
