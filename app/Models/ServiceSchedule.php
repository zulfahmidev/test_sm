<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    use HasFactory;

    public $fillable = [
        'vehicle_id', 'last_service_at', 'next_service_at', 'cost', 'note'
    ];

    public function getVehicle() {
        return Vehicle::find($this->vehicle_id);
    }
}
