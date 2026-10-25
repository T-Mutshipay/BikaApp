<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'capacite',
        'disponibilite',
    ];

    protected function casts(): array
    {
        return [
            'capacite' => 'integer',
            'disponibilite' => 'boolean',
        ];
    }

    public function hospitalisations(): HasMany
    {
        return $this->hasMany(Hospitalisation::class);
    }

    /** Nombre de patients actuellement dans la chambre. */
    public function occupation(?int $exceptHospitalisationId = null): int
    {
        return $this->hospitalisations()
            ->active()
            ->when($exceptHospitalisationId, fn ($q) => $q->where('id', '!=', $exceptHospitalisationId))
            ->count();
    }

    /** Recalcule la disponibilité à partir de l'occupation réelle. */
    public function refreshDisponibilite(): void
    {
        $this->update(['disponibilite' => $this->occupation() < $this->capacite]);
    }
}
