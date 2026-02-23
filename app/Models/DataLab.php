<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataLab extends Model
{
    protected $fillable = [
        'patient_id',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
