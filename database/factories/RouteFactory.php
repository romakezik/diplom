<?php

namespace Database\Factories;

// database/factories/RouteFactory.php

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    protected $model = Route::class;

    public function definition()
    {
        $cities = ['Минск', 'Воложин','Молодечно'];

        $start_city = $this->faker->randomElement($cities);

        $end_city = $this->faker->randomElement(array_diff($cities, [$start_city])); 

        return [
            'start_city' => $start_city,
            'end_city' => $end_city,
            'price' => $this->faker->randomFloat(2, 6, 6),
        ];
    }
}
