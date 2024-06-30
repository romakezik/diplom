<?php

namespace Database\Factories;
// database/factories/StopFactory.php

use App\Models\Route;
use App\Models\Stop;
use Illuminate\Database\Eloquent\Factories\Factory;

class StopFactory extends Factory
{
    protected $model = Stop::class;

    public function definition()
    {
        return [
            'route_id' => Route::factory(),
            'stop_name' => $this->faker->streetName,
            'stop_order_number' => $this->faker->randomDigit,
            'additional_time_from_departure' => $this->faker->numberBetween(1,60),
        ];
    }
}

