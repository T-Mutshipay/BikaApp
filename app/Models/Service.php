<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'departement_id'
    ];

    public function departement(){
        return $this->BelongsTo(Departement::class);
    }
    public function hospitalisation(){
        return $this->hasMany(Hospitalisation::class);
    }
}
