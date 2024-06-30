<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function flights(Request $request)
    {
        $user = Auth::user(); // assuming the driver is logged in
        $driver = $user->driver; // get the driver for the user
        $flights = $driver->flights();
    
        if ($request->has('date')) {
            $date = Carbon::parse($request->get('date'));
            $flights->whereDate('departure_datetime', $date);
        }
    
        $flights = $flights->get();
    
        return view('driver.flights', compact('flights'));
    }
    



public function viewFlight(Flight $flight)
{
    $stops = $flight->route->stops()->orderBy('stop_order_number')->get();

    return view('driver.view_flight', compact('flight', 'stops'));
}
public function flightUsers(Flight $flight)
{
    $users = $flight->tickets->map->user;
    $stops = $flight->route->stops()->orderBy('stop_order_number')->get();

    return view('driver.flight_users', compact('users', 'flight', 'stops'));
}



public function confirmTicket(Request $request, Ticket $ticket)
{
    $ticket->update(['status' => 'оплачен']);

    return back();
}
public function noShowTicket(Request $request, Ticket $ticket)
{
    $ticket->update(['status' => 'неявился']);

    return back();
}

}
