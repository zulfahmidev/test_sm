<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    public $fillable = [
        'vehicle_id', 'maintenance_at', 'cost', 'note'
    ];

    public function getVehicle() {
        return Vehicle::find($this->vehicle_id);
    }
}
