<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;


class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        $cars = ['Мерседес', 'Форд','Фольксваген'];
        return [
            'name' => $this->faker->randomElement($cars),
            'color' => $this->faker->safeColorName,
            'license_plate' => $this->faker->bothify('####??-#'),
            'number_of_passenger_seats' => $this->faker->numberBetween(15, 15),
        ];
    }
}
