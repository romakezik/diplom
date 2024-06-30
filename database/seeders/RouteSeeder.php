<?php

namespace Database\Seeders;

// database/seeders/RouteSeeder.php

use App\Models\Flight;
use App\Models\Route;
use App\Models\Stop;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    public function run()
    {
        Route::factory(6)->create()->each(function ($route) {
            
            // Создание остановок
            $stopCount = random_int(3, 5);
            for ($i = 0; $i < $stopCount; $i++) {
                Stop::factory()->create([
                    'route_id' => $route->id,
                    'additional_time_from_departure'=> $i*10, 
                    'stop_order_number' => $i,
                ]);
            }
        
            // Создание рейсов
            for ($i = 0; $i < 3; $i++) {
                Flight::factory()->create(['route_id' => $route->id]);
            }
        });
    }
}
