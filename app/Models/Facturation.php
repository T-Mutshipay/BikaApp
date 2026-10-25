<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'hospitalisation_id', 
        'consultation_id', 
        'examen_id', 
        'montant_total', 
        'statut'
    ];

    public const STATUT_EN_ATTENTE = 'En attente';
    public const STATUT_PAYEE = 'Payée';
    public const STATUT_ANNULEE = 'Annulée';

    public const STATUTS = [
        self::STATUT_EN_ATTENTE,
        self::STATUT_PAYEE,
        self::STATUT_ANNULEE,
    ];

    protected function casts(): array
    {
        return [
            'montant_total' => 'decimal:2',
        ];
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function hospitalisation()
    {
        return $this->belongsTo(Hospitalisation::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
