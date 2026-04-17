<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientResponsable extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'user_id',
        'role'
    ];
    
    public function  patient(){
        return $this->BelongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
