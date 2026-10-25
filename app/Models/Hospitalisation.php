<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hospitalisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'service_id',
        'room_id',
        'date_admission',
        'date_sortie',
    ];

    protected function casts(): array
    {
        return [
            'date_admission' => 'date:Y-m-d',
            'date_sortie' => 'date:Y-m-d',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Hospitalisations en cours : pas de date de sortie, ou sortie prévue
     * aujourd'hui ou plus tard.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $q->whereNull('date_sortie')->orWhereDate('date_sortie', '>=', today());
        });
    }
}
