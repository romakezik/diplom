<?php

namespace Database\Factories;



use App\Models\Flight;
use App\Models\Route;
use App\Models\Car;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'route_id' => Route::factory(),
            'car_id' => Car::factory(),
            'driver_id' => Driver::factory(),
            'departure_datetime' => $this->faker->dateTimeBetween('now', '+1 day'),
            'available_seats' => $this->faker->numberBetween(15, 15),
        ];
    }
}
