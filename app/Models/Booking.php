<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public $fillable = [
        'customer_name', 'vehicle_id', 'driver_id', 'usage_at', 'estimated_duration', 'note'
    ];

    public function getVehicle() {
        return Vehicle::find($this->vehicle_id);
    }

    public function getDriver() {
        return Driver::find($this->driver_id);
    }

    public function getApprovers() {
        $approver_ids = Approval::where('booking_id', $this->id)->pluck('user_id');
        return User::whereIn('id', $approver_ids)->get();
    }

    public function getApproval() {
        return Approval::where('booking_id', $this->id)->get();
    }

    public function getStatus() {
        $status = 'panding';
        $approveds = 0;
        $rejecteds = 0;
        $pandings = 0;
        $approvals = Approval::where('booking_id', $this->id)->get();
        foreach ($approvals as $approval) {
            if ($approval->status == 'approved') $approveds++;
            if ($approval->status == 'rejected') $rejecteds++;
            if ($approval->status == 'panding') $pandings++;
        }
        if ($approveds == $approvals->count()) $status = 'approved';
        elseif ($rejecteds == $approvals->count()) $status = 'rejected';
        elseif ($pandings == $approvals->count()) $status = 'panding';
        elseif ($pandings == 0) $status = 'rejected';
        return $status;
    }
}
