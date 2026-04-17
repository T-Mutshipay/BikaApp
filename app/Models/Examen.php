<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'type',
        'result',
        'date',
        'patient_responsable_id'
    ];
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function patientResponsable(){
        return $this->belongsTo(PatientResponsable::class);
    }
}
