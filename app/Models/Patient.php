<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'email',
    ];

    protected function casts(): array
    {
        return [
            'date_naissance' => 'date:Y-m-d',
        ];
    }

    public function examens(): HasMany
    {
        return $this->hasMany(Examen::class);
    }

    public function hospitalisations(): HasMany
    {
        return $this->hasMany(Hospitalisation::class);
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function facturations(): HasMany
    {
        return $this->hasMany(Facturation::class);
    }
}
