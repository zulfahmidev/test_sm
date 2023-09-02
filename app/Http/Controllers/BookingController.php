<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function index(Request $request) {
        $bookings = Booking::where(function($query) use ($request) {
            if ($search = $request->search) {
                $query->orWhere('customer_name', 'LIKE', "%$search%");
                $query->orWhere('drivers.fullname', 'LIKE', "%$search%");
                $query->orWhere('vehicles.plat', 'LIKE', "%$search%");
            }
        })
        ->join('drivers', 'drivers.id', '=', 'bookings.driver_id')
        ->join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
        ->selectRaw('bookings.id, bookings.customer_name, bookings.vehicle_id, bookings.driver_id, bookings.usage_at, bookings.created_at, bookings.estimated_duration, bookings.updated_at')
        ->latest()->paginate(10);

        return view('booking.index', compact('bookings'));
    }

    public function show(Booking $booking) {

        return view('booking.show', compact('booking'));
    }

    public function create() {
        return view('booking.create');
    }

    public function getDrivers(Request $request) {
        $drivers = Driver::where(function($query) use ($request) {
            if ($name = $request->name) {
                $query->orWhere('fullname', 'LIKE', "%$name%");
            }
        })
        ->where('availability_status', 'yes')
        ->latest()->get()->take(3);
        return response()->json($drivers);
    }

    public function getVehicles(Request $request) {
        $vehicles = Vehicle::where(function($query) use ($request) {
            if ($plat = $request->plat) {
                $query->orWhere('plat', 'LIKE', "%$plat%");
            }
        })
        ->latest()->get()->take(3);
        return response()->json($vehicles);
    }

    public function getApprovers(Request $request) {
        $approvers = User::where(function($query) use ($request) {
            if ($name = $request->name) {
                $query->orWhere('username', 'LIKE', "%$name%");
            }
        })
        ->where('role', 'approver')
        ->latest()->get()->take(3);
        return response()->json($approvers);
    }

    public function getApproversByBookingId($booking_id) {
        $approvers = Booking::find($booking_id)->getApprovers();
        return response()->json($approvers);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'customer_name' => 'required|string',
            'usage_at' => 'required|date_format:Y-m-d\TH:i',
            'estimated_duration' => 'required|numeric',
            'note' => 'required|string|min:3',
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'user_id' => 'required|array|exists:users,id|min:2',
        ]);
        
        $booking = Booking::create($request->only([
            'customer_name', 'usage_at', 'estimated_duration', 'note', 'vehicle_id', 'driver_id'
        ]));

        foreach ($request->user_id as $id) {
            Approval::create([
                'booking_id' => $booking->id,
                'user_id' => $id
            ]);
        }

        return redirect()->route('booking.index');
    }

    public function edit(Booking $booking) {
        return view('booking.edit', compact('booking'));   
    }

    public function test() {
        // Data sebelumnya
        $dataLama = [
            ["id" => 1, "name" => "zulfahmi"],
            ["id" => 2, "name" => "zulfahmi 2"],
        ];
        
        // Data yang baru
        $dataBaru = [
            ["id" => 1, "name" => "zulfahmi"],
            ["id" => 3, "name" => "zulfahmi 3"],
        ];

        $new = [];
        
        foreach ($dataBaru as $db) {
            $exists = false;
            foreach ($dataLama as $dl) {
                if ($db['id'] == $dl['id']) $exists = true;
            }
            if (!$exists) $dataLama[] = $db;
        }
        
        foreach ($dataLama as $i => $dl) {
            $exists = false;
            foreach ($dataBaru as $db) {
                if ($dl['id'] == $db['id']) $exists = true;
            }
            if (!$exists) unset($dataLama[$i]);
        }
        
        // Hasil akhir adalah $dataLama yang sudah terupdate
        dd(array_values($dataLama));
    }

    public function matchingApprovers($approvers_ids, $booking_id) {
        $approvers_old_ids = Approval::where('booking_id', $booking_id)->pluck('user_id')->toArray();
        $new_approvers_ids = [];
        $reduce_approvers_ids = [];
        foreach ($approvers_ids as $db) {
            $exists = false;
            foreach ($approvers_old_ids as $dl) {
                if ($db == $dl) $exists = true;
            }
            if (!$exists) $new_approvers_ids[] = $db;
        }
        
        foreach ($approvers_old_ids as $i => $dl) {
            $exists = false;
            foreach ($approvers_ids as $db) {
                if ($dl == $db) $exists = true;
            }
            if (!$exists) $reduce_approvers_ids[] = $dl;
        }
        return [
            "reduce" => $reduce_approvers_ids,
            "new" => $new_approvers_ids
        ];
    }

    public function update(Request $request, Booking $booking) {
        $this->validate($request, [
            'customer_name' => 'required|string',
            'usage_at' => 'required|date_format:Y-m-d\TH:i',
            'estimated_duration' => 'required|numeric',
            'note' => 'required|string|min:3',
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'user_id' => 'required|array|exists:users,id|min:2',
        ]);
        
        $booking->update($request->only([
            'customer_name', 'usage_at', 'estimated_duration', 'note', 'vehicle_id', 'driver_id'
        ]));

        $data = $this->matchingApprovers($request->user_id, $booking->id);
        $reduce_approvals = Approval::whereIn('user_id', $data['reduce'])->where('booking_id', $booking->id)->get();
        foreach ($reduce_approvals as $approval) {
            $approval->delete();
        }
        foreach ($data['new'] as $approver_id) {
            Approval::create([
                'booking_id' => $booking->id,
                'user_id' => $approver_id
            ]);
        }

        return redirect()->route('booking.index');
    }

    public function destroy(Booking $booking) {
        $booking->delete();

        return redirect()->route('booking.index');
    }
}
