<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Stop;
use Carbon\Carbon;

class FlightDetailsController extends Controller
{
    public function show($id)
    {
        $flight = Flight::with(['route.stops', 'car', 'driver'])->findOrFail($id);

        $stops = $flight->route->stops->sortBy('stop_order_number')->map(function ($stop) use ($flight) {
            $flight->departure_datetime = Carbon::parse($flight->departure_datetime);
            $tmp =  $flight->departure_datetime;          
            $stop->departure_time = $tmp->addMinutes($stop->additional_time_from_departure);
            return $stop;
        });

        return view('flight_details', compact('flight', 'stops'));
    }
}
