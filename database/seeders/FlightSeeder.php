<?php

namespace Database\Seeders;

// database/seeders/FlightSeeder.php

use App\Models\Flight;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run()
    {
        Flight::factory()->count(10)->create();
    }
}
