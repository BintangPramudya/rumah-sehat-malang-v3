<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'therapist_id',
        'chief_complaint',
        'current_illness_history',
        'past_medical_history',
        'physical_examination',
        'merokok',
	'merokok',
        'diagnosis',
        'treatment_plan',
        'doctor_notes',
        'consultation_datetime',
        'teraphist_notes',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'consultation_datetime' => 'datetime',
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

    public function terapiBalurs()
    {
        return $this->hasMany(TerapiBalur::class);
    }

    
}
