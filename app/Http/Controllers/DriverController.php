<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(Request $request) {
        $drivers = Driver::where(function($query) use ($request) {
            if ($search = $request->search) {
                $query->orWhere('fullname', 'LIKE', "%$search%");
                $query->orWhere('phone', 'LIKE', "%$search%");
            }
        })->latest()->paginate(10);

        return view('driver.index', compact('drivers'));
    }

    public function show(Driver $driver) {

        return view('driver.show', compact('driver'));
    }

    public function create() {
        return view('driver.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'fullname' => 'required|string',
            'phone' => 'required|numeric',
            'availability_status' => 'required|in:yes,not',
        ]);
        
        Driver::create($request->only([
            'fullname', 'phone', 'availability_status'
        ]));

        return redirect()->route('driver.index');
    }

    public function edit(Driver $driver) {
        return view('driver.edit', compact('driver'));   
    }

    public function update(Request $request, Driver $driver) {
        $this->validate($request, [
            'fullname' => 'required|string',
            'phone' => 'required|numeric',
            'availability_status' => 'required|in:yes,not',
        ]);
        
        $driver->update($request->only([
            'fullname', 'phone', 'availability_status'
        ]));

        return redirect()->route('driver.index');
    }

    public function destroy(Driver $driver) {
        $driver->delete();

        return redirect()->route('driver.index');
    }
}
