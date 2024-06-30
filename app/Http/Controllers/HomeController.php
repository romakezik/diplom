<?php
namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $popularRoutes = Route::withCount(['flights as tickets_sold' => function ($query) {
            $query->join('tickets', 'flights.id', '=', 'tickets.flight_id');
        }])
        ->orderBy('tickets_sold', 'desc')
        ->take(6)
        ->get();

        $recommendedRoutes = $this->getRecommendedRoutes();

        return view('dashboard', compact('popularRoutes', 'recommendedRoutes'));
    }

    private function getRecommendedRoutes()
    {
        $user = Auth::user();

        if ($user == null) {
            return collect(); // Return an empty collection if no previous bookings are found
        }
    // Check if the user has previously booked tickets
    $previousBookings = Ticket::where('user_id', $user->id)->exists();

    if (!$previousBookings) {
        return collect(); // Return an empty collection if no previous bookings are found
    }

    
        $routes = Ticket::where('user_id', $user->id)
            ->join('flights', 'tickets.flight_id', '=', 'flights.id')
            ->join('routes', 'flights.route_id', '=', 'routes.id')
            ->select('routes.start_city', 'routes.end_city', 'routes.price')
            ->groupBy('routes.start_city', 'routes.end_city', 'routes.price')
            ->orderByRaw('COUNT(*) DESC')
            ->get();
    
        // Add reverse routes
        foreach ($routes as $route) {
            $reverseRoute = new Route;
            $reverseRoute->start_city = $route->end_city;
            $reverseRoute->end_city = $route->start_city;
            $reverseRoute->price = $route->price;
    
            // Check for reverse route
            if (! $routes->contains(function($r) use ($reverseRoute) {
                return $r->start_city == $reverseRoute->start_city && $r->end_city == $reverseRoute->end_city;
            })) {
                $routes->push($reverseRoute);
            }
        }
        $routes = $routes->unique(function($route) {
            return $route->start_city.$route->end_city;
        });
        
        // If less than 6 routes, add popular routes
        if (count($routes) < 6) {
            $popularRoutes = Route::withCount(['flights as tickets_sold' => function ($query) {
                $query->join('tickets', 'flights.id', '=', 'tickets.flight_id');
            }])
            ->where('start_city', $routes[0]->start_city)
            ->orderBy('tickets_sold', 'desc')
            ->get();
    
            foreach ($popularRoutes as $popularRoute) {
                // Check for popular route
                if (! $routes->contains(function($r) use ($popularRoute) {
                    return $r->start_city == $popularRoute->start_city && $r->end_city == $popularRoute->end_city;
                })) {
                    $routes->push($popularRoute);
                }
            }
    
            $routes = $routes->unique(function($route) {
                return $route->start_city.$route->end_city;
            })->values()->take(6);
        }
    
        return $routes;
    }
    
    
}
