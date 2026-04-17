<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitalisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'service_id',
        'room_id',
        'date_admission',
        'date_sorite'
    ];
    public function patient(){
        return $this->belongsTo(patient::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
