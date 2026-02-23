<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerapiBalur extends Model
{
    protected $fillable = [
        'patient_id',
        'user_id',
        'therapy_datetime',
        'tensi',
        'pre_complaint',
        'post_complaint',
        'consultation_id',
        'rokok',
        'enema',
        'minum',
        'therapist_notes',
        'image_tembaga',
        'image_patient',
    ];

    protected $casts = [
        'rokok' => 'array',
        'enema' => 'array',
        'minum' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }


    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
