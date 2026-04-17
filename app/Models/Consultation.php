<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'patient_id',
        'user_id',
        'motif_consultation',
        'poids',
        'taille',
        'temperature',
        'tension',
        'pouls',
        'diagnostic',
        'date_consultation',
        'heure_consultation',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
