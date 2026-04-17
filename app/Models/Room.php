<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'capacite',
        'disponibilite'
    ];
    public function hospitalisation(){
        return $this->hasMany(Hospitalisation::class);
    }
}
