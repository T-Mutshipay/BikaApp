<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'genre',
        'adresse',
        'telephone',
        'email'
    ];
    public function examens(){
        return $this->hasMany(Examen::class);
    }
    public function hospitalisations(){
        return $this->hasMany(Hospitalisation::class);
    }
    public function consultation(){
        return $this->hasMany(Consultation::class);
    }
}
