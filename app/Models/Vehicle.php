<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public $fillable = [
        'plat', 'capacity', 'transport_type', 'ownership_status', 'condition'
    ];

    public function getNextService() {
        $service = ServiceSchedule::where('vehicle_id', $this->id)->latest('created_at')->first();
        return ($service) ? $service->next_service_at : null;
    }

    public function getLastService() {
        $service = ServiceSchedule::where('vehicle_id', $this->id)->latest('created_at')->first();
        return ($service) ? $service->last_service_at : null;
    }

    public function getFuelConsumedPerMonth($month = 1, $year = 1970) {
        return VehicleReturn::where('vehicle_id', $this->id)
        ->whereMonth('return_at', $month)
        ->whereYear('return_at', $year)
        ->sum('fuel_consumed');
    }

    public function getDistanceTraveledPerMonth($month = 1, $year = 1970) {
        return VehicleReturn::where('vehicle_id', $this->id)
        ->whereMonth('return_at', $month)
        ->whereYear('return_at', $year)
        ->sum('distance_traveled');
    }

    public function getServiceSchedules() {
        return ServiceSchedule::where('vehicle_id', $this->id)->get();
    }

    public function getMaintenances() {
        return Maintenance::where('vehicle_id', $this->id)->get();
    }

    public function getReturnReports() {
        return VehicleReturn::where('vehicle_id', $this->id)->get();
    }
}
