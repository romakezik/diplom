<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Driver;
class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition()
{

    return [
        'name' => $this->faker->name, 
        'phone_number' => $this->faker->numerify('+37544#######'), 
    ];
}

}
