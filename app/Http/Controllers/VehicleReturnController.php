<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleReturnController extends Controller
{
    public function index() {
        return view('vehicle_return.index');
    }
}
