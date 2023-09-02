<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index(Request $request) {
        $approvals = Approval::where(function($query) use ($request) {
            if ($search = $request->search) {
                $query->orWhere('bookings.customer_name', 'LIKE', "%$search%");
                $query->orWhere('drivers.fullname', 'LIKE', "%$search%");
                $query->orWhere('vehicles.plat', 'LIKE', "%$search%");
            }
        })
        ->join('bookings', 'bookings.id', '=', 'approvals.booking_id')
        ->join('drivers', 'drivers.id', '=', 'bookings.driver_id')
        ->join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
        ->selectRaw('approvals.id, approvals.status, bookings.customer_name, vehicles.plat, drivers.fullname as driver_name, bookings.usage_at, bookings.estimated_duration, approvals.created_at, approvals.updated_at')
        ->where('user_id', auth()->user()->id)
        ->latest()->paginate(10);

        return view('approval.index', compact('approvals'));
    }

    public function show(Approval $approval) {
        $booking = Booking::find($approval->booking_id);
        return view('approval.show', compact('approval', 'booking'));
    }

    public function update(Request $request, Approval $approval) {
        $request->validate([
            'status' => 'required|in:panding,approved,rejected'
        ]);
        $approval->update($request->only('status'));
        return redirect()->back();
    }
}
