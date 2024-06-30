<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Flight;
use Carbon\Carbon;

class TicketSearchController extends Controller
{
    public function index()
    {
        $start_cities = Route::select('start_city')->distinct()->get();
        $end_cities = Route::select('end_city')->distinct()->get();

        return view('ticket_search', compact('start_cities', 'end_cities'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'start_city' => 'required|different:end_city',
            'end_city' => 'required|different:start_city',
            'departure_date' => 'required|date|after_or_equal:today',
            'passengers' => 'required|integer|min:1|max:5',
        ]);
    
        $flights = Flight::whereHas('route', function ($query) use ($request) {
            $query->where('start_city', $request->start_city)
                  ->where('end_city', $request->end_city);
        })->whereDate('departure_datetime', $request->departure_date)
          ->where('available_seats', '>=', $request->passengers)
          ->get();
    
        $start_cities = Route::select('start_city')->distinct()->get();
        $end_cities = Route::select('end_city')->distinct()->get();
    
        return view('ticket_search', compact('start_cities', 'end_cities', 'flights'));
    }
    
    public function searchFromLink($start_city, $end_city)
{
    // Find the next flight for this route
    $nextFlight = Flight::whereHas('route', function ($query) use ($start_city, $end_city) {
        $query->where('start_city', $start_city)
              ->where('end_city', $end_city);
    })
    ->where('departure_datetime', '>', Carbon::now())
    ->orderBy('departure_datetime', 'asc')
    ->first();

    // If there is no next flight, you can redirect back with an error message
    if (!$nextFlight) {
        return redirect()->back()->withErrors(['message' => 'No upcoming flights for this route.']);
    }

    $departure_date = Carbon::parse($nextFlight->departure_datetime)->format('Y-m-d');

    $request = new Request([
        'start_city' => $start_city,
        'end_city' => $end_city,
        'departure_date' => $departure_date,
        'passengers' => 1, // default to 1 passenger
    ]);

    return $this->search($request);
}


}
