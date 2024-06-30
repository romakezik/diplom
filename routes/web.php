<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TicketSearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//рейсы поиск
Route::get('/ticket_search', 'App\Http\Controllers\TicketSearchController@index')->name('ticket_search');
Route::post('/ticket_search', 'App\Http\Controllers\TicketSearchController@search');

//детали рейса
Route::get('/flight_details/{id}', 'App\Http\Controllers\FlightDetailsController@show')->name('flight_details');

//бронирование
Route::get('booking/create/{flight}', [BookingController::class, 'create'])->name('booking.create');
Route::post('booking/store/{flight}', [BookingController::class, 'store'])->name('booking.store');
Route::get('/calculate-price/{flight}', [BookingController::class, 'calculatePrice'])->name('booking.calculate_price');

//отображение билетов ваших
Route::get('/user/tickets', [UserController::class, 'tickets'])->name('user.tickets');
Route::delete('/user/tickets/{id}', [UserController::class,'cancelTicket'])->name('user.cancelTicket');

//главная
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

//поиск по ссылке с главной
Route::get('/ticket_search/{start_city}/{end_city}/{departure_date}', [TicketSearchController::class, 'searchFromLink'])->name('ticket_search.link');

//админпанель
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

//машины
Route::get('/admin/cars', [AdminController::class, 'showCars'])->name('admin.cars.index');
Route::get('/admin/cars/create', [AdminController::class, 'createCar'])->name('admin.cars.create');
Route::post('/admin/cars', [AdminController::class, 'storeCar'])->name('admin.cars.store');
Route::get('/admin/cars/{car}/edit', [AdminController::class, 'editCar'])->name('admin.cars.edit');
Route::put('/admin/cars/{car}', [AdminController::class, 'updateCar'])->name('admin.cars.update');
Route::delete('/admin/cars/{car}', [AdminController::class, 'deleteCar'])->name('admin.cars.delete');

//водители
Route::get('/admin/drivers', [AdminController::class, 'showDrivers'])->name('admin.drivers.index');
Route::get('/admin/drivers/create', [AdminController::class, 'createDriver'])->name('admin.drivers.create');
Route::post('/admin/drivers', [AdminController::class, 'storeDriver'])->name('admin.drivers.store');
Route::get('/admin/drivers/{driver}/edit', [AdminController::class, 'editDriver'])->name('admin.drivers.edit');
Route::put('/admin/drivers/{driver}', [AdminController::class, 'updateDriver'])->name('admin.drivers.update');
Route::delete('/admin/drivers/{driver}', [AdminController::class, 'deleteDriver'])->name('admin.drivers.delete');

// маршруты
Route::get('/admin/routes', [AdminController::class, 'routesIndex'])->name('admin.routes.index');
Route::get('/admin/routes/create', [AdminController::class,'createRoute'])->name('admin.routes.create');
Route::post('/admin/routes', [AdminController::class,'storeRoute'])->name('admin.routes.store');
Route::get('/admin/routes/{route}/edit', [AdminController::class,'editRoute'])->name('admin.routes.edit');
Route::put('/admin/routes/{route}', [AdminController::class,'updateRoute'])->name('admin.routes.update');
Route::delete('/admin/routes/{route}', [AdminController::class,'deleteRoute'])->name('admin.routes.delete');

// рейсы
Route::get('/admin/flights', [AdminController::class, 'indexFlight'])->name('admin.flights.index');
Route::get('/admin/flights/create', [AdminController::class,'createFlight'])->name('admin.flights.create');
Route::post('/admin/flights', [AdminController::class,'storeFlight'])->name('admin.flights.store');
Route::get('/admin/flights/{flights}/edit', [AdminController::class,'editFlight'])->name('admin.flights.edit');
Route::put('/admin/flights/{flights}', [AdminController::class,'updateFlight'])->name('admin.flights.update');
Route::delete('/admin/flights/{id}', [AdminController::class, 'destroyFlight'])->name('admin.flights.destroy');

//водилаюзер
Route::get('/driver/flights', [DriverController::class, 'flights'])->name('driver.flights');
Route::get('/driver/flights/{flight}/users', [DriverController::class, 'flightUsers'])->name('driver.flight.users');
Route::get('/driver/flights/{flight}', [DriverController::class,'viewFlight'])->name('driver.flight.view');

Route::get('/driver/tickets/{ticket}/confirm', [DriverController::class,'confirmTicket'])->name('driver.ticket.confirm');
Route::get('/driver/ticket/noShow/{ticket}', [DriverController::class, 'noShowTicket'])->name('driver.ticket.noShow');

require __DIR__.'/auth.php';
