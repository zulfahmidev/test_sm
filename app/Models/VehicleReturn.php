<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleReturn extends Model
{
    use HasFactory;

    public $fillable = [
        'booking_id', 'return_at', 'fuel_consumed', 'distance_traveled', 'note'
    ];

    public function getBooking() {
        return Booking::find($this->booking_id);
    }
}
