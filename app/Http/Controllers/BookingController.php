<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Ticket;
use Ramsey\Uuid\Type\Decimal;

class BookingController extends Controller
{
    public function create(Flight $flight)
    {
        return view('booking.create', compact('flight'));
    }

    public function store(Request $request, Flight $flight)
{
    $request->validate([
        'entrance_stop_id' => 'required',
        'exit_stop_id' => 'required',
        'passengers' => 'required|integer|min:1|max:' . $flight->available_seats,
    ]);

    if ($flight->available_seats == 0) {
        return back()->with('error', 'No available seats for this flight.');
    }

    $entrance_stop = $flight->route->stops()->where('id', $request->entrance_stop_id)->first();
    $exit_stop = $flight->route->stops()->where('id', $request->exit_stop_id)->first();

    if (!$entrance_stop || !$exit_stop) {
        return back()->with('error', 'Invalid stop selected.');
    }

    $full_duration = $flight->route->stops()->orderBy('stop_order_number', 'desc')->first()->additional_time_from_departure;
    $price = $flight->route->price *  ($exit_stop->additional_time_from_departure - $entrance_stop->additional_time_from_departure)/ $full_duration;

    for ($i = 0; $i < $request->passengers; $i++) {
        Ticket::create([
            'flight_id' => $flight->id,
            'entrance_stop_id' => $request->entrance_stop_id,
            'exit_stop_id' => $request->exit_stop_id,
            'user_id' => auth()->id(),
            'price' => $price,
            'status' => 'забронирован'
        ]);
    }

    $flight->available_seats -= $request->passengers;
    $flight->save();

    return redirect()->route('dashboard')->with('success', 'Ticket successfully booked, you can manage it in the "Your Reservations" tab!');
}
public function calculatePrice(Request $request, Flight $flight)
{
    $entrance_stop = $flight->route->stops()->where('id', $request->entrance_stop_id)->first();
    $exit_stop = $flight->route->stops()->where('id', $request->exit_stop_id)->first();

    if (!$entrance_stop || !$exit_stop) {
        return response()->json(['error' => 'Invalid stop selected.']);
    }

    $full_duration = $flight->route->stops()->orderBy('stop_order_number', 'desc')->first()->additional_time_from_departure;
    $price = $flight->route->price *  ($exit_stop->additional_time_from_departure - $entrance_stop->additional_time_from_departure)/ $full_duration;
    $price =  number_format($price,2,'.'); 
    return response()->json(['price' => $price]);
}

}
