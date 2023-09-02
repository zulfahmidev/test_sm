<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request) {
        $vehicles = Vehicle::where(function($query) use ($request) {
            if ($search = $request->search) {
                $query->orWhere('plat', 'LIKE', "%$search%");
            }
        })->latest()->paginate(10);

        return view('vehicle.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle) {

        return view('vehicle.show', compact('vehicle'));
    }

    public function create() {
        return view('vehicle.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'plat' => 'required|string',
            'transport_type' => 'required|in:goods,passengers',
            'ownership_status' => 'required|in:owned,leased',
            'capacity' => 'required|numeric',
            'condition' => 'required|in:damaged,good,repair',
        ]);
        
        Vehicle::create($request->only([
            'plat', 'transport_type', 'capacity', 'ownership_status', 'condition'
        ]));

        return redirect()->route('vehicle.index');
    }

    public function edit(Vehicle $vehicle) {
        return view('vehicle.edit', compact('vehicle'));   
    }

    public function update(Request $request, Vehicle $vehicle) {
        $this->validate($request, [
            'plat' => 'required|string',
            'transport_type' => 'required|in:goods,passengers',
            'ownership_status' => 'required|in:owned,leased',
            'capacity' => 'required|numeric',
            'condition' => 'required|in:damaged,good,repair',
        ]);
        
        $vehicle->update($request->only([
            'plat', 'transport_type', 'capacity', 'ownership_status', 'condition'
        ]));

        return redirect()->route('vehicle.index');
    }

    public function destroy(Vehicle $vehicle) {
        $vehicle->delete();

        return redirect()->route('vehicle.index');
    }
}
