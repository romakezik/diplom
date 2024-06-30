<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Car, Driver, Flight, Route, Stop, Ticket, User};

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showCars()
{
    $cars = Car::all();
    return view('admin.cars.index', compact('cars'));
}

public function createCar()
{
    return view('admin.cars.create');
}

public function storeCar(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'color' => 'required|max:255',
        'license_plate' => 'required|max:255',
        'number_of_passenger_seats' => 'required|integer',
    ]);

    $car = Car::create($validatedData);

    return redirect()->route('admin.cars.index')->with('success', 'Car added successfully.');
}


public function editCar(Car $car)
{
    return view('admin.cars.edit', compact('car'));
}

public function updateCar(Request $request, Car $car)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'color' => 'required|max:255',
        'license_plate' => 'required|max:255',
        'number_of_passenger_seats' => 'required|integer',
    ]);

    $car->update($validatedData);

    return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
}


public function deleteCar(Car $car)
{
    $car->delete();
    return redirect()->route('admin.cars.index');
}


//водители
public function showDrivers()
{
    $drivers = Driver::all();
    return view('admin.drivers.index', compact('drivers'));
}

public function createDriver()
{
    return view('admin.drivers.create');
}

public function storeDriver(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'phone_number' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
    ]);

    $user = User::create([
        'email' => $validatedData['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validatedData['password']),
        'phone_number' => $validatedData['phone_number'],
        'user_type' => 3,
        'remember_token' => 'token1',
        'email_verified_at' => '2024-05-10 18:56:06',
    ]);

    $driver = Driver::create([
        'name' => $validatedData['name'],
        'phone_number' => $validatedData['phone_number'],
        'user_id' => $user->id,
    ]);

    return redirect()->route('admin.drivers.index')->with('success', 'Водитель и его аккаунт успешно созданы.');
}


public function editDriver(Driver $driver)
{
    $user = User::find($driver->user_id);
    if (!$user) {
        return redirect()->route('admin.drivers.index')->with('error', 'Пользователь, связанный с этим водителем, не найден.');
    }
    return view('admin.drivers.edit', compact('driver', 'user'));
}


public function updateDriver(Request $request, Driver $driver)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'phone_number' => 'required|max:255',
        'email' => 'required|email|unique:users,email,' . $driver->user_id,
        'password' => 'nullable|min:8',
    ]);

    $driver->update([
        'name' => $validatedData['name'],
        'phone_number' => $validatedData['phone_number'],
    ]);
    
    $user = User::find($driver->user_id);
    if ($user) {
        $user->update([
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? \Illuminate\Support\Facades\Hash::make($validatedData['password']) : $user->password,
        ]);
    }

    return redirect()->route('admin.drivers.index')->with('success', 'Информация о водителе и его аккаунте успешно обновлена.');
}


public function deleteDriver(Driver $driver)
{
    $user = User::find($driver->user_id);
    $driver->delete();
    if ($user) {
        $user->delete();
    }

    return redirect()->route('admin.drivers.index')->with('success', 'Водитель и его аккаунт успешно удалены.');
}

//маршруты
public function routesIndex()
{
    $routes = Route::all();
    return view('admin.routes.index', compact('routes'));
}

public function createRoute()
{
    return view('admin.routes.create');
}

public function storeRoute(Request $request)
{
    $route = Route::create($request->only('start_city', 'end_city', 'price'));
    foreach ($request->stops as $stop) {
        $route->stops()->create($stop);
    }
    return redirect()->route('admin.routes.index');
}



public function updateRoute(Request $request, Route $route)
{
    $route->update($request->only('start_city', 'end_city', 'price'));
    foreach ($request->stops as $index => $stopData) {
        if ($index < $route->stops->count()) {
            $route->stops[$index]->update($stopData);
        } else {
            $route->stops()->create($stopData);
        }
    }
    return redirect()->route('admin.routes.index');
}


public function deleteRoute(Route $route)
{
    foreach ($route->stops as $stop) {
        $stop->delete();
    }
    $route->delete();
    return redirect()->route('admin.routes.index');
}


public function editRoute(Route $route)
{
    return view('admin.routes.edit', compact('route'));
}

//рейсы
public function indexFlight(Request $request)
{
    $flights = Flight::query();
    if ($request->start_city) {
        $flights->whereHas('route', function ($query) use ($request) {
            $query->where('start_city', $request->start_city);
        });
    }
    if ($request->end_city) {
        $flights->whereHas('route', function ($query) use ($request) {
            $query->where('end_city', $request->end_city);
        });
    }
    if ($request->departure_date) {
        $flights->whereDate('departure_datetime', $request->departure_date);
    }
    $flights = $flights->get();
    $start_cities = Route::select('start_city')->distinct()->get();
    $end_cities = Route::select('end_city')->distinct()->get();
    return view('admin.flights.index', compact('flights', 'start_cities', 'end_cities'));
}




public function createFlight()
{
    $routes = Route::all();
    $cars = Car::all();
    $drivers = Driver::all();
    return view('admin.flights.create', compact('routes', 'cars', 'drivers'));
}

public function storeFlight(Request $request)
{
    Flight::create($request->all());
    return redirect()->route('admin.flights.index');
}

public function editFlight($id)
{
    $flight = Flight::findOrFail($id);
    $routes = Route::all();
    $cars = Car::all();
    $drivers = Driver::all();
    return view('admin.flights.edit', compact('flight', 'routes', 'cars', 'drivers'));
}


public function updateFlight(Request $request, $id)
{
    $flight = Flight::findOrFail($id);
    $flight->update($request->all());
    return redirect()->route('admin.flights.index')->with('success', 'Рейс успешно обновлен');
}

public function destroyFlight($id)
{
    $flight = Flight::findOrFail($id);
    $flight->delete();
    return redirect()->route('admin.flights.index')->with('success', 'Рейс успешно удален');
}





}
